<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="col-12 mx-auto mt-2 w-full lg:w-[75%] md:w-[75%]">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="setUnitType('same')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white @if ($unit_type == 'same') tagsUnit @endif ">
                            <span class="font-bold">{{ $lang['1'] ?? 'Same Cash Flow' }}</span>
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="setUnitType('not_same')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white @if ($unit_type == 'not_same') tagsUnit @endif">
                            <span class="font-bold">{{ $lang['8'] ?? 'Different Cash Flow' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                @if ($unit_type === 'same')
                    <div class="grid grid-cols-12 gap-4 animate-fade-in">
                        <div class="col-span-12 md:col-span-6">
                            <label for="initial" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['2'] ?? 'Initial Investment' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="initial" id="initial" class="input" placeholder="100000" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="cash" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['4'] ?? 'Cash Flow' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="cash" id="cash" class="input" placeholder="30000" />
                                <span class="text-blue input_unit">/ year</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="add_sub" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['growth_type'] ?? 'Growth Type' }}:</label>
                            <div class="w-full py-2 relative">
                                <select wire:model.live="add_sub" id="add_sub" class="input">
                                    <option value="in">{{ $lang['5'] ?? 'Increasing' }}</option>
                                    <option value="de">{{ $lang['6'] ?? 'Decreasing' }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="in_de" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['growth_rate'] ?? 'Growth Rate' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="in_de" id="in_de" class="input" placeholder="5" />
                                <span class="text-blue input_unit">% / year</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="year" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['7'] ?? 'Project Duration' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="year" id="year" class="input" placeholder="5" />
                                <span class="text-blue input_unit">Yrs</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="discount" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['3'] ?? 'Discount Rate' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="discount" id="discount" class="input" placeholder="5" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-12 gap-4 animate-fade-in">
                        <div class="col-span-12 md:col-span-6">
                            <label for="initial2" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['2'] ?? 'Initial Investment' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="initial2" id="initial2" class="input" placeholder="100000" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="discount2" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['3'] ?? 'Discount Rate' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="discount2" id="discount2" class="input" placeholder="5" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                        
                        <div class="col-span-12 mt-4">
                            <h3 class="font-bold text-gray-800 border-b pb-2 mb-4">{{ $lang['cash_flows'] ?? 'Annual Cash Flows' }}</h3>
                            <div class="grid grid-cols-12 gap-4">
                                @foreach($years_data as $index => $value)
                                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                                        <label for="year_{{ $index }}" class="font-bold text-gray-600 text-xs  mb-1 block">{{ $lang['9'] ?? 'Year' }} {{ $index + 1 }}:</label>
                                        <div class="w-full py-2 relative">
                                            <input type="number" step="any" wire:model.live="years_data.{{ $index }}" id="year_{{ $index }}" class="input" placeholder="50000" />
                                            <span class="text-blue input_unit">{{ $currancy }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="flex justify-end mt-4">
                                <button type="button" wire:click="addYear" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition-all shadow-md transform hover:scale-105">
                                    + {{ $lang[10] ?? 'Add Year' }}
                                </button>
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
                    <div class="rounded-lg flex flex-col items-center justify-center mt-5">
                        <div class="w-full mt-3">
                            <!-- Summary Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div class="p-6 rounded-2xl bg-gray-150 border flex flex-col items-center">
                                    <span class="  text-xs font-bold tracking-widest mb-2">{{ $lang[15] ?? 'Payback Period' }}</span>
                                    @if(isset($detail['not_back']))
                                        <div class="text-center">
                                            <span class="text-2xl font-black text-orange-600">{{ $detail['back'] }} Years</span>
                                            <p class="text-xs  mt-2">{{ $lang[11] }} {{ $detail['ave_i'] }} {{ $lang[12] }} {{ $currancy }}{{ $detail['ave_cash'] }}/yr</p>
                                        </div>
                                    @else
                                        <span class="text-4xl font-black text-blue-700">{{ $detail['back'] }} <span class="text-xl">Years</span></span>
                                    @endif
                                </div>
                                <div class="p-6 rounded-2xl bg-gray-150  border border-gray-100 flex flex-col items-center">
                                    <span class="text-xs font-bold tracking-widest mb-2">{{ $lang[19] ?? 'Discounted Payback Period' }}</span>
                                    @if(isset($detail['dis_not_back']))
                                        <div class="text-center">
                                            <span class="text-2xl font-black text-orange-600">{{ $detail['dis_back'] }} Years</span>
                                            <p class="text-xs  mt-2">{{ $lang[16] }} {{ $detail['discount2'] ?? $discount }}% {{ $lang[18] }} {{ $currancy }}{{ $detail['ave_cash_d'] }}/yr</p>
                                        </div>
                                    @else
                                        <span class="text-4xl font-black text-green-600">{{ $detail['dis_back'] }} <span class="text-xl">Years</span></span>
                                    @endif
                                </div>
                            </div>

                            <!-- Detailed Table -->
                            <div class="w-full overflow-x-auto bg-white rounded-2xl border border-gray-200 ">
                                <table class="w-full text-sm text-center">
                                    <thead class="bg-gray-50 border-b border-gray-200">
                                        <tr>
                                            <th class="py-4 px-3 font-bold text-gray-700">Years</th>
                                            <th class="py-4 px-3 font-bold text-gray-700">{{ $lang[4] ?? 'Cash Flow' }}</th>
                                            <th class="py-4 px-3 font-bold text-gray-700">{{ $lang[20] ?? 'Cumulative CF' }}</th>
                                            <th class="py-4 px-3 font-bold text-gray-700">{{ $lang[21] ?? 'PV of CF' }}</th>
                                            <th class="py-4 px-3 font-bold text-gray-700">{{ $lang[22] ?? 'Cumulative PV' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        <tr class="bg-blue-50/30">
                                            <td class="py-4 font-bold text-blue-800">Year 0</td>
                                            <td class="py-4 font-bold text-red-600">{{ $currancy }}-{{ number_format($detail['total'], 2) }}</td>
                                            <td class="py-4 font-bold text-red-600">{{ $currancy }}-{{ number_format($detail['total'], 2) }}</td>
                                            <td class="py-4 font-bold text-red-600">{{ $currancy }}-{{ number_format($detail['total'], 2) }}</td>
                                            <td class="py-4 font-bold text-red-600">{{ $currancy }}-{{ number_format($detail['total'], 2) }}</td>
                                        </tr>
                                        {!! $detail['table'] !!}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
