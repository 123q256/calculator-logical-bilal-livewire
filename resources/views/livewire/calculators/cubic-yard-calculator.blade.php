<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-5">
                    <div class="space-y-2">
                        <div class="grid grid-cols-1   gap-6">
                            <div class="space-y-2 ">
                                <label for="operations" class="font-s-14 text-blue">{{ $lang[1] ?? 'Shape' }}:</label>
                                <div class="w-100  relative"> 
                                    <select wire:model.live="operations" id="operations" class="input">    
                                        @php
                                            $name = [$lang[2]??'Rectangle',$lang[3]??'Square',$lang[4]??'Rectangle Border',$lang[5]??'Circle',$lang[6]??'Circle Border',$lang['7']??'Annulus',$lang['8']??'Triangle',$lang['9']??'Trapezoid',$lang['10']??'Cube',$lang['11']??'Cylinder',$lang['12']??'Hollow Cylinder',$lang['13']??'Hemisphere',$lang['14']??'Cone',$lang['15']??'Pyramid',$lang['16']??'Other'];
                                            $val = [3,4,5,6,7,8,9,10,11,12,13,14,15,16,17];
                                        @endphp
                                        @foreach($val as $index => $v)
                                            <option value="{{ $v }}">{{ $name[$index] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if(in_array('extra', $shapeConfig['show']))
                            <div class="space-y-2" id="extra">
                                <label for="extra_area" class="font-s-14 text-blue">{{ $lang['17'] ?? 'Area' }}:</label>
                                <div class="relative w-full ">
                                    <input type="number" wire:model.live="extra_area" id="extra_area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                                    <label for="extra_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('extra_units')">{{ $extra_units }} ▾</label>
                                    @if($showDropdown === 'extra_units')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["in²","ft²","cm²","m²","yd²"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('extra_units', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(in_array('1', $shapeConfig['show']))
                            <div class="space-y-2 first" id="1">
                                <label for="first" class="font-s-14 text-blue">{{ $shapeConfig['labels']['first'] ?? 'Depth:' }}</label>
                                <div class="relative w-full ">
                                    <input type="number" wire:model.live="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="{{ $shapeConfig['placeholders']['first'] ?? 'Depth' }}" />
                                    <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('units1')">{{ $units1 }} ▾</label>
                                    @if($showDropdown === 'units1')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["in","ft","cm","m","yd"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units1', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(in_array('2', $shapeConfig['show']))
                            <div class="space-y-2 second" id="2">
                                <label for="second" class="font-s-14 text-blue">{{ $shapeConfig['labels']['second'] ?? 'Length:' }}</label>
                                <div class="relative w-full ">
                                    <input type="number" wire:model.live="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="{{ $shapeConfig['placeholders']['second'] ?? 'Length' }}" />
                                    <label for="units2" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('units2')">{{ $units2 }} ▾</label>
                                    @if($showDropdown === 'units2')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["in","ft","cm","m","yd"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units2', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(in_array('3', $shapeConfig['show']))
                            <div class="space-y-2 third" id="3">
                                <label for="third" class="font-s-14 text-blue">{{ $shapeConfig['labels']['third'] ?? 'Width:' }}</label>
                                <div class="relative w-full ">
                                    <input type="number" wire:model.live="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="{{ $shapeConfig['placeholders']['third'] ?? 'Width' }}" />
                                    <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('units3')">{{ $units3 }} ▾</label>
                                    @if($showDropdown === 'units3')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["in","ft","cm","m","yd"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units3', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(in_array('4', $shapeConfig['show']))
                            <div class="space-y-2 four" id="4">
                                <label for="four" class="font-s-14 text-blue">{{ $shapeConfig['labels']['four'] ?? 'Border Width:' }}</label>
                                <div class="relative w-full ">
                                    <input type="number" wire:model.live="four" id="four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="{{ $shapeConfig['placeholders']['four'] ?? 'Border Width' }}" />
                                    <label for="units4" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('units4')">{{ $units4 }} ▾</label>
                                    @if($showDropdown === 'units4')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["in","ft","cm","m","yd"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units4', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(in_array('5', $shapeConfig['show']))
                            <div class="space-y-2 five" id="5">
                                <label for="five" class="font-s-14 text-blue">{{ $lang['22'] ?? 'Five:' }}</label>
                                <div class="relative w-full ">
                                    <input type="number" wire:model.live="five" id="five" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                                    <label for="units5" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('units5')">{{ $units5 }} ▾</label>
                                    @if($showDropdown === 'units5')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["in","ft","cm","m","yd"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units5', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(in_array('5b', $shapeConfig['show']))
                            <div class="space-y-2 fiveb" id="5b">
                                <label for="fiveb" class="font-s-14 text-blue">{{ $lang['23'] ?? 'Five B:' }}</label>
                                <div class="w-full py-2 position-relative"> 
                                    <input type="number" step="any" wire:model.live="fiveb" id="fiveb" class="input" aria-label="input" />
                                </div>
                            </div>
                            @endif

                            <div class="space-y-2 price">
                                <label for="price" class="font-s-14 text-blue">{{ $lang['25'] ?? 'Price:' }}</label>
                                <div class="relative w-full ">
                                    <input type="number" wire:model.live="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                                    <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('price_unit')">{{ $price_unit }} ▾</label>
                                    @if($showDropdown === 'price_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["{$currancy} ft³","{$currancy} yd³","{$currancy} m³"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('price_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="grid grid-cols-1   gap-6">
                            @if(in_array('6', $shapeConfig['show']))
                            <div class="space-y-2 quantity" id="6">
                                <label for="quantity" class="font-s-14 text-blue">{{ $lang['24'] ?? 'Quantity' }}:</label>
                                <div class="w-full "> 
                                    <input type="number" step="any" wire:model.live="quantity" id="quantity" class="input" aria-label="input" />
                                </div>
                            </div>
                            @endif
                            <div class="space-y-2 ">
                                <img src="{{ asset('images/' . $shapeConfig['image']) }}" id="im" alt="Polygon Calculator" width="100%" height="300px">
                            </div>
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
                <div class="w-full mt-5">
                    <div class="w-full my-2">
                        <div class="lg:w-[80%] md:w-[80%] w-full overflow-x-auto">
                            <table class="w-full">
                                <tr>
                                    <td width="60%" class="border-b py-2"><strong>{{ $lang['26'] ?? 'Result' }}  ft³ :</strong></td>
                                    <td class="border-b py-2">{{ $detail['cubic_feet'] ?? 0 }} ft³</td>
                                </tr>
                                @if(!empty($detail['estimated_price']))
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['27'] ?? 'Estimated Price' }} :</strong></td>
                                        <td class="border-b py-2">{{ $currancy . ' ' . $detail['estimated_price'] }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="border-b py-2">{{ $lang['28'] ?? 'Volume' }}   in³ :</td>
                                    <td class="border-b py-2">{{ $detail['cubic_in'] ?? 0 }} in³</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['28'] ?? 'Volume' }}   cm³ :</td>
                                    <td class="border-b py-2">{{ $detail['cubic_cm'] ?? 0 }} cm³</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['28'] ?? 'Volume' }}  m³ :</td>
                                    <td class="border-b py-2">{{ $detail['cubic_meter'] ?? 0 }} m³</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['28'] ?? 'Volume' }}  yards³ :</td>
                                    <td class="border-b py-2">{{ $detail['cubic_yard'] ?? 0 }} yd³</td>
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
