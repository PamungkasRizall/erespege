<?php

namespace App\DTOs;

class CompetenceAnswerDTO
{
    public function __construct(
        public readonly int $competence_detail_id,
        public readonly string $user_id,
        public readonly int $choice_id,
        public readonly string $filing_id,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            competence_detail_id: $data['competence_detail_id'],
            user_id: $data['user_id'],
            choice_id: $data['choice_id'],
            filing_id: $data['filing_id'],
        );
    }
}

