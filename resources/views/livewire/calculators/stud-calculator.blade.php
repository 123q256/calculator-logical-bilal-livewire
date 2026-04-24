<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-2">
                    
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-270 px-3">
                        <label for="want" class="font-s-14 text-blue">{{ $lang['1'] ?? 'I want to calculate' }}:</label>
                        <div class="w-100 py-2"> 
                            <select wire:model.live="want" id="want" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full">
                                <option value="stud">{!! $lang['2'] ?? 'Studs' !!}</option>
                                <option value="sheet">{!! $lang['3'] ?? 'Sheets' !!}</option>
                                <option value="board">{!! $lang['4'] ?? 'Board Feet' !!}</option>
                                <option value="all">{!! $lang['5'] ?? 'All' !!}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 wall_end_stud">
                        <label for="wall_end_stud" class="font-s-14 text-blue first_text">{{ $lang['6'] ?? 'Wall End Studs' }}:</label>
                        <div class="w-100 py-2"> 
                            <select wire:model.live="wall_end_stud" id="wall_end_stud" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full">
                                <option value="0">{{ $lang['7'] ?? '0' }}</option>
                                <option value="2">{{ $lang['8'] ?? '2' }}</option>
                                <option value="4">{{ $lang['9'] ?? '4' }}</option>
                                <option value="6">{{ $lang['10'] ?? '6' }}</option>
                            </select>
                        </div>
                    </div>

                    @if($want == 'sheet' || $want == 'all')
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 wall_on">
                        <label for="wall_on" class="font-s-14 text-blue second_text"><?=$lang[11] ?? 'Wall is built on'?>:</label>
                        <div class="w-100 py-2"> 
                            <select wire:model.live="wall_on" id="wall_on" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full">
                                <option value="subfloor">{{ $lang['12'] ?? 'Subfloor' }}</option>
                                <option value="slab">{{ $lang['13'] ?? 'Slab' }}</option>
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 wall-height">
                        <label for="hight" class="font-s-14 text-blue hight_text"><?=$lang[14] ?? 'Wall Height'?>:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="hight" id="hight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                            <label for="hight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('hight_unit')">{{ $hight_unit }} ▾</label>
                            @if($showDropdown === 'hight_unit')
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach (["cm","in","ft"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('hight_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                            </div>
                            @endif
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 wall-length ">
                        <label for="length" class="font-s-14 text-blue four_text"><?=$lang[15] ?? 'Wall Length'?>:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                            <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('length_unit')">{{ $length_unit }} ▾</label>
                            @if($showDropdown === 'length_unit')
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                            </div>
                            @endif
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 stud-spacing">
                        <label for="stud_spacing" class="font-s-14 text-blue">{{ $lang['16'] ?? 'Stud Spacing' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="stud_spacing" id="stud_spacing" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                            <label for="stud_spacing_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('stud_spacing_unit')">{{ $stud_spacing_unit }} ▾</label>
                            @if($showDropdown === 'stud_spacing_unit')
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('stud_spacing_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                            </div>
                            @endif
                        </div>
                     </div>

                     @if($want == 'sheet' || $want == 'all')
                     <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 rim-joist ">
                        <label for="rim_joist_width" class="font-s-14 text-blue">{{ $lang['17'] ?? 'Rim Joist Width' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="rim_joist_width" id="rim_joist_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                            <label for="rim_joist_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('rim_joist_width_unit')">{{ $rim_joist_width_unit }} ▾</label>
                            @if($showDropdown === 'rim_joist_width_unit')
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('rim_joist_width_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                            </div>
                            @endif
                        </div>
                     </div>
                     <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 subfloor ">
                        <label for="subfloor_thickness" class="font-s-14 text-blue">{{ $lang['18'] ?? 'Subfloor Thickness' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="subfloor_thickness" id="subfloor_thickness" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                            <label for="subfloor_thickness_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('subfloor_thickness_unit')">{{ $subfloor_thickness_unit }} ▾</label>
                            @if($showDropdown === 'subfloor_thickness_unit')
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('subfloor_thickness_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                            </div>
                            @endif
                        </div>
                     </div>
                     @endif

                     @if($want == 'board' || $want == 'all')
                     <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3 stud-width ">
                        <label for="stud_width" class="font-s-14 text-blue">{{ $lang['19'] ?? 'Stud Width' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="stud_width" id="stud_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                            <label for="stud_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('stud_width_unit')">{{ $stud_width_unit }} ▾</label>
                            @if($showDropdown === 'stud_width_unit')
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('stud_width_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                            </div>
                            @endif
                        </div>
                     </div>
                     @endif
                  
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3  ">
                        <label for="stud_price" class="font-s-14 text-blue">{{ $lang['20'] ?? 'Price' }}:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" wire:model.live="stud_price" id="stud_price" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                            <span class="text-blue input_unit">{{$currancy}}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-0 mt-lg-2 px-3  ">
                        <label for="estimated_waste" class="font-s-14 text-blue">{{ $lang['21'] ?? 'Estimated Waste' }}:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" wire:model.live="estimated_waste" id="estimated_waste" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                            <span class="text-blue input_unit">%</span>
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
                    <div class="w-full my-2">
                        <div class="w-full md:w-[70%] lg:w-[80%] overflow-x-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[22] ?? 'Total Studs'?> :</strong></td>
                                    <td class="border-b py-2"><?= $detail['studs'] ?? 0;?> <span class="font-s-16"><?=$lang[23] ?? 'studs'?></span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[35] ?? 'Total Cost'?> :</strong></td>
                                    <td class="border-b py-2"><?= $currancy.' '.($detail['total_cost'] ?? 0);?> </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[24] ?? 'Finished Length of Studs'?> :</strong></td>
                                    <td class="border-b py-2"><?= $detail['finished_length_of_studs'] ?? 0;?> <span class="font-s-16"><?=$lang[25] ?? 'ft'?></span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[26] ?? 'Wall Area'?> :</strong></td>
                                    <td class="border-b py-2"><?= $detail['wall_area_ft'] ?? 0;?> <span class="font-s-16"><?=$lang[27] ?? 'sq ft'?></span></td>
                                </tr>
                                @if($want == 'sheet' || $want == 'all')
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[28] ?? 'Sheets Required'?> :</strong></td>
                                        <td class="border-b py-2"><?= $detail['sheets_req'] ?? 0;?> <span class="font-s-16"><?=$lang[19] ?? 'sheets'?></span></td>
                                    </tr>
                                @endif
                                @if($want == 'board' || $want == 'all')
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[30] ?? 'Board Footage'?> :</strong></td>
                                        <td class="border-b py-2"><?= $detail['board_footage'] ?? 0;?> <span class="font-s-16"><?=$lang[31] ?? 'bf'?></span></td>
                                    </tr>
                                @endif
                            </table>
                            <table class="w-full">
                                <tr>
                                    <td colspan="3" class="pb-2 pt-3"><strong><?=$lang[32] ?? 'Lumber needed (assuming 16" spacing)'?></strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=($detail['lumber8'] ?? 0) * 2 ?></strong> <span class="font-s-16"> 8' <?=$lang[33] ?? 'lumber'?></span></td>
                                    <td class="border-b py-2"><strong><?=($detail['lumber10'] ?? 0) * 2 ?></strong> <span class="font-s-16"> 10' <?=$lang[33] ?? 'lumber'?></span></td>
                                    <td class="border-b py-2"><strong><?=($detail['lumber12'] ?? 0) * 2 ?></strong> <span class="font-s-16"> 12' <?=$lang[33] ?? 'lumber'?></span></td>
                                </tr> 
                                <tr>
                                    <td colspan="3" class="pb-2 pt-3"><strong><?=$lang[34] ?? 'Lumber needed (assuming 24" spacing)'?></strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$detail['lumber8'] ?? 0?></strong> <span class="font-s-16"> 8' <?=$lang[33] ?? 'lumber'?></span></td>
                                    <td class="border-b py-2"><strong><?=$detail['lumber10'] ?? 0?></strong> <span class="font-s-16"> 10' <?=$lang[33] ?? 'lumber'?></span></td>
                                    <td class="border-b py-2"><strong><?=$detail['lumber12'] ?? 0?></strong> <span class="font-s-16"> 12' <?=$lang[33] ?? 'lumber'?></span></td>
                                </tr>
                                
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
