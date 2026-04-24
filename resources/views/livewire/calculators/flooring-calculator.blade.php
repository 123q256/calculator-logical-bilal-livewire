<div>
 <form wire:submit.prevent="calculate">
 
        
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
                
                @foreach($rooms as $index => $room)
                    <div class="col-span-12 flex items-center justify-between mt-2">
                        <h3 class="font-bold text-lg">Room {{ $index + 1 }}</h3>
                        @if(count($rooms) > 1)
                            <button type="button" wire:click="removeRoom({{ $index }})" class="text-red-500 hover:text-red-700 font-bold">Remove</button>
                        @endif
                    </div>

                    <div class="col-span-6">
                        <label for="room_length_{{ $index }}" class="font-s-14 text-blue one_text">{{$lang['1'] ?? 'Length'}}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="rooms.{{ $index }}.length" id="room_length_{{ $index }}" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                            <label for="room_length_unit_{{ $index }}" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('room_length_unit_{{ $index }}')">{{ $room['length_unit'] }} ▾</label>
                            @if($showDropdown === 'room_length_unit_'.$index)
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setRoomUnit({{ $index }}, 'length_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setRoomUnit({{ $index }}, 'length_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setRoomUnit({{ $index }}, 'length_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setRoomUnit({{ $index }}, 'length_unit', 'ft')">ft</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-6">
                        <label for="room_width_{{ $index }}" class="font-s-14 text-blue one_text">{{$lang['2'] ?? 'Width'}}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="rooms.{{ $index }}.width" id="room_width_{{ $index }}" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                            <label for="room_width_unit_{{ $index }}" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('room_width_unit_{{ $index }}')">{{ $room['width_unit'] }} ▾</label>
                            @if($showDropdown === 'room_width_unit_'.$index)
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setRoomUnit({{ $index }}, 'width_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setRoomUnit({{ $index }}, 'width_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setRoomUnit({{ $index }}, 'width_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setRoomUnit({{ $index }}, 'width_unit', 'ft')">ft</p>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                   
                <div class="col-span-12 my-2">
                    <button type="button" title="Add More Fields" class="units_active p-2 bg-[#2845F5] text-white radius-5 cursor-pointer rounded" wire:click="addRoom">
                        <b><span>+</span> {{$lang['3'] ?? 'Add Room'}}</b>
                    </button>
                </div>
                
                <p class="col-span-12">{{$lang['4'] ?? 'Cost'}} (Optional):</p>
                <div class="col-span-6">
                    <label for="cost" class="font-s-14 text-blue one_text">{{$lang['5'] ?? 'Price'}}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="cost" id="cost" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                        <label for="cost_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('cost_unit_dropdown')">{{ $cost_unit }} ▾</label>
                        @if($showDropdown === 'cost_unit_dropdown')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('cost_unit', '{{$currancy}} m²')">{{$currancy}} m²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('cost_unit', '{{$currancy}} ft²')">{{$currancy}} ft²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('cost_unit', '{{$currancy}} yd²')">{{$currancy}} yd²</p>
                        </div>
                        @endif
                    </div>
                 </div>
                <div class="col-span-6">
                    <label for="waste_factor" class="font-s-14 text-blue one_text">{{$lang['6'] ?? 'Waste Factor'}} %:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="waste_factor" id="waste_factor" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                    </div>
                </div>
            </div>
        </div>
        
        @if ($type == 'calculator')
            @include('inc.button')
        @endif
        @if ($type=='widget')
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
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                            <div class="lg:w-[80%] md:w-[90%] w-full overflow-x-scroll">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['7'] ?? 'Area'}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['area'] ?? 0}} (m<sup>2</sup>)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['8'] ?? 'Total Material'}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['total_material'] ?? 0}} (m<sup>2</sup>)</td>
                                    </tr>
                                    @if(!empty($cost))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['9'] ?? 'Total Cost'}} :</strong></td>
                                            <td class="border-b py-2">{{$currancy.' '.($detail['price'] ?? 0)}}</td>
                                        </tr>
                                    @endif
                                </table>
                                <p class="mt-2 mb-1"><strong>{{$lang['10'] ?? 'Other Units'}}</strong></p>
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-1">{{$lang['7'] ?? 'Area'}} :</td>
                                        <td class="border-b">{{round(($detail['area'] ?? 0)*10.764,4)}} square feet (ft<sup>2</sup>)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-1">{{$lang['7'] ?? 'Area'}} :</td>
                                        <td class="border-b">{{round(($detail['area'] ?? 0)*1.196,4)}}  square yards (yd<sup>2</sup>)</td>
                                    </tr>
                                </table>
                            </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
</div>
