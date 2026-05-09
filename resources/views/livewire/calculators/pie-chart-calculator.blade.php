<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 mt-3 gap-4">
                    <div class="w-full">
                        <div class="grid grid-cols-12 gap-4">
                            @foreach($choices as $index => $choice)
                                <div class="col-span-6 relative">
                                    <label for="choices{{ $index }}" class="font-s-14 text-blue">
                                        {{ $index < 4 ? ($lang[$index + 1] ?? 'Group ' . chr(65 + $index)) : 'Group ' . chr(65 + $index) }}
                                    </label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="choices.{{ $index }}" required id="choices{{ $index }}" class="input" aria-label="input" placeholder="00" />
                                    </div>
                                    @if($index >= 4)
                                        <img src="{{ url('assets/img/close.png') }}" alt="Remove" wire:click="removeInput({{ $index }})" width="13" class="absolute cursor-pointer" style="right: 10px; top: 12px;">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    @if(count($choices) < 20)
                        <div class="w-full flex justify-end px-2 mt-4">
                            <button type="button" wire:click="addInput" class="bg-[#2845F5] text-white border radius-10 px-4 py-1 flex items-center shadow-md hover:bg-blue-700 transition">
                                <strong class="text-blue flex items-center">
                                    <span class="font-s-18 text-white mr-1">+</span> <span class="text-white">Add</span>
                                </strong>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-2">
                            <div class="w-full">
                                @php
                                    $letters = $detail['letters'];
                                    $values = $detail['values'];
                                    $percentage = $detail['percentage'];
                                    $degree = $detail['degree'];
                                    $chal_v = $detail['new_combine'];
                                @endphp
                                <div class="w-full overflow-auto mt-3">
                                    <table class="w-full" style="border-collapse: collapse">
                                        <tr class="bg-sky">
                                            <td class="p-2 border text-center"><strong class="text-blue">{{ $lang['5'] ?? 'Letter' }}</strong></td>
                                            <td class="p-2 border text-center"><strong class="text-blue">{{ $lang['6'] ?? 'Value' }}</strong></td>
                                            <td class="p-2 border text-center"><strong class="text-blue">{{ $lang['7'] ?? 'Percentage' }}</strong></td>
                                            <td class="p-2 border text-center"><strong class="text-blue">{{ $lang['8'] ?? 'Degree' }}</strong></td>
                                        </tr>
                                        @php
                                            $totalRows = max(count($letters), count($values), count($percentage), count($degree));
                                        @endphp
                                        @for ($i = 0; $i < $totalRows; $i++)
                                            <tr class="bg-white">
                                                <td class="p-2 border text-center">{{ $i < count($letters) ? $letters[$i] : "" }}</td>
                                                <td class="p-2 border text-center">{{ $i < count($values) ? $values[$i] : "" }}</td>
                                                <td class="p-2 border text-center">{{ $i < count($percentage) ? $percentage[$i] : "" }} %</td>
                                                <td class="p-2 border text-center">{{ $i < count($degree) ? $degree[$i] : "" }}°</td>
                                            </tr>
                                        @endfor
                                    </table>
                                </div>
                                
                                <div class="w-full mt-6 mb-5" 
                                     x-data='{ 
                                        detail: @json($detail),
                                        render(newDetail) {
                                            if (newDetail) this.detail = newDetail;
                                            
                                            if (typeof CanvasJS === "undefined") {
                                                setTimeout(() => this.render(), 200);
                                                return;
                                            }
                                            
                                            if (!this.detail || !this.detail.new_combine) return;

                                            const dataPoints = typeof this.detail.new_combine === "string" 
                                                ? JSON.parse(this.detail.new_combine) 
                                                : this.detail.new_combine;

                                            var chart = new CanvasJS.Chart(this.$refs.pieChart, {
                                                theme: "light2",
                                                exportEnabled: true,
                                                animationEnabled: true,
                                                title: {
                                                    text: "Pie Chart"
                                                },
                                                data: [{
                                                    type: "pie",
                                                    startAngle: 25,
                                                    toolTipContent: "<b>{label}</b>: {y}%",
                                                    showInLegend: "true",
                                                    legendText: "{label}",
                                                    indexLabelFontSize: 16,
                                                    indexLabel: "{label} - {y}",
                                                    dataPoints: dataPoints
                                                }]
                                            });
                                            chart.render();
                                        }
                                     }' 
                                     x-init="render()"
                                     @chart-updated.window="render($event.detail[0])"
                                     wire:ignore>
                                    <div x-ref="pieChart" style="height: 370px; width: 100%;"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>

@push('calculatorJS')
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
@endpush
