<?php

namespace App\Enums;

enum FilingStatus: int {
    case PENDING = 0;
    case REVIEW = 1;
    case BA = 2;
    case SUB_COMMITTEE = 3;
    case HEAD_OF_COMMITTEE = 4;
    case PEMBERKASAN = 5;
    case DIRECTOR = 6;
    case DONE = 7;

    public static function values(): array
    {
        return array_reduce(
            self::cases(),
            fn($carry, $status) => array_merge($carry, [$status->value => $status->naming()]),
            []
        );
    }

    public function naming(): String
    {
        return match($this)
        {
            self::PENDING => 'Pending',
            self::REVIEW => 'Review',
            self::BA => 'Berita Acara',
            self::SUB_COMMITTEE => 'Sub Komite',
            self::HEAD_OF_COMMITTEE => 'Ketua Komite',
            self::PEMBERKASAN => 'Pemberkasan',
            self::DIRECTOR => 'Direktur',
            self::DONE => 'Aktif',
        };
    }

    public function color(): String
    {
        return match($this)
        {
            self::PENDING => 'warning',
            self::REVIEW => 'info',
            self::BA => 'info',
            self::SUB_COMMITTEE => 'info',
            self::HEAD_OF_COMMITTEE => 'info',
            self::PEMBERKASAN => 'info',
            self::DIRECTOR => 'info',
            self::DONE => 'success',
        };
    }
}
