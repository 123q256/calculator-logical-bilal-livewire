<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="w-full lg:w-8/12 justify-center mx-auto mt-3">
                <div class="w-full lg:w-10/12 justify-center mx-auto mt-3">
                    <!-- Mode Selection -->
                    <div class="w-full lg:w-12/12 px-2 mb-3">
                        <div class="flex justify-between w-full">
                            <div class="w-9/12">
                                <label for="known" class="label">{{ $lang['1'] ?? 'Known values' }}</label>
                                <div class="py-2">
                                    <select wire:model.live="known" id="known" class="border text-gray-900 text-sm rounded-l-lg rounded-r-none block w-full p-2.5 outline-none focus:ring-0">
                                        <option value="1">{{ $lang['2'] ?? 'average velocity & time' }}</option>
                                        <option value="2">{{ $lang['3'] ?? 'initial velocity, acceleration & time' }}</option>
                                        <option value="3">{{ $lang['4'] ?? 'initial velocity, final velocity & time' }}</option>
                                        <option value="4">{{ $lang['5'] ?? 'velocity & time array' }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-3/12">
                                <label class="label">&nbsp;</label>
                                <div class="py-2">
                                    <select wire:model.live="sldsp" class="border border-gray-300 text-gray-900 rounded-r-lg rounded-l-none text-sm border-s-gray-100 border-s-2 block w-full p-2.5 outline-none focus:ring-0">
                                        <option value="m">m</option>
                                        <option value="in">in</option>
                                        <option value="ft">ft</option>
                                        <option value="km">km</option>
                                        <option value="mi">mi</option>
                                        <option value="cm">cm</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mode 1: Average Velocity & Time -->
                    @if($known == '1')
                    <div class="w-full lg:w-12/12 px-2 mb-3">
                        <label for="av" class="label">{{ $lang['6'] ?? 'Average velocity' }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" wire:model.live="av" step="any" id="av" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-5" wire:click="toggleOverlay('slav_dropdown')">{{ $slav }} ▾</label>
                            @if($showDropdown === 'slav_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['m/s','ft/s','km/h','km/s','mi/s','mph'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('slav', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Modes 1, 2, 3: Time -->
                    @if(in_array($known, ['1', '2', '3']))
                    <div class="w-full lg:w-12/12 px-2 mb-3">
                        <label for="tm" class="label">{{ $lang['7'] ?? 'Time' }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" wire:model.live="tm" step="any" id="tm" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-5" wire:click="toggleOverlay('sltm_dropdown')">{{ $sltm }} ▾</label>
                            @if($showDropdown === 'sltm_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['sec','min','h'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('sltm', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Modes 2, 3: Initial Velocity -->
                    @if(in_array($known, ['2', '3']))
                    <div class="w-full lg:w-12/12 px-2 mb-3">
                        <label for="iv" class="label">{{ $lang['8'] ?? 'Initial velocity' }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" wire:model.live="iv" step="any" id="iv" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-5" wire:click="toggleOverlay('sliv_dropdown')">{{ $sliv }} ▾</label>
                            @if($showDropdown === 'sliv_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['m/s','ft/s','km/h','km/s','mi/s','mph'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('sliv', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Mode 3: Final Velocity -->
                    @if($known == '3')
                    <div class="w-full lg:w-12/12 px-2 mb-3">
                        <label for="fv" class="label">{{ $lang['9'] ?? 'Final velocity' }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" wire:model.live="fv" step="any" id="fv" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-5" wire:click="toggleOverlay('slfv_dropdown')">{{ $slfv }} ▾</label>
                            @if($showDropdown === 'slfv_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['m/s','ft/s','km/h','km/s','mi/s','mph'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('slfv', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Mode 2: Acceleration -->
                    @if($known == '2')
                    <div class="w-full lg:w-12/12 px-2 mb-3">
                        <label for="acc" class="label">{{ $lang['10'] ?? 'Acceleration' }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" wire:model.live="acc" step="any" id="acc" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-5" wire:click="toggleOverlay('slacc_dropdown')">{{ $slacc }} ▾</label>
                            @if($showDropdown === 'slacc_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['m/s²','ft/s²'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('slacc', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Mode 4: Velocity-Time Array -->
                    @if($known == '4')
                    <div class="w-full lg:w-12/12 px-2 mb-3 space-y-4">
                        @for ($i = 0; $i < 10; $i++)
                        <div class="flex space-x-4 border-b pb-4 border-gray-100 last:border-0">
                            <div class="w-1/2">
                                <label class="label text-xs uppercase tracking-wider text-gray-500">v {{ $i }}</label>
                                <div class="relative w-full py-1">
                                    <input type="number" wire:model.live="vloc.{{ $i }}" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none text-sm" placeholder="00" />
                                    <label class="absolute cursor-pointer text-xs underline right-2 top-4" wire:click="toggleOverlay('slvloc_{{ $i }}')">{{ $slvloc[$i] }} ▾</label>
                                    @if($showDropdown === "slvloc_$i")
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['m/s','ft/s','km/h','km/s','mi/s','mph'] as $unit)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-xs" wire:click="setUnit('slvloc.{{ $i }}', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="w-1/2">
                                <label class="label text-xs uppercase tracking-wider text-gray-500">t {{ $i }}</label>
                                <div class="relative w-full py-1">
                                    <input type="number" wire:model.live="timi.{{ $i }}" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none text-sm" placeholder="00" />
                                    <label class="absolute cursor-pointer text-xs underline right-2 top-4" wire:click="toggleOverlay('sltimi_{{ $i }}')">{{ $sltimi[$i] }} ▾</label>
                                    @if($showDropdown === "sltimi_$i")
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['sec','min','h'] as $unit)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-xs" wire:click="setUnit('sltimi.{{ $i }}', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    @endif
                </div>
            </div>

            <div class="w-full flex justify-center mt-6">
                @if ($type == 'calculator')
                    @include('inc.button')
                @else
                    @include('inc.widget-button')
                @endif
            </div>
        </div>

        @if($detail)
        <hr class="my-8">
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full rounded-lg mt-2">
                        <div class="lg:w-[50%] md:w-[50%] w-full text-xl mt-4">
                            <div class="w-full">
                                <table class="w-full lg:text-lg border-separate border-spacing-4 text-sm">
                                    <tr>
                                        <td class="py-2 border-b w-3/4 font-semibold text-blue-600">{{ $lang['11'] ?? 'Displacement' }}</td>
                                        <td class="py-2 border-b font-bold text-gray-800">{{ $detail['dsp'] }}</td>
                                    </tr>
                                </table>
                            </div>

                            @if($known == '1')
                                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                    <p class="text-sm font-medium text-blue-800 mb-2">Formula Used:</p>
                                    <img src="{{ asset('images/displacement-formula-3.webp') }}" class="h-16 object-contain" alt="Formula 3">
                                </div>
                            @elseif($known == '2')
                                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                    <p class="text-sm font-medium text-blue-800 mb-2">Formula Used:</p>
                                    <img src="{{ asset('images/displacement-formula-2.webp') }}" class="h-16 object-contain" alt="Formula 2">
                                </div>
                            @elseif($known == '3')
                                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                    <p class="text-sm font-medium text-blue-800 mb-2">Formula Used:</p>
                                    <img src="{{ asset('images/displacement-formula-1.webp') }}" class="h-16 object-contain" alt="Formula 1">
                                </div>
                            @elseif($known == '4')
                                <div class="mt-4">
                                    <p class="font-semibold text-sm text-gray-600 mb-2 uppercase tracking-wide">{{ $lang['13'] ?? 'Converted results' }}</p>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div class="p-3 border rounded-lg text-center">
                                            <span class="block text-xs text-gray-500 mb-1">Feet</span>
                                            <span class="font-bold">{{ $detail['dspft'] }} ft</span>
                                        </div>
                                        <div class="p-3 border rounded-lg text-center">
                                            <span class="block text-xs text-gray-500 mb-1">Kilometers</span>
                                            <span class="font-bold">{{ $detail['dspkm'] }} km</span>
                                        </div>
                                        <div class="p-3 border rounded-lg text-center">
                                            <span class="block text-xs text-gray-500 mb-1">Miles</span>
                                            <span class="font-bold">{{ $detail['dspmi'] }} mi</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </form>
</div>
