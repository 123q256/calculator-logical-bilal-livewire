<div>
   <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 mb-1 flex items-center">
                <p class="font-s-14 text-blue pe-lg-2 pe-2">
                    {{$lang['calculate']}} {{$lang['1']}}:
                </p>
                <div class="flex items-center mr-4">
                    <input type="radio" name="cal_by" id="elements" value="elements" wire:click="setCalBy('elements')" {{ $cal_by === 'elements' ? 'checked' : '' }} class="cursor-pointer mr-1">
                    <label for="elements" class="font-s-14 pe-lg-3 pe-2 cursor-pointer">{{$lang['2']}}</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" name="cal_by" id="cardinality" value="cardinality" wire:click="setCalBy('cardinality')" {{ $cal_by === 'cardinality' ? 'checked' : '' }} class="cursor-pointer mr-1">
                    <label for="cardinality" class="font-s-14 cursor-pointer">{{$lang['3']}}</label>
                </div>
            </div>

            <div class="col-span-12 {{ $cal_by === 'elements' ? '' : 'hidden' }}" id="setInput">
                <label for="set_val" class="font-s-14 text-blue">{{$lang[4]}} (,):</label>
                <div class="w-full py-2">
                    <textarea aria-label="textarea input" id="set_val" name="set_val" class="textareaInput" wire:model.live="set_val"></textarea>
                </div>
            </div>

            <div class="col-span-12 {{ $cal_by === 'cardinality' ? '' : 'hidden' }}" id="cardinalInput">
                <label for="cardinal" class="font-s-14 text-blue">{{$lang[5]}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="cardinal" id="cardinal" class="input" wire:model.live="cardinal" aria-label="input"/>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result overflow-auto">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['6']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['subsets']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['7']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['pro_subsets']}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{$lang['8']}}</strong></p>
                            @php $ne = $detail['ne']; $value1 = 1; @endphp
                            <p class="mt-2"><strong>{{ $ne[0] }}</strong> {{ $lang['9'] }} <strong>{{ $lang['10'] }}</strong> {{ $lang['11'] }}.</p>
                            @foreach($ne as $key => $value)
                                @if($key != 0)
                                    <p class="mt-2"><strong>{{ $value }}</strong> {{ $lang['9'] }} <strong>{{ $value1 }}</strong> {{ $lang['11'] }}.</p>
                                    @php $value1++; @endphp
                                @endif
                            @endforeach
                        </div>
                        @isset($detail['pw'])
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['6']}}</strong></p>
                                <p class="mt-2">{{$detail['pw']}}</p>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
