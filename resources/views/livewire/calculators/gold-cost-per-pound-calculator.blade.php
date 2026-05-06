<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-3">
                    {{-- Total Cost --}}
                    <div class="w-full">
                        <label for="cost" class="label">{{ $lang['1'] }} ({{ $currancy }}):</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live.debounce.500ms="cost" id="cost" step="any" class="input" placeholder="0.00" />
                        </div>
                    </div>

                    {{-- Weight --}}
                    <div class="w-full">
                        <label for="weight" class="label">{{ $lang['3'] }} (lbs):</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live.debounce.500ms="weight" id="weight" step="any" class="input" placeholder="230" />
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
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$lang['3']}}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                                
                                <strong class="text-blue">{{$currancy}} {{$detail['GCP']  }} <span class="font-s-18">/ lb</span></strong></p>
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
