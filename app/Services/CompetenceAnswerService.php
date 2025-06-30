<?php

namespace App\Services;

use App\Models\CompetenceAnswer;
use App\Models\Filing;
use Illuminate\Support\Facades\DB;

class CompetenceAnswerService
{
    public function getAnswersByFiling(Filing $filing, bool $isAssesor = false, bool $isNotes = false): array
    {
        $answers = CompetenceAnswer::where('filing_id', $filing->id)
            ->with('competenceDetail', 'choice')
            ->get();

        return $answers->mapWithKeys(function (CompetenceAnswer $answer, int $key) use($isAssesor, $isNotes) {
            $sequence = $isAssesor ? $answer->assessor_choice?->sequence : $answer->choice?->sequence;
            $letterToNumber = $sequence ? letterToNumber($sequence) : null;

            if ($isNotes)
                return [$answer->competence_detail_id => $answer->ass_notes];

            return [$answer->competenceDetail->serial_number => $letterToNumber];
        })->toArray();
    }

    public function storeAnswer($dto): CompetenceAnswer
    {
        return DB::transaction(function () use ($dto) {
            return CompetenceAnswer::updateOrCreate(
                [
                    'competence_detail_id' => $dto->competence_detail_id,
                    // 'user_id' => $dto->user_id,
                    'filing_id' => $dto->filing_id,
                ],
                (array) $dto
            );
        });
    }
}
