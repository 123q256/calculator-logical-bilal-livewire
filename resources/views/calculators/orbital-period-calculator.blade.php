<style>
    img{
        object-fit: contain;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <p class="col-span-12 text-[18px]"><strong>{{ $lang[1] }}</strong></p>
            <div class="col-span-6">
                <label for="density" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="density" id="density" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['density']) ? $_POST['density'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('density_unit_dropdown')">{{ isset($_POST['density_unit'])?$_POST['density_unit']:'kg/m³' }} ▾</label>
                    <input type="text" name="density_unit" value="{{ isset($_POST['density_unit'])?$_POST['density_unit']:'kg/m³' }}" id="density_unit" class="hidden">
                    <div id="density_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="density_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'kg/m³')">kg/m³</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'lb/ft³')">lb/ft³</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'lb/yd³')">lb/yd³</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'g/cm³')">g/cm³</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'kg/cm³')">kg/cm³</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'mg/cm³')">mg/cm³</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'g/m³')">g/m³</p>
                    </div>
                 </div>
            </div>
            <p class="col-span-12 text-[18px]"><strong>{{ $lang[3] }}</strong></p>
            <div class="col-span-6">
                <label for="Semi" class="font-s-14 text-blue">{{ $lang[4] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="Semi" id="Semi" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['Semi']) ? $_POST['Semi'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="Semi_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('Semi_unit_dropdown')">{{ isset($_POST['Semi_unit'])?$_POST['Semi_unit']:'km' }} ▾</label>
                    <input type="text" name="Semi_unit" value="{{ isset($_POST['Semi_unit'])?$_POST['Semi_unit']:'km' }}" id="Semi_unit" class="hidden">
                    <div id="Semi_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="Semi_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Semi_unit', 'm')">m</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Semi_unit', 'km')">km</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Semi_unit', 'yd')">yd</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Semi_unit', 'mi')">mi</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Semi_unit', 'nmi')">nmi</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Semi_unit', 'Ro')">Ro</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Semi_unit', 'ly')">ly</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Semi_unit', 'au')">au</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('Semi_unit', 'pcs')">pcs</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-6">
                <label for="first" class="font-s-14 text-blue">{{ $lang[5] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="first_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('first_unit_dropdown')">{{ isset($_POST['first_unit'])?$_POST['first_unit']:'kg' }} ▾</label>
                    <input type="text" name="first_unit" value="{{ isset($_POST['first_unit'])?$_POST['first_unit']:'kg' }}" id="first_unit" class="hidden">
                    <div id="first_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="first_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'kg')">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 't')">t</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'lb')">lb</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'st')">st</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'US ton')">US ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'long ton')">long ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'earth')">earth</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('first_unit', 'sun')">sun</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-6">
                <label for="second" class="font-s-14 text-blue">{{ $lang[6] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="second_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('second_unit_dropdown')">{{ isset($_POST['second_unit'])?$_POST['second_unit']:'kg' }} ▾</label>
                    <input type="text" name="second_unit" value="{{ isset($_POST['second_unit'])?$_POST['second_unit']:'kg' }}" id="second_unit" class="hidden">
                    <div id="second_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="second_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'kg')">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 't')">t</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'lb')">lb</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'st')">st</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'US ton')">US ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'long ton')">long ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'earth')">earth</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('second_unit', 'sun')">sun</p>
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang[7] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['answer'], 4) ?> {{ $lang['9'] }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12 my-3"><strong><?= $lang[8] ?></strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang['10'] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['answer'] * 3600, 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang['11'] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['answer'] * 60, 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang['12'] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['answer']  / 24, 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang['13'] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['answer']  / 168, 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang['14'] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['answer']  / 730, 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang['15'] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['answer']  / 8760, 4) ?></strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12">&nbsp;</p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang[16] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['sub_answer'], 4) ?> {{ $lang['9'] }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12 my-3"><strong><?= $lang[8] ?></strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang['10'] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['sub_answer'] * 3600, 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang['11'] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['sub_answer'] * 60, 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang['12'] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['sub_answer']  / 24, 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang['13'] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['sub_answer']  / 168, 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang['14'] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['sub_answer']  / 730, 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang['15'] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue"><?= round($detail['sub_answer']  / 8760, 4) ?></strong></td>
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
@push('calculatorJS')
    
@endpush