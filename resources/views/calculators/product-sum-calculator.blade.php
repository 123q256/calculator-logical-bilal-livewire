<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="product" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="w-100 py-2">
                    <input  type="number" step="any" name="product" id="product" class="input" value="{{ isset($_POST['product']) ? $_POST['product'] : '24' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="sum" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                <div class="w-100 py-2">
                    <input  type="number" step="any" name="sum" id="sum" class="input" value="{{ isset($_POST['sum']) ? $_POST['sum'] : '44' }}" aria-label="input" />
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
                            <div class="w-full  text-[16px]">
                                <p class="mt-3 text-[18px]"><strong>{{$detail['roots']}}</strong></p>
                                <p class="mt-3"><strong>{{$lang['4']}}:</strong></p>
                                <p class="mt-3">{{$lang[1]}}(x.y) = {{$_POST['product']}}</p>
                                <p class="mt-3">{{$lang[2]}}(x+y) = {{$_POST['sum']}}</p>
                                <p class="mt-3">y = {{$_POST['sum']}} - x</p>
                                <p class="mt-3">{{$lang[5]}} y in x.y = {{$_POST['product']}}</p>
                                <p class="mt-3">
                                    {{$lang[6]}}: \( {{$detail['a']}}x^2 {{(($detail['B']<0)?$detail['B']:' + '.$detail['B'])}}x {{(($detail['C']<0)?$detail['C']:' + '.$detail['C'])}} = 0 \)
                                </p>
                                <p class="mt-3">{{$lang[7]}}</p>
                                @php
                                    $inner1= 4 * $detail['a'] * $detail['C'];
                                    $inner=(pow($detail['B'], 2)) - $inner1;
                                    $inner2=round(sqrt($inner),4);
                                @endphp
                                <p class="mt-3">a = {{$detail['a']}}, b = {{$detail['B']}}, {{$lang[8]}} c = {{$detail['C']}}</p>
                                <p class="mt-3">
                                    \(
                                        x = \frac{ -b \pm \sqrt{b^2 - 4ac}}{ 2a }
                                    \)
                                </p>
                                <p class="mt-3">
                                    \(
                                        x = \frac{ {{(($detail['B']<0)?'- ('.$detail['B'].')':' - '.$detail['B'])}} \pm \sqrt{({{$detail['B']}})^2 - 4({{$detail['a']}})({{$detail['C']}})}}{ 2({{$detail['a']}}) }
                                    \)
                                </p>
                                <p class="mt-3">
                                    \(
                                        x = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} \pm \sqrt{ {{pow($detail['B'], 2)}} {{(($inner1<0)?' + '.$inner1 * (-1):' - '.$inner1)}} }}{ {{$detail['a'] * 2}} } 
                                    \)
                                </p>
                                <p class="mt-3">
                                    \(
                                        x = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} \pm \sqrt{ {{$inner}} }}{ {{$detail['a']*2}} }
                                    \)
                                </p>
                                @if($inner>0)
                                    <p class="mt-3"> b<sup class="font-s-14">2</sup>−4ac > 0 {{$lang[9]}}</p>
                                    <p class="mt-3">
                                        \(
                                            x₁ = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} + \sqrt{ {{$inner}} }}{ {{$detail['a']*2}} },x₁ = { {{(($detail['B'] * (-1)) + $inner2) / ($detail['a']*2)}} } 
                                        \)
                                    </p>
                                    <p class="mt-3">
                                        \(
                                            x₂ = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} - \sqrt{ {{$inner}} }}{ {{$detail['a']*2}} },x₂ = { {{(($detail['B'] * (-1)) - $inner2) / ($detail['a']*2)}} } 
                                        \)
                                    </p>
                                @endif
                                @if($inner<0)
                                    <p class="mt-3">b<sup class="font-s-14">2</sup>−4ac < 0 so, there are two complex roots.</p>
                                    <p class="mt-3">
                                        \(
                                            x₁ = \frac{ <?=(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])?> + \sqrt{<?=($inner * (-1))?>}\, i}{ <?=$detail['a']*2?> },x₁ = { <?=round(($detail['B'] * (-1) / ($detail['a']*2)),4)?>} + {{ <?=round(sqrt(($inner*(-1))) /($detail['a']*2),4)?> }}\,i} 
                                        \)
                                    </p>
                                    <p class="mt-3">
                                        \(
                                            x₂ = \frac{ <?=(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])?> - \sqrt{<?=($inner * (-1))?>}\, i}{ <?=$detail['a']*2?> },x₂ = { <?=round(($detail['B'] * (-1) / ($detail['a']*2)),4)?>} - {{ <?=round(sqrt(($inner*(-1))) /($detail['a']*2),4)?> }}\,i} 
                                        \)
                                    </p>
                                @endif
                                @if($inner==0)
                                    <p class="mt-3"><?=$lang['t_d']?> b<sup class="font-s-14">2</sup>−4ac = 0 so, there is one real root.</p>
                                    <p class="mt-3">
                                        \(
                                            x = \frac{ <?=(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])?>}{ <?=$detail['a']*2?> }
                                        \)
                                    </p>
                                    <p class="mt-3">\( { <?=$detail['roots']?> } \)</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({"SVG": {linebreaks: { automatic: true }} });
        </script>
    @endpush
</form>