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
        <div wire:key="overview_view" class="space-y-3 sm:space-y-4">
            <div class="p-6 bg-white rounded-lg shadow sm:p-8">
                <div class="text-2xl font-bold text-primary-500">
                    {{ $class->name }}
                </div>
                <div class="font-light">
                    {{ $class->description }}
                </div>
            </div>
            <div class="grid grid-cols-12 gap-3 sm:gap-4">
                <x-box class="col-span-6 lg:col-span-4" color="primary" icon="i-ph-user" :title="__('Students')"
                    :description="__('Number of :subject', ['subject' => __('Student')])" :count="$class->students_count" />
                <x-box class="col-span-6 lg:col-span-4" color="secondary" icon="i-ph-user" :title="__('Quizzes')"
                    :description="__('Number of :subject', ['subject' => __('Quiz')])" :count="$class->quizzes_count" />
                <x-box class="col-span-6 lg:col-span-4" color="cyan" icon="i-ph-user" :title="__('Assessments')"
                    :description="__('Number of :subject', ['subject' => __('Assessment')])" :count="$class->assessments_count" />
            </div>
        </div>
    @endif

    @if ($tabActive == 'quizzes')
        <div wire:key="quizzes_view" class="space-y-3 sm:space-y-4">
            @if ($data->total() > 0)
            @else
                <x-no-data />
                @if (auth()->user()->isTeacher)
                    <div class="text-center">
                        <x-button radius="rounded-full" color="primary" :withBorderIcon="false" icon="i-ph-magnifying-glass"
                            href="{{ route('dashboard.quiz.available') }}">
                            {{ __('Find :find', ['find' => __('Quiz')]) }}
                        </x-button>
                    </div>
                @endif
            @endif
        </div>
    @endif

    @if ($tabActive == 'students')
        <div wire:key="students_view" class="space-y-3 sm:space-y-4">
            @if (auth()->user()->isTeacher)
                <x-button color="primary" icon="i-ph-plus"
                    wire:click="$dispatch('toggle-add-student-modal', {class: '{{ $class->id }}'})">
                    {{ __('Add :add', ['add' => __('Student')]) }}
                </x-button>
            @endif
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
                                {{ $student->hasClasses->where('id', $class->id)->first()->created_at->translatedFormat('d M Y H:i:s') }}
                            </x-table.td>
                            <x-table.td centered>
                                @if (auth()->user()->isTeacher)
                                    <x-button color="red" size="sm" icon="i-ph-arrow-square-out"
                                        x-on:click="$dispatch('toggle-kick-class-modal')"
                                        wire:click="$dispatch('setKickStudent',{class: '{{ $class->slug }}', student:'{{ $student->id }}'})">
                                        {{ __('Get Student Out') }}
                                    </x-button>
                                @else
                                    -
                                @endif
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
        </div>
    @endif

    <div wire:ignore>
        @if (auth()->user()->isTeacher)
            <x-modal name="kick-class-modal" size="xl" :modalTitle="__('Get Student Out')">
                <livewire:dashboard.class.kick />
            </x-modal>
            <x-modal name="add-student-modal" size="xl" :modalTitle="__('Add :add', ['add' => __('Student')])">
                <livewire:dashboard.class.add-student />
            </x-modal>
        @endif
    </div>
</x-content>
