<?php

namespace App\Services;

use App\DTOs\ProfessionDTO;
use App\Enums\Committee;
use App\Models\Profession;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProfessionService
{
    private const ASSESOR_PERMISSIONS = ['assessor-list', 'assessor-create'];

    public function findOrFail(int $code): Profession
    {
        return Profession::findOrFail($code);
    }

    public function getProfessions(): Collection
    {
        return Profession::where('committee',Committee::NAKES_LAINNYA)
            ->pluck('name', 'id')
            ->sort();
    }

    public function storeProfession(ProfessionDTO $dto): Profession
    {
        return DB::transaction(function () use ($dto) {
            $profession = Profession::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );

            $this->syncAssesors($profession, $dto->assesors);

            return $profession;
        });
    }

    private function syncAssesors(Profession $profession, array $assesors)
    {
        if ($profession->assesors)
            $this->revokePermissionToAssesors($profession->assesors);

        $profession->assesors()->sync($assesors);

        $this->givePermissionToAssesors($assesors);
    }

    private function revokePermissionToAssesors(Collection $assesors)
    {
        foreach ($assesors as $assesor)
            $assesor->revokePermissionTo(self::ASSESOR_PERMISSIONS);
    }

    private function givePermissionToAssesors(array $assesors)
    {
        (new UserService)->findMultipleUser($assesors)
            ->each(fn ($user) => $user->givePermissionTo(self::ASSESOR_PERMISSIONS));
    }

    public function deleteProfession(int $id): void
    {
        DB::transaction(function () use ($id) {
            $this->findOrFail($id)->delete();
        });
    }
}
