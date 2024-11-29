<div>
    <div class="relative p-6 rounded-lg shadow-md sm:p-8 bg-pattern-4">
        <div
            class="relative z-10 flex flex-col gap-1 sm:items-start sm:justify-center min-h-52 sm:min-h-24 sm:w-96 lg:w-full">
            <div
                class="text-;g font-bold text-transparent sm:text-xl lg:text-2xl 2xl:text-3xl bg-gradient-to-br from-primary-500 to-secondary-500 bg-clip-text">
                {{ __('Welcome back, :name!', ['name' => auth()->user()->{Str::lower(auth()->user()->roleName)}->name]) }}
            </div>
            <div class="font-light ">
                <span class="font-bold text-secondary-500">
                    {{ __('Diagnostic Assessment') }}.
                </span>
                {{ __('Differentiated Learning Needs in the Merdeka Curriculum') }}.
            </div>
        </div>
        <img class="absolute bottom-0 z-0 pointer-events-none right-5 w-60" src="{{ Vite::image('bg-1.jpg') }}">
    </div>

    <livewire:is :component="'dashboard.home.' .
        Str::lower(auth()->user()->roleName == 'Superadmin' ? 'Administrator' : auth()->user()->roleName)" />
</div>
