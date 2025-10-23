<style>
    #calculator{
        border-spacing: 0px;
    }
    .calculate{
        font-size: 15px !important;
        padding: 6px 10px !important;
    }
    fieldset {
        min-width: 0;
        padding: 0;
        margin: 0;
        border: 0;
        width: 60px;
    }
    .gray{
        color: gainsboro;
    }
    .bg-succes{
        background-color: #99EA48;
    }
    .calculator-wrapper {
        background: #fff;
        border-radius: 4px;
        overflow-x: hidden;
    }
    #name-input,
    #date-input {
        border: 1px solid #53565a;
        color: #000;
        height: 40px;
        max-width: 100%;
        width: 100%;
        border-radius: 3px;
        padding: 0px 5px
    }

    input[type=number] , select {
        background: #fff;
        border: 1px solid #53565a;
        border-radius: 4px!important;
        color: #53565a;
        height: 30px;
        line-height: 1.2;
        outline: 0;
        padding: 0;
        text-align: center;
        width: 50px;
        margin: 0px 2px;
    }

    input[type=number]:focus {
        outline-color: #99EA48 !important;
    }

    #calculator tbody tr:nth-child(2n) {
        background: rgba(255, 255, 255, 0.819)!important;
    }

    #calculator tr td {
        border: none;
        padding: 10px;
        position: relative;
        display: inline-flex
;
    }

    #calculator tbody td:last-of-type {
        text-align: right;
    }

    .table-header {
        background: #99EA48;
    }

    .table-footer {
        background: #ededed;
        border-radius: 0 0 4px 4px;
        color: #53565a;
        display: flex;
        line-height: 1;
        margin-bottom: 35px;
    }

    .total-hours {
        font-size: 22px;
        font-weight: 700;
        padding: 20px;
        /* text-align: right; */
    }
    span.colon-separator {
        padding: 0 5px;
    }

    /* div.flex {
        text-align: left;
        width: 100%;
    }
     */
    @media screen and (max-width: 920px) {
        #calculator tbody tr {
            display: flex;
            flex-direction: column;
        }
    }
    @media screen and (max-width: 920px) {
        #calculator tbody td {
            padding: 5px 0;
        }
    }
    .gap-2{
        gap: 5px;
    }
    .dowload_PDF_CSV {
        position: absolute;
        text-align: center;
        top: -39px;
        right: 41.5%;
        background-color: #99EA48;
    }
    @media screen and (max-width : 550px){
        .table-header{
            display: none !important;
        }
        .text-start{
            text-align: start !important;
        }
    }
    .bg-result-blue{
        background-color: #99EA48;
    }
</style>
@php
    $request = request();
@endphp
<form class="text-start" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 bg-white rounded-lg shadow-md space-y-6 mb-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[100%] md:w-[100%] w-full mx-auto ">
        
        <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[80%] w-full mb-4">
            <div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  imperial" id="imperial">
                        <a href="{{url('time-card-calculator')}}">  Time Card</a>
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric tagsUnit" id="metric">
                        <a href="{{url('time-card-advance-calculator')}}">  Time Card Advance</a>
                    </div>
                </div>
            </div>  
        </div>
            
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                
                <div class=" col-span-12 printable-content row relative">
                    <div class="col-lg-12 mx-auto result ">
                        <div class="row">
                            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                                <div class="col-span-12 md:col-span-6 lg:col-span-6 header-input-fields">
                                    {{$lang['1n'] ?? "Name"}}
                                    <input type="text" class="input py-2" id="name" name="name-input" value="" placeholder="Jhon" onfocus="this.placeholder=''" onblur="this.placeholder=placeholder || 'Jhon'" >
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 header-input-fields" id="date-input-wrapper">
                                    {{$lang['2n'] ?? "Date"}}
                                    <input type="date"  class="input py-2" id="date" name="date-input" value="{{date('Y-m-d')}}">
                                </div>

                            </div>
                            {{-- table --}} 
                            <table id="calculator" class="responsive text-[14px] mt-2 w-full">
                                <tbody class="grid grid-cols-12">
                                    <tr class="table-header col-span-12 p-2 radius-2 mt-2 ">
                                        <td width="12%">{{$lang['3n'] ?? "Day"}}</td>
                                        <td width="25%">{{$lang['4n'] ?? "Starting Time"}}</td>
                                        <td width="25%">{{$lang['5n'] ?? "Ending Time"}}</td>
                                        <td width="20%"> {{$lang['6n'] ?? "Break Deduction"}} </td>
                                        <td width="">{{$lang['7n'] ?? "Total"}}</td>
                                    </tr>
                                    <tr class="col-span-12">
                                        <td width="12%"  class="flex">Monday</td>
                                        <td class="flex">
                                            <input type="number" id="hours1" name="hours1" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="minut1" name="minut1" min="1" max="59"/>
                                            <div class="form-group-calculator d-inline">
                                                <select name="start_time1" id="start_time1">
                                                    <option value="AM" selected>AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Starting Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" id="ehours1" name="hours1" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="eminut1" name="minut1" min="1" max="59">
                                            <div class="form-group-calculator d-inline">
                                                <select name="end_time1" id="end_time1">
                                                    <option value="AM" >AM</option>
                                                    <option value="PM" selected="">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Ending Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" name="break_h1" id="break_h1">
                                            <span class="colon-separator">:</span>
                                            <input type="number" name="break_m1" id="break_m1">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Break Deduction</span>
                                        </td>
                                        <td class="text-start  {{$device == 'mobile' ? 'flex gap-2' : ''}}">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block mobile-label-total">Total Hours: </span>
                                            <div class="fw-bold"  id="stot1"></div>
                                        </td>
                                    </tr>                            
                                    <tr class="col-span-12">
                                        <td width="12%" class="flex">Tuesday</td>
                                        <td class="flex">
                                            <input type="number" id="hours2" name="hours2" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="minut2" name="minut2" min="1" max="59"/>
                                            <div class="form-group-calculator d-inline">
                                                <select name="start_time2" id="start_time2">
                                                    <option value="AM" selected>AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Starting Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" id="ehours2" name="hours4" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="eminut2" name="minut4" min="1" max="59">
                                            <div class="form-group-calculator d-inline">
                                                <select name="end_time2" id="end_time2">
                                                    <option value="AM" >AM</option>
                                                    <option value="PM" selected="">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Ending Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" name="break_h2" id="break_h2">
                                            <span class="colon-separator">:</span>
                                            <input type="number" name="break_m2" id="break_m2">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Break Deduction</span>
                                        </td>
                                        <td class="text-start  {{$device == 'mobile' ? 'flex gap-2' : ''}}">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block mobile-label-total">Total Hours: </span>
                                            <div class="fw-bold"  id="stot2"></div>
                                        </td>
                                    </tr>                            
                                    <tr class="col-span-12">
                                        <td width="12%" class="flex">Wednesday</td>
                                        <td class="flex">
                                            <input type="number" id="hours3" name="hours5" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="minut3" name="minut5" min="1" max="59"/>
                                            <div class="form-group-calculator d-inline">
                                                <select name="start_time3" id="start_time3">
                                                    <option value="AM" selected>AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Starting Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" id="ehours3" name="hours6" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="eminut3" name="minut6" min="1" max="59">
                                            <div class="form-group-calculator d-inline">
                                                <select name="end_time3" id="end_time3">
                                                    <option value="AM" >AM</option>
                                                    <option value="PM" selected="">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Ending Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" name="break_h3" id="break_h3">
                                            <span class="colon-separator">:</span>
                                            <input type="number" name="break_m3" id="break_m3">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Break Deduction</span>
                                        </td>
                                        <td class="text-start  {{$device == 'mobile' ? 'flex gap-2' : ''}}">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block mobile-label-total">Total Hours: </span>
                                            <div class="fw-bold"  id="stot3"></div>
                                        </td>
                                    </tr>                           
                                    <tr class="col-span-12">
                                        <td width="12%" class="flex">Thursday</td>
                                        <td class="flex">
                                            <input type="number" id="hours4" name="hours7" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="minut4" name="minut7" min="1" max="59"/>
                                            <div class="form-group-calculator d-inline">
                                                <select name="start_time4" id="start_time4">
                                                    <option value="AM" selected>AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Starting Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" id="ehours4" name="hours8" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="eminut4" name="minut8" min="1" max="59">
                                            <div class="form-group-calculator d-inline">
                                                <select name="end_time4" id="end_time4">
                                                    <option value="AM" >AM</option>
                                                    <option value="PM" selected="">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Ending Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" name="break_h4" id="break_h4">
                                            <span class="colon-separator">:</span>
                                            <input type="number" name="break_m4" id="break_m4">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Break Deduction</span>
                                        </td>
                                        <td class="text-start  {{$device == 'mobile' ? 'flex gap-2' : ''}}">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block mobile-label-total">Total Hours: </span>
                                            <div class="fw-bold"  id="stot4"></div>
                                        </td>
                                    </tr>                           
                                    <tr class="col-span-12">
                                        <td width="12%" class="flex">Friday</td>
                                        <td class="flex">
                                            <input type="number" id="hours5" name="hours9" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="minut5" name="minut9" min="1" max="59"/>
                                            <div class="form-group-calculator d-inline">
                                                <select name="start_time5" id="start_time5">
                                                    <option value="AM" selected>AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Starting Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" id="ehours5" name="hours10" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="eminut5" name="minut10" min="1" max="59">
                                            <div class="form-group-calculator d-inline">
                                                <select name="end_time5" id="end_time5">
                                                    <option value="AM" >AM</option>
                                                    <option value="PM" selected="">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Ending Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" name="break_h5" id="break_h5">
                                            <span class="colon-separator">:</span>
                                            <input type="number" name="break_m5" id="break_m5">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Break Deduction</span>
                                        </td>
                                        <td class="text-start  {{$device == 'mobile' ? 'flex gap-2' : ''}}">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block mobile-label-total">Total Hours: </span>
                                            <div class="fw-bold"  id="stot5"></div>
                                        </td>
                                    </tr>
                                    <tr class="col-span-12">
                                        <td width="12%" class="flex">Saturday</td>
                                        <td class="flex">
                                            <input type="number" id="hours6" name="hours11" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="minut6" name="minut11" min="1" max="59"/>
                                            <div class="form-group-calculator d-inline">
                                                <select name="start_time6" id="start_time6">
                                                    <option value="AM" selected>AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Starting Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" id="ehours6" name="hours12" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="eminut6" name="minut12" min="1" max="59">
                                            <div class="form-group-calculator d-inline">
                                                <select name="end_time6" id="end_time6">
                                                    <option value="AM">AM</option>
                                                    <option value="PM" selected="">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Ending Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" name="break_h6" id="break_h6">
                                            <span class="colon-separator">:</span>
                                            <input type="number" name="break_m6" id="break_m6">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Break Deduction</span>
                                        </td>
                                        <td class="text-start  {{$device == 'mobile' ? 'flex gap-2' : ''}}">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block mobile-label-total">Total Hours: </span>
                                            <div class="fw-bold"  id="stot6"></div>
                                        </td>
                                    </tr>
                                    <tr class="col-span-12">
                                        <td width="12%" class="flex">Sunday</td>
                                        <td class="flex">
                                            <input type="number" id="hours7" name="hours13" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="minut7" name="minut13" min="1" max="59"/>
                                            <div class="form-group-calculator d-inline">
                                                <select name="start_time7" id="start_time7">
                                                    <option value="AM" selected>AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Starting Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" id="ehours7" name="hours7" min="0" max="12"/>
                                            <span class="colon-separator">:</span>
                                            <input type="number" id="eminut7" name="minut7" min="1" max="59">
                                            <div class="form-group-calculator d-inline">
                                                <select name="end_time7" id="end_time7">
                                                    <option value="AM" selected>AM</option>
                                                    <option value="PM" selected="">PM</option>
                                                </select>
                                            </div>
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Ending Time</span>
                                        </td>
                                        <td class="flex">
                                            <input type="number" name="break_h7" id="break_h7">
                                            <span class="colon-separator">:</span>
                                            <input type="number" name="break_m7" id="break_m7">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block">Break Deduction</span>
                                        </td>
                                        <td class="text-start  {{$device == 'mobile' ? 'flex gap-2' : ''}}">
                                            <span class="mobile-only mobile-label lg:hidden d-inline-block mobile-label-total">Total Hours: </span>
                                            <div class="fw-bold"  id="stot7"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- result --}}
                            <div class="rounded-lg p-2 d-m flex bg-result-blue mb-2 text-[16px]">
                                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-3 lg:col-span-3 px-1 d-block  mt-md-0 mt-1"> 
                                        <span class="mb-0">{{$lang['8n'] ?? "Total Hours"}}: </span>
                                        <span class="mb-0" id="finalTime">00</span>
                                    </div>
                                    <div class="col-span-12 md:col-span-3 lg:col-span-3 px-1 hidden overtime  mt-md-0 mt-1"> 
                                        <span class="mb-0">{{$lang['9n'] ?? "Overtime Pay" }}: </span>
                                        <span class="mb-0" id="overtime_pay">$00</span>
                                    </div>
                                    <div class="col-span-12 md:col-span-3 lg:col-span-3 px-1 hidden overtime  mt-md-0 mt-1"> 
                                        <span class="mb-0">{{$lang['10n'] ?? "Overtime Hours"}}: </span>
                                        <span class="mb-0" id="overtime_hours">00</span>
                                    </div>
                                    <div class="col-span-12 md:col-span-3 lg:col-span-3 px-1 hidden gross  mt-md-0 mt-1"> 
                                        <span class="mb-0">{{$lang['11n'] ?? "Total Gross Pay"}}: </span>
                                        <span class="mb-0" id="GrosPrice">$00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- advance option --}}
                <div class=" col-span-12 row border rounded-lg py-2 text-[14px]">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12 md:col-span-4 lg:col-span-4 flex items-center gap-2">
                            <input type="checkbox" name="cal_gross" id="cal_gross">
                            <label for="cal_gross">{{$lang['12n'] ?? "Calculate Total Gross Wages"}}</label>
                        </div>
                        @if($device == 'mobile')
                            <div class="col-md ps-3 mt-1">
                                <div class="my-2 gross hidden items-center gap-2">
                                $ <input type="number" id="price" size="6" maxlength="8" value="" style="width: 65px"> /hour
                                </div>
                            </div>
                        @endif
                        <div class="col-span-12 md:col-span-4 lg:col-span-4 flex items-center gap-2">
                            <input type="checkbox" name="working_hr" id="working_hr">
                            <label for="working_hr">{{$lang['13n'] ?? "Include Gross Overtime Wages"}}</label>
                        </div>
                        @if($device == 'mobile')
                            <div class="w-full ps-3 my-1 shows hidden">
                                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4  items-center">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6 gap-2 mt-5">
                                        <input type="number" id="working_hours" value="8" placeholder="8" class="my-2">
                                        <select name="" id="working_period" class="border-dark my-2" style="width:120px;">
                                            <option value="day">{{$lang['14n'] ?? "Hours per day"}}</option>
                                            <option value="week">{{$lang['15n'] ?? "Hours per week"}}</option>
                                        </select>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6 ps-3 my-1 overtime hidden">
                                        <label for="bi_weekly">{{$lang['16n'] ?? "Overtime rate"}}:</label>
                                        <div>    
                                            <input type="number" id="Overtime" value="1.5" placeholder="1.5" class="my-2"> times base rate
                                        </div>
                                    </div>
                                </div>
                                <p>{{$lang['overtime_key'] ?? 'Overtime: Reg. x 1.5 after 09 hrs/day'}}</p>
                            </div>
                        @endif
                        <div class="col-span-12 md:col-span-4 lg:col-span-4 ps-md-3 my-1 flex items-center gap-2">
                            <input type="checkbox" name="bi_weekly" id="bi_weekly">
                            <label for="bi_weekly">{{$lang['17n'] ?? "Switch to Bi-Weekly"}} </label>
                        </div>
                    </div>
                    @if($device == 'desktop')
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12 md:col-span-4 lg:col-span-4 ps-3 my-1">
                            <div class="my-2 gross hidden items-center gap-2">
                            $ <input type="number" id="price" size="6" maxlength="8" value="" style="width: 65px"> /hour
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-8 lg:col-span-8 ps-3 my-1 shows hidden">
                            <div class="flex items-center">
                                <div class="gap-2 mt-5">
                                    <input type="number" id="working_hours" value="8" placeholder="8" class="my-2">
                                    <select name="" id="working_period" class="border-dark my-2" style="width:120px;">
                                        <option value="day">{{$lang['14n'] ?? "Hours per day"}}</option>
                                        <option value="week">{{$lang['15n'] ?? "Hours per week"}}</option>
                                    </select>
                                </div>
                                <div class="col-md ps-3 my-1 overtime hidden">
                                    <label for="bi_weekly">{{$lang['16n'] ?? "Overtime rate"}}:</label>
                                    <div>    
                                        <input type="number" id="Overtime" value="1.5" placeholder="1.5" class="my-2"> times base rate
                                    </div>
                                </div>
                            </div>
                            <p>{{$lang['overtime_key'] ?? 'Overtime: Reg. x 1.5 after 09 hrs/day'}}</p>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-span-12 text-center me-2 mt-4 relative">
                    {{-- <button type="button" class="calculate bg-black text-[#99EA48] rounded-lg" id="printpage">{{$lang['18n'] ?? "Print"}}</button> --}}
                    <button type="button" class="calculate bg-black text-[#99EA48] rounded-lg" id="save">{{$lang['19n'] ?? "download"}}
                        <div class="dowload_PDF_CSV px-2 py-1 rounded-lg hidden">
                            <p class="cursor-pointer text-[14px] d-block text-black py-1" id="downloadCSV" onclick="generateExcel()">{{$lang['19csv'] ?? "download CSV"}}</p>
                            {{-- <p class="cursor-pointer text-[14px] d-block text-black border-b-dark py-1" onclick="downloadPDF()">{{$lang['19pdf'] ?? "download PDF"}}</p> --}}
                        </div>
                    </button>
                    <button type="button" class="calculate bg-[#99EA48] rounded-lg" id="resetButton3">{{$lang['20n'] ?? "Rest"}}</button>
                </div>
        </div>
    </div>
  
    @if ($type=='widget')
    @include('inc.widget-button')
     @endif
 </div>

        
</form>

@push('calculatorJS')
    <script>
        function addRowsForExtraWeek() {
            const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            const tableBody = document.querySelector('#calculator tbody');
            const startIndex = 8;
            days.forEach((day, index) => {
                const row = document.createElement('tr');
                row.classList.add('col-span-12', 'px-md-0');
                row.setAttribute('data-week', '2');
                row.innerHTML = `
                    <td width="12%"  class="flex">${day}</td>
                    <td width="24%" class="flex">
                        <input type="number" id="hours${startIndex + index}" name="hours${startIndex + index}" min="0" max="12"/>
                        <span class="colon-separator">:</span>
                        <input type="number" id="minut${startIndex + index}" name="minut${startIndex + index}" min="1" max="59"/>
                        <div class="form-group-calculator d-inline">
                            <select name="start_time${startIndex + index}" id="start_time${startIndex + index}">
                                <option value="AM" selected>AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
                        <span class="mobile-only mobile-label lg:hidden d-inline-block">Starting Time</span>
                    </td>
                    <td width="25%" class="flex">
                        <input type="number" id="ehours${startIndex + index}" name="ehours${startIndex + index}" min="0" max="12"/>
                        <span class="colon-separator">:</span>
                        <input type="number" id="eminut${startIndex + index}" name="eminut${startIndex + index}" min="1" max="59">
                        <div class="form-group-calculator d-inline">
                            <select name="end_time${startIndex + index}" id="end_time${startIndex + index}">
                                <option value="AM">AM</option>
                                <option value="PM" selected>PM</option>
                            </select>
                        </div>
                        <span class="mobile-only mobile-label lg:hidden d-inline-block">Ending Time</span>
                    </td>
                    <td width="17%" class="flex">
                        <input type="number" name="break_h${startIndex + index}" id="break_h${startIndex + index}">
                        <span class="colon-separator">:</span>
                        <input type="number" name="break_m${startIndex + index}" id="break_m${startIndex + index}">
                        <span class="mobile-only mobile-label lg:hidden d-inline-block">Break Deduction</span>
                    </td>
                    <td class="text-start  {{$device == 'mobile' ? 'flex gap-2' : ''}}">
                        <span class="mobile-only mobile-label lg:hidden d-inline-block mobile-label-total">Total Hours: </span>
                        <div class="fw-bold gray" id="stot${startIndex + index}" class="gray">00h 0m</div>
                    </td>
                `;
                tableBody.appendChild(row);
                var inputFields = document.querySelectorAll('input[type=number]');
                inputFields.forEach(input => {
                    input.placeholder = this.placeholder || '00';
                })
                inputFields.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.placeholder = '';
                    });
                    input.addEventListener('blur', function() {
                        this.placeholder = this.placeholder || '00';
                    });
                }); 
            });
        }
        function removeRowsForExtraWeek() {
            const tableBody = document.querySelector('#calculator tbody');
            const extraWeekRows = tableBody.querySelectorAll('tr[data-week="2"]');
            
            extraWeekRows.forEach(row => {
                tableBody.removeChild(row);
            });
        }
    </script>
    <script>
        var inputFields = document.querySelectorAll('input[type=number]');
        inputFields.forEach(input => {
            input.placeholder = this.placeholder || '00';
        })
        inputFields.forEach(input => {
            input.addEventListener('focus', function() {
                this.placeholder = '';
            });
            input.addEventListener('blur', function() {
                this.placeholder = this.placeholder || '00';
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('working_hr');
            const showElement = document.querySelector('.shows');
            const overtime = document.querySelectorAll('.overtime');
            const cal_gross = document.getElementById('cal_gross');
            const gross = document.querySelectorAll('.gross');
            const bi_weekly = document.getElementById('bi_weekly');

            checkbox.addEventListener('click', function() {
                if (checkbox.checked) {
                    showElement.classList.add('d-block');
                    showElement.classList.remove('hidden');
                    overtime.forEach(element => {
                        element.classList.add('d-block');
                    });
                    overtime.forEach(element => {
                        element.classList.remove('hidden');
                    });
                } else {
                    showElement.classList.add('hidden');
                    showElement.classList.remove('d-block');
                    overtime.forEach(element => {
                        element.classList.add('hidden');
                    });
                    overtime.forEach(element => {
                        element.classList.remove('d-block');
                    });
                }
            });
            bi_weekly.addEventListener('click', function() {
                if (bi_weekly.checked) {
                    addRowsForExtraWeek();
                } else {
                    removeRowsForExtraWeek();
                }
            });
            cal_gross.addEventListener('click', function() {
                if (cal_gross.checked) {
                    gross.forEach(element => {
                        element.classList.add('flex');
                    });
                    gross.forEach(element => {
                        element.classList.remove('hidden');
                    });
                } else {
                    gross.forEach(element => {
                        element.classList.add('hidden');
                    });
                    gross.forEach(element => {
                        element.classList.remove('flex');
                    });
                }
            });
        });
        const totalHoursArray = [];
        const totalMinutesArray = [];

        function calculateTotalHours(i) {
            let totalMinutes = 0;
            const startHour = parseInt(document.querySelector(`#hours${i}`).value) || 0;       
            const startMinute = parseInt(document.querySelector(`#minut${i}`).value) || 0;
            const startAmpm = document.querySelector(`#start_time${i}`).value;

            const endHour = parseInt(document.querySelector(`#ehours${i}`).value) || 0;
            const endMinute = parseInt(document.querySelector(`#eminut${i}`).value) || 0;
            const endAmpm = document.querySelector(`#end_time${i}`).value;

            const breakHour = parseInt(document.querySelector(`#break_h${i}`).value) || 0;
            const breakMinute = parseInt(document.querySelector(`#break_m${i}`).value) || 0;

            const startTotalMinutes = convertToMinutes(startHour, startMinute, startAmpm);
            const endTotalMinutes = convertToMinutes(endHour, endMinute, endAmpm);
            const breakTotalMinutes = (breakHour * 60) + breakMinute;

            let dayTotalMinutes = endTotalMinutes - startTotalMinutes - breakTotalMinutes;
            const totalHours = Math.floor(dayTotalMinutes / 60);
            const totalMinutesForDay = dayTotalMinutes % 60;

            totalHoursArray[i - 1] = totalHours;
            totalMinutesArray[i - 1] = totalMinutesForDay;

            var stot = document.querySelector(`#stot${i}`);
            stot.innerText = `${totalHours}h ${totalMinutesForDay}m`;
            stot.classList.remove('gray');
            updateTotalSum();
        }

        function convertToMinutes(hour, minute, ampm) {
            if (ampm === "PM" && hour !== 12) {
                hour += 12;
            } else if (ampm === "AM" && hour === 12) {
                hour = 0;
            }
            return (hour * 60) + minute;
        }

        function updateTotalSum() {
            let totalHours = 0;
            let totalMinutes = 0;
            let overtimeHours = 0;

            const workingHoursInput = document.querySelector('#working_hours');
            const workingHours = parseFloat(workingHoursInput.value) || 0;
            const workingPeriod = document.querySelector('#working_period').value;
            const isWorkingHoursChecked = document.querySelector('#working_hr').checked;

            for (let i = 0; i < totalHoursArray.length; i++) {
                let dayHours = totalHoursArray[i] || 0;
                let dayMinutes = totalMinutesArray[i] || 0;
                let dayTotalMinutes = (dayHours * 60) + dayMinutes;

                if (isWorkingHoursChecked && workingPeriod === 'day') {
                    if (dayTotalMinutes > workingHours * 60) {
                        overtimeHours += (dayTotalMinutes - (workingHours * 60)) / 60;
                        dayTotalMinutes = workingHours * 60;
                    }
                }

                totalHours += Math.floor(dayTotalMinutes / 60);
                totalMinutes += dayTotalMinutes % 60;
            }

            totalHours += Math.floor(totalMinutes / 60);
            totalMinutes = totalMinutes % 60;

            document.querySelector('#finalTime').innerText = `${totalHours}h ${totalMinutes}m`;
            document.querySelector('#overtime_hours').innerText = `${overtimeHours.toFixed(2)}h`;

            calculateGrossPrice(totalHours, totalMinutes, overtimeHours);
        }

        function calculateGrossPrice(totalHours, totalMinutes, overtimeHours) {
            var price = parseFloat(document.querySelector('#price').value);
            if (!isNaN(price)) {
                var GrosPrice = document.querySelector('#GrosPrice');
                var totalGrosPrice = (price * totalHours) + ((price / 60) * totalMinutes);
                
                var overtimeRate = parseFloat(document.querySelector('#Overtime').value) || 0;
                let overtimePay = overtimeHours * price * overtimeRate;

                let totalGrossPay = totalGrosPrice + overtimePay;
                GrosPrice.innerText = "$"+totalGrossPay.toFixed(2); 
                document.querySelector('#overtime_pay').innerText = "$"+overtimePay.toFixed(2);

                console.log('Gross Price:', totalGrosPrice);
                console.log('Overtime Hours:', overtimeHours);
                console.log('Overtime Pay:', overtimePay);
                console.log('Total Gross Pay (including Overtime):', totalGrossPay);
            }
        }

        for (let i = 1; i <= 14; i++) {
            const inputs = [
                { id: `hours${i}`, max: 11 },
                { id: `minut${i}`, max: 59 },
                { id: `ehours${i}`, max: 11 },
                { id: `eminut${i}`, max: 59 },
                { id: `break_h${i}`, max: 23 },
                { id: `break_m${i}`, max: 59 }
            ];

            inputs.forEach(input => {
                const element = document.querySelector(`#${input.id}`);
                if (element) {
                    element.addEventListener('input', function () {
                        const inputValue = parseFloat(this.value);
                        if (inputValue > input.max) {
                            this.value = input.max;
                        }
                    });
                }
            });
        }

        for (let i = 1; i <= 7; i++) {
            document.querySelector(`#hours${i}`).addEventListener('input', function() {
                calculateTotalHours(i);
            });
            document.querySelector(`#ehours${i}`).addEventListener('input', function() {
                calculateTotalHours(i);
            });

            document.querySelector(`#eminut${i}`).addEventListener('input', function() {
                calculateTotalHours(i);
            });
            document.querySelector(`#minut${i}`).addEventListener('input', function() {
                calculateTotalHours(i);
            });

            document.querySelector(`#break_h${i}`).addEventListener('input', function() {
                calculateTotalHours(i);
            });

            document.querySelector(`#break_m${i}`).addEventListener('input', function() {
                calculateTotalHours(i);
            });
            document.querySelector(`#stot${i}`).innerText = `00h 0m`;
            document.querySelector(`#stot${i}`).classList.add('gray');
        }

        document.querySelector('#price').addEventListener('input', function() {
            updateTotalSum();
        });

        document.querySelector('#working_hours').addEventListener('input', function() {
            updateTotalSum();
        });

        document.querySelector('#Overtime').addEventListener('input', function() {
            updateTotalSum();
        });

        document.querySelector('#working_hr').addEventListener('change', function() {
            const isChecked = this.checked;
            const workingHoursSection = document.querySelector('.show');
            // if (isChecked) {
            //     workingHoursSection.classList.remove('hidden');
            // } else {
            //     workingHoursSection.classList.add('hidden');
            // }
            updateTotalSum();
        });

        document.querySelector('#cal_gross').addEventListener('change', function() {
            const isChecked = this.checked;
            const grossSection = document.querySelector('.gross');
            if (isChecked) {
                grossSection.classList.remove('hidden');
            } else {
                grossSection.classList.add('hidden');
            }
            updateTotalSum();
        });

        function calculateOvertimeHours(totalHours, totalMinutes) {
            const workingHours = parseFloat(document.querySelector('#working_hours').value) || 0;
            const workingPeriod = document.querySelector('#working_period').value;
            let overtimeHours = 0;

            if (workingPeriod === 'day') {
                const standardDailyHours = workingHours * 7;
                overtimeHours = Math.max(0, (totalHours + (totalMinutes / 60)) - standardDailyHours);
            } else if (workingPeriod === 'week') {
                const standardWeeklyHours = workingHours;
                overtimeHours = Math.max(0, (totalHours + (totalMinutes / 60)) - standardWeeklyHours);
            }
            return overtimeHours;
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    <script src="{{ url('js/html2pdf.bundle.js') }}"></script>
    <script>
        document.getElementById('save').addEventListener('click',function(){
            document.querySelector('.dowload_PDF_CSV').classList.toggle('hidden');
        });
        function downloadPDF(){
            var n = document.querySelector('.result');
            html2pdf().from(n).set({
                margin: [15, 5, 5, 5],
                filename: "Time Card Calculator Result by calculator-online.net.pdf",
                image: {
                    type: "jpeg",
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    logging: !0,
                    dpi: 192,
                    letterRendering: !0,
                },
                jsPDF: {
                    unit: "mm",
                    format: "a4",
                    orientation: "p"
                },
                pagebreak: {
                    before: ".page-break",
                    avoid: "table"
                },
            }).toPdf().get("pdf").then(function(e) {
                var t = e.internal.getNumberOfPages();
                for (let pageNumber = 1; pageNumber <= t; pageNumber++) {
                    e.setPage(pageNumber);
                    e.setFontSize(8);
                    e.setTextColor(150);
                    e.text(15, 15, "Results from");
                    e.setTextColor(0, 0, 255);
                    e.textWithLink(" thetimecalculator.org", 31, 15, {
                        url: "https://thetimecalculator.org/"
                    });
                    var allMathText = "thetimecalculator.og " + pageNumber + "/" + t;
                    var allMathTextWidth = e.getStringUnitWidth(allMathText) * 8;
                    e.textWithLink(allMathText, e.internal.pageSize.getWidth() - 65 - allMathTextWidth, e.internal.pageSize.getHeight() - 8, {
                        url: "https://thetimecalculator.org/"
                    });
                }
            }).save().catch((e)=>{});
        };
        
        document.getElementById('resetButton3').addEventListener('click', function(event) {
            event.preventDefault();
            var inputs = document.querySelectorAll('input[type="number"]');
            inputs.forEach(function(input) {
                if (input.type !== 'hidden') {
                    input.value = ''; 
                }
                for (let i = 0; i <= 14; i++) {
                    document.querySelectorAll(`#stot${i}`).forEach(element => {
                        element.innerText = "00h 0m";
                        element.classList.add('gray');
                    });   
                }
            });
        });

        document.getElementById('printpage').addEventListener('click', function() {
            var contentToPrint = document.querySelector('.printable-content').cloneNode(true);
            contentToPrint.querySelectorAll('input').forEach(function(input) {
                input.setAttribute('value', input.value);
            });

            var mywindow = window.open('', 'PRINT', 'height=1000,width=auto');
            mywindow.document.write('<html><head><title></title>');
            mywindow.document.write(
                `<style>
                    body * {
                        visibility: hidden;
                    }
                    .result, .result * {
                        visibility: visible;
                    }
                    .mobile-label {
                        display: none;
                    }
                    .mobile-label-total {
                        display: none;
                    }
                    #calculator {
                        width: 100% !important;
                        border-spacing: 0px;
                    }
                    #calculator tr, td {
                        border: 1px solid black !important;
                        color: black !important;
                        text-align: center !important;
                        padding: 8px;
                    }
                    .table-header {
                        background-color: white !important;
                    }
                    .bg-gradient {
                        background-color: white !important;
                    }
                    input[type="number"]::-webkit-inner-spin-button,
                    input[type="number"]::-webkit-outer-spin-button {
                        -webkit-appearance: none; /* Hides the up/down buttons */
                        margin: 0; /* Ensures no extra space is left */
                    }
                    .flex {
                        display: flex;
                    }
                    .justify-between {
                        justify-content: space-between;
                    }
                    input[type=number] {
                        width: 40px;
                        border: 0px;
                    }
                    .d-inline {
                        display: inline;
                    }
                    .mt-2 {
                        margin-top: 1rem;
                    }
                    .hidden {
                        display: none;
                    }
                    .d-block {
                        display: block;
                    }
                    .bg-gradient div {
                        border: 1px solid black;
                        padding: 5px;
                    }
                    .bg-gradient {
                        margin-top: 10px;
                    }
                    .col-md {
                        flex: 1 0 0%;
                    }
                </style>`
            );
            mywindow.document.write('</head><body>');
            mywindow.document.write(contentToPrint.outerHTML);
            mywindow.document.write(
                '<p>This Report is generated by <span style="color: #4277ac;"> <a href="{{ url()->current() }}">{{ url()->current() }}</a></span></p>'
            );
            mywindow.document.write('</body></html>');
            mywindow.document.close();
            mywindow.print();
            mywindow.close();
        });

        function generateExcel() {
            var workbook = XLSX.utils.book_new();
                var worksheet_data = [];
                worksheet_data.push([
                    "Name: ", document.getElementById('name').value, "Date: ", document.getElementById('date').value
                ]);
                worksheet_data.push([
                    "Day", "Starting Time", "Ending Time", "Break Deduction", "Total"
                ]);
                const bi_weekly = document.getElementById('bi_weekly');

                if (bi_weekly.checked) {
                    for (var i = 0; i < 14; i++) {
                        var day = getDayName(i); 
                        var startHour = document.getElementById('hours' + (i + 1)).value;
                        var startMin = document.getElementById('minut' + (i + 1)).value;
                        var startAmPm = document.getElementById('start_time' + (i + 1)).value;

                        var endHour = document.getElementById('ehours' + (i + 1)).value;
                        var endMin = document.getElementById('eminut' + (i + 1)).value;
                        var endAmPm = document.getElementById('end_time' + (i + 1)).value;

                        var breakHour = document.getElementById('break_h' + (i + 1)).value;
                        var breakMin = document.getElementById('break_m' + (i + 1)).value;

                        var total = document.getElementById('stot' + (i + 1)).innerText;
                        worksheet_data.push([
                            day,
                            startHour + ":" + startMin + " " + startAmPm,
                            endHour + ":" + endMin + " " + endAmPm,
                            breakHour + ":" + breakMin,
                            total
                        ]);
                    }
                }else{
                    for (var i = 0; i < 7; i++) {
                        var day = getDayName(i); // Get the name of the day (e.g., Monday, Tuesday, etc.)
                        var startHour = document.getElementById('hours' + (i + 1)).value;
                        var startMin = document.getElementById('minut' + (i + 1)).value;
                        var startAmPm = document.getElementById('start_time' + (i + 1)).value;

                        var endHour = document.getElementById('ehours' + (i + 1)).value;
                        var endMin = document.getElementById('eminut' + (i + 1)).value;
                        var endAmPm = document.getElementById('end_time' + (i + 1)).value;

                        var breakHour = document.getElementById('break_h' + (i + 1)).value;
                        var breakMin = document.getElementById('break_m' + (i + 1)).value;

                        var total = document.getElementById('stot' + (i + 1)).innerText;
                        worksheet_data.push([
                            day,
                            startHour + ":" + startMin + " " + startAmPm,
                            endHour + ":" + endMin + " " + endAmPm,
                            breakHour + ":" + breakMin,
                            total
                        ]);
                    }
                }

                var finalTime = document.getElementById("finalTime").innerText.trim();
                var overtimePay = document.getElementById("overtime_pay").innerText.trim();
                var overtimeHours = document.getElementById("overtime_hours").innerText.trim();
                var grosPrice = document.getElementById("GrosPrice").innerText.trim();

                worksheet_data.push(["Total Hours = "+ finalTime,"Overtime Pay = "+ overtimePay,"Overtime Hours = "+ overtimeHours,"Total Gross Pay = "+ grosPrice]);

                var worksheet = XLSX.utils.aoa_to_sheet(worksheet_data);

                XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");
                XLSX.writeFile(workbook, "WorkHours.xlsx");
        }
        function getDayName(index) {
            var days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
            return days[index % 7];
        }

    </script>
@endpush
