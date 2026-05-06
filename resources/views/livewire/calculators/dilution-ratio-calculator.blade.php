<div x-data="{ dropdowns: {} }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mt-3">
                    {{-- Final Volume --}}
                    <div class="w-full">
                        <label for="final_volume" class="label">{{ $lang['1'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="final_volume" id="final_volume" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['final_unit'] = !dropdowns['final_unit']">
                                {{ $final_unit }} ▾
                            </label>
                            <div x-show="dropdowns['final_unit']" @click.away="dropdowns['final_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl max-h-60 overflow-y-auto" x-cloak>
                                @foreach (['cm³', 'dm³', 'm³', 'cu in', 'cu ft', 'cu yd', 'ml', 'cl', 'liter', 'US gal', 'UK gal'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('final_unit', '{{ $unit }}'); dropdowns['final_unit'] = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Dilution Ratio --}}
                    <div class="w-full">
                        <label for="dilution_ratio" class="label">{{ $lang['2'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" step="any" wire:model.live.debounce.500ms="dilution_ratio" id="dilution_ratio" class="input" placeholder="00" />
                            <span class="absolute right-6 top-3.5 font-bold">:1</span>
                        </div>
                    </div>

                    {{-- Concentrate Volume --}}
                    <div class="w-full">
                        <label for="concentrate_volume" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="concentrate_volume" id="concentrate_volume" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['concentrate_unit'] = !dropdowns['concentrate_unit']">
                                {{ $concentrate_unit }} ▾
                            </label>
                            <div x-show="dropdowns['concentrate_unit']" @click.away="dropdowns['concentrate_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl max-h-60 overflow-y-auto" x-cloak>
                                @foreach (['cm³', 'dm³', 'm³', 'cu in', 'cu ft', 'cu yd', 'ml', 'cl', 'liter', 'US gal', 'UK gal'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('concentrate_unit', '{{ $unit }}'); dropdowns['concentrate_unit'] = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Water Volume --}}
                    <div class="w-full">
                        <label for="water_volume" class="label">{{ $lang['1'] }}: (Water)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="water_volume" id="water_volume" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['water_unit'] = !dropdowns['water_unit']">
                                {{ $water_unit }} ▾
                            </label>
                            <div x-show="dropdowns['water_unit']" @click.away="dropdowns['water_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl max-h-60 overflow-y-auto" x-cloak>
                                @foreach (['cm³', 'dm³', 'm³', 'cu in', 'cu ft', 'cu yd', 'ml', 'cl', 'liter', 'US gal', 'UK gal'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('water_unit', '{{ $unit }}'); dropdowns['water_unit'] = false">{{ $unit }}</p>
                                @endforeach
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

        @isset($detail)
        <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex flex-col space-y-8 mt-5">
                        {{-- Result 1 --}}
                        <div class="w-full">
                            <p class="text-[20px] mb-2 font-bold text-gray-800">{{ $detail['name1'] }}</p>
                            <p class="md:text-[25px] font-extrabold text-[#119154] mb-4">{{ $detail['res1'] }}</p>
                            
                            @if(isset($detail['res11']) && is_numeric($detail['res11']))
                                <div class="w-full overflow-x-auto rounded-xl border border-gray-100 bg-white">
                                    <table class="w-full text-left">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">cm³</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">dm³</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">m³</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">cu in</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">cu ft</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">cu yd</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">ml</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">cl</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">US gal</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">UK gal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res11'] * 1000, 2) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res11'] * 1, 2) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res11'] * 0.001, 5) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res11'] * 61.02, 2) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res11'] * 0.035315, 4) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res11'] * 0.001308, 5) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res11'] * 1000, 2) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res11'] * 100, 2) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res11'] * 0.26417, 3) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res11'] * 0.21997, 3) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                        {{-- Result 2 --}}
                        <div class="w-full">
                            <p class="text-[20px] mb-2 font-bold text-gray-800">{{ $detail['name2'] }}</p>
                            <p class="md:text-[25px] font-extrabold text-[#119154] mb-4">{{ $detail['res2'] }}</p>
                            
                            @if(isset($detail['res22']) && is_numeric($detail['res22']))
                                <div class="w-full overflow-x-auto rounded-xl border border-gray-100 bg-white">
                                    <table class="w-full text-left">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">cm³</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">dm³</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">m³</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">cu in</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">cu ft</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">cu yd</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">ml</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">cl</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">US gal</th>
                                                <th class="py-3 px-4 text-sm font-bold text-gray-600">UK gal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res22'] * 1000, 2) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res22'] * 1, 2) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res22'] * 0.001, 5) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res22'] * 61.02, 2) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res22'] * 0.035315, 4) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res22'] * 0.001308, 5) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res22'] * 1000, 2) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res22'] * 100, 2) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res22'] * 0.26417, 3) }}</td>
                                                <td class="py-3 px-4 text-sm font-medium">{{ number_format($detail['res22'] * 0.21997, 3) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
