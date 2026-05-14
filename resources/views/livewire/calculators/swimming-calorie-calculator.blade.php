<div>
    <style>
        .bg-light-blue { background-color: #F0F7FF; }
        .text-blue { color: #2845F5; }
        .border-blue { border-color: #2845F5; }
        .input_unit_dropdown { 
            position: absolute; 
            right: 12px; 
            top: 50%; 
            transform: translateY(-50%); 
            font-size: 14px;
            font-weight: 500;
            color: #4B5563;
            background: transparent;
            border: none;
            cursor: pointer;
            text-decoration: underline;
            padding-right: 15px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%234B5563'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right center;
            background-size: 12px;
        }
        .input_unit_dropdown:focus { outline: none; }
    </style>

    <form wire:submit.prevent="calculate" x-data="{ weight_unit_open: false, time_unit_open: false }">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <!-- Swimming Style -->
                    <div class="col-span-12">
                        <label for="style" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="style" class="input" id="style">
                                @php
                                    $styles = [
                                        '13.8' => $lang['2'], '9.5' => $lang['3'], '4.8' => $lang['4'], 
                                        '10.3' => $lang['5'], '5.3' => $lang['6'], '10.0' => $lang['7'], 
                                        '8.3' => $lang['8'], '7.0' => $lang['9'], '9.8' => $lang['10'], 
                                        '3.5' => $lang['11'], '5.5' => $lang['12'], '9.8' => $lang['13'], 
                                        '6.8' => $lang['14'], '4.5' => $lang['15']
                                    ];
                                @endphp
                                @foreach($styles as $val => $name)
                                    <option value="{{ $val }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Weight Input with Custom Dropdown -->
                    <div class="col-span-6">
                        <label for="weight" class="label">{{ $lang['16'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" step="any" wire:model.live="weight" id="weight" class="input p-2 w-full" placeholder="00" />
                            <label @click="weight_unit_open = !weight_unit_open" class="absolute cursor-pointer text-sm underline right-6 top-4 select-none">
                                <span x-text="$wire.weight_unit"></span> ▾
                            </label>
                            <div x-show="weight_unit_open" @click.away="weight_unit_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('weight_unit', 'kg'); weight_unit_open = false">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('weight_unit', 'lb'); weight_unit_open = false">lb</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('weight_unit', 'stone'); weight_unit_open = false">stone</p>
                            </div>
                        </div>
                    </div>

                    <!-- Time Input with Custom Dropdown -->
                    <div class="col-span-6">
                        <label for="time" class="label">{{ $lang['17'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" step="any" wire:model.live="time" id="time" class="input p-2 w-full" placeholder="00" />
                            <label @click="time_unit_open = !time_unit_open" class="absolute cursor-pointer text-sm underline right-6 top-4 select-none">
                                <span x-text="$wire.time_unit"></span> ▾
                            </label>
                            <div x-show="time_unit_open" @click.away="time_unit_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('time_unit', 'sec'); time_unit_open = false">sec</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('time_unit', 'min'); time_unit_open = false">min</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('time_unit', 'hrs'); time_unit_open = false">hrs</p>
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
        </div>
    </form>

    <!-- Result Section -->
    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
        <div >
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="flex flex-wrap justify-center md:justify-around lg:justify-around text-center">
                            <div class="mt-2 px-4">
                                <p><strong>{{ $lang['18'] }}</strong></p>
                                <p>
                                    <strong class="text-[28px] text-green-500">{{ $detail['cal_burned_per_min'] }}</strong>
                                    <span class="text-[20px]">kcal/min</span>
                                </p>
                            </div>
                            <div class="border-r hidden md:block lg:block self-center h-12">&nbsp;</div>
                            <div class="mt-2 px-4">
                                <p><strong>{{ $lang['19'] }}</strong></p>
                                <p>
                                    <strong class="text-[28px] text-green-500">{{ $detail['total_cal_burned'] }}</strong>
                                    <span class="text-[20px]">Kcal Total</span>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Simple Table for clarity if needed, but horizontal layout is cleaner -->
                        <div class="hidden grid grid-cols-12 gap-2 mt-8">
                            <div class="col-span-12 md:col-span-8 md:col-start-3 lg:col-span-6 lg:col-start-4">
                                <table class="w-full" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-3"><strong>{{ $lang['18'] }}:</strong></td>
                                        <td class="border-b py-3 text-right"><strong>{{ $detail['cal_burned_per_min'] }} kcal</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3"><strong>{{ $lang['19'] }}:</strong></td>
                                        <td class="border-b py-3 text-right"><strong>{{ $detail['total_cal_burned'] }} kcal</strong></td>
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
</div>
