<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <div class="w-full px-2 my-2"><strong>{{$lang[1]}} :</strong></div>
                </div>
                <div class="col-span-12">
                    <label for="method_unit" class="label">{{ $lang['2'] }}</label>
                    <div class="w-full py-2 relative">
                        <select name="method_unit" id="method_unit" class="input" onchange="mySelection(this)">
                            <option value="{{ $lang[11] }} "{{ isset($_POST['method_unit']) && $_POST['method_unit'] == $lang[11] ? 'selected' : '' }}> {{ $lang[11] }}  </option>
                            <option value="{{ $lang[12] }}" {{ isset($_POST['method_unit']) && $_POST['method_unit'] == $lang[12] ? 'selected' : '' }}> {{ $lang[12] }} </option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="hidden">
                    <label for="property" class="label">{{ $lang['3'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="property" id="property" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['property'])?$_POST['property']:'20000' }}" />
                        <span class="text-blue input_unit">{{ $currancy}}</span>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="hidden_three">
                    <label for="area" class="label d-flex justify-content-between"><span class="text-blue">{{ $lang['9'] }}</span><span class="text-blue"> {{ $currancy}} per</span></label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area']) ? $_POST['area'] : '10000' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'m²' }} ▾</label>
                        <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'m²' }}" id="area_unit" class="hidden">
                        <div id="area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'm²')">m²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ft²')">ft²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'yd²')">yd²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'mi²')">mi²</p>
                        </div>
                     </div>
                </div>

              
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="hidden_sec">
                    <label for="value" class="label">{{ $lang['4'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="value" id="value" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['value'])?$_POST['value']:'20000' }}" />
                        <span class="text-blue input_unit">{{ $currancy}}</span>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="hidden_four">
                    <label for="total" class="label d-flex justify-content-between">{{ $lang['10'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="total" id="total" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['total']) ? $_POST['total'] : '10000' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="total_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('total_unit_dropdown')">{{ isset($_POST['total_unit'])?$_POST['total_unit']:'m²' }} ▾</label>
                        <input type="text" name="total_unit" value="{{ isset($_POST['total_unit'])?$_POST['total_unit']:'m²' }}" id="total_unit" class="hidden">
                        <div id="total_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="total_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'm²')">m²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'ft²')">ft²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'yd²')">yd²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'mi²')">mi²</p>
                        </div>
                     </div>
                </div>
             
                <div class="col-span-12">
                    <div class="w-full px-2 my-3"><strong>{{$lang[5]}} :</strong></div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="average" class="label d-flex justify-content-between"><span class="text-blue">{{ $lang['6'] }}</span><span class="text-blue"> {{ $currancy}} per</span></label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="average" id="average" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['average']) ? $_POST['average'] : '10000' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="average_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('average_unit_dropdown')">{{ isset($_POST['average_unit'])?$_POST['average_unit']:'m²' }} ▾</label>
                        <input type="text" name="average_unit" value="{{ isset($_POST['average_unit'])?$_POST['average_unit']:'m²' }}" id="average_unit" class="hidden">
                        <div id="average_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="average_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('average_unit', 'm²')">m²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('average_unit', 'ft²')">ft²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('average_unit', 'yd²')">yd²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('average_unit', 'mi²')">mi²</p>
                        </div>
                     </div>
                </div>
            
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="cost" class="label">{{ $lang['7'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="cost" id="cost" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['cost'])?$_POST['cost']:'1000' }}" />
                        <span class="text-blue input_unit">{{ $currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="purchase" class="label">{{ $lang['8'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="purchase" id="purchase" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['purchase'])?$_POST['purchase']:'50' }}" />
                        <span class="text-blue input_unit">%</span>
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
                        <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                            <table class="w-full text-[18px]">
                               <tr>
                                  <td class="py-2 border-b" width="70%"><strong>{{ $lang[14] }} </strong></td>
                                   <td class="py-2 border-b"> {{$currancy}} {{ $detail['after_repair_value'] }}</td>
                               </tr>
                               <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[15] }} </strong></td>
                                 <td class="py-2 border-b"> {{ $detail['requires_repairs'] }} {{ $_POST['average_unit']}}</td>
                             </tr>
                             <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[16] }} </strong></td>
                                 <td class="py-2 border-b"> {{ round($detail['maximum_bid_price']) }}</td>
                             </tr>
                             <tr>
                                <td class="py-2 border-b" width="70%"><strong>ROI </strong></td>
                                 <td class="py-2 border-b"> {{ round($detail['roi']) }}</td>
                             </tr>
                             <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[17] }} </strong></td>
                                 <td class="py-2 border-b"> {{ round($detail['percentage']) }} %</td>
                             </tr>
                            </table>
                      </div>
                        <div class="w-full text-[16px]">
                            <div class="w-full">
                                <p class="mt-3">{{ $lang[18] }}</p>
                                <p class="mt-2"><strong>{{ $lang[14] }}</strong></p>
                                <p class="mt-2">{{ $lang[14] }} =
                                    @if($_POST['method_unit'] === "Value of the property")
                                        {{ $lang[3] }} + {{ $lang[4] }}
                                    @else
                                        {{ $lang[9] }} x {{ $lang[10] }}
                                    @endif
                                </p>
                                <p class="mt-2">{{ $lang[14] }} = {{ $currancy }} {{ round($detail['after_repair_value'],4) }} </p>
                                <p class="mt-2"><strong> {{ $lang[15] }}</strong></p>
                                <p class="mt-2">{{ $lang[15] }} = {{ $lang[7] }} / {{ $lang[6] }}</p>
                                <p class="mt-2">{{ $lang[15] }} = {{ round($detail['requires_repairs'],4) }}{{ $_POST['average_unit']}}</b></p>
                                <p class="mt-2"><strong>{{ $lang[16] }}</strong></p>
                                <p class="mt-2">{{ $lang[16] }} = {{ $lang[15] }} x ( {{ $lang[8] }} %) - {{ $lang[7] }}</p>
                                <p class="mt-2">{{ $lang[16] }} = {{ $currancy }} {{ round($detail['maximum_bid_price'], 4) }}</b></p>
                                <p class="mt-2"><strong>{{ $lang[17] }}</strong></p>
                                <p class="mt-2">{{ $lang[17] }} = {{ $lang[8] }} - 100</p>
                                <p class="mt-2">{{ $lang[17] }} = {{ round($detail['percentage'], 4) }}%</p>
                                <p class="mt-2"><strong>ROI</strong></p>
                                <p class="mt-2">ROI = {{ $lang[17] }} * {{ $lang[14] }}</p>
                                <p class="mt-2">ROI = {{ $currancy }} {{ round($detail['roi'], 4) }}</p>
            
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
function mySelection(chal) {
    var aja = chal.value;
    if (aja === "{{ $lang[11] }}") {
        document.getElementById('hidden_sec').classList.remove('hidden');
        document.getElementById('hidden').classList.remove('hidden');
        document.getElementById('hidden_three').classList.add('hidden');
        document.getElementById('hidden_four').classList.add('hidden');
    } else if (aja === "{{ $lang[12] }}") {
        document.getElementById('hidden_three').classList.remove('hidden');
        document.getElementById('hidden_four').classList.remove('hidden');
        document.getElementById('hidden_sec').classList.add('hidden');
        document.getElementById('hidden').classList.add('hidden');
    } else {
        document.getElementById('hidden_sec').classList.remove('hidden');
        document.getElementById('hidden').classList.remove('hidden');
        document.getElementById('hidden_three').classList.add('hidden');
        document.getElementById('hidden_four').classList.add('hidden');
    }
}
@if(isset($detail) || isset($error) )
    var aja = "{{$_POST['method_unit']}}";
    if (aja === "{{ $lang[11] }}") {
        document.getElementById('hidden_sec').classList.remove('hidden');
        document.getElementById('hidden').classList.remove('hidden');
        document.getElementById('hidden_three').classList.add('hidden');
        document.getElementById('hidden_four').classList.add('hidden');
    } else if (aja === "{{ $lang[12] }}") {
        document.getElementById('hidden_three').classList.remove('hidden');
        document.getElementById('hidden_four').classList.remove('hidden');
        document.getElementById('hidden_sec').classList.add('hidden');
        document.getElementById('hidden').classList.add('hidden');
    } else {
        document.getElementById('hidden_sec').classList.remove('hidden');
        document.getElementById('hidden').classList.remove('hidden');
        document.getElementById('hidden_three').classList.add('hidden');
        document.getElementById('hidden_four').classList.add('hidden');
    }
@endif
</script>
@endpush