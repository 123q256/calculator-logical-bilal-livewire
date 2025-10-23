<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
              
                <div class="col-span-6">
                    <label for="calculation_unit" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select name="calculation_unit" id="calculation_unit" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'], $lang['3']];
                                $val = ['1','2'];
                                optionsList($val,$name,isset($_POST['calculation_unit'])?$_POST['calculation_unit']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                 <div class="col-span-6 total_area {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] !== '1' ? 'block' : 'hidden' }}">
                    <label for="total_area" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="total_area" id="total_area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['total_area'])?$_POST['total_area']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="total_area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('total_area_unit_dropdown')">{{ isset($_POST['total_area_unit'])?$_POST['total_area_unit']:'cm' }} ▾</label>
                        <input type="text" name="total_area_unit" value="{{ isset($_POST['total_area_unit'])?$_POST['total_area_unit']:'cm' }}" id="total_area_unit" class="hidden">
                        <div id="total_area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="total_area_unit">
                            @foreach (["sq ft","sq m","sq yd","sq in","sq cm"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('total_area_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6 area_length {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] === '2' ? 'hidden' : 'block' }}">
                    <label for="area_length" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="area_length" id="area_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area_length'])?$_POST['area_length']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="area_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_length_unit_dropdown')">{{ isset($_POST['area_length_unit'])?$_POST['area_length_unit']:'cm' }} ▾</label>
                        <input type="text" name="area_length_unit" value="{{ isset($_POST['area_length_unit'])?$_POST['area_length_unit']:'cm' }}" id="area_length_unit" class="hidden">
                        <div id="area_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_length_unit">
                            @foreach (["cm","m","mm","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('area_length_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6 area_width {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] === '2' ? 'hidden' : 'block' }}">
                    <label for="area_width" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="area_width" id="area_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area_width'])?$_POST['area_width']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="area_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_width_unit_dropdown')">{{ isset($_POST['area_width_unit'])?$_POST['area_width_unit']:'cm' }} ▾</label>
                        <input type="text" name="area_width_unit" value="{{ isset($_POST['area_width_unit'])?$_POST['area_width_unit']:'cm' }}" id="area_width_unit" class="hidden">
                        <div id="area_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_width_unit">
                            @foreach (["cm","m","mm","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('area_width_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6 tile_length ">
                    <label for="tile_length" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="tile_length" id="tile_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tile_length'])?$_POST['tile_length']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="tile_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tile_length_unit_dropdown')">{{ isset($_POST['tile_length_unit'])?$_POST['tile_length_unit']:'m' }} ▾</label>
                        <input type="text" name="tile_length_unit" value="{{ isset($_POST['tile_length_unit'])?$_POST['tile_length_unit']:'m' }}" id="tile_length_unit" class="hidden">
                        <div id="tile_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tile_length_unit">
                            @foreach (["cm","m","mm","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('tile_length_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6 tile_width">
                    <label for="tile_width" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                    <div class="relative w-full  mt-[7px]">
                        <input type="number" name="tile_width" id="tile_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tile_width'])?$_POST['tile_width']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="tile_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tile_width_unit_dropdown')">{{ isset($_POST['tile_width_unit'])?$_POST['tile_width_unit']:'m' }} ▾</label>
                        <input type="text" name="tile_width_unit" value="{{ isset($_POST['tile_width_unit'])?$_POST['tile_width_unit']:'m' }}" id="tile_width_unit" class="hidden">
                        <div id="tile_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tile_width_unit">
                            @foreach (["cm","m","mm","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('tile_width_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-6 gap_size ">
                    <label for="gap_size" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="gap_size" id="gap_size" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['gap_size'])?$_POST['gap_size']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="gap_size_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('gap_size_unit_dropdown')">{{ isset($_POST['gap_size_unit'])?$_POST['gap_size_unit']:'m' }} ▾</label>
                        <input type="text" name="gap_size_unit" value="{{ isset($_POST['gap_size_unit'])?$_POST['gap_size_unit']:'m' }}" id="gap_size_unit" class="hidden">
                        <div id="gap_size_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="gap_size_unit">
                            @foreach (["cm","m","mm","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('gap_size_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
                <div class="col-span-6 waste ">
                    <label for="waste" class="font-s-14 text-blue">{{ $lang['10'] }} (%):</label>
                    <div class="w-full py-2 position-relative"> 
                        <input type="number" step="any" name="waste" id="waste" class="input" aria-label="input"  value="{{ isset($_POST['waste'])?$_POST['waste']:'10' }}" />
                    </div>
                </div>
                <p class="col-span-12"><strong>{{$lang['11']}} ({{$lang['12']}}):</strong></p>

                <div class="col-span-6 price ">
                    <label for="price" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price'])?$_POST['price']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_unit_dropdown')">{{ isset($_POST['price_unit'])?$_POST['price_unit']:'tile' }} ▾</label>
                        <input type="text" name="price_unit" value="{{ isset($_POST['price_unit'])?$_POST['price_unit']:'tile' }}" id="price_unit" class="hidden">
                        <div id="price_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{$currancy}} tile')">{{$currancy}} tile</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{$currancy}} box')">{{$currancy}} box</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{$currancy}} inch²')">{{$currancy}} inch²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{$currancy}} feet²')">{{$currancy}} feet²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{$currancy}} yard²')">{{$currancy}} yard²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{$currancy}} acre')">{{$currancy}} acre</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{$currancy}} meter²')">{{$currancy}} meter²</p>
                        </div>
                    </div>
                 </div>

                <div class="col-span-6 box_size">
                    <label for="box_size" class="font-s-14 text-blue">{{ $lang['14'] }}:</label>
                    <div class="w-full py-2 relative"> 
                        <input type="number" step="any" name="box_size" id="box_size" class="input" aria-label="input"  value="{{ isset($_POST['box_size'])?$_POST['box_size']:'' }}" />
                        <span class="text-blue input_unit">Tiles Per Box</span>
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
                        <div class="w-full my-2">
                            <p class="text-[20px]"><strong>{{$lang[15]}}</strong></p>
                            <div class="lg:w-[70%] md:w-[70%] w-ful text-[18px]">
                                <table class="w-full">
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang[16]}} :</td>
                                        <td class="border-b py-2">{{($detail['formula']) }} <span>({{$lang[17]}})</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang[20]}} :</td>
                                        <td class="border-b py-2">{{$detail['calculate_size']}} <span> (ft²)</span></td>
                                    </tr>
                                    @if(!empty($detail['calculate_box_size']))
                                    <tr>
                                        <td class="border-b py-2">{{$lang[18]}} :</td>
                                        <td class="border-b py-2">{{$detail['calculate_box_size'] }}</td>
                                    </tr>
                                    @endif
                                    @if(!empty($detail['price_per_tile']))
                                    <tr>
                                        <td class="border-b py-2">{{$lang[19]}} :</td>
                                        <td class="border-b py-2">{{$currancy.' '.$detail['price_per_tile'] }}</td>
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
        var total_area = document.querySelector('.total_area');
        var area_length = document.querySelector('.area_length');
        var area_width= document.querySelector('.area_width');
        document.getElementById('calculation_unit').addEventListener('change',function(){
            var value = this.value;
            if (value === "1") {
                total_area.style.display = "none";
                area_length.style.display = "block";
                area_width.style.display = "block";
            } else if (value === "2") {
                total_area.style.display = "block";
                area_length.style.display = "none";
                area_width.style.display = "none";
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>