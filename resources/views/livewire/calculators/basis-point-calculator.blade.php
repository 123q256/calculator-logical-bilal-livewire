<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="col-12 mx-auto mt-2 w-full lg:w-[75%] md:w-[75%]">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="setUnitType('submit')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-all duration-300 @if ($unit_type == 'submit') tagsUnit @else hover:bg-blue-50 @endif ">
                            <span class="font-bold">Basis Point Calculator</span>
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="setUnitType('submit1')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-all duration-300 @if ($unit_type == 'submit1') tagsUnit @else hover:bg-blue-50 @endif">
                            <span class="font-bold">What is x bps of y?</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                @if ($unit_type === 'submit')
                    <div class="grid grid-cols-12 gap-4 animate-fade-in">
                        <p class="col-span-12 py-2 text-gray-600"><strong>{{ $lang[1] ?? 'Conversion' }}:</strong> {{ $lang[2] ?? 'Enter one value to calculate the others' }}.</p>
                        
                        <div class="col-span-12 md:col-span-6">
                            <label for="dec" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['3'] ?? 'Decimal' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="dec" id="dec" class="input" placeholder="00" />
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label for="percent" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['4'] ?? 'Percentage' }} (%):</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="percent" id="percent" class="input" placeholder="00" />
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label for="perm" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['5'] ?? 'Permille' }} (‰):</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="perm" id="perm" class="input" placeholder="00" />
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label for="bsp" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['6'] ?? 'Basis Points' }} (bps):</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="bsp" id="bsp" class="input" placeholder="00" />
                            </div>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-12 gap-4 animate-fade-in">
                        <p class="col-span-12 my-2 text-gray-800 font-bold">{{ $lang[7] ?? 'Calculate Basis Points of a value' }}?</p>
                        <div class="col-span-12 bg-blue-50 p-3 rounded-lg border border-blue-200 mb-2">
                          <p class="col-span-12 "><strong>{{ $lang[1] }}:</strong> {{ $lang[8] }}.</p>
                        </div>
                        
                        <div class="col-span-12 md:col-span-6">
                            <label for="bps1" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang[1] ?? 'Basis Points' }}:</label>
                            <div class="relative w-full py-2" x-data="{ open: false }">
                                <input type="number" wire:model.live="bps1" id="bps1" step="any" class="input" placeholder="00" />
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 flex items-center">
                                    <button type="button" @click="open = !open" class="text-xs font-bold underline focus:outline-none">
                                        {{ $bps_unit }} ▾
                                    </button>
                                </div>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg w-32 mt-1 right-0">
                                    <p class="p-2 cursor-pointer text-xs font-bold" @click="$wire.set('bps_unit', 'decimal'); open = false">decimal</p>
                                    <p class="p-2 cursor-pointer text-xs font-bold" @click="$wire.set('bps_unit', 'percent'); open = false">percent</p>
                                    <p class="p-2 cursor-pointer text-xs font-bold" @click="$wire.set('bps_unit', 'permille'); open = false">permille</p>
                                    <p class="p-2 cursor-pointer text-xs font-bold" @click="$wire.set('bps_unit', 'bps'); open = false">bps</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label for="of" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang[9] ?? 'Of Value' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="of" id="of" class="input" placeholder="00" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
                            </div>
                        </div>

                        <div class="col-span-12">
                            <label for="equals" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang[10] ?? 'Equals Amount' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="equals" id="equals" class="input" placeholder="00" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
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
            <div class="rounded-lg  flex items-center justify-center">
                
                <div class="w-full mt-3">
                    <div class="w-full lg:w-[80%] overflow-auto  mt-2">
                        <table class="w-full text-[18px]">
                            @if ($detail['ans'] == 1)
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[4] }} (%) </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['percent'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] }} (‰)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['perm'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[6] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['bsp'] }}</td>
                                </tr>
                            @elseif($detail['ans'] == 2)
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['dec'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] }} (‰)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['perm'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[6] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['bsp'] }}</td>
                                </tr>
                            @elseif($detail['ans'] == 3)
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['dec'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[4] }} (%)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['percent'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[6] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['bsp'] }}</td>
                                </tr>
                            @elseif($detail['ans'] == 4)
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['dec'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[4] }} (%)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['percent'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] }} (‰) </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['perm'] }}</td>
                                </tr>
                            @elseif($detail['ans'] == 5)
                                <p class="mt-2">
                                    <strong>
                                        {{ $detail['bps1'] }} bps {{ $lang[9] }} {{ $currancy }} {{ $detail['of'] }}
                                        {{ $lang[10] }} {{ $currancy }} {{ $detail['equals'] }}
                                    </strong>
                                </p>
                                <p class="mt-2"><strong>{{ $lang[12] }}:</strong></p>
                                <p class="mt-2">
                                    {{ $lang[13] }} {{ $detail['bps1'] }} bps {{ $lang[14] }} {{ $currancy }}
                                    {{ $detail['of'] }}
                                    {{ $lang[15] }} {{ $currancy }} {{ $detail['equals'] }} {{ $lang[16] }}
                                    {{ $currancy }} {{ $detail['equals'] + $detail['of'] }}
                                </p>
                            @endif
        
                        </table>
                    </div>
                </div>
            </div>
        </div>
            </div>
        @endisset
    </form>
</div>
