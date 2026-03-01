<div>
    <form wire:submit.prevent="calculate" class="row">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            <div class="col-12  mx-auto mt-2 w-full">
                <div class="row">
                    @if (isset($error))
                        <p class="text-red-500 text-lg mb-3"><strong>{{ $error }}</strong></p>
                    @endif
                    <div class="container mx-auto">


                        <div
                            class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">

                            <div class="lg:w-1/3 w-full px-2 py-1">
                                <div wire:click="changeOperation('time_first')"
                                    class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white @if ($operations == 'time_first') tagsUnit @endif ">
                                    {{ $cal_name }}
                                </div>
                            </div>
                            <div wire:click="changeOperation('time_second')" class="lg:w-1/3 w-full px-2 py-1">
                                <div
                                    class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white @if ($operations == 'time_second') tagsUnit @endif">
                                    {{ $lang['7'] }}
                                </div>
                            </div>
                            <div wire:click="changeOperation('time_third')" class="lg:w-1/3 w-full px-2 py-1">
                                <div
                                    class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white @if ($operations == 'time_third') tagsUnit @endif">
                                    {{ $lang['20'] }}
                                </div>
                            </div>

                        </div>
                    </div>
                    {{-- Operation 1 --}}
                    <div class="time_due @if ($operations != 'time_first') hidden @endif">
                        <p class="text-lg mt-4">{{ $lang['after_title_1'] }}</p>
                        <div class="flex flex-wrap gap-4">
                            <div class="flex-1 px-2 py-2">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['days'] }}:</label>
                                <input type="number" wire:model="t_days"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="days" />
                            </div>
                            <div class="flex-1 px-2 py-2">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['hours'] }}:</label>
                                <input type="number" wire:model="t_hours"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="hrs" />
                            </div>
                            <div class="flex-1 px-2 py-2">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['min'] }}:</label>
                                <input type="number" wire:model="t_min"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="min" />
                            </div>
                            <div class="flex-1 px-2 py-2">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['sec'] }}:</label>
                                <input type="number" wire:model="t_sec"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="sec" />
                            </div>
                        </div>

                        <div class="my-2 flex justify-center space-x-4">
                            <label><input type="radio" wire:model="t_method" value="plus" class="mr-2">
                                +Add</label>
                            <label><input type="radio" wire:model="t_method" value="minus" class="mr-2">
                                -Subtract</label>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <div class="flex-1 px-2 py-2">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['days'] }}:</label>
                                <input type="number" wire:model="te_days"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="date" />
                            </div>
                            <div class="flex-1 px-2 py-2">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['hours'] }}:</label>
                                <input type="number" wire:model="te_hours"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="hrs" />
                            </div>
                            <div class="flex-1 px-2 py-2">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['min'] }}:</label>
                                <input type="number" wire:model="te_min"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="min" />
                            </div>
                            <div class="flex-1 px-2 py-2">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['sec'] }}:</label>
                                <input type="number" wire:model="te_sec"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="sec" />
                            </div>
                        </div>
                    </div>

                    {{-- Operation 2 --}}
                    <div class="time_due_sec  @if ($operations != 'time_second') hidden @endif">
                        <p class="text-lg mt-4">{{ $lang['8'] }}</p>
                        <div class="mt-5 flex flex-wrap gap-4">
                            <div class="w-full lg:w-auto">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['days'] }}:</label>
                                <input type="date" wire:model="td_date"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                            </div>
                            <div class="flex-1">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['hours'] }}:</label>
                                <input type="number" wire:model="ts_hours"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                            </div>
                            <div class="flex-1">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['min'] }}:</label>
                                <input type="number" wire:model="ts_min"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                            </div>
                            <div class="flex-1">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['sec'] }}:</label>
                                <input type="number" wire:model="ts_sec"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                            </div>
                            <div class="flex-1">
                                <label class="text-blue-600 text-sm font-medium">12/24</label>
                                <select wire:model="am_pm" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                    <option value="24">24-hr</option>
                                </select>
                            </div>
                        </div>

                        <div class="my-6 flex justify-center space-x-4">
                            <label><input type="radio" wire:model="td_method" value="plus" class="mr-2">
                                +Add</label>
                            <label><input type="radio" wire:model="td_method" value="minus" class="mr-2">
                                -Subtract</label>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <div class="flex-1">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['days'] }}:</label>
                                <input type="number" wire:model="td_days"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                            </div>
                            <div class="flex-1">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['hours'] }}:</label>
                                <input type="number" wire:model="td_hours"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                            </div>
                            <div class="flex-1">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['min'] }}:</label>
                                <input type="number" wire:model="td_min"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                            </div>
                            <div class="flex-1">
                                <label class="text-blue-600 text-sm font-medium">{{ $lang['sec'] }}:</label>
                                <input type="number" wire:model="td_sec"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md" />
                            </div>
                        </div>
                    </div>

                    {{-- Operation 3 --}}
                    <div class="paragraph  @if ($operations != 'time_third') hidden @endif">
                        <p class="text-lg mt-4">{{ $lang['14'] }}</p>
                        <textarea wire:model="input" class="w-full px-3 py-2 border border-gray-300 rounded-md resize-none" rows="4"></textarea>
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
        @if (isset($detail))
            {{-- result --}}
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full col-12   rounded-lg mt-3">
                            <div class="my-2">
                                @if ($detail['submitt'] == 'time_first')
                                    <div class="lg:w-3/3 text-lg">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4   rounded-lg ">
                                            <div
                                                class="flex justify-between items-center border-b border-gray-300 py-2">
                                                <span class="font-medium text-gray-600">{{ $lang['10'] }}</span>
                                                <span
                                                    class="text-gray-900">{{ round($detail['totalDays'], 3) }}</span>
                                            </div>
                                            <div
                                                class="flex justify-between items-center border-b border-gray-300 py-2">
                                                <span class="font-medium text-gray-600">{{ $lang['11'] }}</span>
                                                <span
                                                    class="text-gray-900">{{ round($detail['totalHours'], 3) }}</span>
                                            </div>
                                            <div
                                                class="flex justify-between items-center border-b border-gray-300 py-2">
                                                <span class="font-medium text-gray-600">{{ $lang['12'] }}</span>
                                                <span class="text-gray-900">{{ round($detail['totalMin'], 3) }}</span>
                                            </div>
                                            <div
                                                class="flex justify-between items-center border-b border-gray-300 py-2">
                                                <span class="font-medium text-gray-600">{{ $lang['13'] }}</span>
                                                <span class="text-gray-900">{{ round($detail['totalSec'], 3) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($detail['submitt'] == 'time_second')
                                    <div class="text-center">
                                        <!-- Main time result block -->
                                        <div class=" px-6 py-4 rounded-lg inline-block my-4 bg-[#F6FAFC] border">
                                            <p class="text-2xl font-bold text-blue-600">{{ $detail['resTime'] }}
                                            </p>
                                            <p class="text-lg text-gray-700">
                                                {{ $detail['finalDate'] . ' ' . $detail['resDay'] }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="lg:w-full text-lg">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4   rounded-lg ">
                                            <div
                                                class="flex justify-between items-center border-b border-gray-300 py-2">
                                                <span class="font-medium text-gray-600">{{ $lang['10'] }}</span>
                                                <span
                                                    class="text-gray-900">{{ round($detail['daysResult'], 3) }}</span>
                                            </div>
                                            <div
                                                class="flex justify-between items-center border-b border-gray-300 py-2">
                                                <span class="font-medium text-gray-600">{{ $lang['11'] }}</span>
                                                <span
                                                    class="text-gray-900">{{ round($detail['hoursResult'], 3) }}</span>
                                            </div>
                                            <div
                                                class="flex justify-between items-center border-b border-gray-300 py-2">
                                                <span class="font-medium text-gray-600">{{ $lang['12'] }}</span>
                                                <span
                                                    class="text-gray-900">{{ round($detail['mintsResult'], 3) }}</span>
                                            </div>
                                            <div
                                                class="flex justify-between items-center border-b border-gray-300 py-2">
                                                <span class="font-medium text-gray-600">{{ $lang['13'] }}</span>
                                                <span
                                                    class="text-gray-900">{{ round($detail['secondsResult'], 3) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
