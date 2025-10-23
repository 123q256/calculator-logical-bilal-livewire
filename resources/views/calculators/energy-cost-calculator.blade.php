<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
        <input type="hidden" name="currancy" value="{{ $currancy }}">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="appliance" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select name="appliance" id="appliance" class="input" onchange="update_value(this)">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['9'], $lang['10'], $lang['11'], $lang['12'], $lang['13'], $lang['14'], $lang['15'], $lang['16'], $lang['17'], $lang['18'], $lang['19'], $lang['20'], $lang['21'], $lang['22'], $lang['23'], $lang['24'], $lang['25']];
                            $val = [600, 3000, 2400, 1600, 2000, 70, 2000, 800, 100, 50, 200, 200, 70, 1000, 1600, 2000, 4000];
                            optionsList($val,$name,isset($_POST['appliance'])?$_POST['appliance']:'600');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="power" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="power" id="power" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['power'])?$_POST['power']:'500' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="power_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('power_units_dropdown')">{{ isset($_POST['power_units'])?$_POST['power_units']:'watts (W)' }} ▾</label>
                        <input type="text" name="power_units" value="{{ isset($_POST['power_units'])?$_POST['power_units']:'watts (W)' }}" id="power_units" class="hidden">
                        <div id="power_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[40%] mt-1 right-0 hidden">
                            <p class="p-1 text-[14px] hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_units', 'watts (W)')">watts (W)</p>
                            <p class="p-1 text-[14px] hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_units', 'kilowatts (kW)')">kilowatts (kW)</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 relative">
                    <label for="hours_per_day" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                    <input type="number" type="any" name="hours_per_day" id="hours_per_day" class="input" value="{{ isset($_POST['hours_per_day'])?$_POST['hours_per_day']:'8' }}" aria-label="input" placeholder="00" />
                    <span class="input_unit">h/day</span>
                </div>
                <div class="space-y-2">
                    <label for="cost" class="font-s-14 text-blue">{{ $lang[5] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="cost" id="cost" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cost'])?$_POST['cost']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="cost_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cost_units_dropdown')">{{ isset($_POST['cost_units'])?$_POST['cost_units']: $currancy.'/cent' }} ▾</label>
                        <input type="text" name="cost_units" value="{{ isset($_POST['cost_units'])?$_POST['cost_units']: $currancy.'/cent' }}" id="cost_units" class="hidden">
                        <div id="cost_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[40%] mt-1 right-0 hidden">
                            <p class="p-1 text-[16px] hover:bg-gray-100 cursor-pointer" onclick="setUnit('cost_units', '{{$currancy}}/cent')">{{$currancy}}/cent</p>
                            <p class="p-1 text-[16px] hover:bg-gray-100 cursor-pointer" onclick="setUnit('cost_units', '{{$currancy}}/pence')">{{$currancy}}/pence</p>
                            <p class="p-1 text-[16px] hover:bg-gray-100 cursor-pointer" onclick="setUnit('cost_units', '{{$currancy}}/rupee')">{{$currancy}}/rupee</p>
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
                    <div class="w-full bg-light-blue  rounded-lg mt-3">
                        <div class="flex">
                            <div class="w-full lg:w-1/2 overflow-auto">
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="p-2 border-b">{{ $lang[6] }}</td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ $currancy . $detail['energy_cost_per_day'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b">{{ $lang[7] }}</td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ $currancy . $detail['energy_cost_per_month'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b">{{ $lang[8] }}</td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ $currancy . $detail['energy_cost_per_year'] }}</strong></td>
                                    </tr>
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
    <script>
        function update_value(element) {
            let val = element.value;
            document.getElementById("power").value = val;
        }
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>