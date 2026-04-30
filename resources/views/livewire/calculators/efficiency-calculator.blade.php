<div>
   <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6">
                    <label for="solve" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2">
                        <select wire:model.live="solve" id="solve" class="input">
                            <option value="1">{{ $lang[2] }}</option>
                            <option value="2">{{ $lang[3] }}</option>
                            <option value="3">{{ $lang[4] }}</option>
                        </select>
                    </div>
                </div>

                @if($solve == '1' || $solve == '3')
                <div class="col-span-12 md:col-span-6">
                    <label for="en_in" class="label">{{ $lang[5] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="en_in" id="en_in" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="en_in_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('en_in_unit')">{{ $en_in_unit }} ▾</label>
                        @if($dropdowns['en_in_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['J', 'kJ', 'MJ', 'Wh', 'kWh', 'ft-lbs', 'kcal', 'eV'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('en_in_unit', '{{ $unit }}', 'en_in_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                @if($solve == '1' || $solve == '2')
                <div class="col-span-12 md:col-span-6">
                    <label for="en_ou" class="label">{{ $lang[6] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="en_ou" id="en_ou" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="en_ou_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('en_ou_unit')">{{ $en_ou_unit }} ▾</label>
                        @if($dropdowns['en_ou_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['J', 'kJ', 'MJ', 'Wh', 'kWh', 'ft-lbs', 'kcal', 'eV'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('en_ou_unit', '{{ $unit }}', 'en_ou_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                @if($solve == '2' || $solve == '3')
                <div class="col-span-12 md:col-span-6">
                    <label for="en_ef" class="label">{{ $lang[3] }} (%):</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" wire:model="en_ef" id="en_ef" class="input" placeholder="00" />
                        <span class="text-blue input_unit">%</span>
                    </div>
                </div>
                @endif
        </div>
    </div>
     @if ($type == 'calculator')
     @include('inc.button')
    @endif
    @if ($type=='widget')
    @include('inc.widget-button')
     @endif
 </div>
<hr>

    @if(isset($detail))
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]">
                                <strong>
                                    @if ($solve === "1") {{ $lang[2] }} @elseif ($solve === "2") {{ $lang[3] }} @else {{ $lang[4] }} @endif
                                </strong>
                            </p>
                            <div class="flex justify-center">
                                <p class="text-[32px] bg-[#2845F5] text-white rounded-lg px-3 py-2 my-3">
                                    <strong>{{ round($detail['answer'], 4) }} @if ($solve === "2" || $solve === "3") J @else % @endif</strong>
                                </p>
                            </div>
                        </div>
                        <div class="w-full mt-3 space-y-2">
                            <p class="text-[18px]"><strong>{{ $lang[6] }}</strong></p>
                            @if($solve == '1')
                                <p>Efficiency = (Energy Output / Energy Input) * 100</p>
                                <p>Efficiency = ({{ $en_ou }} {{ $en_ou_unit }} / {{ $en_in }} {{ $en_in_unit }}) * 100</p>
                                <p>Efficiency = {{ round($detail['answer'], 4) }}%</p>
                            @elseif($solve == '2')
                                <p>Energy Input = (Energy Output * 100) / Efficiency</p>
                                <p>Energy Input = ({{ $en_ou }} {{ $en_ou_unit }} * 100) / {{ $en_ef }}%</p>
                                <p>Energy Input = {{ round($detail['answer'], 4) }} J</p>
                            @else
                                <p>Energy Output = (Efficiency / 100) * Energy Input</p>
                                <p>Energy Output = ({{ $en_ef }}% / 100) * {{ $en_in }} {{ $en_in_unit }}</p>
                                <p>Energy Output = {{ round($detail['answer'], 4) }} J</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
</div>
