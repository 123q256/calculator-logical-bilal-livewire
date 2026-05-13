<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <!-- Method -->
                    <div class="col-span-12">
                        <label for="method" class="label">{!! $lang['method'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="method" id="method" class="input">
                                <option value="1">{!! $lang['basic'] !!}</option>
                                <option value="2">{!! $lang['m_2'] !!}</option>
                                <option value="3">{!! $lang['m_3'] !!}</option>
                                <option value="4">Karvonen by Age & HRR</option>
                            </select>
                        </div>
                    </div>

                    <!-- Formula (Visible for methods 1, 2, 4) -->
                    @if($method != '3')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="formula" class="label">MHR {!! $lang['for'] !!}:</label>
                            <div class="w-full py-2 relative">
                                <select wire:model.live="formula" id="formula" class="input">
                                    <option value="1">Haskell & Fox (basic, for men)</option>
                                    <option value="2">Haskell & Fox (basic, for women)</option>
                                    <option value="3">Robergs & Landwehr</option>
                                    <option value="4">Londeree and Moeschberger</option>
                                    <option value="5">Miller et al.</option>
                                    <option value="6">Tanaka, Monahan, & Seals</option>
                                    <option value="7">Jackson et al.</option>
                                    <option value="8">Nes, et al.</option>
                                    <option value="9">Gellish (for men)</option>
                                    <option value="10">Gellish (for women)</option>
                                    <option value="11">Martha Gulati et al. (for women)</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <!-- Age (Visible for methods 1, 2, 4) -->
                    @if($method != '3')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="age" class="label">{!! $lang['your'] !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="age" id="age" class="input" placeholder="00" />
                                <span class="text-blue input_unit">{{ $lang['year'] }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- RHR (Visible for method 2) -->
                    @if($method == '2')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="rhr" class="label">RHR <span class="bg-white text-blue rounded-full px-2 ms-1 cursor-help" title="{!! $lang['rhr'] !!}">?</span>:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="rhr" id="rhr" class="input" placeholder="00" />
                                <span class="text-blue input_unit">bpm</span>
                            </div>
                        </div>
                    @endif

                    <!-- HRR (Visible for method 4) -->
                    @if($method == '4')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="hrr" class="label">HRR <span class="bg-white text-blue rounded-full px-2 ms-1 cursor-help" title="{!! $lang['hrr'] !!}">?</span>:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="hrr" id="hrr" class="input" placeholder="00" />
                                <span class="text-blue input_unit">bpm</span>
                            </div>
                        </div>
                    @endif

                    <!-- MHR (Visible for method 3) -->
                    @if($method == '3')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="mhr_input" class="label">MHR <span class="bg-white text-blue rounded-full px-2 ms-1 cursor-help" title="{!! $lang['mhr'] !!}">?</span>:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="mhr_input" id="mhr_input" class="input" placeholder="00" />
                                <span class="text-blue input_unit">bpm</span>
                            </div>
                        </div>
                    @endif

                    <!-- RHR for Method 3 -->
                    @if($method == '3')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="rhrm" class="label">RHR <span class="bg-white text-blue rounded-full px-2 ms-1 cursor-help" title="{!! $lang['rhr'] !!}">?</span>:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="rhrm" id="rhrm" class="input" placeholder="00" />
                                <span class="text-blue input_unit">bpm</span>
                            </div>
                        </div>
                    @endif

                    <!-- Desire % -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="percent" class="label">{!! $lang['desire'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="percent" id="percent" min="1" max="100" class="input" placeholder="00" />
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>

                    <!-- Training Max -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="ideal" class="label">{!! $lang['train'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="ideal" id="ideal" class="input">
                                <option value="0.65">{!! $lang['bf'] !!}</option>
                                <option value="0.75">{!! $lang['sf'] !!}</option>
                                <option value="0.85">{!! $lang['tmax'] !!}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="w-full mt-5">
                    <div class="w-full">
                        @if($method == '2' || $method == '3')
                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2" style="border: 1px solid #c1b8b899">
                                <strong>{{ $lang['hrr'] }} (HRR) =</strong>
                                <strong class="text-green-700 text-[28px]">{{ $detail['mhr'] - $detail['rhr'] }}</strong>
                                <strong>bpm</strong>
                            </div>
                        @elseif($method == '4')
                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2" style="border: 1px solid #c1b8b899">
                                <strong>{{ $lang['rhr'] }} (RHR) =</strong>
                                <strong class="text-green-700 text-[28px]">{{ $detail['rhr'] }}</strong>
                                <strong>bpm</strong>
                            </div>
                        @endif

                        <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2" style="border: 1px solid #c1b8b899">
                            <strong>{{ $lang['tar_des'] }} =</strong>
                            <strong class="text-green-700 text-[28px]">
                                @if($method == '1')
                                    {{ round($detail['mhr'] * ($percent / 100)) }}
                                @else
                                    {{ round((($detail['mhr'] - $detail['rhr']) * ($percent / 100)) + $detail['rhr']) }}
                                @endif
                            </strong>
                            <strong>bpm</strong>
                        </div>

                        <div class="bg-sky border rounded-lg px-3 py-2 mt-2">
                            <strong>{{ $lang['ihr'] }} =</strong>
                            <strong class="text-green-700 text-[28px]">
                                @if($method == '1')
                                    {{ round($detail['mhr'] * $ideal) }}
                                @else
                                    {{ round((($detail['mhr'] - $detail['rhr']) * $ideal) + $detail['rhr']) }}
                                @endif
                            </strong>
                            <strong>bpm</strong>
                        </div>

                        <div class="bg-sky border rounded-lg px-3 py-2 mt-2">
                            <strong>{{ $lang['mhr'] }} (MHR) =</strong>
                            <strong class="text-green-700 text-[28px]">{{ $detail['mhr'] }}</strong>
                            <strong>bpm</strong>
                        </div>

                        <!-- Zone Table 1 -->
                        <div class="w-full overflow-auto mt-4">
                            <table class="w-full" cellspacing="0">
                                <tr class="bg-[#2845F5] text-white">
                                    <td class="text-center border-b-4 border-indigo-500 rounded-t-lg ps-4 px-3 py-2" colspan="3">{{ $lang['chat1'] }}</td>
                                </tr>
                                <tr class="bg-[#2845F5] text-white">
                                    <td class="ps-4 px-3 py-2">{{ $lang['target'] }}</td>
                                    <td class="px-3">% {{ $lang['in'] }}</td>
                                    <td class="px-3">{{ $lang['thr'] }}</td>
                                </tr>
                                
                                @php
                                    $zones = [
                                        ['label' => $lang['max'] . ' <strong>VO<sub>2</sub> ' . $lang['max_z'] . '</strong>', 'min' => 0.9, 'max' => 1.0],
                                        ['label' => $lang['Hard'] . ' <strong>' . $lang['an_zone'] . '</strong>', 'min' => 0.8, 'max' => 0.9],
                                        ['label' => $lang['mod'] . ' <strong>' . $lang['ar_zone'] . '</strong>', 'min' => 0.7, 'max' => 0.8],
                                        ['label' => $lang['Light'] . ' <strong>' . $lang['fat_zone'] . '</strong>', 'min' => 0.6, 'max' => 0.7],
                                        ['label' => $lang['v_light'] . ' <strong>' . $lang['w_zone'] . '</strong>', 'min' => 0.5, 'max' => 0.6],
                                    ];
                                @endphp

                                @foreach($zones as $zone)
                                    <tr>
                                        <td class="border-b px-3 py-2">{!! $zone['label'] !!}</td>
                                        <td class="border-b px-3 py-2">{{ ($zone['min'] * 100) }}% - {{ ($zone['max'] * 100) }}%</td>
                                        <td class="border-b px-3 py-2">
                                            <strong>
                                                @if($method == '1')
                                                    {{ round($detail['mhr'] * $zone['min']) }} - {{ round($detail['mhr'] * $zone['max']) }}
                                                @else
                                                    {{ round((($detail['mhr'] - $detail['rhr']) * $zone['min']) + $detail['rhr']) }} - {{ round((($detail['mhr'] - $detail['rhr']) * $zone['max']) + $detail['rhr']) }}
                                                @endif
                                            </strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <!-- Zone Table 2 -->
                        <div class="w-full overflow-auto mt-4">
                            <table class="w-full" cellspacing="0">
                                <tr class="bg-[#2845F5] text-white">
                                    <td class="text-center border-b-2 border-white rounded-t-lg ps-4 px-3 py-2" colspan="3">{{ $lang['chart2'] }}</td>
                                </tr>
                                <tr class="bg-[#2845F5] text-white">
                                    <td class="ps-4 px-3 py-2">{{ $lang['target'] }}</td>
                                    <td class="px-3">% {{ $lang['in'] }}</td>
                                    <td class="px-3">{{ $lang['thr'] }}</td>
                                </tr>
                                @php
                                    $offsets = [
                                        ['label' => $lang['max'] . ' <strong>VO<sub>2</sub> ' . $lang['max_z'] . '</strong>', 'off_min' => 15, 'off_max' => 0],
                                        ['label' => $lang['Hard'] . ' <strong>' . $lang['an_zone'] . '</strong>', 'off_min' => 25, 'off_max' => 15],
                                        ['label' => $lang['mod'] . ' <strong>' . $lang['ar_zone'] . '</strong>', 'off_min' => 35, 'off_max' => 25],
                                        ['label' => $lang['Light'] . ' <strong>' . $lang['fat_zone'] . '</strong>', 'off_min' => 45, 'off_max' => 35],
                                        ['label' => $lang['v_light'] . ' <strong>' . $lang['w_zone'] . '</strong>', 'off_min' => 55, 'off_max' => 45],
                                    ];
                                @endphp
                                @foreach($offsets as $offset)
                                    <tr>
                                        <td class="border-b px-3 py-2">{!! $offset['label'] !!}</td>
                                        <td class="border-b px-3 py-2">{{ round(($detail['mhr'] - $offset['off_min']) / $detail['mhr'] * 100) }}% - {{ round(($detail['mhr'] - $offset['off_max']) / $detail['mhr'] * 100) }}%</td>
                                        <td class="border-b px-3 py-2"><strong>{{ $detail['mhr'] - $offset['off_min'] }} - {{ $detail['mhr'] - $offset['off_max'] }}</strong></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
