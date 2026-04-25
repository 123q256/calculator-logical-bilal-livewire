<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Solve For --}}
                    <div class="col-span-12">
                        <label class="font-s-14 text-blue font-bold">{!! $lang['1'] ?? 'Solve For' !!}:</label>
                        <div class="relative w-full mt-2">
                            <select wire:model.live="solve" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none bg-white font-medium appearance-none cursor-pointer">
                                <option value="1">{!! $lang['2'] ?? 'mmol/L to mg/dl' !!}</option>
                                <option value="2">{!! $lang['2'] ?? 'mg/dl to mmol/L' !!}</option>
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                                ▾
                            </div>
                        </div>
                    </div>

                    {{-- Input Value --}}
                    <div class="col-span-12">
                        <label class="font-s-14 text-blue font-bold">
                            {!! $lang['3'] ?? 'Input' !!} {{ $solve == '1' ? 'mmol/L' : 'mg/dl' }}:
                        </label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="input_value" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center space-x-4 mt-8">
                @if ($type == 'calculator')
                    @include('inc.button')
                @elseif ($type == 'widget')
                    @include('inc.widget-button')
                @endif
           
            </div>
        </div>

        @if($detail)
            <hr class="my-8">
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="w-full bg-light-blue result p-6 radius-10 mt-3 text-center">
                        <p><strong class="text-[18px]">{!! $lang['4'] ?? 'Result' !!}</strong></p>
                        <p><strong class="text-[#119154] text-[20px] md:text-[30px] font-black">
                            {!! round($detail['answer'], 2) !!} {{ $solve == '1' ? 'mg/dl' : 'mmol/L' }}
                        </strong></p>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
