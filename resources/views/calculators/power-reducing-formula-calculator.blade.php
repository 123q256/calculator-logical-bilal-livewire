<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="know" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="know" id="know">
                        <option value="1">{{$lang['2']}}</option>
                        <option value="2" {{ isset($_POST['know']) && $_POST['know']=='2'?'selected':'' }}>{{$lang['3']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 angle {{ isset($_POST['know']) && $_POST['know']==='2' ? 'hidden':'block' }}">
                <label for="angle" class="label">{{$lang[2]}}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="angle" id="angle" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle']) ? $_POST['angle'] : '30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_unit_dropdown')">{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }} ▾</label>
                    <input type="text" name="angle_unit" value="{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }}" id="angle_unit" class="hidden">
                    <div id="angle_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'deg')">degrees (deg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'rad')">radians (rad)</p>
                    </div>
                 </div>
            </div>
          
            <div class="col-span-12 function {{ isset($_POST['know']) && $_POST['know']==='2' ? 'block':'hidden' }}">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 text-center mt-3 mb-1"><strong>{{ $lang['4'] }}</strong></p>
                    <div class="col-span-6">
                        <label for="sinx" class="label">sin(x):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" min="-1" max="1" name="sinx" id="sinx" value="{{ isset($_POST['sinx'])?$_POST['sinx']:'' }}" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="sin2x" class="label">sin²(x):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="sin2x" id="sin2x" min="0" max="1" value="{{ isset($_POST['sin2x'])?$_POST['sin2x']:'' }}" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="cosx" class="label">cos(x):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" min="-1" max="1" name="cosx" id="cosx" value="{{ isset($_POST['cosx'])?$_POST['cosx']:'' }}" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="cos2x" class="label">cos²(x):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="cos2x" id="cos2x" min="0" max="1" value="{{ isset($_POST['cos2x'])?$_POST['cos2x']:'' }}" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="tanx" class="label">tan(x):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" min="-1" max="1" name="tanx" id="tanx" value="{{ isset($_POST['tanx'])?$_POST['tanx']:'' }}" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="tan2x" class="label">tan²(x):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="tan2x" min="0" max="1" id="tan2x" value="{{ isset($_POST['tan2x'])?$_POST['tan2x']:'' }}" class="input" aria-label="input" />
                        </div>
                    </div>
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
                            @isset($detail['angle'])
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-3">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{$lang[2]}}</td>
                                            <td class="py-2 border-b"><strong>{{round($detail['angle'],5)}} (deg)</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{$lang[2]}}</td>
                                            <td class="py-2 border-b"><strong>{{round(deg2rad($detail['angle']),5)}} (rad)</strong></td>
                                        </tr>
                                    </table>
                                </div>    
                            @endisset
                            <p class="mt-3 text-[20px]"><strong>{{ $lang['5'] }}</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-3">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>sin(x)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['sin'],5)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>cos(x)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['cos'],5)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>tan(x)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['tan'],5)}}</td>
                                    </tr>
                                </table>
                            </div>
                            <p class="mt-3 text-[20px]"><strong>{{ $lang['6'] }}</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-3">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">sin<sup class="font-s-14">2</sup>(x)</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['sin2'],5)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">cos<sup class="font-s-14">2</sup>(x)</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['cos2'],5)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">tan<sup class="font-s-14">2</sup>(x)</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['tan2'],5)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">sin<sup class="font-s-14">3</sup>(x)</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['sin3'],5)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">cos<sup class="font-s-14">3</sup>(x)</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['cos3'],5)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">tan<sup class="font-s-14">3</sup>(x)</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['tan3'],5)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">sin<sup class="font-s-14">4</sup>(x)</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['sin4'],5)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">cos<sup class="font-s-14">4</sup>(x)</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['cos4'],5)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">tan<sup class="font-s-14">4</sup>(x)</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['tan4'],5)}}</strong></td>
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
            document.getElementById('know').addEventListener('change', function() {
                if(this.value === "1"){
                    ['.function'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['.angle'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else{
                    ['.angle'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['.function'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>