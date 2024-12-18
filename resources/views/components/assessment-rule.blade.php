<x-accordion :title="'(' . __('Explanation') . ') ' . __('Assessment Rule')">
    <div class="space-y-3 sm:space-y-4">
        @foreach (QuizHelper::getAssessmentRuleType() as $rule)
            <div>
                <div class="font-semibold">
                    {{ $rule['title'] }}
                </div>
                <div class="font-light">
                    {{ $rule['description'] }}
                </div>
            </div>
        @endforeach
        {{-- <div>
            <div class="font-semibold">
                {{ __('Summation') }}
            </div>
            <div class="font-light">
                {{ __('Results based on the highest number of choices from the available answer options') }}.<br />
                {{ __('Each answer item will be given a value and the final result will calculate the sum of each answer item. So the final conclusion of this quiz will refer to the highest number of answer items.') }}
            </div>
        </div>
        <div>
            <div class="font-semibold">
                {{ __('Calculation') }}
            </div>
            <div class="font-light">
                {{ __('Results based on the highest value of the number of scores given to each answer choice') }}.<br />
                {{ __('The student will be required to give a score to each answer option. The final result of the quiz is the dominant score from the sum of the scores of each answer choice.') }}
            </div>
        </div>
        <div>
            <div class="font-semibold">
                {{ __('Calculation 2') }}
            </div>
            <div class="font-light">
                {{ __('Results based on predefined number of scores for each question added (available in the next step)') }}.<br />
                {{ __('The final result of this quiz will count the number of answers from each answer item. For example, a participant answers answer item (a) for 5 questions and answer item (b) for 3 questions. Then, the participant will have a dominant to the indicator of answer item (a).') }}
            </div>
        </div>
        <div>
            <div class="font-semibold">
                {{ __('Summative') }}
            </div>
            <div class="font-light">
                {{ __('Results are based on the correct answers (correct answers are applied to the next step) which are then summed and adjusted based on the indicators added') }}.<br />
                {{ __('The final result of the quiz is determined by whether the answers are correct or incorrect. Scoring indicators will also be added for this assessment rule.') }}
            </div>
        </div> --}}
    </div>
</x-accordion>
