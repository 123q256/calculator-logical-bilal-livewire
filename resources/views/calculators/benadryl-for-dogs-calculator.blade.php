<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
        

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2">
                    <label for="w" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="w" id="w" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['w'])?$_POST['w']:'25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="w_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('w_unit_dropdown')">{{ isset($_POST['w_unit'])?$_POST['w_unit']:'g' }} ▾</label>
                        <input type="text" name="w_unit" value="{{ isset($_POST['w_unit'])?$_POST['w_unit']:'g' }}" id="w_unit" class="hidden">
                        <div id="w_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'g')">grams (g)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'oz')">ounces (oz)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'lbs')">pounds (lbs)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'stone')">stone</p>
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
                    <div class="w-full bg-light-blue lg:p-4 md:p-4 p-1 rounded-lg mt-6">
                        <div class="w-full">
                            <div class="bg-[#F6FAFC] text-black border rounded-lg p-4">
                                <strong>{{ $lang['2'] }} (mg) =</strong>
                                <span class="text-[#119154] text-lg font-bold">{{ round($detail['bd'],2) }} (mg)</span>
                            </div>
                    
                            <div class="bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4">
                                <strong>{{ $lang['3'] }} (12.5 mg / 5 mL) =</strong>
                                <span class="text-[#119154] text-lg font-bold">{{ round($detail['liquid'],2) }} (ml)</span>
                            </div>
                    
                            <div class="w-full overflow-auto mt-4">
                                <table class="w-full lg:w-3/4 mx-auto border-collapse">
                                    <tr>
                                        <td class="border-b py-2">
                                            <p class="text-[#2845F5]">{{ $lang['4'] }} <strong class="text-[#2845F5]">25 <span class="text-[#2845F5]">(mg)</span> {{ $lang['7'] }}</strong></p>
                                        </td>
                                        <td class="border-b text-right">
                                            <p class="text-[#2845F5]">{{ intval($detail['bd']/25) }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">
                                            <p class="text-[#2845F5]">{{ $lang['4'] }} <strong class="text-[#2845F5]">12.5 <span class="text-[#2845F5]">(mg)</span> {{ $lang['5'] }}</strong></p>
                                        </td>
                                        <td class="border-b text-right">
                                            <p class="text-[#2845F5]">{{ intval($detail['bd']/12.5) }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                    
                            <div class="mt-4">
                                <p><strong>🕒 {{ $lang['6'] }}.</strong></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
</form>