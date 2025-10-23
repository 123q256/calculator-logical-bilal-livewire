<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2 relative">
                        <label for="chemical_selection" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                        <select name="chemical_selection" id="chemical_selection" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[2],$lang[3],$lang[4],$lang[5],"[H⁺], [OH⁻], or pOH"];
                                $val = ["1","2","3","4","5"];
                                optionsList($val,$name,isset(request()->chemical_selection)?request()->chemical_selection:'1');
                            @endphp
                        </select>
                    </div>
                    <div class="space-y-2 relative" id="selection2">
                        <label for="chemical_name" class="font-s-14 text-blue" id="acid">{!! $lang['6'] !!}</label>
                        <select name="chemical_name" id="chemical_name" class="input">
                            @php
                                $name = ["Acetic acid - CH₃COOH","Arsenic acid - H₃AsO₄","Arsenious acid - H₃AsO₃","Benzoic acid - C₆H₅COOH","Boric acid - H₃BO₃","Carbonic acid - H₂CO₃","Citric acid - C₃H₅O(COOH)₃","Formic acid - HCOOH","Hydrocyanic acid - HCN","Hydrofluoric acid - HF","Hydrosulfuric acid - H₂S","Hydrochloric acid - HCl","
                                Hypochlorous acid - HClO","Perchloric acid - HClO₄","Chlorous acid - HClO₂","Sulfuric acid - H₂SO₄","Sulfurous acid - H₂SO₃","Nitric acid - HNO₃","Nitrous acid - HNO₂","Phenol - C₆H₅OH","Phosphoric acid - H₃PO₄","Phosphorous acid - H₃PO₃"];
                                $val = ["0.000018","0.0069","0.00000000059","0.000065","0.00000000058","0.00000045","0.0007447","0.00018","0.00000000072","0.00063","0.0000001","10000000","0.00000005","1","0.011","1000","0.015","27.5","0.00051","0.00000000013","0.0069","0.05"];
                                optionsList($val,$name,isset(request()->chemical_name)?request()->chemical_name:'0.000018');
                            @endphp
                        </select>
                    </div>
                    <div class="space-y-2 relative hidden" id="selection">
                        <label for="operation" class="font-s-14 text-blue">{!! $lang['7'] !!}</label>
                        <select name="operation" id="operation" class="input">
                            @php
                                $name = ["[H⁺]","pOH","[OH⁻]"];
                                $val = ["1","2","3"];
                                optionsList($val,$name,isset(request()->operation)?request()->operation:'1');
                            @endphp
                        </select>
                    </div>
                    <div class="space-y-2"  id="third">
                        <label for="concentration" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="concentration" id="concentration" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['concentration'])?$_POST['concentration']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="con_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('con_units_dropdown')">{{ isset($_POST['con_units'])?$_POST['con_units']:'M' }} ▾</label>
                            <input type="text" name="con_units" value="{{ isset($_POST['con_units'])?$_POST['con_units']:'M' }}" id="con_units" class="hidden">
                            <div id="con_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[60%] md:w-[60%] w-[44%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_units', 'M')">molars (M)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_units', 'mM')">millimolars (mM)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_units', 'µM')">micromolars (µM)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_units', 'nM')">nanomolars (nM)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_units', 'pM')">picomolars (pM)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_units', 'fM')">femtomolars (fM)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_units', 'aM')">attomolars (aM)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_units', 'zM')">zeptomolars (zM)</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 hidden"  id="weight">
                        <label for="f_length" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="f_length" id="f_length" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f_length'])?$_POST['f_length']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="fl_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fl_units_dropdown')">{{ isset($_POST['fl_units'])?$_POST['fl_units']:'ng' }} ▾</label>
                            <input type="text" name="fl_units" value="{{ isset($_POST['fl_units'])?$_POST['fl_units']:'ng' }}" id="fl_units" class="hidden">
                            <div id="fl_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[60%] md:w-[60%] w-[60%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 'ng')">nanograms (ng)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 'µg')">micrograms (µg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 'mg')">milligrams (mg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 'g')">grams (g)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 'dag')">decagrams (dag)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 'kg')">kilograms (kg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 't')">tons (t)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 'gr')">grain (gr)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 'dr')">dram (dr)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 'lbs')">pounds (lbs)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 'stones')">stones</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 'oz t')">troy ounces (oz t)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', 'oz')">ounces (oz)</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 hidden"  id="volume">
                        <label for="post_space" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="post_space" id="post_space" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['post_space'])?$_POST['post_space']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="po_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('po_units_dropdown')">{{ isset($_POST['po_units'])?$_POST['po_units']:'mm³' }} ▾</label>
                            <input type="text" name="po_units" value="{{ isset($_POST['po_units'])?$_POST['po_units']:'mm³' }}" id="po_units" class="hidden">
                            <div id="po_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[60%] md:w-[60%] w-[60%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'mm³')">cubic millimeters (mm³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'cm³')">cubic centimeters (cm³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'dm³')">cubic decimeters (dm³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'm³')">cubic meters (m³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'in³')">cubic inches (in³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'ft³')">cubic feet (ft³)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'ml')">milliliters (ml)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'cl')">centiliters (cl)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'liters')">liters</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'US gal')">US gallons (US gal)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'UK gal')">UK gallons (UK gal)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'US fl oz')">US fluid ounces (US fl oz)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', 'UK fl oz')">UK fluid ounces (UK fl oz)</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 relative hidden" id="selection">
                        <label for="second" class="font-s-14 text-blue">PoH:</label>
                        <input type="number" step="any" name="second" id="second" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->second)?request()->second:'7' }}" />
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
                    <div class="w-full rounded-lg mt-3">
                        <div class="w-full mt-2">
                            @if($detail['pH'])
                                <p class="text-xl font-semibold">pH:</p>
                                <p class="text-[#119154] text-3xl font-semibold">{!! $detail['pH'] !!}</p>
                            @endif
                    
                            <div class="w-full overflow-auto mt-3">
                                <table class="w-full lg:w-1/2 border-collapse">
                                    @if(isset($detail['H']))
                                        <tr>
                                            <td class="border-b py-2 font-semibold">[H⁺]</td>
                                            <td class="border-b py-2 font-semibold">{!! $detail['H'] !!}</td>
                                        </tr>
                                    @endif
                                    @if(isset($detail['pho']))
                                        <tr>
                                            <td class="border-b py-2 font-semibold">pOH</td>
                                            <td class="border-b py-2 font-semibold">{!! $detail['pho'] !!}</td>
                                        </tr>
                                    @endif
                                    @if(isset($detail['OH']))
                                        <tr>
                                            <td class="border-b py-2 font-semibold">OH⁻</td>
                                            <td class="border-b py-2 font-semibold">{!! $detail['OH'] !!}</td>
                                        </tr>
                                    @endif
                                    @if(isset($detail['pka']))
                                        <tr>
                                            <td class="border-b py-2 font-semibold">Pka:</td>
                                            <td class="border-b py-2 font-semibold">{!! $detail['pka'] !!}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let val=document.getElementById("operation").value;
                if(val=="1"){
                    document.getElementById("third").style.display = 'block';
                    document.getElementById("poh").style.display = 'none';
                    document.getElementById('concentration').textContent = "[H⁺]:";
                }else if(val=="2"){
                    document.getElementById("third").style.display = 'none';
                    document.getElementById("poh").style.display = 'block';
                }else if(val=="3"){
                    document.getElementById("third").style.display = 'block';
                    document.getElementById("poh").style.display = 'none';
                    document.getElementById('concentration').textContent = "[OH⁻]:";
                }
                document.getElementById("operation").addEventListener("change",function(){
                    let val=this.value;
                    if(val=="1"){
                        document.getElementById("third").style.display = 'block';
                        document.getElementById("poh").style.display = 'none';
                        document.getElementById('concentration').textContent = "[H⁺]:";
                    }else if(val=="2"){
                        document.getElementById("third").style.display = 'none';
                        document.getElementById("poh").style.display = 'block';
                    }else if(val=="3"){
                        document.getElementById("third").style.display = 'block';
                        document.getElementById("poh").style.display = 'none';
                        document.getElementById('concentration').textContent = "[OH⁻]:";
                    }
                });

                var s1=document.getElementById('chemical_selection');
                var s2=document.getElementById('chemical_name');

                s2.innerHTML="";
                if(s1.value=="1"){
                    var optionArray=['0.000018|Acetic acid - CH₃COOH','0.0069|Arsenic acid - H₃AsO₄','0.00000000059|Arsenious acid - H₃AsO₃','0.000065|Benzoic acid - C₆H₅COOH','0.00000000058|Boric acid - H₃BO₃','0.00000045|Carbonic acid - H₂CO₃','0.0007447|Citric acid - C₃H₅O(COOH)₃','0.00018|Formic acid - HCOOH','0.00000000072|Hydrocyanic acid - HCN','0.00063|Hydrofluoric acid - HF','0.0000001|Hydrosulfuric acid - H₂S','10000000|Hydrochloric acid - HCl','0.00000005|Hypochlorous acid - HClO','1|Perchloric acid - HClO₄','0.011|Chlorous acid - HClO₂','1000|Sulfuric acid - H₂SO₄','0.015|Sulfurous acid - H₂SO₃','27.5|Nitric acid - HNO₃','0.00051|Nitrous acid - HNO₂','0.00000000013|Phenol - C₆H₅OH','0.0069|Phosphoric acid - H₃PO₄','0.05|Phosphorous acid - H₃PO₃'];
                    document.getElementById("selection2").style.display='block';
                    document.getElementById("third").style.display='block';
                    document.getElementById("acid").textContent="Acid:";
                    document.getElementById("poh").style.display='none';
                    document.getElementById("weight").style.display='none';
                    document.getElementById("volume").style.display='none';
                    document.getElementById("poh").style.display='none';
                    document.getElementById("concentration").textContent="Concentration:";
                    document.getElementById("selection").style.display='none';
                }else if(s1.value=="2"){
                    var optionArray=['0.63|sodium hydroxide - NaOH','0.00000000043|aniline - C₆H₅NH₂','0.000018|ammonia - NH₃','0.0025|magnesium hydroxide - Mg(OH)₂','0.00013|iron (II) hydroxide - Fe(OH)₂','2.3|lithium hydroxide - LiOH','0.0000000014|aluminium hydroxide - Al(OH)₃'];
                    document.getElementById("selection2").style.display='block';
                    document.getElementById("acid").textContent="Base:";
                    document.getElementById("poh").style.display='none';
                    document.getElementById("concentration").textContent="Concentration:";
                    document.getElementById("selection").style.display='none';
                }else if(s1.value=="3"){
                    var optionArray=['0.000018&60.052|Acetic acid - CH₃COOH','0.0069&141.94|Arsenic acid - H₃AsO₄','0.00000000059&125.94|Arsenious acid - H₃AsO₃','0.000065&122.123|Benzoic acid - C₆H₅COOH','0.00000000058&61.83|Boric acid - H₃BO₃','0.00000045&62.024|Carbonic acid - H₂CO₃','0.0007447&192.124|Citric acid - C₃H₅O(COOH)₃','0.00018&46.025|Formic acid - HCOOH','0.00000000072&27.0253|Hydrocyanic acid - HCN','0.00063&20.0063|Hydrofluoric acid - HF','0.0000001&34.0809|Hydrosulfuric acid - H₂S','10000000&36.46|Hydrochloric acid - HCl','0.00000005&52.46|Hypochlorous acid - HClO','1&100.46|Perchloric acid - HClO₄','0.011&68.46|Chlorous acid - HClO₂','1000&98.079|Sulfuric acid - H₂SO₄','0.015&82.07|Sulfurous acid - H₂SO₃','27.5&63.01|Nitric acid - HNO₃','0.00051&47.013|Nitrous acid - HNO₂','0.00000000013&94.11|Phenol - C₆H₅OH','0.0069&97.994|Phosphoric acid - H₃PO₄','0.05&82|Phosphorous acid - H₃PO₃'];
                    document.getElementById("selection2").style.display='block';
                    document.getElementById("acid").textContent="Acid:";
                    document.getElementById("weight").style.display='block';
                    document.getElementById("volume").style.display='block';
                    document.getElementById("poh").style.display='none';
                    document.getElementById("third").style.display='none';
                    document.getElementById("selection").style.display='none';
                }else if(s1.value=="4"){
                    var optionArray=['0.63&39.997|sodium hydroxide - NaOH','0.00000000043&93.13|aniline - C₆H₅NH₂','0.000018&17.031|ammonia - NH₃','0.0025&58.3197|magnesium hydroxide - Mg(OH)₂','0.00013&89.86|iron (II) hydroxide - Fe(OH)₂','2.3&23.95|lithium hydroxide - LiOH','0.0000000014&78|aluminium hydroxide - Al(OH)₃'];
                    document.getElementById("selection2").style.display='block';
                    document.getElementById("weight").style.display='block';
                    document.getElementById("volume").style.display='block';
                    document.getElementById("acid").textContent="Base:";
                    document.getElementById("poh").style.display='none';
                    document.getElementById("third").style.display='none';
                    document.getElementById("selection").style.display='none';
                }else if(s1.value=="5"){
                    document.getElementById("selection2").style.display='none';
                    document.getElementById("concentration").textContent="[H⁺]:";
                    document.getElementById("third").style.display='block';
                    document.getElementById("weight").style.display='none';
                    document.getElementById("volume").style.display='none';
                    document.getElementById("poh").style.display='none';
                    document.getElementById("selection").style.display='block';
                }
                for(var option in optionArray){
                    var pair=optionArray[option].split("|");
                    var newoption=document.createElement("option");
                    newoption.value=pair[0];
                    newoption.innerHTML=pair[1];
                    s2.options.add(newoption);   
                }

                @if(isset($detail) || isset($error))
                    document.getElementById('chemical_name').value = "{!! request()->chemical_name !!}"
                @endif

                document.getElementById('chemical_selection').addEventListener('change', function(){
                    var s1=this;
                    var s2=document.getElementById('chemical_name');

                    s2.innerHTML="";
                    if(s1.value=="1"){
                        var optionArray=['0.000018|Acetic acid - CH₃COOH','0.0069|Arsenic acid - H₃AsO₄','0.00000000059|Arsenious acid - H₃AsO₃','0.000065|Benzoic acid - C₆H₅COOH','0.00000000058|Boric acid - H₃BO₃','0.00000045|Carbonic acid - H₂CO₃','0.0007447|Citric acid - C₃H₅O(COOH)₃','0.00018|Formic acid - HCOOH','0.00000000072|Hydrocyanic acid - HCN','0.00063|Hydrofluoric acid - HF','0.0000001|Hydrosulfuric acid - H₂S','10000000|Hydrochloric acid - HCl','0.00000005|Hypochlorous acid - HClO','1|Perchloric acid - HClO₄','0.011|Chlorous acid - HClO₂','1000|Sulfuric acid - H₂SO₄','0.015|Sulfurous acid - H₂SO₃','27.5|Nitric acid - HNO₃','0.00051|Nitrous acid - HNO₂','0.00000000013|Phenol - C₆H₅OH','0.0069|Phosphoric acid - H₃PO₄','0.05|Phosphorous acid - H₃PO₃'];
                        document.getElementById("selection2").style.display='block';
                        document.getElementById("third").style.display='block';
                        document.getElementById("acid").textContent="Acid:";
                        document.getElementById("poh").style.display='none';
                        document.getElementById("weight").style.display='none';
                        document.getElementById("volume").style.display='none';
                        document.getElementById("poh").style.display='none';
                        document.getElementById("concentration").textContent="Concentration:";
                        document.getElementById("selection").style.display='none';
                    }else if(s1.value=="2"){
                        var optionArray=['0.63|sodium hydroxide - NaOH','0.00000000043|aniline - C₆H₅NH₂','0.000018|ammonia - NH₃','0.0025|magnesium hydroxide - Mg(OH)₂','0.00013|iron (II) hydroxide - Fe(OH)₂','2.3|lithium hydroxide - LiOH','0.0000000014|aluminium hydroxide - Al(OH)₃'];
                        document.getElementById("selection2").style.display='block';
                        document.getElementById("acid").textContent="Base:";
                        document.getElementById("poh").style.display='none';
                        document.getElementById("concentration").textContent="Concentration:";
                        document.getElementById("selection").style.display='none';
                    }else if(s1.value=="3"){
                        var optionArray=['0.000018&60.052|Acetic acid - CH₃COOH','0.0069&141.94|Arsenic acid - H₃AsO₄','0.00000000059&125.94|Arsenious acid - H₃AsO₃','0.000065&122.123|Benzoic acid - C₆H₅COOH','0.00000000058&61.83|Boric acid - H₃BO₃','0.00000045&62.024|Carbonic acid - H₂CO₃','0.0007447&192.124|Citric acid - C₃H₅O(COOH)₃','0.00018&46.025|Formic acid - HCOOH','0.00000000072&27.0253|Hydrocyanic acid - HCN','0.00063&20.0063|Hydrofluoric acid - HF','0.0000001&34.0809|Hydrosulfuric acid - H₂S','10000000&36.46|Hydrochloric acid - HCl','0.00000005&52.46|Hypochlorous acid - HClO','1&100.46|Perchloric acid - HClO₄','0.011&68.46|Chlorous acid - HClO₂','1000&98.079|Sulfuric acid - H₂SO₄','0.015&82.07|Sulfurous acid - H₂SO₃','27.5&63.01|Nitric acid - HNO₃','0.00051&47.013|Nitrous acid - HNO₂','0.00000000013&94.11|Phenol - C₆H₅OH','0.0069&97.994|Phosphoric acid - H₃PO₄','0.05&82|Phosphorous acid - H₃PO₃'];
                        document.getElementById("selection2").style.display='block';
                        document.getElementById("acid").textContent="Acid:";
                        document.getElementById("weight").style.display='block';
                        document.getElementById("volume").style.display='block';
                        document.getElementById("poh").style.display='none';
                        document.getElementById("third").style.display='none';
                        document.getElementById("selection").style.display='none';
                    }else if(s1.value=="4"){
                        var optionArray=['0.63&39.997|sodium hydroxide - NaOH','0.00000000043&93.13|aniline - C₆H₅NH₂','0.000018&17.031|ammonia - NH₃','0.0025&58.3197|magnesium hydroxide - Mg(OH)₂','0.00013&89.86|iron (II) hydroxide - Fe(OH)₂','2.3&23.95|lithium hydroxide - LiOH','0.0000000014&78|aluminium hydroxide - Al(OH)₃'];
                        document.getElementById("selection2").style.display='block';
                        document.getElementById("weight").style.display='block';
                        document.getElementById("volume").style.display='block';
                        document.getElementById("acid").textContent="Base:";
                        document.getElementById("poh").style.display='none';
                        document.getElementById("third").style.display='none';
                        document.getElementById("selection").style.display='none';
                    }else if(s1.value=="5"){
                        document.getElementById("selection2").style.display='none';
                        document.getElementById("concentration").textContent="[H⁺]:";
                        document.getElementById("third").style.display='block';
                        document.getElementById("weight").style.display='none';
                        document.getElementById("volume").style.display='none';
                        document.getElementById("poh").style.display='none';
                        document.getElementById("selection").style.display='block';
                    }
                    for(var option in optionArray){
                        var pair=optionArray[option].split("|");
                        var newoption=document.createElement("option");
                        newoption.value=pair[0];
                        newoption.innerHTML=pair[1];
                        s2.options.add(newoption);   
                    }
                });
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>