<div>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Age --}}
                    <div class="w-full">
                        <label for="age" class="label text-blue">{!! $lang['1'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="age" id="age" step="any" class="input pr-20" placeholder="00">
                            <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3">{{ $age_unit }} ▾</span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 w-auto">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('age_unit', '{{ $lang['2'] ?? 'Weeks' }}'); open = false">{{ $lang['2'] ?? 'Weeks' }}</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('age_unit', '{{ $lang['3'] ?? 'Months' }}'); open = false">{{ $lang['3'] ?? 'Months' }}</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('age_unit', '{{ $lang['4'] ?? 'Years' }}'); open = false">{{ $lang['4'] ?? 'Years' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Weight --}}
                    <div class="w-full">
                        <label for="weight" class="label text-blue">{!! $lang['5'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="weight" id="weight" step="any" class="input pr-20" placeholder="00">
                            <span @click="open = !open" class="absolute cursor-pointer text-sm underline right-4 top-3">{{ $weight_unit }} ▾</span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 w-auto">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('weight_unit', 'kg'); open = false">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('weight_unit', 'lbs'); open = false">lbs</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('weight_unit', 'stone'); open = false">stone</p>
                            </div>
                        </div>
                    </div>

                    {{-- Med Type --}}
                    <div class="w-full">
                        <label for="med_type" class="label text-blue">{!! $lang['6'] !!}:</label>
                        <div class="w-full mt-[7px]">
                            <select wire:model.live="med_type" id="med_type" class="input cursor-pointer">
                                <option value="1">(125 mg/5 mL)</option>
                                <option value="2">(250 mg/5 mL)</option>
                                <option value="3">(200 mg/5 mL)</option>
                                <option value="4">(400 mg/5 mL)</option>
                            </select>
                        </div>
                    </div>

                    {{-- General Dosing --}}
                    <div class="w-full">
                        <label for="general_dosing" class="label text-blue">{!! $lang['7'] !!}:</label>
                        <div class="w-full mt-[7px]">
                            <select wire:model.live="general_dosing" id="general_dosing" class="input cursor-pointer">
                                <option value="1">{{ $lang['8'] ?? 'General indications' }}</option>
                                <option value="2">{{ $lang['9'] ?? 'Group A streptococcal pharyngitis/tonsillitis' }}</option>
                                <option value="3">{{ $lang['10'] ?? 'Infective endocarditis prophylaxis' }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Route (Only for General Indications) --}}
                    <div class="w-full" x-show="$wire.general_dosing === '1'" x-cloak>
                        <label for="route" class="label text-blue">{!! $lang['11'] !!}:</label>
                        <div class="w-full mt-[7px]">
                            <select wire:model.live="route" id="route" class="input cursor-pointer">
                                <option value="1">{{ $lang['12'] ?? 'Oral' }} (PO)</option>
                                <option value="2">{{ $lang['13'] ?? 'Intravenous' }} (IV)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Specific Dosage mg/kg/dose --}}
                    <div class="w-full">
                        <label for="dosag" class="label text-blue">{!! $lang['20'] !!}:</label>
                        <div class="relative mt-[7px]">
                            <input type="number" wire:model.live="dosag" id="dosag" step="any" class="input pr-24" placeholder="00">
                            <span class="absolute right-4 top-3 text-blue text-sm">mg/kg/dose</span>
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
                        <div class="w-full mt-5">
                            <div class="w-full">
                                @php
                                    $milli1 = $detail['in_mm'] * 2;
                                    $milli2 = $detail['in_milli'] * 2;
                                    $general_dosing = $detail['general_dosing'];
                                @endphp
                                <p class="w-full">{{ $lang['14'] }}</p>
                                @if($detail['general_dosing'] == "1" || $detail['general_dosing'] == "2" || $detail['general_dosing'] == "3")
                                    <p class="text-blue font-s-18">
                                        @if($detail['general_dosing'] == "1")
                                            @if($detail['route'] == "1")
                                                3 {{ $lang['21'] }}/{{ $lang['22'] }} 8 Hours :
                                            @elseif($detail['route'] == "2")
                                                3 {{ $lang['21'] }} :
                                            @endif
                                        @elseif($detail['general_dosing'] == "2")
                                            {{ $lang['23'] }} 10 days :
                                        @elseif($detail['general_dosing'] == "3")
                                            30-60 {{ $lang['24'] }}:
                                        @endif
                                    </p>
                                    <div class="w-full overflow-auto mt-4">
                                        <table class="w-full md:w-[60%] lg:w-[60%] " cellspacing="0">
                                            <tr>
                                                <td class="border-b py-3">
                                                    <p class=""><strong>{{ $lang['15'] }} :</strong></p>
                                                </td>
                                                <td class="border-b">
                                                    <p class="">
                                                        @if($detail['general_dosing'] == "1")
                                                            <strong><span class="text-[#119154] text-[18px]"> {{ round($detail['in_mm'], 1) }} - {{ round($milli1, 1) }}</span><span class="text-blue"> (mg)</span></strong>
                                                        @elseif($detail['general_dosing'] == "2" || $detail['general_dosing'] == "3")
                                                            <strong><span class="text-[#119154] text-[18px]"> {{ round($detail['in_mm'], 1) }}</span><span class="text-blue"> (mg)</span></strong>
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-3">
                                                    <p class=""><strong>{{ $lang['16'] }} :</strong></p>
                                                </td>
                                                <td class="border-b">
                                                    <p class="">
                                                        @if($detail['general_dosing'] == "1")
                                                            <strong><span class="text-[#119154] text-[18px]"> {{ round($detail['in_milli'], 1) }} - {{ round($milli2, 1) }}</span><span class="text-blue"> (mL)</span></strong>
                                                        @elseif($detail['general_dosing'] == "2" || $detail['general_dosing'] == "3")
                                                            <strong><span class="text-[#119154] text-[18px]"> {{ round($detail['in_milli'], 1) }} </span><span class="text-blue"> (mL)</span></strong>
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                        @if($detail['general_dosing'] == "1")
                                            @if($detail['route'] == "1")
                                                @if($milli1 > 500)
                                                    <p class="mt-3"><b>❗</b> {{ $lang['25'] }} 500 milligrams per dose.</p>
                                                    @if($milli1 * 3 > 4000)
                                                        <p class="mt-3"><b>❗</b> {{ $lang['25'] }} of 4 grams per day.</p>
                                                    @endif
                                                @endif
                                            @elseif($detail['route'] == "2")
                                                @if(($milli1 * 3 > 4000))
                                                    <p class="mt-3"><b>❗</b> {{ $lang['25'] }} 4 grams per day.</p>
                                                @endif
                                            @endif
                                        @elseif($detail['general_dosing'] == "3")
                                            @if(($detail['in_mm']) > 2000)
                                                <p class="mt-3"><b>❗</b> {{ $lang['27'] }} 2 grams per dose.</p>
                                            @endif
                                        @endif
                                    </div>
                                @endif
                                
                                @if($detail['dosag'] != "")
                                    @if($detail['general_dosing'] == "1")
                                        @if($detail['route'] == "1")
                                            <p class="mt-3">{{ $lang['18'] }} : <strong class="text-[#119154]">{{ $detail['w_val'] * (float)$detail['dosag'] }}</strong><strong><span class="text-blue"> (mg) </span></strong></p>
                                            @if($detail['dosag'] >= 15 && $detail['dosag'] <= 30)
                                                <p class="mt-3">✅ {{ $lang['19'] }} .</p>
                                            @else
                                                <p class="mt-3">❌ {{ $lang['17'] }} .</p>
                                            @endif
                                        @elseif($detail['route'] == "2")
                                            <p class="mt-3">{{ $lang['18'] }} : <strong class="text-[#119154]">{{ $detail['dosag'] * $detail['w_val'] }}</strong><strong><span class="text-blue"> (mg) </span></strong></p>
                                            @if($detail['dosag'] == "30")
                                            @elseif($detail['dosag'] >= 31 && $detail['dosag'] <= 60)
                                                <p class="mt-3">✅ {{ $lang['19'] }}.</p>
                                            @else
                                                <p class="mt-3">❌ {{ $lang['17'] }}.</p>
                                            @endif
                                        @endif
                                    @elseif($detail['general_dosing'] == "2" || $detail['general_dosing'] == "3")
                                        <p class="mt-3">{{ $lang['18'] }} : <strong class="text-[#119154]">{{ $detail['w_val'] * (float)$detail['dosag'] }}</strong><strong><span class="text-blue"> (mg) </span></strong></p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
