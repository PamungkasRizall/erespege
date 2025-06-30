<?php

namespace App\Http\Requests;

use App\Enums\Committee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfessionRequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'model_id' => null,
        'name' => '',
        'committee' => null,
        'assesors' => []
    ];

    public function rules(?int $model_id = null): array
    {
        return [
            'model_id' => [
                'nullable'
            ],
            'name' => [
                'required',
                'min:2'
            ],
            'committee' => [
                'required',
                Rule::enum(Committee::class)
            ],
            'assesors' => [
                'required',
            ],
        ];
    }
}

