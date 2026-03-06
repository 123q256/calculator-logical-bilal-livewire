<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[90%] md:w-[100%] w-full mx-auto ">
            <div class="grid md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="type_unit" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                  <select wire:model="type_unit" wire:change="onTypeUnitChange" id="type_unit" class="input">
                    <option value="{{ $lang['4'] }}">{{ $lang['4'] }}</option>
                    <option value="{{ $lang['5'] }}">{{ $lang['5'] }}</option>
                    <option value="{{ $lang['6'] }}">{{ $lang['6'] }}</option>
                    <option value="{{ $lang['7'] }}">{{ $lang['7'] }}</option>
                    <option value="{{ $lang['8'] }}">{{ $lang['8'] }}</option>
                    <option value="{{ $lang['9'] }}">{{ $lang['9'] }}</option>
                    <option value="{{ $lang['10'] }}">{{ $lang['10'] }}</option>
                    <option value="{{ $lang['11'] }}">{{ $lang['11'] }}</option>
                    <option value="{{ $lang['12'] }}">{{ $lang['12'] }}</option>
                    <option value="{{ $lang['13'] }}">{{ $lang['13'] }}</option>
                    <option value="{{ $lang['14'] }}">{{ $lang['14'] }}</option>
                </select>
                </div>

                <div class="space-y-2">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['2'] }}</label>

                    <div class="relative w-full" x-data="{ open: false }">
                        {{-- Input --}}
                        <input type="number" id="weight" wire:model.defer="weight" step="any"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                            placeholder="00" />

                        {{-- Toggle Label --}}
                        <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-3"
                            @click="open = !open">{{ $weight_unit }} ▾</label>

                        {{-- Hidden Field --}}
                        <input type="hidden" id="weight_unit" wire:model="weight_unit" />

                        {{-- Dropdown --}}
                        <div x-show="open" x-cloak @click.outside="open = false"
                            class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach (['g' => 'grams (g)', 'dag' => 'decagrams (dag)', 'kg' => 'kilograms (kg)', 'lb' => 'pounds (lb)'] as $unit => $label)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    wire:click="setWeightUnit('{{ $unit }}')" @click="open = false">
                                    {{ $label }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @if ($type == 'calculator')
        @include('inc.button')
        @endif
        @if ($type=='widget')
        @include('inc.widget-button')
        @endif
    </div>
          
    @isset($detail)
    <hr style="height: 1px; background-color: #e5e7eb;">
     <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue rounded-lg p-4 mt-6">
                        <div class="my-4">
                            <div class="text-center">
                                <p class="text-lg font-bold text-[#2845F5]">{{ $lang['3'] }}</p>
                                <p class="text-4xl bg-[#2845F5] text-white px-4 py-2 rounded-lg inline-block my-4">
                                    <strong class="">{{ round($detail['answer']) }}<span class="text-lg"> Cal</span></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
 
</form>
</div>
