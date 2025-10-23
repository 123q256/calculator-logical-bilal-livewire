<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="to_cal" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="to_cal" id="to_cal">
                        <option value="1">{{$lang['2']}}</option>
                        <option value="2" {{ isset($_POST['to_cal']) && $_POST['to_cal']=='2'?'selected':'' }}>{{$lang['3']}}</option>
                        <option value="3" {{ isset($_POST['to_cal']) && $_POST['to_cal']=='3'?'selected':'' }}>{{$lang['4']}}</option>
                    </select>
                </div>
            </div>

            <div class="col-span-12 {{ isset($_POST['to_cal']) && $_POST['to_cal']==='2' ? 'hidden':'' }}" id="verticalInput">
                <label for="vertical" class="font-s-14 text-blue">{{$lang['3']}}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="vertical" id="vertical" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['vertical']) ? $_POST['vertical'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="vertical_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('vertical_unit_dropdown')">{{ isset($_POST['vertical_unit'])?$_POST['vertical_unit']:'m' }} ▾</label>
                    <input type="text" name="vertical_unit" value="{{ isset($_POST['vertical_unit'])?$_POST['vertical_unit']:'m' }}" id="vertical_unit" class="hidden">
                    <div id="vertical_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="vertical_unit">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vertical_unit', 'cm')">centimeters (cm)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vertical_unit', 'm')">meters (m)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vertical_unit', 'km')">kilometers (km)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vertical_unit', 'in')">inches (in)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vertical_unit', 'ft')">feets (ft)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vertical_unit', 'yd')">yards (yd)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vertical_unit', 'mi')">miles (mi)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['to_cal']) && $_POST['to_cal']==='3' ? 'hidden':'' }}" id="horiInput">
                <label for="hori" class="font-s-14 text-blue">{{$lang['4']}}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="hori" id="hori" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hori']) ? $_POST['hori'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="hori_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hori_unit_dropdown')">{{ isset($_POST['hori_unit'])?$_POST['hori_unit']:'m' }} ▾</label>
                    <input type="text" name="hori_unit" value="{{ isset($_POST['hori_unit'])?$_POST['hori_unit']:'m' }}" id="hori_unit" class="hidden">
                    <div id="hori_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hori_unit">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hori_unit', 'mm')">millimeters (mm)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hori_unit', 'cm')">centimeters (cm)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hori_unit', 'm')">meters (m)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hori_unit', 'km')">kilometers (km)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hori_unit', 'in')">inches (in)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hori_unit', 'ft')">feets (ft)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hori_unit', 'yd')">yards (yd)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hori_unit', 'mi')">miles (mi)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hori_unit', 'nmi')">nautical miles (nmi)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['to_cal']) && ($_POST['to_cal']==='2' || $_POST['to_cal']==='3') ? 'd-block':'hidden' }}" id="angleInput">
                <label for="angle" class="font-s-14 text-blue">{{$lang['5']}}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="angle" id="angle" class="input" value="{{ isset($_POST['angle'])?$_POST['angle']:'45' }}" aria-label="input"/>
                    <label for="angle_unit" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }} ▾</label>
                    <input type="text" name="angle_unit" value="{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }}" id="angle_unit" class="hidden">
                    <div class="units angle_unit hidden" to="angle_unit">
                        <p value="deg">degrees (deg)</p>
                        <p value="rad">radians (rad)</p>
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    @if($_POST['to_cal'] === '1')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['5']}}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['ang_deg'],4)}} deg</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['5']}}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['angle'],5)}} rad</td>
                                        </tr>
                                    @elseif($_POST['to_cal'] === '2')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['3']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['vertical']}}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['hori']}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['6']}}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['grade'],4)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['7']}}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['gradep'],4)}} %</td>
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
            document.getElementById('to_cal').addEventListener("change", function() {
                var selectedValue = this.value;          
                if(selectedValue === '1') {
                    ['#verticalInput', '#horiInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#angleInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(selectedValue === '2'){
                    ['#angleInput', '#horiInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#verticalInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else{
                    ['#angleInput', '#verticalInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#horiInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>