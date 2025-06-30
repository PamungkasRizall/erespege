<?php

namespace App\Http\Requests;

use App\Enums\Committee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StructureRequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'modelId' => null,
        'name' => '',
        'isUnique' => false,
        'parentId' => 0,
        'departmentId' => 0
    ];

    public function rules(?int $model_id = null): array
    {
        return [
            'modelId' => [
                'nullable'
            ],
            'name' => [
                'required',
                'min:2'
            ],
            'isUnique' => [
                'boolean',
            ],
            'parentId' => [
                'required'
            ],
            'departmentId' => [
                'required'
            ]
        ];
    }
}

