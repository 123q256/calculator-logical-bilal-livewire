<div x-data="{ dropdowns: {} }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4">
                    {{-- Curtain Type --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="type_curtain" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="type_curtain" id="type_curtain" class="input">
                                <option value="sill_lenght">{{ $lang['9'] }}</option>
                                <option value="cafe_length">{{ $lang['10'] }}</option>
                                <option value="extra_long">{{ $lang['11'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Fullness --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="fullness" class="label">{{ $lang['2'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="fullness" id="fullness" class="input">
                                <option value="std_full">{{ $lang['12'] }}</option>
                                <option value="del_full">{{ $lang['13'] }}</option>
                                <option value="ult_full">{{ $lang['14'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Window Height --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="w_height" class="label">({{ $lang['3'] }}):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="w_height" id="w_height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['height'] = !dropdowns['height']">
                                {{ $wh_units }} ▾
                            </label>
                            <div x-show="dropdowns['height']" @click.away="dropdowns['height'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                @foreach(['mm' => 'milimeters (mm)', 'cm' => 'centimeters (cm)', 'm' => 'meters (m)', 'ft' => 'feet (ft)', 'in' => 'inches (in)', 'yd' => 'yards (yd)'] as $val => $label)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('wh_units', '{{ $val }}'); dropdowns['height'] = false">{{ $label }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Window Width --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="w_width" class="label">({{ $lang['4'] }}):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="w_width" id="w_width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['width'] = !dropdowns['width']">
                                {{ $ww_units }} ▾
                            </label>
                            <div x-show="dropdowns['width']" @click.away="dropdowns['width'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                @foreach(['mm' => 'milimeters (mm)', 'cm' => 'centimeters (cm)', 'm' => 'meters (m)', 'ft' => 'feet (ft)', 'in' => 'inches (in)', 'yd' => 'yards (yd)'] as $val => $label)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('ww_units', '{{ $val }}'); dropdowns['width'] = false">{{ $label }}</p>
                                @endforeach
                            </div>
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

        <hr>

        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="">
                            <div class="w-full mt-5">
                                <div class="w-full">
                                    <div class="w-full lg:w-[80%]">
                                        @if (isset($detail['type_curtain']))
                                            <p class="md:text-[20px] text-[16px] mb-4"><strong>{{ $lang[5] }}</strong></p>
                                            <table class="text-[18px] w-full">
                                                <tr class="border-b border-blue-50">
                                                    <td class="py-2">{{ $lang[6] }} :</td>
                                                    <td class="py-2 text-right">
                                                        {{ round($detail['c_lenght'], 2) }} 
                                                        <span class="text-sm font-normal">({{ $lang[7] }})</span>
                                                    </td>
                                                </tr>
                                                <tr class="border-b border-blue-50">
                                                    <td class="py-2">{{ $lang[8] }} :</td>
                                                    <td class="py-2 text-right">
                                                        {{ round($detail['c_width'], 2) }} 
                                                        <span class="text-sm font-normal">({{ $lang[7] }})</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
</div>
