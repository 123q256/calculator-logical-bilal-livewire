@php
    $bag_size_unit=request()->bag_size_unit;
    $bag_size=request()->bag_size;
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  gap-4">
                    <div class="space-y-2">
                        <label for="calculation_unit" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select name="calculation_unit" id="calculation_unit" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? "selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[2]." & ".$lang[3],$lang[4]." & ".$lang[3]];
                                $val = ['1','2'];
                                optionsList($val,$name,isset($_POST['calculation_unit'])?$_POST['calculation_unit']:'3');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 mt-3 lg:grid-cols-2 md:grid-cols-2  gap-4">

                    <div class="space-y-2 length {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] === '2' ?'hidden':'d-block' }}">
                        <label for="length" class="font-s-14 text-blue length_text">  {{ $lang['6'] }}  :</label>
                        <div class="relative w-full ">
                            <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cu ft' }} ▾</label>
                            <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cu ft' }}" id="length_unit" class="hidden">
                            <div id="length_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                                @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', '{{$name}}')">{{$name}}</p>
                            @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="space-y-2  width {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] === '2' ?'hidden':'d-block' }}">
                        <label for="width" class="font-s-14 text-blue width_text"> {{ $lang['7'] }}/{{ $lang['8'] }} :</label>
                        <div class="relative w-full ">
                            <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'m' }} ▾</label>
                            <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'m' }}" id="width_unit" class="hidden">
                            <div id="width_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                                @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', '{{$name}}')">{{$name}}</p>
                            @endforeach
                            </div>
                        </div>
                     </div>

                     <div class="space-y-2  depth">
                        <label for="depth" class="font-s-14 text-blue depth_text"> {{ $lang['3'] }}/{{ $lang['9'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="depth" id="depth" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['depth'])?$_POST['depth']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="depth_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('depth_unit_dropdown')">{{ isset($_POST['depth_unit'])?$_POST['depth_unit']:'m' }} ▾</label>
                            <input type="text" name="depth_unit" value="{{ isset($_POST['depth_unit'])?$_POST['depth_unit']:'m' }}" id="depth_unit" class="hidden">
                            <div id="depth_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                                @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('depth_unit', '{{$name}}')">{{$name}}</p>
                            @endforeach
                            </div>
                        </div>
                     </div>
                     <div class="space-y-2  area  {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] !== '1' ?'d-block':' d-none' }}">
                        <label for="area" class="font-s-14 text-blue area_text">{{ $lang['4'] }} :</label>
                        <div class="relative w-full ">
                            <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area'])?$_POST['area']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'sq ft' }} ▾</label>
                            <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'sq ft' }}" id="area_unit" class="hidden">
                            <div id="area_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                                @foreach (["sq yd","sq ft","sq m"] as $name)
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', '{{$name}}')">{{$name}}</p>
                            @endforeach
                            </div>
                        </div>
                     </div>
                  
                </div>

                <p class="mt-2"><strong>{{$lang['10']}} ({{$lang['11']}})</strong></p>

                <div class="grid grid-cols-2 mt-3 lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2">
                        <label for="purchase_unit" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <select name="purchase_unit" id="purchase_unit" class="input">
                            @php
                                $name = ["In Bags","In Bulk"];
                                $val = ["1","2"];
                                optionsList($val,$name,isset($_POST['purchase_unit'])?$_POST['purchase_unit']:'1');
                            @endphp
                        </select>
                    </div>
                  
                    <div class="space-y-2 bag_size {{ isset($_POST['purchase_unit']) && $_POST['purchase_unit'] !== '1' ?'hidden':'d-block' }}">
                        <label for="bag_size" class="font-s-14 text-blue">{{$lang['12']}}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="bag_size" id="bag_size" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bag_size'])?$_POST['bag_size']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="bag_size_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('bag_size_unit_dropdown')">{{ isset($_POST['bag_size_unit'])?$_POST['bag_size_unit']:'cu ft' }} ▾</label>
                            <input type="text" name="bag_size_unit" value="{{ isset($_POST['bag_size_unit'])?$_POST['bag_size_unit']:'cu ft' }}" id="bag_size_unit" class="hidden">
                            <div id="bag_size_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[25%] md:w-[25%] w-[30%] mt-1 right-0 hidden">
                                @foreach (["cu ft","cu yd","cu m","lbs","kg","liters"] as $name)
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bag_size_unit', '{{$name}}')">{{$name}}</p>
                            @endforeach
                            </div>
                        </div>
                     </div>


                    <div class="space-y-2 cost {{ isset($_POST['purchase_unit']) && $_POST['purchase_unit'] !== '1' ?'hidden':'d-block' }}">
                        <label for="price_per_bag" class="font-s-14 text-blue">{{$lang['13']}}:</label>
                        <input type="number" step="any" name="price_per_bag" id="price_per_bag" class="input" aria-label="input"  value="{{ isset($_POST['price_per_bag'])?$_POST['price_per_bag']:'' }}" />
                        <span class="input-unit text-blue">{{$currancy}}</span>
                    </div>
                    <div class="space-y-2 relative ton_cost {{ isset($_POST['purchase_unit']) && $_POST['purchase_unit'] !== '1' ?'d-block':'hidden' }}">
                        <label for="price_per_ton" class="font-s-14 text-blue">{{$lang['14']}}:</label>
                        <input type="number" step="any" name="price_per_ton" id="price_per_ton" class="input" aria-label="input"  value="{{ isset($_POST['price_per_ton'])?$_POST['price_per_ton']:'' }}" />
                        <span class="input_unit text-blue">{{$currancy}}</span>
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
                <div class="w-full  p-3 radius-10 mt-3">
                    <div class="w-full my-2">
                        <p class="font-s-20"><strong>{{$lang[15]}}</strong></p>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18 overflow-auto">
                            <table class="w-100">
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[16]}} :</strong></td>
                                    <td class="border-b py-2">{{$detail['calculation'] }} (ft³)</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[17]}} :</strong></td>
                                    <td class="border-b py-2">{{$detail['calculation']*0.037037 }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[18]}}({{$lang[19]}}) :</strong></td>
                                    <td class="border-b py-2">{{ round($detail['calculation']*0.037037,2)  }} - {{ round($detail['calculation']*0.037037*1.3,2)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[20]}} (wet) :</strong></td>
                                    <td class="border-b py-2">{{round($detail['calculation']*0.037037*1.5,2)  }} - {{ round(($detail['calculation']*0.037037)*1.7,2) }}</td>
                                </tr>
                                @if(!empty($detail['calculate_cost']))
                                <tr>
                                    <td class="border-b py-2"> <strong>{{$lang[21]}} :</strong> </td>
                                    <td class="border-b py-2">{{ $detail['calculate_cost'] }}</td>
                                </tr>  
                                @endif
                                @if(!empty($detail['number_of_bags']))
                                <tr>
                                    <td class="border-b py-2"> <strong>{{$lang[22]}} :</strong> </td>
                                    <td class="border-b py-2">{{ $detail['number_of_bags'] }}</td>
                                </tr>  
                                @endif
                                @if(!empty($detail['total_cost']))
                                <tr>
                                    <td class="border-b py-2">
                                    <strong>{{$lang[23]}} :</strong>
                                    </td>
                                    <td class="border-b py-2">${{$detail['total_cost']}}<span class="font_size16 sty">($ {{ $detail['price_in_ton'] }} {{$lang[24]}})</span></td>
                                </tr>  
                                @endif
                                @if(!empty($detail['bag1']))
                                
                                <tr>
                                    <td class="border-b py-2">0.75 cu.ft.{{$lang[25]}} :</td>
                                    <td class="border-b py-2">{{$detail['bag1']}}</td>
                                </tr>
                                @endif
                                @if(!empty($detail['bag2']))
                                <tr>
                                    <td class="border-b py-2">1 cu.ft.{{$lang[25]}} :</td>
                                    <td class="border-b py-2">{{$detail['bag2']}}</td>
                                </tr>
                                @endif
                                @if(!empty($detail['bag3']))
                                <tr>
                                    <td class="border-b py-2">1.5 cu.ft.{{$lang[25]}} :</td>
                                    <td class="border-b py-2">{{$detail['bag3']}}</td>
                                </tr>
                                @endif
                                @if(!empty($detail['bag4']))
                                <tr>
                                    <td class="border-b py-2">2 cu.ft.{{$lang[25]}} :</td>
                                    <td class="border-b py-2">{{$detail['bag4']}}</td>
                                </tr>
                                @endif
                                @if(!empty($detail['bag5']))
                                <tr>
                                    <td class="border-b py-2">3 cu.ft.{{$lang[25]}} :</td>
                                    <td class="border-b py-2">{{$detail['bag5']}}</td>
                                </tr>
                                @endif
                                @if(!empty($detail['bag6']))
                                <tr>
                                    <td class="border-b py-2">25 quart {{$lang[25]}} :</td>
                                    <td class="border-b py-2">{{$detail['bag6']}}</td>
                                </tr>
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
        var lenght = document.querySelector('.length');
        var width= document.querySelector('.width');
        var depth = document.querySelector('.depth');
        var area = document.querySelector('.area');
        var cost = document.querySelector('.cost');
        var bag_size = document.querySelector('.bag_size');
        var ton_cost = document.querySelector('.ton_cost');
        document.getElementById('calculation_unit').addEventListener('change',function(){
            var value = this.value;
            if (value === "1"){
                lenght.style.display = "block";
                width.style.display = "block";
                depth.style.display = "block";
                area.style.display = "none";
            } else{
                lenght.style.display = "none";
                width.style.display = "none";
                depth.style.display = "block";
                area.style.display = "block";
            }
        });
        document.getElementById('purchase_unit').addEventListener('change',function(){
            var value = this.value;
            if (value === "1"){
                cost.style.display = "block";
                bag_size.style.display = "block";
                ton_cost.style.display = "none";
            } else{
                cost.style.display = "none";
                bag_size.style.display = "none";
                ton_cost.style.display = "block";
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>