<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-5">
                    {{-- WBC Count --}}
                    <div class="space-y-2 relative">
                        <label for="wbs" class="label">{!! $lang['wbs'] !!}:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="wbs" id="wbs" class="input" placeholder="{{ $lang['normal'] }}" />
                            <span class="absolute right-3 top-2.5 text-gray-500 font-medium">×10³/μL</span>
                        </div>
                    </div>

                    {{-- Neutrophils --}}
                    <div class="space-y-2 relative">
                        <label for="segs" class="label">{!! $lang['neu'] !!}:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="segs" id="segs" class="input" placeholder="00" />
                            <span class="absolute right-3 top-2.5 text-gray-500 font-medium">%</span>
                        </div>
                    </div>

                    {{-- Bands --}}
                    <div class="space-y-2 relative">
                        <label for="bands" class="label">{!! $lang['bands'] !!}:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="bands" id="bands" class="input" placeholder="00" />
                            <span class="absolute right-3 top-2.5 text-gray-500 font-medium">%</span>
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

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full text-center">
                                <p class="w-full text-[20px] mt-2"><strong>{{ $lang['anc'] }}</strong></p>
                                <p class="w-full text-[25px]">
                                    @if(isset($detail['anc']))
                                        <strong class="text-green-500">{{ number_format($detail['anc'], 2) }} ×10³/μL</strong>
                                    @else
                                        <strong class="text-green-500">0.0 ×10³/μL</strong>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
