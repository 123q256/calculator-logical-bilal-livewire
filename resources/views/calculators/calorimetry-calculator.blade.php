<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))
       
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2 relative">
                    <label for="myselection" class="label">{{ $lang['50'] }}:</label>
                    <select name="state_change" id="myselection" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'],$lang['3']];
                            $val = ["a chemical reaction in a cofee cup calorimeter","heat exchange between several objects"];
                            optionsList($val,$name,isset(request()->state_change)?request()->state_change:'a chemical reaction in a cofee cup calorimeter');
                        @endphp
                    </select>
                </div>
              
                <div class="space-y-2  fimg3 hidden">
                    <label for="objects" class="label">{{ $lang['4'] }}:</label>
                        <select name="obj_units" id="objects" class="input">
                            @php
                                $name = [$lang['5'],$lang['6']];
                                $val = ["2","3"];
                                optionsList($val,$name,isset(request()->obj_units)?request()->obj_units:'2');
                            @endphp
                        </select>
                </div>
                <div class="space-y-2  state hidden">
                    <label for="obj_change" class="label">{{ $lang['7'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="state" id="obj_change" class="input">
                            @php
                                $name = [$lang['8'],$lang['10']];
                                $val = ["No","Yes,two times"];
                                optionsList($val,$name,isset(request()->state)?request()->state:'No');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="space-y-2  single_object">
                    <div class="grid grid-cols-1   gap-4">
                        <div class="space-y-2">
                            <label for="formula_change" class="label">{{ $lang['1'] }}:</label>
                                <select name="formula" id="formula_change" class="input">
                                    @php
                                        $name = [$lang['12'],$lang['13'],$lang['14'],$lang['15'],$lang['16'],$lang['17'],$lang['18']];
                                        $val = ["Heat Energy","Specific Heat","Mass","Initial_Temperature","Final_Temperature","Time_of_isolation","Enthalpy_change"];
                                        optionsList($val,$name,isset(request()->formula)?request()->formula:'Heat Energy');
                                    @endphp
                                </select>
                        </div>
                        <div class="space-y-2 my-2 by">
                            <span class="font-s-14 pe-2 pe-lg-3"><strong>{!! $lang['19'] !!}: </strong></span>
                            <input type="radio" name="type" class="with-gap" id="temp_change" value="temp_change" checked {!! isset(request()->type) && request()->type === 'temp_change' ? 'checked' : '' !!}>
                            <label for="temp_change" class="label pe-lg-3 pe-2">{!! $lang['20'] !!} (\(\Delta T\)):</label>
                           
                        </div>
                        <div class="space-y-2 px-[10px]  by">
                            <input type="radio" name="type" class="with-gap" id="i_f_temp" value="i_f_temp" {!! isset(request()->type) && request()->type === 'i_f_temp' ? 'checked' : '' !!}>
                            <label for="i_f_temp" class="label">{!! $lang['21'] !!}:</label>
                        </div>
                    </div>
                    <div class="grid grid-cols-4   gap-4">
                        <div class="col-span-3 mass">
                            <label for="mass" class="label">{!! $lang['23'] !!} (m):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="mass" id="mass" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mass)?request()->mass:'10' }}" />
                            </div>
                        </div>
                        <div class="col-span-1 mass">
                            <label for="m_units" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="m_units" id="m_units" class="input">
                                    @php
                                        $name = ["g", "pg", "ng", "μg", "mg", "dag", "kg", "t", "gr", "dr", "oz", "lb", "stone", "US ton","Long ton","u","oz t"];
                                        $val = ["grams (g)", "picograms (pg)", "nanograms (ng)", "milligrams (mg)", "decagrams (dag)", "kilograms (kg)", "metric tons (t)", "grains (gr)", "drachms (dr)", "ounces (oz)", "pounds (lb)", "stones (stone)", "US short tones (US ton)", "imperial tons (Long ton)","atomic mass unit (u)","troy ounce (oz t)"];
                                        optionsList($val,$name,isset(request()->m_units)?request()->m_units:'grams (g)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-3 s_h_c">
                            <label for="heat_capacity" class="label">{!! $lang['24'] !!} (c):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="heat_capacity" id="heat_capacity" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->heat_capacity)?request()->heat_capacity:'25' }}" />
                            </div>
                        </div>
                        <div class="col-span-1 s_h_c">
                            <label for="s_heat_units" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="s_heat_units" id="s_heat_units" class="input">
                                    @php
                                        $name = ["J/(g.K)", "J/(kg.K)", "cal/(kg.K)", "cal/g.K", "kcal/(kg.K)", "J/(kg·°C)", "J/(g·°C)", "cal/(kg·°C)", "cal/(g·°C)", "kcal/(kg·°C)"];
                                        $val = ["joules per gram per kelvin (J/(g.k)", "joules per kilogram per kelvin J/(kg.k)", "calories per kilogram per kelvin cal/(kg.k)",
                                        "kilocalories per kilogram per kelvin kcal/(kg.k)", "joules per kilogram per celsius J/(kg·°C)", "joules per gram per celsius J/(g·°C)",
                                        "calories per kilogram per celsius cal/(kg·°C)","calories per gram per celsius cal/(g·°C)", "kilocalories per kilogram per celsius kcal/(kg·°C)"];
                                        optionsList($val,$name,isset(request()->s_heat_units)?request()->s_heat_units:'joules per gram per kelvin (J/(g.K)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-3 temp_change">
                            <label for="temp_change1" class="label">{!! $lang['30'] !!} (\(\Delta T\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="temp_change" id="temp_change1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->temp_change)?request()->temp_change:'20' }}" />
                            </div>
                        </div>
                        <div class="col-span-1 temp_change">
                            <label for="t_c_units" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="t_c_units" id="t_c_units" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->t_c_units)?request()->t_c_units:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-4   gap-4">
                        <div class="col-lg-4 px-2 en hidden">
                        <label for="energy" class="label">{{ $lang['22'] }} (\(\Delta Q\)):</label>
                        <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="energy" id="energy" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->energy)?request()->energy:'20' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 en hidden">
                            <label for="units" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="units" id="units" class="input">
                                    @php
                                        $name = ["J", "nj", "μJ", "mJ", "kJ", "MJ", "Wh", "kWh", "ft-lbs", "cal", "Kcal", "Mcal", "neV", "μeV","meV","eV","KeV","MeV"];
                                        $val = ["joules (J)", "nanojoules (nj)", "microjoules (μJ)", "millijoules (mJ)", "kilojoules (kJ)", "megajoules (MJ)", "watt hours (Wh)",
                                        "kilowatt hours (kWh)", "foot-pounds (ft-lbs)", "calories (cal)", "kilocalories (Kcal)", "megacalories (Mcal)", "nanoelectronovolts (neV)",
                                        "microelectronovolts (μeV)","millielectronovolts (meV)","electronvolts (eV)","kiloelectronovolts (KeV)","megaelectronovolts (MeV)"];
                                        optionsList($val,$name,isset(request()->units)?request()->units:'joules (J)');
                                    @endphp
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 px-2 s_m hidden">
                            <label for="subtance_mass" class="label">{!! $lang['25'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="subtance_mass" id="subtance_mass" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->subtance_mass)?request()->subtance_mass:'15' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 s_m hidden">
                            <label for="s_m_units" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="s_m_units" id="s_m_units" class="input">
                                    @php
                                        $name = ["g", "pg", "ng", "μg", "mg", "dag", "kg", "t", "gr", "dr", "oz", "lb", "stone", "US ton","Long ton","u","oz t"];
                                        $val = ["grams (g)", "picograms (pg)", "nanograms (ng)", "milligrams (mg)", "decagrams (dag)", "kilograms (kg)", "metric tons (t)",
                                        "grains (gr)", "drachms (dr)", "ounces (oz)", "pounds (lb)", "stones (stone)", "US short tones (US ton)",
                                        "imperial tons (Long ton)","atomic mass unit (u)","troy ounce (oz t)"];
                                        optionsList($val,$name,isset(request()->s_m_units)?request()->s_m_units:'grams (g)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 px-2 m_m hidden">
                            <label for="molar_mass" class="label">{!! $lang['26'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="molar_mass" id="molar_mass" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molar_mass)?request()->molar_mass:'20' }}" />
                                <span class="text-blue input-unit">g/mol</span>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 i_temp hidden">
                            <label for="in_temp" class="label">{!! $lang['28'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="in_temp" id="in_temp" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->in_temp)?request()->in_temp:'20' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 i_temp hidden">
                            <label for="i_t_units" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="i_t_units" id="i_t_units" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->i_t_units)?request()->i_t_units:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 f_temp hidden">
                            <label for="s_fin_temp" class="label">{!! $lang['29'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="s_fin_temp" id="s_fin_temp" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->s_fin_temp)?request()->s_fin_temp:'30' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 f_temp hidden">
                            <label for="S_f_t_units" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="S_f_t_units" id="S_f_t_units" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->S_f_t_units)?request()->S_f_t_units:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                      
                    </div>
                </div>
                <div class="space-y-2 obj_1 hidden">
                    <div class="row">
                        <div class="col-lg-6 px-2">
                            <label for="object_formula_change" class="label">{!! $lang['31'] !!}</label>
                            <div class="w-100 py-2 relative">
                                <select name="formula_2obj" id="object_formula_change" class="input">
                                    @php
                                        $name = [$lang['23'] . '(m₁)', $lang['24'] . '(c₁)', $lang['28'] . '(Tᵢ₁)', $lang['29'] . '(T𝒻₁)', $lang['23'] . '(m₂)', $lang['24'] . '(c₂)', $lang['28'] . '(Tᵢ₂)', $lang['29'] . '(T𝒻₂)', $lang['22'] . '(ΔQ₁)', $lang['22'] . '(ΔQ₂)'];
                                        $val = ["m1", "c1", "Ti(1)", "Tf(1)", "m2", "c2", "Ti(2)", "Tf(2)", "q1", "q2"];
                                        optionsList($val,$name,isset(request()->formula_2obj)?request()->formula_2obj:'m1');
                                    @endphp
                                </select>
                                <div class="two_time">
                                    <select name="two_time" id="two_time" class="input">
                                        @php
                                            $name = [$lang['23'] . '(m₁)', $lang['24'] . '(c₁)', $lang['28'] . '(Tᵢ₁)', $lang['32'] . '(T𝒻ᵤₛᵢₒₙ)', $lang['33'] . '(ΔH𝒻ᵤₛᵢₒₙ)', $lang['24'] . '(c₂)', $lang['23'] . '(m₂)', $lang['28'] . '(Tᵢ₂)', $lang['29'] . '(T𝒻)'];
                                            $val = ["m1_two", "c1_two", "Ti(1)", "Tfusion", "ΔHfusion", "c2", "m2", "Ti(2)", "Tf"];
                                            optionsList($val,$name,isset(request()->two_time)?request()->two_time:'m1_two');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 by">
                            <div class="temp"></div>
                        </div>
                        <div class="col-lg-4 px-2 mass1">
                            <label for="mass_1" class="label">{!! $lang['23'] !!} (\(m_1\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="mass_1" id="mass_1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mass_1)?request()->mass_1:'10' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 mass1">
                            <label for="m_units1" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="m_units1" id="m_units1" class="input">
                                    @php
                                        $name = ["g", "pg", "ng", "μg", "mg", "dag", "kg", "t", "gr", "dr", "oz", "lb", "stone", "US ton", "Long ton", "u", "oz t"];
                                        $val = ["grams (g)", "picograms (pg)", "nanograms (ng)", "milligrams (mg)", "decagrams (dag)", "kilograms (kg)", "metric tons (t)", "grains (gr)", "drachms (dr)", "ounces (oz)", "pounds (lb)", "stones (stone)", "US short tones (US ton)", "imperial tons (Long ton)", "atomic mass unit (u)", "troy ounce (oz t)"];
                                        optionsList($val,$name,isset(request()->m_units1)?request()->m_units1:'grams (g)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 mass2">
                            <label for="mass_2" class="label">{!! $lang['23'] !!} (\(m_2\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="mass_2" id="mass_2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mass_2)?request()->mass_2:'20' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 mass2">
                            <label for="m_units2" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="m_units2" id="m_units2" class="input">
                                    @php
                                        $name = ["g", "pg", "ng", "μg", "mg", "dag", "kg", "t", "gr", "dr", "oz", "lb", "stone", "US ton", "Long ton", "u", "oz t"];
                                        $val = ["grams (g)", "picograms (pg)", "nanograms (ng)", "milligrams (mg)", "decagrams (dag)", "kilograms (kg)", "metric tons (t)", "grains (gr)", "drachms (dr)", "ounces (oz)", "pounds (lb)", "stones (stone)", "US short tones (US ton)", "imperial tons (Long ton)", "atomic mass unit (u)", "troy ounce (oz t)"];
                                        optionsList($val,$name,isset(request()->m_units2)?request()->m_units2:'grams (g)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 s_h_c1">
                            <label for="heat_capacity_1" class="label">{!! $lang['24'] !!} (\(c_1\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="heat_capacity_1" id="heat_capacity_1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->heat_capacity_1)?request()->heat_capacity_1:'25' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 s_h_c1">
                            <label for="s_heat_units1" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="s_heat_units1" id="s_heat_units1" class="input">
                                    @php
                                        $name = ["J/(g.K)", "J/(kg.K)", "cal/(kg.K)", "cal/g.K", "kcal/(kg.K)", "J/(kg·°C)", "J/(g·°C)", "cal/(kg·°C)", "cal/(g·°C)", "kcal/(kg·°C)"];
                                        $val = ["joules per gram per kelvin (J/(g.k)", "joules per kilogram per kelvin J/(kg.k)", "calories per kilogram per kelvin cal/(kg.k)", "kilocalories per kilogram per kelvin kcal/(kg.k)", "joules per kilogram per celsius J/(kg·°C)", "joules per gram per celsius J/(g·°C)", "calories per kilogram per celsius cal/(kg·°C)", "calories per gram per celsius cal/(g·°C)", "kilocalories per kilogram per celsius kcal/(kg·°C)"];
                                        optionsList($val,$name,isset(request()->s_heat_units1)?request()->s_heat_units1:'joules per gram per kelvin (J/(g.k)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 s_h_c2">
                            <label for="heat_capacity_2" class="label">{!! $lang['24'] !!} (\(c_2\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="heat_capacity_2" id="heat_capacity_2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->heat_capacity_2)?request()->heat_capacity_2:'50' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 s_h_c2">
                            <label for="s_heat_units2" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="s_heat_units2" id="s_heat_units2" class="input">
                                    @php
                                        $name = ["J/(g.K)", "J/(kg.K)", "cal/(kg.K)", "cal/g.K", "kcal/(kg.K)", "J/(kg·°C)", "J/(g·°C)", "cal/(kg·°C)", "cal/(g·°C)", "kcal/(kg·°C)"];
                                        $val = ["joules per gram per kelvin (J/(g.k)", "joules per kilogram per kelvin J/(kg.k)", "calories per kilogram per kelvin cal/(kg.k)", "kilocalories per kilogram per kelvin kcal/(kg.k)", "joules per kilogram per celsius J/(kg·°C)", "joules per gram per celsius J/(g·°C)", "calories per kilogram per celsius cal/(kg·°C)", "calories per gram per celsius cal/(g·°C)", "kilocalories per kilogram per celsius kcal/(kg·°C)"];
                                        optionsList($val,$name,isset(request()->s_heat_units2)?request()->s_heat_units2:'joules per gram per kelvin (J/(g.k)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 i_temp1">
                            <label for="in_temp_1" class="label">{!! $lang['28'] !!} (\(T_{i1}\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="in_temp_1" id="in_temp_1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->in_temp_1)?request()->in_temp_1:'20' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 i_temp1">
                            <label for="i_t_units1" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="i_t_units1" id="i_t_units1" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->i_t_units1)?request()->i_t_units1:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 i_temp2">
                            <label for="in_temp_2" class="label">{!! $lang['28'] !!} (\(T_{i2}\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="in_temp_2" id="in_temp_2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->in_temp_2)?request()->in_temp_2:'20' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 i_temp2">
                            <label for="i_t_units2" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="i_t_units2" id="i_t_units2" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->i_t_units2)?request()->i_t_units2:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 f_temp1">
                            <label for="fin_temp_1" class="label">{!! $lang['29'] !!} (\(T_{f1}\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="fin_temp_1" id="fin_temp_1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->fin_temp_1)?request()->fin_temp_1:'30' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 f_temp1">
                            <label for="f_t_units1" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="f_t_units1" id="f_t_units1" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->f_t_units1)?request()->f_t_units1:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 f_temp2">
                            <label for="fin_temp_2" class="label">{!! $lang['29'] !!} (\(T_{f2}\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="fin_temp_2" id="fin_temp_2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->fin_temp_2)?request()->fin_temp_2:'30' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 f_temp2">
                            <label for="f_t_units2" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="f_t_units2" id="f_t_units2" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->f_t_units2)?request()->f_t_units2:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 f_temp_two">
                            <label for="fin_temp" class="label">{!! $lang['29'] !!} (\(T_f\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="fin_temp" id="fin_temp" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->fin_temp)?request()->fin_temp:'50' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 f_temp_two">
                            <label for="f_t_units" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="f_t_units" id="f_t_units" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->f_t_units)?request()->f_t_units:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 t_fusion">
                            <label for="t_fusion" class="label">{!! $lang['32'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="t_fusion" id="t_fusion" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->t_fusion)?request()->t_fusion:'40' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 t_fusion">
                            <label for="t_units" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="t_units" id="t_units" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->t_units)?request()->t_units:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 h_fusion">
                            <label for="h_fusion" class="label">{!! $lang['33'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="h_fusion" id="h_fusion" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->h_fusion)?request()->h_fusion:'30' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 h_fusion">
                            <label for="h_fusion_unit" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="h_fusion_unit" id="h_fusion_unit" class="input">
                                    @php
                                        $name = ["J/(g.K)", "J/(kg.K)", "cal/(kg.K)", "cal/g.K", "kcal/(kg.K)", "J/(kg·°C)", "J/(g·°C)", "cal/(kg·°C)", "cal/(g·°C)", "kcal/(kg·°C)"];
                                        $val = ["joules per gram per kelvin (J/(g.k)", "joules per kilogram per kelvin J/(kg.k)", "calories per kilogram per kelvin cal/(kg.k)", "kilocalories per kilogram per kelvin kcal/(kg.k)", "joules per kilogram per celsius J/(kg·°C)", "joules per gram per celsius J/(g·°C)", "calories per kilogram per celsius cal/(kg·°C)", "calories per gram per celsius cal/(g·°C)", "kilocalories per kilogram per celsius kcal/(kg·°C)"];
                                        optionsList($val,$name,isset(request()->h_fusion_unit)?request()->h_fusion_unit:'joules per gram per kelvin (J/(g.k)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-2  obj_3 hidden">
                    <div class="row">
                        <div class="col-lg-6 px-2">
                            <label for="object3_formula_change" class="label">{!! $lang['31'] !!}</label>
                            <div class="w-100 py-2 relative">
                                <select name="formula_3obj" id="object3_formula_change" class="input">
                                    @php
                                        $name = [$lang['23'] . '(m₁)', $lang['24'] . '(c₁)', $lang['29'] . '(T𝒻₁)', $lang['28'] . '(Tᵢ₁)', $lang['23'] . '(m₂)', $lang['24'] . '(c₂)', $lang['29'] . '(T𝒻₂)', $lang['28'] . '(Tᵢ₂)', $lang['23'] . '(m₃)', $lang['24'] . '(c₃)', $lang['29'] . '(T𝒻₃)', $lang['28'] . '(Tᵢ₃)'];
                                        $val = ["m1", "c1", "Tf(1)", "Ti(1)", "m2", "c2", "Tf(2)", "Ti(2)", "m3", "c3", "Tf(3)", "Ti(3)"];
                                        optionsList($val,$name,isset(request()->formula_3obj)?request()->formula_3obj:'m1');
                                    @endphp
                                </select>
                                <div class="three_time hidden">
                                    <select name="three_time" id="three_time" class="input">
                                        @php
                                            $name = [$lang['23'] . '(m₁)', $lang['24'] . '(c₁)', $lang['32'] . '(T𝒻ᵤₛᵢₒₙ)', $lang['28'] . '(Tᵢ₁)', $lang['33'] . '(H𝒻ᵤₛᵢₒₙ)', $lang['24'] . '(c₂)', $lang['23'] . '(m₂)', $lang['28'] . '(Tᵢ₂)', $lang['23'] . '(m₃)', $lang['24'] . '(c₃)', $lang['29'] . '(Tf)'];
                                            $val = ["m1", "c1", "Tfusion", "Ti(1)", "Hfusion", "c2", "m2", "Ti(2)", "m3", "c3", "Tf"];
                                            optionsList($val,$name,isset(request()->three_time)?request()->three_time:'m1');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 by">
                            <div class="temp"></div>
                        </div>
                        <div class="col-lg-4 px-2 mass1">
                            <label for="mass_1_3" class="label">{!! $lang['23'] !!} (\(m_1\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="mass_1_3" id="mass_1_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mass_1_3)?request()->mass_1_3:'10' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 mass1">
                            <label for="m_units1_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="m_units1_3" id="m_units1_3" class="input">
                                    @php
                                        $name = ["g", "pg", "ng", "μg", "mg", "dag", "kg", "t", "gr", "dr", "oz", "lb", "stone", "US ton", "Long ton", "u", "oz t"];
                                        $val = ["grams (g)", "picograms (pg)", "nanograms (ng)", "milligrams (mg)", "decagrams (dag)", "kilograms (kg)", "metric tons (t)", "grains (gr)", "drachms (dr)", "ounces (oz)", "pounds (lb)", "stones (stone)", "US short tones (US ton)", "imperial tons (Long ton)", "atomic mass unit (u)", "troy ounce (oz t)"];
                                        optionsList($val,$name,isset(request()->m_units1_3)?request()->m_units1_3:'grams (g)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 mass2">
                            <label for="mass_2_3" class="label">{!! $lang['23'] !!} (\(m_2\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="mass_2_3" id="mass_2_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mass_2_3)?request()->mass_2_3:'10' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 mass2">
                            <label for="m_units2_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="m_units2_3" id="m_units2_3" class="input">
                                    @php
                                        $name = ["g", "pg", "ng", "μg", "mg", "dag", "kg", "t", "gr", "dr", "oz", "lb", "stone", "US ton", "Long ton", "u", "oz t"];
                                        $val = ["grams (g)", "picograms (pg)", "nanograms (ng)", "milligrams (mg)", "decagrams (dag)", "kilograms (kg)", "metric tons (t)", "grains (gr)", "drachms (dr)", "ounces (oz)", "pounds (lb)", "stones (stone)", "US short tones (US ton)", "imperial tons (Long ton)", "atomic mass unit (u)", "troy ounce (oz t)"];
                                        optionsList($val,$name,isset(request()->m_units2_3)?request()->m_units2_3:'grams (g)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 mass3">
                            <label for="mass_3_3" class="label">{!! $lang['23'] !!} (\(m_3\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="mass_3_3" id="mass_3_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mass_3_3)?request()->mass_3_3:'40' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 mass3">
                            <label for="m_units3_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="m_units3_3" id="m_units3_3" class="input">
                                    @php
                                        $name = ["g", "pg", "ng", "μg", "mg", "dag", "kg", "t", "gr", "dr", "oz", "lb", "stone", "US ton", "Long ton", "u", "oz t"];
                                        $val = ["grams (g)", "picograms (pg)", "nanograms (ng)", "milligrams (mg)", "decagrams (dag)", "kilograms (kg)", "metric tons (t)", "grains (gr)", "drachms (dr)", "ounces (oz)", "pounds (lb)", "stones (stone)", "US short tones (US ton)", "imperial tons (Long ton)", "atomic mass unit (u)", "troy ounce (oz t)"];
                                        optionsList($val,$name,isset(request()->m_units3_3)?request()->m_units3_3:'grams (g)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 s_h_c1">
                            <label for="heat_capacity_1_3" class="label">{!! $lang['24'] !!} (\(c_1\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="heat_capacity_1_3" id="heat_capacity_1_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->heat_capacity_1_3)?request()->heat_capacity_1_3:'25' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 s_h_c1">
                            <label for="s_heat_units1_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="s_heat_units1_3" id="s_heat_units1_3" class="input">
                                    @php
                                        $name = ["J/(g.K)", "J/(kg.K)", "cal/(kg.K)", "cal/g.K", "kcal/(kg.K)", "J/(kg·°C)", "J/(g·°C)", "cal/(kg·°C)", "cal/(g·°C)", "kcal/(kg·°C)"];
                                        $val = ["joules per gram per kelvin (J/(g.k)", "joules per kilogram per kelvin J/(kg.k)", "calories per kilogram per kelvin cal/(kg.k)", "kilocalories per kilogram per kelvin kcal/(kg.k)", "joules per kilogram per celsius J/(kg·°C)", "joules per gram per celsius J/(g·°C)", "calories per kilogram per celsius cal/(kg·°C)", "calories per gram per celsius cal/(g·°C)", "kilocalories per kilogram per celsius kcal/(kg·°C)"];
                                        optionsList($val,$name,isset(request()->s_heat_units1_3)?request()->s_heat_units1_3:'joules per gram per kelvin (J/(g.k)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 s_h_c2">
                            <label for="heat_capacity_2_3" class="label">{!! $lang['24'] !!} (\(c_2\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="heat_capacity_2_3" id="heat_capacity_2_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->heat_capacity_2_3)?request()->heat_capacity_2_3:'50' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 s_h_c2">
                            <label for="s_heat_units2_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="s_heat_units2_3" id="s_heat_units2_3" class="input">
                                    @php
                                        $name = ["J/(g.K)", "J/(kg.K)", "cal/(kg.K)", "cal/g.K", "kcal/(kg.K)", "J/(kg·°C)", "J/(g·°C)", "cal/(kg·°C)", "cal/(g·°C)", "kcal/(kg·°C)"];
                                        $val = ["joules per gram per kelvin (J/(g.k)", "joules per kilogram per kelvin J/(kg.k)", "calories per kilogram per kelvin cal/(kg.k)", "kilocalories per kilogram per kelvin kcal/(kg.k)", "joules per kilogram per celsius J/(kg·°C)", "joules per gram per celsius J/(g·°C)", "calories per kilogram per celsius cal/(kg·°C)", "calories per gram per celsius cal/(g·°C)", "kilocalories per kilogram per celsius kcal/(kg·°C)"];
                                        optionsList($val,$name,isset(request()->s_heat_units2_3)?request()->s_heat_units2_3:'joules per gram per kelvin (J/(g.k)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 s_h_c3">
                            <label for="heat_capacity_3_3" class="label">{!! $lang['24'] !!} (\(c_3\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="heat_capacity_3_3" id="heat_capacity_3_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->heat_capacity_3_3)?request()->heat_capacity_3_3:'70' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 s_h_c3">
                            <label for="s_heat_units3_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="s_heat_units3_3" id="s_heat_units3_3" class="input">
                                    @php
                                        $name = ["J/(g.K)", "J/(kg.K)", "cal/(kg.K)", "cal/g.K", "kcal/(kg.K)", "J/(kg·°C)", "J/(g·°C)", "cal/(kg·°C)", "cal/(g·°C)", "kcal/(kg·°C)"];
                                        $val = ["joules per gram per kelvin (J/(g.k)", "joules per kilogram per kelvin J/(kg.k)", "calories per kilogram per kelvin cal/(kg.k)", "kilocalories per kilogram per kelvin kcal/(kg.k)", "joules per kilogram per celsius J/(kg·°C)", "joules per gram per celsius J/(g·°C)", "calories per kilogram per celsius cal/(kg·°C)", "calories per gram per celsius cal/(g·°C)", "kilocalories per kilogram per celsius kcal/(kg·°C)"];
                                        optionsList($val,$name,isset(request()->s_heat_units3_3)?request()->s_heat_units3_3:'joules per gram per kelvin (J/(g.k)');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 i_temp1">
                            <label for="in_temp_1_3" class="label">{!! $lang['28'] !!} (\(T_{i1}\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="in_temp_1_3" id="in_temp_1_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->in_temp_1_3)?request()->in_temp_1_3:'60' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 i_temp1">
                            <label for="i_t_units1_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="i_t_units1_3" id="i_t_units1_3" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->i_t_units1_3)?request()->i_t_units1_3:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 i_temp2">
                            <label for="in_temp_2_3" class="label">{!! $lang['28'] !!} (\(T_{i2}\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="in_temp_2_3" id="in_temp_2_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->in_temp_2_3)?request()->in_temp_2_3:'40' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 i_temp2">
                            <label for="i_t_units2_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="i_t_units2_3" id="i_t_units2_3" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->i_t_units2_3)?request()->i_t_units2_3:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 i_temp3">
                            <label for="in_temp_3_3" class="label">{!! $lang['28'] !!} (\(T_{i3}\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="in_temp_3_3" id="in_temp_3_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->in_temp_3_3)?request()->in_temp_3_3:'20' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 i_temp3">
                            <label for="i_t_units3_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="i_t_units3_3" id="i_t_units3_3" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->i_t_units3_3)?request()->i_t_units3_3:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 f_temp1">
                            <label for="fin_temp_1_3" class="label">{!! $lang['29'] !!} (\(T_{f1}\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="fin_temp_1_3" id="fin_temp_1_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->fin_temp_1_3)?request()->fin_temp_1_3:'80' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 f_temp1">
                            <label for="f_t_units1_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="f_t_units1_3" id="f_t_units1_3" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->f_t_units1_3)?request()->f_t_units1_3:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 f_temp2">
                            <label for="fin_temp_2_3" class="label">{!! $lang['29'] !!} (\(T_{f2}\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="fin_temp_2_3" id="fin_temp_2_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->fin_temp_2_3)?request()->fin_temp_2_3:'10' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 f_temp2">
                            <label for="f_t_units2_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="f_t_units2_3" id="f_t_units2_3" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->f_t_units2_3)?request()->f_t_units2_3:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 f_temp3">
                            <label for="fin_temp_3_3" class="label">{!! $lang['29'] !!} (\(T_{f3}\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="fin_temp_3_3" id="fin_temp_3_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->fin_temp_3_3)?request()->fin_temp_3_3:'25' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 f_temp3">
                            <label for="f_t_units3_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="f_t_units3_3" id="f_t_units3_3" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->f_t_units3_3)?request()->f_t_units3_3:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 f_temp_two">
                            <label for="fin_temp_3" class="label">{!! $lang['29'] !!} (\(T_f\)):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="fin_temp_3" id="fin_temp_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->fin_temp_3)?request()->fin_temp_3:'50' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 f_temp_two">
                            <label for="f_t_units_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="f_t_units_3" id="f_t_units_3" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->f_t_units_3)?request()->f_t_units_3:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 t_fusion">
                            <label for="t_fusion_3" class="label">\(T_{fusion}\):</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="t_fusion_3" id="t_fusion_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->t_fusion_3)?request()->t_fusion_3:'30' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 t_fusion">
                            <label for="t_units_3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="t_units_3" id="t_units_3" class="input">
                                    @php
                                        $name = ["K", "°C", "°F"];
                                        $val = ["kelvin K", "celsius °C", "Fahrenheit °F"];
                                        optionsList($val,$name,isset(request()->t_units_3)?request()->t_units_3:'kelvin K');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 px-2 h_fusion">
                            <label for="h_fusion_3" class="label">{!! $lang['33'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="h_fusion_3" id="h_fusion_3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->h_fusion_3)?request()->h_fusion_3:'30' }}" />
                            </div>
                        </div>
                        <div class="col-lg-2 px-2 h_fusion">
                            <label for="h_units3" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="h_units3" id="h_units3" class="input">
                                    @php
                                        $name = ["J/(g.K)", "J/(kg.K)", "cal/(kg.K)", "cal/g.K", "kcal/(kg.K)", "J/(kg·°C)", "J/(g·°C)", "cal/(kg·°C)", "cal/(g·°C)", "kcal/(kg·°C)"];
                                        $val = ["joules per gram per kelvin (J/(g.k)", "joules per kilogram per kelvin J/(kg.k)", "calories per kilogram per kelvin cal/(kg.k)", "kilocalories per kilogram per kelvin kcal/(kg.k)", "joules per kilogram per celsius J/(kg·°C)", "joules per gram per celsius J/(g·°C)", "calories per kilogram per celsius cal/(kg·°C)", "calories per gram per celsius cal/(g·°C)", "kilocalories per kilogram per celsius kcal/(kg·°C)"];
                                        optionsList($val,$name,isset(request()->h_units3)?request()->h_units3:'joules per gram per kelvin (J/(g.k)');
                                    @endphp
                                </select>
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


    @endunless
    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg ">
                    <div class="w-full bg-light-blue result p-3 radius-10 mt-3">
                        @php
                            $type = trim(request()->type);
                            $state_change = trim(request()->state_change);
                            $obj_units = trim(request()->obj_units);
                            $state = trim(request()->state);
                            $formula = trim(request()->formula);
                            $three_time = trim(request()->three_time);
                            $energy = trim(request()->energy);
                            $mass = trim(request()->mass);
                            $heat_capacity = trim(request()->heat_capacity);
                            $in_temp = trim(request()->in_temp);
                            $s_fin_temp = trim(request()->s_fin_temp);
                            $temp_change = trim(request()->temp_change);
                            $units = trim(request()->units);
                            $m_units = trim(request()->m_units);
                            $i_t_units = trim(request()->i_t_units);
                            $f_t_units = trim(request()->f_t_units);
                            $t_c_units = trim(request()->t_c_units);
                            $s_heat_units = trim(request()->s_heat_units);
                            $subtance_mass = trim(request()->subtance_mass);
                            $molar_mass = trim(request()->molar_mass);
                            $formula_2obj = trim(request()->formula_2obj);
                            $formula_3obj = trim(request()->formula_3obj);
                            $m_units1 = trim(request()->m_units1);
                            $m_units2 = trim(request()->m_units2);
                
                            $s_m_units = trim(request()->s_m_units);
                            $S_f_t_units = trim(request()->S_f_t_units);
                            $m_units1_3 = trim(request()->m_units1_3);
                            $m_units2_3 = trim(request()->m_units2_3);
                            $m_units3_3 = trim(request()->m_units3_3);
                            $s_heat_units1_3 = trim(request()->s_heat_units1_3);
                            $s_heat_units2_3 = trim(request()->s_heat_units2_3);
                            $s_heat_units3_3 = trim(request()->s_heat_units3_3);
                            $i_t_units1_3 = trim(request()->i_t_units1_3);
                            $i_t_units2_3 = trim(request()->i_t_units2_3);
                            $i_t_units3_3 = trim(request()->i_t_units3_3);
                            $f_t_units1_3 = trim(request()->f_t_units1_3);
                            $f_t_units2_3 = trim(request()->f_t_units2_3);
                            $f_t_units3_3 = trim(request()->f_t_units3_3);
                            $f_t_units_3 = trim(request()->f_t_units_3);
                            $t_units_3 = trim(request()->t_units_3);
                            $h_units3 = trim(request()->h_units3);
                
                            $mass_2 = trim(request()->mass_2);
                            $heat_capacity_2 = trim(request()->heat_capacity_2);
                            $s_heat_units2 = trim(request()->s_heat_units2);
                            $heat_capacity_1 = trim(request()->heat_capacity_1);
                            $s_heat_units1 = trim(request()->s_heat_units1);
                            $in_temp_2 = trim(request()->in_temp_2);
                            $i_t_units2 = trim(request()->i_t_units2);
                            $fin_temp_2 = trim(request()->fin_temp_2);
                            $fin_temp_3 = trim(request()->fin_temp_3);
                            $f_t_units2 = trim(request()->f_t_units2);
                            $in_temp_1 = trim(request()->in_temp_1);
                            $i_t_units1 = trim(request()->i_t_units1);
                            $fin_temp_1 = trim(request()->fin_temp_1);
                            $f_t_units1 = trim(request()->f_t_units1);
                            $mass_1 = trim(request()->mass_1);
                            $fin_temp = trim(request()->fin_temp);
                            $mass_1_3 = trim(request()->mass_1_3);
                            $mass_2_3 = trim(request()->mass_2_3);
                            $mass_3_3 = trim(request()->mass_3_3);
                            $heat_capacity_1_3 = trim(request()->heat_capacity_1_3);
                            $heat_capacity_2_3 = trim(request()->heat_capacity_2_3);
                            $heat_capacity_3_3 = trim(request()->heat_capacity_3_3);
                            $in_temp_1_3 = trim(request()->in_temp_1_3);
                            $in_temp_2_3 = trim(request()->in_temp_2_3);
                            $in_temp_3_3 = trim(request()->in_temp_3_3);
                            $fin_temp_1_3 = trim(request()->fin_temp_1_3);
                            $fin_temp_2_3 = trim(request()->fin_temp_2_3);
                            $fin_temp_3_3 = trim(request()->fin_temp_3_3);
                            $fin_temp_3 = trim(request()->fin_temp_3);
                            $t_fusion_3 = trim(request()->t_fusion_3);
                            $h_fusion_3 = trim(request()->h_fusion_3);
                            $t_fusion = trim(request()->t_fusion);
                            $h_fusion = trim(request()->h_fusion);
                            $t_units = trim(request()->t_units);
                            $two_time = trim(request()->two_time);
                            $h_fusion_unit = trim(request()->h_fusion_unit);
                        @endphp
                        <div class="w-full">
                            @if(isset($detail['formula']))
                                <p><strong><?= str_replace('_', ' ', $detail['formula']); ?></strong></p>
                                @if($formula == 'Heat Energy')
                                    <p><strong class="text-green-700 text-32"><?= round($detail['energy'], 3); ?> J</strong></p>
                                @elseif($formula == 'Specific Heat')
                                    <p><strong class="text-green-700 text-32"><?= round($detail['heat_capacity'], 3); ?> J/(kg·K)</strong></p>
                                @elseif($formula == 'Mass')
                                    <p><strong class="text-green-700 text-32"><?= round($detail['mass'], 3); ?> kg</strong></p>
                                @elseif($formula == 'Enthalpy_change')
                                    <p><strong class="text-green-700 text-32"><?= round($detail['enthalpy_change'], 3); ?> Kj/mol</strong></p>
                                @elseif($formula == 'Time_of_isolation')
                                    <p><strong class="text-green-700 text-32"><?= round($detail['time_of_is'], 3); ?> Seconds</strong></p>
                                @elseif($formula == 'Initial_Temperature')
                                    <p><strong class="text-green-700 text-32"><?= round($detail['in_temp'], 3); ?> K</strong></p>
                                @elseif($formula == 'Final_Temperature')
                                    <p><strong class="text-green-700 text-32"><?= round($detail['fin_temp'], 3); ?> K</strong></p>
                                @endif
                
                                <p><strong class="text-[18px]"><?= $lang[35] ?>:</strong></p>
                
                                @if($formula == 'Heat Energy')
                                    <p class="mt-2">\({\Delta Q} = m c \Delta T\)</p>
                                    <p class="mt-2">\({\Delta Q} = (<?= $detail['mass']; ?>)(<?= $detail['heat_capacity']; ?>)(<?= $detail['temp_change']; ?>)\)</p>
                                    <p class="mt-2">\({\Delta Q} = (<?= $detail['mass'] * $detail['heat_capacity']; ?>)(<?= $detail['temp_change']; ?>)\)</p>
                                    <p class="mt-2">\({\Delta Q} = <?= round($detail['mass'] * $detail['heat_capacity'] * $detail['temp_change'], 3); ?>J\)</p>
                                @elseif($formula == 'Specific Heat')
                                    <p class="mt-2">\( C = \dfrac{\Delta Q}{m \Delta T} \)</p>
                                    <p class="mt-2">\(C = \dfrac{(<?= $detail['energy']; ?>)}{(<?= $detail['mass']; ?>)(<?= $detail['temp_change']; ?>)}\)</p>
                                    <?php $res = $detail['mass'] * $detail['temp_change']; ?>
                                    <p class="mt-2">\(C = \dfrac{(<?= $detail['energy']; ?>)}{(<?= $detail['mass'] * $detail['temp_change']; ?>)}\)</p>
                                    <p class="mt-2">\(C = \text{<?= round($detail['energy'] / $res, 3); ?>}J/(kg·K)\)</p>
                                @elseif($formula == 'Mass')
                                    <p class="mt-2">\(m = \dfrac{Q} {c{\Delta T}} \)</p>
                                    <p class="mt-2">\(m = \dfrac{(<?= $detail['energy']; ?>)}{(<?= $detail['heat_capacity']; ?>)(<?= $detail['temp_change']; ?>)}\)</p>
                                    <p class="mt-2">\(m = \dfrac{(<?= $detail['energy']; ?>)}{(<?= $detail['heat_capacity'] * $detail['temp_change']; ?>)}\)</p>
                                    @php $res = $detail['heat_capacity'] * $detail['temp_change'] @endphp
                                    <p class="mt-2">\(\text{m = <?= round($detail['energy'] / $res, 3); ?>}kg\)</p>
                                @elseif($formula == 'Enthalpy_change')
                                    <p class="mt-2">\({\Delta H} = {\dfrac{M {\Delta Q}}{mol}}\)</p>
                                    <p class="mt-2">\({\Delta H} = \dfrac{(<?= $detail['molar_mass']; ?>)(<?= $detail['energy']; ?>)}{(<?= $detail['subtance_mass']; ?>)}\)</p>
                                    <p class="mt-2">\({\Delta H} = \dfrac{(<?= $detail['molar_mass'] * $detail['energy']; ?>)}{(<?= $detail['subtance_mass']; ?>)}\)</p>
                                    <p class="mt-2">\({\Delta H} = \text{<?= round($detail['enthalpy_change'], 3); ?>}\)</p>
                                    <p class="mt-2">\({\Delta H_Obj2} = \text{<?= round($detail['enthalpy_change_2'], 3); ?>}Kj/mol\)</p>
                                @elseif($formula == 'Time_of_isolation')
                                    <p class="mt-2">\(t = \dfrac{m.c.{\Delta T}}{\Delta Q}\)</p>
                                    <p class="mt-2">\(t = \dfrac{(<?= $detail['mass']; ?>)(<?= $detail['heat_capacity']; ?>)(<?= $detail['temp_change']; ?>)}{(<?= $detail['energy']; ?>)}\)</p>
                                    <p class="mt-2">\(t = \dfrac{(<?= $detail['mass'] * $detail['heat_capacity'] * $detail['temp_change']; ?>)}{(<?= $detail['energy']; ?>)}\)</p>
                                    <p class="mt-2">\(t = \text{<?= round($detail['time_of_is'], 3); ?> Seconds}\)</p>
                                    <p class="mt-2">\(t = \text{<?= round($detail['time_of_is'] / 60, 3); ?> Minutes}\)</p>
                                    <p class="mt-2">\(t = \text{<?= round($detail['time_of_is'] / 3600, 3); ?> Hours}\)</p>
                                @elseif($formula == 'Initial_Temperature')
                                    <p class="mt-2">\(T_i = \dfrac{\Delta Q}{mc-T_f}\)</p>
                                    <p class="mt-2">\({T_i} = \dfrac{(<?= $detail['energy']; ?>)}{(<?= $detail['mass']; ?>)(<?= $detail['heat_capacity']; ?>)-(<?= $detail['fin_temp']; ?>)}\)</p>
                                    <p class="mt-2">\({T_i} = \dfrac{(<?= $detail['energy']; ?>)}{(<?= $detail['mass'] * $detail['heat_capacity']; ?>)-(<?= $detail['fin_temp']; ?>)}\)</p>
                                    <p class="mt-2">\({T_i} = \dfrac{(<?= $detail['energy'] ?>)}{(<?= $detail['mass'] * $detail['heat_capacity'] - $detail['fin_temp']; ?>)}\)</p>
                                    <p class="mt-2">\({T_i} = <?= round($detail['in_temp'], 3) ?>K\)</p>
                                @elseif($formula == 'Final_Temperature')
                                    <p class="mt-2">\(T_f = \dfrac{\Delta Q}{mc+Ti}\)</p>
                                    <p class="mt-2">\(T_f = \dfrac{(<?= $detail['energy']; ?>)}{(<?= $detail['mass']; ?>)(<?= $detail['heat_capacity']; ?>)+(<?= $detail['in_temp']; ?>)}\)</p>
                                    <p class="mt-2">\(T_f = \dfrac{(<?= $detail['energy']; ?>)}{(<?= $detail['mass'] * $detail['heat_capacity']; ?>)+(<?= $detail['in_temp']; ?>)}\)</p>
                                    <?php $res = $detail['mass'] * $detail['heat_capacity']; ?>
                                    <p class="mt-2">\(T_f = \dfrac{(<?= $detail['energy']; ?>)}{(<?= $detail['mass'] * $detail['heat_capacity'] + $detail['in_temp']; ?>)}\)</p>
                                    <p class="mt-2">\(T_f = <?= round($detail['fin_temp'], 3) ?>K\)</p>
                                @endif
                            @endif
                
                            @if(isset($detail['formula_2obj']))
                                @if($formula_2obj == 'm1')
                                    <p><strong><?= $lang[34] ?> \((m_1)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['mass_1'], 3); ?> g</strong></p>
                                @elseif($formula_2obj == 'c1')
                                    <p><strong><?= $lang[37] ?>\((c_1)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['heat_capacity_1'], 3); ?> J/(g.K)</strong></p>
                                @elseif($formula_2obj == 'Ti(1)')
                                    <p><strong><?= $lang[38] ?>\((T_{i1})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['in_temp_1'], 3); ?> K</strong></p>
                                @elseif($formula_2obj == 'Tf(1)')
                                    <p><strong><?= $lang[39] ?>\((T_{f1})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['fin_temp_1'], 3); ?> K</strong></p>
                                @elseif($formula_2obj == 'm2')
                                    <p><strong><?= $lang[40] ?>\((m_2)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['mass_2'], 3); ?> g</strong></p>
                                @elseif($formula_2obj == 'c2')
                                    <p><strong><?= $lang[41] ?>\((c_2)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['heat_capacity_2'], 3); ?> J/(g.K)</strong></p>
                                @elseif($formula_2obj == 'Ti(2)')
                                    <p><strong><?= $lang[42] ?>\((T_{i2})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['in_temp_2'], 3); ?> K</strong></p>
                                @elseif($formula_2obj == 'Tf(2)')
                                    <p><strong><?= $lang[43] ?>\((T_{f2})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['fin_temp_2'], 3); ?> K</strong></p>
                                @elseif($formula_2obj == 'q1')
                                    <p><strong><?= $lang[44] ?>\((Q_1)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['energy'], 3); ?> J</strong></p>
                                @elseif($formula_2obj == 'q2')
                                    <p><strong><?= $lang[45] ?>\((Q_2)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['energy'], 3); ?> J</strong></p>
                                @endif
                
                                <p><strong class="font-s-18"><?= $lang[35] ?>:</strong></p>
                
                                @if($formula_2obj == 'm1')
                                    <p class="mt-2">\(m_1\) = \(\dfrac{ m_2c_2(T_{f2} - T_{i2})}{c_1(T_{f1} - T_{i1})}\)</p>
                                    <p class="mt-2">\(m_1\) = \(\dfrac{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)}{(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1\) = \(\dfrac{(<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2'] - $detail['in_temp_2']; ?>)}{(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1'] - $detail['in_temp_1']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1\) = \(\dfrac{(<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2'] - $detail['in_temp_2']; ?>)}{(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1'] - $detail['in_temp_1']; ?>)}\)</p>
                                    <?php $detail['temp'] = $detail['fin_temp_2'] - $detail['in_temp_2'] ?>
                                    <?php $detail['temp1'] = $detail['fin_temp_1'] - $detail['in_temp_1'] ?>
                                    <p class="mt-2">\(m_1\) = \(\dfrac{(<?= $detail['mass_2'] * $detail['heat_capacity_2'] * $detail['temp'] ?>)}{(<?= $detail['heat_capacity_1'] * $detail['temp1']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = <?= round($detail['mass_1'], 3) ?> g\)</p>
                                @elseif($formula_2obj == 'c1')
                                    <p class="mt-2">\(c_1 = \dfrac{-m_2c_2(T_{f2} - T_{i2})}{m_1(T_{f1} - T_{i1})}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(-<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(-<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2'] - $detail['in_temp_2']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['fin_temp_1'] - $detail['in_temp_1']; ?>)}\)</p>
                                    @php
                                        $temp = $detail['fin_temp_2'] - $detail['in_temp_2'];
                                        $temp1 = $detail['fin_temp_1'] - $detail['in_temp_1'];
                                    @endphp
                                    <p class="mt-2">\(c_1 = \dfrac{(-<?= $detail['mass_2'] * $detail['heat_capacity_2'] * $temp; ?>)}{(<?= $detail['mass_1'] * $temp; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = <?= round($detail['heat_capacity_1'], 3) ?>J/(g.K)\)</p>
                                @elseif($formula_2obj == 'Ti(1)')
                                    <p class="mt-2">\(T_{i1}\) = \(\dfrac{m_2c_2(T_{f2} - T_{i2})+T_{f1}}{m_1c_1}\)</p>
                                    <p class="mt-2">\(T_{i1}\) = \(\dfrac{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)+(<?= $detail['fin_temp_1']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i1}\) = \(\dfrac{(<?= $detail['mass_2'] * $detail['heat_capacity_2'];; ?>)(<?= $detail['fin_temp_2'] - $detail['in_temp_2']; ?>)+(<?= $detail['fin_temp_1']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)}\)</p>
                                    @php
                                        $temp = $detail['fin_temp_2'] - $detail['in_temp_2'];
                                        $res = $detail['mass_2'] * $detail['heat_capacity_2'] * $temp + $detail['fin_temp_1'];
                                    @endphp
                                    <p class="mt-2">\(T_{i1}\) = \(\dfrac{(<?= $detail['mass_2'] * $detail['heat_capacity_2'] * $temp; ?>)+(<?= $detail['fin_temp_1']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i1}\) = \(\dfrac{(<?= $res; ?>)}{(<?= $detail['mass_1'] * $detail['heat_capacity_1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i1}\) = \(<?= round($detail['in_temp_1'], 3) ?>K\)</p>
                                @elseif($formula_2obj == 'Tf(1)')
                                    <p class="mt-2">\(T_{f1} = \dfrac{-m_2c_2(T_{f2} - T_{i2})+T_{i1}}{m_1c_1}\)</p>
                                    <p class="mt-2">\(T_{f1} = \dfrac{(-<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)+(<?= $detail['in_temp_1']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f1} = \dfrac{(-<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2'] - $detail['in_temp_2']; ?>)+(<?= $detail['in_temp_1']; ?>)}{(<?= $detail['mass_1'] * $detail['heat_capacity_1']; ?>)}\)</p>
                                    @php
                                        $temp = $detail['fin_temp_2'] - $detail['in_temp_2'];
                                        $res = $detail['mass_2'] * $detail['heat_capacity_2'] * $temp + $detail['in_temp_1'];
                                    @endphp
                                    <p class="mt-2">\(T_{f1} = \dfrac{(-<?= $detail['mass_2'] * $detail['heat_capacity_2'] * $temp; ?>)+(<?= $detail['in_temp_1']; ?>)}{(<?= $detail['mass_1'] * $detail['heat_capacity_1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f1} = \dfrac{(-<?= $res; ?>)}{(<?= $detail['mass_1'] * $detail['heat_capacity_1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f1} = <?= round($detail['fin_temp_1'], 3) ?>\)K</p>
                                @elseif($formula_2obj == 'm2')
                                    <p class="mt-2">\(m_2 = \dfrac{m_1c_1(T_{f1} - T_{i1})}{c_2(T_{f2} - T_{i2})}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)}{(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_1']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['mass_1'] * $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1'] - $detail['in_temp_1']; ?>)}{(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2'] - $detail['in_temp_1']; ?>)}\)</p>
                                    @php
                                        $temp = $detail['fin_temp_1'] - $detail['in_temp_1'];
                                        $temp2 = $detail['fin_temp_2'] - $detail['in_temp_1'];
                                    @endphp
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['mass_1'] * $detail['heat_capacity_1'] * $temp; ?>)}{(<?= $detail['heat_capacity_2'] * $temp2; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = <?= round($detail['mass_2'], 3) ?>g\)</p>
                                @elseif($formula_2obj == 'c2')
                                    <p class="mt-2"> \(c_2 = \dfrac{-m_1c_1(T_{f1} - T_{i1})}{m_2(T_{f2} - T_{i2})}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(-<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)}{(<?= $detail['mass_2']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(-<?= $detail['mass_1'] * $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1'] - $detail['in_temp_1']; ?>)}{(<?= $detail['mass_2']; ?>)(<?= $detail['fin_temp_1'] - $detail['in_temp_1']; ?>)}\)</p>
                                    @php
                                        $temp = $detail['fin_temp_1'] - $detail['in_temp_1'];
                                        $temp2 = $detail['fin_temp_2'] - $detail['in_temp_1'];
                                    @endphp
                                    <p class="mt-2">\(c_2 = \dfrac{(-<?= $detail['mass_1'] * $detail['heat_capacity_1'] * $temp; ?>)}{(<?= $detail['mass_2'] * $temp2; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = <?= round($detail['heat_capacity_2'], 3) ?> J/(g.K)\)</p>
                                @elseif($formula_2obj == 'Ti(2)')
                                    <p class="mt-2"> \(T_{i2} = \dfrac{m_1c_1(T_{f1} - T_{i1})+T_{f2}}{m_2c_2}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)+(<?= $detail['fin_temp_2']; ?>)}{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['mass_1'] * $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1'] - $detail['in_temp_1']; ?>)+(<?= $detail['fin_temp_2']; ?>)}{(<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)}\)</p>
                                    <?php
                                    $temp = $detail['fin_temp_1'] - $detail['in_temp_1'];
                                    ?>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['mass_1'] * $detail['heat_capacity_1'] * $temp; ?>)+(<?= $detail['fin_temp_2']; ?>)}{(<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['mass_1'] * $detail['heat_capacity_1'] * $temp + $detail['fin_temp_2']; ?>)}{(<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = <?= round($detail['in_temp_2'], 3) ?>K\)</p>
                                @elseif($formula_2obj == 'Tf(2)')
                                    <p class="mt-2"> \(T_{f2} = \dfrac{-m_1c_1(T_{f1} - T_{i1})+T_{i1}}{m_2c_2}\)</p>
                                    <p class="mt-2">\(T_{f2} = \dfrac{(-<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)+(<?= $detail['in_temp_1']; ?>)}{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f2} = \dfrac{(-<?= $detail['mass_1'] * $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1'] - $detail['in_temp_1']; ?>)+(<?= $detail['in_temp_1']; ?>)}{(<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)}\)</p>
                                    <?php
                                    $temp = $detail['fin_temp_1'] - $detail['in_temp_1'];
                                    $res = -$detail['mass_1'] * $detail['heat_capacity_1'] * $temp;
                                    $res1 = $res + $detail['in_temp_1'];
                                    ?>
                                    <p class="mt-2">\(T_{f2} = \dfrac{(-<?= $detail['mass_1'] * $detail['heat_capacity_1'] * $temp; ?>)+(<?= $detail['in_temp_1']; ?>)}{(<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f2} = \dfrac{(<?= $res1 ?>)}{(<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f2} = <?= round($detail['fin_temp_2'], 3) ?>K\)</p>
                                @elseif($formula_2obj == 'q1')
                                    <p class="mt-2"> \({\Delta Q_1} = m_1 c_1 (T_{f1} - T_{i1})\)</p>
                                    <p class="mt-2">\({\Delta Q_1} = (<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)\)</p>
                                    <p class="mt-2">\({\Delta Q_1} = (<?= $detail['mass_1'] * $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1'] - $detail['in_temp_1']; ?>)\)</p>
                                    <p class="mt-2">\({\Delta Q_1} = <?= round($detail['energy'], 3) ?>J\)</p>
                                    <p class="mt-2"> As the calorimetry eqution is</p>
                                    <p class="mt-2"> \({\Delta Q_1} + ΔQ2 = 0\)</p>
                                    <p class="mt-2"> \({\Delta Q_1} = -ΔQ2\)</p>
                                    <p class="mt-2"> \({\Delta Q_2} = -<?= round($detail['energy'], 3) ?>J\)</p>
                                @elseif($formula_2obj == 'q2')
                                    <p class="mt-2"> \({\Delta Q_2} = m_1 c_1 (T_{f1} - T_{i1})\)</p>
                                    <p class="mt-2">\({\Delta Q_2} = (<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)\)</p>
                                    <p class="mt-2">\({\Delta Q_2} = (<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2'] - $detail['in_temp_2']; ?>)\)</p>
                                    <p class="mt-2">\({\Delta Q_2} = <?= round($detail['energy'], 3) ?>J\)</p>
                                    <p class="mt-2"> As the calorimetry eqution is</p>
                                    <p class="mt-2"> \({\Delta Q_2} + ΔQ1 = 0\)</p>
                                    <p class="mt-2"> \({\Delta Q_2} = -ΔQ1\)</p>
                                    <p class="mt-2"> \({\Delta Q_1} = -<?= round($detail['energy'], 3) ?>J\)</p>
                                @endif
                            @endif
                
                            @if(isset($detail['two_time']))
                                @if ($two_time == 'm1_two')
                                    <p><strong><?= $lang[34] ?>\((m_1)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['mass_1'], 3); ?> g</strong></p>
                                @elseif ($two_time == 'c1_two')
                                    <p><strong><?= $lang[37] ?>\((c_1)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['heat_capacity_1'], 3); ?> J/(g.K)</strong></p>
                                @elseif ($two_time == 'Ti(1)')
                                    <p><strong><?= $lang[38] ?> \((T_{i1})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['in_temp_1'], 3); ?> K</strong></p>
                                @elseif ($two_time == 'Tfusion')
                                    <p><strong><?= $lang[46] ?> \((T_{fusion})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['t_fusion'], 3); ?> K</strong></p>
                                @elseif ($two_time == 'ΔHfusion')
                                    <p><strong><?= $lang[47] ?> \(({\Delta H_{fusion}})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['h_fusion'], 3); ?> J(g.K)</strong></p>
                                @elseif ($two_time == 'c2')
                                    <p><strong><?= $lang[41] ?>\((c_2)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['heat_capacity_2'], 3); ?> J/(g.K)</strong></p>
                                @elseif ($two_time == 'm2')
                                    <p><strong><?= $lang[40] ?>\((m_2)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['mass_2'], 3); ?> g</strong></p>
                                @elseif ($two_time == 'Ti(2)')
                                    <p><strong><?= $lang[42] ?>\((T_{i2})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['in_temp_2'], 3); ?> K</strong></p>
                                @elseif ($two_time == 'Tf')
                                    <p><strong><?= $lang[29] ?> \((T_f)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['fin_temp'], 3); ?> K</strong></p>
                                @endif
                
                                <p><strong class="font-s-18">Solutions:</strong></p>
                
                                @if($two_time == 'm1_two')
                                    <p class="mt-2">\(m_1 = \dfrac{m_2c_2(T_{f2} - T_{i2})}{c_1(T_{fusion} - T_{i1})+{\Delta H_{fusion}}+ c_2(T_f-T_{fusion})}\)</p>
                                    <p class="mt-2">\(m_1 = \dfrac{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)}{<?= $detail['heat_capacity_1']; ?>(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)+<?= $detail['h_fusion']; ?>+<?= $detail['heat_capacity_2']; ?>(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = \dfrac{(<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2'] - $detail['in_temp_2']; ?>)}{<?= $detail['heat_capacity_1']; ?>(<?= $detail['t_fusion'] - $detail['in_temp_1']; ?>)+<?= $detail['h_fusion']; ?>+<?= $detail['heat_capacity_2']; ?>(<?= $detail['fin_temp'] - $detail['t_fusion']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = \dfrac{(<?= $detail['m2c2tfti2']; ?>)}{(<?= $detail['c1_tfusion_ti']; ?>)+<?= $detail['h_fusion']; ?>+(<?= $detail['c2_tf_tfusion']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = \dfrac{(<?= $detail['m2c2tfti2']; ?>)}{(<?= $detail['div']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = <?= round($detail['mass_1'], 3) ?>g\)</p>
                                @elseif($two_time == 'c1_two')
                                    <p class="mt-2">\(c_1 = \dfrac{-m_1{\Delta H_{fusion}}-m_1c_2(T_f - T_{fusion})-m_2c_2(T_f - T_{i2})}{m_1(T_{fusion} - T_{i1})}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(<?= -$detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(<?= $detail['m1Hfusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp'] - $detail['t_fusion']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp'] - $detail['in_temp_2']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['t_fusion'] - $detail['in_temp_1']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(<?= $detail['m1Hfusion']; ?>)-(<?= $detail['m1c2_Tf_Tfusion']; ?>)-(<?= $detail['m2c2_tf_ti']; ?>)}{(<?= $detail['m1_tfusion_ti']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m1_tfusion_ti']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = <?= round($detail['heat_capacity_1'], 3) ?>J/(g.K)\)</p>
                                @elseif($two_time == 'Ti(1)')
                                    <p class="mt-2">\(T_{i1} = \dfrac{-m_1{\Delta H_{fusion}}-m_1c_2(T_f - T_{fusion})-m_2c_2(T_f - T_{i2})}{m_1c_1}\)</p>
                                    <p class="mt-2">\(T_{i1} = \dfrac{-(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i1} = \dfrac{(<?= $detail['m1Hfusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp'] - $detail['t_fusion']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp'] - $detail['in_temp_2']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i1} = \dfrac{(<?= $detail['m1Hfusion']; ?>)-(<?= $detail['m1c2_Tf_Tfusion']; ?>)-(<?= $detail['m2c2_tf_ti']; ?>)}{(<?= $detail['m1_c1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i1} = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m1_c1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i1} = <?= round($detail['in_temp_1'], 3) ?>K\)</p>
                                @elseif($two_time == 'Tfusion')
                                    <p class="mt-2">\(T_{fusion} = \dfrac{-m_1H_{fusion}-m_2c_2(T_f - T_{i1})-m_1c_1T_i-m_1c_2T_f}{m_1c_1-m_1c_2}\)</p>
                                    <p class="mt-2">\(T_{fusion} = \dfrac{(<?= -$detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{fusion} = \dfrac{(<?= $detail['m1Hfusion']; ?>)-(<?= $detail['m2c2_tf_ti']; ?>)-(<?= $detail['m1c1Ti']; ?>)-(<?= $detail['m1c2Tf']; ?>)}{(<?= $detail['m1c1']; ?>)-(<?= $detail['m1c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{fusion} = \dfrac{<?= round($detail['res'], 2) ?>}{<?= round($detail['m1c1_m1c2'], 2) ?>}\)</p>
                                    <p class="mt-2">\(T_{fusion} = <?= round($detail['t_fusion'], 3) ?>K\)</p>
                                @elseif($two_time == 'ΔHfusion')
                                    <p class="mt-2">\({\Delta H_{fusion}} = \dfrac{-m_1c_1(T_{fusion}-T_{i1}) -m_1c_2(T_f - T_{fusion})-m_2c_2(T_f-T_{i2})}{m_1}\)</p>
                                    <p class="mt-2">\({\Delta H_{fusion}} = \dfrac{(<?= -$detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_1']; ?>)}{(<?= $detail['mass_1']; ?>)}\)</p>
                                    <p class="mt-2">\({\Delta H_{fusion}} = \dfrac{(<?= $detail['m1_c1']; ?>)(<?= $detail['Tfusion_ti']; ?>)-(<?= $detail['m1c2']; ?>)(<?= $detail['tf_tfusion']; ?>)-(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti']; ?>)}{(<?= $detail['mass_1']; ?>)}\)</p>
                                    <p class="mt-2">\({\Delta H_{fusion}} = \dfrac{(<?= $detail['m1_c1'] * $detail['Tfusion_ti']; ?>)-(<?= $detail['m1c2'] * $detail['tf_tfusion']; ?>)-(<?= $detail['m2c2'] * $detail['tf_ti']; ?>)}{(<?= $detail['mass_1']; ?>)}\)</p>
                                    <p class="mt-2">\({\Delta H_{fusion}} = <?= round($detail['h_fusion'], 3) ?>J(g.K)\)</p>
                                @elseif($two_time == 'c2')
                                    <p class="mt-2">\(c_2 = \dfrac{-m_1c_1(T_{fusion}-T_{i1})-m_1{\Delta H_{fusion}}}{m_1(T_f - T_{fusion})+m_2(T_f-T_{i2})}\);</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(-<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)+(<?= $detail['mass_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(<?= $detail['m1_c1']; ?>)(<?= $detail['t_fusion'] - $detail['in_temp_1']; ?>)-(<?= $detail['m1hfusion']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['fin_temp'] - $detail['t_fusion']; ?>)+(<?= $detail['mass_2']; ?>)(<?= $detail['fin_temp'] - $detail['in_temp_2']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(<?= $detail['m1_c1_tfusion_ti']; ?>)-(<?= $detail['m1hfusion']; ?>)}{(<?= $detail['m1_tf_tfusion']; ?>)+(<?= $detail['m2_tf_ti']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(<?= $detail['m1_c1_tfusion_ti'] - $detail['m1hfusion']; ?>)}{(<?= $detail['m1_tf_tfusion'] + $detail['m2_tf_ti']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = <?= round($detail['heat_capacity_2'], 3) ?>J/(g.K)\)</p>
                                @elseif($two_time == 'm2')
                                    <p class="mt-2">\(m_2 = \dfrac{-m_1c_1(T_{fusion}-T_{i1}) -m_1{\Delta H_{fusion}}-m_1c_2(T_f - T_{fusion})}{c_2(T_f-T_{i2})}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(-<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)}{(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['m1_c1']; ?>)(<?= $detail['t_fusion'] - $detail['in_temp_1']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['mass_1'] * $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp'] - $detail['t_fusion']; ?>)}{(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp'] - $detail['in_temp_2']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['m1_c1_tfusion_ti']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m1_c2_tf_tfusion']; ?>)}{(<?= $detail['c2_tf_ti']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['c2_tf_ti']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = <?= round($detail['mass_2'], 3) ?>g\)</p>
                                @elseif($two_time == 'Ti(2)')
                                    <p class="mt-2">\(T_{i2} = \dfrac{-m_1c_1(T_{fusion} - T_{i1})-m_1{\Delta H_{fusion}}-m_1c_2(T_f - T_{fusion})-T_f}{m_2c_2}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)-(<?= $detail['fin_temp']; ?>)}{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['m1_h1']; ?>)(<?= $detail['t_fusion'] - $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp'] - $detail['t_fusion']; ?>)-(<?= $detail['fin_temp']; ?>)}{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['m1_h1_tfusion_intemp']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m1c2_tf_tfusion']; ?>)-(<?= $detail['fin_temp']; ?>)}{(<?= $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = <?= round($detail['in_temp_2'], 3) ?>K\)</p>
                                @elseif($two_time == 'Tf')
                                    <p class="mt-2">\(T_f = \dfrac{m_1c_1(T_{fusion} - T_{i1})+m_1H_{fusion}-m_1c_2T_{fusion}-m_2c_2T_{i2}}{-m_1c_2-m_2c_2}\)</p>
                                    <p class="mt-2">\(T_f = \dfrac{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)+(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['t_fusion']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['in_temp_2']; ?>)}{-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_f = \dfrac{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion'] - $detail['in_temp_1']; ?>)+(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['t_fusion']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['in_temp_2']; ?>)}{-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_f = \dfrac{(<?= $detail['m1c1tfti']; ?>)+(<?= $detail['m1Hfusion']; ?>)-(<?= $detail['m1c1Tfusion']; ?>)-(<?= $detail['m2c2Ti2']; ?>)}{-(<?= $detail['m1c2']; ?>)-(<?= $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_f = \dfrac{(<?= $detail['m1c1tfti'] + $detail['m1Hfusion'] - $detail['m1c1Tfusion'] - $detail['m2c2Ti2']; ?>)}{(<?= -$detail['m1c2'] - $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_f = <?= round($detail['fin_temp'], 3) ?>K\)</p>
                                @endif
                            @endif
                
                            @if(isset($detail['formula_3obj']))
                                @if($formula_3obj == 'm1')
                                    <p><strong><?= $lang[34] ?>\((m_1)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['mass_1'], 3); ?> g</strong></p>
                                @elseif($formula_3obj == 'c1')
                                    <p><strong><?= $lang[37] ?>\((c_1)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['heat_capacity_1'], 3); ?> J/(g.K)</strong></p>
                                @elseif($formula_3obj == 'Tf(1)')
                                    <p><strong><?= $lang[39] ?>\((T_{f1})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['fin_temp_1'], 3); ?> K</strong></p>
                                @elseif($formula_3obj == 'Ti(1)')
                                    <p><strong><?= $lang[38] ?>\((T_{i1})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['in_temp_1'], 3); ?> K</strong></p>
                                @elseif($formula_3obj == 'm2')
                                    <p><strong><?= $lang[40] ?>\((m_2)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['mass_2'], 3); ?> g</strong></p>
                                @elseif($formula_3obj == 'c2')
                                    <p><strong>Specific Heat Of Object 2\((c_2)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['heat_capacity_2'], 3); ?> J/(g.K)</strong></p>
                                @elseif($formula_3obj == 'Tf(2)')
                                    <p><strong><?= $lang[43] ?>\((T_{f2})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['fin_temp_2'], 3); ?> K</strong></p>
                                @elseif($formula_3obj == 'Ti(2)')
                                    <p><strong><?= $lang[42] ?>\((T_{i2})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['in_temp_2'], 3); ?> K</strong></p>
                                @elseif($formula_3obj == 'm3')
                                    <p><strong><?= $lang[48] ?>\((m_3)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['mass_3'], 3); ?> g</strong></p>
                                @elseif($formula_3obj == 'c3')
                                    <p><strong><?= $lang[49] ?>\((c_3)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['heat_capacity_3'], 3); ?> J(g.K)</strong></p>
                                @elseif($formula_3obj == 'Tf(3)')
                                    <p><strong><?= $lang[29] ?> 3\((T_{f3})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['fin_temp_3'], 3); ?> K</strong></p>
                                @elseif($formula_3obj == 'Ti(3)')
                                    <p><strong>Initial Temperature 3\((T_{i3})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['in_temp_3'], 3); ?> K</strong></p>
                                @endif
                
                                <p><strong class="font-s-18">Solutions:</strong></p>
                
                                @if($formula_3obj == 'm1')
                                    <p class="mt-2">\(m_1 = \dfrac{m_2c_2(T_{f2} - T_{i2})-m_3c_3(T_{f_3} - T_{i3})}{c_1(T_{f1} -T_{i1})}\)</p>
                                    <p class="mt-2">\(m_1 = \dfrac{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)-(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp_3']; ?>-<?= $detail['in_temp_3']; ?>)}{(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = \dfrac{(<?= $detail['mass_2'] * $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2'] - $detail['in_temp_2']; ?>)-(<?= $detail['m3c3'] ?>)(<?= $detail['tf_ti3'] ?>)}{(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1'] - $detail['in_temp_1']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = \dfrac{(<?= $detail['m2c2'] * $detail['tf_ti2']; ?>)-(<?= $detail['m3c3_tf_ti3'] ?>)}{(<?= $detail['c1_tf_ti1']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = \dfrac{(<?= $detail['res'] ?>)}{(<?= $detail['c1_tf_ti1']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = <?= round($detail['mass_1'], 3) ?>g\)</p>
                                @elseif($formula_3obj == 'c1')
                                    <p class="mt-2">\(c_1 = \dfrac{-m_2c_2(T_{f2} - T_{i2})-m_1c_3(T_{f3} - T_{i3})}{m_1(T_{f1}-T_{i1})}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(-<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)-(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp_3']; ?>-<?= $detail['in_temp_3']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)-(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['tf_ti1']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(<?= $detail['m2c2tf2ti2']; ?>)-(<?= $detail['m3c3_tf_ti3']; ?>)}{(<?= $detail['m1_tf_ti1']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m1_tf_ti1']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = <?= round($detail['heat_capacity_1'], 3) ?>J/(g.K)\)</p>
                                @elseif($formula_3obj == 'Tf(1)')
                                    <p class="mt-2">\(T_{f1} = \dfrac{-(m_2)c_2(T_{f2} - T_{i2})-m_3c_3(T_{f3} - T_{i3})+T_{i1}}{m_1c_1}\)</p>
                                    <p class="mt-2">\(T_{f1} = \dfrac{(-<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)-(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp_3']; ?>-<?= $detail['in_temp_3']; ?>)+(<?= $detail['in_temp_1']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f1} = \dfrac{(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)-(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)+(<?= $detail['in_temp_1']; ?>)}{(<?= $detail['m1c1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f1} = \dfrac{(<?= $detail['m2c2tf2ti2']; ?>)-(<?= $detail['m3c3_tf_ti3']; ?>)+(<?= $detail['in_temp_1']; ?>)}{(<?= $detail['m1c1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f1} = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m1c1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f1} = <?= round($detail['fin_temp_1'], 3) ?>K\)</p>
                                @elseif($formula_3obj == 'Ti(1)')
                                    <p class="mt-2">\(T_{i1} = \dfrac{m_2c_2(T_{f2} - T_{i2})-m_3c_3(T_{f3} - T_{i3})+T_{f1}}{m_1c_1}\)</p>
                                    <p class="mt-2">\(T_{i1} = \dfrac{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)-(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp_3']; ?>-<?= $detail['in_temp_3']; ?>)+(<?= $detail['fin_temp_1']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i1} = \dfrac{(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)-(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)+(<?= $detail['fin_temp_1']; ?>)}{(<?= $detail['m1c1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i1} = \dfrac{(<?= $detail['m2c2tf2ti2']; ?>)-(<?= $detail['m3c3_tf_ti3']; ?>)+(<?= $detail['fin_temp_1']; ?>)}{(<?= $detail['m1c1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i1} = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m1c1']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i1} = <?= round($detail['in_temp_1'], 3) ?>K\)</p>
                                @elseif($formula_3obj == 'm2')
                                    <p class="mt-2">\(m_2 = \dfrac{m_1c_1(T_{f1} - T_{i1})-m_3c_3(T_{f3} - T_{i3})}{c_2(T_{f2}-T{i2})}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp_3']; ?>-<?= $detail['in_temp_3']; ?>)}{(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?> - <?= $detail['in_temp_2']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tf_ti1']; ?>)-(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)}{(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['tf2ti2']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['m1c1tf1ti1']; ?>)-(<?= $detail['m3c3_tf_ti3']; ?>)}{(<?= $detail['c2tf2ti2']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['c2tf2ti2']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = <?= round($detail['mass_2'], 3) ?>g\)</p>
                                @elseif($formula_3obj == 'c2')
                                    <p class="mt-2">\(c_2 = \dfrac{-m_1c_1(T_{f1} - T_{i1})-m_3c_3(T_{f3} - T_{i3})}{m_2(T_{f2}-T_{i2})}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(-<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp_3']; ?>-<?= $detail['in_temp_3']; ?>)}{(<?= $detail['mass_2']; ?>)(<?= $detail['fin_temp_2']; ?> - <?= $detail['in_temp_2']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tf_ti1']; ?>)-(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)}{(<?= $detail['mass_2']; ?>)(<?= $detail['tf2ti2']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(<?= $detail['m1c1tf1ti1']; ?>)-(<?= $detail['m3c3_tf_ti3']; ?>)}{(<?= $detail['m2tf2ti2']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m2tf2ti2']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = <?= round($detail['heat_capacity_2'], 3) ?>J/(g.K)\)</p>
                                @elseif($formula_3obj == 'Tf(2)')
                                    <p class="mt-2">\(T_{f2} = \dfrac{-m_1c_1(T_{f1} - T_{i1})-m_3c_3(T_{f3} - T_{i3})+T_{i2}}{m_2c_2}\)</p>
                                    <p class="mt-2">\(T_{f2} = \dfrac{(-<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp_3']; ?>-<?= $detail['in_temp_3']; ?>)+(<?= $detail['in_temp_2']; ?>)}{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f2} = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tf_ti1']; ?>)-(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)+(<?= $detail['in_temp_2']; ?>)}{(<?= $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f2} = \dfrac{(<?= $detail['m1c1tf1ti1']; ?>)-(<?= $detail['m3c3_tf_ti3']; ?>)+(<?= $detail['in_temp_2']; ?>)}{(<?= $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f2} = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f2} = <?= round($detail['fin_temp_2'], 3) ?>K\)</p>
                                @elseif($formula_3obj == 'Ti(2)')
                                    <p class="mt-2">\(T_{i2} = \dfrac{m_1c_1(T_{f1} - T_{i1})+m_3c_3(T_{f3} - T_{i3})+T_{f2}}{m_2c_2}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)+(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp_3']; ?>-<?= $detail['in_temp_3']; ?>)+(<?= $detail['fin_temp_2']; ?>)}{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tf_ti1']; ?>)+(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)+(<?= $detail['fin_temp_2']; ?>)}{(<?= $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['m1c1tf1ti1']; ?>)+(<?= $detail['m3c3_tf_ti3']; ?>)+(<?= $detail['fin_temp_2']; ?>)}{(<?= $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = <?= round($detail['in_temp_2'], 3) ?>K\)</p>
                                @elseif($formula_3obj == 'm3')
                                    <p class="mt-2">\(m_3 = \dfrac{m_1c_1(T_{f1} - T_{i1})-m_2c_2(T_{f2} - T_{i2})}{c_3(T_{f3}-T_{i3})}\)</p>
                                    <p class="mt-2">\(m_3 = \dfrac{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)}{(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp_3']; ?>-<?= $detail['in_temp_3']; ?>)}\)</p>
                                    <p class="mt-2">\(m_3 = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tf_ti1']; ?>)-(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)}{(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['tf_ti3']; ?>)}\)</p>
                                    <p class="mt-2">\(m_3 = \dfrac{(<?= $detail['m1c1tf1ti1']; ?>)-(<?= $detail['m2c2tf2ti2']; ?>)}{(<?= $detail['c3tf3ti3']; ?>)}\)</p>
                                    <p class="mt-2">\(m_3 = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['c3tf3ti3']; ?>)}\)</p>
                                    <p class="mt-2">\(m_3 = <?= round($detail['mass_3'], 3) ?>g\)</p>
                                @elseif($formula_3obj == 'c3')
                                    <p class="mt-2">\(c_3 = \dfrac{-m_1c_1(T_{f1} - T_{i1})-m_2c_2(T_{f2} - T_{i2})}{m_3(T_{f3}-T_{i3})}\)</p>
                                    <p class="mt-2">\(c_3 = \dfrac{(-<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)}{(<?= $detail['mass_3']; ?>)(<?= $detail['fin_temp_3']; ?>-<?= $detail['in_temp_3']; ?>)}\)</p>
                                    <p class="mt-2">\(c_3 = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tf_ti1']; ?>)-(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)}{(<?= $detail['mass_3']; ?>)(<?= $detail['tf_ti3']; ?>)}\)</p>
                                    <p class="mt-2">\(c_3 = \dfrac{(<?= $detail['m1c1tf1ti1']; ?>)-(<?= $detail['m2c2tf2ti2']; ?>)}{(<?= $detail['mass_3']; ?>)(<?= $detail['tf_ti3']; ?>)}\)</p>
                                    <p class="mt-2">\(c_3 = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m3tf3ti3']; ?>)}\)</p>
                                    <p class="mt-2">\(c_3 = <?= round($detail['heat_capacity_3'], 3) ?>J(g.K)\)</p>
                                @elseif($formula_3obj == 'Tf(3)')
                                    <p class="mt-2">\(T_{f3} = \dfrac{-m_1c_1(T_{f1} - T_{i1})-m_2c_2(T_{f2} - T_{i2})+T_{i3}}{m_3c_3}\)</p>
                                    <p class="mt-2">\(T_{f3} = \dfrac{(-<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)+(<?= $detail['in_temp_3']; ?>)}{(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f3} = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tf_ti1']; ?>)-(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)+(<?= $detail['in_temp_3']; ?>)}{(<?= $detail['m3c3']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f3} = \dfrac{(<?= $detail['m1c1tf1ti1']; ?>)-(<?= $detail['m2c2tf2ti2']; ?>)+(<?= $detail['in_temp_3']; ?>)}{(<?= $detail['m3c3']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f3} = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m3c3']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{f3} = <?= round($detail['fin_temp_3'], 3) ?>K\)</p>
                                @elseif($formula_3obj == 'Ti(3)')
                                    <p class="mt-2">\(T_{i3} = \dfrac{m_1c_1(T_{f1} - T_{i1})+m_2c_2(T_{f2} - T_{i2})+T_{f3}}{m_3c_3}\)</p>
                                    <p class="mt-2">\(T_{i3} = \dfrac{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['fin_temp_1']; ?>-<?= $detail['in_temp_1']; ?>)+(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp_2']; ?>-<?= $detail['in_temp_2']; ?>)+(<?= $detail['fin_temp_3']; ?>)}{(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i3} = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tf_ti1']; ?>)+(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)+(<?= $detail['fin_temp_3']; ?>)}{(<?= $detail['m3c3']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i3} = \dfrac{(<?= $detail['m1c1tf1ti1']; ?>)+(<?= $detail['m2c2tf2ti2']; ?>)+(<?= $detail['fin_temp_3']; ?>)}{(<?= $detail['m3c3']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i3} = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m3c3']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i3} = <?= round($detail['in_temp_3'], 3) ?>K\)</p>
                                @endif
                            @endif
                
                            @if(isset($detail['three_time']))
                                @if($three_time == 'm1')
                                    <p><strong><?= $lang[34] ?>\((m_1)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['mass_1'], 3); ?> g</strong></p>
                                @elseif($three_time == 'c1')
                                    <p><strong><?= $lang[37] ?>\((c_1)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['heat_capacity_1'], 3); ?> J/(g.K)</strong></p>
                                @elseif($three_time == 'Tfusion')
                                    <p><strong><?= $lang[46] ?> \((T_{fusion})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['t_fusion'], 3); ?> K</strong></p>
                                @elseif($three_time == 'Ti(1)')
                                    <p><strong><?= $lang[38] ?> \((T_{i1})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['in_temp_1'], 3); ?> K</strong></p>
                                @elseif($three_time == 'Hfusion')
                                    <p><strong><?= $lang[47] ?> \(({\Delta H_{fusion}})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['h_fusion'], 3); ?> J/(g.K)</strong></p>
                                @elseif($three_time == 'c2')
                                    <p><strong><?= $lang[41] ?>\((c_2)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['heat_capacity_2'], 3); ?> J/(g.K)</strong></p>
                                @elseif($three_time == 'm2')
                                    <p><strong><?= $lang[40] ?>\((m_2)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['mass_2'], 3); ?> g</strong></p>
                                @elseif($three_time == 'Ti(2)')
                                    <p><strong><?= $lang[42] ?>\((T_{i2})\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['in_temp_2'], 3); ?> K</strong></p>
                                @elseif($three_time == 'm3')
                                    <p><strong><?= $lang[48] ?>\((m_3)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['mass_3'], 3); ?> g</strong></p>
                                @elseif($three_time == 'c3')
                                    <p><strong><?= $lang[49] ?>\((c_3)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['heat_capacity_3'], 3); ?> J/(g.K)</strong></p>
                                @elseif($three_time == 'Tf')
                                    <p><strong><?= $lang[29] ?>\((T_f)\)</strong></p>
                                    <p><strong class="text-green font-s-32"><?= round($detail['fin_temp'], 3); ?> K</strong></p>
                                @endif
                
                                <p><strong class="font-s-18"><?= $lang[35] ?>:</strong></p>
                
                                @if($three_time == 'm1')
                                    <p class="mt-2">\(m_1 = \dfrac{(m_2)c_2(T_f - T_{i2})-m_3c_3(T_f - T_{i3})}{c_1(T_{fusion} - T_{i1})+ {\Delta H_{fusion}} + c_2(T_f - T_{fusion})}\)</p>
                                    <p class="mt-2">\(m_1 = \dfrac{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)-(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_3']; ?>)}{(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)+(<?= $detail['h_fusion']; ?>)+(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = \dfrac{(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2'] ?>)-(<?= $detail['m3c3'] ?>)(<?= $detail['tf_ti3'] ?>)}{(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['tfusion_ti']; ?>)+(<?= $detail['h_fusion']; ?>)+(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['tf_tfusion']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = \dfrac{(<?= $detail['m2c2tfti2'] ?>)-(<?= $detail['m3c3tfti3'] ?>)}{(<?= $detail['c1_tfusion_ti']; ?>)+(<?= $detail['h_fusion']; ?>)+(<?= $detail['c2_tf_tfusion']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = \dfrac{(<?= $detail['m2c2tf2ti2_m3c3tfti3'] ?>)}{(<?= $detail['c1tfusionti1_hfusion_c2tftfusion']; ?>)}\)</p>
                                    <p class="mt-2">\(m_1 = <?= round($detail['mass_1'], 3) ?>g\)</p>
                                @elseif($three_time == 'c1')
                                    <p class="mt-2">\(c_1 = \dfrac{-(m_1){\Delta H_{fusion}}+m_1c_2(T_f - T_{fusion})+m_2c_2(T_f - T_{i2})+m_3c_3(T_f-T_{i3})}{m_1(T_{fusion} - T_{i1})}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(-<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)+(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)+(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)+(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_3']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['t_fusion']; ?> - <?= $detail['in_temp_1']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(<?= $detail['m1hfusion']; ?>)+(<?= $detail['mass_1'] * $detail['heat_capacity_2']; ?>)(<?= $detail['tf_tfusion']; ?>)+(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)+(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['tfusion_ti1']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(<?= $detail['m1hfusion']; ?>)+(<?= $detail['mass_1'] * $detail['heat_capacity_2'] * $detail['tf_tfusion']; ?>)+(<?= $detail['m2c2'] * $detail['tf_ti2']; ?>)+(<?= $detail['m3c3'] * $detail['tf_ti3']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['tfusion_ti1']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m1tfusionti1']; ?>)}\)</p>
                                    <p class="mt-2">\(c_1 = <?= round($detail['heat_capacity_1'], 3) ?>J/(g.K)\)</p>
                                @elseif($three_time == 'Tfusion')
                                    <p class="col s12 font_size5 margin_top_15">\(T_{fusion} = \dfrac{m_2c_2(T_f - T_{i2})+m_3c_3(T_f - T_{i3})-m_1{\Delta H_{fusion}}+m_1c_1T_{i1}-m_2c_2T_f}{m_1c_1-m_1c_2}\)</p>
                                    <p class="col s12 font_size2 margin_top_15">\(T_{fusion} = \dfrac{(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)+(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_3']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)+(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="col s12 font_size7 margin_top_15">\(T_{fusion} = \dfrac{(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)+(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)-(<?= $detail['m1hfusion']; ?>)+(<?= $detail['m1c1ti1']; ?>)-(<?= $detail['m1c2tf']; ?>)}{(<?= $detail['m1c1']; ?>)-(<?= $detail['m1c2']; ?>)}\)</p>
                                    <p class="col s12 font_size7 margin_top_15">\(T_{fusion} = \dfrac{(<?= $detail['m2c2'] * $detail['tf_ti2']; ?>)+(<?= $detail['m3c3'] * $detail['tf_ti3']; ?>)-(<?= $detail['m1hfusion']; ?>)+(<?= $detail['m1c1ti1']; ?>)-(<?= $detail['m1c2tf']; ?>)}{(<?= $detail['m1c1']; ?>)-(<?= $detail['m1c2']; ?>)}\)</p>
                                    <p class="col s12 font_size7 margin_top_15">\(T_{fusion} = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['div']; ?>)}\)</p>
                                    <p class="col s12 font_size7 margin_top_15">\(T_{fusion} = <?= round($detail['t_fusion'], 3) ?>K\)</p>
                                @elseif($three_time == 'Ti(1)')
                                    <p class="col s12 font_size12 margin_top_15">\(T_{i1} = \dfrac{-m_1{\Delta H_{fusion}}-m_1c_2(T_f - T_{fusion})+m_2c_2(T_f - T_{i2})+m_3c_3(T_f - T_{i3})-m_1c_1T_{fussion}}{-m_1c_1}\)</p>
                                    <p class="col s12 font_size12 margin_top_15">\(T_{i1} = \dfrac{(<?= -$detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)+(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)+(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_3']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>)}{(-<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)}\)</p>
                                    <p class="col s12 font_size14 margin_top_15">\(T_{i1} = \dfrac{(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m1c2']; ?>)(<?= $detail['tf_tfusion']; ?>)+(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)+(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)-(<?= $detail['m1c1tfusion']; ?>)}{(<?= $detail['m1c1']; ?>)}\)</p>
                                    <p class="col s12 font_size14 margin_top_15">\(T_{i1} = \dfrac{(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m1c2'] * $detail['tf_tfusion']; ?>)+(<?= $detail['m2c2'] * $detail['tf_ti2']; ?>)+(<?= $detail['m3c3'] * $detail['tf_ti3']; ?>)-(<?= $detail['m1c1tfusion']; ?>)}{(<?= $detail['m1c1']; ?>)}\)</p>
                                    <p class="col s12 font_size14 margin_top_15">\(T_{i1} = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m1c1']; ?>)}\)</p>
                                    <p class="col s12 font_size14 margin_top_15">\(T_{i1} = <?= round($detail['in_temp_1'], 3) ?>K\)</p>
                                @elseif($three_time == 'Hfusion')
                                    <p class="mt-2">\({\Delta H_{fusion}} = \dfrac{-m_1c_1(T_{fusion} - T_{i1})-m_1c_2(T_f - T_{fusion})-m_2c_2(T_f - T_{i2})-m_3c_3(T_f - T_{i3})}{m_1}\)</p>
                                    <p class="mt-2">\({\Delta H_{fusion}} = \dfrac{(<?= -$detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)-(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_3']; ?>)}{(<?= $detail['mass_1']; ?>)}\)</p>
                                    <p class="mt-2">\({\Delta H_{fusion}} = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tfusionti1']; ?>)-(<?= $detail['m1c2']; ?>)(<?= $detail['tf_tfusion']; ?>)-(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)-(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)}{(<?= $detail['mass_1']; ?>)}\)</p>
                                    <p class="mt-2">\({\Delta H_{fusion}} = \dfrac{(<?= $detail['m1c1tfusionti1']; ?>)-(<?= $detail['m1c2tftfusion']; ?>)-(<?= $detail['m2c2tfti2']; ?>)-(<?= $detail['m3c3tfti3']; ?>)}{(<?= $detail['mass_1']; ?>)}\)</p>
                                    <p class="mt-2">\({\Delta H_{fusion}} = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['mass_1']; ?>)}\)</p>
                                    <p class="mt-2">\({\Delta H_{fusion}} = <?= round($detail['h_fusion'], 3) ?>J/(g.K)\)</p>
                                @elseif($three_time == 'c2')
                                    <p class="mt-2">\(c_2 = \dfrac{-m_1c_1(T_{fusion} - T_{i1})-m_1{\Delta H_{fusion}}-m_3c_3(T_f - T_{i3})}{m_1(T_f - T_{fusion})+m_2(T_f - T_{i2})}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(<?= -$detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_3']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)+(<?= $detail['mass_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tfusionti1']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['tf_tfusion']; ?>)+(<?= $detail['mass_2']; ?>)(<?= $detail['tf_ti2']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(<?= $detail['m1c1tfusionti1']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m3c3tfti3']; ?>)}{(<?= $detail['m1tftfusion']; ?>)(<?= $detail['m2tfti2']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['div']; ?>)}\)</p>
                                    <p class="mt-2">\(c_2 = <?= round($detail['heat_capacity_2'], 3) ?>J/(g.K)\)</p>
                                @elseif($three_time == 'm2')
                                    <p class="mt-2">\(m_2 = \dfrac{m_1c_1(T_{fusion} - T_{i1})-m_1{\Delta H_{fusion}}-m_1c_2(T_f - T_{fusion})-m_3c_3(T_f - T_{i3})}{c_2(T_f - T_{i2})}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= -$detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)-(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_3']; ?>)}{(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tfusionti1']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m1c2']; ?>)(<?= $detail['tf_tfusion']; ?>)-(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)}{(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['tf_ti2']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['m1c1tfusionti1']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m1c2tftfuion']; ?>)-(<?= $detail['m3c3'] * $detail['tf_ti3']; ?>)}{(<?= $detail['c2tfti2']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['c2tfti2']; ?>)}\)</p>
                                    <p class="mt-2">\(m_2 = <?= round($detail['mass_2'], 3) ?>g\)</p>
                                @elseif($three_time == 'Ti(2)')
                                    <p class="mt-2">\(T_{i2} = \dfrac{-m_1c_1(T_{fusion} - T_{i1})-m_1{\Delta H_{fusion}}-m_1c_2(T_f - T_{fusion})-m_3c_3(T_f - T_{i3})-m_2c_2T_f}{-m_2c_2}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= -$detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)-(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_3']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>)}{(-<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tfusionti1']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m1c2']; ?>)(<?= $detail['tf_tfusion']; ?>)-(<?= $detail['m3c3']; ?>)(<?= $detail['tf_ti3']; ?>)-(<?= $detail['m2c2tf']; ?>)}{(<?= $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['m1c1tfusionti1']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m1c2tftfuion']; ?>)-(<?= $detail['m3c3tfti3']; ?>)-(<?= $detail['m2c2tf']; ?>)}{(<?= $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m2c2']; ?>)}\)</p>
                                    <p class="mt-2">\(T_{i2} = <?= round($detail['in_temp_2'], 3) ?>K\)</p>
                                @elseif($three_time == 'm3')
                                    <p class="mt-2">\(m_3 = \dfrac{m_1c_1(T_{fusion} - T_{i1})-m_1{\Delta H_{fusion}}-m_1c_2(T_f - T_fusion)-m_2c_2(T_f - T_{i2})}{c_3(T_f - T_{i3})}\)</p>
                                    <p class="mt-2">\(m_3 = \dfrac{(<?= -$detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)}{(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_3']; ?>)}\)</p>
                                    <p class="mt-2">\(m_3 = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tfusionti1']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m1c2']; ?>)(<?= $detail['tf_tfusion']; ?>)-(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)}{(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['tfti3']; ?>)}\)</p>
                                    <p class="mt-2">\(m_3 = \dfrac{(<?= $detail['m1c1tfusionti1']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m1c2tftfuion']; ?>)-(<?= $detail['m2c2tfti2']; ?>)}{(<?= $detail['c3tfti3']; ?>)}\)</p>
                                    <p class="mt-2">\(m_3 = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['c3tfti3']; ?>)}\)</p>
                                    <p class="mt-2">\(m_3 = <?= round($detail['mass_3'], 3) ?>g\)</p>
                                @elseif($three_time == 'c3')
                                    <p class="mt-2">\(c_3 = \dfrac{-m_1c_1(T_{fusion} - T_{i1})-m_1{\Delta H_{fusion}}-m_1c_2(T_f - T_{fusion})-m_2c_2(T_f - T_{i2})}{m_3(T_f - T_{i3})}\)</p>
                                    <p class="mt-2">\(c_3 = \dfrac{(<?= -$detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['t_fusion']; ?>)-(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_2']; ?>)}{(<?= $detail['mass_3']; ?>)(<?= $detail['fin_temp']; ?>-<?= $detail['in_temp_3']; ?>)}\)</p>
                                    <p class="mt-2">\(c_3 = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tfusionti1']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m1c2']; ?>)(<?= $detail['tf_tfusion']; ?>)-(<?= $detail['m2c2']; ?>)(<?= $detail['tf_ti2']; ?>)}{(<?= $detail['mass_3']; ?>)(<?= $detail['tfti3']; ?>)}\)</p>
                                    <p class="mt-2">\(c_3 = \dfrac{(<?= $detail['m1c1tfusionti1']; ?>)-(<?= $detail['m1hfusion']; ?>)-(<?= $detail['m1c2tftfuion']; ?>)-(<?= $detail['m2c2tfti2']; ?>)}{(<?= $detail['m3tfti3']; ?>)}\)</p>
                                    <p class="mt-2">\(c_3 = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m3tfti3']; ?>)}\)</p>
                                    <p class="mt-2">\(c_3 = <?= round($detail['heat_capacity_3'], 3) ?>J/(g.K)\)</p>
                                @elseif($three_time == 'Tf')
                                    <p class="mt-2">\(T_f = \dfrac{-m_1c_1(T_{fusion} - T_{i1})-m_1{\Delta H_{fusion}}+m_1c_2T_{fusion}+m_2c_2T_{i2}+m_3c_3T_{i3}}{m_1c_2 + m_2c_2 + m_3c_3}\)</p>
                                    <p class="col s12 font_size14 margin_top_15">\(T_f = \dfrac{(<?= -$detail['mass_1']; ?>)(<?= $detail['heat_capacity_1']; ?>)(<?= $detail['t_fusion']; ?>-<?= $detail['in_temp_1']; ?>)-(<?= $detail['mass_1']; ?>)(<?= $detail['h_fusion']; ?>)+(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['t_fusion']; ?>)+(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)(<?= $detail['in_temp_2']; ?>)+(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)(<?= $detail['in_temp_3']; ?>)}{(<?= $detail['mass_1']; ?>)(<?= $detail['heat_capacity_2']; ?>)+(<?= $detail['mass_2']; ?>)(<?= $detail['heat_capacity_2']; ?>)+(<?= $detail['mass_3']; ?>)(<?= $detail['heat_capacity_3']; ?>)}\)</p>
                                    <p class="mt-2">\(T_f = \dfrac{(<?= $detail['m1c1']; ?>)(<?= $detail['tfusionti1']; ?>)-(<?= $detail['m1hfusion']; ?>)+(<?= $detail['m1c2tfusion']; ?>)+(<?= $detail['m2c2ti2']; ?>)+(<?= $detail['m3c3Ti3']; ?>)}{(<?= $detail['m1c2']; ?>)+(<?= $detail['m2c2']; ?>)+(<?= $detail['m3c3']; ?>)}\)</p>
                                    <p class="mt-2">\(T_f = \dfrac{(<?= $detail['m1c1tfusionti1']; ?>)-(<?= $detail['m1hfusion']; ?>)+(<?= $detail['m1c2tfusion']; ?>)+(<?= $detail['m2c2ti2']; ?>)+(<?= $detail['m3c3Ti3']; ?>)}{(<?= $detail['m1c2m2c2m3c3']; ?>)}\)</p>
                                    <p class="mt-2">\(T_f = \dfrac{(<?= $detail['res']; ?>)}{(<?= $detail['m1c2m2c2m3c3']; ?>)}\)</p>
                                    <p class="mt-2">\(T_f = <?= round($detail['fin_temp'], 3) ?>K\)</p>
                                @endif
                            @endif
                        </div>
                        <div class="w-full text-center mt-3">
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
    @endisset
    @push('calculatorJS')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>

                $('#myselection').on('change', function() {
                    var demovalue = $(this).val();
                    if (demovalue == 'heat exchange between several objects') {
                        $(".single_object, .formula").hide();
                        $("div.fimg3, div.state, .obj_1, .obj_2").show();
                        $(".two_time, div.f_temp_two, div.t_fusion, div.h_fusion, div.mass1").hide();
                    } else {
                        $("div.fimg3, div.state, .obj_1, .obj_2, .obj_3").hide();
                        $(".single_object, .formula").show();
                    }
                });

                $('#objects').on('change', function() {
                    var demovalue = $(this).val();
                    if (demovalue == '2') {
                        $("div.object_2, .obj_1").show();
                        $(".obj_3").hide();
                    } else if (demovalue == '3') {
                        $(".obj_1, div.object_2").hide();
                        $(".obj_3").show();
                    }
                });

                $('#obj_change').on('change', function() {
                    var demovalue = $(this).val();
                    if (demovalue == 'No') {
                        $("select#object_formula_change, div.f_temp1, div.f_temp2, div.f_temp1, select#object3_formula_change").show();
                        $(".two_time, div.f_temp_two, div.t_fusion, div.h_fusion, .three_time").hide();
                    } else if (demovalue == 'Yes,two times') {
                        $("select#object_formula_change").hide();
                        $(".two_time, .three_time, div.f_temp_two, div.t_fusion, div.h_fusion").show();
                        $("div.mass1, div.f_temp2, div.f_temp1, select#object3_formula_change").hide();
                    }

                });

                $('#object_formula_change').on('change', function() {
                    var demovalue = $(this).val();
                    if (demovalue == 'm1') {
                        $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.s_h_c1, div.f_temp1, div.i_temp1").show();
                        $("div.mass1").hide();
                    } else if (demovalue == 'c1') {
                        $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass1, div.f_temp1, div.i_temp1").show();
                        $("div.s_h_c1").hide();
                    } else if (demovalue == 'Ti(1)') {
                        $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.f_temp1, div.mass1, div.s_h_c1").show();
                        $("div.i_temp1").hide();
                    } else if (demovalue == 'Tf(1)') {
                        $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.i_temp1, div.mass1, div.s_h_c1").show();
                        $("div.f_temp1").hide();
                    } else if (demovalue == 'm2') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                        $("div.mass2").hide();

                    } else if (demovalue == 'c2') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass2, div.f_temp2, div.i_temp2").show();
                        $("div.s_h_c2").hide();
                    } else if (demovalue == 'Ti(2)') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.f_temp2, div.mass2, div.s_h_c2").show();
                        $("div.i_temp2").hide();
                    } else if (demovalue == 'Tf(2)') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass2, div.s_h_c2").show();
                        $("div.f_temp2, div.i_temp2").hide();
                    } else if (demovalue == 'q1') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1").show();
                        $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2").hide();
                    } else if (demovalue == 'q2') {
                        $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1").hide();
                    }

                });

                $('#two_time').on('change', function() {
                    var demovalue = $(this).val();
                    if (demovalue == 'm1_two') {
                        $("div.mass2, div.s_h_c2, div.f_temp_two, div.i_temp2, div.s_h_c1, div.t_fusion, div.i_temp1, div.h_fusion").show();
                        $("div.mass1, div.f_temp1, div.f_temp2").hide();
                    } else if (demovalue == 'c1_two') {
                        $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2").show();
                        $("div.s_h_c1").hide();
                    } else if (demovalue == 'Ti(1)') {
                        $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2, div.s_h_c1").show();
                        $("div.i_temp1").hide();
                    } else if (demovalue == 'Tfusion') {
                        $("div.mass1, div.h_fusion, div.mass2, div.s_h_c2, div.f_temp, div.i_temp2, div.s_h_c1").show();
                        $("div.i_temp1, div.t_fusion").hide();
                    } else if (demovalue == 'ΔHfusion') {
                        $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.s_h_c2, div.f_temp, div.mass2, div.i_temp2").show();
                        $("div.h_fusion").hide();
                    } else if (demovalue == 'c2') {
                        $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.mass2, div.i_temp2, div.h_fusion").show();
                        $("div.s_h_c2").hide();
                    } else if (demovalue == 'm2') {
                        $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.i_temp2, div.h_fusion, div.s_h_c2").show();
                        $("div.mass2").hide();
                    } else if (demovalue == 'Ti(2)') {
                        $("div.mass1, div.s_h_c1, div.h_fusion, div.i_temp1, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2").show();
                        $("div.i_temp2").hide();
                    } else if (demovalue == 'Tf') {
                        $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.i_temp2, div.mass2, div.h_fusion,div.s_h_c2").show();
                        $("div.f_temp, div.f_temp_two").hide();
                    }
                });

                $('#object3_formula_change').on('change', function() {
                    var demovalue = $(this).val();
                    if (demovalue == 'm1') {
                        $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.s_h_c1, div.f_temp1, div.i_temp1").show();
                        $("div.mass1").hide();
                    } else if (demovalue == 'c1') {
                        $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.f_temp1, div.i_temp1, div.mass1").show();
                        $("div.s_h_c1").hide();
                    } else if (demovalue == 'Tf(1)') {
                        $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.i_temp1, div.mass1, div.s_h_c1").show();
                        $("div.f_temp1").hide();
                    } else if (demovalue == 'Ti(1)') {
                        $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.f_temp1, div.mass1, div.s_h_c1").show();
                        $("div.i_temp1").hide();
                    } else if (demovalue == 'm2') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                        $("div.mass2").hide();
                    } else if (demovalue == 'c2') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.mass2, div.f_temp2, div.i_temp2").show();
                        $("div.s_h_c2").hide();
                    } else if (demovalue == 'Tf(2)') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.i_temp2, div.mass2, div.s_h_c2").show();
                        $("div.f_temp2").hide();
                    } else if (demovalue == 'Ti(2)') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2").show();
                        $("div.i_temp2").hide();
                    } else if (demovalue == 'm3') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.s_h_c3, div.f_temp3, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                        $("div.mass3").hide();
                    } else if (demovalue == 'c3') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.f_temp3, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3").show();
                        $("div.s_h_c3").hide();
                    } else if (demovalue == 'Tf(3)') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3").show();
                        $("div.f_temp3").hide();
                    } else if (demovalue == 'Ti(3)') {
                        $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3").show();
                        $("div.i_temp3").hide();
                    }
                });

                $('#three_time').on('change', function() {
                    var demovalue = $(this).val();
                    if (demovalue == 'm1') {
                        $("div.mass2, div.s_h_c2, div.f_temp, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.s_h_c1, div.t_fusion, div.i_temp1, div.h_fusion").show();
                        $("div.mass1,div.f_temp3").hide();
                    } else if (demovalue == 'c1') {
                        $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3").show();
                        $("div.s_h_c1, div.i_temp1, div.f_temp3").hide();
                    } else if (demovalue == 'Tfusion') {
                        $("div.mass2, div.s_h_c2, div.f_temp, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.mass1, div.h_fusion, div.s_h_c1, div.i_temp1").show();
                        $("div.t_fusion, div.f_temp3").hide();
                    } else if (demovalue == 'Ti(1)') {
                        $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.s_h_c1").show();
                        $("div.i_temp1, div.f_temp3").hide();
                    } else if (demovalue == 'Hfusion') {
                        $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.s_h_c2, div.f_temp, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3").show();
                        $("div.h_fusion, div.f_temp3").hide();
                    } else if (demovalue == 'c2') {
                        $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.h_fusion").show();
                        $("div.s_h_c2, div.f_temp3").hide();
                    } else if (demovalue == 'm2') {
                        $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.h_fusion, div.s_h_c2").show();
                        $("div.mass2, div.f_temp3").hide();
                    } else if (demovalue == 'Ti(2)') {
                        $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.mass3, div.s_h_c3, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2").show();
                        $("div.i_temp2, div.f_temp3").hide();
                    } else if (demovalue == 'm3') {
                        $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.s_h_c3, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2, div.i_temp2").show();
                        $("div.mass3, div.f_temp3").hide();
                    } else if (demovalue == 'c3') {
                        $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2, div.i_temp2, div.mass3").show();
                        $("div.s_h_c3, div.f_temp3").hide();
                    } else if (demovalue == 'Tf') {
                        $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2, div.i_temp2, div.mass3, div.s_h_c3").show();
                        $("div.f_temp_two, div.f_temp, div.f_temp3").hide();
                    }
                });

                $('#formula_change').on('change', function() {
                    var demovalue = $(this).val();
                    if (demovalue == 'Heat Energy') {
                        $("p.he, div.s_h_c, div.mass, div.temp, div.formula, p.by, div.temp_change").show();
                        $("p.sh, p.m, p.i_t, p.f_t, p.t_i, p.e_c, div.s_m, div.m_m, div.en").hide();
                        if ($('input[name="type"]:checked').val() == 'temp_change') {
                            $("div.temp_change, .t_c").show();
                            $("div.i_temp, div.f_temp, .i_f_t").hide();
                        } else if ($('input[name="type"]:checked').val() == 'i_f_temp') {
                            $("div.temp_change, .t_c").hide();
                            $("div.i_temp, div.f_temp, .i_f_t").show();
                        }
                    } else if (demovalue == 'Specific Heat') {
                        $("p.sh, div.en, div.mass, div.formula, div.temp, p.by, div.temp_change").show();
                        $("p.m, p.he, div.m_m, p.i_t, p.f_t, p.t_i, p.e_c, div.s_h_c, div.s_m").hide();
                        if ($('input[name="type"]:checked').val() == 'temp_change') {
                            $("div.temp_change, .t_c").show();
                            $("div.i_temp, div.f_temp, .i_f_t").hide();
                        } else if ($('input[name="type"]:checked').val() == 'i_f_temp') {
                            $("div.temp_change, .t_c").hide();
                            $("div.i_temp, div.f_temp, .i_f_t").show();
                        }

                    } else if (demovalue == 'Mass') {
                        $("p.m, div.en, div.s_h_c, div.temp, div.formula, p.by, div.temp_change").show();
                        $("p.he, p.sh, p.i_t, p.f_t, p.t_i, p.e_c, div.mass, div.s_m, div.m_m").hide();
                        if ($('input[name="type"]:checked').val() == 'temp_change') {
                            $("div.temp_change, .t_c").show();
                            $("div.i_temp, div.f_temp, .i_f_t").hide();
                        } else if ($('input[name="type"]:checked').val() == 'i_f_temp') {
                            $("div.temp_change, .t_c").hide();
                            $("div.i_temp, div.f_temp, .i_f_t").show();
                        }

                    } else if (demovalue == 'Enthalpy_change') {
                        $("p.e_c, div.s_m, div.m_m, div.en").show();
                        $("p.he, p.sh, p.m, p.i_t, p.f_t, p.t_i, div.temp, div.mass, div.temp_change, div.s_h_c, div.i_temp, div.f_temp, p.by").hide();
                    } else if (demovalue == 'Initial_Temperature') {
                        $("div.mass, div.en, div.s_h_c, p.i_t, div.f_temp, div.formula").show();
                        $("div.temp, p.he, p.sh, p.m, p.f_t, p.t_i, p.e_c, div.s_m, div.m_m, div.temp_change, div.i_temp, p.by").hide();
                        $("input.h_change").attr('checked', 'checked');
                    } else if (demovalue == 'Final_Temperature') {
                        $("div.mass, div.en, div.s_h_c, p.f_t, div.i_temp, div.formula").show();
                        $("div.temp, p.he, p.sh, p.m, p.i_t, p.t_i, p.e_c, div.s_m, div.m_m, div.temp_change, div.f_temp, p.by").hide();
                        $("input.h_change").attr('checked', 'checked');
                    } else if (demovalue == 'Time_of_isolation') {
                        $("p.t_i, div.en, div.mass, div.s_h_c, div.formula, div.temp, p.by, div.temp_change").show();
                        $("p.sh, p.m, p.he, div.m_m, p.i_t, p.f_t, p.e_c, div.s_m").hide();
                        if ($('input[name="type"]:checked').val() == 'temp_change') {
                            $("div.temp_change, .t_c").show();
                            $("div.i_temp, div.f_temp, .i_f_t").hide();
                        } else if ($('input[name="type"]:checked').val() == 'i_f_temp') {
                            $("div.temp_change, .t_c").hide();
                            $("div.i_temp, div.f_temp, .i_f_t").show();
                        }

                    }
                });

                $('.with-gap').on('click', function() {
                    var demovalue = $(this).val();
                    if (demovalue == 'temp_change') {
                        $("div.temp_change, .t_c").show();
                        $("div.i_temp, div.f_temp, .i_f_t").hide();
                    } else {
                        $("div.temp_change, .t_c").hide();
                        $("div.i_temp, div.f_temp, .i_f_t").show();
                    }
                });

                $('#myselection').on('change', function() {
                    let myselection = $('#myselection').val();
                    if (myselection == 'heat exchange between several objects') {
                        $(".single_object").hide();
                        $("div.fimg3, div.state, .obj_1, .obj_2").show();
                        $(".two_time, div.f_temp_two, div.t_fusion, div.h_fusion, div.mass1").hide();

                        let objects = $('#objects').val();

                        if (objects == '2') {
                            $("div.object_2, .obj_1").show();
                            $(".obj_3").hide();
                            let obj_change = $('#obj_change').val();

                            if (obj_change == 'No') {
                                $("select#object_formula_change, div.f_temp1, div.f_temp2, div.f_temp1, select#object3_formula_change").show();
                                $(".two_time, div.f_temp_two, div.t_fusion, div.h_fusion, .three_time").hide();
                                let objformula = $('#object_formula_change').val();

                                if (objformula == 'm1') {

                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.s_h_c1, div.f_temp1, div.i_temp1").show();
                                    $("div.mass1").hide();
                                } else if (objformula == 'c1') {

                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass1, div.f_temp1, div.i_temp1").show();
                                    $("div.s_h_c1").hide();
                                } else if (objformula == 'Ti(1)') {
                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.f_temp1, div.mass1, div.s_h_c1").show();
                                    $("div.i_temp1").hide();
                                } else if (objformula == 'Tf(1)') {
                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.i_temp1, div.mass1, div.s_h_c1").show();
                                    $("div.f_temp1").hide();
                                } else if (objformula == 'm2') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                                    $("div.mass2").hide();
                                } else if (objformula == 'c2') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass2, div.f_temp2, div.i_temp2").show();
                                    $("div.s_h_c2").hide();
                                } else if (objformula == 'Ti(2)') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.f_temp2, div.mass2, div.s_h_c2").show();
                                    $("div.i_temp2").hide();
                                } else if (objformula == 'Tf(2)') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass2, div.s_h_c2").show();
                                    $("div.f_temp2, div.i_temp2").hide();
                                } else if (objformula == 'q1') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1").show();
                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2").hide();
                                } else if (objformula == 'q2') {
                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1").hide();
                                }

                            } else if (obj_change == 'Yes,two times') {
                                $("select#object_formula_change, div.mass1, div.f_temp2, div.f_temp1, select#object3_formula_change").hide();
                                $(".two_time, .three_time, div.f_temp_two, div.t_fusion, div.h_fusion").show();
                                let twoTime = $('#two_time').val();
                                if (twoTime == 'm1_two') {
                                    $("div.mass2, div.s_h_c2, div.f_temp_two, div.i_temp2, div.s_h_c1, div.t_fusion, div.i_temp1, div.h_fusion").show();
                                    $("div.mass1, div.f_temp1, div.f_temp2").hide();
                                } else if (twoTime == 'c1_two') {
                                    $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2").show();
                                    $("div.s_h_c1").hide();
                                } else if (twoTime == 'Ti(1)') {
                                    $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2, div.s_h_c1").show();
                                    $("div.i_temp1").hide();
                                } else if (twoTime == 'Tfusion') {
                                    $("div.mass1, div.h_fusion, div.mass2, div.s_h_c2, div.f_temp, div.i_temp2, div.s_h_c1").show();
                                    $("div.i_temp1, div.t_fusion").hide();
                                } else if (twoTime == 'ΔHfusion') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.s_h_c2, div.f_temp, div.mass2, div.i_temp2").show();
                                    $("div.h_fusion").hide();
                                } else if (twoTime == 'c2') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.mass2, div.i_temp2, div.h_fusion").show();
                                    $("div.s_h_c2").hide();
                                } else if (twoTime == 'm2') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.i_temp2, div.h_fusion, div.s_h_c2").show();
                                    $("div.mass2").hide();
                                } else if (twoTime == 'Ti(2)') {
                                    $("div.mass1, div.s_h_c1, div.h_fusion, div.i_temp1, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2").show();
                                    $("div.i_temp2").hide();
                                } else if (twoTime == 'Tf') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.i_temp2, div.mass2, div.h_fusion,div.s_h_c2").show();
                                    $("div.f_temp, div.f_temp_two").hide();
                                }
                            }
                        } else if (objects == '3') {
                            $(".obj_1, div.object_2").hide();
                            $(".obj_3").show();
                            let obj_change = $('#obj_change').val();
                            if (obj_change == 'No') {
                                $("div.object_2, .obj_3").show();
                                $(".obj_1").hide();
                                let obj_change3 = $('#object3_formula_change').val();
                                if (obj_change3 == 'm1') {
                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.s_h_c1, div.f_temp1, div.i_temp1").show();
                                    $("div.mass1").hide();
                                } else if (obj_change3 == 'c1') {
                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.f_temp1, div.i_temp1, div.mass1").show();
                                    $("div.s_h_c1").hide();
                                } else if (obj_change3 == 'Tf(1)') {
                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.i_temp1, div.mass1, div.s_h_c1").show();
                                    $("div.f_temp1").hide();
                                } else if (obj_change3 == 'Ti(1)') {
                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.f_temp1, div.mass1, div.s_h_c1").show();
                                    $("div.i_temp1").hide();
                                } else if (obj_change3 == 'm2') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                                    $("div.mass2").hide();
                                } else if (obj_change3 == 'c2') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.mass2, div.f_temp2, div.i_temp2").show();
                                    $("div.s_h_c2").hide();
                                } else if (obj_change3 == 'Tf(2)') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.i_temp2, div.mass2, div.s_h_c2").show();
                                    $("div.f_temp2").hide();
                                } else if (obj_change3 == 'Ti(2)') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2").show();
                                    $("div.i_temp2").hide();
                                } else if (obj_change3 == 'm3') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.s_h_c3, div.f_temp3, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                                    $("div.mass3").hide();
                                } else if (obj_change3 == 'c3') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.f_temp3, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3").show();
                                    $("div.s_h_c3").hide();
                                } else if (obj_change3 == 'Tf(3)') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3").show();
                                    $("div.f_temp3").hide();
                                } else if (obj_change3 == 'Ti(3)') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3").show();
                                    $("div.i_temp3").hide();
                                }
                            } else if (obj_change == 'Yes,two times') {
                                $("select#object_formula_change, div.mass1, div.f_temp2, div.f_temp1, select#object3_formula_change").hide();
                                $(".two_time, .three_time, div.f_temp_two, div.t_fusion, div.h_fusion").show();
                                let three_time = $('#three_time').val();
                                if (three_time == 'm1') {
                                    $("div.mass2, div.s_h_c2, div.f_temp, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.s_h_c1, div.t_fusion, div.i_temp1, div.h_fusion").show();
                                    $("div.mass1,div.f_temp3").hide();
                                } else if (three_time == 'c1') {
                                    $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3").show();
                                    $("div.s_h_c1, div.i_temp1, div.f_temp3").hide();
                                } else if (three_time == 'Tfusion') {
                                    $("div.mass2, div.s_h_c2, div.f_temp, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.mass1, div.h_fusion, div.s_h_c1, div.i_temp1").show();
                                    $("div.t_fusion, div.f_temp3").hide();
                                } else if (three_time == 'Ti(1)') {
                                    $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.s_h_c1").show();
                                    $("div.i_temp1, div.f_temp3").hide();
                                } else if (three_time == 'Hfusion') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.s_h_c2, div.f_temp, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3").show();
                                    $("div.h_fusion, div.f_temp3").hide();
                                } else if (three_time == 'c2') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.h_fusion").show();
                                    $("div.s_h_c2, div.f_temp3").hide();
                                } else if (three_time == 'm2') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.h_fusion, div.s_h_c2").show();
                                    $("div.mass2, div.f_temp3").hide();
                                } else if (three_time == 'Ti(2)') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.mass3, div.s_h_c3, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2").show();
                                    $("div.i_temp2, div.f_temp3").hide();
                                } else if (three_time == 'm3') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.s_h_c3, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2, div.i_temp2").show();
                                    $("div.mass3, div.f_temp3").hide();
                                } else if (three_time == 'c3') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2, div.i_temp2, div.mass3").show();
                                    $("div.s_h_c3, div.f_temp3").hide();
                                } else if (three_time == 'Tf') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2, div.i_temp2, div.mass3, div.s_h_c3").show();
                                    $("div.f_temp_two, div.f_temp, div.f_temp3").hide();
                                }
                            }
                        }

                    } else if (myselection == 'a chemical reaction in a cofee cup calorimeter') {
                        $("div.fimg3, div.state, .obj_1, .obj_2, .obj_3").hide();
                        $(".single_object").show();
                    }
                });

                $('#objects').on('change', function() {
                    var objects = $(this).val();
                    if (objects == '2') {
                        $("div.object_2, .obj_1").show();
                        $(".obj_3").hide();
                        let obj_change = $('#obj_change').val();
                        if (obj_change == 'No') {
                            $("select#object_formula_change, div.f_temp1, div.f_temp2, div.f_temp1, select#object3_formula_change").show();
                            $(".two_time, div.f_temp_two, div.t_fusion, div.h_fusion, .three_time").hide();
                            let objformula = $('#object_formula_change').val();
                            if (objformula == 'm1') {
                                $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.s_h_c1, div.f_temp1, div.i_temp1").show();
                                $("div.mass1").hide();
                            } else if (objformula == 'c1') {
                                $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass1, div.f_temp1, div.i_temp1").show();
                                $("div.s_h_c1").hide();
                            } else if (objformula == 'Ti(1)') {
                                $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.f_temp1, div.mass1, div.s_h_c1").show();
                                $("div.i_temp1").hide();
                            } else if (objformula == 'Tf(1)') {
                                $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.i_temp1, div.mass1, div.s_h_c1").show();
                                $("div.f_temp1").hide();
                            } else if (objformula == 'm2') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                                $("div.mass2").hide();
                            } else if (objformula == 'c2') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass2, div.f_temp2, div.i_temp2").show();
                                $("div.s_h_c2").hide();
                            } else if (objformula == 'Ti(2)') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.f_temp2, div.mass2, div.s_h_c2").show();
                                $("div.i_temp2").hide();
                            } else if (objformula == 'Tf(2)') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass2, div.s_h_c2").show();
                                $("div.f_temp2, div.i_temp2").hide();
                            } else if (objformula == 'q1') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1").show();
                                $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2").hide();
                            } else if (objformula == 'q2') {
                                $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1").hide();
                            }

                        } else if (obj_change == 'Yes,two times') {
                            $("select#object_formula_change, div.mass1, div.f_temp2, div.f_temp1, select#object3_formula_change").hide();
                            $(".two_time, .three_time, div.f_temp_two, div.t_fusion, div.h_fusion").show();
                            let twoTime = $('#two_time').val();
                            if (twoTime == 'm1_two') {
                                $("div.mass2, div.s_h_c2, div.f_temp_two, div.i_temp2, div.s_h_c1, div.t_fusion, div.i_temp1, div.h_fusion").show();
                                $("div.mass1, div.f_temp1, div.f_temp2").hide();
                            } else if (twoTime == 'c1_two') {
                                $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2").show();
                                $("div.s_h_c1").hide();
                            } else if (twoTime == 'Ti(1)') {
                                $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2, div.s_h_c1").show();
                                $("div.i_temp1").hide();
                            } else if (twoTime == 'Tfusion') {
                                $("div.mass1, div.h_fusion, div.mass2, div.s_h_c2, div.f_temp, div.i_temp2, div.s_h_c1").show();
                                $("div.i_temp1, div.t_fusion").hide();
                            } else if (twoTime == 'ΔHfusion') {
                                $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.s_h_c2, div.f_temp, div.mass2, div.i_temp2").show();
                                $("div.h_fusion").hide();
                            } else if (twoTime == 'c2') {
                                $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.mass2, div.i_temp2, div.h_fusion").show();
                                $("div.s_h_c2").hide();
                            } else if (twoTime == 'm2') {
                                $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.i_temp2, div.h_fusion, div.s_h_c2").show();
                                $("div.mass2").hide();
                            } else if (twoTime == 'Ti(2)') {
                                $("div.mass1, div.s_h_c1, div.h_fusion, div.i_temp1, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2").show();
                                $("div.i_temp2").hide();
                            } else if (twoTime == 'Tf') {
                                $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.i_temp2, div.mass2, div.h_fusion,div.s_h_c2").show();
                                $("div.f_temp, div.f_temp_two").hide();
                            }
                        }

                    } else if (objects == '3') {
                        $(".obj_1, div.object_2").hide();
                        $(".obj_3").show();
                        let obj_change = $('#obj_change').val();
                        if (obj_change == 'No') {
                            $("div.object_2, .obj_3").show();
                            $(".obj_1").hide();
                            let obj_change3 = $('#object3_formula_change').val();

                            if (obj_change3 == 'm1') {
                                $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.s_h_c1, div.f_temp1, div.i_temp1").show();
                                $("div.mass1").hide();
                            } else if (obj_change3 == 'c1') {
                                $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.f_temp1, div.i_temp1, div.mass1").show();
                                $("div.s_h_c1").hide();
                            } else if (obj_change3 == 'Tf(1)') {
                                $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.i_temp1, div.mass1, div.s_h_c1").show();
                                $("div.f_temp1").hide();
                            } else if (obj_change3 == 'Ti(1)') {
                                $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.f_temp1, div.mass1, div.s_h_c1").show();
                                $("div.i_temp1").hide();
                            } else if (obj_change3 == 'm2') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                                $("div.mass2").hide();
                            } else if (obj_change3 == 'c2') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.mass2, div.f_temp2, div.i_temp2").show();
                                $("div.s_h_c2").hide();
                            } else if (obj_change3 == 'Tf(2)') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.i_temp2, div.mass2, div.s_h_c2").show();
                                $("div.f_temp2").hide();
                            } else if (obj_change3 == 'Ti(2)') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2").show();
                                $("div.i_temp2").hide();
                            } else if (obj_change3 == 'm3') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.s_h_c3, div.f_temp3, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                                $("div.mass3").hide();
                            } else if (obj_change3 == 'c3') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.f_temp3, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3").show();
                                $("div.s_h_c3").hide();
                            } else if (obj_change3 == 'Tf(3)') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3").show();
                                $("div.f_temp3").hide();
                            } else if (obj_change3 == 'Ti(3)') {
                                $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3").show();
                                $("div.i_temp3").hide();
                            }
                        } else if (obj_change == 'Yes,two times') {
                            $("select#object_formula_change, div.mass1, div.f_temp2, div.f_temp1, select#object3_formula_change").hide();
                            $(".two_time, .three_time, div.f_temp_two, div.t_fusion, div.h_fusion").show();
                            let three_time = $('#three_time').val();

                            if (three_time == 'm1') {
                                $("div.mass2, div.s_h_c2, div.f_temp, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.s_h_c1, div.t_fusion, div.i_temp1, div.h_fusion").show();
                                $("div.mass1,div.f_temp3").hide();
                            } else if (three_time == 'c1') {
                                $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3").show();
                                $("div.s_h_c1, div.i_temp1, div.f_temp3").hide();
                            } else if (three_time == 'Tfusion') {
                                $("div.mass2, div.s_h_c2, div.f_temp, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.mass1, div.h_fusion, div.s_h_c1, div.i_temp1").show();
                                $("div.t_fusion, div.f_temp3").hide();
                            } else if (three_time == 'Ti(1)') {
                                $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.s_h_c1").show();
                                $("div.i_temp1, div.f_temp3").hide();
                            } else if (three_time == 'Hfusion') {
                                $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.s_h_c2, div.f_temp, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3").show();
                                $("div.h_fusion, div.f_temp3").hide();
                            } else if (three_time == 'c2') {
                                $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.h_fusion").show();
                                $("div.s_h_c2, div.f_temp3").hide();
                            } else if (three_time == 'm2') {
                                $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.h_fusion, div.s_h_c2").show();
                                $("div.mass2, div.f_temp3").hide();
                            } else if (three_time == 'Ti(2)') {
                                $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.mass3, div.s_h_c3, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2").show();
                                $("div.i_temp2, div.f_temp3").hide();
                            } else if (three_time == 'm3') {
                                $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.s_h_c3, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2, div.i_temp2").show();
                                $("div.mass3, div.f_temp3").hide();
                            } else if (three_time == 'c3') {
                                $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2, div.i_temp2, div.mass3").show();
                                $("div.s_h_c3, div.f_temp3").hide();
                            } else if (three_time == 'Tf') {
                                $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2, div.i_temp2, div.mass3, div.s_h_c3").show();
                                $("div.f_temp_two, div.f_temp, div.f_temp3").hide();
                            }
                        }

                    }

                });

                $('#obj_change').on('change', function() {
                    var demovalue = $(this).val();
                    if (demovalue == 'No') {
                        $("select#object_formula_change, div.f_temp1, div.f_temp2, div.f_temp1, select#object3_formula_change").show();
                        $(".two_time, div.f_temp_two, div.t_fusion, div.h_fusion, .three_time").hide();
                        let objChange = $('#object_formula_change').val();

                        if (objChange == 'm1') {
                            $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.s_h_c1, div.f_temp1, div.i_temp1").show();
                            $("div.mass1").hide();
                        } else if (objChange == 'c1') {
                            $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass1, div.f_temp1, div.i_temp1").show();
                            $("div.s_h_c1").hide();
                        } else if (objChange == 'Ti(1)') {
                            $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.f_temp1, div.mass1, div.s_h_c1").show();
                            $("div.i_temp1").hide();
                        } else if (objChange == 'Tf(1)') {
                            $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.i_temp1, div.mass1, div.s_h_c1").show();
                            $("div.f_temp1").hide();
                        } else if (objChange == 'm2') {
                            $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                            $("div.mass2").hide();

                        } else if (objChange == 'c2') {

                            $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass2, div.f_temp2, div.i_temp2").show();
                            $("div.s_h_c2").hide();
                        } else if (objChange == 'Ti(2)') {
                            $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.f_temp2, div.mass2, div.s_h_c2").show();
                            $("div.i_temp2").hide();
                        } else if (objChange == 'Tf(2)') {
                            $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass2, div.s_h_c2").show();
                            $("div.f_temp2, div.i_temp2").hide();
                        } else if (objChange == 'q1') {
                            $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1").show();
                            $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2").hide();
                        } else if (objChange == 'q2') {
                            $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                            $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1").hide();
                        }

                        let objects = $('#objects').val();
                        if (objects == '3') {
                            $(".obj_1, div.object_2").hide();
                            $(".obj_3").show();
                            let obj_change = $('#obj_change').val();
                            if (obj_change == 'No') {
                                $("div.object_2, .obj_3").show();
                                $(".obj_1").hide();
                                let obj_change3 = $('#object3_formula_change').val();
                                if (obj_change3 == 'm1') {
                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.s_h_c1, div.f_temp1, div.i_temp1").show();
                                    $("div.mass1").hide();
                                } else if (obj_change3 == 'c1') {
                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.f_temp1, div.i_temp1, div.mass1").show();
                                    $("div.s_h_c1").hide();
                                } else if (obj_change3 == 'Tf(1)') {
                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.i_temp1, div.mass1, div.s_h_c1").show();
                                    $("div.f_temp1").hide();
                                } else if (obj_change3 == 'Ti(1)') {
                                    $("div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.f_temp1, div.mass1, div.s_h_c1").show();
                                    $("div.i_temp1").hide();
                                } else if (obj_change3 == 'm2') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                                    $("div.mass2").hide();
                                } else if (obj_change3 == 'c2') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.mass2, div.f_temp2, div.i_temp2").show();
                                    $("div.s_h_c2").hide();
                                } else if (obj_change3 == 'Tf(2)') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.i_temp2, div.mass2, div.s_h_c2").show();
                                    $("div.f_temp2").hide();
                                } else if (obj_change3 == 'Ti(2)') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass3, div.s_h_c3, div.f_temp3, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2").show();
                                    $("div.i_temp2").hide();
                                } else if (obj_change3 == 'm3') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.s_h_c3, div.f_temp3, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2").show();
                                    $("div.mass3").hide();
                                } else if (obj_change3 == 'c3') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.f_temp3, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3").show();
                                    $("div.s_h_c3").hide();
                                } else if (obj_change3 == 'Tf(3)') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.i_temp3, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3").show();
                                    $("div.f_temp3").hide();
                                } else if (obj_change3 == 'Ti(3)') {
                                    $("div.mass1, div.s_h_c1, div.f_temp1, div.i_temp1, div.mass2, div.s_h_c2, div.f_temp2, div.i_temp2, div.mass3, div.s_h_c3, div.f_temp3").show();
                                    $("div.i_temp3").hide();
                                }

                            }

                        }


                    } else if (demovalue == 'Yes,two times') {

                        $("select#object_formula_change, div.mass1, div.f_temp2, div.f_temp1, select#object3_formula_change").hide();
                        $(".two_time, .three_time, div.f_temp_two, div.t_fusion, div.h_fusion").show();
                        let twoTime = $('#two_time').val();

                        if (twoTime == 'm1_two') {
                            $("div.mass2, div.s_h_c2, div.f_temp_two, div.i_temp2, div.s_h_c1, div.t_fusion, div.i_temp1, div.h_fusion").show();
                            $("div.mass1, div.f_temp1, div.f_temp2").hide();
                        } else if (twoTime == 'c1_two') {
                            $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2").show();
                            $("div.s_h_c1").hide();
                        } else if (twoTime == 'Ti(1)') {
                            $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2, div.s_h_c1").show();
                            $("div.i_temp1").hide();
                        } else if (twoTime == 'Tfusion') {
                            $("div.mass1, div.h_fusion, div.mass2, div.s_h_c2, div.f_temp, div.i_temp2, div.s_h_c1").show();
                            $("div.i_temp1, div.t_fusion").hide();
                        } else if (twoTime == 'ΔHfusion') {
                            $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.s_h_c2, div.f_temp, div.mass2, div.i_temp2").show();
                            $("div.h_fusion").hide();
                        } else if (twoTime == 'c2') {
                            $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.mass2, div.i_temp2, div.h_fusion").show();
                            $("div.s_h_c2").hide();
                        } else if (twoTime == 'm2') {
                            $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.i_temp2, div.h_fusion, div.s_h_c2").show();
                            $("div.mass2").hide();
                        } else if (twoTime == 'Ti(2)') {
                            $("div.mass1, div.s_h_c1, div.h_fusion, div.i_temp1, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2").show();
                            $("div.i_temp2").hide();
                        } else if (twoTime == 'Tf') {
                            $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.i_temp2, div.mass2, div.h_fusion,div.s_h_c2").show();
                            $("div.f_temp, div.f_temp_two").hide();
                        }

                        let objects = $('#objects').val();
                        if (objects == '3') {
                            $(".obj_1, div.object_2").hide();
                            $(".obj_3").show();
                            let obj_change = $('#obj_change').val();
                            if (obj_change == 'Yes,two times') {
                                $("select#object_formula_change, div.mass1, div.f_temp2, div.f_temp1, select#object3_formula_change").hide();
                                $(".two_time, .three_time, div.f_temp_two, div.t_fusion, div.h_fusion").show();
                                let three_time = $('#three_time').val();

                                if (three_time == 'm1') {
                                    $("div.mass2, div.s_h_c2, div.f_temp, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.s_h_c1, div.t_fusion, div.i_temp1, div.h_fusion").show();
                                    $("div.mass1,div.f_temp3").hide();
                                } else if (three_time == 'c1') {
                                    $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3").show();
                                    $("div.s_h_c1, div.i_temp1, div.f_temp3").hide();
                                } else if (three_time == 'Tfusion') {
                                    $("div.mass2, div.s_h_c2, div.f_temp, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.mass1, div.h_fusion, div.s_h_c1, div.i_temp1").show();
                                    $("div.t_fusion, div.f_temp3").hide();
                                } else if (three_time == 'Ti(1)') {
                                    $("div.mass1, div.h_fusion, div.s_h_c2, div.f_temp, div.t_fusion, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.s_h_c1").show();
                                    $("div.i_temp1, div.f_temp3").hide();
                                } else if (three_time == 'Hfusion') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.s_h_c2, div.f_temp, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3").show();
                                    $("div.h_fusion, div.f_temp3").hide();
                                } else if (three_time == 'c2') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.mass2, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.h_fusion").show();
                                    $("div.s_h_c2, div.f_temp3").hide();
                                } else if (three_time == 'm2') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.i_temp2, div.mass3, div.s_h_c3, div.i_temp3, div.h_fusion, div.s_h_c2").show();
                                    $("div.mass2, div.f_temp3").hide();
                                } else if (three_time == 'Ti(2)') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.mass3, div.s_h_c3, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2").show();
                                    $("div.i_temp2, div.f_temp3").hide();
                                } else if (three_time == 'm3') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.s_h_c3, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2, div.i_temp2").show();
                                    $("div.mass3, div.f_temp3").hide();
                                } else if (three_time == 'c3') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.f_temp, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2, div.i_temp2, div.mass3").show();
                                    $("div.s_h_c3, div.f_temp3").hide();
                                } else if (three_time == 'Tf') {
                                    $("div.mass1, div.s_h_c1, div.t_fusion, div.i_temp1, div.i_temp3, div.h_fusion, div.s_h_c2, div.mass2, div.i_temp2, div.mass3, div.s_h_c3").show();
                                    $("div.f_temp_two, div.f_temp, div.f_temp3").hide();
                                }
                            }

                        }
                    }

                });
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>