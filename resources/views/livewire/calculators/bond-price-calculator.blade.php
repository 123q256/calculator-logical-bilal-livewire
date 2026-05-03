<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <!-- Face Value -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="faceValue" class="label">{{ $lang['1'] ?? 'Face Value' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="faceValue" id="faceValue" class="input" aria-label="faceValue" placeholder="2000" />
                            <span class="input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Coupon Rate -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="couponRate" class="label">{{ $lang['2'] ?? 'Annual Coupon Rate' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="couponRate" id="couponRate" class="input" aria-label="couponRate" placeholder="5" />
                            <span class="input_unit">%</span>
                        </div>
                    </div>

                    <!-- Frequency -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="frequency" class="label">{{ $lang['3'] ?? 'Payment Frequency' }}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="frequency" id="frequency" class="input">
                                <option value="1">Annually</option>
                                <option value="2">Semi-Annually</option>
                                <option value="4">Quarterly</option>
                                <option value="12">Monthly</option>
                                <option value="52">Weekly</option>
                                <option value="365">Daily</option>
                            </select>
                        </div>
                    </div>

                    <!-- Years to Maturity -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="yearsToMaturity" class="label">{{ $lang['4'] ?? 'Years to Maturity' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="yearsToMaturity" id="yearsToMaturity" class="input" aria-label="yearsToMaturity" placeholder="7" />
                            <span class="input_unit">years</span>
                        </div>
                    </div>

                    <!-- Yield to Maturity -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="yield" class="label">{{ $lang['6'] ?? 'Yield to Maturity (YTM)' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="yield" id="yield" class="input" aria-label="yield" placeholder="5" />
                            <span class="input_unit">%</span>
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full lg:w-[80%] overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    <tr class="border-b">
                                        <td class="py-3" width="70%"><strong>{{ $lang['5'] ?? 'Bond Price' }}</strong></td>
                                        <td class="py-3 text-xl font-bold text-blue-700">{{ $currancy }}{{ $detail['bondPrice'] + 0 }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3" width="70%"><strong>{{ $lang['7'] ?? 'Coupon Payment' }} (Per Period)</strong></td>
                                        <td class="py-3 font-semibold orange-text">{{ $currancy }}{{ $detail['couponPayment'] + 0 }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3" width="70%"><strong>{{ $lang['8'] ?? 'Annual Coupon Payment' }}</strong></td>
                                        <td class="py-3 font-semibold orange-text">{{ $currancy }}{{ abs($detail['annual']) + 0 }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="w-full text-[16px] mt-5">
                                <p class="mt-2 font-bold text-lg text-blue-600 mb-4">Calculation Breakdown</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border">
                                    <p class="leading-relaxed">The Bond Price is calculated by summing the present values of all future coupon payments and the face value repayment at maturity.</p>
                                    
                                    <div class="pt-4 border-t border-gray-200">
                                        <p><strong>Formula:</strong></p>
                                        <div class="bg-white p-4 rounded border border-blue-100 my-2 overflow-x-auto text-sm">
                                            Price = Σ [C / (1+r)<sup>t</sup>] + [F / (1+r)<sup>n</sup>]
                                        </div>
                                        <p class="text-sm text-gray-600 mt-2">
                                            Where: C = Coupon Payment, F = Face Value, r = Yield, n = Total Periods.
                                        </p>
                                    </div>

                                    <div class="pt-4 border-t border-gray-200 space-y-2">
                                        <p><strong>Values Used:</strong></p>
                                        <ul class="list-disc pl-8 space-y-1 text-sm">
                                            <li>Face Value = {{ $faceValue + 0 }}</li>
                                            <li>Annual Coupon = {{ $faceValue * ($couponRate/100) + 0 }} ({{ $couponRate + 0 }}%)</li>
                                            <li>Yield = {{ $yield + 0 }}%</li>
                                            <li>Maturity = {{ $yearsToMaturity + 0 }} years</li>
                                        </ul>
                                        
                                        <p class="pt-4 text-xl font-bold orange-text">Bond Price = {{ $currancy }}{{ $detail['bondPrice'] + 0 }}</p>
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
