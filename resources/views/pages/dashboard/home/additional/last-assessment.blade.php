<div class="space-y-3 sm:space-y-4">
    @if ($assessment)
        <div
            class="relative flex items-center gap-5 text-2xl font-bold text-center uppercase border-secondary-50 text-nowrap text-secondary-500 before:border-b before:inline-flex before:w-full before:border-secondary-500 after:border-secondary-500 after:border-b after:inline-flex after:w-full">
            {{ __('Last Assessment') }}
        </div>
        {{-- <div
            class="w-full p-6 overflow-hidden bg-white rounded-lg shadow-md lg:p-8 sm:[column-count:2] [column-count:1] lg:[column-count:3]">
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __(':name Name', ['name' => __('Student')]) }}
                </div>
                <div class="flex-1 font-semibold text-secondary-500">
                    {{ $assessment->student->name }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __(':name Name', ['name' => __('School')]) }}
                </div>
                <div class="flex-1">
                    {{ $assessment->student->school->name }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __(':name Name', ['name' => __('Class')]) }}
                </div>
                <div class="flex-1">
                    {{ $assessment->class->name }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __(':name Name', ['name' => __('Assessment')]) }}
                </div>
                <div class="flex-1 font-semibold text-secondary-500">
                    {{ $assessment->quiz->name }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __(':type Type', ['type' => __('Assessment')]) }}
                </div>
                <div class="flex-1 font-semibold">
                    {{ __(Str::headline($assessment->quiz->type)) }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __('Started On') }}
                </div>
                <div class="flex-1">
                    {{ $assessment->created_at->translatedFormat('d M Y H:i:s') }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __('Assessed On') }}
                </div>
                <div class="flex-1">
                    {{ $assessment->result->updated_at->translatedFormat('d M Y H:i:s') }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __('Status') }}
                </div>
                <div class="flex-1">
                    @if ($assessment)
                        @if ($assessment->isDone)
                            <div class="text-green-500">
                                {{ __('Assessment result completed') }}
                            </div>
                        @elseif ($assessment->isSubmitted)
                            <span class="text-yellow-500">
                                {{ __('You have completed this assessment') }}!
                            </span>
                            {{ __('Assessment results are being processed') }}
                        @else
                            @if (is_null($assessment->remainingTime))
                                <div class="text-blue-500">
                                    {{ __('Assessments have been made, but not yet started') }}
                                </div>
                            @else
                                @if ($assessment->remainingTime > 0)
                                    <div class="text-yellow-600">
                                        {{ __('You can take this assessment with :time left', ['time' => GeneralHelper::getTime($assessment->remainingTime)]) }}
                                    </div>
                                @elseif($assessment->remainingTime == 0)
                                    <span class="text-red-500">
                                        {{ __('Time is up') }}!
                                    </span>
                                    {{ __('Assessment results are being processed') }}
                                @endif
                            @endif
                        @endif
                    @else
                        {{ __('You have never done this assessment') }}
                    @endif
                </div>
            </div>
        </div>
        <div class="flex flex-col items-start w-full gap-3 lg:gap-4 lg:flex-row">
            <div class="w-full p-6 overflow-hidden bg-white rounded-lg shadow-md xl:max-w-[33%] 2xl:max-w-[25%] lg:p-8">
                <div class="mb-5 text-lg font-bold text-center text-primary-500">
                    {{ __('Result Chart') }}
                </div>
                <div wire:ignore>
                    <canvas class="!w-full !h-auto" id="chart"></canvas>
                </div>
            </div>
            <div
                class="flex flex-col flex-1 w-full gap-3 p-6 overflow-hidden bg-white rounded-lg shadow-md sm:gap-4 lg:p-8">
                <div
                    class="relative w-full p-6 overflow-hidden rounded-lg shadow-md cursor-pointer bg-primary-500 lg:p-8">
                    <div class="mb-5 text-lg font-bold text-center text-secondary-500">
                        {{ __('Dominance') }}
                    </div>

                    <div class="px-5 py-6 mb-5 bg-white rounded-lg">
                        <div
                            class="text-3xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-br from-primary-500 to-secondary-500">
                            {{ $assessment->result->dominance->title }}
                        </div>
                    </div>
                    <div class="text-sm italic font-light text-center text-white">
                        {{ __('Click to see more') }}
                    </div>
                    <a class="absolute inset-0" href="{{ route('dashboard.assessment.result', $assessment) }}"></a>
                </div>
                <div class="flex flex-col gap-3 lg:gap-4">
                    <div class="flex-1 space-y-3 lg:space-y-4">
                        @foreach ($assessment->result->details as $detail)
                            <div>
                                <div class="flex items-center justify-between gap-3 mb-1 lg:gap-4">
                                    <div class="font-semibold">
                                        {{ $detail->title }}
                                    </div>
                                    <div class="text-sm">
                                        {{ GeneralHelper::numberFormat(($detail->score / $assessment->result->details->sum('score')) * 100) }}%
                                    </div>
                                </div>
                                <div class="relative w-full h-4 overflow-hidden rounded-full shadow bg-red-50">
                                    <div style="width: {{ ($detail->score / $assessment->result->details->sum('score')) * 100 > 0 ? ($detail->score / $assessment->result->details->sum('score')) * 100 . '%' : '0px' }}"
                                        class="h-full bg-red-500 rounded-full">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> --}}
    @else
        <div class="text-center">
            <div class="mb-3">
                {{ __('No assessments you completed') }}
            </div>

            <x-button radius="rounded-full" color="primary" :withBorderIcon="false" icon="i-ph-magnifying-glass"
                href="{{ route('dashboard.assessment') }}">
                {{ __('Find :find', ['find' => __('Assessment')]) }}
            </x-button>
        </div>
    @endif
</div>
{{--
@if ($assessment)
    @push('scripts')
        <script type="module">
            const ctx = document.getElementById('chart');
            const image = new Image();
            image.src = `{{ Vite::image('favicon.png') }}`;

            Chart.register(Colors);
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: {!! $assessment->result->details->pluck('title') !!},
                    datasets: [{
                        label: `{{ __('Score') }}`,
                        data: {!! $assessment->result->details->pluck('score') !!},
                        // backgroundColor: [
                        //     'rgb(255, 99, 132)',
                        //     'rgb(54, 162, 235)',
                        //     'rgb(255, 205, 86)'
                        // ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                },
                plugins: [{
                        id: 'customCanvasBackgroundImage',
                        beforeDraw: (chart) => {
                            if (image.complete) {
                                const ctx = chart.ctx;
                                const {
                                    top,
                                    left,
                                    width,
                                    height
                                } = chart.chartArea;
                                const x = left + width / 2 - image.width / 2;
                                const y = top + height / 2 - image.height / 2;
                                ctx.drawImage(image, x, y);
                            } else {
                                image.onload = () => chart.draw();
                            }
                        }
                    },
                    {
                        colors: {
                            enabled: false
                        }
                    }
                ]
            });
        </script>
    @endpush
@endif --}}
