<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="calculation" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="calculation" id="calculation" class="input">
                            <option value="1">{{ $lang[2] }}</option>
                            <option value="2">{{ $lang[3] }}</option>
                            <option value="3">{{ $lang[4] }}</option>
                            <option value="4">{{ $lang[5] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="input" class="font-s-14 text-blue" id="text_change">
                        @if($calculation == '1')
                            {{ $lang[6] }}
                        @elseif($calculation == '2')
                            {{ $lang[3] }}
                        @elseif($calculation == '3')
                            {{ $lang[4] }}
                        @else
                            {{ $lang[5] }}
                        @endif
                    </label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" wire:model.live="input" id="input" class="input" placeholder="00" />
                        <span class="text-blue absolute right-4 top-4 font-semibold">
                            @if($calculation == '1' || $calculation == '2')
                                dBm
                            @elseif($calculation == '3')
                                W
                            @else
                                mW
                            @endif
                        </span>
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
 <hr>
 @isset($detail)
 <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong>
                                        @if ($calculation === "1" || $calculation === "2")
                                            {{ $lang[7] }} ({{ $lang[8] }})
                                        @else
                                            {{ $lang[7] }} ({{ $lang[9] }})
                                        @endif
                                    </strong>
                                </p>
                                <div class="flex justify-center">
                                    <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                                    <strong>{{ round($detail['answer'], 4) . ' ' .$detail['unit'] }}</strong>
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
