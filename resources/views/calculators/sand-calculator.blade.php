<style>
    .current_input {
        display: none;
        transition: display 0.5s ease-in-out;
    }

    .button {
        transform: rotate(360deg);
        transition: .5s ease-in-out;
    }

    .show {
        display: flex;
    }

    .rotate {
        transform: rotate(180deg);
    }
</style>

<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">
                <div class="col-span-12">
                    <label for="shape" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <select name="shape" id="shape" class="input">
                            <option value="0"
                                {{ isset($_POST['shape']) && $_POST['shape'] == '0' ? 'selected' : '' }}>
                                {{ $lang['2'] }}</option>
                            <option value="1"
                                {{ isset($_POST['shape']) && $_POST['shape'] == '1' ? 'selected' : '' }}>
                                {{ $lang['3'] }}</option>
                        </select>
                    </div>
                </div>
                <div
                    class="col-span-12 chose {{ isset($_POST['shape']) && $_POST['shape'] !== '0' ? 'hidden' : 'd-block' }}">
                    <div class="grid grid-cols-12 mt-3  gap-2">
                        <div class="col-span-6 ">
                            <input type="radio" name="g" id="g1" value="g1" checked
                                {{ isset($_POST['check']) && $_POST['check'] === 'g1' ? 'checked' : '' }}>
                            <label for="g1" class="label pe-lg-3 pe-2">{{ $lang['4'] }}:</label>
                        </div>
                        <div class="col-span-6">
                            <input type="radio" name="g" id="g2" value="g2"
                                {{ isset($_POST['check']) && $_POST['check'] === 'g2' ? 'checked' : '' }}>
                            <label for="g2" class="label pe-lg-3 pe-2">{{ $lang['5'] }}:</label>
                        </div>
                        <div class="col-span-12 ">
                            <input type="radio" name="g" id="g3" value="g3"
                                {{ isset($_POST['check']) && $_POST['check'] === 'g3' ? 'checked' : '' }}>
                            <label for="g3" class="label">{{ $lang['6'] }}:</label>
                            <input type="hidden" name="check" id="check" value="g1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-6 pe-lg-3">
                    <div
                        class="col-span-12 length {{ isset($_POST['shape']) && $_POST['shape'] !== '0' ? 'hidden' : 'd-block' }} {{ isset($_POST['check']) && $_POST['check'] !== 'g1' ? 'hidden' : 'd-block' }}">
                        <label for="length" class="label">{{ $lang['7'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="length" id="length" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                value="{{ isset($_POST['length']) ? $_POST['length'] : '24' }}" aria-label="input"
                                placeholder="00" oninput="checkInput()" />
                            <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit']) ? $_POST['length_unit'] : 'cm' }}
                                ▾</label>
                            <input type="text" name="length_unit"
                                value="{{ isset($_POST['length_unit']) ? $_POST['length_unit'] : 'cm' }}" id="length_unit"
                                class="hidden">
                            <div id="length_unit_dropdown"
                                class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                to="length_unit">
                                @foreach (['cm', 'm', 'in', 'ft', 'yd'] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('length_unit', '{{ $name }}')"> {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-span-12 width {{ isset($_POST['shape']) && $_POST['shape'] !== '0' ? 'hidden' : 'd-block' }} {{ isset($_POST['check']) && $_POST['check'] !== 'g1' ? 'hidden' : 'd-block' }}">
                        <label for="width" class="label">{{ $lang['8'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="width" id="width" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                value="{{ isset($_POST['width']) ? $_POST['width'] : '8' }}" aria-label="input"
                                placeholder="00" oninput="checkInput()" />
                            <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit']) ? $_POST['width_unit'] : 'cm' }}
                                ▾</label>
                            <input type="text" name="width_unit"
                                value="{{ isset($_POST['width_unit']) ? $_POST['width_unit'] : 'cm' }}" id="width_unit"
                                class="hidden">
                            <div id="width_unit_dropdown"
                                class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                to="width_unit">
                                @foreach (['cm', 'm', 'in', 'ft', 'yd'] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('width_unit', '{{ $name }}')"> {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-span-12 area {{ isset($_POST['check']) && $_POST['check'] === 'g2' ? 'd-block' : 'hidden' }}">
                        <label for="area" class="label">{{ $lang['9'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="area" id="area" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                value="{{ isset($_POST['area']) ? $_POST['area'] : '10' }}" aria-label="input"
                                placeholder="00" oninput="checkInput()" />
                            <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit']) ? $_POST['area_unit'] : 'mm²' }}
                                ▾</label>
                            <input type="text" name="area_unit"
                                value="{{ isset($_POST['area_unit']) ? $_POST['area_unit'] : 'mm²' }}" id="area_unit"
                                class="hidden">
                            <div id="area_unit_dropdown"
                                class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                to="area_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'mm²')">
                                    mm²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'cm²')">
                                    cm²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'm²')">
                                    m²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'in²')">
                                    in²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ft²')">
                                    ft²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'yd²')">
                                    yd²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('area_unit', 'hectares')"> hectares</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('area_unit', 'acres')"> acres</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('area_unit', 'soccer fields')"> soccer fields</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-span-12 volume {{ isset($_POST['check']) && $_POST['check'] === 'g3' ? 'd-block' : 'hidden' }}">
                        <label for="volume" class="label">{{ $lang['10'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="volume" id="volume" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                value="{{ isset($_POST['volume']) ? $_POST['volume'] : '15' }}" aria-label="input"
                                placeholder="00" oninput="checkInput()" />
                            <label for="volume_unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                onclick="toggleDropdown('volume_unit_dropdown')">{{ isset($_POST['volume_unit']) ? $_POST['volume_unit'] : 'mm³' }}
                                ▾</label>
                            <input type="text" name="volume_unit"
                                value="{{ isset($_POST['volume_unit']) ? $_POST['volume_unit'] : 'mm³' }}"
                                id="volume_unit" class="hidden">
                            <div id="volume_unit_dropdown"
                                class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                to="volume_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('volume_unit', 'mm³')"> mm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('volume_unit', 'cm³')"> cm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('volume_unit', 'm³')"> m³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('volume_unit', 'in³')"> in³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('volume_unit', 'ft³')"> ft³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('volume_unit', 'yd³')"> yd³</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-span-12 diameter {{ isset($_POST['shape']) && $_POST['shape'] === '1' ? 'd-block' : 'hidden' }}">
                        <label for="diameter" class="label">{{ $lang['11'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="diameter" id="diameter" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                value="{{ isset($_POST['diameter']) ? $_POST['diameter'] : '15' }}" aria-label="input"
                                placeholder="00" oninput="checkInput()" />
                            <label for="diameter_unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                onclick="toggleDropdown('diameter_unit_dropdown')">{{ isset($_POST['diameter_unit']) ? $_POST['diameter_unit'] : 'cm' }}
                                ▾</label>
                            <input type="text" name="diameter_unit"
                                value="{{ isset($_POST['diameter_unit']) ? $_POST['diameter_unit'] : 'cm' }}"
                                id="diameter_unit" class="hidden">
                            <div id="diameter_unit_dropdown"
                                class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                to="diameter_unit">
                                @foreach (['cm', 'm', 'in', 'ft', 'yd'] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('diameter_unit', '{{ $name }}')">
                                        {{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-span-12 depth {{ isset($_POST['check']) && $_POST['check'] === 'g3' ? 'hidden' : 'd-block' }}">
                        <label for="depth" class="label">{{ $lang['12'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="depth" id="depth" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                value="{{ isset($_POST['depth']) ? $_POST['depth'] : '10' }}" aria-label="input"
                                placeholder="00" oninput="checkInput()" />
                            <label for="depth_unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                onclick="toggleDropdown('depth_unit_dropdown')">{{ isset($_POST['depth_unit']) ? $_POST['depth_unit'] : 'cm' }}
                                ▾</label>
                            <input type="text" name="depth_unit"
                                value="{{ isset($_POST['depth_unit']) ? $_POST['depth_unit'] : 'cm' }}" id="depth_unit"
                                class="hidden">
                            <div id="depth_unit_dropdown"
                                class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                to="depth_unit">
                                @foreach (['cm', 'm', 'in', 'ft', 'yd'] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('depth_unit', '{{ $name }}')"> {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-span-12 density {{ isset($_POST['shape']) && $_POST['shape'] !== '0' ? 'hidden' : 'd-block' }} {{ isset($_POST['shape']) && $_POST['shape'] === '2' ? 'hidden' : 'd-block' }}">
                        <label for="density" class="label">{{ $lang['13'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="density" id="density" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                value="{{ isset($_POST['density']) ? $_POST['density'] : '10' }}" aria-label="input"
                                placeholder="00" oninput="checkInput()" />
                            <label for="density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                onclick="toggleDropdown('density_unit_dropdown')">{{ isset($_POST['density_unit']) ? $_POST['density_unit'] : 'kg/m³' }}
                                ▾</label>
                            <input type="text" name="density_unit"
                                value="{{ isset($_POST['density_unit']) ? $_POST['density_unit'] : 'kg/m³' }}"
                                id="density_unit" class="hidden">
                            <div id="density_unit_dropdown"
                                class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                to="density_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('density_unit', 'kg/m³')"> kg/m³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('density_unit', 't/m³')"> t/m³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('density_unit', 'g/cm³')"> g/cm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('density_unit', 'oz/in³')"> oz/in³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('density_unit', 'lb/in³')"> lb/in³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('density_unit', 'lb/ft³')"> lb/ft³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    onclick="setUnit('density_unit', 'lb/yd³')"> lb/yd³</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-6 ps-lg-3 flex items-center">
                    <img src="{{ asset('images/sand-square.webp') }}" alt="ShapeImage" class="max-width imgset"
                        width="320px" height="130px">
                </div>
                <div class="col-span-12 cursor-pointer current_gpa flex items-center justify-center my-3">
                    <strong class="pe-lg-3">{{ $lang['14'] }}:</strong>
                    <img src="{{ asset('images/new-down.webp') }}" class="right button mx-2" alt="cost"
                        width="16px" height="16px">
                </div>
                <div
                    class="col-span-12 current_input {{ (isset($_POST['mass_price']) && $_POST['mass_price'] !== '') || (isset($_POST['c_price']) && $_POST['c_price'] !== '') ? 'show' : 'current_input' }}">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div
                            class="col-span-6 c_price {{ isset($_POST['shape']) && $_POST['shape'] !== '0' ? 'd-block' : 'hidden' }}">
                            <label for="c_price" class="label">{{ $lang['17'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="c_price" id="c_price" class="input"
                                    aria-label="input" value="{{ isset($_POST['c_price']) ? $_POST['c_price'] : '' }}" />
                                <span class="text-blue input-unit">{{ $currancy }}</span>
                            </div>
                        </div>
                        <div
                            class="col-span-6 price {{ isset($_POST['shape']) && $_POST['shape'] !== '0' ? 'hidden' : 'd-block' }}">
                            <label for="mass_price" class="label">{{ $lang['15'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="mass_price" id="mass_price" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    value="{{ isset($_POST['mass_price']) ? $_POST['mass_price'] : '5' }}"
                                    aria-label="input" placeholder="00" oninput="checkInput()" />
                                <label for="mass_price_unit"
                                    class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    onclick="toggleDropdown('mass_price_unit_dropdown')">{{ isset($_POST['mass_price_unit']) ? $_POST['mass_price_unit'] : $currancy . ' ' . 't' }}
                                    ▾</label>
                                <input type="text" name="mass_price_unit"
                                    value="{{ isset($_POST['mass_price_unit']) ? $_POST['mass_price_unit'] : $currancy . ' ' . 't' }}"
                                    id="mass_price_unit" class="hidden">
                                <div id="mass_price_unit_dropdown"
                                    class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                    to="mass_price_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('mass_price_unit', '{{ $currancy }} µg')">
                                        {{ $currancy }} µg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('mass_price_unit', '{{ $currancy }} mg')">
                                        {{ $currancy }} mg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('mass_price_unit', '{{ $currancy }} g')">
                                        {{ $currancy }} g</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('mass_price_unit', '{{ $currancy }} kg')">
                                        {{ $currancy }} kg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('mass_price_unit', '{{ $currancy }} t')">
                                        {{ $currancy }} t</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('mass_price_unit', '{{ $currancy }} lb')">
                                        {{ $currancy }} lb</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('mass_price_unit', '{{ $currancy }} stone')">
                                        {{ $currancy }} stone</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('mass_price_unit', '{{ $currancy }} US ton')">
                                        {{ $currancy }} US ton</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('mass_price_unit', '{{ $currancy }} Long ton')">
                                        {{ $currancy }} Long ton</p>
                                </div>
                                <input type="hidden" name="hiddencurrancy" value="{{ $currancy }}" />
                            </div>
                        </div>
                        <div
                            class="col-span-6 optional {{ isset($_POST['shape']) && $_POST['shape'] !== '0' ? 'hidden' : 'd-block' }}">
                            <label for="volume_price" class="label">{{ $lang['16'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="volume_price" id="volume_price" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    value="{{ isset($_POST['volume_price']) ? $_POST['volume_price'] : '' }}"
                                    aria-label="input" placeholder="00" oninput="checkInput()" />
                                <label for="volume_price_unit"
                                    class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    onclick="toggleDropdown('volume_price_unit_dropdown')">{{ isset($_POST['volume_price_unit']) ? $_POST['volume_price_unit'] : $currancy . ' ' . 't' }}
                                    ▾</label>
                                <input type="text" name="volume_price_unit"
                                    value="{{ isset($_POST['volume_price_unit']) ? $_POST['volume_price_unit'] : $currancy . ' ' . 't' }}"
                                    id="volume_price_unit" class="hidden">
                                <div id="volume_price_unit_dropdown"
                                    class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                                    to="volume_price_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('volume_price_unit', '{{ $currancy }} mm³')">
                                        {{ $currancy }} mm³</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('volume_price_unit', '{{ $currancy }} cm³')">
                                        {{ $currancy }} cm³</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('volume_price_unit', '{{ $currancy }} m³')">
                                        {{ $currancy }} m³</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('volume_price_unit', '{{ $currancy }} in³')">
                                        {{ $currancy }} in³</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('volume_price_unit', '{{ $currancy }} ft³')">
                                        {{ $currancy }} ft³</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        onclick="setUnit('volume_price_unit', '{{ $currancy }} yd³')">
                                        {{ $currancy }} yd³</p>

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
                            <div class="w-full my-1">
                                <div class="w-full md:w-[60%] lg:w-[60%] text-[18px]">
                                    <table class="w-full">
                                        @if (isset($detail['volume']))
                                            <tr>
                                                <td width="40%" class="border-b py-2">
                                                    <strong>{{ $lang['18'] }}</strong></td>
                                                <td class="border-b py-2">{{ $detail['volume'] }} (ft³)</td>
                                            </tr>
                                            <tr>
                                                <td class="pt-3 pb-2">{{ $lang['19'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['18'] }}</td>
                                                <td class="border-b py-2">{{ $detail['mm3'] }} cubic milimeters (mm³)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['18'] }}</td>
                                                <td class="border-b py-2">{{ $detail['cm3'] }} cubic centimeters (cm³)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['18'] }}</td>
                                                <td class="border-b py-2">{{ $detail['m3'] }} cubic meters (m³)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['18'] }}</td>
                                                <td class="border-b py-2">{{ $detail['in3'] }} cubic inches (in³)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['18'] }}</td>
                                                <td class="border-b py-2">{{ $detail['yd3'] }} cubic yards (yd³)</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="border-b pb-2 pt-4"><strong>{{ $lang['20'] }}</strong></td>
                                            <td class="border-b pb-2 pt-4">
                                                {{ $detail['weight'] }} t
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="pt-3 pb-2">{{ $lang['19'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['20'] }}</td>
                                            <td class="border-b py-2">{{ $detail['g'] }} grams (g)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['20'] }}</td>
                                            <td class="border-b py-2">{{ $detail['kg'] }} kilograms (kg)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['20'] }}</td>
                                            <td class="border-b py-2">{{ $detail['oz'] }} ounces (oz)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['20'] }}</td>
                                            <td class="border-b py-2">{{ $detail['lb'] }} pounds (lb)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['20'] }}</td>
                                            <td class="border-b py-2">{{ $detail['stone'] }} stones (stone)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['20'] }}</td>
                                            <td class="border-b py-2">{{ $detail['us_ton'] }} US short tons (US ton)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['20'] }}</td>
                                            <td class="border-b py-2">{{ $detail['long_ton'] }} imperial tons (Long ton)
                                            </td>
                                        </tr>
                                        @if (isset($detail['cost']))
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['21'] }}</td>
                                                <td class="border-b py-2">
                                                    {{ $currancy . ' ' . $detail['cost'] }}
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
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
        var length = document.querySelector('.length');
        var width = document.querySelector('.width');
        var area = document.querySelector('.area');
        var volume = document.querySelector('.volume');
        var diameter = document.querySelector('.diameter');
        var depth = document.querySelector('.depth');
        var density = document.querySelector('.density');
        var c_price = document.querySelector('.c_price');
        var price = document.querySelector('.price');
        var optional = document.querySelector('.optional');
        var chose = document.querySelector('.chose');
        var imgset = document.querySelector('.imgset');
        var check = document.getElementById('check');
        document.getElementById('shape').addEventListener('change', function() {
            var value = this.value;
            if (value === "0") {
                length.style.display = "block";
                imgset.setAttribute('src', "{{ asset('images/sand-square.webp') }}");
                width.style.display = "block";
                depth.style.display = "block";
                density.style.display = "block";
                price.style.display = "block";
                optional.style.display = "block";
                chose.style.display = "block";
                diameter.style.display = "none";
                volume.style.display = "none";
                area.style.display = "none";
                c_price.style.display = "none";
            } else if (value === "1") {
                imgset.setAttribute('src', "{{ asset('images/sand-circle.webp') }}");
                length.style.display = "none";
                width.style.display = "none";
                density.style.display = "none";
                chose.style.display = "none";
                depth.style.display = "block";
                diameter.style.display = "block";
                c_price.style.display = "block";
                volume.style.display = "none";
                area.style.display = "none";
                price.style.display = "none";
                optional.style.display = "none";
            }
        });

        @if (isset($_POST['shape']) && $_POST['shape'] !== '0')
            imgset.setAttribute("src", "{{ asset('images/sand-circle.webp') }}");
        @else
            imgset.setAttribute("src", "{{ asset('images/sand-square.webp') }}");
        @endif

        document.getElementById('g1').addEventListener('click', function() {
            check.value = 'g1';
            length.style.display = "block";
            width.style.display = "block";
            depth.style.display = "block";
            density.style.display = "block";
            price.style.display = "block";
            optional.style.display = "block";
            diameter.style.display = "none";
            volume.style.display = "none";
            area.style.display = "none";
            c_price.style.display = "none";
        });
        document.getElementById('g2').addEventListener('click', function() {
            check.value = 'g2';
            length.style.display = "none";
            width.style.display = "none";
            diameter.style.display = "none";
            depth.style.display = "block";
            density.style.display = "block";
            price.style.display = "block";
            optional.style.display = "block";
            area.style.display = "block";
            volume.style.display = "none";
            c_price.style.display = "none";

        });
        document.getElementById('g3').addEventListener('click', function() {
            check.value = 'g3';
            length.style.display = "none";
            width.style.display = "none";
            diameter.style.display = "none";
            depth.style.display = "none";
            density.style.display = "block ";
            price.style.display = "block";
            optional.style.display = "block";
            volume.style.display = "block";
            area.style.display = "none";
            c_price.style.display = "none";
        });
        document.querySelector('.current_gpa').addEventListener('click', function() {
            var view = document.querySelector('.current_input');
            var button = document.querySelector('.button');
            view.classList.remove('hidden');
            view.classList.toggle('show');
            button.classList.toggle('rotate');
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>