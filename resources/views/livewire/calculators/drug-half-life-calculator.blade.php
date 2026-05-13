<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <!-- Half-Life Time -->
                    <div class="col-span-12">
                        <label class="label">{{ $lang['1'] }} <span class="text-blue">({{ $time_unit }})</span>:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            @if($time_unit === 'min/sec' || $time_unit === 'hrs/min')
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="number" step="any" wire:model.live="time_min" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="{{ explode('/', $time_unit)[0] }}" />
                                    <input type="number" step="any" wire:model.live="time_sec" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="{{ explode('/', $time_unit)[1] }}" />
                                </div>
                            @else
                                <input type="number" wire:model.live="time" id="time" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="{{ $time_unit }}" />
                            @endif

                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $time_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach(['sec' => 'seconds', 'mins' => 'minutes', 'hrs' => 'hours', 'days' => 'days', 'min/sec' => 'min / sec', 'hrs/min' => 'hrs / min'] as $val => $label)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('time_unit', '{{ $val }}');" @click="open = false">{{ $label }} ({{ $val }})</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Dosage -->
                    <div class="col-span-12">
                        <label for="dosage" class="label">{{ $lang['2'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="dosage" id="dosage" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $dosage_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('dosage_unit', 'µg');" @click="open = false">micrograms (µg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('dosage_unit', 'mg');" @click="open = false">milligrams (mg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('dosage_unit', 'g');" @click="open = false">grams (g)</p>
                            </div>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full p-3 mt-3">
                            <div class="w-full mt-2">
                                <div class="w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <th class="text-start border-b py-2">
                                                <strong>
                                                    {{ $lang['4'] }} (
                                                    @php
                                                        if($time_unit=="mins"){
                                                            echo"mins";
                                                        }elseif ($time_unit=="hrs"){
                                                            echo"hrs";
                                                        }elseif ($time_unit=="days"){
                                                            echo"days";
                                                        }elseif ($time_unit=="sec"){
                                                            echo"sec";
                                                        }elseif ($time_unit === 'min/sec'){
                                                            echo"mins";
                                                        }elseif ($time_unit === 'hrs/min'){
                                                            echo"hrs";
                                                        }
                                                    @endphp
                                                    )
                                                </strong>
                                            </th>
                                            <th class="text-start border-b py-2"><strong>{{ $lang['2'] }} ({{ $dosage_unit }})</strong></th>
                                            <th class="text-start border-b py-2"><strong>{{ $lang['5'] }}</strong></th>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $detail['answer'] }}</td>
                                            <td class="border-b py-2">{{ round($detail['subanswer'], 2) }}</td>
                                            <td class="border-b py-2">50%</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $detail['answer_one'] }}</td>
                                            <td class="border-b py-2">{{ round($detail['subanswer_one'], 2) }}</td>
                                            <td class="border-b py-2">25%</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $detail['answer_two'] }}</td>
                                            <td class="border-b py-2">{{ round($detail['subanswer_sec'], 2) }}</td>
                                            <td class="border-b py-2">12.5%</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $detail['answer_three'] }}</td>
                                            <td class="border-b py-2">{{ round($detail['subanswer_three'], 2) }}</td>
                                            <td class="border-b py-2">6.25%</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $detail['answer_four'] }}</td>
                                            <td class="border-b py-2">{{ round($detail['subanswer_four'], 2) }}</td>
                                            <td class="border-b py-2">3.125%</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">{{ $detail['answer_five'] }}</td>
                                            <td class="py-2">{{ round($detail['subanswer_five'], 2) }}</td>
                                            <td class="py-2">1.562%</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
