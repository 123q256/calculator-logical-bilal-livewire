<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-6">
                        <label for="first" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Length' }}:</label>
                        <div class="relative w-full mt-3">
                            <input type="number" wire:model="first" id="first" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('unit1_dropdown')">{{ $unit1 }} ▾</label>
                            @if ($showDropdown === 'unit1_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "mm", "m", "in", "yd", "ft"] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit1', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="second" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Width' }}:</label>
                        <div class="relative w-full mt-3">
                            <input type="number" wire:model="second" id="second" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('unit2_dropdown')">{{ $unit2 }} ▾</label>
                            @if ($showDropdown === 'unit2_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm", "mm", "m", "in", "yd", "ft"] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit2', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="third" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Price' }}:</label>
                        <div class="relative w-full mt-3">
                            <input type="number" wire:model="third" id="third" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('unit3_dropdown')">{{ $currancy . ' ' . $unit3 }} ▾</label>
                            @if ($showDropdown === 'unit3_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["mm²", "cm²", "m²", "km²", "in²", "ft²", "yd²", "a", "da", "ha", "ac"] as $item)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit3', '{{ $item }}')">{{ $currancy . ' ' . $item }}</p>
                                    @endforeach
                                </div>
                            @endif
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>{{ $lang['4'] ?? 'Total Area' }} :</strong></td>
                                            <td class="border-b py-2">
                                                <span>{{ $converted_result }}</span>
                                                <select wire:model.live="result_unit" class="d-inline ms-1 text-[17px] w-[80px] border-none outline-none text-[#1670a7] bg-transparent">
                                                    @foreach (["in²", "cm²", "m²", "ft²", "yd²", "km²", "a", "ac", "ha"] as $u)
                                                        <option value="{{ $u }}">{{ $u }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['5'] ?? 'Price' }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy . ' ' . number_format($detail['price'] ?? 0, 2) }}</td>
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
