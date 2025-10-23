<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="unit_type" class="label">{!! $lang['19'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="unit_type" id="unit_type" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['20'],$lang['21'],$lang['22']];
                            $val = ["1","2","3"];
                            optionsList($val,$name,isset($_POST['unit_type'])?$_POST['unit_type']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="test_units" class="label">{!! $lang['1'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="test_units" id="test_units" class="input">
                        @php
                            $name = [$lang['8'],$lang['6']];
                            $val = ["1","2"];
                            optionsList($val,$name,isset($_POST['test_units'])?$_POST['test_units']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="deadlift" class="label">{!! $lang['2'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="deadlift" id="deadlift" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['deadlift'])?$_POST['deadlift']:'80' }}" />
                    <span class="input_unit">lbs</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="standing_power_throw" class="label">{!! $lang['3'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="standing_power_throw" id="standing_power_throw" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['standing_power_throw'])?$_POST['standing_power_throw']:'3.2' }}" />
                    <span class="input_unit">m</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="hand_release" class="label">{!! $lang['4'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="hand_release" id="hand_release" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['hand_release'])?$_POST['hand_release']:'13' }}" />
                    <span class="input_unit">{{ $lang['23'] }}</span>
                </div>
            </div>
            <div class="col-span-6 md:col-span-4 lg:col-span-4 px-2">
                <label for="sprint_min" class="label">{!! $lang['5'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="sprint_min" id="sprint_min" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['sprint_min'])?$_POST['sprint_min']:'2' }}" />
                    <span class="input_unit">min</span>
                </div>
            </div>
            <div class="col-span-6 md:col-span-2 lg:col-span-2 pe-2">
                <label for="sprint_sec" class="label">&nbsp;</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="sprint_sec" id="sprint_sec" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['sprint_sec'])?$_POST['sprint_sec']:'51' }}" />
                    <span class="input_unit">sec</span>
                </div>
            </div>
            <div class="col-span-6 md:col-span-4 lg:col-span-4 px-2 plank hidden">
                <label for="plank_min" class="label">{!! $lang['6'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="plank_min" id="plank_min" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['plank_min'])?$_POST['plank_min']:'4' }}" />
                    <span class="input_unit">min</span>
                </div>
            </div>
            <div class="col-span-6 md:col-span-2 lg:col-span-2 pe-2 plank hidden">
                <label for="plank_sec" class="label">&nbsp;</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="plank_sec" id="plank_sec" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['plank_sec'])?$_POST['plank_sec']:'13' }}" />
                    <span class="input_unit">sec</span>
                </div>
            </div>
            <div class="col-span-6 md:col-span-4 lg:col-span-4 px-2">
                <label for="mile_min" class="label">{!! $lang['7'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="mile_min" id="mile_min" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['mile_min'])?$_POST['mile_min']:'13' }}" />
                    <span class="input_unit">min</span>
                </div>
            </div>
            <div class="col-span-6 md:col-span-2 lg:col-span-2 pe-2">
                <label for="mile_sec" class="label">&nbsp;</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="mile_sec" id="mile_sec" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['mile_sec'])?$_POST['mile_sec']:'30' }}" />
                    <span class="input_unit">sec</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 leg_tuck">
                <label for="leg_tuck" class="label">{!! $lang['8'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="leg_tuck" id="leg_tuck" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['leg_tuck'])?$_POST['leg_tuck']:'0' }}" />
                    <span class="input_unit">reps</span>
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
    @php
        $unit_type = $detail['request']->unit_type;
        $test_units = $detail['request']->test_units;
        $deadlift = $detail['request']->deadlift;
        $standing_power_throw = $detail['request']->standing_power_throw;
        $hand_release = $detail['request']->hand_release;
        $sprint_min = $detail['request']->sprint_min;
        $sprint_sec = $detail['request']->sprint_sec;
        $plank_min = $detail['request']->plank_min;
        $plank_sec = $detail['request']->plank_sec;
        $mile_min = $detail['request']->mile_min;
        $mile_sec = $detail['request']->mile_sec;
        $leg_tuck = $detail['request']->leg_tuck;
    @endphp
   <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full overflow-auto mt-2">
                            <table class="w-full" cellspacing="0">
                                <tr class="bg-[#2845F5] text-white">
                                    <td class="radius-l-10 ps-4 pe-3 py-2">{{ $lang['9'] }}</td>
                                    <td class="px-3">{{ $lang['24'] }}</td>
                                    <td class="px-3">{{ $lang['11'] }}</td>
                                    <td class="radius-r-10 px-3">{{ $lang['res'] }}</td>
                                </tr>
                                @if($detail['dead_lift_score'] != "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['25'] }}</td>
                                    <td class="border-b px-3">{{ $deadlift }} lb</td>
                                    <td class="border-b px-3">{{ $detail['dead_lift_score'] }}</td>
                                    @if($detail['dead_lift_score']>=$detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-dark-blue text-white text-center p-1 rounded">Passed</p>
                                        </td>
                                    @elseif($detail['dead_lift_score'] < $detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-red text-white text-center p-1 rounded">Fail</p>
                                        </td>
                                    @endif
                                </tr>
                                @endif
                                @if($detail['hand_release_answer'] != "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['26'] }}</td>
                                    <td class="border-b px-3">{{ $hand_release }}</td>
                                    <td class="border-b px-3">{{ $detail['hand_release_answer'] }}</td>
                                    @if($detail['hand_release_answer'] >= $detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-dark-blue text-white text-center p-1 rounded">Passed</p>
                                        </td>
                                    @elseif($detail['hand_release_answer'] < $detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-red text-white text-center p-1 rounded">Fail</p>
                                        </td>
                                    @endif
                                </tr>
                                @endif
                                @if($detail['spring_drag_score_answer'] != "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['13'] }}</td>
                                    <td class="border-b px-3">{{ $sprint_min.":".$sprint_sec }}</td>
                                    <td class="border-b px-3">{{ $detail['spring_drag_score_answer'] }}</td>
                                    @if($detail['spring_drag_score_answer']>=$detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-dark-blue text-white text-center p-1 rounded">Passed</p>
                                        </td>
                                    @elseif($detail['spring_drag_score_answer']<$detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-red text-white text-center p-1 rounded">Fail</p>
                                        </td>
                                    @endif
                                </tr>
                                @endif
                                @if(isset($detail['leg_tuck_answer']) && $detail['leg_tuck_answer'] != "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['8'] }}</td>
                                    <td class="border-b px-3">{{ $leg_tuck }}</td>
                                    <td class="border-b px-3">{{ $detail['leg_tuck_answer'] }}</td>
                                    @if($detail['leg_tuck_answer']>=$detail['min_score'])
                                        <td class="border-b px-3">    
                                            <p class="bg-dark-blue text-white text-center p-1 rounded">Passed</p>
                                        </td>
                                    @elseif($detail['leg_tuck_answer']<$detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-red text-white text-center p-1 rounded">Fail</p>
                                        </td>
                                    @endif
                                </tr>
                                @endif
                                @if(isset($detail['plank_answer']) && $detail['plank_answer'] != "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['6'] }}</td>
                                    <td class="border-b px-3">{{ $plank_min.":".$plank_sec }}</td>
                                    <td class="border-b px-3">{{ $detail['plank_answer'] }}</td>
                                    @if($detail['plank_answer']>=$detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-dark-blue text-white text-center p-1 rounded">Passed</p>
                                        </td>
                                    @elseif($detail['plank_answer']<$detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-red text-white text-center p-1 rounded">Fail</p>
                                        </td>
                                    @endif
                                </tr>
                                @endif
                                @if($detail['two_miles_run_values'] != "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['7'] }}</td>
                                    <td class="border-b px-3">{{ $mile_min.":".$mile_sec }}</td>
                                    <td class="border-b px-3">{{ $detail['two_miles_run_values'] }}</td>
                                    @if($detail['two_miles_run_values']>=$detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-dark-blue text-white text-center p-1 rounded">Passed</p>
                                        </td>
                                    @elseif($detail['two_miles_run_values']<$detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-red text-white text-center p-1 rounded">Fail</p>
                                        </td>
                                    @endif
                                </tr>
                                @endif
                                @if($detail['power_throw_score_answer'] != "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['14'] }}</td>
                                    <td class="border-b px-3">{{ $standing_power_throw }}</td>
                                    <td class="border-b px-3">{{ $detail['power_throw_score_answer'] }}</td>
                                    @if($detail['power_throw_score_answer']>=$detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-dark-blue text-white text-center p-1 rounded">Passed</p>
                                        </td>
                                    @elseif($detail['power_throw_score_answer']<$detail['min_score'])
                                        <td class="border-b px-3">
                                            <p class="bg-red text-white text-center p-1 rounded">Fail</p>
                                        </td>
                                    @endif
                                </tr>
                                @endif
                                <tr>
                                    <td class="px-3 py-3" colspan="2"><strong>{{ $lang['15'] }}</strong></td>
                                    @php
                                        $plank_answer = isset($detail['plank_answer']) ? $detail['plank_answer'] : 0;
                                        $leg_tuck_answer = isset($detail['leg_tuck_answer']) ? $detail['leg_tuck_answer'] : 0;
                                    @endphp
                                    <td class="px-3">
                                        <strong>{{ $detail['dead_lift_score'] + $detail['power_throw_score_answer'] + $detail['two_miles_run_values'] + $plank_answer + $leg_tuck_answer + $detail['spring_drag_score_answer'] + $detail['hand_release_answer'] }}</strong>
                                    </td>
                                    @if ($detail['dead_lift_score'] < $detail['min_score'] || $detail['power_throw_score_answer'] < $detail['min_score'] || $detail['two_miles_run_values'] < $detail['min_score'] || (isset($detail['plank_answer']) && $detail['plank_answer'] < $detail['min_score']) || $detail['leg_tuck_answer'] < $detail['min_score'] || $detail['spring_drag_score_answer'] < $detail['min_score'] || $detail['hand_release_answer'] < $detail['min_score'])
                                        <td class="px-3">
                                            <p class="bg-red text-white text-center p-1 rounded">Fail</p>
                                        </td>
                                    @else
                                        <td class="px-3">
                                            <p class="bg-dark-blue text-white text-center p-1 rounded">Passed</p>
                                        </td>
                                    @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full text-[20px] mt-3"><strong>{{ $lang['16'] }}</strong></p>
                        <div class="w-full overflow-auto mt-1">
                            <table class="w-full" cellspacing="0">
                                <tr class="bg-[#2845F5] text-white">
                                    <td class="radius-l-10 ps-4 pe-3 py-2">{{ $lang['9'] }}</td>
                                    <td class="px-3">{{ $lang['17'] }}</td>
                                    <td class="radius-r-10 px-3">{{ $lang['18'] }}</td>
                                </tr>
                                @if($detail['dead_lift_score'] != "")
                                    <tr>
                                        <td class="border-b px-3 py-3">{{ $lang['25'] }}</td>
                                        <td class="border-b px-3">{{ $deadlift }} lb</td>
                                        <td class="border-b px-3">{{ $detail['mdl_value'] }} lb</td>
                                    </tr>
                                @endif
                                @if($detail['hand_release_answer'] != "")
                                    <tr>
                                        <td class="border-b px-3 py-3">{{ $lang['26'] }}</td>
                                        <td class="border-b px-3">{{ $hand_release }} (Reps)</td>
                                        <td class="border-b px-3">{{ $detail['hrp_value'] }} (Reps)</td>
                                    </tr>
                                @endif
                                @if($detail['spring_drag_score_answer'] != "")
                                    <tr>
                                        <td class="border-b px-3 py-3">{{ $lang['13'] }}</td>
                                        <td class="border-b px-3">{{ $sprint_min.":".$sprint_sec }} (MM:SS)</td>
                                        <td class="border-b px-3">{{ $detail['sdc_value'] }} (MM:SS)</td>
                                    </tr>
                                @endif
                                @if(isset($detail['leg_tuck_answer']) && $detail['leg_tuck_answer'] != "")
                                    <tr>
                                        <td class="border-b px-3 py-3">{{ $lang['8'] }}</td>
                                        <td class="border-b px-3">{{ $leg_tuck }} (Reps)</td>
                                        <td class="border-b px-3">{{ $detail['ltk_value'] }} (Reps)</td>
                                    </tr>
                                @endif
                                @if(isset($detail['plank_answer']) && $detail['plank_answer'] != "")
                                    <tr>
                                        <td class="border-b px-3 py-3">{{ $lang['6'] }}</td>
                                        <td class="border-b px-3">{{ $plank_min.":".$plank_sec }}</td>
                                        <td class="border-b px-3">{{ $detail['plk_value'] }}</td>
                                    </tr>
                                @endif    
                                @if($detail['two_miles_run_values'] != "")
                                    <tr>
                                        <td class="border-b px-3 py-3">{{ $lang['7'] }}</td>
                                        <td class="border-b px-3">{{ $mile_min.":".$mile_sec }} (MM:SS)</td>
                                        <td class="border-b px-3">{{ $detail['two_miles_run_values'] }} (MM:SS)</td>
                                    </tr>
                                @endif 
                                @if($detail['power_throw_score_answer'] != "")
                                    <tr>
                                        <td class="px-3 py-3">{{ $lang['14'] }}</td>
                                        <td class="px-3">{{ $standing_power_throw }} m</td> 
                                        <td class="px-3">{{ $detail['spt_value'] }} m</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('test_units').addEventListener('change', function() {
                var w = this.value;
                if (w === '1') {
                    document.querySelectorAll('.leg_tuck').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelectorAll('.plank').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                } else if (w === '2') {
                    document.querySelectorAll('.leg_tuck').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.plank').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                }
            });

            @isset($detail)
                var w = document.getElementById('test_units').value;
                if (w === '1') {
                    document.querySelectorAll('.leg_tuck').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelectorAll('.plank').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                } else if (w === '2') {
                    document.querySelectorAll('.leg_tuck').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.plank').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                }
            @endisset
        </script>
    @endpush
</form>