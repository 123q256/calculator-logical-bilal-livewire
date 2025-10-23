<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
    
            <div class="col-span-12">
                <div class="grid grid-cols-12  lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <div class="w-full mx-auto mt-2 ">
                        <input type="hidden" name="unit_type" id="unit_type" value="lbs">
                        <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                            <div class="lg:w-1/2 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="imperial">
                                        {{ $lang['imperial'] }}
                                </div>
                            </div>
                            <div class="lg:w-1/2 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="metric">
                                        {{ $lang['metric'] }}
                                </div>
                            </div>
                        </div>
                    </div>
 
                </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="age" class="label">{!! $lang['age'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->age)?request()->age:'23' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 height_ft_in">
                <label for="ft_in" class="label">{!! $lang['height'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="ft_in" id="ft_in" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
							$name = ["4ft 7in", "4ft 8in", "4ft 9in", "4ft 10in", "4ft 11in", "5ft 0in", "5ft 1in", "5ft 2in", "5ft 3in", "5ft 4in", "5ft 5in", "5ft 6in", "5ft 7in", "5ft 8in", "5ft 9in", "5ft 10in", "5ft 11in", "6ft 0in", "6ft 1in", "6ft 2in", "6ft 3in", "6ft 4in", "6ft 5in", "6ft 6in", "6ft 7in", "6ft 8in", "6ft 9in", "6ft 10in", "6ft 11in", "7ft 0in"];
							$val = ["55", "56", "57", "58", "59", "60", "61", "62", "63", "64", "65", "66", "67", "68", "69", "70", "71", "72", "73", "74", "75", "76", "77", "78", "79", "80", "81", "82", "83", "84"];
                            optionsList($val,$name,isset(request()->ft_in)?request()->ft_in:'69');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 height_cm hidden">
                <label for="height_cm" class="label">{!! $lang['height'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="height_cm" id="height_cm" class="input" min="1" aria-label="input" placeholder="00" value="{{ isset(request()->height_cm)?request()->height_cm:'175.26' }}" />
                    <span class="text-blue input_unit">cm</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="weight" class="label">{!! $lang['weight'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="weight" id="weight" class="input" min="1" aria-label="input" placeholder="00" value="{{ isset(request()->weight)?request()->weight:'205' }}" />
                    <span class="text-blue input_unit" id="lbs_or_kg1">{{ (request()->unit_type === 'kg') ? 'kg' : 'lbs' }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="activity" class="label">{!! $lang['activity'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="activity" id="activity" class="input">
                        @php
                            $name = ["Little to no exercise", "Light exercise (1-3 days per week)", "Moderate Exercise (3-5 days per week)", "Heavy Exercise (6-7 days per week)", "Very Heavy Exercise (twice per day)"];
                            $val = ["1.2", "1.25", "1.375", "1.55", "1.725"];
                            optionsList($val,$name,isset(request()->activity)?request()->activity:'1.2');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="bf" class="label">{!! $lang['bf'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="bf" id="bf" class="input">
                        @php
                            $name = ["Exclusive Breastfeeding", "Mostly Breastfeeding", "Partial Breastfeeding", "Not Breastfeeding"];
                            $val = ["500", "400", "250", "0"];
                            optionsList($val,$name,isset(request()->bf)?request()->bf:'500');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="pregnant" class="label">{!! $lang['pregnant'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="pregnant" id="pregnant" class="input">
                        @php
                            $name = ["Not Pregnant", "First Trimester", "Second Trimester", "Third Trimester", "Third Trimester (Twins)"];
                            $val = ["0", "50", "340", "450", "700"];
                            optionsList($val,$name,isset(request()->pregnant)?request()->pregnant:'0');
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
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="flex flex-wrap justify-between">
                            <div class="mt-2">
                                <p><strong>{{ $lang['maintain'] }}</strong></p>
                                <p>
                                    <strong class="text-[28px] text-green-500">{{ $detail['maintain'] }}</strong>
                                    <span class="text-blue-500 text-[20px]">Kcal/day</span>
                                </p>
                            </div>
                            <div class="border-r hidden md:block lg:block">&nbsp;</div>
                            <div class="mt-2">
                                <p><strong>{{ $lang['lose'] }}</strong></p>
                                <p>
                                    <strong class="text-[28px] text-green-500">{{ $detail['lose'] }}</strong>
                                    <span class="text-blue-500 text-[20px]">Kcal/day</span>
                                </p>
                            </div>
                            <div class="border-r hidden md:block lg:block">&nbsp;</div>
                            <div class="mt-2">
                                <p><strong>{{ $lang['supply'] }}</strong></p>
                                <p>
                                    <strong class="text-[28px] text-green-500">{{ $detail['supply'] }}</strong>
                                    <span class="text-blue-500 text-[20px]">Kcal/day</span>
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 mt-4">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <table class="w-full" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['carbo'] }}</strong></td>
                                        <td class="border-b py-2"><strong class="clr_blue">{{ $detail['carbos1'] }}g</strong></td>
                                    </tr>
                                    <tr class="bdr-top">
                                        <td class="border-b py-2"><strong>{{ $lang['proteins'] }}</strong></td>
                                        <td class="border-b py-2"><strong class="clr_blue">{{ $detail['proteins1'] }}g</strong></td>
                                    </tr>
                                    <tr class="bdr-top boder_bottom_none">
                                        <td class="border-b py-2"><strong>{{ $lang['fats'] }}</strong></td>
                                        <td class="border-b py-2"><strong class="clr_blue">{{ $detail['fats1'] }}g</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 md:border-l-2 lg:border-l-2 md:px-3 lg:px-3">
                                <table class="w-full" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['carbo'] }}</strong></td>
                                        <td class="border-b py-2"><strong class="clr_blue">{{ $detail['carbos2'] }}g</strong></td>
                                    </tr>
                                    <tr class="bdr-top">
                                        <td class="border-b py-2"><strong>{{ $lang['proteins'] }}</strong></td>
                                        <td class="border-b py-2"><strong class="clr_blue">{{ $detail['proteins2'] }}g</strong></td>
                                    </tr>
                                    <tr class="bdr-top boder_bottom_none">
                                        <td class="border-b py-2"><strong>{{ $lang['fats'] }}</strong></td>
                                        <td class="border-b py-2"><strong class="clr_blue">{{ $detail['fats2'] }}g</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            var unit_type = "{{ request()->unit_type }}";
            if (unit_type == 'kg') {
                document.querySelectorAll('.imperial').forEach(function(element) {
                    element.classList.remove('tagsUnit');
                });
                document.querySelectorAll('.metric').forEach(function(element) {
                    element.classList.add('tagsUnit');
                });
                document.getElementById('lbs_or_kg1').textContent = "kg";
                document.querySelectorAll('.height_ft_in').forEach(function(element) {
                    element.style.display = 'none';
                });
                document.querySelectorAll('.height_cm').forEach(function(element) {
                    element.style.display = 'block';
                });
                var in_to_cm = document.getElementById('ft_in').value;
            } else {
                document.querySelectorAll('.metric').forEach(function(element) {
                    element.classList.remove('tagsUnit');
                });
                document.querySelectorAll('.imperial').forEach(function(element) {
                    element.classList.add('tagsUnit');
                });
                document.getElementById('lbs_or_kg1').textContent = "lbs";
                document.querySelectorAll('.height_ft_in').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('.height_cm').forEach(function(element) {
                    element.style.display = 'none';
                });
                var kg_to_lbs = document.getElementById('weight').value;
            }
            document.querySelectorAll('.imperial').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.getElementById('unit_type').value = 'lbs';
                    document.querySelectorAll('.imperial').forEach(function(item) {
                        item.classList.add('tagsUnit');
                    });
                    document.querySelectorAll('.metric').forEach(function(item) {
                        item.classList.remove('tagsUnit');
                    });
                    document.getElementById('lbs_or_kg1').textContent = "lbs";
                    document.querySelectorAll('.height_ft_in').forEach(function(item) {
                        item.style.display = 'block';
                    });
                    document.querySelectorAll('.height_cm').forEach(function(item) {
                        item.style.display = 'none';
                    });
                    var kg_to_lbs = document.getElementById('weight').value;
                    if (kg_to_lbs !== "") {
                        var input_lbs = (kg_to_lbs * 2.205).toFixed(2);
                        document.getElementById('weight').value = input_lbs;
                    }
                });
            });
            document.querySelectorAll('.metric').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.getElementById('unit_type').value = 'kg';
                    document.querySelectorAll('.metric').forEach(function(item) {
                        item.classList.add('tagsUnit');
                    });
                    document.querySelectorAll('.imperial').forEach(function(item) {
                        item.classList.remove('tagsUnit');
                    });
                    document.getElementById('lbs_or_kg1').textContent = "kg";
                    document.querySelectorAll('.height_ft_in').forEach(function(item) {
                        item.style.display = 'none';
                    });
                    document.querySelectorAll('.height_cm').forEach(function(item) {
                        item.style.display = 'block';
                    });
                    var in_to_cm = document.getElementById('ft_in').value;
                    if (in_to_cm !== null) {
                        var input_cm = (in_to_cm * 2.54).toFixed(2);
                        document.getElementById('height_cm').value = input_cm;
                    }
                    var lbs_to_kg = document.getElementById('weight').value;
                    if (lbs_to_kg !== "") {
                        var input_kg = (lbs_to_kg / 2.205).toFixed(2);
                        document.getElementById('weight').value = input_kg;
                    }
                });
            });
        </script>
    @endpush
</form>