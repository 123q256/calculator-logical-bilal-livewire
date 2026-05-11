<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    {{-- Gender --}}
                    <div class="col-span-6">
                        <label for="gender" class="label">{{ $lang['gen'] ?? 'Gender' }}:</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="gender" id="gender" class="input">
                                <option value="Male">{{ $lang['male'] ?? 'Male' }}</option>
                                <option value="Female">{{ $lang['female'] ?? 'Female' }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- IPPT Type --}}
                    <div class="col-span-6">
                        <label for="ippt_type" class="label">{{ $lang['type'] ?? 'Type' }}:</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="ippt_type" id="ippt_type" class="input">
                                <option value="NSM">NSMEN</option>
                                <option value="NSF">{{ $lang['active'] ?? 'Active' }}/NSF</option>
                            </select>
                        </div>
                    </div>

                    {{-- Age --}}
                    <div class="col-span-6">
                        <label for="age" class="label">{{ $lang['age'] ?? 'Age' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="age" id="age" min="18" max="60" class="input" placeholder="00" required />
                            <span class="text-blue input_unit">{{ $lang['year'] ?? 'Years' }}</span>
                        </div>
                    </div>

                    {{-- Push-ups --}}
                    <div class="col-span-6">
                        <label for="push" class="label">{{ $lang['push'] ?? 'Push-ups' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="push" id="push" min="1" max="60" class="input" placeholder="00" required />
                            <span class="text-blue input_unit">{{ $lang['rep'] ?? 'Reps' }}</span>
                        </div>
                    </div>

                    {{-- Sit-ups --}}
                    <div class="col-span-6">
                        <label for="sit" class="label">{{ $lang['sit'] ?? 'Sit-ups' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="sit" id="sit" min="1" max="60" class="input" placeholder="00" required />
                            <span class="text-blue input_unit">{{ $lang['rep'] ?? 'Reps' }}</span>
                        </div>
                    </div>

                    {{-- Run Time --}}
                    <div class="col-span-6">
                        <label for="time" class="label">{{ $lang['run'] ?? '2.4km Run' }} (MM:SS):</label>
                        <div class="w-100 py-2 relative">
                            @if ($gender === 'Male')
                                <select wire:model.live="time" id="time" class="input">
                                    @foreach ($male_times as $index => $label)
                                        <option value="{{ $index }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            @else
                                <select wire:model.live="time_fe" id="time_fe" class="input">
                                    @foreach ($female_times as $index => $label)
                                        <option value="{{ $index }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($type == 'calculator')
            @include('inc.button')
        @elseif ($type == 'widget')
            @include('inc.widget-button')
        @endif
    </form>

    @if ($detail)
        <hr class="my-6">
        <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full mt-2">
                            @php
                                $status = $detail['status'];
                                $score = $detail['score'];
                                $toNext = $detail['to_next'];
                            @endphp

                            @if($status == 'Fail')
                                <p class="text-[20px]"><strong class="text-red-700">{{ $lang['fail'] ?? 'Fail' }}</strong> {{ $lang['with'] ?? 'with' }} {{ $score }} {{ $lang['point'] ?? 'points' }}.</p>
                                <p class="text-[18px]">{{ $lang['get_'] ?? 'Get' }} {{ $toNext }} {{ $lang['p1'] ?? 'more points for' }} {{ $score + $toNext }} {{ $lang['point'] ?? 'points' }}.</p>
                            @else
                                @php
                                    $statusLabels = [
                                        'Pass' => ['label' => $lang['pass'] ?? 'Pass', 'award' => '$0', 'next' => $lang['p2'] ?? 'points for next award'],
                                        'incentive' => ['label' => $lang['ipass'] ?? 'Pass (Incentive)', 'award' => '$200', 'next' => $lang['p3'] ?? 'points for next award'],
                                        'Silver' => ['label' => $lang['spass'] ?? 'Silver', 'award' => '$300', 'next' => $lang['p4'] ?? 'points for next award'],
                                        'Gold' => ['label' => $lang['gpass'] ?? 'Gold', 'award' => '$500', 'next' => ''],
                                        'Gold1' => ['label' => $lang['p5'] ?? 'Gold (Commando/Diver/Guards)', 'award' => '$500', 'next' => ''],
                                    ];
                                    $currentStatus = $statusLabels[$status] ?? ['label' => $status, 'award' => '', 'next' => ''];
                                @endphp
                                <p class="text-[20px]"><strong class="text-green-700">{{ $currentStatus['label'] }}</strong> {{ $lang['with'] ?? 'with' }} {{ $score }} {{ $lang['point'] ?? 'points' }}.</p>
                                @if($currentStatus['award'])
                                    <p class="text-[30px]"><strong class="text-green-700">({{ $currentStatus['award'] }} {{ $lang['awa'] ?? 'Award' }})</strong></p>
                                @endif
                                @if($currentStatus['next'])
                                    <p class="text-[18px]">{{ $lang['get_'] ?? 'Get' }} {{ $toNext }} {{ $currentStatus['next'] }} {{ $score + $toNext }} {{ $lang['point'] ?? 'points' }}.</p>
                                @else
                                    <p class="text-[18px]">{{ $lang['cong'] ?? 'Congratulations' }}!</p>
                                @endif
                            @endif

                            <div class="w-full overflow-auto mt-6">
                                <table class="w-full text-sm" cellspacing="0">
                                    <tr class="bg-[#2845F5] text-white">
                                        <th class="ps-4 pe-3 py-2 text-left">Activity</th>
                                        <th class="px-3 text-left">{{ $lang['rep'] ?? 'Reps/Time' }}</th>
                                        <th class="px-3 text-left rounded-r">{{ $lang['score'] ?? 'Score' }}</th>
                                    </tr>
                                    <tr>
                                        <td class="border-b ps-4 pe-3 py-3">{{ $lang['push'] ?? 'Push-ups' }}</td>
                                        <td class="border-b px-3">{{ $detail['request']->push ?? $push }}</td>
                                        <td class="border-b px-3 font-semibold">{{ $detail['push_s'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b ps-4 pe-3 py-3">{{ $lang['sit'] ?? 'Sit-ups' }}</td>
                                        <td class="border-b px-3">{{ $detail['request']->sit ?? $sit }}</td>
                                        <td class="border-b px-3 font-semibold">{{ $detail['sit_s'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b ps-4 pe-3 py-3">{{ $lang['run'] ?? '2.4km Run' }}</td>
                                        <td class="border-b px-3">{{ $detail['request']->time_value ?? '' }}</td>
                                        <td class="border-b px-3 font-semibold">{{ $detail['run_s'] }}</td>
                                    </tr>
                                    <tr class="bg-[#2845F5]/10 font-bold">
                                        <td class="ps-4 pe-3 py-3" colspan="2">{{ $lang['ts'] ?? 'Total Score' }}</td>
                                        <td class="px-3 text-blue-700">{{ $detail['score'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
