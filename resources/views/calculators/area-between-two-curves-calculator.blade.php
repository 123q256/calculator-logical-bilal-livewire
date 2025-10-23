<style>

.res_step ol {
    list-style-type: decimal;
    border-left: 1px solid #FF8080;
    padding: 0 30px;
}
.res_step ol ol {
    list-style-type: upper-alpha;
    border-left: 1px solid #92D169;
}

    </style>

<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       @php $request = request(); @endphp
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="EnterEq1" class="label">{{$lang['1']}}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="EnterEq1" id="EnterEq1" class="input" value="{{ isset($request->EnterEq1)?$request->EnterEq1:'6x+x^3' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="EnterEq2" class="label">{{$lang['2']}}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="EnterEq2" id="EnterEq2" class="input" value="{{ isset($request->EnterEq2)?$request->EnterEq2:'6x + 4' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="upper" class="label">{{$lang['3']}}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="upper" id="upper" class="input" value="{{ isset($request->upper)?$request->upper:'3' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="lower" class="label">{{$lang['4']}}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="lower" id="lower" class="input" value="{{ isset($request->lower)?$request->lower:'1' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="with" class="label">W.R.T:</label>
                    <div class="w-full py-2">
                        <select name="with" class="input" id="with" aria-label="select">
                            <option value="x">x</option>
                            <option value="y" {{ isset($request->with) && $request->with=='y'?'selected':'' }}>y</option>
                        </select>
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
                                    $EnterEq= $request->EnterEq;
                                    $ub= $request->ub;
                                    $lb= $request->lb;
                                    $with= $request->with;
                                @endphp
                                <div class="w-full text-[16px]">
                                    <p class="mt-3 text-[18px]"><strong>{{$lang['6']}}</strong></p>
                                    <p class="mt-3">=\( {{$detail['ans']}} \)</p>
                                    <p class="mt-3"> = {{$detail['ans1']}}</p>
                                    <p class="mt-3 text-[18px]"><strong>{{$lang['5']}}</strong></p>
                                    <p class="mt-3">\( \int_{ {{$detail['lb'].'}^{'.$detail['ub']}} } {{$detail['enter']}}\, d{{$detail['with']}} \)</p>
                                    <p class="mt-3"><strong>{{$lang['7']}}</strong></p>
                                    <div class="w-full res_step">
                                        <p class="mt-3">{!!$detail['steps']!!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        @if (isset($detail))
            <script>
                function loadMathJax() {
                    var mathJaxScript = document.createElement('script');
                    mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                    document.querySelector('head').appendChild(mathJaxScript);
                
                    var mathJaxConfigScript = document.createElement('script');
                    mathJaxConfigScript.type = "text/x-mathjax-config";
                    mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                    document.querySelector('head').appendChild(mathJaxConfigScript);
                }
                
                window.addEventListener('load', function () {
                    loadMathJax();
                });
            </script>
        @endif
    @endpush
</form>