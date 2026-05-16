<div x-data="{ 
    keyboard: false,
    examples: [
        't^2', '(10t)^{3/2}', 'sin(2t)', 'cos(5t)', 'e^{3t}', 
        'sinh(4t)', 'cosh(t)', 't * sin(t)', 'e^{-2t} * cos(3t)', '3t^4 - 5t^2 + 2'
    ],
    loadExample() {
        const random = this.examples[Math.floor(Math.random() * this.examples.length)];
        $wire.set('EnterEq', random);
        $wire.set('detail', null);
        $wire.set('error', null);
    }
}">
    <style>
        @keyframes blink {
            0%, 100% { border-color: transparent; }
            50% { border-color: #2845F5; }
        }
        #exampleLoadBtn {
            animation: blink 1s infinite;
            border: 2px solid transparent;
            background: #1670a712;
            padding: 7px 10px;
            border-radius: 100px;
            cursor: pointer;
            font-size: 12px;
            color: #000000;
        }
        @isset($detail)
        #exampleLoadBtn { background: #1670a712 !important; }
        @endisset
        [x-cloak] { display: none !important; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <div class="">
                            <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                                <div class="flex items-center col-span-12 md:col-span-8 lg:col-span-8">
                                    <label for="EnterEq" class="text-[12px]">
                                        {{ $lang['1'] }} {{ $lang['2'] }} e^(3t) {{ $lang['3'] }} e^{3t}
                                    </label>
                                </div>
                                <div class="col-span-12 md:col-span-4 lg:col-span-4 flex justify-end">
                                    <button type="button" @click="loadExample()" class="flex border rounded-lg p-1 items-center" id="exampleLoadBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right size-5 me-1" style="transform: rotate(180deg);"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                                        Load Example
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="w-full py-2 relative">
                            <input type="text" wire:model.live="EnterEq" id="EnterEq" class="input" aria-label="input" />
                            <img src="{{ asset('images/keyboard.png') }}" width="35" style="top: 31px" height="35" alt="keyboard" loading="lazy" decoding="async" 
                                 class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" 
                                 @click="keyboard = !keyboard">
                        </div>
                        <div class="col-span-12 keyboard" x-show="keyboard" x-cloak>
                            <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" 
                                    @click="if(confirm('Are you sure you want to clear Equation?')) $wire.EnterEq = ''">CLS</button>
                            @foreach(['+', '-', '/', '*', '^', 'sqrt(', '(', ')'] as $char)
                                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" 
                                        @click="$wire.EnterEq += '{{ $char }}'">{{ $char === 'sqrt(' ? '√' : $char }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @isset($detail)
        <hr>
        <div id="result-section" wire:key="result-{{ count($detail) }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full text-center my-3">
                                <p><strong class="bg-[#ffffff] p-3 text-[25px] rounded-lg">\( \color{#1670a7}{ {{$detail['ans']}} } \)</strong></p>
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
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('math-updated', () => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                // Proactive rendering after any Livewire update
                Livewire.hook('morph.updated', ({ el }) => {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(el);
                    }
                });
            });
        </script>
    @endpush
</div>
