<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="col-lg-7 mb-3 px-2 mx-auto">
                <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                    <input type="hidden" name="type" id="type"
                        value="{{ isset($_POST['type']) ? $_POST['type'] : 'velocity' }}">
                    <div
                        class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial"
                                id="tab1">
                                {{ $lang['1'] }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric"
                                id="tab2">
                                {{ $lang['2'] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 mt-3  gap-4">

                    <div id="linear" class="col-span-12">
                        <div class="row">
                            <strong class="col-span-12">{{ $lang[3] }}:</strong>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 mb-3 mt-3 flex items-center">
                                @if (isset($_POST['to_cal']))
                                    @if ($_POST['to_cal'] == 'mom')
                                        <input name="to_cal" id="to_cal" class="kin_ mx-1" value="mom"
                                            type="radio" checked />
                                    @else
                                        <input name="to_cal" id="to_cal" class="kin_ mx-1" value="mom"
                                            type="radio" />
                                    @endif
                                @else
                                    <input name="to_cal" id="to_cal" class="kin_ mx-1" value="mom" type="radio"
                                        checked />
                                @endif
                                <label for="to_cal" class="font-s-14 text-blue px-1">{{ $lang['4'] }}</label>
                                @if (isset($_POST['to_cal']) && $_POST['to_cal'] == 'mass')
                                    <input name="to_cal" id="to_cal1" class="mass_ ms-2" value="mass"
                                        type="radio" checked />
                                @else
                                    <input name="to_cal" id="to_cal1" class="mass_ ms-2" value="mass"
                                        type="radio" />
                                @endif
                                <label for="to_cal1" class="font-s-14 text-blue px-1">{{ $lang['5'] }}</label>
                                @if (isset($_POST['to_cal']) && $_POST['to_cal'] == 'velo')
                                    <input name="to_cal" id="to_cal2" class="velo_ ms-2" value="velo"
                                        type="radio" checked />
                                @else
                                    <input name="to_cal" id="to_cal2" class="velo_ ms-2" value="velo"
                                        type="radio" />
                                @endif
                                <label for="to_cal2" class="font-s-14 text-blue ps-1">{{ $lang['6'] }}</label>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 mass">
                                <label for="mass" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="mass" id="mass" step="any"
                                        class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                        value="{{ isset($_POST['mass']) ? $_POST['mass'] : '12' }}" aria-label="input"
                                        placeholder="00" oninput="checkInput()" />
                                    <label for="unit_m"
                                        class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        onclick="toggleDropdown('unit_m_dropdown')">{{ isset($_POST['unit_m']) ? $_POST['unit_m'] : 'kg' }}
                                        ▾</label>
                                    <input type="text" name="unit_m"
                                        value="{{ isset($_POST['unit_m']) ? $_POST['unit_m'] : 'kg' }}" id="unit_m"
                                        class="hidden">
                                    <div id="unit_m_dropdown"
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                        to="unit_m">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_m', 'kg')">kg</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_m', 'mg')">mg</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_m', 'g')">g</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_m', 'lbs')">lbs</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 velocity">
                                <label for="velocity" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="velocity" id="velocity" step="any"
                                        class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                        value="{{ isset($_POST['velocity']) ? $_POST['velocity'] : '12' }}"
                                        aria-label="input" placeholder="00" oninput="checkInput()" />
                                    <label for="unit_v"
                                        class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        onclick="toggleDropdown('unit_v_dropdown')">{{ isset($_POST['unit_v']) ? $_POST['unit_v'] : 'miles/s' }}
                                        ▾</label>
                                    <input type="text" name="unit_v"
                                        value="{{ isset($_POST['unit_v']) ? $_POST['unit_v'] : 'miles/s' }}"
                                        id="unit_v" class="hidden">
                                    <div id="unit_v_dropdown"
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                        to="unit_v">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_v', 'miles/s')">miles/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_v', 'km/s')">km/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_v', 'm/s')">m/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_v', 'in/s')">in/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_v', 'yd/s')">yd/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_v', 'km/h')">km/h</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_v', 'm/h')">m/h</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden kin">
                                <label for="mom" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="mom" id="mom" step="any"
                                        class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                        value="{{ isset($_POST['mom']) ? $_POST['mom'] : '13' }}" aria-label="input"
                                        placeholder="00" oninput="checkInput()" />
                                    <label for="unit_k"
                                        class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        onclick="toggleDropdown('unit_k_dropdown')">{{ isset($_POST['unit_k']) ? $_POST['unit_k'] : 'kg-ms' }}
                                        ▾</label>
                                    <input type="text" name="unit_k"
                                        value="{{ isset($_POST['unit_k']) ? $_POST['unit_k'] : 'kg-ms' }}" id="unit_k"
                                        class="hidden">
                                    <div id="unit_k_dropdown"
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                        to="unit_k">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_k', 'kg-ms')">kg-ms</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_k', 'Ns')">Ns</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_k', 'Nm')">Nm</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_k', 'Nh')">Nh</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_k', 'lb-ft')">lb-ft</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="rotational" class="col-span-12 hidden">
                        <div class="row">
                            <strong class="col-span-12">{{ $lang[3] }}:</strong>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 mb-3 mt-3 flex items-center">
                                @if (isset($_POST['to_calr']))
                                    @if ($_POST['to_calr'] == 'mom_t')
                                        <input name="to_calr" id="to_calr" class="kin_r mx-1" value="mom_t"
                                            type="radio" checked />
                                    @else
                                        <input name="to_calr" id="to_calr" class="kin_r mx-1" value="mom_t"
                                            type="radio" />
                                    @endif
                                @else
                                    <input name="to_calr" id="to_calr" class="kin_r mx-1" value="mom_t"
                                        type="radio" checked />
                                @endif
                                <label for="to_calr" class="font-s-14 text-blue px-1">{{ $lang['4'] }}</label>
                                @if (isset($_POST['to_calr']) && $_POST['to_calr'] == 'force')
                                    <input name="to_calr" id="to_calr1" class="mass_r ms-2" value="force"
                                        type="radio" checked />
                                @else
                                    <input name="to_calr" id="to_calr1" class="mass_r ms-2" value="force"
                                        type="radio" />
                                @endif
                                <label for="to_calr1" class="font-s-14 text-blue px-1">{{ $lang['7'] }}
                                    (F)</label>
                                @if (isset($_POST['to_calr']) && $_POST['to_calr'] == 'time_c')
                                    <input name="to_calr" id="to_calr2" class="velo_r ms-2" value="time_c"
                                        type="radio" checked />
                                @else
                                    <input name="to_calr" id="to_calr2" class="velo_r ms-2" value="time_c"
                                        type="radio" />
                                @endif
                                <label for="to_calr2" class="font-s-14 text-blue ps-1">{{ $lang['8'] }}
                                    (ΔT)</label>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden r_kin">
                                <label for="mom_t" class="font-s-14 text-blue">{{ $lang['4'] }} (p):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="mom_t" id="mom_t" step="any"
                                        class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                        value="{{ isset($_POST['mom_t']) ? $_POST['mom_t'] : '13' }}"
                                        aria-label="input" placeholder="00" oninput="checkInput()" />
                                    <label for="unit_mt"
                                        class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        onclick="toggleDropdown('unit_mt_dropdown')">{{ isset($_POST['unit_mt']) ? $_POST['unit_mt'] : 'kg-ms' }}
                                        ▾</label>
                                    <input type="text" name="unit_mt"
                                        value="{{ isset($_POST['unit_mt']) ? $_POST['unit_mt'] : 'kg-ms' }}"
                                        id="unit_mt" class="hidden">
                                    <div id="unit_mt_dropdown"
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                        to="unit_mt">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_mt', 'kg-ms')">kg m/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_mt', 'Ns')">N-s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_mt', 'Nm')">N-min</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_mt', 'Nh')">N-h</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_mt', 'lb-ft')">lb-ft/s</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 moment">
                                <label for="force" class="font-s-14 text-blue">{{ $lang['7'] }} (F):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="force" id="force" step="any"
                                        class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                        value="{{ isset($_POST['force']) ? $_POST['force'] : '20' }}"
                                        aria-label="input" placeholder="00" oninput="checkInput()" />
                                    <label for="unit_i"
                                        class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        onclick="toggleDropdown('unit_i_dropdown')">{{ isset($_POST['unit_i']) ? $_POST['unit_i'] : 'N' }}
                                        ▾</label>
                                    <input type="text" name="unit_i"
                                        value="{{ isset($_POST['unit_i']) ? $_POST['unit_i'] : 'N' }}" id="unit_i"
                                        class="hidden">
                                    <div id="unit_i_dropdown"
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                        to="unit_i">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_i', 'N')">N</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_i', 'KN')">KN</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_i', 'MN')">MN</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 a_velocity">
                                <label for="time" class="font-s-14 text-blue">{{ $lang['8'] }} (ΔT):</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="time" id="time" step="any"
                                        class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                        value="{{ isset($_POST['time']) ? $_POST['time'] : '20' }}"
                                        aria-label="input" placeholder="00" oninput="checkInput()" />
                                    <label for="unit_t"
                                        class="absolute cursor-pointer text-sm underline right-6 top-4"
                                        onclick="toggleDropdown('unit_t_dropdown')">{{ isset($_POST['unit_t']) ? $_POST['unit_t'] : 's' }}
                                        ▾</label>
                                    <input type="text" name="unit_t"
                                        value="{{ isset($_POST['unit_t']) ? $_POST['unit_t'] : 's' }}" id="unit_t"
                                        class="hidden">
                                    <div id="unit_t_dropdown"
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                        to="unit_t">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_t', 's')">s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_t', 'min')">min</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            onclick="setUnit('unit_t', 'h')">h</p>
                                    </div>
                                </div>
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
                            <div class="w-full">
                                @php
                                    $request = request();
                                @endphp
                                <?php if(isset($detail['mom'])){ ?>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['4'] ?> (p)</td>
                                            <td class="py-2 border-b"><strong><?= $detail['mom'] ?> (N-s) kg m/s</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="col-12 mt-3 text-[18px]"><strong>{{ $lang[9] }}</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['4'] ?> (p)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['mom'] * 0.01666667, 5) ?>
                                                    N-min</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['4'] ?> (p)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['mom'] * 0.000277778, 5) ?>
                                                    N-h</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['4'] ?> (p)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['mom'] * 0.22482, 5) ?>
                                                    lb-ft/s</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <?php } ?>
                                <?php if(isset($detail['mass'])){ ?>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['5'] ?> (m)</td>
                                            <td class="py-2 border-b"><strong><?= $detail['mass'] ?> kg</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="col-12 mt-3 text-[18px]"><strong>{{ $lang[9] }}</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['5'] ?> (m)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['mass'] * 2.20462, 5) ?>
                                                    lbs</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['5'] ?> (m)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['mass'] * 1000, 5) ?>
                                                    g</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['5'] ?> (m)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['mass'] * 1000000, 5) ?>
                                                    mg</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <?php } ?>
                                <?php if(isset($detail['velo'])){ ?>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['6'] ?> (v)</td>
                                            <td class="py-2 border-b"><strong><?= $detail['velo'] ?> m/s</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="col-12 mt-3 text-[18px]"><strong>{{ $lang[9] }}</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['6'] ?> (v)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['velo'] / 1609, 5) ?>
                                                    miles/s</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['6'] ?> (v)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['velo'] / 1000, 5) ?>
                                                    km/s</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['6'] ?> (v)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['velo'] * 3.281, 5) ?>
                                                    ft/s</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['6'] ?> (v)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['velo'] * 39.37, 5) ?>
                                                    in/s</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['6'] ?> (v)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['velo'] * 1.094, 5) ?>
                                                    yd/s</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['6'] ?> (v)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['velo'] * 3.6, 5) ?>
                                                    km/h</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['6'] ?> (v)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['velo'] * 2.237, 5) ?>
                                                    m/h</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <?php } ?>
                                <?php if(isset($detail['momt'])){ ?>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['4'] ?> (p)</td>
                                            <td class="py-2 border-b"><strong><?= $detail['momt'] ?> (N-s) kg m/s</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="col-12 mt-3 text-[18px]"><strong>{{ $lang[9] }}</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['4'] ?> (p)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['momt'] * 0.01666667, 5) ?>
                                                    N-min</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['4'] ?> (p)</td>
                                            <td class="py-2 border-b">
                                                <strong><?= round($detail['momt'] * 0.000277778, 5) ?> N-h</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['4'] ?> (p)</td>
                                            <td class="py-2 border-b"><strong><?= round($detail['momt'] * 0.22482, 5) ?>
                                                    lb-ft/s</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <?php } ?>
                                <?php if(isset($detail['forcet'])){ ?>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['7'] ?> (F)</td>
                                            <td class="py-2 border-b"><strong><?= $detail['forcet'] ?> N</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="col-12 mt-3 text-[18px]"><strong>{{ $lang[9] }}</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['7'] ?> (F)</td>
                                            <td class="py-2 border-b"><strong><?= $detail['forcet'] / 1e3 ?> KN</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b">Mass</td>
                                            <td class="py-2 border-b"><strong><?= $detail['forcet'] / 1e6 ?> MN</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <?php } ?>
                                <?php if(isset($detail['time'])){ ?>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['8'] ?> (ΔT)</td>
                                            <td class="py-2 border-b"><strong><?= $detail['time'] ?> s</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="col-12 mt-3 text-[18px]"><strong>{{ $lang[9] }}</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['8'] ?> (ΔT)</td>
                                            <td class="py-2 border-b"><strong><?= round($_POST['time'] * 60, 6) ?>
                                                    min</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?= $lang['8'] ?> (ΔT)</td>
                                            <td class="py-2 border-b"><strong><?= round($_POST['time'] * 60 * 60, 6) ?>
                                                    h</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
    
</form>
@push('calculatorJS')
    <script>
        @if (isset($_POST['type']) && $_POST['type'] == 'velocity')
            document.getElementById('tab1').click();
        @endif
        @if (isset($_POST['type']) && $_POST['type'] == 'rotational')
            document.getElementById('tab2').click();
        @endif
        document.getElementById('tab1').addEventListener('click', function() {
            document.getElementById('type').value = 'velocity';
            this.classList.add('tagsUnit');
            document.getElementById('tab2').classList.remove('tagsUnit');
            document.querySelectorAll('#linear').forEach(el => el.style.display = 'block');
            document.querySelectorAll('#rotational').forEach(el => el.style.display = 'none');
        });

        // Event listener for tab2 click
        document.getElementById('tab2').addEventListener('click', function() {
            document.getElementById('type').value = 'rotational';
            this.classList.add('tagsUnit');
            document.getElementById('tab1').classList.remove('tagsUnit');
            document.querySelectorAll('#rotational').forEach(el => el.style.display = 'block');
            document.querySelectorAll('#linear').forEach(el => el.style.display = 'none');
        });
        // Function to show and hide elements based on class names
        function toggleVisibility(showSelectors, hideSelectors) {
            showSelectors.forEach(selector => {
                document.querySelectorAll(selector).forEach(element => {
                    element.style.display = 'block';
                });
            });

            hideSelectors.forEach(selector => {
                document.querySelectorAll(selector).forEach(element => {
                    element.style.display = 'none';
                });
            });
        }

        // Event listeners for kin, mass, and velocity buttons
        document.querySelector('.kin_').addEventListener('click', () => {
            toggleVisibility(['.mass', '.velocity'], ['.kin']);
        });
        document.querySelector('.mass_').addEventListener('click', () => {
            toggleVisibility(['.kin', '.velocity'], ['.mass']);
        });
        document.querySelector('.velo_').addEventListener('click', () => {
            toggleVisibility(['.kin', '.mass'], ['.velocity']);
        });
        // Event listeners for rotational kin, mass, and velocity buttons
        document.querySelector('.kin_r').addEventListener('click', () => {
            toggleVisibility(['.moment', '.a_velocity'], ['.r_kin']);
        });
        document.querySelector('.mass_r').addEventListener('click', () => {
            toggleVisibility(['.r_kin', '.a_velocity'], ['.moment']);
        });
        document.querySelector('.velo_r').addEventListener('click', () => {
            toggleVisibility(['.r_kin', '.moment'], ['.a_velocity']);
        });
        @if (isset($_POST['to_cal']) && $_POST['to_cal'] == 'mom')
            document.querySelector('.kin_').click();
        @endif
        @if (isset($_POST['to_cal']) && $_POST['to_cal'] == 'mass')
            document.querySelector('.mass_').click();
        @endif
        @if (isset($_POST['to_cal']) && $_POST['to_cal'] == 'velo')
            document.querySelector('.velo_').click();
        @endif

        @if (isset($_POST['to_calr']) && $_POST['to_calr'] == 'mom_t')
            document.querySelector('.kin_r').click();
        @endif
        @if (isset($_POST['to_calr']) && $_POST['to_calr'] == 'force')
            document.querySelector('.mass_r').click();
        @endif
        @if (isset($_POST['to_calr']) && $_POST['to_calr'] == 'time_c')
            document.querySelector('.velo_r').click();
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>