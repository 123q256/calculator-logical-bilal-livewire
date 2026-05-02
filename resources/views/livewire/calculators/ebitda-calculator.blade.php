<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                {{-- Mode Switcher --}}
                <div class="col-12 col-lg-9 mx-auto mt-2 w-full mb-6">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="setMode('simple')" class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $unit_type == 'simple' ? 'bg-[#2845F5] text-white' : 'bg-white hover:bg-blue-50' }}">
                                {{ $lang['Simple'] ?? 'Simple' }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="setMode('extended')" class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $unit_type == 'extended' ? 'bg-[#2845F5] text-white' : 'bg-white hover:bg-blue-50' }}">
                                {{ $lang['Extended'] ?? 'Extended' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Simple Mode Inputs --}}
                @if ($unit_type == 'simple')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2 relative">
                            <label for="x" class="font-s-14 text-blue">{{ $lang['r'] ?? 'Revenue' }}:</label>
                            <input type="number" step="any" wire:model.live="x" id="x" class="input" placeholder="50">
                            <span class="input_unit text-blue absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="y" class="font-s-14 text-blue">{{ $lang['e'] ?? 'Expenses' }}:</label>
                            <input type="number" step="any" wire:model.live="y" id="y" class="input" placeholder="50">
                            <span class="input_unit text-blue absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="a" class="font-s-14 text-blue">{{ $lang['a'] ?? 'Amortization' }}:</label>
                            <input type="number" step="any" wire:model.live="a" id="a" class="input" placeholder="50">
                            <span class="input_unit text-blue absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="d" class="font-s-14 text-blue">{{ $lang['d'] ?? 'Depreciation' }}:</label>
                            <input type="number" step="any" wire:model.live="d" id="d" class="input" placeholder="50">
                            <span class="input_unit text-blue absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>
                @endif

                {{-- Extended Mode Inputs --}}
                @if ($unit_type == 'extended')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2 relative">
                            <label for="rev" class="font-s-14 text-blue">{{ $lang['r'] ?? 'Revenue' }}:</label>
                            <input type="number" step="any" wire:model.live="rev" id="rev" class="input" placeholder="50">
                            <span class="input_unit text-blue absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="net" class="font-s-14 text-blue">{{ $lang['n_p'] ?? 'Net Profit' }}:</label>
                            <input type="number" step="any" wire:model.live="net" id="net" class="input" placeholder="50">
                            <span class="input_unit text-blue absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="Interest" class="font-s-14 text-blue">{{ $lang['Interest'] ?? 'Interest' }}:</label>
                            <input type="number" step="any" wire:model.live="Interest" id="Interest" class="input" placeholder="50">
                            <span class="input_unit text-blue absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="Taxes" class="font-s-14 text-blue">{{ $lang['Taxes'] ?? 'Taxes' }}:</label>
                            <input type="number" step="any" wire:model.live="Taxes" id="Taxes" class="input" placeholder="50">
                            <span class="input_unit text-blue absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="ae" class="font-s-14 text-blue">{{ $lang['a'] ?? 'Amortization' }}:</label>
                            <input type="number" step="any" wire:model.live="ae" id="ae" class="input" placeholder="50">
                            <span class="input_unit text-blue absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="de" class="font-s-14 text-blue">{{ $lang['d'] ?? 'Depreciation' }}:</label>
                            <input type="number" step="any" wire:model.live="de" id="de" class="input" placeholder="50">
                            <span class="input_unit text-blue absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
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
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-3 border-b text-blue" width="70%"><strong>{{ $lang['ebitda'] ?? 'EBITDA' }}</strong></td>
                                        <td class="py-3 border-b text-right text-blue">
                                            <b>{{ !empty($detail['ebitda']) ? $detail['ebitda'] : '0.0' }} {{ $currancy }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 border-b text-blue" width="70%"><strong>{{ $lang['margin'] ?? 'EBITDA Margin' }}</strong></td>
                                        <td class="py-3 border-b text-right text-blue">
                                            <b>{{ !empty($detail['margin']) ? $detail['margin'] : '0.0 %' }}</b>
                                        </td>
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
