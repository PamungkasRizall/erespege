<?php

namespace App\DTOs;
class CredentialQuestionDTO
{
    public function __construct(
        public readonly ?string $model_id,
        public readonly int $functional_position_id,
        public readonly string $name,
        public readonly array $choices,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'] ?? null,
            functional_position_id: $data['functional_position_id'],
            name: preg_replace('/\s+/', ' ', trim($data['name'])),
            choices: $data['choices'],
        );
    }
}

