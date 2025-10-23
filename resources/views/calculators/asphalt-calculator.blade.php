<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="cal" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select name="cal" id="cal" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'],$lang['3'],$lang['4'],$lang['5'],$lang['6']];
                                $val = ["lwt","at","vad","csn","dtbr"];
                                optionsList($val,$name,isset($_POST['cal'])?$_POST['cal']:'lwt');
                            @endphp
                        </select>
                    </div>
                </div>

                  <div class="col-span-12 md:col-span-6 lg:col-span-6 length {{ isset($_POST['cal']) && $_POST['cal'] !== 'lwt'?'d-none':'d-block' }}">
                    <label for="length" class="label">{{ $lang['7'] }}:</label>
                    <div class="relative w-full py-2 ">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }} ▾</label>
                        <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }}" id="length_unit" class="hidden">
                        <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                            @foreach (["cm","m","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_unit', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 width {{ isset($_POST['cal']) && $_POST['cal'] !== 'lwt'?'d-none':'d-block' }}">
                    <label for="width" class="label">{{ $lang['8'] }}:</label>
                    <div class="relative w-full py-2 ">
                        <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }} ▾</label>
                        <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }}" id="width_unit" class="hidden">
                        <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                            @foreach (["cm","m","in","ft","yd","mi"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('width_unit', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 area {{ isset($_POST['cal']) && ($_POST['cal'] !== 'lwt' && $_POST['cal'] !== 'vad')?'d-block':'d-none' }}">
                    <label for="area" class="label">{{ $lang['9'] }}:</label>
                    <div class="relative w-full py-2 ">
                        <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area'])?$_POST['area']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'m²' }} ▾</label>
                        <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'m²' }}" id="area_unit" class="hidden">
                        <div id="area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_unit">
                            @foreach (["m²","km²","in²","ft²"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('area_unit', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 depth {{ isset($_POST['cal']) && $_POST['cal'] === 'vad'?'d-none':'d-block' }}">
                    <label for="depth" class="label">{{ $lang['10'] }}:</label>
                    <div class="relative w-full py-2 ">
                        <input type="number" name="depth" id="depth" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['depth'])?$_POST['depth']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="depth_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('depth_unit_dropdown')">{{ isset($_POST['depth_unit'])?$_POST['depth_unit']:'cm' }} ▾</label>
                        <input type="text" name="depth_unit" value="{{ isset($_POST['depth_unit'])?$_POST['depth_unit']:'cm' }}" id="depth_unit" class="hidden">
                        <div id="depth_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="depth_unit">
                            @foreach (["cm","m","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('depth_unit', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 volume {{ isset($_POST['cal']) && $_POST['cal'] === 'vad'?'d-block':'d-none' }}">
                    <label for="volume" class="label">{{ $lang['11'] }}:</label>
                    <div class="relative w-full py-2 ">
                        <input type="number" name="volume" id="volume" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volume'])?$_POST['volume']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="volume_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('volume_unit_dropdown')">{{ isset($_POST['volume_unit'])?$_POST['volume_unit']:'m³' }} ▾</label>
                        <input type="text" name="volume_unit" value="{{ isset($_POST['volume_unit'])?$_POST['volume_unit']:'m³' }}" id="volume_unit" class="hidden">
                        <div id="volume_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="volume_unit">
                            @foreach (["m³","cu ft","US Gal","UK Gal"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('volume_unit', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 density {{ isset($_POST['cal']) && ($_POST['cal'] !== 'lwt' && $_POST['cal'] !== 'at'  && $_POST['cal'] !== 'vad' ) ? 'd-none':'d-block' }}">
                    <label for="density" class="label">{{ $lang['12'] }}:</label>
                    <div class="relative w-full py-2 ">
                        <input type="number" name="density" id="density" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['density'])?$_POST['density']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('density_unit_dropdown')">{{ isset($_POST['density_unit'])?$_POST['density_unit']:'kg/m³' }} ▾</label>
                        <input type="text" name="density_unit" value="{{ isset($_POST['density_unit'])?$_POST['density_unit']:'kg/m³' }}" id="density_unit" class="hidden">
                        <div id="density_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="density_unit">
                            @foreach (["kg/m³","lb/cu ft"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('density_unit', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
             
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 cs_depth {{ isset($_POST['cal']) && $_POST['cal'] === 'csn'?'d-block':'d-none' }}">
                    <label for="cs_depth" class="label">{{ $lang['13'] }}:</label>
                    <div class="relative w-full py-2 ">
                        <input type="number" name="cs_depth" id="cs_depth" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cs_depth'])?$_POST['cs_depth']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="cs_depth_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cs_depth_unit_dropdown')">{{ isset($_POST['cs_depth_unit'])?$_POST['cs_depth_unit']:'cm' }} ▾</label>
                        <input type="text" name="cs_depth_unit" value="{{ isset($_POST['cs_depth_unit'])?$_POST['cs_depth_unit']:'cm' }}" id="cs_depth_unit" class="hidden">
                        <div id="cs_depth_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cs_depth_unit">
                            @foreach (["cm","m","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('cs_depth_unit', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 depth_dr {{ isset($_POST['cal']) && $_POST['cal'] === 'dtbr'?'d-block':'d-none' }}">
                    <label for="depth_dr" class="label">{{ $lang['14'] }}:</label>
                    <div class="relative w-full py-2 ">
                        <input type="number" name="depth_dr" id="depth_dr" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['depth_dr'])?$_POST['depth_dr']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="depth_dr_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('depth_dr_unit_dropdown')">{{ isset($_POST['depth_dr_unit'])?$_POST['depth_dr_unit']:'cm' }} ▾</label>
                        <input type="text" name="depth_dr_unit" value="{{ isset($_POST['depth_dr_unit'])?$_POST['depth_dr_unit']:'cm' }}" id="depth_dr_unit" class="hidden">
                        <div id="depth_dr_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="depth_dr_unit">
                            @foreach (["cm","m","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('depth_dr_unit', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6 cost {{ isset($_POST['cal']) && ($_POST['cal'] !== 'lwt' && $_POST['cal'] !== 'at'  && $_POST['cal'] !== 'vad' ) ? 'd-none':'d-block' }}">
                    <label for="cost" class="label">{{ $lang['15'] }}:</label>
                    <div class="relative w-full py-2 ">
                        <input type="number" name="cost" id="cost" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cost'])?$_POST['cost']:'15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="cost_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cost_unit_dropdown')">{{ isset($_POST['cost_unit'])?$_POST['cost_unit']:'cm' }} ▾</label>
                        <input type="text" name="cost_unit" value="{{ isset($_POST['cost_unit'])?$_POST['cost_unit']:'cm' }}" id="cost_unit" class="hidden">
                        <div id="cost_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cost_unit">
                            @foreach (["$currancy kg","$currancy ton","$currancy lb","$currancy us_ton","$currancy long_ton"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('cost_unit', '{{ $name }}')"> {{ $name }}</p>
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
                        @php
                            $cal=trim(request()->cal);
                        @endphp
                        <div class="w-ful my-2">
                            <div class="w-full  md:w-[60%] lg:w-[60%] text-[18px]">
                                <table class="w-full">
                                    <tr>
                                        <td width="60%" class="border-b py-2"><strong>{{$lang['16']}} :</strong></p>
                                        <td class="border-b py-2">{{$detail['asphalt'] }} tons</p>
                                    </tr>
                                    @if($cal==='lwt')
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['9']}} :</strong></td>
                                            <td class="border-b py-2">{{$detail['area']}} m²</td>
                                        </td>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['11']}} :</strong></td>
                                            <td class="border-b py-2">{{$detail['volume']}} m³</td>
                                        </tr>
                                        @if(isset($detail['total_cost']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['17']}} :</strong></td>
                                                <td class="border-b py-2">{{$currancy.' '.$detail['total_cost']}}</td>
                                            </tr>
                                        @endif
                                    @elseif($cal==='at')
                                        @if(isset($detail['total_cost']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['11']}} :</strong></td>
                                                <td class="border-b py-2">{{$detail['volume']}} m³</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['17']}} :</strong></td>
                                                <td class="border-b py-2">{{$currancy.' '.$detail['total_cost']}}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['11']}} :</strong></td>
                                                <td class="border-b py-2">{{$detail['volume']}} m³</td>
                                            </tr>
                                        @endif
                                    @elseif($cal==='vad')
                                        @if(isset($detail['total_cost']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['17']}} :</strong></td>
                                                <td class="border-b py-2">{{$currancy.' '.$detail['total_cost']}}</td>
                                            </tr>
                                        @endif
                                    @elseif($cal==='csn')
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['18']}} :</strong></td>
                                            <td class="border-b py-2">{{$detail['stone']}} tons</td>
                                        </tr>
                                    @elseif($cal==='dtbr')
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['19']}} :</strong></td>
                                            <td class="border-b py-2">{{$detail['dirt']}} cu yd</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="2" class="pt-3 pb-2">
                                            <strong>{{$lang['20']}} </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['16']}} :</td>
                                        <td class='border-b py-2'>{{$detail['kg']}} kilograms</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['16']}} :</td>
                                        <td class='border-b py-2'>{{$detail['lb']}} pounds</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['16']}} :</td>
                                        <td class='border-b py-2'>{{$detail['us_ton']}} US short tons</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['16']}} :</td>
                                        <td class='border-b py-2'>{{$detail['long_ton']}} imperial tons</td>
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
        document.getElementById('cal').addEventListener('change',function(){
            var value = this.value;
            var length = document.querySelector('.length');
            var width = document.querySelector('.width');
            var density= document.querySelector('.density');
            var depth = document.querySelector('.depth');
            var area = document.querySelector('.area');
            var depth_dr = document.querySelector('.depth_dr');
            var cs_depth= document.querySelector('.cs_depth');
            var volume= document.querySelector('.volume');
            var cost= document.querySelector('.cost');
            if (value === "lwt") {
                length.style.display = "block";
                width.style.display = "block";
                density.style.display = "block";
                depth.style.display = "block";
                cost.style.display = "block";
                volume.style.display = "none";
                depth_dr.style.display = "none";
                area.style.display = "none";
                cs_depth.style.display = "none";
            } else if (value === "at") {
                length.style.display = "none";
                width.style.display = "none";
                density.style.display = "block";
                depth.style.display = "block";
                cost.style.display = "block";
                area.style.display = "block";
                volume.style.display = "none";
                depth_dr.style.display = "none";
                cs_depth.style.display = "none";
            } else if (value === "vad") {
                length.style.display = "none";
                width.style.display = "none";
                density.style.display = "block";
                depth.style.display = "none";
                cost.style.display = "block";
                area.style.display = "none";
                volume.style.display = "block";
                depth_dr.style.display = "none";
                cs_depth.style.display = "none";
            }else if (value === "csn") {
                length.style.display = "none";
                width.style.display = "none";
                density.style.display = "none";
                depth.style.display = "block";
                cost.style.display = "none";
                area.style.display = "block";
                volume.style.display = "none";
                depth_dr.style.display = "none";
                cs_depth.style.display = "block";
            } else if (value === "dtbr") {
                length.style.display = "none";
                width.style.display = "none";
                density.style.display = "none";
                depth.style.display = "block";
                cost.style.display = "none";
                area.style.display = "block";
                volume.style.display = "none";
                depth_dr.style.display = "block";
                cs_depth.style.display = "none";
            }
        })
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>