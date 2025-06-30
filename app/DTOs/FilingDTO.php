<?php

namespace App\DTOs;

use App\Enums\FilingOrigin;
use App\Enums\FilingStatus;
use Carbon\Carbon;

class FilingDTO
{
    public function __construct(
        public readonly ?string $model_id,
        public readonly string $name,
        public readonly int $category_id,
        public readonly string $letter_no,
        public readonly Carbon $start_date,
        public readonly ?Carbon $end_date,
        public readonly bool $is_end,
        public readonly FilingStatus $status,
        public readonly FilingOrigin $origin,
        public readonly ?string $competence_id,
        public readonly ?string $str_code,
        public readonly ?string $sik_code,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'] ?? null,
            name: $data['name'],
            category_id: $data['category_id'],
            letter_no: $data['letter_no'],
            start_date: $data['start_date'],
            end_date: $data['end_date'] ?? null,
            is_end: $data['is_end'] ?? false,
            status: $data['status'] ?? FilingStatus::SUB_COMMITTEE,
            origin: $data['origin'] ?? FilingOrigin::MANUAL,
            competence_id: $data['competence_id'] ?? null,
            str_code: $data['str_code'] ?? null,
            sik_code: $data['sik_code'] ?? null,
        );
    }
}

