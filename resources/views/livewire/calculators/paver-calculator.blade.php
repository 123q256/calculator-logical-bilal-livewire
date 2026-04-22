<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column: Inputs -->
                    <div class="space-y-6">
                        <!-- Project Shape Selection -->
                        <div>
                            <label for="operations" class="label">{{ $lang['1'] ?? 'Project Shape' }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="operations" id="operations" class="input">
                                    <option value="3">{{ $lang['2'] ?? 'Rectangular Area' }}</option>
                                    <option value="4">{{ $lang['3'] ?? 'Multiple Rectangular Areas' }}</option>
                                    <option value="5">{{ $lang['4'] ?? 'Circular Area' }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Area Dimensions -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="label">
                                    @if($operations == '5') {{ $lang['20'] ?? 'Diameter' }}
                                    @else {{ $lang['6'] ?? 'Length' }}
                                    @endif:
                                </label>
                                <div class="relative w-full py-2">
                                    <input type="number" step="any" wire:model="first" class="input" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('u1')">{{ $units1 }} ▾</label>
                                    @if ($showDropdown === 'u1')
                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('units1', '{{ $name }}')">{{ $name }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($operations != '5')
                            <div>
                                <label class="label">{{ $lang['7'] ?? 'Width' }}:</label>
                                <div class="relative w-full py-2">
                                    <input type="number" step="any" wire:model="second" class="input" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('u2')">{{ $units2 }} ▾</label>
                                    @if ($showDropdown === 'u2')
                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('units2', '{{ $name }}')">{{ $name }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($operations == '4')
                            <div class="col-span-1 sm:col-span-2">
                                <label class="label">{{ $lang['9'] ?? 'Quantity' }}:</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model="fiveb" class="input" />
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Paver Dimensions -->
                        <div class="border-t pt-4">
                            <h3 class="font-bold text-gray-700 mb-2 uppercase text-xs tracking-wider">Paver Size</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="label">{{ $lang['12'] ?? 'Paver Length' }}:</label>
                                    <div class="relative w-full py-2">
                                        <input type="number" step="any" wire:model="third" class="input" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('u3')">{{ $units3 }} ▾</label>
                                        @if ($showDropdown === 'u3')
                                            <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('units3', '{{ $name }}')">{{ $name }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <label class="label">{{ $lang['11'] ?? 'Paver Width' }}:</label>
                                    <div class="relative w-full py-2">
                                        <input type="number" step="any" wire:model="four" class="input" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('u4')">{{ $units4 }} ▾</label>
                                        @if ($showDropdown === 'u4')
                                            <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('units4', '{{ $name }}')">{{ $name }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing and Costs -->
                        <div class="border-t pt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="label">{{ $lang['13'] ?? 'Price per Paver' }}:</label>
                                <div class="relative w-full py-2">
                                    <input type="number" step="any" wire:model="price" class="input" placeholder="0.00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('p_u')">{{ $price_unit }} ▾</label>
                                    @if ($showDropdown === 'p_u')
                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach (["ft²", "m²"] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('price_unit', '{{ $currancy }} {{ $u }}')">{{ $currancy }} {{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <label class="label">{{ $lang['15'] ?? 'Labor Cost per Area' }}:</label>
                                <div class="relative w-full py-2">
                                    <input type="number" step="any" wire:model="cost" class="input" placeholder="0.00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('c_u')">{{ $cost_unit }} ▾</label>
                                    @if ($showDropdown === 'c_u')
                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach (["ft²", "m²"] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('cost_unit', '{{ $currancy }} {{ $u }}')">{{ $currancy }} {{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Visual Helper -->
                    <div class="flex flex-col items-center justify-center space-y-4">
                        @php
                            $imageName = match($operations) {
                                '3' => 'Rectangle',
                                '4' => 'Rectangle',
                                '5' => 'circle',
                                default => 'Rectangle'
                            };
                        @endphp
                        <div class="bg-white p-4 rounded-xl shadow-inner border border-gray-100">
                            <img src="{{ asset('images/' . $imageName . '.webp') }}" alt="{{ $imageName }}" class="max-w-full h-auto rounded-lg shadow-sm" style="max-height: 250px;">
                        </div>
                        <p class="text-sm text-gray-500 italic text-center">
                            Calculate the total number of pavers needed for your project, including area estimates and cost breakdowns.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-8">
                @if ($type == 'calculator')
                    @include('inc.button')
                @else
                    @include('inc.widget-button')
                @endif
            </div>
        </div>

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="max-w-4xl mx-auto">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-5">
                        <!-- Main Result -->
                        <div class="bg-white/50 p-6 rounded-xl border border-blue-50 flex flex-col items-center justify-center text-center">
                            <h3 class="text-gray-500 text-sm uppercase tracking-widest mb-2 font-bold">{{ $lang['16'] ?? 'Pavers Needed' }}</h3>
                            <div class="text-5xl font-black text-blue-800 mb-2">{{ number_format($detail['no_paver']) }}</div>
                            <div class="text-gray-400 text-sm">Total Individual Pavers</div>
                        </div>

                        <!-- Statistics Breakdown -->
                        <div class="bg-white/50 p-6 rounded-xl border border-blue-50">
                            <h3 class="font-bold text-blue-700 mb-4 border-b pb-2">Project Breakdown</h3>
                            <table class="w-full text-sm">
                                <tr>
                                    <td class="py-2 text-gray-600"><strong>{{ $lang['5'] ?? 'Total Project Area' }} :</strong></td>
                                    <td class="py-2 text-right font-semibold">{{ round($detail['area_ans'], 2) }} ft²</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-gray-600"><strong>{{ $lang['10'] ?? 'Area per Paver' }} :</strong></td>
                                    <td class="py-2 text-right font-semibold">{{ round($detail['patio_area_ans'], 2) }} ft²</td>
                                </tr>
                                @isset($detail['price_p'])
                                    <tr>
                                        <td class="py-2 text-gray-600 border-t mt-2 pt-2">{{ $lang['17'] ?? 'Total Paver Cost' }} :</td>
                                        <td class="py-2 text-right font-semibold border-t mt-2 pt-2">{{ $currancy }} {{ number_format($detail['price_p'], 2) }}</td>
                                    </tr>
                                @endisset
                                @isset($detail['cost_p'])
                                    <tr>
                                        <td class="py-2 text-gray-600">{{ $lang['18'] ?? 'Total Labor Cost' }} :</td>
                                        <td class="py-2 text-right font-semibold">{{ $currancy }} {{ number_format($detail['cost_p'], 2) }}</td>
                                    </tr>
                                @endisset
                                @isset($detail['total_cost'])
                                    <tr class="text-green-700 font-bold text-lg">
                                        <td class="pt-4 border-t">{{ $lang['19'] ?? 'Estimated Total' }} :</td>
                                        <td class="pt-4 text-right border-t">{{ $currancy }} {{ number_format($detail['total_cost'], 2) }}</td>
                                    </tr>
                                @endisset
                            </table>
                        </div>
                    </div>
               
                </div>
            </div>
        @endisset
    </form>
</div>
