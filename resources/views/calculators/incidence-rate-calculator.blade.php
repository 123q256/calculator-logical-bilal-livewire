<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">
                    
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="cases" class="label">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="cases" id="cases" class="input" aria-label="input" min="0" placeholder="00" value="{{ isset(request()->cases)?request()->cases:'10' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="risk" class="label">{!! $lang['2'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="risk" id="risk" class="input" aria-label="input" min="0" placeholder="00" value="{{ isset(request()->risk)?request()->risk:'100' }}" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="different_unit" class="label">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="different_unit" id="different_unit" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[6], $lang[7]];
                                $val = ["Yes", "No"];
                                optionsList($val,$name,isset(request()->different_unit)?request()->different_unit:'Yes');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 population">
                    <label for="population" class="label">{!! $lang['4'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="population" id="population" class="input" min="0" aria-label="input" placeholder="00" value="{{ isset(request()->population)?request()->population:'1000' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 per hidden">
                    <label for="per" class="label">{!! $lang['5'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="per" id="per" class="input">
                            @php
                                $name = ["1000", "10000", "100000", "1000000"];
                                $val = ["1000", "10000", "100000", "1000000"];
                                optionsList($val,$name,isset(request()->per)?request()->per:'100000');
                            @endphp
                        </select>
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
    
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                    @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <p><strong>{{ $lang[8] }}:</strong></p>
                        <p><strong class="text-green-500 text-[32px]">{{ round($detail['answer'], 4) }}</strong></p>
                        <p><strong class="text-[20px]">{{ $lang[9] }}:</strong></p>
                        @if(request()->different_unit == "Yes")
                            <p>{{ $lang[10] }}.</p>
                            <p>{{ $lang[8] }} = {{ $lang[1] }} / {{ $lang[2] }} * {{ $lang[4] }}</p>
                            <p>{{ $lang[8] }} = {{ request()->cases; }} / {{ request()->risk; }} * {{ request()->population; }}</p>
                            <p>{{ $lang[8] }} = {{ round($detail['answer'], 7) }}</p>
                        @elseif(request()->different_unit == "No")
                            <p>{{ $lang[10] }}</p>
                            <p>{{ $lang[8] }} = {{ $lang[2] }} / {{ $lang[4] }} * {{ $lang[5] }}</p>
                            <p>{{ $lang[8] }} = {{ request()->cases; }} / {{ request()->risk; }} * {{ request()->population; }}</p>
                            <p>{{ $lang[8] }} = {{ round($detail['answer'], 7) }}</p>
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
                let differentUnit = document.getElementById('different_unit');

                if (differentUnit.value === 'Yes') {
                    document.querySelectorAll('.population').forEach(function(element) {
                        element.style.display = 'block';
                    });
                    document.querySelectorAll('.per').forEach(function(element) {
                        element.style.display = 'none';
                    });
                } else if (differentUnit.value === 'No') {
                    document.querySelectorAll('.population').forEach(function(element) {
                        element.style.display = 'none';
                    });
                    document.querySelectorAll('.per').forEach(function(element) {
                        element.style.display = 'block';
                    });
                }

                differentUnit.addEventListener('change', function() {
                    if (this.value === 'Yes') {
                        document.querySelectorAll('.population').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        document.querySelectorAll('.per').forEach(function(element) {
                            element.style.display = 'none';
                        });
                    } else {
                        document.querySelectorAll('.population').forEach(function(element) {
                            element.style.display = 'none';
                        });
                        document.querySelectorAll('.per').forEach(function(element) {
                            element.style.display = 'block';
                        });
                    }
                });
            });
        </script>
    @endpush
</form>