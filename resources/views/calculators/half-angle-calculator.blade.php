<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="cal" class="label">{{ $lang['calculate'] }} {{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="cal" id="cal">
                        <option value="angle" {{ isset($_POST['cal']) && $_POST['cal']=='angle'?'selected':'' }}>{{$lang['2']}} (x)</option>
                        <option value="sinx" {{ isset($_POST['cal']) && $_POST['cal']=='sinx'?'selected':'' }}>sin(x)</option>
                        <option value="cosx" {{ isset($_POST['cal']) && $_POST['cal']=='cosx'?'selected':'' }}>cos(x)</option>
                        <option value="tanx" {{ isset($_POST['cal']) && $_POST['cal']=='tanx'?'selected':'' }}>tan(x)</option>
                        <option value="sinx_2" {{ isset($_POST['cal']) && $_POST['cal']=='sinx_2'?'selected':'' }}>sin(x/2)</option>
                        <option value="cosx_2" {{ isset($_POST['cal']) && $_POST['cal']=='cosx_2'?'selected':'' }}>cos(x/2)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal']) && ($_POST['cal']==='sinx' || $_POST['cal']==='cosx' || $_POST['cal']==='tanx' || $_POST['cal']==='sinx_2' || $_POST['cal']==='cosx_2') ? 'hidden':'' }}" id="angleInput">
                <label for="angle" class="label">{{$lang['2']}} (x)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="angle" id="angle" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle']) ? $_POST['angle'] : '60' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_unit_dropdown')">{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'kg' }} ▾</label>
                    <input type="text" name="angle_unit" value="{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'kg' }}" id="angle_unit" class="hidden">
                    <div id="angle_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_unit">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'deg')">degrees (deg)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'rad')">radians (rad)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'pirad')">* π rad (pirad)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal']) && ($_POST['cal']==='sinx' || $_POST['cal']==='cosx' || $_POST['cal']==='tanx' || $_POST['cal']==='sinx_2' || $_POST['cal']==='cosx_2') ? 'd-block':'hidden' }}" id="functionInput">
                <label for="func" class="label" id="textChanged">sin(x)</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="func" id="func" min="-1" max="1" class="input" value="{{ isset($_POST['func'])?$_POST['func']:'0.5' }}" aria-label="input"/>
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
                            $sinx=$detail['sinx'];
                            $cosx=$detail['cosx'];
                            $tanx=$detail['tanx'];
                            $sinx2=$detail['sinx2'];
                            $cosx2=$detail['cosx2'];
                            $tanx2=$detail['tanx2'];
                            $table=array("0.866"=>"√3/2", "0.7071"=>"√2/2", "0.5"=>"1/2");
                            $table1=array("1.732"=>"√3", "-1.732"=>"-√3", "0.5774"=>"√3/3", "-0.5774"=>"-√3/3","1"=>"1");
                        @endphp
                        <div class="w-full">
                            @isset($detail['angle_u'])
                                @if($detail['angle_u'] === 'deg')
                                    @php
                                        $sinx_val = '';
                                        foreach ($table as $key => $sinx_value) {
                                            if ($sinx < 0) {
                                                $key = $key * (-1);
                                            }
                                            if ("$key" === "$sinx") {
                                                $sinx_val = $sinx_value;
                                            }
                                        }
                                        $cosx_val = '';
                                        foreach ($table as $key => $cosx_value) {
                                            if ($cosx < 0) {
                                                $key = $key * (-1);
                                            }
                                            if ("$key" === "$cosx") {
                                                $cosx_val = $cosx_value;
                                            }
                                        }
                                        $tanx_val = '';
                                        foreach ($table1 as $key => $tanx_value) {
                                            if ("$key" === "$tanx") {
                                                $tanx_val = $tanx_value;
                                            }
                                        }
                                        if (!empty($sinx_val)) {
                                            if ($sinx < 0) {
                                                $sinx_val = '-' . $sinx_val;
                                            }
                                        }
                                        if (!empty($cosx_val)) {
                                            if ($cosx < 0) {
                                                $cosx_val = '-' . $cosx_val;
                                            }
                                        }
                                        $sinx2_val = '';
                                        foreach ($table as $key => $sinx2_value) {
                                            if ($sinx2 < 0) {
                                                $key = $key * (-1);
                                            }
                                            if ("$key" === "$sinx2") {
                                                $sinx2_val = $sinx2_value;
                                            }
                                        }
                                        $cosx2_val = '';
                                        foreach ($table as $key => $cosx2_value) {
                                            if ($cosx2 < 0) {
                                                $key = $key * (-1);
                                            }
                                            if ("$key" === "$cosx2") {
                                                $cosx2_val = $cosx2_value;
                                            }
                                        }
                                        $tanx2_val = '';
                                        foreach ($table1 as $key => $tanx2_value) {
                                            if ("$key" === "$tanx2") {
                                                $tanx2_val = $tanx2_value;
                                            }
                                        }
                                        if (!empty($sinx2_val)) {
                                            if ($sinx2 < 0) {
                                                $sinx2_val = '-' . $sinx2_val;
                                            }
                                        }
                                        if (!empty($cosx2_val)) {
                                            if ($cosx2 < 0) {
                                                $cosx2_val = '-' . $cosx2_val;
                                            }
                                        }
                                    @endphp
                                    @if(!empty($sinx2_val) && !empty($cosx2_val) && !empty($tanx2_val))
                                        <p class="mt-3 text-[18px]"><strong>{{$lang[3]}}</strong></p>
                                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                            <table class="w-full text-[18px]">
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>sin(x/2)</strong></td>
                                                    <td class="py-2 border-b">{{$sinx2}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>cos(x/2)</strong></td>
                                                    <td class="py-2 border-b">{{$cosx2}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>tan(x/2)</strong></td>
                                                    <td class="py-2 border-b">{{$tanx2}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <p class="mt-3 text-[18px]"><strong>{{$lang[4]}}</strong></p>
                                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                            <table class="w-full text-[18px]">
                                                <tr>
                                                    <td class="py-2 border-b" width="60%">sin(x/2)</td>
                                                    <td class="py-2 border-b"><strong>{{$sinx2_val}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="60%">cos(x/2)</td>
                                                    <td class="py-2 border-b"><strong>{{$cosx2_val}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="60%">tan(x/2)</td>
                                                    <td class="py-2 border-b"><strong>{{$tanx2_val}}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif
                                @endif
                            @endisset
                            @if(empty($sinx2_val) && empty($cosx2_val) && empty($tanx2_val))
                                <p class="mt-3 text-[18px]"><strong>Half-Angle Functions</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>sin(x/2)</strong></td>
                                            <td class="py-2 border-b">{{$sinx2}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>cos(x/2)</strong></td>
                                            <td class="py-2 border-b">{{$cosx2}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>tan(x/2)</strong></td>
                                            <td class="py-2 border-b">{{$tanx2}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            <div class="w-full text-[16px] mt-3">
                                <p class="text-[18px]"><strong>Solution</strong></p>
                                <p class="mt-3">Formulas</p>
                                <p class="mt-3">sin(x/2) = ± &radic;<span class="border-top-black">1-cos(x) / 2</span></p>
                                <p class="mt-3">cos(x/2) = ± &radic;<span class="border-top-black">1+cos(x) / 2</span></p>
                                <p class="mt-3">tan(x/2) = ± &radic;<span class="border-top-black">1-cos(x) / 1+cos(x)</span></p>
                                <p class="mt-3">Put angle value ({{ $_POST['angle'] }}) into cos(x)</p>
                                <p class="mt-3">cos({{ $_POST['angle'] }}) = {{ $cosx }}</p>
                                <p class="mt-3">Find sin(x/2)</p>
                                <p class="mt-3">sin(x/2) = ± &radic;<span class="border-top-black">1-cos(x) / 2</span></p>
                                <p class="mt-3">sin(x/2) = ± &radic;<span class="border-top-black">1-({{ $cosx }}) / 2</span></p>
                                <p class="mt-3">sin(x/2) = ± &radic;<span class="border-top-black">{{ $detail['s1'] }} / 2</span></p>
                                <p class="mt-3">sin(x/2) = ± &radic;<span class="border-top-black">{{ $detail['s2'] }}</span></p>
                                <p class="mt-3">sin(x/2) = ± {{ $sinx2 }}</p>
                                <p class="mt-3">Find cos(x/2)</p>
                                <p class="mt-3">cos(x/2) = ± &radic;<span class="border-top-black">1+cos(x) / 2</span></p>
                                <p class="mt-3">cos(x/2) = ± &radic;<span class="border-top-black">1+({{ $cosx }}) / 2</span></p>
                                <p class="mt-3">cos(x/2) = ± &radic;<span class="border-top-black">{{ $detail['c1'] }} / 2</span></p>
                                <p class="mt-3">cos(x/2) = ± &radic;<span class="border-top-black">{{ $detail['c2'] }}</span></p>
                                <p class="mt-3">cos(x/2) = ± {{ $cosx2 }}</p>
                                <p class="mt-3">Find tan(x/2)</p>
                                <p class="mt-3">tan(x/2) = ± &radic;<span class="border-top-black">1-cos(x) / 1+cos(x)</span></p>
                                <p class="mt-3">tan(x/2) = ± &radic;<span class="border-top-black">1-({{ $cosx }}) / 1+({{ $cosx }})</span></p>
                                <p class="mt-3">tan(x/2) = ± &radic;<span class="border-top-black">{{ $detail['s1'] }} / {{ $detail['c1'] }}</span></p>
                                <p class="mt-3">tan(x/2) = ± &radic;<span class="border-top-black">{{ $detail['t1'] }}</span></p>
                                <p class="mt-3">tan(x/2) = ± {{ $tanx2 }}</p>
                            </div>
                            @isset($detail['angle_u'])
                                @if($detail['angle_u'] === 'deg')
                                    @if(!empty($sinx2_val) && !empty($cosx2_val) && !empty($tanx2_val))
                                        <p class="mt-3 text-[18px]"><strong>Basic Functions</strong></p>
                                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                            <table class="w-full text-[18px]">
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>sin(x)</strong></td>
                                                    <td class="py-2 border-b">{{$sinx}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>cos(x)</strong></td>
                                                    <td class="py-2 border-b">{{$cosx}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>tan(x)</strong></td>
                                                    <td class="py-2 border-b">{{$tanx}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <p class="mt-3 text-[18px]"><strong>Precise Values</strong></p>
                                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                            <table class="w-full text-[18px]">
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>sin(x)</strong></td>
                                                    <td class="py-2 border-b">{{$sinx_val}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>cos(x)</strong></td>
                                                    <td class="py-2 border-b">{{$cosx_val}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>tan(x)</strong></td>
                                                    <td class="py-2 border-b">{{$tanx_val}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif
                                @endif
                            @endisset
                            @if(empty($sinx_val) && empty($cosx_val) && empty($tanx_val))
                                <p class="mt-3 text-[18px]"><strong>Basic Functions</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>sin(x)</strong></td>
                                            <td class="py-2 border-b">{{$sinx}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>cos(x)</strong></td>
                                            <td class="py-2 border-b">{{$cosx}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>tan(x)</strong></td>
                                            <td class="py-2 border-b">{{$tanx}}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            <div class="w-full text-[16px] mt-3">
                                <p class="text-[18px]"><strong>Solution</strong></p>
                                <p class="mt-3">Put angle value ({{ $_POST['angle'] }}) into sin(x), cos(x) & tan(x)</p>
                                <p class="mt-3">sin({{ $_POST['angle'] }}) = {{ $sinx }}</p>
                                <p class="mt-3">cos({{ $_POST['angle'] }}) = {{ $cosx }}</p>
                                <p class="mt-3">tan({{ $_POST['angle'] }}) = {{ $tanx }}</p>
                            </div>
                            @if($_POST['cal'] !== 'angle')
                                <p class="mt-3 text-[18px]"><strong>Angle</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>Angle</strong></td>
                                            <td class="py-2 border-b">{{$detail['angle_deg']}} degrees</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>Angle</strong></td>
                                            <td class="py-2 border-b">{{$detail['angle_rad']}} radians</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>Angle</strong></td>
                                            <td class="py-2 border-b">{{$detail['angle_pirad']}} π radians</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('cal').addEventListener("change", function() {
                var selectedValue = this.value;
                var funcText = '';
                switch(selectedValue) {
                    case 'angle':
                        document.getElementById('angleInput').style.display = 'block';
                        document.getElementById('functionInput').style.display = 'none';
                        break;
                    case 'sinx':
                        funcText = 'sin(x)';
                        break;
                    case 'cosx':
                        funcText = 'cos(x)';
                        break;
                    case 'tanx':
                        funcText = 'tan(x)';
                        break;
                    case 'sinx_2':
                        funcText = 'sin(x/2)';
                        break;
                    case 'cosx_2':
                        funcText = 'cos(x/2)';
                        break;
                }

                if (funcText !== '') {
                    document.getElementById('functionInput').style.display = 'block';
                    document.getElementById('angleInput').style.display = 'none';
                    document.getElementById('textChanged').textContent = funcText;
                }
            });
        </script>
    @endpush
</form>