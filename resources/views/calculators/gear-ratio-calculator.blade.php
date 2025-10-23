<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 mx-auto mb-2">
                    <div class="row">
                        <strong class="col-12 mt-2 px-2 text-center">{{ $lang[1] }}:</strong>
                        <div class="col-12 px-2 mb-3 mt-3 d-flex align-items-center justify-content-center">
                            @if (isset($_POST['type']))
                                @if ($_POST['type']=='first')
                                    <input name="type" id="first" class="mx-1" value="first" type="radio" checked />
                                @else
                                    <input name="type" id="first" class="mx-1" value="first" type="radio" />
                                @endif
                            @else
                                <input name="type" id="first" class="mx-1" value="first" type="radio" checked />
                            @endif
                            <label for="first" class="label px-1">{{ $lang['2'] }}</label>
                            @if (isset($_POST['type']) && $_POST['type']=='second')
                                <input name="type" id="second" class="ms-2" value="second" type="radio" checked />
                            @else
                                <input name="type" id="second" class="ms-2" value="second" type="radio" />
                            @endif
                            <label for="second" class="label px-1">{{ $lang['3'] }}</label>
                        </div>
                    </div>
                </div>

            <div class="col-span-12" id="calculator">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-6">
                        <label for="f_first" class="label">{{ $lang['4'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="f_first" id="f_first" class="input" value="{{ isset($_POST['f_first'])?$_POST['f_first']:'15' }}" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                
        
                    <div class="col-span-6">
                        <label for="f_second" class="label">{{ $lang['5'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="f_second" id="f_second" class="input" value="{{ isset($_POST['f_second'])?$_POST['f_second']:'10' }}" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="f_third" class="label">{{ $lang['6'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="f_third" id="f_third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f_third']) ? $_POST['f_third'] : '9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="ft_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ft_unit_dropdown')">{{ isset($_POST['ft_unit'])?$_POST['ft_unit']:'rpm' }} ▾</label>
                            <input type="text" name="ft_unit" value="{{ isset($_POST['ft_unit'])?$_POST['ft_unit']:'rpm' }}" id="ft_unit" class="hidden">
                            <div id="ft_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ft_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ft_unit', 'rpm')">rpm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ft_unit', 'rad/s')">rad/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ft_unit', 'Hz')">Hz</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-6">
                        <label for="f_four" class="label">{{ $lang['7'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="f_four" id="f_four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f_four']) ? $_POST['f_four'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="ff_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ff_unit_dropdown')">{{ isset($_POST['ff_unit'])?$_POST['ff_unit']:'Nm' }} ▾</label>
                            <input type="text" name="ff_unit" value="{{ isset($_POST['ff_unit'])?$_POST['ff_unit']:'Nm' }}" id="ff_unit" class="hidden">
                            <div id="ff_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ff_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ff_unit', 'Nm')">Nm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ff_unit', 'kg-cm')">kg-cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ff_unit', 'J/rad')">J/rad</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ff_unit', 'ft-lb')">ft-lb</p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <div id="converter" class="col-span-12 hidden">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-6">
                        <label for="transmissions" class="label">{{ $lang[8] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select name="transmissions" id="transmissions" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name = ["Magnum XL 2.66 - .50","Magnum XL 2.97 - .63","Magnum 2.66 - .63","Magnum 2.97 - .50","Magnum-F 2.66 - .63","Magnum-F 2.97 - .63","Magnum-F 2.66 - .50","Magnum-F 2.97 - .50","T-5 2.95 - .63","TKO-500 3.27 - .68","TKO-600 2.87 - .64","TKO-600 2.87 - .82","TKX 3.27 - .72","TKX 2.87 - .81","TKX 2.87 - .68","GM Muncie 2.20 - 1.00","Ford Toploader 2.32 - 1.00","Ford Toploader 2.78 - 1.00","A-833 HEMI 4-Speed 2.44 - 1.00"];
                                    $val = ["Magnum XL 2.66 - .50","Magnum XL 2.97 - .63","Magnum 2.66 - .63","Magnum 2.97 - .50","Magnum-F 2.66 - .63","Magnum-F 2.97 - .63","Magnum-F 2.66 - .50","Magnum-F 2.97 - .50","T-5 2.95 - .63","TKO-500 3.27 - .68","TKO-600 2.87 - .64","TKO-600 2.87 - .82","TKX 3.27 - .72","TKX 2.87 - .81","TKX 2.87 - .68","GM Muncie 2.20 - 1.00","Ford Toploader 2.32 - 1.00","Ford Toploader 2.78 - 1.00","A-833 HEMI 4-Speed 2.44 - 1.00"];
                                    optionsList($val,$name,isset($_POST['transmissions'])?$_POST['transmissions']:'Magnum XL 2.66 - .50');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="s_first" class="label">{{ $lang['13'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="s_first" id="s_first" class="input" value="{{ isset($_POST['s_first'])?$_POST['s_first']:'100' }}" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="s_second" class="label">{{ $lang['14'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="s_second" id="s_second" class="input" value="{{ isset($_POST['s_second'])?$_POST['s_second']:'45' }}" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="s_third" class="label">{{ $lang['15'] }} (in):</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="s_third" id="s_third" class="input" value="{{ isset($_POST['s_third'])?$_POST['s_third']:'20' }}" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="s_four" class="label">{{ $lang['16'] }} (mm):</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="s_four" id="s_four" class="input" value="{{ isset($_POST['s_four'])?$_POST['s_four']:'26' }}" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="s_five" class="label">{{ $lang['17'] }} (in):</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="s_five" id="s_five" class="input" value="{{ isset($_POST['s_five'])?$_POST['s_five']:'8' }}" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="s_six" class="label">{{ $lang['18'] }} (1-100):</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="s_six" id="s_six" class="input" value="{{ isset($_POST['s_six'])?$_POST['s_six']:'6' }}" aria-label="input" placeholder="00" />
                        </div>
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
                    <div class="w-full">
                        <p class="col-12 mt-2 font-s-21"><strong class="text-blue"><?= $lang[19] ?></strong></p>
                        <?php if ($detail['type'] == "first") { ?>
                            <div class="w-full md:w-[60%] lg:w-[60%] overflow-auto">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[20] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['gear_ratio'], 2) }} :1</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[21] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['mechanical'], 2) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[22] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['output_rot'], 2) }} (rpm)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[23] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['output_tor'], 2) }} (Nm)</strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } else if ($detail['type'] == "second") { ?>
                            <div class="w-full md:w-[60%] lg:w-[60%]mt-2 overflow-auto">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[24] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['height'], 2) }} (in)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[25] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['width'], 2) }} (in)</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full md:w-[60%] lg:w-[60%] overflow-auto">
                                <table class="w-full" style="border-collapse: collapse">
                                    <tr class="bg-gray">
                                        <td class="p-2 border text-center"><strong class="text-blue"><?= $lang[26] ?></strong></td>
                                        <td class="p-2 border text-center"><strong class="text-blue"><?= $lang[27] ?></strong></td>
                                        <td class="p-2 border text-center"><strong class="text-blue">MPH</strong></td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center">1st <?= $lang[28] ?></td>
                                        <td class="p-2 border text-center"><?= $detail['transratio1_value'] ?></td>
                                        <td class="p-2 border text-center"><?= $detail['mph1_value'] ?></td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center">2nd <?= $lang[28] ?></td>
                                        <td class="p-2 border text-center"><?= $detail['transratio2_value'] ?></td>
                                        <td class="p-2 border text-center"><?= $detail['mph2_value'] ?></td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center">3rd <?= $lang[28] ?></td>
                                        <td class="p-2 border text-center"><?= $detail['transratio3_value'] ?></td>
                                        <td class="p-2 border text-center"><?= $detail['mph3_value'] ?></td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center">4th <?= $lang[28] ?></td>
                                        <td class="p-2 border text-center"><?= $detail['transratio4_value'] ?></td>
                                        <td class="p-2 border text-center"><?= $detail['mph4_value'] ?></td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center">5th <?= $lang[28] ?></td>
                                        <td class="p-2 border text-center"><?= $detail['transratio5_value'] ?></td>
                                        <td class="p-2 border text-center"><?= $detail['mph5_value'] ?></td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center">6th <?= $lang[28] ?></td>
                                        <td class="p-2 border text-center"><?= $detail['transratio6_value'] ?></td>
                                        <td class="p-2 border text-center"><?= $detail['mph6_value'] ?></td>
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
</form>
@push('calculatorJS')
    <script>
        document.getElementById('first').addEventListener('click', function() {
            document.getElementById('converter').style.display = 'none';
            document.getElementById('calculator').style.display = 'block';
        });

        document.getElementById('second').addEventListener('click', function() {
            document.getElementById('converter').style.display = 'block';
            document.getElementById('calculator').style.display = 'none';
        });
        @if (isset($_POST['type']) && $_POST['type']=='first')
            document.getElementById('first').click();
        @endif
        @if (isset($_POST['type']) && $_POST['type']=='second')
            document.getElementById('second').click();
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>