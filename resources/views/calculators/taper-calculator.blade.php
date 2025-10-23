<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
                
            <div class="col-lg-6 pe-lg-4">
                <div class="col-12 px-2 mt-0 mt-lg-2">
                    <label for="major" class="label py-2">({{ $lang['1'] }}):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="major" id="major" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['major']) ? $_POST['major'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="major_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('major_unit_dropdown')">{{ isset($_POST['major_unit'])?$_POST['major_unit']:'m' }} ▾</label>
                        <input type="text" name="major_unit" value="{{ isset($_POST['major_unit'])?$_POST['major_unit']:'m' }}" id="major_unit" class="hidden">
                        <div id="major_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="major_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('major_unit', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('major_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('major_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('major_unit', 'ft')">feet (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('major_unit', 'in')">inches (in)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 px-2 mt-0 mt-lg-2">
                    <label for="minor" class="label py-2">({{ $lang['2'] }}):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="minor" id="minor" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['minor']) ? $_POST['minor'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="minor_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('minor_unit_dropdown')">{{ isset($_POST['minor_unit'])?$_POST['minor_unit']:'m' }} ▾</label>
                        <input type="text" name="minor_unit" value="{{ isset($_POST['minor_unit'])?$_POST['minor_unit']:'m' }}" id="minor_unit" class="hidden">
                        <div id="minor_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="minor_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('minor_unit', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('minor_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('minor_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('minor_unit', 'ft')">feet (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('minor_unit', 'in')">inches (in)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 px-2 mt-0 mt-lg-2">
                    <label for="length" class="label py-2">({{ $lang['3'] }}):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'m' }} ▾</label>
                        <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'m' }}" id="length_unit" class="hidden">
                        <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'ft')">feet (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'in')">inches (in)</p>
                        </div>
                     </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-4 text-center flex items-center mt-lg-0 mt-3">
                <img src="{{asset('images/taper_new.webp')}}" alt="skirt" class="mt-lg-5 max-width" width="500px" height="80x">
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
                    <div class="w-full my-2">
                        <div class="col-lg-6 font-s-18">
                            <table class="w-100">
                                <p class="font-s-20 mb-2 mt-1"><strong>{{$lang['4']}} (θ)</strong></p>
                                <tr>
                                    <td width="80%" class="border-b py-2">{{round($detail['answer'], 4)}} :</td>
                                    <td class="border-b py-2">deg</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{round($detail['answer_rad'], 4)}} :</td>
                                    <td class="border-b py-2">red</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{round($detail['answer_gon'], 4)}} :</td>
                                    <td class="border-b py-2">gon</td>
                                </tr>
                            </table>
                            <table class="w-100">
                                <p class="font-s-20 mt-3 mb-2"><strong>{{$lang['5']}} (T)</strong></p>
                                <tr>
                                    <td width="80%" class="border-b py-2">{{round($detail['main'], 4)}} :</td>
                                    <td class="border-b py-2">in</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{round($detail['main_cm'], 4)}} :</td>
                                    <td class="border-b py-2">cm</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{round($detail['main_m'], 4)}} :</td>
                                    <td class="border-b py-2">m</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{round($detail['main_mm'], 4)}} :</td>
                                    <td class="border-b py-2">mm</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{round($detail['main_ft'], 4)}} :</td>
                                    <td class="border-b py-2">ft</td>
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