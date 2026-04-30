<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <label for="velocity" class="font-s-14 text-blue">{{ $lang[1] }} (V) (ft/s - FPS):</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model="velocity" id="velocity" class="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang[2] }} (W) ({{ $lang[3] }}):</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model="weight" id="weight" class="input" placeholder="00" />
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
                                <p class="text-[18px]"><strong>FPE ({{ $lang['4'] }})</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong>{{ round($detail['answer'], 7) }}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="w-full mt-3 space-y-2">
                                <p class="text-[18px]"><strong>{{ $lang['5'] }}</strong></p>
                                <p>{{ $lang['6'] }}.</p>
                                <p>FPE = V² ∗ W / 450240</p>
                                <p>{{ $lang['7'] }}</p>
                                <p>{{ $lang['8'] }} (ft/s)</p>
                                <p>{{ $lang['9'] }} ({{ $lang['11'] }})</p>
                                <p>{{ $lang['10'] }} ({{ $lang['11'] }})</p>
                                <p>FPE = {{ $velocity }}² ∗ {{ $weight }} / 450240</p>
                                <p>FPE = {{ round($detail['answer'], 7) }} ft-lb</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>
</div>
