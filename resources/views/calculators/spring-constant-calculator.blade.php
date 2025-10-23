<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">

            <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                <label for="selection" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="selection" id="selection">
                        <option value="1" {{ isset($_POST['selection']) && $_POST['selection'] == '1' ? 'selected' : '' }}>
                            {{ $lang['2'] }}</option>
                        <option value="2" {{ isset($_POST['selection']) && $_POST['selection'] == '2' ? 'selected' : '' }}>
                            {{ $lang['3'] }}</option>
                        <option value="3" {{ isset($_POST['selection']) && $_POST['selection'] == '3' ? 'selected' : '' }}>
                            {{ $lang['4'] }}</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2 const">
                <label for="spring_constant" class="font-s-14 text-blue">{{ $lang['5'] }}(K)</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="spring_constant" id="spring_constant" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['spring_constant'])?$_POST['spring_constant']:'4' }}" />
                    <span class="text-blue input_unit">N/m</span>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2 dis" >
                <label for="spring_displacement" class="font-s-14 text-blue">{{ $lang['6'] }} (X)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="spring_displacement" id="spring_displacement" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['spring_displacement'])?$_POST['spring_displacement']:'45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="spring_displacement_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('spring_displacement_unit_dropdown')">{{ isset($_POST['spring_displacement_unit'])?$_POST['spring_displacement_unit']:'cm' }} ▾</label>
                   <input type="text" name="spring_displacement_unit" value="{{ isset($_POST['spring_displacement_unit'])?$_POST['spring_displacement_unit']:'cm' }}" id="spring_displacement_unit" class="hidden">
                   <div id="spring_displacement_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="spring_displacement_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('spring_displacement_unit', 'm')">m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('spring_displacement_unit', 'mm')">mm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('spring_displacement_unit', 'cm')">cm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('spring_displacement_unit', 'inches')">inches</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('spring_displacement_unit', 'feet')">feet</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('spring_displacement_unit', 'yards')">yards</p>
                   </div>
                </div>
              </div>
            <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2 hidden force">
                <label for="spring_force" class="font-s-14 text-blue">{{ $lang['7'] }}(F)</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="spring_force" id="spring_force" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['spring_force'])?$_POST['spring_force']:'4' }}" />
                    <span class="text-blue input_unit">N</span>
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
                        <div class="w-full  text-[20px]">
                            @if(isset($detail['fahad1']))
                                <div class="w-full text-center text-[20px]">
                                    <p>{{ $lang[8] }} (F)</p>
                                    <div class="flex justify-center">
                                    <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]"> {{ round($detail['fahad1'], 4)  }} N</strong></p>
                                </div>
                            </div>
                            @elseif(isset($detail['fahad2']))
                                <div class="w-full text-center text-[20px]">
                                    <p>{{ $lang[5] }} (K)</p>
                                    <div class="flex justify-center">
                                    <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]"> {{ round($detail['fahad2'], 4)   }} N/m</strong></p>
                                </div>
                            </div>
                            @else
                
                            <div class="w-full text-center text-[20px]">
                                <p>{{ $lang[9] }} (X)</p>
                                <div class="flex justify-center">
                                <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]"> {{ round($detail['an'], 4)  }} M</strong></p>
                            </div>
                        </div>
                                <p class="mt-2"><strong>{{$lang[10]}}</strong></p>
                                <table class="w-full font-s-16">
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{$lang[11]}}</td>
                                    <td class="py-2 border-b"><strong>{{$detail['ans']}} ({{$lang[11]}})</strong></td>
                                </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="70%">{{$lang[12]}}</td>
                                    <td class="py-2 border-b"><strong>{{$detail['ans1']}} ({{$lang[12]}})</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{$lang[13]}}</td>
                                    <td class="py-2 border-b"><strong>{{$detail['ans2']}} ({{$lang[13]}})</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{$lang[14]}}</td>
                                    <td class="py-2 border-b"><strong>{{$detail['ans3']}} ({{$lang[14]}})</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{$lang[15]}}</td>
                                    <td class="py-2 border-b"><strong>{{$detail['ans4']}} ({{$lang[15]}})</strong></td>
                                </tr>
                                </table>
                            @endif
                            
                        </div>
                    </div>
    
    
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
<script>
@if(isset($error))
    var type = "{{$_POST['selection']}}";
    document.addEventListener('DOMContentLoaded', function() {
    'use strict';
        function showElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.classList.remove('hidden');
                });
            });
        }
        function hideElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.classList.add('hidden');
                });
            });
        }
        if (type == "1") {
            showElements(['.const', '.dis']);
            hideElements(['.force']);
        } else if (type == "2") {
            showElements(['.force', '.dis']);
            hideElements(['.const']);
        } else if (type == "3") {
            showElements(['.force', '.const']);
            hideElements(['.dis']);
        }
    });
@endif

@if(isset($detail))
    var type = "{{$_POST['selection']}}";
    document.addEventListener('DOMContentLoaded', function() {
    'use strict';
        function showElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.classList.remove('hidden');
                });
            });
        }
        function hideElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.classList.add('hidden');
                });
            });
        }
        if (type == "1") {
            showElements(['.const', '.dis']);
            hideElements(['.force']);
        } else if (type == "2") {
            showElements(['.force', '.dis']);
            hideElements(['.const']);
        } else if (type == "3") {
            showElements(['.force', '.const']);
            hideElements(['.dis']);
        }
    });
@endif

    document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    document.getElementById('selection').addEventListener('change', function() {
        var b = this.value;

        function showElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.classList.remove('hidden');
                });
            });
        }

        function hideElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.classList.add('hidden');
                });
            });
        }

        if (b == "1") {
            showElements(['.const', '.dis']);
            hideElements(['.force']);
        } else if (b == "2") {
            showElements(['.force', '.dis']);
            hideElements(['.const']);
        } else if (b == "3") {
            showElements(['.force', '.const']);
            hideElements(['.dis']);
        }
    });
});

  </script>
  @endpush
  <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>