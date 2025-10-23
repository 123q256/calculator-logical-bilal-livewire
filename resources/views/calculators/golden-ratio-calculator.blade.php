<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php
                if (!isset($detail)) {
                    $_POST['units'] = "m";
                }
            @endphp
            <div class="col-span-12">
                <label for="main" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="selection" id="main">
                        <option value="1">{{$lang['2']}} (A)</option>
                        <option value="2" {{ isset($_POST['selection']) && $_POST['selection']=='2'?'selected':'' }}>{{$lang['3']}} (B)</option>
                        <option value="3" {{ isset($_POST['selection']) && $_POST['selection']=='3'?'selected':'' }}>{{$lang['4']}} ((A+B))</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="a" class="font-s-14 text-blue" id="changeText">
                    {{ (isset($_POST['selection']) && $_POST['selection']=='2') ? "$lang[3] (B):" : ((isset($_POST['selection']) && $_POST['selection']=='3') ? "$lang[4] (A+B):" : "$lang[2] (A):" ) }}
                </label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="a" id="a" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['a']) ? $_POST['a'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units_dropdown')">{{ isset($_POST['units'])?$_POST['units']:'m' }} ▾</label>
                    <input type="text" name="units" value="{{ isset($_POST['units'])?$_POST['units']:'m' }}" id="units" class="hidden">
                    <div id="units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'mm')">milimeters (mm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'cm')">centimeters (cm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'm')">meters (m)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'km')">kilometers (km)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'dm')">decimetre (dm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'in')">inches (in)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'ft')">feets (ft)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'yd')">yards (yd)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'mi')">miles (mi)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'nmi')">nautical mile (nmi)</p>
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
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['2']}} (A)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['longer_section'], 3)}} {{$_POST['units']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['3']}} (B)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['shorter_section'], 3)}} {{$_POST['units']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}} (A+B)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['sum'], 3)}} {{$_POST['units']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>φ = A/B = (A+B)/A</strong></td>
                                        <td class="py-2 border-b">{{round($detail['value'], 3)}}</td>
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
            document.getElementById('main').addEventListener('change', function() {
                if(this.value === "1"){
                    document.getElementById('changeText').textContent = '{{$lang[2]}} (A):';
                }else if(this.value === "2"){
                    document.getElementById('changeText').textContent = '{{$lang[3]}} (B):';
                }else{
                    document.getElementById('changeText').textContent = '{{$lang[4]}} (A+B):';
                }
            });
        </script>
    @endpush
</form>