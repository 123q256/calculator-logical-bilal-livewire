<div>
<style>
    [x-cloak] { display: none !important; }
</style>

<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 gap-4 mt-3">
                <div class="px-2">
                    <label for="stdv_txt" class="label">{{ $lang['1'] ?? 'Dataset (separated by comma or space)' }}</label>
                    <div class="w-100 py-2">
                        <textarea wire:model.live="stdv_txt" id="stdv_txt" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54"></textarea>
                    </div>
                </div>
                <div class="px-2 flex flex-wrap items-center gap-6 justify-center">
                    <div class="flex items-center gap-2">
                        <input type="radio" wire:model.live="stdv_rad" id="stdv_rad" value="sample" class="cursor-pointer h-4 w-4 text-blue-600">
                        <label for="stdv_rad" class="label cursor-pointer">{{ $lang['2'] ?? 'Sample' }}</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" wire:model.live="stdv_rad" id="stdv_rad1" value="population" class="cursor-pointer h-4 w-4 text-blue-600">
                        <label for="stdv_rad1" class="label cursor-pointer">{{ $lang['3'] ?? 'Population' }}</label>
                    </div>
                </div>
            </div>
        </div>
        @if ($type == 'calculator')
            @include('inc.button')
        @endif
        @if ($type=='widget')
            @include('inc.widget-button')
        @endif
    </div>

    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        @php
                            $stdv_rad = $detail['stdv_rad'];
                            if ($detail['stdv_rad'] === "population") {
                                $sdSym = "σ";
                                $mSym = "μ";
                            } else {
                                $sdSym = "s";
                                $mSym = "x̄";
                            }
                        @endphp
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{ $lang['4'] ?? 'Standard Deviation' }} {{ $sdSym }}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] w-auto bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">
                                        @if ($stdv_rad === "population")
                                            {{ round(sqrt($detail["ar_sum"] / $detail["t_n"]), 4) }}
                                        @else
                                            {{ round(sqrt($detail["ar_sum"] / ($detail["t_n"] - 1)), 4) }}
                                        @endif
                                    </strong>
                                </p>
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["5"] ?? 'Number' }} (n)</p></td>
                                    <td class="p-2 border-b"><b>{{ $detail["t_n"] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["6"] ?? 'Sum' }} (Σx)</p></td>
                                    <td class="p-2 border-b"><b>{{ $detail["sum"] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["7"] ?? 'Mean' }} ({{ $mSym }})</p></td>
                                    <td class="p-2 border-b"><b>{{ $detail["m"] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["8"] ?? 'Variance' }} ({{ $sdSym }}²)</p></td>
                                    <td class="p-2 border-b"><b>{{ $detail["v_2"] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["9"] ?? 'Coefficient' }}</p></td>
                                    <td class="p-2 border-b"><b>{{ $detail["c"] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["10"] ?? 'SE' }} (SE)</p></td>
                                    <td class="p-2 border-b"><b>{{ $detail["s_e"] }}</b></td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-2 font-s-20">{{ $lang["11"] ?? 'Formula' }} :</p> 
                        <p class="col-12">
                            @if ($stdv_rad === "population")
                                \[ {{ $sdSym }} = \sqrt{\dfrac{\sum_{i=1}^{n}(x_i - \mu)^{2}}{n}} \]
                            @else
                                \[ {{ $sdSym }} = \sqrt{\dfrac{\sum_{i=1}^{n}(x_i - \bar{X})^{2}}{n - 1}} \]
                            @endif
                        </p>
                        <div class="grid grid-cols-1 mt-2 overflow-auto">
                            {!! $detail["table"] !!}
                        </div>
                        <p class="w-full mt-2">
                            @if ($stdv_rad === "population")
                                \[ {{ $sdSym }} = \sqrt{\dfrac{SS}{n}} \]
                                \[ {{ $sdSym }} = \sqrt{\dfrac{ {{ $detail["ar_sum"] }} }{ {{ $detail["t_n"] }} }} \]
                                \[ {{ $sdSym }} = \sqrt{ {{ ($detail["ar_sum"] / $detail["t_n"]) }} } \]
                                \[ {{ $sdSym }} = {{ round(sqrt($detail["ar_sum"] / $detail["t_n"]), 4) }} \]
                            @else
                                \[ {{ $sdSym }} = \sqrt{\dfrac{SS}{n - 1}} \]
                                \[ {{ $sdSym }} = \sqrt{\dfrac{ {{ $detail["ar_sum"] }} }{ {{ ($detail["t_n"] - 1) }} }} \]
                                \[ {{ $sdSym }} = \sqrt{ {{ ($detail["ar_sum"] / ($detail["t_n"] - 1)) }} } \]
                                \[ {{ $sdSym }} = {{ round(sqrt($detail["ar_sum"] / ($detail["t_n"] - 1)), 4) }} \]
                            @endif
                        </p>
                        <p class="w-full font-s-20 mt-2"><strong>Margin of Error (Confidence Interval)</strong></p>
                        <p class="w-full mt-2">Normal distribution gives you an estimation about sampling mean. Consider the equation as under to compute standard error of mean (SEM):</p>
                        <p class="w-full font-s-18">σ<sub>x̄</sub> = \(\dfrac{σ}{\sqrt{N}} = {{ $detail['mor'] }}\)</p>
                        <p class="w-full mt-2">Considering SEM, various confidence levels gives you different error margin estimations. As per the study field, 95% confidence level (significance level = 5%) is what we consider a standard for representing data.</p>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 border-b"><strong>Confidence Level</strong></td>
                                    <td class="py-2 border-b"><strong>Margin of Error</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">68.3%, σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b">{{ $detail['m'] }} ± {{ round($detail['mor'], 3) }} (±{{ round((sqrt($detail['put'])/sqrt($detail['i']))*100, 2) }}%)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">90%, 1.645σ<sub>x̄</sub></td>
                                    <td class="p-2 border-b">{{ $detail['m'] }} ± {{ round($detail['mor']*1.645, 3) }} (±{{ round(1.645*(sqrt($detail['put'])/sqrt($detail['i']))*100, 2) }}%)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">95%, 1.960σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b">{{ $detail['m'] }} ± {{ round($detail['mor']*1.960, 3) }} (±{{ round(1.960*(sqrt($detail['put'])/sqrt($detail['i']))*100, 2) }}%)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">99%, 2.576σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b">{{ $detail['m'] }} ± {{ round($detail['mor']*2.576, 3) }} (±{{ round(2.576*(sqrt($detail['put'])/sqrt($detail['i']))*100, 2) }}%)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">99.99%, 3.891σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b">{{ $detail['m'] }} ± {{ round($detail['mor']*3.891, 3) }} (±{{ round(3.891*(sqrt($detail['put'])/sqrt($detail['i']))*100, 2) }}%)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">99.999%, 4.417σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b">{{ $detail['m'] }} ± {{ round($detail['mor']*4.417, 3) }} (±{{ round(4.417*(sqrt($detail['put'])/sqrt($detail['i']))*100, 2) }}%)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">99.9999%, 4.892σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b">{{ $detail['m'] }} ± {{ round($detail['mor']*4.892, 3) }} (±{{ round(4.892*(sqrt($detail['put'])/sqrt($detail['i']))*100, 2) }}%)</td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-3 font-s-20">{{ $lang["12"] ?? 'Frequency Table' }}</p> 
                        <div class="col-lg-6 mt-2 overflow-auto">
                            <table class="w-100 text-center">
                                <tr>
                                    <th class="py-2 border-b">{{ $lang["13"] ?? 'Value' }}</th>
                                    <th class="py-2 border-b">{{ $lang["14"] ?? 'Frequency' }}</th>
                                </tr>
                                {!! $detail["tablef"] !!}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>

@push('calculatorJS')
    <link rel="stylesheet" href="{{ asset('katex/katex.min.css') }}">
    <script src="{{ asset('katex/katex.min.js') }}"></script>
    <script src="{{ asset('katex/auto-render.min.js') }}"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            renderMathInElement(document.body);
        });
        document.addEventListener('livewire:navigated', () => {
            renderMathInElement(document.body);
        });
    </script>
@endpush
</div>
