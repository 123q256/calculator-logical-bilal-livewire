<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                
                <p class="col-span-12 "><strong>{{$lang['1']}}</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 wall_length ">
                    <label for="wall_length" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="wall_length" id="wall_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wall_length'])?$_POST['wall_length']:'7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="wall_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wall_length_unit_dropdown')">{{ isset($_POST['wall_length_unit'])?$_POST['wall_length_unit']:'yd' }} ▾</label>
                        <input type="text" name="wall_length_unit" value="{{ isset($_POST['wall_length_unit'])?$_POST['wall_length_unit']:'yd' }}" id="wall_length_unit" class="hidden">
                        <div id="wall_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wall_length_unit">
                            @foreach (["cm", "m","cm", "dm", "in", "ft", "yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('wall_length_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 wall_height">
                    <label for="wall_height" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="wall_height" id="wall_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wall_height'])?$_POST['wall_height']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="wall_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wall_height_unit_dropdown')">{{ isset($_POST['wall_height_unit'])?$_POST['wall_height_unit']:'yd' }} ▾</label>
                        <input type="text" name="wall_height_unit" value="{{ isset($_POST['wall_height_unit'])?$_POST['wall_height_unit']:'yd' }}" id="wall_height_unit" class="hidden">
                        <div id="wall_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wall_height_unit">
                            @foreach (["cm", "m","cm", "dm", "in", "ft", "yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('wall_height_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 block_height">
                    <p class="mb-2 font-s-14">{{$lang['4']}}</p>
                    <label for="block_height" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="block_height" id="block_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['block_height'])?$_POST['block_height']:'1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="block_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('block_height_unit_dropdown')">{{ isset($_POST['block_height_unit'])?$_POST['block_height_unit']:'in' }} ▾</label>
                        <input type="text" name="block_height_unit" value="{{ isset($_POST['block_height_unit'])?$_POST['block_height_unit']:'in' }}" id="block_height_unit" class="hidden">
                        <div id="block_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="block_height_unit">
                            @foreach (["cm", "m","cm", "dm", "in", "ft", "yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('block_height_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 cap_height">
                    <p class="mb-2 font-s-14">{{$lang['6']}}</p>
                    <label for="cap_height" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="cap_height" id="cap_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cap_height'])?$_POST['cap_height']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="cap_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cap_height_unit_dropdown')">{{ isset($_POST['cap_height_unit'])?$_POST['cap_height_unit']:'in' }} ▾</label>
                        <input type="text" name="cap_height_unit" value="{{ isset($_POST['cap_height_unit'])?$_POST['cap_height_unit']:'in' }}" id="cap_height_unit" class="hidden">
                        <div id="cap_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cap_height_unit">
                            @foreach (["cm", "m","cm", "dm", "in", "ft", "yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('cap_height_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 block_length">
                    <label for="block_length" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="block_length" id="block_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['block_length'])?$_POST['block_length']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="block_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('block_length_unit_dropdown')">{{ isset($_POST['block_length_unit'])?$_POST['block_length_unit']:'ft' }} ▾</label>
                        <input type="text" name="block_length_unit" value="{{ isset($_POST['block_length_unit'])?$_POST['block_length_unit']:'ft' }}" id="block_length_unit" class="hidden">
                        <div id="block_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="block_length_unit">
                            @foreach (["cm", "m","cm", "dm", "in", "ft", "yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('block_length_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                    <label for="cap_length" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="cap_length" id="cap_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cap_length'])?$_POST['cap_length']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="cap_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cap_length_unit_dropdown')">{{ isset($_POST['cap_length_unit'])?$_POST['cap_length_unit']:'in' }} ▾</label>
                        <input type="text" name="cap_length_unit" value="{{ isset($_POST['cap_length_unit'])?$_POST['cap_length_unit']:'in' }}" id="cap_length_unit" class="hidden">
                        <div id="cap_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cap_length_unit">
                            @foreach (["cm", "m","cm", "dm", "in", "ft", "yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('cap_length_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
              
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="wall_block_price" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="w-100 py-2 relative"> 
                        <input type="number" step="any" name="wall_block_price" id="wall_block_price" class="input" aria-label="input"  value="{{ isset(request()->wall_block_price)?request()->wall_block_price:'10' }}" />
                        <span class="text-blue input_unit">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 cost">
                    <label for="cap_block_price" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                    <div class="w-100 py-2 relative"> 
                        <input type="number" step="any" name="cap_block_price" id="cap_block_price" class="input" aria-label="input"  value="{{ isset(request()->cap_block_price)?request()->cap_block_price:'5' }}" />
                        <span class="text-blue input_unit">{{$currancy}}</span>
                    </div>
                </div>
                <p class="col-span-12 "><strong>{{ $lang['8'] }}</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 cost conc_mix_one">
                    <label for="backfill_thickness" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="backfill_thickness" id="backfill_thickness" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['backfill_thickness'])?$_POST['backfill_thickness']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="backfill_thickness_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('backfill_thickness_unit_dropdown')">{{ isset($_POST['backfill_thickness_unit'])?$_POST['backfill_thickness_unit']:'cm' }} ▾</label>
                        <input type="text" name="backfill_thickness_unit" value="{{ isset($_POST['backfill_thickness_unit'])?$_POST['backfill_thickness_unit']:'cm' }}" id="backfill_thickness_unit" class="hidden">
                        <div id="backfill_thickness_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="backfill_thickness_unit">
                            @foreach (["cm", "m","cm", "dm", "in", "ft", "yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('backfill_thickness_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                    <label for="backfill_length" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="backfill_length" id="backfill_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['backfill_length'])?$_POST['backfill_length']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="backfill_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('backfill_length_unit_dropdown')">{{ isset($_POST['backfill_length_unit'])?$_POST['backfill_length_unit']:'ft' }} ▾</label>
                        <input type="text" name="backfill_length_unit" value="{{ isset($_POST['backfill_length_unit'])?$_POST['backfill_length_unit']:'ft' }}" id="backfill_length_unit" class="hidden">
                        <div id="backfill_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="backfill_length_unit">
                            @foreach (["cm", "m","cm", "dm", "in", "ft", "yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('backfill_length_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                    <label for="backfill_height" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="backfill_height" id="backfill_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['backfill_height'])?$_POST['backfill_height']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="backfill_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('backfill_height_unit_dropdown')">{{ isset($_POST['backfill_height_unit'])?$_POST['backfill_height_unit']:'ft' }} ▾</label>
                        <input type="text" name="backfill_height_unit" value="{{ isset($_POST['backfill_height_unit'])?$_POST['backfill_height_unit']:'ft' }}" id="backfill_height_unit" class="hidden">
                        <div id="backfill_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="backfill_height_unit">
                            @foreach (["cm", "m","cm", "dm", "in", "ft", "yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('backfill_height_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="backfill_price" class="font-s-14 text-blue">{{ $lang['12'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="backfill_price" id="backfill_price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['backfill_price'])?$_POST['backfill_price']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="backfill_price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('backfill_price_unit_dropdown')">{{ isset($_POST['backfill_price_unit'])?$_POST['backfill_price_unit']:'ft' }} ▾</label>
                        <input type="text" name="backfill_price_unit" value="{{ isset($_POST['backfill_price_unit'])?$_POST['backfill_price_unit']:'ft' }}" id="backfill_price_unit" class="hidden">
                        <div id="backfill_price_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="backfill_price_unit">
                            @foreach (["$currancy deg", "$currancy lb", "$currancy t", "$currancy oz", "$currancy stone", "$currancy Us ton", "$currancy Long ton"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('backfill_price_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
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


    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full my-1">
                        <div class="w-full md:w-[60%] lg:w-[60%]">
                            <table>
                                <tr>
                                    <td colspan="2" class=""><strong>{{$lang[13]}}</strong></td>
                                </tr>
                                <tr>
                                    <td width="60%" class="border-b py-2">{{$lang[14]}} :</td>
                                    <td class="border-b py-2">{{number_format($detail['blocks'])}} <span class="font-s-14">{{$lang[15]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang[16]}} :</td>
                                    <td class="border-b py-2">{{number_format($detail['caps'])}} <span class="font-s-14">{{$lang[15]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang[17]}} :</td>
                                    <td class="border-b py-2">{{$detail['backfill_volume']}} <span class="font-s-14">{{$lang[18]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang[19]}} :</td>
                                    <td class="border-b py-2">{{number_format($detail['backfill_weight'])}} <span class="font-s-14">{{$lang[20]}}</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="pt-2"><strong>{{$lang[21]}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang[22]}} :</td>
                                    <td class="border-b py-2">{{number_format($detail['blocks_price'])}} <span class="font-s-14">{{$lang[23]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang[24]}} :</td>
                                    <td class="border-b py-2">{{number_format($detail['caps_price'])}} <span class="font-s-14">{{$lang[23]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang[25]}} :</td>
                                    <td class="border-b py-2">{{number_format($detail['backfill_total_price'])}} <span class="font-s-14">{{$lang[23]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang[26]}} :</td>
                                    <td class="border-b py-2">{{number_format($detail['total_cost'])}} <span class="font-s-14">{{$lang[23]}}</span></td>
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
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>