<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Configuration;
use Illuminate\Support\Facades\Schema;

class ConfigurationHelper
{
    private static $configs;

    public function __construct()
    {
        if (Schema::hasTable('configurations'))
            static::$configs = Configuration::get();
    }

    public static function get($config)
    {
        return collect(static::$configs)
            ->where('attribute', $config)
            ->first()
            ->value;
    }

    public static function appName()
    {
        return static::get('app_name');
    }

    public static function appFullname()
    {
        return static::get('app_fullname');
    }

    public static function dateFormat(?string $date, string $type = 'default')
    {
        switch ($type) {
            case 'short':
                $format = Carbon::parse($date)->translatedFormat('d/m/Y');
                break;
            case 'simple':
                $format = Carbon::parse($date)->translatedFormat('d F Y');
                break;
            default:
                $format = Carbon::parse($date)->translatedFormat('d F Y H:i:s');
                break;
        }

        return $format;
    }
}
