<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-7">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12">
                            <label for="sides" class="label">{{ $lang['2'] }}:</label>
                            <div class="w-full py-2">
                                <select name="sides" class="input" id="sides" aria-label="select">
                                    <option value="a">{{$lang[2]}}</option>
                                    <option value="b" {{ isset($_POST['sides']) && $_POST['sides']=='b'?'selected':'' }}>{{$lang[3]}}</option>
                                    <option value="c" {{ isset($_POST['sides']) && $_POST['sides']=='c'?'selected':'' }}>{{$lang[4]}}</option>
                                    <option value="area" {{ isset($_POST['sides']) && $_POST['sides']=='area'?'selected':'' }}>{{$lang[5]}}</option>
                                    <option value="perimeter" {{ isset($_POST['sides']) && $_POST['sides']=='perimeter'?'selected':'' }}>{{$lang[6]}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="input" class="font-s-14 text-blue" id="changeText">
                                @if (isset($_POST['sides']) && $_POST['sides'] === "perimeter")
                                    {{$lang[6]}}
                                @elseif(isset($_POST['sides']) && $_POST['sides'] === "b")
                                    {{$lang[11]}}
                                @elseif(isset($_POST['sides']) && $_POST['sides'] === "c")
                                    {{$lang[12]}}
                                @elseif(isset($_POST['sides']) && $_POST['sides'] === "area")
                                    {{$lang[5]}}
                                @else
                                    {{$lang[7]}}
                                @endif
                            </label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="input" id="input" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['input']) ? $_POST['input'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                              
                                <div class="{{ isset($_POST['sides']) && $_POST['sides']==='area' ? 'hidden':'' }}" id="linearUnit">
                                <label for="linear_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('linear_unit_dropdown')">{{ isset($_POST['linear_unit'])?$_POST['linear_unit']:'cm' }} ▾</label>
                                <input type="text" name="linear_unit" value="{{ isset($_POST['linear_unit'])?$_POST['linear_unit']:'cm' }}" id="linear_unit" class="hidden">
                                <div id="linear_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="linear_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'mm')">millimeters (mm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'cm')">centimeters (cm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'm')">meters (m)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'km')">kilometers (km)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'in')">inches (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'ft')">feets (ft)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'yd')">yards (yd)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'mi')">miles (mi)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'nmi')">nautical miles (nmi)</p>
                                </div>
                            </div>
                            <div class="{{ isset($_POST['sides']) && $_POST['sides']==='area' ? '':'hidden' }}" id="squareUnit">
                                <label for="linear_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('linear_unit_dropdown')">{{ isset($_POST['linear_unit'])?$_POST['linear_unit']:'cm' }} ▾</label>
                                <input type="text" name="linear_unit" value="{{ isset($_POST['linear_unit'])?$_POST['linear_unit']:'cm' }}" id="linear_unit" class="hidden">
                                <div id="linear_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="linear_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'mm²')">square millimeters (mm²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'cm²')">square centimeters (cm²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'm²')">square meters (m²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'km²')">square kilometers (km²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'in²')">square inches (in²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'ft²')">square feets (ft²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'yd²')">square yards (yd²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'mi²')">square miles (mi²)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'nmi²')">square nautical miles (nmi²)</p>

                                </div>
                            </div>
                            </div>
                        </div>
                       
                   </div>
                </div>
                <div class="col-span-5 mt-3 text-center flex justify-center items-center">
                    <img src="{{asset('images/new_fourty_five.webp')}}" height="100%" width="150px" alt="trianle details image" loading="lazy" decoding="async">
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
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[2]}}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['a_ans'], 2)}} cm</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[3]}}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['b_ans'], 2)}} cm</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[4]}}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['c_ans'], 2)}} cm</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[8]}}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['height'], 2)}} cm</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[5]}}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['area_ans'], 2)}} cm²</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[9]}}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['radius'], 2)}} cm</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[10]}}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['height'], 2)}} cm</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('sides').addEventListener('change', function() {
                if (this.value === "a") {
                    document.getElementById('changeText').textContent = "{{$lang[7]}}";
                    ['#linearUnit'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#squareUnit'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "b"){
                    document.getElementById('changeText').textContent = '{{$lang[11]}}';
                    ['#linearUnit'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#squareUnit'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "c"){
                    document.getElementById('changeText').textContent = '{{$lang[12]}}';
                    ['#linearUnit'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#squareUnit'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "area"){
                    document.getElementById('changeText').textContent = '{{$lang[5]}}';
                    ['#linearUnit'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['#squareUnit'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else{
                    document.getElementById('changeText').textContent = '{{$lang[6]}}';
                    ['#linearUnit'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#squareUnit'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>