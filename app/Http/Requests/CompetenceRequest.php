<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompetenceRequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'model_id' => null,
        'code' => '',
        'profession_id' => null,
        'functional_position_id' => null,
        'file' => null,
        'choices' => [],
    ];

    public function rules(?string $model_id = null): array
    {
        return [
            'model_id' => [
                'nullable'
            ],
            'code' => [
                'required',
                'unique:competences,code,'.$model_id
            ],
            'profession_id' => [
                'required',
            ],
            'functional_position_id' => [
                'required',
            ],
            'file' => [
                'required',
                'mimes:xlsx, xls'
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

