<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="selection" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 relative">
                    <select name="selection" id="selection" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'],$lang['3'],$lang['4'],$lang['5'],$lang['6'],$lang['7']];
                            $val = ["1","2","3","4","5","6"];
                            optionsList($val,$name,isset($_POST['selection'])?$_POST['selection']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="selection3" class="label">{!! $lang['8'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="selection3" id="selection3" class="input">
                        @php
                            $name = [$lang['9'],$lang['10'],$lang['11'],$lang['12']];
                            $val = ["1","2","3","4"];
                            optionsList($val,$name,isset($_POST['selection3'])?$_POST['selection3']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="charge" class="label">{{ $lang['13'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="charge" id="charge" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['charge']) ? $_POST['charge'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="d_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('d_unit_dropdown')">{{ isset($_POST['d_unit'])?$_POST['d_unit']:$lang['14'] }} ▾</label>
                    <input type="text" name="d_unit" value="{{ isset($_POST['d_unit'])?$_POST['d_unit']:$lang['14'] }}" id="d_unit" class="hidden">
                    <div id="d_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="d_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', '{{ $lang['14'] }}')">{{ $lang['14'] }}</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', '{{ $lang['15'] }}')">{{ $lang['15'] }}</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', '{{ $lang['16'] }}')">{{ $lang['16'] }}</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', '{{ $lang['17'] }}')">{{ $lang['17'] }}</p>
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
                            <div class="bg-[#F6FAFC] border  rounded-lg p-3" style=" border: 1px solid #c1b8b899;">
                                {{ $lang['18'] }} = <strong class="text-[#119154] text-[25px]">{{ $detail['answer1'] }}</strong> mg {{ $lang['19'] }}
                            </div>
                            <div class="bg-[#F6FAFC] border  rounded-lg p-3 mt-2" style=" border: 1px solid #c1b8b899;">
                                {{ $lang['20'] }} = <strong class="text-[#119154] text-[20px]">{{ $detail['answer2'] }}</strong>
                            </div>
                            <p class="mt-2">{{ $lang['21'] }}</p>
                            <p>{{ ($detail['answer3']) }} <strong class="text-[#119154] text-[18px]">{{ ($detail['answer4']) }} {{ ($detail['days']) }}{{ ($detail['weeks']) }}{{ ($detail['months']) }}{{ ($detail['years']) }}</strong>-{{ $lang['22'] }}:</p>
                            <div class="w-full overflow-auto">
                                <table class="w-full col-lg-3" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2">{{ ($detail['ans1']) }} {{ ($detail['ans1_first']) }} {{ ($detail['tablets']) }} {{ ($detail['tablet']) }} {{ ($detail['ml']) }} {{ ($detail['applications']) }} {{ ($detail['strips']) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ ($detail['ans2']) }} {{ ($detail['ans1_second']) }} {{ ($detail['tablets']) }} {{ ($detail['tablet']) }} {{ ($detail['drops']) }} {{ ($detail['strips']) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ ($detail['ans3']) }} {{ ($detail['ans1_third']) }} {{ ($detail['tablets']) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">{{ ($detail['ans4']) }} {{ ($detail['ans1_four']) }} {{ ($detail['tablets']) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>