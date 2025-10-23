<style>
        .calender_val{
            position: absolute;
            top: 17px;
            left: 11.5px
        }
        .inner_line{
            position: absolute;
            bottom: 3px;
            height: 4px;
            background: #fff;
        }
        .r_line,.r_line2,.r_line3{
            position: absolute;
            bottom: 3px;
            height: 4px;
            background: #1670a7;
            width: 0px;
            height: 7px;
            border-radius: 10px
        }
        .r_line{
            width: 10px;
        }
        .p_line{
            width: 100%;
            height: 50px;
            position: relative;
            margin-top: -20px;
            z-index: 0;
        }
        .res_img,.res_img1,.res_img2{
            position: relative;
            left: 0px;
            top: 12px;
            width: 23%;
            height: 100%;
        }
        .p_res_img,.p_res_img1,.p_res_img2{
            position: absolute;
            z-index: 3333;
            left: -12px;
        }
        .p_res_img1,.p_res_img2{
            display: none;
        }
        .trim_height{
            height: 215px;
        }
        .week_height{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 71.59px;
            line-height: 50px;
        }
        .orange_color{
            color: #000000;
        }
        .green_color{
            color: #ffffff;
        }
        .orange{
            background: #f7d7a8
        }
        .light-orange{
            background: #f7d7a8
        }
        .lime{
            background: #041dcfc7
        }
        .light-lime{
            background: #041dcfc7
        }
        .light-blue{
            background: #12a575cf
        }
        .lighter-blue{
            background: #12a575cf
        }
        .bg_blue_g{
            background-image: linear-gradient(to left,#012432,#02598c)
        }
        .grey{
            background: #eee
        }
        .color_gray{
            color: #666666
        }
        .bg-dark-blue {
        background: #094365;
    }
    .text-white {
    color: white!important;
    
    }
    .container1{
        overflow: auto !important;
    }


/* Style scrollbar thumb */
#set_custom_scroll::-webkit-scrollbar-thumb {
    background-color: #119154 ; /* Thumb color */
    border-radius: 10px; /* Rounded thumb */
}

/* Style scrollbar size */
#set_custom_scroll::-webkit-scrollbar {
    height: 12px; /* Scrollbar height */
}



	@if(isset($detail['RemainingWeeks']) && $detail['RemainingWeeks']!='')
        @php $value=$detail['RemainingWeeks'] @endphp
        @if($value!=1 && $value!=2 && $value<7)
            .res_img{
                left: {{ 7.69 * $value }}%;
            }
            .r_line{
                width: {{ 7.69 * $value }}%;
            }
        @endif
        @if($value>=7 && $value<11)
            .res_img{
                left: {{ 7.69 * $value }}%;
            }
            .r_line{
                width: {{ 7.69 * $value }}%;
            }
        @endif
        @if($value>=11 && $value<14)
            .res_img{
                left: {{ 7.69 * $value }}%;
            }
            .r_line{
                width: {{ 7.69 * $value }}%;
            }
        @endif
        @if($value>=14 && $value<16)
            .p_res_img{
                display: none;
            }
            .p_res_img1{
                display: block;
            }
            .r_line{
                width: 100%;
            }
            .r_line2{
                width: 10px;
            }
        @endif
        @if($value>=16 && $value<24)
            .p_res_img{
                display: none;
            }
            .p_res_img1{
                display: block;
            }
            .r_line{
                width: 100%;
            }
            .res_img1{
                left: {{ 2.2 * $value }}%;
            }
            .r_line2{
                width: {{ 2.2 * $value }}%;
            }
        @endif
        @if($value>=24 && $value<27)
            .p_res_img{
                display: none;
            }
            .p_res_img1{
                display: block;
            }
            .r_line{
                width: 100%;
            }
            .res_img1{
                left: {{ 3.3 * $value }}%;
            }
            .r_line2{
                width: {{ 3.3 * $value }}%;
            }
        @endif
        @if($value==27)
            .p_res_img{
                display: none;
            }
            .p_res_img1{
                display: block;
            }
            .r_line{
                width: 100%;
            }
            .res_img1{
                left: 100%;
            }
            .r_line2{
                width: 100%;
            }
        @endif
        @if($value>=28 && $value<30)
            .p_res_img,.p_res_img1{
                display: none;
            }
            .p_res_img2{
                display: block;
            }
            .r_line,.r_line2{
                width: 100%;
            }
            .r_line3{
                width: 10px;
            }
        @endif
        @if($value>=30 && $value<36)
            .p_res_img,.p_res_img1{
                display: none;
            }
            .p_res_img2{
                display: block;
            }
            .r_line,.r_line2{
                width: 100%;
            }
            .res_img2{
                left: {{ 1.5 * $value }}%;
            }
            .r_line3{
                width: {{ 1.5 * $value }}%;
            }
        @endif
        @if($value>=36 && $value<39)
            .p_res_img,.p_res_img1{
                display: none;
            }
            .p_res_img2{
                display: block;
            }
            .r_line,.r_line2{
                width: 100%;
            }
            .res_img2{
                left: {{ 2 * $value }}%;
            }
            .r_line3{
                width: {{ 2 * $value }}%;
            }
        @endif
        @if($value==39 || $value==40)
            .p_res_img,.p_res_img1{
                display: none;
            }
            .p_res_img2{
                display: block;
            }
            .r_line,.r_line2,.r_line3{
                width: 100%;
            }
            .res_img2{
                left: 100%;
            }
        @endif
	@endif
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[100%] md:w-[100%] w-full mx-auto ">
            <div class="w-full lg:w-8/12 mx-auto mt-3">
                <div class="flex flex-wrap">
                    @if(isset($error))
                        <p class="text-lg text-center font-semibold text-red-600">{{ $error }}</p>
                    @endif
                    <div class="w-full px-2">
                        <label for="method" class="text-base text-blue-600">{!! $lang['cal_method'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select name="method" id="method" class="w-full border border-gray-300 rounded px-4 py-2">
                                @php
                                    function optionsList($arr1, $arr2, $unit) {
                                        foreach($arr1 as $index => $name) {
                                @endphp
                                    <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                        }
                                    }
                                    $name = [$lang['m1'], "Due Date", $lang['m2'], $lang['m3'], $lang['m4']];
                                    $val = ["Last", "Due", "Conception", "IVF", "Ultrasound"];
                                    optionsList($val, $name, isset(request()->method) ? request()->method : 'Last');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 px-2">
                        <label for="date" class="text-base text-blue-600" id="class">First Day of Last Menstrual Period:</label>
                        <div class="w-full py-2 relative">
                            <input type="date" name="date" id="date" class="w-full border border-gray-300 rounded px-4 py-2" aria-label="input" placeholder="MMM DD, YYYY" value="{{ isset(request()->date) ? request()->date : date("Y-m-d") }}" />
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 px-2 cycle">
                        <label for="cycle" class="text-base text-blue-600">{!! $lang['cycle_len'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" name="cycle" id="cycle" class="w-full border border-gray-300 rounded px-4 py-2" min="22" max="44" aria-label="input" placeholder="00" value="{{ isset(request()->cycle) ? request()->cycle : '28' }}" />
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 px-2 ivf hidden">
                        <label for="ivf" class="text-base text-blue-600">{!! $lang['e_age'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select name="ivf" id="ivf" class="w-full border border-gray-300 rounded px-4 py-2">
                                @php
                                    $name = [$lang['m1'], "Due Date", $lang['m2'], $lang['m3'], $lang['m4']];
                                    $val = ["Last", "Due", "Conception", "IVF", "Ultrasound"];
                                    optionsList($val, $name, isset(request()->ivf) ? request()->ivf : 'Last');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 px-2 week_day hidden">
                        <label for="week" class="text-base text-blue-600">{!! $lang['week'] !!}:</label>
                        <div class="w-full py-2">
                            <input type="number" name="week" id="week" class="w-full border border-gray-300 rounded px-4 py-2" min="1" max="24" aria-label="input" placeholder="00" value="{{ isset(request()->week) ? request()->week : '21' }}" />
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 px-2 week_day hidden">
                        <label for="days" class="text-base text-blue-600">{!! $lang['days'] !!}:</label>
                        <div class="w-full py-2">
                            <input type="number" name="days" id="days" class="w-full border border-gray-300 rounded px-4 py-2" min="0" max="6" aria-label="input" placeholder="00" value="{{ isset(request()->days) ? request()->days : '5' }}" />
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
                    <div class="w-full  p-3 rounded-lg mt-3">
                        <div class="row ">
                            <div class="flex flex-wrap px-1 lg:px-3">
                            </div>
                            <div class="flex flex-col lg:flex-row">
                                <!-- First Card -->
                                <div class="w-full ">
                                    <div class="lg:flex gap-4 md:flex flex-row">
                                    <div class="w-full  mt-6 flex justify-center">
                                        <div class="w-full bg-[#F6FAFC] to-blue-50 border border-blue-200  rounded-xl p-4">
                                            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                                                <div class="text-center md:text-left">
                                                    <p class="text-sm font-semibold text-blue-600 max-w-[170px]">
                                                        {{ $lang['your_due'] }} 
                                                        <span class="text-blue-800">{{ date('M d, Y', strtotime($detail['EstimatedAge'])) }}</span>
                                                    </p>
                                                </div>
                
                                                <div class="hidden md:block md:border-r border-blue-300 pr-4 mr-4"></div>
                
                                                <div class="flex items-center space-x-2 text-2xl text-gray-700">
                                                    <strong>{{ date('M', strtotime($detail['EstimatedAge'])) }}</strong>
                                                    <div class="relative">
                                                        <img src="{{ asset('images/empty_calender.png') }}" width="60px" alt="Calendar" class=" transform transition-transform hover:scale-105">
                                                        <strong class="text-green-500 absolute inset-0 flex items-center justify-center text-xl">{{ date('d', strtotime($detail['EstimatedAge'])) }}</strong>
                                                    </div>
                                                    <strong>{{ date('Y', strtotime($detail['EstimatedAge'])) }}</strong>
                                                </div>
                                            </div>
                
                                            <p class="text-sm mt-4 text-gray-600">
                                                <strong class="text-red-500">{{ $lang['cong'] }}!</strong>
                                            </p>
                
                                            <p class="text-sm text-gray-700">
                                                <strong>{{ $lang['1'] }} {{ $detail['RemainingWeeks'] }} {{ $lang['week'] }}, {{ $detail['RemainingDays'] }} {{ $lang['days'] }} {{ $lang['2'] }}</strong>
                                            </p>
                
                                            @if($_POST['method'] == 'Due')
                                                <p class="text-sm text-gray-700">
                                                    {{ $lang['con'] }}: 
                                                    <strong class="text-black">{{ date('M d, Y', strtotime($detail['ovu_date'])) }}</strong>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                
                                    <!-- Second Card -->
                                    <div class="w-full flex justify-center mt-6">
                                        <div class="w-full bg-[#F6FAFC] border border-blue-200  rounded-xl px-6 py-5">
                                            <p class="text-lg font-bold text-blue-600">
                                                {{ $lang['5'] }} 
                                                <span class="text-blue-800">{{ $lang['week'].' '.$detail['RemainingWeeks'] }} {{ $lang['6'] }}</span>
                                            </p>
                
                                            @if ($detail['RemainingWeeks'] == 1 || $detail['RemainingWeeks'] == 2 || $detail['RemainingWeeks'] == 0)
                                                @php $week = explode('@', $lang['w1&2']) @endphp
                                                <p class="text-lg font-semibold text-gray-800">{{ $week[0] }}</p>
                                                <p class="text-sm text-gray-600">{{ $week[1] }}</p>
                                            @endif
                
                                            @if ($detail['RemainingWeeks'] == 3)
                                                @php $week = explode('@', $lang['w3']) @endphp
                                                <p class="text-lg font-semibold text-gray-800">{{ $week[0] }}</p>
                                                <p class="text-sm text-gray-600">{{ $week[1] }}</p>
                                            @endif
                
                                            @if ($detail['RemainingWeeks'] == 40)
                                                @php $week = explode('@', $lang['w40']) @endphp
                                                <p class="text-lg font-semibold text-gray-800">{{ $week[0] }}</p>
                                                <p class="text-sm text-gray-600">{{ $week[1] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                
                                    <!-- Section Separator -->
                                    <p class="text-lg mt-6 text-center font-bold text-blue-600 border-b-2 border-blue-500 inline-block pb-1">
                                        {{ $lang['24'] }}
                                    </p>
                
                                    <!-- Timeline Sections -->
                                    <div class="w-full mt-4">
                                        <div class=" flex items-center  rounded-lg border border-blue-200 ">
                                            <div class="w-full lg:w-12/12 bg-[#F6FAFC] rounded-lg px-4 py-2 flex flex-col justify-center">
                                                <p class="text-blue-600 font-bold">{{ $lang['1st'] }}</p>
                                                <p class="text-gray-500 text-sm">{{ date('M d', strtotime($detail['ovu_date'].' - 2 weeks')) }} to {{ date('M d', strtotime($detail['ovu_date'].' + 11 weeks - 1 day')) }}</p>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="w-full mt-4">
                                        <div class=" flex items-center  rounded-lg border border-blue-200 ">
                                            <div class="w-full lg:w-12/12 bg-[#F6FAFC] rounded-lg px-4 py-2 flex flex-col justify-center">
                                                <p class="text-blue-600 font-bold">{{ $lang['2nd'] }}</p>
                                                <p class="text-gray-500 text-sm">{{ date('M d', strtotime($detail['ovu_date'].' + 11 weeks')) }} to {{ date('M d', strtotime($detail['ovu_date'].' + 25 weeks - 1 day')) }}</p>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="w-full mt-4">
                                        <div class=" flex items-center rounded-lg border border-blue-200  ">
                                            <div class="w-full lg:w-12/12 bg-[#F6FAFC] rounded-lg px-4 py-2 flex flex-col justify-center">
                                                <p class="text-blue-600 font-bold">{{ $lang['3rd'] }}</p>
                                                <p class="text-gray-500 text-sm">{{ date('M d', strtotime($detail['ovu_date'].' + 25 weeks')) }} to {{ date('M d', strtotime($detail['ovu_date'].' + 38 weeks')) }}</p>
                                            </div>
                                        </div>
                                    </div>
                
                                    <!-- Final Message -->
                                    <p class="mt-6 text-lg font-bold">{{ $lang['3'] }}</p>
                                    <p class="text-gray-700">{{ $lang['4'] }}</p>
                                </div>
                            </div>
                            <div class="w-full lg:w-[100%] mt-3">
                                <div class="bg-[#F6FAFC]  border rounded-2xl px-3 py-2">
                                    <p class="text-center"> <strong class="text-blue-500">{{ $lang['7'] }}</strong></p>
                                    <div class="w-full overflow-auto">
                                        <table class="w-full" cellspacing="0">
                                        @php
                                            $today = date('M d, Y');
                                            $today = date(strtotime($today));
                                            $ovu_date = date(strtotime($detail['ovu_date']));
                                            $preg_text = date(strtotime($detail['ovu_date'].' + 9 days'));
                                            $heart_beat = date(strtotime($detail['ovu_date'].' + 21 days'));
                                            $morning = date(strtotime($detail['ovu_date'].' + 7 weeks'));
                                            $midwife = date(strtotime($detail['ovu_date'].' + 8 weeks'));
                                            $second = date(strtotime($detail['ovu_date'].' + 11 weeks'));
                                            $ears = date(strtotime($detail['ovu_date'].' + 13 weeks'));
                                            $feeling = date(strtotime($detail['ovu_date'].' + 15 weeks'));
                                            $scan = date(strtotime($detail['ovu_date'].' + 16 weeks'));
                                            $organs = date(strtotime($detail['ovu_date'].' + 22 weeks'));
                                            $third = date(strtotime($detail['ovu_date'].' + 25 weeks'));
                                            $deliver = date(strtotime($detail['ovu_date'].' + 34 weeks'));
                                            $full = date(strtotime($detail['ovu_date'].' + 35 weeks'));
                                            $due = date(strtotime($detail['ovu_date'].' + 38 weeks'));
                                        @endphp
                                        @if($today < $ovu_date)
                                            <tr>
                                                <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d', strtotime($detail['ovu_date'])) }}</td>
                                                <td class="border-b p-2">{{ $lang['8'] }}</td>
                                            </tr>
                                        @endif
                                        @if($today == $ovu_date)
                                            <tr class="bg-blue-500 text-white">
                                                <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d', strtotime($detail['ovu_date'])) }}</td>
                                                <td class="border-b p-2">{{ $lang['8'] }}</td>
                                            </tr>
                                        @endif
                                            @if($today>$ovu_date)
                                                <tr>
                                                    <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'])) }}</td>
                                                    <td class="color_gray border-b p-2">{{ $lang['8'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$ovu_date && $today < $preg_text)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$preg_text)
                                                <tr>
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 9 days')); }}</td>
                                                    <td class="border-b p-2">{{ $lang['10'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today==$preg_text)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 9 days')); }}</td>
                                                    <td class="border-b p-2">{{ $lang['10'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$preg_text)
                                                <tr>
                                                    <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 9 days')); }}</td>
                                                    <td class="color_gray border-b p-2">{{ $lang['10'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$preg_text && $today<$heart_beat)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$heart_beat)
                                                <tr>
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 21 days')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['11'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today==$heart_beat)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 21 days')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['11'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$heart_beat)
                                                <tr>
                                                    <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 21 days')) }}</td>
                                                    <td class="color_gray border-b p-2">{{ $lang['11'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$heart_beat && $today<$morning)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$morning)
                                                <tr>
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 7 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['12'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today==$morning)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 7 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['12'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$morning)
                                                <tr>
                                                    <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 7 weeks')) }}</td>
                                                    <td class="color_gray border-b p-2">{{ $lang['12'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$morning && $today<$midwife)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$midwife)
                                                <tr>
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 8 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['13'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today==$midwife)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 8 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['13'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$midwife)
                                                <tr>
                                                    <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 8 weeks')) }}</td>
                                                    <td class="color_gray border-b p-2">{{ $lang['13'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$midwife && $today<$second)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$second)
                                                <tr>
                                                    <td class="border-b pe-2 p-2"><strong class="text-blue">{{ date('M d',strtotime($detail['ovu_date'].' + 11 weeks')) }}</strong></td>
                                                    <td class="border-b p-2"><strong>{{ $lang['2nd'] }} (13 {{ $lang['week'] }})</strong></td>
                                                </tr>	
                                            @endif
                                            @if($today==$second)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="border-b pe-2 p-2"><strong class="text-blue">{{ date('M d',strtotime($detail['ovu_date'].' + 11 weeks')) }}</strong></td>
                                                    <td class="border-b p-2"><strong>{{ $lang['2nd'] }} (13 {{ $lang['week'] }})</strong></td>
                                                </tr>
                                            @endif
                                            @if($today>$second)
                                                <tr>
                                                    <td class="border-b pe-2 p-2"><strong class="color_gray">{{ date('M d',strtotime($detail['ovu_date'].' + 11 weeks')) }}</strong></td>
                                                    <td class="border-b p-2"><strong class="color_gray">{{ $lang['2nd'] }} (13 {{ $lang['week'] }})</strong></td>
                                                </tr>	
                                            @endif
                                            @if($today>$second && $today<$ears)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$ears)
                                                <tr>
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 13 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['14'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today==$ears)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 13 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['14'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$ears)
                                                <tr>
                                                    <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 13 weeks')) }}</td>
                                                    <td class="color_gray border-b p-2">{{ $lang['14'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$ears && $today<$feeling)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$feeling)
                                                <tr>
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 15 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['15'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today==$feeling)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 15 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['15'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$feeling)
                                                <tr>
                                                    <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 15 weeks')) }}</td>
                                                    <td class="color_gray border-b p-2">{{ $lang['15'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$feeling && $today<$scan)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$scan)
                                                <tr>
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 16 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['16'] }} </td>
                                                </tr>	
                                            @endif
                                            @if($today==$scan)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 16 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['16'] }} </td>
                                                </tr>
                                            @endif
                                            @if($today>$scan)
                                                <tr>
                                                    <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 16 weeks')) }}</td>
                                                    <td class="color_gray border-b p-2">{{ $lang['16'] }} </td>
                                                </tr>
                                            @endif
                                            @if($today>$scan && $today<$organs)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$organs)
                                                <tr>
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 22 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['17'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today==$organs)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 22 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['17'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$organs)
                                                <tr>
                                                    <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 22 weeks')) }}</td>
                                                    <td class="color_gray border-b p-2">{{ $lang['17'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$organs && $today<$third)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$third)
                                                <tr>
                                                    <td class="border-b pe-2 p-2"><strong class="text-blue">{{ date('M d',strtotime($detail['ovu_date'].' + 25 weeks')) }}</strong></td>
                                                    <td class="border-b p-2"><strong>{{ $lang['3rd'] }} (28 {{ $lang['week'] }})</strong></td>
                                                </tr>
                                            @endif
                                            @if($today==$third)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="border-b pe-2 p-2"><strong class="text-blue">{{ date('M d',strtotime($detail['ovu_date'].' + 25 weeks')) }}</strong></td>
                                                    <td class="border-b p-2"><strong>{{ $lang['3rd'] }} (28 {{ $lang['week'] }})</strong></td>
                                                </tr>
                                            @endif
                                            @if($today>$third)
                                                <tr>
                                                    <td class="border-b pe-2 p-2"><strong class="color_gray">{{ date('M d',strtotime($detail['ovu_date'].' + 25 weeks')) }}</strong></td>
                                                    <td class="border-b p-2"><strong class="color_gray">{{ $lang['3rd'] }} (28 {{ $lang['week'] }})</strong></td>
                                                </tr>
                                            @endif
                                            @if($today>$third && $today<$deliver)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$deliver)
                                                <tr>
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 34 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['18'] }}</td>
                                                </tr>	
                                            @endif
                                            @if($today==$deliver)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 34 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['18'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$deliver)
                                                <tr>
                                                    <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 34 weeks')) }}</td>
                                                    <td class="color_gray border-b p-2">{{ $lang['18'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$deliver && $today<$full)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$full)
                                                <tr>
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 35 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['19'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today==$full)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 35 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['19'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$full)
                                                <tr>
                                                    <td class="text-blue-500 border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 35 weeks')) }}</td>
                                                    <td class="color_gray border-b p-2">{{ $lang['19'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today>$full && $today<$due)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d') }}</td>
                                                    <td class="border-b p-2">{{ $lang['9'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today<$due)
                                                <tr>
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 38 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['20'] }}</td>
                                                </tr>
                                            @endif
                                            @if($today==$due || $today>$due)
                                                <tr class="bg_blue_g text-white">
                                                    <td class="text-blue border-b pe-2 p-2">{{ date('M d',strtotime($detail['ovu_date'].' + 38 weeks')) }}</td>
                                                    <td class="border-b p-2">{{ $lang['20'] }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                            <p class="font-s-18 my-3"><strong class="border-b-blue text-blue pb-1">{{ $lang['21'] }}</strong></p>
                            <div class="border border-blue-200 " id="set_custom_scroll" style="overflow:auto">
                                <div class="row mt-3 flex " style="width:940px;" >
                                    <div class="col-2 w-[20%] d-lg-block" style="border-right: 2px solid white;">
                                        <div class="col-12 text-center bg-gray border-white"><strong>{{ $lang['21'] }}</strong></div>
                                        <div class="col-12 p-2 trim_height text-center orange border-white orange_color" style="justify-content: center;display: grid;">
                                            <b>{{ $lang['1st'] }}</b>
                                            <img src="{{ asset('images/1st_trim.png') }}" alt="1st trimester" class="mt-2" width="100px" height="100px">
                                        </div>
                                        <div class="col-12 p-2 trim_height text-center light-blue border-white text-blue" style="justify-content: center;display: grid;border-top: 2px solid white;">
                                            <b>{{ $lang['2nd'] }}</b>
                                            <img src="{{ asset('images/2nd_trim.png') }}" alt="2nd trimester" class="mt-2" width="100px" height="100px">
                                        </div>
                                        <div class="col-12 p-2 trim_height text-center lime border-white green_color" style="justify-content: center;display: grid; border-top: 2px solid white;">
                                            <b>{{ $lang['3rd'] }}</b>
                                            <img src="{{ asset('images/3rd_trim.png') }}" alt="3rd trimester" class="mt-2" width="100px" style="max-height: 160px;">
                                        </div>
                                    </div>
                                    <div class="col-2 w-[8%] col-lg-1" style="border-right: 2px solid white;">
                                        <div class="col-12 text-center bg-gray border-white"><strong>{{ $lang['22'] }}</strong></div>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['one_t']))?$detail['one_t']:"light-orange orange_color") }}">1</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['two_t']))?$detail['two_t']:"light-orange orange_color") }}">2</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['three_t']))?$detail['three_t']:"light-orange orange_color") }}">3</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['four_t']))?$detail['four_t']:"lighter-blue text-blue") }}">4</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['five_t']))?$detail['five_t']:"lighter-blue text-blue") }}">5</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['six_t']))?$detail['six_t']:"lighter-blue text-blue") }}">6</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['seven_t']))?$detail['seven_t']:"light-lime green_color") }}">7</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['eight_t']))?$detail['eight_t']:"light-lime green_color") }}">8</b>
                                        <b  class="col-12 border-white week_height text-center {{ ((isset($detail['nine_t']))?$detail['nine_t']:"light-lime green_color") }}">9</b>
                                    </div>
                                    <div class="col-2 w-[8%] col-lg-1" style="border-right: 2px solid white;">
                                        <div class="col-12 text-center bg-gray border-white"><strong>{{ $lang['week'] }}</strong></div>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['one_t']))?$detail['one_t']:"light-orange orange_color") }}">0-4</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['two_t']))?$detail['two_t']:"light-orange orange_color") }}">5-8</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['three_t']))?$detail['three_t']:"light-orange orange_color") }}">9-13</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['four_t']))?$detail['four_t']:"lighter-blue text-blue") }}">14-17</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['five_t']))?$detail['five_t']:"lighter-blue text-blue") }}">18-21</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['six_t']))?$detail['six_t']:"lighter-blue text-blue") }}">22-27</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['seven_t']))?$detail['seven_t']:"light-lime green_color") }}">28-31</b>
                                        <b style="border-bottom: 2px solid white;" class="col-12 border-white week_height text-center {{ ((isset($detail['eight_t']))?$detail['eight_t']:"light-lime green_color") }}">32-35</b>
                                        <b class="col-12 border-white week_height text-center {{ ((isset($detail['nine_t']))?$detail['nine_t']:"light-lime green_color") }}">36-40</b>
                                    </div>
                                    <div class="col-4 w-[32%]" style="border-right: 2px solid white;">
                                        <div class="col-12 text-center bg-gray border-white"><strong>{{ $lang['24'] }}</strong></div>
                                        <div class="row p-2 text-[13px] border-white trim_height light-orange orange_color overflow-auto overflow-md-visible">
                                            <div class="col-lg-6 px-2 overflow-auto">
                                                <b>{{ $lang['27'] }}</b>
                                                <p class="font-s-12">
                                                    @php
                                                        $early=explode(',', $lang['28']);
                                                        foreach ($early as $key => $value) {
                                                            echo $value.'<br>';
                                                        }
                                                        @endphp
                                                </p>
                                            </div>
                                            <div class="col-lg-6 px-2 overflow-auto">
                                                <b>{{ $lang['29'] }}:</b>
                                                <p class="font-s-12">
                                                    @php
                                                        $early=explode(',', $lang['31']);
                                                        foreach ($early as $key => $value) {
                                                            echo $value.'<br>';
                                                        }
                                                        @endphp
                                                </p>
                                            </div>
                                            <div class="col-lg-6 px-2 d-none d-lg-block">
                                                <b>{{ $lang['30'] }}</b>
                                                <p class="font-s-12">
                                                    @php
                                                        $early=explode(',', $lang['32']);
                                                        foreach ($early as $key => $value) {
                                                            echo $value.'<br>';
                                                        }
                                                    @endphp
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row p-2 border-white trim_height lighter-blue text-blue overflow-auto" style="border-top: 2px solid white;border-bottom: 2px solid white;">
                                            <div class="col-12 px-2 overflow-auto">
                                                <b>{{ $lang['33'] }}</b>
                                                <p class="font-s-12">
                                                    @php
                                                        $early=explode(',', $lang['34']);
                                                        foreach ($early as $key => $value) {
                                                            echo $value.'<br>';
                                                        }
                                                    @endphp
                                                </p>
                                            </div>
                                            <div class="col-lg-6 px-2 overflow-auto">
                                                <b>{{ $lang['29'] }}:</b>
                                                <p class="font-s-12">
                                                    @php
                                                        $early=explode(',', $lang['35']);
                                                        foreach ($early as $key => $value) {
                                                            echo $value.'<br>';
                                                        }
                                                    @endphp
                                                </p>
                                            </div>
                                            <div class="col-lg-6 px-2 d-none d-lg-block">
                                                <b>{{ $lang['30'] }}</b>
                                                <p class="font-s-12">{{ $lang['36'] }}</p>
                                            </div>
                                        </div>
                                        <div class="row p-2 text-[14px] border-white trim_height light-lime green_color overflow-auto overflow-md-visible">
                                            <div class="col-lg-6 px-2 overflow-auto">
                                                <b>{{ $lang['37'] }}:</b>
                                                <p class="font-s-12">
                                                    @php
                                                        $early=explode(',', $lang['38']);
                                                        foreach ($early as $key => $value) {
                                                            echo $value.'<br>';
                                                        }
                                                    @endphp
                                                </p>
                                            </div>
                                            <div class="col-lg-6 px-2 overflow-auto">
                                                <b>{{ $lang['29'] }}:</b>
                                                <p class="font-s-12">
                                                    @php
                                                        $early=explode(',', $lang['39']);
                                                        foreach ($early as $key => $value) {
                                                            echo $value.'<br>';
                                                        }
                                                    @endphp
                                                </p>
                                            </div>
                                            <div class="col-lg-6 px-2 d-none d-lg-block">
                                                <b>{{ $lang['30'] }}:</b>
                                                <p class="font-s-12">{{ $lang['40'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 w-[32%]" style="border-right: 2px solid white;">
                                        <div class="col-12 text-center bg-gray border-white"><strong>{{ $lang['25'] }}</strong></div>
                                        <div class="col-12 p-2 border-white trim_height light-orange orange_color overflow-auto">
                                            <b>{{ $lang['41'] }}</b>
                                            <p class="font-s-12">
                                                @php
                                                    $early=explode(',', $lang['43']);
                                                    foreach ($early as $key => $value) {
                                                        echo $value.'<br>';
                                                    }
                                                @endphp
                                            </p>
                                            <b>{{ $lang['42'] }}</b>
                                            <p class="font-s-12">1/4" --> 209" & 0.8 oz</p>
                                        </div>
                                        <div class="col-12 p-2 text-blue border-white trim_height lighter-blue overflow-auto"  style="border-top: 2px solid white;border-bottom: 2px solid white;">
                                            <b>{{ $lang['41'] }}</b>
                                            <p class="font-s-12">
                                                @php
                                                    $early=explode(',', $lang['44']);
                                                    foreach ($early as $key => $value) {
                                                        echo $value.'<br>';
                                                    }
                                                @endphp
                                            </p>
                                            <b>{{ $lang['42'] }}</b>
                                            <p class="font-s-12">3.4" --> 1.5 oz & 14" & 1.7 lbs</p>
                                        </div>
                                        <div class="col-12 p-2 border-white trim_height light-lime green_color overflow-auto">
                                            <b>{{ $lang['41'] }}</b>
                                            <p class="font-s-12">
                                                @php
                                                    $early=explode(',', $lang['45']);
                                                    foreach ($early as $key => $value) {
                                                        echo $value.'<br>';
                                                    }
                                                @endphp
                                            </p>
                                            <b>{{ $lang['42'] }}</b>
                                            <p class="font-s-12">14.4" & 2.9 lbs --> 20.3" & 8.1 lbs</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row mt-3">
                                <!-- First container -->
                                <div class="w-full lg:w-full">
                                    <div id="container" class="rounded-lg w-full h-[400px]"></div>
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row mt-3">
                
                                  <!-- Second container -->
                                <div class="w-full lg:w-full mt-2">
                                    <div id="container1" style="overflow: auto !important;" class="rounded-lg w-full h-[400px]"></div>
                                </div>
                            </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        @if(isset($detail))
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var myChart = Highcharts.chart('container', {
                        chart: {
                            type: 'bar',
                            borderWidth: 1,
                            borderColor: '#D2D4D8',
                            borderRadius: 10,
                            backgroundColor: '#F6FAFC'
                        },
                        title: {
                            text: '{{ $lang['46'] }}'
                        },
                        xAxis: {
                            categories: ['{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 1 day')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 2 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 3 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 4 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 5 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 6 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 7 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 8 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 9 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 10 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 11 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 12 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 13 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 14 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 15 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 16 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 17 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 18 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 19 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 20 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 21 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 22 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 23 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 24 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 25 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 26 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 27 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 28 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 29 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 30 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 31 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 32 days')); !!}']
                        },
                        yAxis: {
                            title: {
                                text: null
                            },
                            labels: {
                                formatter: function () {
                                    return Math.abs(this.value) + '%';
                                }
                            }
                        },
                        tooltip: {
                            crosshairs: true,
                            shared: true,
                            valueSuffix: '%'
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -10,
                            y: 70,
                            floating: true,
                            borderWidth: 1,
                            backgroundColor:
                                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                            shadow: true
                        },
                        series: [{
                            name: '{{ $lang['48'] }}',
                            data: [1.4,1.3,1.4,1.9,2.4,2.1,2.7,3.1,2.8,2.9,3.8,4.0,4.0,4.6,6.9,5.2,4.5,4.3,4.0,4.1,4.2,4.0,3.1,2.4,2.3,1.7,1.3,1.1,0.7]
                        }]
                    });
                });
                document.addEventListener('DOMContentLoaded', function () {
                    var myChart = Highcharts.chart('container1', {
                        chart: {
                            type: 'line',
                            borderWidth: 1,
                            borderColor: '#D2D4D8',
                            borderRadius: 10,
                            backgroundColor: '#F6FAFC',
                          
                        },
                        title: {
                            text: '{{ $lang['47'] }}'
                        },
                        xAxis: {
                            categories: ['{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 1 day')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 2 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 3 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 4 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 5 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 6 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 7 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 8 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 9 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 10 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 11 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 12 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 13 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 14 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 15 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 16 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 17 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 18 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 19 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 20 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 21 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 22 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 23 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 24 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 25 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 26 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 27 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 28 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 29 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 30 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 31 days')); !!}','{!! date('M d',strtotime($detail['ovu_date'].' + 36 weeks + 32 days')); !!}']
                        },
                        yAxis: {
                            title: {
                                text: null
                            },
                            labels: {
                                formatter: function () {
                                    return Math.abs(this.value) + '%';
                                }
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            crosshairs: true,
                            shared: true,
                            valueSuffix: '%'
                        },
                        series: [{
                            name: '{{ $lang['49'] }}',
                            data: [10.8,12.1,13.5,15.4,17.9,19.9,22.6,26.6,28.4,31.4,35.2,39.3,43.3,47.9,{
                        y: 54.4,
                        marker: {
                            symbol: 'url({{ asset('images/birth.png') }})'
                        }
                    },60.0,64.5,68.8,72.8,76.8,81.0,85.1,88.2,90.7,93.0,94.7,96.0,97.1,97.8]
                        }]
                    });
                });
            </script>
         @endif
            
         <script>

            document.getElementById('method').addEventListener('change', function() {
                var method = this.value;
                updateDisplay(method);
            });

            function updateDisplay(method) {
                // Get the label element for displaying the class
                var classLabelElement = document.getElementById('class');
                
                // Define elements for each category
                var cycleElements = document.querySelectorAll('.cycle');
                var conceptionElements = document.querySelectorAll('.conception_date');
                var ivfElements = document.querySelectorAll('.ivf');
                var weekDayElements = document.querySelectorAll('.week_day');
                var gesAgeElements = document.querySelectorAll('.ges_age');

                // Hide all elements initially
                cycleElements.forEach(el => el.classList.add('hidden'));
                conceptionElements.forEach(el => el.classList.add('hidden'));
                ivfElements.forEach(el => el.classList.add('hidden'));
                weekDayElements.forEach(el => el.classList.add('hidden'));
                gesAgeElements.forEach(el => el.classList.add('hidden'));

                // Update the display based on the selected method
                if (method === "Last") {
                    classLabelElement.textContent = "{{ $lang['start_date'] }}:";
                    cycleElements.forEach(el => el.classList.remove('hidden'));
                } else if (method === 'Due') {
                    classLabelElement.textContent = "Due Date:";
                    conceptionElements.forEach(el => el.classList.remove('hidden'));
                } else if (method === 'Conception') {
                    classLabelElement.textContent = "{{ $lang['con'] }}:";
                    conceptionElements.forEach(el => el.classList.remove('hidden'));
                } else if (method === 'IVF') {
                    classLabelElement.textContent = "{{ $lang['ivf'] }}:";
                    ivfElements.forEach(el => el.classList.remove('hidden'));
                } else if (method === 'Ultrasound') {
                    classLabelElement.textContent = "{{ $lang['ultra'] }}:";
                    weekDayElements.forEach(el => el.classList.remove('hidden'));
                }
            }
        </script>
    @endpush
</form>