<?php

namespace App\Services;

use App\DTOs\FunctionalPositionDTO;
use App\Models\FunctionalPosition;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FunctionalPositionService
{
    public function findOrFail(int $code): FunctionalPosition
    {
        return FunctionalPosition::with('profession')->findOrFail($code);
    }

    public function getFunctionalPositions(?int $profession_id = null): Collection
    {
        return FunctionalPosition::when( $profession_id, function ($q) use($profession_id) {
                return $q->where('profession_id',$profession_id);
            })
            ->pluck('name', 'id')
            ->sort();
    }

    public function storeFunctionalPosition(FunctionalPositionDTO $dto): FunctionalPosition
    {
        return DB::transaction(function () use ($dto) {
            return FunctionalPosition::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );
        });
    }

    public function deleteFunctionalPosition(int $id): void
    {
        DB::transaction(function () use ($id) {
            $this->findOrFail($id)->delete();
        });
    }
}
