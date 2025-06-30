<?php

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

class CompetenceDTO
{
    public function __construct(
        public readonly ?string $model_id,
        public readonly string $code,
        public readonly int $functional_position_id,
        public readonly array $choices,
        public readonly UploadedFile $file,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'] ?? null,
            code: $data['code'],
            functional_position_id: $data['functional_position_id'],
            choices: $data['choices'],
            file: $data['file'],
        );
    }
}

