<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="input" class="label">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="input" id="input" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['input']) ? $_POST['input'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="in_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('in_unit_dropdown')">{{ isset($_POST['in_unit'])?$_POST['in_unit']:'m' }} ▾</label>
                        <input type="text" name="in_unit" value="{{ isset($_POST['in_unit'])?$_POST['in_unit']:'m' }}" id="in_unit" class="hidden">
                        <div id="in_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="in_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'AU')">AU</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'km')">km</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'mil')">mil</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'mm')">mm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'nm')">nm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'mile')">mile</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'parsec')">parsec</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'pm')">pm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('in_unit', 'yd')">yd</p>
                        </div>
                     </div>
                </div>
            
                <div class="col-span-12">
                    <label for="solve" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-full py-2 ">
                        <select name="solve" id="solve" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = ["m²","Acre","Barn","Hectare","cm²","km²","ft²","in²","miles²","yd²"];
                                        $val = ["1@@m²","0.000247105@@Acre","10000000000000000000000000000@@Barn","0.0001@@Hectare","10000@@cm²","0.000001@@km²","10.7639@@ft²","1550@@in²","0.0000003861@@miles²","1.19599@@yd²"];
                                optionsList($val,$name,isset($_POST['solve'])?$_POST['solve']:'1@@m²');
                            @endphp
                        </select>
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
                <div class="col-12 bg-light-blue  p-3 radius-10 mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$lang['3']}}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">{{ $detail['answer']  }} <span class="font-s-20">{{$detail['unit']}}</span> </strong></p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>