<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <label for="gender" class="label">{{ $lang['gen'] }}:</label>
                <div class="w-100 py-2 relative">
                    <select name="gender" id="gender" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['male'],$lang['female']];
                            $val = ["Male","Female"];
                            optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'Male');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="type" class="label">{{ $lang['type'] }}:</label>
                <div class="w-100 py-2 relative">
                    <select name="type" id="type" class="input">
                        @php
                            $name = ["NSMEN",$lang['active']."/NSF"];
                            $val = ["NSM","NSF"];
                            optionsList($val,$name,isset($_POST['type'])?$_POST['type']:'NSM');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="age" class="label">{{ $lang['age'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="age" id="age" min="18" max="60" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'25' }}" required />
                    <span class="text-blue input_unit">{{ $lang['year'] }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="push" class="label">{{ $lang['push'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="push" id="push" min="1" max="60" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['push'])?$_POST['push']:'20' }}" required />
                    <span class="text-blue input_unit">{{ $lang['rep'] }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="sit" class="label">{{ $lang['sit'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="sit" id="sit" min="1" max="60" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['sit'])?$_POST['sit']:'30' }}" required />
                    <span class="text-blue input_unit">{{ $lang['rep'] }}</span>
                </div>
            </div>
            <input type="hidden" name="time_value" id="time_value">
            <div class="col-span-6 male_run">
                <label for="time" class="label">{{ $lang['run'] }} (MM:SS):</label>
                <div class="w-100 py-2 relative">
                    <select name="time" id="time" class="input">
                        @php
                            $name = ["8:30","8:40","8:50","9:00","9:10","9:20","9:30","9:40","9:50","10:00","10:10","10:20","10:30","10:40","10:50","11:00","11:10","11:20","11:30","11:40","11:50","12:00","12:10","12:20","12:30","12:40","12:50","13:00","13:10","13:20","13:30","13:40","13:50","14:00","14:10","14:20","14:30","14:40","14:50","15:00","15:10","15:20","15:30","15:40","15:50","16:00","16:10","16:20","16:30","16:40","16:50","17:00","17:10","17:20","17:30","17:40","17:50","18:00","18:10","18:20"];
                            $val = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47", "48", "49", "50", "51", "52", "53", "54", "55", "56", "57", "58", "59"];
                            optionsList($val,$name,isset($_POST['time'])?$_POST['time']:'0');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-6 female_run hidden">
                <label for="time_fe" class="label">{{ $lang['run'] }} (MM:SS):</label>
                <div class="w-100 py-2 relative">
                    <select name="time_fe" id="time_fe" class="input">
                        @php
                            $name = ["10:00","10:10","10:20","10:30","10:40","10:50","11:00","11:10","11:20","11:30","11:40","11:50","12:00","12:10","12:20","12:30","12:40","12:50","13:00","13:10","13:20","13:30","13:40","13:50","14:00","14:10","14:20","14:30","14:40","14:50","15:00","15:10","15:20","15:30","15:40","15:50","16:00","16:10","16:20","16:30","16:40","16:50","17:00","17:10","17:20","17:30","17:40","17:50","18:00","18:10","18:20","18:30","18:40","18:50","19:00","19:10","19:20","19:30","19:40","19:50","20:00","20:10","20:20","20:30","20:40","20:50","21:00","21:10","21:20","21:30","21:40","21:50","22:00","22:10"];
                            $val = ["0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","67","68","69","70","71","72","73"];
                            optionsList($val,$name,isset($_POST['time_fe'])?$_POST['time_fe']:'0');
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
                    <div class="w-full mt-2">
                        @if($detail['status']=='Fail')
                            <p class="text-[20px]"><strong class="text-green-700">{{ $lang['fail'] }}</strong> {{ $lang['with'] }} {{ $detail['score'] }} {{ $lang['point'] }}.</p>
                            <p class="text-[18px]">{{ $lang['get_'] }} {{ $detail['to_next'] }} {{ $lang['p1'] }} {{ $detail['score'] + $detail['to_next'] }} {{ $lang['point'] }}.</p>
                        @elseif($detail['status']=='Pass')
                            <p class="text-[20px]"><strong class="text-green-700">{{ $lang['pass'] }}</strong> {{ $lang['with'] }} {{ $detail['score'] }} {{ $lang['point'] }}.</p>
                            <p class="text-[30px]"><strong class="text-green-700">($0 {{ $lang['awa'] }})</strong></p>
                            <p class="text-[18px]">{{ $lang['get_'] }} {{ $detail['to_next'] }} {{ $lang['p2'] }} {{ $detail['score'] + $detail['to_next'] }} {{ $lang['point'] }}.</p>
                        @elseif($detail['status']=='incentive')
                            <p class="text-[20px]"><strong class="text-green-700">{{ $lang['ipass'] }}</strong> {{ $lang['with'] }} {{ $detail['score'] }} {{ $lang['point'] }}.</p>
                            <p class="text-[30px]"><strong class="text-green-700">($200 {{ $lang['awa'] }})</strong></p>
                            <p class="text-[18px]">{{ $lang['get_'] }} {{ $detail['to_next'] }} {{ $lang['p3'] }} {{ $detail['score'] + $detail['to_next'] }} {{ $lang['point'] }}.</p>
                        @elseif($detail['status']=='incentive')
                            <p class="text-[20px]"><strong class="text-green-700">{{ $lang['ipass'] }}</strong> {{ $lang['with'] }} {{ $detail['score'] }} {{ $lang['point'] }}.</p>
                            <p class="text-[30px]"><strong class="text-green-700">($200 {{ $lang['awa'] }})</strong></p>
                            <p class="text-[18px]">{{ $lang['get_'] }} {{ $detail['to_next'] }} {{ $lang['p3'] }} {{ $detail['score'] + $detail['to_next'] }} {{ $lang['point'] }}.</p>
                        @elseif($detail['status']=='Silver')
                            <p class="text-[20px]"><strong class="text-green-700">{{ $lang['spass'] }}</strong> {{ $lang['with'] }} {{ $detail['score'] }} {{ $lang['point'] }}.</p>
                            <p class="text-[30px]"><strong class="text-green-700">($300 {{ $lang['awa'] }})</strong></p>
                            <p class="text-[18px]">{{ $lang['get_'] }} {{ $detail['to_next'] }} {{ $lang['p4'] }} {{ $detail['score'] + $detail['to_next'] }} {{ $lang['point'] }}.</p>
                        @elseif($detail['status']=='Gold')
                            <p class="text-[20px]"><strong class="text-green-700">{{ $lang['gpass'] }}</strong> {{ $lang['with'] }} {{ $detail['score'] }} {{ $lang['point'] }}.</p>
                            <p class="text-[30px]"><strong class="text-green-700">($500 {{ $lang['awa'] }})</strong></p>
                            <p class="text-[18px]">{{ $lang['cong'] }}!</p>
                        @elseif($detail['status']=='Gold1')
                            <p class="text-[20px]"><strong class="text-green-700">{{ $lang['p5'] }}</strong> {{ $lang['with'] }} {{ $detail['score'] }} {{ $lang['point'] }}.</p>
                            <p class="text-[30px]"><strong class="text-green-700">($500 {{ $lang['awa'] }})</strong></p>
                            <p class="text-[18px]">{{ $lang['cong'] }}!</p>
                        @endif
                        <div class="w-full overflow-auto mt-2">
                            <table class="w-full" cellspacing="0">
                                <tr>
                                    <th class="text-blue text-start py-3">Activity</th>
                                    <th class="text-blue text-start">{{ $lang['rep'] }}</th>
                                    <th class="text-blue text-start">{{ $lang['score'] }}</th>
                                </tr>
                                <tr>
                                    <td class="border-b py-3">{{ $lang['push'] }}</td>
                                    <td class="border-b">{{ $_POST['push'] }}</td>
                                    <td class="border-b">{{ $detail['push_s'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-3">{{ $lang['sit'] }}</td>
                                    <td class="border-b">{{ $_POST['sit'] }}</td>
                                    <td class="border-b">{{ $detail['sit_s'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-3">{{ $lang['run'] }}</td>
                                    <td class="border-b">{{ $_POST['time_value'] }}</td>
                                    <td class="border-b">{{ $detail['run_s'] }}</td>
                                </tr>
                                <tr class="bg_blue_g white-text">
                                    <td class="py-3" colspan="2"><strong>{{ $lang['ts'] }}</strong></td>
                                    <td><strong>{{ $detail['score'] }}</strong></td>
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
            var gen = document.getElementById('gender').value;
            if (gen === 'Male') {
                var time = document.getElementById('time').value;
                document.getElementById('time_value').value = time;
                var timeText = document.querySelector('#time option:checked').textContent;
                document.querySelectorAll('.male_run').forEach(function(elem) {
                    elem.style.display = 'block';
                });
                document.querySelectorAll('.female_run').forEach(function(elem) {
                    elem.style.display = 'none';
                });
            } else {
                var time = document.getElementById('time_fe').value;
                document.getElementById('time_value').value = time;
                var timeText = document.querySelector('#time_fe option:checked').textContent;
                document.querySelectorAll('.male_run').forEach(function(elem) {
                    elem.style.display = 'none';
                });
                document.querySelectorAll('.female_run').forEach(function(elem) {
                    elem.style.display = 'block';
                });
            }
            document.getElementById('gender').addEventListener('change', function() {
                var gen = this.value;
                var time;
                if (gen === 'Male') {
                    time = document.getElementById('time').value;
                    document.getElementById('time_value').value = time;
                    time = document.querySelector('#time option:checked').textContent;
                    document.querySelectorAll('.male_run').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelectorAll('.female_run').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                } else {
                    time = document.getElementById('time_fe').value;
                    document.getElementById('time_value').value = time;
                    time = document.querySelector('#time_fe option:checked').textContent;
                    document.querySelectorAll('.male_run').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.female_run').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                }
            });
            document.getElementById('time').addEventListener('change', function() {
                var time = this.options[this.selectedIndex].text;
                document.getElementById('time_value').value = time;
            });

            document.getElementById('time_fe').addEventListener('change', function() {
                var time = this.options[this.selectedIndex].text;
                document.getElementById('time_value').value = time;
            });
        </script>
    @endpush
</form>