<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-2   gap-4">
                    <div>
                        <p class="my-4 text-[16px] font-bold">{!! $lang['1'] !!}:</p>
                    <div class="grid grid-cols-1  gap-4">
                        <div class="space-y-2">
                            <input type="text" step="any" name="e1" id="e1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->e1)?request()->e1:'C' }}" />
                        </div>
                        <div class="space-y-2">
                            <input type="text" step="any" name="e2" id="e2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->e2)?request()->e2:'H' }}" />
                        </div>
                        <div class="space-y-2">
                            <input type="text" step="any" name="e3" id="e3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->e3)?request()->e3:'O' }}" />
                        </div>
                        <div class="space-y-2">
                            <input type="text" step="any" name="e4" id="e4" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->e4)?request()->e4:'P' }}" />
                        </div>
                        <div class="space-y-2">
                            <input type="text" step="any" name="e5" id="e5" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->e5)?request()->e5:'Fr' }}" />
                        </div>
                        <div class="space-y-2">
                            <input type="text" step="any" name="e6" id="e6" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->e6)?request()->e6:'Ba' }}" />
                        </div>
                    </div>
                </div>
                    <div>
                    <p class="my-4 text-[16px] font-bold">{!! $lang['2'] !!}:</p>
                    <div class="grid grid-cols-1   gap-4">
                        <div class="space-y-2">
                            <input type="number" step="any" name="m1" id="m1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->m1)?request()->m1:'40.00' }}" />
                        </div>
                        <div class="space-y-2">
                            <input type="number" step="any" name="m2" id="m2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->m2)?request()->m2:'6.67' }}" />
                        </div>
                        <div class="space-y-2">
                            <input type="number" step="any" name="m3" id="m3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->m3)?request()->m3:'53.3' }}" />
                        </div>
                        <div class="space-y-2">
                            <input type="number" step="any" name="m4" id="m4" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->m4)?request()->m4:'40.00' }}" />
                        </div>
                        <div class="space-y-2">
                            <input type="number" step="any" name="m5" id="m5" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->m5)?request()->m5:'6.67' }}" />
                        </div>
                        <div class="space-y-2">
                            <input type="number" step="any" name="m6" id="m6" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->m6)?request()->m6:'137.33' }}" />
                        </div>
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
                <div class="w-full  p-3 radius-10 mt-3">
                    <div class="w-full  mt-2">
                        <div class="bg-sky border radius-10 px-3 py-2">
                            <strong>{{ $lang['3'] }} =</strong>
                            <strong class="text-[#119154] text-[28px]">{!! $detail['formula'] !!}</strong>
                        </div>
                        <p class="font-s-20 px-2 mt-3"><strong>Solution</strong></p>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                            <table class="col-12" cellspaing="0">
                                <tr id="s1Ans">
                                    <td class="border-b p-2">{{ $lang['1'] }}</td>
                                    {!! $detail['s1'] !!}
                                </tr>
                                <tr id="s2Ans">
                                    <td class="border-b p-2">{{ $lang['4'] }}</td>
                                    {!! $detail['s2'] !!}
                                </tr>
                                <tr id="s3Ans">
                                    <td class="border-b p-2">{{ $lang['5'] }}</td>
                                    {!! $detail['s3'] !!}
                                </tr>
                                <tr id="s4Ans">
                                    <td class="border-b p-2">{{ $lang['5'] }}</td>
                                    {!! $detail['s4'] !!}
                                </tr>
                                <tr id="s5Ans">
                                    <td class="border-b p-2">{{ $lang['6'] }}</td>
                                    {!! $detail['s5'] !!}
                                </tr>
                                <tr id="s6Ans">
                                    <td class="border-b p-2">{{ $lang['7'] }}</td>
                                    {!! $detail['s6'] !!}
                                </tr>
                                <tr>
                                    <td class="p-2">{{ $lang['3'] }}</td>
                                    <td id="defineColspan"><strong class="text-green">{!! $detail['formula'] !!}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            @if(isset($detail))
                function loadMathJax(){
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
            @endif
        </script>
    @endpush
</form>