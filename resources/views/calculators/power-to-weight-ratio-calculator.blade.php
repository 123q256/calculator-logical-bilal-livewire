<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="power" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="power" id="power" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['power'])?$_POST['power']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="power_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('power_unit_dropdown')">{{ isset($_POST['power_unit'])?$_POST['power_unit']:'W' }} ▾</label>
                        <input type="text" name="power_unit" value="{{ isset($_POST['power_unit'])?$_POST['power_unit']:'W' }}" id="power_unit" class="hidden">
                        <div id="power_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'W')">W</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'kW')">kW</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'hpl')">hp(l)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'hpm')">hp(M)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'js')">j/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'kjs')">kj/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'nms')">Nm/s</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="weight" id="weight" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight'])?$_POST['weight']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'g' }} ▾</label>
                        <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'g' }}" id="weight_unit" class="hidden">
                        <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'g')">g</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 't')">t</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'oz')">oz</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lb')">lb</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'us')">US (ton)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'long')">Long (ton)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'mg')">mg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'gr')">gr</p>
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
                    <div class="w-full bg-light-blue  p-3 rounded-lg mt-3">
                        <div class="w-full lg:w-10/12 mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b w-7/12"><strong>{{ $lang[3] }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['answer'], 2) }} (kW/kg)</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full lg:w-10/12 mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b w-7/12"><strong>{{ $lang[4] }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['answer'] * 1000, 2) }} (W/kg)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-7/12"><strong>{{ $lang[5] }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['answer'] * 0.608, 2) }} (hp(l)/lb)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-7/12"><strong>{{ $lang[6] }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['answer'] * 1.34, 2) }} (hp(l)/kg)</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>