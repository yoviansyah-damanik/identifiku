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

        return Carbon::parse($date)->diff(now())->format($format);
    }

    public static function getTime(int $time, string $locale = 'id')
    {
        $hours = floor($time / 60);
        $minutes = $time - ($hours * 60);

        $hourText = 'h';
        $minuteText = 'm';

        if ($locale == 'id') {
            $hourText = 'j';
            $minuteText = 'm';
        }

        if ($hours > 0) {
            return $hours . $hourText . ' ' . $minutes . $minuteText;
        }
        return $minutes . $minuteText;
    }

    public static function getPerPageList()
    {
        return [10, 25, 50, 100];
    }

    public static function getRandomToken()
    {
        return Str::random(12);
    }

    public static function isProduction()
    {
        return env('APP_ENV') == 'production';
    }

    public static function numberToRoman(int $number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    public static function numberToWord($num = '')
    {
        $num    = (string) ((int) $num);

        if ((int) ($num) && ctype_digit($num)) {
            $words  = array();
            $num    = str_replace(array(',', ' '), '', trim($num));

            $list1  = array(
                '',
                'one',
                'two',
                'three',
                'four',
                'five',
                'six',
                'seven',
                'eight',
                'nine',
                'ten',
                'eleven',
                'twelve',
                'thirteen',
                'fourteen',
                'fifteen',
                'sixteen',
                'seventeen',
                'eighteen',
                'nineteen'
            );

            $list2  = array(
                '',
                'ten',
                'twenty',
                'thirty',
                'forty',
                'fifty',
                'sixty',
                'seventy',
                'eighty',
                'ninety',
                'hundred'
            );

            $list3  = array(
                '',
                'thousand',
                'million',
                'billion',
                'trillion',
                'quadrillion',
                'quintillion',
                'sextillion',
                'septillion',
                'octillion',
                'nonillion',
                'decillion',
                'undecillion',
                'duodecillion',
                'tredecillion',
                'quattuordecillion',
                'quindecillion',
                'sexdecillion',
                'septendecillion',
                'octodecillion',
                'novemdecillion',
                'vigintillion'
            );

            $num_length = strlen($num);
            $levels = (int) (($num_length + 2) / 3);
            $max_length = $levels * 3;
            $num    = substr('00' . $num, -$max_length);
            $num_levels = str_split($num, 3);

            foreach ($num_levels as $num_part) {
                $levels--;
                $hundreds   = (int) ($num_part / 100);
                $hundreds   = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : 's') . ' ' : '');
                $tens       = (int) ($num_part % 100);
                $singles    = '';

                if ($tens < 20) {
                    $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
                } else {
                    $tens = (int) ($tens / 10);
                    $tens = ' ' . $list2[$tens] . ' ';
                    $singles = (int) ($num_part % 10);
                    $singles = ' ' . $list1[$singles] . ' ';
                }
                $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
            }
            $commas = count($words);
            if ($commas > 1) {

                $commas = $commas - 1;
            }

            $words  = implode(', ', $words);
            $words  = trim(str_replace(' ,', ',', ucwords($words)), ', ');

            if ($commas) {
                $words  = str_replace(',', ' and', $words);
            }

            return $words;
        } else if (! ((int) $num)) {

            return 'Zero';
        }

        return '';
    }

    public static function numberToAlpha(int $num)
    {
        $alphabet = range('A', 'Z');

        return $alphabet[$num - 1];
    }
}
