<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Volume --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{{ $lang['1'] ?? 'Volume' }}:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="volume" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('volume_dropdown')">
                                {{ $volume_unit }} ▾
                            </label>
                            @if ($showDropdown === 'volume_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer whitespace-nowrap text-sm" wire:click="setUnit('volume', 'mL')">mL ({!! $lang['2'] ?? 'milliliters' !!})</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer whitespace-nowrap text-sm" wire:click="setUnit('volume', 'L')">L ({!! $lang['3'] ?? 'liters' !!})</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer whitespace-nowrap text-sm" wire:click="setUnit('volume', 'uL')">uL ({!! $lang['4'] ?? 'microliters' !!})</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Molarity --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{{ $lang['5'] ?? 'Molarity' }}:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="molarity" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('molarity_dropdown')">
                                {{ $molarity_unit }} ▾
                            </label>
                            @if ($showDropdown === 'molarity_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer whitespace-nowrap text-sm" wire:click="setUnit('molarity', 'M')">M (mol/lit)</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer whitespace-nowrap text-sm" wire:click="setUnit('molarity', 'mM')">mM (mmol/L)</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer whitespace-nowrap text-sm" wire:click="setUnit('molarity', 'uM')">uM (µmol/L)</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center space-x-4 mt-8">
                @if ($type == 'calculator')
                    @include('inc.button')
                @elseif ($type == 'widget')
                    @include('inc.widget-button')
                @endif
            </div>
        </div>

        @if($detail)
            <hr class="my-8">
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="w-full bg-light-blue result p-6 radius-10 mt-3 text-center">
                        <p><strong class="text-[18px]">{!! $lang['6'] ?? 'Moles' !!}</strong></p>
                        <p><strong class="text-[#119154] text-[20px] md:text-[40px] font-black">{!! round($detail['answer'], 5) !!}</strong></p>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
