<div class="flex flex-col items-start gap-4 lg:flex-row">
    <x-preview.groups :$quiz :$selectedQuizPhase :$selectedQuizCategory />

    <div class="flex-1 w-full">
        <x-preview.active-group :$activeGroup />
    </div>
</div>
