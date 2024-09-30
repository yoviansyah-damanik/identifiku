<x-content>
    <x-content.title :title="__('Grade Level')" :description="__('Manage education levels.')" />

    <div class="box-border flex w-full gap-3 overflow-x-auto overflow-y-hidden snap-proximity snap-x">
        <x-button color="primary" icon="i-ph-plus" x-on:click="$dispatch('toggle-create-grade-level-modal')">
            {{ __('Add :add', ['add' => __('Grade Level')]) }}
        </x-button>
        <x-form.select class="snap-start" :items="$perPageList" wire:model.live='perPage' />
        <x-form.select-with-search class="w-72" block searchVar="educationLevelSearch" :items="$educationLevels"
            wire:model="educationLevel" error="{{ $errors->first('educationLevel') }}" :withReset="true"
            :buttonText="__('Choose a :item', ['item' => __('Education Level')])" />
        <x-form.input class="flex-1 min-w-48 snap-start" type="search" :placeholder="__('Search by :1', ['1' => __(':name Name', ['name' => __('Grade Level')])])" block
            wire:model.live.debounce.750ms='search' />
    </div>

    <x-table :columns="[
        '#',
        __(':name Name', ['name' => __('Grade Level')]),
        __('Description'),
        __(':name Name', ['name' => __('Education Level')]),
        __('Number of :subject', ['subject' => __('Schools')]),
        __('Number of :subject', ['subject' => __('Students')]),
        __('Action'),
    ]">
        <x-slot name="body">
            @forelse ($gradeLevels as $gradeLevel)
                <x-table.tr>
                    <x-table.td class="w-16" centered>
                        {{ $gradeLevels->perPage() * ($gradeLevels->currentPage() - 1) + $loop->iteration }}
                    </x-table.td>
                    <x-table.td>
                        {{ $gradeLevel->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $gradeLevel->description }}
                    </x-table.td>
                    <x-table.td>
                        {{ $gradeLevel->educationLevel->name }}
                    </x-table.td>
                    <x-table.td centered>
                        {{ GeneralHelper::numberFormat($gradeLevel->educationLevel->schools_count) .
                            ' ' .
                            ($gradeLevel->educationLevel->schools_count > 1 ? __('Schools') : __('School')) }}
                    </x-table.td>
                    <x-table.td centered>
                        {{ GeneralHelper::numberFormat($gradeLevel->students_count) .
                            ' ' .
                            ($gradeLevel->students_count > 1 ? __('Students') : __('Student')) }}
                    </x-table.td>
                    <x-table.td centered>
                        <x-tooltip :title="__('Edit')">
                            <x-button color="yellow" icon="i-ph-pen" size="sm"
                                wire:click="$dispatch('setEditGradeLevel',{ gradeLevel: '{{ $gradeLevel->id }}' })"
                                x-on:click="$dispatch('toggle-edit-grade-level-modal')">
                            </x-button>
                        </x-tooltip>
                        <x-tooltip :title="__('Delete')">
                            <x-button color="red" icon="i-ph-trash" size="sm"
                                wire:click="$dispatch('setDeleteGradeLevel',{ gradeLevel: '{{ $gradeLevel->id }}' })"
                                x-on:click="$dispatch('toggle-delete-grade-level-modal')">
                            </x-button>
                        </x-tooltip>
                    </x-table.td>
                </x-table.tr>
            @empty
                <x-table.tr>
                    <x-table.td colspan="7">
                        <x-no-data />
                    </x-table.td>
                </x-table.tr>
            @endforelse
        </x-slot>

        <x-slot name="paginate">
            {{ $gradeLevels->links(data: ['scrollTo' => 'table']) }}
        </x-slot>
    </x-table>

    <div wire:ignore>
        <x-modal name="create-grade-level-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Grade Level')])">
            <livewire:dashboard.grade-level.create />
        </x-modal>
        <x-modal name="edit-grade-level-modal" size="xl" :modalTitle="__('Edit :edit', ['edit' => __('Grade Level')])">
            <livewire:dashboard.grade-level.edit />
        </x-modal>
        <x-modal name="delete-grade-level-modal" size="xl" :modalTitle="__('Delete :delete', ['delete' => __('Grade Level')])">
            <livewire:dashboard.grade-level.delete />
        </x-modal>
    </div>
</x-content>
