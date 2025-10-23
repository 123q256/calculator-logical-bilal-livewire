<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="convert" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="convert" id="convert">
                        <option value="1">{{$lang['2']}}</option>
                        <option value="2" {{ isset($_POST['convert']) && $_POST['convert']=='2'?'selected':'' }}>{{$lang['3']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="select_unit" class="font-s-14 text-blue" id="changeText">
                    @if(isset($_POST['select_unit']) && $_POST['select_unit']=='2')
                        Select Type of Fraction
                    @else
                        {{ $lang['4'] }}:   
                    @endif
                </label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="select_unit" id="select_unit">
                        <option value="1">{{$lang['5']}}</option>
                        <option value="2" {{ isset($_POST['select_unit']) && $_POST['select_unit']=='2'?'selected':'' }}>{{$lang['6']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 flex tems-center px-2">
                <div>
                    <label for="first_number" class="font-s-14 text-blue" id="changeText1">
                        @if(isset($_POST['select_unit']) && $_POST['select_unit']=='2')
                            Part
                        @else
                            A   
                        @endif
                    </label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="first_number" id="first_number" class="input" value="{{ isset($_POST['first_number'])?$_POST['first_number']:'12' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="dot px-2 flex items-center pt-4">
                    <p>&nbsp;</p>
                    <div class="mb-2">
                        <strong id="dotText">:</strong>
                    </div>
                </div>
                <div>
                    <label for="second_number" class="font-s-14 text-blue" id="changeText2">
                        @if(isset($_POST['select_unit']) && $_POST['select_unit']=='2')
                            Whole
                        @else
                            B  
                        @endif
                    </label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="second_number" id="second_number" class="input" value="{{ isset($_POST['second_number'])?$_POST['second_number']:'22' }}" aria-label="input"/>
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
    <script type="text/javascript" async
  src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML">
</script>
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full overflow-auto">
                    <div class="w-full">
                        <div class="w-full text-[16px]">
                            @if($detail['method']=="1")
                            <p class="mt-3 font-s-21">
                                \( \frac{ {{ $detail['upr1'] }} }{ {{ $detail['btm1'] }} } \text{ & } \frac{ {{ $detail['upr2'] }} }{ {{ $detail['btm2'] }} } \)
                            </p>
                            
                                <p class="mt-3"><strong>{{$lang['8']}}:</strong></p>
                                <p class="mt-3">\( \text{ {{$lang['26']}} }={{$detail['first_number']}} \text{ {{$lang['27']}} {{$lang['28']}} } ={{$detail['second_number']}}\)</p>
                                <p class="mt-3">\( \text{ {{$lang['9']}} }:\)</p>
                                <p class="mt-3">\( \text{ {{$lang['10']}} } \)</p>
                                <p class="mt-3">\( {{$lang['16']}}={{ $detail['first_number']}}+{{$detail['second_number']}}={ {{$detail['addition']}} } \)</p>
                                <p class="mt-3">\(\text{ {{$lang['11']}} }:\)</p>
                                <p class="mt-3">\( \text{ {{$lang['12']}} } \)</p>
                                <p class="mt-3">\( \frac{ {{$detail['first_number'] }} }{ {{$detail['addition'] }} } \text{ & } \frac{ {{$detail['second_number'] }} }{ {{$detail['addition'] }} }  \)</p>
                                <p class="mt-3">\(\text{ {{$lang['15']}} } :\)</p>
                                @if($detail['upr1']==$detail['first_number'] && $detail['upr2']==$detail['second_number'] )
                                    <p class="mt-3">\( \text{ {{$lang['13']}} }  \)</p>
                                @else
                                    <p class="mt-3">\( \text{ {{$lang['14']}} } \)</p>
                                    <p class="mt-3">\( \frac{ {{$detail['first_number'] }} }{ {{$detail['addition'] }} }=  \frac{ {{$detail['upr1'] }} }{ {{$detail['btm1'] }} }  \)</p>
                                    <p class="mt-3">\( \frac{ {{$detail['second_number'] }} }{ {{$detail['addition'] }} }=  \frac{ {{$detail['upr2'] }} }{ {{$detail['btm2'] }} }  \)</p>
                                @endif
                            @endif
                            @if($detail['method']=="2")
                                @if($detail['upr2']/$detail['btm2']=="1")
                                    <p class="mt-3 font-s-21">
                                        \(
                                           {{$divide}}
                                        \)
                                    </p>
                                @else
                                    <p class="mt-3 font-s-21">
                                        \(
                                            \frac{ {{$detail['upr2'] }} }{ {{$detail['btm2'] }} }
                                        \)
                                    </p>
                                    
                                @endif
                                <p class="mt-3"><strong>{{$lang['8']}}:</strong></p>
                                <p class="mt-3">\( \text{ {{$lang['9']}} }:\)</p>
                                <p class="mt-3">\( \text{ {{$lang['22']}} } \)</p>
                                <p class="mt-3">\({{$detail['first_number'] }}:{{$detail['second_number']}}=\frac{ {{$detail['first_number'] }} }{ {{$detail['second_number'] }} }\)</p>
                                <p class="mt-3">\( \text{ {{$lang['11']}} } \)</p>
                                @if($detail['upr2']==$detail['first_number'] && $detail['btm2']==$detail['second_number'] )
                                    <p class="mt-3">\( \text{ {{$lang['18']}} } \)</p>
                                @else
                                    <p class="mt-3">\( \text{ {{$lang['23']}} } \)</p>
                                    <p class="mt-3">\( \frac{ {{$detail['first_number'] }} }{ {{$detail['second_number'] }} } = \frac{ {{$detail['upr2'] }} }{ {{$detail['btm2'] }} } \)</p>
                                @endif
                            @endif
                            @if($detail['method']=="3")
                                <p class="mt-3 font-s-21">
                                    \(
                                        {{$detail['upr1']}}:{{$detail['upr2']}}
                                    \)
                                </p>
                                <p class="mt-3"><strong>{{$lang['8']}}:</strong></p>
                                <p class="mt-3">\( \text{ {{$lang['9']}} }\)</p>
                                @if($detail['upr1']==$detail['first_number'] && $detail['upr2']==$detail['second_number'] )
                                    <p class="mt-3">\( \text{ {{$lang['18']}} } \)</p>
                                @else
                                    <p class="mt-3">\( \text{ {{$lang['19']}} } \)</p>
                                    <p class="mt-3">\( \frac{ {{$detail['first_number'] }} }{ {{$detail['second_number'] }} }=\frac{ {{$detail['upr1'] }} }{ {{$detail['upr2'] }} }\)</p>
                                @endif
                                <p class="mt-3">\( \text{ {{$lang['11'] }} }:\)</p>
                                <p class="mt-3">\( \text{ {{$lang['20']}} } \)</p>
                                <p class="mt-3">\( \frac{ {{$detail['upr1'] }} }{ {{$detail['upr2'] }} } \text{ = }{{$detail['upr1'] }}:{{$detail['upr2'] }}\)</p>
                            @endif
                            @if($detail['method']=="4")
                                    <p class="my-3 text-center"><strong class="bg-white px-3 py-2 font-s-32 radius-10 text-blue">\( \color{#1670a7}{{$detail['upr1']}}:\color{#1670a7}{{$detail['btm1']}} \)</strong></p>
                            @endif
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
            document.getElementById('convert').addEventListener('change', function() {
                if (this.value === "1") {
                    document.getElementById('changeText').textContent = "{{ $lang['4'] }}:";
                    document.getElementById('dotText').textContent = ":";
                }else{
                    document.getElementById('changeText').textContent = "Select Type of Fraction:";
                    document.getElementById('dotText').textContent = "/";
                }
            });
            document.getElementById('select_unit').addEventListener('change', function() {
                if (this.value === "1") {
                    document.getElementById('changeText1').textContent = "A";
                    document.getElementById('changeText2').textContent = "B";
                }else{
                    document.getElementById('changeText1').textContent = "Part";
                    document.getElementById('changeText2').textContent = "Whole";
                }
            });
        </script>
    @endpush
</form>