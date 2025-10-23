<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
            <input type="hidden" name="type" id="type" value="{{ isset($_POST['type'])?$_POST['type']:'linear' }}">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="tab1">
                            {{ $lang['linear'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="tab2">
                            {{ $lang['rot'] }}
                    </div>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-12  gap-4">
                <div id="linear" class="col-span-12">
                      <div class="grid grid-cols-12  gap-4">
                        <strong class="col-span-12 mt-2 px-2">To Calculate:</strong>
                        <div class="col-span-12 flex items-center">
                            @if (isset($_POST['to_cal']))
                                @if ($_POST['to_cal']=='kin')
                                    <input name="to_cal" id="to_cal" class="kin_ mx-1" value="kin" type="radio" checked />
                                @else
                                    <input name="to_cal" id="to_cal" class="kin_ mx-1" value="kin" type="radio" />
                                @endif
                            @else
                                <input name="to_cal" id="to_cal" class="kin_ mx-1" value="kin" type="radio" checked />
                            @endif
                            <label for="to_cal" class="font-s-14 text-blue px-1">{{ $lang['kin'] }}</label>
                            @if (isset($_POST['to_cal']) && $_POST['to_cal']=='mass')
                                <input name="to_cal" id="to_cal1" class="mass_ ms-2" value="mass" type="radio" checked />
                            @else
                                <input name="to_cal" id="to_cal1" class="mass_ ms-2" value="mass" type="radio" />
                            @endif
                            <label for="to_cal1" class="font-s-14 text-blue px-1">{{ $lang['mass'] }}</label>
                            @if (isset($_POST['to_cal']) && $_POST['to_cal']=='velo')
                                <input name="to_cal" id="to_cal2" class="velo_ ms-2" value="velo" type="radio" checked />
                            @else
                                <input name="to_cal" id="to_cal2" class="velo_ ms-2" value="velo" type="radio" />
                            @endif
                            <label for="to_cal2" class="font-s-14 text-blue ps-1">{{ $lang['velo'] }}</label>
                        </div>
                        
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 mass">
                            <label for="mass" class="font-s-14 text-blue">{{ $lang['mass'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="mass" id="mass" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass']) ? $_POST['mass'] : '53' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit_m" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_m_dropdown')">{{ isset($_POST['unit_m'])?$_POST['unit_m']:'miles/s' }} ▾</label>
                                <input type="text" name="unit_m" value="{{ isset($_POST['unit_m'])?$_POST['unit_m']:'miles/s' }}" id="unit_m" class="hidden">
                                <div id="unit_m_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_m">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_m', 'kg')">kg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_m', 'mg')">mg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_m', 'g')">g</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_m', 'lbs')">lbs</p>
                                </div>
                             </div>
                        </div>
                       
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 velocity">
                            <label for="velocity" class="font-s-14 text-blue">{{ $lang['velo'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="velocity" id="velocity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['velocity']) ? $_POST['velocity'] : '52600' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit_v" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_v_dropdown')">{{ isset($_POST['unit_v'])?$_POST['unit_v']:'miles/s' }} ▾</label>
                                <input type="text" name="unit_v" value="{{ isset($_POST['unit_v'])?$_POST['unit_v']:'miles/s' }}" id="unit_v" class="hidden">
                                <div id="unit_v_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_v">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_v', 'miles/s')">miles/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_v', 'km/s')">km/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_v', 'm/s')">m/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_v', 'ft/s')">ft/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_v', 'in/s')">in/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_v', 'yd/s')">yd/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_v', 'km/h')">km/h</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_v', 'm/h')">m/h</p>
                                </div>
                             </div>
                        </div>
                       
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden kin">
                            <label for="kin" class="font-s-14 text-blue">{{ $lang['kin'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="kin" id="kin" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['kin']) ? $_POST['kin'] : '52600' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit_k" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_k_dropdown')">{{ isset($_POST['unit_k'])?$_POST['unit_k']:'j' }} ▾</label>
                                <input type="text" name="unit_k" value="{{ isset($_POST['unit_k'])?$_POST['unit_k']:'j' }}" id="unit_k" class="hidden">
                                <div id="unit_k_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_k">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_k', 'j')">j</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_k', 'kJ')">kJ</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_k', 'MJ')">MJ</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_k', 'Wh')">Wh</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_k', 'kWh')">kWh</p>
                                </div>
                             </div>
                        </div>
                       
                    </div>
                </div>
                <div id="rotational" class="col-span-12 hidden">
                      <div class="grid grid-cols-12  gap-4">
                        <strong class="col-12 mt-2 px-2">To Calculate:</strong>
                        <div class="col-span-12 flex items-center">
                            @if (isset($_POST['to_calr']))
                                @if ($_POST['to_calr']=='r_kin')
                                    <input name="to_calr" id="to_calr" class="kin_r mx-1" value="r_kin" type="radio" checked />
                                @else
                                    <input name="to_calr" id="to_calr" class="kin_r mx-1" value="r_kin" type="radio" />
                                @endif
                            @else
                                <input name="to_calr" id="to_calr" class="kin_r mx-1" value="r_kin" type="radio" checked />
                            @endif
                            <label for="to_calr" class="font-s-14 text-blue px-1">{{ $lang['kin'] }}</label>
                            @if (isset($_POST['to_calr']) && $_POST['to_calr']=='moi')
                                <input name="to_calr" id="to_calr1" class="mass_r ms-2" value="moi" type="radio" checked />
                            @else
                                <input name="to_calr" id="to_calr1" class="mass_r ms-2" value="moi" type="radio" />
                            @endif
                            <label for="to_calr1" class="font-s-14 text-blue px-1">{{ $lang['moi'] }}</label>
                            @if (isset($_POST['to_calr']) && $_POST['to_calr']=='a_v')
                                <input name="to_calr" id="to_calr2" class="velo_r ms-2" value="a_v" type="radio" checked />
                            @else
                                <input name="to_calr" id="to_calr2" class="velo_r ms-2" value="a_v" type="radio" />
                            @endif
                            <label for="to_calr2" class="font-s-14 text-blue ps-1">{{ $lang['a_v'] }}</label>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden r_kin">
                            <label for="r_kin" class="font-s-14 text-blue">{{ $lang['kin'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="r_kin" id="r_kin" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['r_kin']) ? $_POST['r_kin'] : '52600' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit_k_r" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_k_r_dropdown')">{{ isset($_POST['unit_k_r'])?$_POST['unit_k_r']:'j' }} ▾</label>
                                <input type="text" name="unit_k_r" value="{{ isset($_POST['unit_k_r'])?$_POST['unit_k_r']:'j' }}" id="unit_k_r" class="hidden">
                                <div id="unit_k_r_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_k_r">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_k_r', 'j')">j</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_k_r', 'kJ')">kJ</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_k_r', 'MJ')">MJ</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_k_r', 'Wh')">Wh</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_k_r', 'kWh')">kWh</p>
                                </div>
                             </div>
                        </div>
                        
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 moment">
                            <label for="moment" class="font-s-14 text-blue">{{ $lang['moi'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="moment" id="moment" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['moment']) ? $_POST['moment'] : '1067' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit_i" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_i_dropdown')">{{ isset($_POST['unit_i'])?$_POST['unit_i']:'kg*m²' }} ▾</label>
                                <input type="text" name="unit_i" value="{{ isset($_POST['unit_i'])?$_POST['unit_i']:'kg*m²' }}" id="unit_i" class="hidden">
                                <div id="unit_i_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_i">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_i', 'kg*m²')">kg*m²</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_i', 'lbs*ft²')">lbs*ft²</p>
                                </div>
                             </div>
                        </div>
                      
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 a_velocity">
                            <label for="a_velocity" class="font-s-14 text-blue">{{ $lang['a_v'] }}:</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="a_velocity" id="a_velocity" class="input" value="{{ isset($_POST['a_velocity'])?$_POST['a_velocity']:'31.4' }}" aria-label="input" placeholder="00" />
                            </div>
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
                    <div class="w-full">
                        @php
                            $request = request();
                        @endphp
                        <?php if(isset($detail['a_velocity'])){ ?>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['a_v']?></td>
                                        <td class="py-2 border-b"><strong>{{ $detail['a_velocity'] }} rad/s</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['kin']?></td>
                                        <td class="py-2 border-b"><strong>{{ $request['r_kin']." ".$request['unit_k_r'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['moi']?></td>
                                        <td class="py-2 border-b"><strong>{{ $request['moment']." ".$request['unit_i'] }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                        <?php if(isset($detail['moment'])){ ?>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['moi']?></td>
                                        <td class="py-2 border-b"><strong><?=$detail['moment']?> kg*m²</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['kin']?></td>
                                        <td class="py-2 border-b"><strong><?=$request['r_kin']." ".$request['unit_k_r']?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['a_v']?></td>
                                        <td class="py-2 border-b"><strong><?=$request['a_velocity']?> rad/s</strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                        <?php if(isset($detail['r_kin'])){ ?>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['kin']?></td>
                                        <td class="py-2 border-b"><strong><?=$detail['r_kin']?> J</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['moi']?></td>
                                        <td class="py-2 border-b"><strong><?=$request['moment']." ".$request['unit_i']?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['a_v']?></td>
                                        <td class="py-2 border-b"><strong><?=$request['a_velocity']?> rad/s</strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                        <?php if(isset($detail['velocity'])){ ?>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['velo']?></td>
                                        <td class="py-2 border-b"><strong><?=$detail['velocity']?> m/s</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12 mt-3 font-s-18"><strong>Result in Other Units</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['velo']?></td>
                                        <td class="py-2 border-b"><strong><?=round($detail['velocity']/1609,4)?> miles/s</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['velo']?></td>
                                        <td class="py-2 border-b"><strong><?=round($detail['velocity']/1000,4)?> km/s</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['velo']?></td>
                                        <td class="py-2 border-b"><strong><?=round($detail['velocity']*3.28084,4)?> ft/s</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['velo']?></td>
                                        <td class="py-2 border-b"><strong><?=round($detail['velocity']*2.23694,4)?> miles/h</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['velo']?></td>
                                        <td class="py-2 border-b"><strong><?=round($detail['velocity']*3.6,4)?> km/h</strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                        <?php if(isset($detail['mass'])){ ?>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['mass']?></td>
                                        <td class="py-2 border-b"><strong><?=$detail['mass']?> kg</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12 mt-3 font-s-18"><strong>Result in Other Units</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['mass']?></td>
                                        <td class="py-2 border-b"><strong><?=round($detail['mass']*1e+6,4)?> mg</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['mass']?></td>
                                        <td class="py-2 border-b"><strong><?=round($detail['mass']*1e+3,4)?> g</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['mass']?></td>
                                        <td class="py-2 border-b"><strong><?=round($detail['mass']*2.205,4)?> lbs</strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                        <?php if(isset($detail['kin'])){ ?>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['kin']?></td>
                                        <td class="py-2 border-b"><strong><?=$detail['kin']?> J</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12 mt-3 font-s-18"><strong>Result in Other Units</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['kin']?></td>
                                        <td class="py-2 border-b"><strong><?=round($request['kin']/1000,6)?> kJ</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['kin']?></td>
                                        <td class="py-2 border-b"><strong><?=round($request['kin']/1000000,6)?> MJ</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['kin']?></td>
                                        <td class="py-2 border-b"><strong><?=round($request['kin']/3600,6)?> Wh</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['kin']?></td>
                                        <td class="py-2 border-b"><strong><?=round($request['kin']/3.6e+6,6)?> kWh</strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        @if (isset($_POST['type']) && $_POST['type']=='linear')
            document.getElementById('tab1').click();
        @endif
        @if (isset($_POST['type']) && $_POST['type']=='rotational')
            document.getElementById('tab2').click();
        @endif
        document.getElementById('tab1').addEventListener('click', function() {
            document.getElementById('type').value = 'linear';
            this.classList.add('tagsUnit');
            document.getElementById('tab2').classList.remove('tagsUnit');
            document.querySelectorAll('#linear').forEach(el => el.style.display = 'block');
            document.querySelectorAll('#rotational').forEach(el => el.style.display = 'none');
        });

        // Event listener for tab2 click
        document.getElementById('tab2').addEventListener('click', function() {
            document.getElementById('type').value = 'rotational';
            this.classList.add('tagsUnit');
            document.getElementById('tab1').classList.remove('tagsUnit');
            document.querySelectorAll('#rotational').forEach(el => el.style.display = 'block');
            document.querySelectorAll('#linear').forEach(el => el.style.display = 'none');
        });
        // Function to show and hide elements based on class names
        function toggleVisibility(showSelectors, hideSelectors) {
            showSelectors.forEach(selector => {
                document.querySelectorAll(selector).forEach(element => {
                    element.style.display = 'block';
                });
            });

            hideSelectors.forEach(selector => {
                document.querySelectorAll(selector).forEach(element => {
                    element.style.display = 'none';
                });
            });
        }

        // Event listeners for kin, mass, and velocity buttons
        document.querySelector('.kin_').addEventListener('click', () => {
            toggleVisibility(['.mass', '.velocity'], ['.kin']);
        });
        document.querySelector('.mass_').addEventListener('click', () => {
            toggleVisibility(['.kin', '.velocity'], ['.mass']);
        });
        document.querySelector('.velo_').addEventListener('click', () => {
            toggleVisibility(['.kin', '.mass'], ['.velocity']);
        });
        // Event listeners for rotational kin, mass, and velocity buttons
        document.querySelector('.kin_r').addEventListener('click', () => {
            toggleVisibility(['.moment', '.a_velocity'], ['.r_kin']);
        });
        document.querySelector('.mass_r').addEventListener('click', () => {
            toggleVisibility(['.r_kin', '.a_velocity'], ['.moment']);
        });
        document.querySelector('.velo_r').addEventListener('click', () => {
            toggleVisibility(['.r_kin', '.moment'], ['.a_velocity']);
        });
        @if (isset($_POST['to_cal']) && $_POST['to_cal']=='kin')
            document.querySelector('.kin_').click();
        @endif
        @if (isset($_POST['to_cal']) && $_POST['to_cal']=='mass')
            document.querySelector('.mass_').click();
        @endif
        @if (isset($_POST['to_cal']) && $_POST['to_cal']=='velo')
            document.querySelector('.velo_').click();        
        @endif

        @if (isset($_POST['to_calr']) && $_POST['to_calr']=='r_kin')
            document.querySelector('.kin_r').click();
        @endif
        @if (isset($_POST['to_calr']) && $_POST['to_calr']=='moi')
            document.querySelector('.mass_r').click();
        @endif
        @if (isset($_POST['to_calr']) && $_POST['to_calr']=='a_v')
            document.querySelector('.velo_r').click();
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>