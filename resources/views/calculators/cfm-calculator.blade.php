<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

        <p class="col-span-12"><strong>{{$lang['11']}}</strong></p>
        <div class="col-span-12 md:col-span-6 lg:col-span-6">
            <label for="length" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
            <div class="relative w-full mt-[7px]">
                <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                <label for="length_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_units_dropdown')">{{ isset($_POST['length_units'])?$_POST['length_units']:'m' }} ▾</label>
                <input type="text" name="length_units" value="{{ isset($_POST['length_units'])?$_POST['length_units']:'m' }}" id="length_units" class="hidden">
                <div id="length_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_units">
                    @foreach (["cm","m","in","ft","yd"] as $name)
                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_units', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                </div>
             </div>
        </div>
        <div class="col-span-12 md:col-span-6 lg:col-span-6">
            <label for="width" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
            <div class="relative w-full mt-[7px]">
                <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width']) ? $_POST['width'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                <label for="width_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_units_dropdown')">{{ isset($_POST['width_units'])?$_POST['width_units']:'m' }} ▾</label>
                <input type="text" name="width_units" value="{{ isset($_POST['width_units'])?$_POST['width_units']:'m' }}" id="width_units" class="hidden">
                <div id="width_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_units">
                    @foreach (["cm","m","in","ft","yd"] as $name)
                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('width_units', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                </div>
             </div>
        </div>
    
        <div class="col-span-12 md:col-span-6 lg:col-span-6">
            <label for="celling" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
            <div class="relative w-full mt-[7px]">
                <input type="number" name="celling" id="celling" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['celling']) ? $_POST['celling'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                <label for="celling_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('celling_units_dropdown')">{{ isset($_POST['celling_units'])?$_POST['celling_units']:'m' }} ▾</label>
                <input type="text" name="celling_units" value="{{ isset($_POST['celling_units'])?$_POST['celling_units']:'m' }}" id="celling_units" class="hidden">
                <div id="celling_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="celling_units">
                    @foreach (["cm","m","in","ft","yd"] as $name)
                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('celling_units', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                </div>
             </div>
        </div>
       
        <p class="col-span-12 mt-2"><strong>{{$lang['4']}}</strong></p>
        <div class="col-span-12 md:col-span-6 lg:col-span-6">
            <label for="airflow" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
            <div class="w-100 py-2 position-relative"> 
                <input type="number" step="any" name="airflow" id="airflow" class="input" aria-label="input"  value="{{ isset($_POST['airflow'])?$_POST['airflow']:'4' }}" />
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
                    <div class="w-full py-2">
                        <div class="w-full md:w-[60%] lg:w-[60%] text-[18px]">
                            <table class="w-full">
                                <tr>
                                    <td width="60%" class="border-b py-2"><strong>{{$lang['6']}} :</strong></td>
                                    <td class="border-b py-2">
                                        {{$detail['floorArea']}} m²
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['7']}} :</strong></td>
                                    <td class="border-b py-2">
                                        {{$detail['volume']}} m²</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['8']}} :</strong></td>
                                    <td class="border-b py-2">
                                        {{round($detail['requiredAirFlow'],1)}} CFM</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['9']}} :</strong></td>
                                    <td class="border-b py-2">
                                        {{$detail['airflow_rate']}} m³/hr</td>
                                </tr>
                            </table>
                            <p class="mt-3 mb-1">{{$lang['10']}}</p>
                            <table class="w-full">
                                <tr>
                                    <td width="60%" class="border-b py-2">ft³/s</td>
                                    <td class="border-b py-2">{{round($detail['airflow_rate'] * 0.00980963, 2)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">ft³/hr</td>
                                    <td class="border-b py-2">{{round($detail['airflow_rate'] * 35.31467, 2)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">ft³/day</td>
                                    <td class="border-b py-2">{{round($detail['airflow_rate'] * 547.552, 2)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">m³/s</td>
                                    <td class="border-b py-2">{{round($detail['airflow_rate'] * 0.0002777778, 2)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">m³/min</td>
                                    <td class="border-b py-2">{{round($detail['airflow_rate'] * 0.016666667, 2)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">m³/day</td>
                                    <td class="border-b py-2">{{round($detail['airflow_rate'] * 24, 2)}}</td>
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