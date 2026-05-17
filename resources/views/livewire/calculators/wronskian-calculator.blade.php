<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3" x-data="{ showKeyboard: false }">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-10">
                <label for="EnterEq" class="label">{{$lang['2']}}:</label>
                <div class="w-full py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" wire:model.live="EnterEq" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" @click="showKeyboard = !showKeyboard" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async">
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
            </div>
            <div class="col-span-2">
                <label for="with" class="label">W.R.T:</label>
                <div class="w-100 py-2">
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
                                <p class="mt-3 text-[18px]"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-3">
                                    \( {!! $detail['res'] !!} \)
                                </p>
                                <p class="mt-3"><strong>{{$lang['5']}}</strong></p>
                                
                                @php
                                    $input = explode('##', $detail['enter']);
                                    $cou = count($input);
                                    $fs = '';
                                    $funcs_str = '';
                                    for ($i = 0; $i < ($cou - 1); $i++) {
                                        if (($cou - 2) == $i) {
                                            $fs .= "f_" . ($i + 1);
                                            $funcs_str .= "f_" . ($i + 1) . " = " . $input[$i];
                                        } else {
                                            $fs .= "f_" . ($i + 1) . ",";
                                            $funcs_str .= "f_" . ($i + 1) . " = " . $input[$i] . ", ";
                                        }
                                    }
                                @endphp
                                
                                <p class="mt-3">
                                    {{$lang['6']}}:
                                    \( {!! $funcs_str !!} \)    
                                </p>
                                <p class="mt-3">{{$lang['7']}}:</p>
                                
                                @php
                                    $how = $cou;
                                    $de = "";
                                    $matrix_syms = "";
                                    while ($how > 1) {
                                        for ($i = 0; $i < ($cou - 1); $i++) {
                                            if (($cou - 2) == $i) {
                                                $matrix_syms .= "f_" . ($i + 1) . "(" . $with . ")^{" . $de . "} \\\\ ";
                                            } else {
                                                $matrix_syms .= "f_" . ($i + 1) . "(" . $with . ")^{" . $de . "} & ";
                                            }
                                        }
                                        $de .= "'";
                                        $how--;
                                    }
                                @endphp
                                
                                <p class="mt-3">
                                    \( 
                                        W({!! $fs !!})({{$with}}) = 
                                        \begin{vmatrix}
                                         {!! $matrix_syms !!}
                                        \end{vmatrix}
                                    \)
                                </p>
                                <p class="mt-3">{{$lang['8']}}:</p>
                                
                                @php
                                    $how = $cou;
                                    $de = "";
                                    $matrix_vals = "";
                                    while ($how > 1) {
                                        for ($i = 0; $i < ($cou - 1); $i++) {
                                            if (($cou - 2) == $i) {
                                                $matrix_vals .= "(" . $input[$i] . ")^{" . $de . "} \\\\ ";
                                            } else {
                                                $matrix_vals .= "(" . $input[$i] . ")^{" . $de . "} & ";
                                            }
                                        }
                                        $de .= "'";
                                        $how--;
                                    }
                                @endphp
                                
                                <p class="mt-3">
                                    \( 
                                        W({!! $fs !!})({{$with}}) = 
                                        \begin{vmatrix}
                                         {!! $matrix_vals !!}
                                        \end{vmatrix}
                                    \)
                                </p>
                                <p class="mt-3">{{$lang['9']}} ({{$lang['10']}} <a href="https://calculator-online.net/derivative-calculator/" class="text-blue" target="_blank">{{$lang[11]}}</a>):</p>
                                @php $mat = str_replace('[', '|', $detail['matrix']);  @endphp
                                <p class="mt-3">\( W({!! $fs !!})({{$with}}) = {!! str_replace(']', '|', $mat) !!} \)</p>
                                <p class="mt-3">{{$lang['12']}}:</p>
                                <p class="mt-3">\( W({!! $fs !!})({{$with}}) = {!! str_replace(']', '|', $mat) !!} = {!! $detail['res'] !!} \)</p>
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
