<div>
    <form wire:submit.prevent="calculate">
   
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 mb-3">
                @if (isset($error))
                    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
                @endif
                
                <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                    <div class="grid grid-cols-12 gap-2">
                        <div class="col-span-12 flex justify-center">
                            <img src="{{ asset('images/room_size.png') }}" alt="Room Size" class="w-full md:w-[50%] lg:w-[50%] h-auto">
                        </div>
                        
                        <div class="col-span-12">
                            <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                                    <div class="lg:w-1/2 w-full px-2 py-1">
                                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $name == 'feet' ? 'tagsUnit' : '' }}" wire:click="setTab('feet')">
                                            {{ $lang['2'] ?? 'Feet / Inches' }}
                                        </div>
                                    </div>
                                    <div class="lg:w-1/2 w-full px-2 py-1">
                                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $name == 'meter' ? 'tagsUnit' : '' }}" wire:click="setTab('meter')">
                                            {{ $lang['1'] ?? 'Meters' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="col-span-12 font-semibold mt-4">{{ $lang['3'] ?? 'Enter the dimensions of each area' }}</p>

                        @foreach($rooms as $index => $room)
                            <div class="col-span-12 border-b border-gray-200 pb-4 mb-4">
                                <div class="flex justify-between items-center">
                                    <p class="font-bold text-blue-600">Area {{ $index + 1 }}</p>
                                    @if(count($rooms) > 1)
                                        <button type="button" wire:click="removeRoom({{ $index }})" class="text-red-500 hover:text-red-700">
                                            <img src="{{ asset('images/close.png') }}" alt="Remove" class="w-4 h-4 inline-block">
                                            <span class="text-xs ml-1">{{ $lang['remove'] ?? 'Remove' }}</span>
                                        </button>
                                    @endif
                                </div>

                                @if($name == 'feet')
                                    <div class="grid grid-cols-12 mt-3 gap-2">
                                        <div class="col-span-5 md:col-span-2">
                                            <label class="label text-xs">{{ $lang['4'] ?? 'Length' }} (ft):</label>
                                            <input type="number" step="any" wire:model.live="rooms.{{ $index }}.lenght_f" class="input p-2 border border-gray-300 rounded w-full" placeholder="ft" />
                                        </div>
                                        <div class="col-span-5 md:col-span-2">
                                            <label class="label text-xs">{{ $lang['4'] ?? 'Length' }} (in):</label>
                                            <input type="number" step="any" wire:model.live="rooms.{{ $index }}.lenght_in" class="input p-2 border border-gray-300 rounded w-full" placeholder="in" />
                                        </div>
                                        <div class="pt-[30px] col-span-1 text-center font-bold">x</div>
                                        <div class="col-span-5 md:col-span-2">
                                            <label class="label text-xs">{{ $lang['5'] ?? 'Width' }} (ft):</label>
                                            <input type="number" step="any" wire:model.live="rooms.{{ $index }}.width_f" class="input p-2 border border-gray-300 rounded w-full" placeholder="ft" />
                                        </div>
                                        <div class="col-span-5 md:col-span-2">
                                            <label class="label text-xs">{{ $lang['5'] ?? 'Width' }} (in):</label>
                                            <input type="number" step="any" wire:model.live="rooms.{{ $index }}.width_in" class="input p-2 border border-gray-300 rounded w-full" placeholder="in" />
                                        </div>
                                    </div>
                                @else
                                    <div class="grid grid-cols-12 mt-3 gap-2">
                                        <div class="col-span-5 md:col-span-5">
                                            <label class="label text-xs">{{ $lang['4'] ?? 'Length' }} (m):</label>
                                            <input type="number" step="any" wire:model.live="rooms.{{ $index }}.lenght_m" class="input p-2 border border-gray-300 rounded w-full" placeholder="m" />
                                        </div>
                                        <div class="pt-[30px] col-span-1 text-center font-bold">x</div>
                                        <div class="col-span-5 md:col-span-5">
                                            <label class="label text-xs">{{ $lang['5'] ?? 'Width' }} (m):</label>
                                            <input type="number" step="any" wire:model.live="rooms.{{ $index }}.width_m" class="input p-2 border border-gray-300 rounded w-full" placeholder="m" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        @if(count($rooms) < 5)
                            <div class="col-span-12 mt-2">
                                <button type="button" wire:click="addRoom" class="text-blue-600 font-bold hover:underline">
                                    <span class="text-xl">+</span> {{ $lang['7'] ?? 'Add Another Area' }}
                                </button>
                            </div>
                        @endif

                        <div class="col-span-12 md:col-span-4 mt-4">
                            <label for="perce" class="label">{{ $lang['6'] ?? 'Wastage' }}:</label>
                            <select wire:model.live="perce" id="perce" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full mt-2">
                                <option value="0">0 %</option>
                                <option value="5">5 %</option>
                                <option value="10">10 %</option>
                                <option value="15">15 %</option>
                            </select>
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
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg w-full items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full md:w-[80%] lg:w-[80%] text-[18px] overflow-auto">
                                    <table class="w-full">
                                        @if ($name == 'feet')
                                            <tr>
                                                <td class="border-b py-3"><strong>{{ $lang['8'] ?? 'Total Area' }}</strong></td>
                                                <td class="border-b py-3 font-bold text-blue-600">{{ round($detail['f_r_s'], 3) }} ft²</td>
                                            </tr>
                                            @if ($perce != 0)
                                                <tr>
                                                    <td class="border-b py-3"><strong>{{ $lang['8'] ?? 'Total Area' }} with {{ $perce }}% {{ $lang['10'] ?? 'Waste' }}</strong></td>
                                                    <td class="border-b py-3 font-bold text-red-600">{{ round($detail['perc'], 3) }} ft²</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="border-b py-3 text-gray-600 text-sm italic">{{ $lang['8'] ?? 'Total area' }} (Square Inch)</td>
                                                <td class="border-b py-3 text-sm italic">{{ round($detail['f_r_s'] * 144, 3) }} in²</td>
                                            </tr>
                                            @if ($perce != 0)
                                                <tr>
                                                    <td class="border-b py-3 text-gray-600 text-sm italic">Total area waste (Square Inch)</td>
                                                    <td class="border-b py-3 text-sm italic">{{ round($detail['perc'] * 144, 3) }} in²</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="border-b py-3 text-gray-600 text-sm italic">{{ $lang['8'] ?? 'Total area' }} (Square Meter)</td>
                                                <td class="border-b py-3 text-sm italic">{{ round($detail['f_r_s'] / 10.764, 3) }} m²</td>
                                            </tr>
                                            @if ($perce != 0)
                                                <tr>
                                                    <td class="border-b py-3 text-gray-600 text-sm italic">Total area waste (Square Meter)</td>
                                                    <td class="border-b py-3 text-sm italic">{{ round($detail['perc'] / 10.764, 3) }} m²</td>
                                                </tr>
                                            @endif
                                        @else
                                            <tr>
                                                <td class="border-b py-3"><strong>{{ $lang['8'] ?? 'Total Area' }}</strong></td>
                                                <td class="border-b py-3 font-bold text-blue-600">{{ round($detail['m_r_s'], 3) }} m²</td>
                                            </tr>
                                            @if ($perce != 0)
                                                <tr>
                                                    <td class="border-b py-3"><strong>{{ $lang['8'] ?? 'Total Area' }} with {{ $perce }}% {{ $lang['10'] ?? 'Waste' }}</strong></td>
                                                    <td class="border-b py-3 font-bold text-red-600">{{ round($detail['perc'], 3) }} m²</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="border-b py-3 text-gray-600 text-sm italic">{{ $lang['8'] ?? 'Total area' }} (Square Feet)</td>
                                                <td class="border-b py-3 text-sm italic">{{ round($detail['m_r_s'] * 10.764, 3) }} ft²</td>
                                            </tr>
                                            @if ($perce != 0)
                                                <tr>
                                                    <td class="border-b py-3 text-gray-600 text-sm italic">Total area waste (Square Feet)</td>
                                                    <td class="border-b py-3 text-sm italic">{{ round($detail['perc'] * 10.764, 3) }} ft²</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="border-b py-3 text-gray-600 text-sm italic">{{ $lang['8'] ?? 'Total area' }} (Square Inches)</td>
                                                <td class="border-b py-3 text-sm italic">{{ round($detail['m_r_s'] * 1550, 3) }} in²</td>
                                            </tr>
                                            @if ($perce != 0)
                                                <tr>
                                                    <td class="border-b py-3 text-gray-600 text-sm italic">Total area waste (Square Inches)</td>
                                                    <td class="border-b py-3 text-sm italic">{{ round($detail['perc'] * 1550, 3) }} in²</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
