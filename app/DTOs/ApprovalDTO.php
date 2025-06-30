<?php

namespace App\DTOs;

use Carbon\Carbon;

class ApprovalDTO
{
    public function __construct(
        public readonly ?string $notes,
        public readonly int $status,
        public readonly ?Carbon $recomendation_at,
        public readonly ?string $recomendation_code,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            notes: $data['notes'] ?? null,
            status: $data['status'],
            recomendation_at: $data['recomendation_at'] ?? null,
            recomendation_code: $data['recomendation_code'] ?? null,
        );
    }
}

