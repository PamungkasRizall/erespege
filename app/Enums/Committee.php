<?php

namespace App\Enums;

enum Committee: string {
    // case MEDIS = 'medis';
    // case KEPERAWATAN = 'keperawatan';
    case NAKES_LAINNYA = 'nakes-lainnya';

    public static function values(): array
    {
        return [
            // self::MEDIS->value => self::MEDIS->label(),
            // self::KEPERAWATAN->value => self::KEPERAWATAN->label(),
            self::NAKES_LAINNYA->value => self::NAKES_LAINNYA->label(),
        ];
    }

    public function numbering(): String
    {
        return match($this)
        {
            self::NAKES_LAINNYA => 'KTKL',
        };
    }

    public function naming(): String
    {
        return match($this)
        {
            self::NAKES_LAINNYA => 'Tenaga Kesehatan Lainnya',
        };
    }

    public function label(): string
    {
        return ucwords(str_replace( '-', ' ', $this->value));
    }

    public function role(): string
    {
        return 'Komite ' . ucwords(str_replace( '-', ' ', $this->value));
    }
}
