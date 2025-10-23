<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="concentration" class="font-s-14 text-blue">{!! $lang['1'] !!} ({!! $lang['2'] !!}):</label>
                            <div class="relative w-full ">
                                <input type="number" name="concentration" id="concentration" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['concentration'])?$_POST['concentration']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="concentration_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('concentration_unit_dropdown')">{{ isset($_POST['concentration_unit'])?$_POST['concentration_unit']:'M' }} ▾</label>
                                <input type="text" name="concentration_unit" value="{{ isset($_POST['concentration_unit'])?$_POST['concentration_unit']:'M' }}" id="concentration_unit" class="hidden">
                                <div id="concentration_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_unit', 'M')">M</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_unit', 'mM')">mM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_unit', 'μM')">μM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_unit', 'nM')">nM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_unit', 'pM')">pM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_unit', 'fM')">fM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_unit', 'aM')">aM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_unit', 'zM')">zM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_unit', 'yM')">yM</p>
                                </div>
                            </div>
                       </div>
                        <div class="space-y-2">
                            <label for="volume" class="font-s-14 text-blue">{!! $lang['3'] !!} ({!! $lang['2'] !!}):</label>
                            <div class="relative w-full ">
                                <input type="number" name="volume" id="volume" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volume'])?$_POST['volume']:'45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="volume_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('volume_unit_dropdown')">{{ isset($_POST['volume_unit'])?$_POST['volume_unit']:'l' }} ▾</label>
                                <input type="text" name="volume_unit" value="{{ isset($_POST['volume_unit'])?$_POST['volume_unit']:'l' }}" id="volume_unit" class="hidden">
                                <div id="volume_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'mm³')">cubic millimeters (mm³)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'cm³')">cubic centimeters (cm³)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'dm³')">cubic decimeters (dm³)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'm³')">cubic meters (m³)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'in³')">cubic inches (in³)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'ft³')">cubic feet (ft³)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'yd³')">cubic yards (yd³)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'ml')">milliliters (ml)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'cl')">centiliters (cl)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'l')">liters (l)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'US gal')">US gallons (US gal)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'UK gal')">UK gallons (UK gal)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'US fl oz')">US fluid ounces (US fl oz)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'UK fl oz')">UK fluid ounces (UK fl oz)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'cups')">cups</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'tbsp')">tablespoon (tbsp)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'US qt')">US liquid quart (US qt)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'UK qt')">UK liquid quart (UK qt)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'US pt')">US pints (US pt)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'UK pt')">UK pints (UK pt)</p>
                                </div>
                            </div>
                       </div>
                        <div class="space-y-2">
                                <label for="final" class="font-s-14 text-blue">{!! $lang['1'] !!} ({!! $lang['4'] !!}):</label>
                                <div class="relative w-full ">
                                    <input type="number" name="final" id="final" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['final'])?$_POST['final']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="final_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('final_unit_dropdown')">{{ isset($_POST['final_unit'])?$_POST['final_unit']:'M' }} ▾</label>
                                    <input type="text" name="final_unit" value="{{ isset($_POST['final_unit'])?$_POST['final_unit']:'M' }}" id="final_unit" class="hidden">
                                    <div id="final_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'M')">M</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'mM')">mM</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'μM')">μM</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'nM')">nM</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'pM')">pM</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'fM')">fM</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'aM')">aM</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'zM')">zM</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'yM')">yM</p>
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
                        <div class="w-full">
                            <div class="d-flex flex-column flex-md-row items-center bg-[#F6FAFC] rounded-lg  px-3 py-2" style="border: 1px solid #c1b8b899;">
                                <strong class="pe-md-3">{!! $lang['3'] !!} ({!! $lang['4'] !!}) =</strong>
                                <strong class="text-green font-s-28">{!! $detail['answer'] !!} <span class="font-s-16">{!! $lang['6'] !!}</span></strong>
                            </div>
                            <p class="mt-2 mb-3"><strong>{!! $lang['3'] !!} ({!! $lang['4'] !!}) {!! $lang['5'] !!}</strong></p>
                            <div class="w-full overflow-auto">
                                <table class="col-12" cellspacing="0" style="border-collapse: collapse">
                                    <thead>
                                        <tr class="bg-sky">
                                            <td class="border p-2"><strong class="text-blue">mm³</strong></td>
                                            <td class="border p-2"><strong class="text-blue">cm³</strong></td>
                                            <td class="border p-2"><strong class="text-blue">dm³</strong></td>
                                            <td class="border p-2"><strong class="text-blue">m³</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-white border p-2">{!! $detail['answer'] * 1e+6 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer'] * 1000 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer'] * 1 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer'] / 1000 !!}</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border p-2"><strong class="text-blue">in³</strong></td>
                                            <td class="border p-2"><strong class="text-blue">ft³</strong></td>
                                            <td class="border p-2"><strong class="text-blue">yd³</strong></td>
                                            <td class="border p-2"><strong class="text-blue">ml</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-white border p-2">{!! $detail['answer']  * 61.024 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer'] / 28.317 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer'] / 764.6 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer'] * 1000 !!}</td>
                                        </tr>
                                        <tr>
                                            <td class="border p-2"><strong class="text-blue">cl</strong></td>
                                            <td class="border p-2"><strong class="text-blue">tsp</strong></td>
                                            <td class="border p-2"><strong class="text-blue">US gal</strong></td>
                                            <td class="border p-2"><strong class="text-blue">UK gal</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-white border p-2">{!! $detail['answer'] * 100 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer']  * 202.9  !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer'] / 3.785 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer'] / 4.546 !!}</td>
                                        </tr>
                                        <tr>
                                            <td class="border p-2"><strong class="text-blue">US fl oz</strong></td>
                                            <td class="border p-2"><strong class="text-blue">UK fl oz</strong></td>
                                            <td class="border p-2"><strong class="text-blue">cups</strong></td>
                                            <td class="border p-2"><strong class="text-blue">tbsp</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-white border p-2">{!! $detail['answer'] * 33.814 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer']  * 35.195 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer'] * 4.227 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer'] * 66.6667 !!}</td>
                                        </tr>
                                        <tr>
                                            <td class="border p-2"><strong class="text-blue">US qt</strong></td>
                                            <td class="border p-2"><strong class="text-blue">UK qt</strong></td>
                                            <td class="border p-2"><strong class="text-blue">US pt</strong></td>
                                            <td class="border p-2"><strong class="text-blue">UK pt</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-white border p-2">{!! $detail['answer'] * 1.057 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer']  / 1.136 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer'] * 2.113376 !!}</td>
                                            <td class="bg-white border p-2">{!! $detail['answer'] * 1.759754 !!}</td>
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
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>