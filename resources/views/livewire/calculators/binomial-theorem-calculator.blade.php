<div x-data="{ keyboard: false }">
    <style>
        [x-cloak] { display: none !important; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="EnterEq" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="text" wire:model.live="EnterEq" id="EnterEq" class="input" aria-label="input" />
                            <img src="{{ asset('images/keyboard.png') }}" width="35" style="top: 31px" height="35" alt="keyboard" 
                                 class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" 
                                 @click="keyboard = !keyboard">
                        </div>
                        
                        {{-- Keyboard --}}
                        <div x-show="keyboard" x-cloak class="col-span-12 keyboard">
                            <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" 
                                    @click="if(confirm('Are you sure you want to clear Equation?')) $wire.EnterEq = ''">CLS</button>
                            @foreach(['+', '-', '/', '*', '^', 'sqrt(', '(', ')'] as $char)
                                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" 
                                        @click="$wire.EnterEq += '{{ $char }}'">{{ $char === 'sqrt(' ? '√' : $char }}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="x" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="x" id="x" class="input" aria-label="input" />
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
                            <div class="w-full text-center my-3 overflow-x-auto py-4">
                                <p><strong class="bg-[#ffffff] p-3 text-[21px] rounded-lg whitespace-nowrap">\( \color{#000000}{ {{ $detail['ans'] }} } \)</strong></p>
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

                Livewire.hook('morph.updated', ({ el }) => {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(el);
                    }
                });
            });
        </script>
    @endpush
</div>
