<div class="h-full">
    <livewire:is :component="'assessment.step.step-' . GeneralHelper::numberToWord($current)" :key="'step-' . $current" :$assessment />
</div>
