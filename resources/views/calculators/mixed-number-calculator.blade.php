<style>
    @media (max-width: 380px) {
        .calculator-box{
            padding-left: 0.5rem; 
            padding-right: 0.5rem; 
        }
        .px-3{
            padding-right: 0.7rem;
            padding-left: 0.7rem;
        }
    }
    .velocitytab .v_active{
        border-bottom: 3px solid var(--light-blue);
    }
    .velocitytab .v_active strong{
        color: var(--light-blue);
    }
    .veloTabs:hover{
        background-color : gainsboro;
    }
    .velocitytab p{
        position: relative;
        top: 2px;
    }
    .active{
        background-color: var(--light-blue);;
        color: white;
    }
    .bdr-top{
        border-top:2px solid var(--light-blue);
    }

</style>
<form class="row w-100" action="{{ url()->current() }}/" method="POST" id="myForm">
    @csrf
    @php $request = request(); @endphp
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                if (!isset($detail)) {
                    $_POST['round'] = "8";
                }
            @endphp
            @if(app()->getLocale() == 'en')
            <div class="col-span-12 text-center">
                <div class="flex {{$device == 'desktop' ? 'justify-around' : 'justify-between' }} velocitytab border-b-dark border-b relative">
                    <p class="cursor-pointer veloTabs px-2"><strong>
                        <a href="{{url('fraction-calculator')}}/" class="cursor-pointer veloTabs  text-decoration-none ">{{ isset($lang['43']) ? $lang['43'] : 'Fraction Calculator' }}</a></strong></p>
                    <p class="cursor-pointer veloTabs v_active px-2"><strong>{{ isset($lang['44']) ? $lang['44'] : 'Mixed Number' }}</strong></p>
                    <p class="cursor-pointer veloTabs px-2"><strong>
                        <a href="{{url('fraction-simplifier-calculator')}}/" class="cursor-pointer veloTabs  text-decoration-none ">{{ isset($lang['45']) ? $lang['45'] : 'Fraction Simplifier' }}</a></strong></p>
                </div>
            </div>
            
            @endif
            <div class="col-span-12 mx-auto">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4 ro ">
                    <div class="col-span-5">
                        <div class="flex items-center">
                            <div class="pe-2">
                                <input type="number" name="s1" id="s1" class="input mb-2" value="{{ isset($request->s1)?$request->s1:'-3' }}" aria-label="input"/>
                            </div>
                            <div class="ps-lg-2">
                                <input type="number" name="n1" id="n1" class="input mb-2" value="{{ isset($request->n1)?$request->n1:'2' }}" aria-label="input"/>
                                <hr>
                                <input type="number" name="d1" id="d1" class="input mt-2" value="{{ isset($request->d1)?$request->d1:'5' }}" aria-label="input"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2" >
                        <label for="action" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-100 py-2">
                            <select name="action" class="input" id="action" aria-label="select">
                                <option value="+">+</option>
                                <option value="-" {{ isset($request->action) && $request->action=='-'?'selected':'' }}>-</option>
                                <option value="×" {{ isset($request->action) && $request->action=='×'?'selected':'' }}>×</option>
                                <option value="÷" {{ isset($request->action) && $request->action=='÷'?'selected':'' }}>÷</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-5">
                        <div class="flex items-center">
                            <div class="pe-2">
                                <input type="number" name="s2" id="s2" class="input mb-2" value="{{ isset($request->s2)?$request->s2:'5' }}" aria-label="input"/>
                            </div>
                            <div class="ps-lg-2">
                                <input type="number" name="n2" id="n2" class="input mb-2" value="{{ isset($request->n2)?$request->n2:'2' }}" aria-label="input"/>
                                <hr>
                                <input type="number" name="d2" id="d2" class="input mt-2" value="{{ isset($request->d2)?$request->d2:'7' }}" aria-label="input"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



</div>
</div>
<div class="flex justify-center gap-3 mb-6 mt-10">
    <button type="submit" name="submit" value="calculate" id="calculate" class="px-6 py-3 sm:px-10 sm:py-4 font-semibold text-[#ffffff] bg-[#2845F5] rounded-[30px] focus:outline-none focus:ring-2 text-sm sm:text-base">
        {{ $lang['calculate'] }}
    </button>
    @if (isset($detail))
    <a href="{{ url()->current() }}/" class="calculate hover:bg-[#2845F5] shadow-2xl text-[#fff] bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
        @if (app()->getLocale() == 'en')
            RESET
        @else
            {{ $lang['reset'] ?? 'RESET' }}
        @endif
    </a>
    @endif
</div>
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
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[16px]">
                                    <strong>\(
                                        {{(isset($_POST['s1'])?$_POST['s1']:'')}} \frac{ {{$_POST['n1']}} }{ {{$_POST['d1']}} } {{$_POST['action']}} {{(isset($_POST['s2'])?$_POST['s2']:'')}} \frac{ {{$_POST['n2']}} }{ {{$_POST['d2']}} } = \frac{ {{$detail['upr']}} }{ {{$detail['btm']}} }
                                    \)</strong>
                                </p>
                                <p class="mt-3">{{$lang['ex']}}:</p>
                                <p class="mt-3">
                                    {{$lang['input']}}:
                                    \(
                                        {{(isset($_POST['s1'])?$_POST['s1']:'')}} \frac{ {{$_POST['n1']}} }{ {{$_POST['d1']}} } {{$_POST['action']}} {{(isset($_POST['s2'])?$_POST['s2']:'')}} \frac{ {{$_POST['n2']}} }{ {{$_POST['d2']}} } 
                                    \)
                                </p>
                                @if(is_numeric($_POST['s1']) || is_numeric($_POST['s2']))
                                    <p class="mt-3">{{$lang['step']}} # 1 :
                                        \(
                                            \frac{ {{$detail['N1']}} }{ {{$detail['D1']}} } {{$_POST['action']}} \frac{ {{$detail['N2']}} }{ {{$detail['D2']}} }
                                        \)
                                    </p>
                                @endif
                                @if($_POST['action']=='×')
                                    <p class="mt-3">
                                        {{$lang['step']}} # 2 =
                                        \(
                                            \frac{ {{$detail['N1'].$_POST['action'].$detail['N2']}} }{ {{$detail['D1'].$_POST['action'].$detail['D2']}} }
                                        \)
                                    </p>
                                @elseif($_POST['action']=='÷')
                                    <p class="mt-3">
                                        {{$lang['step']}} # 2 =
                                        \(
                                            \frac{ ({{$detail['N1'].'×'.$detail['D2']}}) }{ ({{$detail['N2'].'×'.$detail['D1']}}) }
                                        \)
                                    </p>
                                @else
                                    <p class="mt-3">
                                        {{$lang['step']}} # 2 =
                                        \(
                                            \frac{ ({{$detail['N1'].'×'.$detail['D2']}}) {{$_POST['action']}} {{$detail['N2'].'×'.$detail['D1']}} }{ {{$detail['D1'].'×'.$detail['D2']}} }
                                        \)
                                    </p>
                                @endif
                                <p class="mt-3">
                                    {{$lang['step']}} # 3 =
                                    \(
                                        \frac{ {{$detail['totalN']}} }{ {{$detail['totalD']}} }
                                    \)
                                </p>
                                <p class="mt-3">
                                    {{$lang['step']}} # 4 =
                                    \(
                                        \frac{ ({{$detail['totalN'].'÷'.$detail['g']}}) }{ ({{$detail['totalD'].'÷'.$detail['g']}}) }
                                    \)
                                </p>
                                @if($detail['btm']=='1')
                                    <p class="mt-3">
                                        {{$lang['an']}} = 
                                        \( {{$detail['upr']}} \)
                                    </p>
                                @else
                                    <p class="mt-3">
                                        {{$lang['an']}} = 
                                        \( \frac{ {{$detail['upr']}} }{ {{$detail['btm']}} } \)
                                    </p>
                                @endif
                                @if($detail['upr']>$detail['btm'] && $detail['btm']!='1')
                                    @php $bta=$detail['upr'] % $detail['btm']; $shi=floor($detail['upr'] / $detail['btm']); @endphp
                                    <p class="mt-3">
                                        {{$lang['or']}} = {{$shi}} 
                                        \( \frac{ {{$bta}} }{ {{$detail['btm']}} } \)
                                    </p>
                                @endif
                                @if($detail['btm']!='1')
                                    <p class="mt-3">{{$lang['dec']}}: {{round($detail['upr']/$detail['btm'],4)}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        @isset($detail)
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
            <script defer src="{{ url('katex/katex.min.js') }}"></script>
            <script defer src="{{ url('katex/auto-render.min.js') }}" 
            onload="renderMathInElement(document.body);"></script>
        @endisset
        <script>
            @if(!isset($detail))
                document.getElementById('resetButton').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default behavior if needed
                    var inputs = document.querySelectorAll('#myForm input');
                    inputs.forEach(function(input) {
                        if (input.type !== 'hidden') {
                            input.value = ''; // Set the value property to an empty string
                        }
                    });
                });
            @endif
        </script>
    @endpush
</form>