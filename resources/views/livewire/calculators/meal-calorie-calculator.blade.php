<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="meals" class="font-s-14 text-blue">{{ $lang['meal'] }}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="meals" id="meals" class="input">
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="calorie" class="font-s-14 text-blue">{{ $lang['day'] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="calorie" id="calorie" class="input" placeholder="e.g. 1800" />
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full text-center">
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-[10px] p-3" style="border: 1px solid #c1b8b899;">
                                            <div class="flex flex-wrap items-center justify-between">
                                                <div class="flex items-center">
                                                    <img src="{{ asset('images/break_fast.png') }}" alt="break fast" width="50">
                                                    <span class="text-blue-700 text-[18px] mx-2">{{ $lang['b_f'] }}</span>
                                                </div>
                                                <div>
                                                    <strong class="text-[28px] text-green-700">{{ $detail['b_f'] ?? '0' }} kcal</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($meals >= 4)
                                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                            <div class="bg-[#F6FAFC] border rounded-[10px] p-3" style="border: 1px solid #c1b8b899;">
                                                <div class="flex flex-wrap items-center justify-between">
                                                    <div class="flex items-center">
                                                        <img src="{{ asset('images/ms.png') }}" alt="Morning" width="50">
                                                        <span class="text-blue-700 text-[18px] ms-2">{{ $lang['m_s'] }}</span>
                                                    </div>
                                                    <div>
                                                        <strong class="text-[28px] text-green-700">{{ $detail['m_s'] ?? '0' }} kcal</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-[#F6FAFC] border rounded-[10px] p-3" style="border: 1px solid #c1b8b899;">
                                            <div class="flex flex-wrap items-center justify-between">
                                                <div class="flex items-center">
                                                    <img src="{{ asset('images/lunch.png') }}" alt="lunch" width="50">
                                                    <span class="text-blue-700 text-[18px] mx-2">{{ $lang['l'] }}</span>
                                                </div>
                                                <div>
                                                    <strong class="text-[28px] text-green-700">{{ $detail['lanch'] ?? '0' }} kcal</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($meals == 5)
                                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                            <div class="bg-sky border rounded-[10px] p-3">
                                                <div class="flex flex-wrap items-center justify-between">
                                                    <div class="flex items-center">
                                                        <img src="{{ asset('images/afternoon.png') }}" alt="afternoon" width="50">
                                                        <span class="text-blue-700 text-[18px] mx-2">{{ $lang['a_n'] }}</span>
                                                    </div>
                                                    <div>
                                                        <strong class="text-[28px] text-green-700">{{ $detail['a_n'] ?? '0' }} kcal</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="bg-sky border rounded-[10px] p-3">
                                            <div class="flex flex-wrap items-center justify-between">
                                                <div class="flex items-center">
                                                    <img src="{{ asset('images/dinner.png') }}" alt="dinner" width="50">
                                                    <span class="text-blue-700 text-[18px] mx-2">{{ $lang['d'] }}</span>
                                                </div>
                                                <div>
                                                    <strong class="text-[28px] text-green-700">{{ $detail['dinner'] ?? '0' }} kcal</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
