<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="length" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Length' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('l_units_dropdown')">{{ $l_units }} ▾</label>
                            @if ($showDropdown === 'l_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["mm", "cm", "m", "ft", "in", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('l_units', '{{ $u }}')">
                                            {{ $u == 'mm' ? 'millimeters (mm)' : ($u == 'cm' ? 'centimeters (cm)' : ($u == 'm' ? 'meters (m)' : ($u == 'ft' ? 'feet (ft)' : ($u == 'in' ? 'inches (in)' : 'yards (yd)')))) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="width" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Width' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('w_units_dropdown')">{{ $w_units }} ▾</label>
                            @if ($showDropdown === 'w_units_dropdown')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["mm", "cm", "m", "ft", "in", "yd"] as $u)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('w_units', '{{ $u }}')">
                                            {{ $u == 'mm' ? 'millimeters (mm)' : ($u == 'cm' ? 'centimeters (cm)' : ($u == 'm' ? 'meters (m)' : ($u == 'ft' ? 'feet (ft)' : ($u == 'in' ? 'inches (in)' : 'yards (yd)')))) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="price" class="font-s-14 text-blue">({{ $lang['3'] ?? 'Price per square inch' }}):</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="price" id="price" class="input pr-10" />
                            <span class="absolute right-3 top-3 text-blue">{{ $currancy }}</span>
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
                            <div class="w-full">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['5'] ?? 'Total Area' }}</strong></td>
                                            <td class="border-b py-2">{{ number_format($detail['square_inches'] ?? 0, 2) }} in²</td>
                                        </tr>
                                        @if (isset($detail['cost']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['6'] ?? 'Total Cost' }}</strong></td>
                                                <td class="border-b py-2">{{ $currancy }} {{ number_format($detail['cost'], 2) }}</td>
                                            </tr>
                                        @endif
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
