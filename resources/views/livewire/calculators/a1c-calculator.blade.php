<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <!-- Solve Type -->
                    <div class="col-span-12">
                        <label for="solve" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="solve" id="solve" class="input">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="2">{{ $lang['3'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Input Field -->
                    <div class="col-span-12">
                        <label for="input" class="font-s-14 text-blue" id="cc_hp">
                            {{ $solve === '1' ? $lang['3'] : $lang['2'] }}:
                        </label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="input" id="input" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            
                            @if($solve === '1')
                                <!-- A1C Units -->
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit1 }} ▾</label>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit1', '%');" @click="open = false">percent (%)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit1', 'mmol/mol');" @click="open = false">mmol/mol</p>
                                </div>
                            @else
                                <!-- Glucose Units -->
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit2 }} ▾</label>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit2', 'mmol/L');" @click="open = false">mmol/L</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit2', 'mg/dL');" @click="open = false">mg/dL</p>
                                </div>
                            @endif
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                    @if($solve === "1")
                                        <p class="col-span-12 mb-2"><strong>{{ $lang[2] }}</strong></p>
                                        <div class="col-span-12">
                                            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                                <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                                    <strong class="text-[#119154] text-[32px]">{{ round($detail['jawab']/18.016, 2) }}</strong>
                                                    <span class="text-[#2845F5] text-[20px]">mmol/L</span>
                                                </div>
                                                <div class="col-span-1 border-r hidden md:block lg:block ps-3 me-3">&nbsp;</div>
                                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                                    <strong class="text-[#119154] text-[32px]">{{ $detail['jawab'] }}</strong>
                                                    <span class="text-[#2845F5] text-[20px]">mg/dL</span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <p class="col-span-12 mb-2"><strong>{{ $lang[3] }}</strong></p>
                                        <div class="col-span-12">
                                            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                                <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                                    <strong class="text-[#119154] text-[32px]">{{ round($detail['jawab'], 2) }}</strong>
                                                    <span class="text-[#2845F5] text-[20px]">%</span>
                                                </div>
                                                <div class="col-span-1 border-r hidden md:block lg:block ps-3 me-3">&nbsp;</div>
                                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                                    <strong class="text-[#119154] text-[32px]">{{ round((($detail['jawab'] - 2.152) / 0.09148), 2) }}</strong>
                                                    <span class="text-[#2845F5] text-[20px]">mmol/mol</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-4 p-3 rounded-lg">
                                    @if($detail['percent'] < 5.7)
                                        <p class="font-semibold text-green-700">{{ $lang[4] }}</p>
                                    @elseif($detail['percent'] >= 5.7 && $detail['percent'] <= 6.4)
                                        <p class="font-semibold text-orange-600">{{ $lang[5] }}</p>
                                    @else
                                        <p class="font-semibold text-red-600">{{ $lang[6] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
