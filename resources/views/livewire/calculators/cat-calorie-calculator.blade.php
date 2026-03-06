<div>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <form wire:submit.prevent="calculate" class="row">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Weight --}}
                    <div class="space-y-2">
                        <label for="weight" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Enter Weight' }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" id="weight" wire:model.defer="weight" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                @click="open = !open">{{ $unit }} ▾</label>
                            <input type="hidden" wire:model="unit" id="unit" />
                            <div x-show="open" x-cloak @click.outside="open = false"
                                class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[44%] mt-1 right-0">
                                @foreach (['kg' => 'kilograms (kg)', 'oz' => 'ounces (oz)', 'lbs' => 'pounds (lbs)'] as $unit => $label)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click="setUnit('{{ $unit }}')" @click="open = false">
                                        {{ $label }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Condition --}}
                    <div class="space-y-2">
                        <label for="condition"
                            class="font-s-14 text-blue">{{ $lang['2'] ?? 'Select Condition' }}:</label>
                        <select id="condition" wire:model="condition" class="input w-full">
                            @foreach (['Neutered adult', 'Non-neutered adult', 'Weight loss', 'Weight gain', '0-4 months old kitten', '4 months to adult cat'] as $cond)
                                <option value="{{ $cond }}">{{ $cond }}</option>
                            @endforeach
                        </select>
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
       

        @isset($detail)
        <hr style="height: 1px; background-color: #e5e7eb;">
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full bg-light-blue rounded-lg p-4 mt-6">
                            <div class="w-full">
                                <div class="flex flex-col md:flex-row md:justify-between md:w-1/2 mx-auto">
                                    <div class="text-center md:text-left">
                                        <p><strong>{{ $lang['3'] }}</strong></p>
                                        <p>
                                            <strong
                                                class="text-[#119154] text-4xl">{{ round($detail['resting_energy'], 2) }}</strong>
                                            <span class="text-lg">kcal</span>
                                        </p>
                                    </div>
                                    <div class="hidden md:block border-r mx-4"></div>
                                    <div class="text-center md:text-left">
                                        <p><strong>{{ $lang['4'] }}</strong></p>
                                        <p>
                                            <strong
                                                class="text-[#119154] text-4xl">{{ round($detail['maintenance_energy'], 2) }}</strong>
                                            <span class="text-lg">kcal</span>
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
