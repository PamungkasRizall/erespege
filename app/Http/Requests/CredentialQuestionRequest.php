<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CredentialQuestionRequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'model_id' => null,
        'name' => '',
        'choices' => [],
        'profession_id' => null,
        'functional_position_id' => null,
    ];

    public function rules(?string $model_id = null): array
    {
        return [
            'model_id' => [
                'nullable'
            ],
            'name' => [
                'required',
                'string'
            ],
            'profession_id' => [
                'required',
            ],
            'functional_position_id' => [
                'required',
            ],
            'choices' => [
                'required',
                'array',
                'min:4'
            ],
            'choices.*.id' => [
                'nullable',
            ],
            'choices.*.name' => [
                'required',
                'string'
            ],
            'choices.*.score' => [
                'required',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            // 'choices.*.is_correct' => [
            //     'required',
            //     'boolean'
            // ]
        ];
    }
}

