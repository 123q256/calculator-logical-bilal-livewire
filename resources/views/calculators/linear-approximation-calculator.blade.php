<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="type" class="font-s-14 text-blue">{{ $lang['main'] }}:</label>
                    <div class="w-100 py-2">
                        <select class="input" aria-label="select" name="type" id="type">
                            <option value="1">{{$lang['1']}}: y=f(x)</option>
                            <option value="2" {{ isset($_POST['type']) && $_POST['type']=='2'?'selected':'' }}>{{$lang[2]}}: x=x(t), y=y(t)</option>
                            <option value="3" {{ isset($_POST['type']) && $_POST['type']=='3'?'selected':'' }}>{{$lang[3]}}: r=r(t)</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="EnterEq" class="font-s-14 text-blue" id="changeText1">
                        @if (isset($_POST['type']) && $_POST['type'] === '2')
                            {{$lang['4']}}: x(t)
                        @elseif (isset($_POST['type']) && $_POST['type'] === '3')
                            {{$lang['4']}}: r(t)
                        @else
                            {{$lang['4']}}: y = f(x)
                        @endif
                    </label>
                    <div class="w-100 py-2">
                        <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($_POST['type']) && ($_POST['type'] === '2' || $_POST['type'] === '3') ? ($_POST['EnterEq'] ?? 't^2 + 3t') : ($_POST['EnterEq'] ?? '2x^2+3x-12') }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 {{ isset($_POST['type']) && $_POST['type'] === '2' ? '':'hidden' }} sec_fun">
                    <label for="EnterEq1" class="font-s-14 text-blue">y(t) =</label>
                    <div class="w-100 py-2">
                        <input type="text" name="EnterEq1" id="EnterEq1" class="input" value="{{ isset($_POST['EnterEq1'])?$_POST['EnterEq1']:'2t' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="point" class="font-s-14 text-blue" id="changeText3">
                        @if (isset($_POST['type']) && ($_POST['type'] === '2' || $_POST['type'] === '3'))
                            t =
                        @else
                            {{$lang['5']}}: x₀
                        @endif
                    </label>
                    <div class="w-100 py-2">
                        <input type="text" name="point" id="point" class="input" value="{{ isset($_POST['point'])?$_POST['point']:'3' }}" aria-label="input"/>
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
                            @if($_POST['type'] === "1")
                                <div class="w-full text-[16ppx]">
                                    <p class="mt-2 text-[18px]"><strong>\(L(x) \approx {{$detail['res']}}\)</strong></p>
                                    <p class="mt-2"><strong>{{$lang['7']}}:</strong></p>
                                    <p class="mt-2">{{$lang['8']}} \( f(x)={{$detail['enter']}} \text{ at } x_0 = {{$_POST['point']}}\)</p>
                                    <p class="mt-2">{{$lang['9']}} \( L(x) \approx f(x_0) + f'(x_0)(x-x_0)  \)</p>
                                    <p class="mt-2">{{$lang['10']}}: \(y_0 = f(x_0) = {{$detail['fun']}}\)</p>
                                    <p class="mt-2">{{$lang['11']}}: \(f'(x) = {{$detail['deri']}}\)</p>
                                    <p class="mt-2">{{$lang['12']}}. <br> \(f'({{$_POST['point']}}) = {{$detail['simple']}}\)</p>
                                    <p class="mt-2">{{$lang['13']}}: <br> \( L(x) \approx {{$detail['fun']}} + {{$detail['simple']}}(x-({{$_POST['point']}}))  \)</p>
                                    <p class="mt-2">{{$lang['6']}}: \(L(x) \approx {{$detail['res']}}\)</p>
                                </div>
                            @elseif($_POST['type'] === "2")
                                <div class="w-full text-[16ppx]">
                                    <p class="mt-2 text-[18px]"><strong>\(L(x) \approx {{$detail['res']}}\)</strong></p>
                                    <p class="mt-2"><strong>{{$lang['7']}}:</strong></p>
                                    <p class="mt-2">{{$lang['8']}} \( x(t)={{$detail['enter']}} , y(t)={{$detail['enter1']}} \text{ at } x_0 = {{$_POST['point']}}\)</p>
                                    <p class="mt-2">{{$lang['9']}} \( L(x) \approx f(x_0) + \frac{dy}{dx}|_{x_0,y_0}(x-x_0)  \)</p>
                                    <p class="mt-2">{{$lang['14']}}  \(t\): <br> \( x_0 = {{$detail['fun']}} , y_0 = {{$detail['fun1']}}\)</p>
                                    <p class="mt-2">{{$lang['15']}}: \(\frac{dy}{dx}|_{t={{$_POST['point']}}}\)</p>
                                    <p class="mt-2">{{$lang['16']}}: \(\frac{dy}{dx}=\frac{\frac{dy}{dt}}{\frac{dx}{dt}}\)</p>
                                    <p class="mt-2">{{$lang['17']}} \(t\): \(\frac{dx}{dt} = {{$detail['deri']}}\)</p>
                                    <p class="mt-2">{{$lang['18']}} \(t\): \(\frac{dy}{dt} = {{$detail['deri1']}}\)</p>
                                    <p class="mt-2">{{$lang['19']}}: \(\frac{dy}{dx} = \frac{{{$detail['deri1']}}}{{{$detail['deri']}}}\)</p>
                                    <p class="mt-2">{{$lang['12']}}. <br> \(\frac{dy}{dx}|_{t={{$_POST['point']}}} = \frac{{{$detail['uper']}}}{{{$detail['lower']}}} = {{$detail['simple']}}\)</p>
                                    <p class="mt-2">{{$lang['13']}}: <br> \( L(x) \approx {{$detail['fun1']}} + \frac{{{$detail['uper']}}}{{{$detail['lower']}}}(x-({{$detail['fun']}}))  \)
                                    <br> \( L(x) \approx {{$detail['fun1']}} + {{$detail['simple']}}(x-({{$detail['fun']}}))  \)</p>
                                    <p class="mt-2">{{$lang['6']}}: \(L(x) \approx {{$detail['res']}}\)</p>
                                </div>
                            @else
                                <div class="w-full text-[16ppx]">
                                    <p class="mt-2 text-[18px]"><strong>\(L(x) \approx {{$detail['soc']}}x {{(($detail['final']>0)?'+':'')}} {{$detail['final']}}\)</strong></p>
                                    <p class="mt-2"><strong>{{$lang['7']}}:</strong></p>
                                    <p class="mt-2">{{$lang['8']}} \( r(t)={{$detail['enter']}} \text{ at } t = {{$_POST['point']}}\)</p>
                                    <p class="mt-2">{{$lang['9']}} \( L(x) \approx y_0 + \frac{dy}{dx}|_{x_0,y_0}(x-x_0)  \)</p>
                                    <p class="mt-2">{{$lang['10']}}: \(r({{$_POST['point']}}) = {{$detail['point']}}\)</p>
                                    <p class="mt-2">{{$lang['20']}}: <br> \( x_0=r({{$_POST['point']}}).cos({{$_POST['point']}}) = {{$detail['point']}}cos({{$_POST['point']}}) , y_0=r({{$_POST['point']}}).sin({{$_POST['point']}}) = {{$detail['point']}}sin({{$_POST['point']}})\)</p>
                                    <p class="mt-2">{{$lang['15']}}: \(\frac{dy}{dx}|_{t={{$_POST['point']}}}\)</p>
                                    <p class="mt-2">{{$lang['21']}}: \(\frac{dy}{dx}=\frac{\frac{dr}{dt}sin(t)+r.cos(t)}{\frac{dr}{dt}cos(t)-r.sin(t)}\)</p>
                                    <p class="mt-2">{{$lang['22']}} \(t\): \(\frac{dr}{dt} = {{$detail['deri']}}\)</p>
                                    <p class="mt-2">{{$lang['19']}}, \(\frac{dx}{dy}|_{t={{$_POST['point']}}} = \frac{({{$detail['deri']}})sin({{$_POST['point']}})+({{$detail['enter']}})cos({{$_POST['point']}})}{({{$detail['deri']}})cos({{$_POST['point']}})-({{$detail['enter']}})sin({{$_POST['point']}})}\)
                                        <br>
                                        \(=\frac{ {{$detail['fun_deri']}}sin({{$_POST['point']}})+{{$detail['point']}}cos({{$_POST['point']}})}{ {{$detail['fun_deri']}}cos({{$_POST['point']}})-{{$detail['point']}}sin({{$_POST['point']}})}\)
                                    </p>
                                    <p class="mt-2">{{$lang['13']}}: <br> \( L(x) \approx {{$detail['point'].'sin('.$_POST['point'].')'}} + \frac{ {{$detail['fun_deri']}}sin({{$_POST['point']}})+{{$detail['point']}}cos({{$_POST['point']}})}{ {{$detail['fun_deri']}}cos({{$_POST['point']}})-{{$detail['point']}}sin({{$_POST['point']}})}(x-({{$detail['point'].'cos('.$_POST['point'].')'}}))  \)</p>
                                    <p class="mt-2">{{$lang['6']}}: \(L(x) \approx {{$detail['soc']}}x {{(($detail['final']>0)?'+':'')}} {{$detail['final']}}\)</p>
                                </div>
                
                            @endif
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
        <script>
            document.getElementById('type').addEventListener('change', function() {
                if (this.value === "1") {
                    document.getElementById('changeText1').textContent = "{{$lang['4']}}: y = f(x)";
                    document.getElementById('changeText3').textContent = "{{$lang['5']}}: x₀";
                    document.getElementById('EnterEq').value = '2x^2+3x-12';
                    ['.sec_fun'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "2"){
                    document.getElementById('changeText1').textContent = "{{$lang['4']}}: x(t)";
                    document.getElementById('changeText3').textContent = 't =';
                    document.getElementById('EnterEq').value = 't^2 + 3t';
                    ['.sec_fun'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else{
                    document.getElementById('changeText1').textContent = "{{$lang['4']}}: r(t)";
                    document.getElementById('changeText3').textContent = 't =';
                    document.getElementById('EnterEq').value = 't^2 + 3t';
                    ['.sec_fun'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>