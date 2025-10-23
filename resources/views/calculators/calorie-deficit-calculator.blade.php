<style>
    @media (max-width: 520px) {
        .calculator-box{
            padding-right: 0rem;
            padding-left: 0rem;
        }
        .border-end-cus{
           border-bottom: 1px solid gainsboro; 
        }
    }
    @media (min-width: 520px) {
        .border-end-cus{
           border-right: 1px solid gainsboro; 
        }
    }
    .calo{
        font-size: 10px;
    }
	.loading {
		display: flex;
		justify-content: center;
		align-items: center;
		transition: 0.5s;
        position: absolute;
		top: 0;
		width: 95.5%;
		height: 100%
	}
    .text-orange{
        color: #ff4500c4;
    }
	.loading::after {
		content: "";
		width: 37.6px;
		height: 37.6px;
		border: 8px solid #bbdbfc;
		border-top-color: #2845F5;
		border-radius: 50%;
		animation: loading 1s linear infinite
	}
	@keyframes loading {
		to {
			transform: rotate(1turn)
		}
	}
	.load_content {
		transition: 0.5s;
		opacity: 0
	}
	.active_tr{
        background-image: linear-gradient(45deg, #2845F5, #57b4eb) !important;
	}
    .active_tr td{
		color: white !important;
	}
	.click_me:hover{
        background-image: linear-gradient(45deg, #2845F5, #57b4eb);
        /* color: white !important; */
	}
    .click_me:hover td{
        color: white !important;
	}
    .line-height{
        line-height: 28px;
    }
    .gap-2{
        gap: 15px;
    }
    tbody .click_me:nth-child(even) {
        background-color: #1670a712;
        /* color: #fff; */
    }
    .radius-top{
        border-radius: 10px 10px 0px 0px;

    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">

        <div class="  mt-2 lg:w-[50%] ">
            <input type="hidden" name="unit_type" id="unit_type" value="lbs">
            <div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="imperial" data-value="imperial" >
                            {{ $lang['49'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="metric" data-value="metric">
                            {{ $lang['48'] }}
                    </div>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <div class="px-lg-0 px-2 py-3">
                        <label for="gender" class="pe-3 text-[14px] text-blue">{!! $lang['gender'] !!}:</label>
                        <input type="radio" name="gender" id="male" value="Male"  {{ isset($_POST['gender']) && $_POST['gender'] === 'male' ? 'checked' : '' }}>
                        <label for="male" class="text-[14px] text-blue pe-lg-3 pe-2">{{ $lang['male'] }}</label>
                        <input type="radio" name="gender" id="female" value="Female" checked {{ isset($_POST['gender']) && $_POST['gender'] === 'female' ? 'checked' : '' }}>
                        <label for="female" class="text-[14px] text-blue">{{ $lang['female'] }}</label>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="age" class="text-[14px] text-blue">{!! $lang['your_age'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'23' }}" />
                    </div>
                </div>
                <div class="col-span-6 height_ft_in">
                    <label for="ft_in" class="text-[14px] text-blue">{!! $lang['height'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="ft_in" id="ft_in" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ["4ft 7in", "4ft 8in", "4ft 9in", "4ft 10in", "4ft 11in", "5ft 0in", "5ft 1in", "5ft 2in", "5ft 3in", "5ft 4in", "5ft 5in", "5ft 6in", "5ft 7in", "5ft 8in", "5ft 9in", "5ft 10in", "5ft 11in", "6ft 0in", "6ft 1in", "6ft 2in", "6ft 3in", "6ft 4in", "6ft 5in", "6ft 6in", "6ft 7in", "6ft 8in", "6ft 9in", "6ft 10in", "6ft 11in", "7ft 0in"];
                                $val = ["55", "56", "57", "58", "59", "60", "61", "62", "63", "64", "65", "66", "67", "68", "69", "70", "71", "72", "73", "74", "75", "76", "77", "78", "79", "80", "81", "82", "83", "84"];
                                optionsList($val,$name,isset($_POST['ft_in'])?$_POST['ft_in']:'69');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6 height_cm hidden">
                    <label for="height_cm" class="text-[14px] text-blue">{!! $lang['height'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" name="height_cm" id="height_cm" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['height_cm'])?$_POST['height_cm']:'175' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="weight" class="text-[14px] text-blue">{!! $lang['weight'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="weight" id="weight" min="1" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['weight'])?$_POST['weight']:'205' }}" />
                        <span class="text-blue input_unit" id="lbs_or_kg1">lbs</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="target" class="text-[14px] text-blue">{!! $lang['50'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="target" id="target" min="1" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['target'])?$_POST['target']:'185' }}" />
                        <span class="text-blue input_unit" id="lbs_or_kg2">lbs</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-10 lg:col-span-10">
                    <label for="activity" class="text-[14px] text-blue">{!! $lang['daily_activity'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="activity" id="activity" class="input">
                            @php
                                $name = [$lang['No_sport'], $lang['Light_activity'], $lang['Moderate_activity'], $lang['High_activity'], $lang['Extreme_activity']];
                                $val = ["1.2", "1.375", "1.55", "1.725", "1.9"];
                                optionsList($val,$name,isset($_POST['activity'])?$_POST['activity']:'1.55');
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



    @endunless
    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  md:w-[95%] lg:w-[95%] mt-3 flex justify-center">
                <div class="w-full ">
                    @php
                        $submit = request()->unit_type;
                    @endphp
                    <div class="w-full ">
                        <div class="grid grid-cols-12 gap-4 text-center shadow-md rounded-lg px-2 mx-[10px] py-4">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="text-center line-height border-end-cus px-3">
                                    <strong>{{ $lang[84] }} </strong>
                                    <p class="text-[14px] px-4 py-2">Your should take following calories on a daily calories</p>
                                    <strong class="text-orange text-[25px]">{{ $detail['tdee'] }}</strong>
                                    <p class="text-[12px]" style="line-height: 1;">Kcal/day</p>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="text-center line-height px-3">
                                    <strong>{{ $lang[86] }} </strong>
                                    <p class="text-[14px] px-4 my-2">Your should take following calories on a daily calories</p>
                                    <strong class="text-orange text-[25px]">{{ $detail['calorie_def_cal'] }}</strong>
                                    <p class="text-[12px]" style="line-height: 1;">Kcal/day</p>
            
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-2 mt-3 ">
                            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                <div class="shadow-md mt-md-0 mt-2 p-2 rounded-lg flex justify-between items-center">
                                    <div>
                                        <span class="text-[12px]">Mild Weight Loss</span>
                                        <p class="text-[12px] text-gray-500">{{ ($submit === "lbs") ? "( 0.5 lb/week )" : "( 0.25 kg/week )"}}</p>
                                    </div>
                                    <div class="text-blue-500">
                                        @php
                                        $calorieReduction = ($submit === "lbs") ? 250 : round((7700 * 0.25) / 7);
                                        @endphp                        
                                        <strong class="text-[14px]">{{ number_format($detail['tdee']-$calorieReduction) }} <span class="calo text-dark">Calories/Day</span></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                <div class="shadow-md mt-md-0 mt-2 p-2 rounded-lg flex justify-between items-center mx-md-2">
                                    <div>
                                        <span class="text-[12px]">Weight Loss </span>
                                        <p class="text-[12px] text-gray-500">{{ ($submit === "lbs") ? "( 1 lb/week )" : "( 0.25 kg/week )"}}</p>
                                    </div>
                                    <div class="text-blue-500">
                                        @php $calorieReduction = ($submit === "lbs") ? 500 : round((7700 * 0.5) / 7); @endphp                    
                                        <strong class="text-[14px]">{{ number_format($detail['tdee']-$calorieReduction) }} <span class="calo text-dark">Calories/Day</span></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                <div class="shadow-md mt-md-0 mt-2 p-2 rounded-lg flex justify-between items-center">
                                    <div>
                                        <span class="text-[12px]">Extreme Weight Loss</span>
                                        <p class="text-[12px] text-gray-500">{{ ($submit === "lbs") ? "( 2 lb/week )" : "( 1 kg/week )"}}</p>
                                    </div>
                                    <div class="text-blue-500">
                                        @php $calorieReduction = ($submit === "lbs") ? 1000 : round(7700 / 7); @endphp                        
                                        <strong class="text-[14px]">{{ number_format($detail['tdee']-$calorieReduction) }} <span class="calo text-dark">Calories/Day</span></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full  hide_table px-3">
                            <p class="text-[18px] px-3 mt-4 mb-3 text-center"><strong>{{ $lang[56] }} ({{ date("l jS F Y") }})</strong></p>
                            <div class="w-full  overflow-auto border rounded-lg custom-scroll" style="max-height:286px">
                                <table class="w-full px-3 text-center" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="hidden"></th>
                                            <th class="text-[12px] border-b-dark p-2">{{ $lang[57] }}</th>
                                            <th class="text-[12px] border-b-dark p-2">{{ $lang[58] }}</th>
                                            <th class="text-[12px] border-b-dark p-2">{{ $lang[59] }}</th>
                                            <th class="text-[12px] border-b-dark p-2">{{ $lang[60] }}</th>
                                            <th class="text-[12px] p-2 border-b-dark">{{ $lang[87] }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $sort = 0;
                                        foreach ($detail['intake_cal_array'] as $key => $val) {
                                            list($in_cal, $yrs, $date, $less_cal) = explode("@@", $val);
                                            $border_b = 'border-b';
                                            if($key+1 === count($detail['intake_cal_array'])){
                                                $border_b = '';
                                            }
                                        @endphp
                                            <tr class="click_me " style="cursor: pointer;" onclick="getDetail({{ $in_cal }},'{{ $yrs }}','{{ $date }}', this)">
                                                <td class="hidden">{{ ++$sort }}</td>
                                                <td class="text-[14px] {{ $border_b }} p-2" width="15%">{{ $in_cal }}</td>
                                                <td class="text-[14px] {{ $border_b }} p-2">{{ $less_cal }}</td>
                                                <td class="text-[14px] {{ $border_b }} p-2">{{ $yrs }}</td>
                                                <td class="text-[14px] {{ $border_b }} p-2">{{ $date }}</td>
                                                <td class="{{ $border_b }} text-green-500 p-2 flex " title="{{ $lang[77] }}">
                                                   <span class="mx-1"> {{ $lang[87] }}</span> <img src="{{ asset('images/blue-arrow.png') }}" alt="Arrow" width="13px" height="" class="ms-lg-2 object-contain mx-2">
                                                </td>
                                            </tr>
                                        @php } @endphp
                                    </tbody>
                                </table>
                            </div>
                        </div>
            
                        <div class="w-full loading_data hidden">
                            <p class="text-[18px] px-3 mt-2 mb-1"><strong class="text-blue">{{ $lang[62] }}</strong></p>
                            <div class="w-full bg-sky overflow-auto px-3 relative">
                                <div class="loading">
                                    <div align="center" style="position: absolute; margin-top: 63px; text-align: center; font-size: 18px; font-family: sans-serif; font-weight: 550; color: #fafafd;">Loading...
                                    </div>
                                </div>
                                <div class="load_content">
                                    <div class="w-full">
                                        <p class="text-center my-2"><strong class="text-blue"> {{ $lang[63] }} <span class="cal_update text-blue">2800</span> {{ $lang[64] }} <span id="time_update" class="text-blue">1.2 yrs</span>.</strong></p>
                                        <div class="grid grid-cols-12 gap-3 text-[14px]">
                                            <div class="col-span-4 overflow-auto">
                                                <table class="w-full" cellspacing="0">
                                                    <tr>
                                                        <td class="p-2">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b p-2"><strong>{{ $lang['weight'] }}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b p-2"><strong>{{ $lang[64] }}</strong></td>
                                                    <tr>
                                                        <td class="border-b p-2"><strong>TDEE</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b p-2"><strong>RMR</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-2"><strong>BMI</strong></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-span-4 overflow-auto">
                                                <table class="w-full" cellspacing="0">
                                                    <tr>
                                                        <td class="border-b p-2"><strong class="text-blue">{{ date('j-F-Y') }}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b p-2"><strong>{{ $detail['weight'] }}</strong> <span>{{ $detail['submit'] }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b p-2"><strong>{{ $detail['LBM'] }}</strong> <span>{{ $detail['submit'] }}</span></td>
                                                    <tr>
                                                        <td class="border-b p-2"><strong>{{ $detail['tdee'] }}</strong> <span>kcal</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b p-2"><strong>{{ $detail['RMR'] }}</strong> <span>kcal</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-2"><strong>{{ $detail['BMI'] }}</strong></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-span-4 overflow-auto">
                                                <table class="w-full" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-b p-2"><strong class="text-blue" id="target_date">&nbsp;</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-b p-2"><strong>{{ $detail['target'] }}</strong> <span>{{ $detail['submit'] }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-b p-2"><strong>{{ $detail['LBM_target'] }}</strong> <span>{{ $detail['submit'] }}</span></td>
                                                        <tr>
                                                            <td class="border-b p-2"><strong>{{ $detail['tdee_target'] }}</strong> <span>kcal</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-b p-2"><strong>{{ $detail['RMR_target'] }}</strong> <span>kcal</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-2"><strong>{{ $detail['BMI_target'] }}</strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col s12 padding_0 margin_top_15">
                                            <p class="text-center my-2"><strong class="text-blue">{{ $lang[65] }} <span class="cal_update text-blue">2800</span> kcal</strong></p>
                                        </div>
                                        <div class="grid grid-cols-12 gap-3  text-[14px]">
                                            <div class="col-span-3 overflow-auto">
                                                <table class="w-full" cellspacing="0">
                                                    <tr>
                                                        <td class="border-b p-2"><strong class="text-blue">{{ $lang[66] }}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b p-2"><strong>{{ $lang[67] }}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b p-2"><strong>{{ $lang[68] }}</strong></td>
                                                    <tr>
                                                        <td class="border-b p-2"><strong>{{ $lang[69] }}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-2"><strong>{{ $lang[70] }}</strong></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-span-3 overflow-auto">
                                                <table class="w-full" cellspacing="0">
                                                    <tr>
                                                        <td class="border-b p-2"><strong class="text-blue">{{ $lang[71] }}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b p-2"><strong id="balanced_protein">Balanced</strong> (g)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b p-2"><strong id="low_fat_protein">Low Fat</strong> (g)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b p-2"><strong id="low_carb_protein">Low Carbs</strong> (g)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-2"><strong id="high_pro_protein">High Protein</strong> (g)</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-span-3 overflow-auto">
                                                <table class="w-full" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-b p-2"><strong class="text-blue">{{ $lang[72] }}</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-b p-2"><strong id="balanced_carbs">Balanced</strong> (g)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-b p-2"><strong id="low_fat_carbs">Low Fat</strong> (g)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-b p-2"><strong id="low_carb_fats">Low Carbs</strong> (g)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-2"><strong id="high_pro_carbs">High Protein</strong> (g)</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-span-3 overflow-auto">
                                                <table class="w-full" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-b p-2"><strong class="text-blue">{{ $lang[73] }}</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-b p-2"><strong id="balanced_fats">Balanced</strong> (g)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-b p-2"><strong id="low_fat_fats">Low Fat</strong> (g)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-b p-2"><strong id="low_carb_carbs">Low Carbs</strong> (g)</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-2"><strong id="high_pro_fats">High Protein</strong> (g)</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full text-center">
                                        <button type="button" class="bg-[#2845F5] text-white rounded-lg border-0 px-4 py-2 my-3 cursor-pointer" onclick="hideDetail()">{{ $lang[74] }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-4 px-3">
                            <p class="text-[18px] px-3 my-4 text-center"><strong>{{ $lang[75] ." (". date("l jS  F Y") .")"}} </strong></p>
                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div> 
                        <div class="w-full mt-4 px-3">
                            <div class="grid grid-cols-12 border-blue-500 pb-3 rounded-lg">
                                <p class="col-span-12 text-[18px] px-3 mb-2 text-center radius-top bg-[#2845F5] py-2"><strong class="text-white">{{ $lang[88] }}</strong></p>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 md:border-r lg::border-r px-2 overflow-auto">
                                    <table class="w-full px-3" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td class="border-b p-2">TDEE&nbsp; <span class="bg-white radius-circle px-2 cursor-pointer" title="{{ $lang[32] }}">?</span></td>
                                                <td class="border-b p-2 text-end"><strong>{{ $detail['tdee']  }}</strong> <span class="text-[14px]">Kcal/day</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b p-2">BMR&nbsp; <span class="bg-white radius-circle px-2 cursor-pointer" title="{{ $lang[54] }}">?</span></td>
                                                <td class="border-b p-2 text-end"><strong>{{ $detail['BMR']  }}</strong> <span class="text-[14px]">Kcal/day</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-md-b p-2">RMR&nbsp; <span class="bg-white radius-circle px-2 cursor-pointer" title="{{ $lang[53] }}">?</span></td>
                                                <td class="border-md-b p-2 text-end"><strong>{{ $detail['RMR']  }}</strong> <span class="text-[14px]">Kcal/day</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 overflow-auto px-2">
                                    <table class="w-full px-3" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td class="border-b p-2">BMI&nbsp; <span class="bg-white radius-circle px-2 cursor-pointer" title="{{ $lang[89] }}">?</span></td>
                                                <td class="border-b p-2 text-end"><strong>{{ $detail['BMI']  }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b p-2">PAL&nbsp; <span class="bg-white radius-circle px-2 cursor-pointer" title="{{ $lang[52] }}">?</span></td>
                                                <td class="border-b p-2 text-end"><strong>{{ $detail['activity']  }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="p-2">IBW&nbsp; <span class="bg-white radius-circle px-2 cursor-pointer" title="{{ $lang[55] }}">?</span></td>
                                                <td class="p-2 text-end"><strong>{{ $detail['ibw']  }}</strong> <span>{{ $detail['submit'] }}</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-center my-3">
                        <div class="flex justify-center gap-3 mb-6 mt-10">
                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                                @if (app()->getLocale() == 'en')
                                    RESET
                                @else
                                    {{ $lang['reset'] ?? 'RESET' }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        @isset($detail)
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

            <script>
                // var mild = {{$detail['tdee'] - 250}};
                // var extreme = {{$detail['tdee'] - 500}};
                // var loss = {{$detail['tdee'] - 1000}};
                var mild = {{$detail['tdee'] - ($submit === "lbs" ? 250 : round((7700 * 0.25) / 7))}};
                var loss = {{$detail['tdee'] - ($submit === "lbs" ? 500 : round((7700 * 0.5) / 7))}};
                var extreme = {{$detail['tdee'] - ($submit === 'lbs' ? 1000 : round(7700 / 7))}};

                console.log(loss);

                window.onload = function () {
                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        theme: "light2", // "light1", "light2", "dark1", "dark2"
                        axisY: {
                            title: "Weight (lbs)",
                            interval: 200,
                            minimum: 80,
                            maximum: mild
                        },
                        data: [{        
                            type: "column",
                            dataPoints: [      
                                { y: extreme, label: "Extreme Weight Loss", color: "#fec623" },
                                { y: mild, label: "Mild Weight Loss", color: "#3c5bbd" },
                                { y: loss, label: "Weight Loss", color: "#ff5b55" },
                            ]
                        }]
                    });
                    chart.render();
                };


                document.addEventListener('DOMContentLoaded', function () {
                    var myChart = Highcharts.chart('container1', {
                        chart: {
                            backgroundColor: 'var(--bg-sky)',
                            type: 'line',
                        },
                        title: {
                            text: null,
                        },
                        xAxis: {
                            title: {
                                text: 'Days',
                                style: {
                                    color: '#444',
                                    fontWeight: 'bold',
                                    fontSize: '20px',
                                    fontFamily: 'Trebuchet MS, Verdana, sans-serif'
            
                                } 
                            },
                            labels: {
                                style: {
                                    color: '#444'
                                }
                            },
                            categories: [
                                @php
                                    // $today = date();
                                    for($i=1; $i<=$detail['days'];$i++){
                                        $NewDate=Date('d M', strtotime("+".$i." day"));
                                        echo "'".$NewDate."',";
                                    }
                                @endphp
                            ]
                        },
                        yAxis: {
                            title: {
                                text: 'Weight',
                                style: {
                                    color: '#444',
                                    fontWeight: 'bold',
                                    fontSize: '20px',
                                    fontFamily: 'Trebuchet MS, Verdana, sans-serif'
            
                                } 
                            },
                            labels: {
                                style: {
                                    color: '#444'
                                },
                                formatter: function () {
                                    return Math.abs(this.value) + '{{ $detail['submit'] }}';
                                }
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            crosshairs: true,
                            shared: true,
                            valueSuffix: ' {{ $detail['submit'] }}'
                        },
                        series: [{
                            name: 'Weight',
                            data: [
                                @php
                                    $weight = $detail['weight'];
                                    for($i=1; $i<=$detail['days'];$i++){
                                        echo $weight.",";
                                        $weight=round($weight - $detail['pounds_daily'],2);
                                    }
                                @endphp
                            ],
                        }]
                    });
                });
                function getDetail(calories, time, date, element) {
                    $('.click_me').removeClass("active_tr");
                    $(element).addClass("active_tr");
                    $('.cal_update').text(calories);
                    $('#time_update').text(time);
                    $('#target_date').text(date);
                    var low_fat_pro = Math.round((calories * 0.25) / 4);
                    var low_fat_fat = Math.round((calories * 0.20) / 9);
                    var low_fat_carbs = Math.round((calories * 0.55) / 4);
                    $('#low_fat_protein').text(low_fat_pro);
                    $('#low_fat_fats').text(low_fat_fat);
                    $('#low_fat_carbs').text(low_fat_carbs);
                    var low_carb_pro = Math.round((calories * 0.25) / 4);
                    var low_carb_fat = Math.round((calories * 0.30) / 9);
                    var low_carb_carbs = Math.round((calories * 0.45) / 4);
                    $('#low_carb_protein').text(low_carb_pro);
                    $('#low_carb_fats').text(low_carb_fat);
                    $('#low_carb_carbs').text(low_carb_carbs);
                    var high_pro_pro = Math.round((calories * 0.35) / 4);
                    var high_pro_fat = Math.round((calories * 0.20) / 9);
                    var high_pro_carbs = Math.round((calories * 0.45) / 4);
                    $('#high_pro_protein').text(high_pro_pro);
                    $('#high_pro_fats').text(high_pro_fat);
                    $('#high_pro_carbs').text(high_pro_carbs);
                    var balanced_pro = Math.round((calories * 0.20) / 4);
                    var balanced_fat = Math.round((calories * 0.30) / 9);
                    var balanced_carbs = Math.round((calories * 0.50) / 4);
                    $('#balanced_protein').text(balanced_pro);
                    $('#balanced_fats').text(balanced_fat);
                    $('#balanced_carbs').text(balanced_carbs);
                    $('.hide_table').hide();
                    $('.loading_data').show();
                    const loading = document.querySelector('.loading');
                    const content = document.querySelector('.load_content');
                    setTimeout(() => {
                        loading.style.display = "none";
                        loading.style.opacity = "0";
                        content.style.opacity = "1";
                    }, 2000)
                }
                function hideDetail() {
                    const loading = document.querySelector('.loading');
                    const content = document.querySelector('.load_content');
                    loading.style.display = "flex";
                    loading.style.opacity = "1";
                    content.style.opacity = "0";
                    setTimeout(() => {
                        $('.hide_table').show();
                        $('.loading_data').hide();
                    }, 2000)
                }
            </script>
        @endisset
        <script>
            if(document.querySelector('.imperial')){
                document.querySelector('.imperial').addEventListener('click', function() {
                    this.classList.add('tagsUnit');
                    document.querySelector('.metric').classList.remove('tagsUnit');
                    document.getElementById('lbs_or_kg1').textContent = "lbs";
                    document.getElementById('lbs_or_kg2').textContent = "lbs";
                    document.querySelectorAll('.height_ft_in').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.height_cm').forEach(function(el) {
                        el.style.display = 'none';
                    });
    
                    if (document.getElementById('unit_type').value !== 'lbs') {
                        var kg_to_lbs = parseFloat(document.getElementById('weight').value);
                        if (!isNaN(kg_to_lbs)) {
                            var input_lbs = Math.round(kg_to_lbs * 2.205, 2);
                            document.getElementById('weight').value = input_lbs;
                        }
                        var lbs_to_kg = parseFloat(document.getElementById('target').value);
                        if (!isNaN(lbs_to_kg)) {
                            var input_kg = Math.round(lbs_to_kg * 2.205, 2);
                            document.getElementById('target').value = input_kg;
                        }
                    }
                    document.getElementById('unit_type').value = 'lbs';
                });
            }

            if(document.querySelector('.metric')){
                document.querySelector('.metric').addEventListener('click', function() {
                    this.classList.add('tagsUnit');
                    document.querySelector('.imperial').classList.remove('tagsUnit');
                    document.getElementById('lbs_or_kg1').textContent = "kg";
                    document.getElementById('lbs_or_kg2').textContent = "kg";
                    document.querySelectorAll('.height_ft_in').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelectorAll('.height_cm').forEach(function(el) {
                        el.style.display = 'block';
                    });

                    if (document.getElementById('unit_type').value !== 'kg') {
                        var in_to_cm = parseFloat(document.getElementById('ft_in').value);
                        if (!isNaN(in_to_cm)) {
                            var input_cm = Math.round(in_to_cm * 2.54, 2);
                            document.getElementById('height_cm').value = input_cm;
                        }
                        var lbs_to_kg = parseFloat(document.getElementById('weight').value);
                        if (!isNaN(lbs_to_kg)) {
                            var input_kg = Math.round(lbs_to_kg / 2.205, 2);
                            document.getElementById('weight').value = input_kg;
                        }
                        var kg_to_lbs = parseFloat(document.getElementById('target').value);
                        if (!isNaN(kg_to_lbs)) {
                            var input_lbs = Math.round(kg_to_lbs / 2.205, 2);
                            document.getElementById('target').value = input_lbs;
                        }
                    }
                    document.getElementById('unit_type').value = 'kg';
                });
            }

            @if(isset(request()->unit_type) && request()->unit_type === 'lbs')
                if(document.querySelector('.imperial')){
                    document.querySelector('.imperial').classList.add('tagsUnit');
                    document.querySelector('.metric').classList.remove('tagsUnit');
                    document.getElementById('lbs_or_kg1').textContent = "lbs";
                    document.getElementById('lbs_or_kg2').textContent = "lbs";
                    document.querySelectorAll('.height_ft_in').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.height_cm').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.getElementById('unit_type').value = 'lbs';
                }
            @elseif(isset(request()->unit_type) && request()->unit_type === 'kg')
                if(document.querySelector('.metric')){
                    document.querySelector('.metric').classList.add('tagsUnit');
                    document.querySelector('.imperial').classList.remove('tagsUnit');
                    document.getElementById('lbs_or_kg1').textContent = "kg";
                    document.getElementById('lbs_or_kg2').textContent = "kg";
                    document.querySelectorAll('.height_ft_in').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelectorAll('.height_cm').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.getElementById('unit_type').value = 'kg';
                }
            @endif
        </script>
    @endpush
</form>