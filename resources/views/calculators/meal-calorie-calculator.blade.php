<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="meals" class="font-s-14 text-blue">{{ $lang['meal'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="meals" id="meals" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = ["3","4","5"];
                                $val = ["3","4","5"];
                                optionsList($val,$name,isset($_POST['meals'])?$_POST['meals']:'3');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="calorie" class="font-s-14 text-blue">{{ $lang['day'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="calorie" id="calorie" class="input" aria-label="input" placeholder="e.g. 1800" value="{{ isset($_POST['calorie'])?$_POST['calorie']:'' }}" />
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
                        <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-[10px] p-3" style="border: 1px solid #c1b8b899;">
                                    <div class="flex flex-wrap items-center justify-between">
                                        <div class="flex items-center">
                                            <img src="{{ url('images/break_fast.png') }}" alt="break fast" width="50">
                                            <span class="text-blue-700 text-[18px] mx-2">{{ $lang['b_f'] }}</span>
                                        </div>
                                        <div>
                                            <strong class="text-[28px] text-green-700">{{ $detail['b_f']." kcal" }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($_POST['meals']==4 || $_POST['meals']==5)
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-[10px] p-3"  style="border: 1px solid #c1b8b899;">
                                        <div class="flex flex-wrap items-center justify-between">
                                            <div class="flex items-center">
                                                <img src="{{ url('images/ms.png') }}" alt="Morning" width="50">
                                                <span class="text-blue-700 text-[18px] ms-2">{{ $lang['m_s'] }}</span>
                                            </div>
                                            <div>
                                                <strong class="text-[28px] text-green-700">{{ $detail['m_s']." kcal" }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-[10px] p-3"  style="border: 1px solid #c1b8b899;">
                                    <div class="flex flex-wrap items-center justify-between">
                                        <div class="flex items-center">
                                            <img src="{{ url('images/lunch.png') }}" alt="lunch" width="50">
                                            <span class="text-blue-700 text-[18px] mx-2">{{ $lang['l'] }}</span>
                                        </div>
                                        <div>
                                            <strong class="text-[28px] text-green-700">{{ $detail['lanch']." kcal" }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($_POST['meals']==5)
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-sky border rounded-[10px] p-3">
                                        <div class="flex flex-wrap items-center justify-between">
                                            <div class="flex items-center">
                                                <img src="{{ url('images/afternoon.png') }}" alt="afternoon" width="50">
                                                <span class="text-blue-700 text-[18px] mx-2">{{ $lang['a_n'] }}</span>
                                            </div>
                                            <div>
                                                <strong class="text-[28px] text-green-700">{{ $detail['a_n']." kcal" }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-sky border rounded-[10px] p-3">
                                    <div class="flex flex-wrap items-center justify-between">
                                        <div class="flex items-center">
                                            <img src="{{ url('images/dinner.png') }}" alt="dinner" width="50">
                                            <span class="text-blue-700 text-[18px] mx-2">{{ $lang['d'] }}</span>
                                        </div>
                                        <div>
                                            <strong class="text-[28px] text-green-700">{{ $detail['dinner']." kcal" }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>