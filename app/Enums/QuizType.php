<?php

namespace App\Enums;

use App\Traits\EnumTrait;


enum QuizType: string
{
    use EnumTrait;

    case StudentLearningStyle = 'Student Learning Style';
    case PersonalityType = 'Personality Type';
    case MultipleIntelligenceType = 'Multiple Intelligence Type';
}
