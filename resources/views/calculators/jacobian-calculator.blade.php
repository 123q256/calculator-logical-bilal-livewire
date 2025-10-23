<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @php $request = request(); @endphp
           <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
            <input type="hidden" name="type" value="{{ isset($request->type) && $request->type === 'three' ? 'three':'two' }}" id="type">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tab {{ isset($request->type) && $request->type === 'three' ? '':'tagsUnit' }}" id="imperial" data-value="two">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab {{ isset($request->type) && $request->type === 'three' ? 'tagsUnit':'' }}" id="type" data-value="three">
                            {{ $lang['2'] }}
                    </div>
                </div>
            </div>
        </div>

            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 mt-4">
                    <div class="col-span-3">
                        <div class="w-full py-2">
                            <select name="xu_var" class="input" id="xu_var" aria-label="select">
                                <option value="u">x</option>
                                <option value="x" {{ isset($request->xu_var) && $request->xu_var == 'x' ? 'selected' : '' }}>x</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-1 text-[18px] my-auto text-center">
                        <p class="py-2"><strong>=</strong></p>
                    </div>
                    <div class="col-span-8">
                        <div class="w-full py-2">
                            <input type="text" name="xu" id="xu" class="input" value="{{ isset($request->xu)?$request->xu:'u^2-v^3' }}" aria-label="input"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12">
                <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 ">
                    <div class="col-span-3">
                        <div class="w-full py-2">
                            <select name="yv_var" class="input" id="yv_var" aria-label="select">
                                <option value="v">y</option>
                                <option value="y" {{ isset($request->yv_var) && $request->yv_var == 'y' ? 'selected' : '' }}>v</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-1 text-[18px] my-auto text-center">
                        <p class="py-2"><strong>=</strong></p>
                    </div>
                    <div class="col-span-8">
                        <div class="w-full py-2">
                            <input type="text" name="yv" id="yv" class="input" value="{{ isset($request->yv)?$request->yv:'u^2+v^3' }}" aria-label="input"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 {{ isset($request->type) && $request->type === 'three' ? '':'hidden' }}" id="zwInput">
                <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 ">
                    <div class="col-span-3">
                        <div class="w-full py-2">
                            <select name="zw_var" class="input" id="zw_var" aria-label="select">
                                <option value="w">z</option>
                                <option value="z" {{ isset($request->zw_var) && $request->zw_var == 'z' ? 'selected' : '' }}>w</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-1 text-[18px] my-auto text-center">
                        <p class="py-2"><strong>=</strong></p>
                    </div>
                    <div class="col-span-8">
                        <div class="w-full py-2">
                            <input type="text" name="zw" id="zw" class="input" value="{{ isset($request->zw)?$request->zw:'u^2+v^3+w' }}" aria-label="input"/>
                        </div>
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
    
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            @php
                                $enter=$detail['enter'];
                                $enter1=$detail['enter1'];
                                $jacob=$detail['jacob'];
                                $dtrmnt=$detail['dtrmnt'];
                                $var=$detail['var'];
                                $var1=$detail['var1'];
                                $check=$detail['check'];
                                if($var==='u'){
                                    $varr='x';
                                }elseif($var==='x'){
                                    $varr='u';
                                }
                                if($var1==='v'){
                                    $varr1='y';
                                }elseif($var1==='y'){
                                    $varr1='v';
                                }
                            @endphp
                            <div class="w-full text-[16px]">
                                @if($check==='two')
                                    <p class="mt-3 text-[18px]"><strong>{{$lang['4']}}</strong></p>
                                    <p class="mt-3">
                                        \( {{$jacob}} \)
                                    </p>
                                    <p class="mt-3 text-[18px]"><strong>{{$lang['5']}}</strong></p>
                                    <p class="mt-3">
                                        \( {{$dtrmnt}} \)
                                    </p>
                                    <p class="mt-3"><strong>{{$lang['6']}}</strong></p>
                                    <p class="mt-3">\( J({{$varr}}, {{$varr1}})({{$var}}, {{$var1}}) = \left[\begin{matrix}\frac{\partial {{$varr}}}{\partial {{$var}}} & \frac{\partial {{$varr}}}{\partial {{$var1}}}\\\frac{\partial {{$varr1}}}{\partial {{$var}}} & \frac{\partial {{$varr1}}}{\partial {{$var1}}}\end{matrix}\right] \)</p>
                                    <p class="mt-3">\( J({{$varr}}, {{$varr1}})({{$var}}, {{$var1}}) = \left[\begin{matrix}\frac{\partial}{\partial {{$var}}} ({{$enter}}) & \frac{\partial}{\partial {{$var1}}} ({{$enter}})\\\frac{\partial}{\partial {{$var}}} ({{$enter1}}) & \frac{\partial}{\partial {{$var1}}} ({{$enter1}})\end{matrix}\right] \)</p>
                                    <p class="mt-3">\( J({{$varr}}, {{$varr1}})({{$var}}, {{$var1}}) = {{$jacob}} \)</p>
                                @else
                                    @php
                                        $enter2=$detail['enter2'];
                                        $var2=$detail['var2'];
                                        if($var2==='w'){
                                            $varr2='z';
                                        }elseif($var2==='z'){
                                            $varr2='w';
                                        }
                                    @endphp
                                    <p class="mt-3 text-[18px]"><strong>{{$lang['4']}}</strong></p>
                                    <p class="mt-3">
                                        \( {{$jacob}} \)
                                    </p>
                                    <p class="mt-3 text-[18px]"><strong>{{$lang['5']}}</strong></p>
                                    <p class="mt-3">
                                        \( {{$dtrmnt}} \)
                                    </p>
                                    <p class="mt-3"><strong><?=$lang['6']?>:</strong></p> 
                                    <p class="mt-3 overflow-auto">\( J({{$varr}}, {{$varr1}}, {{$varr2}})({{$var}}, {{$var1}}, {{$var2}}) = \left[\begin{matrix}\frac{\partial {{$varr}}}{\partial {{$var}}} & \frac{\partial {{$varr}}}{\partial {{$var1}}} & \frac{\partial {{$varr}}}{\partial {{$var2}}}\\\frac{\partial {{$varr1}}}{\partial {{$var}}} & \frac{\partial {{$varr1}}}{\partial {{$var1}}} & \frac{\partial {{$varr1}}}{\partial {{$var2}}}\\\frac{\partial z}{\partial {{$var}}} & \frac{\partial z}{\partial {{$var1}}} & \frac{\partial z}{\partial {{$var2}}}\end{matrix}\right] \)</p>
                                    <p class="mt-3 overflow-auto">\( J({{$varr}}, {{$varr1}}, {{$varr2}})({{$var}}, {{$var1}}, {{$var2}}) = \left[\begin{matrix}\frac{\partial}{\partial {{$var}}} ({{$enter}}) & \frac{\partial}{\partial {{$var1}}} ({{$enter}}) & \frac{\partial}{\partial {{$var2}}} ({{$enter}})\\\frac{\partial}{\partial {{$var}}} ({{$enter1}}) & \frac{\partial}{\partial {{$var1}}} ({{$enter1}}) & \frac{\partial}{\partial {{$var2}}} ({{$enter1}})\\\frac{\partial}{\partial {{$var}}} ({{$enter2}}) & \frac{\partial}{\partial {{$var1}}} ({{$enter2}}) & \frac{\partial}{\partial {{$var2}}} ({{$enter2}})\end{matrix}\right] \)</p>
                                    <p class="mt-3">\( J({{$varr}}, {{$varr1}})({{$var}}, {{$var1}}) = {{$jacob}} \)</p>
                                @endif
                                <p class="mt-3">({{$lang['7']}} <a href="https://calculator-online.net/derivative-calculator/" class="text-blue" target="_blank">{{$lang[8]}}</a> {{$lang['9']}})</p>
                                <p class="mt-3">\( J({{$varr}}, {{$varr1}})({{$var}}, {{$var1}}) = {{$dtrmnt}} \)</p>
                                <p class="mt-3">{{$lang['10']}},</p>
                                <p class="mt-3">{{$lang['4']}} {{$lang['11']}} \( {{$jacob}} \)</p>
                                <p class="mt-3">{{$lang['5']}} {{$lang['11']}} \( {{$dtrmnt}} \)</p>
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
        <script>
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab').forEach(function(tab) {
                        tab.classList.remove('tagsUnit');
                    });
                    this.classList.add('tagsUnit');
                    let val = this.dataset.value;
                    document.getElementById('type').value = val;
                    if (val === 'three') {
                        ['#zwInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                    } else {
                        ['#zwInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                    }
                });
            });
        </script>
    @endpush
</form>