<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="type" class="label">{{ $lang['1'] }}</label>
                    <div class="w-100 py-2"> 
                        <select name="type" id="type" class="input">
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
                                $val = ["lawn_mowed","mowing_time"];
                                optionsList($val,$name,isset($_POST['type'])?$_POST['type']: 'lawn_mowed' );
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 lawn_mowed">
                    <label for="charges" class="label">{{ $lang['4'] }}</label>
                    <div class="w-100 py-2"> 
                        <select name="charges" id="charges" class="input">
                            @php
                                $name = [$lang['5'], $lang['6']];
                                $val = ["area","hour"];
                                optionsList($val,$name,isset($_POST['charges'])?$_POST['charges']: 'area' );
                            @endphp
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6 mow_price">
                    <label for="mow_price" class="label">{{ $lang['7'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="mow_price" id="mow_price" step="any" min="0"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mow_price']) ? $_POST['mow_price'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <span class="input_unit text-blue hidden hour">{{$currancy}}/h</span>
                        <label for="m_p_units" class="absolute cursor-pointer text-sm underline right-6 top-4 m_p_unit" onclick="toggleDropdown('m_p_units_dropdown')">{{ isset($_POST['m_p_units'])?$_POST['m_p_units']:$currancy.' '.'km²' }} ▾</label>
                        <input type="text" name="m_p_units" value="{{ isset($_POST['m_p_units'])?$_POST['m_p_units']:$currancy.' '.'km²' }}" id="m_p_units" class="hidden">
                        <div id="m_p_units_dropdown" class="m_p_units absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m_p_units">
                            <input type="hidden" name="currancy" value="{{$currancy}}">
                            @foreach (["$currancy m²","$currancy km²", "$currancy ft²", "$currancy yd²","$currancy a","$currancy da","$currancy ha","$currancy ac"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('m_p_units', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 area_mow">
                    <label for="area_mow" class="label">{{ $lang['8'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="area_mow" id="area_mow" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area_mow']) ? $_POST['area_mow'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="a_m_units" class="absolute cursor-pointer text-sm underline right-6 top-4 a_m_unit" onclick="toggleDropdown('a_m_units_dropdown')">{{ isset($_POST['a_m_units'])?$_POST['a_m_units']:'km²' }} ▾</label>
                        <input type="text" name="a_m_units" value="{{ isset($_POST['a_m_units'])?$_POST['a_m_units']:'km²' }}" id="a_m_units" class="hidden">
                        <div id="a_m_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="a_m_units">
                            @foreach (["m²","km²", "ft²", "yd²","a","da","ha","ac"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('a_m_units', '{{ $name }}')"> {{ $name }}</p>  
                        @endforeach
                        </div>
                     </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6 hours_work">
                    <label for="hours_work" class="label">{{ $lang['9'] }}:</label>
                    <div class="w-100 py-2 position-relative"> 
                        <input type="number" step="any" name="hours_work" id="hours_work" class="input" aria-label="input"  value="{{ isset($_POST['hours_work'])?$_POST['hours_work']:'10' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 mowing_time">
                    <label for="mow_speed" class="label">{{ $lang['10'] }}:</label>

                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="mow_speed" id="mow_speed" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mow_speed']) ? $_POST['mow_speed'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mow_speed_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mow_speed_units_dropdown')">{{ isset($_POST['mow_speed_units'])?$_POST['mow_speed_units']:'km/h' }} ▾</label>
                        <input type="text" name="mow_speed_units" value="{{ isset($_POST['mow_speed_units'])?$_POST['mow_speed_units']:'km/h' }}" id="mow_speed_units" class="hidden">
                        <div id="mow_speed_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mow_speed_units">
                            @foreach (["km/h","m/h", "ft/h"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('mow_speed_units', '{{ $name }}')"> {{ $name }}</p>    
                           @endforeach
                        </div>
                     </div>
                </div>
             


                <div class="col-span-12 md:col-span-6 lg:col-span-6 mow_width">
                    <label for="mow_width" class="label">{{ $lang['11'] }}:</label>

                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="mow_width" id="mow_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mow_width']) ? $_POST['mow_width'] : '6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mow_width_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mow_width_units_dropdown')">{{ isset($_POST['mow_width_units'])?$_POST['mow_width_units']:'km' }} ▾</label>
                        <input type="text" name="mow_width_units" value="{{ isset($_POST['mow_width_units'])?$_POST['mow_width_units']:'km' }}" id="mow_width_units" class="hidden">
                        <div id="mow_width_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mow_width_units">
                            @foreach (["cm","m", "km","in","ft"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('mow_width_units', '{{ $name }}')"> {{ $name }}</p>    
                           @endforeach
                        </div>
                     </div>
                </div>

                <div class="col-span-12  mow_pro">
                    <label for="mow_pro" class="label">{{ $lang['12'] }}:</label>
                    <div class="w-100 py-2 relative"> 
                        <input type="number" step="any" name="mow_pro" id="mow_pro" class="input" aria-label="input"  value="{{ isset($_POST['mow_pro'])?$_POST['mow_pro']:'80' }}" />
                        <span class="input_unit text-blue">%</span>
                    </div>
                </div>

                <div class="col-span-12 to_mow pe-lg-3">
                    <p><?= $lang['13'] ?> (<?= $lang['14'] ?>)</p>
                        <label for="to_mow" class="label"><?= $lang['15'] ?>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="to_mow" id="to_mow" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['to_mow']) ? $_POST['to_mow'] : '6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="to_mow_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('to_mow_units_dropdown')">{{ isset($_POST['to_mow_units'])?$_POST['to_mow_units']:'ft²/to mow' }} ▾</label>
                        <input type="text" name="to_mow_units" value="{{ isset($_POST['to_mow_units'])?$_POST['to_mow_units']:'ft²/to mow' }}" id="to_mow_units" class="hidden">
                        <div id="to_mow_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="to_mow_units">
                            @foreach (["m²/to mow","km²/to mow", "ft²/to mow","yd²/to mow","a/to mow","ha/to mow","ac/to mow"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('to_mow_units', '{{ $name }}')"> {{ $name }}</p>    
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
    @else
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <?php if ($detail['type'] == 'lawn_mowed'){ ?>
                                <?php if ($detail['charges'] == 'area'){ ?>
                                    <div class="text-center">
                                        <p class="text-[20px]"><strong>{{$lang['16']}}</strong></p>
                                        <div class="flex justify-center">
                                            <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><span>{{$currancy}}</span> {{round($detail['total_cost'],5)}}</strong> </p>
                                    </div>
                                </div>
                                    <div>
                                        <p><strong><?= $lang['17'] ?></strong></p>
                                        <p class="mt-2"><?= $lang['18'] ?> = <?= $detail['mow_price']?>km²</p>
                                        <p class="mt-2"><?= $lang['8'] ?> = <?= $detail['area_mow']?>km²</p>
                                        <p class="mt-2"><strong><?= $lang['19'] ?></strong></p>
                                        <p class="mt-2"><?= $lang['16'] ?>  = <?= $lang['18'] ?>  * <?= $lang['8'] ?></p>
                                        <p class="mt-2"><?= $lang['16'] ?>  = <?= $detail['mow_price']?> * <?= $detail['area_mow']?></p>
                                        <p class="mt-2"><strong><?= $lang['16'] ?></strong> = <i><?=$currancy?></i> <?= $detail['total_cost']?></p>
                                    </div>
                                <?php } else if ($detail['charges'] == 'hour'){ ?>
                                    <div class="text-center">
                                        <p class="text-[20px]"><strong>{{$lang['16']}}</strong></p>
                                        <div class="flex justify-center">
                                            <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><span>{{$currancy}}</span> {{round($detail['total_cost'],5)}}</strong> </p>
                                    </div>
                                </div>
                                    <div>
                                        <p><strong><?= $lang['17'] ?></strong></p>
                                        <p class="mt-2"><?= $lang['18'] ?> = <?= $detail['mow_price']?>/h</p>
                                        <p class="mt-2"><?= $lang['8'] ?> = <?= $detail['hours_work']?>h</p>
                                        <p class="mt-2"><strong><?= $lang['19'] ?></strong></p>
                                        <p class="mt-2"><?= $lang['16'] ?> = <?= $lang['18'] ?> * <?= $lang['20'] ?></p>
                                        <p class="mt-2"><?= $lang['16'] ?> = <?= $detail['mow_price']?> * <?= $detail['hours_work']?></p>
                                        <p class="mt-2"><strong><?= $lang['16'] ?></strong> = <i><?=$currancy?></i> <?= $detail['total_cost']?></p>
                                    </div>
                                <?php } ?>
                            <?php } else if ($detail['type'] == 'mowing_time'){ ?>	
                                    <div class="col-lg-8 font-s-18">
                                        <table class="w-100">
                                            <tr>
                                                <td width="50%" class="border-b py-2"><strong><?= $lang['21'] ?> :</strong></td>
                                                <td class="border-b py-2"><?= $detail['m_cost'] ?> <span class="font-s-16">km² <?= $lang['6'] ?></span></td>
                                            </tr>
                                            <?php if (isset($detail['hours'])){ ?>
                                                <tr>
                                                    <td class="border-b py-2"><strong><?= $lang['13'] ?> :</strong></td>
                                                    <td class="border-b py-2"><?= $detail['hours']?> <span class="font-s-16"><?= $lang['21'] ?></span> : <?= $detail['minutes']?> <span class="font-s-16"><?= $lang['22'] ?></span></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>	
                                    <div class="col-lg-8 font-s-18" style="overflow: auto;">
                                        <p><?= $lang['23'] ?></p> 
                                        <table class="w-100">
                                            <tr>
                                                <td width="50%" class="border-b py-2"><?= $lang['21'] ?> :</td>
                                                <td class="border-b py-2"><?=$detail['m_cost'] * 1000000?> m²</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?= $lang['21'] ?> :</td>
                                                <td class="border-b py-2"><?=$detail['m_cost'] * 10763910?> ft²</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?= $lang['21'] ?> :</td>
                                                <td class="border-b py-2"><?=$detail['m_cost'] * 1195990 ?> yd²</td>
                
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?= $lang['21'] ?> :</td>
                                                <td class="border-b py-2"><?=$detail['m_cost'] * 10000?> a</td>
                
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?= $lang['21'] ?> :</td>
                                                <td class="border-b py-2"><?=$detail['m_cost'] * 100 ?> ha</td>
                
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?= $lang['21'] ?> :</td>
                                                <td class="border-b py-2"><?=$detail['m_cost'] * 247.1 ?> ac</td>
                
                                            </tr>
                                        </table>
                                    </div>
                                    <div>
                                        <p class="mt-2"><strong><?= $lang['17'] ?></strong></p>
                                        <p class="mt-2"><?= $lang['10'] ?> = <?= $detail['mow_speed'] ?> km/h</p>
                                        <p class="mt-2"><?= $lang['11'] ?> = <?= $detail['mow_width'] ?> km </p>
                                        <p class="mt-2"><?= $lang['30'] ?> = <?= $detail['mow_pro'] ?> %</p>
                                        <?php if (isset($detail['hours'])){ ?>
                                            <p class="mt-2"><?= $lang['8'] ?> = <?= $detail['to_mow'] ?> km²</p>
                                        <?php } ?>
                                        <p class="mt-2 "><strong><?= $lang['19'] ?></strong></p>
                                        <p class="mt-2"><?= $lang['21'] ?> =  <?= $lang['10'] ?> * <?= $lang['11'] ?> * <?= $lang['30'] ?> </p>
                                        <p class="mt-2"><?= $lang['21'] ?> = <?= $detail['mow_speed'] ?> * <?= $detail['mow_width'] ?> * 
                                        <span class="fraction">
                                            <span class="num">{{ $detail['mow_pro'] }}</span>
                                            <span class="visually-hidden "></span>
                                            <span class="den">100</span>
                                        </span></p>
                                        <p class="mt-2"><?= $lang['21'] ?> = <?= $detail['mow_speed'] * $detail['mow_width'] ?> * <?= $detail['mow_pro'] / 100 ?></p>
                                        <p class="mt-2"><strong><?= $lang['21'] ?>  = <?= $detail['m_cost'] ?>  km² <?= $lang['6'] ?></strong></p>
                                        <?php if (isset($detail['hours'])){ ?>
                                            <p class="mt-2 font-s-16"><?= $lang['31'] ?></p>
                                            <p class="mt-2"> <?= $lang['13'] ?>   =
                                                <span class="fraction">
                                                    <span class="num">{{$lang['8'] }}</span>
                                                    <span class="visually-hidden "></span>
                                                    <span class="den">{{ $lang['32']}}</span>
                                            </p>
                                            <p class="mt-2"> <?= $lang['13'] ?> = 
                                                <span class="fraction">
                                                    <span class="num">{{ $detail['to_mow'] }}</span>
                                                    <span class="visually-hidden "></span>
                                                    <span class="den">{{$detail['m_cost'] }}</span>
                                                </span>
                                            </p>
                                            <p class="mt-2"><strong> <?= $lang['13'] ?>  = <?= $detail['hours']?> <?= $lang['21'] ?>  : <?= $detail['minutes']?> <?= $lang['22'] ?></strong></p>
                                        <?php } ?>
                                    </div>
                            <?php } ?>
                        </div>
                        <div class="col-12 text-center my-[25px]">
                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                                @if (app()->getLocale() == 'en')
                                    RESET
                                @else
                                    {{ $lang['reset'] ?? 'RESET' }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endif
</form>
@push('calculatorJS')
    <script>
        var option = document.getElementById('type').value;
        if (option === 'lawn_mowed') {
            document.querySelectorAll(".area_mow, .mow_price, .lawn_mowed").forEach(function(el) {
                el.style.display = 'block';
            });
            document.querySelectorAll(".mowing_time, .hours_work, .mow_width, .mow_pro, .to_mow").forEach(function(el) {
                el.style.display = 'none';
            });
        } 

        document.getElementById('type').addEventListener('change', function() {
            var option = this.value;
            if (option === 'mowing_time') {
                document.querySelectorAll(".area_mow, .mow_price, .lawn_mowed").forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll(".mowing_time, .mow_width, .mow_pro, .to_mow").forEach(function(el) {
                    el.style.display = 'block';
                });
            } else {
                document.querySelectorAll(".area_mow, .mow_price, .lawn_mowed").forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelectorAll(".mowing_time, .hours_work, .mow_width, .mow_pro, .to_mow").forEach(function(el) {
                    el.style.display = 'none';
                });
            }
        });
        
        document.getElementById('charges').addEventListener('change', function() {
            var option = this.value;
            if (option === 'hour') {
                document.querySelectorAll(".m_p_unit, .area_mow, .a_m_unit").forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll(".hour, .hours_work").forEach(function(el) {
                    el.style.display = 'block';
                });
            } else {
                document.querySelectorAll(".hour, .hours_work").forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll(".m_p_unit, .area_mow, .a_m_unit").forEach(function(el) {
                    el.style.display = 'block';
                });
            }
        });

    </script>
@endpush