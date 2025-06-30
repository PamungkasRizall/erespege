<?php

namespace App\DTOs;

use Carbon\Carbon;

class ProfileDTO
{
    public function __construct(
        public readonly ?int $model_id,
        public readonly string $user_id,
        public readonly int $nik,
        public readonly string $place_of_birth,
        public readonly Carbon $date_of_birth,
        public readonly bool $gender,
        public readonly ?string $doctoral_degree,
        public readonly string $academic_degree,
        public readonly string $address,
        public readonly string $province,
        public readonly string $city,
        public readonly string $subdistrict,
        public readonly string $district,
        public readonly int $phone,
        public readonly int $phone_emergency,
        public readonly int $profession_id,
        public readonly int $functional_position_id,
        public readonly int $employee_status_id,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            model_id: $data['model_id'] ?? null,
            user_id: $data['user_id'] ?? null,
            nik: $data['nik'],
            place_of_birth: $data['place_of_birth'],
            date_of_birth: $data['date_of_birth'],
            gender: $data['gender'],
            doctoral_degree: $data['doctoral_degree'] ?? null,
            academic_degree: $data['academic_degree'],
            address: $data['address'],
            province: $data['province'],
            city: $data['city'],
            subdistrict: $data['subdistrict'],
            district: $data['district'],
            phone: $data['phone'],
            phone_emergency: $data['phone_emergency'],
            profession_id: $data['profession_id'],
            functional_position_id: $data['functional_position_id'],
            employee_status_id: $data['employee_status_id'],
        );
    }
}

