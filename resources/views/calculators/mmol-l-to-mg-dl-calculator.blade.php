<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="solve" class="label">{!! $lang['1'] !!}:</label>
                    <div class="w-full py-2 position-relative">
                        <select name="solve" id="solve" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ["$lang[2] mg/dl","$lang[2] mmol/L"];
                                $val = ["1","2"];
                                optionsList($val,$name,isset(request()->solve)?request()->solve:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="input" class="label" id="cc_hp">{!! $lang['3'] !!} mmol/L:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="input" id="input" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->input)?request()->input:'7' }}" />
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
                <div class="w-full mt-3">
                    <div class="w-full text-center">
                        <p><strong class="text-[18px]">{!! $lang[4] !!}</strong></p>
                        <p><strong class="text-green-500 text-[32px]">{!! round($detail['answer'], 2) !!}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var solveElement = document.getElementById('solve');
                var ccHpElement = document.getElementById('cc_hp');

                function updateText() {
                    var solve_val = solveElement.value;
                    if (solve_val === "1") {
                        ccHpElement.textContent = "{!! $lang[3] !!} mmol/L:";
                    } else {
                        ccHpElement.textContent = "{!! $lang[3] !!} mg/dl:";
                    }
                }

                updateText();

                solveElement.addEventListener('change', updateText);
            });
        </script>
    @endpush
</form>