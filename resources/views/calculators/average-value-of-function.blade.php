<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="fun" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="w-100 py-2">
                    <input type="text" name="fun" id="fun" class="input" value="{{ isset($_POST['fun']) ? $_POST['fun'] : 'x^2 + 3x' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="lb" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="lb" id="lb" class="input" value="{{ isset($_POST['lb']) ? $_POST['lb'] : '2' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="ub" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="ub" id="ub" class="input" value="{{ isset($_POST['ub']) ? $_POST['ub'] : '3' }}" aria-label="input" />
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
                            <div class="col-12 text-[16px]">
                                <p class="mt-3 text-[18px]">\( \int_{ {{$_POST['lb'].'}^{'.$_POST['ub']}} } {{$detail['sim']}}\, d{{$detail['with']}} = {{$detail['ans']}} \)</p>
                                <p class="mt-3"><strong>{{$lang['5']}}:</strong></p>
                                <p class="mt-3">{{$lang[6]}} \({{$detail['input']}}\) {{$lang[7]}} \( \left[{{$_POST['lb']}},{{$_POST['ub']}}\right]\)</p>
                                <p class="mt-3">{{$lang[8]}} \(f(x)\) {{$lang[7]}} \([a,b]\) is \( \bar{f}= \frac{1}{b-a} \int_a^b f \left( x \right) d x \)</p>
                                <p class="mt-3">{{$lang[9]}} \( L = \frac{1}{\left( {{$_POST['ub']}} \right)-\left( {{$_POST['lb']}} \right)}\int_{ {{$_POST['lb']}} }^{ {{$_POST['ub']}} } {{$detail['input']}} d{{$detail['with']}} = \int_{ {{$_POST['lb']}} }^{ {{$_POST['ub']}} } {{$detail['sim']}}d{{$detail['with']}}\)</p>
                                <p class="mt-3">
                                    {{$lang[10]}}:
                                    <a href="https://technical-calculator/{{'integral-calculator/?res_link=0&EnterEq=('.$_POST['fun'].')/'.$detail['divide'].'&ub='.$_POST['ub'].'&lb='.$_POST['lb'].'&with='.$detail['with'].'&form=def'}}" class="text-blue" target="_blank">{{$lang[11]}}</a>
                                </p>
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