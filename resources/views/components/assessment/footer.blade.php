<footer class="hidden text-sm shadow lg:text-base lg:block">
    <div class="px-5 bg-gradient-to-t from-primary-500 to-primary-700 shadow-primary-700">
        <div class="flex flex-col items-center justify-between py-2 font-normal text-white lg:flex-row">
            <div class="text-center  lg:text-left">
                ©{{ date('Y') }} {{ __('Copyright') }} <x-href href="{{ url('') }}"
                    class="font-bold text-secondary-500">IdentifiKu</x-href>.
                {{ __('All right reserved.') }}
            </div>
            <div class="text-center lg:text-right">
                {{ __('Version :ver', ['ver' => GeneralHelper::getVersion()]) }}
            </div>
        </div>
    </div>
</footer>
