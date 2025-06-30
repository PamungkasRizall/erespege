<?php

namespace App\Http\Requests;

use App\Enums\Committee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompetenceBARequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'location' => '',
        'filings' => []
    ];

    public function rules(): array
    {
        return [
            'location' => [
                'required',
                'min:2'
            ],
            'date_at' => [
                'required',
            ],
            'filings' => [
                'required',
            ],
        ];
    }
}

