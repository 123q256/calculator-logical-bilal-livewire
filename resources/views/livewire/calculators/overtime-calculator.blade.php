<div>
    <style>
        #onetw {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            color: #1670a7;
            cursor: pointer;
            outline: none;
            border: none;
            margin-left: 10px;
        }
    
        @media (max-width: 430px) {
            .calculator-box {
                padding-right: 0.5rem;
                padding-left: 0.5rem;
            }
        }

        .orange_color {
            color: #CC6E29;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto ">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2  gap-4">
                    
                    <!-- Pay Rate -->
                    <div class="space-y-2">
                        <label for="pay" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Hourly Pay' }} {{ $currancy }}</label>
                        <div class="relative w-full ">
                            <input type="number" step="any" wire:model.live="pay" id="pay"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input"
                                placeholder="00" />
                            
                            <label for="per" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                wire:click="toggleDropdown('per')">
                                {{ $per }} ▾
                            </label>
                            
                            @if ($openDropdown === 'per')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[25%] md:w-[25%] w-[40%] mt-1 right-0 shadow-lg" style="display: block;">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('per', 'hour')">{{ $lang['hrs'] ?? 'hour' }}</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('per', 'day')">{{ $lang['dys'] ?? 'day' }}</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('per', 'week')">{{ $lang['wks'] ?? 'week' }}</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('per', 'month')">{{ $lang['mos'] ?? 'month' }}</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('per', 'anualy')">{{ $lang['yrs'] ?? 'anualy' }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Overtime Rate -->
                    <div class="grid grid-cols-5 lg:grid-cols-5 md:grid-cols-5 gap-4">
                        <div class="col-span-3 space-y-2">
                            <label for="overtime_rate" class="font-s-14 text-blue">{{ $lang['10'] ?? 'Overtime Rate' }}</label>
                            <select wire:model.live="overtime_rate" id="overtime_rate" class="input mt-2">
                                <option value="half">{{ $lang['half_t'] ?? 'Time and a Half' }} (1.5x)</option>
                                <option value="double">{{ $lang['duble_t'] ?? 'Double Time' }} (2x)</option>
                                <option value="triple">{{ $lang['triple_t'] ?? 'Triple Time' }} (3x)</option>
                                <option value="other">{{ $lang['other'] ?? 'Other' }}</option>
                            </select>
                        </div>
                        <div class="col-span-2 space-y-2">
                            <label class="block text-sm font-medium text-gray-700">&nbsp;</label>
                            <input type="number" step="any" wire:model.live="multi" id="multi" class="input"
                                aria-label="input" placeholder="0" {{ $overtime_rate !== 'other' ? 'readonly' : '' }} />
                        </div>
                    </div>

                    <!-- Regular Time -->
                    <div class="space-y-2 relative">
                        <label for="time" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Regular Hours' }}</label>
                        <input type="number" step="any" wire:model.live="time" id="time" class="input"
                            placeholder="{{ $lang['opt'] ?? 'Optional' }}" aria-label="input" />
                        <span class="input_unit text-blue">hrs</span>
                    </div>

                    <!-- Overtime -->
                    <div class="space-y-2 relative">
                        <label for="over" class="font-s-14 text-blue">{{ $lang['12'] ?? 'Overtime Hours' }}</label>
                        <input type="number" step="any" wire:model.live="over" min="0" id="over" class="input"
                            placeholder="{{ $lang['opt'] ?? 'Optional' }}" aria-label="input" />
                        <span class="input_unit text-blue">hrs</span>
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

        <hr>

        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full radius-10 mt-3">
                                <div class="lg:w-[80%] w-full overflow-auto">
                                    <table class="w-full">
                                        <tr>
                                            <td class="py-2 border-b" width="60%">
                                                <strong>{{ $lang['13'] ?? 'Overtime Pay Rate' }}</strong></td>
                                            <td class="py-2 border-b"> {{ $currancy }} {{ $detail['overPayPerHour'] }}
                                                <span class="font-s-14">{{ $lang['15'] ?? 'per hour' }}</span></td>
                                        </tr>
                                        @if ($over)
                                            <tr>
                                                <td class="py-2 border-b">
                                                    <strong>{{ $lang['18'] ?? 'Total Overtime Pay' }}</strong></td>
                                                <td class="py-2 border-b"> {{ $currancy }} {{ $detail['overTotalPay'] }}
                                                    <span class="font-s-14">{{ $lang['16'] ?? 'per period' }}</span></td>
                                            </tr>
                                        @endif
                                        @if ($time)
                                            <tr>
                                                <td class="py-2 border-b">
                                                    <strong>{{ $lang['19'] ?? 'Regular Pay' }}</strong></td>
                                                <td class="py-2 border-b"> {{ $currancy }} {{ $detail['regPay'] }}
                                                    <span class="font-s-14">{{ $lang['16'] ?? 'per period' }}</span></td>
                                            </tr>
                                        @endif
                                        @if ($time && $over)
                                            <tr>
                                                <td class="py-2 border-b">
                                                    <strong>{{ $lang['14'] ?? 'Total Pay' }}</strong></td>
                                                <td class="py-2 border-b"
                                                    x-data="{ 
                                                        initialValue: {{ $detail['total'] }},
                                                        unit: 'month',
                                                        getValue() {
                                                            if (this.unit === 'year') return (this.initialValue * 12).toFixed(2);
                                                            if (this.unit === 'week') return (this.initialValue / 4.344).toFixed(2);
                                                            return this.initialValue.toFixed(2);
                                                        }
                                                    }">
                                                    <div class="flex items-center">
                                                        <span>{{ $currancy }} <span x-text="getValue()"></span></span>
                                                        <select x-model="unit" id="onetw">
                                                            <option value="week">Per Week</option>
                                                            <option value="month">Per Month</option>
                                                            <option value="year">Per Year</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
