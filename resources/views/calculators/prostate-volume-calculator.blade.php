<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">


                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="length" class="label">{!! $lang['1'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }} ▾</label>
                        <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }}" id="length_unit" class="hidden">
                        <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mm')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'dm')">decimeters (dm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mi')">miles (mi)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'ft')">feet (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'yd')">yards (yd)</p>

                        </div>
                     </div>
                </div>
    
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="width" class="label">{!! $lang['2'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width']) ? $_POST['width'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }} ▾</label>
                        <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }}" id="width_unit" class="hidden">
                        <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mm')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'dm')">decimeters (dm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mi')">miles (mi)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'ft')">feet (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'yd')">yards (yd)</p>

                        </div>
                     </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="height" class="label">{!! $lang['3'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'cm' }} ▾</label>
                        <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'cm' }}" id="height_unit" class="hidden">
                        <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mm')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'dm')">decimeters (dm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mi')">miles (mi)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'ft')">feet (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'yd')">yards (yd)</p>

                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="psa" class="label">PSA ({!! $lang['4'] !!}):</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="psa" id="psa" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->psa)?request()->psa:'' }}" />
                        <span class="text-blue input_unit">ng/ml</span>
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
    
                    <div class="w-full p-3 mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[80%] lg:w-[80%] flex flex-wrap justify-between">
                                <div class="px-3 mt-3">
                                    <p><strong>{{ $lang[5] }} cm³</strong></p>
                                    <p class="text-[28px]"><strong class="text-[#119154]">{{ number_format($detail['answer'], 3)." "."cm³" }}</strong></p>
                                    @if(isset($detail['answer2']))
                                      <p><strong>PSA {{ $lang[6] }}</strong></p>
                                      <p class="text-[28px]"><strong class="text-[#119154]">{{ number_format($detail['answer2'], 3)." "."ng/ml²" }}</strong></p>
                                    @endif
                                </div>
                                <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                <div class="px-3 mt-3">
                                    <p><strong>{{ $lang[7] }} cm³</strong></p>
                                    <p class="text-[28px]"><strong class="text-[#119154]">{{ number_format($detail['answer22'], 3)." "."cm³" }}</strong></p>
                                    @if(isset($detail['answer23']))
                                      <p><strong>PSA {{ $lang[6] }}</strong></p>
                                      <p class="text-[28px]"><strong class="text-[#119154]">{{ number_format($detail['answer23'], 3)." "."ng/ml²" }}</strong></p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-wrap text-center justify-between mt-3">
                                <div class="px-3 mt-3">
                                    <p>{{ $lang[5] }} in³</p>
                                    <p><strong>{{ number_format(($detail['answer']/16.387), 3)." "."in³" }}</strong></p>
                                </div>
                                <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                <div class="px-3 mt-3">
                                    <p>{{ $lang[7] }} in³</p>
                                    <p><strong>{{ number_format(($detail['answer22']/16.387), 3)." "."in³" }}</strong></p>
                                </div>
                                <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                <div class="px-3 mt-3">
                                    <p>{{ $lang[5] }} mm³</p>
                                    <p><strong>{{ number_format(($detail['answer']*100), 3) ." "."mm³" }}</strong></p>
                                </div>
                                <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                <div class="px-3 mt-3">
                                    <p>{{ $lang[7] }} mm³</p>
                                    <p><strong>{{ number_format(($detail['answer22']*100), 3)." "."mm³" }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset
</form>