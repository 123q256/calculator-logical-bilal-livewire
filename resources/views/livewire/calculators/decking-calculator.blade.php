<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <p class="col-span-12 font-bold text-blue border-b pb-1">{{ $lang['1'] ?? 'Deck size' }}</p>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="deck_length" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Length' }}</label>
                        <div class="relative w-full mt-1">
                            <input type="number" wire:model="deck_length" id="deck_length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('deck_length_unit_dropdown')">{{ $deck_length_unit }} ▾</label>
                            @if ($showDropdown === 'deck_length_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "in", "ft"] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('deck_length_unit', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : 'feet (ft)')) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="deck_width" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Width' }}</label>
                        <div class="relative w-full mt-1">
                            <input type="number" wire:model="deck_width" id="deck_width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('deck_width_unit_dropdown')">{{ $deck_width_unit }} ▾</label>
                            @if ($showDropdown === 'deck_width_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "in", "ft"] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('deck_width_unit', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : 'feet (ft)')) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <p class="col-span-12 mt-4 font-bold text-blue border-b pb-1">{{ $lang['4'] ?? 'Board size' }}</p>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="board_length" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Length' }}</label>
                        <div class="relative w-full mt-1">
                            <input type="number" wire:model="board_length" id="board_length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('board_length_unit_dropdown')">{{ $board_length_unit }} ▾</label>
                            @if ($showDropdown === 'board_length_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "in", "ft"] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('board_length_unit', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : 'feet (ft)')) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="board_width" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Width' }}</label>
                        <div class="relative w-full mt-1">
                            <input type="number" wire:model="board_width" id="board_width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('board_width_unit_dropdown')">{{ $board_width_unit }} ▾</label>
                            @if ($showDropdown === 'board_width_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "m", "in", "ft"] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('board_width_unit', '{{ $u }}')">
                                            {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : 'feet (ft)')) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <p class="col-span-12 mt-4 font-bold text-blue border-b pb-1">{{ $lang['5'] ?? 'Fasteners' }}</p>
                    <div class="col-span-12 flex items-center space-x-6 mt-2 font-s-14">
                        <p class="text-blue font-semibold">{{ $lang['6'] ?? 'Material' }}:</p>
                        <div class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" wire:model="material" id="screws" value="screws" class="cursor-pointer">
                            <label for="screws" class="cursor-pointer">{{ $lang['7'] ?? 'Nails / Screws' }}</label>
                        </div>
                        <div class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" wire:model="material" id="hidden" value="hidden" class="cursor-pointer">
                            <label for="hidden" class="cursor-pointer">{{ $lang['8'] ?? 'Hidden clips' }}</label>
                        </div>
                    </div>

                    <p class="col-span-12 mt-4 font-bold text-blue border-b pb-1">{{ $lang['9'] ?? 'Cost estimation' }}</p>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="price" class="font-s-14 text-blue">{{ $lang['10'] ?? 'Price per board' }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model="price" id="price" class="input" placeholder="00" />
                            <span class="input_unit text-blue">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="Cost" class="font-s-14 text-blue">{{ $lang['11'] ?? 'Cost of fasteners' }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model="Cost" id="Cost" class="input" placeholder="00" />
                            <span class="input_unit text-blue">{{ $currancy }}</span>
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

        <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full mb-2">
                                <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td width="50%" class="border-b py-2"><strong>{{ $lang['12'] ?? 'Total deck area' }} :</strong></td>
                                            <td class="border-b py-2">{{ number_format($detail['size_deck'], 2) }} <span class="font-s-14">ft²</span></td>
                                        </tr>
                                        <tr>
                                            <td class="pt-4 pb-1 text-sm text-gray-500" colspan="2">{{ $lang['15'] ?? 'Deck area in other units' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-1 pl-4 text-sm text-gray-600 italic">cm² :</td>
                                            <td class="border-b py-1 text-sm">{{ number_format($detail['size_deck'] * 929.03, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-1 pl-4 text-sm text-gray-600 italic">m² :</td>
                                            <td class="border-b py-1 text-sm">{{ number_format($detail['size_deck'] / 10.764, 4) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-1 pl-4 text-sm text-gray-600 italic">In² :</td>
                                            <td class="border-b py-1 text-sm">{{ number_format($detail['size_deck'] * 144, 2) }}</td>
                                        </tr>

                                        <tr>
                                            <td class="border-b pt-6 pb-2"><strong>{{ $lang['16'] ?? 'Individual board area' }} :</strong></td>
                                            <td class="border-b pt-6 pb-2">{{ number_format($detail['size_board'], 2) }} <span class="font-s-14">ft²</span></td>
                                        </tr>
                                        <tr>
                                            <td class="pt-4 pb-1 text-sm text-gray-500" colspan="2">{{ $lang['17'] ?? 'Board area in other units' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-1 pl-4 text-sm text-gray-600 italic">cm² :</td>
                                            <td class="border-b py-1 text-sm">{{ number_format($detail['size_board'] * 929.03, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-1 pl-4 text-sm text-gray-600 italic">m² :</td>
                                            <td class="border-b py-1 text-sm">{{ number_format($detail['size_board'] / 10.764, 4) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-1 pl-4 text-sm text-gray-600 italic">In² :</td>
                                            <td class="border-b py-1 text-sm">{{ number_format($detail['size_board'] * 144, 2) }}</td>
                                        </tr>

                                        <tr>
                                            <td class="border-b pb-2 pt-6"><strong>{{ $lang['18'] ?? 'Number of boards' }} :</strong></td>
                                            <td class="border-b pb-2 pt-6">{{ number_format($detail['numbers']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $material === 'hidden' ? ($lang['19'] ?? 'Number of clips') : ($lang['20'] ?? 'Number of nails') }} :</strong></td>
                                            <td class="border-b py-2">{{ number_format($material === 'hidden' ? $detail['clips'] : $detail['nails']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['21'] ?? 'Total board cost' }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy . number_format($detail['price_boards'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['22'] ?? 'Total estimated cost' }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy . number_format($detail['Cost_boards'], 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
