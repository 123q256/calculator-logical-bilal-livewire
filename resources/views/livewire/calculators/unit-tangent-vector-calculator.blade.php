<div>
 <form wire:submit.prevent="calculate">
  
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 mt-0 mt-lg-2 text-[14px]">
                <p><strong>{{ $lang['1'] }}</strong></p>
            </div>
            <div class="col-span-12 mt-2 flex items-center">
                <p class="font-s-18" style="white-space: nowrap"><strong>r(t) = (</strong></p>
                <div class="mx-2">
                    <input type="text" name="x" id="x" class="input" aria-label="input" wire:model.live="x" />
                </div>
                <p class="font-s-18"><strong>,</strong></p>
                <div class="mx-2">
                    <input type="text" name="y" id="y" class="input" aria-label="input" wire:model.live="y" />
                </div>
                <p class="font-s-18"><strong>,</strong></p>
                <div class="mx-2">
                    <input type="text" name="z" id="z" class="input" aria-label="input" wire:model.live="z" />
                </div>
                <p class="font-s-18"><strong>)</strong></p>
            </div>
            <div class="col-span-12 mt-3 flex items-center">
                <p class="font-s-18" style="white-space: nowrap"><strong>at t =</strong></p>
                <div class="mx-2">
                    <input type="number" name="t" id="t" class="input" aria-label="input" wire:model.live="t" />
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
    
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result overflow-auto">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        @php
                            $enter=$detail['enter'];
                            $enter1=$detail['enter1'];
                            $enter2=$detail['enter2'];
                            $deriv=$detail['deriv'];
                            $deriv1=$detail['deriv1'];
                            $deriv2=$detail['deriv2'];
                            $steps=$detail['steps'];
                            $steps1=$detail['steps1'];
                            $steps2=$detail['steps2'];
                            $eq_len=$detail['eq_len'];
                            $eq1_len=$detail['eq1_len'];
                            $eq2_len=$detail['eq2_len'];
                            $res=$detail['res'];
                            $res1=$detail['res1'];
                            $res2=$detail['res2'];
                            $t_val=$detail['t'];
                        @endphp
                        <div class="w-full text-[16px]">
                            @if($detail['check']==='method1')
                                @if(!empty($t_val))
                                  <p class="mt-3 font-s-20"><strong>\( \vec T ({{$t_val}}) = ({{round($res,5)}}, {{round($res1,5)}}, {{round($res2,5)}}) \)</strong></p>
                                @else
                                  <p class="mt-3 font-s-20">\( \vec T (t) = \left( \large{ \frac { {{$deriv}} }{\sqrt { {{$detail['eq_solve']}} }}, \frac { {{$deriv1}} }{\sqrt { {{$detail['eq_solve']}} }}, \frac { {{$deriv2}} }{\sqrt { {{$detail['eq_solve']}} }} } \right) \)</p>
                                @endif
                                <p class="mt-3"><strong>{{$lang['4']}}:</strong></p>
                                <p class="mt-3">{{$lang['5']}} r(t)</p>
                                <p class="mt-3">\( rx = {{$enter}}, \space \large{\frac {d}{dt}} (rx) = {{$deriv}} \)</p>
                                
                                <div x-data="{ showStep: false }">
                                    <div class="w-full my-3">
                                        <button type="button" @click="showStep = !showStep" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['6']}}</button>
                                    </div>
                                    <div class="w-full res_step" x-show="showStep" x-collapse style="display: none;">
                                        {!! $steps !!}
                                    </div>
                                </div>

                                <p class="mt-3">\( ry = {{$enter1}}, \space \large{\frac {d}{dt}} (ry) = {{$deriv1}} \)</p>
                                
                                <div x-data="{ showStep1: false }">
                                    <div class="w-full my-3">
                                        <button type="button" @click="showStep1 = !showStep1" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['6']}}</button>
                                    </div>
                                    <div class="w-full res_step" x-show="showStep1" x-collapse style="display: none;">
                                        {!! $steps1 !!}
                                    </div>
                                </div>

                                <p class="mt-3">\( rz = {{$enter2}}, \space \large{\frac {d}{dt}} (rz) = {{$deriv2}} \)</p>
                                
                                <div x-data="{ showStep2: false }">
                                    <div class="w-full my-3">
                                        <button type="button" @click="showStep2 = !showStep2" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['6']}}</button>
                                    </div>
                                    <div class="w-full res_step" x-show="showStep2" x-collapse style="display: none;">
                                        {!! $steps2 !!}
                                    </div>
                                </div>

                                <p class="mt-3">{{$lang['7']}}</p>
                                <p class="mt-3">\( \vec r'(t) = ({{$deriv}}, {{$deriv1}}, {{$deriv2}}) \)</p>
                                <p class="mt-3">{{$lang['8']}}</p>
                                <p class="mt-3">\( ||\vec r'(t)|| = \sqrt {( {{$deriv}} )^2+( {{$deriv1}} )^2+( {{$deriv2}} )^2} \)</p>
                                <p class="mt-3">\( ||\vec r'(t)|| = \sqrt { {{$detail['eq_solve']}} } \)</p>
                                <p class="mt-3">{{$lang['9']}}</p>
                                <p class="mt-3">\( \vec T (t) = \large{ \frac {\vec r (t)}{||\vec r (t)||}} \)</p>
                                <p class="mt-3">\( \vec T (t) = \large{ \frac {( {{$deriv}}, {{$deriv1}}, {{$deriv2}} )}{\sqrt { {{$detail['eq_solve']}} }}} \)</p>
                                <p class="mt-3">\( \vec T (t) = \left( \large{ \frac { {{$deriv}} }{\sqrt { {{$detail['eq_solve']}} }}, \frac { {{$deriv1}} }{\sqrt { {{$detail['eq_solve']}} }}, \frac { {{$deriv2}} }{\sqrt { {{$detail['eq_solve']}} }} } \right) \)</p>
                                @if(!empty($t_val))
                                <p class="mt-3">\( \vec T ({{$t_val}}) = \left( \large{ \frac { {{preg_replace("/\(t/","(".$t_val,$deriv)}} }{\sqrt { {{preg_replace("/\(t/","(".$t_val,$detail['eq_solve'])}} }}, \frac { {{preg_replace("/\(t/","(".$t_val,$deriv1)}} }{\sqrt { {{preg_replace("/\(t/","(".$t_val,$detail['eq_solve'])}} }}, \frac { {{preg_replace("/\(t/","(".$t_val,$deriv2)}} }{\sqrt { {{preg_replace("/\(t/","(".$t_val,$detail['eq_solve'])}} }} } \right) \)</p>
                                <p class="mt-3">\( \vec T ({{$t_val}}) = ({{$res}}, {{$res1}}, {{$res2}}) \)</p>
                                @endif
                              @elseif($detail['check']==='method2')
                                @if(!empty($t_val))
                                  <p class="mt-3 font-s-20"><strong>\( \vec T ({{$t_val}}) = ({{round($detail['ans'],5)}}, {{round($detail['ans1'],5)}}, {{round($detail['ans2'],5)}}) \)</strong></p>
                                @else
                                  <p class="mt-3 font-s-20"><strong>\( \vec T (t) = ({{round($detail['ans'],5)}}, {{round($detail['ans1'],5)}}, {{round($detail['ans2'],5)}}) \)</strong></p>
                                @endif
                                <p class="mt-3"><strong>{{$lang['4']}}:</strong></p>
                                <p class="mt-3"><strong>{{$lang['5']}} r(t)</strong></p>
                                <p class="mt-3">\( rx = {{$enter}}, \space \large{\frac {d}{dt}} (rx) = {{$deriv}} \)</p>
                                
                                <div x-data="{ showStep: false }">
                                    <div class="w-full my-3">
                                        <button type="button" @click="showStep = !showStep" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['6']}}</button>
                                    </div>
                                    <div class="w-full res_step" x-show="showStep" x-collapse style="display: none;">
                                        {!! $steps !!}
                                    </div>
                                </div>

                                <p class="mt-3">\( ry = {{$enter1}}, \space \large{\frac {d}{dt}} (ry) = {{$deriv1}} \)</p>
                                
                                <div x-data="{ showStep1: false }">
                                    <div class="w-full my-3">
                                        <button type="button" @click="showStep1 = !showStep1" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['6']}}</button>
                                    </div>
                                    <div class="w-full res_step" x-show="showStep1" x-collapse style="display: none;">
                                        {!! $steps1 !!}
                                    </div>
                                </div>

                                <p class="mt-3">\( rz = {{$enter2}}, \space \large{\frac {d}{dt}} (rz) = {{$deriv2}} \)</p>
                                
                                <div x-data="{ showStep2: false }">
                                    <div class="w-full my-3">
                                        <button type="button" @click="showStep2 = !showStep2" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['6']}}</button>
                                    </div>
                                    <div class="w-full res_step" x-show="showStep2" x-collapse style="display: none;">
                                        {!! $steps2 !!}
                                    </div>
                                </div>

                                <p class="mt-3"><strong>{{$lang['7']}}</strong></p>
                                <p class="mt-3">\( \vec r'(t) = ({{$deriv}}, {{$deriv1}}, {{$deriv2}}) \)</p>
                                <p class="mt-3"><strong>{{$lang['8']}}</strong></p>
                                <p class="mt-3">\( ||\vec r'(t)|| = \sqrt {({{$deriv}})^2+({{$deriv1}})^2+({{$deriv2}})^2} \)</p>
                                <p class="mt-3">\( ||\vec r'(t)|| = \sqrt { {{$eq_len}} + {{$eq1_len}} + {{$eq2_len}} } \)</p>
                                <p class="mt-3">\( ||\vec r'(t)|| = \sqrt { {{$eq_len+$eq1_len+$eq2_len}} } \)</p>
                                <p class="mt-3"><strong>{{$lang['9']}}</strong></p>
                                <p class="mt-3">\( \vec T (t) = \large{ \frac {\vec r (t)}{||\vec r (t)||}} \)</p>
                                <p class="mt-3">\( \vec T (t) = \large{ \frac {( {{$deriv}}, {{$deriv1}}, {{$deriv2}} )}{\sqrt { {{$eq_len+$eq1_len+$eq2_len}} }}} \)</p>
                                @if(!empty($t_val))
                                <p class="mt-3">\( \vec T ({{$t_val}}) = ({{$detail['ans']}}, {{$detail['ans1']}}, {{$detail['ans2']}}) \)</p>
                                @else
                                <p class="mt-3">\( \vec T (t) = ({{$detail['ans']}}, {{$detail['ans1']}}, {{$detail['ans2']}}) \)</p>
                                @endif
                              @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                // Initial render
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</form>
</div>
