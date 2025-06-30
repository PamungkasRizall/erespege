<?php

namespace App\Enums;

enum CompetenceAnswerIndex: string {
    case A = 'A';
    case B = 'B';
    case C = 'C';
    case D = 'D';

    public static function values(): array
    {
        return [
            self::A->value => 0,
            self::B->value => 1,
            self::C->value => 2,
            self::D->value => 3,
        ];
    }

    public static function keys(): array
    {
        return [
            self::A->value,
            self::B->value,
            self::C->value,
            self::D->value,
        ];
    }
}
