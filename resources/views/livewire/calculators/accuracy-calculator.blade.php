<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-3">
                    <div class="col-span-12 mx-auto">
                        <label for="method" class="label">{{ $lang[1] ?? 'Calculation Method' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="method_unit" id="method" class="input cursor-pointer">
                                <option value="Standard method">{{ $lang[11] ?? 'Standard method' }}</option>
                                <option value="Prevalence method">{{ $lang[12] ?? 'Prevalence method' }}</option>
                                <option value="Percent error method">{{ $lang[13] ?? 'Percent error method' }}</option>
                            </select>
                        </div>
                    </div>

                    @if($method_unit === 'Standard method')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 mt-3 gap-3">
                                <div class="col-span-6">
                                    <label for="true_postive" class="label">{{ $lang[2] ?? 'True Positive' }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="true_postive" id="true_postive" class="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="false_negative" class="label">{{ $lang[3] ?? 'False Negative' }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="false_negative" id="false_negative" class="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="false_positive" class="label">{{ $lang[4] ?? 'False Positive' }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="false_positive" id="false_positive" class="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="true_negative" class="label">{{ $lang[5] ?? 'True Negative' }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="true_negative" id="true_negative" class="input" placeholder="00" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($method_unit === 'Prevalence method')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 mt-3 gap-3">
                                <div class="col-span-6">
                                    <label for="prevalenc" class="label">{{ $lang[6] ?? 'Prevalence' }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" wire:model.live="prevalence" id="prevalenc" class="input" placeholder="00" />
                                        <span class="text-blue input_unit">%</span>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="sensitivity" class="label">{{ $lang[7] ?? 'Sensitivity' }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" wire:model.live="sensitivity" id="sensitivity" class="input" placeholder="00" />
                                        <span class="text-blue input_unit">%</span>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="specificity" class="label">{{ $lang[8] ?? 'Specificity' }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" wire:model.live="specificity" id="specificity" class="input" placeholder="00" />
                                        <span class="text-blue input_unit">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 mt-3 gap-3">
                                <div class="col-span-6">
                                    <label for="observed_value" class="label">{{ $lang[9] ?? 'Observed Value' }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="observed_value" id="observed_value" class="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="accepted_value" class="label">{{ $lang[10] ?? 'Accepted Value' }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="accepted_value" id="accepted_value" class="input" placeholder="00" />
                                    </div>
                                </div>
                            </div>
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
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @if ($method_unit == "Standard method" || $method_unit == "Prevalence method")
                                    <div class="text-center">
                                        <p class="text-[18px]">
                                            <strong>{{ $lang[14] ?? 'Accuracy' }}</strong>
                                        </p>
                                        <div class="flex justify-center">
                                            <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                                <strong class="text-white">{{ round($detail['answer'], 2) }}%</strong>
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <p class="text-[18px]">
                                            <strong>{{ $lang[15] ?? 'Percent error' }}</strong>
                                        </p>
                                        <div class="flex justify-center">
                                            <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                                <strong class="text-white">{{ round($detail['answer'], 2) }}%</strong>
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                @if ($method_unit == "Standard method")
                                    <p class="w-full mt-2 text-[18px]"><strong class="text-blue">{{ $lang[19] ?? 'Step-by-step Solution' }}</strong></p>
                                    <p class="w-full mt-2">{{ $lang[17] ?? 'Calculation' }}.</p>
                                    <p class="w-full mt-2">{{ $lang[14] ?? 'Accuracy' }} = (TP + TN) / (TP + TN + FP + FN)</p>
                                    <p class="w-full mt-2">{{ $lang[14] ?? 'Accuracy' }} = ({{ $true_postive }} + {{ $true_negative }}) / ({{ $true_postive }} + {{ $true_negative }} + {{ $false_positive }} + {{ $false_negative }})</p>
                                    <p class="w-full mt-2">{{ $lang[14] ?? 'Accuracy' }} = {{ round($detail['answer'], 4) }}</p>
                                @elseif ($method_unit == "Prevalence method")
                                    <p class="w-full mt-2 text-[18px]"><strong class="text-blue">{{ $lang[19] ?? 'Step-by-step Solution' }}</strong></p>
                                    <p class="w-full mt-2">{{ $lang[17] ?? 'Calculation' }}.</p>
                                    <p class="w-full mt-2">{{ $lang[14] ?? 'Accuracy' }} = (({{ $lang[7] ?? 'Sensitivity' }}) * ({{ $lang[6] ?? 'Prevalence' }})) + (({{ $lang[8] ?? 'Specificity' }}) * (1 - {{ $lang[6] ?? 'Prevalence' }}))</p>
                                    <p class="w-full mt-2">{{ $lang[14] ?? 'Accuracy' }} = ({{ $sensitivity }} * {{ $prevalence }}) + ({{ $specificity }} * (1 - {{ $prevalence }}))</p>
                                    <p class="w-full mt-2">{{ $lang[14] ?? 'Accuracy' }} = {{ round($detail['answer'], 4) }}</p>
                                @else
                                    <p class="w-full mt-2 text-[18px]"><strong>{{ $lang[19] ?? 'Step-by-step Solution' }}</strong></p>
                                    <p class="w-full mt-2">{{ $lang[18] ?? 'Calculation' }}.</p>
                                    <p class="w-full mt-2">{{ $lang[15] ?? 'Percent error' }} = (({{ $lang[9] ?? 'Observed value' }} - {{ $lang[10] ?? 'Accepted value' }})/{{ $lang[10] ?? 'Accepted value' }}) * 100</p>
                                    <p class="w-full mt-2">{{ $lang[15] ?? 'Percent error' }} = (({{ $observed_value }} - {{ $accepted_value }})/{{ $accepted_value }}) * 100</p>
                                    <p class="w-full mt-2">{{ $lang[15] ?? 'Percent error' }} = {{ round($detail['answer'], 4) }}</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>

@push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="{{ url('katex/katex.min.js') }}"></script>
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body, { delimiters: [{left: '$$', right: '$$', display: true}, {left: '\\(', right: '\\)', display: false}, {left: '\\[', right: '\\]', display: true}] });"></script>
    
    <script>
        window.MJrerender = function() {
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.getElementById('result-section') || document.body, {
                    delimiters: [
                        {left: '$$', right: '$$', display: true},
                        {left: '\\(', right: '\\)', display: false},
                        {left: '\\[', right: '\\]', display: true}
                    ],
                    throwOnError : false
                });
            }
        };

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('math-updated', () => {
                setTimeout(() => { window.MJrerender(); }, 100);
            });
        });
    </script>
@endpush
