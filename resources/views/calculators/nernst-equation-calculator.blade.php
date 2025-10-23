<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 ">
                    <label for="cal" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <select name="cal" id="cal" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["E𝒸ₑₗₗ","Eᵒ","T","n","Q"];
                            $val = ["ecell","eo","t","n","q"];
                            optionsList($val,$name,isset(request()->cal)?request()->cal:'ecell');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  mt-3 gap-4">
                <div class="space-y-2 ecell  hidden">
                    <label for="ecell" class="font-s-14 text-blue">E<sub>{{ $lang['2'] }}</sub> <span class="bg-white radius-circle px-2" title="Electromotive force of the cell">?</span>:</label>
                    <div class="relative w-full ">
                        <input type="number" name="ecell" id="ecell" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ecell'])?$_POST['ecell']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="ecell_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ecell_unit_dropdown')">{{ isset($_POST['ecell_unit'])?$_POST['ecell_unit']:'mV' }} ▾</label>
                        <input type="text" name="ecell_unit" value="{{ isset($_POST['ecell_unit'])?$_POST['ecell_unit']:'mV' }}" id="ecell_unit" class="hidden">
                        <div id="ecell_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ecell_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ecell_unit', 'mV')">mV</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ecell_unit', 'V')">V</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 eo">
                    <label for="eo" class="font-s-14 text-blue">E<sup>o</sup> <span class="bg-white radius-circle px-2" title="Standard Electrode potential of the cell">?</span>:</label>
                    <div class="relative w-full ">
                        <input type="number" name="eo" id="eo" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['eo'])?$_POST['eo']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="eo_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('eo_unit_dropdown')">{{ isset($_POST['eo_unit'])?$_POST['eo_unit']:'mV' }} ▾</label>
                        <input type="text" name="eo_unit" value="{{ isset($_POST['eo_unit'])?$_POST['eo_unit']:'mV' }}" id="eo_unit" class="hidden">
                        <div id="eo_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="eo_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('eo_unit', 'mV')">mV</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('eo_unit', 'V')">V</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 t">
                    <label for="t" class="font-s-14 text-blue">T <span class="bg-white radius-circle px-2" title="Temperature">?</span>:</label>
                    <div class="relative w-full ">
                        <input type="number" name="t" id="t" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['eto'])?$_POST['t']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_unit_dropdown')">{{ isset($_POST['t_unit'])?$_POST['t_unit']:'°C' }} ▾</label>
                        <input type="text" name="t_unit" value="{{ isset($_POST['t_unit'])?$_POST['t_unit']:'°C' }}" id="t_unit" class="hidden">
                        <div id="t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'K')">K</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 n">
                    <label for="n" class="font-s-14 text-blue">n <span class="bg-white radius-circle px-2" title="The number of electrons transferred per cell reaction">?</span>:</label>
                    <input type="number" step="any" name="n" id="n" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->n)?request()->n:'5' }}" />
                </div>
                <div class="space-y-2 q">
                    <label for="q" class="font-s-14 text-blue">Q <span class="bg-white radius-circle px-2" title="Reaction Quotient">?</span>:</label>
                    <input type="number" step="any" name="q" id="q" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->q)?request()->q:'6' }}" />
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
                    <div class="w-full text-center">
                        @php
                            $ans=$detail['ans'];
                            if(request()->cal==='ecell'){
                                $head="E<sub>cell</sub>";
                            }elseif(request()->cal==='eo'){
                                $head="E<sup>o</sup>";
                            }elseif(request()->cal==='t'){
                                $head="Temperature";
                            }elseif(request()->cal==='n'){
                                $head="Number of Electrons";
                            }elseif(request()->cal==='q'){
                                $head="Reaction Quotient";
                            }
                        @endphp
                        <p><strong class="text-[20px]">{!! $head !!}</strong></p>
                        <p><strong class="text-[#119154] text-[28px]">{!! $ans !!}</strong></p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let cal = document.querySelector('#cal').value;
                toggleElements(cal);

                document.querySelector('#cal').addEventListener('change', function() {
                    let cal = this.value;
                    toggleElements(cal);
                });
            
                function toggleElements(cal) {
                    if (cal === "ecell") {
                        showElements(['eo', 't', 'n', 'q']);
                        hideElements(['ecell']);
                    } else if (cal === "eo") {
                        showElements(['ecell', 't', 'n', 'q']);
                        hideElements(['eo']);
                    } else if (cal === "t") {
                        showElements(['ecell', 'eo', 'n', 'q']);
                        hideElements(['t']);
                    } else if (cal === "n") {
                        showElements(['ecell', 'eo', 't', 'q']);
                        hideElements(['n']);
                    } else if (cal === "q") {
                        showElements(['ecell', 'eo', 't', 'n']);
                        hideElements(['q']);
                    }
                }
            
                function showElements(classes) {
                    classes.forEach(function(cls) {
                        document.querySelectorAll('.' + cls).forEach(function(el) {
                            el.style.display = 'block';
                        });
                    });
                }
            
                function hideElements(classes) {
                    classes.forEach(function(cls) {
                        document.querySelectorAll('.' + cls).forEach(function(el) {
                            el.style.display = 'none';
                        });
                    });
                }
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>