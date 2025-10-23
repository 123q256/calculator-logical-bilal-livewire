<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">

                <div class="space-y-2 grid grid-cols-1  gap-4">
                    <div class="space-y-2">
                        <label for="type" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                        <select name="type" id="type" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[2],$lang[3]];
                                $val = ["1","2"];
                                optionsList($val,$name,isset($_POST['type'])?$_POST['type']:'1');
                            @endphp
                        </select>
                    </div>
                    <div class="space-y-2" id="op1">
                        <label for="operations1" class="font-s-14 text-blue">{{ $lang[4] }}:</label>
                        <select name="operations1" id="operations1" class="input">
                            @php
                                $name = ["1","2"];
                                $val = ["1","2"];
                                optionsList($val,$name,isset($_POST['operations1'])?$_POST['operations1']:'2');
                            @endphp
                        </select>
                    </div>
                    <div class="space-y-2 hidden" id="op2">
                        <label for="operations2" class="font-s-14 text-blue">{{ $lang[5] }}:</label>
                        <select name="operations2" id="operations2" class="input">
                            @php
                                $name = ["1","2","3"];
                                $val = ["1","2","3"];
                                optionsList($val,$name,isset($_POST['operations2'])?$_POST['operations2']:'1');
                            @endphp
                        </select>
                    </div>
                    <div class="space-y-2 hidden" id="a1">
                        <label for="first" class="font-s-14 text-blue" id="text1">{{ $lang['6'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="first" id="first" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first'])?$_POST['first']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'mg' }} ▾</label>
                            <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'mg' }}" id="unit1" class="hidden">
                            <div id="unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'mg')">mg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 't')">t</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'oz')">oz</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'lb')">lb</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 hidden" id="a11">
                        <label for="second" class="font-s-14 text-blue" id="text2">{{ $lang['7'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="second" id="second" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second'])?$_POST['second']:'56' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit2_dropdown')">{{ isset($_POST['unit2'])?$_POST['unit2']:'mg' }} ▾</label>
                            <input type="text" name="unit2" value="{{ isset($_POST['unit2'])?$_POST['unit2']:'mg' }}" id="unit2" class="hidden">
                            <div id="unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'mg')">mg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 't')">t</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'oz')">oz</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'lb')">lb</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 hidden" id="a12">
                        <label for="third" class="font-s-14 text-blue" id="text3">{{ $lang['8'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="third" id="third" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third'])?$_POST['third']:'34' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit3_dropdown')">{{ isset($_POST['unit3'])?$_POST['unit3']:'mg' }} ▾</label>
                            <input type="text" name="unit3" value="{{ isset($_POST['unit3'])?$_POST['unit3']:'mg' }}" id="unit3" class="hidden">
                            <div id="unit3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'mg')">mg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 't')">t</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'oz')">oz</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'lb')">lb</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 hidden" id="a2">
                        <label for="four" class="font-s-14 text-blue" id="text4">{{ $lang['9'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="four" id="four" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['four'])?$_POST['four']:'9.865' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit4_dropdown')">{{ isset($_POST['unit4'])?$_POST['unit4']:'m/s²' }} ▾</label>
                            <input type="text" name="unit4" value="{{ isset($_POST['unit4'])?$_POST['unit4']:'m/s²' }}" id="unit4" class="hidden">
                            <div id="unit4_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'm/s²')">m/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'ft/s²')">ft/s²</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 hidden" id="a4">
                        <label for="six" class="font-s-14 text-blue" id="text6">{{ $lang['10'] }} β:</label>
                        <div class="relative w-full ">
                            <input type="number" name="six" id="six" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['six'])?$_POST['six']:'45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit6" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit6_dropdown')">{{ isset($_POST['unit6'])?$_POST['unit6']:'deg' }} ▾</label>
                            <input type="text" name="unit6" value="{{ isset($_POST['unit6'])?$_POST['unit6']:'deg' }}" id="unit6" class="hidden">
                            <div id="unit6_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit6', 'deg')">deg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit6', 'rad')">rad</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit6', 'gon')">gon</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:space-y-[50px] md:space-y-[50px] space-y-2 grid grid-cols-1  gap-4">
                    <div class="w-full text-center">
                        <img src="<?=url('images/tension2.webp')?>" alt="Tension Calculator" width="300" height="160" id="im"> 
                    </div>

                    <div class="space-y-2 lg:mt-[55px] md:mt-[55px] " id="a3">
                        <label for="five" class="font-s-14 text-blue" id="text5">{{ $lang['10'] }} α:</label>
                        <div class="relative w-full ">
                            <input type="number" name="five" id="five" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['five'])?$_POST['five']:'50' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit5" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit5_dropdown')">{{ isset($_POST['unit5'])?$_POST['unit5']:'deg' }} ▾</label>
                            <input type="text" name="unit5" value="{{ isset($_POST['unit5'])?$_POST['unit5']:'deg' }}" id="unit5" class="hidden">
                            <div id="unit5_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit5', 'deg')">deg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit5', 'rad')">rad</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit5', 'gon')">gon</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 hidden" id="a5">
                        <label for="seven" class="font-s-14 text-blue" id="text7">{{ $lang['11'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="seven" id="seven" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['seven'])?$_POST['seven']:'7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit7" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit7_dropdown')">{{ isset($_POST['unit7'])?$_POST['unit7']:'N' }} ▾</label>
                            <input type="text" name="unit7" value="{{ isset($_POST['unit7'])?$_POST['unit7']:'N' }}" id="unit7" class="hidden">
                            <div id="unit7_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit7', 'N')">N</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit7', 'kN')">kN</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit7', 'MN')">MN</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit7', 'lbf')">lbf</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit7', 'kip')">kip</p>
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
                <div class="w-full radius-10 mt-3">
                    <div class="w-full">
                        <p class="col-12 mt-2 font-s-21"><strong class="text-blue"><?= $lang[12] ?></strong></p>
                        <?php if (isset($detail['weight'])) { ?>
                            <div class="col-lg-6 mt-2 overflow-auto">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[13] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['weight'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['t_ans'], 4) }} (N)</strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } elseif (isset($detail['weight2'])) { ?>
                            <div class="col-lg-6 mt-2 overflow-auto">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[13] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['weight2'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] }} 1</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['t1_ans'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] }} 2</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['t2_ans'], 4) }} (N)</strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } elseif (isset($detail['op21'])) { ?>
                            <div class="col-lg-6 mt-2 overflow-auto">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[15] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['ans'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] }} 1</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['op21'], 4) }} (N)</strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } elseif (isset($detail['op22'])) { ?>
                            <div class="col-lg-6 mt-2 overflow-auto">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[15] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['ans'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] }} 1</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['op22'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] }} 2</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['answer2'], 4) }} (N)</strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } elseif (isset($detail['op23'])) { ?>
                            <div class="col-lg-6 mt-2 overflow-auto">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[15] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['ans'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] }} 1</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['answer2'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] }} 2</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['op23'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] }} 3</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['answer4'], 4) }} (N)</strong></td>
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
        function type() {
            var cal = document.getElementById('type').value;
            if (cal == '1') {
                document.getElementById('op2').style.display = 'none';
                document.getElementById('a5').style.display = 'none';
                document.getElementById('a11').style.display = 'none';
                document.getElementById('a12').style.display = 'none';
                document.getElementById('op1').style.display = 'block';
                document.getElementById('a1').style.display = 'block';
                document.getElementById('a2').style.display = 'block';
                document.getElementById('a3').style.display = 'block';
                document.getElementById('a4').style.display = 'block';
                document.getElementById('text1').textContent = "Object's Mass:";
                document.getElementById('text5').textContent = "Angle α:";
                document.getElementById('im').src = '<?=url("assets/img/tension2.webp")?>';
            } else if (cal == '2') {
                document.getElementById('op1').style.display = 'none';
                document.getElementById('a2').style.display = 'none';
                document.getElementById('a4').style.display = 'none';
                document.getElementById('a11').style.display = 'none';
                document.getElementById('a12').style.display = 'none';
                document.getElementById('op2').style.display = 'block';
                document.getElementById('a1').style.display = 'block';
                document.getElementById('a3').style.display = 'block';
                document.getElementById('a5').style.display = 'block';
                document.getElementById('text5').textContent = "Angle θ:";
                document.getElementById('im').src = '<?=url("assets/img/tension3.webp")?>';
            }
        }
        type()
        document.getElementById('type').addEventListener('change', type);

        function operations1() {
            var cal = document.getElementById('operations1').value;
            if (cal == '1') {
                document.getElementById('text1').textContent = "Object's Mass:";
                document.getElementById('a1').style.display = 'block';
                document.getElementById('a2').style.display = 'block';
                document.getElementById('a3').style.display = 'none';
                document.getElementById('a4').style.display = 'none';
                document.getElementById('a5').style.display = 'none';
                document.getElementById('a11').style.display = 'none';
                document.getElementById('a12').style.display = 'none';
                document.getElementById('im').src = '<?=url("assets/img/tension1.webp")?>';
            } else if (cal == '2') {
                document.getElementById('text1').textContent = "Object's Mass:";
                document.getElementById('a1').style.display = 'block';
                document.getElementById('a2').style.display = 'block';
                document.getElementById('a3').style.display = 'block';
                document.getElementById('a4').style.display = 'block';
                document.getElementById('text5').textContent = "Angle α:";
                document.getElementById('a5').style.display = 'none';
                document.getElementById('a11').style.display = 'none';
                document.getElementById('a12').style.display = 'none';
                document.getElementById('im').src = '<?=url("assets/img/tension2.webp")?>';
            }
        }
        @if(isset($_POST['type']) && $_POST['type']=='1')
            operations1()
        @endif
        document.getElementById('operations1').addEventListener('change', operations1);

        function operations2() {
            var cal = document.getElementById('operations2').value;
            if (cal == '1') {
                document.getElementById('text1').textContent = "Object's Mass:";
                document.getElementById('text5').textContent = "Angle θ:";
                document.getElementById('a1').style.display = 'block';
                document.getElementById('a3').style.display = 'block';
                document.getElementById('a5').style.display = 'block';
                document.getElementById('a2').style.display = 'none';
                document.getElementById('a4').style.display = 'none';
                document.getElementById('a11').style.display = 'none';
                document.getElementById('a12').style.display = 'none';
                document.getElementById('im').src = '<?=url("assets/img/tension3.webp")?>';
            } else if (cal == '2') {
                document.getElementById('text1').textContent = "First object's Mass:";
                document.getElementById('text5').textContent = "Angle θ:";
                document.getElementById('a1').style.display = 'block';
                document.getElementById('a11').style.display = 'block';
                document.getElementById('a3').style.display = 'block';
                document.getElementById('a5').style.display = 'block';
                document.getElementById('a2').style.display = 'none';
                document.getElementById('a4').style.display = 'none';
                document.getElementById('a12').style.display = 'none';
                document.getElementById('im').src = '<?=url("assets/img/tension4.webp")?>';
            } else if (cal == '3') {
                document.getElementById('text1').textContent = "First object's Mass:";
                document.getElementById('text5').textContent = "Angle θ:";
                document.getElementById('a1').style.display = 'block';
                document.getElementById('a11').style.display = 'block';
                document.getElementById('a3').style.display = 'block';
                document.getElementById('a5').style.display = 'block';
                document.getElementById('a12').style.display = 'block';
                document.getElementById('a2').style.display = 'none';
                document.getElementById('a4').style.display = 'none';
                document.getElementById('im').src = '<?=url("assets/img/tension5.webp")?>';
            }
        }
        @if(isset($_POST['type']) && $_POST['type']=='2')
            operations2()
        @endif
        document.getElementById('operations2').addEventListener('change', operations2);
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>