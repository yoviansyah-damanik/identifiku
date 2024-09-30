<div
    class="relative flex items-center justify-between px-4 py-3 border-b sm:px-6 sm:py-4 bg-primary-500 dark:bg-slate-900 dark:text-gray-100">
    <div class="flex-1 font-bold text-secondary-500">
        {{ $title }}
    </div>
    <x-button size="sm" color="secondary-outline" icon="i-ph-x-bold" x-on:click="closeModal" />
</div>
