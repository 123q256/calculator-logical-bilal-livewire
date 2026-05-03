<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <!-- Mode Toggle (Profit vs Calculator) -->
                <div class="grid grid-cols-1 gap-4 my-3">
                    <div class="flex items-center space-x-6">
                        <span class="font-s-16 text-blue">Calculate: </span>
                        <label class="flex items-center cursor-pointer space-x-2">
                            <input type="radio" wire:model.live="calculation_type" value="first" class="with-gap" />
                            <span>{{ $lang[12] ?? 'Turo Profit' }}</span>
                        </label>
                        <label class="flex items-center cursor-pointer space-x-2">
                            <input type="radio" wire:model.live="calculation_type" value="second" class="with-gap" />
                            <span>{{ $lang[13] ?? 'Turo Calculator' }}</span>
                        </label>
                    </div>
                </div>

                <!-- Calculator Mode (Income/Lease/Expenses) -->
                @if ($calculation_type == 'second')
                    <div class="grid grid-cols-1 gap-4 mt-3">
                        <div class="space-y-2">
                            <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Sub-Operation' }}:</label>
                            <select class="input" wire:model.live="operations" id="operations">
                                <option value="1">{{ $lang[2] ?? 'Income' }}</option>
                                <option value="2">{{ $lang[3] ?? 'Lease Details' }}</option>
                                <option value="3">{{ $lang[4] ?? 'Expenses' }}</option>
                            </select>
                        </div>

                        <!-- Dynamic Inputs for Calculator Mode -->
                        <div class="space-y-4">
                            <!-- Input 1 -->
                            <div class="space-y-2 relative">
                                <label class="font-s-14 text-blue">
                                    @if($operations == 1) {{ $lang[5] ?? 'Daily Rate' }} @elseif($operations == 2) {{ $lang[14] ?? 'Monthly Payment' }} @else {{ $lang[16] ?? 'Gas Cost' }} @endif:
                                </label>
                                <input type="number" step="any" wire:model.live="first" class="input" />
                                <span class="text-blue input_unit">
                                    @if($operations == 1) {{ $currancy }}/day @else {{ $currancy }}/month @endif
                                </span>
                            </div>

                            <!-- Input 2 -->
                            <div class="space-y-2 relative">
                                <label class="font-s-14 text-blue">
                                    @if($operations == 1) {{ $lang[6] ?? 'Days per Month' }} @elseif($operations == 2) {{ $lang[15] ?? 'Maintenance' }} @else {{ $lang[17] ?? 'Insurance' }} @endif:
                                </label>
                                <input type="number" step="any" wire:model.live="second" class="input" />
                                <span class="text-blue input_unit">
                                    @if($operations == 1) /month @else {{ $currancy }}/month @endif
                                </span>
                            </div>

                            <!-- Input 3 (Lease and Expenses only) -->
                            @if ($operations == 2 || $operations == 3)
                                <div class="space-y-2 relative">
                                    <label class="font-s-14 text-blue">
                                        @if($operations == 2) {{ $lang[7] ?? 'Lease Duration' }} @else {{ $lang[18] ?? 'Cleaning' }} @endif:
                                    </label>
                                    <input type="number" step="any" wire:model.live="third" class="input" />
                                    <span class="text-blue input_unit">
                                        @if($operations == 2) months @else {{ $currancy }}/month @endif
                                    </span>
                                </div>
                            @endif

                            <!-- Input 4 (Expenses only) -->
                            @if ($operations == 3)
                                <div class="space-y-2 relative">
                                    <label class="font-s-14 text-blue">{{ $lang[8] ?? 'Misc Expenses' }}:</label>
                                    <input type="number" step="any" wire:model.live="four" class="input" />
                                    <span class="text-blue input_unit">{{ $currancy }}/month</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Profit Mode (Converter) -->
                @if ($calculation_type == 'first')
                    <div class="grid grid-cols-1 gap-4 mt-3">
                        <div class="space-y-2 relative">
                            <label for="f_first" class="font-s-14 text-blue">{{ $lang[9] ?? 'Monthly Expenses' }}:</label>
                            <input type="number" step="any" wire:model.live="f_first" class="input" />
                            <span class="text-blue input_unit">{{ $currancy }}/month</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="f_second" class="font-s-14 text-blue">{{ $lang[10] ?? 'Daily Rental Rate' }}:</label>
                            <input type="number" step="any" wire:model.live="f_second" class="input" />
                            <span class="text-blue input_unit">{{ $currancy }}/day</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="f_third" class="font-s-14 text-blue">{{ $lang[11] ?? 'Days Rented' }}:</label>
                            <input type="number" step="any" wire:model.live="f_third" class="input" />
                            <span class="text-blue input_unit">days</span>
                        </div>
                    </div>
                @endif
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        <hr>

        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full bg-light-blue p-8 rounded-lg mt-3">
                            <div class="w-full text-center">
                                <p class="mb-8 text-2xl font-semibold text-blue-900">{{ $detail['heading'] }}</p>
                                <div class="flex justify-center">
                                    <div class="bg-[#2845F5] px-8 py-4 text-3xl lg:text-4xl rounded-2xl text-white font-bold shadow-lg">
                                        {{ number_format($detail['answer'], 2) }} {{ $currancy }}/month
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
