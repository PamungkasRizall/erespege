<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Enums\Committee;
use App\Models\Structure;
use App\Models\User;
use App\Models\UserStructure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserService
{
    public function findOrFail(string $id): User
    {
        return User::with('profile', 'positions')->findOrFail($id);
    }

    public function findMultipleUser(array $ids): Collection
    {
        return User::whereIn('id', $ids)->get();
    }

    public function userProfessionId(): int
    {
        return Auth::user()->profile->profession_id;
    }

    public function userCommittee(): Committee
    {
        return Auth::user()->profile->profession->committee;
    }

    public function isPosition(string $name): bool
    {
        return Auth::user()->positions->whereNull('end_date')->contains(function ($item) use($name): bool {
            return Str::is("{$name}*", strtolower($item->name));
        });
    }

    public function mainPosition(User $user): Structure|null
    {
        return $user->positions->where('is_main', true)?->first();
    }

    public function storeUser(UserDTO $dto): User
    {
        return DB::transaction(function () use ($dto) {
            $user = User::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );

            $this->assignRolesToUser($user, $dto->roles);
            $this->assignUserToPosition($user, $dto->structure_id);

            return $user;
        });
    }

    private function assignRolesToUser(User $user, array $roles): void
    {
        $user->syncRoles(array_map('intval', $roles));
    }

    private function assignUserToPosition(User $user, int $structureId): void
    {
        // $user->positions()->attach($structureId, ['start_date' => now()]);
        UserStructure::create(['user_id' => $user->id, 'structure_id' => $structureId]);
    }

    public function updateUser(UserDTO $dto): User
    {
        return DB::transaction(function () use ($dto) {
            return User::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );
        });
    }

    public function deleteUser(string $id): bool
    {
        return DB::transaction(function () use ($id) {
            $this->findOrFail($id)->delete();
        });
    }
}
