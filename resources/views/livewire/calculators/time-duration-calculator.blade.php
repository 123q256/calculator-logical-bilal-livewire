<div>
    <form wire:submit.prevent="calculate" class="row">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                <input type="hidden" wire:model="calculator_time" id="calculator_time">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <!-- Date Tab -->
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="changeOperation('date_cal')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white pacetab 
                {{ $calculator_time === 'date_cal' ? 'tagsUnit' : '' }}">
                            {{ $lang['1'] }}
                        </div>
                    </div>
                    <!-- Time Tab -->
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="changeOperation('time_cal')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white pacetab 
                {{ $calculator_time === 'time_cal' ? 'tagsUnit' : '' }}">
                            {{ $lang['2'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
                <p class="font-s-14 mt-4 text-blue">{{ $lang['3'] }}</p>
                <div
                    class="grid lg:grid-cols-5 grid-cols-2 md:gap-4 gap-2 time_betw  {{ $calculator_time === 'time_cal' ? 'flex' : 'hidden' }}">
                    <div class="space-y-2">
                        <label for="start_date" class="text-blue text-sm">Date:</label>
                        <div class="py-2">
                            <input type="date" step="any" name="" id="start_date"
                                class="w-full p-2 border border-gray-300 rounded" wire:model="start_date" />
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="t_start_h" class="text-blue text-sm">Hrs:</label>
                        <div class="py-2">
                            <input type="number" step="any" name="" id="t_start_h"
                                class="w-full p-2 border border-gray-300 rounded" wire:model="t_start_h"
                                placeholder="Hrs" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="t_start_m" class="text-blue text-sm">Min:</label>
                        <div class="py-2">
                            <input type="number" step="any" name="" id="t_start_m"
                                class="w-full p-2 border border-gray-300 rounded" wire:model="t_start_m"
                                placeholder="Min" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="t_start_s" class="text-blue text-sm">Sec:</label>
                        <div class="py-2">
                            <input type="number" step="any" name="" id="t_start_s"
                                class="w-full p-2 border border-gray-300 rounded" wire:model="t_start_s"
                                placeholder="Sec" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="py-2">
                            <label for="t_start_ampm" class="text-blue text-sm">&nbsp;</label>
                            <select name="" wire:model="t_start_ampm" id="t_start_ampm"
                                class="w-full p-2 border border-gray-300 rounded mt-2">
                                <option value="am">AM</option>
                                <option value="pm">PM</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div
                    class="grid lg:grid-cols-4 grid-cols-2 md:gap-4 gap-2 time_due {{ $calculator_time === 'time_cal' ? 'hidden' : 'flex' }} ">
                    <div class="space-y-2">
                        <label for="d_start_h" class="text-blue text-sm">Hrs:</label>
                        <div class="py-2">
                            <input type="number" step="any" name="" id="d_start_h"
                                class="w-full p-2 border border-gray-300 rounded" wire:model="d_start_h"
                                placeholder="Hrs" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="d_start_m" class="text-blue text-sm">Min:</label>
                        <div class="py-2">
                            <input type="number" step="any" name="" id="d_start_m"
                                class="w-full p-2 border border-gray-300 rounded" wire:model="d_start_m"
                                placeholder="Min" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="d_start_s" class="text-blue text-sm">Sec:</label>
                        <div class="py-2">
                            <input type="number" step="any" name="" id="d_start_s"
                                class="w-full p-2 border border-gray-300 rounded" wire:model="d_start_s"
                                placeholder="Sec" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="py-2">
                            <label for="d_start_ampm" class="text-blue text-sm">&nbsp;</label>
                            <select name="" wire:model="d_start_ampm" id="d_start_ampm"
                                class="w-full p-2 border border-gray-300 rounded mt-2">
                                <option value="am">AM</option>
                                <option value="pm">PM</option>
                            </select>
                        </div>
                    </div>
                </div>
                <p class="font-s-14 text-blue mt-2">{{ $lang['6'] }}</p>
                <div
                    class="grid lg:grid-cols-5 grid-cols-2 md:gap-4 gap-2 time_betw  {{ $calculator_time === 'time_cal' ? 'flex' : 'hidden' }}">
                    <div class="space-y-2">
                        <label for="end_date" class="text-blue text-sm">Date:</label>
                        <div class="py-2">
                            <input type="date" step="any" name="" id="end_date" class="input w-full"
                                wire:model="end_date" />
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="t_end_h" class="text-blue text-sm">Hrs:</label>
                        <div class="py-2">
                            <input type="number" step="any" name="" id="t_end_h" class="input w-full"
                                wire:model="t_end_h" placeholder="Hrs" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="t_end_m" class="text-blue text-sm">Min:</label>
                        <div class="py-2">
                            <input type="number" step="any" name="" id="t_end_m" class="input w-full"
                                wire:model="t_end_m" placeholder="Min" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="t_end_s" class="text-blue text-sm">Sec:</label>
                        <div class="py-2">
                            <input type="number" step="any" name="" id="t_end_s" class="input w-full"
                                wire:model="t_end_s" placeholder="Sec" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="py-2">
                            <label for="t_end_ampm" class="text-blue text-sm">&nbsp;</label>
                            <select name="" wire:model="t_end_ampm" id="t_end_ampm"
                                class="input w-full mt-2">
                                <option value="am">AM</option>
                                <option value="pm">PM</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div
                    class="grid lg:grid-cols-4 grid-cols-2 md:gap-4 gap-2 time_due {{ $calculator_time === 'time_cal' ? 'hidden' : 'flex' }} ">

                    <div class="space-y-2">
                        <label for="d_end_h" class="text-blue text-sm">Hrs:</label>
                        <div class="py-2">
                            <input type="number" step="any" name="" id="d_end_h" class="input w-full"
                                wire:model="d_end_h" placeholder="Hrs" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="d_end_m" class="text-blue text-sm">Min:</label>
                        <div class="py-2">
                            <input type="number" step="any" name="" id="d_end_m" class="input w-full"
                                wire:model="d_end_m" placeholder="Min" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="d_end_s" class="text-blue text-sm">Sec:</label>
                        <div class="py-2">
                            <input type="number" step="any" name="" id="d_end_s" class="input w-full"
                                wire:model="d_end_s" placeholder="Sec" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="py-2">
                            <label for="d_end_ampm" class="text-blue text-sm">&nbsp;</label>
                            <select name="" wire:model="d_end_ampm" id="d_end_ampm"
                                class="input w-full mt-2">
                                <option value="am">AM</option>
                                <option value="pm">PM</option>
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
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2 overflow-auto">
                                <div class="lg:w-[70%] md:w-[80%] w-full gap-4 text-[16px]">
                                    <table class="w-full">

                                        @if ($detail['calculator_time'] == 'time_cal')
                                            <tr>
                                                <td class="border-b py-2 font-semibold">
                                                    <strong>{{ $detail['days_ans'] }}</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $lang[7] }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="w-3/5 border-b py-2 font-semibold">
                                                <strong>{{ $detail['hours'] }}</strong>
                                            </td>
                                            <td class="border-b py-2">{{ $lang['hours'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 font-semibold">
                                                <strong>{{ $detail['minutes'] }}</strong>
                                            </td>
                                            <td class="border-b py-2">{{ $lang['minute'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 font-semibold">
                                                <strong>{{ $detail['seconds'] }}</strong>
                                            </td>
                                            <td class="border-b py-2">{{ $lang['second'] }}</td>
                                        </tr>
                                        @if ($detail['calculator_time'] == 'time_cal')
                                            <tr>
                                                <td class="border-b py-2 font-semibold">{{ $lang[8] }} :</td>
                                                <td class="border-b py-2">{{ $detail['total_days'] }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="border-b py-2 font-semibold">{{ $lang[9] }} :</td>
                                            <td class="border-b py-2">{{ $detail['total_hours'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 font-semibold">{{ $lang[10] }} :</td>
                                            <td class="border-b py-2">{{ $detail['total_minutes'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 font-semibold">{{ $lang[11] }} :</td>
                                            <td class="border-b py-2">{{ $detail['total_seconds'] }}</td>
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
