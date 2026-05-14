<div>
    <style>
        .radius-l-10 { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
        .radius-r-10 { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }
        .bg-dark-blue { background-color: #2845F5; }
        .bg-red { background-color: #EF4444; }
        .text-blue { color: #2845F5; }
        .text-green { color: #10B981; }
        .font-s-20 { font-size: 20px; }
        .font-s-25 { font-size: 25px; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[85%] md:w-[85%] w-full mx-auto" x-data="{ testUnits: @entangle('test_units') }">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">

                    <!-- Unit Type -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{!! $lang['19'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="unit_type" class="input">
                                <option value="1">{{ $lang['20'] }}</option>
                                <option value="2">{{ $lang['21'] }}</option>
                                <option value="3">{{ $lang['22'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Test Units (Toggles Leg Tuck/Plank) -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{!! $lang['1'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="test_units" class="input">
                                <option value="1">{{ $lang['8'] }}</option>
                                <option value="2">{{ $lang['6'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Deadlift -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{!! $lang['2'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="deadlift" class="input" placeholder="00">
                            <span class="input_unit">lbs</span>
                        </div>
                    </div>

                    <!-- Standing Power Throw -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{!! $lang['3'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="standing_power_throw" class="input" placeholder="00">
                            <span class="input_unit">m</span>
                        </div>
                    </div>

                    <!-- Hand Release Push-Ups -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{!! $lang['4'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="hand_release" class="input" placeholder="00">
                            <span class="input_unit">{{ $lang['23'] }}</span>
                        </div>
                    </div>

                    <!-- Sprint-Drag-Carry -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 grid grid-cols-2 gap-2">
                        <div class="col-span-1">
                            <label class="label">{!! $lang['5'] !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="sprint_min" class="input" placeholder="00">
                                <span class="input_unit">min</span>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <label class="label">&nbsp;</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="sprint_sec" class="input" placeholder="00">
                                <span class="input_unit">sec</span>
                            </div>
                        </div>
                    </div>

                    <!-- Plank (Hidden by default, shown if test_units is 2) -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 grid grid-cols-2 gap-2" x-show="testUnits == '2'" x-cloak>
                        <div class="col-span-1">
                            <label class="label">{!! $lang['6'] !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="plank_min" class="input" placeholder="00">
                                <span class="input_unit">min</span>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <label class="label">&nbsp;</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="plank_sec" class="input" placeholder="00">
                                <span class="input_unit">sec</span>
                            </div>
                        </div>
                    </div>

                    <!-- 2-Mile Run -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 grid grid-cols-2 gap-2">
                        <div class="col-span-1">
                            <label class="label">{!! $lang['7'] !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="mile_min" class="input" placeholder="00">
                                <span class="input_unit">min</span>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <label class="label">&nbsp;</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="mile_sec" class="input" placeholder="00">
                                <span class="input_unit">sec</span>
                            </div>
                        </div>
                    </div>

                    <!-- Leg Tuck (Shown if test_units is 1) -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="testUnits == '1'" x-cloak>
                        <label class="label">{!! $lang['8'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="leg_tuck" class="input" placeholder="00">
                            <span class="input_unit">reps</span>
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
    </form>

    <!-- Result Section -->
    @isset($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg">
                    <div class="w-full mt-5">
                        <div class="w-full overflow-auto mt-2">
                            <table class="w-full" cellspacing="0">
                                <tr class="bg-[#2845F5] text-white">
                                    <td class="radius-l-10 ps-4 pe-3 py-2">{{ $lang['9'] }}</td>
                                    <td class="px-3">{{ $lang['24'] }}</td>
                                    <td class="px-3">{{ $lang['11'] }}</td>
                                    <td class="radius-r-10 px-3 text-center">{{ $lang['res'] }}</td>
                                </tr>

                                {{-- Deadlift --}}
                                @if($detail['dead_lift_score'] !== "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['25'] }}</td>
                                    <td class="border-b px-3">{{ $deadlift }} lb</td>
                                    <td class="border-b px-3">{{ $detail['dead_lift_score'] }}</td>
                                    <td class="border-b px-3 text-center">
                                        <p class="inline-block px-4 py-1 rounded {{ $detail['dead_lift_score'] >= $detail['min_score'] ? 'bg-dark-blue' : 'bg-red' }} text-white">
                                            {{ $detail['dead_lift_score'] >= $detail['min_score'] ? 'Passed' : 'Fail' }}
                                        </p>
                                    </td>
                                </tr>
                                @endif

                                {{-- Hand Release --}}
                                @if($detail['hand_release_answer'] !== "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['26'] }}</td>
                                    <td class="border-b px-3">{{ $hand_release }}</td>
                                    <td class="border-b px-3">{{ $detail['hand_release_answer'] }}</td>
                                    <td class="border-b px-3 text-center">
                                        <p class="inline-block px-4 py-1 rounded {{ $detail['hand_release_answer'] >= $detail['min_score'] ? 'bg-dark-blue' : 'bg-red' }} text-white">
                                            {{ $detail['hand_release_answer'] >= $detail['min_score'] ? 'Passed' : 'Fail' }}
                                        </p>
                                    </td>
                                </tr>
                                @endif

                                {{-- Sprint Drag Carry --}}
                                @if($detail['spring_drag_score_answer'] !== "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['13'] }}</td>
                                    <td class="border-b px-3">{{ $sprint_min }}:{{ str_pad($sprint_sec, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="border-b px-3">{{ $detail['spring_drag_score_answer'] }}</td>
                                    <td class="border-b px-3 text-center">
                                        <p class="inline-block px-4 py-1 rounded {{ $detail['spring_drag_score_answer'] >= $detail['min_score'] ? 'bg-dark-blue' : 'bg-red' }} text-white">
                                            {{ $detail['spring_drag_score_answer'] >= $detail['min_score'] ? 'Passed' : 'Fail' }}
                                        </p>
                                    </td>
                                </tr>
                                @endif

                                {{-- Leg Tuck --}}
                                @if($test_units == '1' && isset($detail['leg_tuck_answer']) && $detail['leg_tuck_answer'] !== "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['8'] }}</td>
                                    <td class="border-b px-3">{{ $leg_tuck }}</td>
                                    <td class="border-b px-3">{{ $detail['leg_tuck_answer'] }}</td>
                                    <td class="border-b px-3 text-center">
                                        <p class="inline-block px-4 py-1 rounded {{ $detail['leg_tuck_answer'] >= $detail['min_score'] ? 'bg-dark-blue' : 'bg-red' }} text-white">
                                            {{ $detail['leg_tuck_answer'] >= $detail['min_score'] ? 'Passed' : 'Fail' }}
                                        </p>
                                    </td>
                                </tr>
                                @endif

                                {{-- Plank --}}
                                @if($test_units == '2' && isset($detail['plank_answer']) && $detail['plank_answer'] !== "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['6'] }}</td>
                                    <td class="border-b px-3">{{ $plank_min }}:{{ str_pad($plank_sec, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="border-b px-3">{{ $detail['plank_answer'] }}</td>
                                    <td class="border-b px-3 text-center">
                                        <p class="inline-block px-4 py-1 rounded {{ $detail['plank_answer'] >= $detail['min_score'] ? 'bg-dark-blue' : 'bg-red' }} text-white">
                                            {{ $detail['plank_answer'] >= $detail['min_score'] ? 'Passed' : 'Fail' }}
                                        </p>
                                    </td>
                                </tr>
                                @endif

                                {{-- 2-Mile Run --}}
                                @if($detail['two_miles_run_values'] !== "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['7'] }}</td>
                                    <td class="border-b px-3">{{ $mile_min }}:{{ str_pad($mile_sec, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="border-b px-3">{{ $detail['two_miles_run_values'] }}</td>
                                    <td class="border-b px-3 text-center">
                                        <p class="inline-block px-4 py-1 rounded {{ $detail['two_miles_run_values'] >= $detail['min_score'] ? 'bg-dark-blue' : 'bg-red' }} text-white">
                                            {{ $detail['two_miles_run_values'] >= $detail['min_score'] ? 'Passed' : 'Fail' }}
                                        </p>
                                    </td>
                                </tr>
                                @endif

                                {{-- Standing Power Throw --}}
                                @if($detail['power_throw_score_answer'] !== "")
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['14'] }}</td>
                                    <td class="border-b px-3">{{ $standing_power_throw }} m</td>
                                    <td class="border-b px-3">{{ $detail['power_throw_score_answer'] }}</td>
                                    <td class="border-b px-3 text-center">
                                        <p class="inline-block px-4 py-1 rounded {{ $detail['power_throw_score_answer'] >= $detail['min_score'] ? 'bg-dark-blue' : 'bg-red' }} text-white">
                                            {{ $detail['power_throw_score_answer'] >= $detail['min_score'] ? 'Passed' : 'Fail' }}
                                        </p>
                                    </td>
                                </tr>
                                @endif

                                {{-- Total Score --}}
                                <tr class="font-bold">
                                    <td class="px-3 py-3" colspan="2">{{ $lang['15'] }}</td>
                                    @php
                                        $plk = (int)($detail['plank_answer'] ?? 0);
                                        $ltk = (int)($detail['leg_tuck_answer'] ?? 0);
                                        $total = $detail['dead_lift_score'] + $detail['power_throw_score_answer'] + $detail['two_miles_run_values'] + $plk + $ltk + $detail['spring_drag_score_answer'] + $detail['hand_release_answer'];
                                        
                                        $failed = ($detail['dead_lift_score'] < $detail['min_score'] || 
                                                   $detail['power_throw_score_answer'] < $detail['min_score'] || 
                                                   $detail['two_miles_run_values'] < $detail['min_score'] || 
                                                   ($test_units == '2' && ($detail['plank_answer'] ?? 0) < $detail['min_score']) || 
                                                   ($test_units == '1' && ($detail['leg_tuck_answer'] ?? 0) < $detail['min_score']) || 
                                                   $detail['spring_drag_score_answer'] < $detail['min_score'] || 
                                                   $detail['hand_release_answer'] < $detail['min_score']);
                                    @endphp
                                    <td class="px-3">{{ $total }}</td>
                                    <td class="px-3 text-center">
                                        <p class="inline-block px-4 py-1 rounded {{ !$failed ? 'bg-dark-blue' : 'bg-red' }} text-white">
                                            {{ !$failed ? 'Passed' : 'Fail' }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <p class="w-full font-bold text-[20px] mt-8">{{ $lang['16'] }}:</p>
                        <div class="w-full overflow-auto mt-2">
                            <table class="w-full" cellspacing="0">
                                <tr class="bg-[#2845F5] text-white">
                                    <td class="radius-l-10 ps-4 pe-3 py-2">{{ $lang['9'] }}</td>
                                    <td class="px-3">{{ $lang['17'] }}</td>
                                    <td class="radius-r-10 px-3">{{ $lang['18'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['25'] }}</td>
                                    <td class="border-b px-3">{{ $deadlift }} lb</td>
                                    <td class="border-b px-3">{{ $detail['mdl_value'] }} lb</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['26'] }}</td>
                                    <td class="border-b px-3">{{ $hand_release }} Reps</td>
                                    <td class="border-b px-3">{{ $detail['hrp_value'] }} Reps</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['13'] }}</td>
                                    <td class="border-b px-3">{{ $sprint_min }}:{{ str_pad($sprint_sec, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="border-b px-3">{{ $detail['sdc_value'] }}</td>
                                </tr>
                                @if($test_units == '1')
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['8'] }}</td>
                                    <td class="border-b px-3">{{ $leg_tuck }} Reps</td>
                                    <td class="border-b px-3">{{ $detail['ltk_value'] }} Reps</td>
                                </tr>
                                @else
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['6'] }}</td>
                                    <td class="border-b px-3">{{ $plank_min }}:{{ str_pad($plank_sec, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="border-b px-3">{{ $detail['plk_value'] }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['7'] }}</td>
                                    <td class="border-b px-3">{{ $mile_min }}:{{ str_pad($mile_sec, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="border-b px-3">{{ $detail['two_miles_run_values_score'] ?? $detail['two_miles_run_values'] }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">{{ $lang['14'] }}</td>
                                    <td class="px-3">{{ $standing_power_throw }} m</td>
                                    <td class="px-3">{{ $detail['spt_value'] }} m</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
