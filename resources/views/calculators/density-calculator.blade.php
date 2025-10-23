<style>
.show {
    display: flex!important;
}

.current_input {
    display: none;
    transition: display 0.5s ease-in-out;
}
    .button {
    transform: rotate(360deg);
    transition: .5s ease-in-out;
}


.button {
    transform: rotate(0deg);
    transition: transform 0.5s ease-in-out;
}

.button.rotate {
    transform: rotate(180deg);
}

</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           
        <div class="row hidden">
            <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white mx-auto text-center mt-2 border radius-10 p-1">
                <div class="col py-2 cursor-pointer radius-5 wed  {{ isset(request()->calc) && request()->calc === 'advance'  ? '' :'units_active' }} " id="wed">
                    {{$lang['1']}}
                </div>
                <div class="col py-2 cursor-pointer radius-5 rel  {{ isset(request()->calc) && request()->calc !== 'simple' ? 'units_active' :'' }}" id="rel">
                    {{$lang['2']}}
                </div>
                <input type="hidden" name="calc" id="one" value="{{ isset($_POST['calc'])?$_POST['calc']:'simple' }}">
            </div>
        </div>
          <div class="col-12  mx-auto mt-2  w-full"> 
            <div class="col-lg-2 font-s-14 hidden d-lg-block">{{$lang['3']}}:</div>
            <input type="hidden" name="to_cals" id="to_cals" value="{{ isset($_POST['to_cals'])?$_POST['to_cals']:'density' }}">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags {{isset(request()->to_cals) && request()->to_cals == "density" ? 'checked': ''}} hover:text-white tagsUnit imperial" id="density">
                                {{ $lang['4'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags {{isset(request()->to_cals) && request()->to_cals == "volume" ? 'checked': ''}} hover:text-white metric" id="volume">
                                {{ $lang['5'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags {{isset(request()->to_cals) && request()->to_cals == "mass" ? 'checked': ''}} hover:text-white metric" id="mass">
                                {{ $lang['6'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12   mt-3  gap-4">
          
                <div class="col-span-12">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" id="dens_unt">
                            <label for="dens_unt1" class="label my-3">{{ $lang['7'] }}</label>
                            <div class="w-100 py-2"> 
                                <select name="dens_unt" id="dens_unt1" class="input">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                            {{ $arr2[$index] }}
                                        </option>
                                    @php
                                        }}
                                        $name=["kg/m³","kg/dm³","kg/L","g/mL","t/m³","g/cm³","oz/cu_in","lb/cu_in","lb/cu_ft","lb/cu_yd","lb/us_gal", "g/l", "g/dl","mg/l"];
                                        $val=["kg/m³","kg/dm³","kg/L","g/mL","t/m³","g/cm³","oz/cu_in","lb/cu_in","lb/cu_ft","lb/cu_yd","lb/us_gal", "g/l", "g/dl","mg/l"];
                                        optionsList($val,$name,isset($_POST['dens_unt'])?$_POST['dens_unt']: "kg/m³");
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" id="volu_unt">
                            <label for="volu_unt1" class="label my-3">{{ $lang['9'] }}</label>
                            <div class="w-100 py-2"> 
                                <select name="volu_unt" id="volu_unt1" class="input">
                                    @php
                                        $name=["m³", "mm³", "cm³", "dm³", "cu in", "cu ft", "cu yd", "ml", "cl", "liters", "hl", "US gal", "UK gal", "US fl oz", "UK fl oz", "cups", "tbsp", "tsp", "US qt", "UK qt", "US pt", "UK pt"];
                                        $val=["m³", "mm³", "cm³", "dm³", "cu_in", "cu_ft", "cu_yd", "ml", "cl", "liters", "hl", "US_gal", "UK_gal", "US_fl_oz", "UK_fl_oz", "cups", "tbsp", "tsp", "US_qt", "UK_qt", "US_pt", "UK_pt"];
                                        optionsList($val,$name,isset($_POST['volu_unt'])?$_POST['volu_unt']: "m³");
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" id="mass_unt">
                            <label for="mass_unt1" class="label my-3">{{ $lang['10'] }}</label>
                            <div class="w-100 py-2"> 
                                <select name="mass_unt" id="mass_unt1" class="input">
                                    @php
                                        $name = ["kg", "µg", "mg", "g", "dag", "t", "gr", "dr", "oz", "lb", "stone", "US ton", "Long ton", "Earths", "Suns", "me", "mp", "mn", "u", "oz t"];
                                        $val = ["kg", "µg", "mg", "g", "dag", "t", "gr", "dr", "oz", "lb", "stone", "US_ton", "Long_ton", "Earths", "Suns", "me", "mp", "mn", "u", "oz_t"];
                                        optionsList($val,$name,isset($_POST['mass_unt'])?$_POST['mass_unt']: "kg");
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="col-span-12">
                <div class="grid grid-cols-12 gap-4">
                 <div class="col-span-12 md:col-span-6 lg:col-span-6" id="dens_blk_dns">
                    <label for="dns" class="label my-3">{{ $lang['4'] }}</label>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6 pe-lg-2"> 
                            <input type="number" step="any" name="dns" id="dns" class="input" aria-label="input"  value="{{ isset($_POST['bc'])?$_POST['bc']:'10' }}" />
                        </div>
                        <div class="col-span-6 ps-2 ps-lg-0"> 
                            <select name="sldns" id="sldns" class="input">
                                @php
                                    $name = ["kg/m³", "kg/dm³", "kg/L", "g/mL", "t/m³", "g/cm³", "oz/cu in", "lb/cu in", "lb/cu ft", "lb/cu yd", "lb/US gal", "g/L", "g/dL", "mg/L"];
                                    $val = ["kg/m³", "kg/dm³", "kg/L", "g/mL", "t/m³", "g/cm³", "oz/cu_in", "lb/cu_in", "lb/cu_ft", "lb/cu_yd", "lb/us_gal", "g/l", "g/dl", "mg/l"];
                                    optionsList($val,$name,isset($_POST['sldns'])?$_POST['sldns']: "kg/m³");
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="dens_blk_vol">
                    <label for="vol" class="label my-3">{{ $lang['5'] }}</label>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6 pe-lg-2"> 
                            <input type="number" step="any" name="vol" id="vol" class="input" aria-label="input"  value="{{ isset($_POST['vol'])?$_POST['vol']:'32' }}" />
                        </div>
                        <div class="col-span-6  ps-lg-0"> 
                            <select name="slvol" id="slvol" class="input">
                                @php
                                    $name=["m³", "mm³", "cm³", "dm³", "cu in", "cu ft", "cu yd", "ml", "cl", "liters", "hl", "US gal", "UK gal", "US fl oz", "UK fl oz", "cups", "tbsp", "tsp", "US qt", "UK qt", "US pt", "UK pt"];
                                    $val=["m³", "mm³", "cm³", "dm³", "cu_in", "cu_ft", "cu_yd", "ml", "cl", "liters", "hl", "US_gal", "UK_gal", "US_fl_oz", "UK_fl_oz", "cups", "tbsp", "tsp", "US_qt", "UK_qt", "US_pt", "UK_pt"];
                                    optionsList($val,$name,isset($_POST['slvol'])?$_POST['slvol']: "m³");
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="dens_blk_mas">
                    <label for="mas" class="label my-3">{{ $lang['6'] }}</label>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6 pe-lg-2"> 
                            <input type="number" step="any" name="mas" id="mas" class="input" aria-label="input"  value="{{ isset($_POST['mas'])?$_POST['mas']:'9' }}" />
                        </div>
                        <div class="col-span-6 ps-2 ps-lg-0"> 
                            <select name="slmas" id="slmas" class="input">
                                @php
                                        $name = ["kg", "µg", "mg", "g", "dag", "t", "gr", "dr", "oz", "lb", "stone", "US ton", "Long ton", "Earths", "Suns", "me", "mp", "mn", "u", "oz t"];
                                        $val = ["kg", "µg", "mg", "g", "dag", "t", "gr", "dr", "oz", "lb", "stone", "US_ton", "Long_ton", "Earths", "Suns", "me", "mp", "mn", "u", "oz_t"];
                                    optionsList($val,$name,isset($_POST['slmas'])?$_POST['slmas']: "kg");
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="dens_blk_lgn">
                    <label for="lgn" class="label my-3">{{ $lang['11'] }}</label>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6  pe-lg-2"> 
                            <input type="number" step="any" name="lgn" id="lgn" class="input" aria-label="input"  value="{{ isset($_POST['lgn'])?$_POST['lgn']:'50' }}" />
                        </div>
                        <div class="col-span-6 "> 
                            <select name="sllgn" id="sllgn" class="input">
                                @php
                                        $name = ["cm", "mm", "m", "in", "ft", "yd"];
                                        $val = ["cm", "mm", "m", "in", "ft", "yd"];
                                    optionsList($val,$name,isset($_POST['sllgn'])?$_POST['sllgn']: "cm");
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="dens_blk_wdt">
                    <label for="wdt" class="label my-3">{{ $lang['12'] }}</label>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6  pe-lg-2"> 
                            <input type="number" step="any" name="wdt" id="wdt" class="input" aria-label="input"  value="{{ isset($_POST['wdt'])?$_POST['wdt']:'40' }}" />
                        </div>
                        <div class="col-span-6 "> 
                            <select name="slwdt" id="slwdt" class="input">
                                @php
                                        $name = ["cm", "mm", "m", "in", "ft", "yd"];
                                        $val = ["cm", "mm", "m", "in", "ft", "yd"];
                                    optionsList($val,$name,isset($_POST['slwdt'])?$_POST['slwdt']: "cm");
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="dens_blk_hgt">
                    <label for="hgt" class="label my-3">{{ $lang['13'] }}</label>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6  pe-lg-2"> 
                            <input type="number" step="any" name="hgt" id="hgt" class="input" aria-label="input"  value="{{ isset($_POST['hgt'])?$_POST['hgt']:'40' }}" />
                        </div>
                        <div class="col-span-6"> 
                            <select name="slhgt" id="slhgt" class="input">
                                @php
                                        $name = ["cm", "mm", "m", "in", "ft", "yd"];
                                        $val = ["cm", "mm", "m", "in", "ft", "yd"];
                                    optionsList($val,$name,isset($_POST['slhgt'])?$_POST['slhgt']: "cm");
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="dens_adv_vol">
                    <label for="sladvol" class="label my-3">{{ $lang['9'] }}</label>
                    <div class="w-100 py-2"> 
                        <select name="sladvol" id="sladvol" class="input">
                            @php
                                $name=["m³", "mm³", "cm³", "dm³", "cu in", "cu ft", "cu yd", "ml", "cl", "liters", "hl", "US gal", "UK gal", "US fl oz", "UK fl oz", "cups", "tbsp", "tsp", "US qt", "UK qt", "US pt", "UK pt"];
                                $val=["m³", "mm³", "cm³", "dm³", "cu_in", "cu_ft", "cu_yd", "ml", "cl", "liters", "hl", "US_gal", "UK_gal", "US_fl_oz", "UK_fl_oz", "cups", "tbsp", "tsp", "US_qt", "UK_qt", "US_pt", "UK_pt"];
                                optionsList($val,$name,isset($_POST['sladvol'])?$_POST['sladvol']: "kg");
                            @endphp
                        </select>
                    </div>
                </div>
                </div>
            </div>
                
                <div class="col-span-12 cursor-pointer current_gpa flex items-center justify-center my-3 gap-3 ">
                    <strong class="text-[16px]"><?php echo $lang["14"] ?></strong>
                    <img src="<?=asset('images/new-down.png')?>" width="16px" height="16px" class="mt-1 max-width right button" alt="Add Extra Payment">
                </div>
                <div class="col-span-12 border row  pb-2 p-3 justify-center current_input {{ isset($_POST['price_bag']) && $_POST['price_bag'] !== '' ? 'show' : 'current_input' }} p-3 ">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 unit_h mb-2" id="dens_lok_unt">
                            <p class="text-blue font-s-14 pb-2"><?php echo $lang["7"] ?></p>
                            <select name="dens_lok_unt" class="input dens_lok_answer">
                                <option value="kg/m³" selected>kg/m³</option>
                                <option value="kg/dm³">kg/dm³</option>
                                <option value="kg/L">kg/L</option>
                                <option value="g/mL">g/mL</option>
                                <option value="t/m³">t/m³</option>
                                <option value="g/cm³">g/cm³</option>
                                <option value="oz/cu_in">oz/cu in</option>
                                <option value="lb/cu_in">lb/cu in</option>
                                <option value="lb/cu_ft">lb/cu ft</option>
                                <option value="lb/cu_yd">lb/cu yd</option>
                                <option value="lb/us_gal">lb/US gal</option>
                                <option value="g/l">g/L</option>
                                <option value="g/dl">g/dL</option>
                                <option value="mg/l">mg/L</option>
                            </select>
                        </div>
                        <div class="col-span-4 pe-2" id="dens_lok_cat">
                            <p class="text-blue font-s-14 pb-2"><?php echo $lang["15"] ?></p>
                            <select name="slcat" class="input dens_lok_answer">
                                <option value="metals" selected><?php echo $lang["17"] ?></option>
                                <option value="non-metals"><?php echo $lang["18"] ?></option>
                                <option value="gases"><?php echo $lang["19"] ?></option>
                                <option value="liquids"><?php echo $lang["20"] ?></option>
                                <option value="astronomy"><?php echo $lang["21"] ?></option>
                            </select>
                        </div>
                        <div class="col-span-8 ps-2" id="dens_cat_mtl">
                            <div class="col m8 s8 unit_h paddings_rl20_10">
                                <p class="text-blue font-s-14 pb-2"><?php echo $lang["16"] ?></p>
                                <select name="slmtl" class="input dens_lok_answer">
                                    <option value="aluminum" selected><?php echo $lang["22"] ?></option>
                                    <option value="beryllium"><?php echo $lang["23"] ?></option>
                                    <option value="brass"><?php echo $lang["24"] ?></option>
                                    <option value="copper"><?php echo $lang["25"] ?></option>
                                    <option value="gold"><?php echo $lang["26"] ?></option>
                                    <option value="iron"><?php echo $lang["27"] ?></option>
                                    <option value="lead"><?php echo $lang["28"] ?></option>
                                    <option value="magnesium"><?php echo $lang["29"] ?></option>
                                    <option value="mercury"><?php echo $lang["30"] ?></option>
                                    <option value="nickel"><?php echo $lang["31"] ?></option>
                                    <option value="platium"><?php echo $lang["32"] ?></option>
                                    <option value="plutonium"><?php echo $lang["33"] ?></option>
                                    <option value="potassium"><?php echo $lang["34"] ?></option>
                                    <option value="silver"><?php echo $lang["35"] ?></option>
                                    <option value="sodium"><?php echo $lang["36"] ?></option>
                                    <option value="tin"><?php echo $lang["37"] ?></option>
                                    <option value="titanium"><?php echo $lang["38"] ?></option>
                                    <option value="uranium"><?php echo $lang["39"] ?></option>
                                    <option value="zinc"><?php echo $lang["40"] ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-8 ps-2" id="dens_cat_mtl_no">
                            <div class="col m8 s8 unit_h paddings_rl20_10">
                                <p class="text-blue font-s-14 pb-2"><?php echo $lang["16"] ?></p>
                                <select name="slmtl_no" class="input dens_lok_answer">
                                    <option value="concrete" selected><?php echo $lang["41"] ?></option>
                                    <option value="cork"><?php echo $lang["42"] ?></option>
                                    <option value="diamond"><?php echo $lang["43"] ?></option>
                                    <option value="ice"><?php echo $lang["44"] ?></option>
                                    <option value="nylon"><?php echo $lang["45"] ?></option>
                                    <option value="oak"><?php echo $lang["46"] ?></option>
                                    <option value="pine"><?php echo $lang["47"] ?></option>
                                    <option value="plastics"><?php echo $lang["48"] ?></option>
                                    <option value="styrofoam"><?php echo $lang["49"] ?></option>
                                    <option value="wood"><?php echo $lang["50"] ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-8 ps-2" id="dens_cat_gas">
                            <div class="col m8 s8 unit_h paddings_rl20_10">
                                <p class="text-blue font-s-14 pb-2"><?php echo $lang["16"] ?></p>
                                <select name="slgas" class="input dens_lok_answer">
                                    <option value="air0" selected><?php echo $lang["51"] ?></option>
                                    <option value="air20"><?php echo $lang["52"] ?></option>
                                    <option value="carbon_dioxide0"><?php echo $lang["53"] ?></option>
                                    <option value="carbon_dioxide20"><?php echo $lang["54"] ?></option>
                                    <option value="carbon_monoxide0"><?php echo $lang["55"] ?></option>
                                    <option value="carbon_monoxide20"><?php echo $lang["56"] ?></option>
                                    <option value="hydrogen"><?php echo $lang["57"] ?></option>
                                    <option value="helium"><?php echo $lang["58"] ?></option>
                                    <option value="methane0"><?php echo $lang["59"] ?></option>
                                    <option value="methane20"><?php echo $lang["60"] ?></option>
                                    <option value="nitrogen0"><?php echo $lang["61"] ?></option>
                                    <option value="nitrogen20"><?php echo $lang["62"] ?></option>
                                    <option value="oxygen0"><?php echo $lang["63"] ?></option>
                                    <option value="oxygen20"><?php echo $lang["64"] ?></option>
                                    <option value="propane20"><?php echo $lang["65"] ?></option>
                                    <option value="water_vapor"><?php echo $lang["66"] ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-8 ps-2" id="dens_cat_lqd">
                            <div class="col m8 s8 unit_h paddings_rl20_10">
                                <p class="text-blue font-s-14 pb-2"><?php echo $lang["16"] ?></p>
                                <select name="sllqd" class="input dens_lok_answer">
                                    <option value="cooking_oil" selected><?php echo $lang["67"] ?></option>
                                    <option value="liquid_hydrogen"><?php echo $lang["68"] ?></option>
                                    <option value="liquid_oxygen"><?php echo $lang["69"] ?></option>
                                    <option value="water_fresh"><?php echo $lang["70"] ?></option>
                                    <option value="water_salt"><?php echo $lang["71"] ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-8 ps-2" id="dens_cat_astr">
                            <div class="col m8 s8 unit_h paddings_rl20_10">
                                <p class="text-blue font-s-14 pb-2"><?php echo $lang["16"] ?></p>
                                <select name="slastr" class="input dens_lok_answer">
                                    <option value="earth" selected><?php echo $lang["72"] ?></option>
                                    <option value="earth_core"><?php echo $lang["73"] ?></option>
                                    <option value="sun_core_min"><?php echo $lang["74"] ?></option>
                                    <option value="sun_core_max"><?php echo $lang["75"] ?></option>
                                    <option value="super_black_hole"><?php echo $lang["76"] ?></option>
                                    <option value="dwarf_star"><?php echo $lang["77"] ?></option>
                                    <option value="atomic_nuclei"><?php echo $lang["78"] ?></option>
                                    <option value="neutron_star"><?php echo $lang["79"] ?></option>
                                    <option value="stellar_black_hole"><?php echo $lang["80"] ?></option>
                                </select>
                            </div>
                        </div>
                
                        <p class="col-span-12 ps-2 text-blue">{{$lang['res']}}</p>
                        <div class=" col-span-12 ps-2 text-center mt-3 bg-sky p-2 " id="dens_lok_ans">
                            <p class="font-s-20 pt-2"><strong>{{$lang['4']}}</strong></p>
                            <p class="font-s-32  px-3 py-2  d-inline-block my-2"><strong class="text-blue dens_lok_ansr">2700 kg/m³</strong></p>
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
</div>      



    @else
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full my-5">
                    @php
                        $calc = request()->calc;
                        $appli=request()->appli;
                        $r_type=request()->r_type;
                    @endphp
                    <div class="w-full">
                        <div class="col s12 s12 dnsty_wrap">
                            <div class="text-center">
                                <p class="text-[18px]"><strong>
                                    <?php
                                        if ($detail["anstitle"] === "m") {
                                            echo $lang["6"];
                                        } elseif ($detail["anstitle"] === "v") {
                                            echo $lang["5"];
                                        } elseif ($detail["anstitle"] === "d") {
                                            echo $lang["4"];
                                        }
                                    ?>
                                </strong></p>
                                <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2 d-inline-block my-3 wrap_dnst"><strong class="text-blue">
                                    <?php echo $detail["ansval"]?>
                                </strong></p>
                            </div>
                        </div>
                            <?php
                               $to_cals = request()->to_cals;
                               $calc = request()->calc;
                            if ($calc === 'simple') {
                                    ?>
                                {{-- <div class="text-center kin_res_frm">
                                    <?php
                                        if (isset($to_cals)) {
                                            if ($to_cals === "density") {
                                    ?>
                                            <p>
                                                <img src="<?php echo asset('images/density-dns-formula.png')?>" width="110px" height="80px" class="max-width formula_img" alt="Displacement Calculator Formula 3" />
                                            </p>
                                    <?php
                                            } elseif ($to_cals === "volume") {
                                    ?>
                                            <p>
                                                <img src="<?php echo asset('images/density-vol-formula.png')?>" width="165" height="102" class="display_inline padding_5 m_b_n_10 formula_img" alt="Displacement Calculator Formula 3" />
                                            </p>
                                    <?php
                                            } elseif ($to_cals === "mass") {
                                    ?>
                                            <p>
                                                <img src="<?php echo asset('images/density-mas-formula.png')?>" width="225" height="58" class="display_inline padding_5 m_b_n_10 formula_img" alt="Displacement Calculator Formula 3" />
                                            </p>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div> --}}
                                    {{-- <p class="font-s-18">
                                        <strong><?php echo $lang["82"] ?></strong>
                                    </p> --}}
                                <div class="col-lg-8 font-s-18">
                                    <table class="w-100 disp_tbl">
                                        {{-- <tr>
                                            <td class="border-b py-2">
                                                <strong>
                                                    <?php
                                                        if ($detail["anstitle1"] === "m") {
                                                            echo $lang["6"];
                                                        } elseif ($detail["anstitle1"] === "v") {
                                                            echo $lang["5"];
                                                        } elseif ($detail["anstitle1"] === "d") {
                                                            echo $lang["4"];
                                                        }
                                                    ?>
                                                    :</strong>
                                            </td>
                                            <td class="border-b py-2">
                                                <?php echo $detail["ansval1"]?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <strong>
                                                    <?php
                                                        if ($detail["anstitle2"] === "m") {
                                                            echo $lang["6"];
                                                        } elseif ($detail["anstitle2"] === "v") {
                                                            echo $lang["5"];
                                                        } elseif ($detail["anstitle2"] === "d") {
                                                            echo $lang["4"];
                                                        }
                                                    ?>
                                                    :</strong>
                                            </td>
                                            <td class="border-b py-2">
                                                    <?php echo $detail["ansval2"]?>
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td class="border-b py-2"><strong><?php echo $lang["81"] ?> :</strong></td>
                                            <td class="border-b py-2">
                                                
                                                    <?php echo $detail["ansval3"]?>
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <p class="font-s-18">
                                    <strong><?php echo $lang["82"] ?> :</strong>
                                </p>
                                <div class="col-lg-8 font-s-18">
                                    <table class="w-100 disp_tbl">
                                        <tr>
                                            <td class="border-b py-2"><strong><?php echo $lang["6"] ?> :</strong></td>
                                            <td class="border-b py-2">
                                                <?php echo $detail["mass"]?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong><?php echo $lang["11"] ?> :</strong></td>
                                            <td class="border-b py-2">
                                                <?php echo $detail["lngt"]?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong><?php echo $lang["12"] ?> :</strong></td>
                                            <td class="border-b py-2">
                                                <?php echo $detail["wdth"]?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"> <strong><?php echo $lang["13"] ?> :</strong></td>
                                            <td class="border-b py-2">
                                                <?php echo $detail["hgth"]?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong><?php echo $lang["5"] ?> :</strong></td>
                                            <td class="border-b py-2">
                                                <?php echo $detail["vlme"]?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong><?php echo $lang["81"] ?> :</strong></td>
                                            <td class="border-b py-2">
                                                <?php echo $detail["ansval3"]?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-[20px]">
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
            function showElements(selectors) {
                    selectors.forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.style.display = 'block';
                    });
                });
            }

            function hideElements(selectors) {
                selectors.forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.style.display = 'none';
                    });
                });
            }
            // document.querySelector('.current_gpa').addEventListener('click', function() {
            //     var view = document.querySelector('.current_input');
            //     var button = document.querySelector('.button');
            //     view.classList.remove('current_input');
            //     view.classList.toggle('show');
            //     button.classList.toggle('rotate');
            //     alert('fff');
            // });

            document.querySelector('.current_gpa').addEventListener('click', function () {
            var view = document.querySelector('.current_input');
            var button = document.querySelector('.button');
            view.classList.toggle('show'); // Toggle visibility class
            button.classList.toggle('rotate'); // Toggle rotation class
            });




            var inputs = document.getElementById("one");
            if(inputs.value == 'simple'){
                showElements(["#dens_unt","#dens_blk_mas","#dens_blk_vol",".simp_radio"]);
                hideElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn","#dens_blk_dns","#mass_unt","#volu_unt"]);
            }

            @if(isset($error))
                if(inputs.value == 'simple'){
                    showElements(["#dens_unt","#dens_blk_mas","#dens_blk_vol",".simp_radio"]);
                    hideElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn","#dens_blk_dns","#mass_unt","#volu_unt"]);
                    var input = document.getElementById("density");
                    var inputv = document.getElementById("volume");
                    var inputm = document.getElementById("mass");
                    if(input.checked) {
                        showElements(["#dens_unt","#dens_blk_mas","#dens_blk_vol"]);
                        hideElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn","#dens_blk_dns","#mass_unt","#volu_unt"]);
                    }
                    if(inputv.checked) {
                        showElements(["#volu_unt","#dens_blk_mas","#dens_blk_dns"]);
                        hideElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn","#dens_blk_vol","#mass_unt","#dens_unt"]);
                    }
                    if(inputm.checked) {
                        showElements(["#mass_unt","#dens_blk_dns","#dens_blk_vol"]);
                        hideElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn","#dens_blk_mas","#dens_unt","#volu_unt"]);
                    }
                }else{
                    hideElements(["#dens_blk_dns","#dens_blk_vol","#volu_unt","#mass_unt",".simp_radio"]);
                    showElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn"]);
                }
                    
            @endif

            document.querySelectorAll('.wed').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.getElementById('one').value = 'simple'
                    this.classList.add('units_active')
                    document.querySelectorAll('.rel').forEach(function(hours1) {
                        hours1.classList.remove('units_active')
                    });
                    showElements(["#dens_unt","#dens_blk_mas","#dens_blk_vol",".simp_radio"]);
                    hideElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn","#dens_blk_dns","#mass_unt","#volu_unt"]);
                    var input = document.getElementById("density");
                    var inputv = document.getElementById("volume");
                    var inputm = document.getElementById("mass");
                    if(input.checked) {
                        showElements(["#dens_unt","#dens_blk_mas","#dens_blk_vol"]);
                        hideElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn","#dens_blk_dns","#mass_unt","#volu_unt"]);
                    }
                    if(inputv.checked) {
                        showElements(["#volu_unt","#dens_blk_mas","#dens_blk_dns"]);
                        hideElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn","#dens_blk_vol","#mass_unt","#dens_unt"]);
                    }
                    if(inputm.checked) {
                        showElements(["#mass_unt","#dens_blk_dns","#dens_blk_vol"]);
                        hideElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn","#dens_blk_mas","#dens_unt","#volu_unt"]);
                    }
                })
            });

            document.querySelectorAll('.rel').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.getElementById('one').value = 'advance'
                    this.classList.add('units_active')
                    document.querySelectorAll('.wed').forEach(function(hours1) {
                        hours1.classList.remove('units_active')
                    });
                    hideElements(["#dens_blk_dns","#dens_blk_vol","#volu_unt","#mass_unt",".simp_radio"]);
                    showElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn"]);
                })
            });
                
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('density').addEventListener('click', function() {            
                    document.getElementById('density').classList.add('tagsUnit');
                    document.getElementById('volume').classList.remove('tagsUnit');
                    document.getElementById('mass').classList.remove('tagsUnit');
                    document.getElementById('to_cals').value = "density";

                    showElements(["#dens_unt", "#dens_blk_mas", "#dens_blk_vol"]);
                    hideElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt", "#dens_blk_lgn", "#dens_blk_dns", "#mass_unt", "#volu_unt"]);
                });
            });

            document.getElementById('volume').addEventListener('click',function(){
                document.getElementById('volume').classList.add('tagsUnit');
                document.getElementById('mass').classList.remove('tagsUnit');
                document.getElementById('density').classList.remove('tagsUnit');
                document.getElementById('to_cals').value = "volume";

                showElements(["#volu_unt","#dens_blk_mas","#dens_blk_dns"]);
                hideElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn","#dens_blk_vol","#mass_unt","#dens_unt"]);
            });
            document.getElementById('mass').addEventListener('click',function(){
                document.getElementById('mass').classList.add('tagsUnit');
                document.getElementById('volume').classList.remove('tagsUnit');
                document.getElementById('density').classList.remove('tagsUnit');
                document.getElementById('to_cals').value = "mass";
                showElements(["#mass_unt","#dens_blk_dns","#dens_blk_vol"]);
                hideElements(["#dens_adv_vol", "#dens_blk_hgt", "#dens_blk_wdt","#dens_blk_lgn","#dens_blk_mas","#dens_unt","#volu_unt"]);
            });

            showElements(["#dens_cat_mtl"]);
            hideElements(["#dens_cat_mtl_no", "#dens_cat_gas", "#dens_cat_lqd","#dens_cat_astr"]);

            document.querySelectorAll(".dens_lok_answer").forEach(function(element) {
                element.addEventListener("change", function() {
                    var dens_lok_unt = document.querySelector("#dens_lok_unt select").value;
                    var dens_lok_cat = document.querySelector("#dens_lok_cat select").value;
                    var dens_val;

                    if (dens_lok_cat === "metals") {
                        var dens_cat_mtl = document.querySelector("#dens_cat_mtl select").value;
                        showElements(["#dens_cat_mtl"]);
                        hideElements(["#dens_cat_mtl_no", "#dens_cat_gas", "#dens_cat_lqd","#dens_cat_astr"]);
                        if (dens_cat_mtl === "aluminum") dens_val = "2700";
                        else if (dens_cat_mtl === "beryllium") dens_val = "1850";
                        else if (dens_cat_mtl === "brass") dens_val = "8600";
                        else if (dens_cat_mtl === "copper") dens_val = "8940";
                        else if (dens_cat_mtl === "gold") dens_val = "19320";
                        else if (dens_cat_mtl === "iron") dens_val = "7870";
                        else if (dens_cat_mtl === "lead") dens_val = "11340";
                        else if (dens_cat_mtl === "magnesium") dens_val = "1740";
                        else if (dens_cat_mtl === "mercury") dens_val = "13546";
                        else if (dens_cat_mtl === "nickel") dens_val = "8900";
                        else if (dens_cat_mtl === "platium") dens_val = "21450";
                        else if (dens_cat_mtl === "plutonium") dens_val = "19840";
                        else if (dens_cat_mtl === "potassium") dens_val = "860";
                        else if (dens_cat_mtl === "silver") dens_val = "10500";
                        else if (dens_cat_mtl === "sodium") dens_val = "970";
                        else if (dens_cat_mtl === "tin") dens_val = "7310";
                        else if (dens_cat_mtl === "titanium") dens_val = "240";
                        else if (dens_cat_mtl === "uranium") dens_val = "18800";
                        else if (dens_cat_mtl === "zinc") dens_val = "7000";
                    } else if (dens_lok_cat === "non-metals") {
                        showElements(["#dens_cat_mtl_no"]);
                        hideElements(["#dens_cat_mtl", "#dens_cat_gas", "#dens_cat_lqd","#dens_cat_astr"]);
                        var dens_cat_mtl_no = document.querySelector("#dens_cat_mtl_no select").value;
                        if (dens_cat_mtl_no === "concrete") dens_val = "2400";
                        else if (dens_cat_mtl_no === "cork") dens_val = "240";
                        else if (dens_cat_mtl_no === "diamond") dens_val = "3500";
                        else if (dens_cat_mtl_no === "ice") dens_val = "916.7";
                        else if (dens_cat_mtl_no === "nylon") dens_val = "1150";
                        else if (dens_cat_mtl_no === "oak") dens_val = "710";
                        else if (dens_cat_mtl_no === "pine") dens_val = "373";
                        else if (dens_cat_mtl_no === "plastics") dens_val = "1175";
                        else if (dens_cat_mtl_no === "styrofoam") dens_val = "75";
                        else if (dens_cat_mtl_no === "wood") dens_val = "700";
                    } else if (dens_lok_cat === "gases") {
                        showElements(["#dens_cat_gas"]);
                        hideElements(["#dens_cat_mtl_no", "#dens_cat_mtl", "#dens_cat_lqd","#dens_cat_astr"]);
                        var dens_cat_gas = document.querySelector("#dens_cat_gas select").value;
                        if (dens_cat_gas === "air0") dens_val = "1.293";
                        else if (dens_cat_gas === "air20") dens_val = "1.205";
                        else if (dens_cat_gas === "carbon_dioxide0") dens_val = "1.977";
                        else if (dens_cat_gas === "carbon_dioxide20") dens_val = "1.842";
                        else if (dens_cat_gas === "carbon_monoxide0") dens_val = "1.25";
                        else if (dens_cat_gas === "carbon_monoxide20") dens_val = "1.165";
                        else if (dens_cat_gas === "hydrogen") dens_val = "0.0898";
                        else if (dens_cat_gas === "helium") dens_val = "0.179";
                        else if (dens_cat_gas === "methane0") dens_val = "0.717";
                        else if (dens_cat_gas === "methane20") dens_val = "0.688";
                        else if (dens_cat_gas === "nitrogen0") dens_val = "1.2506";
                        else if (dens_cat_gas === "nitrogen20") dens_val = "1.165";
                        else if (dens_cat_gas === "oxygen0") dens_val = "1.429";
                        else if (dens_cat_gas === "oxygen20") dens_val = "1.331";
                        else if (dens_cat_gas === "propane20") dens_val = "1.882";
                        else if (dens_cat_gas === "water_vapor") dens_val = "0.804";
                    } else if (dens_lok_cat === "liquids") {
                        showElements(["#dens_cat_lqd"]);
                        hideElements(["#dens_cat_mtl_no", "#dens_cat_gas", "#dens_cat_mtl","#dens_cat_astr"]);
                        var dens_cat_lqd = document.querySelector("#dens_cat_lqd select").value;
                        if (dens_cat_lqd === "cooking_oil") dens_val = "920";
                        else if (dens_cat_lqd === "liquid_hydrogen") dens_val = "70";
                        else if (dens_cat_lqd === "liquid_oxygen") dens_val = "1141";
                        else if (dens_cat_lqd === "water_fresh") dens_val = "1000";
                        else if (dens_cat_lqd === "water_salt") dens_val = "1030";
                    } else if (dens_lok_cat === "astronomy") {
                        showElements(["#dens_cat_astr"]);
                        hideElements(["#dens_cat_mtl_no", "#dens_cat_gas", "#dens_cat_lqd","#dens_cat_mtl"]);
                        var dens_cat_astr = document.querySelector("#dens_cat_astr select").value;
                        if (dens_cat_astr === "earth") dens_val = "5515";
                        else if (dens_cat_astr === "earth_core") dens_val = "13000";
                        else if (dens_cat_astr === "sun_core_min") dens_val = "33000";
                        else if (dens_cat_astr === "sun_core_max") dens_val = "160000";
                        else if (dens_cat_astr === "super_black_hole") dens_val = "900000";
                        else if (dens_cat_astr === "dwarf_star") dens_val = "2100000000";
                        else if (dens_cat_astr === "atomic_nuclei") dens_val = "230000000000000000";
                        else if (dens_cat_astr === "neutron_star") dens_val = "480000000000000000";
                        else if (dens_cat_astr === "stellar_black_hole") dens_val = "1000000000000000000";
                    }

                    if (dens_lok_unt === "kg/dm³" || dens_lok_unt === "kg/L" || dens_lok_unt === "g/mL" || dens_lok_unt === "t/m³" || dens_lok_unt === "g/cm³") {
                        dens_val = dens_val / 1000;
                    } else if (dens_lok_unt === "oz/cu_in") {
                        dens_lok_unt = "oz/cu in";
                        dens_val = dens_val / 1730;
                    } else if (dens_lok_unt === "lb/cu_in") {
                        dens_lok_unt = "lb/cu in";
                        dens_val = dens_val / 27680;
                    } else if (dens_lok_unt === "lb/cu_ft") {
                        dens_lok_unt = "lb/cu ft";
                            dens_val = dens_val / 16.018;
                        } else if (dens_lok_unt === "lb/cu_yd") {
                            dens_lok_unt = "lb/cu yd";
                            dens_val = dens_val * 1.6855549959513;
                        } else if (dens_lok_unt === "lb/us_gal") {
                            dens_lok_unt = "lb/US gal";
                            dens_val = dens_val / 120;
                        } else if (dens_lok_unt === "g/l") {
                            dens_lok_unt = "g/L";
                            dens_val = dens_val;
                        } else if (dens_lok_unt === "g/dl") {
                            dens_lok_unt = "g/dL";
                            dens_val = dens_val / 10;
                        } else if (dens_lok_unt === "mg/l") {
                            dens_lok_unt = "mg/L";
                            dens_val = dens_val * 1000;
                        }

                    document.querySelector(".dens_lok_ansr").innerHTML = dens_val + " " + dens_lok_unt;
                });
            });
        </script>
    @endpush