<div x-data="{
    EnterEq: @entangle('EnterEq').live,
    with: @entangle('with').live,
    lb: @entangle('lb').live,
    ub: @entangle('ub').live,
    n: @entangle('n').live,
    sum_type: @entangle('sum_type').live,
    showKeyboard: false,
    examples: [
        { eq: '(x^2+4)^(1/2)', lb: 1, ub: 4, n: 5, type: '1', with: 'x' },
        { eq: 'sin(x)', lb: 0, ub: 3.14159, n: 6, type: '3', with: 'x' },
        { eq: 'x^3 - 2x', lb: 0, ub: 2, n: 4, type: '2', with: 'x' },
        { eq: '1/x', lb: 1, ub: 3, n: 8, type: '4', with: 'x' },
        { eq: 'e^(-x^2)', lb: -1, ub: 1, n: 10, type: '1', with: 'x' }
    ],
    loadRandomExample() {
        let current = this.EnterEq;
        let filtered = this.examples.filter(ex => ex.eq !== current);
        let selected = filtered[Math.floor(Math.random() * filtered.length)];
        this.EnterEq = selected.eq;
        this.lb = selected.lb;
        this.ub = selected.ub;
        this.n = selected.n;
        this.sum_type = selected.type;
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
                <label for="lb" class="label">{{$lang['2']}}:</label>
                <div class="w-full py-2">
                    <input type="number" name="lb" id="lb" class="input" wire:model.live="lb" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ub" class="label">{{$lang['3']}}:</label>
                <div class="w-full py-2">
                    <input type="number" name="ub" id="ub" class="input" wire:model.live="ub" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="n" class="label">{{$lang['4']}}:</label>
                <div class="w-full py-2">
                    <input type="number" name="n" id="n" class="input" wire:model.live="n" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="type" class="label">{{$lang['5']}}:</label>
                <div class="w-full py-2">
                    <select name="sum_type" class="input" id="type" aria-label="select" wire:model.live="sum_type">
                        <option value="1">{{ $lang['6'] }}</option>
                        <option value="2">{{ $lang['7'] }}</option>
                        <option value="3">{{ $lang['8'] }}</option>
                        <option value="4">{{ $lang['9'] }}</option>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[18px]">\( \int\limits_{{ $detail['lb'] }}^{{ $detail['ub'] }} {{ $detail['enter'] }}\, d{{ $detail['with'] }} = {{ $detail['res'] }} \)</p>
                                <p class="mt-3"><strong>{{$lang['10']}}</strong></p>
                                <p class="mt-3">{{ $lang['11'] }} \( \int\limits_{{ $detail['lb'] }}^{{ $detail['ub'] }} {{ $detail['enter'] }}\, d{{ $detail['with'] }} \) {{ $lang['12'] }} \( n={{ $detail['n'] }} \) {{ $lang['13'] }} 
                                    @if ($detail['type'] === '1')
                                        {{ $lang['6'] }}
                                    @elseif ($detail['type'] === '2')
                                        {{ $lang['7'] }}
                                    @elseif ($detail['type'] === '3')
                                        {{ $lang['8'] }}
                                    @else
                                        {{ $lang['9'] }}
                                    @endif
                                .</p>
                                
                                @if($detail['type'] === '1' || $detail['type'] === '2')
                                    <p class="mt-3">\( \int\limits_{a}^{b} f({{ $detail['with'] }})\, d{{ $detail['with'] }} ≈ \Delta {{ $detail['with'] }}(f({{ $detail['with'] }}_0) + f({{ $detail['with'] }}_1) + f({{ $detail['with'] }}_2) + ... + f({{ $detail['with'] }}_{n-2}) + f({{ $detail['with'] }}_{n-1}))\)</p>
                                    <p class="mt-3">{{$lang['14']}} \( \Delta {{ $detail['with'] }} = \frac{b-a}{n}\)</p>
                                    <p class="mt-3">{{$lang['15']}} \( a = {{ $detail['lb'] }},b = {{ $detail['ub'] }},n = {{ $detail['n'] }}\)</p>
                                    <p class="mt-3">So, \(\Delta {{ $detail['with'] }} = \frac{ {{ $detail['ub'] }} - {{ $detail['lb'] }} }{ {{ $detail['n'] }} } = {{ $detail['diff'] }}\)</p>
                                    <p class="mt-3">{{$lang['16']}} \([{{ $detail['lb'] }},{{ $detail['ub'] }}]\) {{$lang['25']}} \(n={{ $detail['n'] }}\) {{$lang['17']}} \(Δ{{ $detail['with'] }}={{ $detail['diff'] }}\) {{$lang['18']}}:</p>
                                    <p class="mt-3">\(a={{ $detail['limit'] }}=b\)</p>
                                    <p class="mt-3">{{$lang['19']}} {{ (($detail['type'] === '1') ? 'left' : 'right') }} {{$lang['20']}}</p>
                                    
                                    @php
                                        $i = 0;
                                        $show = '';
                                    @endphp
                                    @foreach ($detail['steps'] as $key => $value)
                                        @if (!empty($value))
                                            @php
                                                if ((count($detail['steps']) - 2) == $i) {
                                                    $show .= $value;
                                                } else {
                                                    $show .= $value . " + ";
                                                }
                                            @endphp
                                            <p class="mt-3">\(f({{ $detail['with'] }}_{{ $i }}) = f({{ $detail['limit_a'][$i] }}) = {{ str_replace($detail['with'], $detail['limit_a'][$i], $detail['enter']) }} = {{ $value }}\)</p>
                                            @php $i++; @endphp
                                        @endif
                                    @endforeach
                                    
                                    <p class="mt-3">{{$lang['21']}} \(Δ{{ $detail['with'] }} = {{ $detail['diff'] }}\)</p>
                                    <p class="mt-3">\( {{ $detail['diff'] }}({{ $show }}) = {{ $detail['res'] }}\)</p>
                                    
                                @elseif($detail['type'] === '3')
                                    <p class="col s12 font_size18">\(\int\limits_{a}^{b} f({{ $detail['with'] }})\, d{{ $detail['with'] }} ≈ \Delta {{ $detail['with'] }}(f(\frac{ {{ $detail['with'] }}_0+{{ $detail['with'] }}_1 }{2}) + f(\frac{ {{ $detail['with'] }}_1+{{ $detail['with'] }}_2 }{2}) + f(\frac{ {{ $detail['with'] }}_2+{{ $detail['with'] }}_3 }{2}) + ... + f(\frac{ {{ $detail['with'] }}_{n-2}+{{ $detail['with'] }}_{n-1} }{2}) + f(\frac{ {{ $detail['with'] }}_{n-1}+{{ $detail['with'] }}_n }{2}))\)</p>
                                    <p class="mt-3">{{$lang['14']}} \(\Delta {{ $detail['with'] }} = \frac{b-a}{n}\)</p>
                                    <p class="mt-3">{{$lang['15']}} \(a = {{ $detail['lb'] }},b = {{ $detail['ub'] }},n = {{ $detail['n'] }}\)</p>
                                    <p class="mt-3">So, \(\Delta {{ $detail['with'] }} = \frac{ {{ $detail['ub'] }} - {{ $detail['lb'] }} }{ {{ $detail['n'] }} } = {{ $detail['diff'] }}\)</p>
                                    <p class="mt-3">{{$lang['16']}} \([{{ $detail['lb'] }},{{ $detail['ub'] }}]\) {{$lang['25']}} \(n={{ $detail['n'] }}\) {{$lang['17']}} \(Δ{{ $detail['with'] }}={{ $detail['diff'] }}\) {{$lang['18']}}:</p>
                                    <p class="mt-3">\(a={{ $detail['limit'] }}=b\)</p>
                                    <p class="mt-3">{{$lang['19']}} {{$lang['22']}}.</p>
                                    
                                    @php
                                        $i = 0;
                                        $show = '';
                                    @endphp
                                    @foreach ($detail['steps'] as $key => $value)
                                        @if (!empty($value))
                                            @php
                                                if ((count($detail['steps']) - 2) == $i) {
                                                    $show .= $value;
                                                } else {
                                                    $show .= $value . " + ";
                                                }
                                                $inner = round(($detail['limit_a'][$i] + $detail['limit_a'][$i+1]) / 2, 5);
                                            @endphp
                                            <p class="mt-3">\(f(\frac{ {{ $detail['with'] }}_{{ $i }}+{{ $detail['with'] }}_{{ $i+1 }} }{2}) = f(\frac{ {{ $detail['limit_a'][$i] }}+{{ $detail['limit_a'][$i+1] }} }{2}) = f({{ $inner }}) = {{ str_replace($detail['with'], $inner, $detail['enter']) }} = {{ $value }}\)</p>
                                            @php $i++; @endphp
                                        @endif
                                    @endforeach
                                    
                                    <p class="mt-3">{{$lang['21']}} \(Δ{{ $detail['with'] }} = {{ $detail['diff'] }}\)</p>
                                    <p class="mt-3">\( {{ $detail['diff'] }}({{ $show }}) = {{ $detail['res'] }}\)</p>
                                    
                                @elseif($detail['type'] === '4')
                                    <p class="col s12 font_size18">\(\int\limits_{a}^{b} f({{ $detail['with'] }})\, d{{ $detail['with'] }} ≈ \Delta {{ $detail['with'] }}(\frac{ f({{ $detail['with'] }}_0)+f({{ $detail['with'] }}_1) }{2} + \frac{ f({{ $detail['with'] }}_1)+f({{ $detail['with'] }}_2) }{2} + \frac{ f({{ $detail['with'] }}_2)+f({{ $detail['with'] }}_3) }{2} + ... + \frac{ f({{ $detail['with'] }}_{n-2})+f({{ $detail['with'] }}_{n-1}) }{2} + \frac{ f({{ $detail['with'] }}_{n-1})+f({{ $detail['with'] }}_n) }{2})\)</p>
                                    <p class="mt-3">{{$lang['14']}} \(\Delta {{ $detail['with'] }} = \frac{b-a}{n}\)</p>
                                    <p class="mt-3">{{$lang['15']}} \(a = {{ $detail['lb'] }},b = {{ $detail['ub'] }},n = {{ $detail['n'] }}\)</p>
                                    <p class="mt-3">{{$lang['24']}}, \(\Delta {{ $detail['with'] }} = \frac{ {{ $detail['ub'] }} - {{ $detail['lb'] }} }{ {{ $detail['n'] }} } = {{ $detail['diff'] }}\)</p>
                                    <p class="mt-3">{{$lang['16']}} \([{{ $detail['lb'] }},{{ $detail['ub'] }}]\) {{$lang['25']}} \(n={{ $detail['n'] }}\) {{$lang['17']}} \(Δ{{ $detail['with'] }}={{ $detail['diff'] }}\) {{$lang['18']}}:</p>
                                    <p class="mt-3">\(a={{ $detail['limit'] }}=b\)</p>
                                    <p class="mt-3">{{$lang['19']}} {{$lang['23']}}.</p>
                                    
                                    @php
                                        $i = 0;
                                        $show = '';
                                    @endphp
                                    @foreach ($detail['steps'] as $key => $value)
                                        @if (!empty($value))
                                            @php
                                                if ((count($detail['steps']) - 2) == $i) {
                                                    $show .= $value;
                                                } else {
                                                    $show .= $value . " + ";
                                                }
                                            @endphp
                                            <p class="mt-3">\(\frac{ f({{ $detail['with'] }}_{{ $i }})+f({{ $detail['with'] }}_{{ $i+1 }}) }{2} = \frac{ f({{ $detail['limit_a'][$i] }})+f({{ $detail['limit_a'][$i+1] }}) }{2} = \frac{ {{ str_replace($detail['with'], $detail['limit_a'][$i], $detail['enter']) }} + {{ str_replace($detail['with'], $detail['limit_a'][$i+1], $detail['enter']) }} }{2} = {{ $value }}\)</p>
                                            @php $i++; @endphp
                                        @endif
                                    @endforeach
                                    
                                    <p class="mt-3">{{$lang['21']}} \(Δ{{ $detail['with'] }} = {{ $detail['diff'] }}\)</p>
                                    <p class="mt-3">\( {{ $detail['diff'] }}({{ $show }}) = {{ $detail['res'] }}\)</p>
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
