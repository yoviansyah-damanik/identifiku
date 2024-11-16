<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum QuestionTypes: string
{
    use EnumTrait;

        // case Essay = 'Essay';
    case MultipleChoice = 'MultipleChoice';
    case Dichotomous = 'Dichotomous';
    // case Checkbox = 'Checkbox';
}
