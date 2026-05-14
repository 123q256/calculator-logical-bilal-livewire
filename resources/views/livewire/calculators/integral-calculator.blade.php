<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{!! $error !!}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-9">
                        <label for="EnterEq" class="label">{{ $lang['6'] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="text" wire:model.live="EnterEq" id="EnterEq" class="border border-gray-300 rounded w-full p-2" placeholder="cos(x)^3*sin(x)">
                            <img src="{{ asset('images/keyboard.png') }}" width="40" height="35" alt="keyboard" loading="lazy" decoding="async" class="absolute top-2 right-3 cursor-pointer keyboardImg">
                        </div>
                    </div>
                    <div class="col-span-3">
                        <label for="with" class="label">W.R.T:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="with" class="border border-gray-300 rounded w-full p-2" id="with">
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

                    <!-- Keyboard -->
                    <div class="col-span-12 hidden keyboard" id="keyboard-container">
                        <div class="flex flex-wrap gap-2">
                            <button type="button" class="bg-blue-700 text-white rounded-sm h-9 px-3 uppercase shadow-md hover:bg-blue-600" onclick="clear_input();">CLS</button>
                            @foreach(['+', '-', '/', '*', '^', 'sqrt(', '(', ')'] as $token)
                                <button type="button" class="keyBtn bg-blue-700 text-white rounded-sm h-9 px-3 uppercase shadow-md hover:bg-blue-600" value="{{ $token }}">{{ $token == 'sqrt(' ? '√' : $token }}</button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Integration Type -->
                    <div class="col-span-12 flex items-center px-2 mt-3">
                        <p>
                            <input type="radio" wire:model.live="form" id="def" value="def" class="mr-2">
                            <label for="def" class="text-base">Definite</label>
                        </p>
                        <p class="ml-4">
                            <input type="radio" wire:model.live="form" id="ind" value="ind" class="mr-2">
                            <label for="ind" class="text-base">Indefinite</label>
                        </p>
                    </div>

                    @if($form === 'def')
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="ub" class="label">{{ $lang['3'] }}:</label>
                        <div class="w-full py-2">
                            <input type="text" wire:model.live="ub" id="ub" class="border border-gray-300 rounded w-full p-2">
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="lb" class="label">{{ $lang['4'] }}:</label>
                        <div class="w-full py-2">
                            <input type="text" wire:model.live="lb" id="lb" class="border border-gray-300 rounded w-full p-2">
                        </div>
                    </div>
                    @endif
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
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full p-3 rounded-lg mt-3">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="text-base">
                            @if(isset($detail['defi']))
                                <p class="mt-3 text-lg font-semibold">{{ $lang['7'] }}</p>
                                <p class="mt-3 text-lg">\( {{$detail['defi']}} \)</p>
                            @endif

                            <p class="mt-3 text-lg font-semibold">{{ $lang['8'] }}</p>
                            <p class="mt-3 text-lg">\( {{$detail['ans']}} + \text{ constant} \)</p>

                            <p class="mt-3 text-lg font-semibold">{{ $lang['6'] }}</p>
                            @if(isset($detail['defi']))
                                <p class="mt-3">\( \int_{ {{ $lb . '}^{' . $ub }}} {{ $detail['enter'] }}\, d{{ $with }} \)</p>
                            @else
                                <p class="mt-3">\( \int {{ $detail['enter'] }}\, d{{ $with }} \)</p>
                            @endif

                            <p class="mt-3 text-lg font-semibold">Solution:</p>
                            <div class="w-full res_step overflow-auto mt-2">
                                {!! $detail['buffer'] !!}
                            </div>
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
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body, { delimiters: [{left: '$$', right: '$$', display: true}, {left: '\\(', right: '\\)', display: false}, {left: '$', right: '$', display: false}] });"></script>
        
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body, {
                                delimiters: [
                                    {left: '$$', right: '$$', display: true},
                                    {left: '\\(', right: '\\)', display: false},
                                    {left: '$', right: '$', display: false}
                                ]
                            });
                        }
                    }, 150);
                });

                // Initial render
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }

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
</div>
