<div class="flex flex-col gap-3 lg:gap-4">
    <div class="flex flex-col gap-3 lg:gap-4 lg:flex-row">
        <div class="flex-1 w-full p-6 overflow-hidden bg-white rounded-lg lg:p-8">
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
                                        {{ __('You can take this assessment with :minute minutes left', ['minute' => $assessment->remainingTime]) }}
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
        <div class="flex-1 w-full p-6 overflow-hidden rounded-lg bg-primary-500 lg:p-8">
            <div class="mb-5 text-lg font-bold text-center text-secondary-500">
                {{ __('Dominance') }}
            </div>

            <div class="px-5 py-6 bg-white rounded-lg mb-7">
                <div
                    class="text-3xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-br from-primary-500 to-secondary-500">
                    {{ $assessment->result->details->where('is_highlight', true)->first()->title }}
                </div>
            </div>
        </div>
    </div>
    <div class="w-full">
        <div class="flex flex-col items-start gap-3 lg:gap-4" x-data="{
            isShow: false,
            title: '',
            message: '',
            indicator: '',
            setDataModal(title, message, indicator) {
                this.isShow = true;
                this.title = title;
                this.message = message;
                this.indicator = indicator;
            }
        }">
            <div class="flex flex-col items-start w-full gap-3 lg:gap-4 lg:flex-row">
                <div
                    class="w-full p-6 overflow-hidden bg-white rounded-lg lg:max-w-screen-sm 2xl:max-w-screen-lg lg:p-8">
                    <div class="mb-5 text-lg font-bold text-center text-primary-500">
                        {{ __('Assessment Result') }}
                    </div>

                    <div class="flex flex-col gap-3 lg:flex-row lg:gap-4">
                        <div class="w-full lg:w-80 2xl:w-96">
                            <div class="w-full mx-auto max-w-96 mb-7" wire:ignore>
                                <canvas id="summationChart"></canvas>
                            </div>
                        </div>
                        <div class="flex-1 space-y-3 lg:space-y-4">
                            @foreach ($assessment->result->details as $detail)
                                <div>
                                    <div class="flex items-center justify-between gap-3 mb-1 lg:gap-4">
                                        <div class="font-semibold">
                                            {{ $detail->title }}
                                        </div>
                                        <div class="text-sm">
                                            {{ ($detail->value / $assessment->result->details->sum('value')) * 100 }}%
                                        </div>
                                    </div>
                                    <div class="relative w-full h-4 overflow-hidden rounded-full shadow bg-red-50">
                                        <div style="width: {{ ($detail->value / $assessment->result->details->sum('value')) * 100 > 0 ? ($detail->value / $assessment->result->details->sum('value')) * 100 . '%' : '0px' }}"
                                            class="h-full bg-red-500 rounded-full">
                                        </div>
                                    </div>
                                    <div class="mt-3" x-data="{ expanded: false }">
                                        <x-button size="sm" radius="rounded-full" block color="primary-transparent"
                                            x-on:click="setDataModal('{{ $detail->title }}','{{ $detail->message ?: '-' }}','{{ $detail->indicator }}')">
                                            {{ __('Show :show', ['show' => __('Indicator')]) }}
                                        </x-button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex-1 w-full p-6 overflow-hidden bg-white rounded-lg lg:p-8">
                    <div class="mb-5 text-lg font-bold text-center text-primary-500">
                        {{ __('Indicator Explanation') }}
                    </div>

                    <div x-show="!isShow" class="text-center">
                        {{ __('Please select the indicator you want to show') }}
                    </div>
                    <div x-show="isShow">
                        <div class="space-y-3 lg:space-y-4">
                            <div>
                                <div class="font-semibold">
                                    {{ __('Title') }}
                                </div>
                                <div x-text="title"></div>
                            </div>
                            <div>
                                <div class="font-semibold">
                                    {{ __('Indicator') }}
                                </div>
                                <div x-html="indicator"></div>
                            </div>
                            <div>
                                <div class="font-semibold">
                                    {{ __('Message') }}
                                </div>
                                <div x-text="message"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@push('scripts')
    <script type="module">
        const ctx = document.getElementById('summationChart');
        const image = new Image();
        image.src = `{{ Vite::image('favicon.png') }}`;

        Chart.register(Colors);
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! $assessment->result->details->pluck('title') !!},
                datasets: [{
                    label: `{{ __('Value') }}`,
                    data: {!! $assessment->result->details->pluck('value') !!},
                    // backgroundColor: [
                    //     'rgb(255, 99, 132)',
                    //     'rgb(54, 162, 235)',
                    //     'rgb(255, 205, 86)'
                    // ],
                    hoverOffset: 4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
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
