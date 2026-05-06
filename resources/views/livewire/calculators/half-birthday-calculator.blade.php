<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <label for="year" class="font-s-14 text-blue">{{ $lang['y'] }}:</label>
                        <select wire:model.live="year" id="year" class="input">
                            @for ($i = 1940; $i <= date('Y'); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="month" class="font-s-14 text-blue">{{ $lang['m'] }}:</label>
                        <select wire:model.live="month" id="month" class="input">
                            @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $index => $name)
                                <option value="{{ $index + 1 }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="day" class="font-s-14 text-blue">{{ $lang['d'] }}:</label>
                        <select wire:model.live="day" id="day" class="input">
                            @php
                                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year);
                            @endphp
                            @for ($i = 1; $i <= $daysInMonth; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
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

        <hr>

        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full bg-light-blue p-4 lg:p-3 rounded-[10px] mt-3">
                                <div class="lg:w-[90%] w-flull overflow-auto">
                                    <table class="w-full border-collapse">
                                        <tr class="border-b border-blue-200">
                                            <td class="w-[55%] py-3"><strong>{{ $lang['7'] }} :</strong></td>
                                            <td class="py-3 text-blue-700 font-bold text-[20px]">{{ $detail['next_half'] }}</td>
                                        </tr>
                                        <tr class="border-b border-blue-100">
                                            <td class="py-3">{{ $lang[11] }} :</td>
                                            <td class="py-3 font-medium text-gray-800">{{ $detail['first_Q'] }}</td>
                                        </tr>
                                        <tr class="border-b border-blue-100">
                                            <td class="py-3">{{ $lang[14] }} :</td>
                                            <td class="py-3 font-medium text-gray-800">{{ $detail['third_Q'] }}</td>
                                        </tr>
                                        <tr class="border-b border-blue-200">
                                            <td class="py-3"><strong>{{ $lang[15] }} <span class="underline">{{ $lang[16] }}</span> {{ $lang[17] }} :</strong></td>
                                            <td class="py-3 text-green-700 font-bold text-[20px]">{{ $detail['next_bday'] }}</td>
                                        </tr>
                                        <tr class="border-b border-blue-100">
                                            <td class="py-3">{{ $lang['10'] }} :</td>
                                            <td class="py-3"><span class="font-bold text-gray-800">{{ $detail['next_half_days'] }}</span> {{ $lang[13] }}</td>
                                        </tr>
                                        <tr class="border-b border-blue-100">
                                            <td class="py-3">{{ $lang['12'] }} {{ $lang[18] }} :</td>
                                            <td class="py-3"><span class="font-bold text-gray-800">{{ $detail['first_Q_days'] }}</span> {{ $lang[13] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3">{{ $lang['12'] }} {{ $lang[19] }} :</td>
                                            <td class="py-3"><span class="font-bold text-gray-800">{{ $detail['third_Q_days'] }}</span> {{ $lang[13] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
</div>
