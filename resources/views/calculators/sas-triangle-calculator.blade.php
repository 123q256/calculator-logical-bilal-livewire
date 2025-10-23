<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="first" class="font-s-14 text-blue">a</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'m' }} ▾</label>
                        <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'m' }}" id="unit1" class="hidden">
                        <div id="unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit1">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'ft')">feets (ft)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="second" class="font-s-14 text-blue">b</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit2_dropdown')">{{ isset($_POST['unit2'])?$_POST['unit2']:'cm' }} ▾</label>
                        <input type="text" name="unit2" value="{{ isset($_POST['unit2'])?$_POST['unit2']:'cm' }}" id="unit2" class="hidden">
                        <div id="unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit2">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'ft')">feets (ft)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="third" class="font-s-14 text-blue">Y</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third']) ? $_POST['third'] : '2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit3_dropdown')">{{ isset($_POST['unit3'])?$_POST['unit3']:'pi' }} ▾</label>
                        <input type="text" name="unit3" value="{{ isset($_POST['unit3'])?$_POST['unit3']:'pi' }}" id="unit3" class="hidden">
                        <div id="unit3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit3">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'pi')">pi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'deg')">degree (deg)</p>
                            <p value="pi">pi</p>
                            <p value="deg">degree (deg)</p>
                        </div>
                     </div>
                </div>
            </div>
            <div class="col-span-6 text-center flex justify-center items-center">
                <img src="{{ asset('images/sas_image.webp') }}" width="175" height="100%" alt="SAS Triangle" loading="lazy" decoding="async">
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
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>Side (c)</strong></td>
                                    <td class="py-2 border-b">{{$detail['c']}} cm</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang[5]}} ∠A (α)</strong></td>
                                    <td class="py-2 border-b">{{round($detail['alpha'], 4)}}<sup class="font-s-14">°</sup></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang[5]}} ∠B (β)</strong></td>
                                    <td class="py-2 border-b">{{round($detail['beta'], 4)}}<sup class="font-s-14">°</sup></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>Area</strong></td>
                                    <td class="py-2 border-b">{{$detail['t']}} cm²</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang[3]}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['p']}} cm</td>
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