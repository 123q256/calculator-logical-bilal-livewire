<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    {{-- Concentration --}}
                    <div class="space-y-2">
                        <label class="label font-bold text-blue text-xs tracking-wider uppercase">{!! $lang['1'] !!} ({!! $lang['2'] !!}):</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="concentration" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('concentration_unit_dropdown')">
                                {{ $concentration_unit }} ▾
                            </label>
                            @if ($showDropdown === 'concentration_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg min-w-[80px]">
                                    @foreach(['M', 'mM', 'μM', 'nM', 'pM', 'fM', 'aM', 'zM', 'yM'] as $unit)
                                        <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('concentration_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Volume --}}
                    <div class="space-y-2">
                        <label class="label font-bold text-blue text-xs tracking-wider uppercase">{!! $lang['3'] !!} ({!! $lang['2'] !!}):</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="volume" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold text-blue" wire:click="toggleOverlay('volume_unit_dropdown')">
                                {{ $volume_unit }} ▾
                            </label>
                            @if ($showDropdown === 'volume_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto min-w-[200px]">
                                    @foreach(['mm³', 'cm³', 'dm³', 'm³', 'in³', 'ft³', 'yd³', 'ml', 'cl', 'l', 'US gal', 'UK gal', 'US fl oz', 'UK fl oz', 'cups', 'tbsp', 'tsp', 'US qt', 'UK qt', 'US pt', 'UK pt'] as $unit)
                                        <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-xs" wire:click="setUnit('volume_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Final Concentration --}}
                    <div class="space-y-2 md:col-span-2">
                        <label class="label font-bold text-blue text-xs tracking-wider uppercase">{!! $lang['1'] !!} ({!! $lang['4'] !!}):</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="final" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('final_unit_dropdown')">
                                {{ $final_unit }} ▾
                            </label>
                            @if ($showDropdown === 'final_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg min-w-[80px]">
                                    @foreach(['M', 'mM', 'μM', 'nM', 'pM', 'fM', 'aM', 'zM', 'yM'] as $unit)
                                        <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('final_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex justify-center items-center space-x-4 mt-12">
                    @if ($type == 'calculator')
                        @include('inc.button')
                    @elseif ($type == 'widget')
                        @include('inc.widget-button')
                    @endif
                </div>
            </div>
        </div>

        <hr>

        @if($detail)
            <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="mt-3">
                        {{-- Main Result --}}
                        <div class="bg-light-blue p-6 lg:p-7 text-center mb-3 rounded-lg">
                            <p class="font-bold text-blue tracking-wide text-xs uppercase mb-3">{!! $lang['3'] !!} ({!! $lang['4'] !!})</p>
                            <p class="font-black text-[40px] lg:text-[50px] text-green leading-none">
                                {!! round($detail['answer'], 5) !!}
                                <span class="text-base font-bold text-gray-500 ml-1">{!! $lang['6'] !!}</span>
                            </p>
                        </div>

                        <p class="font-bold text-blue mb-4 text-sm tracking-widest uppercase">{!! $lang['3'] !!} ({!! $lang['4'] !!}) {!! $lang['5'] !!}</p>
                        
                        {{-- Conversion Table --}}
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider">Unit</th>
                                        <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider">Value</th>
                                        <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider hidden md:table-cell">Unit</th>
                                        <th class="border border-gray-200 px-4 py-3 text-left text-xs font-bold text-blue tracking-wider hidden md:table-cell">Value</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                    @php
                                        $units = [
                                            'mm³' => $detail['answer'] * 1e+6,
                                            'cm³' => $detail['answer'] * 1000,
                                            'dm³' => $detail['answer'] * 1,
                                            'm³' => $detail['answer'] / 1000,
                                            'in³' => $detail['answer'] * 61.024,
                                            'ft³' => $detail['answer'] / 28.317,
                                            'yd³' => $detail['answer'] / 764.6,
                                            'ml' => $detail['answer'] * 1000,
                                            'cl' => $detail['answer'] * 100,
                                            'tsp' => $detail['answer'] * 202.9,
                                            'US gal' => $detail['answer'] / 3.785,
                                            'UK gal' => $detail['answer'] / 4.546,
                                            'US fl oz' => $detail['answer'] * 33.814,
                                            'UK fl oz' => $detail['answer'] * 35.195,
                                            'cups' => $detail['answer'] * 4.227,
                                            'tbsp' => $detail['answer'] * 66.6667,
                                            'US qt' => $detail['answer'] * 1.057,
                                            'UK qt' => $detail['answer'] / 1.136,
                                            'US pt' => $detail['answer'] * 2.113376,
                                            'UK pt' => $detail['answer'] * 1.759754,
                                        ];
                                        $chunks = array_chunk(array_keys($units), 2);
                                    @endphp
                                    @foreach($chunks as $chunk)
                                        <tr class="hover:bg-gray-50">
                                            @foreach($chunk as $unitKey)
                                                <td class="border border-gray-200 px-4 py-2 font-semibold text-gray-600 bg-gray-50/30">{{ $unitKey }}</td>
                                                <td class="border border-gray-200 px-4 py-2 text-gray-800 break-all">{{ is_numeric($units[$unitKey]) ? round($units[$unitKey], 6) : $units[$unitKey] }}</td>
                                            @endforeach
                                            {{-- Fill empty cells if chunk is not full --}}
                                            @if(count($chunk) < 2)
                                                <td class="border border-gray-200 px-4 py-2"></td>
                                                <td class="border border-gray-200 px-4 py-2"></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
