<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <p class="w-full">{{ $lang['voltage'] }} = {{ $lang['current'] }} * {{ $lang['resistance'] }}</p>
            <p class="w-full">{{ $lang['power'] }} = {{ $lang['voltage'] }} * {{ $lang['current'] }}</p>
            <p class="w-full">{{ $lang['note'] }} {{ $lang['note_value'] }}</p>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="voltage" class="font-s-14 text-blue">{{ $lang['voltage'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="voltage" id="voltage" min="1"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                            value="{{ isset($_POST['voltage']) ? $_POST['voltage'] : '' }}" aria-label="input"
                            placeholder="00" oninput="checkInput()" />
                        <label for="unit_v" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('unit_v_dropdown')">{{ isset($_POST['unit_v']) ? $_POST['unit_v'] : 'V' }}
                            ▾</label>
                        <input type="text" name="unit_v" value="{{ isset($_POST['unit_v']) ? $_POST['unit_v'] : 'V' }}"
                            id="unit_v" class="hidden">
                        <div id="unit_v_dropdown"
                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_v', 'V')">V</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_v', 'KV')">KV</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_v', 'mV')">mV</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="current" class="font-s-14 text-blue">{{ $lang['current'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="current" id="current" min="1"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                            value="{{ isset($_POST['current']) ? $_POST['current'] : '' }}" aria-label="input"
                            placeholder="00" oninput="checkInput()" />
                        <label for="unit_i" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('unit_i_dropdown')">{{ isset($_POST['unit_i']) ? $_POST['unit_i'] : 'A' }}
                            ▾</label>
                        <input type="text" name="unit_i" value="{{ isset($_POST['unit_i']) ? $_POST['unit_i'] : 'A' }}"
                            id="unit_i" class="hidden">
                        <div id="unit_i_dropdown"
                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_i', 'A')">A</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_i', 'mA')">mA</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="current" class="font-s-14 text-blue">{{ $lang['current'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="resistance" id="resistance" min="1"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                            value="{{ isset($_POST['resistance']) ? $_POST['resistance'] : '' }}" aria-label="input"
                            placeholder="00" oninput="checkInput()" />
                        <label for="unit_r" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('unit_r_dropdown')">{{ isset($_POST['unit_r']) ? $_POST['unit_r'] : 'Ω' }}
                            ▾</label>
                        <input type="text" name="unit_r" value="{{ isset($_POST['unit_r']) ? $_POST['unit_r'] : 'Ω' }}"
                            id="unit_r" class="hidden">
                        <div id="unit_r_dropdown"
                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'Ω')">Ω</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'kΩ')">kΩ</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="power" class="font-s-14 text-blue">{{ $lang['power'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="power" id="power" min="1"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                            value="{{ isset($_POST['power']) ? $_POST['power'] : '' }}" aria-label="input"
                            placeholder="00" oninput="checkInput()" />
                        <label for="unit_p" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('unit_p_dropdown')">{{ isset($_POST['unit_p']) ? $_POST['unit_p'] : 'W' }}
                            ▾</label>
                        <input type="text" name="unit_p"
                            value="{{ isset($_POST['unit_p']) ? $_POST['unit_p'] : 'W' }}" id="unit_p"
                            class="hidden">
                        <div id="unit_p_dropdown"
                            class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_p', 'W')">W</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_p', 'kW')">kW</p>
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
    <style>
        .border-b {
            border-bottom: 2px solid white !important;
        }
    </style>
    @isset($detail)
        {{-- result --}}
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue rounded-lg mt-6">
                        <div class="flex flex-wrap">
                            <div class="w-full lg:w-1/2 mt-4">
                                <table class="w-full text-base">
                                    <tr>
                                        <td class="py-2 border-b w-3/5"><strong>{{ $lang['voltage'] }} </strong></td>
                                        <td class="py-2 border-b">{{ $detail['voltage'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-3/5"><strong>{{ $lang['current'] }} </strong></td>
                                        <td class="py-2 border-b">{{ $detail['current'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-3/5"><strong>{{ $lang['resistance'] }} </strong></td>
                                        <td class="py-2 border-b">{{ $detail['resistance'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-3/5"><strong>{{ $lang['power'] }} </strong></td>
                                        <td class="py-2 border-b">{{ $detail['power'] }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full lg:w-1/2 mt-4 text-center">
                                <img src="{{ asset('images/ohm-min.webp') }}" alt="ohm's law calculator" class="mx-auto"
                                    width="208" height="auto">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
