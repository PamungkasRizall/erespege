<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public const DEFAULT_VALUES = [
        'model_id' => null,
        'name' => '',
        'username' => '',
        'nip' => '',
        // 'roles' => [],
        'structureId' => 0
    ];

    public function rules(?string $model_id = null): array
    {
        return [
            'model_id' => [
                'nullable'
            ],
            'name' => [
                'required',
                'min:3'
            ],
            'username' => $this->getUsernameRules($model_id),
            'nip' => [
                'required',
                'int',
                'digits:18',
                'unique:users,nip,'.$model_id
            ],
            'password' => [
                'required_without:model_id',
                'sometimes',
                'confirmed',
                'min:6'
            ],
            'roles' => [
                'required',
                'array'
            ],
            'structureId' => [
                'required',
            ],
        ];
    }

    private function getUsernameRules(?string $model_id = null): array
    {
        return [
            'required',
            'min:3',
            'max:100',
            'unique:users,username,'.$model_id,
            function ($attribute, $value, $fail) {
                if (str_contains($value, ' ')) {
                    $fail('Tidak menggunakan spasi');
                }
            },
            'regex:/^\S*$/u '
        ];
    }

}

