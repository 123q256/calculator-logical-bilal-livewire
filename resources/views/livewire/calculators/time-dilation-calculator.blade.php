<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3 gap-4">
                {{-- Time Interval --}}
                @php
                    $isSplit = in_array($interval_unit, ['mins/sec', 'hrs/mins', 'yrs/mos', 'wks/days']);
                @endphp

                @if(!$isSplit)
                <div class="col-span-12">
                    <label for="interval" class="font-s-14 text-blue">{{ $lang['1'] }} (Δt):</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model="interval" id="interval" class="input" placeholder="00" />
                    </div>
                </div>
                @else
                <div class="col-span-12">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6">
                            <label for="interval_one" class="font-s-14 text-blue">
                                {{ explode('/', $interval_unit)[0] }} (Δt):
                            </label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model="interval_one" id="interval_one" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="interval_sec" class="font-s-14 text-blue">
                                {{ explode('/', $interval_unit)[1] }}:
                            </label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model="interval_sec" id="interval_sec" class="input" placeholder="00" />
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Interval Unit Selection --}}
                <div class="col-span-12">
                    <label for="interval_unit" class="font-s-14 text-blue">Unit:</label>
                    <div class="w-full py-2">
                        <select wire:model.live="interval_unit" id="interval_unit" class="input">
                            @foreach(["sec", "mins", "hrs", "days", "wks", "mos", "yrs", "mins/sec", "hrs/mins", "yrs/mos", "wks/days"] as $u)
                                <option value="{{ $u }}">{{ $u }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Velocity --}}
                <div class="col-span-12">
                    <label for="velocity" class="font-s-14 text-blue">{{ $lang[2] }} (v):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="velocity" id="velocity" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('velocity_unit')">{{ $velocity_unit }} ▾</label>
                        @if($dropdowns['velocity_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['km/s', 'm/s', 'mi/s', 'c'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('velocity_unit', '{{ $unit }}', 'velocity_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full  p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg ">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full lg:w-[80%] md:w-[80%] overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[3] }} (Δt')</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'], 4) }} {{ $lang[5] }}</strong></td>
                                </tr>                        
                            </table>
                        </div>

                        <p class="w-full mt-6 text-center text-[20px]"><strong>{{ $lang[3] }} (Δt') {{ $lang[4] }}</strong></p>
                        
                        <div class="w-full lg:w-[80%] md:w-[80%] overflow-auto mt-3">
                            <table class="w-full ">
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[6] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 60, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[7] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 3600, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[8] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 86400, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[9] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 604800, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[10] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 2629800, 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[11] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 31557600, 4) }}</strong></td>
                                </tr>
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
