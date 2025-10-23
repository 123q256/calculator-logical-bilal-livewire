<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-6" id="f1_div">
                    <label for="first" class="label">{{ $lang['1'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'Pa' }} ▾</label>
                        <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'Pa' }}" id="unit1" class="hidden">
                        <div id="unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit1">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'Pa')">Pa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'mb')">mb</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'bar')">bar</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'psi')">psi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'atm')">atm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'torr')">torr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'hPa')">hPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'kPa')">kPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'inHg')">inHg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'mmHg')">mmHg</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6" id="f1_div">
                    <label for="second" class="label">{{ $lang['2'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '21' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit2_dropdown')">{{ isset($_POST['unit2'])?$_POST['unit2']:'°C' }} ▾</label>
                        <input type="text" name="unit2" value="{{ isset($_POST['unit2'])?$_POST['unit2']:'°C' }}" id="unit2" class="hidden">
                        <div id="unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit2">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'K')">K</p>
                        </div>
                     </div>
                </div>
            
            <div class="col-span-6">
                <label for="operations1" class="label">{{ $lang['3'] }}:</label>
                <div class="w-full py-2 relative">
                    <select class="input" name="operations1" id="operations1">
                        <option value="2"  {{ isset($_POST['operations1']) && $_POST['operations1']=='2'?'selected':''}}> {{$lang['5']}}</option>
                        <option value="1"  {{ isset($_POST['operations1']) && $_POST['operations1']=='1'?'selected':''}}> {{$lang['4']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6 on_change">
                <label for="third" class="label">{{ $lang['6'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="third" id="third" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['third'])?$_POST['third']:'90' }}" />
                    <span class="text-blue input_unit">%</span>
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
                    @if ($detail['operations1'] == "1")
                    <div class="col-12 text-center text-[20px]">
                        <p>{{ $lang[4] }}</p>
                        <p class="my-3"><strong class="bg-sky px-3 py-2 text-[32px] radius-10 text-blue">{{ isset($_POST['acv'])?$_POST['acv']:'5' }}</strong></p>
                    </div>
                    @elseif ($detail['operations1'] == "2") 
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full font-s-18">
                           <tr>
                              <td class="py-2 border-b" width="50%"><strong>{{ $lang[8] }} </strong></td>
                               <td class="py-2 border-b"> {{ round(($detail['dp']-1), 2) }} (°C)</td>
                           </tr>
                           <tr>
                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[9] }} </strong></td>
                             <td class="py-2 border-b"> {{ round($detail['pd']+1) }} (Pa)</td>
                         </tr>
                         <tr>
                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[10] }} </strong></td>
                             <td class="py-2 border-b"> {{ round($detail['pv']) }} (Pa)</td>
                         </tr>
                         <tr>
                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] }} </strong></td>
                             <td class="py-2 border-b"> {{ round($detail['air_density']*515.4, 5) }} (kg/m³)</td>
                         </tr>
                        </table>
                  </div>
                  @endif
                 
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
@push('calculatorJS')
<script>
    @if(isset($error))
        var cal = "{{$_POST['operations1']}}";
            var onChangeElements = document.querySelectorAll('.on_change');
            
            if (cal === '1') {
                onChangeElements.forEach(function(element) {
                    element.classList.add('d-none');
                });
            } else if (cal === '2') {
                onChangeElements.forEach(function(element) {
                    element.classList.remove('d-none');
                });
            }

    @endif
    @if(isset($detail))
        var cal = "{{$_POST['operations1']}}";
            var onChangeElements = document.querySelectorAll('.on_change');
            
            if (cal === '1') {
                onChangeElements.forEach(function(element) {
                    element.classList.add('d-none');
                });
            } else if (cal === '2') {
                onChangeElements.forEach(function(element) {
                    element.classList.remove('d-none');
                });
            }
    @endif
    document.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById("selectNumber");
        
        document.getElementById('operations1').addEventListener('change', function() {
            var cal = this.value;
            var onChangeElements = document.querySelectorAll('.on_change');
            
            if (cal === '1') {
                onChangeElements.forEach(function(element) {
                    element.classList.add('d-none');
                });
            } else if (cal === '2') {
                onChangeElements.forEach(function(element) {
                    element.classList.remove('d-none');
                });
            }
        });
    });
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>