@php
    if (isset($_POST['submit'])) {  
    $price_unit=$_POST['price_unit'];
    $price=$_POST['price'];
}elseif(isset($_GET['res_link'])){
  $price_unit=$GET['price_unit'];
  $price=$GET['price'];

}
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
          
                <div class="col-span-12">
                    <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select name="operations" id="operations" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? "selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'],$lang['3'],$lang['4']];
                                $val = ['3','4','5'];
                                optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']:'3');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class=" col-span-6 ffirst">
                    <label for="first" class="font-s-14 text-blue first_text">
                        @if(isset($_POST['operations']) && $_POST['operations'] === '5')
                            {{$lang['20']}}
                        @else
                            {{ $lang['6'] }}
                        @endif
                    :</label>
                    <div class="relative w-full ">
                        <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first'])?$_POST['first']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'in' }} ▾</label>
                        <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'in' }}" id="units1" class="hidden">
                        <div id="units1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units1">
                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units1', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
                 <div class=" col-span-6 second {{ isset($_POST['operations']) && $_POST['operations'] === '5' ?'hidden':'d-block' }}">
                    <label for="second" class="font-s-14 text-blue second_text">
                            {{ $lang['7'] }}
                    :</label>
                    <div class="relative w-full ">
                        <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second'])?$_POST['second']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units2_dropdown')">{{ isset($_POST['units2'])?$_POST['units2']:'in' }} ▾</label>
                        <input type="text" name="units2" value="{{ isset($_POST['units2'])?$_POST['units2']:'in' }}" id="units2" class="hidden">
                        <div id="units2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units2">
                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units2', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
                 <div class=" col-span-6 third ">
                    <label for="third" class="font-s-14 text-blue third_text">
                            {{ $lang['12'] }}
                    :</label>
                    <div class="relative w-full ">
                        <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third'])?$_POST['third']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units3_dropdown')">{{ isset($_POST['units3'])?$_POST['units3']:'in' }} ▾</label>
                        <input type="text" name="units3" value="{{ isset($_POST['units3'])?$_POST['units3']:'in' }}" id="units3" class="hidden">
                        <div id="units3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units3">
                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units3', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6 four {{ isset($_POST['operations']) && $_POST['operations'] === '5' ?'pe-lg-3':'ps-lg-3' }}">
                    <label for="four" class="font-s-14 text-blue four_text">
                            {{ $lang['11'] }}
                    :</label>
                    <div class="relative w-full ">
                        <input type="number" name="four" id="four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['four'])?$_POST['four']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units4_dropdown')">{{ isset($_POST['units4'])?$_POST['units4']:'in' }} ▾</label>
                        <input type="text" name="units4" value="{{ isset($_POST['units4'])?$_POST['units4']:'in' }}" id="units4" class="hidden">
                        <div id="units4_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units4">
                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units4', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
               
                <div class=" col-span-6 fiveb {{ isset($_POST['operations']) && $_POST['operations'] === '4' ?'d-block':'hidden' }}">
                    <label for="fiveb" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                    <div class="w-100 py-2 position-relative"> 
                        <input type="number" step="any" name="fiveb" id="fiveb" class="input" aria-label="input"  value="{{ isset($_POST['fiveb'])?$_POST['fiveb']:'15' }}" />
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class=" col-span-6  price ">
                    <label for="price" class="font-s-14 text-blue">{{ $lang['13'] }} ({{$lang['14']}}):</label>
                    <div class="relative w-full ">
                        <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price'])?$_POST['price']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_unit_dropdown')">{{ isset($_POST['price_unit'])?$_POST['price_unit']:'ft²' }} ▾</label>
                        <input type="hidden"  name="currancy" value="{{ $currancy }}">
                        <input type="text" name="price_unit" value="{{ isset($_POST['price_unit'])?$_POST['price_unit']:'ft²' }}" id="price_unit" class="hidden">
                        <div id="price_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{$currancy}} ft²')"> {{$currancy}} ft²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{$currancy}} m²')"> {{$currancy}} m²</p>
                        </div>
                    </div>
                 </div>
                 <div class=" col-span-6 cost ">
                    <label for="cost" class="font-s-14 text-blue">{{ $lang['15'] }} ({{$lang['14']}}):</label>
                    <div class="relative w-full ">
                        <input type="number" name="cost" id="cost" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cost'])?$_POST['cost']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="cost_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cost_unit_dropdown')">{{ isset($_POST['cost_unit'])?$_POST['cost_unit']:'ft²' }} ▾</label>
                        <input type="hidden"  name="currancy" value="{{ $currancy }}">
                        <input type="text" name="cost_unit" value="{{ isset($_POST['cost_unit'])?$_POST['cost_unit']:'ft²' }}" id="cost_unit" class="hidden">
                        <div id="cost_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cost_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('cost_unit', '{{$currancy}} ft²')"> {{$currancy}} ft²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('cost_unit', '{{$currancy}} m²')"> {{$currancy}} m²</p>
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
                    <div class="w-full my-1">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 text-[19px]">
                            <table class="w-full">
                                <tr>
                                    <td width="60%" class="border-b py-2"><strong>{{$lang['16']}} :</strong></td>
                                    <td class="border-b py-2">{{$detail['no_paver']}} </td>
                                </tr>
                                @isset ($detail['area_ans'])
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['5'] }} :</td>
                                        <td class="border-b py-2">{{ round($detail['area_ans'],2) }} (ft²)</td>
                                    </tr>
                                @endisset
                                @isset ($detail['patio_area_ans'])
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['10'] }} :</td>
                                        <td class="border-b py-2">{{ round($detail['patio_area_ans'],2) }} (ft²)</td>
                                    </tr>
                                @endisset
                                @isset ($detail['price_p'])
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['17'] }} :</td>
                                        <td class="border-b py-2">{{ $currancy }} {{ $detail['price_p'] }}
                                        </td>
                                    </tr>
                                @endisset
                                @isset ($detail['cost_p'])
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['18'] }} :</td>
                                        <td class="border-b py-2">{{ $currancy }} {{ $detail['cost_p'] }}
                                        </td>
                                    </tr>
                                @endisset
                                @isset ($detail['total_cost'])
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['19'] }} :</td>
                                        <td class="border-b py-2">{{ $currancy }}
                                            {{ $detail['total_cost'] }}</td>
                                    </tr>
                                @endisset
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
        var first = document.querySelector('.ffirst');
        var first_t = document.querySelector('.first_text');
        var second = document.querySelector('.second');
        var second_t = document.querySelector('.second_text');
        var third= document.querySelector('.third');
        var four = document.querySelector('.four');
        var fiveb= document.querySelector('.fiveb');
        var price= document.querySelector('.price');
        document.getElementById('operations').addEventListener('change',function(){
            var value = this.value;
            if (value === "3"){
                first_t.innerHTML = "{{$lang['6']}}:";
                four.classList.add('ps-lg-3');
                four.classList.remove('pe-lg-3');
                second.style.display = "block";
                fiveb.style.display = "none";
            } else if (value === "4") {
                first_t.innerHTML = "{{$lang['6']}}:";
                second.style.display = "block";
                four.classList.add('pe-lg-3');
                four.classList.remove('ps-lg-3');
                fiveb.style.display = "block";
            }else if (value === "5") {
                first_t.innerHTML = "{{$lang['20']}}:";
                second.style.display = "none";
                third.style.display = "block";
                four.style.display = "block";
                fiveb.style.display = "none";
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>