<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
              <p class="w-full my-2 px-2">{{ $lang[5] }}</p>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="resistance" class="font-s-14 text-blue">{{ $lang[1] }} (R):</label>
                    <div class="relative w-full ">
                        <input type="number" name="resistance" id="resistance" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['resistance'])?$_POST['resistance']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="resistance_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('resistance_unit_dropdown')">{{ isset($_POST['resistance_unit'])?$_POST['resistance_unit']:'Ω' }} ▾</label>
                        <input type="text" name="resistance_unit" value="{{ isset($_POST['resistance_unit'])?$_POST['resistance_unit']:'Ω' }}" id="resistance_unit" class="hidden">
                        <div id="resistance_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resistance_unit', 'Ω')">Ω</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resistance_unit', 'kΩ')">kΩ</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resistance_unit', 'MΩ')">MΩ</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="current" class="font-s-14 text-blue">{{ $lang[2] }} (I):</label>
                    <div class="relative w-full ">
                        <input type="number" name="current" id="current" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['current'])?$_POST['current']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="current_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('current_unit_dropdown')">{{ isset($_POST['current_unit'])?$_POST['current_unit']:'A' }} ▾</label>
                        <input type="text" name="current_unit" value="{{ isset($_POST['current_unit'])?$_POST['current_unit']:'A' }}" id="current_unit" class="hidden">
                        <div id="current_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('current_unit', 'A')">A</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('current_unit', 'μA')">μA</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('current_unit', 'mA')">mA</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('current_unit', 'kA')">kA</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('current_unit', 'MA')">MA</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="voltage" class="font-s-14 text-blue">{{ $lang[3] }} (V):</label>
                    <div class="relative w-full ">
                        <input type="number" name="voltage" id="voltage" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['voltage'])?$_POST['voltage']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="voltage_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('voltage_unit_dropdown')">{{ isset($_POST['voltage_unit'])?$_POST['voltage_unit']:'V' }} ▾</label>
                        <input type="text" name="voltage_unit" value="{{ isset($_POST['voltage_unit'])?$_POST['voltage_unit']:'V' }}" id="voltage_unit" class="hidden">
                        <div id="voltage_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('voltage_unit', 'V')">V</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('voltage_unit', 'μV')">μV</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('voltage_unit', 'mV')">mV</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('voltage_unit', 'KV')">KV</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('voltage_unit', 'MV')">MV</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="power" class="font-s-14 text-blue">{{ $lang[4] }} (P):</label>
                    <div class="relative w-full ">
                        <input type="number" name="power" id="power" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['power'])?$_POST['power']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="power_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('power_unit_dropdown')">{{ isset($_POST['power_unit'])?$_POST['power_unit']:'W' }} ▾</label>
                        <input type="text" name="power_unit" value="{{ isset($_POST['power_unit'])?$_POST['power_unit']:'W' }}" id="power_unit" class="hidden">
                        <div id="power_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'W')">W</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'μW')">μW</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'mW')">mW</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'KW')">KW</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'MW')">MW</p>
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
                <div class="w-full bg-light-blue   rounded-lg mt-3">
                    <div class="flex">
                        <div class="w-full lg:w-1/2 mt-2 px-2">
                            <table class="w-full text-lg">
                                <?php if (isset($detail['resistance'])) { ?>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang['1'] ?></td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['resistance'], 3) }} (Ω)</strong></td>
                                    </tr>
                                <?php } ?>
                                <?php if (isset($detail['current'])) { ?>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang['2'] ?></td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['current'], 3) }} (A)</strong></td>
                                    </tr>
                                <?php } ?>
                                <?php if (isset($detail['power'])) { ?>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang['4'] ?></td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['power'], 3) }} (W)</strong></td>
                                    </tr>
                                <?php } ?>
                                <?php if (isset($detail['voltage'])) { ?>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang['3'] ?></td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['voltage'], 3) }} (V)</strong></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>