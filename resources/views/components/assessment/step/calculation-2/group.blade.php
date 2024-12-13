<div
    class="flex flex-col flex-1 w-full px-6 py-4 space-y-3 bg-white shadow lg:shadow-none lg:relative lg:left-auto sm:px-8 lg:py-8 sm:space-y-4">
    <div class="flex gap-8 overflow-auto lg:space-y-4 lg:overflow-clip lg:gap-0 lg:block snap-x lg:snap-none">
        @foreach ($groups as $group)
            <div class="space-y-3 snap-start lg:snap-none">
                <div class="font-semibold text-primary-500 text-nowrap">
                    {{ GeneralHelper::numberToRoman($group['order']) }}.
                    {{ $group['name'] }}
                </div>
                <div class="flex gap-1 lg:flex-wrap snap-x lg:snap-none">
                    @foreach ($group['questions'] as $question)
                        <x-button wire:click="setQuestion('{{ $group['id'] }}','{{ $question['id'] }}')" square
                            radius="rounded-full" base="!p-0 snap-start lg:snap-none w-8" size="sm" :color="$questionActive['id'] == $question['id']
                                ? 'secondary'
                                : (in_array($question['id'], $result->pluck('question_id')->toArray())
                                    ? 'primary'
                                    : 'primary-transparent')">
                            {{ $question['order'] }}
                        </x-button>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
