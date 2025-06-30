<?php

namespace App\Enums;

enum CategoryType: string {
    case EMPLOYEE_STATUS = 'Status Pegawai';
    case FILING = 'Pemberkasan';
    case KREDENSIAL = 'Kredensial';
    case STATUS_APPROVAL = 'Status Approval';

    public static function values(): array
    {
        return [
            self::EMPLOYEE_STATUS,
            self::FILING,
        ];
    }
}
