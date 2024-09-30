<footer class="relative z-10 px-4 py-1 text-sm text-center bg-primary-500 sm:px-6 sm:text-base dark:text-gray-100">
    <div class="flex h-8 items-center justify-between sm:gap-3 text-white">
        <div>
            {{ GeneralHelper::getAppName() }}
        </div>
        <div class="flex flex-col items-center sm:gap-3 sm:flex-row">
            {{ __('Version') }}: {{ GeneralHelper::getVersion() }}
        </div>
    </div>
</footer>
