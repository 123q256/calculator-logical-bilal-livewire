<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            
                <div class="col-span-6">
                    <div class="grid grid-cols-12  gap-4">
                        <div class="col-span-12">
                            <label for="st_type" class="label">{{ $lang['3'] }}</label>
                            <div class="w-100 py-2"> 
                                <select name="st_type" id="st_type" class="input">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                            {{ $arr2[$index] }}
                                        </option>
                                    @php
                                        }}
                                        $name = [$lang['1']." (7715 kg/m³)",$lang['2']." (7750 kg/m³)",$lang['3']." (7820 kg/m³)",$lang['4']." (7830 kg/m³)",$lang['5']." (7840 kg/m³)",$lang['6']." (7850 kg/m³)",$lang['7']." (7860 kg/m³)",$lang['8']." (7870 kg/m³)",$lang['9']." (8030 kg/m³)"];
                                        $val = ["7715","7750","7820","7830","7840","7850","7860","7870","8030"];
                                        optionsList($val,$name,isset(request()->st_type)?request()->st_type:'7715');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="st_shape" class="label">{{ $lang['11'] }}</label>
                            <div class="w-100 py-2"> 
                                <select name="st_shape" id="st_shape" class="input">
                                    @php
                                        $name=[$lang['12'],$lang['13'],$lang['14'],$lang['15']];
                                        $val = ["1","2","3","4"];
                                        optionsList($val,$name,isset(request()->st_shape)?request()->st_shape:'1');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 length">
                            <label for="length" class="label">{{ $lang['16'] }} (l):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }} ▾</label>
                                <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }}" id="length_unit" class="hidden">
                                <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                                @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 width" >
                            <label for="width" class="label">{{ $lang['17'] }} (w):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }} ▾</label>
                                <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }}" id="width_unit" class="hidden">
                                <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                                @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('width_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 thickness">
                            <label for="thickness" class="label">{{ $lang['18'] }} (t):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="thickness" id="thickness" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['thickness'])?$_POST['thickness']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="thickness_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('thickness_unit_dropdown')">{{ isset($_POST['thickness_unit'])?$_POST['thickness_unit']:'cm' }} ▾</label>
                                <input type="text" name="thickness_unit" value="{{ isset($_POST['thickness_unit'])?$_POST['thickness_unit']:'cm' }}" id="thickness_unit" class="hidden">
                                <div id="thickness_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="thickness_unit">
                                @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('thickness_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 side hidden">
                            <label for="side" class="label">{{ $lang['19'] }} (s):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="side" id="side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['side'])?$_POST['side']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="side_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('side_unit_dropdown')">{{ isset($_POST['side_unit'])?$_POST['side_unit']:'cm' }} ▾</label>
                                <input type="text" name="side_unit" value="{{ isset($_POST['side_unit'])?$_POST['side_unit']:'cm' }}" id="side_unit" class="hidden">
                                <div id="side_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="side_unit">
                                @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('side_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 diameter hidden">
                            <label for="diameter" class="label">{{ $lang['20'] }} (d):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="diameter" id="diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['diameter'])?$_POST['diameter']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="diameter_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('diameter_unit_dropdown')">{{ isset($_POST['diameter_unit'])?$_POST['diameter_unit']:'cm' }} ▾</label>
                                <input type="text" name="diameter_unit" value="{{ isset($_POST['diameter_unit'])?$_POST['diameter_unit']:'cm' }}" id="diameter_unit" class="hidden">
                                <div id="diameter_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="diameter_unit">
                                @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('diameter_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-span-12 area hidden">
                            <label for="area" class="label">{{ $lang['21'] }} (a):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area'])?$_POST['area']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'cm²' }} ▾</label>
                                <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'cm²' }}" id="area_unit" class="hidden">
                                <div id="area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_unit">
                                    @foreach (["cm²","mm²","m²","in²","ft²","yd²"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('area_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <div class="grid grid-cols-12  gap-4">
                    <div class="col-span-12">
                        <label for="quantity" class="label">{{ $lang['22'] }}:</label>
                        <div class="w-100 py-2"> 
                            <input type="number" step="any" name="quantity" id="quantity" class="input" aria-label="input"  value="{{ isset(request()->quantity)?request()->quantity:'5' }}" />
                        </div>
                    </div>
                    </div>
                    <div class="col-span-12">&nbsp;</div>
                    <div class="col-span-12">&nbsp;</div>
                    <div class="col-span-12 flex items-center">
                    <img src="{{asset('images/k12.webp')}}" alt="Shape Image" class="max-width change_img mt-lg-5" width="500px" height="150px">
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
                    <div class="row my-2">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18">
                            <table class="w-full">
                                <tr>
                                    <td width="60%" class="border-b py-2"><strong>{{$lang['21']}} :</strong></td>
                                    <td class="border-b py-2">{{round($detail['area'],2)}} <span class="font-s-14"> (cm<sup>2</sup>)</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['23']}} :</strong></td>
                                    <td class="border-b py-2">{{round($detail['volume'],2)}}<span class="font-s-14"> (cm<sup>3</sup>)</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['24']}} :</strong></td>
                                    <td class="border-b py-2">{{$detail['weight']}}<span class="font-s-14"> (g)</span></td>
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
         var length = document.querySelector('.length');
        var width = document.querySelector('.width');
        var side = document.querySelector('.side');
        var diameter = document.querySelector('.diameter');
        var area = document.querySelector('.area');
        var change_img = document.querySelector('.change_img');
        @if(isset($detail))
            var concrete = document.getElementById('st_shape').value;
            if(concrete == "1"){
                length.style.display = "block";
                width.style.display = "block";
                side.style.display = "none";
                diameter.style.display = "none";
                area.style.display = "none";
                change_img.setAttribute("src", "{{asset('images/k12.webp')}}");
            }else if(concrete == "2"){
                length.style.display = "none";
                width.style.display = "none";
                side.style.display = "block";
                diameter.style.display = "none";
                area.style.display = "none";
                change_img.setAttribute("src", "{{asset('images/k22.webp')}}");
            }else if(concrete == "3"){
                length.style.display = "none";
                width.style.display = "none";
                side.style.display = "none";
                diameter.style.display = "block";
                area.style.display = "none";
                change_img.setAttribute("src", "{{asset('images/k32.webp')}}");
            }else if(concrete == "4"){
                length.style.display = "none";
                width.style.display = "none";
                side.style.display = "none";
                diameter.style.display = "none";
                area.style.display = "block";
                change_img.setAttribute("src", "{{asset('images/k42.webp')}}");
            }
        @endif
       
        document.getElementById('st_shape').addEventListener('change',function(){
            var concrete = this.value;
            if(concrete == "1"){
                length.style.display = "block";
                width.style.display = "block";
                side.style.display = "none";
                diameter.style.display = "none";
                area.style.display = "none";
                change_img.setAttribute("src", "{{asset('images/k12.webp')}}");
            }else if(concrete == "2"){
                length.style.display = "none";
                width.style.display = "none";
                side.style.display = "block";
                diameter.style.display = "none";
                area.style.display = "none";
                change_img.setAttribute("src", "{{asset('images/k22.webp')}}");
            }else if(concrete == "3"){
                length.style.display = "none";
                width.style.display = "none";
                side.style.display = "none";
                diameter.style.display = "block";
                area.style.display = "none";
                change_img.setAttribute("src", "{{asset('images/k32.webp')}}");
            }else if(concrete == "4"){
                length.style.display = "none";
                width.style.display = "none";
                side.style.display = "none";
                diameter.style.display = "none";
                area.style.display = "block";
                change_img.setAttribute("src", "{{asset('images/k42.webp')}}");
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>