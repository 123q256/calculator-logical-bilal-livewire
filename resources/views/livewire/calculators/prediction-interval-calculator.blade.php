<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="x" class="font-s-14 text-blue">{{ $lang['1'] }} ({{ $lang['2'] }})</label>
                        <div class="w-full py-2">
                            <textarea wire:model.live="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 3, 5, 2, 4, 4, 1, 5, 4, 6, 2, 2, 3, 1, 2, 3"></textarea>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="y" class="font-s-14 text-blue">{{ $lang['3'] }} ({{ $lang['2'] }})</label>
                        <div class="w-full py-2">
                            <textarea wire:model.live="y" id="y" class="textareaInput" aria-label="input" placeholder="e.g. 80, 94, 81, 87, 86, 67, 90, 91, 95, 77, 74, 81, 66, 75, 79"></textarea>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="confidence" class="font-s-14 text-blue">{{ $lang['4'] }} (Ex: 0.95):</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live="confidence" id="confidence" class="input" aria-label="input" step="0.01" min="0" max="1" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="prediction" class="font-s-14 text-blue">X {{ $lang['5'] }} X₀ (Ex: 3):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="prediction" id="prediction" class="input" aria-label="input" />
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
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-5">
                            <div class="w-full">
                                <div class="text-center">
                                    <p class="font-s-18">
                                        <strong>{{ $lang['6'] }}</strong>
                                    </p>
                                    <div class="flex justify-center">
                                        <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">({{ $detail['piPov'] }} , {{ $detail['piNeg'] }})</strong>
                                        </p>
                                    </div>
                                </div>
                                
                                <p class="w-full mt-3 font-s-18 text-blue">{{ $lang['34'] }}</p>
                                <p class="w-full mt-2">{{ $lang['7'] }}:</p>
                                <div class="w-full mt-2 overflow-auto">
                                    <table class="w-full" style="border-collapse: collapse">
                                        <tr class="bg-gray-100">
                                            <td class="p-2 text-center border text-blue">Obs.</td>
                                            <td class="p-2 text-center border text-blue">X</td>
                                            <td class="p-2 text-center border text-blue">Y</td>
                                        </tr>
                                        @for ($i = 0; $i < $detail['array_num']; $i++)
                                            <tr class="bg-white">
                                                <td class="p-2 text-center border">{{ $i + 1 }}</td>
                                                <td class="p-2 text-center border">{{ $detail['array_x'][$i] }}</td>
                                                <td class="p-2 text-center border">{{ $detail['array_y'][$i] }}</td>
                                            </tr>
                                        @endfor
                                    </table>
                                </div>

                                <p class="w-full mt-3 text-blue font-s-18">{{ $lang['8'] }}</p>
                                <p class="w-full mt-2">{{ $lang['9'] }}:</p>
                                <div class="w-full mt-2 overflow-auto">
                                    <table class="w-full" style="border-collapse: collapse">
                                        <tr class="bg-gray-100">
                                            <td class="p-2 border text-blue text-center">Obs.</td>
                                            <td class="p-2 border text-blue text-center">X</td>
                                            <td class="p-2 border text-blue text-center">Y</td>
                                            <td class="p-2 border text-blue text-center">Xᵢ²</td>
                                            <td class="p-2 border text-blue text-center">Yᵢ²</td>
                                            <td class="p-2 border text-blue text-center">Xᵢ &middot; Yᵢ</td>
                                        </tr>
                                        @for ($i = 0; $i < $detail['array_num']; $i++)
                                            <tr class="bg-white">
                                                <td class="p-2 border text-center">{{ $i + 1 }}</td>
                                                <td class="p-2 border text-center">{{ $detail['array_x'][$i] }}</td>
                                                <td class="p-2 border text-center">{{ $detail['array_y'][$i] }}</td>
                                                <td class="p-2 border text-center">{{ $detail['x_sqr'][$i] }}</td>
                                                <td class="p-2 border text-center">{{ $detail['y_sqr'][$i] }}</td>
                                                <td class="p-2 border text-center">{{ $detail['x_mul_y'][$i] }}</td>
                                            </tr>
                                        @endfor
                                        <tr class="bg-gray-100">
                                            <td class="text-blue p-2 border text-center">Sum =</td>
                                            <td class="text-blue p-2 border text-center">{{ $detail['x_sum'] }}</td>
                                            <td class="text-blue p-2 border text-center">{{ $detail['y_sum'] }}</td>
                                            <td class="text-blue p-2 border text-center">{{ $detail['x_sqr_sum'] }}</td>
                                            <td class="text-blue p-2 border text-center">{{ $detail['y_sqr_sum'] }}</td>
                                            <td class="text-blue p-2 border text-center">{{ $detail['xy_sum'] }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="p-2 mt-2">
                                    <p class="w-full mt-3 text-center text-[20px]"><strong>Step by Step Solution</strong></p>
                                    
                                    <p class="w-full mt-3">{{ $lang['10'] }}:</p>
                                    <p class="w-full overflow-auto">$$ SS_{XX} = \sum^n_{i=1}X_i^2 - \dfrac{1}{n} \left(\sum^n_{i=1}X_i \right)^2 = {{ $detail['x_sqr_sum'] }} - \dfrac{1}{ {{ $detail['array_num'] }} } ({{ $detail['x_sum'] }})^2 = {{ $detail['ssxx'] }} $$</p>

                                    <p class="w-full overflow-auto">$$ SS_{YY} = \sum^n_{i=1}Y_i^2 - \dfrac{1}{n} \left(\sum^n_{i=1}Y_i \right)^2 = {{ $detail['y_sqr_sum'] }} - \dfrac{1}{ {{ $detail['array_num'] }} } ({{ $detail['y_sum'] }})^2 = {{ $detail['ssyy'] }} $$</p>

                                    <p class="w-full overflow-auto">$$ SS_{XY} = \sum^n_{i=1}{X_iY_i} - \dfrac{1}{n} \left(\sum^n_{i=1}X_i \right) \left(\sum^n_{i=1}Y_i \right) = {{ $detail['xy_sum'] }} - \dfrac{1}{ {{ $detail['array_num'] }} } ({{ $detail['x_sum'] }}) ({{ $detail['y_sum'] }}) = {{ $detail['ssxy'] }} $$</p>

                                    <p class="w-full mt-3">{{ $lang['11'] }}:</p>
                                    <p class="w-full overflow-auto">$$ \hat{\beta}_1 = \dfrac{SS_{XY}}{SS_{XX}} = \dfrac{ {{ $detail['ssxy'] }} }{ {{ $detail['ssxx'] }} } = {{ $detail['b1'] }} $$</p>

                                    <p class="w-full overflow-auto">$$ \hat{\beta}_0 = \bar{Y} - \hat{\beta}_1 \times \bar{X} = {{ $detail['mean_y'] }} - {{ $detail['b1'] }} \times {{ $detail['mean_x'] }} = {{ $detail['b0'] }} $$</p>

                                    <p class="w-full mt-3">{{ $lang['12'] }}:</p>
                                    <p class="w-full overflow-auto">$$ \hat{Y} = \hat{\beta}_0 + \hat{\beta}_1 \times X $$</p>

                                    <p class="w-full mt-3">{{ $lang['13'] }} X={{ $detail['prediction'] }}, {{ $lang['14'] }} X={{ $detail['prediction'] }} {{ $lang['15'] }}:</p>
                                    <p class="w-full overflow-auto">$$ \hat{Y} = {{ $detail['b0'] }} + {{ $detail['b1'] }} \times {{ $detail['prediction'] }} = {{ $detail['Y'] }} $$</p>

                                    <p class="w-full mt-3">{{ $lang['16'] }} {{ $detail['confidence_per'] }} {{ $lang['17'] }}:</p>
                                    <p class="w-full text-blue font-s-16">
                                        Y = {{ $detail['Y'] }} {{ $lang['18'] }} {{ $detail['confidence_per'] }} {{ $lang['19'] }} {{ $lang['20'] }}
                                    </p>

                                    <p class="w-full mt-3">{{ $lang['21'] }}:</p>
                                    <p class="w-full overflow-auto">$$ SS_{Total} = SS_{YY} = {{ $detail['ssyy'] }} $$</p>

                                    <p class="w-full mt-3">{{ $lang['22'] }}:</p>
                                    <p class="w-full overflow-auto">$$ SS_{Regression} = \hat{\beta}_1 \times SS_{XY} = {{ $detail['b1'] }} \times {{ $detail['ssxy'] }} = {{ $detail['ssRegression'] }} $$</p>

                                    <p class="w-full mt-3">{{ $lang['23'] }}: $$ SS_{Total} = SS_{Regression} + SS_{Error} $$</p>
                                    <p class="w-full mt-3">{{ $lang['24'] }}: $$ SS_{Error} = SS_{Total} - SS_{Regression} = {{ $detail['ssyy'] }} - {{ $detail['ssRegression'] }} = {{ $detail['ssError'] }} $$</p>

                                    <p class="w-full mt-3">{{ $lang['25'] }}:</p>
                                    <p class="w-full overflow-auto">$$ MSE = \dfrac{SS_{Error}}{n - 2} = \dfrac{ {{ $detail['ssError'] }} }{ {{ $detail['array_num'] }} - 2 } = {{ $detail['mse'] }} $$</p>

                                    <p class="w-full mt-3">{{ $lang['26'] }}:</p>
                                    <p class="w-full overflow-auto">$$ \hat{\sigma} = \sqrt{MSE} = \sqrt{ {{ $detail['mse'] }} } = {{ $detail['errorEst'] }} $$</p>

                                    <p class="w-full mt-3">
                                        {{ $lang['27'] }} {{ $detail['confidence_per'] }} {{ $lang['28'] }} {{ $detail['Y'] }}, {{ $lang['29'] }} {{ $detail['level'] }}.
                                        {{ $lang['30'] }} df = n − 2 = {{ $detail['array_num'] }} - 2 = {{ $detail['array_num'] - 2 }} {{ $lang['31'] }} α = {{ $detail['level'] }} {{ $lang['32'] }} t = 2.16. 
                                    </p>
                                    <p class="w-full mt-3 text-blue font-s-18">{{ $lang['33'] }}</p>
                                    <p class="w-full overflow-auto">$$ E = t_{\alpha/2, n-2} \times \sqrt{ \hat{\sigma}^2 \left(1 + \dfrac{1}{n} + \dfrac{(X_0 - \bar{X})^2}{SS_{XX}} \right)} $$</p>
                                    <p class="w-full overflow-auto">$$ = 2.16 \times \sqrt{ {{ $detail['mse'] }} \left(1 + \dfrac{1}{ {{ $detail['array_num'] }} } + \dfrac{( {{ $detail['prediction'] }} - {{ $detail['mean_x'] }} )^2}{ {{ $detail['ssxx'] }} } \right)} = {{ $detail['E'] }} $$</p>

                                    <p class="w-full mt-3 text-blue font-s-18">{{ $lang['34'] }} {{ $detail['confidence_per'] }} {{ $lang['35'] }} Y = {{ $detail['Y'] }}</p>
                                    <p class="w-full overflow-auto">$$ PI = (\hat{Y} - E , \hat{Y} + E) = ({{ $detail['Y'] }} - {{ $detail['E'] }} , {{ $detail['Y'] }} + {{ $detail['E'] }}) = ({{ $detail['piNeg'] }} , {{ $detail['piPov'] }}) $$</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    @endpush
</div>
