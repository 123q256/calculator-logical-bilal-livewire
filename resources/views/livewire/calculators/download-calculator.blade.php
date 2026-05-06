<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select wire:model.live="operations" id="operations" class="input my-2">
                            <option value="1">{{ $lang['2'] }}</option>
                            <option value="2">{{ $lang['3'] }}</option>
                            <option value="3">{{ $lang['4'] }}</option>
                        </select>
                    </div>

                    @if ($operations == '1' || $operations == '2')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="first" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <div x-data="{ open: false }" class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="first" id="first" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $f_unit }} ▾</label>
                                <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-60 overflow-y-auto">
                                    @foreach (['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB', 'bit', 'kbit', 'Mbit', 'Gbits', 'Tbit', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB', 'Kibit', 'Mibit', 'Gibit', 'Tibit'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('f_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($operations == '2' || $operations == '3')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="third" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                            <div x-data="{ open: false }" class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="third" id="third" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $t_unit }} ▾</label>
                                <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (['sec', 'min', 'hrs', 'days', 'wks', 'mos', 'yrs'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('t_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($operations == '1' || $operations == '3')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="second" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            <div x-data="{ open: false }" class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="second" id="second" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $s_unit }} ▾</label>
                                <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-60 overflow-y-auto">
                                    @foreach (['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB', 'bit', 'kbit', 'Mbit', 'Gbits', 'Tbit', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB', 'Kibit', 'Mibit', 'Gibit', 'Tibit'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('s_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
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
                            <div class="w-full mt-3">
                                <div class="w-full my-1">
                                    <div class="w-full md:w-[80%] lg:w-[80%] lg:text-[18px] md:text-[18px] text-[16px] overflow-auto">
                                        @if ($operations == 1)
                                            @php
                                                $min = round($detail['jawab'] / 60, 5);
                                                $hrs = round($detail['jawab'] / 3600, 5);
                                                $days = round($detail['jawab'] / 86400, 5);
                                                $wks = round($detail['jawab'] / 604800, 5);
                                            @endphp
                                            <table class="w-full">
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[2] }} :</strong></td>
                                                    <td class="border-b py-2">{{ $detail['jawab'] . ' sec' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[2] }} (min) :</strong></td>
                                                    <td class="border-b py-2">{{ $min . ' min' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[2] }} (hrs) :</strong></td>
                                                    <td class="border-b py-2">{{ $hrs . ' hrs' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[2] }} (days) :</strong></td>
                                                    <td class="border-b py-2">{{ $days . ' days' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[2] }} (wks) :</strong></td>
                                                    <td class="border-b py-2">{{ $wks . ' wks' }}</td>
                                                </tr>
                                            </table>
                                            <table class="w-full text-center mt-6">
                                                <tr class="bg-gray-100">
                                                    <th class="border-b py-2"><strong>{{ $lang[5] }}</strong></th>
                                                    <th class="border-b py-2"><strong>{{ $lang[3] }}</strong></th>
                                                    <th class="border-b py-2"><strong>{{ $lang[2] }}</strong></th>
                                                </tr>
                                                @php
                                                    $bandwidths = [
                                                        ['Modem', '28,8 kbit/s', 'f1'],
                                                        ['Modem', '56,6 kbit/s', 'f2'],
                                                        ['ADSL', '256 kbit/s', 'f3'],
                                                        ['ADSL', '512 kbit/s', 'f4'],
                                                        ['ADSL', '1 Mbit/s', 'f5'],
                                                        ['ADSL', '2 Mbit/s', 'f6'],
                                                        ['ADSL', '8 Mbit/s', 'f7'],
                                                        ['ADSL', '24 Mbit/s', 'f8'],
                                                        ['LAN', '10 Mbit/s', 'f9'],
                                                        ['LAN', '100 Mbit/s', 'f10'],
                                                        ['Mobile 3G', '7,2 Mbit/s', 'f11'],
                                                        ['4G', '80 Mbit/s', 'f12'],
                                                        ['5G', '1 Gbit/s', 'f13'],
                                                    ];
                                                @endphp
                                                @foreach ($bandwidths as $bw)
                                                    <tr>
                                                        <td class="border-b py-2">{{ $bw[0] }}</td>
                                                        <td class="border-b py-2">{{ $bw[1] }}</td>
                                                        <td class="border-b py-2">{{ $detail[$bw[2]] }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @elseif ($operations == 2)
                                            @php
                                                $kb = $detail['jawab'] * 1000;
                                                $gb = $detail['jawab'] / 1000;
                                                $tb = $detail['jawab'] / 1000000;
                                                $b = $detail['jawab'] * 1000000;
                                            @endphp
                                            <table class="w-full">
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[3] }} :</strong></td>
                                                    <td class="border-b py-2">{{ $detail['jawab'] . ' MB' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[3] }} (b) :</strong></td>
                                                    <td class="border-b py-2">{{ $b . ' b' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[3] }} (kb) :</strong></td>
                                                    <td class="border-b py-2">{{ $kb . ' kb' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[3] }} (gb) :</strong></td>
                                                    <td class="border-b py-2">{{ $gb . ' gb' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[3] }} (tb) :</strong></td>
                                                    <td class="border-b py-2">{{ $tb . ' tb' }}</td>
                                                </tr>
                                            </table>
                                        @elseif ($operations == 3)
                                            @php
                                                $kb = $detail['jawab'] * 1000;
                                                $gb = $detail['jawab'] / 1000;
                                                $tb = $detail['jawab'] / 1000000;
                                                $b = $detail['jawab'] * 1000000;
                                            @endphp
                                            <table class="w-full">
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[4] }} :</strong></td>
                                                    <td class="border-b py-2">{{ $detail['jawab'] . ' MB' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[4] }} (b) :</strong></td>
                                                    <td class="border-b py-2">{{ $b . ' b' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[4] }} (kb) :</strong></td>
                                                    <td class="border-b py-2">{{ $kb . ' kb' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[4] }} (gb) :</strong></td>
                                                    <td class="border-b py-2">{{ $gb . ' gb' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[4] }} (tb) :</strong></td>
                                                    <td class="border-b py-2">{{ $tb . ' tb' }}</td>
                                                </tr>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
</div>
