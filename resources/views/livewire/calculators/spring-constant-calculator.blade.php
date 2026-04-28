<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-4">
                    {{-- Solve For --}}
                    <div class="col-span-1 lg:col-span-1">
                        <label for="selection" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="selection" class="input" id="selection">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="2">{{ $lang['3'] }}</option>
                                <option value="3">{{ $lang['4'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Spring Constant (K) --}}
                    @if ($selection == '1' || $selection == '3')
                        <div class="col-span-1 lg:col-span-1">
                            <label for="spring_constant" class="font-s-14 text-blue">{{ $lang['5'] }} (K)</label>
                            <div class="w-full py-2 relative">
                                <input type="text" inputmode="decimal" wire:model.live="spring_constant" id="spring_constant" class="input" placeholder="4" />
                                <span class="text-blue input_unit">N/m</span>
                            </div>
                        </div>
                    @endif

                    {{-- Spring Displacement (X) --}}
                    @if ($selection == '1' || $selection == '2')
                        <div class="col-span-1 lg:col-span-1">
                            <label for="spring_displacement" class="font-s-14 text-blue">{{ $lang['6'] }} (X)</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="text" inputmode="decimal" wire:model.live="spring_displacement" id="spring_displacement" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('spring_displacement_unit')">
                                    {{ $spring_displacement_unit }} ▾
                                </label>
                                @if ($openDropdown === 'spring_displacement_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['m', 'mm', 'cm', 'inches', 'feet', 'yards'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('spring_displacement_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Spring Force (F) --}}
                    @if ($selection == '2' || $selection == '3')
                        <div class="col-span-1 lg:col-span-1">
                            <label for="spring_force" class="font-s-14 text-blue">{{ $lang['7'] }} (F)</label>
                            <div class="w-full py-2 relative">
                                <input type="text" inputmode="decimal" wire:model.live="spring_force" id="spring_force" class="input" placeholder="4" />
                                <span class="text-blue input_unit">N</span>
                            </div>
                        </div>
                    @endif
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full text-[20px]">
                                @if (isset($detail['fahad1']))
                                    <div class="w-full text-center text-[20px]">
                                        <p>{{ $lang[8] }} (F)</p>
                                        <div class="flex justify-center">
                                            <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]"> {{ round($detail['fahad1'], 4) }} N</strong></p>
                                        </div>
                                    </div>
                                @elseif(isset($detail['fahad2']))
                                    <div class="w-full text-center text-[20px]">
                                        <p>{{ $lang[5] }} (K)</p>
                                        <div class="flex justify-center">
                                            <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]"> {{ round($detail['fahad2'], 4) }} N/m</strong></p>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-full text-center text-[20px]">
                                        <p>{{ $lang[9] }} (X)</p>
                                        <div class="flex justify-center">
                                            <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]"> {{ round($detail['an'], 4) }} M</strong></p>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-center"><strong>{{ $lang[10] }}</strong></p>
                                    <div class="md:w-[100%] lg:w-[100%] w-full">
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b" width="70%">{{ $lang[11] }}</td>
                                                <td class="py-2 border-b"><strong>{{ round($detail['ans'], 4) }} ({{ $lang[11] }})</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%">{{ $lang[12] }}</td>
                                                <td class="py-2 border-b"><strong>{{ round($detail['ans1'], 4) }} ({{ $lang[12] }})</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%">{{ $lang[13] }}</td>
                                                <td class="py-2 border-b"><strong>{{ round($detail['ans2'], 4) }} ({{ $lang[13] }})</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%">{{ $lang[14] }}</td>
                                                <td class="py-2 border-b"><strong>{{ round($detail['ans3'], 4) }} ({{ $lang[14] }})</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%">{{ $lang[15] }}</td>
                                                <td class="py-2 border-b"><strong>{{ round($detail['ans4'], 4) }} ({{ $lang[15] }})</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
