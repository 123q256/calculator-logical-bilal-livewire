<div>
 <form wire:submit.prevent="calculate">
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
                
                <div class="col-span-6 pe-lg-3">
                    <label for="type" class="label one_text">{{$lang['22'] ?? 'Calculation Method'}}:</label>
                    <div class="w-100 py-2">
                        <select wire:model.live="calc_type" id="type" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full">
                            <option value="1">{{ $lang['1'] ?? 'By wall dimensions' }}</option>
                            <option value="2">{{ $lang['2'] ?? 'By room dimensions' }}</option>
                        </select>
                    </div>
                </div>

                @if($calc_type == '2')
                <div class="col-span-6 pe-lg-3 rooms">
                    <label for="room_length" class="label  one_text">{{$lang['3'] ?? 'Room Length'}}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" wire:model.live="room_length" id="room_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                        <label for="room_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('room_length_unit')">{{ $room_length_unit }} ▾</label>
                        @if($showDropdown === 'room_length_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_length_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_length_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_length_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_length_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_length_unit', 'yd')">yd</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-span-6 pe-lg-3 rooms">
                    <label for="room_width" class="label one_text">{{$lang['4'] ?? 'Room Width'}}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" wire:model.live="room_width" id="room_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                        <label for="room_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('room_width_unit')">{{ $room_width_unit }} ▾</label>
                        @if($showDropdown === 'room_width_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_width_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_width_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_width_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_width_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_width_unit', 'yd')">yd</p>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-span-6 pe-lg-3 rooms">
                    <label for="room_height" class="label one_text">{{$lang['5'] ?? 'Room Height'}}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" wire:model.live="room_height" id="room_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                        <label for="room_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('room_height_unit')">{{ $room_height_unit }} ▾</label>
                        @if($showDropdown === 'room_height_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_height_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_height_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_height_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_height_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('room_height_unit', 'yd')">yd</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                @if($calc_type == '1')
                <div class="col-span-6  walls">
                    <label for="wall_width" class="label one_text">{{$lang['6'] ?? 'Wall Width'}}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" wire:model.live="wall_width" id="wall_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                        <label for="wall_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('wall_width_unit')">{{ $wall_width_unit }} ▾</label>
                        @if($showDropdown === 'wall_width_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_width_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_width_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_width_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_width_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_width_unit', 'yd')">yd</p>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-span-6 pe-lg-3 walls">
                    <label for="wall_height" class="label one_text">{{$lang['7'] ?? 'Wall Height'}}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" wire:model.live="wall_height" id="wall_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                        <label for="wall_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('wall_height_unit')">{{ $wall_height_unit }} ▾</label>
                        @if($showDropdown === 'wall_height_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_height_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_height_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_height_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_height_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('wall_height_unit', 'yd')">yd</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                <p class="col-span-12">{{$lang['8'] ?? 'Doors Info'}}</p>

                <div class="col-span-6 pe-lg-3">
                  <label for="door_height" class="label one_text">{{$lang['9'] ?? 'Door Height'}}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" wire:model.live="door_height" id="door_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                        <label for="door_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('door_height_unit')">{{ $door_height_unit }} ▾</label>
                        @if($showDropdown === 'door_height_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('door_height_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('door_height_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('door_height_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('door_height_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('door_height_unit', 'yd')">yd</p>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-span-6 pe-lg-3">
                    <label for="door_width" class="label one_text">{{$lang['10'] ?? 'Door Width'}}:</label>
                      <div class="relative w-full mt-3">
                          <input type="number" wire:model.live="door_width" id="door_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                          <label for="door_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('door_width_unit')">{{ $door_width_unit }} ▾</label>
                          @if($showDropdown === 'door_width_unit')
                          <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('door_width_unit', 'cm')">cm</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('door_width_unit', 'm')">m</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('door_width_unit', 'in')">in</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('door_width_unit', 'ft')">ft</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('door_width_unit', 'yd')">yd</p>
                          </div>
                          @endif
                      </div>
                  </div>
                <div class="col-span-6 pe-lg-3">
                    <label for="no_of_doors" class="label one_text">{{$lang['11'] ?? 'Number of doors'}}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" wire:model.live="no_of_doors" id="no_of_doors" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                    </div>
                </div>

                <p class="col-span-12">{{$lang['12'] ?? 'Windows Info'}}</p>
                <div class="col-span-6 pe-lg-3">
                    <label for="window_height" class="label one_text">{{$lang['13'] ?? 'Window Height'}}:</label>
                      <div class="relative w-full mt-3">
                          <input type="number" wire:model.live="window_height" id="window_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                          <label for="window_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('window_height_unit')">{{ $window_height_unit }} ▾</label>
                          @if($showDropdown === 'window_height_unit')
                          <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('window_height_unit', 'cm')">cm</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('window_height_unit', 'm')">m</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('window_height_unit', 'in')">in</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('window_height_unit', 'ft')">ft</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('window_height_unit', 'yd')">yd</p>
                          </div>
                          @endif
                      </div>
                  </div>

                  <div class="col-span-6 pe-lg-3">
                    <label for="window_width" class="label one_text">{{$lang['13'] ?? 'Window Width'}}:</label>
                      <div class="relative w-full mt-3">
                          <input type="number" wire:model.live="window_width" id="window_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                          <label for="window_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('window_width_unit')">{{ $window_width_unit }} ▾</label>
                          @if($showDropdown === 'window_width_unit')
                          <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('window_width_unit', 'cm')">cm</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('window_width_unit', 'm')">m</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('window_width_unit', 'in')">in</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('window_width_unit', 'ft')">ft</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('window_width_unit', 'yd')">yd</p>
                          </div>
                          @endif
                      </div>
                  </div>
                <div class="col-span-6 pe-lg-3">
                    <label for="no_of_windows" class="label one_text">{{$lang['15'] ?? 'Number of windows'}}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="no_of_windows" id="no_of_windows" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                    </div>
                </div>
                <p class="col-span-12">{{$lang['16'] ?? 'Roll Info'}}</p>

                <div class="col-span-6 pe-lg-3">
                    <label for="roll_length" class="label one_text">{{$lang['17'] ?? 'Roll Length'}}:</label>
                      <div class="relative w-full mt-3">
                          <input type="number" wire:model.live="roll_length" id="roll_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                          <label for="roll_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('roll_length_unit')">{{ $roll_length_unit }} ▾</label>
                          @if($showDropdown === 'roll_length_unit')
                          <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('roll_length_unit', 'cm')">cm</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('roll_length_unit', 'm')">m</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('roll_length_unit', 'in')">in</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('roll_length_unit', 'ft')">ft</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('roll_length_unit', 'yd')">yd</p>
                          </div>
                          @endif
                      </div>
                  </div>
                  <div class="col-span-6 pe-lg-3">
                    <label for="roll_width" class="label one_text">{{$lang['17'] ?? 'Roll Width'}}:</label>
                      <div class="relative w-full mt-3">
                          <input type="number" wire:model.live="roll_width" id="roll_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                          <label for="roll_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('roll_width_unit')">{{ $roll_width_unit }} ▾</label>
                          @if($showDropdown === 'roll_width_unit')
                          <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('roll_width_unit', 'cm')">cm</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('roll_width_unit', 'm')">m</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('roll_width_unit', 'in')">in</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('roll_width_unit', 'ft')">ft</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('roll_width_unit', 'yd')">yd</p>
                          </div>
                          @endif
                      </div>
                  </div>
                <div class="col-span-6 pe-lg-3">
                    <label for="cost" class="label one_text"><?=$lang['19'] ?? 'Cost' ?> (<?=$lang['20'] ?? 'per roll'?>):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="cost" id="cost" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                        <span class="input-unit text-blue">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-6 pe-lg-3">
                    <label for="pattern" class="label one_text">{{$lang['21'] ?? 'Pattern Repeat'}}:</label>
                      <div class="relative w-full mt-3">
                          <input type="number" wire:model.live="pattern" id="pattern" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                          <label for="pattern_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('pattern_unit')">{{ $pattern_unit }} ▾</label>
                          @if($showDropdown === 'pattern_unit')
                          <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pattern_unit', 'cm')">cm</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pattern_unit', 'm')">m</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pattern_unit', 'in')">in</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pattern_unit', 'ft')">ft</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pattern_unit', 'yd')">yd</p>
                          </div>
                          @endif
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full my-1">
                        <div class="lg:w-[80%] md:w-[90%] w-full overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td width="60%" class="border-b py-2"><strong>Wall surface area :</strong></td>
                                    <td class="border-b py-2"><?=round($detail['area'] ?? 0, 3)?><span class="font-s-14"> (m<sup>2</sup>)</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>Total doors area :</strong></td>
                                    <td class="border-b py-2"><?=$detail['door_area'] ?? 0?><span class="font-s-14"> (m<sup>2</sup>)</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>Total windows area :</strong></td>
                                    <td class="border-b py-2"><?=round($detail['window_area'] ?? 0, 3)?><span class="font-s-14"> (m<sup>2</sup>)</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>Adjusted height :</strong></td>
                                    <td class="border-b py-2"><?=round($detail['adjusted_height'] ?? 0, 3)?> <span class="font-s-14"> m</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>Adjusted wall area :</strong></td>
                                    <td class="border-b py-2"><?=round($detail['adjusted_wall_area'] ?? 0, 3)?><span class="font-s-14"> (m<sup>2</sup>)</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>Number of rolls :</strong></td>
                                    <td class="border-b py-2"><?=intval($detail['number_of_rolls'] ?? 0)?></td>
                                </tr>
                                @if(!empty($detail['costs']))
                                    <tr>
                                        <td class="border-b py-2"><strong>Total cost :</strong></td>
                                        <td class="border-b py-2">{{$currancy}} <?=intval($detail['costs'] ?? 0)?></td>
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
