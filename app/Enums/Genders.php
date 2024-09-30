<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum Genders: String
{
    use EnumTrait;

    case M = 'Male';
    case F = 'Female';
}
