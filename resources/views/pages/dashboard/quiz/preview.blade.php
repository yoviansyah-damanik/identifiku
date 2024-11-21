<x-content>
    <x-content.title :title="__('Preview')" :description="__('Preview the added quiz')" />
    <x-preview :$quiz :$selectedQuizPhase :$selectedQuizCategory :$activeGroup />
</x-content>
