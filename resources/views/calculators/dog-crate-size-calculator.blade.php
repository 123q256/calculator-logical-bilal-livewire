<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-1 lg:p-4 md:p-4  rounded-lg  space-y-6 mb-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            {{-- <div class=" w-full mx-auto p-4"> --}}
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2">
                        <div class="space-y-2">
                            <p class="font-s-14 text-blue mb-3">{{ $lang['1'] }}:</p>
                            <label for="height" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="height" id="height" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    value="{{ isset($_POST['height']) ? $_POST['height'] : '3' }}" aria-label="input"
                                    placeholder="00" oninput="checkInput()" />
                                <label for="h_units" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    onclick="toggleDropdown('h_units_dropdown')">{{ isset($_POST['h_units']) ? $_POST['h_units'] : 'cm' }}
                                    ▾</label>
                                <input type="text" name="h_units"
                                    value="{{ isset($_POST['h_units']) ? $_POST['h_units'] : 'cm' }}" id="h_units"
                                    class="hidden">
                                <div id="h_units_dropdown"
                                    class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[44%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_units', 'cm')">
                                        centimeters (cm)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_units', 'm')">
                                        meters (m)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_units', 'ft')">
                                        feet (ft)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_units', 'in')">
                                        inches (in)</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <p class="font-s-14 mb-3 text-blue">{{ $lang['3'] }}:</p>
                            <label for="length" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="length" id="length" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    value="{{ isset($_POST['length']) ? $_POST['length'] : '3' }}" aria-label="input"
                                    placeholder="00" oninput="checkInput()" />
                                <label for="l_units" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    onclick="toggleDropdown('l_units_dropdown')">{{ isset($_POST['l_units']) ? $_POST['l_units'] : 'cm' }}
                                    ▾</label>
                                <input type="text" name="l_units"
                                    value="{{ isset($_POST['l_units']) ? $_POST['l_units'] : 'cm' }}" id="l_units"
                                    class="hidden">
                                <div id="l_units_dropdown"
                                    class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[44%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'cm')">
                                        centimeters (cm)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'm')">
                                        meters (m)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'ft')">
                                        feet (ft)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'in')">
                                        inches (in)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <img src="{{ asset('assets/img/dog-crate.webp') }}" class="max-width" alt="Dog Crate"
                            width="300px" height="180px">
                        <div class="col-12 px-2 mt-0 mt-lg-4">
                            <label for="extra_lenght" class="font-s-14 text-blue cat">{{ $lang['5'] }}:</label>
                            <select class="input" name="extra_lenght" id="extra_lenght" aria-label="input select">
                                <option value="5.1"
                                    {{ isset($_POST['extra_lenght']) && $_POST['extra_lenght'] === '5.1' ? 'selected' : '' }}>
                                    2 in/5.1 cm (small dog)</option>
                                <option value="7.6"
                                    {{ isset($_POST['extra_lenght']) && $_POST['extra_lenght'] === '7.6' ? 'selected' : '' }}>
                                    3 in/7.6 cm (medium dog)</option>
                                <option value="10.2"
                                    {{ isset($_POST['extra_lenght']) && $_POST['extra_lenght'] === '10.2' ? 'selected' : '' }}>
                                    4 in/10.2 cm (big dog)</option>
                            </select>
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
    </div>
        @isset($detail)
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full bg-light-blue p-4 rounded-lg mt-6">
                            <div class="mt-4">
                                <p class="text-lg mt-2 mb-2 font-bold text-[#2845F5]">{{ $lang['9'] }}
                                    {{ $lang['10'] }}</p>
                                <table class="text-base mb-6 w-full lg:w-1/2 overflow-auto">
                                    <tr>
                                        <td class="border-b py-2 w-3/4">{{ $lang['10'] }}:</td>
                                        <td class="border-b py-2">{{ $detail['c_height'] }} cm</td>
                                    </tr>
                                </table>

                                <p class="text-lg mt-2 mb-2 font-bold text-[#2845F5]">{{ $lang['9'] }}
                                    {{ $lang['11'] }}</p>
                                <table class="text-base mb-6 w-full lg:w-1/2 overflow-auto">
                                    <tr>
                                        <td class="border-b py-2 w-3/4">{{ $lang['11'] }}:</td>
                                        <td class="border-b py-2">{{ $detail['c_lenght'] }} cm</td>
                                    </tr>
                                </table>

                                <p class="text-lg font-bold mb-2 text-[#2845F5]">{{ $lang['12'] }}</p>
                                <div class="overflow-auto w-full lg:w-1/2 text-base">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['10'] }} ({{ $lang['13'] }}):</td>
                                            <td class="border-b py-2">{{ $detail['c_height'] * 0.01 }} m</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['11'] }} ({{ $lang['13'] }}):</td>
                                            <td class="border-b py-2">{{ $detail['c_lenght'] * 0.01 }} m</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['10'] }} ({{ $lang['10'] }}):</td>
                                            <td class="border-b py-2">{{ round($detail['c_height'] * 0.3937, 3) }} in</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['11'] }} ({{ $lang['10'] }}):</td>
                                            <td class="border-b py-2">{{ round($detail['c_lenght'] * 0.3937, 3) }} in</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['10'] }} ({{ $lang['15'] }}):</td>
                                            <td class="border-b py-2">{{ round($detail['c_height'] * 0.03281, 4) }} ft
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['11'] }} ({{ $lang['15'] }}):</td>
                                            <td class="border-b py-2">{{ round($detail['c_lenght'] * 0.03281, 4) }} ft
                                            </td>
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
