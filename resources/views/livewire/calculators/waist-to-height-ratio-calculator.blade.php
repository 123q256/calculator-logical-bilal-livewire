<div>
        <style>
            .speech-bubble-area {
                position: absolute;
                width: 18%;
                top: -29px;
                background: {{ $detail['color'] ?? '#20BEC8' }};
                left: {{ $detail['left'] ?? '2%' }};
                animation: bmi_res 0.5s;
                border-radius: 5px;
                padding-top: 2px;
            }
            @keyframes bmi_res {
                from { left: 2%; }
                to { left: {{ $detail['left'] ?? '2%' }} }
            }
            .speech-bubble:after {
                content: '';
                position: absolute;
                width: 0;
                height: 0;
                bottom: 0;
                left: 40%;
                border: 8px solid transparent;
                border-bottom: 0;
                margin-bottom: -7px;
                border-top-color: {{ $detail['color'] ?? '#20BEC8' }};
            }
            .bg-blue { background-color: #20BEC8 !important; }
            .bg-green { background-color: #10951D !important; }
            .bg-trumeric { background-color: #CABE52 !important; }
            .bg-red { background-color: #FF0000 !important; }
        </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    {{-- Gender --}}
                    <div class="col-span-6">
                        <label for="gender" class="label">{!! $lang['gen'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="gender" id="gender" class="input">
                                <option value="Male">{{ $lang['male'] }}</option>
                                <option value="Female">{{ $lang['female'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Age --}}
                    <div class="col-span-6">
                        <label for="age" class="label">{!! $lang['age'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="age" id="age" class="input" placeholder="00" />
                        </div>
                    </div>

                    {{-- Height --}}
                    @if ($unit_h == 'ft/in')
                        <div class="col-span-6 md:col-span-3 lg:col-span-3">
                            <label for="height_ft" class="label">{!! $lang['height'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="height_ft" id="height_ft" class="input" min="1" placeholder="ft" />
                            </div>
                        </div>
                        <div class="col-span-6 md:col-span-3 lg:col-span-3">
                            <label for="height_in" class="label">&nbsp;</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="height_in" id="height_in" step="any" min="1" class="input pr-12" placeholder="in" />
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                    <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                        ft/in ▾
                                    </button>
                                </div>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit_h', 'ft/in'); open = false">feet / inches (ft/in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit_h', 'cm'); open = false">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="height_cm" class="label">{{ $lang['height'] }} (cm):</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="height_cm" id="height_cm" step="any" class="input pr-12" placeholder="00" />
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                    <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                        cm ▾
                                    </button>
                                </div>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit_h', 'ft/in'); open = false">feet / inches (ft/in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit_h', 'cm'); open = false">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Waist --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="waist" class="label">{{ $lang['waist'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="waist" id="waist" step="any" min="1" class="input pr-12" placeholder="00" />
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                    {{ $unit }} ▾
                                </button>
                            </div>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit', 'in'); open = false">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit', 'cm'); open = false">centimeters (cm)</p>
                            </div>
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

        @if ($detail)
        <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-5">
                            <div class="w-full lg:w-[90%] mx-auto">
                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-3" style="border: 1px solid #c1b8b899;">
                                    <span>{{ $lang['ans'] }} =</span>
                                    <strong class="text-green text-[25px]">{{ $detail['ratio'] ?? '0.0' }}</strong>
                                </div>
                                <div class="grid grid-cols-12 mt-[50px] mb-4 relative">
                                    <div class="col-span-12 speech-bubble-area text-center">
                                        <p class="speech-bubble text-white rounded-lg text-[13px] relative">{{ $detail['ratio'] ?? '0.0' }}</p>
                                    </div>
                                    <div class="col-span-3 bg-[#20BEC8] text-center py-1 rounded-l">
                                        <p class="text-white text-[13px]">{{ $lang['under'] }}</p>
                                    </div>
                                    <div class="col-span-3 bg-[#10951D] text-center py-1">
                                        <p class="text-white text-[13px]">{{ $lang['health'] }}</p>
                                    </div>
                                    <div class="col-span-3 bg-[#CABE52] text-center py-1">
                                        <p class="text-white text-[13px]">{{ $lang['over'] }}</p>
                                    </div>
                                    <div class="col-span-3 bg-[#FF0000] text-center py-1 rounded-r">
                                        <p class="text-white text-[13px]">{{ $lang['obese'] }}</p>
                                    </div>
                                </div>
                                <div class="w-full overflow-auto mt-6">
                                    <table class="w-full">
                                        <thead>
                                            <tr>
                                                <th class="text-start text-blue-700 py-2 px-2">{{ $lang['val'] }}</th>
                                                <th class="text-start text-blue-700 py-2 px-2">{{ $lang['clasi'] }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="{{ $detail['xslim'] ?? '' }}">
                                                <td class="border-b py-2 px-2">0.34 {{ $lang['and_b'] }}</td>
                                                <td class="border-b py-2 px-2">{{ $lang['xslim_label'] ?? 'Extremely Slim' }}</td>
                                            </tr>
                                            <tr class="{{ $detail['slim'] ?? '' }}">
                                                <td class="border-b py-2 px-2">{{ $gender == 'Female' ? '0.35 to 0.41' : '0.35 to 0.42' }}</td>
                                                <td class="border-b py-2 px-2">{{ $lang['slim_label'] ?? 'Slim' }}</td>
                                            </tr>
                                            <tr class="{{ $detail['health'] ?? '' }}">
                                                <td class="border-b py-2 px-2">{{ $gender == 'Female' ? '0.42 to 0.48' : '0.43 to 0.52' }}</td>
                                                <td class="border-b py-2 px-2">{{ $lang['health'] }}</td>
                                            </tr>
                                            <tr class="{{ $detail['overc'] ?? '' }}">
                                                <td class="border-b py-2 px-2">{{ $gender == 'Female' ? '0.49 to 0.57' : '0.53 to 0.62' }}</td>
                                                <td class="border-b py-2 px-2">{{ $lang['over'] }}</td>
                                            </tr>
                                            <tr class="{{ $detail['overh'] ?? '' }}">
                                                <td class="py-2 px-2">{{ $gender == 'Female' ? '0.58' : '0.63' }} {{ $lang['and_a'] }}</td>
                                                <td class="py-2 px-2">{{ $lang['obese'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="w-full text-center flex justify-center mt-6">
                                    <img src="{{ asset('images/waist-min.png') }}" class="rounded-lg shadow-md" alt="Waist to Height Ratio Chart" style="width: 100%; max-width:400px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
