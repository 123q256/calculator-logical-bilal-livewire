<div x-data="{ different_unit: @entangle('different_unit') }">
 <form wire:submit.prevent="calculate">
  

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">
                    
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="cases" class="label">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="cases" id="cases" class="input" aria-label="input" min="0" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="risk" class="label">{!! $lang['2'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="risk" id="risk" class="input" aria-label="input" min="0" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="different_unit" class="label">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="different_unit" id="different_unit" class="input">
                            <option value="Yes">{!! $lang[6] !!}</option>
                            <option value="No">{!! $lang[7] !!}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="different_unit === 'Yes'" x-cloak @if($different_unit !== 'Yes') style="display: none;" @endif>
                    <label for="population" class="label">{!! $lang['4'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="population" id="population" class="input" min="0" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="different_unit === 'No'" x-cloak @if($different_unit !== 'No') style="display: none;" @endif>
                    <label for="per" class="label">{!! $lang['5'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="per" id="per" class="input">
                            <option value="1000">1000</option>
                            <option value="10000">10000</option>
                            <option value="100000">100000</option>
                            <option value="1000000">1000000</option>
                        </select>
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

            
    @isset($detail)
    <hr>
    {{-- result --}}
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                    @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <p><strong>{{ $lang[8] }}:</strong></p>
                        <p><strong class="text-green-500 text-[32px]">{{ round($detail['answer'], 4) }}</strong></p>
                        <p><strong class="text-[20px]">{{ $lang[9] }}:</strong></p>
                        @if($different_unit == "Yes")
                            <p>{{ $lang[10] }}.</p>
                            <p>{{ $lang[8] }} = {{ $lang[1] }} / {{ $lang[2] }} * {{ $lang[4] }}</p>
                            <p>{{ $lang[8] }} = {{ $cases }} / {{ $risk }} * {{ $population }}</p>
                            <p>{{ $lang[8] }} = {{ round($detail['answer'], 7) }}</p>
                        @elseif($different_unit == "No")
                            <p>{{ $lang[10] }}</p>
                            <p>{{ $lang[8] }} = {{ $lang[1] }} / {{ $lang[2] }} * {{ $lang[5] }}</p>
                            <p>{{ $lang[8] }} = {{ $cases }} / {{ $risk }} * {{ $per }}</p>
                            <p>{{ $lang[8] }} = {{ round($detail['answer'], 7) }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
</div>
