<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6 div_center">
                    <label for="fluid_substance" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" name="fluid_substance" id="fluid_substance">
                            <option selected value="custom">{{$lang[2]}}</option>
                            <option value="1.225|0.0000181|0.000014776" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='1.225|0.0000181|0.000014776'?'selected':''}}>{{$lang[3]}} (15 °C)</option>
                            <option value="1.184|0.0000186|0.00001571" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='1.184|0.0000186|0.00001571'?'selected':''}}>{{$lang[3]}} (25 °C)</option>              
                            <option value="999.7|0.001308|0.0000013084" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='999.7|0.001308|0.0000013084'?'selected':''}}>{{$lang[4]}} (10 °C)</option>             
                            <option value="988|0.0005471|0.0000005537" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='988|0.0005471|0.0000005537'?'selected':''}}>{{$lang[4]}} (50 °C)</option>              
                            <option value="965.3|0.000315|0.0000003263" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='965.3|0.000315|0.0000003263'?'selected':''}}>{{$lang[4]}} (90 °C)</option>             
                            <option value="1060|0.0035|0.000003302" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='1060|0.0035|0.000003302'?'selected':''}}>{{$lang[5]}} (37 °C)</option>             
                            <option value="1450|0.006|0.000004138" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='1450|0.006|0.000004138'?'selected':''}}>{{$lang[6]}}</option>              
                            <option value="1082|0.25|0.00023104" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='1082|0.25|0.00023104'?'selected':''}}>{{$lang[7]}}</option>            
                            <option value="791|0.000306|0.00000038685" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='791|0.000306|0.00000038685'?'selected':''}}>{{$lang[8]}} (25 °C)</option>              
                            <option value="789|0.001074|0.0000013612" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='789|0.001074|0.0000013612'?'selected':''}}>{{$lang[9]}} (25 °C)</option>             
                            <option value="13600|0.001526|0.0000001122" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='13600|0.001526|0.0000001122'?'selected':''}}>{{$lang[10]}} (25 °C)</option>              
                            <option value="807|0.000158|0.0000001958" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='807|0.000158|0.0000001958'?'selected':''}}>{{$lang[11]}} ( -196 °C)</option>   
                            <option value="920|0.081|0.00008804" {{ isset($_POST['fluid_substance']) && $_POST['fluid_substance']=='920|0.081|0.00008804'?'selected':''}}>{{$lang[12]}} (25 °C)</option> 
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fluid_density" class="font-s-14 text-blue">{{ $lang['13'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="fluid_density" id="fluid_density" step="any"  class="border fluid_density border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fluid_density']) ? $_POST['fluid_density'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="fluid_density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fluid_density_unit_dropdown')">{{ isset($_POST['fluid_density_unit'])?$_POST['fluid_density_unit']:'kg/m³' }} ▾</label>
                        <input type="text" name="fluid_density_unit" value="{{ isset($_POST['fluid_density_unit'])?$_POST['fluid_density_unit']:'kg/m³' }}" id="fluid_density_unit" class="hidden">
                        <div id="fluid_density_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fluid_density_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_density_unit', 'kg/m³')">kg/m³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_density_unit', 'kg/dm³')">kg/dm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_density_unit', 't/m³')">t/m³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_density_unit', 'g/cm³')">g/cm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_density_unit', 'oz/cu in')">oz/cu in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_density_unit', 'lb/cu in')">lb/cu in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_density_unit', 'lb/cu ft')">lb/cu ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_density_unit', 'lb/cu yd')">lb/cu yd</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="dynamic_velocity" class="font-s-14 text-blue">{{ $lang['14'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="dynamic_velocity" id="dynamic_velocity" step="any"  class="border dynamic_velocity border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dynamic_velocity']) ? $_POST['dynamic_velocity'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dynamic_velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dynamic_velocity_unit_dropdown')">{{ isset($_POST['dynamic_velocity_unit'])?$_POST['dynamic_velocity_unit']:'kg-m-s' }} ▾</label>
                        <input type="text" name="dynamic_velocity_unit" value="{{ isset($_POST['dynamic_velocity_unit'])?$_POST['dynamic_velocity_unit']:'kg-m-s' }}" id="dynamic_velocity_unit" class="hidden">
                        <div id="dynamic_velocity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dynamic_velocity_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_velocity_unit', 'kg-m-s')">kg-m-s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_velocity_unit', 'p')">p</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_velocity_unit', 'cp')">cp</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_velocity_unit', 'mpas')">mpas</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_velocity_unit', 'pas')">mPa.s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_velocity_unit', 'slug')">slug(ft.s)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_velocity_unit', 'lbfs-ft2')">lbf⋅s/ft²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_velocity_unit', 'lb-fts')">lb/(ft⋅s)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_velocity_unit', 'dynas-cm2')">dyn⋅s/cm²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_velocity_unit', 'g-cms')">g/(cm⋅s)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_velocity_unit', 'reyn')">reyn</p>

                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fluid_velocity" class="font-s-14 text-blue">{{ $lang['15'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="fluid_velocity" id="fluid_velocity" step="any"  class="border fluid_velocity border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fluid_velocity']) ? $_POST['fluid_velocity'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="fluid_velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fluid_velocity_unit_dropdown')">{{ isset($_POST['fluid_velocity_unit'])?$_POST['fluid_velocity_unit']:'m-s' }} ▾</label>
                        <input type="text" name="fluid_velocity_unit" value="{{ isset($_POST['fluid_velocity_unit'])?$_POST['fluid_velocity_unit']:'m-s' }}" id="fluid_velocity_unit" class="hidden">
                        <div id="fluid_velocity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fluid_velocity_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_velocity_unit', 'm-s')">m-s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_velocity_unit', 'km-h')">km-h</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_velocity_unit', 'ft/s')">ft/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_velocity_unit', 'mi-h')">mi-h</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="linear_dimension" class="font-s-14 text-blue">{{ $lang['16'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="linear_dimension" id="linear_dimension" step="any"  class="border linear_dimension border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['linear_dimension']) ? $_POST['linear_dimension'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="linear_dimension_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('linear_dimension_unit_dropdown')">{{ isset($_POST['linear_dimension_unit'])?$_POST['linear_dimension_unit']:'m-s' }} ▾</label>
                        <input type="text" name="linear_dimension_unit" value="{{ isset($_POST['linear_dimension_unit'])?$_POST['linear_dimension_unit']:'m-s' }}" id="linear_dimension_unit" class="hidden">
                        <div id="linear_dimension_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="linear_dimension_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_dimension_unit', 'mm')">mm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_dimension_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_dimension_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_dimension_unit', 'km')">km</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_dimension_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_dimension_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_dimension_unit', 'yd')">yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_dimension_unit', 'mi')">mi</p>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]   mt-2">
                            <table class="w-full font-s-18">
                            <tr>
                                <td class="py-2 border-b" width="40%"><strong>{{ $lang[17] }} </strong></td>
                                <td class="py-2 border-b"> {{ $detail['kinematic'] }} m²/s</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="40%"><strong>{{ $lang[18] }} </strong></td>
                                <td class="py-2 border-b"> {{ number_format($detail['reynolds']) }}
                                    @if($detail['reynolds'] < '2100')
                                    {{$lang[19]}}
                                    @elseif($detail['reynolds'] > '2100' && $detail['reynolds'] < '3000')
                                        {{$lang[20]}}
                                    @elseif($detail['reynolds'] > '3000') 
                                        {{$lang[21]}}
                                    @endif
                                </td>
                            </tr>
                            </table>
                        
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
@endisset
</form>
@push('calculatorJS')
<script>
    @if(isset($error))
        var value = "{{$_POST['fluid_substance']}}";

        if (value == "custom") {
                document.querySelector('.fluid_density').readOnly = false;
                document.querySelector('.dynamic_velocity').readOnly = false;
            } else {
                var result = value.split('|');
                var density = result[0];
                var dynamic = result[1];
                document.querySelector('.fluid_density').value = density;
                document.querySelector('.dynamic_velocity').value = dynamic;
                document.querySelector('.fluid_density').readOnly = true;
                document.querySelector('.dynamic_velocity').readOnly = true;
            }

    @endif
    @if(isset($detail))
        var value = "{{$_POST['fluid_substance']}}";

        if (value == "custom") {
                document.querySelector('.fluid_density').readOnly = false;
                document.querySelector('.dynamic_velocity').readOnly = false;
            } else {
                var result = value.split('|');
                var density = result[0];
                var dynamic = result[1];
                document.querySelector('.fluid_density').value = density;
                document.querySelector('.dynamic_velocity').value = dynamic;
                document.querySelector('.fluid_density').readOnly = true;
                document.querySelector('.dynamic_velocity').readOnly = true;
            }

    @endif
    document.addEventListener('DOMContentLoaded', function() {
        'use strict';
        
        document.getElementById('fluid_substance').addEventListener('change', function() {
            var value = this.value;
            
            if (value == "custom") {
                document.querySelector('.fluid_density').readOnly = false;
                document.querySelector('.dynamic_velocity').readOnly = false;
            } else {
                var result = value.split('|');
                var density = result[0];
                var dynamic = result[1];
                document.querySelector('.fluid_density').value = density;
                document.querySelector('.dynamic_velocity').value = dynamic;
                document.querySelector('.fluid_density').readOnly = true;
                document.querySelector('.dynamic_velocity').readOnly = true;
            }
        });
    });
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>