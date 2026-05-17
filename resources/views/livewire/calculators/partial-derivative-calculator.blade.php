<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="EnterEq" class="label text-left">{{$lang['1']}} f(x,y): {{$lang['2']}} e^x {{$lang['3']}} e^{x}</label>
                <div class="w-full py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" wire:model.live="EnterEq" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-span-12 hidden keyboard" wire:ignore>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" onclick="clear_input();">CLS</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="+">+</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="-">-</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="/">/</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="*">*</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="^">^</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="sqrt(">√</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="(">(</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value=")">)</button>
            </div>
            <div class="col-span-12">
                <label for="with" class="label text-left">{{$lang['4']}} W.R.T:</label>
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
            <div class="col-span-12 hidden">
                <label for="how" class="label text-left">{{$lang['5']}}:</label>
                <div class="w-full py-2">
                    <select name="how" class="input" id="how" wire:model.live="how" aria-label="select">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
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
                        @if($how > 1 && isset($detail['final_res']))
                            @php $j="'"; @endphp
                            @for($i=1; $i < count($detail['final_res']); $i++)
                                <p class="mt-3 text-[18px]"><strong>\( f{!! $j !!} (x)\) {{$lang['7']}}</strong></p>
                                <p class="mt-3 text-[18px]">\( {!! $detail['final_res'][$i+1] !!} \)</p>
                                @php $i++;$j.="'"; @endphp
                                @php $i++; @endphp
                                <div x-data="{ open: false }" class="w-full">
                                    <div class="w-full mt-3">
                                        <button type="button" @click="open = !open" class="calculate bg-blue-700 text-white rounded px-4 py-2 hover:bg-blue-600 transition" style="font-size: 16px;cursor: pointer;">
                                            {{$lang['8']}}
                                        </button>
                                    </div>
                                    <div class="w-full mt-3 res_step" x-show="open" style="display: none;">
                                        <p class="mt-3">{!! $detail['final_res'][$i] !!}</p>
                                    </div>
                                </div>
                            @endfor
                        @else
                            <p class="mt-3 text-[18px]"><strong>{{$lang['7']}}</strong></p>
                            <p class="mt-3 text-[18px]">\( {!! $detail['simple'] !!} \)</p>
                            <p class="mt-3 text-[18px]"><strong>Solution:</strong></p>
                            <div class="w-full mt-3 res_step">
                                <p class="mt-3">{!! $detail['buffer'] !!}</p>
                            </div>
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
        function clear_input() {
            var check = confirm("Are you sure you want to clear Equation?");
            if (check === true) {
                var enterEq = document.getElementById('EnterEq');
                enterEq.value = '';
                enterEq.dispatchEvent(new Event('input'));
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            convertLegacyMathScripts();
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body);
            }

            document.querySelectorAll('.keyBtn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var val = this.value;
                    var enterEq = document.getElementById('EnterEq');
                    enterEq.value += val;
                    enterEq.dispatchEvent(new Event('input'));
                });
            });
            document.querySelectorAll('.keyboardImg').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.querySelectorAll('.keyboard').forEach(function(keyboard) {
                        if (keyboard.style.display === 'none' || keyboard.style.display === '') {
                            keyboard.style.display = 'block';
                            keyboard.style.transition = 'display 1.5s ease-out';
                        } else {
                            keyboard.style.display = 'none';
                            keyboard.style.transition = 'display 1.5s ease-out';
                        }
                    });
                });
            });
        });
    </script>
@endpush
</form>
</div>
