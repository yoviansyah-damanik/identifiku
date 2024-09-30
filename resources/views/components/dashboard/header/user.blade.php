<a class="flex items-center gap-3 p-1 rounded-full cursor-pointer bg-primary-700" wire:navigate
    href="{{ route('dashboard.account') }}">
    <img class="rounded-full size-10" src="{{ Vite::image('default-avatar.jpg') }}" alt="User Icon" />
    <div class="flex flex-col py-1 font-semibold w-44 sm:w-52 lg:w-60">
        <div class="pr-6 text-sm line-clamp-1 sm:text-base text-primary-100">
            {{-- {{ auth()->user()->dataRelation->name }} --}}
            Lorem ipsum dolor sit.
        </div>
        <div class="text-xs font-light line-clamp-1 text-primary-50">
            {{-- {{ __(auth()->user()->roleName) }} --}}
            Lorem, ipsum.
        </div>
    </div>
</a>
