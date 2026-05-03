<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <!-- Consumption -->
                    <div class="col-span-6">
                        <label for="consumption" class="label">{{ $lang['1'] ?? 'Consumption' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="consumption" id="consumption" class="input" aria-label="consumption" placeholder="413" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="consumption_unit" class="label">&nbsp;</label>
                        <div class="w-full py-2">
                            <select wire:model.live="consumption_unit" id="consumption_unit" class="input">
                                <option value="{{ $lang[6] ?? 'million' }}">{{ $lang[6] ?? 'Million' }}</option>
                                <option value="{{ $lang[7] ?? 'billion' }}">{{ $lang[7] ?? 'Billion' }}</option>
                                <option value="{{ $lang[8] ?? 'trillion' }}">{{ $lang[8] ?? 'Trillion' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Investment -->
                    <div class="col-span-6">
                        <label for="investment" class="label">{{ $lang['2'] ?? 'Investment' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="investment" id="investment" class="input" aria-label="investment" placeholder="413" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="investment_unit" class="label">&nbsp;</label>
                        <div class="w-full py-2">
                            <select wire:model.live="investment_unit" id="investment_unit" class="input">
                                <option value="{{ $lang[6] ?? 'million' }}">{{ $lang[6] ?? 'Million' }}</option>
                                <option value="{{ $lang[7] ?? 'billion' }}">{{ $lang[7] ?? 'Billion' }}</option>
                                <option value="{{ $lang[8] ?? 'trillion' }}">{{ $lang[8] ?? 'Trillion' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Government Purchases -->
                    <div class="col-span-6">
                        <label for="purchases" class="label">{{ $lang['3'] ?? 'Government Purchases' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="purchases" id="purchases" class="input" aria-label="purchases" placeholder="413" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="purchases_unit" class="label">&nbsp;</label>
                        <div class="w-full py-2">
                            <select wire:model.live="purchases_unit" id="purchases_unit" class="input">
                                <option value="{{ $lang[6] ?? 'million' }}">{{ $lang[6] ?? 'Million' }}</option>
                                <option value="{{ $lang[7] ?? 'billion' }}">{{ $lang[7] ?? 'Billion' }}</option>
                                <option value="{{ $lang[8] ?? 'trillion' }}">{{ $lang[8] ?? 'Trillion' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Exports -->
                    <div class="col-span-6">
                        <label for="exports" class="label">{{ $lang['4'] ?? 'Exports' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="exports" id="exports" class="input" aria-label="exports" placeholder="4" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="exports_unit" class="label">&nbsp;</label>
                        <div class="w-full py-2">
                            <select wire:model.live="exports_unit" id="exports_unit" class="input">
                                <option value="{{ $lang[6] ?? 'million' }}">{{ $lang[6] ?? 'Million' }}</option>
                                <option value="{{ $lang[7] ?? 'billion' }}">{{ $lang[7] ?? 'Billion' }}</option>
                                <option value="{{ $lang[8] ?? 'trillion' }}">{{ $lang[8] ?? 'Trillion' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Imports -->
                    <div class="col-span-6">
                        <label for="imports" class="label">{{ $lang['5'] ?? 'Imports' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="imports" id="imports" class="input" aria-label="imports" placeholder="4" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="imports_unit" class="label">&nbsp;</label>
                        <div class="w-full py-2">
                            <select wire:model.live="imports_unit" id="imports_unit" class="input">
                                <option value="{{ $lang[6] ?? 'million' }}">{{ $lang[6] ?? 'Million' }}</option>
                                <option value="{{ $lang[7] ?? 'billion' }}">{{ $lang[7] ?? 'Billion' }}</option>
                                <option value="{{ $lang[8] ?? 'trillion' }}">{{ $lang[8] ?? 'Trillion' }}</option>
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

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                 <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="">
                <div class="w-full mt-3">
                    <div class="w-full lg:w-[80%] overflow-auto mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>GDP  </strong>
                                </td>
                                <td class="py-2 border-b">{{ round($detail['gdp'], 4) }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang['9'] }} </strong></td>
                                <td class="py-2 border-b"> {{ round($detail['net_export'], 2) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px] mt-2">
                        <p class="mt-2"><strong>{{ $lang['10'] }}</strong></p>
                        <p class="mt-2">{{ $lang['11'] }}.</p>
                        <p class="mt-2">GDP = {{ $lang['1'] }} + {{ $lang['2'] }} + {{ $lang['3'] }} +
                            {{ $lang['9'] }}</p>
                        <p class="mt-2">{{ $lang['12'] }}.</p>
                        <p class="mt-2">{{ $lang['9'] }} = {{ $lang['4'] }}- {{ $lang['5'] }}</p>
                        <p class="mt-2">{{ $lang['9'] }} = {{ $exports + 0 }}-
                            {{ $imports + 0 }}</p>
                        <p class="mt-2">{{ $lang['9'] }} = {{ round($detail['net_export'], 4) + 0 }}</p>
                        <p class="mt-2">{{ $lang['13'] }}:</p>
                        <p class="mt-2">GDP = {{ $consumption + 0 }} +
                            {{ $investment + 0 }} +
                            {{ $purchases + 0 }} + {{ round($detail['net_export'], 4) + 0 }}</p>
                        <p class="mt-2">GDP = {{ round($detail['gdp'], 4) + 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
            </div>
        @endisset
    </form>
</div>
