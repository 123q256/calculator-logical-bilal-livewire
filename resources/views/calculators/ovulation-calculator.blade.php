<style>
    .calendar {
        position: relative;
        text-transform: capitalize;
        text-align: center;
        color: #545A5C;
        margin: 0px auto;
        overflow: auto
    }
    .calendar header .month {
        padding: 0;
        margin: 0;
    }
    .calendar header .btn {
        display: inline-block;
        position: absolute;
        background: none !important;
        box-shadow: none !important;
        text-align: left;
        line-height: 35px;
        font-size: 25px;
    }
    .calendar header .btn-prev {
        left: 24%;
        top: 0px;
        font-size: 35px;
    }
    .calendar header .btn-next {
        right: 25%;
        top: 0px;
        font-size: 35px;
    }
    .calendar .day {
        display: inline-block;
        width: 2em;
        height: 2em;
        line-height: 1.9em;
        border-radius: 50%;
        text-align: center;
        font-size: 12px;
        border: 2px solid transparent;
    }
    .calendar .day.event {
        color: #fff;
        background: #ff4081;
        border: 2px solid #f77721;
    }
    .calendar .day.today {
        background: #13699E;
        color: white;
    }
    .calendar .event-container {
        display: none;
        position: absolute;
        top: 3px;
        left: 0;
        width: 100%;
        height: 98%;
        color: white;
        background: #fff;
        border-radius: 10px
    }
    .event-container{
        color: black !important;
    }
    .event-container>p {
        margin-top: 20px;
        font-size: 20px !important;
    }
    .event-container>.close {
        position: absolute;
        right: 32px;
        top: 32px;
        width: 32px;
        height: 32px;
        opacity: 0.3;
    }
    .calendar a {
        text-decoration: none;
    }
    .close {
        font-size: 25px;
        cursor: pointer
    }
    .calendar table {
        width: 100%;
        margin: 10px 0;
        border-spacing: 0px;
        border: 1px solid #f5f5f5
    }
    .calendar td {
        padding: 1.8px 5px;
        line-height: 0;
        border: 1px solid #f5f5f5
    }
    .calendar .headings td{
        padding: 12px 5px;
        border: 0
    }
    .cycle6_table td{
        padding: 13.7px
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="w-full lg:w-6/12 mx-auto mt-5">
            <div class="flex flex-wrap">
                <!-- First Input (Date) -->
                <div class="w-full px-2">
                    <label for="date" class="label">{!! $lang['first_date'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <input type="date" name="date" id="date" class="w-full border border-gray-300 rounded-md p-2" aria-label="input" placeholder="MMM DD, YYYY" value="{{ isset($_POST['date'])?$_POST['date']:date('m-d-Y') }}" />
                    </div>
                </div>
                <!-- Second Input (Number of Days) -->
                <div class="w-full lg:w-6/12 px-2">
                    <label for="days" class="label">{!! $lang['number_days'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" name="days" id="days" class="w-full border border-gray-300 rounded-md p-2" title="{{ $lang['note_ovu'] }}" aria-label="input" placeholder="{{ $lang['days'] }}" value="{{ isset($_POST['days'])?$_POST['days']:'28' }}" />
                    </div>
                </div>
                <!-- Third Input (Luteal Phase) -->
                <div class="w-full lg:w-6/12 px-2">
                    <label for="Luteal" class="label">{!! $lang['l_p'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" name="Luteal" id="Luteal" class="w-full border border-gray-300 rounded-md p-2" aria-label="input" placeholder="14 {{ $lang['days'] }}" value="{{ isset($_POST['Luteal'])?$_POST['Luteal']:'' }}" />
                    </div>
                </div>
                <!-- Conditional Buttons -->
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
                <div class="rounded-lg lg:p-4 md:p-4 flex items-center justify-center">
                    <div class="w-full  p-3 rounded-lg mt-3">
                        <div class="w-full">
                            <div class="flex flex-wrap">
                                <!-- Ovulation Day -->
                                <div class="w-full lg:w-1/2 lg:px-3 py-3">
                                    <div class="bg-[#F6FAFC] text-center border rounded-lg px-3 py-4">
                                        <div class="w-10/12 mx-auto">
                                            <p><strong>Your Ovulation Day is</strong></p>
                                            <p class="text-2xl mt-3"><strong class="text-green-500">{{ $detail['Ovu_date'] }}</strong></p>
                                            <div class="bg-white text-sm rounded-lg p-3 mt-3">
                                                <strong>{{ $lang['last_date'] }} <span class="text-gray-500 ml-2">{{ $detail['request']->date }}</span></strong>
                                            </div>
                                            <div class="bg-white text-sm rounded-lg p-3 mt-3 mb-10">
                                                <strong>{{ $lang['c_l'] }} <span class="text-gray-500 ml-2">{{ $detail['request']->days }} {{ $lang['days'] }}</span></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Ovulation Calendar -->
                                <div class="w-full lg:w-1/2 lg:px-3 py-3">
                                    <div class="bg-[#F6FAFC] text-center border rounded-lg p-2">
                                        <p><strong class="text-blue-500">Ovulation Calendar</strong></p>
                                        <div class="calendar"></div>
                                    </div>
                                </div>
                                
                                <!-- Fertile Period & Next Period -->
                                <div class="w-full lg:w-1/2 lg:px-3 py-3">
                                    <div class="bg-[#F6FAFC] text-center border rounded-lg p-2">
                                        <div class="flex flex-wrap">
                                            <div class="w-1/2 p-2">
                                                <div class="bg-white text-sm rounded-lg p-2">
                                                    <img src="{{ asset('images/fertile.png') }}" alt="Fertile Period" class="w-12  mx-auto">
                                                    <p class="text-blue-500"><strong>{{ $lang['fertile'] }}</strong></p>
                                                    <p>{{ $detail['First_day'] }} to {{ ($detail['Last_day']) }}</p>
                                                </div>
                                            </div>
                                            <div class="w-1/2 p-2">
                                                <div class="bg-white text-sm rounded-lg p-2">
                                                    <img src="{{ asset('images/next_period.png') }}" alt="Next Period" class="w-12  mx-auto">
                                                    <p class="text-blue-500"><strong>{{ $lang['next_period'] }}</strong></p>
                                                    <p>{{ $detail['Next_period'] }}</p>
                                                </div>
                                            </div>
                                            <div class="w-1/2 p-2">
                                                <div class="bg-white text-sm rounded-lg p-2">
                                                    <img src="{{ asset('images/window.png') }}" alt="Intercourse Window for Pregnancy" class="w-12  mx-auto">
                                                    <p class="text-blue-500"><strong>{{ $lang['inter_w'] }}</strong></p>
                                                    <p>{{ $detail['inter'].$detail['Last_day'] }}</p>
                                                </div>
                                            </div>
                                            <div class="w-1/2 p-2">
                                                <div class="bg-white text-sm rounded-lg p-2">
                                                    <img src="{{ asset('images/safe.png') }}" alt="Safe Period" class="w-12  mx-auto">
                                                    <p class="text-blue-500"><strong>{{ $lang['save'] }}</strong></p>
                                                    <p>{{ $detail['save'] }}</p>
                                                    <p>{{ $detail['saven'] }}</p>
                                                </div>
                                            </div>
                                            <div class="w-1/2 p-2">
                                                <div class="bg-white text-sm rounded-lg p-2">
                                                    <img src="{{ asset('images/expected_date.png') }}" alt="Due Date" class="w-12  mx-auto">
                                                    <p class="text-blue-500"><strong>{{ $lang['due_date'] }}</strong></p>
                                                    <p>{{ $detail['Due_date'] }}</p>
                                                </div>
                                            </div>
                                            <div class="w-1/2 p-2">
                                                <div class="bg-white text-sm rounded-lg p-2">
                                                    <img src="{{ asset('images/test.png') }}" alt="Pregnancy Test" class="w-12  mx-auto">
                                                    <p class="text-blue-500"><strong>{{ $lang['p_t'] }}</strong></p>
                                                    <p>{{ $detail['test'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- 6 Cycle Table -->
                                <div class="w-full lg:w-1/2 lg:px-3 py-3">
                                    <div class="bg-[#F6FAFC] border rounded-lg p-2 pt-3">
                                        <p class="text-center"><strong class="text-blue-500">{{ $lang['6cycle'] }}</strong></p>
                                        <div class="w-full overflow-auto cycle6_table">
                                            <table class="w-full mt-2" cellspacing="0">
                                                <tr>
                                                    <td class="border-b border-gray-400 text-xs"><strong>{{ $lang['p_s'] }}</strong></td>
                                                    <td class="border-b border-l border-gray-400 text-xs"><strong>{{ $lang['o_w'] }}</strong></td>
                                                    <td class="border-b border-l border-gray-400 text-xs"><strong>{{ $lang['d_d'] }}</strong></td>
                                                </tr>
                                                {!! $detail['table'] !!}
                                            </table>
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
    @push('calculatorJS')
        @if(isset($detail))
            <script>
                var c_date = '{{ date("D-M-d-Y", $detail["lasttime"]) }}';
                var arrow_left = '{{ asset("images/tarrow-left.png") }}';
                var arrow_right = '{{ asset("images/tarrow-right.png") }}';
            </script>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="{{ url('js/jquery.simple-calendar.js') }}" crossorigin="anonymous"></script>
            <script>
                $(".calendar").simpleCalendar({
                    events: ['{{ $detail['event3'] }}','{{ $detail['event4'] }}','{{ $detail['event5'] }}','{{ $detail['event6'] }}','{{ $detail['event7'] }}','{{ $detail['event8'] }}','{{ $detail['event9'] }}','{{ $detail['event10'] }}','{{ $detail['event11'] }}','{{ $detail['event12'] }}','{{ $detail['event13'] }}','{{ $detail['event14'] }}','{{ $detail['event15'] }}','{{ $detail['event16'] }}','{{ $detail['event17'] }}','{{ $detail['event18'] }}','{{ $detail['event19'] }}','{{ $detail['event20'] }}','{{ $detail['event21'] }}','{{ $detail['event22'] }}','{{ $detail['event23'] }}','{{ $detail['event24'] }}','{{ $detail['event25'] }}','{{ $detail['event26'] }}','{{ $detail['event27'] }}','{{ $detail['event28'] }}','{{ $detail['event29'] }}','{{ $detail['event30'] }}','{{ $detail['event31'] }}','{{ $detail['event32'] }}'],
                    eventsInfo: ['Fertile Period', 'Fertile Period','Ovulation Date', 'Fertile Period','Fertile Period','Fertile Period', 'Fertile Period','Ovulation Date', 'Fertile Period','Fertile Period','Fertile Period', 'Fertile Period','Ovulation Date', 'Fertile Period','Fertile Period','Fertile Period', 'Fertile Period','Ovulation Date', 'Fertile Period','Fertile Period','Fertile Period', 'Fertile Period','Ovulation Date', 'Fertile Period','Fertile Period','Fertile Period', 'Fertile Period','Ovulation Date', 'Fertile Period','Fertile Period']
                });
            </script>
        @else
            <script>
                document.getElementById("date").defaultValue = '{{ date("Y-m-d") }}'
            </script>
        @endif
    @endpush
</form>