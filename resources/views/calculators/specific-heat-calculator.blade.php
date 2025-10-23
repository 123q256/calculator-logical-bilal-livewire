<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 px-2">
                    <label for="find" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <select name="find" id="find" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'],$lang['3'],$lang['4'],$lang['5'].' '.$lang['23'],$lang['6'].' '.$lang['23']];
                                $val = ["energy","specific_heat","mass","itemp","ftemp"];
                                optionsList($val,$name,isset($_POST['find'])?$_POST['find']:'specific_heat');
                            @endphp
                        </select>
                    </div>
                </div>
                <div id="by" class="col-span-12">
                    <div class="grid grid-cols-12   gap-4">
                        <strong class="col-span-12 mt-2 px-2">{{ $lang[7] }}:</strong>
                        <div class="col-span-12 px-2 mb-3 mt-3 d-flex align-items-center">
                            @if (isset($_POST['by']))
                                @if ($_POST['by']=='change')
                                    <input name="by" id="change" class="change mx-1" value="change" type="radio" checked />
                                @else
                                    <input name="by" id="change" class="change mx-1" value="change" type="radio" />
                                @endif
                            @else
                                <input name="by" id="change" class="change mx-1" value="change" type="radio" checked />
                            @endif
                            <label for="change" class="font-s-14 text-blue px-1"><?=$lang['8']?> <?=$lang['10']?> <?=$lang['19']?> (ΔT)</label>
                            @if (isset($_POST['by']) && $_POST['by']=='i_f_t')
                                <input name="by" id="i_f_t" class="i_f_t ms-2" value="i_f_t" type="radio" checked />
                            @else
                                <input name="by" id="i_f_t" class="i_f_t ms-2" value="i_f_t" type="radio" />
                            @endif
                            <label for="i_f_t" class="font-s-14 text-blue px-1"><?=$lang['9']?> <?=$lang['19']?></label>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 px-2" id="q">
                    <label for="q_" class="font-s-14 text-blue">{{ $lang['2'] }} (Q):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="q" id="q_" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['q']) ? $_POST['q'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="q_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('q_unit_dropdown')">{{ isset($_POST['q_unit'])?$_POST['q_unit']:'J' }} ▾</label>
                        <input type="text" name="q_unit" value="{{ isset($_POST['q_unit'])?$_POST['q_unit']:'J' }}" id="q_unit" class="hidden">
                        <div id="q_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="q_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q_unit', 'J')">J</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q_unit', 'kJ')">kJ</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q_unit', 'mJ')">mJ</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q_unit', 'Wh')">Wh</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q_unit', 'kWh')">kWh</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q_unit', 'ft-lbs')">ft-lbs</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q_unit', 'kcal')">kcal</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q_unit', 'eV')">eV</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 px-2" id="it">
                    <label for="it_" class="font-s-14 text-blue">{{ $lang[5] .' '. $lang['19'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="it" id="it_" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['it']) ? $_POST['it'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="it_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('it_unit_dropdown')">{{ isset($_POST['it_unit'])?$_POST['it_unit']:'°C' }} ▾</label>
                        <input type="text" name="it_unit" value="{{ isset($_POST['it_unit'])?$_POST['it_unit']:'°C' }}" id="it_unit" class="hidden">
                        <div id="it_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="it_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('it_unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('it_unit', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('it_unit', 'K')">K</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 px-2" id="ft">
                    <label for="ft_" class="font-s-14 text-blue">{{ $lang[6] .' '. $lang['19'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="ft" id="ft_" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ft']) ? $_POST['ft'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="ft_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ft_unit_dropdown')">{{ isset($_POST['ft_unit'])?$_POST['ft_unit']:'°C' }} ▾</label>
                        <input type="text" name="ft_unit" value="{{ isset($_POST['ft_unit'])?$_POST['ft_unit']:'°C' }}" id="ft_unit" class="hidden">
                        <div id="ft_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ft_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ft_unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ft_unit', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ft_unit', 'K')">K</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 px-2" id="dt">
                    <label for="dt_" class="font-s-14 text-blue"><?=$lang['8']?> <?=$lang['10']?> <?=$lang['19']?> (ΔT):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="dt" id="dt_" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dt']) ? $_POST['dt'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dt_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dt_unit_dropdown')">{{ isset($_POST['dt_unit'])?$_POST['dt_unit']:'°C' }} ▾</label>
                        <input type="text" name="dt_unit" value="{{ isset($_POST['dt_unit'])?$_POST['dt_unit']:'°C' }}" id="dt_unit" class="hidden">
                        <div id="dt_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dt_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dt_unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dt_unit', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dt_unit', 'K')">K</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 px-2" id="m">
                    <label for="m_" class="font-s-14 text-blue"><?=$lang['4']?> (m):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="m" id="m_" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m']) ? $_POST['m'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="m_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m_unit_dropdown')">{{ isset($_POST['m_unit'])?$_POST['m_unit']:'µg' }} ▾</label>
                        <input type="text" name="m_unit" value="{{ isset($_POST['m_unit'])?$_POST['m_unit']:'µg' }}" id="m_unit" class="hidden">
                        <div id="m_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'µg')">µg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'mg')">mg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'g')">g</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'kg')">kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 't')">t</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'oz')">oz</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'lb')">lb</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'stone')">stone</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'US ton')">US ton</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'Long ton')">Long ton</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'Earths')">Earths</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'me')">me</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'u')">u</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'oz t')">oz t</p>

                        </div>
                     </div>
                </div>
                <div class="col-span-6 px-2" id="c">
                    <label for="c_" class="font-s-14 text-blue"><?=$lang['11']?> <?=$lang['22']?> (c):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="c" id="c_" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['c']) ? $_POST['c'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="c_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('c_unit_dropdown')">{{ isset($_POST['c_unit'])?$_POST['c_unit']:'J/(kg·K)' }} ▾</label>
                        <input type="text" name="c_unit" value="{{ isset($_POST['c_unit'])?$_POST['c_unit']:'J/(kg·K)' }}" id="c_unit" class="hidden">
                        <div id="c_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="c_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'J/(kg·K)')">J/(kg·K)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'J/(g·K)')">J/(g·K)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'cal/(kg·K)')">cal/(kg·K)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'cal/(g·K)')">cal/(g·K)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'kcal/(kg·K)')">kcal/(kg·K)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'J/(kg·°C)')">J/(kg·°C)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'J/(g·°C)')">J/(g·°C)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'cal/(kg·°C)')">cal/(kg·°C)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'cal/(g·°C)')">cal/(g·°C)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'kcal/(kg·°C)')">kcal/(kg·°C)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 px-2" id="sub">
                    <label for="subs" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="sub" id="subs" class="input">
                            @php
                                $name = ["Custom","Acetals (solid)","Air (gas, room cond.)","Air (sea level, dry, 0°C","Aluminum (solid)","Ammonia (liquid)","Animal tissue (mixed)","Antimony (solid)","Argon (gas)","Arsenic (solid)","Asphalt (solid)","Beryllium (solid)","Bismuth (solid)","Brick (solid)","Cadmium (solid)","Carbon Dioxide (gas)","Chromium (solid)","Concrete (solid)","Copper (solid)","Diamond (solid)","Ethanol (liquid)","Gasoline (octane, liquid)","Glass (solid)","Glass, crown (solid)","Glass, flint (solid)","Glass, pyrex (solid)","Gold (solid)","Granite (solid)","Graphite (solid)","Gypsum (solid)","Helium (gas)","Hydrogen (gas)","Hydrogen sulfide (gas)","Iron (solid)","Lead (solid)","Lithium (solid)","Lithium at 181°C (liquid)","Magnesium (solid)","Marble, mica (solid)","Mercury (liquid)","Methane at 2°C (gas)","Methanol (liquid)","Molten salt (liquid)","Neon (gas)","Nitrogen (gas)","Oxygen (gas)","Paraffin wax (solid)","Polyethylene (solid)","Sand (solid)","Silica (fused) (solid)","Silver[31] (solid)","Sodium (solid)","Soil (solid)","Steel (solid)","Tin (solid)","Titanium (solid)","Tungsten (solid)","Uranium (solid)","Water at -10 °C (ice) (solid)","Water at 25 °C (liquid)","Water at 100 °C (gas)","Wood (1200 to 2900) (solid)","Zinc (solid)"];
                                $val = ["select","1460@Acetals (solid)","1012@Air (gas, room cond.)","1003.5@Air (sea level, dry, 0°C","897@Aluminum (solid)","4700@Ammonia (liquid)","3500@Animal tissue (mixed)","207@Antimony (solid)","520.3@Argon (gas)","328@Arsenic (solid)","920@Asphalt (solid)","1820@Beryllium (solid)","123@Bismuth (solid)","840@Brick (solid)","231@Cadmium (solid)","839@Carbon Dioxide (gas)","449@Chromium (solid)","880@Concrete (solid)","385@Copper (solid)","509.1@Diamond (solid)","2440@Ethanol (liquid)","2220@Gasoline (octane, liquid)","840@Glass (solid)","670@Glass, crown (solid)","503@Glass, flint (solid)","753@Glass, pyrex (solid)","129@Gold (solid)","790@Granite (solid)","710@Graphite (solid)","1090@Gypsum (solid)","5193.2@Helium (gas)","14300@Hydrogen (gas)","1015@Hydrogen sulfide (gas)","412@Iron (solid)","129@Lead (solid)","3580@Lithium (solid)","4379@Lithium at 181°C (liquid)","1020@Magnesium (solid)","880@Marble, mica (solid)","139.5@Mercury (liquid)","2191@Methane at 2°C (gas)","2140@Methanol (liquid)","1560@Molten salt (liquid)","1030.1@Neon (gas)","1040@Nitrogen (gas)","918@Oxygen (gas)","2500@Paraffin wax (solid)","2302.7@Polyethylene (solid)","835@Sand (solid)","703@Silica (fused) (solid)","233@Silver[31] (solid)","1230@Sodium (solid)","800@Soil (solid)","466@Steel (solid)","227@Tin (solid)","523@Titanium (solid)","134@Tungsten (solid)","116@Uranium (solid)","2050@Water at -10 °C (ice) (solid)","4181.3@Water at 25 °C (liquid)","2080@Water at 100 °C (gas)","1700@Wood (1200 to 2900) (solid)","387@Zinc (solid)"];
                                optionsList($val,$name,isset($_POST['sub'])?$_POST['sub']:'select');
                            @endphp
                        </select>
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
                    @php
                        error_reporting(0);
                        $q1=$detail['q1'];
                        $it1=$detail['it1'];
                        $ft1=$detail['ft1'];
                        $dt1=$detail['dt1'];
                        $m1=$detail['m1'];
                        $c1=$detail['c1'];
                        $q_val=$detail['q'];
                        $c_val=$detail['c'];
                        $check=$detail['check'];
                        $m_val=$detail['m'];
                        $it_val=$detail['it'];
                        $ft_val=$detail['ft'];
                        $s=$detail['s'];
                        $s1=$detail['s1'];
                        $sub_val=$detail['sub'];
                        $sub_name=$detail['sub1'];
                    @endphp
                    <div class="w-full">
                        <div class="col s12 padding_20 padding_10_mbl form-bg">
                            <?php if(isset($q_val)){ ?>
                                <div class="text-center">
                                    <p class="text-[18px]">
                                        <strong><?= $lang[2] ?></strong>
                                    </p>
                                    <p class="text-[21px] bg-white px-3 py-2 radius-10 d-inline-block my-3">
                                        <strong class="text-blue">{{ $q_val }} J</strong>
                                    </p>
                                </div>
                            <?php }elseif(isset($c_val)){ ?>
                                <div class="col-lg-8 mt-2 overflow-auto">
                                    <table class="w-100 text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?=$lang['11']?> <?=$lang['13']?></td>
                                            <td class="py-2 border-b"><strong><?=$c_val?></strong> J/(kg·K)</td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="margin_top_20 padding_b_10 center"><strong>Result in other units:</strong></p>
                                <div class="col-lg-8 mt-2 overflow-auto">
                                    <table class="w-100 text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?=$lang['11']?> <?=$lang['13']?></td>
                                            <td class="py-2 border-b"><strong><?=$c_val*0.001?></strong> J/(g·K)</td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?=$lang['11']?> <?=$lang['13']?></td>
                                            <td class="py-2 border-b"><strong><?=$c_val*0.2388915?></strong> cal/(kg·K)</td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?=$lang['11']?> <?=$lang['13']?></td>
                                            <td class="py-2 border-b"><strong><?=$c_val*0.0002388915?></strong> kcal/(kg·K)</td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?=$lang['11']?> <?=$lang['13']?></td>
                                            <td class="py-2 border-b"><strong><?=$c_val*0.001?></strong> J/(g·°C)</td>
                                        </tr>
                                    </table>
                                </div>
                            <?php }elseif(isset($m_val)){ ?>
                                <div class="text-center">
                                    <p class="text-[18px]">
                                        <strong><?= $lang[4] ?></strong>
                                    </p>
                                    <p class="text-[21px] bg-sky px-3 py-2  my-3">
                                        <strong class="text-blue">{{ $m_val }} kg</strong>
                                    </p>
                                </div>
                            <?php }elseif(isset($it_val)){ ?>
                                <div class="text-center">
                                    <p class="text-[18px]">
                                        <strong><?= $lang[5] ?></strong>
                                    </p>
                                    <p class="text-[21px] bg-sky px-3 py-2  my-3">
                                        <strong class="text-blue">{{ $it_val }} K</strong>
                                    </p>
                                </div>
                            <?php }elseif(isset($ft_val)){ ?>
                                <div class="text-center">
                                    <p class="text-[18px]">
                                        <strong><?= $lang[6] ?></strong>
                                    </p>
                                    <p class="text-[21px] bg-sky px-3 py-2  my-3">
                                        <strong class="text-blue">{{ $ft_val }} K</strong>
                                    </p>
                                </div>
                            <?php } ?>
                            <?php if(isset($sub_val)){ ?>
                                <p class="col-12 mt-3"><strong><?=$lang['14']?> <?=$sub_name?> <?=$lang['15']?> <?=$sub_val?></strong></p>
                            <?php } ?>
                        </div>
                        <p class="col-12 mt-3 text-[18px]"><strong class="text-blue"><?=$lang['16']?></strong></p>
                        <?php if(isset($q_val)){ ?>
                            <p class="col-12 mt-3"><strong><?=$lang['2']?> <?=$lang['17']?></strong></p>
                            <p class="col-12 mt-3">\( Q =	{ m c \Delta T} \)</p>
                            <p class="col-12 mt-3"><strong><?=$lang['18']?></strong></p>
                            <p class="col-12 mt-3">\( m = \text{<?=$lang['4']?>} \)</p>
                            <p class="col-12 mt-3">\( c = \text{<?=$lang['11']?> <?=$lang['13']?>} \)</p>
                            <?php if($check==='q_i_f'){ ?>
                                <p class="col-12 mt-3">\( T_i = \text{<?=$lang['5']?> <?=$lang['19']?>} \)</p>
                                <p class="col-12 mt-3">\( T_f = \text{<?=$lang['6']?> <?=$lang['19']?>} \)</p>
                                <p class="col-12 mt-3">\( Q = <?=$q1?>,\space c = <?=$c1?>,\space T_i = <?=$it1?>,\space T_f = <?=$ft1?> \)</p>
                            <?php }else{ ?>
                                <p class="col-12 mt-3">\( \Delta T = \text{<?=$lang['8']?> <?=$lang['20']?> <?=$lang['19']?>} \)</p>
                                <p class="col-12 mt-3">\( Q = <?=$q1?>,\space c = <?=$c1?>,\space \Delta T = <?=$dt1?> \)</p>
                            <?php } ?>
                            <?php if($check==='q_i_f'){ ?>
                                <p class="col-12 mt-3"><strong><?=$lang['1']?> <?=$lang['8']?> <?=$lang['20']?> <?=$lang['23']?></strong></p>
                                <p class="col-12 mt-3">\( \Delta T =	T_f - T_i \)</p>
                                <p class="col-12 mt-3">\( \Delta T =	<?=$ft1?> - <?=$it1?> \)</p>
                                <p class="col-12 mt-3">\( \Delta T =	<?=$ft1-$it1?> \)</p>
                            <?php } ?>
                            <p class="col-12 mt-3"><strong><?=$lang['21']?></strong></p>
                            <p class="col-12 mt-3">\( Q =	{m c \Delta T} \)</p>
                            <p class="col-12 mt-3">\( Q =	{(<?=$m1?>) (<?=$c1?>) (<?=$dt1?>)} \)</p>
                            <p class="col-12 mt-3">\( Q =	{(<?=$s?>) (<?=$dt1?>)} \)</p>
                            <p class="col-12 mt-3">\( Q =	<?=$q_val?> \)</p>
                        <?php }elseif(isset($c_val)){ ?>
                            <p class="col-12 mt-3"><strong><?=$lang['3']?> <?=$lang['17']?></strong></p>
                            <p class="col-12 mt-3">\( c = \dfrac{Q}{m \Delta T} \)</span></p>
                            <p class="col-12 mt-3"><strong><?=$lang['18']?></strong></p>
                            <p class="col-12 mt-3">\( Q = \text{<?=$lang['2']?>} \)</p>
                            <p class="col-12 mt-3">\( m = \text{<?=$lang['4']?>} \)</p>
                            <?php if($check==='c_i_f'){ ?>
                                <p class="col-12 mt-3">\( T_i = \text{<?=$lang['5']?> <?=$lang['19']?>} \)</p>
                                <p class="col-12 mt-3">\( T_f = \text{<?=$lang['6']?> <?=$lang['19']?>} \)</p>
                                <p class="col-12 mt-3">\( Q = <?=$q1?>,\space m = <?=$m1?>,\space T_i = <?=$it1?>,\space T_f = <?=$ft1?> \)</p>
                            <?php }else{ ?>
                                <p class="col-12 mt-3">\( \Delta T = \text{<?=$lang['8']?> <?=$lang['20']?> <?=$lang['19']?>} \)</p>
                                <p class="col-12 mt-3">\( Q = <?=$q1?>,\space m = <?=$m1?>,\space \Delta T = <?=$dt1?> \)</p>
                            <?php } ?>
                            <?php if($check==='c_i_f'){ ?>
                                <p class="col-12 mt-3"><strong><?=$lang['1']?> <?=$lang['8']?> <?=$lang['20']?> <?=$lang['23']?></strong></p>
                                <p class="col-12 mt-3">\( \Delta T =	T_f - T_i \)</p>
                                <p class="col-12 mt-3">\( \Delta T =	<?=$ft1?> - <?=$it1?> \)</p>
                                <p class="col-12 mt-3">\( \Delta T =	<?=$ft1-$it1?> \)</p>
                            <?php } ?>
                            <p class="col-12 mt-3"><strong><?=$lang['21']?></strong></p>
                            <p class="col-12 mt-3">\( c = \dfrac{Q}{m \Delta T} \)</p>
                            <p class="col-12 mt-3">\( c = \dfrac{<?=$q1?>}{(<?=$m1?>)(<?=$dt1?>)} \)</p>
                            <p class="col-12 mt-3">\( c = \dfrac{<?=$q1?>}{<?=$s?>} \)</p>
                            <p class="col-12 mt-3">\( c = <?=$c_val?> \)</p>
                        <?php }elseif(isset($m_val)){ ?>
                            <p class="col-12 mt-3"><strong><?=$lang['4']?> <?=$lang['17']?></strong></p>
                            <p class="col-12 mt-3">\( m =	\dfrac{Q}{c \Delta T} \)</p>
                            <p class="col-12 mt-3"><strong><?=$lang['18']?></strong></p>
                            <p class="col-12 mt-3">\( Q = \text{<?=$lang['2']?>} \)</p>
                            <p class="col-12 mt-3">\( c = \text{<?=$lang['11']?> <?=$lang['13']?>} \)</p>
                            <?php if($check==='m_i_f'){ ?>
                                <p class="col-12 mt-3">\( T_i = \text{<?=$lang['5']?> <?=$lang['19']?>} \)</p>
                                <p class="col-12 mt-3">\( T_f = \text{<?=$lang['6']?> <?=$lang['19']?>} \)</p>
                                <p class="col-12 mt-3">\( Q = <?=$q1?>,\space c = <?=$c1?>,\space T_i = <?=$it1?>,\space T_f = <?=$ft1?> \)</p>
                            <?php }else{ ?>
                                <p class="col-12 mt-3">\( \Delta T = \text{<?=$lang['8']?> <?=$lang['20']?> <?=$lang['19']?>} \)</p>
                                <p class="col-12 mt-3">\( Q = <?=$q1?>,\space c = <?=$c1?>,\space \Delta T = <?=$dt1?> \)</p>
                            <?php } ?>
                            <?php if($check==='m_i_f'){ ?>
                                <p class="col-12 mt-3"><strong><?=$lang['1']?> <?=$lang['8']?> <?=$lang['20']?> <?=$lang['23']?></strong></p>
                                <p class="col-12 mt-3">\( \Delta T =	T_f - T_i \)</p>
                                <p class="col-12 mt-3">\( \Delta T =	<?=$ft1?> - <?=$it1?> \)</p>
                                <p class="col-12 mt-3">\( \Delta T =	<?=$ft1-$it1?> \)</p>
                            <?php } ?>
                            <p class="col-12 mt-3"><strong><?=$lang['21']?></strong></p>
                            <p class="col-12 mt-3">\( m =	\dfrac{Q}{c \Delta T} \)</p>
                            <p class="col-12 mt-3">\( m =	\dfrac{<?=$q1?>}{(<?=$c1?>)(<?=$dt1?>)} \)</p>
                            <p class="col-12 mt-3">\( m =	\dfrac{<?=$q1?>}{<?=$s?>} \)</p>
                            <p class="col-12 mt-3">\( m = <?=$m_val?> \)</span></p>
                        <?php }elseif(isset($it_val)){ ?>
                            <p class="col-12 mt-3"><strong><?=$lang['5']?> <?=$lang['23']?> <?=$lang['17']?></strong></p>
                            <p class="col-12 mt-3">\( T_i = \dfrac{Q}{m c} - T_f \)</p>
                            <p class="col-12 mt-3"><strong><?=$lang['18']?></strong></p>
                            <p class="col-12 mt-3">\( Q = \text{<?=$lang['2']?>} \)</p>
                            <p class="col-12 mt-3">\( m = \text{<?=$lang['4']?>} \)</p>
                            <p class="col-12 mt-3">\( c = \text{<?=$lang['11']?> <?=$lang['13']?>} \)</p>
                            <p class="col-12 mt-3">\( T_f = \text{<?=$lang['6']?> <?=$lang['19']?>} \)</p>
                            <p class="col-12 mt-3">\( Q = <?=$q1?>,\space m = <?=$m1?>,\space c = <?=$c1?>,\space T_f = <?=$ft1?> \)</p>
                            <p class="col-12 mt-3"><strong><?=$lang['21']?></strong></p>
                            <p class="col-12 mt-3">\( T_i = \dfrac{Q}{m c} - T_f \)</p>
                            <p class="col-12 mt-3">\( T_i = \dfrac{<?=$q1?>}{(<?=$m1?>) (<?=$c1?>)} - <?=$ft1?> \)</p>
                            <p class="col-12 mt-3">\( T_i = \dfrac{<?=$q1?>}{<?=$s?>} - <?=$ft1?> \)</p>
                            <p class="col-12 mt-3">\( T_i = <?=$s1?> - <?=$ft1?> \)</p>
                            <p class="col-12 mt-3">\( T_i = <?=$it_val?> \)</p>
                        <?php }elseif(isset($ft_val)){ ?>
                            <p class="col-12 mt-3"><strong><?=$lang['6']?> <?=$lang['19']?> <?=$lang['17']?></strong></p>
                            <p class="col-12 mt-3">\( T_f = \dfrac{Q}{m c} + T_i \)</p>
                            <p class="col-12 mt-3"><strong><?=$lang['18']?></strong></p>
                            <p class="col-12 mt-3">\( Q = \text{<?=$lang['2']?>} \)</p>
                            <p class="col-12 mt-3">\( m = \text{<?=$lang['4']?>} \)</p>
                            <p class="col-12 mt-3">\( c = \text{<?=$lang['11']?> <?=$lang['13']?>} \)</p>
                            <p class="col-12 mt-3">\( T_i = \text{<?=$lang['5']?> <?=$lang['19']?>} \)</p>
                            <p class="col-12 mt-3">\( Q = <?=$q1?>,\space m = <?=$m1?>,\space c = <?=$c1?>,\space T_i = <?=$it1?> \)</p>
                            <p class="col-12 mt-3"><strong><?=$lang['21']?></strong></p>
                            <p class="col-12 mt-3">\( T_f =	\dfrac{Q}{m c} + T_i \)</p>
                            <p class="col-12 mt-3">\( T_f = \dfrac{<?=$q1?>}{(<?=$m1?>) (<?=$c1?>)} + <?=$it1?> \)</p>
                            <p class="col-12 mt-3">\( T_f = \dfrac{<?=$q1?>}{<?=$s?>} \)</span>\( + \space <?=$it1?> \)</p>
                            <p class="col-12 mt-3">\( T_f = <?=$s1?> + <?=$it1?> \)</p>
                            <p class="col-12 mt-3">\( T_f = <?=$ft_val?> \)</p>
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
        @if (isset($detail))
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @endif
        document.querySelectorAll('.change').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('dt').style.display = 'block';
                document.getElementById('it').style.display = 'none';
                document.getElementById('ft').style.display = 'none';
            });
        });

        document.querySelectorAll('.i_f_t').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('it').style.display = 'block';
                document.getElementById('ft').style.display = 'block';
                document.getElementById('dt').style.display = 'none';
            });
        });

        function find() {
            const findValue = document.getElementById('find').value;
            const byValue = document.querySelector('input[name="by"]:checked').value;

            const showElements = (selectors) => {
                selectors.forEach(selector => document.getElementById(selector).style.display = 'block');
            };

            const hideElements = (selectors) => {
                selectors.forEach(selector => document.getElementById(selector).style.display = 'none');
            };

            switch(findValue) {
                case 'energy':
                    showElements(['dt', 'm', 'c', 'by']);
                    hideElements(['q', 'it', 'ft']);
                    if(byValue === 'change') {
                        showElements(['dt', 'm', 'c']);
                        hideElements(['q', 'it', 'ft']);
                    } else if(byValue === 'i_f_t') {
                        showElements(['it', 'ft', 'm', 'c']);
                        hideElements(['q', 'dt']);
                    }
                    break;
                case 'specific_heat':
                    showElements(['q', 'dt', 'm', 'by']);
                    hideElements(['c', 'it', 'ft']);
                    if(byValue === 'change') {
                        showElements(['q', 'dt', 'm']);
                        hideElements(['c', 'it', 'ft']);
                    } else if(byValue === 'i_f_t') {
                        showElements(['it', 'ft', 'm', 'q']);
                        hideElements(['c', 'dt']);
                    }
                    break;
                case 'mass':
                    showElements(['q', 'dt', 'c', 'by']);
                    hideElements(['m', 'it', 'ft']);
                    if(byValue === 'change') {
                        showElements(['q', 'dt', 'c']);
                        hideElements(['m', 'it', 'ft']);
                    } else if(byValue === 'i_f_t') {
                        showElements(['it', 'ft', 'q', 'c']);
                        hideElements(['m', 'dt']);
                    }
                    break;
                case 'itemp':
                    showElements(['q', 'ft', 'm', 'c']);
                    hideElements(['it', 'dt', 'by']);
                    break;
                case 'ftemp':
                    showElements(['q', 'it', 'm', 'c']);
                    hideElements(['ft', 'dt', 'by']);
                    break;
            }
        }

        document.getElementById('find').addEventListener('change', find);

        // Call find() initially to set the correct state
        find();

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>