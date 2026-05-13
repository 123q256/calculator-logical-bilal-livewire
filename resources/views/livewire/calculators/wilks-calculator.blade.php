<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <!-- Sex -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="sex" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="sex" id="sex" class="input">
                                <option value="male">{{ $lang['2'] }}</option>
                                <option value="female">{{ $lang['3'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Body Weight -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="bw" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="bw" id="bw" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4 select-none">
                                {{ $unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'kg'); open = false">kilograms (kg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'lbs'); open = false">pounds (lbs)</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12">
                        <span class="font-s-14 pe-2 pe-lg-3"><strong>{{ $lang['5'] }}: </strong></span>
                        <input type="radio" wire:model.live="method" id="au" value="au" class="cursor-pointer">
                        <label for="au" class="font-s-14 text-blue pe-lg-3 pe-2 cursor-pointer">{{ $lang['6'] }}:</label>
                        <input type="radio" wire:model.live="method" id="sep" value="sep" class="cursor-pointer">
                        <label for="sep" class="font-s-14 text-blue cursor-pointer">{{ $lang['7'] }}:</label>
                    </div>

                    <div class="col-span-12">
                        @if($method === 'au')
                            <p class="p_set">{{ $lang['8'] }}</p>
                        @else
                            <p class="p_set">{{ $lang['9'] }}</p>
                        @endif
                    </div>

                    <!-- Separate Lifts Section -->
                    @if($method === 'sep')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                <!-- Bench Press -->
                                <div class="col-span-6">
                                    <label for="bp" class="font-s-14 text-blue">{!! $lang['10'] !!}:</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.live="bp" id="bp" class="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="bp_reps" class="font-s-14 text-blue">{!! $lang['11'] !!}:</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.live="bp_reps" id="bp_reps" class="input" placeholder="00" />
                                    </div>
                                </div>

                                <!-- Back Squat -->
                                <div class="col-span-6">
                                    <label for="bs" class="font-s-14 text-blue">{!! $lang['12'] !!}:</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.live="bs" id="bs" class="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="bs_reps" class="font-s-14 text-blue">{!! $lang['11'] !!}:</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.live="bs_reps" id="bs_reps" class="input" placeholder="00" />
                                    </div>
                                </div>

                                <!-- Deadlift -->
                                <div class="col-span-6">
                                    <label for="dl" class="font-s-14 text-blue">{!! $lang['13'] !!}:</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.live="dl" id="dl" class="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="dl_reps" class="font-s-14 text-blue">{!! $lang['11'] !!}:</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.live="dl_reps" id="dl_reps" class="input" placeholder="00" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Weight Lifted (Total) -->
                    @if($method === 'au')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="wl" class="font-s-14 text-blue">{!! $lang['14'] !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="wl" id="wl" class="input" placeholder="00" />
                                <span class="text-blue input_unit">{{ $unit }}</span>
                            </div>
                        </div>
                    @endif
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
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-5">
                            <div class="w-full">
                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                    <strong>{{ $lang[15] }} <span class="text-green-700 text-[28px] ms-2">{{ $detail['ws'] }}</span></strong>
                                </div>
                                <p class="my-2">
                                    <span>{{ $lang[16] }}</span>
                                    <strong>
                                        {{ $detail['fw'] ?? $wl }}
                                        {{ $unit }}
                                    </strong>
                                    <span>{{ $lang[17] }}</span>
                                    <strong>
                                        {{ $bw }}
                                        {{ $unit }}
                                    </strong>
                                </p>
                                <div class="w-full overflow-auto">
                                    <table class="w-full lg:w-[80%]" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-start text-blue-700 border-b py-2">{{ $lang[18] }}</th>
                                                <th class="text-start text-blue-700 border-b py-2">{{ $lang[19] }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td class="border-b py-2">{{ $lang[20] }}</td><td class="border-b py-2">120</td></tr>
                                            <tr><td class="border-b py-2">{{ $lang[21] }}</td><td class="border-b py-2">200</td></tr>
                                            <tr><td class="border-b py-2">{{ $lang[22] }}</td><td class="border-b py-2">238</td></tr>
                                            <tr><td class="border-b py-2">{{ $lang[23] }}</td><td class="border-b py-2">326</td></tr>
                                            <tr><td class="py-2">{{ $lang[24] }}</td><td class="py-2">414</td></tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4 space-y-4">
                                    <p class="text-[20px]"><strong class="text-blue-700">{{ $lang[25] }}:</strong></p>
                                    <p><strong class="text-blue-700">{{ $lang[26] }}</strong></p>
                                    <p class="text-[18px]">{{ $lang[27] }} = TWL * 500 / (a + b * BWT + c * BWT² + d * BWT³ + e * BWT⁴ + f * BWT⁵)</p>
                                    
                                    <p><strong class="text-blue-700">{{ $lang[28] }}</strong></p>
                                    <p class="text-[18px]">
                                        {{ $lang[27] }} = 
                                        @if($sex === 'male')
                                            {{ $detail['fw'] ?? $wl }} * 500 / (-216.0475144 + 16.2606339 * {{ $bw }} + (-0.002388645) * {{ $bw }}² + (-0.00113732) * {{ $bw }}³ + 0.00000701863 * {{ $bw }}⁴ + (-1.291e-8) * {{ $bw }}⁵)
                                        @else
                                            {{ $detail['fw'] ?? $wl }} * 500 / (594.31747775582 + (-27.23842536447) * {{ $bw }} + 0.82112226871 * {{ $bw }}² + (-0.00930733913) * {{ $bw }}³ + 0.00004731582 * {{ $bw }}⁴ + (-9.054e-8) * {{ $bw }}⁵)
                                        @endif
                                    </p>
                                    <p class="mt-2 text-[18px]">
                                        {{ $lang[27] }} = {{ $detail['fw'] ?? $wl }} * {{ $detail['ws_cal'] }} = <strong class="font-s-16">{{ $detail['ws'] }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
