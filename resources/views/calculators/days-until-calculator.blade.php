<style>
     #current{
        padding-right: 8px;
    }
    #current::-webkit-calendar-picker-indicator{
        cursor: pointer;
        font-size: 20px;
    }
    #next{
        padding-right: 8px;
    }
    #next::-webkit-calendar-picker-indicator{
        cursor: pointer;
        font-size: 20px;
    }
    .toggle-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0px;
    }
    .toggle-label {
        display: flex;
        align-items: center;
        margin: 0 10px;
    }
    .toggle-switch {
        position: relative;
        width: 60px;
        height: 30px;
        margin-left: 10px;
    }
    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 30px;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 24px;
        width: 24px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
    input:checked + .slider {
        background-color: #2845F5;
    }
    input:checked + .slider:before {
        transform: translateX(30px);
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @php
        $request = request();
        $nextYear = date('Y-m-d', strtotime('+1 month'));
        $selectedDays = request()->has('weekDay') ? request()->input('weekDay') : [''];
    @endphp
 <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="current" class="font-s-14 text-blue">{{ $lang['1'] }}</label>                        
                    <div class="w-100 py-2">
                        <input type="date" name="current" id="current" class="input" value="{{ isset($request->current) ? $request->current : date('Y-m-d') }}" aria-label="input" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="next" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <div class="w-100 py-2">
                        <input type="date" name="next" id="next" class="input" value="{{ isset($request->next) ? $request->next : $nextYear }}" aria-label="input" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="next" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                    <div class="w-100 py-2">
                        <select name="startEvent" id="startEvent" class="input">
                            <option value="empty" {{$request->startEvent == 'empty' ? 'selected' : ''}}>---</option>
                            <option value="Thanksgiving (Canada)" {{$request->startEvent == 'Thanksgiving (Canada)' ? 'selected' : ''}}>Thanksgiving (Canada)</option>
                            <option value="Halloween" {{$request->startEvent == 'Halloween' ? 'selected' : ''}}>Halloween</option>
                            <option value="Thanksgiving (US)" {{$request->startEvent == 'Thanksgiving (US)' ? 'selected' : ''}}>Thanksgiving (US)</option>
                            <option value="Christmas" {{$request->startEvent == 'Christmas' ? 'selected' : ''}}>Christmas</option>
                            <option value="New Year's Eve" {{$request->startEvent == "New Year's Eve" ? 'selected' : ''}}>New Year's Eve</option>
                            <option value="Easter (Easter Sunday)" {{$request->startEvent == 'Easter (Easter Sunday)' ? 'selected' : ''}}>Easter (Easter Sunday)</option>
                        </select>
                    </div>
                    {{-- @dd($request->startEvent) --}}
                </div>
            </div>
            <div class="grid grid-cols-1   gap-4">
                <div class="toggle-container {{$device == 'mobile' ? 'row' : ''}}">
                    <div class="toggle-label col-lg-6 col-12">
                        <span>Include all days?</span>
                        <label class="toggle-switch">
                            <input type="checkbox" name="inc_all" id="chkPassport"  @if(!isset($detail))
                                    checked
                                @endif
                            {{ isset(request()->inc_all) && request()->inc_all == "on" ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div> <br>
                    <div class="toggle-label col-lg-6 col-12">
                        <span>Include end day?</span>
                        <label class="toggle-switch">
                            <input type="checkbox" name="inc_day" {{isset(request()->inc_day) && request()->inc_day == 'on'? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                <div class="px-2 mt-2 {{isset(request()->inc_all) && request()->inc_all == "on" ? 'hidden' : '' }} {{!isset($detail) ? 'hidden' : ''}}"  id="dvPassport">
                    <label for="currency" class="heading">Days to include:</label>
                    <span class="radio-switch">
                        <input type="checkbox" id="check-0" name="weekDay[]" value="Mon" @if(!isset($detail)) checked @endif {{ in_array('Mon', $selectedDays) ? 'checked' : '' }}>
                        <label for="check-0">M</label>
                        <input type="checkbox" id="check-1" name="weekDay[]" value="Tue" @if(!isset($detail)) checked @endif  {{ in_array('Tue', $selectedDays) ? 'checked' : '' }}>
                        <label for="check-1">T</label>
                        <input type="checkbox" id="check-2" name="weekDay[]" value="Wed" {{ in_array('Wed', $selectedDays) ? 'checked' : '' }}>
                        <label for="check-2">W</label>
                        <input type="checkbox" id="check-3" name="weekDay[]" value="Thu" {{ in_array('Thu', $selectedDays) ? 'checked' : '' }}>
                        <label for="check-3">T</label>
                        <input type="checkbox" id="check-4" name="weekDay[]" value="Fri" {{ in_array('Fri', $selectedDays) ? 'checked' : '' }}>
                        <label for="check-4">F</label>
                        <input type="checkbox" id="check-5" name="weekDay[]" value="Sat" {{ in_array('Sat', $selectedDays) ? 'checked' : '' }}>
                        <label for="check-5">S</label>
                        <input type="checkbox" id="check-6" name="weekDay[]" value="Sun" {{ in_array('Sun', $selectedDays) ? 'checked' : '' }}>
                        <label for="check-6">S</label>
                    </span>
                    <span class="clearElement"></span> 
                </div>
                <div id="Halloween"></div>
                <div id="Thanksgiving"></div>
                <div id="Christmas"></div>
                <div id="Valentine"></div>
                <div id="Father"></div>
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
                    <div class="w-full radius-10 mt-3 overflow-auto">
                        <div class="loader-container">
                            <div id="loading"></div>
                            <div class="loader-text"></div>
                        </div>
                        <div class="loader-container d-none">
                            <div id="loading"></div>
                            <div class="loader-text"></div>
                        </div>
                        <div class="w-full">
                            @if(request()->inc_all == 'on' )
                                @isset($detail['totaldays'])
                                    <p class="border-b pt-2 pb-1">
                                        <strong id="years" class="text font-s-18 me-1">{{$detail['totaldays']}}</strong>
                                        Total Days
                                    </p>
                                @endisset
                                @isset($detail['months'])
                                    <p class="border-b pt-2 pb-1">
                                        <strong id="months" class="text font-s-18 me-1">{{$detail['months']}}</strong>
                                        Months
                                    </p>
                                @endisset
                                
                            @endif
                            <div class="border-b pt-2 pb-1 d-flex">
                                @if(request()->inc_all == 'on' )
                                    @isset($detail['weeks'])
                                        <p>
                                            <strong id="weeks" class="text font-s-18 me-1">{{$detail['weeks']}}</strong>
                                            Weeks
                                        </p>
                                    @endisset
                                @endif
                                @isset($detail['days'])
                                    <p class="{{request()->inc_all == 'on' ? 'ms-2' : ''}}">
                                        <strong id="days" class="text font-s-18 me-1">{{$detail['days']}}</strong>
                                        Days
                                    </p>
                                @endisset
                            </div>
                            @isset($detail['hours'])
                                <p class="border-b-dark pt-2 pb-1">
                                    <strong id="hours" class="text font-s-18 me-1">{{$detail['hours']}}</strong>
                                    Hours
                                </p>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var chkPassport = document.getElementById('chkPassport');
            var dvPassport = document.getElementById('dvPassport');

            chkPassport.addEventListener('click', function() {
                if (chkPassport.checked) {
                    dvPassport.style.display = "none";
                } else {
                    dvPassport.style.display = "block";
                }
            });
        });


        document.getElementById('startEvent').addEventListener('change', function() {
            const selectedEvent = this.value;
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();
            let eventDate;

            switch (selectedEvent) {
                case 'Thanksgiving (Canada)':
                    eventDate = new Date(currentYear, 9, 15); // October 14, 2024
                    break;
                case 'Halloween':
                    eventDate = new Date(currentYear, 9, 32); // October 31, 2024
                    break;
                case 'Thanksgiving (US)':
                    eventDate = new Date(currentYear, 10, 29); // November 28, 2024
                    break;
                case 'Christmas':
                    eventDate = new Date(currentYear, 11, 26); // December 25, 2024
                    break;
                case "New Year's Eve":
                    eventDate = new Date(currentYear + 1, 0, 2); // January 1, 2025
                    break;
                case 'Easter (Easter Sunday)':
                    eventDate = new Date(currentYear + 1, 3, 21); // April 20, 2025
                    break;
                default:
                    eventDate = new Date(currentYear + 1, 0, 1); // Default to January 1 of the next year
                    break;
            }

            if (eventDate < currentDate) {
                eventDate.setFullYear(eventDate.getFullYear() + 1);
            }

            const formattedDate = eventDate.toISOString().split('T')[0];
            document.getElementById('next').value = formattedDate;
        });

        // for content displaying dates
        const today = new Date();
        const currentYear = new Date().getFullYear();
        let eventDate;

        VeleventDate = new Date(currentYear, 1, 14); // February 14th
        if (today > VeleventDate) {
            VeleventDate.setFullYear(VeleventDate.getFullYear() + 1);
        }
        const remainingTime = VeleventDate - today;
        const remainingTimeVel = Math.ceil(remainingTime / (1000 * 60 * 60 * 24));
        document.getElementById('velentain_date').innerHTML = VeleventDate.toDateString();
        document.getElementById('velentain_remain').innerHTML = remainingTimeVel;

        eventDateHel = new Date(currentYear, 9, 31); // October 31st
        if (today > eventDateHel) {
            eventDateHel.setFullYear(eventDateHel.getFullYear() + 1);
        }
        const remainingTimehel = eventDateHel - today;
        const remainingTimeHel = Math.ceil(remainingTimehel / (1000 * 60 * 60 * 24));
        document.getElementById('hellowan_date').innerHTML = eventDateHel.toDateString();
        document.getElementById('hellowan_remain').innerHTML = remainingTimeHel;

        
        // Thanksgiving is the fourth Thursday in November
        const november = new Date(currentYear, 10, 1);
        const firstThursday = new Date(november.setDate(november.getDate() + (11 - november.getDay()) % 7));
        Thanksgiving = new Date(firstThursday.setDate(firstThursday.getDate() + 21)); // Add 21 days to get to the fourth Thursday
        if (today > Thanksgiving) {
            Thanksgiving.setFullYear(Thanksgiving.getFullYear() + 1);
        }
        const remainingTimeThank = Thanksgiving - today;
        const remainingTimeThan = Math.ceil(remainingTimeThank / (1000 * 60 * 60 * 24));

        document.getElementById('Thank_date').innerHTML = Thanksgiving.toDateString();
        document.getElementById('Thank_day_remain').innerHTML = remainingTimeThan;

        Christmas = new Date(currentYear, 11, 25); // December 25th
        if (today > Christmas) {
            Christmas.setFullYear(Christmas.getFullYear() + 1);
        }
        const remainingTimeChris = Christmas - today;
        const remainingTimeChristmas = Math.ceil(remainingTimeChris / (1000 * 60 * 60 * 24));

        document.getElementById('Christmas_date').innerHTML = Christmas.toDateString();
        document.getElementById('Christmas_day_remain').innerHTML = remainingTimeChristmas;

        const june = new Date(currentYear, 5, 1);
        const firstSunday = new Date(june.setDate(june.getDate() + (7 - june.getDay()) % 7));
        var Father = new Date(firstSunday.setDate(firstSunday.getDate() + 14)); // Add 14 days to get to the third Sunday
        if (today > Father) {
            Father.setFullYear(Father.getFullYear() + 1);
        }
        const remainingTimefat = Father - today;
        const remainingTimeFat = Math.ceil(remainingTimefat / (1000 * 60 * 60 * 24));

        document.getElementById('Father_date').innerHTML = Father.toDateString();
        document.getElementById('Father_day_remain').innerHTML = remainingTimeFat;
       
    </script>
    @endpush
</form>