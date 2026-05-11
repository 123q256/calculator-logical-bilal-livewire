<div>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[75%] md:w-[85%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 mb-2">
                        <p><strong class="text-blue">{{ $lang['1'] ?? 'Note' }} : </strong><strong>{{ $lang['2'] ?? 'Enter exactly three values to calculate the remaining results.' }}.</strong></p>
                    </div>

                    {{-- Total Cholesterol --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="tc" class="label text-blue">{!! $lang['3'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="tc" id="tc" step="any" class="input pr-24" placeholder="00">
                            <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 ">{{ $tc_unit }} ▾</span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border rounded-md shadow-lg mt-1 right-0 w-48">
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('tc_unit', 'mg/dL'); open = false">milligrams per deciliter (mg/dL)</p>
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('tc_unit', 'mmol/L'); open = false">millimoles per liter (mmol/L)</p>
                            </div>
                        </div>
                    </div>

                    {{-- HDL Cholesterol --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="hc" class="label text-blue">{!! $lang['4'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="hc" id="hc" step="any" class="input pr-24" placeholder="00">
                            <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 ">{{ $hc_unit }} ▾</span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border rounded-md shadow-lg mt-1 right-0 w-48">
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('hc_unit', 'mg/dL'); open = false">milligrams per deciliter (mg/dL)</p>
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('hc_unit', 'mmol/L'); open = false">millimoles per liter (mmol/L)</p>
                            </div>
                        </div>
                    </div>

                    {{-- LDL Cholesterol --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="lc" class="label text-blue">{!! $lang['5'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="lc" id="lc" step="any" class="input pr-24" placeholder="00">
                            <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 ">{{ $lc_unit }} ▾</span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border rounded-md shadow-lg mt-1 right-0 w-48">
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('lc_unit', 'mg/dL'); open = false">milligrams per deciliter (mg/dL)</p>
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('lc_unit', 'mmol/L'); open = false">millimoles per liter (mmol/L)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Triglycerides --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="tr" class="label text-blue">{!! $lang['6'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="tr" id="tr" step="any" class="input pr-24" placeholder="00">
                            <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3 ">{{ $tr_unit }} ▾</span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border rounded-md shadow-lg mt-1 right-0 w-48">
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('tr_unit', 'mg/dL'); open = false">milligrams per deciliter (mg/dL)</p>
                                <p class="p-2 cursor-pointer text-sm" @click="$wire.set('tr_unit', 'mmol/L'); open = false">millimoles per liter (mmol/L)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Gender --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="gender" class="label text-blue">{!! $lang['7'] !!}:</label>
                        <div class="w-full mt-[7px]">
                            <select wire:model.live="gender" id="gender" class="input cursor-pointer">
                                <option value="male">{{ $lang['8'] ?? 'Male' }}</option>
                                <option value="female">{{ $lang['9'] ?? 'Female' }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @php
                                    $ans1 = (float)$detail['ans1'];
                                    $ans2 = (float)$detail['ans2'];
                                    $ans3 = (float)$detail['ans3'];
                                    $ans4 = (float)$detail['ans4'];
                                    $ans5 = (float)$detail['ans5'];
                                    $ans6 = (float)$detail['ans6'];
                                    
                                    $line1 = ""; $line2 = ""; $line3 = ""; $line4 = ""; $line5 = ""; $line6 = "";

                                    if($detail['gender'] == "male") {
                                        if($ans1 < 3.4) $line1 = $lang['21'];
                                        else if($ans1 >= 3.4 && $ans1 <= 4.4) $line1 = $lang['22'];
                                        else if($ans1 >= 4.5 && $ans1 <= 7.2) $line1 = $lang['23'];
                                        else if($ans1 >= 7.3 && $ans1 <= 16.5) $line1 = $lang['24'];
                                        else if($ans1 > 16.5) $line1 = $lang['25'];

                                        if($ans2 < 1.1 && $ans2 > 0) $line2 = $lang['21'];
                                        else if($ans2 >= 1.1 && $ans2 <= 4.9) $line2 = $lang['23'];
                                        else if($ans2 >= 5 && $ans2 <= 7.1) $line2 = $lang['24'];
                                        else if($ans2 >= 7.1) $line2 = $lang['25'];
                                    } else {
                                        if($ans1 < 3.3) $line1 = $lang['21'];
                                        else if($ans1 >= 3.3 && $ans1 <= 4.1) $line1 = $lang['22'];
                                        else if($ans1 >= 4.2 && $ans1 <= 5.7) $line1 = $lang['23'];
                                        else if($ans1 >= 5.8 && $ans1 <= 9) $line1 = $lang['24'];
                                        else if($ans1 > 9) $line1 = $lang['25'];

                                        if($ans2 < 1.5 && $ans2 > 0) $line2 = $lang['21'];
                                        else if($ans2 >= 1.6 && $ans2 <= 4.1) $line2 = $lang['23'];
                                        else if($ans2 >= 4.2 && $ans2 <= 5.5) $line2 = $lang['24'];
                                        else if($ans2 >= 5.5) $line2 = $lang['25'];
                                    }

                                    if($ans3 < 200 && $ans3 > 0) $line3 = $lang['26'];
                                    else if($ans3 >= 200 && $ans3 <= 239) $line3 = $lang['27'];
                                    else if($ans3 >= 240) $line3 = $lang['28'];

                                    if($ans4 > 60) $line4 = $lang['26'];
                                    else if($ans4 >= 40 && $ans4 <= 60) $line4 = $lang['27'];
                                    else if($ans4 < 40 && $ans4 > 0) $line4 = $lang['28'];

                                    if($ans5 < 100 && $ans5 > 0) $line5 = $lang['26'];
                                    else if($ans5 >= 100 && $ans5 <= 129) $line5 = $lang['29'];
                                    else if($ans5 >= 130 && $ans5 <= 159) $line5 = $lang['27'];
                                    else if($ans5 >= 160 && $ans5 <= 189) $line5 = $lang['28'];
                                    else if($ans5 >= 190) $line5 = $lang['30'];

                                    if($ans6 < 130 && $ans6 > 0) $line6 = $lang['26'];
                                    else if($ans6 >= 130 && $ans6 <= 149) $line6 = $lang['29'];
                                    else if($ans6 >= 150 && $ans6 <= 199) $line6 = $lang['27'];
                                    else if($ans6 >= 200) $line6 = $lang['28'];
                                @endphp

                                <div class="space-y-4">
                                    <div class="border-b pb-2">
                                        <p class="text-[20px] font-bold text-[#2845F5]">{{ $lang['10'] ?? 'Results' }}:</p>
                                    </div>
                                    
                                    <div class="space-y-3 font-s-18">
                                        <div class="flex items-start">
                                            <span class="text-[#2845F5] mt-1.5 me-2 text-xs">■</span>
                                            <p><strong>{{ $lang['11'] }}</strong> = <strong class="text-[#119154] text-[22px]">{{ round($ans1, 2) }}</strong> – {{ $lang['12'] }} <strong>{{ $line1 }}</strong> {{ $lang['13'] }}.</p>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="text-[#2845F5] mt-1.5 me-2 text-xs">■</span>
                                            <p><strong>{{ $lang['14'] }}</strong> = <strong class="text-[#119154] text-[22px]">{{ round($ans2, 2) }}</strong> – {{ $lang['12'] }} <strong>{{ $line2 }}</strong> {{ $lang['13'] }}.</p>
                                        </div>
                                        <div class="flex items-start border-t pt-2">
                                            <span class="text-[#2845F5] mt-1.5 me-2 text-xs">■</span>
                                            <p>{{ $lang['15'] }} <strong>{{ $lang['3'] }}</strong> {{ $lang['16'] }} <strong class="text-[#119154] text-[20px]">{{ round($ans3) }}</strong> (mg/dl) {{ $lang['17'] }} <strong>{{ $line3 }}</strong>.</p>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="text-[#2845F5] mt-1.5 me-2 text-xs">■</span>
                                            <p>{{ $lang['15'] }} <strong>{{ $lang['18'] }}</strong> {{ $lang['16'] }} <strong class="text-[#119154] text-[20px]">{{ round($ans4) }}</strong> (mg/dl) {{ $lang['17'] }} <strong>{{ $line4 }}</strong>.</p>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="text-[#2845F5] mt-1.5 me-2 text-xs">■</span>
                                            <p>{{ $lang['15'] }} <strong>{{ $lang['19'] }}</strong> {{ $lang['16'] }} <strong class="text-[#119154] text-[20px]">{{ round($ans5) }}</strong> (mg/dl) {{ $lang['17'] }} <strong>{{ $line5 }}</strong>.</p>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="text-[#2845F5] mt-1.5 me-2 text-xs">■</span>
                                            <p>{{ $lang['15'] }} <strong>{{ $lang['20'] }}</strong> {{ $lang['16'] }} <strong class="text-[#119154] text-[20px]">{{ round($ans6) }}</strong> (mg/dl) {{ $lang['17'] }} <strong>{{ $line6 }}</strong>.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
