<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-12 gap-x-8 gap-y-6">
                    <div class="col-span-12">
                        <p><strong class="text-[#2845F5] text-lg">{{ $lang['12'] }} =</strong> <span class="text-gray-700 font-bold">10 : 1</span></p>
                    </div>

                    {{-- Blood Urea Nitrogen (BUN) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{{ $lang['1'].' - '.$lang['2'] }}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="bun" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-20" placeholder="10">
                            <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20 font-medium text-gray-600" @click="open = !open">{{ $bun_unit }} ▾</label>
                            
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg overflow-hidden">
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('bun_unit', 'mg/dL')" @click="open = false">milligrams per deciliter (mg/dL)</p>
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('bun_unit', 'mmol/L')" @click="open = false">millimoles per liter (mmol/L)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Serum Creatinine --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{{ $lang['3'] }}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="serum" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-20" placeholder="10">
                            <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20 font-medium text-gray-600" @click="open = !open">{{ $serum_unit }} ▾</label>
                            
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg overflow-hidden">
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('serum_unit', 'mg/dL')" @click="open = false">milligrams per deciliter (mg/dL)</p>
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('serum_unit', 'μmol/L')" @click="open = false">micromoles per liter (μmol/L)</p>
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

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <p>{{ $lang['4'] }}</p>
                                <p class="text-[28px]"><strong class="text-green-700">{{ round($detail['ans'],2) }}</strong></p>
                                <p>
                                @if($detail['ans']>=20)
                                    {{ $lang['6'] }} 20, {{ $lang['7'] }} <strong>{{ $lang['8'] }}</strong>.
                                @elseif($detail['ans']<10)
                                    {{ $lang['9'] }} 10,{{ $lang['10'] }} <strong>{{ $lang['11'] }}</strong>.
                                @else
                                    {{ $lang['5'] }}.
                                @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
