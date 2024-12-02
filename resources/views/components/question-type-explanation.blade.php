<x-accordion :title="'(' . __('Explanation') . ') ' . __('Question Type')">
    <div class="space-y-3 sm:space-y-4">
        <div>
            <div class="font-semibold">
                {{ __('Multiple Choice') }}
            </div>
            <div class="font-light">
                {{ __('The learner is asked to choose one of the several answer options provided.') }}
            </div>
        </div>
        <div>
            <div class="font-semibold">
                {{ __('Dichotomous') }}
            </div>
            <div class="font-light">
                {{ __('The learner chooses one of the two answer options provided.') }}
            </div>
        </div>
    </div>
</x-accordion>
