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
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2">
                        <label for="w" class="font-s-14 text-blue">{!! $lang['1'] ?? 'Enter Weight' !!}:</label>

                        <div class="relative w-full" x-data="{ open: false }">
                            {{-- Input --}}
                            <input type="number" id="w" wire:model.defer="w" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />

                            {{-- Unit Toggle --}}
                            <label for="w_unit" class="absolute cursor-pointer text-sm underline right-6 top-3"
                                @click="open = !open">{{ $w_unit }} ▾</label>
                            {{-- Hidden field to sync --}}
                            <input type="hidden" wire:model="w_unit" id="w_unit" />
                            {{-- Unit Dropdown --}}
                            <div x-show="open" x-cloak @click.outside="open = false"
                                class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[44%] mt-1 right-0">
                                @foreach (['g' => 'grams (g)', 'dag' => 'decagrams (dag)', 'kg' => 'kilograms (kg)', 'oz' => 'ounces (oz)', 'lbs' => 'pounds (lbs)', 'stone' => 'stone'] as $unit => $label)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click="setUnit('{{ $unit }}')" @click="open = false">
                                        {{ $label }}
                                    </p>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Buttons --}}
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
                        <div class="w-full bg-light-blue lg:p-4 md:p-4 p-1 rounded-lg mt-6">
                            <div class="w-full">
                                <div class="bg-[#F6FAFC] text-black border rounded-lg p-4">
                                    <strong>{{ $lang['2'] }} (mg) =</strong>
                                    <span class="text-[#119154] text-lg font-bold">{{ round($detail['bd'], 2) }} (mg)</span>
                                </div>

                                <div class="bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4">
                                    <strong>{{ $lang['3'] }} (12.5 mg / 5 mL) =</strong>
                                    <span class="text-[#119154] text-lg font-bold">{{ round($detail['liquid'], 2) }}
                                        (ml)</span>
                                </div>

                                <div class="w-full overflow-auto mt-4">
                                    <table class="w-full lg:w-3/4 mx-auto border-collapse">
                                        <tr>
                                            <td class="border-b py-2">
                                                <p class="text-[#2845F5]">{{ $lang['4'] }} <strong
                                                        class="text-[#2845F5]">25 <span class="text-[#2845F5]">(mg)</span>
                                                        {{ $lang['7'] }}</strong></p>
                                            </td>
                                            <td class="border-b text-right">
                                                <p class="text-[#2845F5]">{{ intval($detail['bd'] / 25) }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p class="text-[#2845F5]">{{ $lang['4'] }} <strong
                                                        class="text-[#2845F5]">12.5 <span class="text-[#2845F5]">(mg)</span>
                                                        {{ $lang['5'] }}</strong></p>
                                            </td>
                                            <td class="border-b text-right">
                                                <p class="text-[#2845F5]">{{ intval($detail['bd'] / 12.5) }}</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="mt-4">
                                    <p><strong>🕒 {{ $lang['6'] }}.</strong></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endisset
   
    </form>
</div>
