<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-6">
                        <label for="calc_type" class="label">{{ $lang['1'] ?? 'Select Type' }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="calc_type" id="calc_type" class="input cursor-pointer">
                                <option value="equal">Equal variances</option>
                                <option value="unequal">Unequal variances</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="ronding" class="label">{{ $lang['2'] ?? 'Rounding' }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="ronding" id="ronding" class="input cursor-pointer">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 text-center flex items-center justify-center space-x-6">
                        <div class="flex items-center space-x-2">
                            <input type="radio" wire:model.live="option" id="option_sum" value="sum" class="cursor-pointer">
                            <label for="option_sum" class="label text-blue cursor-pointer">{{ $lang['3'] ?? 'Summary Data' }}</label>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="radio" wire:model.live="option" id="option_raw" value="raw" class="cursor-pointer">
                            <label for="option_raw" class="label text-blue cursor-pointer">{{ $lang['4'] ?? 'Raw Data' }}</label>
                        </div>
                    </div>

                    @if($option === 'sum')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="s1" class="label text-blue">{{ $lang['5'] ?? 'Standard Deviation' }} (S₁):</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="s1" id="s1" class="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="s2" class="label text-blue">{{ $lang['5'] ?? 'Standard Deviation' }} (S₂):</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="s2" id="s2" class="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="n1" class="label text-blue">{{ $lang['6'] ?? 'Sample Size' }} (n₁):</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="n1" id="n1" class="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="n2" class="label text-blue">{{ $lang['6'] ?? 'Sample Size' }} (n₂):</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="n2" id="n2" class="input" placeholder="00" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="g1" class="label text-blue">{{ $lang['7'] ?? 'Group 1 Data' }} (comma separated)</label>
                                    <div class="w-100 py-2">
                                        <textarea wire:model.live="g1" id="g1" class="textareaInput h-[150px]" placeholder="e.g. 1, 2, 3, 4, 5"></textarea>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="g2" class="label text-blue">{{ $lang['8'] ?? 'Group 2 Data' }} (comma separated)</label>
                                    <div class="w-100 py-2">
                                        <textarea wire:model.live="g2" id="g2" class="textareaInput h-[150px]" placeholder="e.g. 2, 2, 3, 2, 2"></textarea>
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
                                @if ($detail['type'] == 'equal')
                                    <div class="text-center">
                                        <p class="text-[18px]"><strong>{{ $lang[9] ?? 'Equal Variances Pooled Variance' }}</strong></p>
                                    </div>
                                    @if ($option == 'sum')
                                        <div class="flex justify-center">
                                            <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                                <strong class="text-white">{{ $detail['sp2'] }}</strong>
                                            </p>
                                        </div>
                                        
                                        <p class="w-full mt-2 text-[18px] text-blue">{{ $lang['10'] ?? 'Result Summary' }}</p>
                                        <div class="w-full lg:w-[50%] mt-2 overflow-auto">
                                            <table class="w-full">
                                                <tr>
                                                    <td class="py-2 border-b">{{ $lang["11"] ?? 'Standard Error' }}</td>
                                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['sp'] }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b">{{ $lang["12"] ?? 'Pooled Standard Deviation' }}</td>
                                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['sqrsp2'] }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b">{{ $lang["13"] ?? 'Degree of Freedom' }} (df)</td>
                                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['n1'] + $detail['n2'] - 2 }}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="mt-6 space-y-4">
                                            <p class="text-[18px]">{{ $lang['14'] ?? 'Step-by-step Solution' }}</p>
                                            <div class="overflow-auto py-2">
                                                <p>\(S_p^2 = \dfrac{(n_1 -1)S_1^2 + (n_2 - 1)S_2^2}{n_1 + n_2 - 2}\)</p>
                                                <p>\(S_p^2 = \dfrac{ ({{ $detail['n1'] }} - 1)({{ $detail['s1'] }})^2 + ({{ $detail['n2'] }} - 1)({{ $detail['s2'] }})^2 }{ {{ $detail['n1'] }} + {{ $detail['n2'] }} - 2 }\)</p>
                                                <p>\(S_p^2 = \dfrac{ ({{ $detail['n1_1'] }})({{ $detail['ps1'] }}) + ({{ $detail['n2_1'] }})({{ $detail['ps2'] }}) }{ {{ $detail['devi'] }} }\)</p>
                                                <p>\(S_p^2 = \dfrac{ {{ $detail['n1s1'] }} + {{ $detail['n2s2'] }} }{ {{ $detail['devi'] }} }\)</p>
                                                <p>\(S_p^2 = \dfrac{ {{ $detail['res'] }} }{ {{ $detail['devi'] }} }\)</p>
                                                <p>\(S_p^2 = {{ $detail['sp2'] }}\)</p>
                                                
                                                <p class="mt-4 text-[18px]">{{ $lang['15'] ?? 'Pooled Standard Deviation' }}</p>
                                                <p>\(S_p = \sqrt{S_p^2} = \sqrt{ {{ $detail['sp2'] }} }\)</p>
                                                <p>\(S_p = {{ $detail['sqrsp2'] }}\)</p>
                                                
                                                <p class="mt-4 text-[18px]">{{ $lang['12'] ?? 'Standard Error' }}</p>
                                                <p>\(SE = S_{\bar x_1 - \bar x_2} = S_p \sqrt{\dfrac{1}{n_1} + \dfrac{1}{n_2}}\)</p>
                                                <p>\(SE = {{ $detail['sqrsp2'] }} \sqrt{\dfrac{1}{ {{ $detail['n1'] }} } + \dfrac{1}{ {{ $detail['n2'] }} }}\)</p>
                                                <p>\(SE = {{ $detail['sqrsp2'] }} \sqrt{ {{ 1 / $detail['n1'] }} + {{ 1 / $detail['n2'] }} }\)</p>
                                                <p>\(SE = {{ $detail['sqrsp2'] }} \sqrt{ {{ $detail['devn1'] }} + {{ $detail['devn2'] }} }\)</p>
                                                <p>\(SE = {{ $detail['sqrsp2'] }} \sqrt{ {{ $detail['devres'] }} }\)</p>
                                                <p>\(SE = {{ $detail['sp'] }}\)</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <p class="text-[21px] bg-sky px-3 py-2 rounded-lg d-inline-block my-3">
                                                <strong class="text-blue">{{ $detail['pvres'] }}</strong>
                                            </p>
                                        </div>
                                        <p class="w-full mt-2 text-[18px] text-blue">{{ $lang['10'] ?? 'Result Summary' }}</p>
                                        <div class="w-full lg:w-[50%] mt-2 overflow-auto">
                                            <table class="w-full">
                                                <tr>
                                                    <td class="py-2 border-b">{{ $lang["17"] ?? 'Pooled SD' }} (Sp)</td>
                                                    <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['sqrpvres'], 4) }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b">{{ $lang["12"] ?? 'Standard Error' }}</td>
                                                    <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['seres'], 4) }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b">{{ $lang["13"] ?? 'Degree of Freedom' }} (df)</td>
                                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['i'] + $detail['i1'] - 2 }}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="mt-6 space-y-8">
                                            <div>
                                                <p class="text-[18px] font-semibold text-blue">{{ $lang['18'] ?? 'Group 1 Analysis' }}</p>
                                                <div class="overflow-auto mt-2">
                                                    {!! $detail["table"] !!}
                                                </div>
                                                <div class="mt-4 space-y-2">
                                                    <p>\(\text{Variance } S_1^2 = \dfrac{\Sigma(x_i - \bar x)^2}{n - 1} = \dfrac{ {{ $detail['ar_sum'] }} }{ {{ $detail['i'] }} - 1} = {{ $detail['v'] }}\)</p>
                                                    <p>\(\text{Standard Deviation } S_1 = \sqrt{ {{ $detail['v'] }} } = {{ round($detail['vsqrt'], 4) }}\)</p>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-[18px] font-semibold text-blue">{{ $lang['22'] ?? 'Group 2 Analysis' }}</p>
                                                <div class="overflow-auto mt-2">
                                                    {!! $detail["table1"] !!}
                                                </div>
                                                <div class="mt-4 space-y-2">
                                                    <p>\(\text{Variance } S_2^2 = \dfrac{\Sigma(x_i - \bar x)^2}{n - 1} = \dfrac{ {{ $detail['ar_sum1'] }} }{ {{ $detail['i1'] }} - 1} = {{ $detail['v1'] }}\)</p>
                                                    <p>\(\text{Standard Deviation } S_2 = \sqrt{ {{ $detail['v1'] }} } = {{ $detail['vsqrt1'] }}\)</p>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 p-4 rounded-lg space-y-4 overflow-auto">
                                                <p class="font-semibold">Final Pooled Variance Calculation:</p>
                                                <p>\(S_p^2 = \dfrac{(n_1 -1)S_1^2 + (n_2 - 1)S_2^2}{n_1 + n_2 - 2}\)</p>
                                                <p>\(S_p^2 = \dfrac{({{ $detail['i'] }} - 1)({{ round($detail['vsqrt'], 4) }})^2 + ({{ $detail['i1'] }} - 1)({{ round($detail['vsqrt1'], 4) }})^2}{ {{ $detail['i'] }} + {{ $detail['i1'] }} - 2 }\)</p>
                                                <p>\(S_p^2 = {{ $detail['pvres'] }}\)</p>
                                                <p>\(S_p = \sqrt{ {{ $detail['pvres'] }} } = {{ $detail['sqrpvres'] }}\)</p>
                                                <p>\(SE = S_p \sqrt{\dfrac{1}{n_1} + \dfrac{1}{n_2}} = {{ $detail['seres'] }}\)</p>
                                            </div>
                                        </div>
                                    @endif
                                @elseif ($detail['type'] == 'unequal')
                                    <div class="text-center">
                                        <p class="text-[18px] bg-sky px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-blue">{{ $lang['23'] ?? 'Unequal Variances Analysis' }}</strong>
                                        </p>
                                    </div>
                                    @if ($option == 'sum')
                                        <p class="w-full mt-2 text-[18px] text-blue">{{ $lang['10'] ?? 'Result Summary' }}</p>
                                        <div class="w-full lg:w-[50%] mt-2 overflow-auto">
                                            <table class="w-full">
                                                <tr>
                                                    <td class="py-2 border-b">{{ $lang["12"] ?? 'Standard Error' }}</td>
                                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['seround'] }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b">{{ $lang["24"] ?? 'Adjusted Df' }}</td>
                                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['devs1sm'] }}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="mt-6 space-y-4 overflow-auto">
                                            <p class="text-[18px] font-semibold">Standard Error:</p>
                                            <p>\(SE = \sqrt{\dfrac{S_1^2}{n_1} + \dfrac{S_2^2}{n_2}} = \sqrt{\dfrac{({{ $detail['s1'] }})^2}{ {{ $detail['n1'] }} } + \dfrac{({{ $detail['s2'] }})^2}{ {{ $detail['n2'] }} }} = {{ $detail['seround'] }}\)</p>
                                            <p class="text-[18px] font-semibold mt-4">Degree of Freedom (Satterthwaite approximation):</p>
                                            <p>\(df = \dfrac{(\dfrac{S_1^2}{n_1} + \dfrac{S_2^2}{n_2})^2}{\dfrac{S_1^4}{n_1^2(n_1-1)} + \dfrac{S_2^4}{n_2^2(n_2-1)}} = {{ $detail['devs1sm'] }}\)</p>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <p class="text-[18px] bg-sky px-3 py-2 rounded-lg d-inline-block my-3">
                                                <strong class="text-blue">{{ $lang['23'] ?? 'Unequal Variances Analysis' }}</strong>
                                            </p>
                                        </div>
                                        <div class="w-full lg:w-[50%] mt-2 overflow-auto">
                                            <table class="w-full">
                                                <tr>
                                                    <td class="py-2 border-b">{{ $lang["12"] ?? 'Standard Error' }}</td>
                                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['sqrresdev'] }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b">{{ $lang["24"] ?? 'Adjusted Df' }}</td>
                                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['dftres'] }}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="mt-6 space-y-6 overflow-auto">
                                            <div>
                                                <p class="font-semibold">Calculated Group Statistics:</p>
                                                <p>\(S_1^2 = {{ $detail['v'] }} \text{, } S_2^2 = {{ $detail['v1'] }}\)</p>
                                            </div>
                                            <div class="space-y-4">
                                                <p>\(SE = \sqrt{\dfrac{S_1^2}{n_1} + \dfrac{S_2^2}{n_2}} = \sqrt{\dfrac{ {{ $detail['s12'] }} }{ {{ $detail['i'] }} } + \dfrac{ {{ $detail['s22'] }} }{ {{ $detail['i1'] }} }} = {{ $detail['sqrresdev'] }}\)</p>
                                                <p>\(df = \dfrac{(\dfrac{S_1^2}{n_1} + \dfrac{S_2^2}{n_2})^2}{\dfrac{S_1^4}{n_1^2(n_1-1)} + \dfrac{S_2^4}{n_2^2(n_2-1)}} = {{ $detail['dftres'] }}\)</p>
                                            </div>
                                        </div>
                                    @endif
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
                setTimeout(() => {
                    window.MJrerender();
                }, 100);
            });
        });
    </script>
@endpush
