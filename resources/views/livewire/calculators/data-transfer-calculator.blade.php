<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="first" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="grid grid-cols-12 mt-3 gap-4">
                            <div class="col-span-7">
                                <input type="number" wire:model.live="first" id="first" class="input" aria-label="input" placeholder="620" />
                            </div>
                            <div class="col-span-5">
                                <select wire:model.live="f_unit" id="f_unit" class="input">
                                    @php
                                        $units = ["B", "kB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB", "bit", "kbit", "Mbit", "Gbits", "Tbit", "KiB", "MiB", "GiB", "TiB", "PiB", "EiB", "ZiB", "YiB", "Kibit", "Mibit", "Gibit", "Tibit"];
                                    @endphp
                                    @foreach ($units as $index => $unit)
                                        <option value="{{ $index + 1 }}">{{ $unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="second" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        <div class="grid grid-cols-12 mt-3 gap-4">
                            <div class="col-span-7">
                                <input type="number" wire:model.live="second" id="second" class="input" aria-label="input" placeholder="2" />
                            </div>
                            <div class="col-span-5">
                                <select wire:model.live="s_unit" id="s_unit" class="input">
                                    @php
                                        $units = ["B/s", "kB/s", "MB/s", "GB/s", "TB/s", "PB/s", "EB/s", "ZB/s", "YB/s", "bit/s", "kbit/s", "Mbit/s", "Gbits/s", "Tbit/s", "KiB/s", "MiB/s", "GiB/s", "TiB/s", "PiB/s", "EiB/s", "ZiB/s", "YiB/s", "Kibit/s", "Mibit/s", "Gibit/s", "Tibit/s"];
                                    @endphp
                                    @foreach ($units as $index => $unit)
                                        <option value="{{ $index + 1 }}">{{ $unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="overhead" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="overhead" id="overhead" class="input">
                                <option value="1">{{ $lang['4'] }}: 0%</option>
                                <option value="2">{{ $lang['4'] }}: 5%</option>
                                <option value="3">{{ $lang['4'] }}: 10%</option>
                                <option value="4">{{ $lang['4'] }}: 20%</option>
                                <option value="5">{{ $lang['4'] }}: 30%</option>
                                <option value="6">{{ $lang['4'] }}: 40%</option>
                                <option value="7">{{ $lang['4'] }}: 50%</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="kilo" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="kilo" id="kilo" class="input">
                                <option value="1">1024</option>
                                <option value="2">1000</option>
                            </select>
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
                                <div class="w-full my-2">
                                    <div class="w-full lg:w-[80%] overflow-auto">
                                        @php
                                            $min = round($detail['jawab'] / 60, 5);
                                            $hrs = round($detail['jawab'] / 3600, 5);
                                            $days = round($detail['jawab'] / 86400, 5);
                                            $wks = round($detail['jawab'] / 604800, 5);
                                            list($hours_ans, $minutes_ans, $seconds_ans) = explode(":", trim($detail['main_ans']));
                                        @endphp
                                        <p class="text-[25px] mb-4 text-center"><strong>{{ $lang[5] }}</strong></p>

                                        <div class="flex flex-wrap justify-center gap-8 my-4 text-center">
                                            <div class="px-4">
                                                <p class="text-[30px] font-bold text-blue-600">{{ (int)$hours_ans }}</p>
                                                <p class="text-gray-500 text-sm">Hours</p>
                                            </div>
                                            <div class="px-4">
                                                <p class="text-[30px] font-bold text-blue-600">{{ (int)$minutes_ans }}</p>
                                                <p class="text-gray-500 text-sm">Minutes</p>
                                            </div>
                                            <div class="px-4">
                                                <p class="text-[30px] font-bold text-blue-600">{{ (int)$seconds_ans }}</p>
                                                <p class="text-gray-500 text-sm">Seconds</p>
                                            </div>
                                        </div>

                                        <table class="w-full mt-8 border-t border-gray-100">
                                            <tr class="bg-gray-50">
                                                <th class="py-2 px-4 text-left border-b">Time Unit</th>
                                                <th class="py-2 px-4 text-left border-b">Value</th>
                                            </tr>
                                            <tr>
                                                <td class="py-2 px-4 border-b">Time in Days</td>
                                                <td class="py-2 px-4 border-b font-medium">{{ $days }} Days</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 px-4 border-b">Time in Weeks</td>
                                                <td class="py-2 px-4 border-b font-medium">{{ $wks }} Weeks</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 px-4 border-b">Time in Hours</td>
                                                <td class="py-2 px-4 border-b font-medium">{{ $hrs }} Hours</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 px-4 border-b">Time in Minutes</td>
                                                <td class="py-2 px-4 border-b font-medium">{{ $min }} Minutes</td>
                                            </tr>
                                        </table>

                                        <div class="mt-8 overflow-x-auto">
                                            <table class="w-full text-center border-collapse">
                                                <thead>
                                                    <tr class="bg-blue-50 text-blue-700">
                                                        <th class="border py-2 px-4"><strong>{{ $lang[6] }}</strong></th>
                                                        <th class="border py-2 px-4"><strong>{{ $lang[7] }}</strong></th>
                                                        <th class="border py-2 px-4"><strong>{{ $lang[8] }}</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $comparisons = [
                                                            ['T1/DS1 ' . ($lang[9] ?? 'Line'), '1.544 Mbps', 'f1'],
                                                            [$lang[10] ?? 'Ethernet', '10 Mbps', 'f2'],
                                                            [$lang[11] ?? 'Fast Ethernet', '100 Mbps', 'f3'],
                                                            [$lang[12] ?? 'Gigabit Ethernet', '1000 Mbps', 'f4'],
                                                            ['10 ' . ($lang[13] ?? 'Gigabit'), '10 Gbps', 'f5'],
                                                            ['USB 2.0', '480 Mbps', 'f6'],
                                                            ['USB 3.0', '5 Gbps', 'f7'],
                                                            [$lang[14] ?? 'Thunderbolt', '10 Gbps', 'f8'],
                                                            [($lang[14] ?? 'Thunderbolt') . ' 2', '20 Gbps', 'f9'],
                                                        ];
                                                    @endphp
                                                    @foreach ($comparisons as $item)
                                                        <tr class="hover:bg-gray-50 transition-colors">
                                                            <td class="border py-2 px-4">{{ $item[0] }}</td>
                                                            <td class="border py-2 px-4">{{ $item[1] }}</td>
                                                            <td class="border py-2 px-4 font-mono text-sm">{{ $detail[$item[2]] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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
