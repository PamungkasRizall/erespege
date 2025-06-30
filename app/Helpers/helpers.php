<?php

use App\Enums\Committee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

if (!function_exists('arrayValueRecursive')) {
    function arrayValueRecursive($key, array $arr)
    {
        $val = array();
        array_walk_recursive($arr, function ($v, $k) use ($key, &$val) {
            if ($k == $key) array_push($val, $v);
        });

        return count($val) > 1 ? $val : array_pop($val);
    }
}

if (!function_exists('childrenMenuActive')) {
    function childrenMenuActive($routeName)
    {
        return str_replace(['.index', '.create', '.edit', '.budgets'], '', $routeName);
    }
}

if (!function_exists('mainSidebarRoute')) {
    function mainSidebarRoute($items)
    {
        $permissions = $items['permissions'];

        foreach ($permissions as $key => $val)
            if ( Auth::user()->can($key) )
                return route($val);
    }
}

if (!function_exists('unSLug')) {
    function unSLug($slug)
    {
        return Str::title(str_replace('-', ' ', $slug));
    }
}

if (!function_exists('limitText')) {
    function limitText($text, $length = 150)
    {
        $text = Str::limit(strip_tags(html_entity_decode($text)), $length, '...');

        return $text;
    }
}

if (!function_exists('phoneNumberID')) {
    function phoneNumberID($number)
    {
        return preg_replace('/^0|[^a-zA-Z0-9+]+/', '62', $number);
    }
}

if (!function_exists('numericOnly')) {
    function numericOnly($string): int
    {
        $number = preg_replace("/[^0-9\.]/", '', $string);

        return $number ?: 0;
    }
}

if (!function_exists('currency')) {
    function currency($value, $en = false)
    {
        return $en ? number_format($value, 0, '.', ',') : number_format($value, 0, ',', '.');
    }
}

if (!function_exists('dateFormatLocale')) {
    function dateFormatLocale(Carbon $value, $format): string
    {
        return $value->locale('id')->translatedFormat($format);
    }
}

if (!function_exists('authUserCommittee')) {
    function authUserCommittee(): Committee
    {
        return Committee::NAKES_LAINNYA;
    }
}

if (!function_exists('letterToNumber')) {
    function letterToNumber($number): string
    {
        return chr(64+ $number);
    }
}

if (!function_exists('countNotNull')) {
    function countNotNull(array $array): string
    {
        return count(array_filter($array, fn($value) => !is_null($value)));
    }
}

if (!function_exists('penyebut')) {
    function penyebut($value)
    {
        $nilai = abs($value);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai/1000000000) . " miliar" . penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
        }
        return $temp;
    }
}

if (!function_exists('terbilang')) {
    function terbilang($value)
    {
        if($value < 0) {
            $hasil = "minus ". trim(penyebut($value));
        } else if($value > 0) {
            $hasil = trim(penyebut($value));
        } else {
            $hasil = '';
        }
        return ucwords($hasil);
    }
}

if (!function_exists('numberToRoman')) {
    function numberToRoman(int $number)
    {
        $romans = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];

        return $romans[$number];
    }
}
