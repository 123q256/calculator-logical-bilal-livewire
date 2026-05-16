<div x-data="{ keyboard: false, step0: false, step1: false, step2: false }">
    <style>
        [x-cloak] { display: none !important; }
        .res_step { display: block; }
        #exampleLoadBtn {
            border: 2px solid transparent;
            background: #1670a712;
            padding: 7px 10px;
            border-radius: 100px;
            cursor: pointer;
            font-size: 12px;
            color: #000000;
        }
        .calculate.repeat, .calculate.repeat1, .calculate.repeat2 {
            background-color: #1670a7;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            transition: opacity 0.2s;
        }
        .calculate.repeat:hover, .calculate.repeat1:hover, .calculate.repeat2:hover {
            opacity: 0.9;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="eq" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="text" wire:model.live="eq" id="eq" class="input" aria-label="input" />
                            <img src="{{ asset('images/keyboard.png') }}" width="35" style="top: 31px" height="35" alt="keyboard" 
                                 class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" 
                                 @click="keyboard = !keyboard">
                        </div>
                        
                        {{-- Keyboard --}}
                        <div x-show="keyboard" x-cloak class="col-span-12 keyboard">
                            <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" 
                                    @click="if(confirm('Are you sure you want to clear Equation?')) $wire.eq = ''">CLS</button>
                            @foreach(['+', '-', '/', '*', '^', 'sqrt(', '(', ')'] as $char)
                                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" 
                                        @click="$wire.eq += '{{ $char }}'">{{ $char === 'sqrt(' ? '√' : $char }}</button>
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
                        <div class="row">
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[16px]"><strong>{{ $lang['4'] }} {{ $lang['5'] }}</strong></p>
                                
                                @if(isset($detail['ip_1']))
                                    <p class="mt-3">\( ({{ $detail['ip1'] }}, {{ $detail['ip11'] }}) \)</p>
                                @elseif(isset($detail['no']))
                                    <p class="mt-3">\( {{ $lang['6'] }} \space {{ $lang['4'] }} \space {{ $lang['5'] }} \)</p>
                                @else
                                    <p class="mt-3">\( ({{ $detail['ip1'] }}, {{ $detail['ip2'] }}) \)</p>
                                    <p class="mt-3">\( ({{ $detail['ip11'] }}, {{ $detail['ip22'] }}) \)</p>
                                @endif

                                @if(isset($detail['no']))
                                    <p class="mt-3 text-[16px]"><strong>{{ $lang['10'] }}</strong></p>
                                    <p class="mt-3">\( (-\infty , \infty) \)</p>
                                    <p class="mt-3 text-[16px]"><strong>{{ $lang['11'] }}</strong></p>
                                    <p class="mt-3">\( \emptyset \)</p>
                                @else
                                    <p class="mt-3 text-[16px]"><strong>{{ $lang['10'] }}</strong></p>
                                    <p class="mt-3">\( ({{ $detail['ip1'] }}, \infty) \)</p>
                                    <p class="mt-3 text-[16px]"><strong>{{ $lang['11'] }}</strong></p>
                                    <p class="mt-3">\( (-\infty , {{ $detail['ip1'] }}) \)</p>
                                @endif

                                @if(isset($detail['iptype']))
                                    <p class="mt-3 text-[16px]"><strong>{{ $lang['12'] }}</strong></p>
                                    @if($detail['iptype'] < 0)
                                        <p class="mt-3">\( {{ $lang['13'] }} \space {{ $lang['14'] }} \space {{ $lang['15'] }} \)</p>
                                    @else
                                        <p class="mt-3">\( {{ $lang['16'] }} \space {{ $lang['14'] }} \space {{ $lang['17'] }} \)</p>
                                    @endif
                                @endif

                                {{-- f'(x) --}}
                                <p class="mt-3 text-[16px]"><strong>\( f' (x)\) {{ $lang['7'] }}</strong></p>
                                <p class="mt-3">\( {{ $detail['diff'] }} \)</p>
                                <div class="w-full mt-3">
                                    <button type="button" class="calculate repeat" style="font-size: 16px;padding: 10px;cursor: pointer;" @click="step0 = !step0">{{ $lang['8'] }}</button>
                                </div>
                                <div class="w-full res_step" id="step_cal" x-show="step0" x-collapse x-cloak>
                                    {!! $detail['step'] !!}
                                </div>

                                {{-- f''(x) --}}
                                <p class="mt-3 text-[16px]"><strong>\( f'' (x)\) {{ $lang['7'] }}</strong></p>
                                <p class="mt-3">\( {{ $detail['diff1'] }} \)</p>
                                <div class="w-full mt-3">
                                    <button type="button" class="calculate repeat1" style="font-size: 16px;padding: 10px;cursor: pointer;" @click="step1 = !step1">{{ $lang['8'] }}</button>
                                </div>
                                <div class="w-full res_step" id="step_cal1" x-show="step1" x-collapse x-cloak>
                                    {!! $detail['step1'] !!}
                                </div>

                                {{-- f'''(x) --}}
                                <p class="mt-3 text-[16px]"><strong>\( f''' (x)\) {{ $lang['7'] }}</strong></p>
                                <p class="mt-3">\( {{ $detail['diff2'] }} \)</p>
                                <div class="w-full mt-3">
                                    <button type="button" class="calculate repeat2" style="font-size: 16px;padding: 10px;cursor: pointer;" @click="step2 = !step2">{{ $lang['8'] }}</button>
                                </div>
                                <div class="w-full res_step" id="step_cal2" x-show="step2" x-collapse x-cloak>
                                    {!! $detail['step2'] !!}
                                </div>

                                <p class="mt-3 text-[16px]"><strong>{{ $lang['9'] }}</strong></p>
                                @if(isset($detail['root']))
                                    <p class="mt-3">\( {{ $detail['root'] }} \)</p>
                                @else
                                    <p class="mt-3">\( {{ $lang['6'] }} \space {{ $lang['9'] }} \)</p>
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

                Livewire.hook('morph.updated', ({ el }) => {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(el);
                    }
                });
            });
        </script>
    @endpush
</div>
