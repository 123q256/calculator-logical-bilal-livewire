<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 gap-4">
                    <!-- Current Rent -->
                    <div class="col-span-12">
                        <label for="rent" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Current Monthly Rent' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="rent" id="rent" class="input" aria-label="rent" placeholder="2000" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Rent Increase Rate -->
                    <div class="col-span-12">
                        <label for="year" class="font-s-12 text-blue">{{ $lang['2'] ?? 'Rent Increase Percentage' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="year" id="year" class="input" aria-label="year" placeholder="5" />
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>

                    <!-- Duration -->
                    <div class="col-span-12">
                        <label for="numbers" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Increase Over' }}:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" wire:model.live="numbers" id="numbers" step="any"
                                class="input pr-20" aria-label="numbers" placeholder="2" />

                            <div class="">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('numbers_unit')">
                                    {{ $numbers_unit }} ▾
                                </label>
                                <input type="hidden" name="numbers_unit" value="{{ $numbers_unit }}">
                                @if ($openDropdown === 'numbers_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="closeDropdown()"></div>
                                    <div
                                        class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0">
                                        @foreach (['wks', 'mos', 'yrs'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('numbers_unit', '{{ $val }}')">
                                                {{ $val }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
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
                                        <td class="py-3" width="60%"><strong>{{ $lang['4'] ?? 'New Rent Amount' }}</strong></td>
                                        <td class="py-3 text-xl font-bold orange-text">{{ $currancy }} {{ round($detail['answer'], 2) + 0 }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px] mt-5">
                                <p class="mt-2 font-bold text-lg text-blue-600 mb-4">{{ $lang['5'] ?? 'Calculation Breakdown' }}</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border">
                                    <p class="leading-relaxed">{{ $lang['6'] ?? 'The New Rent is calculated using the following compound increase formula' }}:</p>
                                    <p class="font-bold py-2 px-4 bg-white rounded border border-blue-100 inline-block">
                                        {{ $lang['4'] ?? 'New Rent' }} = {{ $lang['1'] ?? 'Rent' }} * (1 + r)<sup>n</sup>
                                    </p>
                                    
                                    <div class="pt-4 border-t border-gray-200 space-y-2">
                                        <p class="text-sm text-gray-600"><strong>Variables:</strong></p>
                                        <ul class="list-disc pl-8 space-y-1 text-sm">
                                            <li><strong>{{ $lang['1'] ?? 'Rent' }}</strong> = {{ $currancy }}{{ $rent + 0 }}</li>
                                            <li><strong>r (Rate)</strong> = {{ $year + 0 }}% per year</li>
                                            <li><strong>n (Years)</strong> = {{ $numbers + 0 }} {{ $numbers_unit }}</li>
                                        </ul>
                                        
                                        <p class="pt-4"><strong>Calculation:</strong></p>
                                        <p class="pl-4 border-l-4 border-blue-200 italic">
                                            New Rent = {{ $rent + 0 }} * (1 + {{ $year / 100 }})<sup>{{ round($detail['numbers'] ?? $numbers, 4) }}</sup><br>
                                            <span class="text-xl font-bold orange-text">New Rent = {{ $currancy }} {{ round($detail['answer'], 2) + 0 }}</span>
                                        </p>
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
