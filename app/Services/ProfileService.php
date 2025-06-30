<?php

namespace App\Services;

use App\DTOs\ProfileDTO;
use App\DTOs\UpdateAccountDTO;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileService
{
    public function findOrFail(int $id): Profile
    {
        return Profile::findOrFail($id);
    }

    public function storeProfile(ProfileDTO $dto): Profile
    {
        return DB::transaction(function () use ($dto) {
            $profile = Profile::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );

            $user = User::find($dto->user_id);
            $user->profile_completed = true;
            $user->save();

            $this->handleAssignRoles($user);

            return $profile;
        });
    }

    private function handleAssignRoles(User $user): void
    {
        $roleName = authUserCommittee()->role();
        $role = (new RoleService)->findByName($roleName);

        if ($role)
            $user->assignRole([$role->id]);
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
}
