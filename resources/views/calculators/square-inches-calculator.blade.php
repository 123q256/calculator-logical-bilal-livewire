<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">

                <div class="space-y-2">
                    <label for="length" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="l_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('l_units_dropdown')">{{ isset($_POST['l_units'])?$_POST['l_units']:'cm' }} ▾</label>
                        <input type="text" name="l_units" value="{{ isset($_POST['l_units'])?$_POST['l_units']:'cm' }}" id="l_units" class="hidden">
                        <div id="l_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[50%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'mm')">milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'm')">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'ft')">feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('l_units', 'yd')">yards (yd)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="width" class="font-s-14 text-blue cat">{{ $lang['2'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="w_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('w_units_dropdown')">{{ isset($_POST['w_units'])?$_POST['w_units']:'cm' }} ▾</label>
                        <input type="text" name="w_units" value="{{ isset($_POST['w_units'])?$_POST['w_units']:'cm' }}" id="w_units" class="hidden">
                        <div id="w_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[50%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'mm')">milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'm')">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'ft')">feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'yd')">yards (yd)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 relative">
                    <label for="price" class="font-s-14 text-blue">({{ $lang['3'] }}):</label>
                    <input type="number" name="price" id="price" class="input" aria-label="input"  value="{{ isset($_POST['price'])?$_POST['price']:'' }}" />
                    <span class="text-blue input_unit">{{$currancy}}</span>
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
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18 ">
                                <table class="w-100">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['5']}} </strong></td>
                                        <td class="border-b py-2">{{ round($detail['square_inches'], 2) }} in<sup>2</sup></td>
                                    </tr>
                                    @if(isset($detail['cost']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['6']}} </strong></td>
                                            <td class="border-b py-2">{{$currancy}} {{ round($detail['cost'], 2) }}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>