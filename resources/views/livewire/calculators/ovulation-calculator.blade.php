<div>
    <style>
        .calendar {
            width: 100%;
            text-align: center;
            color: #545A5C;
        }
        .calendar .day {
            display: inline-block;
            width: 2.2em;
            height: 2.2em;
            line-height: 2.1em;
            border-radius: 50%;
            text-align: center;
            font-size: 13px;
            transition: all 0.2s;
            color: #4B5563;
            text-decoration: none !important;
            border: 2px solid transparent;
        }
        .calendar .day.event {
            color: #fff !important;
            background: #ff4081;
            border: 2px solid #f77721;
        }
        .calendar .day.today {
            background: #13699E;
            color: white !important;
            font-weight: bold;
        }
        .calendar .day.wrong-month {
            opacity: 0.1;
        }
        .calendar .day:hover:not(.wrong-month) {
            background: #F3F4F6;
        }
        .calendar .day.event:hover {
            background: #e91e63;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="w-full lg:w-[70%] md:w-[70%] mx-auto mt-5">
                <div class="flex flex-wrap">
                    <!-- First Input (Date) -->
                    <div class="w-full px-2">
                        <label for="date" class="label">{!! $lang['first_date'] ?? 'First day of last period' !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="date" wire:model.live="date" id="date" class="input" placeholder="MMM DD, YYYY" />
                        </div>
                    </div>
                    <!-- Second Input (Number of Days) -->
                    <div class="w-full lg:w-6/12 px-2 mt-4 lg:mt-0">
                        <label for="days" class="label">{!! $lang['number_days'] ?? 'Cycle length' !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" wire:model.live="days" id="days" class="input" title="{{ $lang['note_ovu'] ?? '' }}" placeholder="{{ $lang['days'] ?? 'days' }}" />
                        </div>
                    </div>
                    <!-- Third Input (Luteal Phase) -->
                    <div class="w-full lg:w-6/12 px-2 mt-4 lg:mt-0">
                        <label for="Luteal" class="label">{!! $lang['l_p'] ?? 'Luteal phase' !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" wire:model.live="Luteal" id="Luteal" class="input" placeholder="14 {{ $lang['days'] ?? 'days' }}" />
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <hr>
            <div id="result-section" 
                 x-data 
                 x-init="$nextTick(() => { window.initOvulationCalendar() })"
                 wire:loading.remove 
                 wire:target="calculate" 
                 class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg lg:py-4 md:py-4 flex items-center justify-center">
                        <div class="w-full rounded-lg mt-3">
                            <div class="w-full">
                                <div class="flex flex-wrap -mx-3">
                                    <!-- Ovulation Day -->
                                    <div class="w-full lg:w-1/2 px-3 py-3">
                                        <div class="bg-[#F6FAFC] text-center border rounded-lg px-3 py-4 h-full shadow-sm">
                                            <div class="w-10/12 mx-auto">
                                                <p class="text-gray-600 uppercase tracking-wider text-xs font-bold">Your Ovulation Day is</p>
                                                <p class="text-4xl mt-4"><strong class="text-green-600">{{ $detail['Ovu_date'] }}</strong></p>
                                                <div class="bg-white text-sm rounded-lg p-3 mt-6 shadow-sm border border-gray-100">
                                                    <strong>{{ $lang['last_date'] ?? 'Last Period' }}: <span class="text-gray-500 ml-2">{{ $detail['request']->date }}</span></strong>
                                                </div>
                                                <div class="bg-white text-sm rounded-lg p-3 mt-3 mb-4 shadow-sm border border-gray-100">
                                                    <strong>{{ $lang['c_l'] ?? 'Cycle Length' }}: <span class="text-gray-500 ml-2">{{ $detail['request']->days }} {{ $lang['days'] ?? 'days' }}</span></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Ovulation Calendar -->
                                    <div class="w-full lg:w-1/2 px-3 py-3">
                                        <div class="bg-[#F6FAFC] text-center border rounded-lg p-4 h-full shadow-sm">
                                            <p class="mb-4 text-blue-500 font-bold uppercase tracking-wider text-sm">Ovulation Calendar</p>
                                            <div class="calendar-container bg-white p-2 rounded-lg border border-gray-100">
                                                <div class="calendar">
                                                    <header class="relative mb-4 flex items-center justify-between px-10">
                                                        <button type="button" wire:click="prevMonth" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                                                            <img src="{{ asset('images/tarrow-left.png') }}" alt="prev" class="w-6">
                                                        </button>
                                                        <b class="text-lg capitalize">{{ \Carbon\Carbon::create($calendarYear, $calendarMonth, 1)->format('F Y') }}</b>
                                                        <button type="button" wire:click="nextMonth" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                                                            <img src="{{ asset('images/tarrow-right.png') }}" alt="next" class="w-6">
                                                        </button>
                                                    </header>
                                                    <table class="w-full border-collapse">
                                                        <thead>
                                                            <tr class="bg-gray-50">
                                                                @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $dayName)
                                                                    <th class="p-2 text-xs font-bold text-black uppercase">{{ $dayName }}</th>
                                                                @endforeach
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach(array_chunk($this->calendarDays, 7) as $week)
                                                                <tr>
                                                                    @foreach($week as $day)
                                                                        <td class="p-1 border border-gray-50">
                                                                            <span class="day-wrapper flex items-center justify-center">
                                                                                <a href="javascript:void(0)" 
                                                                                   class="day {{ $day['isEvent'] ? 'event' : '' }} {{ $day['isToday'] ? 'today' : '' }} {{ !$day['isCurrentMonth'] ? 'wrong-month opacity-30' : '' }}"
                                                                                   @if($day['isEvent']) data-tippy-content="{{ $day['info'] }}" @endif>
                                                                                    {{ $day['day'] }}
                                                                                </a>
                                                                            </span>
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Fertile Period & Info Cards -->
                                    <div class="w-full lg:w-1/2 px-3 py-3">
                                        <div class="bg-[#F6FAFC] text-center border rounded-lg p-4 h-full shadow-sm">
                                            <div class="flex flex-wrap -mx-2">
                                                <div class="w-1/2 p-2">
                                                    <div class="bg-white text-sm rounded-xl p-4 shadow-sm border border-gray-100 h-full flex flex-col justify-center">
                                                        <img src="{{ asset('images/fertile.png') }}" alt="Fertile Period" class="w-10 mx-auto mb-2">
                                                        <p class="text-blue-500 font-bold text-xs uppercase">{{ $lang['fertile'] ?? 'Fertile Period' }}</p>
                                                        <p class="mt-1 font-semibold text-gray-700">{{ $detail['First_day'] }} to {{ $detail['Last_day'] }}</p>
                                                    </div>
                                                </div>
                                                <div class="w-1/2 p-2">
                                                    <div class="bg-white text-sm rounded-xl p-4 shadow-sm border border-gray-100 h-full flex flex-col justify-center">
                                                        <img src="{{ asset('images/next_period.png') }}" alt="Next Period" class="w-10 mx-auto mb-2">
                                                        <p class="text-blue-500 font-bold text-xs uppercase">{{ $lang['next_period'] ?? 'Next Period' }}</p>
                                                        <p class="mt-1 font-semibold text-gray-700">{{ $detail['Next_period'] }}</p>
                                                    </div>
                                                </div>
                                                <div class="w-1/2 p-2">
                                                    <div class="bg-white text-sm rounded-xl p-4 shadow-sm border border-gray-100 h-full flex flex-col justify-center">
                                                        <img src="{{ asset('images/window.png') }}" alt="Intercourse Window" class="w-10 mx-auto mb-2">
                                                        <p class="text-blue-500 font-bold text-xs uppercase">{{ $lang['inter_w'] ?? 'Intercourse Window' }}</p>
                                                        <p class="mt-1 font-semibold text-gray-700">{{ $detail['inter'] }}{{ $detail['Last_day'] }}</p>
                                                    </div>
                                                </div>
                                                <div class="w-1/2 p-2">
                                                    <div class="bg-white text-sm rounded-xl p-4 shadow-sm border border-gray-100 h-full flex flex-col justify-center">
                                                        <img src="{{ asset('images/safe.png') }}" alt="Safe Period" class="w-10 mx-auto mb-2">
                                                        <p class="text-blue-500 font-bold text-xs uppercase">{{ $lang['save'] ?? 'Safe Period' }}</p>
                                                        <p class="mt-1 font-semibold text-gray-700">{{ $detail['save'] }}</p>
                                                        <p class="text-gray-500 text-xs">{{ $detail['saven'] }}</p>
                                                    </div>
                                                </div>
                                                <div class="w-1/2 p-2">
                                                    <div class="bg-white text-sm rounded-xl p-4 shadow-sm border border-gray-100 h-full flex flex-col justify-center">
                                                        <img src="{{ asset('images/expected_date.png') }}" alt="Due Date" class="w-10 mx-auto mb-2">
                                                        <p class="text-blue-500 font-bold text-xs uppercase">{{ $lang['due_date'] ?? 'Due Date' }}</p>
                                                        <p class="mt-1 font-semibold text-gray-700">{{ $detail['Due_date'] }}</p>
                                                    </div>
                                                </div>
                                                <div class="w-1/2 p-2">
                                                    <div class="bg-white text-sm rounded-xl p-4 shadow-sm border border-gray-100 h-full flex flex-col justify-center">
                                                        <img src="{{ asset('images/test.png') }}" alt="Pregnancy Test" class="w-10 mx-auto mb-2">
                                                        <p class="text-blue-500 font-bold text-xs uppercase">{{ $lang['p_t'] ?? 'Pregnancy Test' }}</p>
                                                        <p class="mt-1 font-semibold text-gray-700">{{ $detail['test'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 6 Cycle Table -->
                                    <div class="w-full lg:w-1/2 px-3 py-3">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-4 h-full shadow-sm">
                                            <p class="text-center mb-4 text-blue-500 font-bold uppercase tracking-wider text-sm">{{ $lang['6cycle'] ?? 'Next 6 Cycles' }}</p>
                                            <div class="w-full overflow-auto cycle6_table shadow-sm border border-gray-100 rounded-lg bg-white">
                                                <table class="w-full" cellspacing="0">
                                                    <thead class="bg-gray-50">
                                                        <tr>
                                                            <th class="p-3 border-b border-gray-200 text-xs text-left text-gray-600 uppercase"><strong>{{ $lang['p_s'] ?? 'Period Start' }}</strong></th>
                                                            <th class="p-3 border-b border-l border-gray-200 text-xs text-left text-gray-600 uppercase"><strong>{{ $lang['o_w'] ?? 'Ovulation Window' }}</strong></th>
                                                            <th class="p-3 border-b border-l border-gray-200 text-xs text-left text-gray-600 uppercase"><strong>{{ $lang['d_d'] ?? 'Due Date' }}</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-100">
                                                        {!! $detail['table'] !!}
                                                    </tbody>
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
    </form>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            tippy('[data-tippy-content]');
            
            Livewire.hook('morph.updated', (el, component) => {
                tippy('[data-tippy-content]');
            });
        });
    </script>
</div>
