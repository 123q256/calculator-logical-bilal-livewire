<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
     
        <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
            <input type="hidden" name="unit_type" id="unit_type" value="simple">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="imperial">
                        {{ $lang['35'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="metric">
                        {{ $lang['36'] }}
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 mt-3  gap-4"  id="converter">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="first" class="font-s-14 text-blue">{{ $lang['28'] }}:</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first'])?$_POST['first']:'13' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'mW' }} ▾</label>
                   <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'mW' }}" id="units1" class="hidden">
                   <div id="units1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units1">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'mW')">mW</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'W')">W</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'kW')">kW</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'MW')">MW</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'GW')">GW</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'BTU/h')">BTU/h</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'hp(l)')">hp(l)</p>
                   </div>
                </div>
              </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="second" class="font-s-14 text-blue">{{ $lang['29'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="second" id="second" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['second']) ? $_POST['second'] : '9' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}/kWh</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="third" class="font-s-14 text-blue">{{ $lang['30'] }} :</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third'])?$_POST['third']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units3_dropdown')">{{ isset($_POST['units3'])?$_POST['units3']:'days' }} ▾</label>
                   <input type="text" name="units3" value="{{ isset($_POST['units3'])?$_POST['units3']:'days' }}" id="units3" class="hidden">
                   <div id="units3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units3">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'days')">days</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'wks')">wks</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'mons')">mons</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'yrs')">yrs</p>
                   </div>
                </div>
              </div>
        </div>
        <div class="grid grid-cols-12 mt-3  gap-4 hidden" id="calculator">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="uc_appliance" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <i class="fas fa-sort-down color_blue"></i>
                    <select name="uc_appliance" id="uc_appliance" class="input">
                        <option value="2000"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '2000' ? 'selected' : '' }}>
                            {{ $lang['2'] }} (2,000W)</option>
                        <option value="9600"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '9600' ? 'selected' : '' }}>
                            {{ $lang['3'] }} (9,600W)</option>
                        <option value="1500"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '1500' ? 'selected' : '' }}>
                            {{ $lang['4'] }} (1,500W)</option>
                        <option value="1500"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '1500' ? 'selected' : '' }}>
                            {{ $lang['5'] }} (1,500W)</option>
                        <option value="5000"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '5000' ? 'selected' : '' }}>
                            {{ $lang['6'] }} (5,000W)</option>
                        <option value="150"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '150' ? 'selected' : '' }}>
                            {{ $lang['7'] }} (150W)</option>
                        <option value="100"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '100' ? 'selected' : '' }}>
                            {{ $lang['8'] }} (100W)</option>
                        <option value="2000"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '2000' ? 'selected' : '' }}>
                            {{ $lang['9'] }} (2,000W)</option>
                        <option value="1000"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '1000' ? 'selected' : '' }}>
                            {{ $lang['10'] }} (1,000W)</option>
                        <option value="1200"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '1200' ? 'selected' : '' }}>
                            {{ $lang['11'] }} (1,200W)</option>
                        <option value="500"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '500' ? 'selected' : '' }}>
                            {{ $lang['12'] }} (500W)</option>
                        <option value="4000"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '4000' ? 'selected' : '' }}>
                            {{ $lang['13'] }} (4,000W)</option>
                        <option value="200"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '200' ? 'selected' : '' }}>
                            {{ $lang['14'] }} (200W)</option>
                        <option value="50"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '50' ? 'selected' : '' }}>
                            {{ $lang['15'] }} (50W)</option>
                        <option value="20"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '20' ? 'selected' : '' }}>
                            {{ $lang['16'] }} (20W)</option>
                        <option value="90"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '90' ? 'selected' : '' }}>
                            {{ $lang['17'] }} (90W)</option>
                        <option value="260"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '260' ? 'selected' : '' }}>
                            {{ $lang['18'] }} (260W)</option>
                        <option value="7"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '7' ? 'selected' : '' }}>
                            {{ $lang['19'] }} (7W)</option>
                        <option value="16"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '16' ? 'selected' : '' }}>
                            {{ $lang['20'] }} (16W)</option>
                        <option value="60"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '60' ? 'selected' : '' }}>
                            {{ $lang['21'] }} (60W)</option>
                        <option value="25"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '25' ? 'selected' : '' }}>
                            {{ $lang['22'] }} (25W)</option>
                        <option value="10"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == '10' ? 'selected' : '' }}>
                            {{ $lang['23'] }} (10W)</option>
                        <option value="other"
                            {{ isset($_POST['uc_appliance']) && $_POST['uc_appliance'] == 'other' ? 'selected' : '' }}>
                            {{ $lang[24] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="f_first" class="font-s-14 text-blue">{{ $lang['25'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="f_first" id="f_first" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['f_first']) ? $_POST['f_first'] : '150' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="f_second" class="font-s-14 text-blue">{{ $lang['26'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="f_second" id="f_second" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['f_second']) ? $_POST['f_second'] : '9' }}" />
                    <span class="text-blue input_unit"></span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="f_third" class="font-s-14 text-blue">{{ $lang['27'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="f_third" id="f_third" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['f_third']) ? $_POST['f_third'] : '15' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
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
                    <div class="grid lg:grid-cols-2 mt-2">
                        <table class="w-full font-s-18">
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[32] }} </strong></td>
                                <td class="py-2 border-b"> {{ round($detail['answer'], 2) }} (kWh per month)</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[33] }} </strong></td>
                                <td class="py-2 border-b"> {{ round($detail['cost'], 2) }} ({{ $currancy }} per month)</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        'use strict';
        document.getElementById('uc_appliance').addEventListener('change', function() {
            var valNum = this.value;
            document.getElementById('f_first').value = valNum;
        });
    });

    @if (isset($detail))
        var valNums = "{{ $_POST['uc_appliance'] }}";
        document.getElementById('f_first').value = valNums;
    @endif
    @if (isset($error))
        var valNums = "{{ $_POST['uc_appliance'] }}";
        document.getElementById('f_first').value = valNums;
    @endif
    @if (isset($detail))
        @if (isset($_POST['unit_type']) && $_POST['unit_type'] === 'simple')
            document.querySelectorAll('.imperial').forEach(function(element) {
                document.getElementById('imperial').classList.add('tagsUnit')
                document.querySelectorAll('.metric').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "simple"
                var priceElasticity = document.getElementById('calculator');
                var revenue = document.getElementById('converter');

                if (priceElasticity && revenue) {
                    priceElasticity.classList.add('hidden');
                    revenue.classList.remove('hidden');
                }
            })
        @endif
        @if (isset($_POST['unit_type']) && $_POST['unit_type'] === 'advance')
            document.querySelectorAll('.metric').forEach(function(element) {
                document.getElementById('metric').classList.add('tagsUnit')
                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "advance"
                var priceElasticity = document.getElementById('calculator');
                var revenue = document.getElementById('converter');

                if (priceElasticity && revenue) {
                    priceElasticity.classList.remove('hidden');
                    revenue.classList.add('hidden');
                }
            })
        @endif
    @endisset

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.imperial').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.metric').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "simple"
                var priceElasticity = document.getElementById('calculator');
                var revenue = document.getElementById('converter');

                if (priceElasticity && revenue) {
                    priceElasticity.classList.add('hidden');
                    revenue.classList.remove('hidden');
                }
            })
        })
        document.querySelectorAll('.metric').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })

                document.getElementById('unit_type').value = "advance"
                var priceElasticity = document.getElementById('calculator');
                var revenue = document.getElementById('converter');

                if (priceElasticity && revenue) {
                    priceElasticity.classList.remove('hidden');
                    revenue.classList.add('hidden');
                }
            })
        })
    });


    @if (isset($error))
        @if (isset($_POST['unit_type']) && $_POST['unit_type'] === 'simple')
            document.querySelectorAll('.imperial').forEach(function(element) {
                document.getElementById('imperial').classList.add('tagsUnit')
                document.querySelectorAll('.metric').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "simple"
                var priceElasticity = document.getElementById('calculator');
                var revenue = document.getElementById('converter');

                if (priceElasticity && revenue) {
                    priceElasticity.classList.add('hidden');
                    revenue.classList.remove('hidden');
                }
            })
        @endif
        @if (isset($_POST['unit_type']) && $_POST['unit_type'] === 'advance')
            document.querySelectorAll('.metric').forEach(function(element) {
                document.getElementById('metric').classList.add('tagsUnit')
                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "advance"
                var priceElasticity = document.getElementById('calculator');
                var revenue = document.getElementById('converter');

                if (priceElasticity && revenue) {
                    priceElasticity.classList.remove('hidden');
                    revenue.classList.add('hidden');
                }
            })
        @endif
    @endisset
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>