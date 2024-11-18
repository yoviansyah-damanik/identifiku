<li x-data="{ id: '{{ $question->id }}' }" class="relative flex items-center justify-between gap-3 overflow-hidden bg-white"
    x-sort:item="'{{ $question->id }}'">
    <div class="flex items-center justify-start flex-1 gap-3">
        <div class="grid self-stretch w-12 bg-secondary-50 place-items-center cursor-grab [body:not(.sorting)_&]:hover:bg-secondary-100"
            x-sort:handle>
            <span class="h-8 i-ph-dots-three-outline-vertical pe-2"></span>
        </div>
        <div class="flex flex-col flex-1 px-5 py-3 space-y-3 sm:space-y-4">
            <div class="font-semibold">
                {{ $question->question }}
            </div>
            <div>
                @foreach ($question->answers as $answer)
                    <div class="flex">
                        <div class="w-14">
                            {{ $answer->answer }}
                        </div>
                        <div class="flex-1">
                            {{ $answer->text }}
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
