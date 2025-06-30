<?php

namespace App\Services;

use App\Models\Department;
use App\Repositories\DepartmentRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DepartmentService
{
    protected DepartmentRepository $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function getDepartmentById(int $id): ?Department
    {
        return $this->departmentRepository->findById($id);
    }

    public function getAllDepartments(bool $isPluck = false)
    {
        $departments = $this->departmentRepository->getAll();
        if ($isPluck)
            return $departments->pluck('name', 'id');

        return $departments;
    }

    // public function getStructuresByName(string $name): ?Collection
    // {
    //     return $this->structureRepository->findByName($name);
    // }

    // public function getAllHeadOfs(): Collection
    // {
    //     return $this->structureRepository->getHeadOfs();
    // }

    // public function storeStructure(StructureDTO $dto): Structure
    // {
    //     // return DB::transaction(function () use ($dto) {
    //     //     return $this->structureRepository->updateOrCreate((array) $dto);
    //     // });
    //     return DB::transaction(fn() => $this->structureRepository->updateOrCreate((array) $dto));
    // }

    // public function deleteStructure(int $id): bool
    // {
    //     return $this->structureRepository->delete($id);
    // }
}
