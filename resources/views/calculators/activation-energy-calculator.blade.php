<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2">
                        <label for="temperature" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="temperature" id="temperature" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temperature'])?$_POST['temperature']:'100' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="tempUnit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tempUnit_dropdown')">{{ isset($_POST['tempUnit'])?$_POST['tempUnit']:'celsius' }} ▾</label>
                                <input type="text" name="tempUnit" value="{{ isset($_POST['tempUnit'])?$_POST['tempUnit']:'celsius' }}" id="tempUnit" class="hidden">
                                <div id="tempUnit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tempUnit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tempUnit', 'celsius')">{!! $lang['2'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tempUnit', 'fahrenheit')">{!! $lang['3'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tempUnit', 'kelvin')">{!! $lang['4'] !!}</p>
                                </div>
                            </div>
                    </div>
                    <div class="space-y-2">
                        <label for="rate" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="rate" id="rate" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rate'])?$_POST['rate']:'100' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="rateUnits" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rateUnits_dropdown')">{{ isset($_POST['rateUnits'])?$_POST['rateUnits']:'sec' }} ▾</label>
                                <input type="text" name="rateUnits" value="{{ isset($_POST['rateUnits'])?$_POST['rateUnits']:'sec' }}" id="rateUnits" class="hidden">
                                <div id="rateUnits_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rateUnits">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rateUnits', 'sec')">{!! $lang['6'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rateUnits', 'min')">{!! $lang['7'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rateUnits', 'hour')">{!! $lang['8'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rateUnits', 'day')">{!! $lang['9'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rateUnits', 'week')">{!! $lang['10'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rateUnits', 'month')">{!! $lang['11'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rateUnits', 'year')">{!! $lang['12'] !!}</p>
                                </div>
                            </div>
                    </div>
                    <div class="space-y-2">
                        <label for="const" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="const" id="const" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['const'])?$_POST['const']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="constUnits" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('constUnits_dropdown')">{{ isset($_POST['constUnits'])?$_POST['constUnits']:'sec' }} ▾</label>
                                <input type="text" name="constUnits" value="{{ isset($_POST['constUnits'])?$_POST['constUnits']:'sec' }}" id="constUnits" class="hidden">
                                <div id="constUnits_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="constUnits">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('constUnits', 'sec')">{!! $lang['6'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('constUnits', 'min')">{!! $lang['7'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('constUnits', 'hour')">{!! $lang['8'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('constUnits', 'day')">{!! $lang['9'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('constUnits', 'week')">{!! $lang['10'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('constUnits', 'month')">{!! $lang['11'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('constUnits', 'year')">{!! $lang['12'] !!}</p>
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
                        <p><strong>{!! $lang['14'] !!} (Ea)</strong></p>
                        <p><strong class="text-green-600 text-[32px] mt-3">{!! round($detail['res'],3) !!} KJ</strong></p>
                        <div class="grid grid-cols-2  lg:grid-cols-4 md:grid-cols-4  gap-4">
                            <div class="mt-3 border-r-4 ">
                                <p><strong>{!! $lang['15'] !!}</strong></p>
                                <p>{!! round($detail['joule'],2) !!}</p>
                            </div>
                            <div class="border-r-4  hidden d-md-block mt-3">&nbsp;</div>
                            <div class="mt-3 border-r-4 ">
                                <p><strong>{!! $lang['16'] !!}</strong></p>
                                <p>{!! round($detail['megajoule'],2) !!}</p>
                            </div>
                            <div class="border-r-4  hidden d-md-block mt-3">&nbsp;</div>
                            <div class="mt-3 border-r-4 ">
                                <p><strong>{!! $lang['17'] !!}</strong></p>
                                <p>{!! round($detail['calories'],2) !!}</p>
                            </div>
                            <div class="border-r-4  hidden d-md-block mt-3">&nbsp;</div>
                            <div class="mt-3 border-r-4 ">
                                <p><strong>{!! $lang['18'] !!}</strong></p>
                                <p>{!! round($detail['kilocalories'],2) !!}</p>
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <p class="mt-3"><strong>{!! $lang['19'] !!}</strong></p>
                            <p class="mt-2">{!! $lang['1'] !!} = {!! round($detail['temperature'],2) !!}</p>
                            <p class="mt-2">{!! $lang['5'] !!} = {!! $detail['rate'] !!}</p>
                            <p class="mt-2">{!! $lang['13'] !!} = {!! $detail['const'] !!}</p>
                            <p class="mt-3"><strong>{!! $lang['20'] !!}</strong></p>
                            <p class="mt-2">Ea = {!! $lang['14'] !!}</p>
                            <p class="mt-2">R = {!! $lang['15'] !!} (-0.008314) J/(K⋅mol)</p>
                            <p class="mt-2">T = {!! $lang['22'] !!}</p>
                            <p class="mt-2">k = {!! $lang['23'] !!}</p>
                            <p class="mt-2">A = {!! $lang['25'] !!}</p>
                            <p class="mt-3"><strong>{!! $lang['26'] !!}</strong></p>
                            <p class="mt-2">Ea = -R * T * ln(k / A)</p>
                            <p class="mt-2">Ea = -0.008314 * {!! round($detail['temperature'],2) !!} * ln({!! $detail['rate'] !!} / {!! $detail['const'] !!})</p>
                            <p class="mt-2">Ea = ({!! -0.008314 * $detail['temperature'] !!}) * (ln({!! $detail['rate'] / $detail['const'] !!}))</p>
                            <p class="mt-2">Ea = ({!! -0.008314 * $detail['temperature'] !!}) * ({!! $detail['log'] !!})</p>
                            <p class="mt-2">Ea = {!! round(-0.008314 * $detail['temperature'] * $detail['log'],3) !!} KJ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>