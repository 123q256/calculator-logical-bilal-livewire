<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <div class="col-12  mx-auto mt-2 w-full">
                    <input type="hidden" name="food_type" id="food_type" value="{{ isset(request()->food_type)?request()->food_type:'food_piece' }}">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit food_type" id="imperial" data-value="food_piece">
                                    {{ $lang['1'] }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white food_type" id="metric" data-value="food_case">
                                    {{ $lang['2'] }}
                            </div>
                        </div>
                    </div>
                </div>
              
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="menu" class="label">{!! $lang['3'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="menu" id="menu" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->menu)?request()->menu:'45' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="measure_unit" class="label">{!! $lang['4'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="measure_unit" id="measure_unit" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["Units","Pieces","Cups","Ounces","Sheets","Pounds","Grams","Liters","Meters"];
                            $val = ["Units","Pieces","Cups","Ounces","Sheets","Pounds","Grams","Liters","Meters"];
                            optionsList($val,$name,isset(request()->measure_unit)?request()->measure_unit:'units');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="units_case" class="label"><span class="text-blue change_unit">{!! $lang['5'] !!}</span> {!! $lang['6'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="units_case" id="units_case" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->units_case)?request()->units_case:'45' }}" required />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="cost_unit" class="label" id="change_text">{!! $lang['7'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="cost_unit" id="cost_unit" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->cost_unit)?request()->cost_unit:'45' }}" required />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="serving_size" class="label">{!! $lang['8'] !!} (<span class="text-blue change_unit">{!! $lang['5'] !!}</span>):</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="serving_size" id="serving_size" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->serving_size)?request()->serving_size:'45' }}" required />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="other" class="label">{!! $lang['9'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="other" id="other" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->other)?request()->other:'45' }}" required />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="menu_price" class="label">{!! $lang['10'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="menu_price" id="menu_price" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->menu_price)?request()->menu_price:'45' }}" required />
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
                        <div class="w-full mt-2">
                            <div class="w-full overflow-auto">
                                <table class="w-full md:w-[50%] lg:w-[50%]" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[11] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ $detail['food_cost'] }} %</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[12] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ ($detail['costPerServing'] <= 0) ? "-" : "" }} {{ $currancy }} {{ abs($detail['costPerServing']) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[13] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ ($detail['costPerPlate'] <= 0) ? "-" : "" }} {{ $currancy }} {{ abs($detail['costPerPlate']) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[14] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ ($detail['contributionPerPlate'] <= 0) ? "-" : "" }} {{ $currancy }} {{ abs($detail['contributionPerPlate']) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[15] }}</strong></td>
                                        <td class="border-b py-2"><strong>{{ ($detail['profitPerCase'] <= 0) ? "-" : "" }} {{ $currancy }} {{ abs($detail['profitPerCase']) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2"><strong>{{ $lang[7] }}</strong></td>
                                        <td class="py-2"><strong>{{ ($detail['costPerUnit'] <= 0) ? "-" : "" }} {{ $currancy }} {{ abs($detail['costPerUnit']) }}</strong></td>
                                    </tr>
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
            document.querySelectorAll('.food_type').forEach(function(element) {
                element.addEventListener('click', function() {
                    let val = this.getAttribute('data-value');
                    
                    document.querySelectorAll('.food_type').forEach(function(el) {
                        el.classList.remove('tagsUnit');
                    });
                    this.classList.add('tagsUnit');
                    
                    document.getElementById('food_type').value = val;

                    if(val === "food_piece"){
                        document.getElementById("change_text").textContent = "{{ $lang[7] }}";
                    } else {
                        document.getElementById("change_text").textContent = "{{ $lang[16] }}";
                    }
                });
            });

            document.getElementById('measure_unit').addEventListener('change', function() {
                let unit_val = this.value;
                document.querySelectorAll(".change_unit").forEach(function(element) {
                    element.textContent = unit_val;
                });
            });
        </script>
    @endpush
</form>