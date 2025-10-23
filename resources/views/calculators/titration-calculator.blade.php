<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="cal" class="col-lg-6 font-s-14 text-blue">{!! $lang['to_calc'] !!}:</label>
                    <select name="cal" id="cal" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['1'], $lang['2'], $lang['3'], $lang['4'], $lang['5'], $lang['6']];
                            $val = ["ma", "va", "hp", "mb", "vb", "oh"];
                            optionsList($val,$name,isset(request()->cal)?request()->cal:'ma');
                        @endphp
                    </select>
                </div>

                <div class="space-y-2 ma hidden">
                    <label for="ma" class="col-lg-6 font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="ma" id="ma" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ma'])?$_POST['ma']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="ma_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ma_unit_dropdown')">{{ isset($_POST['ma_unit'])?$_POST['ma_unit']:'cm' }} ▾</label>
                        <input type="text" name="ma_unit" value="{{ isset($_POST['ma_unit'])?$_POST['ma_unit']:'cm' }}" id="ma_unit" class="hidden">
                        <div id="ma_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ma_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ma_unit', 'pM')">pM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ma_unit', 'nM')">nM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ma_unit', 'μM')">μM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ma_unit', 'mM')">mM/p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ma_unit', 'M')">M</p>
                        </div>
                    </div>
                </div>
                 <div class="space-y-2 va">
                    <label for="va" class="col-lg-6 font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="va" id="va" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['va'])?$_POST['va']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="va_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('va_unit_dropdown')">{{ isset($_POST['va_unit'])?$_POST['va_unit']:'ml' }} ▾</label>
                        <input type="text" name="va_unit" value="{{ isset($_POST['va_unit'])?$_POST['va_unit']:'ml' }}" id="va_unit" class="hidden">
                        <div id="va_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="va_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'mm³')">mm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'cm³')">cm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'dm³')">dm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'm³')">m³/p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'cu in')">cubic inches (cu in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'cu ft')">cubic feet (cu ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'cu yd')">cubic feet (cu yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'ml')">milliliteers (ml)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'cl')">centiliters (cl)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'l')">liters (l)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'us gal')">US gallons (us gal)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'uk gal')">UK gallons (uk gal)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'us fl oz')">fluid ounces (US) (us fl oz)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('va_unit', 'uk fl oz')">fluid ounces (US) (uk fl oz)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 hp">
                    <label for="hp" class="col-lg-6 font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                    <input type="number" step="any" name="hp" id="hp" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['hp'])?$_POST['hp']:'4' }}" />
                </div>
                <div class="space-y-2 mb">
                    <label for="mb" class="col-lg-6 font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="mb" id="mb" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mb'])?$_POST['mb']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mb_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mb_unit_dropdown')">{{ isset($_POST['mb_unit'])?$_POST['mb_unit']:'cm' }} ▾</label>
                        <input type="text" name="mb_unit" value="{{ isset($_POST['mb_unit'])?$_POST['mb_unit']:'cm' }}" id="mb_unit" class="hidden">
                        <div id="mb_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mb_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mb_unit', 'pM')">pM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mb_unit', 'nM')">nM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mb_unit', 'μM')">μM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mb_unit', 'mM')">mM/p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mb_unit', 'M')">M</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 vb">
                    <label for="vb" class="col-lg-6 font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="vb" id="vb" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['vb'])?$_POST['vb']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="vb_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('vb_unit_dropdown')">{{ isset($_POST['vb_unit'])?$_POST['vb_unit']:'ml' }} ▾</label>
                        <input type="text" name="vb_unit" value="{{ isset($_POST['vb_unit'])?$_POST['vb_unit']:'ml' }}" id="vb_unit" class="hidden">
                        <div id="vb_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="vb_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'mm³')">mm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'cm³')">cm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'dm³')">dm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'm³')">m³/p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'cu in')">cubic inches (cu in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'cu ft')">cubic feet (cu ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'cu yd')">cubic feet (cu yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'ml')">milliliteers (ml)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'cl')">centiliters (cl)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'l')">liters (l)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'us gal')">US gallons (us gal)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'uk gal')">UK gallons (uk gal)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'us fl oz')">fluid ounces (US) (us fl oz)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vb_unit', 'uk fl oz')">fluid ounces (US) (uk fl oz)</p>
                        </div>
                    </div>
                 </div>
                <div class="space-y-2 hp">
                    <label for="oh" class="col-lg-6 font-s-14 text-blue">{!! $lang['6'] !!}:</label>
                    <input type="number" step="any" name="oh" id="oh" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['oh'])?$_POST['oh']:'7' }}" />
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
                            if(request()->cal === 'ma'){
                                $mainHeading = $lang['1'];
                            }elseif(request()->cal === 'va'){
                                $mainHeading = $lang['2'];
                            }elseif(request()->cal === 'hp'){
                                $mainHeading = $lang['3'];
                            }elseif(request()->cal === 'mb'){
                                $mainHeading = $lang['4'];
                            }elseif(request()->cal === 'vb'){
                                $mainHeading = $lang['5'];
                            }elseif(request()->cal === 'oh'){
                                $mainHeading = $lang['6'];
                            }
                        @endphp
                        <div class="bg-[#F6FAFC] border radius-10 p-3 mb-3 text-center">
                            <strong class="font-s-25">{{ $mainHeading }} =</strong>
                            <strong class="text-green font-s-25">{!! $detail['ans'] !!}</strong>
                        </div>
                        @if(request()->cal === 'ma' || request()->cal === 'mb')
                            <p class="mb-2"><strong>{{ $lang['7'] }}</strong></p>
                            <div class="grid  grid-cols-1 overflow-auto">
                                <table class="w-full " cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2">{{ $mainHeading }}</td>
                                        <td class='border-b py-2'><strong>{{ $detail['ans_pm'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $mainHeading }}</td>
                                        <td class='border-b py-2'><strong>{{ $detail['ans_nm'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $mainHeading }}</td>
                                        <td class='border-b py-2'><strong>{{ $detail['ans_um'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">{{ $mainHeading }}</td>
                                        <td class='py-2'><strong>{{ $detail['ans_mm'] }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @elseif(request()->cal === 'va' || request()->cal === 'vb')
                            <p class="mb-2"><strong>{{ $lang['7'] }}</strong></p>
                            <div class="grid  grid-cols-1 overflow-auto">
                                <table class="w-full " cellspacing="0">
                                    <tr class="va_vb display_none">
                                        <td class="border-b py-2"></td>
                                        <td class='border-b py-2'><strong>{{ $detail['ans_nl'] }}</strong></td>
                                    </tr>
                                    <tr class="va_vb display_none">
                                        <td class="border-b py-2"></td>
                                        <td class='border-b py-2'><strong>{{ $detail['ans_ul'] }}</strong></td>
                                    </tr>
                                    <tr class="va_vb display_none">
                                        <td class="py-2"></td>
                                        <td class='py-2'><strong>{{ $detail['ans_ml'] }}</strong></td>
                                    </tr>
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let cal = document.querySelector('#cal').value;
                toggleElements(cal);

                document.querySelector('#cal').addEventListener('change', function() {
                    let cal = this.value;
                    toggleElements(cal);
                });

                function toggleElements(cal) {
                    let elements = ['ma', 'va', 'hp', 'mb', 'vb', 'oh'];
                    elements.forEach(function(element) {
                        if (cal === element) {
                            document.querySelectorAll('.' + element).forEach(function(el) {
                                el.classList.remove('d-lg-flex');
                                el.classList.add('d-none');
                            });
                        } else {
                            document.querySelectorAll('.' + element).forEach(function(el) {
                                el.classList.add('d-lg-flex');
                                el.classList.remove('d-none');
                            });
                        }
                    });
                }
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>