<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <input type="radio" name="unit_type" class="unit_type" id="sl" value="sl" checked {{ isset($_POST['unit_type']) && $_POST['unit_type'] === 'sl' ? 'checked' : '' }}>
                    <label for="sl" class="font-s-14 text-blue pe-lg-3 pe-2">SI(cm,kg)</label>
                    <input type="radio" name="unit_type" class="unit_type" id="usa" value="usa" {{ isset($_POST['unit_type']) && $_POST['unit_type'] === 'usa' ? 'checked' : '' }}>
                    <label for="usa" class="font-s-14 text-blue">USA(ft,lbs)</label>
                </div>
                <div class="col-span-6">
                    <label for="age" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'22' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="gender" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="gender" id="gender" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['8'], $lang['9']];
                                $val = ["male", "female"];
                                optionsList($val,$name,isset(request()->gender)?request()->gender:'male');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="height" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="height" id="height" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['height'])?$_POST['height']:'180' }}" />
                        <span class="text-blue input_unit" id="cm_ft">cm</span>
                    </div>
                </div>
                <div class="col-span-6 hidden" id="inches">
                    <label for="inches1" class="font-s-14 text-blue">{!! $lang['10'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="inches" id="inches1" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['inches'])?$_POST['inches']:'5' }}" />
                        <span class="text-blue input_unit">{{ $lang['10'] }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="weight" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="weight" id="weight" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['weight'])?$_POST['weight']:'80' }}" />
                        <span class="text-blue input_unit" id="kg_lbs">kg</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="speed_unit" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="speed_unit" id="speed_unit" class="input">
                            @php
                                $name = ["less than 2.0mph (3.2km/h)", "2.0mph (3.2km/h)", "2.5mph (4.0km/h)", "3.0mph (4.8km/h)", "3.5mph (5.6km/h)", "4.0mph (6.4km/h)", "4.5mph (7.2km/h)", "5.0mph (8.0km/h)"];
                                $val = ["less than 2.0mph (3.2km/h)", "2.0mph (3.2km/h)", "2.5mph (4.0km/h)", "3.0mph (4.8km/h)", "3.5mph (5.6km/h)", "4.0mph (6.4km/h)", "4.5mph (7.2km/h)", "5.0mph (8.0km/h)"];
                                optionsList($val,$name,isset(request()->speed_unit)?request()->speed_unit:'less than 2.0mph (3.2km/h)');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3">
                    <label for="mets" class="font-s-14 text-blue">{!! $lang['6'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="mets" id="mets" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['mets'])?$_POST['mets']:'2' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3">
                    <label for="duration" class="font-s-14 text-blue">{!! $lang['7'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="duration" id="duration" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['duration'])?$_POST['duration']:'120' }}" />
                        <span class="text-blue input_unit">min</span>
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
                <div class="w-full bg-light-blue  radius-10 p-3 mt-3">
                    <div class="w-full mt-2">
                        <div class="w-full border-b-dark pb-3">
                            <div class="w-full md:w-[60%] lg:w-[60%]  flex justify-between">
                                <div>
                                    <p><strong>{{ $lang['12'] }}:</strong></p>
                                    <p>
                                        <strong class="text-green-700 text-[32px]">{{ $detail['burned'] }}</strong>
                                        <span class="text-blue-700 font-s-18">kcal</span>
                                    </p>
                                </div>
                                <div class="hidden md:block lg:block" style="border-right: 1px solid #c6c3c3">&nbsp;</div>
                                <div>
                                    <p><strong>{{ $lang['13'] }}:</strong></p>
                                    <p>
                                        <strong class="text-green-700 text-[32px]">{{ round($detail['male_calories'])  }}</strong>
                                        <span class="text-blue-700 font-s-18">kcal/{{ $lang['17'] }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full overflow-auto">
                            <table class="w-full md:w-[60%] lg:w-[60%] ">
                                <tr>
                                    <td class="border-b py-3">
                                        <strong>{{ $lang['14'] }}:</strong>
                                        <strong class="text-green-700 text-[28px]">{{ round($detail['exercise'], 2) }}</strong>
                                        <span class="text-blue-700">{{ $lang['6'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-3">
                                        <strong>{{ $lang['15'] }}:</strong>
                                        <strong class="text-green-700 text-[28px]">{{ round($detail['hour_duration_min'], 2) }}</strong>
                                        <span class="text-blue-700">km</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3">
                                        <strong>{{ $lang['15'] }}:</strong>
                                        <strong class="text-green-700 text-[28px]">{{ round($detail['hour_mile'], 2) }}</strong>
                                        <span class="text-blue-700">{{ $lang['16'] }}</span>
                                    </td>
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
            let val = "{{ request()->unit_type }}"
            if (val === 'sl') {
                document.getElementById('cm_ft').textContent = 'cm';
                document.getElementById('height').value = '180';
                document.getElementById('kg_lbs').textContent = 'kg';
                document.getElementById('inches').style.display = 'none';
            } else if (val === 'usa') {
                document.getElementById('cm_ft').textContent = 'ft';
                document.getElementById('height').value = '5';
                document.getElementById('kg_lbs').textContent = 'lbs';
                document.getElementById('inches').style.display = 'block';
            }

            document.querySelectorAll('.unit_type').forEach(function(element) {
                element.addEventListener('click', function() {
                    let val = this.value; // or this.getAttribute('value')
                    
                    if (val === 'sl') {
                        document.getElementById('cm_ft').textContent = 'cm';
                        document.getElementById('height').value = '180';
                        document.getElementById('kg_lbs').textContent = 'kg';
                        document.getElementById('inches').style.display = 'none';
                    } else if (val === 'usa') {
                        document.getElementById('cm_ft').textContent = 'ft';
                        document.getElementById('height').value = '5';
                        document.getElementById('kg_lbs').textContent = 'lbs';
                        document.getElementById('inches').style.display = 'block';
                    }
                });
            });

            document.getElementById('speed_unit').addEventListener('change', function() {
                var speed_unit = this.value;

                switch(speed_unit) {
                    case "less than 2.0mph (3.2km/h)":
                        document.getElementById("mets").value = 2.0;
                        break;
                    case "2.0mph (3.2km/h)":
                        document.getElementById("mets").value = 2.8;
                        break;
                    case "2.5mph (4.0km/h)":
                        document.getElementById("mets").value = 3;
                        break;
                    case "3.0mph (4.8km/h)":
                        document.getElementById("mets").value = 3.5;
                        break;
                    case "3.5mph (5.6km/h)":
                        document.getElementById("mets").value = 4.3;
                        break;
                    case "4.0mph (6.4km/h)":
                        document.getElementById("mets").value = 5;
                        break;
                    case "4.5mph (7.2km/h)":
                        document.getElementById("mets").value = 7;
                        break;
                    case "5.0mph (8.0km/h)":
                        document.getElementById("mets").value = 8.3;
                        break;
                    default:
                        // Handle other cases or do nothing
                        break;
                }
            });
        </script>
    @endpush
</form>