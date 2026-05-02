<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Tax Year --}}
                    <div class="space-y-2">
                        <label for="tax_year" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Tax Year' }}</label>
                        <select wire:model.live="tax_year" id="tax_year" class="input">
                            <option value="2020">2020 ({{ $lang['2'] ?? 'Due in' }} 2021)</option>
                            <option value="2019">2019 ({{ $lang['2'] ?? 'Due in' }} 2020)</option>
                        </select>
                    </div>

                    {{-- Income --}}
                    <div class="space-y-2 relative">
                        <label for="income" class="font-s-14 text-blue">{{ $lang['quantity'] ?? 'Income' }}</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="income" id="income" class="input" placeholder="00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">{{ $currancy }}</span>
                        </div>
                    </div>

                    {{-- Filing Status --}}
                    <div class="space-y-2">
                        <label for="f_state" class="font-s-14 text-blue">{{ $lang['f_state'] ?? 'Filing Status' }}</label>
                        <select wire:model.live="f_state" id="f_state" class="input">
                            <option value="s">{{ $lang['single'] ?? 'Single' }}</option>
                            <option value="m_j">{{ $lang['m_join'] ?? 'Married Filing Jointly' }}</option>
                            <option value="m_s">{{ $lang['m_sep'] ?? 'Married Filing Separately' }}</option>
                            <option value="h">{{ $lang['h_onwer'] ?? 'Head of Household' }}</option>
                            <option value="w">{{ $lang['5'] ?? 'Qualifying Widow(er)' }}</option>
                        </select>
                    </div>

                    {{-- Age --}}
                    <div class="space-y-2">
                        <label for="age" class="font-s-14 text-blue">{{ $lang['age'] ?? 'Age' }}</label>
                        <input type="number" min="18" max="99" wire:model.live="age" id="age" class="input" placeholder="00">
                    </div>

                    {{-- 401k Contribution --}}
                    <div class="space-y-2 relative">
                        <label for="k_con" class="font-s-14 text-blue">{{ $lang['k_con'] ?? '401k Contribution' }}</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="k_con" id="k_con" class="input" placeholder="00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">{{ $currancy }}</span>
                        </div>
                    </div>

                    {{-- IRA Contribution --}}
                    <div class="space-y-2 relative">
                        <label for="ira" class="font-s-14 text-blue">{{ $lang['ira'] ?? 'IRA Contribution' }}</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="ira" id="ira" class="input" placeholder="00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">{{ $currancy }}</span>
                        </div>
                    </div>

                    {{-- Tax Withheld --}}
                    <div class="space-y-2 relative">
                        <label for="tax_with" class="font-s-14 text-blue">{{ $lang['tax_with'] ?? 'Tax Withheld' }}</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="tax_with" id="tax_with" class="input" placeholder="00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">{{ $currancy }}</span>
                        </div>
                    </div>

                    {{-- Deduction Type --}}
                    <div class="space-y-2">
                        <label for="ded" class="font-s-14 text-blue">{{ $lang['ded'] ?? 'Deduction Type' }}</label>
                        <select wire:model.live="ded" id="ded" class="input">
                            <option value="s">{{ $lang['stand'] ?? 'Standard' }}</option>
                            <option value="i">{{ $lang['item'] ?? 'Itemized' }}</option>
                        </select>
                    </div>

                    {{-- Itemized Deduction (Conditional) --}}
                    @if ($ded === 'i')
                        <div class="col-span-1 md:col-span-2 space-y-2 relative">
                            <label for="item" class="font-s-14 text-blue">{{ $lang['item'] ?? 'Itemized Deductions' }}</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="item" id="item" class="input" placeholder="00">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">{{ $currancy }}</span>
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
             <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full bg-light-blue  rounded-lg mt-6">
                    @isset($detail['e'])
                    <div class="lg:w-[80%] w-full overflow-auto mt-4">
                        <table class="w-full text-lg">
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['e'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }}{{ $detail['e'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['a'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }}{{ $detail['a'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['3'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ number_format(isset($detail['s']) ? $detail['s'] : 0, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['4'] }}</td>
                                <td class="py-2 border-b">{{ isset($detail['m_tax']) ? $detail['m_tax'] : 0 }} %</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['b'] }}</td>
                                <td class="py-2 border-b">{{ $detail['b'] }} %</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['c'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['c'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['d'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['d'] }}</td>
                            </tr>
                        </table>
                    </div>
                    @endisset
                    @isset($detail['f'])
                    <div class="lg:w-[80%] w-full overflow-auto mt-4">
                        <table class="w-full text-lg">
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['f'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['f'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['a'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['a'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['3'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ number_format(isset($detail['s']) ? $detail['s'] : 0, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['4'] }}</td>
                                <td class="py-2 border-b">{{ isset($detail['m_tax']) ? $detail['m_tax'] : 0 }} %</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['b'] }}</td>
                                <td class="py-2 border-b">{{ $detail['b'] }} %</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['c'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['c'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['d'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['d'] }}</td>
                            </tr>
                        </table>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
            </div>
        @endisset
    </form>
</div>
