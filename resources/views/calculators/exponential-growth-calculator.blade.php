<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                if(!isset($detail)){
                    $_POST['operations'] = "4";
                }
            @endphp
            <div class="col-span-6">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="operations" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select class="input" aria-label="select" name="operations" id="operations">
                                <option value="1">{{ $lang['2'] }} x₀</option>
                                <option value="2" {{ isset($_POST['operations']) && $_POST['operations']=='2'?'selected':'' }}>{{ $lang['3'] }} r</option>
                                <option value="3" {{ isset($_POST['operations']) && $_POST['operations']=='3'?'selected':'' }}>{{ $lang['4'] }} t</option>
                                <option value="4" {{ isset($_POST['operations']) && $_POST['operations']=='4'?'selected':'' }}>{{ $lang['5'] }} x(t)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 {{ isset($_POST['operations']) && $_POST['operations'] === '1' ? 'hidden':'' }}" id="firstInput">
                        <label for="first" class="label">{{ $lang['2'] }} x₀:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="first" id="first" class="input" value="{{ isset($_POST['first'])?$_POST['first']:'1' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12 {{ isset($_POST['operations']) && $_POST['operations'] === '2' ? 'hidden':'' }}" id="secondInput">
                        <label for="second" class="label">{{ $lang['3'] }} r:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="second" id="second" class="input" value="{{ isset($_POST['second'])?$_POST['second']:'3' }}" aria-label="input"/>
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                    <div class="col-span-12 {{ isset($_POST['operations']) && $_POST['operations'] === '3' ? 'hidden':'' }}" id="thirdInput">
                        <label for="third" class="label">{{$lang[4]}} t:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third']) ? $_POST['third'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_unit_dropdown')">{{ isset($_POST['t_unit'])?$_POST['t_unit']:'sec' }} ▾</label>
                            <input type="text" name="t_unit" value="{{ isset($_POST['t_unit'])?$_POST['t_unit']:'sec' }}" id="t_unit" class="hidden">
                            <div id="t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'sec')">{{$lang['6']}} (sec)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'min')">{{$lang['7']}} (min)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'hr')">{{$lang['8']}} (hr)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'days')">{{$lang['9']}}</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'wks')">{{$lang['10']}}</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'mon')">{{$lang['11']}} (mon)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'yrs')">{{$lang['12']}} (yrs)</p>

                            </div>
                         </div>
                    </div>
                    <div class="col-span-12 {{ isset($_POST['operations']) && $_POST['operations'] !== '4' ? '':'hidden' }}" id="fourInput">
                        <label for="four" class="label">{{ $lang['5'] }} x(t):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="four" id="four" class="input" value="{{ isset($_POST['four'])?$_POST['four']:'7' }}" aria-label="input"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-6 text-center flex justify-center items-center">
                <p class="text-[20px]">
                    <strong>
                        x(t) = x₀ × (1 +  
                        <span class="quadratic_fraction">
                            <span class="num">r</span>
                            <span>100</span>
                        </span> )<sup class="font-s-14">t</sup>
                    </strong>
                </p>
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
                        <div class="w-full text-center text-[20px]">
                            <p>{{$detail['jawab']}}</p>
                            <p class="my-3">
                                <strong class="bg-[#2845F5] text-white px-3 py-2 text-[32px] rounded-lg text-blue">
                                    {{$detail['final']}}
                                    @if($detail['operations'] === "2")
                                        %
                                    @elseif($detail['operations'] === "3")
                                        years
                                    @endif
                                </strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('operations').addEventListener('change', function() {
                if(this.value === "1"){
                    ['#firstInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['#secondInput', '#thirdInput', '#fourInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else if(this.value === "2"){
                    ['#secondInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['#firstInput', '#thirdInput', '#fourInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else if(this.value === "3"){
                    ['#thirdInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['#firstInput', '#secondInput', '#fourInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else{
                    ['#fourInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['#firstInput', '#secondInput', '#thirdInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>