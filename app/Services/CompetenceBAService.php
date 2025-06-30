<?php

namespace App\Services;

use App\DTOs\ApprovalDTO;
use App\DTOs\CompetenceBADTO;
use App\Enums\FilingStatus;
use App\Models\CompetenceBA;
use App\Models\Filing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompetenceBAService
{
    public function findOrFail(string $id): CompetenceBA
    {
        return CompetenceBA::findOrFail($id);
    }

    public function getBAByFilingId(string $filingId): ?CompetenceBA
    {
        return CompetenceBA::whereRaw("JSON_CONTAINS(filings, '\"{$filingId}\"')")
            ->with('profession', 'assesor', 'approvals')
            ->first();
    }

    public function storeBA(CompetenceBADTO $dto): CompetenceBA
    {
        return DB::transaction(function () use ($dto) {
            $competeceBA = CompetenceBA::create(
                    (array) $dto
                );

            $this->handleUpdateFilings($dto->filings, FilingStatus::SUB_COMMITTEE);

            return $competeceBA;
        });
    }

    public function storeApprovalSubCommitte(CompetenceBA $competenceBA, ApprovalDTO $dto)
    {
        return DB::transaction(function () use ($competenceBA, $dto) {
            $competenceBA->approvals()->create((array) $dto);

            $this->handleUpdateFilings($competenceBA->filings, FilingStatus::HEAD_OF_COMMITTEE);

            $competenceBA->sub_committee_id = Auth::id();
            $competenceBA->save();

            return $competenceBA;
        });
    }

    private function handleUpdateFilings(array $filingIds, FilingStatus $filingStatus)
    {
        Filing::whereIn('id', $filingIds)
            ->update(['status' => $filingStatus]);
    }
}
