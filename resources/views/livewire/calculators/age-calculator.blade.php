<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .flatpickr-monthDropdown-months {
            appearance: auto !important;
            -webkit-appearance: auto !important;
            border: 1px solid #ddd !important;
            border-radius: 4px !important;
            padding: 2px 4px !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            background: white !important;
            color: #333 !important;
        }

        .numInput.cur-year {
            border: 1px solid #ddd !important;
            border-radius: 4px !important;
            padding: 2px 4px !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            width: 60px !important;
            text-align: center !important;
            background: white !important;
            color: #333 !important;
        }
    </style>
    <form wire:submit.prevent="calculate" class="row">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[70%] md:w-[90%] w-full mx-auto">
                <div class="flex flex-wrap">

                    {{-- Date of Birth --}}
                    <label for="dob" class="label">{{ $lang[106] }}:</label>

                    {{-- Mobile: 2 cols | Desktop: 4 cols --}}
                    <div class="w-full grid grid-cols-2 md:grid-cols-[1fr_1fr_1.5fr_auto] items-center gap-2 py-1">

                        {{-- Day --}}
                        <div>
                            <select name="day" id="day" wire:model="day" class="w-full">
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>

                        {{-- Month --}}
                        <div>
                            <select name="month" id="month" wire:model="month" class="w-full">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>

                        {{-- Year --}}
                        <div>
                            <select name="year" id="year" wire:model="year" class="w-full">
                                @for ($i = 1940; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        {{-- Calendar Icon DOB --}}
                        <div class="relative">
                            <input type="text" id="dob_picker"
                                style="position:absolute; opacity:0; pointer-events:none; width:1px; height:1px; top:35px; left:0;">
                            <button type="button" id="dob_btn"
                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-blue-100 transition-colors border border-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </button>
                        </div>

                    </div>

                    {{-- End Date --}}
                    <label for="e_date" class="label">{{ $lang[107] }}:</label>
                    <div
                        class="{{ app()->getLocale() == 'id' ? 'hidden' : 'w-full grid grid-cols-2 md:grid-cols-[1fr_1fr_1.5fr_auto] items-center gap-2 py-1' }}">

                        {{-- Day Sec --}}
                        <div>
                            <select name="day_sec" id="day_sec" wire:model="day_sec" class="w-full">
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        {{-- Month Sec --}}
                        <div>
                            <select name="month_sec" id="month_sec" wire:model="month_sec" class="w-full">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        {{-- Year Sec --}}
                        <div>
                            <select name="year_sec" id="year_sec" wire:model="year_sec" class="w-full">
                                @for ($i = 1940; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        {{-- Calendar Icon End Date --}}
                        <div class="relative">
                            <input type="text" id="sec_picker"
                                style="position:absolute; opacity:0; pointer-events:none; width:1px; height:1px; top:35px; left:0;">
                            <button type="button" id="sec_btn"
                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-blue-100 transition-colors border border-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </button>
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
        {{-- result --}}
        @if (isset($detail))
            <hr style="height: 1px; background-color: #e5e7eb;">
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="col-12 rounded-lg mt-3">
                        {{-- Top 2 Cards --}}
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                            {{-- Age Card --}}
                            <div
                                class="relative overflow-hidden bg-gradient-to-br from-green-50 to-emerald-100 border border-green-200 rounded-lg p-6 text-center shadow-sm">
                                <div
                                    class="absolute top-0 right-0 w-24 h-24 bg-green-200 rounded-full opacity-20 -mr-6 -mt-6">
                                </div>
                                <div class="relative">
                                    <div
                                        class="inline-flex items-center justify-center w-12 h-12 bg-green-500 rounded-full mb-3">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-green-700 tracking-wider mb-3">
                                        {{ $lang[60] }}</p>
                                    <div class="flex items-center justify-center gap-3 flex-wrap">
                                        <div class="text-center">
                                            <span
                                                class="text-4xl font-black text-green-600">{{ $detail['age_years'][0] }}</span>
                                            <p class="text-xs text-green-600 font-medium mt-1">{{ $lang['years'] }}
                                            </p>
                                        </div>
                                        <span class="text-green-300 text-2xl font-light">•</span>
                                        <div class="text-center">
                                            <span
                                                class="text-4xl font-black text-green-600">{{ $detail['age_months'][0] }}</span>
                                            <p class="text-xs text-green-600 font-medium mt-1">
                                                {{ $lang['months'] }}</p>
                                        </div>
                                        <span class="text-green-300 text-2xl font-light">•</span>
                                        <div class="text-center">
                                            <span
                                                class="text-4xl font-black text-green-600">{{ $detail['age_days'][0] }}</span>
                                            <p class="text-xs text-green-600 font-medium mt-1">{{ $lang['days'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Date Card --}}
                            <div
                                class="relative overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100 border border-blue-200 rounded-lg p-6 text-center shadow-sm">
                                <div
                                    class="absolute top-0 right-0 w-24 h-24 bg-blue-200 rounded-full opacity-20 -mr-6 -mt-6">
                                </div>
                                <div class="relative">
                                    <div
                                        class="inline-flex items-center justify-center w-12 h-12 bg-blue-500 rounded-full mb-3">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-blue-700 tracking-wider mb-3">
                                        {{ $lang[108] }}</p>
                                    <p class="text-xl font-bold text-blue-700">
                                        {{ date('l', strtotime($detail['dates_array'][0])) }}
                                    </p>
                                    <p class="text-lg font-semibold text-blue-600 mt-1">
                                        {{ date('F d, Y', strtotime($detail['dates_array'][0])) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap my-2">
                            <div class="w-full lg:w-12/12 mx-auto my-1  lg:py-6 py-2  ">
                                <table class="w-full  text-left  overflow-hidden">
                                    <thead>
                                        <tr>
                                            <th colspan="2"
                                                class="bg-[#2845F5] text-white text-lg font-bold py-4 px-6">
                                                {{ $lang['lived'] }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b ">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['90'] }}:
                                            </td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_years'][0] }}</strong>
                                                {{ $lang['years'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['91'] }}:
                                            </td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_months'][0] }}</strong>
                                                {{ $lang['months'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['92'] }}:
                                            </td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_weeks'][0] }}</strong>
                                                {{ $lang['weeks'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['93'] }}:
                                            </td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_days'][0] }}</strong>
                                                {{ $lang['days'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['94'] }}:
                                            </td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_hours'][0] }}</strong>
                                                {{ $lang['hours'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['95'] }}:
                                            </td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_minuts'][0] }}</strong>
                                                {{ $lang['minute'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['96'] }}:
                                            </td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_seconds'][0] }}</strong>
                                                {{ $lang['seconds'] }}
                                            </td>
                                        </tr>
                                        <?php
                                        $retirement_date = date('Y-m-d', strtotime($detail['dob_array'][0] . ' + 67 years'));
                                        $initialDate = new DateTime($retirement_date);
                                        [$to_saal, $to_mahina, $to_din] = explode('-', $detail['dates_array'][0]);
                                        $yearsToSubtract = $to_saal;
                                        $monthsToSubtract = $to_mahina;
                                        $daysToSubtract = $to_din;
                                        $interval = new DateInterval("P{$yearsToSubtract}Y{$monthsToSubtract}M{$daysToSubtract}D");
                                        $modifiedDate = $initialDate->sub($interval);
                                        $newDate = $modifiedDate->format('Y-m-d');
                                        $retirement_rem_years = $modifiedDate->format('y');
                                        $retirement_rem_months = $modifiedDate->format('m');
                                        $retirement_rem_days = $modifiedDate->format('d');
                                        ?>
                                        <tr class="bg-green-50 ">
                                            <td colspan="2"
                                                class="bg-[#2845F5] text-white text-lg font-bold py-4 px-6">
                                                {{ $lang['22'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang[23] }}:
                                            </td>
                                            <td
                                                class="py-4 px-6 text-gray-900 {{ app()->getLocale() == 'id' ? 'py-2 lg:py-4' : 'py-2' }}">
                                                {{ $detail['breath'][0] }} {{ $lang[24] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang[25] }}:
                                            </td>
                                            <td class="py-4 px-6 text-gray-900">
                                                {{ $detail['heartBeats'][0] }} {{ $lang[26] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang[29] }}:
                                            </td>
                                            <td class="py-4 px-6 text-gray-900">
                                                {{ $detail['laughed'][0] }} {{ $lang[26] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang[30] }}:
                                            </td>
                                            <td class="py-4 px-6 text-gray-900">
                                                {{ $detail['sleeping'][0] }} {{ $lang['years'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang[64] }}:
                                            </td>
                                            <td class="py-4 px-6 text-gray-900">
                                                {{ $detail['hair_length_m'][0] }} m
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang[65] }}:
                                            </td>
                                            <td class="py-4 px-6 text-gray-900">
                                                {{ $detail['nail_length_m'][0] }} m
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
    {{--  Sirf Flatpickr -- Litepicker hata diya --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            //  DOB Picker
            const dobPicker = flatpickr("#dob_picker", {
                dateFormat: "Y-m-d",
                maxDate: "today",
                minDate: "1940-01-01",
                defaultDate: "{{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}-{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}",
                disableMobile: true,
                onChange: function(selectedDates) {
                    const date = selectedDates[0];
                    @this.set('year', date.getFullYear());
                    @this.set('month', date.getMonth() + 1);
                    @this.set('day', date.getDate());
                }
            });

            document.getElementById('dob_btn').addEventListener('click', function(e) {
                e.preventDefault();
                dobPicker.open();
            });

            //  End Date Picker
            const secPicker = flatpickr("#sec_picker", {
                dateFormat: "Y-m-d",
                maxDate: "today",
                minDate: "1940-01-01",
                defaultDate: "{{ $year_sec }}-{{ str_pad($month_sec, 2, '0', STR_PAD_LEFT) }}-{{ str_pad($day_sec, 2, '0', STR_PAD_LEFT) }}",
                disableMobile: true,
                onChange: function(selectedDates) {
                    const date = selectedDates[0];
                    @this.set('year_sec', date.getFullYear());
                    @this.set('month_sec', date.getMonth() + 1);
                    @this.set('day_sec', date.getDate());
                }
            });

            document.getElementById('sec_btn').addEventListener('click', function(e) {
                e.preventDefault();
                secPicker.open();
            });

        });
    </script>

</div>
