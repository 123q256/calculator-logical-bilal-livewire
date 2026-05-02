<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                {{-- Mode Switcher --}}
                <div class="col-12 mx-auto mt-2 w-full mb-6">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 py-1">
                        <div class="lg:w-1/3 w-full px-1 py-1">
                            <div wire:click="setMode('capm')" class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $unit_type == 'capm' ? 'bg-[#2845F5] text-white' : 'bg-white hover:bg-blue-50' }}">
                                {{ $lang['wacc_calc'] ?? 'WACC Calculator' }}
                            </div>
                        </div>
                        <div class="lg:w-1/3 w-full px-1 py-1">
                            <div wire:click="setMode('cd')" class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $unit_type == 'cd' ? 'bg-[#2845F5] text-white' : 'bg-white hover:bg-blue-50' }}">
                                {{ $lang['cost_equity'] ?? 'Cost of Equity' }}
                            </div>
                        </div>
                        <div class="lg:w-1/3 w-full px-1 py-1">
                            <div wire:click="setMode('debt')" class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $unit_type == 'debt' ? 'bg-[#2845F5] text-white' : 'bg-white hover:bg-blue-50' }}">
                                {{ $lang['cost_debt'] ?? 'Cost of Debt' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- WACC Calculator Mode (capm) --}}
                @if ($unit_type == 'capm')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2 relative">
                            <label for="a" class="font-s-14 text-blue">{{ $lang['a'] ?? 'Debt' }}:</label>
                            <input type="number" step="any" wire:model.live="a" id="a" class="input" placeholder="00">
                            <span class="text-blue input_unit absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="b" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Cost of Debt' }}:</label>
                            <input type="number" step="any" wire:model.live="b" id="b" class="input" placeholder="00">
                            <span class="text-blue input_unit absolute right-4 top-[70%] -translate-y-1/2 font-semibold">%</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="c" class="font-s-14 text-blue">{{ $lang['c'] ?? 'Equity' }}:</label>
                            <input type="number" step="any" wire:model.live="c" id="c" class="input" placeholder="00">
                            <span class="text-blue input_unit absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="d" class="font-s-14 text-blue">{{ $lang['d'] ?? 'Cost of Equity' }}:</label>
                            <input type="number" step="any" wire:model.live="d" id="d" class="input" placeholder="00">
                            <span class="text-blue input_unit absolute right-4 top-[70%] -translate-y-1/2 font-semibold">%</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="e" class="font-s-14 text-blue">{{ $lang['e'] ?? 'Tax Rate' }}:</label>
                            <input type="number" step="any" wire:model.live="e" id="e" class="input" placeholder="00">
                            <span class="text-blue input_unit absolute right-4 top-[70%] -translate-y-1/2 font-semibold">%</span>
                        </div>
                    </div>
                @endif

                {{-- Cost of Equity Mode (cd tab - mapped to cd logic but with custom labels to match screenshot) --}}
                @if ($unit_type == 'cd')
                    <div class="space-y-4">
                        <p class="font-bold text-blue">{{ $lang['capm'] ?? 'Capital Asset Pricing Model (CAPM) Calculator' }}</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2 relative">
                                <label for="risk" class="font-s-14 text-blue">{{ $lang['risk'] ?? 'Risk Free Rate' }}:</label>
                                <input type="number" step="any" wire:model.live="risk" id="risk" class="input" placeholder="13">
                                <span class="text-blue input_unit absolute right-4 top-[70%] -translate-y-1/2 font-semibold">%</span>
                            </div>
                            <div class="space-y-2">
                                <label for="beta" class="font-s-14 text-blue">{{ $lang['cost_equity_label'] ?? 'Cost of Equity' }}:</label>
                                <input type="number" step="any" wire:model.live="beta" id="beta" class="input" placeholder="13">
                            </div>
                            <div class="space-y-2 relative">
                                <label for="eq" class="font-s-14 text-blue">{{ $lang['cost_debt_label'] ?? 'Cost of Debt' }}:</label>
                                <input type="number" step="any" wire:model.live="eq" id="eq" class="input" placeholder="13">
                                <span class="text-blue input_unit absolute right-4 top-[70%] -translate-y-1/2 font-semibold">%</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Cost of Debt Mode (debt tab - mapped to debt logic but with original labels) --}}
                @if ($unit_type == 'debt')
                    <div class="space-y-4">
                        <p class="font-bold text-blue">{{ $lang['debt_calc'] ?? 'Cost of Debt Calculator' }}</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2 relative">
                                <label for="rate" class="font-s-14 text-blue">{{ $lang['int'] ?? 'Interest Rate' }}:</label>
                                <input type="number" step="any" wire:model.live="rate" id="rate" class="input" placeholder="13">
                                <span class="text-blue input_unit absolute right-4 top-[70%] -translate-y-1/2 font-semibold">%</span>
                            </div>
                            <div class="space-y-2 relative">
                                <label for="tax" class="font-s-14 text-blue">{{ $lang['tax'] ?? 'Tax Rate' }}:</label>
                                <input type="number" step="any" wire:model.live="tax" id="tax" class="input" placeholder="13">
                                <span class="text-blue input_unit absolute right-4 top-[70%] -translate-y-1/2 font-semibold">%</span>
                            </div>
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            @if ($unit_type == 'capm')
                                <div class="w-full lg:w-[80%] overflow-auto mt-2">
                                    <table class="w-full lg:text-[18px] md:text-[18px] text-[14px]">
                                        <tr>
                                            <td class="py-3 border-b text-blue" width="70%"><strong>{{ $lang['wacc'] ?? 'Weighted Average Cost of Capital' }} (WACC)</strong></td>
                                            <td class="py-3 border-b text-right text-blue"><b>{{ $detail['wacc'] ?? '0.0' }} %</b></td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 border-b text-blue" width="70%"><strong>{{ $lang['pfe'] ?? 'Proportion of Equity' }} (PFE = E/V)</strong></td>
                                            <td class="py-3 border-b text-right text-blue"><b>{{ $detail['pfe'] ?? '0.0' }} %</b></td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 border-b text-blue" width="70%"><strong>{{ $lang['pfd'] ?? 'Proportion of Debt' }} (PFD = D/V)</strong></td>
                                            <td class="py-3 border-b text-right text-blue"><b>{{ $detail['pfd'] ?? '0.0' }} %</b></td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif ($unit_type == 'cd')
                                <div class="w-full text-center text-[25px]">
                                    <p class="text-blue font-semibold">{{ $lang['eq_prem'] ?? 'Equity Risk Premium' }}</p>
                                    <p class="my-3">
                                        <strong class="bg-[#2845F5] rounded-lg text-white px-6 py-3 text-[30px] shadow-lg inline-block">
                                            {{ $detail['cd'] ?? '0.0' }} %
                                        </strong>
                                    </p>
                                </div>
                            @else
                                <div class="w-full text-center text-[25px]">
                                    <p class="text-blue font-semibold">{{ $lang['cd_label'] ?? 'Cost of Debt' }}</p>
                                    <p class="my-3">
                                        <strong class="bg-[#2845F5] rounded-lg text-white px-6 py-3 text-[30px] shadow-lg inline-block">
                                            {{ $detail['eq'] ?? '0.0' }} %
                                        </strong>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
