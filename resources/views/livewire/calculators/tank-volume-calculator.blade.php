<div>
   <form wire:submit.prevent="calculate">
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        
        @php
            $show2 = !in_array($operations, ['16']);
            $show3 = in_array($operations, ['5', '6', '7', '12', '13', '14', '15']);
            $show4 = in_array($operations, ['13', '14']);
            
            $label1 = $lang[19] ?? 'Length' . " (l)";
            $label2 = $lang[20] ?? 'Diameter' . " (d)";
            $label3 = $lang[19] ?? 'Length' . " (l)";
            $label4 = $lang[28] ?? 'Top Diameter';
            
            if ($operations == '3') {
                $label1 = ($lang[19] ?? 'Length') . ' (l)';
                $label2 = ($lang[20] ?? 'Diameter') . ' (d)';
            } elseif ($operations == '4') {
                $label1 = ($lang[21] ?? 'Height') . ' (h)';
                $label2 = ($lang[20] ?? 'Diameter') . ' (d)';
            } elseif (in_array($operations, ['5', '6', '7', '12'])) {
                $label1 = ($operations == '6' ? "Height (h)" : ($lang[21] ?? 'Height') . " (h)");
                $label2 = ($lang[22] ?? 'Width') . ' (w)';
                $label3 = ($lang[19] ?? 'Length') . ' (l)';
            } elseif (in_array($operations, ['8', '9'])) {
                $label1 = ($lang[24] ?? 'Length') . ' (a)';
                $label2 = ($lang[20] ?? 'Diameter') . ' (d)';
            } elseif (in_array($operations, ['13', '14'])) {
                $label1 = $lang[25] ?? 'Top Height';
                $label2 = $lang[26] ?? 'Bottom Height';
                $label3 = $lang[27] ?? 'Bottom Diameter';
                $label4 = $lang[28] ?? 'Top Diameter';
            } elseif ($operations == '15') {
                $label1 = $lang[25] ?? 'Top Height';
                $label2 = $lang[26] ?? 'Bottom Height';
                $label3 = $lang[28] ?? 'Top Diameter';
            } elseif ($operations == '16') {
                $label1 = ($lang[20] ?? 'Diameter') . ' (d)';
            }
            
            $imageMap = [
                '3' => 'Horizontal Cylinder.webp',
                '4' => 'Vertical Cylinder.webp',
                '5' => 'Rectangle.webp',
                '6' => 'Horizontal Oval.webp',
                '7' => 'Vertical Oval.webp',
                '8' => 'Horizontal Capsule.webp',
                '9' => 'Vertical Capsule.webp',
                '12' => 'Horizontal Elliptical.webp',
                '13' => 'Cone Bottom.webp',
                '14' => 'Cone Top.webp',
                '15' => 'Frustum (truncated cone, funnel).webp',
                '16' => 'Sphere.webp'
            ];
            $image = $imageMap[$operations] ?? 'Horizontal Cylinder.webp';
        @endphp

        <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">

            <div class="col-lg-6">
                <div class="space-y-2 ">
                    <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Tank Type' }}:</label>
                    <select wire:model.live="operations" id="operations" class="input">
                        @php
                            $names = [$lang[2] ?? 'Horizontal Cylinder', $lang[3] ?? 'Vertical Cylinder', $lang[4] ?? 'Rectangle Box', $lang[5] ?? 'Horizontal Oval', $lang[6] ?? 'Vertical Oval', $lang[7] ?? 'Horizontal Capsule', $lang[8] ?? 'Vertical Capsule', $lang[9] ?? 'Horizontal Elliptical', $lang[10] ?? 'Conical Bottom', $lang[11] ?? 'Cone Top', ($lang[12] ?? 'Frustum')." (".($lang[13] ?? 'Truncated Cone').")", $lang[14] ?? 'Sphere'];
                            $vals = ['3','4','5','6','7','8','9','12','13','14','15','16'];
                        @endphp
                        @foreach($vals as $index => $val)
                            <option value="{{ $val }}">
                                {!! $names[$index] !!}
                            </option>
                        @endforeach
                    </select>
                </div>
                 
                <div class="text-center block lg:hidden">
                    <img src="{{asset('images/tank/' . $image)}}" alt="Tank" class="max-width" width="250px" height="250px">
                </div>

                <div class="space-y-2 mt-3" id="1">
                    <label for="first" class="font-s-14 text-blue">{{ $label1 }}:</label>
                    <div class="relative w-full mt-3 ">
                        <input type="number" wire:model.live="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="{{ $label1 }}"/>
                        <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('units1_dropdown')">{{ $units1 }} ▾</label>
                        @if($showDropdown === 'units1_dropdown')
                        <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0">
                            @foreach (["in","ft","cm","m","mm"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units1', '{{$name}}')">{{$name}}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
    
                @if($show2)
                <div class="space-y-2 mt-3" id="2">
                    <label for="second" class="font-s-14 text-blue">{{ $label2 }}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" wire:model.live="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="{{ $label2 }}"/>
                        <label for="units2" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('units2_dropdown')">{{ $units2 }} ▾</label>
                        @if($showDropdown === 'units2_dropdown')
                        <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0">
                            @foreach (["in","ft","cm","m","mm"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units2', '{{$name}}')">{{$name}}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                
                @if($show3)
                <div class="space-y-2 mt-3" id="3">
                    <label for="third" class="font-s-14 text-blue">{{ $label3 }}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" wire:model.live="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="{{ $label3 }}"/>
                        <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('units3_dropdown')">{{ $units3 }} ▾</label>
                        @if($showDropdown === 'units3_dropdown')
                        <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0">
                            @foreach (["in","ft","cm","m","mm"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units3', '{{$name}}')">{{$name}}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                
                <div class="space-y-2 mt-3" id="5">
                    <label for="fill" class="font-s-14 text-blue">{{$lang[29] ?? 'Fill'}} ({{$lang[30] ?? 'Optional'}}):</label>
                    <div class="relative w-full ">
                        <input type="number" wire:model.live="fill" id="fill" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                        <label for="fill_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('fill_units_dropdown')">{{ $fill_units }} ▾</label>
                        @if($showDropdown === 'fill_units_dropdown')
                        <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0">
                            @foreach (["in","ft","cm","m","mm"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('fill_units', '{{$name}}')">{{$name}}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                    
            </div>
            
            <div class="col-lg-6 mt-3">
                <div class="mt-3 flex justify-center hidden lg:flex">
                    <img src="{{asset('images/tank/' . $image)}}" alt="Tank" class="max-width" width="250px" height="250px">
                </div>
                
                @if($show4)
                <div class="space-y-2 mt-3" id="4">
                    <label for="four" class="font-s-14 text-blue">{{ $label4 }}:</label>
                    <div class="relative w-full ">
                        <input type="number" wire:model.live="four" id="four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="{{ $label4 }}"/>
                        <label for="units4" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('units4_dropdown')">{{ $units4 }} ▾</label>
                        @if($showDropdown === 'units4_dropdown')
                        <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0">
                            @foreach (["in","ft","cm","m","mm"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units4', '{{$name}}')">{{$name}}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                 </div>
                 @endif
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
                <div class="rounded-lg   items-center justify-center">
                    <div class="w-full0 mt-3">
                        <div class="w-full my-2">
                            <div class="lg:w-[90%] md:w-[90%] w-full overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td width="50%" class="border-b py-2"><strong>{{$lang[15] ?? 'Volume'}} in³:</strong></td>
                                        <td class="border-b py-2">{{number_format($detail['v_tank'] ?? 0, 2) }} in³</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang[15] ?? 'Volume'}} ft³:</td>
                                        <td class="border-b py-2">{{number_format($detail['v_feet'] ?? 0, 2) }} ft³</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang[16] ?? 'Volume (liters)'}} :</td>
                                        <td class="border-b py-2">{{number_format($detail['v_liter'] ?? 0, 2) }} liters</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">US {{$lang[17] ?? 'Gallons'}} :</td>
                                        <td class="border-b py-2">{{number_format($detail['us_gallons'] ?? 0, 2) }} </td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang[15] ?? 'Volume'}} m³:</td>
                                        <td class="border-b py-2">{{number_format($detail['v_meter'] ?? 0, 2) }} m³</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang[15] ?? 'Volume'}} yd³:</td>
                                        <td class="border-b py-2">{{number_format($detail['v_yard'] ?? 0, 2) }} yd³</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang[15] ?? 'Volume'}} cm³:</td>
                                        <td class="border-b py-2">{{number_format($detail['v_cm'] ?? 0, 2) }} cm³</td>
                                    </tr>
                                </table>
                                @if(!empty($detail['v_fill']))
                                    <table class="w-100 mt-2">
                                        <tr>
                                            <td width="50%" class="border-b py-2"><strong>{{$lang[18] ?? 'Fill Volume'}} :</strong></td>
                                            <td class="border-b py-2">{{number_format($detail['v_fill'], 2) }} in³ (<span class="font-s-18">{{round($detail['per_ans'] ?? 0)."%"." "."FULL"}}</span>)</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="border-b py-2">{{$lang[15] ?? 'Volume'}} ft³:</td>
                                            <td class="border-b py-2">{{number_format($detail['v_feet_fill'] ?? 0, 2) }} ft³</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="border-b py-2">{{$lang[16] ?? 'Volume (liters)'}} :</td>
                                            <td class="border-b py-2">{{number_format($detail['v_liter_fill'] ?? 0, 2) }} liters</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="border-b py-2">US {{$lang[17] ?? 'Gallons'}} :</td>
                                            <td class="border-b py-2">{{number_format($detail['us_gallons_fill'] ?? 0, 2) }} </td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="border-b py-2">{{$lang[15] ?? 'Volume'}} m³:</td>
                                            <td class="border-b py-2">{{number_format($detail['v_meter_fill'] ?? 0, 2) }} m³</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="border-b py-2">{{$lang[15] ?? 'Volume'}} yd³:</td>
                                            <td class="border-b py-2">{{number_format($detail['v_yard_fill'] ?? 0, 2) }} yd³</td>
                                        </tr>
                                        <tr>
                                            <td width="50%" class="border-b py-2">{{$lang[15] ?? 'Volume'}} cm³:</td>
                                            <td class="border-b py-2">{{number_format($detail['v_cm_fill'] ?? 0, 2) }} cm³</td>
                                        </tr>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
