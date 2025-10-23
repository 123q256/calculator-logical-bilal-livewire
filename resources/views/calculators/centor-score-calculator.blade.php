<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="age" class="label">{!! $lang['age'] !!}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="age" id="age" min="1" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="tonsils" class="label">{!! $lang['t'] !!}:</label>
                    <div class="w-full py-2 position-relative">
                        <select name="tonsils" id="tonsils" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang['no'],$lang['yes']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset($_POST['tonsils'])?$_POST['tonsils']:'0');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="cough" class="label">{!! $lang['c'] !!}:</label>
                    <div class="w-full py-2 position-relative">
                        <select name="cough" id="cough" class="input">
                            @php
                                $name = [$lang['cc'],$lang['nc']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset($_POST['cough'])?$_POST['cough']:'0');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="lymph" class="label">{!! $lang['l'] !!}:</label>
                    <div class="w-full py-2 position-relative">
                        <select name="lymph" id="lymph" class="input">
                            @php
                                $name = [$lang['no'],$lang['yes']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset($_POST['lymph'])?$_POST['lymph']:'0');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="temp" class="label">{{ $lang['b'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="temp" id="temp" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temp']) ? $_POST['temp'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'°C' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'°C' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', '°F')">°F</p>
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
                        <div class="w-full text-center">
                            <p class="w-full text-[20px] mt-2"><strong><?=$lang['ans']?></strong></p>
                            <p class="w-full text-[32px]">
                                @if(isset($detail['ans']))
                                    <strong class="text-[#119154]">{!! $detail['ans'] !!}</strong>
                                @else
                                    <strong class="text-[#119154]">0.0 <span class="text-[#119154]  lg:text-[25px] md:text-[25px] text-[18px]">Points</span></strong>
                                @endif
                            </p>
                            <p class="w-full mt-2"><?=$detail['per']." ".$detail['text']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>