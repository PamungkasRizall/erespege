<?php

namespace App\Repositories;

use App\Models\Structure;
use Illuminate\Support\Collection;

class StructureRepository
{
    public function findById(int $id): ?Structure
    {
        return Structure::findOrFail($id);
    }

    public function findByName(string $name): ?Collection
    {
        return Structure::with('users')->where('name', $name)->get();
    }

    public function getAll(): mixed
    {
        return Structure::all();
    }

    public function getAllWithCondition(array $conditions): mixed
    {
        return Structure::where($conditions)->orderBy('name')->get();
    }

    public function getHeadOfs(): Collection
    {
        return Structure::where('is_unique', true)
            ->orderBy('name')
            ->pluck('name', 'id');
    }

    public function updateOrCreate(array $data): Structure
    {
        return Structure::updateOrCreate(
            ['id' => $data['modelId']],
            $data
        );
    }

    public function delete(int $id): bool
    {
        $structure = self::findById($id);

        if (!$structure) {
            return false;
        }

        return $structure->delete();
    }

    // protected const CACHE_KEY = 'users.all';
    // protected const CACHE_TTL = 60 * 5; // Cache for 5 minutes

    // public function getAll(): mixed
    // {
    //     return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
    //         return User::all();
    //     });
    // }

    // public function findById(int $id): ?User
    // {
    //     return User::find($id);
    // }

    // public function findByEmail(string $email): ?User
    // {
    //     return User::where('email', $email)->first();
    // }

    // public function create(array $data): User
    // {
    //     $user = User::create($data);
        // Cache::forget(self::CACHE_KEY); // Clear cache when new user is created
        // return $user;
    // }

    // public function delete(int $id): bool
    // {
    //     $user = User::find($id);

    //     if (!$user) {
    //         return false;
    //     }

    //     return $user->delete();
    // }
}

