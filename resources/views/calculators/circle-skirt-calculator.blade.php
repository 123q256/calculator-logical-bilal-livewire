<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">

                <div class="col-lg-6">
                    <div class="col-12 px-2 mt-0 mt-lg-2">
                        <label for="type" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select class="input" name="type" id="type" aria-label="input select">
                                <option value="full" selected>{{ $lang['2'] }}</option>
                                <option value="three-quarter" {{ isset($_POST['type']) && $_POST['type'] === 'three-quarter' ? 'selected' : '' }}>{{ $lang['3'] }}</option>
                                <option value="half" {{ isset($_POST['type']) && $_POST['type'] === 'half' ? 'selected' : '' }}>{{ $lang['4'] }}</option>
                                <option value="quarter" {{ isset($_POST['type']) && $_POST['type'] === 'quarter' ? 'selected' : '' }}>{{ $lang['5'] }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 px-2 mt-0 mt-lg-2">
                        <label for="waist" class="font-s-14 text-blue">({{ $lang['6'] }}):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="waist" id="waist" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['waist']) ? $_POST['waist'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="waist_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('waist_unit_dropdown')">{{ isset($_POST['waist_unit'])?$_POST['waist_unit']:'mm' }} ▾</label>
                            <input type="text" name="waist_unit" value="{{ isset($_POST['waist_unit'])?$_POST['waist_unit']:'mm' }}" id="waist_unit" class="hidden">
                            <div id="waist_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="waist_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('waist_unit', 'mm')">milimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('waist_unit', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('waist_unit', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('waist_unit', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('waist_unit', 'in')">inches (in)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-12 px-2 mt-0 mt-lg-2">
                        <label for="length" class="font-s-14 text-blue">({{ $lang['4'] }}):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'mm' }} ▾</label>
                            <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'mm' }}" id="length_unit" class="hidden">
                            <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mm')">milimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'in')">inches (in)</p>
                            </div>
                         </div>
                    </div>
                 
                
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{asset('images/full.svg')}}" alt="skirt" class="set_img max-width" width="230px" height="260px">
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
                    <div class="w-full mt-3">
                        <p class="text-[18px] mt-2"><strong>{{ $lang['8']}}</strong></p>
                        <div class="w-full md:w-[60%] lg:w-[60%] text-[20px} overflow-auto my-3">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2">{{$lang['10']}} :</td>
                                    <td class="border-b py-2">{{$detail['radius_cm'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['11']}} :</td>
                                    <td class="border-b py-2">{{ $detail['radius_mm'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['12']}} :</td>
                                    <td class="border-b py-2">{{ $detail['radius_m'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['13']}} :</td>
                                    <td class="border-b py-2">{{ $detail['radius_in'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['14']}} :</td>
                                    <td class="border-b py-2">{{ $detail['radius_ft'] }}</td>
                                </tr>
                            </table>
                        </div>
                        <p class="text-[20px] mt-2"><strong>{{ $lang['9']}}</strong></p>
                        <div class="w-full md:w-[60%] lg:w-[60%] font-s-18 overflow-auto mt-2">
                            <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2">{{$lang['10']}} :</td>
                                        <td class="border-b py-2">{{$detail['fabric_length_cm'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['11']}} :</td>
                                        <td class="border-b py-2">{{ $detail['fabric_length_mm'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['12']}} :</td>
                                        <td class="border-b py-2">{{ $detail['fabric_length_m'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['13']}} :</td>
                                        <td class="border-b py-2">{{ $detail['fabric_length_in'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['14']}} :</td>
                                        <td class="border-b py-2">{{ $detail['fabric_length_ft'] }}</td>
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
        document.getElementById("type").addEventListener("change", function() {
            var value = this.value;
            var setImg = document.querySelector(".set_img");
            if (value === "quarter") {
                setImg.setAttribute("src", '{{asset("images/quarter.svg")}}');
            } else if (value === "half") {
                setImg.setAttribute("src", "{{asset('images/half.svg')}}");
            } else if (value === "three-quarter") {
                setImg.setAttribute("src", "{{asset('images/three-quarter.svg')}}");
            } else {
                setImg.setAttribute("src", "{{asset('images/full.svg')}}");
            }
        });
    </script>
@endpush