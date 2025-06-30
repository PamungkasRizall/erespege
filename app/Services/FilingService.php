<?php

namespace App\Services;

use App\DTOs\ApprovalDTO;
use App\DTOs\FilingDTO;
use App\Enums\CategoryType;
use App\Enums\FilingOrigin;
use App\Enums\FilingStatus;
use App\Models\Filing;
use App\Models\Traits\HasMediaSetting;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class FilingService
{
    use HasMediaSetting;

    public function findOrFail(string $id, ?array $relationships = null): Filing
    {
        return Filing::when( $relationships, fn($q) => $q->with ($relationships))
            ->findOrFail($id);
    }

    public function getAllByIds(array $ids): Collection
    {
        return Filing::with('user.profile.profession')->whereIn('id', $ids)->get();
    }

    public function getUserFilingsByOrigin(string $userId, FilingOrigin $isOrigin = FilingOrigin::MANUAL)
    {
        return Filing::whereUserId($userId)->whereOrigin($isOrigin)->get();
    }

    public function countingCredentialByUser(string $user_id, ?FilingStatus $status = null): int
    {
        $category_id = $this->getCategoryIdKredential();

        return Filing::where([['user_id', $user_id], ['category_id', $category_id]])
            ->when($status, fn($q) => $q->where('status', $status))
            ->count();
    }

    public function getLastCredential(?FilingStatus $status = null): Filing|null
    {
        $category_id = $this->getCategoryIdKredential();

        return Filing::where([
                ['category_id', $category_id],
                ['user_id', Auth::id()]
            ])
            ->when( $status, fn($q) => $q->where('status', $status))
            ->latest('created_at')
            ->first();
    }

    public function storeFiling(FilingDTO $dto, ?UploadedFile $file = null): Filing
    {
        return DB::transaction(function () use ($dto, $file) {
            $filing = Filing::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );

            if ($file) {
                $this->handleFileUpload($filing, $file, $dto->name);
            }

            return $filing;
        });
    }

    public function updateStatus(Filing $filing, FilingStatus $filingStatus)
    {
        // return DB::transaction(function () use ($filing, $filingStatus) {
        //     return Filing::where('id', $filing->id)
        //         ->update([
        //             'status' => $filingStatus,
        //             'end_at' => Carbon::now()
        //         ]);
        // });
        return DB::transaction(fn() => Filing::where('id', $filing->id)
            ->update([
                'status' => $filingStatus,
                'end_at' => Carbon::now()
            ])
        );
    }

    public function updateStatusWithData(Filing $filing, array $data)
    {
        return DB::transaction(fn() => Filing::where('id', $filing->id)
                ->update($data)
        );
    }

    public function deleteFiling(string $id): void
    {
        DB::transaction(function () use ($id) {
            $filing = self::findOrFail($id);
            $filing->delete();

            $this->deleteExistingFile($filing);
        });
    }

    public function checkLastCredential(FilingDTO $dto)
    {
        $category_id = $this->getCategoryIdKredential();

        if ($dto->category_id === $category_id) {
            if (self::getLastCredential())
                throw new Exception('Pemberkasan Kredensial Selanjutnya Sudah Melalui Aplikasi');
        }
    }

    public function assessmentOnPeriod(Filing $lastCredential): bool
    {
        $days = round(Carbon::now()->diffInDays($lastCredential->end_date));
        $statusDone = $lastCredential->status === FilingStatus::DONE;//done

        return in_array($days, range(1, Filing::ASSESSMENT_PERIOD)) && $statusDone;
    }

    public function storeApprovalHeadOfCommitte(Filing $filing, ApprovalDTO $dto)
    {
        return DB::transaction(function () use ($filing, $dto) {
            $filing->approvals()->create((array) $dto);

            $filing->status = FilingStatus::PEMBERKASAN;
            $filing->recomendation_code = $dto->recomendation_code;//self::recomendationCode($dto->recomendation_at);
            $filing->recomendation_at = $dto->recomendation_at;
            $filing->save();

            return $filing;
        });
    }

    private function recomendationCode(Carbon $recomendationAt): string
    {
        $number = Filing::whereYear('recomendation_at', $recomendationAt->year)->count() + 1;

        return sprintf(
            '%s/%s/KTKL/%s',
            $number,
            numberToRoman($recomendationAt->month),
            $recomendationAt->year
        );
    }

    public function storeFileUpload(Filing $filing, UploadedFile $file): Filing
    {
        return DB::transaction(function () use ($filing, $file) {

            $this->updateStatusWithData($filing, ['status' => FilingStatus::DONE]);
            $this->handleFileUpload($filing, $file, $filing->user->full_name, true, $filing::MEDIA_COLLECTION);

            return $filing;
        });
    }

    private function getCategoryIdKredential(): int
    {
        return (new CategoryService)->getCategoryIdByName(CategoryType::KREDENSIAL, Filing::KREDENSIAL);
    }

    public static function createMultipleDocumentAsZip(Collection $filings)
    {
        $mediaPaths = $filings->map(fn ($filing) => $filing->media->first()->getPath());

        $filename = 'document-'.Str::slug($filings->first()->user->name).'-'.$filings->first()->user->nip.'-'.date('Y-m-d').'-'.time();
        $zipPath = Storage::disk('public')->path("{$filename}.zip");
        $zip = new ZipArchive;

        // Open the zip file for creating
        if ($zip->open($zipPath, ZipArchive::CREATE) !== TRUE) {
            return response()->json(['error' => 'Failed to create zip file.'], 500);
        }

        foreach ($mediaPaths as $filePath) {

            if (!file_exists($filePath)) {
                return response()->json(['error' => 'One or more media files were not found.'], 404);
            }

            $zip->addFile($filePath, basename($filePath));
        }

        $zip->close();

        Storage::disk('public')->delete($zipPath);

        return $zipPath;
    }
}
