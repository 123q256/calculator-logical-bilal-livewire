<div x-data="{
    EnterEq: @entangle('EnterEq').live,
    with: @entangle('with').live,
    point: @entangle('point').live,
    n: @entangle('n').live
}" x-init="$watch('EnterEq', value => {
    if (typeof EquPreview === 'function') {
        EquPreview(value, 0);
    }
})">
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
             <div class="col-span-9">
                <label for="EnterEq" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Enter Function' }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" x-model="EnterEq" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-span-3">
                <label for="with" class="font-s-14 text-blue">Variable:</label>
                <div class="w-100 py-2">
                    <select name="with" class="input" id="with" x-model="with" aria-label="select">
                        <option value="x">x</option>
                        <option value="y">y</option>
                        <option value="z">z</option>
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
                        <option value="n">n</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 hidden keyboard">
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
            <div class="col-span-6">
                <label for="point" class="font-s-14 text-blue">{{ $lang['3'] ?? 'At point' }}:</label>
                <div class="w-100 py-2">
                    <input type="number" name="point" id="point" class="input" min="0" max="10" x-model="point" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="n" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Show up to degree' }} n:</label>
                <div class="w-100 py-2">
                    <input type="number" name="n" id="n" class="input" min="0" max="10" x-model="n" aria-label="input"/>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="row">
                        <div class="w-full text-center text-[18px] overflow-auto">
                            <p>{{ $lang[8] ?? 'Power Series representation:' }}</p>
                            <p class="mb-3 mt-4 bg-white px-3 text-[20px] rounded-lg text-blue col-lg-10 mx-auto" style="overflow-x: auto">$$ \color{#1670a7} { {{$detail['ans']}} } $$</p>
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
    onload="renderMathInElement(document.body);"></script>
    <script>
        function clear_input() {
            var check = confirm("Are you sure you want to clear Equation?");
            if (check === true) {
                var enterEq = document.getElementById('EnterEq');
                enterEq.value = '';
                enterEq.dispatchEvent(new Event('input'));
            }
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
