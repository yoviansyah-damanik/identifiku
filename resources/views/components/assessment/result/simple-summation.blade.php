<div class="flex flex-col gap-3 sm:gap-4">
    <div class="w-full p-6 overflow-hidden rounded-lg bg-primary-500 lg:p-8">
        <div class="mb-5 text-lg font-bold text-center text-secondary-500">
            {{ __('Dominance') }}
        </div>

        <div class="px-5 py-6 bg-white rounded-lg mb-7">
            <div
                class="text-3xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-br from-primary-500 to-secondary-500">
                {{ $assessment->result->dominance->title }}
            </div>
        </div>
    </div>
    <div class="w-full p-6 overflow-hidden bg-white rounded-lg lg:p-8">
        <div class="mb-5 text-lg font-bold text-center text-primary-500">
            {{ __('Assessment Result') }}
        </div>

        <div class="flex flex-col gap-3 lg:flex-row lg:gap-4">
            <div class="w-full lg:w-80 2xl:w-96">
                <div class="w-full mx-auto max-w-96 mb-7" wire:ignore>
                    <canvas id="chart"></canvas>
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
                                {{ GeneralHelper::numberFormat(($detail->value / $assessment->result->details->sum('value')) * 100) }}%
                            </div>
                        </div>
                        <div class="relative w-full h-4 overflow-hidden rounded-full shadow bg-red-50">
                            <div style="width: {{ ($detail->value / $assessment->result->details->sum('value')) * 100 > 0 ? ($detail->value / $assessment->result->details->sum('value')) * 100 . '%' : '0px' }}"
                                class="h-full bg-red-500 rounded-full">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

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
        console.log('ea')
    </script>
@endpush
