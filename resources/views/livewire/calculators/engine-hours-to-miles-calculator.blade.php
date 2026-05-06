<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-3">
                    {{-- Engine Hours --}}
                    <div class="w-full">
                        <label for="f_input" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full mt-2"> 
                            <input type="number" step="any" wire:model.live.debounce.500ms="f_input" id="f_input" class="input" placeholder="00" />
                        </div>
                    </div>
                    {{-- Speed Factor --}}
                    <div class="w-full">
                        <label for="s_input" class="label">{{ $lang['2'] }}:</label>
                        <div class="w-full mt-2">
                            <input type="number" step="any" wire:model.live.debounce.500ms="s_input" id="s_input" class="input" placeholder="00" />
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="col-12 bg-light-blue p-3 radius-10 mt-3 w-full">
                            <div class="w-full">
                                <div >
                                    <p class="text-[20px] text-center"><strong>{{ $lang['6'] }}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2 my-3">
                                            <strong class="text-blue">{{ $detail['answer'] }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[20px]"><strong>{{ $lang[3] }}</strong></p>
                                    <p class="mt-2">{{ $lang[1] }} = {{ $f_input }}</p>
                                    <p class="mt-2">{{ $lang[2] }} = {{ $s_input }}</p>
                                    <p class="text-[20px] my-3"><strong>{{ $lang[4] }}</strong></p>
                                    <p>{{ $lang[5] }} = {{ $lang[1] }} * {{ $lang[2] }}</p>
                                    <p class="mt-2">{{ $lang[6] }} = {{ $f_input }} * {{ $s_input }}</p>
                                    <p class="mt-2">{{ $lang[6] }} = {{ round($detail['answer']) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
