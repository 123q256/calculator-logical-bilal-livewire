<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                
                <div class="col-span-12">
                    <label for="stdv_txt" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="w-100 py-2">
                        <textarea name="stdv_txt" id="stdv_txt" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54">{{ isset($_POST['stdv_txt'])?$_POST['stdv_txt']:'12, 23, 45, 33, 65, 54, 54' }}</textarea>
                    </div>
                </div>
                <div class="col-span-12 text-center flex items-center justify-between">
                    <div class="d-flex align-items-center">
                        @if (isset($_POST['stdv_rad']))
                            @if ($_POST['stdv_rad']=='sample')
                                <input name="stdv_rad" id="stdv_rad" value="sample" type="radio" checked />
                            @else
                                <input name="stdv_rad" id="stdv_rad" value="sample" type="radio" />
                            @endif
                        @else
                            <input name="stdv_rad" id="stdv_rad" value="sample" type="radio" checked />
                        @endif
                        <label for="stdv_rad" class="font-s-14 text-blue pe-lg-3 px-1">{{ $lang['2'] }}</label>
                        @if (isset($_POST['stdv_rad']) && $_POST['stdv_rad']=='population')
                            <input name="stdv_rad" id="stdv_rad1" value="population" type="radio" checked />
                        @else
                            <input name="stdv_rad" id="stdv_rad1" value="population" type="radio" />
                        @endif
                        <label for="stdv_rad1" class="font-s-14 text-blue ps-1">{{ $lang['3'] }}</label>
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
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
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
                            <p class="text-[20px]"><strong>{{$lang['4']}} {{ $sdSym }}</strong></p>
                        <div class="flex justify-center">
                            <p class="text-[25px] w-auto bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-blue">
                                    @if ($stdv_rad === "population")
                                            <?php echo round(sqrt($detail["ar_sum"] / $detail["t_n"]),4); ?>
                                    @else
                                        <?php echo round(sqrt($detail["ar_sum"] / ($detail["t_n"] - 1)),4); ?>
                                    @endif
                                </strong>
                            </p>
                        </div>
                    </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1   mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["5"] }} (n)</td>
                                    <td class="p-2 border-b"><b>{{ $detail["t_n"] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["6"] }} (Σx)</td>
                                    <td class="p-2 border-b"><b>{{ $detail["sum"] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["7"] }} ({{ $mSym }})</td>
                                    <td class="p-2 border-b"><b>{{ $detail["m"] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["8"] }} ({{ $sdSym }}²)</td>
                                    <td class="p-2 border-b"><b>{{ $detail["v_2"] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["9"] }}</td>
                                    <td class="p-2 border-b"><b>{{ $detail["c"] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["10"] }} (SE)</td>
                                    <td class="p-2 border-b"><b>{{ $detail["s_e"] }}</b></td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-2 font-s-20"><?php echo $lang["11"];?> :</p> 
                        <p class="col-12">
                            <?php
                                if ($stdv_rad === "population") {
                            ?>
                                    \[ <?php echo $sdSym; ?> = \sqrt{\dfrac{\sum_{i=1}^{n}(x_i - \mu)^{2}}{n}} \]
                            <?php
                                } else {
                            ?>
                                    \[ <?php echo $sdSym; ?> = \sqrt{\dfrac{\sum_{i=1}^{n}(x_i - \bar{X})^{2}}{n - 1}} \]
                            <?php
                                }
                            ?>
                        </p>
                        <div class="grid  grid-cols-1 mt-2 overflow-auto">
                            <?php echo $detail["table"]?>
                        </div>
                        <p class="w-full mt-2">
                            <?php
                                if ($stdv_rad === "population") {
                            ?>
                                \[ <?php echo $sdSym; ?> = \sqrt{\dfrac{SS}{n}} \]
                                \[ <?php echo $sdSym; ?> = \sqrt{\dfrac{<?php echo $detail["ar_sum"]?>}{<?php echo $detail["t_n"]; ?>}} \]
                                \[ <?php echo $sdSym; ?> = \sqrt{<?php echo ($detail["ar_sum"] / $detail["t_n"]); ?>} \]
                                \[ <?php echo $sdSym; ?> = <?php echo round(sqrt($detail["ar_sum"] / $detail["t_n"]),4); ?> \]
                            <?php
                                } else {
                            ?>
                                \[ <?php echo $sdSym; ?> = \sqrt{\dfrac{SS}{n - 1}} \]
                                \[ <?php echo $sdSym; ?> = \sqrt{\dfrac{<?php echo $detail["ar_sum"]?>}{<?php echo ($detail["t_n"] - 1); ?>}} \]
                                \[ <?php echo $sdSym; ?> = \sqrt{<?php echo ($detail["ar_sum"] / ($detail["t_n"] - 1)); ?>} \]
                                \[ <?php echo $sdSym; ?> = <?php echo round(sqrt($detail["ar_sum"] / ($detail["t_n"] - 1)),4); ?> \]
                            <?php
                                }
                            ?>
                        </p>
                        <p class="w-full font-s-20 mt-2"><strong>Margin of Error (Confidence Interval)</strong></p>
                        <p class="w-full mt-2">Normal distribution gives you an estimation about sampling mean. Consider the equation as under to compute standard error of mean (SEM):</p>
                        <p class="w-full font-s-18">σ<sub>x̄</sub> = \(\dfrac{σ}{\sqrt{N}} = <?=$detail['mor']?>\)</p>
                        <p class="w-full mt-2">Considering SEM, various confidence levels gives you different error margin estimations. As per the study field, 95% confidence level (significance level = 5%) is what we consider a standard for representing data.</p>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1  mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 border-b"><strong>Confidence Level</strong></td>
                                    <td class="py-2 border-b"><strong>Margin of Error</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">68.3%, σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b"><?=$detail['m']?> ± <?=round($detail['mor'],3)?> (±<?=round((sqrt($detail['put'])/sqrt($detail['i']))*100,2)?>%)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">90%, 1.645σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b"><?=$detail['m']?> ± <?=round($detail['mor']*1.645,3)?> (±<?=round(1.645*(sqrt($detail['put'])/sqrt($detail['i']))*100,2)?>%)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">95%, 1.960σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b"><?=$detail['m']?> ± <?=round($detail['mor']*1.960,3)?> (±<?=round(1.960*(sqrt($detail['put'])/sqrt($detail['i']))*100,2)?>%)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">99%, 2.576σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b"><?=$detail['m']?> ± <?=round($detail['mor']*2.576,3)?> (±<?=round(2.576*(sqrt($detail['put'])/sqrt($detail['i']))*100,2)?>%)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">99.99%, 3.891σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b"><?=$detail['m']?> ± <?=round($detail['mor']*3.891,3)?> (±<?=round(3.891*(sqrt($detail['put'])/sqrt($detail['i']))*100,2)?>%)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">99.999%, 4.417σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b"><?=$detail['m']?> ± <?=round($detail['mor']*4.417,3)?> (±<?=round(4.417*(sqrt($detail['put'])/sqrt($detail['i']))*100,2)?>%)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">99.9999%, 4.892σ<sub>x̄</sub></td>
                                    <td class="py-2 border-b"><?=$detail['m']?> ± <?=round($detail['mor']*4.892,3)?> (±<?=round(4.892*(sqrt($detail['put'])/sqrt($detail['i']))*100,2)?>%)</td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-3 font-s-20"><?php echo $lang["12"];?></p> 
                        <div class="col-lg-6 mt-2 overflow-auto">
                            <table class="w-100 text-center">
                                <tr>
                                    <th class="py-2 border-b"><?php echo $lang["13"];?></th>
                                    <th class="py-2 border-b"><?php echo $lang["14"];?></th>
                                </tr>
                                <?php echo $detail["tablef"]?>
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
    <script>
        @if (isset($detail))
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>