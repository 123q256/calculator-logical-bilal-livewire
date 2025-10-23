<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="first" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first'])?$_POST['first']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'cm' }} ▾</label>
                        <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'cm' }}" id="units1" class="hidden">
                        <div id="units1_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'm')">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'ft')">feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'yd')">yards (yd)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'km')">kilometer (km)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'mi')">miles (mi)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="second" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second'])?$_POST['second']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units2_dropdown')">{{ isset($_POST['units2'])?$_POST['units2']:'cm' }} ▾</label>
                        <input type="text" name="units2" value="{{ isset($_POST['units2'])?$_POST['units2']:'cm' }}" id="units2" class="hidden">
                        <div id="units2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'm')">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'ft')">feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'yd')">yards (yd)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'km')">kilometer (km)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'mi')">miles (mi)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="third" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third'])?$_POST['third']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units3_dropdown')">{{ isset($_POST['units3'])?$_POST['units3']:'mm' }} ▾</label>
                        <input type="text" name="units3" value="{{ isset($_POST['units3'])?$_POST['units3']:'mm' }}" id="units3" class="hidden">
                        <div id="units3_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'mm')">milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'm')">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'ft')">feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'yd')">yards (yd)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="four" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="four" id="four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['four'])?$_POST['four']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units4_dropdown')">{{ isset($_POST['units4'])?$_POST['units4']:'mm' }} ▾</label>
                        <input type="text" name="units4" value="{{ isset($_POST['units4'])?$_POST['units4']:'mm' }}" id="units4" class="hidden">
                        <div id="units4_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', 'mm')">milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', 'm')">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', 'ft')">feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', 'yd')">yards (yd)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="five" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="five" id="five" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['five'])?$_POST['five']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units5" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units5_dropdown')">{{ isset($_POST['units5'])?$_POST['units5']:'cm' }} ▾</label>
                        <input type="text" name="units5" value="{{ isset($_POST['units5'])?$_POST['units5']:'cm' }}" id="units5" class="hidden">
                        <div id="units5_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', ' {{$currancy}} cm')">{{$currancy}} centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5',  '{{$currancy}} m')">{{$currancy}} meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', ' {{$currancy}} ft')">{{$currancy}} feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', ' {{$currancy}} in')">{{$currancy}} inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', ' {{$currancy}} yd')">{{$currancy}} yards (yd)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="six" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="six" id="six" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['six'])?$_POST['six']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units6" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units6_dropdown')">{{ isset($_POST['units6'])?$_POST['units6']:'cm' }} ▾</label>
                        <input type="text" name="units6" value="{{ isset($_POST['units6'])?$_POST['units6']:'cm' }}" id="units6" class="hidden">
                        <div id="units6_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units6', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units6', 'm')">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units6', 'ft')">feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units6', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units6', 'yd')">yards (yd)</p>
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
                    <div class="w-full  mt-3">
                        <div class="w-full mt-1">
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 col-12">
                                 <table class="font-s-18 w-100">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[7] }} :</strong></td>
                                        <td class="border-b py-2"><?=$detail['grid_len']?></span><span> (cm)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[8] }} :</strong></td>
                                        <td class="border-b py-2"><?=$detail['grid_wid']?></span><span> (cm)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[12] }} :</strong></td>
                                        <td class="border-b py-2"><?=$currancy.' '.$detail['price_s']?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[9] }} :</strong></td>
                                        <td class="border-b py-2"><?= round($detail['trl'], 3)?></span><span> (cm)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[10] }} :</strong></td>
                                        <td class="border-b py-2"><?= round($detail['rebar_pie'])?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[11] }} :</strong></td>
                                        <td class="border-b py-2"><?=$currancy.' '. round($detail['cost'])?></td>
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