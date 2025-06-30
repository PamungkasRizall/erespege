<?php

namespace App\DTOs;

use App\Enums\Committee;

class ProfessionDTO
{
    public function __construct(
        public readonly ?string $model_id,
        public readonly string $name,
        public readonly Committee $committee,
        public readonly array $assesors,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'] ?? null,
            name: $data['name'],
            committee: $data['committee'],
            assesors: $data['assesors'],
        );
    }
}

