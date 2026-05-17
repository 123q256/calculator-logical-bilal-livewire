<div x-data="{ showKeyboard: false }">
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="EnterEq" class="font-s-14 text-blue text-left">{{$lang['1']}} Please write e^x as e^{x}:</label>
                <div class="w-full py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" wire:model.live="EnterEq" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async" @click="showKeyboard = !showKeyboard">
                </div>
            </div>
            <div class="col-span-12" x-show="showKeyboard" x-collapse style="display: none;" wire:ignore>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="confirm('Are you sure you want to clear Equation?') && ($wire.EnterEq = '')">CLS</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq = ($wire.EnterEq || '') + '+'">+</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq = ($wire.EnterEq || '') + '-'">-</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq = ($wire.EnterEq || '') + '/'">/</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq = ($wire.EnterEq || '') + '*'">*</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq = ($wire.EnterEq || '') + '^'">^</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq = ($wire.EnterEq || '') + 'sqrt('">√</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq = ($wire.EnterEq || '') + '('">(</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq = ($wire.EnterEq || '') + ')'">)</button>
            </div>
            <div class="col-span-12">
                <label for="with" class="font-s-14 text-blue text-left">{{$lang['2']}} W.R.T:</label>
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
                                @if(isset($detail['final_res']))
                                    @php $j="'"; @endphp
                                    @for($i=1; $i < count($detail['final_res']); $i++)
                                        <p class="mt-3 text-[18px]"><strong>\( f{!! $j !!} (x)\) {{$lang['2']}}</strong></p>
                                        <p class="mt-3 text-[18px]">\( {!! $detail['final_res'][$i+1] !!} \)</p>
                                        @php $i++;$j.="'"; @endphp
                                        @php $i++; @endphp
                                        <div x-data="{ open: false }" class="w-full my-4">
                                            <div class="w-full mt-3">
                                                <button type="button" @click="open = !open" class="calculate bg-blue-700 text-white rounded px-4 py-2 hover:bg-blue-600 transition duration-300 flex items-center gap-2" style="font-size: 16px;cursor: pointer;">
                                                    <span>{{$lang['6']}}</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="w-full mt-3 res_step border-l-4 border-blue-500 pl-4 py-3 bg-blue-50/30 rounded-r-lg" 
                                                 x-show="open" 
                                                 x-transition:enter="transition ease-out duration-300 transform"
                                                 x-transition:enter-start="opacity-0 -translate-y-3"
                                                 x-transition:enter-end="opacity-100 translate-y-0"
                                                 x-transition:leave="transition ease-in duration-200 transform"
                                                 x-transition:leave-start="opacity-100 translate-y-0"
                                                 x-transition:leave-end="opacity-0 -translate-y-3"
                                                 style="display: none;">
                                                <p class="mt-3">{!! $detail['final_res'][$i] !!}</p>
                                            </div>
                                        </div>
                                    @endfor
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
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="if (typeof convertLegacyMathScripts === 'function') { convertLegacyMathScripts(); } if (typeof renderMathInElement === 'function') { renderMathInElement(document.body); }"></script>
        <script>
            function convertLegacyMathScripts() {
                document.querySelectorAll('script[type^="math/tex"]').forEach(script => {
                    const isDisplay = script.type.includes('mode=display');
                    const mathText = script.textContent;
                    const span = document.createElement(isDisplay ? 'div' : 'span');
                    span.className = isDisplay ? 'math-display-block' : 'math-inline-block';
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
