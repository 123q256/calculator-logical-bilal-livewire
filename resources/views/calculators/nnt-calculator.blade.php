<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="outcome" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="outcome" id="outcome" class="input">
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
                                $val = ["per","yrs"];
                                optionsList($val,$name,isset(request()->outcome)?request()->outcome:'per');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 patient_hide hidden">
                    <label for="first" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->first)?request()->first:'7' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="second" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="second" id="second" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->second)?request()->second:'15' }}" />
                        <span class="text-blue input_unit change_unit">%</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="third" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="third" id="third" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->third)?request()->third:'10' }}" />
                        <span class="text-blue input_unit change_unit">%</span>
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
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full p-3 mt-3">
                    <div class="w-full">
                        <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4 mb-5">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899">
                                    <span>{{ $lang[6] }} (ARR) =</span>
                                    <strong class="text-green-700 text-[28px]">{{ round($detail['arr'],2) }}</strong>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899">
                                    <span>{{ $lang[7] }} (NNT) =</span>
                                    <strong class="text-green-700 text-[28px]">{{ round($detail['nnt'],2) }}</strong>
                                </div>
                            </div>
                        </div>
                        <p>{{ $lang[8] }} <strong>{{ round(abs($detail['nnt']),2) }}</strong> {{ $lang[9] }}</p>
                        <p class="mb-1"><strong class="text-blue font-s-18">{{ $lang[10] }}:</strong></p>
                        @if(request()->outcome == "per")
                            <p>ARR = ({{ $lang[11] }} {{ $lang[12] }} {{ $lang[13] }}) - ({{ $lang[16] }} {{ $lang[12] }} {{ $lang[13] }})</p>
                            <p>ARR = {{ (request()->second / 100)  }} - {{ request()->third / 100 }} = {{ $detail['arr'] }}</p>
                            <p class="mt-1">
                                <span>NNT = </span>
                                <span class="fraction">
                                    <span class="num">1</span>
                                    <span class="visually-hidden"></span>
                                    <span class="den">ARR</span>
                                </span>
                                <span>=</span>
                                <span class="fraction">
                                    <span class="num">1</span>
                                    <span class="visually-hidden"></span>
                                    <span class="den">{{ $detail['arr'] }}</span>
                                </span>
                                <span>= {{ $detail['nnt'] }}</span>
                            </p>
                        @else
                            <p class="mt-1">\( R_0 = 1 - e^(\frac{-{{ $lang[11] }}\;{{ $lang[14] }}}{{{ $lang[15] }}}) \)</p>
                            <p class="mt-1">\( R_1 = 1 - e^(\frac{-{{ $lang[16] }}\;{{ $lang[14] }}}{{{ $lang[15] }}}) \)</p>
                            <p class="mt-1">\( ARR = R_0 - R_1 = {{ $detail['arr'] }} \)</p>
                            <p class="mt-1">\( NNT = \frac{1}{ARR} = \frac{1}{{!! $detail['arr'] !!}} = {{ $detail['nnt'] }} \)</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
    @push('calculatorJS')
        <script>
            let to = document.getElementById('outcome').value;
            if (to === 'per') {
                document.querySelectorAll('.patient_hide').forEach(function(element) {
                    element.style.display = 'none';
                });
                document.querySelectorAll('.change_unit').forEach(function(element) {
                    element.textContent = '%';
                });
            } else if (to === 'yrs') {
                document.querySelectorAll('.patient_hide').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('.change_unit').forEach(function(element) {
                    element.textContent = '{{ $lang[17] }}';
                });
            }
            document.addEventListener('DOMContentLoaded', function() {
                let outcomeElement = document.getElementById('outcome');

                outcomeElement.addEventListener('change', function() {
                    let to = this.value;
                    if (to === 'per') {
                        document.querySelectorAll('.patient_hide').forEach(function(element) {
                            element.style.display = 'none';
                        });
                        document.querySelectorAll('.change_unit').forEach(function(element) {
                            element.textContent = '%';
                        });
                    } else if (to === 'yrs') {
                        document.querySelectorAll('.patient_hide').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        document.querySelectorAll('.change_unit').forEach(function(element) {
                            element.textContent = '{{ $lang[17] }}';
                        });
                    }
                });
            });

            @if(isset($detail))
                function loadMathJax(){
                    var mathJaxScript = document.createElement('script');
                    mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                    document.querySelector('head').appendChild(mathJaxScript);

                    var mathJaxConfigScript = document.createElement('script');
                    mathJaxConfigScript.type = "text/x-mathjax-config";
                    mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                    document.querySelector('head').appendChild(mathJaxConfigScript);
                }

                window.addEventListener('load', function () {
                    loadMathJax();
                });
            @endif
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>