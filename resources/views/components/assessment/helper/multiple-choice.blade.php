<div>
    {{ __('You are asked to select one of the options provided.') }}
    <div class="">
        {{ __('Take a look at the example below.') }}
    </div>
    <div class="flex items-start mt-5">
        <div class="w-full">
            <div class="flex">
                <div class="w-6 text-base font-semibold lg:w-12">
                    1.
                </div>
                <div class="flex-1">
                    <div class="mb-3 font-semibold">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, deserunt sunt?
                    </div>
                    <div class="flex flex-col gap-2">
                        @foreach ($multipleChoiceExample as $item)
                            <div @class([
                                'flex items-start gap-3 sm:gap-4 transition-all py-1.5 px-5 cursor-pointer hover:text-secondary-500 bg-primary-50 rounded-lg',
                                'font-semibold bg-primary-500 text-secondary-500' =>
                                    $item['id'] == $answerExample,
                            ]) wire:click="setAnswerExample('{{ $item['id'] }}')">
                                <div class="w-10">
                                    {{ GeneralHelper::numberToAlpha($loop->iteration) }}
                                </div>
                                <div class="flex-1 text-start">
                                    {{ $item['answer'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        {{ __('Each answer option you choose has certain points that will give you a certain end result.') }}
    </div>
</div>
