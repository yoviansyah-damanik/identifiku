<x-accordion :title="'(' . __('Explanation') . ') ' . __('Assessment Rule')">
    <div class="space-y-3 sm:space-y-4">
        <div>
            <div class="font-semibold">
                {{ __('Summation') }}
            </div>
            <div class="font-light">
                {{ __('Each answer item will be given a value and the final result will calculate the sum of each answer item. So the final conclusion of this quiz will refer to the highest number of answer items.') }}
            </div>
        </div>
        <div>
            <div class="font-semibold">
                {{ __('Calculation') }}
            </div>
            <div class="font-light">
                {{ __('The final result of this quiz will count the number of answers from each answer item. For example, a participant answers answer item (a) for 5 questions and answer item (b) for 3 questions. Then, the participant will have a dominant to the indicator of answer item (a).') }}
            </div>
        </div>
        <div>
            <div class="font-semibold">
                {{ __('Summative') }}
            </div>
            <div class="font-light">
                {{ __('The final result of the quiz is determined by whether the answers are correct or incorrect. Scoring indicators will also be added for this assessment rule.') }}
            </div>
        </div>
    </div>
</x-accordion>
