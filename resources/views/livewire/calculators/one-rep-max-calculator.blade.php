<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4 lg:gap-4 mt-3">
                    {{-- Weight Lifted --}}
                    <div class="px-2">
                        <label for="weight" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Weight Lifted' }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="weight" id="weight" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-4 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none">
                                    {{ $weight_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('weight_unit', 'lbs'); open = false">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('weight_unit', 'kg'); open = false">kilograms (kg)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Reps Performed --}}
                    <div class="px-2">
                        <label for="rep" class="font-s-14 text-blue">{!! $lang['2'] ?? 'Reps Performed' !!}:</label>
                        <div class="w-100 py-2">
                            <input type="number" wire:model.live="rep" id="rep" step="any" class="input" placeholder="00" required />
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
    </form>

    @if ($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-5">
                        @php
                            $weight_unit = $detail['request']->weight_unit;
                            $ans = $detail['ans'];
                        @endphp
                        <div class="w-full">
                            <div class="w-full text-center">
                                <p class="text-[20px]"><strong>{{ $lang[3] }}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2 my-3"><strong>{{ round($ans, 1) }} <span class="font_size22">{{ $weight_unit }}</span></strong></p>
                                </div>
                            </div>
                            <div class="w-full lg:w-[70%] overflow-auto mt-3">
                                <table class="w-full " cellspacing="0">
                                    <tr>
                                        <th class="text-start text-blue border-b py-2 text-blue font-semibold">% of 1RM</th>
                                        <th class="text-start text-blue border-b py-2 text-blue font-semibold">{{ $lang[4] }}</th>
                                        <th class="text-start text-blue border-b py-2 text-blue font-semibold">{{ $lang[5] }} 1RM</th>
                                    </tr>
                                    @php
                                        $pcts = [
                                            ['p' => 1, 'r' => 1], ['p' => 0.95, 'r' => 2], ['p' => 0.90, 'r' => 4],
                                            ['p' => 0.85, 'r' => 6], ['p' => 0.80, 'r' => 8], ['p' => 0.75, 'r' => 10],
                                            ['p' => 0.70, 'r' => 12], ['p' => 0.65, 'r' => 16], ['p' => 0.60, 'r' => 20],
                                            ['p' => 0.55, 'r' => 24], ['p' => 0.50, 'r' => 30]
                                        ];
                                    @endphp
                                    @foreach ($pcts as $index => $row)
                                        <tr>
                                            <td class="{{ $index < count($pcts)-1 ? 'border-b' : '' }} py-2">{{ ($row['p'] * 100) }}%</td>
                                            <td class="{{ $index < count($pcts)-1 ? 'border-b' : '' }} py-2">{{ round($ans * $row['p'], 1).' '.$weight_unit }}</td>
                                            <td class="{{ $index < count($pcts)-1 ? 'border-b' : '' }} py-2">{{ $row['r'] }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <p class="text-[20px] md:mt-5 mt-2"><strong class="text-blue">{{ $lang[6] }} % of 1RM</strong></p>
                            <div class="w-full lg:w-[70%] overflow-auto">
                                <table class="w-full " cellspacing="0">
                                    <tr>
                                        <th class="text-start text-blue border-b py-2 text-blue font-semibold">{{ $lang[2] }}</th>
                                        <th class="text-start text-blue border-b py-2 text-blue font-semibold">{{ $lang[4] }}</th>
                                        <th class="text-start text-blue border-b py-2 text-blue font-semibold">% of 1RM</th>
                                    </tr>
                                    @php
                                        $reps_map = [
                                            1 => 1, 2 => 0.97, 3 => 0.94, 4 => 0.92, 5 => 0.89, 6 => 0.86, 7 => 0.83, 8 => 0.81, 9 => 0.78, 10 => 0.75,
                                            11 => 0.73, 12 => 0.71, 13 => 0.70, 14 => 0.68, 15 => 0.67, 16 => 0.65, 17 => 0.64, 18 => 0.63, 19 => 0.61, 20 => 0.60,
                                            21 => 0.59, 22 => 0.58, 23 => 0.57, 24 => 0.56, 25 => 0.55, 26 => 0.54, 27 => 0.53, 28 => 0.52, 29 => 0.51, 30 => 0.50
                                        ];
                                    @endphp
                                    @foreach ($reps_map as $r => $p)
                                        <tr>
                                            <td class="{{ $r < 30 ? 'border-b' : '' }} py-2">{{ $r }}</td>
                                            <td class="{{ $r < 30 ? 'border-b' : '' }} py-2">{{ round($ans * $p, 1).' '.$weight_unit }}</td>
                                            <td class="{{ $r < 30 ? 'border-b' : '' }} py-2">{{ ($p * 100) }}%</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
