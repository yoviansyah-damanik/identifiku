<div>
    <div class="text-center mb-7">
        {{ __('You will register as:') }}
    </div>
    <div class="grid w-full grid-cols-3 gap-6">
        @foreach ($registeredAsList as $list)
            <div class="flex flex-col items-center justify-center gap-5">
                <x-button base="group flex items-center flex-col gap-3 !px-0" color="transparent" :href="$list['url']">
                    <div
                        class="flex items-center justify-center w-full overflow-hidden group-hover:grayscale-0 grayscale aspect-square">
                        <img src="{{ $list['image'] }}" class="w-full" alt="Registered As {{ __($list['title']) }} Image">
                    </div>
                    {{ __($list['title']) }}
                </x-button>
            </div>
        @endforeach
    </div>
</div>
