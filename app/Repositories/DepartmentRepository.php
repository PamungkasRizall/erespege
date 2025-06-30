<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Support\Collection;

class DepartmentRepository
{
    public function findById(int $id): ?Department
    {
        return Department::findOrFail($id);
    }

    public function getAll(): ?Collection
    {
        return Department::all();
    }

    public function getAllPlucks(): ?Collection
    {
        return Department::orderBy('name')->pluck('id', 'name');
    }

    // public function updateOrCreate(array $data): Structure
    // {
    //     return Structure::updateOrCreate(
    //         ['id' => $data['modelId']],
    //         $data
    //     );
    // }

    // public function delete(int $id): bool
    // {
    //     $structure = self::findById($id);

    //     if (!$structure) {
    //         return false;
    //     }

    //     return $structure->delete();
    // }
}

