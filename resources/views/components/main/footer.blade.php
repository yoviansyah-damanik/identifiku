<footer class="border-t-4 border-secondary-500 text-secondary-50">
    <div class="bg-primary-500">
        <x-container>
            <div class="flex flex-col items-start gap-5 lg:flex-row lg:py-9 py-7">
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
                <div class="w-full text-center lg:text-left lg:w-auto min-w-80">
                    <div class="mb-5 text-lg font-bold text-secondary-500">
                        {{ __('Quick Access') }}
                    </div>
                    <ul class="flex flex-col gap-1">
                        @foreach ($navigations as $navigation)
                            <li>
                                <a class="hover:text-secondary-500" href="{{ $navigation['url'] }}">
                                    {{ $navigation['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex-1 text-center lg:text-left">
                    <div class="mb-5 text-lg font-bold text-secondary-500">
                        {{ __('Supported by') }}
                    </div>
                    <div class="flex items-center gap-1 group">
                        @foreach ($supporters as $supporter)
                            <div
                                class="group/item flex-1 bg-white p-3 rounded-md transition-all group-hover:opacity-70 hover:!opacity-100 group-hover:grayscale hover:!grayscale-0 group-hover:z-[0] hover:!z-[1] ani_bounceIn aniUtil_active">
                                <img class="group-hover/item:scale-150 aspect-[3/2] object-contain transition-all"
                                    src="{{ $supporter['image_path'] }}" alt="{{ $supporter['alt'] }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-container>
    </div>
    <div class="bg-gradient-to-t from-secondary-500 to-secondary-700">
        <x-container>
            <div class="flex flex-col items-center justify-between py-2 font-normal text-primary-50 lg:flex-row">
                <div class="text-center lg:text-left">
                    ©{{ date('Y') }} {{ __('Copyright') }} <x-href href="{{ url('') }}"
                        class="font-bold text-primary-500">IdentifiKu</x-href>.
                    {{ __('All right reserved.') }}
                </div>
                <div class="text-center lg:text-right">
                    {{ __('Version :ver', ['ver' => GeneralHelper::getVersion()]) }}
                </div>
            </div>
        </x-container>
    </div>
</footer>
