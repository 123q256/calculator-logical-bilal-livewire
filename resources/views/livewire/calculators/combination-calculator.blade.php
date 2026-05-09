<div>
 <style>
    [x-cloak] { display: none !important; }
</style>

<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 px-2">
                    <label for="n" class="label n_text">{{ $lang['6'] ?? 'Total number of objects' }}?</label>
                    <div class="w-full py-2 relative">
                        <input type="number" wire:model.live="n" id="n" maxlength="6" class="input " aria-label="input" placeholder="00" />
                        <span class="input_unit n_icon">(n)</span>
                    </div>
                </div>
                <div class="col-span-12 px-2">
                    <label for="r" class="label r_text">{{ $lang['7'] ?? 'Number of objects to be chosen' }}?</label>
                    <div class="w-full py-2 relative">
                        <input type="number" wire:model.live="r" id="r" class="input " aria-label="input" placeholder="00" />
                        <span class="input_unit n_icon">(r)</span>
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
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{ $lang['9'] ?? 'Combination Result C(n, r)' }}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[30px] w-auto bg-[#2845F5] px-4 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $detail['res-ans'] }}</strong>
                                </p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="w-full text-[20px]"><b class="text-blue">{{ $lang['12'] ?? 'Step by Step Solution' }}:</b></p>
                            <p class="w-full mt-4 font-semibold">{{ $lang['13'] ?? 'Combination Formula' }}:</p>
                            <p class="mt-2 p-3 bg-gray-50 rounded italic">C(n, r) = n! / (r! * (n - r)!)</p>
                            
                            <div class="mt-4 space-y-2">
                                <p>{{ $lang['17'] ?? 'Where' }} n = {{ $n }} {{ $lang['18'] ?? 'and' }} r = {{ $r }}</p>
                                <p>C({{ $n }} , {{ $r }}) = ?</p>
                                <p>= {{ $n }}! / ( {{ $r }}! * ( {{ $n }} - {{ $r }} )! )</p>
                                <p>= {{ $n }}! / ( {{ $r }}! * {{ $n - $r }}! )</p>
                                <p>= <strong>{{ $detail['res-ans'] }}</strong></p>
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
