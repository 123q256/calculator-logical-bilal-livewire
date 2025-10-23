<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 ">
                    <label for="conversion" class="font-s-14 text-blue">{{ $lang['1'] }}({{ $lang['2'] }}):</label>
                    <select class="input mt-2" name="conversion" id="conversion">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? "selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["$lang[3] ","$lang[4] "];
                        $val = ["1","2",];
                            optionsList($val,$name,isset($_POST['conversion']) ? $_POST['conversion']:'1');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 formate {{ isset($_POST['conversion']) &&  $_POST['conversion'] == 2 ? 'hidden':'d-block' }}">
                    <label for="military_time" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <input type="number" name="military_time" id="military_time" min="100" max="2400" class="input military_time" aria-label="input"  value="{{ isset($_POST['military_time'])?$_POST['military_time']:'1234' }}" />
                </div>
                <div class="space-y-2 hours {{ isset($_POST['conversion']) &&  $_POST['conversion'] == 2  ? 'd-block' : 'hidden' }}">
                    <label class="label">&nbsp;</label>
                    <div class="flex items-center bg-white text-center mt-3 border rounded-lg p-1">
                        <div class="w-1/2 py-2 cursor-pointer rounded-md tw_hour {{ isset($_POST['hours']) && $_POST['hours'] !== '12h' ? '' :'tagsUnit' }}" id="tw_hour">
                            12 Hours
                        </div>
                        <div class="w-1/2 py-2 cursor-pointer rounded-md tf_hour {{ isset($_POST['hours']) && $_POST['hours'] !== '12h' ? 'tagsUnit' : '' }}" id="tf_hour">
                            24 Hours
                        </div>
                        <input type="hidden" name="hours" id="hours" value="{{ isset($_POST['hours']) ? $_POST['hours'] : '12h' }}">
                    </div>
                </div>
                
                <div class="space-y-2 hours {{ isset($_POST['conversion']) &&  $_POST['conversion'] == 2 ? 'd-block' : 'hidden' }}">
                    <label for="hur" class="text-sm text-blue-500">{{ $lang['6'] }}:</label>
                    <div class="py-2 flex items-center">
                        <input 
                            type="number" 
                            max="12" 
                            min="1" 
                            name="hur" 
                            id="hur" 
                            placeholder="Hour" 
                            class="border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                            aria-label="input" 
                            value="{{ isset($_POST['hur']) ? $_POST['hur'] : '7' }}" 
                        />
                        <span class="mt-2 px-2">:</span>
                        <input 
                            type="number" 
                            max="59" 
                            min="0" 
                            name="min" 
                            id="min" 
                            placeholder="Minutes" 
                            class="border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                            aria-label="input" 
                            value="{{ isset($_POST['min']) ? $_POST['min'] : '17' }}" 
                        />
                    </div>
                </div>

                <div class="space-y-2 hours {{ isset($_POST['conversion']) && $_POST['conversion'] == 2 ? 'd-block' : 'hidden' }}">
                    <label class="label">&nbsp;</label>
                    <div class="flex items-center bg-white text-center mt-3 border border-gray-300 rounded-lg p-1 {{ isset($_POST['hours']) && $_POST['hours'] !== '12h' ? 'hidden' : 'block' }}">
                        <div id="am" class="w-1/2 py-2 cursor-pointer rounded-md am {{ isset($_POST['am_pm']) && $_POST['am_pm'] === 'am' ? 'tagsUnit' : '' }}">
                            AM
                        </div>
                        <div id="pm" class="w-1/2 py-2 cursor-pointer rounded-md pm {{ isset($_POST['am_pm']) && $_POST['am_pm'] === 'am' ? '' : 'tagsUnit' }}">
                            PM
                        </div>
                        <input type="hidden" name="am_pm" id="am_pm" value="{{ isset($_POST['am_pm'])?$_POST['am_pm']:'pm' }}">
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
                    <div class="w-full rounded-lg mt-6">
                        <div class="mt-4">
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="w-full text-lg">
                                    <!-- Military Time Row -->
                                    <tr>
                                        <td class="border-b py-2 font-bold">{{ $lang['9'] }} :</td>
                                        <td class="border-b py-2">{{ $detail['military_time'] }}</td>
                                    </tr>
                    
                                    <!-- English Word Row -->
                                    <tr>
                                        <td class="border-b py-2 font-bold">{{ $lang['10'] }} :</td>
                                        <td class="border-b py-2">{{ $detail['eng_word'] }} {{ $lang['11'] }}</td>
                                    </tr>
                    
                                    <!-- 12-Hour Format Row -->
                                    <tr>
                                        <td class="border-b py-2 font-bold">{{ $lang['12'] }} (12h {{ $lang[13] }}) :</td>
                                        <td class="border-b py-2">{{ $detail['bara_ghante'] }}</td>
                                    </tr>
                    
                                    <!-- 24-Hour Format Row -->
                                    <tr>
                                        <td class="border-b py-2 font-bold">{{ $lang['12'] }} (24h {{ $lang[13] }}) :</td>
                                        <td class="border-b py-2">{{ $detail['chubees_ghante'] }}</td>
                                    </tr>
                                </table>
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
        document.querySelectorAll('.am').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('am_pm').value = 'am'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.pm').forEach(function(hours) {
                    hours.classList.remove('tagsUnit')
                })
            })
        });
        document.querySelectorAll('.pm').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('am_pm').value = 'pm'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.am').forEach(function(hours) {
                    hours.classList.remove('tagsUnit')
                })
            })
        });
        document.querySelectorAll('.tf_hour').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('hours').value = '24h'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.tw_hour').forEach(function(hours) {
                    hours.classList.remove('tagsUnit')
                })
                document.querySelectorAll('.am_pm').forEach(function(am_pm) {
                    am_pm.style.display = 'none'
                })
            })
        });
        document.querySelectorAll('.tw_hour').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('hours').value = '12h'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.tf_hour').forEach(function(hours) {
                    hours.classList.remove('tagsUnit')
                })
                document.querySelectorAll('.am_pm').forEach(function(am_pm) {
                    am_pm.style.display = 'block'
                })
            })
        });
        document.getElementById('conversion').addEventListener('change', function(){
            var value = this.value;
            var defult = document.querySelector('.formate');
            var change = document.querySelectorAll('.hours');
            if(value == 1){
                defult.classList.add('d-block');
                defult.classList.remove('hidden');
                change.forEach(function(element) {
                    element.classList.add('hidden');
                    element.classList.remove('d-block');
                });
            }else{
                defult.classList.add('hidden');
                defult.classList.remove('d-block');
                change.forEach(function(element) {
                    element.classList.add('d-block');
                    element.classList.remove('hidden');
                });
            }
        }); 
    </script>
@endpush