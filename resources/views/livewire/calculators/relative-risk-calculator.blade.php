<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2">
                    <p class="col-span-12 px-2 text-blue font-semibold underline"><strong>{{ $lang[1] ?? 'Exposed Group' }}</strong></p>
                    <div class="col-span-6 px-2">
                        <label for="e_disease" class="font-s-14 text-blue">{{ $lang[2] ?? 'Disease Case' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="e_disease" id="e_disease" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 px-2">
                        <label for="e_no_disease" class="font-s-14 text-blue">{{ $lang[3] ?? 'Non-Disease Case' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="e_no_disease" id="e_no_disease" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    
                    <p class="col-span-12 px-2 text-blue font-semibold underline mt-4"><strong>{{ $lang[4] ?? 'Control Group' }}</strong></p>
                    <div class="col-span-6 px-2">
                        <label for="c_disease" class="font-s-14 text-blue">{{ $lang[2] ?? 'Disease Case' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="c_disease" id="c_disease" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 px-2">
                        <label for="c_no_disease" class="font-s-14 text-blue">{{ $lang[3] ?? 'Non-Disease Case' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="c_no_disease" id="c_no_disease" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    
                    <div class="col-span-6 px-2 mt-4">
                        <label for="confidenceLevel" class="font-s-14 text-blue">{{ $lang[5] ?? 'Confidence Level' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="confidenceLevel" id="confidenceLevel" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                    <div class="col-span-6 px-2 mt-4">
                        <label class="font-s-14 text-blue">Z-Score:</label>
                        <div class="w-full py-2">
                            <input type="text" readonly value="{{ $z_score }}" class="input bg-gray-50" />
                        </div>
                    </div>
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
            @php
                $RR = $detail['relative'];
                $lnRR = log($RR);
                $sqrtTerm = sqrt((1 / $e_disease) + (1 / $c_disease) - (1 / ($e_disease + $e_no_disease)) - (1 / ($c_disease + $c_no_disease)));
                $lowerBound = exp($lnRR - (floatval($z_score) * $sqrtTerm));
                $upperBound = exp($lnRR + (floatval($z_score) * $sqrtTerm));
            @endphp
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result" x-data="{}" x-init="
                setTimeout(() => {
                    if (typeof renderMathInElement !== 'undefined') {
                        renderMathInElement($el);
                    }
                }, 100);
            ">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="p-2 border-b">{{ $lang['7'] ?? 'Relative Risk' }}</td>
                                            <td class="p-2 border-b"><strong class="text-blue">{{ round($RR, 4) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b">{{ $lang['8'] ?? 'Confidence Interval Lower' }}</td>
                                            <td class="p-2 border-b"><strong class="text-blue">{{ round($lowerBound, 4) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b">{{ $lang['9'] ?? 'Confidence Interval Upper' }}</td>
                                            <td class="p-2 border-b"><strong class="text-blue">{{ round($upperBound, 4) }}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <div class="mt-6 space-y-4">
                                    <p class="text-[18px] text-blue font-bold"><u>{{ $lang['10'] ?? 'Input Summary' }}</u></p>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="font-semibold text-blue">{{ $lang[1] ?? 'Exposed Group' }}:</p>
                                            <p>{{ $lang[2] ?? 'Disease' }}: {{ $e_disease }}</p>
                                            <p>{{ $lang[3] ?? 'No Disease' }}: {{ $e_no_disease }}</p>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-blue">{{ $lang[4] ?? 'Control Group' }}:</p>
                                            <p>{{ $lang[2] ?? 'Disease' }}: {{ $c_disease }}</p>
                                            <p>{{ $lang[3] ?? 'No Disease' }}: {{ $c_no_disease }}</p>
                                        </div>
                                    </div>
                                    <p>{{ $lang[5] ?? 'Confidence Level' }}: {{ $confidenceLevel }}{{ $lang['6'] ?? '%' }}</p>
                                    <p>{{ $lang['11'] ?? 'Z-Score' }}: {{ $z_score }}</p>
                                </div>

                                <div class="mt-8 space-y-4">
                                    <p class="text-[20px] text-blue font-bold"><u>Solution</u></p>
                                    <p>{{ $lang['12'] ?? 'The relative risk is calculated using the following formula:' }}</p>
                                    
                                    <p class="text-center text-[18px]">
                                        \( RR = \frac{a / (a + b)}{c / (c + d)} \)
                                    </p>
                                    
                                    <div class="bg-gray-50 p-4 rounded-lg italic">
                                        <p><strong>a</strong> &rarr; {{ $lang['15'] ?? 'Exposed with disease' }} ({{ $e_disease }})</p>
                                        <p><strong>b</strong> &rarr; {{ $lang['16'] ?? 'Exposed without disease' }} ({{ $e_no_disease }})</p>
                                        <p><strong>c</strong> &rarr; {{ $lang['17'] ?? 'Control with disease' }} ({{ $c_disease }})</p>
                                        <p><strong>d</strong> &rarr; {{ $lang['18'] ?? 'Control without disease' }} ({{ $c_no_disease }})</p>
                                    </div>

                                    <p class="text-center text-[18px]">
                                        \( RR = \frac{ {{ $e_disease }} / ({{ $e_disease }} + {{ $e_no_disease }} ) }{ {{ $c_disease }} / ( {{ $c_disease }} + {{ $c_no_disease }} ) } = \frac{ {{ round($detail['riskExposed'], 4) }} }{ {{ round($detail['riskControl'], 4) }} } = {{ round($RR, 4) }} \)
                                    </p>

                                    <p class="text-blue font-bold mt-4">{{ $lang['14'] ?? 'Confidence Interval Calculation' }}</p>
                                    <p>{{ $lang['19'] ?? 'Step 1: Calculate the natural log of RR:' }}</p>
                                    <p class="text-center">\( ln(RR) = ln({{ round($RR, 4) }}) = {{ round($lnRR, 4) }} \)</p>

                                    <p>{{ $lang['20'] ?? 'Step 2: Calculate the standard error term:' }}</p>
                                    <p class="text-center">
                                        \( \text{SE} = \sqrt{\frac{1}{a} + \frac{1}{c} - \frac{1}{a+b} - \frac{1}{c+d}} = \sqrt{\frac{1}{ {{ $e_disease }} } + \frac{1}{ {{ $c_disease }} } - \frac{1}{ {{ $e_disease + $e_no_disease }} } - \frac{1}{ {{ $c_disease + $c_no_disease }} }} = {{ round($sqrtTerm, 4) }} \)
                                    </p>

                                    <p>{{ $lang['21'] ?? 'Step 3: Calculate the bounds:' }}</p>
                                    <div class="space-y-4">
                                        <p class="text-center">
                                            \( \text{Lower Bound} = \exp(ln(RR) - Z \cdot \text{SE}) = \exp({{ round($lnRR, 4) }} - {{ $z_score }} \cdot {{ round($sqrtTerm, 4) }}) = {{ round($lowerBound, 4) }} \)
                                        </p>
                                        <p class="text-center">
                                            \( \text{Upper Bound} = \exp(ln(RR) + Z \cdot \text{SE}) = \exp({{ round($lnRR, 4) }} + {{ $z_score }} \cdot {{ round($sqrtTerm, 4) }}) = {{ round($upperBound, 4) }} \)
                                        </p>
                                    </div>
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
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="{{ url('katex/katex.min.js') }}"></script>
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
@endpush
