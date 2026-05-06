<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <p class="text-center my-3">{!! $lang['note_value'] !!}</p>
            <div class="grid grid-cols-12 mt-3 gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="x" class="font-s-14 text-blue">{{ $lang['e'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" wire:model.live="x" id="x" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="y" class="font-s-14 text-blue">{{ $lang['i'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" wire:model.live="y" id="y" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div> 
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="z" class="font-s-14 text-blue">{{ $lang['o'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" wire:model.live="z" id="z" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="g" class="font-s-14 text-blue">{{ $lang['g'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" wire:model.live="g" id="g" class="input" aria-label="input" />
                    </div>
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
    <hr>
    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full text-center text-[20px]">
                                <p>{{$lang['ans']}}</p>
                                @if ($detail['era']) 
                                    <p class="my-3">
                                        <strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[32px]">{{$detail['era']}}</strong>
                                    </p>
                                @else
                                    <p class="my-3">
                                        <strong class="bg-sky px-3 py-2 text-blue text-[32px]">0.0</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
