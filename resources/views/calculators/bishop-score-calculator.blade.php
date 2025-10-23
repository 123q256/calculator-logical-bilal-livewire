<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="effacement" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="effacement" id="effacement" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ["0-30%", "40-50%", "60-70%", "More than 80%"];
                                $val = ["0", "1", "2", "3"];
                                optionsList($val,$name,isset(request()->effacement)?request()->effacement:'0');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="consistency" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="consistency" id="consistency" class="input">
                            @php
                                $name = ["Firm", "Moderately firm", "Soft"];
                                $val = ["0", "1", "2"];
                                optionsList($val,$name,isset(request()->consistency)?request()->consistency:'0');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fetal_station" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="fetal_station" id="fetal_station" class="input">
                            @php
                                $name = ["-3 (Baby has not reached the vaginal canal)", "-2", "-1 or 0 (Baby's head has reached the ischial spines)", "+1 or +2 (Baby's head is already at the end of the canal)"];
                                $val = ["0", "1", "2", "3"];
                                optionsList($val,$name,isset(request()->fetal_station)?request()->fetal_station:'2');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="head_position" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="head_position" id="head_position" class="input">
                            @php
                                $name = ["Posterior", "Mid-position", "Anterior"];
                                $val = ["0", "1", "2"];
                                optionsList($val,$name,isset(request()->head_position)?request()->head_position:'0');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="dilation" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="dilation" id="dilation" class="input">
                            @php
                                $name = ["Closed","1-2 cm","3-4 cm","More than 5 cm"];
                                $val = ["0","1","2","3"];
                                optionsList($val,$name,isset(request()->dilation)?request()->dilation:'1');
                            @endphp
                        </select>
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
                        <p><strong>{{ $lang['6'] }}</strong></p>
                        <p><strong class="text-green-500 text-[32px]">{{ $detail['bishopScore'] }}</strong></p>
                        <p>{{ $detail['result'] }}</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>