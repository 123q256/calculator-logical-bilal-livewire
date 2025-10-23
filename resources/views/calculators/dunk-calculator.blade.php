<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="hoopType" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2"> 
                    <select name="hoopType" id="hoopType" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["2ⁿᵈ"."$lang[2]", "3ʳᵈ to 4ᵗʰ"."$lang[3]", "5ᵗʰ to 6ᵗʰ"."$lang[3]", "7ᵗʰ"."$lang[4]", "$lang[5]"];
                            $val = ["7", "8", "9", "10", "custom"];
                            optionsList($val,$name,isset($_POST['hoopType'])?$_POST['hoopType']:'8');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="height" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '243.84' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'kg' }} ▾</label>
                    <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'kg' }}" id="height_unit" class="hidden">
                    <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                        @foreach (["cm","m","in","ft","yd"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('height_unit', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="mass" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="mass" id="mass" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass']) ? $_POST['mass'] : '243' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_unit_dropdown')">{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'kg' }} ▾</label>
                    <input type="text" name="mass_unit" value="{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'kg' }}" id="mass_unit" class="hidden">
                    <div id="mass_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mass_unit">
                        @foreach (["g", "kg", "t", "lb", "st", "US ton", "long ton","Earths"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('mass_unit', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="acceleration" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="acceleration" id="acceleration" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['acceleration']) ? $_POST['acceleration'] : '40' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="acceleration_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('acceleration_unit_dropdown')">{{ isset($_POST['acceleration_unit'])?$_POST['acceleration_unit']:'kg' }} ▾</label>
                    <input type="text" name="acceleration_unit" value="{{ isset($_POST['acceleration_unit'])?$_POST['acceleration_unit']:'kg' }}" id="acceleration_unit" class="hidden">
                    <div id="acceleration_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="acceleration_unit">
                        @foreach (["m/s²","g", "ft/s²"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('acceleration_unit', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="palm_size" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="palm_size" id="palm_size" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['palm_size']) ? $_POST['palm_size'] : '40' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="palm_size_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('palm_size_unit_dropdown')">{{ isset($_POST['palm_size_unit'])?$_POST['palm_size_unit']:'kg' }} ▾</label>
                    <input type="text" name="palm_size_unit" value="{{ isset($_POST['palm_size_unit'])?$_POST['palm_size_unit']:'kg' }}" id="palm_size_unit" class="hidden">
                    <div id="palm_size_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="palm_size_unit">
                        @foreach (["mm","cm", "m","in","ft"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('palm_size_unit', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="standing" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="standing" id="standing" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['standing']) ? $_POST['standing'] : '40' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="standing_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('standing_unit_dropdown')">{{ isset($_POST['standing_unit'])?$_POST['standing_unit']:'kg' }} ▾</label>
                    <input type="text" name="standing_unit" value="{{ isset($_POST['standing_unit'])?$_POST['standing_unit']:'kg' }}" id="standing_unit" class="hidden">
                    <div id="standing_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="standing_unit">
                        @foreach (["mm","cm", "m","km","in","ft","yd","mi","nmi"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('standing_unit', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
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
                        <div class="w-full py-2">
                            <div class="w-full md:w-[80%] lg:w-[80%]">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td width="60%" class="border-b py-2"><strong>{{$lang['11']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['minimum_vertical_leap']}} (cm)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['12']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['hang_time']}} (sec)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['13']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['jumping_energy']}} (J)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['14']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['initial_jumping_speed']}} (m/s)</td>
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
        document.getElementById('hoopType').addEventListener('change',function(){
            var hookvalue = this.value;
            var height = document.getElementById('height');
            if (hookvalue === "7") {
                height.value = "213.36";
            } else if (hookvalue === "8") {
                height.value = "243.84";
            } else if (hookvalue === "9") {
                height.value = "274.3";
            }else if (hookvalue === "10") {
                height.value = "304.8";
            } else if (hookvalue === "custom") {
                height.value = "";
            }
        })
    </script>
@endpush