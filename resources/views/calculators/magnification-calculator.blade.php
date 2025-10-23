<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="d" class="font-s-14 text-blue">{{ $lang['focus_d'] }} (d):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="d" id="d" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['d']) ? $_POST['d'] : '100' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="d_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('d_unit_dropdown')">{{ isset($_POST['d_unit'])?$_POST['d_unit']:'cm' }} ▾</label>
                        <input type="text" name="d_unit" value="{{ isset($_POST['d_unit'])?$_POST['d_unit']:'cm' }}" id="d_unit" class="hidden">
                        <div id="d_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="d_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'mi')">miles (mi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="f" class="font-s-14 text-blue">{{ $lang['focal_d'] }} (f):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="f" id="f" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f']) ? $_POST['f'] : '25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['f_unit'])?$_POST['f_unit']:'cm' }} ▾</label>
                        <input type="text" name="f_unit" value="{{ isset($_POST['f_unit'])?$_POST['f_unit']:'cm' }}" id="f_unit" class="hidden">
                        <div id="f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'mi')">miles (mi)</p>
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
                        <div class="w-full my-2">
                            <div class="w-full md:w-[60%] lg:w-[60%] ">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="border-b py-2">
                                            <strong>{{ $lang['magnification'] }} :</strong></td>
                                        <td class="border-b py-2">{{ $detail['m'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">
                                            <strong>{{ $lang['o_d'] }} :</strong></td>
                                        <td class="border-b py-2">{{ $detail['g'] }} m</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">
                                            <strong>{{ $lang['s_d'] }} :</strong></td>
                                        <td class="border-b py-2">{{ $detail['h'] }} m</td>
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