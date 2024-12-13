<div>
    {{ __('You are asked to sort the answer choices from lowest (top) to highest (bottom).') }} <br />
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
                    <div x-data="{
                        handle: (item, position) => {
                            {{-- console.log(item, position) --}}
                            $wire.reorderMultipleChoiceCalculationExample(item, position);
                        }
                    }" class="flex flex-col gap-2" x-sort.ghost="handle">
                        @foreach ($multipleChoiceExample as $item)
                            <div class="flex items-start gap-3 sm:gap-4 cursor-grab active:cursor-grabbing"
                                x-sort:item="'{{ $item['id'] }}'">
                                <div
                                    class="gap-3 px-5 py-2 text-center transition-all rounded-lg pointer-events-none w-14 txt-center sm:gap-4 bg-primary-50">
                                    {{ $loop->iteration }}
                                </div>
                                <div
                                    class="flex-1 gap-3 px-5 py-2 transition-all rounded-lg pointer-events-none sm:gap-4 bg-primary-50">
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
