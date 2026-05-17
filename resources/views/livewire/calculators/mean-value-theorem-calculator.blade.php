<div x-data="{
    EnterEq: @entangle('EnterEq').live,
    with: @entangle('with').live,
    lb: @entangle('lb').live,
    ub: @entangle('ub').live,
    showKeyboard: false,
    examples: [
        { eq: '(x^2+4)^(1/2)', lb: 1, ub: 4, with: 'x' },
        { eq: 'x^3 - 3*x', lb: 0, ub: 2, with: 'x' },
        { eq: 'x^2 - 4*x + 3', lb: 1, ub: 3, with: 'x' },
        { eq: 'sin(x)', lb: 0, ub: 3.14159, with: 'x' },
        { eq: 'ln(x)', lb: 1, ub: 3, with: 'x' }
    ],
    loadRandomExample() {
        let current = this.EnterEq;
        let filtered = this.examples.filter(ex => ex.eq !== current);
        let selected = filtered[Math.floor(Math.random() * filtered.length)];
        this.EnterEq = selected.eq;
        this.lb = selected.lb;
        this.ub = selected.ub;
        this.with = selected.with;
        $wire.detail = null;
        $wire.error = null;
    },
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
    #exampleLoadBtn {
        background: #1670a712 !important;
        border: 1px solid #1670a730 !important;
        color: #1670a7 !important;
        transition: all 0.2s ease-in-out;
    }
    #exampleLoadBtn:hover {
        background: #1670a724 !important;
        transform: translateY(-1px);
    }
</style>
   <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 md:col-span-8 lg:col-span-8 flex items-center">
                        <label for="EnterEq" class="label">{{$lang['1']}}:</label>
                    </div>
                    <div class="col-span-12 md:col-span-4 lg:col-span-4 flex justify-end items-center">
                        <button type="button" class="flex items-center p-1 px-2.5 rounded-lg text-[12px] font-semibold" id="exampleLoadBtn" @click="loadRandomExample()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right size-4 me-1" style="transform: rotate(180deg);"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                            Load Example
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-span-9">
                <div class="w-full py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" wire:model.live="EnterEq" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async" @click="showKeyboard = !showKeyboard">
                </div>
            </div>
            <div class="col-span-3">
                <div class="w-full py-2">
                    <select name="with" class="input" id="with" aria-label="select" wire:model.live="with">
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
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="clearInput()">CLS</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '+'">+</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '-'">-</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '/'">/</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '*'">*</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '^'">^</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += 'sqrt('">√</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '('">(</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += ')'">)</button>
            </div>
            <div class="col-span-6">
                <label for="lb" class="label">{{$lang['3']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="lb" id="lb" class="input" wire:model.live="lb" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ub" class="label">{{$lang['4']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="ub" id="ub" class="input" wire:model.live="ub" aria-label="input"/>
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
    
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="col-12 text-[16px]">
                                <p class="mt-2 text-[18px]"><strong>{{$detail['root']}}</strong></p>
                                <p class="mt-3"><strong>{{$lang['6']}}</strong></p>
                                <p class="mt-3">{{$lang['7']}} \(f={{$detail['enter']}} \) {{$lang['8']}} \( [{{$detail['lb'].','.$detail['ub']}}]\)</p>
                                <p class="mt-3">{{$lang['9']}} \([a,b]\) {{$lang['10']}}, \(f′(c)= \frac{f(b)−f(a)}{b−a}\).</p>
                                <p class="mt-3">{{$lang['11']}}:</p>
                                <p class="mt-3">\( f({{$detail['ub']}}) = {{$detail['end']}} \)</p>
                                <p class="mt-3">\( f({{$detail['lb']}}) = {{$detail['start']}} \)</p>
                                <p class="mt-3">{{$lang['12']}}:</p>
                                <p class="mt-3">\( f'(c)= {{$detail['deri']}} \)</p>
                                <p class="mt-3">{{$lang['13']}}:</p>
                                <p class="mt-3">\( {{$detail['deri']}} = \frac{{{$detail['end'].'-('.$detail['start'].')'}}}{{{$detail['ub'].'-('.$detail['lb'].')'}}} \)</p>
                                <p class="mt-3">{{$lang['14']}}:</p>
                                <p class="mt-3">\( {{$detail['deri']}} = {{$detail['simple']}} \)</p>
                                <p class="mt-3">{{$lang['15']}}:</p>
                                <p class="mt-3">\( {{$lang['5']}} = {{$detail['root']}} \)</p>
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
        document.addEventListener('livewire:navigated', () => {
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body);
            }
        });
    </script>
    @endpush
</form>
</div>
