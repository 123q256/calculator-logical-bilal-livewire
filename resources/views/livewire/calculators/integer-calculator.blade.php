<div>
  <style>
    img{
        object-fit: contain;
    }
    </style>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <p class="col-span-12 text-center my-3 text-[18px]">
                <strong id="changeText">
                    @if ($opr == '2')
                        a - b = ?
                    @elseif ($opr == '3')
                        a x b = ?
                    @elseif ($opr == '4')
                        a ÷ b = ?
                    @elseif ($opr == '5')
                        a<sup class="font-s-14">b</sup> = ?
                    @elseif ($opr == '6')
                        <sup class="font-s-14">b</sup>√a = ?
                    @elseif ($opr == '7')
                        log<sub>a</sub>b = ?
                    @else
                        a + b = ?
                    @endif
                </strong>
            </p>
            <div class="col-span-12">
                <label for="opr" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="opr" id="opr" wire:model.live="opr">
                        <option value="1">{{$lang[2]}}</option>
                        <option value="2">{{$lang[3]}}</option>
                        <option value="3">{{$lang[4]}}</option>
                        <option value="4">{{$lang[5]}}</option>
                        <option value="5">{{$lang[6]}}</option>
                        <option value="6">{{$lang[7]}}</option>
                        <option value="7">{{$lang[8]}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="a" class="label">a</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="a" id="a" class="input" wire:model.live="a" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="b" class="label">b</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="b" id="b" class="input" wire:model.live="b" aria-label="input" />
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
                            <div class="w-full text-center text-[20px]">
                                <p>{!!$detail['ansText']!!}</p>
                                <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[32px] rounded-lg ">{!!$detail['ans']!!}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>

</div>
