<?php

namespace App\Helpers;

use App\Models\Assessment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AssessmentHelper
{
    private static $result;
    private static Assessment $assessment;

    public static function getResult(Assessment $assessment, Collection $result): void
    {
        static::$result = $result;
        static::$assessment = $assessment->load([
            'details',
            'details.answer',
            'quiz',
            'quiz.assessmentRule',
            'quiz.assessmentRule.answers',
            'quiz.assessmentRule.indicators',
        ]);

        static::$assessment->result()->updateOrCreate([], [
            'status' => 'process'
        ]);

        switch ($assessment->quiz->assessmentRule->type) {
            case 'summation':
                (new static)->summation();
                break;
            case 'calculation':
                (new static)->calculation();
                break;
            case 'group-calculation':
                (new static)->groupCalculation();
                break;
            case 'summative':
                (new static)->summative();
                break;
            case 'calculation-2':
                (new static)->calculation2();
                break;
        }
    }

    private function getSummationAnswerMapping(): Collection
    {
        return static::$assessment->quiz->assessmentRule->indicators->map(
            fn($rule) => collect([
                ...$rule->only(['title', 'indicator', 'answer', 'recommendation']),
                'total' => static::$assessment->details()
                    ->whereHas('answer', fn($_answer) => $_answer->where('answer', $rule->answer))
                    ->count(),
            ])
        );
    }

    private function getCalculationAnswerMapping(): Collection
    {
        return static::$assessment->quiz->assessmentRule->indicators->map(
            fn($rule) => collect([
                ...$rule->only(['title', 'indicator', 'answer', 'recommendation']),
                'total' => static::$assessment->details()
                    ->whereHas('answer', fn($_answer) => $_answer->where('answer', $rule->answer))
                    ->sum('score'),
            ])
        );
    }

    private function getGroupCalculationAnswerMapping(): Collection
    {
        return static::$assessment->quiz->groups->map(
            fn($group) => collect([
                ...$group->only(['name', 'description']),
                'indicator' => static::$assessment->rule->indicators->where('answer', $group->id)->first()['indicator'],
                'recommendation' => static::$assessment->rule->indicators->where('answer', $group->id)->first()['indicator'],
                'total' => static::$assessment->details()
                    ->whereIn('question_id', $group->questions->pluck('id')->toArray())
                    ->sum('score'),
                'max_score' => $group->questions->max(fn($question) => $question->answers->max('score')) * $group->questions->count()
            ])
        )->sortByDesc('total');
    }

    private function summation(): void
    {
        DB::beginTransaction();
        try {
            $answerMapping = $this->getSummationAnswerMapping();

            static::$assessment->result()->updateOrCreate([], [
                'status' => 'done',
                'status_message' => __('Successfully')
            ]);

            static::$assessment->result->details()
                ->delete();

            foreach ($answerMapping as $result) {
                static::$assessment->result->details()
                    ->create([
                        'title' => $result['title'],
                        'score' => $result['total'],
                        'indicator' => $result['indicator'],
                        'recommendation' => $result['recommendation'],
                        'is_highlight' => $result['total'] == $answerMapping->max('total'),
                    ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            static::$assessment->result()->updateOrCreate([], [
                'status' => 'failed',
                'status_message' => $e->getMessage()
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            static::$assessment->result()->updateOrCreate([], [
                'status' => 'failed',
                'status_message' => $e->getMessage()
            ]);
        }
    }

    private function calculation(): void
    {
        DB::beginTransaction();
        try {
            $answerMapping = $this->getCalculationAnswerMapping();

            static::$assessment->result()->updateOrCreate([], [
                'status' => 'done',
                'status_message' => __('Successfully')
            ]);

            static::$assessment->result->details()
                ->delete();

            foreach ($answerMapping as $result) {
                static::$assessment->result->details()
                    ->create([
                        'title' => $result['title'],
                        'score' => $result['total'],
                        'indicator' => $result['indicator'],
                        'recommendation' => $result['recommendation'],
                        'is_highlight' => $result['total'] == $answerMapping->max('total'),
                    ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            static::$assessment->result()->updateOrCreate([], [
                'status' => 'failed',
                'status_message' => $e->getMessage()
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            static::$assessment->result()->updateOrCreate([], [
                'status' => 'failed',
                'status_message' => $e->getMessage()
            ]);
        }
    }

    private function calculation2()
    {
        DB::beginTransaction();
        try {
            static::$assessment->result()->updateOrCreate([], [
                'status' => 'done',
                'status_message' => __('Successfully')
            ]);

            static::$assessment->result->details()
                ->delete();

            $scoreRecap = static::$assessment->load([
                'quiz',
                'quiz.groups',
                'quiz.groups.questions',
                'quiz.groups.questions.answers',
            ])->quiz->groups
                ->map(fn($group) => $group->questions
                    ->map(
                        fn($question, $idx) => [
                            'score' => static::$assessment->details
                                ->where('question_id', $question->id)->first()->score,
                            'max' => $question->answers->max('score'),
                            'operator' => $question->operator,
                        ]
                    ))
                ->collapse();

            $totalScore = $scoreRecap->reduce(fn($carry, $score) => $score['operator'] == '-' ? $carry - $score['score'] : $carry + $score['score']);

            $selectedIndicator = static::$assessment->quiz->assessmentRule->indicators
                ->where('value_min', '<=', $totalScore)
                ->where('value_max', '>=', $totalScore)
                ->first();

            if (!$selectedIndicator) {
                static::$assessment->result->details()
                    ->create([
                        'title' => __('No indicators found related to assessment'),
                        'score' => 0,
                        'indicator' => __('No indicators found related to assessment'),
                        'recommendation' => __('No indicators found related to assessment'),
                        'is_highlight' => true,
                    ]);
            } else {
                static::$assessment->result->details()
                    ->create([
                        'title' => $selectedIndicator->title,
                        'score' => $totalScore,
                        'indicator' => $selectedIndicator->indicator,
                        'recommendation' => $selectedIndicator->recommendation,
                        'is_highlight' => true,
                    ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            static::$assessment->result()->updateOrCreate([], [
                'status' => 'failed',
                'status_message' => $e->getMessage()
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            static::$assessment->result()->updateOrCreate([], [
                'status' => 'failed',
                'status_message' => $e->getMessage()
            ]);
        }
    }

    private function groupCalculation(): void
    {
        DB::beginTransaction();
        try {
            static::$assessment = static::$assessment->load([
                'quiz.groups',
                'quiz.groups.questions',
                'quiz.groups.questions.answers'
            ]);

            $answerMapping = $this->getGroupCalculationAnswerMapping();

            static::$assessment->result()->updateOrCreate([], [
                'status' => 'done',
                'status_message' => __('Successfully')
            ]);

            static::$assessment->result->details()
                ->delete();

            foreach ($answerMapping as $idx => $result) {
                static::$assessment->result->details()
                    ->create([
                        'title' => $result['name'],
                        'score' => $result['total'],
                        'max_score' => $result['max_score'] ?: null,
                        'indicator' => $result['indicator'],
                        'recommendation' => $result['recommendation'],
                        'is_highlight' => $idx <= 2,
                    ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            static::$assessment->result()->updateOrCreate([], [
                'status' => 'failed',
                'status_message' => $e->getMessage()
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            static::$assessment->result()->updateOrCreate([], [
                'status' => 'failed',
                'status_message' => $e->getMessage()
            ]);
        }
    }

    private function summative()
    {
        DB::beginTransaction();
        try {
            static::$assessment->result()->updateOrCreate([], [
                'status' => 'done',
                'status_message' => __('Successfully')
            ]);

            static::$assessment->result->details()
                ->delete();

            $scoreTotal = static::$assessment->details->sum(fn($detail) => $detail->answer->is_correct == true ? $detail->score : 0);
            $percentage = $scoreTotal / static::$assessment->details->count() * 100;

            $selectedIndicator = static::$assessment->quiz->assessmentRule->indicators
                ->where('value_min', '<=', $percentage)
                ->where('value_max', '>=', $percentage)
                ->first();

            if (!$selectedIndicator) {
                static::$assessment->result->details()
                    ->create([
                        'title' => __('No indicators found related to assessment'),
                        'score' => 0,
                        'indicator' => __('No indicators found related to assessment'),
                        'recommendation' => __('No indicators found related to assessment'),
                        'is_highlight' => true,
                    ]);
            } else {
                static::$assessment->result->details()
                    ->create([
                        'title' => $selectedIndicator->title,
                        'score' => $percentage,
                        'indicator' => $selectedIndicator->indicator,
                        'recommendation' => $selectedIndicator->recommendation,
                        'is_highlight' => true,
                    ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            static::$assessment->result()->updateOrCreate([], [
                'status' => 'failed',
                'status_message' => $e->getMessage()
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            static::$assessment->result()->updateOrCreate([], [
                'status' => 'failed',
                'status_message' => $e->getMessage()
            ]);
        }
    }



    public static function getChartData(Assessment $assessment)
    {
        return [
            'label' => $assessment->result->details->pluck('title'),
            'data' => $assessment->result->details->pluck('value')
        ];
    }

    //  private function summative2()
    // {
    //     DB::beginTransaction();
    //     try {
    //         static::$assessment->result()->updateOrCreate([], [
    //             'status' => 'done',
    //             'status_message' => __('Successfully')
    //         ]);

    //         static::$assessment->result->details()
    //             ->delete();

    //         $scoreRecap = static::$assessment->load([
    //             'quiz',
    //             'quiz.groups',
    //             'quiz.groups.questions',
    //             'quiz.groups.questions.answers',
    //         ])->quiz->groups
    //             ->map(fn($group) => $group->questions
    //                 ->map(
    //                     fn($question, $idx) => [
    //                         'score' => static::$assessment->details
    //                             ->where('question_id', $question->id)->first()->score,
    //                         'max' => $question->answers->max('score'),
    //                         'operator' => $question->operator,
    //                         'percentage' => static::$assessment->details
    //                             ->where('question_id', $question->id)->first()->score / $question->answers->max('score') * 100
    //                     ]
    //                 ))
    //             ->collapse();

    //         $percentage = $scoreRecap->avg('percentage');
    //         $selectedIndicator = static::$assessment->quiz->assessmentRule->indicators
    //             ->where('value_min', '<=', $percentage)
    //             ->where('value_max', '>=', $percentage)
    //             ->first();

    //         if (!$selectedIndicator) {
    //             static::$assessment->result->details()
    //                 ->create([
    //                     'title' => __('No indicators found related to assessment'),
    //                     'score' => 0,
    //                     'indicator' => __('No indicators found related to assessment'),
    //                     'recommendation' => __('No indicators found related to assessment'),
    //                     'is_highlight' => true,
    //                 ]);
    //         } else {
    //             static::$assessment->result->details()
    //                 ->create([
    //                     'title' => $selectedIndicator->title,
    //                     'score' => $percentage,
    //                     'indicator' => $selectedIndicator->indicator,
    //                     'recommendation' => $selectedIndicator->recommendation,
    //                     'is_highlight' => true,
    //                 ]);
    //         }

    //         DB::commit();
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         static::$assessment->result()->updateOrCreate([], [
    //             'status' => 'failed',
    //             'status_message' => $e->getMessage()
    //         ]);
    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         static::$assessment->result()->updateOrCreate([], [
    //             'status' => 'failed',
    //             'status_message' => $e->getMessage()
    //         ]);
    //     }
    // }
}
