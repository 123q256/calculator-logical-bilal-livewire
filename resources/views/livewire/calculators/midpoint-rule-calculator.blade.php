<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3" x-data="{ showKeyboard: false }">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                
            <div class="col-span-9">
                <label for="EnterEq" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                <div class="w-full py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" wire:model.live="EnterEq" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" @click="showKeyboard = !showKeyboard" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-span-3">
                <label for="with" class="font-s-14 text-blue">W.R.T:</label>
                <div class="w-full py-2">
                    <select name="with" class="input" id="with" wire:model.live="with" aria-label="select">
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
                        <option value="n">n</option>
                        <option value="x">x</option>
                        <option value="y">y</option>
                        <option value="z">z</option>
                    </select>
                </div>
            </div>
            
            <div class="col-span-12 keyboard" x-show="showKeyboard" x-collapse style="display: none;">
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="if (confirm('Are you sure you want to clear Equation?')) $wire.EnterEq = ''">CLS</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '+'">+</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '-'">-</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '/'">/</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '*'">*</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '^'">^</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += 'sqrt('">√</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '('">(</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += ')'">)</button>
            </div>
            
            <div class="col-span-6">
                <label for="lb" class="font-s-14 text-blue">{{$lang['3']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="lb" id="lb" class="input" wire:model.live="lb" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ub" class="font-s-14 text-blue">{{$lang['4']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="ub" id="ub" class="input" wire:model.live="ub" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="n" class="font-s-14 text-blue">{{$lang['5']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="n" id="n" class="input" wire:model.live="n" aria-label="input"/>
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
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[18px]">
                                    \( \int\limits_{ {{$detail['lb']}} }^{ {{$detail['ub']}} } {{$detail['enter']}}\, d{{$detail['with']}} \) = {{$detail['res']}}
                                </p>
                                <p class="mt-3"><strong>{{$lang['7']}}</strong></p>
                                <p class="mt-3">{{$lang['8']}} \( \int\limits_{ {{$detail['lb']}} }^{ {{$detail['ub']}} } {{$detail['enter']}}\, d{{$detail['with']}} \) {{$lang['9']}} \(n={{$detail['n']}}\) {{$lang['10']}}.</p>
                                <p class="mt-3">\( \int\limits_{a}^{b} f({{$detail['with']}})\, d{{$detail['with']}} ≈ \Delta {{$detail['with']}}(f(\frac{ {{$detail['with']}}_0+{{$detail['with']}}_1}{2}) + f(\frac{ {{$detail['with']}}_1+{{$detail['with']}}_2}{2}) + f(\frac{ {{$detail['with']}}_2+{{$detail['with']}}_3}{2}) + ... + f(\frac{ {{$detail['with']}}_{n-2}+{{$detail['with']}}_{n-1}}{2}) + f(\frac{ {{$detail['with']}}_{n-1}+{{$detail['with']}}_n}{2})) \)</p>
                                <p class="mt-3">{{$lang['11']}} \(\Delta {{$detail['with']}} = \frac{b-a}{n}\)</p>
                                <p class="mt-3">{{$lang['12']}} \(a = {{$detail['lb']}},b = {{$detail['ub']}},n = {{$detail['n']}}\)</p>
                                <p class="mt-3">{{$lang['13']}}, \(\Delta {{$detail['with']}} = \frac{ {{$detail['ub']}}-{{$detail['lb']}} }{ {{$detail['n']}} } = {{$detail['diff']}}\)</p>
                                <p class="mt-3">{{$lang['14']}} \([{{$detail['lb']}},{{$detail['ub']}}]\) {{$lang['15']}} \(n={{$detail['n']}}\) {{$lang['16']}} \(Δ{{$detail['with']}}={{$detail['diff']}}\) {{$lang['17']}}:</p>
                                <p class="mt-3">\(a={{$detail['limit']}}=b\)</p>
                                <p class="mt-3">{{$lang['18']}}.</p>
                                @php $i=0;$show=''; @endphp
                                @foreach ($detail['steps'] as $key => $value)
                                    @if(!empty($value))
                                        @php
                                            if ((count($detail['steps'])-2)==$i) {
                                                $show .= "$value";
                                            }else{
                                                $show .= "$value + ";
                                            }
                                            $inner=round(($detail['limit_a'][$i] + $detail['limit_a'][$i+1])/2,5);
                                        @endphp
                                        <p class="mt-3">\( f(\frac{ {{$detail['with']}}_{{$i}}+{{$detail['with']}}_{{$i+1}}}{2}) = f(\frac{ {{$detail['limit_a'][$i]}}+{{$detail['limit_a'][$i+1]}}}{2}) = f({{$inner}}) = {{str_replace($detail['with'], $inner, $detail['enter'])}} = {{$value}}\)</p>
                                        @php $i++; @endphp
                                    @endif
                                @endforeach
                                <p class="mt-3">{{$lang['19']}} \(Δ{{$detail['with']}} = {{$detail['diff']}}\)</p>
                                <p class="mt-3">\( {{$detail['diff']}}({{$show}}) = {{$detail['res']}}\)</p>
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
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="if (typeof renderMathInElement === 'function') renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</form>
</div>
