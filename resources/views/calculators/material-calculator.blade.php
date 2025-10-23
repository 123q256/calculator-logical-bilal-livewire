<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                
                <div class="col-span-12">
                    <label for="operation" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="w-100 py-2"> 
                        <select name="operations" id="operation" class="input">
                            <option value="1" {{ isset($_POST['operation']) && $_POST['operation'] == '1' ? 'selected' : '' }}>{{ $lang[2]}}</option>
                            <option value="2" {{ isset($_POST['operation']) && $_POST['operation'] == '2' ? 'selected' : '' }}>{{ $lang[3]}}</option>
                            <option value="3" {{ isset($_POST['operation']) && $_POST['operation'] == '3' ? 'selected' : '' }}>{{ $lang[4]}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="div1">
                    <label for="first" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first'])?$_POST['first']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'cm' }} ▾</label>
                        <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'cm' }}" id="units1" class="hidden">
                        <div id="units1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_units">
                            @foreach (["in","ft","cm","m","yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units1', '{{ $name }}')"> {{ $name }}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6" id="div2">
                    <label for="second" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second'])?$_POST['second']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units2_dropdown')">{{ isset($_POST['units2'])?$_POST['units2']:'cm' }} ▾</label>
                        <input type="text" name="units2" value="{{ isset($_POST['units2'])?$_POST['units2']:'cm' }}" id="units2" class="hidden">
                        <div id="units2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_units">
                            @foreach (["in","ft","cm","m","yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units2', '{{ $name }}')"> {{ $name }}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="div5">
                    <label for="ex_drop" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                    <div class="w-100 py-2"> 
                        <select name="ex_drop" id="ex_drop" class="input">
                            <option value="105" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '105' ? 'selected' : '' }}>{{ $lang[10]." - 105 lb/ft³"}}</option>
                            <option value="150" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '150' ? 'selected' : '' }}>{{ $lang[11]." - 150 lb/ft³"}}</option>
                            <option value="160" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '160' ? 'selected' : '' }}>{{ $lang[12]." - 160 lb/ft³"}}</option>
                            <option value="145" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '145' ? 'selected' : '' }}>{{ $lang[13]." - 145 lb/ft³"}}</option>
                            <option value="168" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '168' ? 'selected' : '' }}>{{ $lang[14]." - 168 lb/ft³"}}</option>
                            <option value="160" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '160' ? 'selected' : '' }}>{{ $lang[15]." - 160 lb/ft³"}}</option>
                            <option value="168" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '168' ? 'selected' : '' }}>{{ $lang[16]." - 168 lb/ft³"}}</option>
                            <option value="188" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '188' ? 'selected' : '' }}>{{ $lang[17]." - 188 lb/ft³"}}</option>
                            <option value="100" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '100' ? 'selected' : '' }}>{{ $lang[18]." - 100 lb/ft³"}}</option>
                            <option value="100" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '100' ? 'selected' : '' }}>{{ $lang[19]." - 100 lb/ft³"}}</option>
                            <option value="168" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '168' ? 'selected' : '' }}>{{ $lang[16]." - 168 lb/ft³"}}</option>
                            <option value="188" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '188' ? 'selected' : '' }}>{{ $lang[17]." - 188 lb/ft³"}}</option>
                            <option value="100" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '100' ? 'selected' : '' }}>{{ $lang[18]." - 100 lb/ft³"}}</option>
                            <option value="100" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '100' ? 'selected' : '' }}>{{ $lang[19]." - 100 lb/ft³"}}</option>
                            <option value="110" {{ isset($_POST['ex_drop']) && $_POST['ex_drop'] == '110' ? 'selected' : '' }}>{{ $lang[20]." - 110 lb/ft³"}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="div3">
                    <label for="third" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third'])?$_POST['third']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units3_dropdown')">{{ isset($_POST['units3'])?$_POST['units3']:'ft' }} ▾</label>
                        <input type="text" name="units3" value="{{ isset($_POST['units3'])?$_POST['units3']:'ft' }}" id="units3" class="hidden">
                        <div id="units3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_units">
                            @foreach (["in","ft","cm","m","yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units3', '{{ $name }}')"> {{ $name }}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6" id="div4">
                    <label for="four" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="four" id="four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['four'])?$_POST['four']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units4_dropdown')">{{ isset($_POST['units4'])?$_POST['units4']:'ft' }} ▾</label>
                        <input type="text" name="units4" value="{{ isset($_POST['units4'])?$_POST['units4']:'ft' }}" id="units4" class="hidden">
                        <div id="units4_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_units">
                            @foreach (["in","ft","cm","m","yd"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units4', '{{ $name }}')"> {{ $name }}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6" id="div6">
                    <label for="five" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="five" id="five" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['five'])?$_POST['five']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units5" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units5_dropdown')">{{ isset($_POST['units5'])?$_POST['units5']:'in³' }} ▾</label>
                        <input type="text" name="units5" value="{{ isset($_POST['units5'])?$_POST['units5']:'in³' }}" id="units5" class="hidden">
                        <div id="units5_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_units">
                            @foreach (["in³","ft³","yd³","cm³","m³"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units5', '{{ $name }}')"> {{ $name }}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6" id="div7">
                    <label for="six" class="font-s-14 text-blue">{{ $lang['21'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="six" id="six" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['six'])?$_POST['six']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units6" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units6_dropdown')">{{ isset($_POST['units6'])?$_POST['units6']:$currancy.' '.'lb' }} ▾</label>
                        <input type="text" name="units6" value="{{ isset($_POST['units6'])?$_POST['units6']:$currancy.' '.'lb' }}" id="units6" class="hidden">
                        <div id="units6_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_units">
                            @foreach (["lb","t","long t","kg"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units6', '{{$currancy.' '.$item}}')"> {{$currancy.' '.$item}}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6" id="div8">
                    <label for="seven" class="font-s-14 text-blue">{{ $lang['22'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="seven" id="seven" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['seven'])?$_POST['seven']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units7" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units7_dropdown')">{{ isset($_POST['units7'])?$_POST['units7']:$currancy.' '.'in³' }} ▾</label>
                        <input type="hidden" name="currancy" value="{{$currancy}}">
                        <input type="text" name="units7" value="{{ isset($_POST['units7'])?$_POST['units7']:$currancy.' '.'in³' }}" id="units7" class="hidden">
                        <div id="units7_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_units">
                            @foreach (["in³","ft³","yd³","cm³","m³"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('units7', '{{$currancy.' '.$item}}')"> {{$currancy.' '.$item}}</p>
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
                        <div class="row mt-1">
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                 <table class="text-[18px] w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>{{ $lang[27] }} :</strong></td>
                                            <td class="border-b py-2"><?= round($detail['weight'] / 2000,4)?><span class="font_size18 black-text"> tons</span></td>
                                        </tr>
                                        <?php if(request()->operations === "1" ){?>
                                            <tr>
                                                <td class="border-b py-2"><strong>Area :</strong></td>
                                                <td class="border-b py-2"> <?=round($detail['area'], 4)?><span class="font_size18 black-text"> in²</span></td>
                                            </tr>
                                        <?php } ?>
                                        <?php if ( request()->operations === "1" ||  request()->operations === "2"){?>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[4] }} :</strong></td>
                                                <td class="border-b py-2"><?=round($detail['volume'], 4)?><span class="font_size18 black-text"> in³</span></td>
                                            </tr>
                                        <?php } ?>
                                        <?php if (isset($detail['cost_mass'])){?>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[24] }} :</strong></td>
                                                <td class="border-b py-2"><?= $currancy ?> <?=round($detail['cost_mass'], 4)?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php if (!empty(request()->seven)) {?> 
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[25] }} :</strong></td>
                                                <td class="border-b py-2"><?= $currancy ?> <?=round($detail['cost_volume'], 4)?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="2" class="pt-3"><strong>{{$lang['26']}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">lbs</td>
                                            <td class="border-b py-2"><?=round($detail['weight'], 4)?></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">long tons</td>
                                            <td class="border-b py-2"><?= round($detail['weight'] / 2240,4)?></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">kgs</td>
                                            <td class="border-b py-2"><?= round($detail['weight'] / 2.205,4)?></td>
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
        var cal = document.getElementById('operation').value;
        if (cal == '1') {
            document.getElementById('div1').style.display = 'block';
            document.getElementById('div2').style.display = 'block';
            document.getElementById('div3').style.display = 'block';
            document.getElementById('div5').style.display = 'block';
            document.getElementById('div7').style.display = 'block';
            document.getElementById('div8').style.display = 'block';
            document.getElementById('div4').style.display = 'none';
            document.getElementById('div6').style.display = 'none';
        } 
        @if(isset($detail) || isset($error))
            if (cal == '1') {
                document.getElementById('div1').style.display = 'block';
                document.getElementById('div2').style.display = 'block';
                document.getElementById('div3').style.display = 'block';
                document.getElementById('div5').style.display = 'block';
                document.getElementById('div7').style.display = 'block';
                document.getElementById('div8').style.display = 'block';
                document.getElementById('div4').style.display = 'none';
                document.getElementById('div6').style.display = 'none';
            } else if (cal == '2') {
                document.getElementById('div3').style.display = 'block';
                document.getElementById('div4').style.display = 'block';
                document.getElementById('div5').style.display = 'block';
                document.getElementById('div7').style.display = 'block';
                document.getElementById('div8').style.display = 'block';
                document.getElementById('div1').style.display = 'none';
                document.getElementById('div2').style.display = 'none';
                document.getElementById('div6').style.display = 'none';
            } else if (cal == '3') {
                document.getElementById('div5').style.display = 'block';
                document.getElementById('div6').style.display = 'block';
                document.getElementById('div7').style.display = 'block';
                document.getElementById('div8').style.display = 'block';
                document.getElementById('div1').style.display = 'none';
                document.getElementById('div2').style.display = 'none';
                document.getElementById('div3').style.display = 'none';
                document.getElementById('div4').style.display = 'none';
            }
        @endif
        document.getElementById('operation').addEventListener('change', function() {
            var cal = this.value;
            if (cal == '1') {
                document.getElementById('div1').style.display = 'block';
                document.getElementById('div2').style.display = 'block';
                document.getElementById('div3').style.display = 'block';
                document.getElementById('div5').style.display = 'block';
                document.getElementById('div7').style.display = 'block';
                document.getElementById('div8').style.display = 'block';
                document.getElementById('div4').style.display = 'none';
                document.getElementById('div6').style.display = 'none';
            } else if (cal == '2') {
                document.getElementById('div3').style.display = 'block';
                document.getElementById('div4').style.display = 'block';
                document.getElementById('div5').style.display = 'block';
                document.getElementById('div7').style.display = 'block';
                document.getElementById('div8').style.display = 'block';
                document.getElementById('div1').style.display = 'none';
                document.getElementById('div2').style.display = 'none';
                document.getElementById('div6').style.display = 'none';
            } else if (cal == '3') {
                document.getElementById('div5').style.display = 'block';
                document.getElementById('div6').style.display = 'block';
                document.getElementById('div7').style.display = 'block';
                document.getElementById('div8').style.display = 'block';
                document.getElementById('div1').style.display = 'none';
                document.getElementById('div2').style.display = 'none';
                document.getElementById('div3').style.display = 'none';
                document.getElementById('div4').style.display = 'none';
            }
        });

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>