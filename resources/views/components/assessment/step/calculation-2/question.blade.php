<div class="flex items-start flex-1 min-h-[min-content] px-6 py-4 pb-20 overflow-auto lg:py-8">
    <div class="w-full">
        <div class="flex">
            <div class="w-6 text-base font-semibold g:text-lg xl:text-xl lg:w-12">
                {{ $questionActive['order'] }}.
            </div>
            <div class="flex-1 text-base lg:text-lg xl:text-xl">
                <div class="mb-3 font-semibold">
                    ({{ $questionActive['operator'] }}) {{ $questionActive['question'] }}
                </div>
                <div class="flex flex-col gap-2">
                    @foreach ($calculationAnswers as $answer)
                        <div @class([
                            'flex items-start gap-3 sm:gap-4 transition-all py-1.5 px-5 cursor-pointer hover:text-secondary-500 bg-primary-50 rounded-lg',
                            'font-semibold bg-primary-500 text-secondary-500' => in_array(
                                $answer['id'],
                                $result->pluck('answer_choice_id')->toArray()),
                        ])
                            wire:click="setAnswer('{{ $questionActive['id'] }}','{{ $answer['id'] }}')">
                            <div class="w-10">
                                {{ $answer['answer'] }}
                            </div>
                            <div class="flex-1 text-start">
                                {{ $answer['text'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
