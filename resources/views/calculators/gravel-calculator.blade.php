<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 mt-3 gap-4">
                <div class="flex items-center mt-3 space-x-4">
                    <span>{{$lang['fill']}}</span>
                    <input type="radio" name="from" id="rec" value="rec" checked {{ isset($_POST['from']) && $_POST['from'] === 'rec' ? 'checked' : '' }}>
                    <label for="rec" class="font-s-14 text-blue">{{ $lang['ract'] }}:</label>
                    <input type="radio" name="from" id="circle" value="cic" {{ isset($_POST['from']) && $_POST['from'] === 'cic' ? 'checked' : '' }}>
                    <label for="circle" class="font-s-14 text-blue">{{ $lang['circ'] }}:</label>
                </div>
                
            </div>
            <div class="grid grid-cols-1 mt-5 gap-4">
                <div class="ccol-12 mt-0 mt-lg-2 to_calculate  {{ isset($_POST['from']) && $_POST['from'] === 'cic'?'hidden':'d-block' }}">
                    <label for="to_calculate" class="font-s-14 text-blue">{{ $lang['to_cal'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select name="to_calculate" id="to_calculate" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['length'].' '.$lang['area'].' & '.$lang['volume'], $lang['length'].' & '.$lang['area'], $lang['volume']];
                                $val = ["1","2","3"];
                                optionsList($val,$name,isset($_POST['to_calculate'])?$_POST['to_calculate']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-3 lg:grid-cols-2 md:grid-cols-2  gap-4">

                <div class="row">
                    <div class="col-lg-6 pe-lg-3">
                        <div class="space-y-2 length {{ isset($_POST['to_calculate']) && $_POST['to_calculate'] !== '1'?'hidden':'d-block' }} {{ isset($_POST['from']) && $_POST['from'] === 'cic'?'hidden':'d-block' }}">
                            <label for="length" class="font-s-14 text-blue">{{ $lang['length'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="l_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('l_unit_dropdown')">{{ isset($_POST['l_unit'])?$_POST['l_unit']:'m' }} ▾</label>
                                <input type="text" name="l_unit" value="{{ isset($_POST['l_unit'])?$_POST['l_unit']:'m' }}" id="l_unit" class="hidden">
                                <div id="l_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                                    
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_unit', '{{$name}}')">{{$name}}</p>
                                   @endforeach
                               
                                </div>
                            </div>
                         </div>
                         <div class="space-y-2 width {{ isset($_POST['to_calculate']) && $_POST['to_calculate'] !== '1'?'hidden':'d-block' }} {{ isset($_POST['from']) && $_POST['from'] === 'cic'?'hidden':'d-block' }}">
                            <label for="width" class="font-s-14 text-blue">{{ $lang['width'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="w_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('w_unit_dropdown')">{{ isset($_POST['w_unit'])?$_POST['w_unit']:'m' }} ▾</label>
                                <input type="text" name="w_unit" value="{{ isset($_POST['w_unit'])?$_POST['w_unit']:'m' }}" id="w_unit" class="hidden">
                                <div id="w_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                                    
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', '{{$name}}')">{{$name}}</p>
                                   @endforeach
                               
                                </div>
                            </div>
                         </div>
                         <div class="space-y-2 area {{ isset($_POST['to_calculate']) && $_POST['to_calculate'] === '2'?'d-block':'hidden' }} {{ isset($_POST['from']) && $_POST['from'] === 'cic'?'hidden':'d-block' }}">
                            <label for="area" class="font-s-14 text-blue">{{ $lang['area'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area'])?$_POST['area']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="a_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('a_unit_dropdown')">{{ isset($_POST['a_unit'])?$_POST['a_unit']:'m' }} ▾</label>
                                <input type="text" name="a_unit" value="{{ isset($_POST['a_unit'])?$_POST['a_unit']:'m' }}" id="a_unit" class="hidden">
                                <div id="a_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                                    
                                    @foreach (["m²","yd²","ft²"] as $name)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', '{{$name}}')">{{$name}}</p>
                                   @endforeach
                               
                                </div>
                            </div>
                         </div>
                         <div class="space-y-2 mt-3 depth {{ isset($_POST['to_calculate']) && $_POST['to_calculate'] === '3'?'hidden':'d-block' }}">
                            <label for="depth" class="font-s-14 text-blue">{{ $lang['depth'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="depth" id="depth" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['depth'])?$_POST['depth']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="d_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('d_unit_dropdown')">{{ isset($_POST['d_unit'])?$_POST['d_unit']:'cm' }} ▾</label>
                                <input type="text" name="d_unit" value="{{ isset($_POST['d_unit'])?$_POST['d_unit']:'cm' }}" id="d_unit" class="hidden">
                                <div id="d_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                                    
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', '{{$name}}')">{{$name}}</p>
                                   @endforeach
                               
                                </div>
                            </div>
                         </div>
                         <div class="space-y-2 mt-3  volume {{ isset($_POST['to_calculate']) && $_POST['to_calculate'] === '3'?'d-block':'hidden' }} {{ isset($_POST['from']) && $_POST['from'] === 'cic'?'hidden':'d-block' }}">
                            <label for="volume" class="font-s-14 text-blue">{{ $lang['volume'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="volume" id="volume" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volume'])?$_POST['volume']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="v_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v_unit_dropdown')">{{ isset($_POST['v_unit'])?$_POST['v_unit']:'m²' }} ▾</label>
                                <input type="text" name="v_unit" value="{{ isset($_POST['v_unit'])?$_POST['v_unit']:'m²' }}" id="v_unit" class="hidden">
                                <div id="v_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                                    
                                    @foreach (["m²","yd²","ft²"]  as $name)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', '{{$name}}')">{{$name}}</p>
                                   @endforeach
                               
                                </div>
                            </div>
                         </div>
                         <div class="space-y-2 mt-3 density ">
                            <label for="density" class="font-s-14 text-blue">{{ $lang['den'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="density" id="density" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['density'])?$_POST['density']:'104.88' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="dn_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dn_unit_dropdown')">{{ isset($_POST['dn_unit'])?$_POST['dn_unit']:'lb/ft³' }} ▾</label>
                                <input type="text" name="dn_unit" value="{{ isset($_POST['dn_unit'])?$_POST['dn_unit']:'lb/ft³' }}" id="dn_unit" class="hidden">
                                <div id="dn_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-1 right-0 hidden">
                                    
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dn_unit', 'lb/ft³')">lb/ft³</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dn_unit', 'lb/yd³')">lb/yd³</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dn_unit', 't/yd³')">t/yd³</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dn_unit', 'kg/m³')">kg/m³</p>

                                </div>
                            </div>
                         </div>
                         <div class="space-y-2 mt-3 diameter {{ isset($_POST['from']) && $_POST['from'] === 'cic'?'d-block':'hidden' }} ">
                            <label for="diameter" class="font-s-14 text-blue">{{ $lang['dia'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="diameter" id="diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['diameter'])?$_POST['diameter']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="dia_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dia_unit_dropdown')">{{ isset($_POST['dia_unit'])?$_POST['dia_unit']:'m³' }} ▾</label>
                                <input type="text" name="dia_unit" value="{{ isset($_POST['dia_unit'])?$_POST['dia_unit']:'m³' }}" id="dia_unit" class="hidden">
                                <div id="dia_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dia_unit', '{{$name}}')">{{$name}}</p>
                                   @endforeach

                                </div>
                            </div>
                         </div>
                         <div class="space-y-2 mt-3 cost ">
                            <label for="price" class="font-s-14 text-blue">{{ $lang['price'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price'])?$_POST['price']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="p_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('p_unit_dropdown')">{{ isset($_POST['p_unit'])?$_POST['p_unit']:$currancy.' '.'lbs'  }} ▾</label>
                                <input type="text" name="p_unit" value="{{ isset($_POST['p_unit'])?$_POST['p_unit']:$currancy.' '.'lbs'  }}" id="p_unit" class="hidden">
                                <div id="p_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                    <input type="hidden" name="currancy" value="{{$currancy}}">
                                    @foreach (["$currancy kg","$currancy t","$currancy lbs","$currancy g"] as $name)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', '{{$name}}')">{{$name}}</p>
                                   @endforeach

                                </div>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-full pl-3 flex items-center">
                        <img src="{{ asset('images/react.webp') }}" alt="Ractangular" class="setImage max-w-full" width="280px" height="auto">
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
                            <div class="col-lg-8 font-s-18">
                                <table class="w-100">
                                    <tr>
                                        <td width="50%" class="border-b py-2"><strong>{{ $lang['vol_n']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['volume']/27,3)}} cu³ ({{$detail['volume']}} ft³)</td>
                                    </tr>
                                    <tr class="grey lighten-5 border_1px">
                                        <td class="border-b py-2"><strong>{{ $lang['we_n']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['weight']/2000,3)}} tons ({{$detail['weight']}} lbs)</td>
                                    </tr>
                                    @if(isset($detail['price']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['cost']}} :</strong></td>
                                            <td class="border-b py-2">{{$currancy.' '.$detail['price']}}</td>
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
        document.getElementById('to_calculate').addEventListener('change',function(){
            var value = this.value;
            var length = document.querySelector('.length');
            var width = document.querySelector('.width');
            var density= document.querySelector('.density');
            var depth= document.querySelector('.depth');
            var area = document.querySelector('.area');
            var volume= document.querySelector('.volume');
            var cost= document.querySelector('.cost');
            if (value === "1") {
                length.style.display = "block";
                width.style.display = "block";
                density.style.display = "block";
                depth.style.display = "block";
                cost.style.display = "block";
                volume.style.display = "none";
                area.style.display = "none";
            } else if (value === "2") {
                depth.style.display = "block";
                length.style.display = "none";
                width.style.display = "none";
                density.style.display = "block";
                cost.style.display = "block";
                area.style.display = "block";
                volume.style.display = "none";
            } else if (value === "3") {
                depth.style.display = "none";
                length.style.display = "none";
                width.style.display = "none";
                density.style.display = "block";
                cost.style.display = "block";
                area.style.display = "none";
                volume.style.display = "block";
            }
        });
        var length = document.querySelector('.length');
        var width = document.querySelector('.width');
        var density= document.querySelector('.density');
        var depth= document.querySelector('.depth');
        var area = document.querySelector('.area');
        var volume= document.querySelector('.volume');
        var setImage= document.querySelector('.setImage');
        var diameter= document.querySelector('.diameter');
        var cost= document.querySelector('.cost');
        var options = document.querySelector('.to_calculate');
        document.getElementById('circle').addEventListener('click', function() {
            length.style.display = "none";
            width.style.display = "none";
            area.style.display = "none";
            volume.style.display = "none";
            options.style.display = "none";
            depth.style.display = "block";
            density.style.display = "block";
            cost.style.display = "block";
            diameter.style.display = "block";
            setImage.setAttribute("src","{{asset('images/circle.webp')}}")
        });

        @if(isset($_POST['from']) && $_POST['from'] === 'cic')
            setImage.setAttribute("src","{{asset('images/circle.webp')}}")
        @else
            setImage.setAttribute("src","{{asset('images/react.webp')}}")
        @endif

        document.getElementById('rec').addEventListener('click', function() {
            length.style.display = "block";
            width.style.display = "block";
            area.style.display = "none";
            volume.style.display = "none";
            depth.style.display = "block";
            density.style.display = "block";
            options.style.display = "block";
            cost.style.display = "block";
            diameter.style.display = "none";
            setImage.setAttribute("src","{{asset('images/react.webp')}}")

        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>