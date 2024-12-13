<div class="w-full p-6 overflow-hidden bg-white rounded-lg shadow-lg sm:flex-1 lg:p-8">
    <div class="mb-5 text-lg font-bold leading-6 text-center text-primary-500">
        {{ $title }}
    </div>
    <div class="max-h-[40dvh] overflow-auto space-y-3 sm:space-y-4">
        @forelse ($assessments as $assessment)
            <x-five-recent-assessment-item :$assessment />
        @empty
            <x-no-data />
        @endforelse
    </div>
</div>
