<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function all(): Collection
    {
        return Role::orderBy('name')->pluck('name', 'id');
    }

    public function findByName(string $name): Role|null
    {
        return Role::where('name', $name)->first();
    }
}
