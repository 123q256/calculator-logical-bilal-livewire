<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="date" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <input type="date"  name="date" id="date" class="input" aria-label="input" value="{{ isset($_POST['date']) ? $_POST['date'] : date('Y-m-d') }}" />
                </div>

                <div class="space-y-2">
                    <label for="age" class="font-s-14 text-blue">{{ $lang['2'] }} </label>
                    <div class="relative w-full ">
                        <input type="number" name="age" id="age" step="any"  min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['age'])?$_POST['age']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="age_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('age_unit_dropdown')">{{ isset($_POST['age_unit'])?$_POST['age_unit']:'second' }} ▾</label>
                        <input type="text" name="age_unit" value="{{ isset($_POST['age_unit'])?$_POST['age_unit']:'second' }}" id="age_unit" class="hidden">
                        <div id="age_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[40%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'second')">{{ $lang['5'] }}</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'minutes')">{{ $lang['6'] }}</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'hours')">{{ $lang['7'] }}</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'days')">{{ $lang['8'] }}</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'weeks')">{{ $lang['9'] }}</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'months')">{{ $lang['10'] }}</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'years')">{{ $lang['11'] }}</p>
                        </div>
                    </div>
                 </div>

                <div class="space-y-2">
                    <label for="choose" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <select class="input" name="choose" id="choose">
                        <option value="after"  {{ isset($_POST['choose']) && $_POST['choose']=='after'?'selected':''}}>{{ $lang['12'] }}</option>
                        <option value="before"  {{ isset($_POST['choose']) && $_POST['choose']=='before'?'selected':''}}>{{ $lang['13'] }}</option>
                    </select>
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
                    <div class="w-full text-center text-base">
                        <p>{{ $lang[4] }}</p>
                        <p class="my-3">
                            <strong class=" bg-[#2845F5] text-white px-3 py-2 text-4xl rounded-lg text-blue">{{ round($detail['newYear'], 4) }}</strong>
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    @endisset
</form>

