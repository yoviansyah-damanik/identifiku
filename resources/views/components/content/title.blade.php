<div id="content-title" class="p-6 mb-4 bg-white rounded-lg shadow sm:p-8 dark:bg-slate-800">
    <div class="text-lg font-bold text-primary-700 dark:text-primary-500">
        {{ $title }}
    </div>
    @if (!empty($description))
        <div class="mt-1 text-gray-700 dark:text-gray-100">
            {{ $description }}
        </div>
    @endif
</div>
