<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="build_date" class="font-s-14 text-blue one_text">{{ $lang['1'] }}:</label>
                        <input type="date" wire:model.live="build_date" id="build_date" class="input" aria-label="Build Date" />
                    </div>
                    <div class="space-y-2">
                        <label for="structure_type" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <select wire:model.live="structure_type" id="structure_type" class="input">
                            <option value="concrete">{{ $lang[3] }}</option>
                            <option value="cement-bricks">{{ $lang[4] }}</option>
                            <option value="wooden">{{ $lang[5] }}</option>
                            <option value="stone">{{ $lang[6] }}</option>
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
        <hr>
        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full p-3 rounded-lg mt-3">
                                <div class="my-1 text-center">
                                    <p class="text-[24px] font-bold text-gray-800 mb-6">{{ $lang[7] }}</p>
                                    <div class="flex lg:flex-wrap md:flex-wrap justify-center lg:gap-8 md:gap-4 gap-2 my-4">
                                        <div class="text-center px-4">
                                            <p><strong class="text-green-600 lg:text-[32px] md:text-[32px] text-[24px]">{{ $detail['years'] }}</strong></p>
                                            <p class="lg:text-[16px] text-[14px] text-gray-500 font-medium uppercase tracking-wider">{{ $lang[8] }}</p>
                                        </div>
                                        <div class="text-center px-4 border-x border-gray-200">
                                            <p><strong class="text-green-600 lg:text-[32px] md:text-[32px] text-[24px]">{{ $detail['months'] }}</strong></p>
                                            <p class="lg:text-[16px] text-[14px] text-gray-500 font-medium uppercase tracking-wider">{{ $lang[9] }}</p>
                                        </div>
                                        <div class="text-center px-4">
                                            <p><strong class="text-green-600 lg:text-[32px] md:text-[32px] text-[24px]">{{ $detail['days'] }}</strong></p>
                                            <p class="lg:text-[16px] text-[14px] text-gray-500 font-medium uppercase tracking-wider">{{ $lang[10] }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-8 md:p-6 p-3 bg-green-50 rounded-xl border border-green-100 shadow-sm">
                                        <p class="md:text-[18px] text-gray-700 leading-relaxed">
                                            {{ $lang[11] }}
                                            <span class="font-bold text-green-800">
                                                @if($structure_type == 'concrete')
                                                    {{ $lang[12] }}
                                                @elseif($structure_type == 'cement-bricks')
                                                    {{ $lang[13] }}
                                                @elseif($structure_type == 'wooden')
                                                    {{ $lang[14] }}
                                                @elseif($structure_type == 'stone')
                                                    {{ $lang[15] }}
                                                @endif
                                                {{ $detail['predicted_age'] }} {{ $lang[16] }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
</div>
