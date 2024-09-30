<footer class="shadow mt-12">
    <div class="bg-gradient-to-b from-primary-50 to-primary-100">
        <x-container>
            <div class="flex flex-col lg:flex-row lg:py-9 py-7 items-start gap-5">
                <div class="flex-1">
                    <div class="w-72 lg:w-52 m-auto lg:m-0 !mb-5">
                        <img src="{{ Vite::image('logo.png') }}" class="w-full">
                    </div>
                    <div class="font-normal">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. At, commodi deserunt esse magni
                        mollitia aspernatur deleniti nesciunt aperiam aliquid cumque quibusdam vel sit vitae vero
                        suscipit adipisci culpa dolore minus laborum dolor a repellendus optio earum. Excepturi enim
                        doloremque voluptas nihil vel reprehenderit facilis, obcaecati facere magnam, repudiandae
                        ratione dicta!
                    </div>
                </div>
                <div class="text-center lg:text-left w-full lg:w-auto min-w-80">
                    <div class="text-secondary-500 mb-5 font-bold">
                        {{ __('Quick Access') }}
                    </div>
                    <ul class="flex flex-col gap-1">
                        @foreach ($navigations as $navigation)
                            <li>
                                <a class=" hover:text-secondary-500" href="{{ $navigation['url'] }}">
                                    {{ $navigation['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex-1 text-center lg:text-left">
                    <div class="text-secondary-500 mb-5 font-bold">
                        {{ __('Supported by') }}
                    </div>
                    <div class="flex items-center gap-1 group">
                        <div
                            class="group/item flex-1 bg-white/70 drop-shadow-sm p-3 rounded-md transition-all group-hover:grayscale hover:!grayscale-0 group-hover:z-[0] hover:!z-[1]">
                            <img class="group-hover/item:scale-150 aspect-[3/2] object-contain transition-all"
                                src="{{ Vite::image('lldikti1.png') }}" alt="LLDIKTI 1 Logo" />
                        </div>
                        <div
                            class="group/item flex-1 bg-white/70 drop-shadow-sm p-3 rounded-md transition-all group-hover:grayscale hover:!grayscale-0 group-hover:z-[0] hover:!z-[1]">
                            <img class="group-hover/item:scale-150 aspect-[3/2] object-contain transition-all"
                                src="{{ Vite::image('drtpm-bima.png') }}" alt="DRTPM Bima Logo" />
                        </div>
                        <div
                            class="group/item flex-1 bg-white/70 drop-shadow-sm p-3 rounded-md transition-all group-hover:grayscale hover:!grayscale-0 group-hover:z-[0] hover:!z-[1]">
                            <img class="group-hover/item:scale-150 aspect-[3/2] object-contain transition-all"
                                src="{{ Vite::image('kampus-merdeka.png') }}" alt="Kampus Merdeka Logo" />
                        </div>
                        <div
                            class="group/item flex-1 bg-white/70 drop-shadow-sm p-3 rounded-md transition-all group-hover:grayscale hover:!grayscale-0 group-hover:z-[0] hover:!z-[1]">
                            <img class="group-hover/item:scale-150 aspect-[3/2] object-contain transition-all"
                                src="{{ Vite::image('ugn.png') }}" alt="UGN Logo" />
                        </div>
                    </div>
                </div>
            </div>
        </x-container>
    </div>
    <div class="bg-gradient-to-t from-primary-500 to-primary-700 shadow-md shadow-primary-700">
        <x-container>
            <div class="flex flex-col lg:flex-row justify-between items-center text-white font-normal py-2">
                <div class="text-center lg:text-left">
                    ©{{ date('Y') }} {{ __('Copyright') }} <x-href href="{{ url('') }}"
                        class="text-secondary-500 font-bold">IdentifiKu</x-href>.
                    {{ __('All right reserved.') }}
                </div>
                <div class="text-center lg:text-right">
                    {{ __('Version :ver', ['ver' => GeneralHelper::getVersion()]) }}
                </div>
            </div>
        </x-container>
    </div>
</footer>
