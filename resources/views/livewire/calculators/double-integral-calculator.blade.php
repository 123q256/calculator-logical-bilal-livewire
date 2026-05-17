<div x-data="{ showKeyboard: false }">
<style>
    .integral_input{
        height: 30px;
        background: var(--white);
        padding-left: 5px;
        border: 1px solid #D2D4D8;
        border-radius: 5px;
        color: var(--black);
        font-size: 15px;
        box-sizing: border-box;
        width: 35px;
        outline: 0;
    }
    .integ_symb{
        font-size: 7rem;
        line-height: normal;
    }
    .bracket_symbol{
        font-size: 5rem;
    }
    @media (max-width: 480px){
        .integ_symb{ font-size: 4rem; }
        .bracket_symbol{ font-size: 3rem; }
        #lby,#lbx{ margin-top: 5px !important }
        #ubx,#uby{ margin-bottom: 0px !important }
    }
    #responseContainer{ line-height: 2 }
    .icon_animation {
        display: inline-block; position: relative;
        width: 100%; height: 80px;
    }
    .icon_animation samp {
        display: inline-block; position: absolute;
        left: 0; background: #EEF1F5;
        animation: icon_animation 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        height: 8px;
    }
    .icon_animation samp:nth-child(1){ top: 10px; animation-delay: -0.24s; }
    .icon_animation samp:nth-child(2){ top: 28px; animation-delay: -0.12s; }
    .icon_animation samp:nth-child(3){ top: 47px; animation-delay: 0s; }
    .icon_animation samp:nth-child(4){ top: 66px; animation-delay: 0.12s; }
    .icon_animation samp:nth-child(5){ top: 85px; animation-delay: 0.24s; }
    @keyframes icon_animation {
        0%{ left: 0; width: 0; }
        50%, 100%{ left: 0; width: 100%; }
    }
</style>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-1w  gap-2 md:gap-4 lg:gap-4">

            <div class="flex items-center align-items-center justify-content-center" id="inputsField">
                <div class="w-[100px]">
                    <input type="text" wire:model.live="ubx" id="ubx" class="integral_input" aria-label="input" autocomplete="off" style="margin-left: -10px;margin-bottom: 5px;"/>
                    <p class="text-blue integ_symb">∫</p>
                    <input type="text" wire:model.live="lbx" id="lbx" class="integral_input" aria-label="input" autocomplete="off" style="margin-left: -10px;margin-top: -5px;"/>
                </div>
                <div class="mx-2 w-[100px]">
                    <input type="text" wire:model.live="uby" id="uby" class="integral_input" aria-label="input" autocomplete="off" style="margin-bottom: 5px;"/>
                    <p class="text-blue integ_symb">∫</p>
                    <input type="text" wire:model.live="lby" id="lby" class="integral_input" aria-label="input" autocomplete="off" style="margin-top: -5px;"/>
                </div>
                <p class="text-blue bracket_symbol">(</p>
                @if($device == "desktop")
                    <div class="flex-1">
                        <label for="EnterEq" class="font-s-14 text-blue">Function:</label>
                        <div class="py-2 relative">
                            <input type="text" wire:model.live="EnterEq" id="EnterEq" class="input w-full" aria-label="input" autocomplete="off"/>
                            <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async" @click="showKeyboard = !showKeyboard">
                        </div>
                    </div>
                @else
                    <div class="flex-1">
                        <div class="flex items-center justify-between px-1">
                            <label for="EnterEq" class="font-s-14 text-blue">Function:</label>
                        </div>
                        <div class="relative">
                            <input type="text" wire:model.live="EnterEq" id="EnterEq" class="input w-full" aria-label="input" autocomplete="off"/>
                            <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async" @click="showKeyboard = !showKeyboard">
                        </div>
                    </div>
                @endif
                <p class="text-blue bracket_symbol">)</p>
                <div>
                    <label for="with" class="font-s-14 text-blue">W.R.T:</label>
                    <div class="w-100 py-2">
                        <select wire:model.live="with" class="input" id="with" aria-label="select">
                            <option value="xy">dxdy</option>
                            <option value="yx">dydx</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Virtual Keyboard --}}
            <div class="mt-3" x-show="showKeyboard" x-collapse style="display: none;" wire:ignore>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-3 uppercase shadow-md hover:bg-blue-600"
                    @click="confirm('Are you sure you want to clear Equation?') && ($wire.EnterEq = '')">CLS</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-3 uppercase shadow-md hover:bg-blue-600"
                    @click="$wire.EnterEq = ($wire.EnterEq || '') + '+'">+</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-3 uppercase shadow-md hover:bg-blue-600"
                    @click="$wire.EnterEq = ($wire.EnterEq || '') + '-'">-</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-3 uppercase shadow-md hover:bg-blue-600"
                    @click="$wire.EnterEq = ($wire.EnterEq || '') + '/'">/</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-3 uppercase shadow-md hover:bg-blue-600"
                    @click="$wire.EnterEq = ($wire.EnterEq || '') + '*'">*</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-3 uppercase shadow-md hover:bg-blue-600"
                    @click="$wire.EnterEq = ($wire.EnterEq || '') + '^'">^</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-3 uppercase shadow-md hover:bg-blue-600"
                    @click="$wire.EnterEq = ($wire.EnterEq || '') + 'sqrt('">√</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-3 uppercase shadow-md hover:bg-blue-600"
                    @click="$wire.EnterEq = ($wire.EnterEq || '') + '('">(</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-3 uppercase shadow-md hover:bg-blue-600"
                    @click="$wire.EnterEq = ($wire.EnterEq || '') + ')'">)</button>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result overflow-auto">
        <div>
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full font-16">
                        <p class="mt-3 font-s-18"><strong>{{$lang['8']}}</strong></p>
                        <p class="mt-3 font-s-18">\( = {!! $detail['final'] !!} + \mathrm{constant} \)</p>

                        @if(isset($detail['def']) && $detail['def'] === 'def')
                            <p class="mt-3 font-s-18"><strong>{{$lang['9']}}</strong></p>
                            <p class="mt-3 font-s-18">\( = {!! $detail['finaln'] !!} \)</p>
                        @endif

                        <p class="mt-3"><strong>{{$lang['7']}}</strong></p>
                        <p class="mt-3">\( {!! $detail['enter'] !!} \)</p>

                        <p class="mt-3"><strong>{{$lang['10']}}</strong></p>

                        <p class="mt-3">{{$lang['11']}}:</p>
                        <p class="mt-3 mb-3">\( {!! $detail['en1'] !!} \)</p>

                        <div x-data="{ open1: false }" class="w-full my-3">
                            <button type="button" @click="open1 = !open1" class="bg-blue-700 text-white rounded px-4 py-2 hover:bg-blue-600 transition duration-300 flex items-center gap-2">
                                <span>Show Solution</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-300" :class="open1 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="w-full mt-3 border-l-4 border-blue-500 pl-4 py-3 bg-blue-50/30 rounded-r-lg"
                                 x-show="open1"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 -translate-y-3"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 -translate-y-3"
                                 style="display: none;">
                                {!! $detail['step1'] !!}
                            </div>
                        </div>

                        <p class="mt-3">{{$lang['12']}}:</p>
                        <p class="mt-3 mb-3">\( {!! $detail['en2'] !!} \)</p>

                        <div x-data="{ open2: false }" class="w-full my-3">
                            <button type="button" @click="open2 = !open2" class="bg-blue-700 text-white rounded px-4 py-2 hover:bg-blue-600 transition duration-300 flex items-center gap-2">
                                <span>Show Solution</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-300" :class="open2 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="w-full mt-3 border-l-4 border-blue-500 pl-4 py-3 bg-blue-50/30 rounded-r-lg"
                                 x-show="open2"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 -translate-y-3"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 -translate-y-3"
                                 style="display: none;">
                                {!! $detail['step2'] !!}
                            </div>
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
            onload="if (typeof convertLegacyMathScripts === 'function') { convertLegacyMathScripts(); } if (typeof renderMathInElement === 'function') { renderMathInElement(document.body); }">
        </script>
        <script>
            function convertLegacyMathScripts() {
                document.querySelectorAll('script[type^="math/tex"]').forEach(script => {
                    const isDisplay = script.type.includes('mode=display');
                    const mathText = script.textContent;
                    const span = document.createElement(isDisplay ? 'div' : 'span');
                    span.textContent = isDisplay ? '$$' + mathText + '$$' : '\\(' + mathText + '\\)';
                    script.parentNode.replaceChild(span, script);
                });
            }
            document.addEventListener('DOMContentLoaded', () => {
                convertLegacyMathScripts();
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</form>
</div>
