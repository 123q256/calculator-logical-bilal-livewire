<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3 gap-4">
                <div class="col-span-12 lg:col-span-6">
                    <div class="grid grid-cols-12 gap-4">
                        {{-- Surface Type --}}
                        <div class="col-span-12">
                            <label for="surface" class="font-s-14 ">{{ $lang['1'] }}:</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="surface" id="surface" class="input">
                                    <option value="inclined">Inclined</option>
                                    <option value="horizontal">Horizontal</option>
                                </select>
                            </div>
                        </div>

                        {{-- External Force Selection (only for horizontal) --}}
                        @if($surface === 'horizontal')
                        <div class="col-span-12">
                            <label for="external" class="font-s-14 ">{{ $lang['2'] }}:</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="external" id="external" class="input">
                                    <option value="no">No</option>
                                    <option value="downward">Downward</option>
                                    <option value="upward">Upward</option>
                                </select>
                            </div>
                        </div>
                        @endif

                        {{-- Mass --}}
                        <div class="col-span-12">
                            <label for="mass" class="font-s-14 ">{{ $lang[3] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="mass" id="mass" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                                <label for="mass_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('mass_units')">{{ $mass_units }} ▾</label>
                                @if($dropdowns['mass_units'] ?? false)
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                    @foreach(['µg', 'mg', 'g', 'dag', 'kg', 't', 'gr', 'dr', 'oz', 'lb'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('mass_units', '{{ $unit }}', 'mass_units')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                                @endif
                             </div>
                        </div>

                        {{-- Outside Force (for horizontal downward/upward) --}}
                        @if($surface === 'horizontal' && $external !== 'no')
                        <div class="col-span-12">
                            <label for="outside_force" class="font-s-14 ">{{ $lang[4] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="outside_force" id="outside_force" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                                <label for="outside_force_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('outside_force_units')">{{ $outside_force_units }} ▾</label>
                                @if($dropdowns['outside_force_units'] ?? false)
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach(['N', 'KN', 'MN', 'GN', 'TN'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('outside_force_units', '{{ $unit }}', 'outside_force_units')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                                @endif
                             </div>
                        </div>
                        @endif

                        {{-- Angle (for inclined OR horizontal with external force) --}}
                        @if($surface === 'inclined' || ($surface === 'horizontal' && $external !== 'no'))
                        <div class="col-span-12">
                            <label for="angle" class="font-s-14 ">
                                {{ $surface === 'inclined' ? 'Angle' : 'Angle of the outside force' }}:
                            </label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="angle" id="angle" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                                <label for="angle_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('angle_units')">{{ $angle_units }} ▾</label>
                                @if($dropdowns['angle_units'] ?? false)
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach(['deg', 'ran', 'gon', 'tr'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('angle_units', '{{ $unit }}', 'angle_units')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                                @endif
                             </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Visualization --}}
                <div class="col-span-12 lg:col-span-6 flex items-center justify-center pt-2">
                    @if($surface === 'inclined')
                        <img src="{{ url('images/inclined.png') }}" alt="inclined" class="max-w-full h-auto" style="max-height: 200px">
                    @elseif($surface === 'horizontal')
                        @if($external === 'no')
                            <img src="{{ url('images/horizontal_no.png') }}" alt="horizontal_no" class="max-w-full h-auto" style="max-height: 200px">
                        @elseif($external === 'upward')
                            <img src="{{ url('images/horizontal_upward.png') }}" alt="horizontal_upward" class="max-w-full h-auto" style="max-height: 200px">
                        @elseif($external === 'downward')
                            <img src="{{ url('images/horizontal_downward.png') }}" alt="horizontal_downward" class="max-w-full h-auto" style="max-height: 200px">
                        @endif
                    @endif
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
    @if(isset($detail))
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{ $lang['6'] }}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] px-4 py-2 rounded-lg inline-block my-3">
                                    <strong class="text-white">{{ number_format($detail['normal_force'], 2) }} N</strong>
                                </p>
                            </div>
                        </div>

                        <p class="w-full my-3 text-[18px] text-center">{{ $lang[7] }}</p>
                        
                        <div class="w-full overflow-auto mt-4">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-[#F6FAFC]">
                                        <th class="p-3 border text-center font-bold">KN</th>
                                        <th class="p-3 border text-center font-bold">MN</th>
                                        <th class="p-3 border text-center font-bold">GN</th>
                                        <th class="p-3 border text-center font-bold">TN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white">
                                        <td class="text-center p-3 border font-semibold text-blue">{{ number_format($detail['normal_force'] * 0.001, 4) }}</td>
                                        <td class="text-center p-3 border font-semibold text-blue">{{ number_format($detail['normal_force'] * 0.000001, 6) }}</td>
                                        <td class="text-center p-3 border font-semibold text-blue">{{ number_format($detail['normal_force'] * 0.000000001, 9) }}</td>
                                        <td class="text-center p-3 border font-semibold text-blue">{{ number_format($detail['normal_force'] * 0.000000000001, 12) }}</td>
                                    </tr>
                                </tbody>
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
