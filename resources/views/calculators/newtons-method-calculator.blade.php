<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fx" class="labele">f(x)</label>
                    <div class="w-full py-2">
                        <input type="text" name="fx" id="fx" class="input" value="{{ isset($_POST['fx'])?$_POST['fx']:'x^2' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fx1" class="labele">f'(x) {{$lang[1]}}</label>
                    <div class="w-full py-2">
                        <input type="text" name="fx1" id="fx1" class="input" value="{{ isset($_POST['fx1'])?$_POST['fx1']:'' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="x0" class="labele">{{$lang['2']}} (x₀)</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x0" id="x0" class="input" value="{{ isset($_POST['x0'])?$_POST['x0']:'5' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="iter" class="labele">{{$lang[3]}}</label>
                    <div class="w-full py-2">
                        <input type="number" name="iter" min="10" max="200" id="iter" class="input" value="{{ isset($_POST['iter'])?$_POST['iter']:'20' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="round" class="labele">{{$lang['4']}}</label>
                    <div class="w-full py-2">
                        <input type="number" min="3" max="20"  step="any" name="round" id="round" class="input" value="{{ isset($_POST['round'])?$_POST['round']:'4' }}" aria-label="input"/>
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
                                $enter=$detail['enter'];
                                $enter1=$detail['enter1'];
                                $fxx=$detail['fx'];
                                $fxx1=$detail['fx1'];
                                $ress=$detail['res'];
                                $fxx=explode('###',$fxx);
                                $fxx1=explode('###',$fxx1);
                                $ress=explode('###',$ress);
                                function sigFig($value,$digits){
                                    if($value===0){
                                        $decimalPlaces=$digits-1;
                                    }elseif($value<0){
                                        $decimalPlaces=$digits-floor(log10($value*-1))-1;
                                    }else{
                                        $decimalPlaces=$digits-floor(log10($value))-1;
                                    }
                                    $answer=round($value,$decimalPlaces);
                                    return $answer;
                                }
                                if(isset($detail['round'])){
                                    $round=$detail['round'];
                                }else{
                                    $round=4;
                                }
                            @endphp 
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['5'] }}</strong></td>
                                        <td class="py-2 border-b">\( {{$detail['enter']}} \)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['6'] }}</strong></td>
                                        <td class="py-2 border-b">\( {{$detail['enter1']}} \)</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['7']}}:</strong></p>
                                @if(!isset($detail['check']))
                                    <p class="mt-2">{!!$detail['steps']!!}</p>
                                @endif
                                <p class="mt-2">{{$lang['8']}}:</p>
                                <table class="w-full md:w-[80%] lg:w-[80%] ">
                                    <tr>
                                        <td class="py-2 border-b text-center"><strong>{{$lang['9']}}</strong></td>
                                        <td class="py-2 border-b text-center"><strong>x</strong></td>
                                        <td class="py-2 border-b text-center"><strong>f(x)</strong></td>
                                        <td class="py-2 border-b text-center"><strong>f'(x)</strong></td>
                                    </tr>
                                    @for ($i=0; $i < count($ress)-1; $i++)
                                        <tr>
                                            <td class="py-2 border-b text-center">{{$i+1}}</td>
                                            <td class='py-2 border-b text-center'>{{sigFig($ress[$i],$round)}}</td>
                                            <td class="py-2 border-b text-center">{{round($fxx[$i],$round)}}</td>
                                            <td class='py-2 border-b text-center'>{{sigFig($fxx1[$i],$round)}}</td>
                                        </tr>
                                    @endfor
                                </table>
                                @for ($i=0; $i < count($ress)-1; $i++)
                                    @php
                                        if($i===0){
                                            $x0=$_POST['x0'];
                                        }else{
                                            $x0=sigFig($ress[$i-1],$round);
                                        }
                                    @endphp
                                    <p class="mt-3">\( {{$lang['10']}} \ {{$i+1}}: \)</p>
                                    <p class="mt-3">\( f(x_{{$i}}) = f({{$x0}}) = {{preg_replace('/x/','('.$x0.')',$enter)}} = {{round($fxx[$i],$round)}} \)</p>
                                    <p class="mt-3">\( f'(x_{{$i}}) = f'({{$x0}}) = {{preg_replace('/x/','('.$x0.')',$enter1)}} = {{sigFig($fxx1[$i],$round)}} \)</p>
                                    <p class="mt-3">\( x_{{$i+1}} = x_{{$i}} - \)<span class="font_size22">\( \frac {f(x_{{$i}})} {f'(x_{{$i}})} \)</span></p>
                                    <p class="mt-3">\( x_{{$i+1}} = {{$x0}} - \)<span class="font_size22">\( \frac {{{round($fxx[$i],$round)}}} {{{sigFig($fxx1[$i],$round)}}} \)</span></p>
                                    <p class="mt-3">\( x_{{$i+1}} = {{sigFig($ress[$i],4)}} \)</p>
                                @endfor
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