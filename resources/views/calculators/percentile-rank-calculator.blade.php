<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2 relative">
                    <label for="x" class="label">Data set (values separated by commas, maximum 50 values):</label>
                    <textarea name="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54">{{ isset($_POST['x'])?$_POST['x']:'12, 23, 45, 33, 65, 54, 54' }}</textarea>
                </div>
            </div>
            <div class="grid grid-cols-1  mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="find" class="label">Find percentile rank of:</label>
                    <input type="number" step="any" name="find" id="find" value="{{ isset($_POST['find'])?$_POST['find']:'13' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2">
                    <label for="method" class="label">Method:</label>
                    <select name="method" id="method" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["Method 1","Method 2"];
                            $val = [1,2];
                            optionsList($val,$name,isset($_POST['method'])?$_POST['method']:'1');
                        @endphp
                    </select>
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
                                $request = request();
                                $x=$request->x;
                                $find=$request->find;
                                $method=$request->method;
                            @endphp
                            <div class="text-center">
                                <p class="font-s-20">
                                    <strong>Percentile Rank of <?=$find?> is</strong>
                                </p>
                                <p class="my-3">
                                    <strong class="bg-[#2845F5] text-white text-[30px] rounded-lg px-3 py-2">{{ round($detail['pr']) }}%</strong>
                                </p>
                            </div>
                            <p class="col-12 mt-3 font-s-20">Solution:</p>
                            <p class="col-12 mt-2">As you are looking for the numbers that are equal or less than the value <strong><?=$find?></strong> and represents percentile of the data set, so we have:</p>
                            <p class="col-12 mt-2"> The first ever step to follow is to arrange the numbers in the ascending order which is as follows:</p>
                            <p class="col-12 mt-2">
                            <strong><?php 
                                foreach ($detail['values'] as $key => $value) {
                                if ($key==0) {
                                    echo $value;
                                } else {
                                    echo ', '.$value;
                                }
                                }
                            ?></strong>
                            </p>
                            <p class="col-12 mt-2">As you see that <strong><?=$detail['count']?></strong> values are less than the number <strong><?=$find?></strong>, so we calculate the percentile rank of <?=$find?> by following the formula as under:</p>
                            <?php if($method==1){ ?>
                                <p class="col-12 mt-3 text-center">$$\text{Percentile Rank = }(\frac{L}{N})\times(100)$$</p>
                            <?php }else{ ?>
                                <p class="col-12 mt-3 text-center">$$\text{Percentile Rank = }(\frac{L-0.5 \times S}{N})\times(100)$$</p>
                            <?php } ?>
                                <p class="col-12 mt-2">Where:</p>
                                <p class="col-12 mt-2">L = values less than or equal to <strong><?=$find?></strong></p>
                                <p class="col-12 mt-2">N = total number of values in the data set </p>
                            <?php if($method==1){ ?>
                                <p class="col-12 mt-2">So the percentile rank is:</p>
                                <p class="col-12 mt-3 text-center">$$\text{Percentile Rank = }(\frac{<?=$detail['count']?>}{<?=count($detail['values'])?>})(100)$$</p>
                                <p class="col-12 mt-3 text-center">$$\text{Percentile Rank = }(<?=$detail['count']/count($detail['values'])?>)(100)$$</p>
                            <?php }else{ ?>
                                <p class="col-12 mt-2">S = data values equal to data value of interest <strong><?=$find?></strong> </p>
                                <p class="col-12 mt-2">So the percentile rank is:</p>
                                <p class="col-12 mt-3 text-center">$$\text{Percentile Rank = }(\frac{<?=$detail['count']?>-0.6 \times <?=$detail['same']?>}{<?=count($detail['values'])?>})(100)$$</p>
                                <p class="col-12 mt-3 text-center">$$\text{Percentile Rank = }(\frac{<?=($detail['count']-0.6*$detail['same'])?>}{<?=count($detail['values'])?>})(100)$$</p>
                                <p class="col-12 mt-3 text-center">$$\text{Percentile Rank = }(<?=($detail['count']-0.6*$detail['same'])/count($detail['values'])?>)(100)$$</p>
                            <?php } ?>
                            <p class="col-12 mt-2">You must remember that percentile is always a whole number. That is why, multiply the fraction by 100 and round it off to the nearest whole number, which is:</p>
                            <p class="col-12 mt-2">$$\text{Percentile Rank = }<?=round($detail['pr'])?>%$$</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script>
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        </script>
    @endif
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>