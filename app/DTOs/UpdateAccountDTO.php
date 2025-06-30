<?php

namespace App\DTOs;
class UpdateAccountDTO
{
    public function __construct(
        public readonly string $model_id,
        public readonly string $username,
        public readonly ?string $password,
        public readonly ?string $password_confirmation,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['user_id'],
            username: $data['username'],
            password: bcrypt($data['password']) ?: null,
            password_confirmation: $data['password_confirmation'] ?? null,
        );
    }
}

