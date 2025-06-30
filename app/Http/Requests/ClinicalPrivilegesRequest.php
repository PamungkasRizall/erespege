<?php

namespace App\Http\Requests;

use App\Enums\Committee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClinicalPrivilegesRequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'model_id' => null,
        'recomendation_code' => null,
        'letter_no' => null,
    ];

    public function headOfCommitteeRules(): array
    {
        return [
            'recomendation_code' => [
                'required',
                'unique:filings,recomendation_code'
            ],
            'recomendation_at' => [
                'required',
            ],
        ];
    }
}

