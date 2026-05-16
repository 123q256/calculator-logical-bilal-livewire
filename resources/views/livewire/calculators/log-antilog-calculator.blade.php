 <div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-3 lg:gap-3">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="method" class="font-s-14 text-blue">{{$lang['t_cal']}}</label>
                <div class="w-100 py-2">
                    <select wire:model.live="method" class="input" aria-label="select" name="method" id="method">
                        <option value="log">{{$lang['log']}}</option>
                        <option value="anti">{{$lang['anti']}}</option>
                        <option value="ln">ln</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="x" class="font-s-14 text-blue">{{$lang['x']}}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="x" name="x" id="x" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="y" class="font-s-14 text-blue">{{$lang['y']}}</label>
                <div class="w-100 py-2">
                    <input type="text" step="any" wire:model.live="y" name="y" id="y" class="input" aria-label="input"/>
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
                        <div class="w-full flex justify-center">
                            <div class="w-full text-[18px]">
                                <p class="flex justify-center">
                                    @if($method === "anti")
                                        {{$lang['anti']}}
                                    @elseif($method === "ln")
                                        ln
                                    @else
                                        {{$lang['log']}}
                                    @endif
                                </p>
                                <p class="my-3 flex justify-center"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[32px] rounded-lg ">{{ (isset($detail['ans'])) ? $detail['ans'] : "0.0" }}</strong></p>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset
</form>
</div>
