<?php

namespace App\DTOs;

use App\Enums\Committee;
use Carbon\Carbon;

class CompetenceBADTO
{
    public function __construct(
        public readonly string $location,
        public readonly Carbon $date_at,
        public readonly array $filings,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            location: $data['location'],
            date_at: $data['date_at'],
            filings: $data['filings'],
        );
    }
}

