<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
            <div class="col-span-12">
                <label for="set" class="font-s-14 text-blue">{{ $lang['1'] }} (,):</label>
                <div class="w-100 py-2">
                    <textarea name="set" id="set" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54
55 99 85
5
6"></textarea>
                </div>
            </div>
            <div class="col-span-12 text-center flex items-center justify-between">
                <div class="d-flex align-items-center">
                    @if (isset($_POST['cal_meth']))
                        @if ($_POST['cal_meth']=='sample')
                            <input name="cal_meth" id="cal_meth" class="cursor-pointer" value="sample" type="radio" checked />
                        @else
                            <input name="cal_meth" id="cal_meth" class="cursor-pointer" value="sample" type="radio" />
                        @endif
                    @else
                        <input name="cal_meth" id="cal_meth" value="sample" type="radio" checked />
                    @endif
                    <label for="cal_meth" class="font-s-14 text-blue cursor-pointer pe-lg-3 px-1">{{ $lang['2'] }}</label>
                    @if (isset($_POST['cal_meth']) && $_POST['cal_meth']=='population')
                        <input name="cal_meth" id="cal_meth1" class="cursor-pointer" value="population" type="radio" checked />
                    @else
                        <input name="cal_meth" id="cal_meth1" class="cursor-pointer" value="population" type="radio" />
                    @endif
                    <label for="cal_meth1" class="font-s-14 text-blue  cursor-pointer ps-1">{{ $lang['3'] }}</label>
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
                            $cal_meth = $detail['cal_meth'];
                            if($cal_meth==="population"){
                                $sdSym = "σ";
                                $mSym = "μ";
                            }else{
                                $sdSym = "s";
                                $mSym = "x̄";
                            }
                            $var=$detail['var'];
                            $mean=$detail['mean'];
                            $s_d=$detail['s_d'];
                            $c_v=$detail['c_v'];
                            $t_n=$detail['t_n'];
                            $sum=$detail['sum'];
                            $table=$detail['table'];
                            $ss=$detail['ss'];
                        @endphp
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$lang['4']}} ({{ $sdSym }}²)</strong></p>
                        <div class="flex justify-center">
                            <p class="text-[25px] w-auto bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-white">{{ $var }}</strong>
                            </p>
                        </div>
                    </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["5"] }} ({{ $sdSym }})</td>
                                    <td class="p-2 border-b"><b>{{ $s_d }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["6"] }} (n)</td>
                                    <td class="p-2 border-b"><b>{{ $t_n }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["7"] }} (Σx)</td>
                                    <td class="p-2 border-b"><b>{{ $sum }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["8"] }} ({{ $mSym }})</td>
                                    <td class="p-2 border-b"><b>{{ $mean }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["9"] }}</td>
                                    <td class="p-2 border-b"><b>{{ $c_v }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><p>{{ $lang["10"] }} (SS)</td>
                                    <td class="p-2 border-b"><b>{{ $ss }}</b></td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-3 font-s-20"><strong class="text-blue">{{$lang['11']}}:</strong></p>
                        <p class="w-full mt-2 font-s-18"><strong><?=$lang['12']?> (<?=$sdSym?>²)</strong></p>
                        <p class="w-full mt-2">
                            <?php if($cal_meth==="population"){ ?>
                                \[ <?=$sdSym?>^2 = \dfrac{\sum_{i=1}^{n}(x_i - \mu)^{2}}{n} \]
                            <?php }else{ ?>
                                \[ <?=$sdSym?>^2 = \dfrac{\sum_{i=1}^{n}(x_i - \bar{X})^{2}}{n - 1} \]
                            <?php } ?>
                        </p>
                        <p class="w-full mt-2"><strong><?=$lang['13']?> (<?=$sdSym?>²) <?=$lang['14']?> (Σ(x)) <?=$lang['15']?> (SS)</strong></p>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            <?=$table?>
                        </div>
                        <p class="w-full mt-2">
                            <?php if ($cal_meth==="population"){ ?>
                                \[ <?=$sdSym?>^2 = \dfrac{SS}{n} \]
                                \[ <?=$sdSym?>^2 = \dfrac{<?=$ss?>}{<?=$t_n?>} \]
                                \[ <?=$sdSym?>^2 = <?=($ss / $t_n)?> \]
                            <?php }else{ ?>
                                \[ <?=$sdSym?>^2 = \dfrac{SS}{n - 1} \]
                                \[ <?=$sdSym?>^2 = \dfrac{<?=$ss?>}{<?=($t_n - 1)?>} \]
                                \[ <?=$sdSym?>^2 = <?=($ss / ($t_n - 1))?> \]
                            <?php } ?>
                        </p>
                        <p class="w-full mt-2"><strong><?=$lang['16']?> (<?=$sdSym?>)</strong></p>
                        <p class="w-full mt-2">
                        <?php if ($cal_meth==="population"){ ?>
                            \[ <?=$sdSym?> = \sqrt{<?=$sdSym?>^2} \]
                            \[ <?=$sdSym?> = \sqrt{<?=($ss / $t_n)?>} \]
                            \[ <?=$sdSym?> = <?=round(sqrt($ss / $t_n),4)?> \]
                        <?php }else{ ?>
                            \[ <?=$sdSym?> = \sqrt{<?=$sdSym?>^2} \]
                            \[ <?=$sdSym?> = \sqrt{<?=($ss / ($t_n - 1))?>} \]
                            \[ <?=$sdSym?> = <?=round(sqrt($ss / ($t_n - 1)),4)?> \]
                        <?php } ?>
                        </p>
                        <p class="w-full mt-2"><strong><?=$lang['17']?> (c)</strong></p>
                        <p class="w-full mt-2">
                        <?php if ($cal_meth==="population"){ ?>
                            \[ c = \dfrac{<?=$sdSym?>}{<?=$mSym?>} \]
                            \[ c = \dfrac{<?=$s_d?>}{<?=$mean?>} \]
                            \[ c = <?=$c_v?> \]
                        <?php }else{ ?>
                            \[ c = \dfrac{<?=$sdSym?>}{\overline{x}} \]
                            \[ c = \dfrac{<?=$s_d?>}{<?=$mean?>} \]
                            \[ c = <?=$c_v?> \]
                        <?php } ?>
                        </p>
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