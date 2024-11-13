<div class="relative flex flex-col items-center justify-center w-full h-64 px-1 mx-auto transition-all bg-center bg-no-repeat bg-cover bg-primary-100 before:absolute before:inset-0 dark:before:bg-primary-950/80 before:bg-primary-700/80"
    style="background-image: url('{{ Vite::image('sidebar-header.jpeg') }}')"
    :class="sidebarToggle ? 'lg:w-80 xl:w-[20rem] !px-3 gap-3' : 'w-16'">
    <div class="relative" :class="sidebarToggle ? 'lg:w-64 w-44 mx-auto' : 'w-48 rotate-90'">
        <img src="{{ Vite::image('logo.png') }}" class="h-full" alt="Logo">
    </div>

    <div class="absolute inset-x-0 flex justify-between p-4 top-1.5 left-4 md:left-auto md:right-0 lg:hidden">
        {{-- <x-dashboard.theme base="-mt-5" /> --}}
        <x-button color="transparent" size="sm" x-on:click="sidebarToggle = !sidebarToggle"
            base="min-h-0 min-w-0 p-0">
            <span class="i-ph-x-bold size-6 text-primary-100"></span>
        </x-button>
    </div>

    <div class="relative flex flex-col items-center justify-center gap-1 text-center">
        <div class="px-3 font-bold truncate w-72 text-secondary-500" :class="sidebarToggle ? 'block' : 'hidden'">
            {{ auth()->user()->{Str::lower(auth()->user()->roleName)}->name }}
            {{-- Lorem, ipsum dolor. --}}
        </div>
        <div class="px-5 text-sm sm:text-xs text-sky-100" :class="sidebarToggle ? 'block' : 'hidden'">
            <div class="mb-1">
                {{ auth()->user()?->getSchoolData?->name ?? '-' }}
                {{-- Lorem, ipsum dolor. --}}
            </div>
            <div>
                {{ __(auth()->user()->roleName) }}
                {{-- Lorem, ipsum. --}}
            </div>
        </div>
    </div>
</div>
