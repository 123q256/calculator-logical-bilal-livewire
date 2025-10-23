<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[90%] w-full mx-auto ">
                <div class="grid grid-cols-2 text-center gap-4">
                    <a href="{{ url('date-duration-calculator') }}/"
                        class="cursor-pointer py-2 text-[#2845F5] border-b-2 border-[#2845F5]">
                        <strong>{{ $lang['1'] }}</strong>
                    </a>
                    <a href="{{ url('date-calculator') }}/" class="cursor-pointer py-2">
                        <strong>{{ $lang['2'] }}</strong>
                    </a>
                </div>

                <div class="grid grid-cols-1 mt-4 lg:grid-cols-2 gap-4">
                    <!-- Start Date -->
                    <div class="space-y-2 relative">
                        <div class="flex justify-between items-center">
                            <label for="s_date" class="text-[14px] text-[#1670a7]">{{ $lang['6'] }}:</label>
                            <span
                                class="text-[14px] text-[#1670a7] underline cursor-pointer hover:text-[#125a87] transition-colors"
                                wire:click="setNowDate">
                                {{ $lang['now'] }}
                            </span>
                        </div>
                        <input type="date" id="s_date" wire:model.defer="s_date"
                            class="input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1670a7]" />
                    </div>

                    <!-- End Date -->
                    <div class="space-y-2 relative">
                        <div class="flex justify-between items-center">
                            <label for="e_date" class="text-[14px] text-[#1670a7]">{{ $lang['8'] }}:</label>
                            <span
                                class="text-[14px] text-[#1670a7] underline cursor-pointer hover:text-[#125a87] transition-colors"
                                wire:click="settwoNowDate">
                                {{ $lang['now'] }}
                            </span>
                        </div>
                        <input type="date" id="e_date" wire:model.defer="e_date"
                            class="input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1670a7]" />
                    </div>

                    <!-- Checkbox (full width on all screens) -->
                    <div class="space-y-2 relative col-span-1 lg:col-span-2 flex items-center gap-2">
                        <input type="checkbox" id="checkbox" wire:model="checkbox"
                            class="h-5 w-5 text-[#1670a7] focus:ring-[#1670a7] border-gray-300 rounded-full" />
                        <label for="checkbox" class="text-[14px] text-[#1670a7]"
                            style="margin-top: 0px;">{{ $lang['9'] }}</label>
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
                                <div class="lg:w-[70%] md:w-[90%] w-full gap-4 md:text-[18px] text-[16px]">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2 w-3/5"><strong>{{ $lang['10'] }}:</strong></td>
                                            <td class="border-b py-2">{{ $detail['from'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 w-3/5"><strong>{{ $lang['11'] }}:</strong></td>
                                            <td class="border-b py-2">{{ $detail['to'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                {{ $detail['years'] }} {{ $lang[12] }}, {{ $detail['months'] }}
                                                {{ $lang[13] }}, {{ $detail['days'] }} {{ $lang[14] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                {{ number_format(floor($detail['days'] / 7)) }} {{ $lang[15] }},
                                                {{ number_format(floor($detail['days'] % 7)) }} {{ $lang[14] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                {{ $detail['days'] }} {{ $lang[14] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                {{ $detail['days'] * 24 }} {{ $lang[16] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                {{ $detail['days'] * 24 * 60 }} {{ $lang[17] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">
                                                {{ $detail['days'] * 24 * 60 * 60 }} {{ $lang[18] }}
                                            </td>
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
