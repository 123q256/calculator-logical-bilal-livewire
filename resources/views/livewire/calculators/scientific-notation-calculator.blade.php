<div>
    <style>
        .tagsUnit { background-color: #2845F5 !important; color: white !important; }
        .tab-btn { transition: all 0.3s; cursor: pointer; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{!! $error !!}</p>
            @endif

            <!-- Mode Switcher -->
            <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[80%] w-full">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="switchMode('converter')" class="bg-white px-3 py-2 tab-btn rounded-md hover:bg-blue-500 hover:text-white {{ $mode === 'converter' ? 'tagsUnit' : '' }}">
                            {{ $lang['1'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="switchMode('calculator')" class="bg-white px-3 py-2 tab-btn rounded-md hover:bg-blue-500 hover:text-white {{ $mode === 'calculator' ? 'tagsUnit' : '' }}">
                            {{ $lang['cal_name'] ?? 'Scientific Notation Calculator' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4">
                    <!-- Converter Mode -->
                    @if($mode === 'converter')
                    <div class="col-span-12 space-y-4">
                        <p class="font-s-14 text-center"><strong>{{ $lang['4'] }}:</strong> {{ $lang['5'] }}</p>
                        <div class="w-full max-w-md mx-auto">
                            <label for="decimal" class="label">{{ $lang['1'] }}</label>
                            <div class="w-full py-2">
                                <input type="text" wire:model.live="decimal" id="decimal" class="input" placeholder="1.356 x 10^5">
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Calculator Mode -->
                    @if($mode === 'calculator')
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 gap-2 md:gap-4 items-end">
                            <!-- First Number Row -->
                            <div class="col-span-2 hidden md:block lg:block"></div>
                            <div class="col-span-6 md:col-span-4 lg:col-span-4">
                                <label class="label">{{ $lang['2'] }}:</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="nbr1" class="input" placeholder="3.12">
                                </div>
                            </div>
                            <div class="col-span-2 flex flex-col justify-end">
                                <div class="py-2 flex items-center justify-center">
                                    <p class="text-center"><strong>x 10 ^</strong></p>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label class="label">&nbsp;</label>
                                <div class="w-full py-2">
                                    <input type="number" wire:model.live="pwr1" class="input" placeholder="4">
                                </div>
                            </div>

                            <!-- Second Number Row -->
                            <div class="col-span-12 md:col-span-2 lg:col-span-2">
                                <label class="label hidden md:block lg:block">&nbsp;</label>
                                <div class="w-full py-2">
                                    <select wire:model.live="opr" class="input text-center">
                                        <option value="+">+</option>
                                        <option value="-">-</option>
                                        <option value="*">×</option>
                                        <option value="/">÷</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-6 md:col-span-4 lg:col-span-4">
                                <label class="label">{{ $lang['3'] }}:</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="nbr2" class="input" placeholder="1.52">
                                </div>
                            </div>
                            <div class="col-span-2 flex flex-col justify-end">
                                <div class="py-2 flex items-center justify-center">
                                    <p class="text-center"><strong>x 10 ^</strong></p>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label class="label">&nbsp;</label>
                                <div class="w-full py-2">
                                    <input type="number" wire:model.live="pwr2" class="input" placeholder="-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                    @if ($type == 'calculator')
                        @include('inc.button')
                    @endif
                    @if ($type == 'widget')
                        @include('inc.widget-button')
                    @endif
            </div>
        </div>
    </form>

    <!-- Result Section -->
    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result"
         x-data="{ 
            power: {{ $power }},
            mantissa: '{{ $mantissa }}',
            originalNumber: {{ $originalNumber }},
            updateDisplay() {
                let str = (this.originalNumber.toString()).split('.');
                let dp = (str.length > 1) ? str[1].length : 0;
                dp += this.power;
                dp = Math.max(0, Math.min(20, dp));
                this.mantissa = (this.originalNumber / Math.pow(10, this.power)).toFixed(dp);
            }
         }"
         x-init="$watch('power', () => updateDisplay())">
        
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full text-[16px]">
                            <p class="mt-2">{{ $lang[6] }}</p>
                            <p class="mt-2 text-[21px]">
                                <strong>
                                    <span x-text="mantissa"></span> <span class="text-muted">x 10</span><sup class="font-s-12" x-text="power"></sup>
                                </strong>
                            </p>
                            <button type="button" @click="power++" class="calculate mt-2 right bg-[#2845F5] text-white rounded-lg" style="padding: 10px 15px; cursor: pointer;">←</button>
                            <button type="button" @click="power--" class="calculate mt-2 ms-2 left bg-[#2845F5] text-white rounded-lg" style="padding: 10px 15px; cursor: pointer;">→</button>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="40%">{{ $lang['7'] }}</td>
                                        <td class="py-2 border-b">{{ $detail['e_ans'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%">{{ $lang['9'] }}</td>
                                        <td class="py-2 border-b">{{ $detail['ee_ans'] }} x10<sup class="font-s-12">{{ $detail['ee_p'] }}</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%">{{ $lang['8'] }}</td>
                                        <td class="py-2 border-b">{{ $detail['ans'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%">{{ $lang['13'] }}</td>
                                        <td class="py-2 border-b">{{ $detail['right'] }}</td>
                                    </tr>
                                </table>
                            </div>
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
    @endpush
</div>
