<div>
    @php
        if (!function_exists('safe_round')) {
            function safe_round($val, $precision = 5) {
                if ($val === 'NAN' || $val === 'NaN' || (is_numeric($val) && is_nan((float)$val))) {
                    return 'NAN';
                }
                if ($val === 'INF' || $val === 'INF' || $val === 'infinity' || $val === 'Infinity' || (is_numeric($val) && is_infinite((float)$val))) {
                    return 'INF';
                }
                return is_numeric($val) ? round((float)$val, $precision) : $val;
            }
        }
    @endphp
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
        border-bottom: 3px solid #2845F5;
    }
    .velocitytab .v_active strong{
        color: #2845F5;
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
 <form wire:submit.prevent="calculate">
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
                <div class="flex justify-between md:justify-around velocitytab border-b-dark border-b relative">
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
                                <input type="number" wire:model.live="s1" id="s1" class="input mb-2" aria-label="input"/>
                            </div>
                            <div class="ps-lg-2">
                                <input type="number" wire:model.live="n1" id="n1" class="input mb-2" aria-label="input"/>
                                <hr>
                                <input type="number" wire:model.live="d1" id="d1" class="input mt-2" aria-label="input"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2" >
                        <label for="action" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="action" class="input" id="action" aria-label="select">
                                <option value="+">+</option>
                                <option value="-">-</option>
                                <option value="×">×</option>
                                <option value="÷">÷</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-5">
                        <div class="flex items-center">
                            <div class="pe-2">
                                <input type="number" wire:model.live="s2" id="s2" class="input mb-2" aria-label="input"/>
                            </div>
                            <div class="ps-lg-2">
                                <input type="number" wire:model.live="n2" id="n2" class="input mb-2" aria-label="input"/>
                                <hr>
                                <input type="number" wire:model.live="d2" id="d2" class="input mt-2" aria-label="input"/>
                            </div>
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
@if ($type=='widget')
@include('inc.widget-button')
 @endif
</div>
    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
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
                                        {{$s1}} \frac{ {{$n1}} }{ {{$d1}} } {{$action}} {{$s2}} \frac{ {{$n2}} }{ {{$d2}} } = \frac{ {{$detail['upr']}} }{ {{$detail['btm']}} }
                                    \)</strong>
                                </p>
                                <p class="mt-3">{{$lang['ex']}}:</p>
                                <p class="mt-3">
                                    {{$lang['input']}}:
                                    \(
                                        {{$s1}} \frac{ {{$n1}} }{ {{$d1}} } {{$action}} {{$s2}} \frac{ {{$n2}} }{ {{$d2}} } 
                                    \)
                                </p>
                                @if(is_numeric($s1) || is_numeric($s2))
                                    <p class="mt-3">{{$lang['step']}} # 1 :
                                        \(
                                            \frac{ {{$detail['N1']}} }{ {{$detail['D1']}} } {{$action}} \frac{ {{$detail['N2']}} }{ {{$detail['D2']}} }
                                        \)
                                    </p>
                                @endif
                                @if($action=='×')
                                    <p class="mt-3">
                                        {{$lang['step']}} # 2 =
                                        \(
                                            \frac{ {{$detail['N1'].$action.$detail['N2']}} }{ {{$detail['D1'].$action.$detail['D2']}} }
                                        \)
                                    </p>
                                @elseif($action=='÷')
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
                                            \frac{ ({{$detail['N1'].'×'.$detail['D2']}}) {{$action}} {{$detail['N2'].'×'.$detail['D1']}} }{ {{$detail['D1'].'×'.$detail['D2']}} }
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
                                    <p class="mt-3">{{$lang['dec']}}: {{safe_round($detail['upr']/$detail['btm'],4)}}</p>
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
    @endpush
</form>
</div>
