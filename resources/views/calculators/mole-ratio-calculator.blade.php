<style>
    .whole,.whole_two,.moles_one,.moles_two,#btn22,#btn42,#btn6,#btn7,.whole_three,.whole_fourth{
        display:none
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="col-12 col-lg-7 mx-auto">
                <div class="row">
                    @if(isset($error))
                        <p class="font-s-18 text-center"><strong class="text-danger">{{ $error }}</strong></p>
                    @endif
                    <div class="grid grid-cols-1">
                        <div class="w-full input-field px-2 finch">
                            <label for="find" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            <div class="w-full py-2 position-relative">
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
                                        $name=[$lang['2'],$lang['3'],$lang['4']];
                                        $val = ["1","2","3"];
                                        optionsList($val,$name,isset(request()->find)?request()->find:'1');
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 mt-3">
                        <div class="space-y-2 px-2">
                            <p><strong class="font-s-14 text-blue">First Reactant</strong></p>
                            <label for="first_coefficient" class="font-s-14 text-blue">Coefficient in balanced reaction:</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="first_coefficient[]" id="first_reactant" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->first_coefficient)?request()->first_coefficient:'4' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                            </div>
                        </div>
                        <div class="space-y-2 px-2 moles_one">
                            <p><strong class="font-s-14 text-blue">&nbsp;</strong></p>
                            <label for="moles" class="font-s-14 text-blue">Number of moles or molecules:</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="moles[]" id="mole_one" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->moles)?request()->moles:'' }}" pattern="\d+" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                            </div>
                        </div>
                    </div>
                    <div class="w-full input-field whole hidden">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="value1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                                <div class="w-full py-2 position-relative">
                                    <select name="first_value_unit" id="unit1" class="input">
                                        @php
                                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                                            $val =["1","1.00784","4.002602","6.941","9.0122","10.811","12.011","14.0067","15.9994","18.998403","20.179","22.98977","24.305","26.98154","28.0855","30.97376","32.06","35.453","39.0983","39.948","40.08","44.9559","47.90","50.9415","51.996","54.9380","55.847","58.9332","58.70","63.546","65.38"] ;
                                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 px-2 hidden">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="assign1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="value2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'2' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                                <div class="w-full py-2 position-relative">
                                    <select name="first_value_unit" id="unit2" class="input">
                                        @php
                                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                                            $val =["1","1.00784","4.002602","6.941","9.0122","10.811","12.011","14.0067","15.9994","18.998403","20.179","22.98977","24.305","26.98154","28.0855","30.97376","32.06","35.453","39.0983","39.948","40.08","44.9559","47.90","50.9415","51.996","54.9380","55.847","58.9332","58.70","63.546","65.38"] ;
                                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 px-2 hidden">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="assign2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="value3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'3' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                                <div class="w-full py-2 position-relative">
                                    <select name="first_value_unit" id="unit3" class="input">
                                        @php
                                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                                            $val =["1","1.00784","4.002602","6.941","9.0122","10.811","12.011","14.0067","15.9994","18.998403","20.179","22.98977","24.305","26.98154","28.0855","30.97376","32.06","35.453","39.0983","39.948","40.08","44.9559","47.90","50.9415","51.996","54.9380","55.847","58.9332","58.70","63.546","65.38"] ;
                                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 px-2 hidden">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="assign3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Molecular Weight:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="molecular_weight" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'6' }}" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="mass_first_reactant" class="font-s-14 text-blue">Mass of First Reactant:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="mass_first_reactant" id="mass_one" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mass_first_reactant)?request()->mass_first_reactant:'' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 mt-3">
                        <div class="space-y-2 px-2">
                            <p><strong class="font-s-14 text-blue">Second Reactant</strong></p>
                            <label for="first_coefficient" class="font-s-14 text-blue">Coefficient in balanced reaction:</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="first_coefficient[]" id="second_reactant" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->first_coefficient)?request()->first_coefficient:'8' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                            </div>
                        </div>
                        <div class="space-y-2 px-2 moles_two">
                            <p><strong class="font-s-14 text-blue">&nbsp;</strong></p>
                            <label for="moles" class="font-s-14 text-blue">Number of moles or molecules:</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="moles[]" id="mole_two" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->moles)?request()->moles:'8' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                            </div>
                        </div>
                    </div>
                    <div class="w-full input-field whole_two hidden">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2 px-2 moles_two">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="value4" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                                <div class="w-full py-2 position-relative">
                                    <select name="first_value_unit" id="unit4" class="input">
                                        @php
                                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                                            $val =["1","1.00784","4.002602","6.941","9.0122","10.811","12.011","14.0067","15.9994","18.998403","20.179","22.98977","24.305","26.98154","28.0855","30.97376","32.06","35.453","39.0983","39.948","40.08","44.9559","47.90","50.9415","51.996","54.9380","55.847","58.9332","58.70","63.546","65.38"] ;
                                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'1.00784');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 px-2 hidden">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="assign4" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="value5" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'2' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                                <div class="w-full py-2 position-relative">
                                    <select name="first_value_unit" id="unit5" class="input">
                                        @php
                                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                                            $val =["1","1.00784","4.002602","6.941","9.0122","10.811","12.011","14.0067","15.9994","18.998403","20.179","22.98977","24.305","26.98154","28.0855","30.97376","32.06","35.453","39.0983","39.948","40.08","44.9559","47.90","50.9415","51.996","54.9380","55.847","58.9332","58.70","63.546","65.38"] ;
                                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'1.00784');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 px-2 hidden">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="assign5" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="value6" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'3' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                                <div class="w-full py-2 position-relative">
                                    <select name="first_value_unit" id="unit6" class="input">
                                        @php
                                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                                            $val =["1","1.00784","4.002602","6.941","9.0122","10.811","12.011","14.0067","15.9994","18.998403","20.179","22.98977","24.305","26.98154","28.0855","30.97376","32.06","35.453","39.0983","39.948","40.08","44.9559","47.90","50.9415","51.996","54.9380","55.847","58.9332","58.70","63.546","65.38"] ;
                                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'1.00784');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 px-2 hidden">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="assign6" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Molecular Weight:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" id="molecular_weight2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'6' }}" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Mass of Second Reactant:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" id="mass_two" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'' }}" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-3 empty_div_one">
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-3 empty_div_three">
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-3 empty_div_five">
                    </div>
                    {{-- <div class="col-12 my-2">
                        <div class="space-y-2 px-2" id="btn2">
                            <button type="button" id="btn3" class="bg-white border radius-5 px-4 py-2" title="Add More Fields"><strong class="text-blue">+ Add Reactants</strong></button>
                        </div>
                    </div> --}}
                    {{-- <div class="col-12 my-2">
                        <div class="space-y-2 px-2" id="btn22">
                            <button type="button" id="btn32" class="bg-white border radius-5 px-4 py-2" title="Add More Fields"><strong class="text-blue">+ Add Reactants</strong></button>
                        </div>
                    </div> --}}
                    {{-- <div class="col-12 my-2">
                        <div class="space-y-2 px-2" id="btn6">
                            <button type="button" id="btn72" class="bg-white border radius-5 px-4 py-2" title="Add More Fields"><strong class="text-blue">+ Add Reactants</strong></button>
                        </div>
                    </div> --}}
                    <div class="grid grid-cols-2 gap-4 mt-3">
                        <div class="space-y-2 px-2">
                            <p><strong class="font-s-14 text-blue">First Product</strong></p>
                            <label for="first_product" class="font-s-14 text-blue">Coefficient in balanced reaction:</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="first_product[]" id="first_product" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->first_product)?request()->first_product:'2' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                            </div>
                        </div>
                        <div class="space-y-2 px-2 moles_one">
                            <p><strong class="font-s-14 text-blue">&nbsp;</strong></p>
                            <label for="moles" class="font-s-14 text-blue">Number of moles or molecules:</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="moles[]" id="baristow" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->moles)?request()->moles:'2' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 input-field whole_three hidden">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="baristow" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                                <div class="w-full py-2 position-relative">
                                    <select name="first_value_unit" id="atom_unit_one" class="input">
                                        @php
                                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                                            $val =["1","1.00784","4.002602","6.941","9.0122","10.811","12.011","14.0067","15.9994","18.998403","20.179","22.98977","24.305","26.98154","28.0855","30.97376","32.06","35.453","39.0983","39.948","40.08","44.9559","47.90","50.9415","51.996","54.9380","55.847","58.9332","58.70","63.546","65.38"] ;
                                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 px-2 hidden">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="assignment1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="atom2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'2' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                                <div class="w-full py-2 position-relative">
                                    <select name="first_value_unit" id="atom_unit_two" class="input">
                                        @php
                                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                                            $val =["1","1.00784","4.002602","6.941","9.0122","10.811","12.011","14.0067","15.9994","18.998403","20.179","22.98977","24.305","26.98154","28.0855","30.97376","32.06","35.453","39.0983","39.948","40.08","44.9559","47.90","50.9415","51.996","54.9380","55.847","58.9332","58.70","63.546","65.38"] ;
                                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 px-2 hidden">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="assignment2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="atom3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'3' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                                <div class="w-full py-2 position-relative">
                                    <select name="first_value_unit" id="atom_unit_three" class="input">
                                        @php
                                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                                            $val =["1","1.00784","4.002602","6.941","9.0122","10.811","12.011","14.0067","15.9994","18.998403","20.179","22.98977","24.305","26.98154","28.0855","30.97376","32.06","35.453","39.0983","39.948","40.08","44.9559","47.90","50.9415","51.996","54.9380","55.847","58.9332","58.70","63.546","65.38"] ;
                                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 px-2 hidden">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="assignment3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Molecular Weight:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="mw1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'6' }}" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="mass_first_reactant" class="font-s-14 text-blue">Mass of First Product:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="mass_first_reactant" id="mw2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mass_first_reactant)?request()->mass_first_reactant:'' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="grid grid-cols-2 gap-4 mt-3">
                        <div class="space-y-2 px-2">
                            <p><strong class="font-s-14 text-blue">Second Product</strong></p>
                            <label for="first_product" class="font-s-14 text-blue">Coefficient in balanced reaction:</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="first_product[]" id="second_product" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->first_product)?request()->first_product:'5' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                            </div>
                        </div>
                        <div class="space-y-2 px-2 moles_two">
                            <p><strong class="font-s-14 text-blue">&nbsp;</strong></p>
                            <label for="moles" class="font-s-14 text-blue">Number of moles or molecules:</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="moles[]" id="baristow2" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->moles)?request()->moles:'' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 input-field whole_fourth hidden">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="atom4" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                                <div class="w-full py-2 position-relative">
                                    <select name="first_value_unit" id="atom_unit_four" class="input">
                                        @php
                                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                                            $val =["1","1.00784","4.002602","6.941","9.0122","10.811","12.011","14.0067","15.9994","18.998403","20.179","22.98977","24.305","26.98154","28.0855","30.97376","32.06","35.453","39.0983","39.948","40.08","44.9559","47.90","50.9415","51.996","54.9380","55.847","58.9332","58.70","63.546","65.38"] ;
                                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 px-2 hidden">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="assignment4" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="atom5" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'2' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                                <div class="w-full py-2 position-relative">
                                    <select name="first_value_unit" id="atom_unit_five" class="input">
                                        @php
                                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                                            $val =["1","1.00784","4.002602","6.941","9.0122","10.811","12.011","14.0067","15.9994","18.998403","20.179","22.98977","24.305","26.98154","28.0855","30.97376","32.06","35.453","39.0983","39.948","40.08","44.9559","47.90","50.9415","51.996","54.9380","55.847","58.9332","58.70","63.546","65.38"] ;
                                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 px-2 hidden">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="assignment5" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="atom6" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'3' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="first_value_unit" class="font-s-14 text-blue">&nbsp;</label>
                                <div class="w-full py-2 position-relative">
                                    <select name="first_value_unit" id="atom_unit_six" class="input">
                                        @php
                                            $name = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                                            $val =["1","1.00784","4.002602","6.941","9.0122","10.811","12.011","14.0067","15.9994","18.998403","20.179","22.98977","24.305","26.98154","28.0855","30.97376","32.06","35.453","39.0983","39.948","40.08","44.9559","47.90","50.9415","51.996","54.9380","55.847","58.9332","58.70","63.546","65.38"] ;
                                            optionsList($val,$name,isset(request()->first_value_unit)?request()->first_value_unit:'');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 px-2 hidden">
                                <label for="molecular_weight" class="font-s-14 text-blue">Number of atoms in one molecule:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="assignment6" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'1' }}" onkeypress="return event.charCode>=48 && event.charCode<=57" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="molecular_weight" class="font-s-14 text-blue">Molecular Weight:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="molecular_weight" id="mw3" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_weight)?request()->molecular_weight:'6' }}" />
                                </div>
                            </div>
                            <div class="space-y-2 px-2">
                                <label for="mass_first_reactant" class="font-s-14 text-blue">Mass of First Product:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="mass_first_reactant" id="mw4" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mass_first_reactant)?request()->mass_first_reactant:'' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 empty_div_two">
                    </div>
                    <div class="grid grid-cols-3 gap-4 empty_div_four">
                    </div>
                    <div class="grid grid-cols-3 gap-4 empty_div_six">
                    </div>
                    {{-- <div class="w-full">
                        <div class="space-y-2 px-2" id="btn4">
                            <button type="button" id="btn3" class="bg-white border radius-5 px-4 py-2" title="Add More Fields"><strong class="text-blue">+ Add Reactants</strong></button>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="space-y-2 px-2" id="btn42">
                            <button type="button" id="btn32" class="bg-white border radius-5 px-4 py-2" title="Add More Fields"><strong class="text-blue">+ Add Reactants</strong></button>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="space-y-2 px-2" id="btn7">
                            <button type="button" id="btn72" class="bg-white border radius-5 px-4 py-2" title="Add More Fields"><strong class="text-blue">+ Add Reactants</strong></button>
                        </div>
                    </div> --}}

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
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full  mt-3">
                    <div class="w-full">
                        @php
                            $coefficient=$detail['coefficient'];
                            $count_first_coefficient=count($detail['coefficient']);
                            $product=$detail['first_product'];
                            $product_count=count($detail['first_product']);
            
                            function gcd($a,$b) {
                                $a = abs($a); $b = abs($b);
                                if( $a < $b) list($b,$a) = Array($a,$b);
                                if( $b == 0) return $a;
                                $r = $a % $b;
                                while($r > 0) {
                                    $a = $b;
                                    $b = $r;
                                    $r = $a % $b;
                                }
                                return $b;
                            }
            
                            function simplify($num,$den) {
                                $g = gcd($num,$den);
                                return Array($num/$g,$den/$g);
                            }
                            function writetext($string){
                                if($string=="0"){
                                    $r="First Reactant";
                                }else if($string=="1"){
                                    $r="Second Reactant";
                                }else if($string=="2"){
                                    $r="Third Reactant";
                                }else if($string=="3"){
                                    $r="Fourth Reactant";
                                }else if($string=="4"){
                                    $r="Fifth Reactant";
                                }
                                return $r;
                            }
                            function writetexttwo($string2){
                                if($string2=="0"){
                                    $r2="First Product";
                                }else if($string2=="1"){
                                    $r2="Second Product";
                                }else if($string2=="2"){
                                    $r2="Third Product";
                                }else if($string2=="3"){
                                    $r2="Fourth Product";
                                }else if($string2=="4"){
                                    $r2="Fifth Product";
                                }
                                return $r2;
                            }
            
                            $s=1;
                            $sub=$count_first_coefficient-1;//3 4 5 6
                            $sub2=$product_count-1;
                        @endphp
                        <div class="w-full overflow-auto">
                            <table class="col-12" cellspacing="0">
                                <tr>
                                    <th class="text-start text-blue border-b p-2">Description</th>
                                    <th class="text-start text-blue border-b p-2">Molar Ratio</th>
                                </tr>
                                @php
                                    for ($i=0; $i<$count_first_coefficient; $i++) {
                                        $stokes=writetext($i);
                                        for ($j=0; $j <$sub ; $j++) {
                                            $stokes2=writetext($j+$s);
                                            $root=simplify($coefficient[$i],$coefficient[$j+$s]);
                                            @endphp
                                            <tr><td class="border-b p-2">{!! $stokes !!} : {!! $stokes2 !!}</td><td class="border-b p-2">{!! $root[0] !!} : {!! $root[1] !!}</td></tr>
                                            @php
                                        }
                                        for($k=0;$k<$product_count;$k++){
                                            $dimuth=simplify($coefficient[$i],$product[$k]);
                                            $call1=writetext($i);
                                            $call2=writetexttwo($k);
                                            @endphp
                                            <tr><td class="border-b p-2">{!! $call1; !!} : {!! $call2; !!}</td><td class="border-b p-2">{!! $dimuth[0]!!} : {!! $dimuth[1]; !!}</td></tr>
                                            @php
                                        }
                                        $sub=$sub-1;
                                        $s=$s+1;
                                    }
                                    $p=1;
                                    for($y=0;$y<$product_count;$y++){
                                        $broad=writetexttwo($y);
                                        for($z=0;$z<$sub2;$z++){
                                            $rooty=simplify($product[$y],$product[$z+$p]);
                                            $broad2=writetexttwo($z+$p);
                                            @endphp
                                            <tr><td class="border-b p-2">{!! $broad !!} : {!! $broad2 !!}</td><td class="border-b p-2">{!! $rooty[0] !!} : {!! $rooty[1] !!}</td></tr>
                                            @php
                                        }
                                        $sub2=$sub2-1;
                                        $p=$p+1;
                                    }
                                @endphp
                            </table>
                        </div>
                    </div>
                    <div class="w-full text-center  mt-[30px]">
                        <a href="{{ url()->current() }}/" class="calculate px-6 py-3 sm:px-10 sm:py-4 font-semibold bg-[#99EA48] rounded-[30px] focus:outline-none focus:ring-2 text-sm sm:text-base" id="">
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
        <script>
            $("#mole_one,#first_reactant,#second_reactant").on("input",function(){
                var first_reactant=$("#first_reactant").val();
                var second_reactant=$("#second_reactant").val();
                var third_reactant=$("#third_reactant").val();
                var moles_one=$("#mole_one").val();
                var calculate=(second_reactant*moles_one)/(first_reactant);
                var y=$("#find").val();
                if(y=="2"){
                $("#mole_two").val(calculate);
                }else if(y=="3"){
                $("#mole_two").val();
                }
            });
            $("#p_one,#first_product,#second_product").on("input",function(){
                var first_product=$("#first_product").val();
                var second_product=$("#second_product").val();
                var third_product=$("#third_product").val();
                var moles_one=$("#p_one").val();
                var calculate=(second_product*moles_one)/(first_product);
                $("#p_two").val(calculate);
            });
            $("#find").on("change",function(){
            var w=$(this).val();
            if(w=="1"){
                //#btn2,#btn22,#btn4,#btn42
                $(".whole,#btn22,#btn42,.empty_div_three,.empty_div_four,.moles_one,.moles_two,.whole_two,#btn6,#btn7,.empty_div_five,.whole_three,.whole_fourth,.empty_div_six").hide();
                $("#btn2,#btn4,.empty_div_one,.empty_div_two").show();
            }else if(w=="2"){
                $("#btn22,#btn42,.empty_div_three,.empty_div_four,.moles_one,.moles_two").show();
                $("#btn2,#btn4,.whole,.empty_div_one,.empty_div_two,.whole_two,#btn6,#btn7,.empty_div_five,.whole_three,.whole_fourth,.empty_div_six").hide();
            }else if(w=="3"){
                $(".whole,.moles_one,.moles_two,.whole_two,#btn6,#btn7,.empty_div_five,.whole_three,.whole_fourth,.empty_div_six").show();
                $("#btn22,#btn42,#btn2,#btn4,.empty_div_one,.empty_div_two,.empty_div_three,.empty_div_four").hide();
            }
            });
            var x=0;
            var y=0;
            var cars=["Third","Fourth","Fifth"];
            var data=["third","fourth","fifth"];
            $("#btn3").click(function(){
                if(3 > x){
                //text box increment
                var read=
                '<div class="space-y-2">'+
                    '<p class=""><strong class="font-s-14 text-blue">'+cars[x]+' Reactant</strong></p>'+
                    '<p class="font-s-14 text-blue">Coefficient in balanced reaction</p>'+
                    '<input type="number" step="any" name="first_coefficient[]" class="input" id="'+data[x]+'_reactant" value="" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                    '</div>';
                $(".empty_div_one").append(read);
                x++;
                }else{
                    alert('Only Five Fields are Allowed');
                }
            });
            $("#btn5").on("click",function(){
                    if(3 > y){
                    //text box increment
                    var root='<div class="space-y-2">'+
                        '<p class=""><strong class="font-s-14 text-blue">'+cars[y]+' Product</strong></p>'+
                        '<p class="font-s-14 text-blue">Coefficient in balanced reaction</p>'+
                        '<input type="number" step="any" name="first_product[]" class="input" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                        '</div>';
                    $(".empty_div_two").append(root);
                    y++;
                    }else{
                        alert('Only Five Fields are Allowed');
                    }
                });
            var a=0;
            var b=0;
            var cars2=["Third","Fourth","Fifth"];
            var data2=["third","fourth","fifth"];
            $("#btn32").on("click",function(){
                if(3 > a){
                    //text box increment
                    var read2=
                    '<div class="space-y-2">'+
                    '<p class=""><strong class="font-s-14 text-blue">'+cars2[a]+' Reactant</strong></p>'+
                    '<p class="font-s-14 text-blue">Coefficient in balanced reaction</p>'+
                        '<input type="number" step="any" name="first_coefficient[]" class="input" id="'+data2[a]+'_reactant" value="" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                    '</div>'+
                        '<div class="space-y-2">'+
                        '<p class="font-s-14 text-blue">&nbsp;</p>'+
                        '<p class="font-s-14 text-blue">Number of moles or molecules</p>'+
                        '<input type="number" step="any" name="moles_two" class="input" id="mole_'+data2[a]+'" value="" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                        '</div>';
                    $(".empty_div_three").append(read2);
                    a++;
                    $("#mole_one,#first_reactant,#second_reactant,#third_reactant,#fourth_reactant,#fifth_reactant").on("keyup",function(){
                        var first_reactant=$("#first_reactant").val();
                        var second_reactant=$("#second_reactant").val();
                        var third_reactant=$("#third_reactant").val();
                        var fourth_reactant=$("#fourth_reactant").val();
                        var fifth_reactant=$("#fifth_reactant").val();
                        var moles_one=$("#mole_one").val();
                        var calculate=(second_reactant*moles_one)/(first_reactant);
                        var res=(calculate*third_reactant)/second_reactant;
                        $("#mole_third").val(res);
                        var res2=(res*fourth_reactant)/(third_reactant);
                        $("#mole_fourth").val(res2);
                        var p=$("#mole_fourth").val();
                        var res3=(res2*fifth_reactant)/fourth_reactant;
                        $("#mole_fifth").val(res3);
                    });
                    }else{
                        alert('Only Five Fields are Allowed');
                    }
            });
            $("#btn52").on("click",function(){
                if(3 > b){
                    //text box increment
                    var root='<div class="space-y-2">'+
                        '<p class=""><strong class="font-s-14 text-blue">'+cars2[b]+' Product</strong></p>'+
                        '<p class="font-s-14 text-blue">Coefficient in balanced reaction</p>'+
                        '<input type="number" step="any" name="first_product[]" class="input" id="'+data2[b]+'_product" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                        '</div>'+
                        '<div class="space-y-2">'+
                        '<p class="font-s-14 text-blue">&nbsp;</p>'+
                        '<p class="font-s-14 text-blue">Number of moles or molecules</p>'+
                        '<input type="number" step="any" name="moles_two" class="input" id="p_'+data2[b]+'" value="" onkeypress="return event.charCode>=48 && event.charCode<=57" />';
                    $(".empty_div_four").append(root);
                    b++;
                    $("#p_one,#first_product,#second_product,#third_product,#fourth_product,#fifth_product").on("keyup",function(){
                        var first_product=$("#first_product").val();
                        var second_product=$("#second_product").val();
                        var third_product=$("#third_product").val();
                        var fourth_product=$("#fourth_product").val();
                        var fifth_product=$("#fifth_product").val();
                        var p_two=$("#p_one").val();
                        var calculate=(second_product*p_two)/(first_product);
                        var resp=(calculate*third_product)/second_product;
                        $("#p_third").val(resp);
                        var res2=(resp*fourth_product)/(third_product);
                        $("#p_fourth").val(res2);
                        var p=$("#p_fourth").val();
                        var res3=(res2*fifth_product)/fourth_product;
                        $("#p_fifth").val(res3);
                    });
                    }else{
                        alert('Only Five Fields are Allowed');
                    }
            });
            var c=0;
            var d=0;
            var cars3=["Third","Fourth","Fifth"];
            var data3=["third","fourth","fifth"];
            $("#btn72").on("click",function(){
                if(3 > c){
                    //text box increment
                    var rooty='<div class="space-y-2">'+
                        '<p class=""><strong class="font-s-14 text-blue">'+cars3[c]+' Reactant</strong></p>'+
                        '<p class="font-s-14 text-blue">Coefficient in balanced reaction</p>'+
                        '<input type="number" step="any" name="first_coefficient[]" class="validate dinesh" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                        '</div>'+
                        '<div class="space-y-2">'+
                        '<p class="font-s-14 text-blue">&nbsp;</p>'+
                        '<p class="font-s-14 text-blue">Number of moles or molecules</p>'+
                        '<input type="number" step="any" name="moles_two" class="input" id="ca_'+data3[c]+'" value="">'+
                        '</div>'+
                        '<div class="space-y-2 margin_top_20">'+
                            '<p class="font-s-14 text-blue">Number of atoms in one molecule</p>'+
                            '<input type="number" step="any" name="molecular_weight" class="input" id="valu_'+data3[c]+'" value="1" onkeypress="return event.charCode>=48 && event.charCode<=57">'+
                        '</div>'+
                        '<div class="col m6 s12 padding_l_r_20">'+
                        '<p class="font-s-14 text-blue">&nbsp;</p>'+
                    '<select class="browser-default" name="first_value_unit" id="unitt_'+data3[c]+'">'+
                        '<option value="1">Atomic mass amu</option>'+
                        '<option value="1.00784">H (Hydrogen)</option>'+
                        '<option value="4.002602">He (Helium)</option>'+
                        '<option value="6.941">Li (Lithium)</option>'+
                        '<option value="9.0122">Be (Beryllium)</option>'+
                        '<option value="10.811">B (Boron)</option>'+
                        '<option value="12.011">C (Carbon)</option>'+
                        '<option value="14.0067">N (Nitrogen)</option>'+
                        '<option value="15.9994">O (Oxygen)</option>'+
                        '<option value="18.998403">F (Fluorine)</option>'+
                        '<option value="20.179">Ne (Neon)</option>'+
                        '<option value="22.98977">Na (Sodium)</option>'+
                        '<option value="24.305">Mg (Magnesium)</option>'+
                        '<option value="26.98154">Al (Aluminium)</option>'+
                        '<option value="28.0855">Si (Silicon)</option>'+
                        '<option value="30.97376">P (Phosphorus)</option>'+
                        '<option value="32.06">S (Sulfur)</option>'+
                        '<option value="35.453">Cl (Chlorine)</option>'+
                        '<option value="39.948">Ar (Argon)</option>'+
                        '<option value="39.0983">Potassium (K)</option>'+
                        '<option value="40.08">Ca (Calcium)</option>'+
                        '<option value="44.9559">Sc (Scandium)</option>'+
                        '<option value="47.90">Ti (Titanium)</option>'+
                        '<option value="50.9415">V (Vanadium)</option>'+
                        '<option value="54.996">Cr (Chromium)</option>'+
                        '<option value="54.9380">Mn (Manganese)</option>'+
                        '<option value="55.845">Fe (Iron)</option>'+
                        '<option value="58.9332">Co ( Cobalt)</option>'+
                        '<option value="58.70">Ni (Nickel)</option>'+
                        '<option value="63.546">Cu (Copper)</option>'+
                        '<option value="65.38">Zn (Zinc)</option>'+
                    '</select>'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20 display_none">'+
                        '<input type="number" step="any" name="molecular_weight" class="input" id="assigning'+data3[c]+'" value="1" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20">'+
                        '<p class="font-s-14 text-blue">Number of atoms in one molecule</p>'+
                        '<input type="number" step="any" name="molecular_weight" class="input" id=valuu_'+data3[c]+' value="2" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                    '</div>'+
                    '<div class="col m6 s12 padding_l_r_20">'+
                        '<p class="font-s-14 text-blue">&nbsp;</p>'+
                    '<select class="browser-default" name="first_value_unit" id="unittt'+data3[c]+'">'+
                        '<option value="1">Atomic mass amu</option>'+
                        '<option value="1.00784">H (Hydrogen)</option>'+
                        '<option value="4.002602">He (Helium)</option>'+
                        '<option value="6.941">Li (Lithium)</option>'+
                        '<option value="9.0122">Be (Beryllium)</option>'+
                        '<option value="10.811">B (Boron)</option>'+
                        '<option value="12.011">C (Carbon)</option>'+
                        '<option value="14.0067">N (Nitrogen)</option>'+
                        '<option value="15.9994">O (Oxygen)</option>'+
                        '<option value="18.998403">F (Fluorine)</option>'+
                        '<option value="20.179">Ne (Neon)</option>'+
                        '<option value="22.98977">Na (Sodium)</option>'+
                        '<option value="24.305">Mg (Magnesium)</option>'+
                        '<option value="26.98154">Al (Aluminium)</option>'+
                        '<option value="28.0855">Si (Silicon)</option>'+
                        '<option value="30.97376">P (Phosphorus)</option>'+
                        '<option value="32.06">S (Sulfur)</option>'+
                        '<option value="35.453">Cl (Chlorine)</option>'+
                        '<option value="39.948">Ar (Argon)</option>'+
                        '<option value="39.0983">Potassium (K)</option>'+
                        '<option value="40.08">Ca (Calcium)</option>'+
                        '<option value="44.9559">Sc (Scandium)</option>'+
                        '<option value="47.90">Ti (Titanium)</option>'+
                        '<option value="50.9415">V (Vanadium)</option>'+
                        '<option value="54.996">Cr (Chromium)</option>'+
                        '<option value="54.9380">Mn (Manganese)</option>'+
                        '<option value="55.845">Fe (Iron)</option>'+
                        '<option value="58.9332">Co ( Cobalt)</option>'+
                        '<option value="58.70">Ni (Nickel)</option>'+
                        '<option value="63.546">Cu (Copper)</option>'+
                        '<option value="65.38">Zn (Zinc)</option>'+
                    '</select>'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20 display_none">'+
                        '<input type="number" step="any" name="molecular_weight" class="input" id="dine'+data3[c]+'" value="1" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20">'+
                        '<p class="font-s-14 text-blue">Number of atoms in one molecule</p>'+
                        '<input type="number" step="any" name="molecular_weight" class="input" id="valuuu'+data3[c]+'" value="3" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                    '</div>'+
                    '<div class="col m6 s12 padding_l_r_20">'+
                        '<p class="font-s-14 text-blue">&nbsp;</p>'+
                    '<select class="browser-default" name="first_value_unit" id="unittttt'+data3[c]+'">'+
                        '<option value="1">Atomic mass amu</option>'+
                        '<option value="1.00784">H (Hydrogen)</option>'+
                        '<option value="4.002602">He (Helium)</option>'+
                        '<option value="6.941">Li (Lithium)</option>'+
                        '<option value="9.0122">Be (Beryllium)</option>'+
                        '<option value="10.811">B (Boron)</option>'+
                        '<option value="12.011">C (Carbon)</option>'+
                        '<option value="14.0067">N (Nitrogen)</option>'+
                        '<option value="15.9994">O (Oxygen)</option>'+
                        '<option value="18.998403">F (Fluorine)</option>'+
                        '<option value="20.179">Ne (Neon)</option>'+
                        '<option value="22.98977">Na (Sodium)</option>'+
                        '<option value="24.305">Mg (Magnesium)</option>'+
                        '<option value="26.98154">Al (Aluminium)</option>'+
                        '<option value="28.0855">Si (Silicon)</option>'+
                        '<option value="30.97376">P (Phosphorus)</option>'+
                        '<option value="32.06">S (Sulfur)</option>'+
                        '<option value="35.453">Cl (Chlorine)</option>'+
                        '<option value="39.948">Ar (Argon)</option>'+
                        '<option value="39.0983">Potassium (K)</option>'+
                        '<option value="40.08">Ca (Calcium)</option>'+
                        '<option value="44.9559">Sc (Scandium)</option>'+
                        '<option value="47.90">Ti (Titanium)</option>'+
                        '<option value="50.9415">V (Vanadium)</option>'+
                        '<option value="54.996">Cr (Chromium)</option>'+
                        '<option value="54.9380">Mn (Manganese)</option>'+
                        '<option value="55.845">Fe (Iron)</option>'+
                        '<option value="58.9332">Co ( Cobalt)</option>'+
                        '<option value="58.70">Ni (Nickel)</option>'+
                        '<option value="63.546">Cu (Copper)</option>'+
                        '<option value="65.38">Zn (Zinc)</option>'+
                    '</select>'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20 display_none">'+
                    '<p class="font-s-14 text-blue">Number of atoms in one molecule</p>'+
                    '<input type="number" step="any" class="input" id="pa_'+data3[c]+'" value="1" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20">'+
                        '<p class="font-s-14 text-blue">Molecular Weight</p>'+
                        '<input type="number" step="any" class="input" id="molecular_weightt_'+data3[c]+'" value="6">'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20">'+
                        '<p class="font-s-14 text-blue">Mass of '+cars3[c]+' Reactant</p>'+
                        '<input type="number" step="any" class="input" id="masss'+data3[c]+'" value="">'+
                    '</div>';
                    $(".empty_div_five").append(rooty);
                    $("#unitt_third").on("change",function(){
                        var g3=$(this).val();
                        $("#assigningthird").val(g3);
                    });
                        $("#unitttthird").on("change",function(){
                        var g4=$(this).val();
                        $("#dinethird").val(g4);
                    });
                        $("#unitttttthird").on("change",function(){
                        var g5=$(this).val();
                        $("#pa_third").val(g5);
                        });
                    $("#valu_third,#valuu_third,#valuuuthird,#ca_third").on("keyup",function(){
                        var unit11=$("#assigningthird").val();
                        var unit22=$("#dinethird").val();
                        var unit32=$("#pa_third").val();
                        var value11=$("#valu_third").val();
                        var value22=$("#valuu_third").val();
                        var value33=$("#valuuuthird").val();
                        var ca_third=$("#ca_third").val();
                        mul11=value11*unit11;
                        mul22=value22*unit22;
                        mul33=value33*unit32;
                        sum22=mul11+mul22+mul33;
                        var ans22=sum22*ca_third;
                        //alert("The ans is"+ans22);
                        $("#molecular_weightt_third").val(sum22);
                        $("#masssthird").val(ans22);
                    });
                    $("#unitt_fourth").on("change",function(){
                        var g6=$(this).val();
                        $("#assigningfourth").val(g6);
                    });
                        $("#unitttfourth").on("change",function(){
                        var g7=$(this).val();
                        $("#dinefourth").val(g7);
                    });
                        $("#unitttttfourth").on("change",function(){
                        var g8=$(this).val();
                        $("#pa_fourth").val(g8);
                        });
                    $("#valu_fourth,#valuu_fourth,#valuuufourth,#ca_fourth").on("keyup",function(){
                        var unit111=$("#assigningfourth").val();
                        var unit222=$("#dinefourth").val();
                        var unit322=$("#pa_fourth").val();
                    
                        var value112=$("#valu_fourth").val()
                        var value223=$("#valuu_fourth").val();
                        var value333=$("#valuuufourth").val();
                        var ca_fourth=$("#ca_fourth").val();
                        mul111=value112*unit111;
                        mul222=value223*unit222;
                        mul333=value333*unit322;
                        sum222=mul111+mul222+mul333;
                        var ans222=sum222*ca_fourth;
                        $("#molecular_weightt_fourth").val(sum222);
                        $("#masssfourth").val(ans222);
                    });
                    $("#unitt_fifth").on("change",function(){
                        var g7=$(this).val();
                        $("#assigningfifth").val(g7);
                    });
                        $("#unitttfifth").on("change",function(){
                        var g8=$(this).val();
                        $("#dinefourth").val(g8);
                    });
                        $("#unitttttfifth").on("change",function(){
                        var g9=$(this).val();
                        $("#pa_fifth").val(g9);
                        });
                    $("#valu_fifth,#valuu_fifth,#valuuufifth,#ca_fifth").on("keyup",function(){
                        var unit1111=$("#assigningfifth").val();
                    
                        var unit2222=$("#dinefifth").val();
                    
                        var unit3222=$("#pa_fifth").val();
                    
                        var value1112=$("#valu_fifth").val();
                    
                        var value2223=$("#valuu_fifth").val();
                    
                        var value3333=$("#valuuufifth").val();
                
                        var ca_fifth=$("#ca_fifth").val();
                        mul1111=value1112*unit1111;
                        mul2222=value2223*unit2222;
                        mul3333=value3333*unit3222;
                        sum2222=mul1111+mul2222+mul3333;
                        var ans2222=sum2222*ca_fifth;
                    ("The value of ans2222 is"+sum2222);
                        $("#molecular_weightt_fifth").val(sum2222);
                        $("#masssfifth").val(ans2222);
                    });
                        c++;
                    }else{
                        alert('Only Five Fields are Allowed');
                    }
            });
                $("#btn82").on("click",function(){
                //text box increment
                if(3 > d){
                    var robot='<div class="space-y-2">'+
                        '<p class=""><strong class="font-s-14 text-blue">'+cars3[d]+' Product</strong></p>'+
                        '<p class="font-s-14 text-blue">Coefficient in balanced reaction</p>'+
                        '<input type="number" step="any" name="first_coefficient[]" class="input" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                        '</div>'+
                        '<div class="space-y-2">'+
                        '<p class="font-s-14 text-blue">&nbsp;</p>'+
                        '<p class="font-s-14 text-blue">Number of moles or molecules</p>'+
                        '<input type="number" step="any" name="moles_two" class="input" id="caf_'+data3[d]+'" value="">'+
                        '</div>'+
                        '<div class="space-y-2 margin_top_20">'+
                            '<p class="font-s-14 text-blue">Number of atoms in one molecule</p>'+
                            '<input type="number" step="any" name="molecular_weight" class="input" id="valuq_'+data3[d]+'" value="1" onkeypress="return event.charCode>=48 && event.charCode<=57">'+
                        '</div>'+
                        '<div class="col m6 s12 padding_l_r_20">'+
                        '<p class="font-s-14 text-blue">&nbsp;</p>'+
                    '<select class="browser-default" name="first_value_unit" id="unittqp_'+data3[d]+'">'+
                        '<option value="1">Atomic mass amu</option>'+
                        '<option value="1.00784">H (Hydrogen)</option>'+
                        '<option value="4.002602">He (Helium)</option>'+
                        '<option value="6.941">Li (Lithium)</option>'+
                        '<option value="9.0122">Be (Beryllium)</option>'+
                        '<option value="10.811">B (Boron)</option>'+
                        '<option value="12.011">C (Carbon)</option>'+
                        '<option value="14.0067">N (Nitrogen)</option>'+
                        '<option value="15.9994">O (Oxygen)</option>'+
                        '<option value="18.998403">F (Fluorine)</option>'+
                        '<option value="20.179">Ne (Neon)</option>'+
                        '<option value="22.98977">Na (Sodium)</option>'+
                        '<option value="24.305">Mg (Magnesium)</option>'+
                        '<option value="26.98154">Al (Aluminium)</option>'+
                        '<option value="28.0855">Si (Silicon)</option>'+
                        '<option value="30.97376">P (Phosphorus)</option>'+
                        '<option value="32.06">S (Sulfur)</option>'+
                        '<option value="35.453">Cl (Chlorine)</option>'+
                        '<option value="39.948">Ar (Argon)</option>'+
                        '<option value="39.0983">Potassium (K)</option>'+
                        '<option value="40.08">Ca (Calcium)</option>'+
                        '<option value="44.9559">Sc (Scandium)</option>'+
                        '<option value="47.90">Ti (Titanium)</option>'+
                        '<option value="50.9415">V (Vanadium)</option>'+
                        '<option value="54.996">Cr (Chromium)</option>'+
                        '<option value="54.9380">Mn (Manganese)</option>'+
                        '<option value="55.845">Fe (Iron)</option>'+
                        '<option value="58.9332">Co ( Cobalt)</option>'+
                        '<option value="58.70">Ni (Nickel)</option>'+
                        '<option value="63.546">Cu (Copper)</option>'+
                        '<option value="65.38">Zn (Zinc)</option>'+
                    '</select>'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20 display_none">'+
                        '<input type="number" step="any" name="molecular_weight" class="input" id="h'+data3[d]+'" value="1" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20">'+
                        '<p class="font-s-14 text-blue">Number of atoms in one molecule</p>'+
                        '<input type="number" step="any" name="molecular_weight" class="input" id=valuqo_'+data3[d]+' value="2" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                    '</div>'+
                    '<div class="col m6 s12 padding_l_r_20">'+
                        '<p class="font-s-14 text-blue">&nbsp;</p>'+
                    '<select class="browser-default" name="first_value_unit" id="unittql'+data3[d]+'">'+
                        '<option value="1">Atomic mass amu</option>'+
                        '<option value="1.00784">H (Hydrogen)</option>'+
                        '<option value="4.002602">He (Helium)</option>'+
                        '<option value="6.941">Li (Lithium)</option>'+
                        '<option value="9.0122">Be (Beryllium)</option>'+
                        '<option value="10.811">B (Boron)</option>'+
                        '<option value="12.011">C (Carbon)</option>'+
                        '<option value="14.0067">N (Nitrogen)</option>'+
                        '<option value="15.9994">O (Oxygen)</option>'+
                        '<option value="18.998403">F (Fluorine)</option>'+
                        '<option value="20.179">Ne (Neon)</option>'+
                        '<option value="22.98977">Na (Sodium)</option>'+
                        '<option value="24.305">Mg (Magnesium)</option>'+
                        '<option value="26.98154">Al (Aluminium)</option>'+
                        '<option value="28.0855">Si (Silicon)</option>'+
                        '<option value="30.97376">P (Phosphorus)</option>'+
                        '<option value="32.06">S (Sulfur)</option>'+
                        '<option value="35.453">Cl (Chlorine)</option>'+
                        '<option value="39.948">Ar (Argon)</option>'+
                        '<option value="39.0983">Potassium (K)</option>'+
                        '<option value="40.08">Ca (Calcium)</option>'+
                        '<option value="44.9559">Sc (Scandium)</option>'+
                        '<option value="47.90">Ti (Titanium)</option>'+
                        '<option value="50.9415">V (Vanadium)</option>'+
                        '<option value="54.996">Cr (Chromium)</option>'+
                        '<option value="54.9380">Mn (Manganese)</option>'+
                        '<option value="55.845">Fe (Iron)</option>'+
                        '<option value="58.9332">Co ( Cobalt)</option>'+
                        '<option value="58.70">Ni (Nickel)</option>'+
                        '<option value="63.546">Cu (Copper)</option>'+
                        '<option value="65.38">Zn (Zinc)</option>'+
                    '</select>'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20 display_none">'+
                        '<input type="number" step="any" name="molecular_weight" class="input" id="h2'+data3[d]+'" value="1" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20">'+
                        '<p class="font-s-14 text-blue">Number of atoms in one molecule</p>'+
                        '<input type="number" step="any" name="molecular_weight" class="input" id="valuuq'+data3[d]+'" value="3" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                    '</div>'+
                    '<div class="col m6 s12 padding_l_r_20">'+
                        '<p class="font-s-14 text-blue">&nbsp;</p>'+
                    '<select class="browser-default" name="first_value_unit" id="unittttq'+data3[d]+'">'+
                        '<option value="1">Atomic mass amu</option>'+
                        '<option value="1.00784">H (Hydrogen)</option>'+
                        '<option value="4.002602">He (Helium)</option>'+
                        '<option value="6.941">Li (Lithium)</option>'+
                        '<option value="9.0122">Be (Beryllium)</option>'+
                        '<option value="10.811">B (Boron)</option>'+
                        '<option value="12.011">C (Carbon)</option>'+
                        '<option value="14.0067">N (Nitrogen)</option>'+
                        '<option value="15.9994">O (Oxygen)</option>'+
                        '<option value="18.998403">F (Fluorine)</option>'+
                        '<option value="20.179">Ne (Neon)</option>'+
                        '<option value="22.98977">Na (Sodium)</option>'+
                        '<option value="24.305">Mg (Magnesium)</option>'+
                        '<option value="26.98154">Al (Aluminium)</option>'+
                        '<option value="28.0855">Si (Silicon)</option>'+
                        '<option value="30.97376">P (Phosphorus)</option>'+
                        '<option value="32.06">S (Sulfur)</option>'+
                        '<option value="35.453">Cl (Chlorine)</option>'+
                        '<option value="39.948">Ar (Argon)</option>'+
                        '<option value="39.0983">Potassium (K)</option>'+
                        '<option value="40.08">Ca (Calcium)</option>'+
                        '<option value="44.9559">Sc (Scandium)</option>'+
                        '<option value="47.90">Ti (Titanium)</option>'+
                        '<option value="50.9415">V (Vanadium)</option>'+
                        '<option value="54.996">Cr (Chromium)</option>'+
                        '<option value="54.9380">Mn (Manganese)</option>'+
                        '<option value="55.845">Fe (Iron)</option>'+
                        '<option value="58.9332">Co ( Cobalt)</option>'+
                        '<option value="58.70">Ni (Nickel)</option>'+
                        '<option value="63.546">Cu (Copper)</option>'+
                        '<option value="65.38">Zn (Zinc)</option>'+
                    '</select>'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20 display_none">'+
                    '<p class="font-s-14 text-blue">Number of atoms in one molecule</p>'+
                    '<input type="number" step="any" class="input" id="ppl_'+data3[d]+'" value="1" onkeypress="return event.charCode>=48 && event.charCode<=57" />'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20">'+
                        '<p class="font-s-14 text-blue">Molecular Weight</p>'+
                        '<input type="number" step="any" class="input" id="molecular_weighttq_'+data3[d]+'" value="6">'+
                    '</div>'+
                    '<div class="space-y-2 margin_top_20">'+
                        '<p class="font-s-14 text-blue">Mass of '+cars3[d]+' Reactant</p>'+
                        '<input type="number" step="any" class="input" id="masssq'+data3[d]+'" value="">'+
                    '</div>';
                    $(".empty_div_six").append(robot);
                    $("#unittqp_third").on("change",function(){
                        var queen1=$(this).val();
                        $("#hthird").val(queen1);
                    });
                    $("#unittqlthird").on("change",function(){
                        var queen2=$(this).val();
                        $("#h2third").val(queen2);
                    });
                    $("unittttqthird").on("change",function(){
                        var queen3=$(this).val();
                        $("#ppl_third").val(queen3);
                    });
                    $("#caf_third,#valuq_third,#valuqo_third,#valuuqthird").on("keyup",function(){
                        var cal1=$("#hthird").val();
                        var cal2=$("#h2third").val();
                        var cal3=$("#ppl_third").val();
                        var w1=$("#valuq_third").val();
                        var w2=$("#valuqo_third").val();
                        var w3=$("#valuuqthird").val();
                        var caf_third=$("#caf_third").val();
                        var cat1=cal1*w1;
                        var cat2=cal2*w2;
                        var cat3=cal3*w3;
                        var cat4=cat1+cat2+cat3;
                        $("#molecular_weighttq_third").val(cat4);
                        $("#masssqthird").val(cat4*caf_third);
                    });
                    $("#caf_fourth,#valuq_fourth,#valuqo_fourth,#valuuqfourth").on("keyup",function(){
                        var cal11=$("#hfourth").val();
                        var cal22=$("#h2fourth").val();
                        var cal33=$("#ppl_fourth").val();
                        var w11=$("#valuq_fourth").val();
                        var w22=$("#valuqo_fourth").val();
                        var w33=$("#valuuqfourth").val();
                        var caf_fourth=$("#caf_fourth").val();
                        var cat11=cal11*w11;
                        var cat22=cal22*w22;
                        var cat33=cal33*w33;
                        var cat43=cat11+cat22+cat33;
                        $("#molecular_weighttq_fourth").val(cat43);
                        $("#masssqfourth").val(cat43*caf_fourth);
                    });
                    $("#caf_fifth,#valuq_fifth,#valuqo_fifth,#valuuqfifth").on("keyup",function(){
                        var cal111=$("#hfifth").val();
                        var cal222=$("#h2fifth").val();
                        var cal333=$("#ppl_fifth").val();
                        var w111=$("#valuq_fifth").val();
                        var w222=$("#valuqo_fifth").val();
                        var w333=$("#valuuqfifth").val();
                        var caf_fifth=$("#caf_fifth").val();
                        var cat111=cal111*w111;
                        var cat222=cal222*w222;
                        var cat333=cal333*w333;
                        var cat433=cat111+cat222+cat333;
                        $("#molecular_weighttq_fifth").val(cat433);
                        $("#masssqfifth").val(cat433*caf_fifth);
                    });
                    d++;
                }
                });
            $("#unit1").on("change",function(){
                var w=$(this).val();
                $("#assign1").val(w);
            });
            $("#unit2").on("change",function(){
                var d=$(this).val();
                $("#assign2").val(d);
            });
                $("#unit3").on("change",function(){
                var g=$(this).val();
                $("#assign3").val(g);
            });
                $("#unit4").on("change",function(){
                var w2=$(this).val();
                $("#assign4").val(w2);
            });
            $("#unit5").on("change",function(){
                var d2=$(this).val();
                $("#assign5").val(d2);
            });
                $("#unit6").on("change",function(){
                var g2=$(this).val();
                $("#assign6").val(g2);
            });
            $("#value1,#value2,#value3,#mole_one").on("keyup",function(){
            var unit1=$("#assign1").val();
            var unit2=$("#assign2").val();
            var unit3=$("#assign3").val();
            var value1=$("#value1").val();
            var value2=$("#value2").val();
            var value3=$("#value3").val();
            var moles_one=$("#mole_one").val();
            mul1=value1*unit1;
            mul2=value2*unit2;
            mul3=value3*unit3;
            sum=mul1+mul2+mul3;
            var ans=sum*moles_one;
            $("#molecular_weight").val(sum);
            $("#mass_one").val(ans);
            });
            $("#value4,#value5,#value6,#mole_two").on("keyup",function(){
            var unit4=$("#assign4").val();
            var unit5=$("#assign5").val();
            var unit6=$("#assign6").val();
            var value4=$("#value4").val();
            var value5=$("#value5").val();
            var value6=$("#value6").val();
            var moles_two=$("#mole_two").val();
            mul4=value4*unit4;
            mul5=value5*unit5;
            mul6=value6*unit6;
            sum2=mul4+mul5+mul6;
            var ans2=sum2*moles_two;
            $("#molecular_weight2").val(sum2);
            $("#mass_two").val(ans2);
            });
            $("#atom_unit_one").on("change",function(){
                var ball1=$(this).val();
                $("#assignment1").val(ball1);
            });
            $("#atom_unit_two").on("change",function(){
                var ball2=$(this).val();
                $("#assignment2").val(ball2);
            });
            $("#atom_unit_three").on("change",function(){
                var ball3=$(this).val();
                $("#assignment3").val(ball3);
            });
            $("#atom1,#atom2,#atom3,#baristow").on("input",function(){
                var unit_value_one=$("#assignment1").val();
                var unit_value_two=$("#assignment2").val();
                var unit_value_three=$("#assignment3").val();
                var content_value_one=$("#atom1").val();
                var content_value_two=$("#atom2").val();
                var content_value_three=$("#atom3").val();
                var baristow=$("#baristow").val();
                zarab1=unit_value_one*content_value_one;
                zarab2=unit_value_two*content_value_two;
                zarab3=unit_value_three*content_value_three;
                zarab4=zarab1+zarab2+zarab3;
                $("#mw1").val(zarab4);
                $("#mw2").val(zarab4*baristow);
            });
            $("#atom_unit_four").on("change",function(){
                var ball11=$(this).val();
                $("#assignment4").val(ball11);
            });
            $("#atom_unit_five").on("change",function(){
                var ball22=$(this).val();
                $("#assignment5").val(ball22);
            });
            $("#atom_unit_six").on("change",function(){
                var ball32=$(this).val();
                $("#assignment6").val(ball32);
            });
            $("#atom4,#atom5,#atom6,#baristow2").on("input",function(){
                var unit_value_onee=$("#assignment4").val();
                var unit_value_twoo=$("#assignment5").val();
                var unit_value_threee=$("#assignment6").val();
                var content_value_onee=$("#atom4").val();
                var content_value_twoo=$("#atom5").val();
                var content_value_threee=$("#atom6").val();
                var baristow2=$("#baristow2").val();
                zarab11=unit_value_onee*content_value_onee;
                zarab22=unit_value_twoo*content_value_twoo;
                zarab33=unit_value_threee*content_value_threee;
                /*alert(zarab11);
                alert(zarab22);
                alert(zarab33);*/
                zarab44=zarab11+zarab22+zarab33;
                $("#mw3").val(zarab44);
                $("#mw4").val(zarab44*baristow2);
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>