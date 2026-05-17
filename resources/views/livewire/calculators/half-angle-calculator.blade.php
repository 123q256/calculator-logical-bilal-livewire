<div>
<style>
    [x-cloak] {
        display: none !important;
    }
    #exampleLoadBtn {
        background: #1670a712 !important;
        border: 1px solid #1670a730 !important;
        color: #1670a7 !important;
        transition: all 0.2s ease-in-out;
    }
    #exampleLoadBtn:hover {
        background: #1670a724 !important;
        transform: translateY(-1px);
    }
</style>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="cal" class="label">{{ $lang['calculate'] }} {{ $lang['1'] }}:</label>
            </div>

            <div class="col-span-12">
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="cal" id="cal" wire:model.live="cal">
                        <option value="angle">{{$lang['2']}} (x)</option>
                        <option value="sinx">sin(x)</option>
                        <option value="cosx">cos(x)</option>
                        <option value="tanx">tan(x)</option>
                        <option value="sinx_2">sin(x/2)</option>
                        <option value="cosx_2">cos(x/2)</option>
                    </select>
                </div>
            </div>
            
            @if ($cal === 'angle')
            <div class="col-span-12">
                <label for="angle" class="label">{{$lang['2']}} (x)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="angle" id="angle" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" wire:model.live="angle" aria-label="input" placeholder="00"/>
                    <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="$toggle('showUnitDropdown')">{{ $this->getUnitLabel() }} ▾</label>
                    @if ($showUnitDropdown)
                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('deg')">degrees (deg)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('rad')">radians (rad)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pirad')">* π rad (pirad)</p>
                    </div>
                    @endif
                 </div>
            </div>
            @else
            <div class="col-span-12">
                <label for="func" class="label">{{ $this->getFuncLabel() }}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="func" id="func" min="-1" max="1" class="input" wire:model.live="func" aria-label="input"/>
                </div>
            </div>
            @endif
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
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
                                <p class="mt-3">Put angle value ({{ $angle }}) into cos(x)</p>
                                <p class="mt-3">cos({{ $angle }}) = {{ $cosx }}</p>
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
                                <p class="mt-3">Put angle value ({{ $angle }}) into sin(x), cos(x) & tan(x)</p>
                                <p class="mt-3">sin({{ $angle }}) = {{ $sinx }}</p>
                                <p class="mt-3">cos({{ $angle }}) = {{ $cosx }}</p>
                                <p class="mt-3">tan({{ $angle }}) = {{ $tanx }}</p>
                            </div>
                            @if($cal !== 'angle')
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
</form>
</div>
