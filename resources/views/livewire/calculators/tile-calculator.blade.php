<div>
 <form wire:submit.prevent="calculate">
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
              
                <div class="col-span-6">
                    <label for="calculation_unit" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Calculation Unit' }}:</label>
                    <div class="w-100 py-2"> 
                        <select wire:model.live="calculation_unit" id="calculation_unit" class="input">
                            <option value="1">{{ $lang['2'] ?? 'Dimensions' }}</option>
                            <option value="2">{{ $lang['3'] ?? 'Total Area' }}</option>
                        </select>
                    </div>
                </div>
                
                @if ($calculation_unit === '2')
                 <div class="col-span-6 total_area">
                    <label for="total_area" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Total Area' }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="total_area" id="total_area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="total_area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('total_area_unit')">{{ $total_area_unit }} ▾</label>
                        @if($showDropdown === 'total_area_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach (["sq ft","sq m","sq yd","sq in","sq cm"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  wire:click="setUnit('total_area_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                 </div>
                 @endif

                 @if ($calculation_unit === '1')
                 <div class="col-span-6 area_length">
                    <label for="area_length" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Length' }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="area_length" id="area_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="area_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('area_length_unit')">{{ $area_length_unit }} ▾</label>
                        @if($showDropdown === 'area_length_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach (["cm","m","mm","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  wire:click="setUnit('area_length_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                 </div>
                 <div class="col-span-6 area_width">
                    <label for="area_width" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Width' }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="area_width" id="area_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="area_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('area_width_unit')">{{ $area_width_unit }} ▾</label>
                        @if($showDropdown === 'area_width_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach (["cm","m","mm","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  wire:click="setUnit('area_width_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                 </div>
                 @endif

                 <div class="col-span-6 tile_length ">
                    <label for="tile_length" class="font-s-14 text-blue">{{ $lang['7'] ?? 'Tile Length' }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="tile_length" id="tile_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="tile_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('tile_length_unit')">{{ $tile_length_unit }} ▾</label>
                        @if($showDropdown === 'tile_length_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach (["cm","m","mm","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  wire:click="setUnit('tile_length_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                 </div>
                 <div class="col-span-6 tile_width">
                    <label for="tile_width" class="font-s-14 text-blue">{{ $lang['8'] ?? 'Tile Width' }}:</label>
                    <div class="relative w-full  mt-[7px]">
                        <input type="number" wire:model.live="tile_width" id="tile_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="tile_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('tile_width_unit')">{{ $tile_width_unit }} ▾</label>
                        @if($showDropdown === 'tile_width_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach (["cm","m","mm","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  wire:click="setUnit('tile_width_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                 </div>
                 <div class="col-span-6 gap_size ">
                    <label for="gap_size" class="font-s-14 text-blue">{{ $lang['9'] ?? 'Gap Size' }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="gap_size" id="gap_size" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="gap_size_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('gap_size_unit')">{{ $gap_size_unit }} ▾</label>
                        @if($showDropdown === 'gap_size_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach (["cm","m","mm","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  wire:click="setUnit('gap_size_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                 </div>
                <div class="col-span-6 waste ">
                    <label for="waste" class="font-s-14 text-blue">{{ $lang['10'] ?? 'Waste' }} (%):</label>
                    <div class="w-full py-2 position-relative"> 
                        <input type="number" step="any" wire:model.live="waste" id="waste" class="input" aria-label="input" />
                    </div>
                </div>
                <p class="col-span-12"><strong>{{ $lang['11'] ?? 'Optional' }} ({{ $lang['12'] ?? 'Optional' }}):</strong></p>

                <div class="col-span-6 price ">
                    <label for="price" class="font-s-14 text-blue">{{ $lang['13'] ?? 'Price' }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('price_unit')">{{ $price_unit }} ▾</label>
                        @if($showDropdown === 'price_unit')
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{$currancy}} tile')">{{$currancy}} tile</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{$currancy}} box')">{{$currancy}} box</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{$currancy}} inch²')">{{$currancy}} inch²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{$currancy}} feet²')">{{$currancy}} feet²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{$currancy}} yard²')">{{$currancy}} yard²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{$currancy}} acre')">{{$currancy}} acre</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{$currancy}} meter²')">{{$currancy}} meter²</p>
                        </div>
                        @endif
                    </div>
                 </div>

                <div class="col-span-6 box_size">
                    <label for="box_size" class="font-s-14 text-blue">{{ $lang['14'] ?? 'Box Size' }}:</label>
                    <div class="w-full py-2 relative"> 
                        <input type="number" step="any" wire:model.live="box_size" id="box_size" class="input" aria-label="input" />
                        <span class="text-blue input_unit">Tiles Per Box</span>
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
                            <p class="text-[20px]"><strong>{{ $lang[15] ?? 'Result' }}</strong></p>
                            <div class="lg:w-[80%] md:w-[80%] w-ful text-[18px] overflow-x-auto">
                                <table class="w-full">
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{ $lang[16] ?? 'Tiles needed' }} :</td>
                                        <td class="border-b py-2">{{ $detail['formula'] }} <span>({{ $lang[17] ?? 'Tiles' }})</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang[20] ?? 'Total area' }} :</td>
                                        <td class="border-b py-2">{{ $detail['calculate_size'] ?? 0 }} <span> (ft²)</span></td>
                                    </tr>
                                    @if(!empty($detail['calculate_box_size']))
                                    <tr>
                                        <td class="border-b py-2">{{ $lang[18] ?? 'Boxes needed' }} :</td>
                                        <td class="border-b py-2">{{ $detail['calculate_box_size'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($detail['price_per_tile']))
                                    <tr>
                                        <td class="border-b py-2">{{ $lang[19] ?? 'Estimated Price' }} :</td>
                                        <td class="border-b py-2">{{ $currancy . ' ' . $detail['price_per_tile'] }}</td>
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
</div>
