<?php

namespace App\DTOs;
class FunctionalPositionDTO
{
    public function __construct(
        public readonly ?string $model_id,
        public readonly string $name,
        public readonly int $profession_id,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'] ?? null,
            name: $data['name'],
            profession_id: $data['profession_id'],
        );
    }
}

