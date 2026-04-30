<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3 gap-4">
                <div class="col-span-12 px-2">
                    <label for="gravity" class="font-s-14 text-blue">{{ $lang[1] }} (g) (m/s²):</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model="gravity" id="gravity" class="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 px-2">
                    <label for="volume" class="font-s-14 text-blue">{{ $lang[2] }} (V) (m³):</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model="volume" id="volume" class="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 px-2">
                    <label for="density" class="font-s-14 text-blue">{{ $lang[3] }} (ρ) (kg/m³):</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model="density" id="density" class="input" placeholder="00" />
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
                <div class="rounded-lg ">
                    <div class="w-full  mt-3">
                        <div class="w-full">
                            <div class="text-center">
                                <p class="text-[18px]"><strong>{{ $lang['4'] }} (N)</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong>{{ round($detail['answer'], 7) }}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="w-full mt-3 space-y-2">
                                <p class="text-[18px]"><strong>{{ $lang[5] }}</strong></p>
                                <p>{{ $lang[6] }}.</p>
                                <p>B = ρ ∗ V ∗ g</p>
                                <p>{{ $lang[7] }}</p>
                                <p>{{ $lang[8] }}</p>
                                <p>{{ $lang[9] }}</p>
                                <p>{{ $lang[10] }}</p>
                                <p>B = {{ $density }} ∗ {{ $volume }} ∗ {{ $gravity }}</p>
                                <p>B = {{ round($detail['answer'], 7) }} N</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>
</div>
