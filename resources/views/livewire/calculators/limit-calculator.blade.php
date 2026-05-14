<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full">{!! $error !!}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-9">
                    <label for="EnterEq" class="text-sm">{{$lang['1']}}:</label>
                    <div class="w-full py-2 relative">
                        <input type="text" wire:model.live="EnterEq" id="EnterEq" class="input w-full py-2 px-3 border border-gray-300 rounded-md" placeholder="(6x + 4)/(3x - 1)">
                        <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="col-span-3">
                    <label for="with" class="text-sm">W.R.T:</label>
                    <div class="w-full py-2">
                        <select wire:model.live="with" class="input w-full py-2 px-3 border border-gray-300 rounded-md" id="with">
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

                <!-- Keyboard container -->
                <div class="col-span-12 hidden" id="keyboard-container">
                    <div class="flex flex-wrap gap-2">
                        <button type="button" class="bg-blue-700 text-white rounded h-9 px-3 uppercase  hover:bg-blue-600" onclick="clear_input();">CLS</button>
                        @foreach(['+', '-', '/', '*', '^', 'sqrt(', '(', ')'] as $key)
                            <button type="button" class="keyBtn bg-blue-700 text-white rounded h-9 px-3 uppercase  hover:bg-blue-600" value="{{ $key }}">{{ $key == 'sqrt(' ? '√' : $key }}</button>
                        @endforeach
                    </div>
                </div>

                <div class="col-span-9">
                    <label for="how" class="text-sm">{{$lang['3']}} (inf = ∞ , pi = π):</label>
                    <div class="w-full py-2">
                        <input type="text" wire:model.live="how" id="how" class="input w-full py-2 px-3 border border-gray-300 rounded-md">
                    </div>
                </div>
                <div class="col-span-3">
                    <label for="dir" class="text-sm">{{$lang['4']}}:</label>
                    <div class="w-full py-2">
                        <select wire:model.live="dir" class="input w-full py-2 px-3 border border-gray-300 rounded-md" id="dir">
                            <option value="+">+</option>
                            <option value="-">-</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        @if ($type == 'calculator')
            @include('inc.button')
        @endif
        @if ($type == 'widget')
            @include('inc.widget-button')
        @endif
    </div>
  </form>

    @if($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg p-4 flex items-center justify-center">
                <div class="w-full rounded-lg mt-3">
                    <div class="flex flex-wrap">
                        <div class="w-full text-base">
                            <p class="mt-3 text-lg">\( \lim_{ {{$with}} \to {{$detail['inf'].($detail['dir'] != ' ' ? '^{' . $detail['dir'] . '}' : '')}} }({{$detail['enter']}}) = {{$detail['ans']}} \)</p>
                            
                            <p class="mt-3 font-bold">{{$lang['8']}}</p>
                            <p class="mt-3">\( \lim_{ {{$with}} \to {{$detail['inf'].($detail['dir'] != ' ' ? '^{' . $detail['dir'] . '}' : '')}} }({{$detail['enter']}}) \)</p>
                            
                            <p class="mt-3">{{$lang['9']}}:</p>
                            <p class="mt-3">\(={{$detail['put']}} \)</p>
                            
                            @isset($detail['upr'])
                                <p class="mt-3">
                                    @if ($detail['upr'] < 0 && $detail['btm'] < 0 && $detail['upr'] != 0 && $detail['btm'] != 0)
                                        \(=\dfrac{{ abs($detail['upr']) }}{{ abs($detail['btm']) }} \)
                                    @elseif ($detail['btm'] < 0 && $detail['upr'] != 0 && $detail['btm'] != 0)
                                        \(=\dfrac{-{{ abs($detail['upr']) }}}{{ abs($detail['btm']) }} \)
                                    @else
                                        \(=\dfrac{{ $detail['upr'] }}{{ $detail['btm'] }} \)
                                    @endif
                                </p>
                            @endisset
                            
                            <p class="mt-3">{{$lang['7']}} \( = {{$detail['ans']}} \)</p>
                            <p class="mt-3">{{$lang['10']}} {{$with}} = {{$detail['inf']}}</p>
                            
                            @if(!empty($detail['ser']))
                                <p class="mt-3">\( {{$detail['ser']}} \) <br> <span class="text-base">{{$lang['11']}}</span></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @push('calculatorJS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js"></script>

    <script>
        function processMathAndRender() {
            const target = document.getElementById('result-section');
            if (!target) return;

            // Convert legacy MathJax script tags if any (unlikely in Limit result but good for safety)
            target.querySelectorAll('script[type^="math/tex"]').forEach(script => {
                const display = script.getAttribute('type').includes('mode=display');
                const content = script.textContent;
                const span = document.createElement('span');
                span.innerHTML = display ? `$$${content}$$` : `\\(${content}\\)`;
                script.parentNode.replaceChild(span, script);
            });

            if (typeof renderMathInElement === 'function') {
                renderMathInElement(target, {
                    delimiters: [
                        {left: '$$', right: '$$', display: true},
                        {left: '\\(', right: '\\)', display: false},
                        {left: '$', right: '$', display: false}
                    ],
                    throwOnError: false
                });
            }
        }

        document.addEventListener('livewire:initialized', () => {
            // Initial render
            setTimeout(processMathAndRender, 200);

            @this.on('math-updated', () => {
                setTimeout(processMathAndRender, 200);
            });

            // Keyboard handling
            document.querySelectorAll('.keyBtn').forEach(function(button) {
                button.addEventListener('click', function() {
                    let val = this.value;
                    let current = @this.get('EnterEq');
                    @this.set('EnterEq', current + val);
                });
            });

            document.querySelectorAll('.keyboardImg').forEach(function(element) {
                element.addEventListener('click', function() {
                    const kb = document.getElementById('keyboard-container');
                    kb.classList.toggle('hidden');
                });
            });
        });

        function clear_input() {
            if (confirm("Are you sure you want to clear Equation?")) {
                @this.set('EnterEq', '');
            }
        }
    </script>
    @endpush
</form>
</div>
