<?php

namespace App\Enums;

enum CompetenceDetail: int {
    case GROUP  = 0;
    case UNIT = 1;
    case ELEMENT = 2;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function prefix(): String
    {
        return match($this)
        {
            self::GROUP => 'G',
            self::UNIT => 'U',
            self::ELEMENT => 'E',
        };
    }

    public function label(): string
    {
        return ucwords(str_replace( '-', ' ', $this->value));
    }
}
