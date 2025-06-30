<?php

namespace App\Services;

use App\DTOs\CompetenceDTO;
use App\DTOs\UpdateAccountDTO;
use App\Enums\CompetenceDetail;
use App\Imports\CompetenceImport;
use App\Models\Competence;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CompetenceService
{
    public function findOrFail(string $id): Competence
    {
        return Competence::findOrFail($id);
    }

    public function storeCompetence(CompetenceDTO $dto): Competence
    {
        return DB::transaction(function () use ($dto) {
            $competence = Competence::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );

            $this->handleImportDetail($competence, $dto);
            $this->handleStoreChoices($competence, $dto->choices);

            return $competence;
        });
    }

    public function handleImportDetail(Competence $competence, CompetenceDTO $dto)
    {
        return Excel::import(new CompetenceImport($competence->id), $dto->file, null, \Maatwebsite\Excel\Excel::XLSX);
    }

    private function handleStoreChoices(Competence $competence, array $choices): void
    {
        $competence->choices()->delete();
        $competence->choices()->createMany($choices);
    }

    public function storeAccount(UpdateAccountDTO $dto): User
    {
        return DB::transaction(function () use ($dto) {
            return User::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );
        });
    }

    public function storeActivation(string $id): Competence
    {
        return DB::transaction(function () use ($id) {

            $competence = $this->findOrFail($id);
            $competence->active = !$competence->active;

            Competence::where('functional_position_id', $competence->functional_position_id)->update(['active' => false]);
            $competence->save();

            return $competence;
        });
    }

    public function findByFunctionalPosition(?int $functionalPositionId = null): Competence|null
    {
        $functionalPositionId = $functionalPositionId ?: Auth::user()->profile->functional_position_id;

        return Competence::where([
                ['functional_position_id', $functionalPositionId],
                ['active', true]
            ])
            ->with('choices')
            ->first();
    }

    public function numberOfDetails(Collection $details): int
    {
        return collect(Arr::dot($details->toArray()))
            ->filter(fn($value, $key) => str_ends_with($key, '.type') && $value === CompetenceDetail::ELEMENT->value)
            ->count();
    }
}
