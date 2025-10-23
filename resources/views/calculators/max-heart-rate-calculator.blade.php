<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="formula" class="label">{!! $lang['1'] !!}:</label>
                <div class="w-full py-2 relative">
                    <select name="formula" id="formula" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang[2], $lang[3], $lang[4], $lang[5], $lang[6]];
                            $val = ['1', '2', '3', '4', '5'];
                            optionsList($val,$name,isset(request()->formula)?request()->formula:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12  text-center">
                <div id="math1"><strong>HR<sub>{{ $lang[7] }}</sub> = 205.8 - (0.685 * {{ $lang[8] }})</strong></div>
                <div class="hidden" id="math2"><strong>HR<sub>{{ $lang[7] }}</sub> = 220 - {{ $lang[8] }}</strong></div>
                <div class="hidden" id="math3"><strong>HR<sub>{{ $lang[7] }}</sub> = 211 - (0.64 * {{ $lang[8] }})</strong></div>
                <div class="hidden" id="math4"><strong>HR<sub>{{ $lang[7] }}</sub> = 192 - (0.007 * {{ $lang[8] }}<sup>2</sup>)</strong></div>
                <div class="hidden" id="math5"><strong>HR<sub>{{ $lang[7] }}</sub> = 208 - (0.07 * {{ $lang[8] }})</strong></div>
            </div>
            <div class="col-span-12">
                <label for="age" class="label">{!! $lang['9'] !!}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->age)?request()->age:'7' }}" />
                    <span class=" input_unit">years</span>
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
                    <div class="w-full  mt-3">
                        <div class="w-full">
                            <p><strong>{{ $lang[10] }}</strong></p>
                            <p>
                                <strong class="text-green-700 text-[32px]">{{ round($detail['answer'], 2) }}</strong>
                                <span class="text-green-700 text-[18px]">BPM</span>
                            </p>
                            <p class="my-2">{{ $lang[11] }}.</p>
                            <p>{{ $lang[12] }}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let formulaElement = document.getElementById('formula');
                let cal = formulaElement.value;

                function showHideMathSections(cal) {
                    document.getElementById('math1').style.display = (cal === '1') ? 'block' : 'none';
                    document.getElementById('math2').style.display = (cal === '2') ? 'block' : 'none';
                    document.getElementById('math3').style.display = (cal === '3') ? 'block' : 'none';
                    document.getElementById('math4').style.display = (cal === '4') ? 'block' : 'none';
                    document.getElementById('math5').style.display = (cal === '5') ? 'block' : 'none';
                }

                showHideMathSections(cal);

                formulaElement.addEventListener('change', function() {
                    let cal = this.value;
                    showHideMathSections(cal);
                });
            });
        </script>
    @endpush
</form>