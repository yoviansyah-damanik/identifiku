<?php

namespace App\Helpers;

class QuizHelper
{
    private function getQuestionTypes()
    {
        return [
            [
                'value' => 'multipleChoice',
                'title' => __('Multiple Choice'),
                'rules' => ['summation', 'calculation', 'group-calculation', 'summative', 'calculation-2']
            ],
            [
                'value' => 'dichotomous',
                'title' => __('Dichotomous'),
                'rules' => ['summation', 'group-calculation', 'summative']
            ],
        ];
    }

    public static function getQuizStep()
    {
        return [
            [
                'step' => 1,
                'stepName' => 'step-one',
                'title' => __('Register a Quiz'),
                'description' => __('You are required to register for the quiz first')
            ],
            [
                'step' => 2,
                'stepName' => 'step-two',
                'title' => __('Quiz Configuration'),
                'description' => __('You need to organize question and result management')
            ],
            [
                'step' => 3,
                'stepName' => 'step-three',
                'title' => __('Quiz Content'),
                'description' => __('Add :add', ['add' => __('Quiz Content')])
            ],
            [
                'step' => 4,
                'stepName' => 'step-four',
                'title' => __('Publish'),
                'description' => __('Enable and publish quiz')
            ]
        ];
    }

    public static function getQuizType(?string $type = null)
    {
        $quizTypes = [
            ['value' => 'studentLearningStyle', 'title' => __('Student Learning Style')],
            ['value' => 'personalityType', 'title' => __('Personality Type')],
            ['value' => 'keirseyTemperamentSorter', 'title' => __('Keirsey Temperament Sorter')],
            ['value' => 'multipleIntelligenceType', 'title' => __('Multiple Intelligence Type')],
        ];

        if ($type) {
            return collect($quizTypes)
                ->where('value', $type)
                ->first();
        }

        return $quizTypes;
    }

    public static function getAssessmentRuleType(?string $quizType = null, ?string $questionType = null)
    {
        $assessmentRuleTypes = [
            [
                'value' => 'summation',
                'title' => __('Summation'),
                'description' => __('Results based on the highest number of choices from the available answer options')
            ],
            [
                'value' => 'calculation',
                'title' => __('Calculation (Order of Answer)'),
                'description' => __('Results based on the highest value of the number of scores given to each answer choice')
            ],
            [
                'value' => 'calculation-2',
                'title' => __('Calculation (Answer Score)'),
                'description' => __('Results based on the sum of the scores given to the selected answer options')
            ],
            [
                'value' => 'group-calculation',
                'title' => __('Group Calculation'),
                'description' => __('Results based on the highest score in each question group (question group in the next step) where each answer choice is given a fixed score')
            ],
            [
                'value' => 'summative',
                'title' => __('Summative'),
                'description' => __('Results are based on the correct answers (correct answers are applied to the next step) which are then summed and adjusted based on the indicators added')
            ],
        ];

        if ($quizType) {
            if ($quizType == 'keirseyTemperamentSorter') {
                $assessmentRuleTypes = collect($assessmentRuleTypes)->where('value', 'calculation')
                    ->values()
                    ->toArray();
            }
        }

        if ($quizType) {
            if ($quizType == 'multipleIntelligenceType') {
                $assessmentRuleTypes = collect($assessmentRuleTypes)->where('value', 'group-calculation')
                    ->values()
                    ->toArray();
            }
        }

        if ($questionType) {
            $rules =  collect((new static)->getQuestionTypes())->whereIn('value', $questionType)
                ->first()['rules'];

            return collect($assessmentRuleTypes)->whereIn('value', $rules)
                ->all();
        }

        return $assessmentRuleTypes;
    }

    public static function getQuestionType(string $quizType, ?string $questionType = null)
    {
        $questionTypes = (new static)->getQuestionTypes();
        if ($quizType) {
            // studentLearningStyle
            // personalityType
            // keirseyTemperamentSorter
            // multipleIntelligenceType
            if ($quizType == 'keirseyTemperamentSorter') {
                $questionTypes = collect($questionTypes)->where('value', 'multipleChoice')
                    ->values()
                    ->toArray();
            }
        }

        if ($questionType) {
            return collect($questionTypes)->where('value', $questionType)
                ->first();
        }

        return $questionTypes;
    }
}
