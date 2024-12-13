<div
    class="relative flex items-center justify-between w-full px-5 py-2 shadow bg-gradient-to-b from-primary-500 to-primary-700">
    <div x-text="currentTime" class="text-2xl font-semibold text-secondary-50"></div>
    <div class="flex items-center gap-1 text-end text-secondary-50">
        <span class="i-ph-user"></span>
        <div class="truncate max-w-40">
            {{ auth()->user()->student->name }}
        </div>
    </div>
    <div x-show="isShowTimer"
        class="absolute z-50 flex items-center flex-1 gap-1 px-3 py-1 text-xs font-semibold bg-white shadow top-full right-5 lg:text-base rounded-b-md">
        {{ __('Remaining Time') }}
        <div class="flex items-center justify-end" :class="time().days != '00' ? 'w-16 lg:w-24' : 'lg:w-16 w-12'">
            <div x-show="time().days != '00'" x-text="time().days">00</div>
            <div :class="time().days != '00' ? `before:content-[':']` : ``" x-text="time().hours">00</div>
            <div class="before:content-[':']" x-text="time().minutes">00</div>
            <div class="before:content-[':']" x-text="time().seconds">00</div>
        </div>
    </div>
</div>
