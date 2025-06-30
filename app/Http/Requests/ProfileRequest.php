<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function rules(?string $model_id = null): array
    {
        return [
            'model_id' => [
                'nullable'
            ],
            'user_id' => [
                'required'
            ],
            'nik' => [
                'required',
                'integer',
                'digits:16',
                'unique:profiles,nik,'.$model_id
            ],
            'place_of_birth' => [
                'required',
                'max:30'
            ],
            'date_of_birth' => [
                'required',
            ],
            'gender' => [
                'required',
                'boolean'
            ],
            'doctoral_degree' => [
                'nullable'
            ],
            'academic_degree' => [
                'required',
                'max:20'
            ],
            'address' => [
                'required'
            ],
            'province' => [
                'required',
                'max:50'
            ],
            'city' => [
                'required',
                'max:50'
            ],
            'subdistrict' => [
                'required',
                'max:50'
            ],
            'district' => [
                'required',
                'max:50'
            ],
            'phone' => $this->getPhoneRules(true, $model_id),
            'phone_emergency' => $this->getPhoneRules(false),
            'profession_id' => [
                'required'
            ],
            'functional_position_id' => [
                'required'
            ],
            'employee_status_id' => [
                'required'
            ]
        ];
    }

    public function accountRules(string $model_id): array
    {
        return [
            'user_id' => [
                'required'
            ],
            'username' => $this->getUsernameRules($model_id),
            'password' => [
                'required_without:model_id',
                'sometimes',
                'confirmed',
                'min:6'
            ],
        ];
    }

    private function getPhoneRules(bool $isPhone = true, ?string $model_id = null): array
    {
        $rules = [
            'required',
            'max:15',
            'regex:/^([0-9\s\-\+\(\)]*)$/',
            function ($attribute, $value, $fail) {
                if (!str_starts_with($value, '628')) {
                    $fail('Format nomor telepon tidak valid');
                }
            }
        ];

        if ($isPhone)
            $rules [] = 'unique:profiles,phone,'.$model_id;

        return $rules;
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

