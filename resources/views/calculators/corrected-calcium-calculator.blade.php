<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="w-full lg:w-2/3 mx-auto">
            <div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-5">
                    <div class="w-full px-2 lg:pl-4">
                        <label for="calcium" class="label">{!! $lang['Calcium'] !!}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="calcium" id="calcium" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-[#3E9960] w-full" value="{{ isset($_POST['calcium'])?$_POST['calcium']:'160' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit_c" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_c_dropdown')">{{ isset($_POST['unit_c'])?$_POST['unit_c']:'mg/dl' }} ▾</label>
                            <input type="text" name="unit_c" value="{{ isset($_POST['unit_c'])?$_POST['unit_c']:'mg/dl' }}" id="unit_c" class="hidden">
                            <div id="unit_c_dropdown" class="absolute p-2 z-10 bg-white border border-gray-300 rounded-md lg:w-[90%] md:w-[90%] w-[94%] mt-1 right-0 hidden">
                                <p class="p-1  hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'mg/dl')">milligrams per deciliter (mg/dL)</p>
                                <p class="p-1  hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'mmol/l')">millimoles per liter (mmol/L)</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-2 lg:pl-4">
                        <label for="albumin" class="label">{!! $lang['Albumin'] !!}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="albumin" id="albumin" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-[#3E9960] w-full" value="{{ isset($_POST['albumin'])?$_POST['albumin']:'160' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit_a" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_a_dropdown')">{{ isset($_POST['unit_a'])?$_POST['unit_a']:'g/dL' }} ▾</label>
                            <input type="text" name="unit_a" value="{{ isset($_POST['unit_a'])?$_POST['unit_a']:'g/dL' }}" id="unit_a" class="hidden">
                            <div id="unit_a_dropdown" class="absolute z-10 p-2 bg-white border border-gray-300 rounded-md lg:w-[90%] md:w-[90%] w-[94%] mt-1 right-0 hidden">
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'g/dL')">grams per deciliter (g/dL)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'g/L')">grams per liter (g/L)</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-2 lg:pl-4">
                        <label for="normal" class="label">{!! $lang['Normal'] !!}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="normal" id="normal" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-[#3E9960] w-full" value="{{ isset($_POST['normal'])?$_POST['normal']:'160' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit_n" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_n_dropdown')">{{ isset($_POST['unit_n'])?$_POST['unit_n']:'g/dL' }} ▾</label>
                            <input type="text" name="unit_n" value="{{ isset($_POST['unit_n'])?$_POST['unit_n']:'g/dL' }}" id="unit_n" class="hidden">
                            <div id="unit_n_dropdown" class="absolute z-10 p-2 bg-white border border-gray-300 rounded-md lg:w-[90%] md:w-[90%] w-[94%] mt-1 right-0 hidden">
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_n', 'g/dL')">grams per deciliter (g/dL)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_n', 'g/L')">grams per liter (g/L)</p>
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

        {{-- result --}}
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
               
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full   rounded-xl mt-3">
                        <div class="w-full text-center mt-2">
                            <p class="text-lg text-[#3E9960] font-bold mb-2">{{ isset($lang['answer_text']) ? $lang['answer_text'] : 'Corrected Calcium' }}</p>
                            @if(isset($detail['Calcium_res']))
                                <strong class="text-green text-4xl">{{ $detail['Calcium_res'] }}</strong>
                            @else
                                <strong class="text-green text-4xl">00.0</strong>
                            @endif
                            <strong class="text-green text-2xl">{{ isset($detail['request']->unit_c) ? $detail['request']->unit_c : 'mg/dl' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

    
    @endisset
</form>