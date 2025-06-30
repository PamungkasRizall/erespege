<?php

namespace App\DTOs;

use Illuminate\Support\Str;

class StructureDTO
{
    public function __construct(
        public readonly ?string $modelId,
        public readonly string $name,
        public readonly bool $is_unique,
        public readonly ?int $parent_id,
        public readonly int $department_id,
    ) {}

    public static function fromObject(array $data): self
    {
        return new self(
            modelId: $data['modelId'] ?? null,
            name: Str::title($data['name']),
            is_unique: $data['isUnique'],
            parent_id: $data['parentId'] ?? null,
            department_id: $data['departmentId'],
        );
    }
}

