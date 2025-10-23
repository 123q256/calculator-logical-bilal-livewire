<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


            <div class="col-span-12">
                <label for="rise" class="font-s-14 text-blue">{{$lang[1]}}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="rise" id="rise" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rise']) ? $_POST['rise'] : '6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="rise_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rise_unit_dropdown')">{{ isset($_POST['rise_unit'])?$_POST['rise_unit']:'m' }} ▾</label>
                    <input type="text" name="rise_unit" value="{{ isset($_POST['rise_unit'])?$_POST['rise_unit']:'m' }}" id="rise_unit" class="hidden">
                    <div id="rise_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rise_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rise_unit', 'mm')">millimeters (mm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rise_unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rise_unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rise_unit', 'km')">kilometers (km)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rise_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rise_unit', 'ft')">feets (ft)</p>
                    </div>
                    </div>
            </div>
            <div class="col-span-12">
                <label for="run" class="font-s-14 text-blue">{{$lang[2]}}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="run" id="run" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['run']) ? $_POST['run'] : '6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="run_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('run_unit_dropdown')">{{ isset($_POST['run_unit'])?$_POST['run_unit']:'m' }} ▾</label>
                    <input type="text" name="run_unit" value="{{ isset($_POST['run_unit'])?$_POST['run_unit']:'m' }}" id="run_unit" class="hidden">
                    <div id="run_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="run_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('run_unit', 'mm')">millimeters (mm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('run_unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('run_unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('run_unit', 'km')">kilometers (km)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('run_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('run_unit', 'ft')">feets (ft)</p>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['slopeAngleDegrees'],2)}}°</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['slopePercentage'],2)}}%</td>
                                </tr>
                            </table>
                            <p class="my-2 text-[16px]"><strong>{{$lang['5']}}</strong></p>
                            <table class="w-full text-[16px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%">{{ $lang['6'] }}</td>
                                    <td class="py-2 border-b"><strong>{{round($detail['slopeAngleDegrees'] * 0.017453,2)}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['7'] }}</td>
                                    <td class="py-2 border-b"><strong>{{round($detail['slopeAngleDegrees'] * 1.111,2 )}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['8'] }}</td>
                                    <td class="py-2 border-b"><strong>{{round($detail['slopeAngleDegrees'] * 0.005556,2)}}</strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{$lang['14']}}</strong></p>
                            <p class="mt-2">{{$lang['10']}}</p>
                            <p class="mt-2">
                                {{$lang[11]}} = 
                                (<span class="quadratic_fraction">
                                    <span class="num">Rise</span>
                                    <span>Run</span>
                                </span>) × 100%
                            </p>
                            <p class="mt-2">
                                {{$lang[11]}} = 
                                (<span class="quadratic_fraction">
                                    <span class="num">{{$_POST['rise']}}</span>
                                    <span>{{$_POST['run']}}</span>
                                </span>) × 100%
                            </p>
                            <p class="mt-2">
                                {{$lang[11]}} = {{round($detail['slopePercentage'],2)}}%
                            </p>
                            <p class="mt-2">{{$lang['12']}}</p>
                            <p class="mt-2">
                                {{$lang[13]}} = atan × 
                                (<span class="quadratic_fraction">
                                    <span class="num">Rise</span>
                                    <span>Run</span>
                                </span>)
                            </p>
                            <p class="mt-2">
                                {{$lang[13]}} = atan × 
                                (<span class="quadratic_fraction">
                                    <span class="num">{{$_POST['rise']}}</span>
                                    <span>{{$_POST['run']}}</span>
                                </span>)
                            </p>
                            <p class="mt-2">
                                {{$lang[13]}} = {{round($detail['slopeAngle'],5)}}
                            </p>
                            <p class="mt-2">
                                {{$lang[13]}} = rad2deg({{$lang['13']}})
                            </p>
                            <p class="mt-2">
                                {{$lang[13]}} = rad2deg({{round($detail['slopeAngle'],5)}})
                            </p>
                            <p class="mt-2">
                                {{$lang[13]}} = {{round($detail['slopeAngleDegrees'],2)}}°
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>