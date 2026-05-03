<div>
    <form wire:submit.prevent="calculate">

        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">

                    <!-- Property Value -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="prop_val" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Property Value' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model="prop_val" id="prop_val" class="input"
                                aria-label="input" placeholder="200000" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Annual Gross Income -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="ann_grs_inc"
                            class="font-s-14 text-blue">{{ $lang['2'] ?? 'Annual Gross Income' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model="ann_grs_inc" id="ann_grs_inc" class="input"
                                aria-label="input" placeholder="30000" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Operating Expenses -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="op_exp" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Operating Expenses' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model="op_exp" id="op_exp" class="input"
                                aria-label="input" placeholder="00" />
                             <span class="text-blue input_unit cursor-pointer"
                                style="pointer-events: auto; z-index: 20; text-decoration: underline;"
                                wire:click="toggleDropdown('op_exp_unit')">
                                {{ $op_exp_unit == '%' ? 'percent (%)' : 'currency (' . $currancy . ')' }} ▾
                            </span>
                            @if ($openDropdown === 'op_exp_unit')
                                <div class="units op_exp_unit w-auto"
                                    style="display: block; position: absolute; right:0; z-index: 10; background: white; border: 1px solid #ccc; top: 100%;">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click="setUnit('op_exp_unit', '%')">percent (%)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click="setUnit('op_exp_unit', '{{ $currancy }}')">currency
                                        ({{ $currancy }})</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Vacancy Rate -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="vac_rate" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Vacancy Rate' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model="vac_rate" id="vac_rate" class="input"
                                aria-label="input" placeholder="10" />
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
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2">
                                <table class="w-100 text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">
                                            <strong>{{ $lang['5'] ?? 'Cap Rate' }}</strong>
                                        </td>
                                        <td class="py-2 border-b">{{ $detail['cap'] }} %</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">
                                            <strong>{{ $lang['6'] ?? 'Gross Operating Income' }}</strong>
                                        </td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ $detail['grs_op_inc'] }} </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">
                                            <strong>{{ $lang['7'] ?? 'Net Operating Income' }}</strong>
                                        </td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ $detail['ann_net_inc'] }} </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"> <strong>{{ $lang['8'] ?? 'Calculation Steps' }}:</strong></p>
                                <p class="mt-2">{{ $lang['6'] ?? 'Gross Operating Income' }} =
                                    {{ $lang['9'] ?? 'Annual Gross Income' }} - {{ $lang['10'] ?? 'Vacancy Amount' }}
                                </p>
                                <p class="mt-2">{{ $lang['6'] ?? 'Gross Operating Income' }} =
                                    {{ $currancy . $detail['ann_grs_inc'] }} - {{ $currancy . $detail['vac_rate1'] }} =
                                    {{ $currancy . $detail['grs_op_inc'] }}</p>
                                @if (isset($detail['percent']))
                                    <p class="mt-2">{{ $lang['7'] ?? 'Net Operating Income' }} = ((100 -
                                        {{ $lang['11'] ?? 'Operating Expenses %' }}) %) * ((100 -
                                        {{ $lang['10'] ?? 'Vacancy Rate' }}) %) *
                                        {{ $lang['9'] ?? 'Annual Gross Income' }}</p>
                                    <p class="mt-2">{{ $lang['7'] ?? 'Net Operating Income' }} = ((100 -
                                        {{ $detail['op_exp'] }}) / 100) * ((100 - {{ $detail['vac_rate'] }}) / 100) *
                                        {{ $currancy . $detail['ann_grs_inc'] }} =
                                        {{ $currancy . $detail['ann_net_inc'] }}</p>
                                @else
                                    <p class="mt-2">{{ $lang['7'] ?? 'Net Operating Income' }} =
                                        {{ $lang['6'] ?? 'Gross Operating Income' }} -
                                        {{ $lang['11'] ?? 'Operating Expenses' }}</p>
                                    <p class="mt-2">{{ $lang['7'] ?? 'Net Operating Income' }} =
                                        {{ $currancy . $detail['grs_op_inc'] }} - {{ $currancy . $detail['op_exp'] }} =
                                        {{ $currancy . $detail['ann_net_inc'] }}</p>
                                @endif
                                <p class="mt-2">{{ $lang['12'] ?? 'Capitalization Rate' }} =
                                    ({{ $lang['7'] ?? 'Net Operating Income' }} /
                                    {{ $lang['13'] ?? 'Property Value' }}) * 100</p>
                                <p class="mt-2">{{ $lang['12'] ?? 'Capitalization Rate' }} =
                                    ({{ $currancy . $detail['ann_net_inc'] }} / {{ $currancy . $detail['prop_val'] }}) *
                                    100 = {{ $detail['cap'] }}%</p>
                                <p class="mt-2">{{ $lang['12'] ?? 'Capitalization Rate' }} =
                                    {{ $detail['cap'] }}%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
