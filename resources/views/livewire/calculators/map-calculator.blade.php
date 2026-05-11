<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="col-12 lg:w-[80%] mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-5">
                    {{-- Systolic Blood Pressure --}}
                    <div class="w-full">
                        <label for="sbp" class="label">{!! $lang['1'] !!} ({{ $lang['10'] ?? 'Normal' }} 100-120):</label>
                        <div class="relative py-2">
                            <input type="number" step="any" wire:model.live="sbp" id="sbp" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#3E9960]" placeholder="00" aria-label="input" />
                            <span class="absolute right-3 top-5 text-gray-500">mmHg</span>
                        </div>
                    </div>

                    {{-- Diastolic Blood Pressure --}}
                    <div class="w-full">
                        <label for="dbp" class="label">{!! $lang['2'] !!} ({{ $lang['10'] ?? 'Normal' }} 60-80):</label>
                        <div class="relative py-2">
                            <input type="number" step="any" wire:model.live="dbp" id="dbp" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#3E9960]" placeholder="00" aria-label="input" />
                            <span class="absolute right-3 top-5 text-gray-500">mmHg</span>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full p-3 rounded-lg mt-3 result">
                            <div class="w-full">
                                <div class="w-full lg:w-8/12">
                                    <div class="flex flex-wrap justify-between items-center">
                                        {{-- MAP Result --}}
                                        <div class="mt-2 sm:mt-0">
                                            <p class="font-semibold text-gray-700">{{ $lang['3'] }}</p>
                                            <p class="lg:text-lg md:text-lg text-sm">
                                                <strong class="text-[#3E9960] text-3xl">{{ round($detail['map'], 2) }}</strong>
                                                <span class="text-[#3E9960] text-lg font-semibold">(mmHg)</span>
                                            </p>
                                        </div>

                                        {{-- Vertical Divider --}}
                                        <div class="border-r border-gray-300 h-16 hidden sm:block">&nbsp;</div>

                                        {{-- Pulse Pressure Result --}}
                                        <div class="mt-2 sm:mt-0">
                                            <p class="font-semibold text-gray-700">{{ $lang['4'] }}</p>
                                            <p class="lg:text-lg md:text-lg text-sm">
                                                <strong class="text-[#3E9960] text-3xl">{{ round($detail['pr'], 2) }}</strong>
                                                <span class="text-[#3E9960] text-lg font-semibold">(mmHg)</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Clinical Interpretation Messages --}}
                                <div class="mt-8 space-y-4">
                                    @if($detail['map'] < 65)
                            <p class="text-md mt-2"><strong class="text-[#3E9960]">{{ $lang['5'] }}:-</strong></p>
                            <p class="lg:text-md  md:text-lg  text-sm"><strong>{{ $lang['6'] }} >= 65 mmHg.</strong></p>
                        @endif
                
                        @if($detail['dbp'] >= 80)
                            <p class="text-md mt-2"><strong class="text-[#3E9960]">{{ $lang['5'] }}:-</strong></p>
                            <p><strong>{{ $lang['7'].'. '.$lang['8'] }}.</strong></p>
                        @elseif($detail['sbp'] >= 120 && $detail['sbp'] <= 129)
                            <p class="text-md mt-2"><strong class="text-[#3E9960]">{{ $lang['5'] }}:-</strong></p>
                            <p><strong>{{ $lang['9'].'. '.$lang['8'] }}.</strong></p>
                        @elseif($detail['sbp'] > 129)
                            <p class="text-md mt-2"><strong class="text-[#3E9960]">{{ $lang['5'] }}:-</strong></p>
                            <p class="lg:text-md  md:text-lg  text-sm"><strong>{{ $lang['7'].'. '.$lang['8'] }}.</strong></p>
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
