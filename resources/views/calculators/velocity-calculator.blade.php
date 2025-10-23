<style>
    @media (max-width: 380px) {
        .calculator-box{
            padding-left: 0.5rem; 
            padding-right: 0.5rem; 
        }
    }
    .velocitytab .v_active{
        border-bottom: 3px solid var(--light-blue);
    }
    .velocitytab .v_active strong{
        color: var(--light-blue);
    }
    .velocitytab p{
        position: relative;
        top: 2px;
    }
    .active{
        background-color: var(--light-blue);;
        color: white;
    }
    #onetw{
        outline: 0
    }
    .katex{
        text-align: left !important;
    }
    .gap-2{
        gap : 4px;
    }
    .time_add, .addedRows .input-unit{
        right: 6px;
        top: 19px;
        font-size: 14px;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="col-12 col-lg-9 mx-auto">
        <div class="row">
            @if(isset($error))
                <p class="font-s-18 text-center"><strong class="text-danger">{{ $error }}</strong></p>
            @endif
            <div class="col-lg-12 px-lg-2 mx-auto">
                <div class="row align-items-center">
                    <div class="col-lg-8 mx-auto">
                        <div class="d-flex {{$device == 'desktop' ? 'justify-content-between' : 'justify-content-between' }} font-s-14 velocitytab border-b-dark position-relative">
                            <p class="cursor-pointer veloTabs {{ isset($_POST['velo_value']) && $_POST['velo_value'] !== '1' ? ''  : 'v_active' }} " id="distanceTab"><strong>{{ $lang['d_c'] }}</strong></p>
                            <p class="cursor-pointer veloTabs {{ isset($_POST['velo_value']) && $_POST['velo_value'] == '2' ? 'v_active'  : '' }} " id="accTab"><strong>{{ $lang['a'] }}</strong></p>
                            <p class="cursor-pointer veloTabs {{ isset($_POST['velo_value']) && $_POST['velo_value'] == '3' ? 'v_active'  : '' }} " id="timeTab"><strong>{{ $lang['av'] }}</strong></p>
                        </div>
                    </div>
                    <input type="hidden" name="velo_value" id="velo_value" value="{{ isset($_POST['velo_value'])?$_POST['velo_value']:'1' }}">
                </div>
            </div>
            <div class="row distance_co mt-3">
                <div>
                    <div class="col-lg-6 px-2">
                        <label for="dimension" class="font-s-14 text-blue">{{ $lang['to_calc'] ?? 'To calculate' }}</label>
                        <div class="w-100 py-2 position-relative">
                            <select name="dem" id="dimension" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name = [$lang['d'],$lang['v'],$lang['t']];
                                    $val = ["dc","av",'t'];
                                    optionsList($val,$name,isset($_POST['dem'])?$_POST['dem']:'av');
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 px-2" id="distance">
                    <label for="x" class="font-s-14 text-blue">{{ $lang['d'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" type="any" name="x" required id="x" class="input" value="{{ isset($_POST['x'])?$_POST['x']:'' }}" aria-label="input" placeholder="00" />
                        <label for="dis_unit" class="text-blue input-unit dis_unit1 text-decoration-underline">{{ isset($_POST['dis_unit'])?$_POST['dis_unit']:'m' }} ▾</label>
                        <input type="text" name="dis_unit" value="{{ isset($_POST['dis_unit'])?$_POST['dis_unit']:'m' }}" id="dis_unit" class="d-none">
                        <div class="units dis_unit d-none" to="dis_unit">
                            <p value="in">in</p>
                            <p value="ft">ft</p>
                            <p value="yd">yd</p>
                            <p value="m">m</p>
                            <p value="cm">cm</p>
                            <p value="km">km</p>
                            <p value="mi">mi</p>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-6 px-2 d-none" id="velocity">
                    <label for="z" class="font-s-14 text-blue">{{ $lang['v'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" type="any" name="vel" id="z" class="input" value="{{ isset(request()->vel)?request()->vel : '' }}" aria-label="input" placeholder="00" />
                        <label for="val_units" class="text-blue input-unit text-decoration-underline">{{ isset(request()->val_units)?request()->val_units:'m/s' }} ▾</label>
                        <input type="text" name="val_units" value="{{ isset(request()->val_units)?request()->val_units:'m/s' }}" id="val_units" class="d-none">
                        <div class="units val_units d-none" to="val_units">
                            <p value="m/s">m/s</p>
                            <p value="km/h">km/h</p>
                            <p value="ft/s">ft/s</p>
                            <p value="mph">mph</p>
                            <p value="kn">kn</p>
                            <p value="ft/m">ft/m</p>
                            <p value="cm/s">cm/s</p>
                            <p value="m/min">m/min</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 px-2" id="times">
                    <label for="y" class="font-s-14 text-blue">{{ $lang['t'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" type="any" name="y" required id="y" class="input" value="{{ isset($_POST['y'])?$_POST['y']:'' }}" aria-label="input" placeholder="00" />
                        <label for="time_unit" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['time_unit'])?$_POST['time_unit']:'sec' }} ▾</label>
                        <input type="text" name="time_unit" value="{{ isset($_POST['time_unit'])?$_POST['time_unit']:'sec' }}" id="time_unit" class="d-none">
                        <div class="units time_unit d-none" to="time_unit">
                            <p value="sec">sec</p>
                            <p value="min">min</p>
                            <p value="hrs">hrs</p>
                            <p value="days">days</p>
                            <p value="wks">wks</p>
                            <p value="mos">mos</p>
                            <p value="yrs">yrs</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="average_acceleration d-none row mt-3">
                <div class="col-lg-6 px-2">
                    <label for="z" class="font-s-14 text-blue">{{ $lang['v'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" type="any" name="z[]" id="zs" class="input" value="{{ isset(request()->z)?request()->z[0]:'' }}" aria-label="input" placeholder="00" />
                        <label for="val_unit" class="text-blue input-unit text-decoration-underline">{{ isset(request()->val_unit)?request()->val_unit[0]:'m/s' }} ▾</label>
                        <input type="text" name="val_unit[]" value="{{ isset(request()->val_unit)?request()->val_unit[0]:'m/s' }}" id="val_unit" class="d-none">
                        <div class="units val_unit d-none" to="val_unit">
                            <p value="m/s">m/s</p>
                            <p value="km/h">km/h</p>
                            <p value="ft/s">ft/s</p>
                            <p value="mph">mph</p>
                            <p value="kn">kn</p>
                            <p value="ft/m">ft/m</p>
                            <p value="cm/s">cm/s</p>
                            <p value="m/min">m/min</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 px-2">
                    <label for="ys" class="font-s-14 text-blue">{{ $lang['t'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" type="any" name="aty[]" id="ys" class="input" value="{{ isset(request()->aty)?request()->aty[0]:'' }}" aria-label="input" placeholder="00" />
                        <label for="ytime_unit" class="text-blue input-unit text-decoration-underline">{{ isset(request()->ytime_unit)?request()->ytime_unit[0]:'sec' }} ▾</label>
                        <input type="text" name="ytime_unit[]" value="{{ isset(request()->ytime_unit)?request()->ytime_unit[0]:'sec' }}" id="time_unit" class="d-none">
                        <div class="units ytime_unit d-none" to="ytime_unit">
                            <p value="sec">sec</p>
                            <p value="min">min</p>
                            <p value="hrs">hrs</p>
                            <p value="days">days</p>
                            <p value="wks">wks</p>
                            <p value="mos">mos</p>
                            <p value="yrs">yrs</p>
                        </div>
                    </div>
                </div>
                
                <div class="row time_add">
                    @if(request()->z && count(request()->aty) >= 1)
                        @php $j = 1; @endphp
                        @foreach (request()->z as $key => $value)
                            @if($key > 0)
                                <div class="row addedRows">
                                    <div class="col-lg-6 px-2">
                                        <label for="z{{ $j }}" class="font-s-14 text-blue">{{ $lang['v'] }} {{ $j }}</label>
                                        <div class="w-100 py-2 position-relative">
                                            <input type="number" name="z[]" id="z{{ $j }}" class="input" 
                                                value="{{ old("z.$key", request()->z[$key] ?? '') }}" 
                                                aria-label="input" placeholder="00"/>
                                            <label for="val_unit{{ $j }}" class="text-blue input-unit text-decoration-underline">
                                                {{ old("val_unit.$key", request()->val_unit[$key] ?? 'm/s') }} ▾
                                            </label>
                                            <input type="text" name="val_unit[]" value="{{ old("val_unit.$key", request()->val_unit[$key] ?? 'm/s') }}" id="val_unit{{ $j }}" class="d-none">
                                            <div class="units val_unit{{ $j }} d-none" to="val_unit{{ $j }}">
                                                <p value="m/s">m/s</p>
                                                <p value="km/h">km/h</p>
                                                <p value="ft/s">ft/s</p>
                                                <p value="mph">mph</p>
                                                <p value="kn">kn</p>
                                                <p value="ft/m">ft/m</p>
                                                <p value="cm/s">cm/s</p>
                                                <p value="m/min">m/min</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 px-2">
                                        <label for="y{{ $j }}" class="font-s-14 text-blue">{{ $lang['t'] }} {{ $j }}</label>
                                        <div class="w-100 py-2 position-relative">
                                            <input type="number" name="aty[]" id="y{{ $j }}" class="input" 
                                                value="{{ old("aty.$key", request()->aty[$key] ?? '') }}" 
                                                aria-label="input" placeholder="00"/>
                                            <label for="ytime_unit{{ $j }}" class="text-blue input-unit text-decoration-underline">
                                                {{ old("ytime_unit.$key", request()->ytime_unit[$key] ?? 's') }} ▾
                                            </label>
                                            <input type="text" name="ytime_unit[]" value="{{ old("ytime_unit.$key", request()->ytime_unit[$key] ?? 's') }}" id="ytime_unit{{ $j }}" class="d-none">
                                            <div class="units ytime_unit{{ $j }} d-none" to="ytime_unit{{ $j }}">
                                                <p value="sec">sec</p>
                                                <p value="min">min</p>
                                                <p value="hrs">hrs</p>
                                                <p value="days">days</p>
                                                <p value="wks">wks</p>
                                                <p value="mos">mos</p>
                                                <p value="yrs">yrs</p>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <button type="button" class="remove cursor-pointer my-auto mb-4 text-danger border-0 bg-transparent">✖</button> --}}
                                </div>
                            @php $j++; @endphp
                            @endif
                        @endforeach
                    @endif
                    
                </div>
                <div class="col-6 time_due px-2">
                    <button type="button" title="Add New Semester" class="active p-2 border radius-5 cursor-pointer add_semester "><b class="text-white">+ <?=$lang['adrow']?></b></button>
                </div>
            </div>

            <div class="acceleration d-none mt-3">
                <div class="col-lg-6 px-lg-2">
                    <label for="collection" class="font-s-14 text-blue">{{ $lang['to_calc'] ?? 'To calculate' }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="collection" id="collection" class="input">
                            @php
                                $name = [$lang['i_v'],$lang['f_v'],$lang['a'],$lang['t']];
                                $val = ["1","2","3","4"];
                                optionsList($val,$name,isset($_POST['collection'])?$_POST['collection']:'2');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 px-lg-2" id="intial">
                        <label for="x1" class="font-s-14 text-blue">{{ $lang['i_v'] }}</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" type="any" name="x1" id="x1" class="input" value="{{ isset($_POST['x1'])?$_POST['x1']:'' }}" aria-label="input" placeholder="00"/>
                            <label for="iv_unit" class="text-blue input-unit iv_unit1 text-decoration-underline">{{ isset($_POST['iv_unit'])?$_POST['iv_unit']:'m/s' }} ▾</label>
                            <input type="text" name="iv_unit" value="{{ isset($_POST['iv_unit'])?$_POST['iv_unit']:'m/s' }}" id="iv_unit" class="d-none">
                            <div class="units iv_unit d-none" to="iv_unit">
                                <p value="m/s">m/s</p>
                                <p value="km/h">km/h</p>
                                <p value="ft/s">ft/s</p>
                                <p value="mph">mph</p>
                                <p value="kn">kn</p>
                                <p value="ft/m">ft/m</p>
                                <p value="cm/s">cm/s</p>
                                <p value="m/min">m/min</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 px-lg-2 d-none" id="final">
                        <label for="z1" class="font-s-14 text-blue">{{ $lang['f_v'] }}</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" type="any" name="z1" id="z1" class="input" value="{{ isset($_POST['z1'])?$_POST['z1']:'' }}" aria-label="input" placeholder="00"/>
                            <label for="fv_unit" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['fv_unit'])?$_POST['fv_unit']:'m/s' }} ▾</label>
                            <input type="text" name="fv_unit" value="{{ isset($_POST['fv_unit'])?$_POST['fv_unit']:'m/s' }}" id="fv_unit" class="d-none">
                            <div class="units fv_unit d-none" to="fv_unit">
                                <p value="m/s">m/s</p>
                                <p value="km/h">km/h</p>
                                <p value="ft/s">ft/s</p>
                                <p value="mph">mph</p>
                                <p value="kn">kn</p>
                                <p value="ft/m">ft/m</p>
                                <p value="cm/s">cm/s</p>
                                <p value="m/min">m/min</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 px-lg-2" id="time">
                        <label for="y1" class="font-s-14 text-blue">{{ $lang['t'] }}</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" type="any" name="y1" id="y1" class="input" value="{{ isset($_POST['y1'])?$_POST['y1']:'' }}" aria-label="input" placeholder="00"/>
                            <label for="atime_unit" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['atime_unit'])?$_POST['atime_unit']:'sec' }} ▾</label>
                            <input type="text" name="atime_unit" value="{{ isset($_POST['atime_unit'])?$_POST['atime_unit']:'sec' }}" id="atime_unit" class="d-none">
                            <div class="units atime_unit d-none" to="atime_unit">
                                <p value="sec">sec</p>
                                <p value="min">min</p>
                                <p value="hrs">hrs</p>
                                <p value="days">days</p>
                                <p value="wks">wks</p>
                                <p value="mos">mos</p>
                                <p value="yrs">yrs</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 px-lg-2" id="accele">
                        <label for="acc" class="font-s-14 text-blue">{{ $lang['a'] }}</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" type="any" name="acc" id="acc" class="input" value="{{ isset($_POST['acc'])?$_POST['acc']:'' }}" aria-label="input" placeholder="00"/>
                            <label for="acc_unit" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['acc_unit'])?$_POST['acc_unit']:'m/s²' }} ▾</label>
                            <input type="text" name="acc_unit" value="{{ isset($_POST['acc_unit'])?$_POST['acc_unit']:'m/s²' }}" id="acc_unit" class="d-none">
                            <div class="units acc_unit d-none" to="acc_unit">
                                <p value="in/s²">in/s²</p>
                                <p value="ft/s²">ft/s²</p>
                                <p value="cm/s²">cm/s²</p>
                                <p value="m/s²">m/s²</p>
                                <p value="mi/s²">mi/s²</p>
                                <p value="km/s²">km/s²</p>
                                <p value="g">g</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($type=='calculator')
                @include('inc.button')
            @endif
            @if ($type=='widget')
                @include('inc.widget-button')
            @endif
        </div>
    </div>
    @isset($detail)
        <div class="col-12 bg-light-blue result p-3 radius-10 mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <p class="text-blue font-s-21"><strong>{{ $lang['res'] }}:</strong></p>
                @if ($type=='calculator')
                    @include('inc.copy-pdf')
                @endif      
            </div>
            @php
                $ans_t = $detail['ans_t'];
                $unit = $detail['unit'];
            @endphp
            <div class="row">
                <div class="text-center">
                    <p class="font-s-18">
                        <strong>{{ $detail['ans_t'] }}</strong>
                    </p>
                    <div class="font-s-25 bg-white px-3 py-2 radius-10 d-inline-block my-3">
                        <strong class="text-blue answer" id="circle_result">{{ $detail['ans'] }}</strong>
                        <select name="circle_unit_result" id="onetw" class="d-inline border-0 text-blue outline-0 font-s-16">
                            @php
                                if($detail['ans_t'] == 'Distance'){
                                    $name = ["m","cm","in","ft","yd","km","mi"];
                                    $val = ["m","cm","in","ft","yd","km","mi"];
                                }elseif($ans_t == 'Final Velocity' || $ans_t == 'Initial Velocity' || $ans_t == 'Velocity' || $ans_t == 'Avrage Velocity') {
                                    $name = ["m/s","km/h","ft/s","mph","kn","ft/m","cm/s"];
                                    $val = ["m/s","km/h","ft/s","mph","kn","ft/m","cm/s"];
                                }elseif($ans_t == 'Time'){
                                    $name = ["sec","min","hrs","days","weeks","months","year"];
                                    $val = ["s","m","h","d","w","mo","y"];
                                }elseif($ans_t == 'Acceleration'){
                                    $name = ["m/s²","cm/s²","in/s²","ft/s²","km/s²","mi/s²","g"];
                                    $val = ["m/s²","cm/s²","in/s²","ft/s²","km/s²","mi/s²","g"];
                                }
                                optionsList($val,$name,"1");
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="{{ url('katex/katex.min.js') }}"></script>
    <script defer src="{{ url('katex/auto-render.min.js') }}" 
    onload="renderMathInElement(document.body);"></script>     
    <script>
        @if(isset($detail))
            const time_type =  document.getElementById('velo_value').value;
            document.addEventListener("DOMContentLoaded", () => {
                // Conversion factors for different units and types
                const conversionFactors = {
                    'Distance': {
                        'm': 1,
                        'cm': 100,
                        'in': 39.3701,
                        'ft': 3.28084,
                        'yd': 1.09361,
                        'km': 0.001,
                        'mi': 0.000621371
                    },
                    'Velocity': {
                        'm/s': 1,
                        'km/h': 3.6,
                        'ft/s': 3.28084,
                        'mph': 2.23694,
                        'kn': 1.94384,
                        'ft/m': 196.8504,
                        'cm/s': 100,
                        'm/min': 60
                    },
                    'Avrage Velocity': {
                        'm/s': 1,
                        'km/h': 3.6,
                        'ft/s': 3.28084,
                        'mph': 2.23694,
                        'kn': 1.94384,
                        'ft/m': 196.8504,
                        'cm/s': 100,
                        'm/min': 60
                    },
                    'Final Velocity': {
                        'm/s': 1,
                        'km/h': 3.6,
                        'ft/s': 3.28084,
                        'mph': 2.23694,
                        'kn': 1.94384,
                        'ft/m': 196.8504,
                        'cm/s': 100,
                        'm/min': 60
                    },
                    'Initial Velocity': {
                        'm/s': 1,
                        'km/h': 3.6,
                        'ft/s': 3.28084,
                        'mph': 2.23694,
                        'kn': 1.94384,
                        'ft/m': 196.8504,
                        'cm/s': 100,
                        'm/min': 60
                    },
                    'Time': {
                        's': 1,
                        'm': 60,
                        'h': 3600,
                        'd': 86400,
                        'w': 604800,
                        'mo': 2.628e+6,
                        'y': 3.154e+7,
                    },
                    'Acceleration': {
                        'm/s²': 1,
                        'cm/s²': 100,
                        'in/s²': 39.3701,
                        'ft/s²': 3.28084,
                        'yd/s²': 1.09361,
                        'km/s²': 0.001,
                        'mi/s²': 0.000621371,
                        'g': 	0.10197162129779
                    }
                };

                const circleResultDiv = document.getElementById('circle_result');
                const initialValue = parseFloat(circleResultDiv.innerText);
                circleResultDiv.setAttribute('data-initial-value', initialValue);

                document.getElementById('onetw').addEventListener('change', event => {
                    const unitType = "{{ $ans_t }}"; // PHP variable for the unit type
                    const unit = event.target.value;
                    
                    if (unitType == 'Time' && conversionFactors[unitType][unit] !== undefined) {
                        console.log(unitType);
                        const conversionFactor = conversionFactors[unitType][unit];
                        const originalValue = parseFloat(circleResultDiv.getAttribute('data-initial-value'));
                        const newValue = originalValue / conversionFactor;
                        circleResultDiv.innerText = Number(newValue.toFixed(10)).toString();
                    }else if (conversionFactors[unitType] && conversionFactors[unitType][unit] !== undefined) {
                        const conversionFactor = conversionFactors[unitType][unit];
                        const originalValue = parseFloat(circleResultDiv.getAttribute('data-initial-value'));
                        const newValue = originalValue * conversionFactor;
                        circleResultDiv.innerText = Number(newValue.toFixed(10)).toString();
                    } else {
                        console.error("Invalid conversion factor for unit: " + unit);
                    }
                });
            });
            if (time_type == 1) {
                document.getElementById('velo_value').value = 1;
                document.querySelector('.distance_co').classList.remove('d-none');
                document.querySelector('.acceleration').classList.add('d-none');
                document.querySelector('.average_acceleration').classList.add('d-none');
                document.querySelectorAll('#ys,#zs,#x1,#y1,#z1,#acc').forEach(element => {
                    element.removeAttribute('required', '');
                });
                document.querySelectorAll('#x, #y').forEach(element => {
                    element.setAttribute('required', '');
                });
                var dimension = document.getElementById('dimension').value;
                if(dimension == 'dc'){
                    document.getElementById('distance').classList.add('d-none');
                    document.getElementById('velocity').classList.remove('d-none');
                    document.getElementById('times').classList.remove('d-none');
                    document.querySelectorAll('#z, #y').forEach(element => {
                        element.setAttribute('required', '');
                    });
                    document.querySelectorAll('#z').forEach(element => {
                        element.removeAttribute('required', '');
                    });
                }else if(dimension == 'av'){
                    document.getElementById('velocity').classList.add('d-none');
                    document.getElementById('distance').classList.remove('d-none');
                    document.getElementById('times').classList.remove('d-none');
                    document.querySelectorAll('#x, #y').forEach(element => {
                        element.setAttribute('required', '');
                    });
                    document.querySelectorAll('#z').forEach(element => {
                        element.removeAttribute('required', '');
                    });
                }else{
                    document.getElementById('times').classList.add('d-none');
                    document.getElementById('velocity').classList.remove('d-none');
                    document.getElementById('distance').classList.remove('d-none');
                    document.querySelectorAll('#z, #z').forEach(element => {
                        element.setAttribute('required', '');
                    });
                    document.querySelectorAll('#y').forEach(element => {
                        element.removeAttribute('required', '');
                    });
                }
            } else if (time_type == 2) {
                document.getElementById('velo_value').value = 2;
                document.querySelector('.average_acceleration').classList.add('d-none');
                document.querySelector('.distance_co').classList.add('d-none');
                document.querySelector('.acceleration').classList.remove('d-none');
                document.querySelectorAll('#acc,#y1,#x1').forEach(element => {
                    element.setAttribute('required', '');
                });
                document.querySelectorAll('#x,#y,#z,#z1,#acc').forEach(element => {
                    element.removeAttribute('required', '');
                });
                var collection = document.getElementById('collection').value;
                if(collection == '1'){
                    console.log(collection);
                    document.getElementById('accele').classList.remove('d-none');
                    document.getElementById('intial').classList.add('d-none');
                    document.getElementById('final').classList.remove('d-none');
                    document.getElementById('time').classList.remove('d-none');
                    document.querySelectorAll('#acc,#y1,#z1').forEach(element => {
                        element.setAttribute('required', '');
                    });
                    document.querySelectorAll('#x1').forEach(element => {
                        element.removeAttribute('required', '');
                    });
                }else if(collection == '2'){
                    document.getElementById('accele').classList.remove('d-none');
                    document.getElementById('intial').classList.remove('d-none');
                    document.getElementById('final').classList.add('d-none');
                    document.getElementById('time').classList.remove('d-none');
                    document.querySelectorAll('#x1,#y1,#acc').forEach(element => {
                        element.setAttribute('required', '');
                    });
                    document.querySelectorAll('#z1').forEach(element => {
                        element.removeAttribute('required', '');
                    });
                }else if(collection == '3'){
                    document.getElementById('accele').classList.add('d-none');
                    document.getElementById('intial').classList.remove('d-none');
                    document.getElementById('final').classList.remove('d-none');
                    document.getElementById('time').classList.remove('d-none');
                    document.querySelectorAll('#x1,#y1,#z1').forEach(element => {
                        element.setAttribute('required', '');
                    });
                    document.querySelectorAll('#acc').forEach(element => {
                        element.removeAttribute('required', '');
                    });
                }else {
                    document.getElementById('accele').classList.remove('d-none');
                    document.getElementById('intial').classList.remove('d-none');
                    document.getElementById('final').classList.remove('d-none');
                    document.getElementById('time').classList.add('d-none');
                    document.querySelectorAll('#acc,#x1,#z1').forEach(element => {
                        element.setAttribute('required', '');
                    });
                    document.querySelectorAll('#y1').forEach(element => {
                        element.removeAttribute('required', '');
                    });
                }
            } else if (time_type == 3) {
                document.getElementById('velo_value').value = 3;
                document.querySelector('.average_acceleration').classList.remove('d-none');
                document.querySelector('.distance_co').classList.add('d-none');
                document.querySelector('.acceleration').classList.add('d-none');
                document.querySelectorAll('#zs, #ys').forEach(element => {
                    element.setAttribute('required', '');
                });
                document.querySelectorAll('#x1,#y1,#z1,#acc,#x,#y,#z').forEach(element => {
                    element.removeAttribute('required', '');
                });
            }
        @endif
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.veloTabs');
            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    tabs.forEach(t => t.classList.remove('v_active'));
                    tab.classList.add('v_active');
                    let time_type;
                    if (tab.id == 'distanceTab') {
                        time_type = 1;
                    } else if (tab.id == 'accTab') {
                        time_type = 2;
                    } else if (tab.id == 'timeTab') {
                        time_type = 3;
                    }
                    if (time_type == 1) {
                        document.getElementById('velo_value').value = 1;
                        document.querySelector('.distance_co').classList.remove('d-none');
                        document.querySelector('.acceleration').classList.add('d-none');
                        document.querySelector('.average_acceleration').classList.add('d-none');
                        document.querySelectorAll('#ys,#zs,#x1,#y1,#z1,#acc').forEach(element => {
                            element.removeAttribute('required', '');
                        });
                        document.querySelectorAll('#x, #y').forEach(element => {
                            element.setAttribute('required', '');
                        });
                        document.getElementById('dimension').addEventListener('change', function(){
                            var value = this.value;
                            if(value == 'dc'){
                                document.getElementById('distance').classList.add('d-none');
                                document.getElementById('velocity').classList.remove('d-none');
                                document.getElementById('times').classList.remove('d-none');
                                document.querySelectorAll('#z, #y').forEach(element => {
                                    element.setAttribute('required', '');
                                });
                                document.querySelectorAll('#z').forEach(element => {
                                    element.removeAttribute('required', '');
                                });
                            }else if(value == 'av'){
                                document.getElementById('velocity').classList.add('d-none');
                                document.getElementById('distance').classList.remove('d-none');
                                document.getElementById('times').classList.remove('d-none');
                                document.querySelectorAll('#x, #y').forEach(element => {
                                    element.setAttribute('required', '');
                                });
                                document.querySelectorAll('#z').forEach(element => {
                                    element.removeAttribute('required', '');
                                });
                            }else{
                                document.getElementById('times').classList.add('d-none');
                                document.getElementById('velocity').classList.remove('d-none');
                                document.getElementById('distance').classList.remove('d-none');
                                document.querySelectorAll('#z, #z').forEach(element => {
                                    element.setAttribute('required', '');
                                });
                                document.querySelectorAll('#y').forEach(element => {
                                    element.removeAttribute('required', '');
                                });
                            }
                        }); 
                    } else if (time_type == 2) {
                        document.getElementById('velo_value').value = 2;
                        
                        document.querySelector('.average_acceleration').classList.add('d-none');
                        document.querySelector('.distance_co').classList.add('d-none');
                        document.querySelector('.acceleration').classList.remove('d-none');
                        document.querySelectorAll('#acc,#y1,#x1').forEach(element => {
                            element.setAttribute('required', '');
                        });
                        document.querySelectorAll('#x,#y,#z,#z1,#acc,#ys,#zs').forEach(element => {
                            element.removeAttribute('required', '');
                        });
                        document.getElementById('collection').addEventListener('change', function(){
                            var collection = this.value;
                            if(collection == '1'){
                                console.log(collection);
                                document.getElementById('accele').classList.remove('d-none');
                                document.getElementById('intial').classList.add('d-none');
                                document.getElementById('final').classList.remove('d-none');
                                document.getElementById('time').classList.remove('d-none');
                                document.querySelectorAll('#acc,#y1,#z1').forEach(element => {
                                    element.setAttribute('required', '');
                                });
                                document.querySelectorAll('#x1').forEach(element => {
                                    element.removeAttribute('required', '');
                                });
                            }else if(collection == '2'){
                                document.getElementById('accele').classList.remove('d-none');
                                document.getElementById('intial').classList.remove('d-none');
                                document.getElementById('final').classList.add('d-none');
                                document.getElementById('time').classList.remove('d-none');
                                document.querySelectorAll('#x1,#y1,#acc').forEach(element => {
                                    element.setAttribute('required', '');
                                });
                                document.querySelectorAll('#z1').forEach(element => {
                                    element.removeAttribute('required', '');
                                });
                            }else if(collection == '3'){
                                document.getElementById('accele').classList.add('d-none');
                                document.getElementById('intial').classList.remove('d-none');
                                document.getElementById('final').classList.remove('d-none');
                                document.getElementById('time').classList.remove('d-none');
                                document.querySelectorAll('#x1,#y1,#z1').forEach(element => {
                                    element.setAttribute('required', '');
                                });
                                document.querySelectorAll('#acc').forEach(element => {
                                    element.removeAttribute('required', '');
                                });
                            }else {
                                document.getElementById('accele').classList.remove('d-none');
                                document.getElementById('intial').classList.remove('d-none');
                                document.getElementById('final').classList.remove('d-none');
                                document.getElementById('time').classList.add('d-none');
                                document.querySelectorAll('#acc,#x1,#z1').forEach(element => {
                                    element.setAttribute('required', '');
                                });
                                document.querySelectorAll('#y1').forEach(element => {
                                    element.removeAttribute('required', '');
                                });
                            }
                        }); 
                    } else if (time_type == 3) {
                        document.getElementById('velo_value').value = 3;
                        document.querySelector('.average_acceleration').classList.remove('d-none');
                        document.querySelector('.distance_co').classList.add('d-none');
                        document.querySelector('.acceleration').classList.add('d-none');
                        document.querySelectorAll('#zs, #ys').forEach(element => {
                            element.setAttribute('required', '');
                        });
                        document.querySelectorAll('#x1,#y1,#z1,#acc,#x,#y,#z').forEach(element => {
                            element.removeAttribute('required', '');
                        });
                    }
                });
            });
        });

        document.getElementById('dimension').addEventListener('change', function(){
            var value = this.value;
            if(value == 'dc'){
                document.getElementById('distance').classList.add('d-none');
                document.getElementById('velocity').classList.remove('d-none');
                document.getElementById('times').classList.remove('d-none');
                document.querySelectorAll('#z, #y').forEach(element => {
                    element.setAttribute('required', '');
                });
                document.querySelectorAll('#z').forEach(element => {
                    element.removeAttribute('required', '');
                });
            }else if(value == 'av'){
                document.getElementById('velocity').classList.add('d-none');
                document.getElementById('distance').classList.remove('d-none');
                document.getElementById('times').classList.remove('d-none');
                document.querySelectorAll('#x, #y').forEach(element => {
                    element.setAttribute('required', '');
                });
                document.querySelectorAll('#z').forEach(element => {
                    element.removeAttribute('required', '');
                });
            }else{
                document.getElementById('times').classList.add('d-none');
                document.getElementById('velocity').classList.remove('d-none');
                document.getElementById('distance').classList.remove('d-none');
                document.querySelectorAll('#z, #z').forEach(element => {
                    element.setAttribute('required', '');
                });
                document.querySelectorAll('#y').forEach(element => {
                    element.removeAttribute('required', '');
                });
            }
        }); 
        document.getElementById('collection').addEventListener('change', function(){
            var collection = this.value;
            if(collection == '1'){
                console.log(collection);
                document.getElementById('accele').classList.remove('d-none');
                document.getElementById('intial').classList.add('d-none');
                document.getElementById('final').classList.remove('d-none');
                document.getElementById('time').classList.remove('d-none');
                document.querySelectorAll('#acc,#y1,#z1').forEach(element => {
                    element.setAttribute('required', '');
                });
                document.querySelectorAll('#x1').forEach(element => {
                    element.removeAttribute('required', '');
                });
            }else if(collection == '2'){
                document.getElementById('accele').classList.remove('d-none');
                document.getElementById('intial').classList.remove('d-none');
                document.getElementById('final').classList.add('d-none');
                document.getElementById('time').classList.remove('d-none');
                document.querySelectorAll('#x1,#y1,#acc').forEach(element => {
                    element.setAttribute('required', '');
                });
                document.querySelectorAll('#z1').forEach(element => {
                    element.removeAttribute('required', '');
                });
            }else if(collection == '3'){
                document.getElementById('accele').classList.add('d-none');
                document.getElementById('intial').classList.remove('d-none');
                document.getElementById('final').classList.remove('d-none');
                document.getElementById('time').classList.remove('d-none');
                document.querySelectorAll('#x1,#y1,#z1').forEach(element => {
                    element.setAttribute('required', '');
                });
                document.querySelectorAll('#acc').forEach(element => {
                    element.removeAttribute('required', '');
                });
            }else {
                document.getElementById('accele').classList.remove('d-none');
                document.getElementById('intial').classList.remove('d-none');
                document.getElementById('final').classList.remove('d-none');
                document.getElementById('time').classList.add('d-none');
                document.querySelectorAll('#acc,#x1,#z1').forEach(element => {
                    element.setAttribute('required', '');
                });
                document.querySelectorAll('#y1').forEach(element => {
                    element.removeAttribute('required', '');
                });
            }
        }); 

        var j=1;
        document.querySelector('.add_semester').addEventListener('click',function(){
            // this.style.display = 'none';
            j++;
            add_semester(j);
        });
        function add_semester(count){
            var semester = `
                <div class="row addedRows">   
                    <div class="col-lg-6 px-2">
                        <label for="z${j}" class="font-s-14 text-blue">{{ $lang['v'] }} ${j}</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" name="z[]" id="z${j}" class="input" 
                                value="" 
                                aria-label="input" placeholder="00"/>
                            <label for="val_unit${j}" class="text-blue input-unit text-decoration-underline">m/s ▾</label>
                            <input type="text" name="val_unit[]" value="m/s" id="val_unit${j}" class="d-none">
                            <div class="units val_unit${j} d-none" to="val_unit${j}">
                                <p value="m/s">m/s</p>
                                <p value="km/h">km/h</p>
                                <p value="ft/s">ft/s</p>
                                <p value="mph">mph</p>
                                <p value="kn">kn</p>
                                <p value="ft/m">ft/m</p>
                                <p value="cm/s">cm/s</p>
                                <p value="m/min">m/min</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 px-2">
                        <label for="y${j}" class="font-s-14 text-blue">{{ $lang['t'] }} ${j}</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" name="aty[]" id="y${j}" class="input" value="" aria-label="input" placeholder="00"/>
                            <label for="ytime_unit${j}" class="text-blue input-unit text-decoration-underline">sec ▾</label>
                            <input type="text" name="ytime_unit[]" value="sec" id="ytime_unit${j}" class="d-none">
                            <div class="units ytime_unit${j} d-none" to="ytime_unit${j}">
                                <p value="sec">sec</p>
                                <p value="min">min</p>
                                <p value="hrs">hrs</p>
                                <p value="days">days</p>
                                <p value="wks">wks</p>
                                <p value="mos">mos</p>
                                <p value="yrs">yrs</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                    // <button type="button" class="remove cursor-pointer my-auto mb-4 text-danger border-0 bg-transparent">✖</button>
                    // <img src="{{ asset('assets/img/belete_btn.png') }}" width="15" height="15" class="remove cursor-pointer my-auto mb-4" alt="Delete" decoding="async" loading="lazy">
            // document.querySelector('.time_add').insertAdjacentHTML(semester);
            let semesterElement = document.createElement('div'); 
            semesterElement.innerHTML = semester;
            document.querySelector('.time_add').append(semesterElement);
        }
        document.addEventListener("click", function (event) {
            if (event.target.classList.contains("remove")) {
                event.target.closest(".addedRows").remove();
            }
        });
    </script>
@endpush