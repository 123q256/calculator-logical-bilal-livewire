<div>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2 text-center  gap-4">
                    <a href="{{ url('date-duration-calculator') }}/" class=" cursor-pointer py-2  " id="date_cal">
                        <strong>{{ $lang['41'] }}</strong>
                    </a>
                    <a href="{{ url('date-calculator') }}/"
                        class=" cursor-pointer py-2 text-[#2845F5] border-b-2 border-[#2845F5]" id="time_cal">
                        <strong>{{ $lang['42'] }}</strong>
                    </a>
                </div>


                <div class="flex flex-wrap">
                    <div class="w-full lg:w-1/2 px-2 mt-3 lg:pr-4">
                        <label for="add_date" class="text-sm text-blue-500">{{ $lang['2'] }}:</label>
                        <div class="w-full py-2">
                            <input type="date" wire:model="add_date" id="add_date"
                                class="w-full border rounded-md p-2" aria-label="input" />
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 px-2 mt-3 lg:pl-4">
                        <label for="method" class="text-sm text-blue-500">{{ $lang[45] }} /
                            {{ $lang['46'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model="method" wire:change="changeMethod" id="method"
                                class="w-full border rounded-md p-2">
                                <option value="add">Add (+)</option>
                                <option value="sub">Subtract (-)</option>
                            </select>
                        </div>
                    </div>




                    <div class="w-full lg:w-1/2 lg:pr-4">
                        <div class="flex flex-wrap">
                            <div class="w-1/2 px-2 lg:pr-1">
                                <label for="years" class="text-sm text-blue-500">{{ $lang['47'] }}:</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model="years" id="years"
                                        class="w-full border rounded-md p-2" aria-label="input" />
                                </div>
                            </div>
                            <div class="w-1/2 px-2 lg:pl-1">
                                <label for="months" class="text-sm text-blue-500">{{ $lang['48'] }}:</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model="months" id="months"
                                        class="w-full border rounded-md p-2" aria-label="input" />
                                </div>
                            </div>
                        </div>

                        {{-- Time fields toggle --}}
                        <div class="flex flex-wrap" x-data="{ showTime: @entangle('showTime') }" x-show="showTime">
                            <div class="w-full flex px-2">
                                <div class="w-1/3 py-2 mx-1">
                                    <input type="number" step="any" wire:model="add_hrs_f"
                                        class="w-full border rounded-md p-2" placeholder="HH" />
                                </div>
                                <div class="w-1/3 py-2 mx-1">
                                    <input type="number" step="any" wire:model="add_min_f"
                                        class="w-full border rounded-md p-2" placeholder="MM" />
                                </div>
                                <div class="w-1/3 py-2 mx-1">
                                    <input type="number" step="any" wire:model="add_sec_f"
                                        class="w-full border rounded-md p-2" placeholder="SS" />
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="w-full lg:w-1/2 lg:pl-4">
                        <div class="flex flex-wrap">
                            <div class="w-1/2 px-2 lg:pl-0">
                                <label for="weeks" class="text-sm text-blue-500">{{ $lang['49'] }}:</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model="weeks" id="weeks"
                                        class="w-full border rounded-md p-2" aria-label="input" />
                                </div>
                            </div>
                            <div class="w-1/2 px-2">
                                <label for="days" class="text-sm text-blue-500">{{ $lang['50'] }}:</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model="days" id="days"
                                        class="w-full border rounded-md p-2" aria-label="input" />
                                </div>
                            </div>
                        </div>

                    </div>



                </div>




                
                <div class="grid grid-cols-1 md:grid-cols-1 gap-4 px-2">
                    {{-- div two --}}
                    {{-- Toggle Button --}}
                    <div x-data="{ inctime: @entangle('inctime') }" x-cloak class="w-full">
                        {{-- Conditionally Shown Time Fields --}}
                        <div class="grid grid-cols-1 lg:grid-cols-2">
                            <div x-show="inctime === 'time_out'" x-cloak class="mt-2">
                                <div class="w-full flex px-2">
                                    <div class="w-1/3 py-2 mx-1">
                                        <input type="number" step="any" wire:model="add_hrs_f"
                                            class="w-full border rounded-md p-2" placeholder="HH" />
                                    </div>
                                    <div class="w-1/3 py-2 mx-1">
                                        <input type="number" step="any" wire:model="add_min_f"
                                            class="w-full border rounded-md p-2" placeholder="MM" />
                                    </div>
                                    <div class="w-1/3 py-2 mx-1">
                                        <input type="number" step="any" wire:model="add_sec_f"
                                            class="w-full border rounded-md p-2" placeholder="SS" />
                                    </div>
                                </div>
                            </div>
                            <div x-show="inctime === 'time_out'" x-cloak class="mt-2">
                                <div class="w-full flex px-2">
                                    <div class="w-1/3 py-2 mx-1">
                                        <input type="number" step="any" wire:model="add_hrs_s"
                                            class="w-full border rounded-md p-2" placeholder="HH" />
                                    </div>
                                    <div class="w-1/3 py-2 mx-1">
                                        <input type="number" step="any" wire:model="add_min_s"
                                            class="w-full border rounded-md p-2" placeholder="MM" />
                                    </div>
                                    <div class="w-1/3 py-2 mx-1">
                                        <input type="number" step="any" wire:model="add_sec_s"
                                            class="w-full border rounded-md p-2" placeholder="SS" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Toggle Button --}}
                        <p class="text-sm text-blue-500 cursor-pointer underline text-end"
                            wire:click="changeOperation">
                            <span x-show="inctime === 'time_in'" x-cloak>{{ $lang[62] }}</span>
                            <span x-show="inctime === 'time_out'" x-cloak>{{ $lang[63] }}</span>
                        </p>
                    </div>


                    {{-- div one --}}
                    <div x-data="{ showRepeat: @entangle('checkbox') }" class="md:w-[50%]">
                        {{-- Conditionally Shown Repeat Input --}}
                        <div x-show="showRepeat" x-cloak>
                            <label for="repeat" class="text-sm text-blue-500">{{ $lang[52] }}:</label>
                            <div class="w-full mt-3">
                                <input type="number" wire:model="repeat" id="repeat"
                                    class="w-full border rounded-md p-2" placeholder="Repeat..." />
                            </div>
                        </div>
                        {{-- Checkbox --}}
                        <div class="mt-2 ">
                            <input type="checkbox" id="checkbox" wire:model="checkbox" />
                            <label for="checkbox" class="text-sm text-blue-500">{{ $lang[51] }}:</label>
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
            {{-- result --}}
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg lg:p-4 md:p-4 flex items-center justify-center">
                        <div class="w-full  lg:p-3 md:p-3 rounded-lg mt-3">
                            <div class="flex flex-wrap">
                                <div class="lg:w-[80%] md:w-[80%] w-[100%] text-base">
                                    <table class="w-full">
                                        <tr class=" border-b  transition-colors duration-200">
                                            @if ($detail['repeat'] > 1)
                                                <td class="py-2 px-1 font-medium text-black">
                                                    <strong><?= $lang[61] ?> 1
                                                        :</strong>
                                                </td>
                                            @else
                                                <td class="py-2 px-1 font-medium text-black">
                                                    <strong><?= $lang[61] ?>
                                                        :</strong>
                                                </td>
                                            @endif
                                            <td class="py-2 px-1 font-medium text-black">
                                                <?= $detail['ans'][0] ?>
                                            </td>
                                        </tr>
                                        @if ($detail['repeat'] > 1)
                                            @php
                                                $new_array = array_slice($detail['ans'], 1);
                                                $i = 2;
                                            @endphp
                                            @foreach ($new_array as $value)
                                                <tr class="border-b   transition-colors duration-200">
                                                    <td class="py-2 px-1 font-medium text-black">
                                                        <strong><?= $lang[61] ?> <?= $i++ ?> :</strong>
                                                    </td>
                                                    <td class="py-2 px-1 font-medium text-black">
                                                        <?= $value ?>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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
