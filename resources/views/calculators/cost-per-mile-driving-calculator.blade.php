@php
    if (isset($_POST['submit'])) {
        $cost_of_gas = trim($_POST['cost_of_gas']);
        $miles_per_gallon = trim($_POST['miles_per_gallon']);
        $car_value = trim($_POST['car_value']);
    } elseif (isset($_GET['res_link'])) {
        $cost_of_gas = trim($_GET['cost_of_gas']);
        $miles_per_gallon = trim($_GET['miles_per_gallon']);
        $car_value = trim($_GET['car_value']);
    }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="cost_of_gas" class="label">{{ $lang['1'] }}({{$currancy}}/{{ $lang['2'] }}):</label>
                    <div class="w-full py-2"> 
                        <input type="number" step="any" name="cost_of_gas" id="cost_of_gas" class="input" aria-label="input"  value="{{ isset($_POST['cost_of_gas'])?$_POST['cost_of_gas']:'7' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                    <label for="miles_per_gallon" class="label">
                            {{ $lang['3'] }}:
                    </label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="miles_per_gallon" id="miles_per_gallon" class="input" aria-label="input"  value="{{ isset($_POST['miles_per_gallon'])?$_POST['miles_per_gallon']:'7' }}" />
                    </div>
                </div> 
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="car_value" class="label">
                            {{ $lang['4'] }}({{$currancy}}):
                    </label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="car_value" id="car_value" class="input" aria-label="input"  value="{{ isset($_POST['car_value'])?$_POST['car_value']:'4' }}" />
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
                <div class="col-span-12 mt-3">
                    <div class="w-full my-2">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$lang['5']}}</strong></p>
                            <div class="flex justify-center">
                            <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">{{round($detail['answer'], 7) }}<span class="text-[20px]"> {{$currancy}}</span></strong></p>
                            </div>
                            <div class="col-12">
                                <p class="text-[20px]"><strong>{{ $lang[6]}}</strong></p>
                                <p class="mt-2">{{ $lang[7] }}</p>
                                <p class="mt-2">{{ $lang[8] }}.</p>
                                <p class="mt-2">{{ $lang[5] }} = {{ $lang[1]}}/ {{ $lang[3]}} + ({{$lang[4]}} /25000*0.03) + 0.05 </p>
                                <p class="mt-2">{{ $lang[9] }}</p>
                                <p class="mt-2">{{ $lang[5] }} = <?php echo $cost_of_gas; ?>/ <?php echo $miles_per_gallon; ?>+(<?php echo $car_value; ?>/25000*0.03) + 0.05</p>
                                <p class="mt-2">{{ $lang[5] }} = <?php echo $cost_of_gas; ?>/ <?php echo $miles_per_gallon; ?>+{{ ($detail['car_value'] *0.03) + 0.05 }}</p>
                                <p class="mt-2">{{ $lang[5] }} = <?php echo $cost_of_gas; ?>/ <?php echo $miles_per_gallon; ?>+{{ ($detail['total_car_value']) + 0.05 }}</p>
                                <p class="mt-2">{{ $lang[5] }} = {{ $detail['total_cost_mile'] }} +{{ $detail['total_car_value'] }} + 0.05</p>
                                <p class="mt-2">{{ $lang[5] }} = {{ $detail['answer'] }} {{$currancy}}</p>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>