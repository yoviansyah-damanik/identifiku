<div class="flex items-start flex-1 min-h-[min-content] px-6 py-4 pb-20 overflow-auto lg:py-8">
    <div class="w-full">
        <div class="flex">
            <div class="w-6 text-base font-semibold g:text-lg xl:text-xl lg:w-12">
                {{ $questionActive['order'] }}.
            </div>
            <div class="flex-1 text-base lg:text-lg xl:text-xl">
                <div class="mb-3 font-semibold">
                    {{ $questionActive['question'] }}
                </div>
                <div class="flex flex-col gap-2" x-data="{
                    handle: (item, position) => {
                        $wire.reorderAnswer(item, position);
                    }
                }" x-sort.ghost="handle">
                    @foreach ($calculationAnswers as $answer)
                        <div class="flex items-start gap-3 sm:gap-4 cursor-grab active:cursor-grabbing"
                            x-sort:item="'{{ $answer['id'] }}'">
                            <div
                                class="gap-3 px-5 py-2 text-center transition-all rounded-lg pointer-events-none w-14 txt-center sm:gap-4 bg-primary-50">
                                {{ $loop->iteration }}
                            </div>
                            <div
                                class="flex-1 gap-3 px-5 py-2 transition-all rounded-lg pointer-events-none sm:gap-4 bg-primary-50">
                                {{ $answer['answer'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
