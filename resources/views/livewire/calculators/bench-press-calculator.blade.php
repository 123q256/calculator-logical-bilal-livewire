<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <!-- Weight -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="weight" class="label">{{ $lang['1'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="weight" id="weight" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit', 'lbs');" @click="open = false">pounds (lbs)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit', 'kg');" @click="open = false">kilograms (kg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit', 'stone');" @click="open = false">stone</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit', 'oz');" @click="open = false">oz</p>
                            </div>
                        </div>
                    </div>

                    <!-- Reps -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="reps" class="label">{!! $lang['2'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" required step="any" wire:model.live="reps" id="reps" class="input" placeholder="00" />
                        </div>
                    </div>

                    <!-- Table Type -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="tableType" class="label">{!! $lang['3'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="tableType" id="tableType" class="input">
                                <option value="Percentage of 1RM">Percentage of 1RM</option>
                                <option value="Repetitions">Repetitions</option>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full p-3 mt-3">
                            <div class="w-full">
                                @if(isset($detail['oneRepMax']))
                                    <div>
                                        <p><strong>{{ $lang['4'] }}</strong></p>
                                        <p>
                                            <strong class="text-green-700 text-[32px]">{{ round($detail['oneRepMax'], 3) }}</strong>
                                            <span class="text-blue-700 text-18px">{{ $unit }}</span>
                                        </p>
                                    </div>
                                @endif
                                @if($tableType == "Percentage of 1RM" && isset($detail['oneRepMax']))
                                    <div>
                                        <p class="mb-2"><strong class="text-blue-700 border-b-2-blue">{{ $lang['5'] }}</strong></p>
                                        <div class="w-full overflow-auto">
                                            <table class="w-full md:w-[60%] lg:w-[60%]" cellspacing="0">
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['6'] }}</strong></td>
                                                    <td class="border-b py-2"><strong>{{ $lang['7'] }}</strong></td>
                                                </tr>
                                                @for($percentage = 100; $percentage >= 50; $percentage -= 5)
                                                    @php
                                                        $percentageWeight = number_format(($percentage / 100) * ($detail['oneRepMax']), 2, '.', '');
                                                        $border = 'border-b';
                                                        if($percentage == 50){
                                                            $border = '';
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td class="{{ $border }} py-2">{{ "$percentage %" }}</td>
                                                        <td class="{{ $border }} py-2">{{ "$percentageWeight $unit" }}</td>
                                                    </tr>
                                                @endfor
                                            </table>
                                        </div>
                                    </div>
                                @elseif($tableType == "Repetitions" && isset($detail['oneRepMax']))
                                    <div>
                                        <p><strong class="text-blue-700 border-b-2">{{ $lang['8']}}</strong></p>
                                        <div class="w-full overflow-auto">
                                            <table class="w-full md:w-[60%] lg:w-[60%] " cellspacing="0">
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8']}}</strong></td>
                                                    <td class="border-b py-2"><strong>{{ $lang['7']}}</strong></td>
                                                </tr>
                                                @for($rep = 1; $rep <= 12; $rep++)
                                                    @php
                                                        $repWeight = number_format($detail['oneRepMax'] / (1 + ($rep / 30)), 2, '.', '');
                                                        $border = 'border-b';
                                                        if($rep == 12){
                                                            $border = '';
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td class="{{ $border }} py-2">{{ $rep }}</td>
                                                        <td class="{{ $border }} py-2">{{ "$repWeight $unit" }}</td>
                                                    </tr>
                                                @endfor
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
