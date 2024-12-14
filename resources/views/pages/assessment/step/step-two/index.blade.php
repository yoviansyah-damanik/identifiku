<div x-data="{
    init() {
        startTimer(Date.parse('{{ now()->sub($assessment->started_on->addMinutes($assessment->quiz->estimation_time)) }}'))
    },
}">
    <livewire:is :component="'assessment.step.step-two.rules.' . $assessment->rule->type" :$assessment />
</div>
