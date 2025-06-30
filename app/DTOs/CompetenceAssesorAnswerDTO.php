<?php

namespace App\DTOs;

class CompetenceAssesorAnswerDTO
{
    public function __construct(
        public readonly int $competence_detail_id,
        public readonly string $filing_id,
        public readonly string $assesor_id,
        public readonly int $ass_choice_id,
        // public readonly int $ass_score,

    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            competence_detail_id: $data['competence_detail_id'],
            filing_id: $data['filing_id'],
            assesor_id: $data['assesor_id'],
            ass_choice_id: $data['ass_choice_id'],
            // ass_score: $data['ass_score'],
        );
    }
}

