@php
 if(isset($_POST['submit'])){
    $price=trim($_POST['price']);
  }elseif(isset($_GET['res_link'])){
    $price=trim($_GET['price']);
  }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="no" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <input type="number" step="any" name="no" id="no" class="input" aria-label="input" placeholder="4" value="{{ isset($_POST['no'])?$_POST['no']:'1' }}" />
                </div>
                
                <div class="space-y-2">
                    <label for="thickness" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="thickness" id="thickness" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['thickness'])?$_POST['thickness']:'1.5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="thickness_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('thickness_unit_dropdown')">{{ isset($_POST['thickness_unit'])?$_POST['thickness_unit']:'cm' }} ▾</label>
                        <input type="text" name="thickness_unit" value="{{ isset($_POST['thickness_unit'])?$_POST['thickness_unit']:'cm' }}" id="thickness_unit" class="hidden">
                        <div id="thickness_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md  lg:w-[40%] md:w-[40%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('thickness_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('thickness_unit', 'm')">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('thickness_unit', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('thickness_unit', 'yd')">yards (yd)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('thickness_unit', 'ft')">foot (ft)</p>
                       
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="length" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="length" id="length" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length'])?$_POST['length']:'1.5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }} ▾</label>
                        <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }}" id="length_unit" class="hidden">
                        <div id="length_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md  lg:w-[40%] md:w-[40%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'm')">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'yd')">yards (yd)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'ft')">foot (ft)</p>
                       
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="width" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="width" id="width" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }} ▾</label>
                        <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }}" id="width_unit" class="hidden">
                        <div id="width_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'm')">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'in')">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'yd')">yards (yd)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'ft')">foot (ft)</p>
                       
                        </div>
                    </div>
                 </div>

                <div class="space-y-2 relative">
                    <label for="price" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <input type="number" step="any" name="price" id="price" class="input" value="{{ isset($_POST['price'])?$_POST['price']:'' }}" aria-label="input" placeholder="" />
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
                    <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                        <div class="flex flex-wrap">
                            <div class="lg:w-1/2 text-lg">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b border-gray-300 py-2"><strong>{{$lang['6']}}</strong></td>
                                        <td class="border-b border-gray-300 py-2">{{round($detail['ans'],2)}} bd ft</td>
                                    </tr>
                                    @if(is_numeric($price))
                                    <tr>
                                        <td class="border-b border-gray-300 py-2"><strong>{{$lang['7']}}</strong></td>
                                        <td class="border-b border-gray-300 py-2">{{$currancy}} {{round($detail['ans'] * $price,2)}}</td>
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