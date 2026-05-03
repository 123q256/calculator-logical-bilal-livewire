<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

                    <!-- Select what to calculate -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="cal" class="label">{{ $lang['1'] ?? 'Calculate' }}:</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="cal" id="cal" class="input">
                                <option value="R">{{ ($lang['2'] ?? 'Expected rate of return') . ' (R)' }}</option>
                                <option value="Bi">{{ ($lang['3'] ?? 'Beta of stock') . ' (βᵢ)' }}</option>
                                <option value="Rf">{{ ($lang['4'] ?? 'Risk-free interest rate') . ' (Rf)' }}</option>
                                <option value="Rm">{{ ($lang['5'] ?? 'Broad market return') . ' (Rm)' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Expected Return (R) - Hidden if calculating R -->
                    @if ($cal !== 'R')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" id="rx">
                            <label for="r" class="label">{{ $lang['2'] ?? 'Expected rate of return' }} (R)</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="r" id="r" class="input"
                                    aria-label="input" placeholder="11" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                    @endif

                    <!-- Risk-free Rate (Rf) - Hidden if calculating Rf -->
                    @if ($cal !== 'Rf')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" id="rfx">
                            <label for="rf" class="label">{{ $lang['4'] ?? 'Risk-free interest rate' }} (Rf)</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="rf" id="rf" class="input"
                                    aria-label="input" placeholder="5" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                    @endif

                    <!-- Market Return (Rm) - Hidden if calculating Rm -->
                    @if ($cal !== 'Rm')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" id="rmx">
                            <label for="rm" class="label">{{ $lang['5'] ?? 'Broad market return' }} (Rm)</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="rm" id="rm" class="input"
                                    aria-label="input" placeholder="10" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                    @endif

                    <!-- Beta (Bi) - Hidden if calculating Bi -->
                    @if ($cal !== 'Bi')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" id="bix">
                            <label for="bi" class="label">{{ $lang['3'] ?? 'Beta of stock' }} (βi)</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="bi" id="bi" class="input"
                                    aria-label="input" placeholder="1.2" />
                            </div>
                        </div>
                    @endif

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
                            <div class="w-full lg:w-[80%] overflow-auto mt-2">
                                <table class="w-full">
                                    <tr>
                                        <td class="py-2 border-b">
                                            <strong>
                                                @if ($detail['cal'] === 'R')
                                                    {{ $lang['6'] ?? 'Expected Return' }}
                                                @elseif($detail['cal'] === 'Bi')
                                                    {{ $lang['7'] ?? 'Beta' }}
                                                @elseif($detail['cal'] === 'Rf')
                                                    {{ $lang['8'] ?? 'Risk-free Rate' }}
                                                @elseif($detail['cal'] === 'Rm')
                                                    {{ $lang['9'] ?? 'Market Return' }}
                                                @endif
                                            </strong>
                                        </td>
                                        <td class="py-2 border-b">
                                            @if ($detail['cal'] === 'R')
                                                {{ $detail['R'] }}%
                                            @elseif($detail['cal'] === 'Bi')
                                                {{ $detail['Bi'] }}
                                            @elseif($detail['cal'] === 'Rf')
                                                {{ $detail['Rf'] }}%
                                            @elseif($detail['cal'] === 'Rm')
                                                {{ $detail['Rm'] }}%
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full  text-[16px]">
                                <div class="col s12 margin_top_10">
                                    <p class="mt-4"><strong>{{ $lang['10'] ?? 'Calculation Steps' }}:</strong></p>
                                    
                                    @if ($detail['cal'] === 'R')
                                        <p class="mt-2"><strong>{{ $lang['6'] ?? 'Expected Return' }}</strong></p>
                                        <p class="mt-2">{{ $lang['11'] ?? 'R' }} = Rf + Bi * (Rm - Rf)</p>
                                        <p class="mt-2">{{ $lang['11'] ?? 'R' }} = {{ $detail['Rf'] }} + {{ $detail['Bi'] }} * ({{ $detail['Rm'] }} − {{ $detail['Rf'] }})</p>
                                        <p class="mt-2">{{ $lang['11'] ?? 'R' }} = {{ $detail['Rf'] }} + ({{ $detail['Bi'] }} * {{ $detail['Emp'] }})</p>
                                        <p class="mt-2">{{ $lang['11'] ?? 'R' }} = {{ $detail['Rf'] }} + {{ $detail['Rp'] }} = <strong>{{ $detail['R'] }}%</strong></p>
                                    
                                    @elseif($detail['cal'] === 'Bi')
                                        <p class="mt-2"><strong>{{ $lang['12'] ?? 'Beta' }}</strong></p>
                                        <p class="mt-2">{{ $lang['13'] ?? 'Bi' }} = (R - Rf) / (Rm - Rf)</p>
                                        <p class="mt-2">{{ $lang['13'] ?? 'Bi' }} = ({{ $detail['R'] }} - {{ $detail['Rf'] }}) / ({{ $detail['Rm'] }} − {{ $detail['Rf'] }})</p>
                                        <p class="mt-2">{{ $lang['13'] ?? 'Bi' }} = {{ $detail['s1'] }} / {{ $detail['Emp'] }} = <strong>{{ $detail['Bi'] }}</strong></p>
                                    
                                    @elseif($detail['cal'] === 'Rf')
                                        <p class="mt-2"><strong>{{ $lang['8'] ?? 'Risk-free Rate' }}</strong></p>
                                        <p class="mt-2">{{ $lang['14'] ?? 'Rf' }} = ((Bi * Rm) - R) / (Bi - 1)</p>
                                        <p class="mt-2">{{ $lang['14'] ?? 'Rf' }} = (({{ $detail['Bi'] }} * {{ $detail['Rm'] }}) - {{ $detail['R'] }}) / ({{ $detail['Bi'] }} − 1)</p>
                                        <p class="mt-2">{{ $lang['14'] ?? 'Rf' }} = ({{ $detail['s1'] }} - {{ $detail['R'] }}) / ({{ $detail['Bi'] }} − 1)</p>
                                        <p class="mt-2">{{ $lang['14'] ?? 'Rf' }} = {{ $detail['s2'] }} / {{ $detail['s3'] }} = <strong>{{ $detail['Rf'] }}%</strong></p>
                                    
                                    @elseif($detail['cal'] === 'Rm')
                                        <p class="mt-2"><strong>{{ $lang['9'] ?? 'Market Return' }}</strong></p>
                                        <p class="mt-2">{{ $lang['15'] ?? 'Rm' }} = (Rf * (Bi - 1) + R) / Bi</p>
                                        <p class="mt-2">{{ $lang['15'] ?? 'Rm' }} = ({{ $detail['Rf'] }} * ({{ $detail['Bi'] }} - 1) + {{ $detail['R'] }}) / {{ $detail['Bi'] }}</p>
                                        <p class="mt-2">{{ $lang['15'] ?? 'Rm' }} = (({{ $detail['Rf'] }} * {{ $detail['s1'] }}) + {{ $detail['R'] }}) / {{ $detail['Bi'] }}</p>
                                        <p class="mt-2">{{ $lang['15'] ?? 'Rm' }} = ({{ $detail['s2'] }} + {{ $detail['R'] }}) / {{ $detail['Bi'] }}</p>
                                        <p class="mt-2">{{ $lang['15'] ?? 'Rm' }} = {{ $detail['s3'] }} / {{ $detail['Bi'] }} = <strong>{{ $detail['Rm'] }}%</strong></p>
                                    @endif

                                    <p class="mt-4"><strong>{{ $lang['16'] ?? 'Risk Premium' }}</strong></p>
                                    <p class="mt-2">{{ $lang['17'] ?? 'Risk Premium' }} = Bi * (Rm - Rf)</p>
                                    <p class="mt-2">{{ $lang['17'] ?? 'Risk Premium' }} = {{ $detail['Bi'] }} * ({{ $detail['Rm'] }} − {{ $detail['Rf'] }}) = <strong>{{ $detail['Rp'] }}%</strong></p>
                                    
                                    <p class="mt-4"><strong>{{ $lang['18'] ?? 'Market Risk Premium' }}</strong></p>
                                    <p class="mt-2">{{ $lang['18'] ?? 'Market Risk Premium' }} = Rm - Rf</p>
                                    <p class="mt-2">{{ $lang['18'] ?? 'Market Risk Premium' }} = {{ $detail['Rm'] }} − {{ $detail['Rf'] }} = <strong>{{ $detail['Emp'] }}%</strong></p>
                                    
                                    <p class="mt-4"><strong>{{ $lang['19'] ?? 'Modified CAPM' }}</strong></p>
                                    <p class="mt-2">{{ $lang['11'] ?? 'R' }} = (Rf + Bi * (Rm - Rf)) + ((Rm * Bi) / Rf)</p>
                                    <p class="mt-2">{{ $lang['11'] ?? 'R' }} = ({{ $detail['Rf'] }} + {{ $detail['Bi'] }} * ({{ $detail['Rm'] }} − {{ $detail['Rf'] }})) + (({{ $detail['Rm'] }} * {{ $detail['Bi'] }}) / {{ $detail['Rf'] }})</p>
                                    <p class="mt-2">{{ $lang['11'] ?? 'R' }} = {{ $detail['R'] }} + {{ $detail['Rmr'] }} = <strong>{{ $detail['Rmrp'] }}%</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
