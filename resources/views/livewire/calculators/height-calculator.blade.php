<div>
    <style>
        .pacetabs { left: 16.6%; }
        @media (max-width: 991px) { .pacetabs { left: 0; } }
        .text-orange { color: #ff4500c4; }
        .font-s-38 { font-size: 38px; }
        .font-s-22 { font-size: 22px; }
        .radius-10 { border-radius: 10px; }
        .bg-light-blue { background-color: #F0F7FF; }
        
        /* Chart Styles */
        .scroll-wrapper { overflow-x: auto; width: 100%; }
        .chart-container, .chart-container-2 {
            position: relative; width: 100%; min-width: 100%;
            margin: 0 auto; font-family: Arial, sans-serif;
            background-color: white; padding: 5px 10px; border-radius: 10px;
        }
        .chart-line {
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid #d8d8d8; padding: 5px 0;
        }
        .chart-line span { font-size: 14px; }
        .chart-line:last-child { border-bottom: none; margin-bottom: 10px; }
        .cm { text-align: left; }
        .ft-in { text-align: right; }
        .person-image, .person-image-2 { position: absolute; bottom: 5px; z-index: 1; object-fit: contain; }
        .image_text, .image_text-2 {
            position: absolute; left: 50%; bottom: 0; background-color: #b6b6b6;
            color: white; padding: 5px 10px; border-radius: 5px;
        }
        
        /* Person Positions Calc 1 */
        .child-image { left: 28%; } .father-image { left: 45%; } .mother-image { left: 61%; }
        .child { left: 30% } .father { left: 47% } .mother { left: 62% }
        
        /* Person Positions Calc 2 */
        .girl-image-2 { left: 21%; } .boy-image-2 { left: 35%; } .father-image-2 { left: 51%; } .mother-image-2 { left: 67%; }
        .girl-2 { left: 27%; } .boy-2 { left: 40%; } .father-2 { left: 56%; } .mother-2 { left: 73%; }

        .loader {
            width: 50px; height: 50px; border: 5px solid #ffffff; border-top: 5px solid #3498db;
            border-radius: 50%; animation: spin 1s linear infinite; position: absolute;
            top: 50%; left: 50%; transform: translate(-50%, -50%);
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        /* AI Prompt Styles */
        .example { cursor: pointer; }
        .new_textArea {
            outline: none; border: none; resize: none; overflow: hidden; width: 100%;
            font-size: 15px; box-sizing: border-box; line-height: 1.5; letter-spacing: .5px;
            background-color: #f5f5f5; max-width: 635px;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 mb-3" x-data="{ method: '{{ $method }}' }">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <label class="label">Select Method:</label>
                <div class="py-2 relative">
                    <select wire:model.live="method" @change="method = $event.target.value" class="input">
                        <option value="calculator1">The Khamis-Roche Height Predictor</option>
                        <option value="calculator2">{{ $lang['3'] ?? '' }}</option>
                    </select>
                </div>
            </div>

            <!-- Khamis-Roche (Calculator 1) -->
            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto grid grid-cols-12 gap-2 md:gap-4 lg:gap-4" x-show="method == 'calculator1'" style="{{ $method == 'calculator1' ? '' : 'display: none;' }}">
                <div class="col-span-6">
                    <label class="label">{!! $lang['9'] ?? ''!!}:</label>
                    <div class="py-2">
                        <select wire:model.live="age" class="input">
                            @for ($i = 4; $i <= 17.5; $i += 0.5)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label class="label">{!! $lang['6'] ?? '' !!}:</label>
                    <div class="py-2">
                        <select wire:model.live="gender" class="input">
                            <option value="0">{{ $lang['7'] ?? '' }}</option>
                            <option value="1">{{ $lang['8'] ?? '' }}</option>
                        </select>
                    </div>
                </div>

                <!-- Child Height -->
                <div class="col-span-6">
                    <label class="label">{!! $lang['10'] ?? '' !!}:</label>
                    <div class="relative w-full mt-2" x-data="{ open: false }">
                        @if ($c_unit_h == 'ft/in')
                            <div class="flex gap-2">
                                <input type="number" step="any" wire:model.live="c_height_ft" class="input" placeholder="ft">
                                <input type="number" step="any" wire:model.live="c_height_in" class="input" placeholder="in">
                            </div>
                        @else
                            <input type="number" step="any" wire:model.live="c_height_cm" class="input" placeholder="cm">
                        @endif
                        <label class="absolute cursor-pointer text-sm underline right-2 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                            {{ $c_unit_h }} ▾
                        </label>
                        <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('c_unit_h', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('c_unit_h', 'ft/in')">ft/in</p>
                        </div>
                    </div>
                </div>

                <!-- Child Weight -->
                <div class="col-span-6">
                    <label class="label">{!! $lang['11'] ?? '' !!}:</label>
                    <div class="relative w-full mt-2" x-data="{ open: false }">
                        @if ($c_unit_w == 'lbs')
                            <input type="number" step="any" wire:model.live="c_weight_lbs" class="input" placeholder="lbs">
                        @else
                            <input type="number" step="any" wire:model.live="c_weight_kg" class="input" placeholder="kg">
                        @endif
                        <label class="absolute cursor-pointer text-sm underline right-2 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                            {{ $c_unit_w }} ▾
                        </label>
                        <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('c_unit_w', 'kg')">kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('c_unit_w', 'lbs')">lbs</p>
                        </div>
                    </div>
                </div>

                <!-- Mother Height (Calc 1) -->
                <div class="col-span-6">
                    <label class="label">{!! $lang['4'] ?? '' !!}:</label>
                    <div class="relative w-full mt-2" x-data="{ open: false }">
                        @if ($m_unit_h_1 == 'ft/in')
                            <div class="flex gap-2">
                                <input type="number" step="any" wire:model.live="m_height_ft_1" class="input" placeholder="ft">
                                <input type="number" step="any" wire:model.live="m_height_in_1" class="input" placeholder="in">
                            </div>
                        @else
                            <input type="number" step="any" wire:model.live="m_height_cm_1" class="input" placeholder="cm">
                        @endif
                        <label class="absolute cursor-pointer text-sm underline right-2 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                            {{ $m_unit_h_1 }} ▾
                        </label>
                        <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('m_unit_h_1', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('m_unit_h_1', 'ft/in')">ft/in</p>
                        </div>
                    </div>
                </div>

                <!-- Father Height (Calc 1) -->
                <div class="col-span-6">
                    <label class="label">{!! $lang['5'] ?? '' !!}:</label>
                    <div class="relative w-full mt-2" x-data="{ open: false }">
                        @if ($f_unit_h_1 == 'ft/in')
                            <div class="flex gap-2">
                                <input type="number" step="any" wire:model.live="f_height_ft_1" class="input" placeholder="ft">
                                <input type="number" step="any" wire:model.live="f_height_in_1" class="input" placeholder="in">
                            </div>
                        @else
                            <input type="number" step="any" wire:model.live="f_height_cm_1" class="input" placeholder="cm">
                        @endif
                        <label class="absolute cursor-pointer text-sm underline right-2 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                            {{ $f_unit_h_1 }} ▾
                        </label>
                        <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('f_unit_h_1', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('f_unit_h_1', 'ft/in')">ft/in</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mid-Parental (Calculator 2) -->
            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto grid grid-cols-12 gap-2 md:gap-4 lg:gap-4" x-show="method == 'calculator2'" style="{{ $method == 'calculator2' ? '' : 'display: none;' }}">
                <!-- Mother Height (Calc 2) -->
                <div class="col-span-6">
                    <label class="label">{!! $lang['4'] ?? '' !!}:</label>
                    <div class="relative w-full mt-2" x-data="{ open: false }">
                        @if ($m_unit_h_2 == 'ft/in')
                            <div class="flex gap-2">
                                <input type="number" step="any" wire:model.live="m_height_ft_2" class="input" placeholder="ft">
                                <input type="number" step="any" wire:model.live="m_height_in_2" class="input" placeholder="in">
                            </div>
                        @else
                            <input type="number" step="any" wire:model.live="m_height_cm_2" class="input" placeholder="cm">
                        @endif
                        <label class="absolute cursor-pointer text-sm underline right-2 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                            {{ $m_unit_h_2 }} ▾
                        </label>
                        <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('m_unit_h_2', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('m_unit_h_2', 'ft/in')">ft/in</p>
                        </div>
                    </div>
                </div>

                <!-- Father Height (Calc 2) -->
                <div class="col-span-6">
                    <label class="label">{!! $lang['5'] ?? '' !!}:</label>
                    <div class="relative w-full mt-2" x-data="{ open: false }">
                        @if ($f_unit_h_2 == 'ft/in')
                            <div class="flex gap-2">
                                <input type="number" step="any" wire:model.live="f_height_ft_2" class="input" placeholder="ft">
                                <input type="number" step="any" wire:model.live="f_height_in_2" class="input" placeholder="in">
                            </div>
                        @else
                            <input type="number" step="any" wire:model.live="f_height_cm_2" class="input" placeholder="cm">
                        @endif
                        <label class="absolute cursor-pointer text-sm underline right-2 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" @click="open = !open">
                            {{ $f_unit_h_2 }} ▾
                        </label>
                        <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 shadow-lg top-full" x-cloak>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('f_unit_h_2', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('f_unit_h_2', 'ft/in')">ft/in</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
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
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 rounded-lg space-y-6">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif

            @if ($detail['submit'] === 'calculator1')
                <div class="text-center">
                    <span class="text-xl font-semibold">Estimated Height:</span>
                    <strong class="text-orange font-s-38 block mt-2">{{ $detail['final_ans'] }}</strong>
                </div>

                <div class="mt-8">
                    <strong class="text-lg text-blue">Height comparison chart:</strong>
                    
                    @php
                        $finalAns = $detail['final_ans'];
                        if (preg_match('/(\d+)ft\s*(\d+)in/', $finalAns, $matches)) {
                            $child_h = ($matches[1] * 30.48) + ($matches[2] * 2.54);
                        } elseif (preg_match('/(\d+)\s*cm/', $finalAns, $matches)) {
                            $child_h = (int) $matches[1];
                        } else { $child_h = 0; }

                        $father_h = $detail['father_h'];
                        $mother_h = $detail['mother_h'];
                        $maxHeightCM = max($child_h, $father_h, $mother_h);
                        
                        $range = 150;
                        $start = max(0, $maxHeightCM - $range);
                        $end = $maxHeightCM + $range;
                        $step = 15;
                        if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(Android|iPhone|iPad)/i', $_SERVER['HTTP_USER_AGENT'])) {
                            $step = 30;
                        }
                    @endphp

                    <div class="scroll-wrapper mt-4" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 1500)">
                        <div class="chart-container">
                            <div class="chart-line font-bold">
                                <span class="cm">cm</span>
                                <span class="ft-in">ft/in</span>
                            </div>
                            @for ($i = $end; $i >= $start; $i -= $step)
                                @php
                                    $cmRounded = round($i);
                                    $feetChart = floor($cmRounded / 30.48);
                                    $inchesChart = round(($cmRounded / 30.48 - $feetChart) * 12, 1);
                                @endphp
                                <div class="chart-line">
                                    <span class="cm">{{ $cmRounded }}</span>
                                    <span class="ft-in">{{ $feetChart }}' {{ $inchesChart }}''</span>
                                </div>
                            @endfor

                            <div x-show="!loaded" class="loader"></div>
                            
                            <div x-show="loaded" class="imgs-container" x-cloak>
                                <img src="{{ asset($detail['gender'] == 0 ? 'assets/new-icon/son.svg' : 'assets/new-icon/daughter.svg') }}" 
                                     class="person-image child-image" style="height: {{ (($child_h - $start) * (100/($end-$start))) }}%;">
                                <img src="{{ asset('assets/new-icon/father.svg') }}" 
                                     class="person-image father-image" style="height: {{ (($father_h - $start) * (100/($end-$start))) }}%;">
                                <img src="{{ asset('assets/new-icon/mother.svg') }}" 
                                     class="person-image mother-image" style="height: {{ (($mother_h - $start) * (100/($end-$start))) }}%;">

                                <p class="image_text child" style="bottom: {{ (($child_h - $start) * (100/($end-$start))) }}%;">{{ $detail['gender'] == 0 ? 'Boy' : 'Girl' }}</p>
                                <p class="image_text father" style="bottom: {{ (($father_h - $start) * (100/($end-$start))) }}%;">Father</p>
                                <p class="image_text mother" style="bottom: {{ (($mother_h - $start) * (100/($end-$start))) }}%;">Mother</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Mid-Parental Result -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border radius-10 p-4 text-center">
                        <strong class="block mb-2">{!! $lang[14] !!}</strong>
                        <strong class="text-orange text-3xl block">{{ $detail['final_ans_boy'] }}</strong>
                    </div>
                    <div class="border radius-10 p-4 text-center">
                        <strong class="block mb-2">{!! $lang[13] !!}</strong>
                        <strong class="text-orange text-3xl block">{{ $detail['final_ans_girl'] }}</strong>
                    </div>
                </div>

                <div class="mt-8">
                    <strong class="text-lg text-blue">Height Comparison Chart:</strong>
                    @php
                        $girls_height = $detail['girls_height'];
                        $boys_height = $detail['boys_height'];
                        $mother_height = $detail['mother_height'];
                        $father_height = $detail['father_height'];
                        $maxHeightCM = max($girls_height, $boys_height, $mother_height, $father_height);
                        
                        $range = 150;
                        $start = max(0, $maxHeightCM - $range);
                        $end = $maxHeightCM + $range;
                        $step = 15;
                    @endphp

                    <div class="scroll-wrapper mt-4" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 1500)">
                        <div class="chart-container-2">
                            <div class="chart-line font-bold">
                                <span class="cm">cm</span>
                                <span class="ft-in">ft/in</span>
                            </div>
                            @for ($i = $end; $i >= $start; $i -= $step)
                                @php
                                    $cmRounded = round($i);
                                    $feetChart = floor($cmRounded / 30.48);
                                    $inchesChart = round(($cmRounded / 30.48 - $feetChart) * 12, 1);
                                @endphp
                                <div class="chart-line">
                                    <span class="cm">{{ $cmRounded }}</span>
                                    <span class="ft-in">{{ $feetChart }}' {{ $inchesChart }}''</span>
                                </div>
                            @endfor

                            <div x-show="!loaded" class="loader"></div>
                            
                            <div x-show="loaded" class="imgs-container-2" x-cloak>
                                <img src="{{ asset('assets/new-icon/daughter.svg') }}" class="person-image-2 girl-image-2" style="height: {{ (($girls_height - $start) * (100/($end-$start))) }}%;">
                                <img src="{{ asset('assets/new-icon/son.svg') }}" class="person-image-2 boy-image-2" style="height: {{ (($boys_height - $start) * (100/($end-$start))) }}%;">
                                <img src="{{ asset('assets/new-icon/father.svg') }}" class="person-image-2 father-image-2" style="height: {{ (($father_height - $start) * (100/($end-$start))) }}%;">
                                <img src="{{ asset('assets/new-icon/mother.svg') }}" class="person-image-2 mother-image-2" style="height: {{ (($mother_height - $start) * (100/($end-$start))) }}%;">

                                <p class="image_text-2 girl-2" style="bottom: {{ (($girls_height - $start) * (100/($end-$start))) }}%;">Girl</p>
                                <p class="image_text-2 boy-2" style="bottom: {{ (($boys_height - $start) * (100/($end-$start))) }}%;">Boy</p>
                                <p class="image_text-2 father-2" style="bottom: {{ (($father_height - $start) * (100/($end-$start))) }}%;">Father</p>
                                <p class="image_text-2 mother-2" style="bottom: {{ (($mother_height - $start) * (100/($end-$start))) }}%;">Mother</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    @endisset
</div>
