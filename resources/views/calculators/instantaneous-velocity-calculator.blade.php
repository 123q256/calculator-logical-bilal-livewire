<style>
    #onetw{
    /* background: transparent; */
    border: none;
    color: #1670a7;
    outline: none;
}
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
@csrf
<div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
    @if (isset($error))
    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
   @endif
   <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
        <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="i_d">
                <label for="i_d1" class="label">{{$lang['2']}} (x₁):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="i_d" id="i_d1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['i_d']) ? $_POST['i_d'] : '1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="i_d_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('i_d_unit_dropdown')">{{ isset($_POST['i_d_unit'])?$_POST['i_d_unit']:'cm' }} ▾</label>
                    <input type="text" name="i_d_unit" value="{{ isset($_POST['i_d_unit'])?$_POST['i_d_unit']:'cm' }}" id="i_d_unit" class="hidden">
                    <div id="i_d_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="i_d_unit">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_d_unit', 'cm')">cm</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_d_unit', 'm')">m</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_d_unit', 'km')">km</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_d_unit', 'in')">in</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_d_unit', 'ft')">ft</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_d_unit', 'yd')">yd</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_d_unit', 'mi')">mi</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="f_d">
                <label for="f_d1" class="label">{{$lang['3']}} (x₂):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="f_d" id="f_d1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f_d']) ? $_POST['f_d'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="f_d_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_d_unit_dropdown')">{{ isset($_POST['f_d_unit'])?$_POST['f_d_unit']:'cm' }} ▾</label>
                    <input type="text" name="f_d_unit" value="{{ isset($_POST['f_d_unit'])?$_POST['f_d_unit']:'cm' }}" id="f_d_unit" class="hidden">
                    <div id="f_d_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_d_unit">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_d_unit', 'cm')">cm</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_d_unit', 'm')">m</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_d_unit', 'km')">km</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_d_unit', 'in')">in</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_d_unit', 'ft')">ft</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_d_unit', 'yd')">yd</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_d_unit', 'mi')">mi</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="i_tt">
                <label for="i_tt1" class="label">{{$lang['4']}} (t₁):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="i_tt" id="i_tt1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['i_tt']) ? $_POST['i_tt'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="i_tt_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('i_tt_unit_dropdown')">{{ isset($_POST['i_tt_unit'])?$_POST['i_tt_unit']:'sec' }} ▾</label>
                    <input type="text" name="i_tt_unit" value="{{ isset($_POST['i_tt_unit'])?$_POST['i_tt_unit']:'sec' }}" id="i_tt_unit" class="hidden">
                    <div id="i_tt_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="i_tt_unit">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_tt_unit', 'sec')">sec</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_tt_unit', 'min')">min</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_tt_unit', 'hrs')">hrs</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="f_tt">
                <label for="f_tt1" class="label">{{$lang['5']}} (t₂):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="f_tt" id="f_tt" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f_tt']) ? $_POST['f_tt'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="f_tt_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_tt_unit_dropdown')">{{ isset($_POST['f_tt_unit'])?$_POST['f_tt_unit']:'sec' }} ▾</label>
                    <input type="text" name="f_tt_unit" value="{{ isset($_POST['f_tt_unit'])?$_POST['f_tt_unit']:'sec' }}" id="f_tt_unit" class="hidden">
                    <div id="f_tt_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_tt_unit">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_tt_unit', 'sec')">sec</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_tt_unit', 'min')">min</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_tt_unit', 'hrs')">hrs</p>
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
    @if ($type == 'calculator')
    @include('inc.copy-pdf')
    @endif
    <div class="rounded-lg  flex items-center justify-center">
        <div class="w-full mt-3">
            <div class="w-full">
                <div class="text-center">
                    <p class="text-[18px]">
                        <strong>
                            {{$lang['iv']}} (V<sub>int</sub>)
                        </strong>
                    </p>
                    <div class="flex justify-center">
                        <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                            <strong class="text-blue" id="circle_result">
                                {{$detail['iv']}}
                            </strong>
                            <select name="circle_unit_result " id="onetw" class="text-[16px] d-inline ms-2" style="width:100px">
                                @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                                @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                                @php
                                }}
                                $name = ["m/s","ft/s","km/s","km/h","mi/s","mph"];
                                $val = ["m/s","ft/s","km/s","km/h","mi/s","mph"];
                                optionsList($val,$name,isset($_POST['circle_unit_result'])?$_POST['circle_unit_result']:'m/s');
                                @endphp
                            </select>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endisset
</form>

@push('calculatorJS')
<script>
   
   document.addEventListener("DOMContentLoaded", () => {
        const conversionFactors = {
            'ft/s': 3.281,
            'm/s': 1,         
            'km/s': 0.001,  
            'km/h': 3.6, 
            'mi/s': 0.000621,
            'mph': 2.237 
        };

        const circleResultDiv = document.getElementById('circle_result');
        const initialValue = parseFloat(circleResultDiv.innerText);
        circleResultDiv.setAttribute('data-initial-value', initialValue);

        document.getElementById('onetw').addEventListener('change', event => {
            const unit = event.target.value;
            const conversionFactor = conversionFactors[unit];

            if (conversionFactor !== undefined) {
                const originalValue = parseFloat(circleResultDiv.getAttribute('data-initial-value'));
                const newValue = originalValue * conversionFactor;

                circleResultDiv.innerText = newValue; 
            } else {
                console.error("Invalid conversion factor for unit: " + unit);
            }
        });
    });

    @if (isset($detail))
        function loadMathJax() {
            var mathJaxScript = document.createElement('script');
            mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_SVG-full";
            document.querySelector('head').appendChild(mathJaxScript);
        
            var mathJaxConfigScript = document.createElement('script');
            mathJaxConfigScript.type = "text/x-mathjax-config";
            mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"SVG": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
            document.querySelector('head').appendChild(mathJaxConfigScript);
        }
        
        window.addEventListener('load', function () {
            loadMathJax();
        });
    @endif

</script>
@endpush