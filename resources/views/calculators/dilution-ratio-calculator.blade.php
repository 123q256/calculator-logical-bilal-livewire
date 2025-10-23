<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-6">
                    <label for="final_volume" class="label">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="final_volume" id="final_volume" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['final_volume']) ? $_POST['final_volume'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="final_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('final_unit_dropdown')">{{ isset($_POST['final_unit'])?$_POST['final_unit']:'liter' }} ▾</label>
                        <input type="text" name="final_unit" value="{{ isset($_POST['final_unit'])?$_POST['final_unit']:'liter' }}" id="final_unit" class="hidden">
                        <div id="final_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="final_unit">
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'cm³')">cm³</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'dm³')">dm³</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'm³')">m³</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'cu in')">cu in</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'cu ft')">cu ft</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'cu yd')">cu yd</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'ml')">ml</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'cl')">cl</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'liter')">liter</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'US gal')">US gal</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'UK gal')">UK gal</p>
                        </div>
                     </div>
                </div>
              
                <div class="col-span-6">
                    <label for="dilution_ratio" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="dilution_ratio" id="dilution_ratio" value="{{ isset($_POST['dilution_ratio'])?$_POST['dilution_ratio']:'' }}" class="input" aria-label="input" />
                        <span class="input_unit text-blue">:1</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="concentrate_volume" class="label">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="concentrate_volume" id="concentrate_volume" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['concentrate_volume']) ? $_POST['concentrate_volume'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="concentrate_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('concentrate_unit_dropdown')">{{ isset($_POST['concentrate_unit'])?$_POST['concentrate_unit']:'liter' }} ▾</label>
                        <input type="text" name="concentrate_unit" value="{{ isset($_POST['concentrate_unit'])?$_POST['concentrate_unit']:'liter' }}" id="concentrate_unit" class="hidden">
                        <div id="concentrate_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="concentrate_unit">
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentrate_unit', 'cm³')">cm³</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentrate_unit', 'dm³')">dm³</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentrate_unit', 'm³')">m³</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentrate_unit', 'cu in')">cu in</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentrate_unit', 'cu ft')">cu ft</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentrate_unit', 'cu yd')">cu yd</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentrate_unit', 'ml')">ml</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentrate_unit', 'cl')">cl</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentrate_unit', 'liter')">liter</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentrate_unit', 'US gal')">US gal</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentrate_unit', 'UK gal')">UK gal</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6">
                    <label for="water_volume" class="label">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="water_volume" id="water_volume" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['water_volume']) ? $_POST['water_volume'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="water_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('water_unit_dropdown')">{{ isset($_POST['water_unit'])?$_POST['water_unit']:'liter' }} ▾</label>
                        <input type="text" name="water_unit" value="{{ isset($_POST['water_unit'])?$_POST['water_unit']:'liter' }}" id="water_unit" class="hidden">
                        <div id="water_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="water_unit">
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('water_unit', 'cm³')">cm³</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('water_unit', 'dm³')">dm³</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('water_unit', 'm³')">m³</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('water_unit', 'cu in')">cu in</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('water_unit', 'cu ft')">cu ft</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('water_unit', 'cu yd')">cu yd</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('water_unit', 'ml')">ml</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('water_unit', 'cl')">cl</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('water_unit', 'liter')">liter</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('water_unit', 'US gal')">US gal</p>
                             <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('water_unit', 'UK gal')">UK gal</p>
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
    
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="col mt-3">
                            <p class="text-[20px]"><strong>{{ $detail['name1']}} </strong></p>
                            <p class="text-[25px] py-2"><strong class="text-[#119154]">{{$detail['res1'] }}</strong></p>
                        </div>
                        <div class="col-12 overtflow-auto lg:text-[18px] md:text-[18px] text-[14px]" style="overflow: auto">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <td class="border-b py-2"><strong>cm³</strong></td>
                                        <td class="border-b py-2"><strong>dm³</strong></td>
                                        <td class="border-b py-2"><strong>m³</strong></td>
                                        <td class="border-b py-2"><strong>cu in</strong></td>
                                        <td class="border-b py-2"><strong>cu ft</strong></td>
                                        <td class="border-b py-2"><strong>cu yd</strong></td>
                                        <td class="border-b py-2"><strong>ml</strong></td>
                                        <td class="border-b py-2"><strong>cl</strong></td>
                                        <td class="border-b py-2"><strong>US gal</strong></td>
                                        <td class="border-b py-2"><strong>UK gal</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-b py-2">{{ $detail['res11'] * 1000 }}</td>
                                        <td class="border-b py-2">{{ $detail['res11'] * 1}}</td>
                                        <td class="border-b py-2">{{ $detail['res11'] * 0.001}}</td>
                                        <td class="border-b py-2">{{ $detail['res11'] * 61.02}}</td>
                                        <td class="border-b py-2">{{ $detail['res11'] * 0.035315}}</td>
                                        <td class="border-b py-2">{{ $detail['res11'] * 0.001308}}</td>
                                        <td class="border-b py-2">{{ $detail['res11'] * 1000}}</td>
                                        <td class="border-b py-2">{{ $detail['res11'] * 100}}</td>
                                        <td class="border-b py-2">{{ $detail['res11'] * 0.26417}}</td>
                                        <td class="border-b py-2">{{ $detail['res11'] * 0.21997}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col mt-3">
                            <p class="text-[20px]"><strong>{{ $detail['name2']}} </strong></p>
                            <p class="text-[25px] py-2"><strong class="text-green-700">{{$detail['res2'] }}</strong></p>
                        </div>
                        <table>
                            <tr>
                                <td class="border-b py-2"></td>
                                <td class="border-b py-2"></td>
                            </tr>
                        </table>
                        <div class="col-12 overtflow-auto text-[18px]" style="overflow: auto">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <td class="border-b py-2"><strong>cm³</strong></td>
                                        <td class="border-b py-2"><strong>dm³</strong></td>
                                        <td class="border-b py-2"><strong>m³</strong></td>
                                        <td class="border-b py-2"><strong>cu in</strong></td>
                                        <td class="border-b py-2"><strong>cu ft</strong></td>
                                        <td class="border-b py-2"><strong>cu yd</strong></td>
                                        <td class="border-b py-2"><strong>ml</strong></td>
                                        <td class="border-b py-2"><strong>cl</strong></td>
                                        <td class="border-b py-2"><strong>US gal</strong></td>
                                        <td class="border-b py-2"><strong>UK gal</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-b py-2">{{ $detail['res22'] * 1000 }}</td>
                                        <td class="border-b py-2">{{ $detail['res22'] * 1}}</td>
                                        <td class="border-b py-2">{{ $detail['res22'] * 0.001}}</td>
                                        <td class="border-b py-2">{{ $detail['res22'] * 61.02}}</td>
                                        <td class="border-b py-2">{{ $detail['res22'] * 0.035315}}</td>
                                        <td class="border-b py-2">{{ $detail['res22'] * 0.001308}}</td>
                                        <td class="border-b py-2">{{ $detail['res22'] * 1000}}</td>
                                        <td class="border-b py-2">{{ $detail['res22'] * 100}}</td>
                                        <td class="border-b py-2">{{ $detail['res22'] * 0.26417}}</td>
                                        <td class="border-b py-2">{{ $detail['res22'] * 0.21997}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>