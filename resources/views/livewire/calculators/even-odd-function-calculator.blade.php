<div x-data="{
    EnterEq: @entangle('EnterEq').live,
    wrt: @entangle('with').live,
    showKeyboard: false,
    clearInput() {
        if (confirm('Are you sure you want to clear Equation?')) {
            this.EnterEq = '';
        }
    }
}">
<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif

        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
            <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-9">
                    <label for="EnterEq" class="label">{{ $lang['1'] ?? 'Enter Function' }} F(x) = or Y = :</label>
                    <div class="w-full py-2 relative">
                        <input type="text" name="EnterEq" id="EnterEq" class="input" x-model="EnterEq" aria-label="input"/>
                        <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async" @click="showKeyboard = !showKeyboard">
                    </div>
                </div>

                <div class="col-span-3">
                    <label for="with" class="label">&nbsp;</label>
                    <div class="w-full py-2">
                        <select name="with" class="input" id="with" aria-label="select" x-model="wrt">
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

                <div class="col-span-12 keyboard" x-show="showKeyboard" x-transition x-cloak>
                    <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="clearInput()">CLS</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '+'">+</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '-'">-</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '/'">/</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '*'">*</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '^'">^</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += 'sqrt('">√</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '('">(</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += ')'">)</button>
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

    @isset($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 resblue">
            <div>
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif

                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full text-center my-2">
                                <p>
                                    <strong class="bg-[#2845F5] text-white px-3 py-2 text-[21px] rounded-lg">
                                        @if($detail['ans'] == 'e')
                                            {{ $lang['3'] ?? 'Even Function' }}
                                        @elseif($detail['ans'] == 'o')
                                            {{ $lang['4'] ?? 'Odd Function' }}
                                        @else
                                            {{ $lang['5'] ?? 'Neither Even nor Odd' }}
                                        @endif
                                    </strong>
                                </p>
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
            });
        </script>
    @endpush
</form>
</div>
