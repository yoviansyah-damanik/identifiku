<x-content>
    <x-content.title :title="$class->name" :description="$class->description" />

    <div class="border-b">
        <div class="box-border flex w-full overflow-x-auto overflow-y-hidden snap-proximity snap-x">
            @foreach ($tabs as $tab)
                <x-button base="!rounded-b-none focus:!outline-none focus:!ring-0" :color="$tabActive == $tab['value'] ? 'primary' : 'primary-transparent'"
                    wire:click="$set('tabActive','{{ $tab['value'] }}')">
                    {{ $tab['title'] }}
                    @if (isset($tab['badge']))
                        <x-badge class="ms-3" color="primary" size="sm">
                            {{ $tab['badge'] }}
                        </x-badge>
                    @endif
                </x-button>
            @endforeach
        </div>
    </div>

    @if ($tabActive == 'overview')
    @endif

    @if ($tabActive == 'quizzes')
    @endif

    @if ($tabActive == 'students')
        <x-table :columns="['#', __(':name Name', ['name' => __('Student')]), __('Grade Level'), __('Time to Join'), '']">
            <x-slot name="body">
                @forelse ($data as $student)
                    <x-table.tr>
                        <x-table.td centered>
                            {{ $data->perPage() * ($data->currentPage() - 1) + $loop->iteration }}
                        </x-table.td>
                        <x-table.td>
                            {{ $student->name }}
                        </x-table.td>
                        <x-table.td centered>
                            {{ $student->grade->name }}
                        </x-table.td>
                        <x-table.td centered>
                            {{ $student->hasClass->where('student_class_id', $class->id)->first()->created_at->translatedFormat('d M Y H:i:s') }}
                        </x-table.td>
                        <x-table.td centered>
                            <x-button color="red" size="sm" icon="i-ph-arrow-square-out"
                                x-on:click="$dispatch('toggle-kick-class-modal')"
                                wire:click="$dispatch('setKickStudent',{class: '{{ $class->id }}', student:'{{ $student->id }}'})">
                                {{ __('Get Student Out') }}
                            </x-button>
                        </x-table.td>
                    </x-table.tr>
                @empty
                    <x-table.tr>
                        <x-table.td colspan="5">
                            <x-no-data />
                        </x-table.td>
                    </x-table.tr>
                @endforelse
            </x-slot>

            <x-slot name="paginate">
                {{ $data->links(data: ['scrollTo' => false]) }}
            </x-slot>
        </x-table>
    @endif

    <div wire:ignore>
        <x-modal name="kick-class-modal" size="xl" :modalTitle="__('Get Student Out')">
            <livewire:dashboard.class.kick />
        </x-modal>
    </div>
</x-content>
