<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['1'] }} ({{ $lang['2'] }})</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 10, 12, 11, 15, 11, 14, 13, 17, 12, 22, 14, 11">{{ isset($_POST['x'])?$_POST['x']:'10, 12, 11, 15, 11, 14, 13, 17, 12, 22, 14, 11' }}</textarea>
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
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['3'] }} (s)</strong></td>
                                    <td class="py-2 border-b">
                                        @php
                                            if (!empty($detail['poutlier'])) {
                                                for ($i=0; $i < count($detail['poutlier']) ; $i++) { 
                                                    if ($i==0) {
                                                        echo $detail['poutlier'][$i];
                                                    }else{
                                                        echo ', '.$detail['poutlier'][$i];
                                                    }
                                                }
                                            }else{
                                                echo "None";
                                            }
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['4'] }} (s)</strong></td>
                                    <td class="py-2 border-b">
                                        @php
                                            if (!empty($detail['outlier'])) {
                                                for ($i=0; $i < count($detail['outlier']) ; $i++) { 
                                                    if ($i==0) {
                                                        echo $detail['outlier'][$i];
                                                    }else{
                                                        echo ', '.$detail['outlier'][$i];
                                                    }
                                                }
                                            }else{
                                                echo "None";
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['5'] }} Q1</strong></td>
                                    <td class="py-2 border-b">{{$detail['first']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['5'] }} Q3</strong></td>
                                    <td class="py-2 border-b">{{$detail['third']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['6'] }} IQR</strong></td>
                                    <td class="py-2 border-b">{{$detail['inner']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                    <td class="py-2 border-b">{{$detail['median']}}</td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-3 text-[20px]"><strong class="text-blue"><?=$lang[8]?>:</strong></p>
                        <p class="w-full mt-2"><?=$lang[9]?>: 
                            <strong><?php 
                                for ($i=0; $i < count($detail['values']) ; $i++) { 
                                    if ($i==0) {
                                        echo $detail['values'][$i];
                                    }else{
                                        echo ', '.$detail['values'][$i];
                                    }
                                }
                                ?></strong></p>
                        <p class="w-full mt-2"><?=$lang[10]?>, IQR</p>
                        <p class="w-full mt-2">$$IQR = Q_3 - Q_3$$</p>
                        <p class="w-full mt-2">$$Q_1 = <?=$detail['first']?>$$</p>
                        <p class="w-full mt-2">$$Q_3 = <?=$detail['third']?>$$</p>
                        <p class="w-full mt-2">$$IQR = <?=$detail['third']?> - <?=$detail['first']?>$$</p>
                        <p class="w-full mt-2">$$IQR = <?=$detail['inner']?>$$</p>
                        <p class="w-full mt-2"><?=$lang[11]?>:</p>
                        <p class="w-full mt-2">$$Q1 - (1.5 \times IQR) \text{ <?=$lang[12]?> } Q3 + (1.5 \times IQR)$$</p>
                        <p class="w-full mt-2">$$<?=$detail['first']?> - (1.5 \times <?=$detail['inner']?>) \text{ <?=$lang[12]?> }  <?=$detail['third']?> + (1.5 \times <?=$detail['inner']?>)$$</p>
                        <p class="w-full mt-2">$$\text{<?=$lang[13]?>: } <?=$detail['in_f1']?> \text{ <?=$lang[12]?> } <?=$detail['in_f2']?>$$</p>
                        <p class="w-full mt-2"><?=$lang[14]?>:</p>
                        <p class="w-full mt-2">$$Q1 - (3 \times IQR) \text{ <?=$lang[12]?> } Q3 + (3 \times IQR)$$</p>
                        <p class="w-full mt-2">$$<?=$detail['first']?> - (3 \times <?=$detail['inner']?>) \text{ <?=$lang[12]?> }  <?=$detail['third']?> + (3 \times <?=$detail['inner']?>)$$</p>
                        <p class="w-full mt-2">$$\text{<?=$lang[15]?>: } <?=$detail['out_f1']?> \text{ and } <?=$detail['out_f2']?>$$</p>
                        <p class="w-full mt-2"><strong class="text-blue"><?=$lang[3]?>(s)</strong></p>
                        <p class="w-full mt-2"><strong>
                            <?php if (!empty($detail['poutlier'])) {
                                for ($i=0; $i < count($detail['poutlier']) ; $i++) { 
                                    if ($i==0) {
                                        echo $detail['poutlier'][$i];
                                    }else{
                                        echo ', '.$detail['poutlier'][$i];
                                    }
                                }
                            }else{
                                echo "None";
                            } ?>
                        </strong></p>
                        <p class="w-full mt-2"><strong class="text-blue"><?=$lang[4]?>(s)</strong></p>
                        <p class="w-full mt-2"><strong>
                            <?php if (!empty($detail['outlier'])) {
                                for ($i=0; $i < count($detail['outlier']) ; $i++) { 
                                    if ($i==0) {
                                        echo $detail['outlier'][$i];
                                    }else{
                                        echo ', '.$detail['outlier'][$i];
                                    }
                                }
                            }else{
                                echo "None";
                            } ?>
                        </strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script>
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        </script>
    @endif
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>