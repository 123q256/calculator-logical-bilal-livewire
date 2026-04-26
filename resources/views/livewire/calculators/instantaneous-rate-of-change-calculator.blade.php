<div x-data="{ 
    enterEq: @entangle('EnterEq'),
    addChar(char) {
        this.enterEq += char;
    }
}">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4 items-center">
                    {{-- Equation Input --}}
                    <div class="col-span-12 md:col-span-10">
                        <label for="EnterEq" class="font-s-14 text-blue block mb-1">{{ $lang['1'] }}:</label>
                        <div class="relative">
                            <input type="text" x-model="enterEq" id="EnterEq" class="input w-full"
                                placeholder="(6x^2 - 4)" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-2 flex items-end h-full pb-2">
                        <span class="text-blue cursor-pointer hover:opacity-80 transition-opacity" wire:click="toggleKeyboard">
                            <img src="{{ asset('images/keyboard.png') }}" class="w-10 h-10 object-contain"
                                alt="keyboard">
                        </span>
                    </div>

                    {{-- Virtual Keyboard --}}
                    <div class="col-span-12 mt-2 {{ $showKeyboard ? 'flex' : 'hidden' }} justify-center flex-wrap gap-2">
                        @foreach(['CLS', '+', '-', '/', '*', '^', 'sqrt(', '(', ')'] as $key)
                            <button type="button"
                                class="bg-blue-600 text-white rounded-md h-10 px-4 font-semibold shadow hover:bg-blue-700 transition-colors"
                                @if($key === 'CLS') 
                                    @click="if(confirm('Are you sure you want to clear Equation?')) enterEq = ''"
                                @else
                                    @click="addChar('{{ $key }}')"
                                @endif
                            >{{ $key === 'sqrt(' ? '√' : $key }}</button>
                        @endforeach
                    </div>

                    {{-- X Point Input --}}
                    <div class="col-span-4 md:col-span-3">
                        <p class="font-semibold text-blue text-lg text-right pr-2">x = {{ $lang['2'] }}</p>
                    </div>
                    <div class="col-span-8 md:col-span-9">
                        <input type="number" step="any" wire:model.live="x" id="x" class="input w-full"
                            placeholder="4" />
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
        <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full text-[18px]" wire:key="result-content-{{ md5($detail['equation'] . $detail['deriv'] . $detail['steps']) }}">
                                <p class="mt-2">{{ $lang['3'] }}</p>
                                <div class="overflow-auto" wire:ignore>
                                    <p class="mt-2">\( { \partial ({{ $detail['equation'] }}) \over {\partial x}} \)<span>\(
                                            {{ $lang['4'] }}
                                            \space x = {{ $x }} \)</span></p>
                                    <p class="mt-2">{{ $lang['5'] }}</p>
                                    <p class="mt-2">\( {{ $detail['deriv'] }} \)</p>
                                    <p class="mt-2">{{ $lang['6'] }}:</p>
                                    <div class="mt-2 px-3"> {!! $detail['steps'] !!}</div>
                                    <p class="mt-2"><strong>3. {{ $lang['7'] }}:</strong> \( {{ $detail['deriv'] }} \)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @if (isset($detail))
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.hook('morph.updated', () => {
                    setTimeout(() => {
                        if (window.MathJax) {
                            MathJax.typesetPromise();
                        }
                    }, 50);
                });
            });
        </script>
    @endif
</div>
