<div>
    <style>
    @media (max-width: 360px) {
        .calculator-box{
            padding-right: 0rem;
            padding-left: 0rem;
        }
    }
</style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="w-full px-2 mb-2">
                    <p><strong class="text-blue">{{ $lang['limit'] }}</strong></p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="font-s-14 text-blue">{{ $lang['Mass'] }}</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="lx" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <button type="button" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit_x')">{{ $unit_x }} ▾</button>
                            @if ($openDropdown === 'unit_x')
                                <div wire:key="dropdown-x" class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'g')">grams (g)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'µg')">micrograms (µg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'mg')">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'lbs')">pounds (lbs)</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="font-s-14 text-blue">{!! $lang['weight'] !!}:</label>
                        <div class="w-full relative">
                            <input type="number" step="any" wire:model="ly" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            <span class="absolute right-4 top-2 text-blue text-sm">g / mol</span>
                        </div>
                    </div>

                    <div class="space-y-2 relative">
                        <label class="font-s-14 text-blue">{!! $lang['sat'] !!}:</label>
                        <input type="number" step="any" wire:model="sx" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                    </div>
                </div>

                <div class="col-12 px-2 my-2">
                    <p><strong class="text-blue">{{ $lang['dp'] }}</strong></p>
                </div>

                <div class="grid grid-cols-1 my-3 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 relative">
                        <label class="font-s-14 text-blue">Mole(s):</label>
                        <input type="number" step="any" wire:model="dx" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                    </div>
                    <div class="space-y-2">
                        <label class="font-s-14 text-blue">{!! $lang['weight'] !!}:</label>
                        <div class="w-full relative">
                            <input type="number" step="any" wire:model="dy" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            <span class="absolute right-4 top-2 text-blue text-sm">g / mol</span>
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
                            <div class="lg:w-[80%] md:w-[80%] w-full overflow-visible mt-2 text-[20px] ">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['theo'] }}</strong></td>
                                        <td class="border-b py-2 relative overflow-visible">
                                            <span>{{ $this->getConvertedValue($detail['ans'] ?? null) }}</span>
                                            <button type="button" class="ml-2 text-sm underline text-blue" wire:click="toggleDropdown('result_unit')">{{ $result_unit }} ▾</button>
                                            @if ($openDropdown === 'result_unit')
                                                <div wire:key="dropdown-result" class="absolute z-[9999] bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl max-h-60 overflow-y-auto min-w-[60px]">
                                                    @foreach ($massUnits as $unit => $multiplier)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setResultUnit('{{ $unit }}')">{{ $unit }}</p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['limit'] }} (moles)</strong></td>
                                        <td class="border-b py-2">{{ $detail['mole'] ?? '00' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['sp'] }}</strong></td>
                                        <td class="border-b py-2">{{ $detail['st'] ?? '00' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
