@php
    if (isset($_POST['submit'])) {
        $f_height = $_POST['f_height'];
        $f_radius = $_POST['f_radius'];
        $s_height = $_POST['s_height'];
        $external = $_POST['external'];
        $internal = $_POST['internal'];
        $f_radius_units = $_POST['f_radius_units'];
        $external_units = $_POST['external_units'];
        $f_height_units = $_POST['f_height_units'];
        $s_height_units = $_POST['s_height_units'];
        $internal_units = $_POST['internal_units'];
    } elseif (isset($_GET['res_link'])) {
        $f_height = $_GET['f_height'];
        $f_height_units = $_GET['f_height_units'];
        $f_radius = $_GET['f_radius'];
        $f_radius_units = $_GET['f_radius_units'];
        $s_height = $_GET['s_height'];
        $s_height_units = $_GET['s_height_units'];
        $external = $_GET['external'];
        $external_units = $_GET['external_units'];
        $internal = $_GET['internal'];
        $internal_units = $_GET['internal_units'];
    }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 mt-2 gap-4">
                <p class="mt-2"><strong class="text-blue">{{ $lang['1'] }}</strong></p>
            </div>
            <div class="grid grid-cols-1 mt-4  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="f_height" class="font-s-14 text-blue">{{ $lang['2'] }} :</label>
                    <div class="relative w-full ">
                        <input type="number" name="f_height" id="f_height" step="any"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                            value="{{ isset($_POST['f_height']) ? $_POST['f_height'] : '3' }}" aria-label="input"
                            placeholder="00" oninput="checkInput()" />
                        <label for="f_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('f_height_units_dropdown')">{{ isset($_POST['f_height_units']) ? $_POST['f_height_units'] : 'mm' }}
                            ▾</label>
                        <input type="text" name="f_height_units"
                            value="{{ isset($_POST['f_height_units']) ? $_POST['f_height_units'] : 'mm' }}"
                            id="f_height_units" class="hidden">
                        <div id="f_height_units_dropdown"
                            class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_height_units', 'cm')">
                                centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_height_units', 'mm')">
                                milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_height_units', 'm')">
                                meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_height_units', 'in')">
                                inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_height_units', 'ft')">
                                feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_height_units', 'km')">
                                kilometer (km)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_height_units', 'mi')">
                                miles (mi)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_height_units', 'yd')">
                                yard (yd)</p>

                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="f_radius" class="font-s-14 text-blue">{{ $lang['3'] }} :</label>
                    <div class="relative w-full ">
                        <input type="number" name="f_radius" id="f_radius" step="any"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                            value="{{ isset($_POST['f_radius']) ? $_POST['f_radius'] : '5' }}" aria-label="input"
                            placeholder="00" oninput="checkInput()" />
                        <label for="f_radius_units" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('f_radius_units_dropdown')">{{ isset($_POST['f_radius_units']) ? $_POST['f_radius_units'] : 'cm' }}
                            ▾</label>
                        <input type="text" name="f_radius_units"
                            value="{{ isset($_POST['f_radius_units']) ? $_POST['f_radius_units'] : 'cm' }}"
                            id="f_radius_units" class="hidden">
                        <div id="f_radius_units_dropdown"
                            class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_radius_units', 'cm')">
                                centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_radius_units', 'mm')">
                                milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_radius_units', 'm')">
                                meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_radius_units', 'in')">
                                inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_radius_units', 'ft')">
                                feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_radius_units', 'km')">
                                kilometer (km)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_radius_units', 'mi')">
                                miles (mi)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_radius_units', 'yd')">
                                yard (yd)</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-4    gap-4">
                <p class="mt-2"><strong class="text-blue">{{ $lang['4'] }}</strong></p>
            </div>
            <div class="grid grid-cols-1 mt-4  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="s_height" class="font-s-14 text-blue">{{ $lang['2'] }} :</label>
                    <div class="relative w-full ">
                        <input type="number" name="s_height" id="s_height" step="any"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                            value="{{ isset($_POST['s_height']) ? $_POST['s_height'] : '5' }}" aria-label="input"
                            placeholder="00" oninput="checkInput()" />
                        <label for="s_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('s_height_units_dropdown')">{{ isset($_POST['s_height_units']) ? $_POST['s_height_units'] : 'mm' }}
                            ▾</label>
                        <input type="text" name="s_height_units"
                            value="{{ isset($_POST['s_height_units']) ? $_POST['s_height_units'] : 'mm' }}"
                            id="s_height_units" class="hidden">
                        <div id="s_height_units_dropdown"
                            class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_height_units', 'cm')">
                                centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_height_units', 'mm')">
                                milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_height_units', 'm')">
                                meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_height_units', 'in')">
                                inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_height_units', 'ft')">
                                feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_height_units', 'km')">
                                kilometer (km)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_height_units', 'mi')">
                                miles (mi)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_height_units', 'yd')">
                                yard (yd)</p>

                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="external" class="font-s-14 text-blue">{{ $lang['5'] }} :</label>
                    <div class="relative w-full ">
                        <input type="number" name="external" id="external" step="any"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                            value="{{ isset($_POST['external']) ? $_POST['external'] : '15' }}" aria-label="input"
                            placeholder="00" oninput="checkInput()" />
                        <label for="external_units" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('external_units_dropdown')">{{ isset($_POST['external_units']) ? $_POST['external_units'] : 'm' }}
                            ▾</label>
                        <input type="text" name="external_units"
                            value="{{ isset($_POST['external_units']) ? $_POST['external_units'] : 'm' }}"
                            id="external_units" class="hidden">
                        <div id="external_units_dropdown"
                            class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('external_units', 'cm')">
                                centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('external_units', 'mm')">
                                milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('external_units', 'm')">
                                meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('external_units', 'in')">
                                inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('external_units', 'ft')">
                                feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('external_units', 'km')">
                                kilometer (km)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('external_units', 'mi')">
                                miles (mi)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('external_units', 'yd')">
                                yard (yd)</p>

                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="internal" class="font-s-14 text-blue">{{ $lang['6'] }} :</label>
                    <div class="relative w-full ">
                        <input type="number" name="internal" id="internal" step="any"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                            value="{{ isset($_POST['internal']) ? $_POST['internal'] : '6' }}" aria-label="input"
                            placeholder="00" oninput="checkInput()" />
                        <label for="internal_units" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('internal_units_dropdown')">{{ isset($_POST['internal_units']) ? $_POST['internal_units'] : 'mm' }}
                            ▾</label>
                        <input type="text" name="internal_units"
                            value="{{ isset($_POST['internal_units']) ? $_POST['internal_units'] : 'mm' }}"
                            id="internal_units" class="hidden">
                        <div id="internal_units_dropdown"
                            class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('internal_units', 'cm')">
                                centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('internal_units', 'mm')">
                                milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('internal_units', 'm')">
                                meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('internal_units', 'in')">
                                inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('internal_units', 'ft')">
                                feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('internal_units', 'km')">
                                kilometer (km)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('internal_units', 'mi')">
                                miles (mi)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('internal_units', 'yd')">
                                yard (yd)</p>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        @if ($type == 'calculator')
            @include('inc.button')
        @endif
        @if ($type == 'widget')
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
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                    <table class="w-100">
                                        <tr>
                                            <td width="70%" class="border-b py-2"><strong>{{ $lang['7'] }}
                                                    :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['vol1'], 2) }} cm³</td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="mt-3 mb-2 font-s-18">{{ $lang['8'] }}</p>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                    <table class="w-100">
                                        <tr>
                                            <td width="70%" class="border-b py-2">mm³ :</td>
                                            <td class="border-b py-2">{{ round($detail['vol1'] * 1000, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">dm³ :</td>
                                            <td class="border-b py-2">{{ round($detail['vol1'] / 1000, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">m³ :</td>
                                            <td class="border-b py-2">{{ round($detail['vol1'] / 1000000, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">cu in :</td>
                                            <td class="border-b py-2">{{ round($detail['vol1'] * 0.0610237, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">cu ft :</td>
                                            <td class="border-b py-2">{{ round($detail['vol1'] * 0.0000353147, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                    <table class="w-100">
                                        <tr>
                                            <td width="70%" class="border-b pt-4 pb-2"><strong>{{ $lang['9'] }}
                                                    :</strong></td>
                                            <td class="border-b pt-4 pb-2">{{ round($detail['vol2'], 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="mt-3 mb-2 font-s-18">{{ $lang['10'] }}</p>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                    <table class="w-100">
                                        <tr>
                                            <td width="70%" class="border-b py-2">mm³ :</td>
                                            <td class="border-b py-2">{{ round($detail['vol2'] * 1000, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">dm³ :</td>
                                            <td class="border-b py-2">{{ round($detail['vol2'] / 1000, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">m³ :</td>
                                            <td class="border-b py-2">{{ round($detail['vol2'] / 1000000, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">cu in :</td>
                                            <td class="border-b py-2">{{ round($detail['vol2'] * 0.0610237, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">cu ft :</td>
                                            <td class="border-b py-2">{{ round($detail['vol2'] * 0.0000353147, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="mt-1">
                                    <p class="font-s-20 mt-2"><strong>Solution</strong></p>
                                    <p class="mt-2">{{ $lang['12'] }}</p>
                                    <p class="mt-2">V = <i>πr²h</i></p>
                                    <p class="mt-2">V =<i> 3.14 x {{ $f_radius }}² x {{ $f_height }}</i></p>
                                    <p class="mt-2">V = {{ round($detail['vol1'], 2) }} cm³</p>
                                    <p class="mt-2">{{ $lang['13'] }}</p>
                                    <p class="mt-2">V = <i>πh(R² - r²)</i></p>
                                    <p class="mt-2">V = <i>3.14 x {{ $s_height }} ({{ $external }}² -
                                            {{ $internal }}²)</i> </p>
                                    <p class="mt-2">V = {{ round($detail['vol2'], 2) }} cm³</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
