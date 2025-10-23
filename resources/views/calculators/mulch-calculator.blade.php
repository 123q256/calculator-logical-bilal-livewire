<style>

.current_input {
    display: none;
    transition: display 0.5s ease-in-out;
}

.button {
    transform: rotate(360deg);
    transition: .5s ease-in-out;
}
.show {
    display: flex
;
}
.rotate {
    transform: rotate(180deg);
}
    </style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                
                <div class="col-span-12 ">
                    <label for="m-shape" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select name="m-shape" id="m-shape" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'], $lang['3'], $lang['4']];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset($_POST['m-shape'])?$_POST['m-shape']:'0');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 chose {{ isset($_POST['m-shape']) && $_POST['m-shape'] !== '0'?'hidden':'d-block' }}">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12">
                        <input type="radio" name="g" id="g1" value="g1" checked {{ isset($_POST['check']) && $_POST['check'] === 'g1' ? 'checked' : '' }}>
                        <label for="g1" class="label pe-lg-3 pe-2">{{ $lang['5'] }}:</label>
                    </div>
                    <div class="col-span-12">
                        <input type="radio" name="g" id="g2" value="g2" {{ isset($_POST['check']) && $_POST['check'] === 'g2' ? 'checked' : '' }}>
                        <label for="g2" class="label">{{ $lang['6'] }}:</label>
                        <input type="hidden" name="check" id="check" value="g1">
                    </div>
                    </div>
                </div> 

                <div class="col-span-6 length {{ isset($_POST['m-shape']) && $_POST['m-shape'] !== '0'?'hidden':'d-block' }} {{ isset($_POST['check']) && $_POST['check'] === 'g2'?'hidden':'d-block' }} ">
                    <label for="length" class="label">{{ $lang['7'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length1_dropdown')">{{ isset($_POST['length1'])?$_POST['length1']:'m' }} ▾</label>
                        <input type="text" name="length1" value="{{ isset($_POST['length1'])?$_POST['length1']:'m' }}" id="length1" class="hidden">
                        <div id="length1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length1">
                            @foreach (["cm","m","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length1', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6 width {{ isset($_POST['m-shape']) && $_POST['m-shape'] !== '0'?'hidden':'d-block' }} {{ isset($_POST['check']) && $_POST['check'] === 'g2'?'hidden':'d-block' }}">
                    <label for="width" class="label">{{ $lang['22'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width1_dropdown')">{{ isset($_POST['width1'])?$_POST['width1']:'m' }} ▾</label>
                        <input type="text" name="width1" value="{{ isset($_POST['width1'])?$_POST['width1']:'m' }}" id="width1" class="hidden">
                        <div id="width1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width1">
                            @foreach (["cm","m","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('width1', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6 side1 {{ isset($_POST['m-shape']) && $_POST['m-shape'] === '2'?'d-block':'hidden' }} ">
                    <label for="side1" class="label">{{ $lang['10'] }} 1:</label>
                    <div class="relative w-full ">
                        <input type="number" name="side1" id="side1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['side1'])?$_POST['side1']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="side11" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('side11_dropdown')">{{ isset($_POST['side11'])?$_POST['side11']:'m' }} ▾</label>
                        <input type="text" name="side11" value="{{ isset($_POST['side11'])?$_POST['side11']:'m' }}" id="side11" class="hidden">
                        <div id="side11_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="side11">
                            @foreach (["cm","m","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('side11', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6 side1 {{ isset($_POST['m-shape']) && $_POST['m-shape'] === '2'?'d-block':'hidden' }}">
                    <label for="side2" class="label">{{ $lang['10'] }} 2:</label>
                    <div class="relative w-full ">
                        <input type="number" name="side2" id="side2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['side2'])?$_POST['side2']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="side21" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('side21_dropdown')">{{ isset($_POST['side21'])?$_POST['side21']:'m' }} ▾</label>
                        <input type="text" name="side21" value="{{ isset($_POST['side21'])?$_POST['side21']:'m' }}" id="side21" class="hidden">
                        <div id="side21_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="side21">
                            @foreach (["cm","m","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('side21', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6 diameter {{ isset($_POST['m-shape']) && $_POST['m-shape'] === '1'?'d-block':'hidden' }}">
                    <label for="diameter" class="label">{{ $lang['9'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="diameter" id="diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['diameter'])?$_POST['diameter']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="diameter1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('diameter1_dropdown')">{{ isset($_POST['diameter1'])?$_POST['diameter1']:'m' }} ▾</label>
                        <input type="text" name="diameter1" value="{{ isset($_POST['diameter1'])?$_POST['diameter1']:'m' }}" id="diameter1" class="hidden">
                        <div id="diameter1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="diameter1">
                            @foreach (["cm","m","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('diameter1', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6 square {{ isset($_POST['check']) && $_POST['check'] !== 'g1'?'d-block':'hidden' }}">
                    <label for="sqr-ft" class="label">{{ $lang['8'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="sqr-ft" id="sqr-ft" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['sqr-ft'])?$_POST['sqr-ft']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="sqr-ft1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('sqr-ft1_dropdown')">{{ isset($_POST['sqr-ft1'])?$_POST['sqr-ft1']:'sq-ft' }} ▾</label>
                        <input type="text" name="sqr-ft1" value="{{ isset($_POST['sqr-ft1'])?$_POST['sqr-ft1']:'sq-ft' }}" id="sqr-ft1" class="hidden">
                        <div id="sqr-ft1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="sqr-ft1">
                            @foreach (["sq-ft","acres"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('sqr-ft1', '{{ $name }}')"> {{ $name }}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6 depth">
                    <label for="depth" class="label">{{ $lang['11'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="depth" id="depth" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['depth'])?$_POST['depth']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="depth1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('depth1_dropdown')">{{ isset($_POST['depth1'])?$_POST['depth1']:'cm' }} ▾</label>
                        <input type="text" name="depth1" value="{{ isset($_POST['depth1'])?$_POST['depth1']:'cm' }}" id="depth1" class="hidden">
                        <div id="depth1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="depth1">
                            @foreach (["cm","m","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('depth1', '{{ $name }}')"> {{ $name }}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m-type" class="label">{{ $lang['12'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select id="m-type" class="input" name="m-type">
                            <option value="0">Cedar</option>
                            <option value="1">Cypress</option>
                            <option value="2">Eucalyptus</option>
                            <option value="3">Hardwood</option>
                            <option value="4">Hemlock</option>
                            <option value="5">Pine</option>
                            <option value="6" selected>Pine Needles</option>
                            <option value="7">Pine Nuggets</option>
                            <option value="8">Rubber</option>
                            <option value="9">Rubber Nuggets</option>
                            <option value="10">Wheat Straw</option>
                            <option value="11">Soil</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 cursor-pointer current_gpa flex items-center justify-center my-3">
                    <strong class="pe-lg-3">{{$lang['13']}}:</strong>
                    <img src="{{asset('images/new-down.webp')}}" class="right button mx-3" alt="cost" width="16px" height="16px">
                </div>

                <div class="col-span-12  current_input   {{ isset($_POST['price_bag']) && $_POST['price_bag'] !== '' ? 'show' : 'current_input' }}">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-6   price">
                        <label for="price_bag" class="label">{{ $lang['14'] }}:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="price_bag" id="price_bag" class="input" aria-label="input"  value="{{ isset($_POST['price_bag'])?$_POST['price_bag']:'' }}" />
                            <span class="text-blue input_unit">{{$currancy}}</span>
                        </div>
                    </div>
                    <div class="col-span-6  optional {{ isset($_POST['bag_size']) && $_POST['bag_size'] !== '' ? 'd-block' : 'hidden' }}">
                        <label for="bag_size" class="label">{{ $lang['23'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="bag_size" id="bag_size" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bag_size'])?$_POST['bag_size']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="bag_size1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('bag_size1_dropdown')">{{ isset($_POST['bag_size1'])?$_POST['bag_size1']:'cm' }} ▾</label>
                            <input type="text" name="bag_size1" value="{{ isset($_POST['bag_size1'])?$_POST['bag_size1']:'cm' }}" id="bag_size1" class="hidden">
                            <div id="bag_size1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="bag_size1">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('bag_size1', 'm³')"> m³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('bag_size1', 'cu ft')"> cu ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('bag_size1', 'cu yd')"> cu yd</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('bag_size1', 'liters')"> liters</p>
                            </div>
                        </div>
                    </div>
                 
                                {{-- <p value="c_m" data-value="m³">m³</p>
                                <p value="c_f" data-value="cu ft">cu ft</p>
                                <p value="c_y" data-value="cu yd">cu yd</p>
                                <p value="lit" data-value="liters">liters</p> --}}

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
                        <div class="w-full my-1">
                            <div class="w-full md:w-[60%] lg:w-[60%] font-s-18">
                                <table class="w-full">
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{ $lang['15']}} :</td>
                                        <td class="border-b py-2">{{$detail['cubic_yards']}} (cu yd)</td>
                                    </tr>
                                </table>
                                <table class="w-full">
                                    <tr>
                                        <td colspan="2" class=" font-s-20 py-2"><strong>{{$lang['16']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang['15']}}</td>
                                        <td class='border-b py-2'>{{$detail['cubic_ft']}} cubic feet (cu ft)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['15']}}</td>
                                        <td class='border-b py-2'>{{$detail['cubic_meters']}} cubic meters (m<sup>3</sup>)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['15']}}</td>
                                        <td class='border-b py-2'>{{$detail['liters']}} liters</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['17']}}</td>
                                        <td class='border-b py-2'>{{$detail['garden_size']}} sq.ft</td>
                                    </tr>
                                    @if(empty($detail['total_cost1']) && empty($detail['total_cost']))
                                        @if($_POST['m-type']==6 || $_POST['m-type']==10)
                                            <tr>
                                                <td class="border-b py-2">{{$lang['18']}}</td>
                                                <td class='border-b py-2'>{{$detail['size1']}} sq.ft</td>
                                            </tr>
                                        @endif
                                    @endif
                                    @if(!empty($detail['size']) && !empty($detail['total_cost']) || !empty($detail['size1'] && !empty($detail['total_cost1'])))
                                    <tr>
                                        <td colspan="2" class="font-s-20 py-2"><strong>{{$lang['19']}}</strong></td>
                                    </tr>
                                        @if($_POST['m-type']==6 || $_POST['m-type']==10)
                                            <tr>
                                                <td class='border-b py-2'>{{$lang['18']}}</td>
                                                <td class='border-b py-2'>{{$detail['size1']}}</td>
                                            </tr>
                                            <tr>
                                                <td class='border-b py-2'>{{$lang['20']}}</td>
                                                <td class='border-b py-2'>{{$detail['total_cost1']}} {{$currancy}}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class='border-b py-2'>{{$lang['21']}}</td>
                                                <td class='border-b py-2'>{{$detail['size']}}</td>
                                            </tr>
                                            <tr>
                                                <td class='border-b py-2'>{{$lang['20']}}</td>
                                                <td class='border-b py-2'>{{$detail['total_cost']}} {{$currancy}}</td>
                                            </tr>
                                        @endif
                                    @endif
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
        var length = document.querySelector('.length');
        var width = document.querySelector('.width');
        var chose= document.querySelector('.chose');
        var depth= document.querySelector('.depth');
        var side1 = document.querySelectorAll('.side1');
        var sqft = document.querySelector('.square');
        var diameter= document.querySelector('.diameter');
        var check= document.getElementById('check');
        document.getElementById('m-shape').addEventListener('change',function(){
            var value = this.value;
            if (value === "0") {
                length.style.display = "block";
                width.style.display = "block";
                depth.style.display = "block";
                diameter.style.display = "none";
                chose.style.display = "block";
                sqft.style.display = "none";
                side1.forEach(element => {
                    element.style.display = "none";
                });
                side1.style.display = "none";
            } else if (value === "1") {
                length.style.display = "none";
                width.style.display = "none";
                depth.style.display = "block";
                diameter.style.display = "block";
                chose.style.display = "none";
                sqft.style.display = "none";
                side1.forEach(element => {
                    element.style.display = "none";
                });
            } else if (value === "2") {
                length.style.display = "none";
                width.style.display = "none";
                depth.style.display = "block";
                diameter.style.display = "none";
                chose.style.display = "none";
                sqft.style.display = "none";
                side1.forEach(element => {
                    element.style.display = "block";
                });
            }
        });
        document.getElementById('g2').addEventListener('click', function() {
            check.value = "g2";
            length.style.display = "none";
            width.style.display = "none";
            depth.style.display = "block";
            diameter.style.display = "none";
            chose.style.display = "block";
            side1.forEach(element => {
                element.style.display = "none";
            });
            sqft.style.display = "block";
        });
        document.getElementById('g1').addEventListener('click', function() {
            check.value = "g1";
            length.style.display = "block";
            width.style.display = "block";
            diameter.style.display = "none";
            chose.style.display = "block";
            side1.forEach(element => {
                element.style.display = "none";
            });
            depth.style.display = "block";
            sqft.style.display = "none";

        });
        document.querySelector('.current_gpa').addEventListener('click', function() {
            var view = document.querySelector('.current_input');
            var button = document.querySelector('.button');
            view.classList.remove('hidden');
            view.classList.toggle('show');
            button.classList.toggle('rotate');
        });
        document.getElementById('m-type').addEventListener('change', function() {
            var type = this.value;
            var optional = document.querySelector('.optional')
            if(type === '6' || type === '10'){
                optional.style.display= 'none';
            }else{
                optional.style.display= 'block';
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>