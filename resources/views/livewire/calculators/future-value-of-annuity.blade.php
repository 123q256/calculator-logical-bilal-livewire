<div>
    <style>
        img {
            object-fit: contain;
        }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="payment" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Payment Amount' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="payment" id="payment" class="input"
                                aria-label="input" placeholder="12" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="interest" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Annual Interest Rate' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="interest" id="interest" class="input"
                                aria-label="input" placeholder="2" />
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="term" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Number of Periods' }}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" wire:model.live="term" id="term" step="any" class="input"
                                aria-label="input" placeholder="12" />
                            
                            <label for="term_unit" class="absolute cursor-pointer text-sm underline right-6 top-6"
                                wire:click="toggleDropdown('term_unit')">
                                {{ $term_unit }} ▾
                            </label>

                            @if ($openDropdown === 'term_unit')
                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" style="display: block;">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('term_unit', 'mons')">mons</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('term_unit', 'yrs')">yrs</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="compounding" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Compounding' }}:</label>
                        <select class="input mt-2" wire:model.live="compounding" id="compounding">
                            <option value="1">{{ $lang['5'] ?? 'Annually' }}</option>
                            <option value="2">{{ $lang['6'] ?? 'Semi-annually' }}</option>
                            <option value="4">{{ $lang['7'] ?? 'Quarterly' }}</option>
                            <option value="12">{{ $lang['8'] ?? 'Monthly' }}</option>
                            <option value="52">{{ $lang['9'] ?? 'Weekly' }}</option>
                            <option value="365">{{ $lang['10'] ?? 'Daily (365)' }}</option>
                            <option value="366">{{ $lang['11'] ?? 'Daily (366)' }}</option>
                        </select>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="payment_fre" class="font-s-14 text-blue">{{ $lang['12'] ?? 'Payment Frequency' }}:</label>
                        <select wire:model.live="payment_fre" id="payment_fre" class="input mt-2">
                            <option value="1">{{ $lang['5'] ?? 'Annually' }}</option>
                            <option value="2">{{ $lang['6'] ?? 'Semi-annually' }}</option>
                            <option value="4">{{ $lang['7'] ?? 'Quarterly' }}</option>
                            <option value="12">{{ $lang['8'] ?? 'Monthly' }}</option>
                            <option value="52">{{ $lang['9'] ?? 'Weekly' }}</option>
                            <option value="365">{{ $lang['10'] ?? 'Daily' }}</option>
                        </select>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="annuity_type" class="font-s-14 text-blue">{{ $lang['13'] ?? 'Annuity Type' }}:</label>
                        <select wire:model.live="annuity_type" id="annuity_type" class="input mt-2">
                            <option value="1">{{ $lang['14'] ?? 'Ordinary Annuity (End)' }}</option>
                            <option value="2">{{ $lang['15'] ?? 'Annuity Due (Beginning)' }}</option>
                        </select>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="g" class="font-s-14 text-blue">{{ $lang['16'] ?? 'Growth Rate (Optional)' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="g" id="g" class="input"
                                aria-label="input" placeholder="0" />
                            <span class="text-blue input_unit">%</span>
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

        <hr>

        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang['17'] ?? 'Future Value' }} </strong></td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ $detail['annuity'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang['18'] ?? 'Total Periods' }} </strong></td>
                                        <td class="py-2 border-b">{{ $detail['term'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang['19'] ?? 'Equivalent Interest Rate' }} </strong></td>
                                        <td class="py-2 border-b">{{ $detail['equ'] }}%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang['20'] ?? 'Periodic Interest Rate' }} </strong></td>
                                        <td class="py-2 border-b">{{ $detail['equ2'] }}%</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
