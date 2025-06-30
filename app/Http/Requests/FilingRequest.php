<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilingRequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'model_id' => null,
        'name' => '',
        'category_id' => 0,
        'letter_no' => '',
        'end_date' => null,
        'is_end' => false,
        'file' => null,
    ];

    public function rules(?string $model_id = null): array
    {
        $rules = [
            'model_id' => [
                'nullable'
            ],
            'name' => [
                'required',
                'max:100'
            ],
            'category_id' => [
                'required'
            ],
            'letter_no' => [
                'required',
                'max:50',
                'unique:filings,letter_no,'.$model_id
            ],
            'start_date' => [
                'required',
            ],
            'end_date' => [
                'nullable',
            ],
            'is_end' => [
                'required',
                'boolean'
            ],
        ];

        if(!$model_id)
        {
            $rules['file'] = [
                'required',
                'mimes:pdf'
            ];
        }

        return $rules;
    }
}

