<div x-data="{ formula: @entangle('formula') }">
  <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="formula" class="label">{!! $lang['1'] !!}:</label>
                <div class="w-full py-2 relative">
                    <select wire:model.live="formula" id="formula" class="input">
                        <option value="1">{!! $lang[2] !!}</option>
                        <option value="2">{!! $lang[3] !!}</option>
                        <option value="3">{!! $lang[4] !!}</option>
                        <option value="4">{!! $lang[5] !!}</option>
                        <option value="5">{!! $lang[6] !!}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12  text-center">
                <div x-cloak x-show="formula === '1'"><strong>HR<sub>{{ $lang[7] }}</sub> = 205.8 - (0.685 * {{ $lang[8] }})</strong></div>
                <div x-cloak x-show="formula === '2'"><strong>HR<sub>{{ $lang[7] }}</sub> = 220 - {{ $lang[8] }}</strong></div>
                <div x-cloak x-show="formula === '3'"><strong>HR<sub>{{ $lang[7] }}</sub> = 211 - (0.64 * {{ $lang[8] }})</strong></div>
                <div x-cloak x-show="formula === '4'"><strong>HR<sub>{{ $lang[7] }}</sub> = 192 - (0.007 * {{ $lang[8] }}<sup>2</sup>)</strong></div>
                <div x-cloak x-show="formula === '5'"><strong>HR<sub>{{ $lang[7] }}</sub> = 208 - (0.07 * {{ $lang[8] }})</strong></div>
            </div>
            <div class="col-span-12">
                <label for="age" class="label">{!! $lang['9'] !!}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" wire:model.live="age" id="age" class="input" aria-label="input" placeholder="00" />
                    <span class=" input_unit">years</span>
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
    
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full  mt-3">
                        <div class="w-full">
                            <p><strong>{{ $lang[10] }}</strong></p>
                            <p>
                                <strong class="text-green-700 text-[32px]">{{ round($detail['answer'], 2) }}</strong>
                                <span class="text-green-700 text-[18px]">BPM</span>
                            </p>
                            <p class="my-2">{{ $lang[11] }}.</p>
                            <p>{{ $lang[12] }}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
</div>
