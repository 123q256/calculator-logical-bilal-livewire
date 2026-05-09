<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2">
                    <!-- Score Type -->
                    <div class="col-span-12">
                        <label for="with" class="font-s-14 text-blue">{{ $lang['5'] }}?</label>
                        <div class="w-full py-2">
                            <select wire:model.live="with" id="with" class="input cursor-pointer" autocomplete="off">
                                <option value="z">{{ $lang['6'] }}</option>
                                <option value="t">{{ $lang['7'] }}</option>
                                <option value="chi">{{ $lang['8'] }}</option>
                                <option value="f">{{ $lang['9'] }}</option>
                                <option value="r">Pearson r score</option>
                                <option value="q">Tukey q score</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tail Selection (Only for Z and T) -->
                    @if($with == 'z' || $with == 't')
                    <div class="col-span-12">
                        <label for="tail" class="font-s-14 text-blue">{{ $lang['1'] }}?</label>
                        <div class="w-full py-2">
                            <select wire:model.live="tail" id="tail" class="input cursor-pointer" autocomplete="off">
                                <option value="2">{{ $lang['2'] }}</option>
                                <option value="1">One-tailed P-value</option>
                            </select>
                        </div>
                    </div>
                    @endif

                    <!-- Score Input -->
                    <div class="col-span-12">
                        <label for="score" class="font-s-14 text-blue">
                            @if($with == 'z') {{ $lang['6'] }}: @elseif($with == 't') {{ $lang['7'] }}: @elseif($with == 'chi') {{ $lang['8'] }}: @elseif($with == 'f') {{ $lang['9'] }}: @elseif($with == 'r') R Score: @else The value of q: @endif
                        </label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="score" id="score" class="input" placeholder="0.00" />
                        </div>
                    </div>

                    <!-- Degrees of Freedom 1 / N / Groups -->
                    @if($with != 'z')
                    <div class="col-span-12">
                        <label for="deg" class="font-s-14 text-blue">
                            @if($with == 'f') {{ $lang['13'] }} (d₁): @elseif($with == 'r') N: @elseif($with == 'q') Number of groups (or means): @else {{ $lang['10'] }} (d): @endif
                        </label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="deg" id="deg" class="input" placeholder="0" />
                        </div>
                    </div>
                    @endif

                    <!-- Degrees of Freedom 2 (Only for F) -->
                    @if($with == 'f')
                    <div class="col-span-12">
                        <label for="deg2" class="font-s-14 text-blue">{{ $lang['11'] }} (d₂):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="deg2" id="deg2" class="input" placeholder="0" />
                        </div>
                    </div>
                    @endif

                    <!-- Degrees of Freedom Within (Only for Q) -->
                    @if($with == 'q')
                    <div class="col-span-12">
                        <label for="degree_freedom" class="font-s-14 text-blue">Degrees of freedom (within-groups):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="degree_freedom" id="degree_freedom" class="input" placeholder="0" />
                        </div>
                    </div>
                    @endif

                    <!-- Significance Level -->
                    <div class="col-span-12 my-2">
                        <p class="font-s-14 text-blue my-1">Significance Level:</p>
                        <div class="flex space-x-6 py-2">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" wire:model.live="level" value=".01" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 font-s-14">0.01</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" wire:model.live="level" value=".05" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 font-s-14">0.05</span>
                            </label>
                            @if($with != 'q')
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" wire:model.live="level" value=".10" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 font-s-14">0.10</span>
                            </label>
                            @endif
                        </div>
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
            <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="w-full">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    
                    <div class="flex flex-col items-center justify-center py-6">
                        <div class="flex justify-center">
                            <div class="text-[32px] bg-[#2845F5] px-6 py-3 rounded-2xl shadow-lg">
                                <strong class="text-white" id="testResult">{{ $detail['p'] }}</strong>
                            </div>
                        </div>
                        
                        <p class="w-full lg:text-[20px] md:text-[20px] text-center mt-6 font-medium text-gray-700" id="p_grater">
                            @if ($detail['inter'] == 'not')
                                {{ $lang['14'] }} p < {{ $detail['level'] }}
                            @else
                                {{ $lang['15'] }} p < {{ $detail['level'] }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jstat@latest/dist/jstat.min.js"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @if (isset($detail) && $with == 'q')
                    calculateTukey();
                @endif

                Livewire.on('tukey-calculate', () => {
                    calculateTukey();
                });
            });

            function calculateTukey() {
                setTimeout(() => {
                    let qscore = parseFloat(@js($score));
                    let nmeans = parseFloat(@js($deg));
                    let doff = parseFloat(@js($degree_freedom));
                    let sig = parseFloat(@js($level));
                    let valu15 = @js($lang['15']);
                    let valu14 = @js($lang['14']);
                    
                    if (typeof jStat !== 'undefined') {
                        let resultVal = (1 - jStat.tukey.cdf(qscore, nmeans, doff)).toFixed(5);
                        let resultStr = resultVal.toString().startsWith('0') ? resultVal.substring(1) : resultVal;
                        
                        const resultEl = document.getElementById('testResult');
                        const textEl = document.getElementById('p_grater');
                        
                        if (resultEl && textEl) {
                            if (parseFloat(resultVal) < sig) {
                                if (parseFloat(resultVal) < 0.00001) {
                                    resultEl.innerText = '.00001';
                                } else {
                                    resultEl.innerText = resultStr;
                                }
                                textEl.innerText = valu15 + ' p < ' + sig;
                            } else {
                                resultEl.innerText = resultStr;
                                textEl.innerText = valu14 + ' p < ' + sig;
                            }
                        }
                    }
                }, 100);
            }
        </script>
    @endpush
</div>
