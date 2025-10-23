<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
                <div class="col-span-12">
                    <label for="rent" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="rent" id="rent" class="input" aria-label="input" placeholder="2000" value="{{ isset($_POST['rent'])?$_POST['rent']:'2000' }}" />
                        <span class="text-blue input_unit">{{$currancy }}</span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="year" class="font-s-12 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="year" id="year" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['year'])?$_POST['year']:'50' }}" />
                        <span class="text-blue input_unit">%</span>
                    </div>
                </div>

                <div class="col-span-12">
                    <label for="numbers" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="numbers" id="numbers" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['numbers']) ? $_POST['numbers'] : '2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="numbers_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('numbers_unit_dropdown')">{{ isset($_POST['numbers_unit'])?$_POST['numbers_unit']:'kg' }} ▾</label>
                        <input type="text" name="numbers_unit" value="{{ isset($_POST['numbers_unit'])?$_POST['numbers_unit']:'kg' }}" id="numbers_unit" class="hidden">
                        <div id="numbers_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="numbers_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('numbers_unit', 'wks')">wks</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('numbers_unit', 'mos')">mos</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('numbers_unit', 'yrs')">yrs</p>
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
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy }} {{round($detail['answer'], 2) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                        <p class="mt-2"><strong>{{ $lang['5'] }}</strong></p>
                        <p class="mt-2">{{ $lang['6'] }}</p>
                        <p class="mt-2">{{ $lang['4'] }} = {{ $lang['1'] }}(1 + {{ $lang['2'] }} )<sup>{{ $lang['3'] }}</sup></p>
                        <p class="mt-2">{{ $lang['4'] }} = {{ isset($_POST['rent'])?$_POST['rent']:'' }}  (1 +  {{ isset($_POST['year'])?$_POST['year']:'' }}  % )<sup>{{ isset($_POST['numbers'])?$_POST['numbers']:'' }}</sup></p>
                        <p class="mt-2">{{ $lang['4'] }} = {{$currancy }} {{round($detail['answer'], 2) }}</p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>