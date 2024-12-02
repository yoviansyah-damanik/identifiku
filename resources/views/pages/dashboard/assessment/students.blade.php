<x-content>
    <x-content.title :title="__('Student Assessments')" :description="__('Student Assessments')" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.select class="snap-start" :items="$statuses" wire:model.live='status' />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', ['1' => __(':name Name', ['name' => __('Assessment')])])" block
            wire:model.live.debounce.750ms='search' wire:change="$dispatch('setRefreshActiveAssessment')" />
    </div>

    @forelse ($assessments as $assessment)
        <x-assessment-student-item :$assessment />
    @empty
        <x-no-data />
    @endforelse

    {{ $assessments->links() }}

</x-content>
