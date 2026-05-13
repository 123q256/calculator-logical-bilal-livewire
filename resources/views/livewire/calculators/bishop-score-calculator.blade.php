<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="effacement" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="effacement" id="effacement" class="input">
                            <option value="0">0-30%</option>
                            <option value="1">40-50%</option>
                            <option value="2">60-70%</option>
                            <option value="3">More than 80%</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="consistency" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="consistency" id="consistency" class="input">
                            <option value="0">Firm</option>
                            <option value="1">Moderately firm</option>
                            <option value="2">Soft</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fetal_station" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="fetal_station" id="fetal_station" class="input">
                            <option value="0">-3 (Baby has not reached the vaginal canal)</option>
                            <option value="1">-2</option>
                            <option value="2">-1 or 0 (Baby's head has reached the ischial spines)</option>
                            <option value="3">+1 or +2 (Baby's head is already at the end of the canal)</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="head_position" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="head_position" id="head_position" class="input">
                            <option value="0">Posterior</option>
                            <option value="1">Mid-position</option>
                            <option value="2">Anterior</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="dilation" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="dilation" id="dilation" class="input">
                            <option value="0">Closed</option>
                            <option value="1">1-2 cm</option>
                            <option value="2">3-4 cm</option>
                            <option value="3">More than 5 cm</option>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <p><strong>{{ $lang['6'] }}</strong></p>
                        <p><strong class="text-green-500 text-[32px]">{{ $detail['bishopScore'] }}</strong></p>
                        <p>{{ $detail['result'] }}</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
</div>
