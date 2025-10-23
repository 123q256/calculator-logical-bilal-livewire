<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="x" class="label">{{$lang[1]}} {{$lang[2]}}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="x" id="x" class="input" value="{{ isset($_POST['x'])?$_POST['x']:'x^2+3' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="x1" class="label">{{$lang[1]}} (x₁):</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x1" id="x1" class="input" value="{{ isset($_POST['x1'])?$_POST['x1']:'3' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="x2" class="label">{{$lang[1]}} (x₂):</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x2" id="x2" min="1" class="input" value="{{ isset($_POST['x2'])?$_POST['x2']:'4' }}" aria-label="input"/>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['5'] }}</strong></td>
                                    <td class="py-2 border-b">\( {{$detail['ans']}} \)</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-3"><strong>{{$lang['6']}}:</strong></p>
                            <p class="mt-3">{{$lang['3']}}:</p>
                            <p class="mt-3">\( f(x) = {{$detail['eq']}} \) {{$lang['4']}} = \( [{{$_POST['x1']}} , {{$_POST['x2']}}] \)</p>
                            <p class="mt-3">{{$lang['7']}}</p>
                            <p class="mt-3">\( \frac{f(b) - f(a)}{b - a} \)</p>
                            <p class="mt-3">{{$lang['8']}}</p>
                            <p class="mt-3">\( a = {{$_POST['x2']}}, b = {{$_POST['x1']}}, f(x) = {{(preg_match('/frac/',$detail['eq']))?'\) \(\space '.$detail['eq'].'\) \(':$detail['eq']}}\)</p>
                            <p class="mt-3">Step 1: Evaluate the Function for a and b</p>
                            <p class="mt-3">\(f(a) = f({{$_POST['x1']}}) = ({{preg_replace('/x/','('.$_POST['x1'].')',$detail['eq'])}}) = {{$detail['fx1']}}\)</p>
                            <p class="mt-3">\(f(b) = f({{$_POST['x2']}}) = ({{preg_replace('/x/','('.$_POST['x2'].')',$detail['eq'])}}) = {{$detail['fx2']}}\)</p>
                            <p class="mt-3">Step 2: Use the Average Rate of Change Formula</p>
                            <p class="mt-3">\( \frac{f(b) - f(a)}{b - a} = \frac{({{$detail['fx2']}}) - ({{$detail['fx1']}})}{{{$_POST['x2'].'-'.$_POST['x1']}}} \)</p>
                            <p class="mt-3">\( \frac{f(b) - f(a)}{b - a} = \frac{{{$detail['fx2']-$detail['fx1']}}}{{{$_POST['x2']-$_POST['x1']}}} \)</p>
                            <p class="mt-3">\( \frac{f(b) - f(a)}{b - a} = {{$detail['ans']}} \)</p>
                            <p class="mt-3">The average rate of change is = {{$detail['ans']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
    @endpush
</form>