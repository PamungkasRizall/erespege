<?php

namespace App\DTOs;
class UserDTO
{
    public function __construct(
        public readonly ?string $model_id,
        public readonly string $name,
        public readonly string $username,
        public readonly int $nip,
        public readonly ?string $password,
        public readonly ?string $password_confirmation,
        public readonly array $roles,
        public readonly int $structure_id,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'] ?? null,
            name: $data['name'],
            username: $data['username'],
            nip: $data['nip'],
            password: bcrypt($data['password']) ?: null,
            password_confirmation: $data['password_confirmation'] ?? null,
            roles: $data['roles'],
            structure_id: $data['structureId'],
            // profile: [
            //     'nik' => $data['nik'],
            //     'doctoral_degree' => $data['doctoral_degree'] ?? null,
            //     'academic_degree' => $data['academic_degree'],
            //     'place_of_birth' => $data['place_of_birth'],
            //     'date_of_birth' => $data['date_of_birth'],
            //     'profession_id' => $data['profession_id'],
            // ],
        );
    }
}

