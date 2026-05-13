<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-12 gap-x-8 gap-y-6">
                    {{-- Number of Guests (First) --}}
                    <div class="col-span-12 md:col-span-12">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{{ $lang['1'] }}:</label>
                        <input type="number" wire:model.live="first" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" placeholder="50">
                    </div>

                    {{-- Meat Portion Size (Second) --}}
                    <div class="col-span-12 md:col-span-12">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{{ $lang['2'] }}:</label>
                        <div class="relative">
                            <select wire:model.live="second" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer appearance-none">
                                <option value="184.27">{{ $lang['3'] }}</option>
                                <option value="155.92">{{ $lang['4'] }}</option>
                                <option value="141.75">{{ $lang['5'] }}</option>
                                <option value="184.27">{{ $lang['6'] }}</option>
                                <option value="198.45">{{ $lang['7'] }}</option>
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
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

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full border-b pb-4">
                                <div class="w-full md:w-[80%] lg:w-[80%]">
                                    <p><strong class="text-[#2845F5] mb-1">{{ $lang[25] }}</strong></p>
                                    <div class="flex flex-wrap justify-between">
                                        <div class="px-3">
                                            <p>{{ $lang[8] }}</p>
                                            <p>
                                                <strong class="text-[28px] text-[#119154]">{{ round($detail['meat_mass'], 2) }}</strong>
                                                <strong class="text-[#2845F5] font-s-20">g</strong>
                                            </p>
                                        </div>
                                        <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                        <div class="px-3">
                                            <p>{{ $lang[9] }}</p>
                                            <p>
                                                <strong class="text-[28px] text-[#119154]">{{ round($detail['cheddar_cheese'], 2) }}</strong>
                                                <strong class="text-[#2845F5] font-s-20">g</strong>
                                            </p>
                                        </div>
                                        <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                        <div class="px-3">
                                            <p>{{ $lang[10] }}</p>
                                            <p>
                                                <strong class="text-[28px] text-[#119154]">{{ round($detail['monterey_cheese'], 2) }}</strong>
                                                <strong class="text-[#2845F5] font-s-20">g</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full border-b pb-4 mt-4">
                                <p class="my-2"><strong class="text-[#2845F5]">{{ $lang[26] }}</strong></p>
                                <div class="flex flex-wrap justify-between">
                                    <div class="px-3">
                                        <p>{{ $lang[11] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['sour_cream'], 2) }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                    <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                    <div class="px-3">
                                        <p>{{ $lang[12] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['guacamole'], 2) }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                    <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                    <div class="px-3">
                                        <p>{{ $lang[13] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['taco_sauce'], 2) }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                    <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                    <div class="px-3">
                                        <p>{{ $lang[14] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['pico_de_gallo'], 2) }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full border-b pb-4 mt-4">
                                <p class="my-2"><strong class="text-[#2845F5]">{{ $lang[27] }}</strong></p>
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-6 md:col-span-3 lg:col-span-3 lg:border-r md:border-r">
                                        <p>{{ $lang[15] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['lettuce'], 2) }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                    <div class="col-span-6 md:col-span-3 lg:col-span-3 lg:border-r md:border-r">
                                        <p>{{ $lang[16] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['onions'], 2) }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                    <div class="col-span-6 md:col-span-3 lg:col-span-3 lg:border-r md:border-r">
                                        <p>{{ $lang[17] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['beans'], 2) }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                    <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                        <p>{{ $lang[18] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['refried_beans'], 2) }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 mt-[20px] gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-6 md:col-span-3 lg:col-span-3 lg:border-r md:border-r">
                                        <p>{{ $lang[19] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['tomatoes'], 2) }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                    <div class="col-span-6 md:col-span-3 lg:col-span-3 lg:border-r md:border-r">
                                        <p>{{ $lang[20] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['olives'], 2) }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                    <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                        <p>{{ $lang[21] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['bell_pepper'], 2) }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full border-b pb-4 mt-4">
                                <div class="w-full md:w-[80%] lg:w-[80%]">
                                    <p class="my-2"><strong class="text-[#2845F5]">{{ $lang[28] }}</strong></p>
                                    <div class="flex flex-wrap justify-between">
                                        <div class="px-3">
                                            <p>{{ $lang[22] }}</p>
                                            <p>
                                                <strong class="text-[28px] text-[#119154]">{{ round($detail['taco_shells'], 2) }}</strong>
                                                <strong class="text-[#2845F5] font-s-20">#</strong>
                                            </p>
                                        </div>
                                        <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                        <div class="px-3">
                                            <p>{{ $lang[23] }}</p>
                                            <p>
                                                <strong class="text-[28px] text-[#119154]">{{ round($detail['tortillas'], 2) }}</strong>
                                                <strong class="text-[#2845F5] font-s-20">#</strong>
                                            </p>
                                        </div>
                                        <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                        <div class="px-3">
                                            <p>{{ $lang[24] }}</p>
                                            <p>
                                                <strong class="text-[28px] text-[#119154]">{{ round($detail['rice'], 2) }}</strong>
                                                <strong class="text-[#2845F5] font-s-20">g</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
