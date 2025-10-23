<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  gap-4">
                 <div class="space-y-2 relative">
                    <label for="find" class="font-s-14 text-blue">Find:</label>
                    <select name="find" id="find" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["Mass Percentage for a Solute","Mass of Solute","Mass of Solvent","Mass Percentage for a Chemical","Mass of Chemical","Total Mass of Compound","Percent Composition"];
                            $val = ["1","2","3","4","5","6","7"];
                            optionsList($val,$name,isset(request()->find)?request()->find:'1');
                        @endphp
                    </select>
                 </div>
            </div>
            <div class="grid grid-cols-1 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                 <div class="space-y-2 input-field mass_solute">
                    <label for="mass_solute" class="font-s-14 text-blue">Mass of solute:</label>
                    <div class="relative w-full ">
                        <input type="number" name="mass_solute" id="mass_solute" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass_solute'])?$_POST['mass_solute']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mass_solute_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_solute_unit_dropdown')">{{ isset($_POST['mass_solute_unit'])?$_POST['mass_solute_unit']:'μg' }} ▾</label>
                        <input type="text" name="mass_solute_unit" value="{{ isset($_POST['mass_solute_unit'])?$_POST['mass_solute_unit']:'μg' }}" id="mass_solute_unit" class="hidden">
                        <div id="mass_solute_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solute_unit', 'μg')">micrograms (μg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solute_unit', 'mg')">milligrams (mg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solute_unit', 'g')">grams (g)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solute_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solute_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solute_unit', 't')">metric tons (t)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solute_unit', 'oz')">ounces (oz)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solute_unit', 'lbs')">pounds (lbs)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 input-field mass_solvent">
                    <label for="mass_solvent" class="font-s-14 text-blue">Mass of solvent:</label>
                    <div class="relative w-full ">
                        <input type="number" name="mass_solvent" id="mass_solvent" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass_solvent'])?$_POST['mass_solvent']:'20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mass_solvent_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_solvent_unit_dropdown')">{{ isset($_POST['mass_solvent_unit'])?$_POST['mass_solvent_unit']:'μg' }} ▾</label>
                        <input type="text" name="mass_solvent_unit" value="{{ isset($_POST['mass_solvent_unit'])?$_POST['mass_solvent_unit']:'μg' }}" id="mass_solvent_unit" class="hidden">
                        <div id="mass_solvent_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'μg')">micrograms (μg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'mg')">milligrams (mg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'g')">grams (g)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 't')">metric tons (t)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'oz')">ounces (oz)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'lbs')">pounds (lbs)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 input-field mass_percentage hidden relative">
                    <label for="mass_percentage" class="font-s-14 text-blue">Mass Percentage:</label>
                    <input type="number" step="any" name="mass_percentage" id="mass_percentage" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mass_percentage)?request()->mass_percentage:'20' }}" />
                    <span class="text-blue input_unit">%</span>
                 </div>
                 <div class="space-y-2 input-field mass_chemical hidden">
                    <label for="mass_chemical" class="font-s-14 text-blue">Mass of chemical:</label>
                    <div class="relative w-full ">
                        <input type="number" name="mass_chemical" id="mass_chemical" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass_solvent'])?$_POST['mass_solvent']:'20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mass_chemical_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_chemical_unit_dropdown')">{{ isset($_POST['mass_chemical_unit'])?$_POST['mass_chemical_unit']:'kg' }} ▾</label>
                        <input type="text" name="mass_chemical_unit" value="{{ isset($_POST['mass_chemical_unit'])?$_POST['mass_chemical_unit']:'kg' }}" id="mass_chemical_unit" class="hidden">
                        <div id="mass_chemical_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_chemical_unit', 'kg')">micrograms (μg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_chemical_unit', 'μg')">micrograms (μg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_chemical_unit', 'mg')">milligrams (mg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_chemical_unit', 'g')">grams (g)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_chemical_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_chemical_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_chemical_unit', 't')">metric tons (t)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_chemical_unit', 'oz')">ounces (oz)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_chemical_unit', 'lbs')">pounds (lbs)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 input-field total_mass_compound hidden">
                    <label for="total_mass_compound" class="font-s-14 text-blue">Total mass of compound:</label>
                    <div class="relative w-full ">
                        <input type="number" name="total_mass_compound" id="total_mass_compound" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['total_mass_compound'])?$_POST['total_mass_compound']:'20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="total_mass_compound_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('total_mass_compound_unit_dropdown')">{{ isset($_POST['total_mass_compound_unit'])?$_POST['total_mass_compound_unit']:'kg' }} ▾</label>
                        <input type="text" name="total_mass_compound_unit" value="{{ isset($_POST['total_mass_compound_unit'])?$_POST['total_mass_compound_unit']:'kg' }}" id="total_mass_compound_unit" class="hidden">
                        <div id="total_mass_compound_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[44%] mt-1 right-0 hidden">

                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_mass_compound_unit', 'μg')">micrograms (μg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_mass_compound_unit', 'mg')">milligrams (mg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_mass_compound_unit', 'g')">grams (g)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_mass_compound_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_mass_compound_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_mass_compound_unit', 't')">metric tons (t)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_mass_compound_unit', 'oz')">ounces (oz)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_mass_compound_unit', 'lbs')">pounds (lbs)</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4 hidden input-field  whole ">

                <div class="space-y-2">
                    <label for="first_value" class="font-s-14 text-blue">No of 1st elements atoms:</label>
                    <input type="number" step="any" name="first_value" id="first_value" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->first_value)?request()->first_value:'30' }}" />
                </div>
                <div class="space-y-2">
                    <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                    <select name="first_value_unit" id="first_value_unit" class="input">
                        @php
                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                            $val =["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'H (Hydrogen)');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="second_value" class="font-s-14 text-blue">No of 2nd elements atoms:</label>
                    <input type="number" step="any" name="second_value" id="second_value" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->second_value)?request()->second_value:'' }}" />
                </div>
                <div class="space-y-2">
                    <label for="second_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                    <select name="second_value_unit" id="second_value_unit" class="input">
                        @php
                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                            $val =["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                            optionsList($val,$name,isset(request()->second_value_unit)?request()->second_value_unit:'H (Hydrogen)');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="third_value" class="font-s-14 text-blue">No of 3rd elements atoms:</label>
                    <input type="number" step="any" name="third_value" id="third_value" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->third_value)?request()->third_value:'' }}" />
                </div>
                <div class="space-y-2">
                    <label for="third_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                    <select name="third_value_unit" id="third_value_unit" class="input">
                        @php
                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                            $val =["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                            optionsList($val,$name,isset(request()->third_value_unit)?request()->third_value_unit:'H (Hydrogen)');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="four_value" class="font-s-14 text-blue">No of 4th elements atoms:</label>
                    <input type="number" step="any" name="four_value" id="four_value" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->four_value)?request()->four_value:'' }}" />
                </div>
                <div class="space-y-2">
                    <label for="four_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                    <select name="four_value_unit" id="four_value_unit" class="input">
                        @php
                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                            $val =["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                            optionsList($val,$name,isset(request()->four_value_unit)?request()->four_value_unit:'H (Hydrogen)');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="five_value" class="font-s-14 text-blue">No of 5th elements atoms:</label>
                    <input type="number" step="any" name="five_value" id="five_value" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->five_value)?request()->five_value:'' }}" />
                </div>
                <div class="space-y-2">
                    <label for="five_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                    <select name="five_value_unit" id="five_value_unit" class="input">
                        @php
                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                            $val =["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                            optionsList($val,$name,isset(request()->five_value_unit)?request()->five_value_unit:'H (Hydrogen)');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="six_value" class="font-s-14 text-blue">No of 6th elements atoms:</label>
                    <input type="number" step="any" name="six_value" id="six_value" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->six_value)?request()->six_value:'' }}" />
                </div>
                <div class="space-y-2">
                    <label for="six_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                    <select name="six_value_unit" id="six_value_unit" class="input">
                        @php
                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                            $val =["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                            optionsList($val,$name,isset(request()->six_value_unit)?request()->six_value_unit:'H (Hydrogen)');
                        @endphp
                    </select>
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
                <div class="w-full p-3 radius-10 mt-3">
                    <div class="w-full">
                        @if($detail['method']=="1")
                            <p><strong>Mass Percentage</strong></p>
                            <p><strong class="text-[#119154] text-[30px]">{!! $detail['mass_percent'] !!} <span class="text-[#119154] text-[20px]">(%)</span></strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-6" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">Mass Solution</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $detail['mass_solution'] !!} (kg)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">Mass of Solute</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! request()->mass_solute !!} (kg)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">Mass of Solvent</td>
                                        <td class="py-2 ps-2"><strong>{!! request()->mass_solvent !!} (kg)</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($detail['method']=="2")
                            <p><strong>Mass Solute</strong></p>
                            <p><strong class="text-[#119154] text-[30px]">{!! $detail['mass_solute'] !!} <span class="text-[#119154] text-[20px]">(kg)</span></strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-6" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">Mass Solution</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $detail['mass_solution'] !!} (kg)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">Mass of Solvent</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! request()->mass_solvent !!} (kg)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">Mass Percentage</td>
                                        <td class="py-2 ps-2"><strong>{!! request()->mass_percentage !!} (kg)</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($detail['method']=="3")
                            <p><strong>Mass of Solvent</strong></p>
                            <p><strong class="text-[#119154] text-[30px]">{!! $detail['mass_solvent'] !!} <span class="text-[#119154] text-[20px]">(kg)</span></strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-6" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">Mass Solution</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $detail['mass_solution'] !!} (kg)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">Mass of Solute</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! request()->mass_solute !!} (kg)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">Mass Percentage</td>
                                        <td class="py-2 ps-2"><strong>{!! request()->mass_percentage !!} (kg)</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($detail['method']=="4")
                            <p><strong>Mass Percentage</strong></p>
                            <p><strong class="text-[#119154] text-[30px]">{!! $detail['mass_percent'] !!} <span class="text-[#119154] text-[20px]">(%)</span></strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-6" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">Mass of Chemical</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! request()->mass_chemical !!} (kg)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">Total Mass of Compound</td>
                                        <td class="py-2 ps-2"><strong>{!! request()->total_mass_compound !!} (kg)</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($detail['method']=="5")
                            <p><strong>Mass of Chemical</strong></p>
                            <p><strong class="text-[#119154] text-[30px]">{!! $detail['mass_of_chemical'] !!} <span class="text-[#119154] text-[20px]">(kg)</span></strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-6" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">Mass Percentage</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! request()->mass_percentage !!} (kg)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">Total Mass of Compound</td>
                                        <td class="py-2 ps-2"><strong>{!! request()->total_mass_compound !!} (kg)</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($detail['method']=="6")
                            <p><strong>Total Mass of Compound</strong></p>
                            <p><strong class="text-[#119154] text-[30px]">{!! $detail['total_mass_compound'] !!} <span class="text-[#119154] text-[20px]">(kg)</span></strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-6" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">Mass Percentage</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! request()->mass_percentage !!} (kg)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">Mass of Chemical</td>
                                        <td class="py-2 ps-2"><strong>{!! request()->mass_chemical !!} (kg)</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($detail['method']=="7")
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-8" cellspacing="0">
                                    <tr>
                                        <th class="text-start border-b py-2 pe-2">Element</th>
                                        <th class="text-start border-b py-2 px-2">Number</th>
                                        <th class="text-start border-b py-2 px-2">Mass</th>
                                        <th class="text-start border-b py-2 ps-2">Percent Composition</th>
                                    </tr>
                                    @if(isset($detail['value1']) && $detail['value1']!="")
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong class="text-blue">{!! $detail['name1'] !!}</strong></td>
                                            <td class="border-b py-2 px-2"><strong>{!! $detail['punk'] !!}</strong></td>
                                            <td class="border-b py-2 px-2"><strong>{!! $detail['punk1'] !!}</strong></td>
                                            <td class="border-b py-2 ps-2"><strong>{!! ($detail['punk1']/$detail['call'])*100*$detail['punk'] !!}</strong></td>
                                        </tr>
                                    @endif
                                    @if(isset($detail['value2']) && $detail['value2']!="")
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong class="text-blue">{!! $detail['name2'] !!}</strong></td>
                                            <td class="border-b py-2 px-2"><strong>{!! $detail['punk2'] !!}</strong></td>
                                            <td class="border-b py-2 px-2"><strong>{!! $detail['punk3'] !!}</strong></td>
                                            <td class="border-b py-2 ps-2"><strong>{!! ($detail['punk3']/$detail['call'])*100*$detail['punk2'] !!}</strong></td>
                                        </tr>
                                    @endif
                                    @if(isset($detail['value3']) && $detail['value3']!="")
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong class="text-blue">{!! $detail['name3'] !!}</strong></td>
                                            <td class="border-b py-2 px-2"><strong>{!! $detail['punk4'] !!}</strong></td>
                                            <td class="border-b py-2 px-2"><strong>{!! $detail['punk5'] !!}</strong></td>
                                            <td class="border-b py-2 ps-2"><strong>{!! ($detail['punk5']/$detail['call'])*100*$detail['punk4'] !!}</strong></td>
                                        </tr>
                                    @endif
                                    @if(isset($detail['value4']) && $detail['value4']!="")
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong class="text-blue">{!! $detail['name4'] !!}</strong></td>
                                            <td class="border-b py-2 px-2"><strong>{!! $detail['punk6'] !!}</strong></td>
                                            <td class="border-b py-2 px-2"><strong>{!! $detail['punk7'] !!}</strong></td>
                                            <td class="border-b py-2 ps-2"><strong>{!! ($detail['punk7']/$detail['call'])*100*$detail['punk6'] !!}</strong></td>
                                        </tr>
                                    @endif
                                    @if(isset($detail['value5']) && $detail['value5']!="")
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong class="text-blue">{!! $detail['name5'] !!}</strong></td>
                                            <td class="border-b py-2 px-2"><strong>{!! $detail['punk8'] !!}</strong></td>
                                            <td class="border-b py-2 px-2"><strong>{!! $detail['punk9'] !!}</strong></td>
                                            <td class="border-b py-2 ps-2"><strong>{!! ($detail['punk9']/$detail['call'])*100*$detail['punk8'] !!}</strong></td>
                                        </tr>
                                    @endif
                                    @if(isset($detail['value6']) && $detail['value6']!="")
                                        <tr>
                                            <td class="border-b py-2 pe-2"><strong class="text-blue">{!! $detail['name6'] !!}</strong></td>
                                            <td class="border-b py-2 px-2"><strong>{!! $detail['punk10'] !!}</strong></td>
                                            <td class="border-b py-2 px-2"><strong>{!! $detail['punk11'] !!}</strong></td>
                                            <td class="border-b py-2 ps-2"><strong>{!! ($detail['punk10']/$detail['call'])*100*$detail['punk11'] !!}</strong></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                function updateFields() {
                    var a = document.getElementById("find").value;
                    var inputFields = document.querySelectorAll(".input-field");

                    inputFields.forEach(function(field) {
                        field.style.display = 'none';
                    });

                    if (a == "1") {
                        document.querySelectorAll(".mass_solute, .mass_solvent").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "2") {
                        document.querySelectorAll(".mass_solvent, .mass_percentage").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "3") {
                        document.querySelectorAll(".mass_solute, .mass_percentage").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "4") {
                        document.querySelectorAll(".total_mass_compound, .mass_chemical").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "5") {
                        document.querySelectorAll(".total_mass_compound, .mass_percentage").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "6") {
                        document.querySelectorAll(".mass_chemical, .mass_percentage").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "7") {
                        document.querySelectorAll(".whole").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    }
                }

                updateFields();

                document.getElementById("find").addEventListener("change", function() {
                    updateFields();
                });
            });
        </script> --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function updateFields() {
                    var a = document.getElementById("find").value;
                    var inputFields = document.querySelectorAll(".input-field");
        
                    // Hide all fields initially by adding the 'hidden' class
                    inputFields.forEach(function(field) {
                        field.classList.add('hidden');
                    });
        
                    // Show specific fields based on the selected value by removing 'hidden' class
                    if (a == "1") {
                        document.querySelectorAll(".mass_solute, .mass_solvent").forEach(function(field) {
                            field.classList.remove('hidden');
                        });
                    } else if (a == "2") {
                        document.querySelectorAll(".mass_solvent, .mass_percentage").forEach(function(field) {
                            field.classList.remove('hidden');
                        });
                    } else if (a == "3") {
                        document.querySelectorAll(".mass_solute, .mass_percentage").forEach(function(field) {
                            field.classList.remove('hidden');
                        });
                    } else if (a == "4") {
                        document.querySelectorAll(".total_mass_compound, .mass_chemical").forEach(function(field) {
                            field.classList.remove('hidden');
                        });
                    } else if (a == "5") {
                        document.querySelectorAll(".total_mass_compound, .mass_percentage").forEach(function(field) {
                            field.classList.remove('hidden');
                        });
                    } else if (a == "6") {
                        document.querySelectorAll(".mass_chemical, .mass_percentage").forEach(function(field) {
                            field.classList.remove('hidden');
                        });
                    } else if (a == "7") {
                        document.querySelectorAll(".whole").forEach(function(field) {
                            field.classList.remove('hidden');
                        });
                    }
                }
        
                // Initial call to set the fields based on the default value
                updateFields();
        
                // Update fields on select change
                document.getElementById("find").addEventListener("change", function() {
                    updateFields();
                });
            });
        </script>
        

    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>