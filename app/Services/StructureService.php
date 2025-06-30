<?php

namespace App\Services;

use App\DTOs\StructureDTO;
use App\Models\Structure;
use App\Repositories\StructureRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StructureService
{
    protected StructureRepository $structureRepository;

    public function __construct(StructureRepository $structureRepository)
    {
        $this->structureRepository = $structureRepository;
    }

    public function getStructureById(int $id): ?Structure
    {
        return $this->structureRepository->findById($id);

        // if (!$user) {
        //     throw new \Exception("User tidak ditemukan");
        // }

        // return $user;
    }

    public function getStructuresIsUnique(bool $isUnique = true)
    {
        return $this->structureRepository->getAllWithCondition([['is_unique', $isUnique]])->pluck('name', 'id');
    }

    public function getStructuresIsMain(bool $isMain = true)
    {
        return $this->structureRepository->getAllWithCondition([['is_main', $isMain]])->pluck('name', 'id');
    }

    public function getStructuresByName(string $name): ?Collection
    {
        return $this->structureRepository->findByName($name);
    }

    public function getAllHeadOfs(): Collection
    {
        return $this->structureRepository->getHeadOfs();
    }

    public function storeStructure(StructureDTO $dto): Structure
    {
        return DB::transaction(fn() => $this->structureRepository->updateOrCreate((array) $dto));
    }

    public function deleteStructure(int $id): bool
    {
        return $this->structureRepository->delete($id);
    }
}
