<div x-data="{ showKeyboard: false }">
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="EnterEq" class="label">{{$lang['1']}} y′=f(x,y) or y′=f(t,y)=:</label>
                <div class="w-full py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" required class="input" wire:model.live="EnterEq" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" @click="showKeyboard = !showKeyboard" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-span-12 keyboard" x-show="showKeyboard" x-cloak x-transition>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="if (confirm('Are you sure you want to clear Equation?')) { $wire.EnterEq = '' }">CLS</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '+'">+</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '-'">-</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '/'">/</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '*'">*</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '^'">^</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += 'sqrt('">√</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '('">(</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += ')'">)</button>
            </div>
            <div class="col-span-12">
                <label for="steps" class="label">{{$lang['2']}}:</label>
                <div class="w-full py-2">
                    <select name="steps" class="input" id="steps" aria-label="select" wire:model.live="steps">
                        <option value="h">{{$lang['3']}}</option>
                        <option value="n">{{$lang['4']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="size" class="label" id="n_number_label" >{{ $steps === 'h' ? $lang['18'] . ' (h):' : 'Step Size (n):' }}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="size" id="size" required class="input" wire:model.live="size" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ini" class="label">{{$lang['5']}} (t₀)</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="ini" id="ini" required class="input" wire:model.live="ini" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="con" class="label">{{$lang['19']}}  (Y₀):</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="con" required id="con" class="input" wire:model.live="con" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="find" class="label">{{$lang['6']}}<sub class="text-blue">1</sub></label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="find" id="find" required class="input" wire:model.live="find" aria-label="input"/>
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result overflow-auto">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                               <div class="w-full  text-center text-[20px]">
                                <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[23px] rounded-lg text-blue">y<sub class="text-blue">{{$detail['find']}}</sub>= {{ round($detail['ans'],2) }}</strong></p>
                            </div>
                            <div class="w-full font-16 rounded-lg px-4 py-2">
                                <p class="mt-3">{{$lang['9']}} \( y({{$detail['find']}}) \) {{$lang['10']}} \(y' = {{$detail['enter']}}\),</p>
                                <p class="mt-3"><strong>{{$lang['8']}}</strong></p>
                                @if($steps=='n')
                                <p class="mt-3">{{$lang['13']}} \( h=\frac{ {{$detail['find']}}-{{$detail['ini']}}}{{{$size}}} = {{round($detail['h'],2)}}\)</p>
                                @endif
                                <p class="mt-3">{{$lang['14']}}  \( y_{n+1} = y_n + h . f({{$detail['one']}}_n,y_n)\)</p>
                                <p class="mt-3">{{$lang['16']}}</p>
                                <ul class="px-3">
                                    <li class="py-2"> \(h={{round($detail['h'],2)}}\)</li>
                                    <li class="py-2">\( {{$detail['one']}}_0 = {{$detail['ini']}}\) </li>
                                    <li class="py-2">\( y_0 = {{$detail['con']}} \) </li>
                                    <li class="py-2">\( f({{$detail['one']}},y)={{$detail['enter']}}\) </li>
                                </ul>
                                <?php 
                                    $count=count($detail['steps']);
                                    $xx=$detail['ini'];
                                    $final=$detail['ini'];
                                    $con_val=$detail['con'];
                                    $table='';
                                    for ($i=1; $i <$count ; $i++){ 
                                        $final=$final+round($detail['h'],2);
                                        $table.='<tr><td>'.round($i,2).'</td><td>'.round($xx,2).'</td><td>'.round($con_val,2).'</td><td>'.round($detail['steps'][$i-1],2).'</td><td>'.round($detail['steps1'][$i-1],2).'</td></tr>';
                                        ?>
                                        <p class="mt-3"><strong>{{ $lang['17']}} {{ $i}}</strong></p>
                                        <p class="mt-3">\({{ $detail['one'].'_'.$i}} = {{ $detail['one'].'_'.($i-1)}} + h = {{ $xx.'+'.round($detail['h'],2).'='.$final}}\)</p>
                                        <p class="mt-3">\(y({{ $detail['one'].'_'.$i}}) = y({{ $final}}) = y_{{ $i}}= y_{{ $i-1}} + h. f({{ $detail['one'].'_'.($i-1)}},y_{{ $i-1}}) = {{ $con_val}} + {{ round($detail['h'],2)}} \times f({{ $xx.','.$con_val}})\)</p>
                                        <p class="mt-3">\( = {{ $con_val}} + {{ round($detail['h'],2)}} \times {{round($detail['steps'][$i-1], 2)}} = {{round($detail['steps1'][$i-1], 2)}} \)</p>
                                <?php
                                    $con_val=  round($detail['steps1'][$i-1] ,2);
                                    $xx=$xx+round($detail['h'],2);
                                    }
                                ?>
                                <p class="mt-3"><strong>{{$lang['7']}}: \( y({{$detail['find']}}) \)= {{round($detail['ans'],2)}}</strong></p>
                                <style>
                                    .result_tab tbody tr td{
                                        padding: 0.5rem 0px !important;
                                        border: 1px solid black
                                    }
                                </style>
                                <div class="w-full mt-3" style="overflow: auto;">
                                    <table class="w-full result_tab text-center" style="border-collapse: collapse;">
                                        <tr style="background-image: linear-gradient(90deg, #334ee9ff, #4a3addff);">
                                            <td><strong class="text-white">{{$lang['17']}}</strong></td>
                                            <td><strong class="text-white">x<sub class="text-white">0</sub></strong></td>
                                            <td><strong class="text-white">y<sub class="text-white">0</sub></strong></td>
                                            <td><strong class="text-white">slope</strong></td>
                                            <td><strong class="text-white">y<sub class="text-white">n</sub></strong></td>
                                        </tr>
                                        {!! $table !!}
                                    </table>
                                </div>
                            </div>
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
