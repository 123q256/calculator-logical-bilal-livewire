<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="grid grid-cols-12  mt-3  gap-2">
                <div class="col-span-12 mx-auto px-2">
                    <label for="method" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="method" id="method" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'],$lang['3'],$lang['4']];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset($_POST['method'])?$_POST['method']:'0');
                            @endphp
                        </select>
                    </div>
                </div>
                <div id="g-hide" class="col-span-12">
                    <div class="row">
                        <strong class="col-12 mt-2 px-2">{{ $lang[5] }}:</strong>
                        <div class="col-12 px-2 mb-3 mt-3 d-flex align-items-center">
                            @if (isset($_POST['g']))
                                @if ($_POST['g']=='ang_vel')
                                    <input name="g" id="g" class="g1 mx-1" value="ang_vel" type="radio" checked />
                                @else
                                    <input name="g" id="g" class="g1 mx-1" value="ang_vel" type="radio" />
                                @endif
                            @else
                                <input name="g" id="g" class="g1 mx-1" value="ang_vel" type="radio" checked />
                            @endif
                            <label for="g" class="font-s-14 text-blue px-1">{{ $lang['6'] }}</label>
                            @if (isset($_POST['g']) && $_POST['g']=='ang_chnge')
                                <input name="g" id="g1" class="g2 ms-2" value="ang_chnge" type="radio" checked />
                            @else
                                <input name="g" id="g1" class="g2 ms-2" value="ang_chnge" type="radio" />
                            @endif
                            <label for="g1" class="font-s-14 text-blue px-1">{{ $lang['7'] }}</label>
                            @if (isset($_POST['g']) && $_POST['g']=='time')
                                <input name="g" id="g2" class="g3 ms-2" value="time" type="radio" checked />
                            @else
                                <input name="g" id="g2" class="g3 ms-2" value="time" type="radio" />
                            @endif
                            <label for="g2" class="font-s-14 text-blue ps-1">{{ $lang['8'] }}</label>
                            <input type="hidden" name="check" id="check" value="g1_value">
                        </div>
                    </div>
                </div>
                <div id="g-hide1" class="col-span-12">
                    <div class="row">
                        <strong class="col-12 mt-2 px-2">{{ $lang[5] }}:</strong>
                        <div class="col-12 px-2 mb-3 mt-3 d-flex align-items-center">
                            @if (isset($_POST['gg']))
                                @if ($_POST['gg']=='ang_vel1')
                                    <input name="gg" id="gg" class="g11 mx-1" value="ang_vel1" type="radio" checked />
                                @else
                                    <input name="gg" id="gg" class="g11 mx-1" value="ang_vel1" type="radio" />
                                @endif
                            @else
                                <input name="gg" id="gg" class="g11 mx-1" value="ang_vel1" type="radio" checked />
                            @endif
                            <label for="gg" class="font-s-14 text-blue px-1">{{ $lang['6'] }}</label>
                            @if (isset($_POST['gg']) && $_POST['gg']=='velocity')
                                <input name="gg" id="gg1" class="g21 ms-2" value="velocity" type="radio" checked />
                            @else
                                <input name="gg" id="gg1" class="g21 ms-2" value="velocity" type="radio" />
                            @endif
                            <label for="gg1" class="font-s-14 text-blue px-1">{{ $lang['9'] }}</label>
                            @if (isset($_POST['gg']) && $_POST['gg']=='radius')
                                <input name="gg" id="gg2" class="g31 ms-2" value="radius" type="radio" checked />
                            @else
                                <input name="gg" id="gg2" class="g31 ms-2" value="radius" type="radio" />
                            @endif
                            <label for="gg2" class="font-s-14 text-blue ps-1">{{ $lang['10'] }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-span-6" id="ac">
                    <label for="ac_" class="font-s-14 text-blue">{{ $lang['7'] }} (Δα):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="ac" id="ac_" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ac'])?$_POST['ac']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="ac1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ac1_dropdown')">{{ isset($_POST['ac1'])?$_POST['ac1']:'deg' }} ▾</label>
                       <input type="text" name="ac1" value="{{ isset($_POST['ac1'])?$_POST['ac1']:'deg' }}" id="ac1" class="hidden">
                       <div id="ac1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ac1">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ac1', 'deg')">deg</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ac1', 'rad')">rad</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ac1', 'gon')">gon</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ac1', 'tr')">tr</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ac1', 'arcmin')">arcmin</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ac1', 'arcsec')">arcsec</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ac1', 'mrad')">mrad</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ac1', 'urad')">urad</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ac1', 'pirad')">pirad</p>
                        
                       </div>
                    </div>
                  </div>
                  <div class="col-span-6" id="t">
                    <label for="t_" class="font-s-14 text-blue">{{ $lang['8'] }} (t):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="t" id="t_" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['t'])?$_POST['t']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="t1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t1_dropdown')">{{ isset($_POST['t1'])?$_POST['t1']:'sec' }} ▾</label>
                       <input type="text" name="t1" value="{{ isset($_POST['t1'])?$_POST['t1']:'sec' }}" id="t1" class="hidden">
                       <div id="t1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t1">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1', 'sec')">sec</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1', 'min')">min</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1', 'hrs')">hrs</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1', 'days')">days</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1', 'weeks')">weeks</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1', 'months')">months</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1', 'year')">year</p>
                       </div>
                    </div>
                  </div>
                  <div class="col-span-6" id="av">
                    <label for="av_" class="font-s-14 text-blue">{{ $lang['6'] }} (ω):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="av" id="av_" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['av'])?$_POST['av']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="av1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('av1_dropdown')">{{ isset($_POST['av1'])?$_POST['av1']:'rad/s' }} ▾</label>
                       <input type="text" name="av1" value="{{ isset($_POST['av1'])?$_POST['av1']:'rad/s' }}" id="av1" class="hidden">
                       <div id="av1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="av1">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('av1', 'rad/s')">rad/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('av1', 'rpm')">rpm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('av1', 'hz')">hz</p>
                       </div>
                    </div>
                  </div>
                  <div class="col-span-6" id="vel">
                    <label for="vel_" class="font-s-14 text-blue">{{ $lang['9'] }} (v):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="vel" id="vel_" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['vel'])?$_POST['vel']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="vel1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('vel1_dropdown')">{{ isset($_POST['vel1'])?$_POST['vel1']:'m/s' }} ▾</label>
                       <input type="text" name="vel1" value="{{ isset($_POST['vel1'])?$_POST['vel1']:'m/s' }}" id="vel1" class="hidden">
                       <div id="vel1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="vel1">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vel1', 'm/s')">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vel1', 'km/h')">km/h</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vel1', 'ft/s')">ft/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vel1', 'mi/s')">mi/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vel1', 'mi/h')">mi/h</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vel1', 'knots')">knots</p>
                       </div>
                    </div>
                  </div>
                  <div class="col-span-6" id="rds">
                    <label for="rad_" class="font-s-14 text-blue">{{ $lang['10'] }} (r):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="rad" id="rad_" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rad'])?$_POST['rad']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="rad1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rad1_dropdown')">{{ isset($_POST['rad1'])?$_POST['rad1']:'mm' }} ▾</label>
                       <input type="text" name="rad1" value="{{ isset($_POST['rad1'])?$_POST['rad1']:'mm' }}" id="rad1" class="hidden">
                       <div id="rad1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rad1">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad1', 'mm')">mm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad1', 'cm')">cm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad1', 'm')">m</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad1', 'km')">km</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad1', 'in')">in</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad1', 'ft')">ft</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad1', 'yd')">yd</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad1', 'mi')">mi</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad1', 'nmi')">nmi</p>
                       </div>
                    </div>
                  </div>
               
                <div class="col-span-6" id="rpm">
                    <label for="rpm_" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="rpm" id="rpm_" class="input" value="{{ isset($_POST['rpm'])?$_POST['rpm']:'10' }}" aria-label="input" plveleholder="00" />
                    </div>
                </div>
                <div class="col-span-6" id="rds_m">
                    <label for="rds_m_" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="rds_m" id="rds_m_" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rds_m'])?$_POST['rds_m']:'1.5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="rds_m1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rds_m1_dropdown')">{{ isset($_POST['rds_m1'])?$_POST['rds_m1']:'m' }} ▾</label>
                       <input type="text" name="rds_m1" value="{{ isset($_POST['rds_m1'])?$_POST['rds_m1']:'m' }}" id="rds_m1" class="hidden">
                       <div id="rds_m1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rds_m1">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rds_m1', 'm')">m</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rds_m1', 'cm')">cm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rds_m1', 'in')">in</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rds_m1', 'ft')">ft</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rds_m1', 'in')">in</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rds_m1', 'yd')">yd</p>
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
                    @php
                        $ans = $detail['ans'];
                        $res_unit = $detail['res_unit'];
                        if (isset($detail['ang_chnge'])) {
                            $head = $lang['7'] . " (Δα)";
                        } elseif (isset($detail['time'])) {
                            $head = $lang['8'] . " (t)";
                        } elseif (isset($detail['velocity'])) {
                            $head = $lang['9'] . " (v)";
                        } elseif (isset($detail['radius'])) {
                            $head = $lang['10'] . " (r)";
                        } else {
                            $head = $lang['6'] . " (ω)";
                        }
                    @endphp
                    <div class="w-full">
                        <div class="w-full md:w-[70%] lg:w-[70%] mt-2 overflow-auto">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $head }}</td>
                                    <td class="py-2 border-b"><strong>{{ $ans }} {{ $res_unit }}</strong></td>
                                </tr>
                                @if (isset($detail['rpm']))
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['9']}}</td>
                                        <td class="py-2 border-b"><strong>{{ $detail['l_v'] }} m/s</strong></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <p class="w-full mt-3"><strong><?= $lang['12'] ?></strong></p>
                        <div class="w-full md:w-[70%] lg:w-[70%] overflow-auto">
                            <table class="w-100 font-s-18">
                                <?php if (isset($detail['ang_vel']) || isset($detail['ang_vel1'])) { ?>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['6'] ?> (ω)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['ang_vel_rpm'] ?> <?= $lang['13'] ?> (rpm)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['6'] ?> (ω)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['ang_vel_hertz'] ?> <?= $lang['14'] ?> (Hz)</strong></td>
                                    </tr>
                                <?php } elseif (isset($detail['ang_chnge'])) { ?>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['7'] ?> (Δα)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['ang_chnge_deg'] ?> <?= $lang['34'] ?> (deg)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['7'] ?> (Δα)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['ang_chnge_gon'] ?> <?= $lang['35'] ?> (gon)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['7'] ?> (Δα)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['ang_chnge_tr'] ?> <?= $lang['36'] ?> (tr)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['7'] ?> (Δα)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['ang_chnge_arcmin'] ?> <?= $lang['37'] ?> (arcmin)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['7'] ?> (Δα)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['ang_chnge_arcsec'] ?> <?= $lang['38'] ?> (arcsec)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['7'] ?> (Δα)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['ang_chnge_mrad'] ?> <?= $lang['39'] ?> (mrad)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['7'] ?> (Δα)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['ang_chnge_urad'] ?> <?= $lang['40'] ?> (μrad)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['7'] ?> (Δα)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['ang_chnge_pirad'] ?> π <?= $lang['41'] ?> (* π rad)</strong></td>
                                    </tr>
                                <?php } elseif (isset($detail['time'])) { ?>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['8'] ?> (t)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['t_min'] ?> <?= $lang['15'] ?> (min)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['8'] ?> (t)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['t_hrs'] ?> <?= $lang['16'] ?> (hrs)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['8'] ?> (t)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['t_days'] ?> <?= $lang['30'] ?> (days)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['8'] ?> (t)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['t_wks'] ?> <?= $lang['31'] ?> (wks)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['8'] ?> (t)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['t_mos'] ?> <?= $lang['32'] ?> (mos)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['8'] ?> (t)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['t_yrs'] ?> <?= $lang['33'] ?> (yrs)</strong></td>
                                    </tr>
                                <?php } elseif (isset($detail['velocity'])) { ?>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['9'] ?> (v)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['vel_kmps'] ?> <?= $lang['23'] ?> (km/s)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['9'] ?> (v)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['vel_kmph'] ?> <?= $lang['24'] ?> (km/h)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['9'] ?> (v)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['vel_ftps'] ?> <?= $lang['14'] ?> (ft/s)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['9'] ?> (v)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['vel_mips'] ?> <?= $lang['25'] ?> (mi/s)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['9'] ?> (v)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['vel_miph'] ?> <?= $lang['14'] ?> (mi/h)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['9'] ?> (v)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['vel_knots'] ?> <?= $lang['27'] ?></strong></td>
                                    </tr>
                                <?php } elseif (isset($detail['radius'])) { ?>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['10'] ?> (r)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['rad_mm'] ?> <?= $lang['48'] ?> (mm)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['10'] ?> (r)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['rad_cm'] ?> <?= $lang['47'] ?> (cm)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['10'] ?> (r)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['rad_km'] ?> <?= $lang['46'] ?> (km)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['10'] ?> (r)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['rad_in'] ?> <?= $lang['20'] ?> (in)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['10'] ?> (r)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['rad_ft'] ?> <?= $lang['18'] ?> (ft)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['10'] ?> (r)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['rad_yd'] ?> <?= $lang['21'] ?> (yd)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['10'] ?> (r)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['rad_mi'] ?> <?= $lang['28'] ?> (mi)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['10'] ?> (r)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['rad_nmi'] ?> <?= $lang['29'] ?> (nmi)</strong></td>
                                    </tr>
                                <?php } elseif (isset($detail['rpm'])) { ?>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['6'] ?> (ω)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['ang_vel_rpm'] ?> <?= $lang['13'] ?> (rpm)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['6'] ?> (ω)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['ang_vel_hertz'] ?> <?= $lang['14'] ?> (Hz)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['9'] ?> (v)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['vel_kmps'] ?> <?= $lang['23'] ?> (km/s)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['9'] ?> (v)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['vel_kmph'] ?> <?= $lang['14'] ?> (km/h)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['9'] ?> (v)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['vel_ftps'] ?> <?= $lang['22'] ?> (ft/s)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['9'] ?> (v)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['vel_mips'] ?> <?= $lang['14'] ?> (mi/s)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['9'] ?> (v)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['vel_miph'] ?> <?= $lang['26'] ?> (mi/h)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?= $lang['9'] ?> (v)</td>
                                        <td class="py-2 border-b"><strong><?= $detail['vel_knots'] ?> <?= $lang['27'] ?></strong></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <p class="w-full   mt-3 font-s-18"><strong class="text-blue"><?= $lang['42'] ?>:</strong></p>
                        <?php if (isset($detail['ang_vel'])) {
                            $ac = $detail['ac'];
                            $t = $detail['t'];
                        ?>
                            <p class="w-full  mt-3"><strong><?= $lang['43'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( Δα = <?= $ac ?>, \space t = <?= $t ?>, \space ω = ? \)</p>
                            <p class="w-full  mt-3"><strong><?= $lang['45'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( ω = \dfrac {Δα}{t} \)</p>
                            <p class="w-full  mt-3">\( ω = \dfrac {<?= $ac ?>}{<?= $t ?>} \)</p>
                            <p class="w-full  mt-3">\( ω = <?= $ac / $t ?> \)</p>
                        <?php } elseif (isset($detail['ang_chnge'])) {
                            $av = $detail['av'];
                            $t = $detail['t'];
                        ?>
                            <p class="w-full  mt-3"><strong><?= $lang['43'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( ω = <?= $av ?>, \space t = <?= $t ?>, \space Δα = ? \)</p>
                            <p class="w-full  mt-3"><strong><?= $lang['45'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( Δα = ω * t \)</p>
                            <p class="w-full  mt-3">\( Δα = <?= $av ?> * <?= $t ?> \)</p>
                            <p class="w-full  mt-3">\( Δα = <?= $av * $t ?> \)</p>
                        <?php } elseif (isset($detail['time'])) {
                            $ac = $detail['ac'];
                            $av = $detail['av'];
                        ?>
                            <p class="w-full  mt-3"><strong><?= $lang['43'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( Δα = <?= $ac ?>, \space ω = <?= $av ?>, \space t = ? \)</p>
                            <p class="w-full  mt-3"><strong><?= $lang['45'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( t = \dfrac {Δα}{ω} \)</p>
                            <p class="w-full  mt-3">\( t = \dfrac {<?= $ac ?>}{<?= $av ?>} \)</p>
                            <p class="w-full  mt-3">\( t = <?= $ac / $av ?> \)</p>
                        <?php } elseif (isset($detail['ang_vel1'])) {
                            $vel = $detail['vel'];
                            $rad = $detail['rad'];
                        ?>
                            <p class="w-full  mt-3"><strong><?= $lang['43'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( v = <?= $vel ?>, \space r = <?= $rad ?>, \space ω = ? \)</p>
                            <p class="w-full  mt-3"><strong><?= $lang['45'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( ω = \dfrac {v}{r} \)</p>
                            <p class="w-full  mt-3">\( ω = \dfrac {<?= $vel ?>}{<?= $rad ?>} \)</p>
                            <p class="w-full  mt-3">\( ω = <?= $vel / $rad ?> \)</p>
                        <?php } elseif (isset($detail['velocity'])) {
                            $av = $detail['av'];
                            $rad = $detail['rad'];
                        ?>
                            <p class="w-full  mt-3"><strong><?= $lang['43'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( ω = <?= $av ?>, \space r = <?= $rad ?>, \space v = ? \)</p>
                            <p class="w-full  mt-3"><strong><?= $lang['45'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( v = ω * r \)</p>
                            <p class="w-full  mt-3">\( v = <?= $av ?> * <?= $rad ?> \)</p>
                            <p class="w-full  mt-3">\( v = <?= $av * $rad ?> \)</p>
                        <?php } elseif (isset($detail['radius'])) {
                            $av = $detail['av'];
                            $vel = $detail['vel'];
                        ?>
                            <p class="w-full  mt-3"><strong><?= $lang['43'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( ω = <?= $av ?>, \space v = <?= $vel ?>, \space r = ? \)</p>
                            <p class="w-full  mt-3"><strong><?= $lang['45'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( r = \dfrac {v}{ω} \)</p>
                            <p class="w-full  mt-3">\( r = \dfrac {<?= $vel ?>}{<?= $av ?>} \)</p>
                            <p class="w-full  mt-3">\( r = <?= $vel / $av ?> \)</p>
                        <?php } elseif (isset($detail['rpm'])) {
                            $rpm = $detail['rpm'];
                            $rds_m = $detail['rds_m'];
                        ?>
                            <p class="w-full  mt-3"><strong><?= $lang['43'] ?>:</strong></p>
                            <p class="w-full  mt-3">\( rpm = <?= $rpm ?>, \space r = <?= $rds_m ?>, \space ω = ?, \space v = ? \)</p>
                            <p class="w-full  mt-3"><strong><?= $lang['44'] ?> <?= $lang['6'] ?> (ω):</strong></p>
                            <p class="w-full  mt-3">\( ω = \dfrac {2 * π * rpm}{60} \)</p>
                            <p class="w-full  mt-3">\( ω = \dfrac {2 * <?= pi() ?> * <?= $rpm ?>}{60} \)</p>
                            <p class="w-full  mt-3">\( ω = \dfrac {<?= 2 * pi() * $rpm ?>}{60} \)</p>
                            <p class="w-full  mt-3">\( ω = <?= $av = (2 * pi() * $rpm) / 60 ?> \)</p>
                            <p class="w-full  mt-3"><strong><?= $lang['44'] ?> <?= $lang['9'] ?> (v):</strong></p>
                            <p class="w-full  mt-3">\( v = ω * r \)</p>
                            <p class="w-full  mt-3">\( v = <?= $av ?> * <?= $rds_m ?> \)</p>
                            <p class="w-full  mt-3">\( v = <?= $av * $rds_m ?> \)</p>
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
        // Function to handle button clicks and update visibility and values
        function handleClick(buttonClass, showSelectors, hideSelectors, checkValue) {
            document.querySelector(buttonClass).addEventListener('click', function() {
                showSelectors.forEach(function(selector) {
                    document.querySelector(selector).style.display = 'block';
                });
                hideSelectors.forEach(function(selector) {
                    document.querySelector(selector).style.display = 'none';
                });
                document.querySelector('#check').value = checkValue;
            });
        }

        // Define the button click behaviors
        handleClick('.g1', ['#ac', '#t'], ['#av'], 'g1_value');
        handleClick('.g2', ['#t', '#av'], ['#ac'], 'g2_value');
        handleClick('.g3', ['#ac', '#av'], ['#t'], 'g3_value');
        handleClick('.g11', ['#vel', '#rds'], ['#av', '#ac', '#t'], 'g11_value');
        handleClick('.g21', ['#av', '#rds'], ['#vel'], 'g21_value');
        handleClick('.g31', ['#vel', '#av'], ['#rds'], 'g31_value');
        @if (isset($_POST['g']) && $_POST['g']=='ang_vel')
            document.querySelector('.g1').click();
        @endif
        @if (isset($_POST['g']) && $_POST['g']=='ang_chnge')
            document.querySelector('.g2').click();
        @endif
        @if (isset($_POST['g']) && $_POST['g']=='time')
            document.querySelector('.g3').click();
        @endif
        @if (isset($_POST['gg']) && $_POST['gg']=='ang_vel1')
            document.querySelector('.g11').click();
        @endif
        @if (isset($_POST['gg']) && $_POST['gg']=='velocity')
            document.querySelector('.g21').click();
        @endif
        @if (isset($_POST['gg']) && $_POST['gg']=='radius')
            document.querySelector('.g31').click();
        @endif
        // Function to handle method changes
        function method() {
            const methodValue = document.querySelector('#method').value;
            const hideAll = ['#g-hide', '#g-hide1', '#av', '#t', '#vel', '#rds', '#rpm', '#rds_m'];

            hideAll.forEach(function(selector) {
                document.querySelector(selector).style.display = 'none';
            });

            if (methodValue == 0) {
                document.querySelector('#g-hide').style.display = 'block';
                document.querySelector('#ac').style.display = 'block';
                document.querySelector('#t').style.display = 'block';

                const gValue = document.querySelector('input[name="g"]:checked').value;
                if (gValue === 'g2') {
                    document.querySelector('#ac').style.display = 'none';
                    document.querySelector('#check').value = 'g2_value';
                } else if (gValue === 'g3') {
                    document.querySelector('#check').value = 'g3_value';
                }
            } else if (methodValue == 1) {
                document.querySelector('#g-hide1').style.display = 'block';
                document.querySelector('#vel').style.display = 'block';
                document.querySelector('#rds').style.display = 'block';
                document.querySelector('#ac').style.display = 'none';
                // document.querySelector('#g11').checked = true;
                document.querySelector('#check').value = 'g11_value';

                const ggValue = document.querySelector('input[name="gg"]:checked').value;
                if (ggValue === 'g21') {
                    document.querySelector('#check').value = 'g21_value';
                } else if (ggValue === 'g31') {
                    document.querySelector('#check').value = 'g31_value';
                }
            } else if (methodValue == 2) {
                document.querySelector('#rpm').style.display = 'block';
                document.querySelector('#rds_m').style.display = 'block';
                document.querySelector('#ac').style.display = 'none';
            }
        }

        // Add event listener for method change
        document.querySelector('#method').addEventListener('change', method);

        // Initial method call to set up the initial state
        method();
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>