<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="per" class="font-s-14 text-blue">{{$lang['1']}} %</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="per" id="per" class="input" wire:model.live="per" aria-label="input"/>
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

    @if(isset($detail) && isset($detail['ans']))
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                    @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%] overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['2']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['ans']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px] mt-2">
                                <p class="mt-2"><strong>Solution</strong></p>
                                <p class="mt-2">{{$lang[5]}} <strong>100</strong> </p>
                                <p class="mt-2">{{$per}} % = {{$per}} / 100</p>
                                <p class="mt-2"> = {{$detail['ans']}} {{$lang[6]}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endif
</form>
</div>
