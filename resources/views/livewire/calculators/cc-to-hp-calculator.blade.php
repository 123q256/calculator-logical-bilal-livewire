<div>
 <form wire:submit.prevent="calculate">
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="solve" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" wire:model.live="solve" id="solve">
                            <option value="1"> {{ $lang[2] }} </option>
                            <option value="2"> {{ $lang[3] }} </option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="input" class="font-s-14 text-blue" id="cc_hp">
                        {{ $solve == '1' ? $lang['4'] : $lang['6'] }}:
                    </label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model="input" id="input" class="input" aria-label="input" placeholder="50"/>
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
                    <div class="w-full text-center text-[20px]">
                        <p>{{ $lang[5] }}</p>
                        <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg text-[25px] p-3">{{ round($detail['answer'], 2) }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
</div>
