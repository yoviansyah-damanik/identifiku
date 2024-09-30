<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;

class GeneralHelper
{

    public static function getAppName()
    {
        return env('APP_NAME');
    }

    public static function getVersion()
    {
        return env('APP_VERSION', 'dev');
    }

    public static function numberFormat($number, $with_comma = false, $commas_total = 2)
    {
        return number_format($number, $with_comma ? $commas_total : 0, ',', '.');
    }

    public static function getAge($date, $withMonth = false, $withDay = false)
    {
        $format = '%y Tahun';

        if ($withMonth)
            $format .= ' %m Bulan';

        if ($withDay)
            $format .= ' %m Hari';

        return Carbon::parse($date)->diff(\Carbon\Carbon::now())->format($format);
    }

    public static function getPerPageList()
    {
        return [10, 25, 50, 100];
    }

    public static function getRandomToken()
    {
        return Str::random(12);
    }
}
