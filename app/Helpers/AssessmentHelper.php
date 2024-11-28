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
            'quiz.assessmentRule.details',
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
            case 'calculation-2':
                (new static)->calculation2();
                break;
            case 'summative':
                (new static)->summative();
                break;
        }
    }

    private function getAnswerMapping(): Collection
    {
        $rules = static::$assessment->quiz->assessmentRule->details;

        return $rules->map(
            fn($detail) => collect([
                ...$detail->only(['indicator', 'answer', 'value_min', 'value_max', 'score']),
                'total' => static::$assessment->details()
                    ->whereHas('answer', fn($_answer) => $_answer->where('answer', $detail->answer))
                    ->count(),
            ])
        );
    }

    private function getAnswerCorrection()
    {
        $rules = static::$assessment->quiz->assessmentRule->details;

        return $rules->map(
            fn($detail) => collect([
                ...$detail->only(['indicator', 'answer', 'value_min', 'value_max', 'score']),
                'total' => static::$assessment->details()
                    ->whereHas('answer', fn($_answer) => $_answer->where('answer', $detail->answer))
                    ->count(),
            ])
        );
    }

    private function summation(): void
    {
        DB::beginTransaction();
        try {
            $answerMapping = $this->getAnswerMapping();

            static::$assessment->result()->updateOrCreate([], [
                'status' => 'done',
                'status_message' => __('Successfully')
            ]);

            static::$assessment->result->details()
                ->delete();

            foreach ($answerMapping as $result) {
                static::$assessment->result->details()
                    ->create([
                        'value' => $result['total'],
                        'indicator' => $result['indicator'],
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

    private function calculation() {}

    private function calculation2() {}

    private function summative() {}
}
