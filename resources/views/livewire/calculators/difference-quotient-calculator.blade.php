<div>
<style>
  @keyframes blink {
    0%, 100% {
      border-color: transparent;
    }
    50% {
      border-color: #2845F5;
    }
  }

  #exampleLoadBtn {
    animation: blink 1s infinite;
    border: 2px solid transparent; /* Default border transparent */
    background: #1670a712;
    padding: 7px 15px;
    border-radius: 5px;
    cursor: pointer;
    color: #000000;
  }
</style>

 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3" x-data="{ showKeyboard: false }">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-6 flex items-center">
                     <label for="EnterEq" class="label">{{$lang['1']}} f:</label>
                    </div>
                    <div class="col-span-6 flex justify-end">
                        <button type="button" class="flex items-center text-[14px]" id="exampleLoadBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right size-4 me-1" style="transform: rotate(180deg);"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                            Load Example
                        </button>
                    </div>
                </div>
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
                                <p class="mt-3 text-[21px]"><strong>{{$lang['3']}}</strong></p>
                                <p class="mt-3">
                                    \( f({{$detail['with']}}) = {!! $detail['enter'] !!} \) is \( {!! $detail['res'] !!} \)
                                </p>
                                @php
                                    $with = $detail['with'];
                                    $replaced_enter = str_replace($with, "({$with} + h)", $detail['enter']);
                                @endphp
                                <p class="mt-3 text-[21px]"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-3">{{$lang['5']}}: \( f({{$detail['with']}}) = {!! $detail['enter'] !!} \)</p>
                                <p class="mt-3 font-s-20"><strong>{{$lang['6']}}:</strong></p>
                                <p class="mt-4">\( \frac{f({{$detail['with']}}+h)-f({{$detail['with']}})}{h} \)</p>
                                <p class="mt-3">{{$lang['7']}} \(f({{$detail['with']}}+h)\), {{$lang['8']}} \({{$detail['with']}} + h\) {{$lang['9']}} \({{$detail['with']}}\):</p>
                                <p class="mt-4">\( f({{$detail['with']}}+h) = {!! str_replace($detail['with'], "(".$detail['with']." + h)", $detail['enter']) !!} \)</p>
                                <p class="mt-3"><strong>{{$lang['10']}}</strong>,</p>
                                <p class="mt-3">\( \frac{f({{$with}}+h)-f({{$with}})}{h} \)</p>
                                <p class="mt-3">
                                    \( = \frac{ \left( {!! $replaced_enter !!} \right) - \left( {!! $detail['enter'] !!} \right) }{h} \)
                                </p>
                                <p class="mt-3">\( = {!! $detail['res'] !!} \)</p>
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

            // Instant Client-side Load Example
            document.addEventListener('livewire:initialized', () => {
                const btn = document.querySelector('#exampleLoadBtn');
                if (btn) {
                    btn.addEventListener('click', () => {
                        const eq = [
                            "2x + 5",
                            "3 - x",
                            "1/2x^2 + 3x - 4",
                            "x^3 - 3x^2 + 2x + 5",
                            "3x^2 + 2x + 5",
                        ];
                        const t = eq[Math.floor(Math.random() * eq.length)];
                        const input = document.getElementById('EnterEq');
                        if (input) {
                            input.value = t;
                            // Dispatch event so Livewire updates its model state instantly
                            input.dispatchEvent(new Event('input'));
                        }
                    });
                }
            });
        </script>
    @endpush
</form>
</div>
