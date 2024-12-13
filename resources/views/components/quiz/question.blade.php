<li x-data="{ id: '{{ $question->id }}' }" class="relative flex items-center justify-between gap-3 overflow-hidden bg-white shadow-md"
    x-sort:item="'{{ $question->id }}'">
    <div class="flex items-center justify-start flex-1 gap-3">
        <div class="grid self-stretch w-12 bg-secondary-50 place-items-center cursor-grab [body:not(.sorting)_&]:hover:bg-secondary-100"
            x-sort:handle>
            <span class="h-8 i-ph-dots-three-outline-vertical pe-2"></span>
        </div>
        <div class="relative flex flex-col flex-1 px-5 py-3 space-y-3 sm:space-y-4">
            <div class="font-semibold">
                {{ $question->order }}.
                {{ $this->quiz->assessmentRule->type == 'calculation-2' ? '(' . $question->operator . ') ' . $question->question : $question->question }}
            </div>
            <div class="space-y-1">
                @foreach ($question->answers as $answer)
                    <div @class([
                        'flex',
                        'text-secondary-500 font-bold' => $answer->is_correct,
                    ])>
                        <div class="w-14">
                            {{ $answer->answer }}
                        </div>
                        <div class="flex-1">
                            {{ $answer->text }}
                            @if ($this->quiz->assessmentRule->type == 'calculation-2')
                                <span class="font-bold">
                                    ({{ __('Score') . ' ' . $answer->score }})
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex gap-1">
                <x-button color="yellow" icon="i-ph-pen" size="sm"
                    x-on:click="$dispatch('toggle-edit-question-modal')"
                    wire:click="$dispatch('setEditQuestion',{question: '{{ $question->id }}'})">
                    {{ __('Edit :edit', ['edit' => __('Question')]) }}
                </x-button>
                <x-button color="red" icon="i-ph-trash" size="sm"
                    x-on:click="$dispatch('toggle-delete-question-modal')"
                    wire:click="$dispatch('setDeleteQuestion',{question: '{{ $question->id }}'})">
                    {{ __('Delete :delete', ['delete' => __('Question')]) }}
                </x-button>
            </div>
        </div>
    </div>
</li>
