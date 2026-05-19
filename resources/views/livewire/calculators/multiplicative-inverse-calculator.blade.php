<div>
  <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="is_frac" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select name="is_frac" class="input" id="is_frac" aria-label="select" wire:model.live="is_frac">
                        <option value="2">{{$lang['3']}}</option>
                        <option value="1">{{$lang['2']."/".$lang['5']}}</option>
                        <option value="3">{{$lang['4']}}</option>
                    </select>
                </div>
            </div>

            @if($is_frac == '2' || $is_frac == '3')
            <div class="col-span-12 @if($is_frac == '3') flex items-center @endif simple_mixed">
                @if($is_frac == '3')
                <div class="pe-2 mixed">
                    <input type="number" step="any" name="s1" id="s1" class="input mb-2" wire:model.live="s1" placeholder="whole number" aria-label="input"/>
                </div>
                @endif
                <div class="simple">
                    <input type="number" step="any" name="n1" id="n1" class="input mb-2" wire:model.live="n1" placeholder="numerator" aria-label="input"/>
                    <hr>
                    <input type="number" step="any" name="d1" id="d1" class="input mt-2" wire:model.live="d1" placeholder="denominator" aria-label="input"/>
                </div>
            </div>
            @endif

            @if($is_frac == '1')
            <div class="col-span-12 integer">
                <input type="number" step="any" name="dec" id="dec" class="input" wire:model.live="dec" aria-label="input"/>
            </div>
            @endif

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
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['6'] }}</strong></td>
                                    <td class="py-2 border-b">{{$detail['ans']}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 text-[16px] mt-2 overflow-auto">
                            @if($is_frac==1)
                                <p class="mt-2">{{$lang['7']}}:</p>
                            @elseif($is_frac==2)
                                <p class="mt-2">{{$lang['8']}}:</p>
                            @else
                                <p class="mt-2">{{$lang['9']}}:</p>
                                <table class="mt-3 text-center">
                                    <tr>
                                        <td rowspan="2" class="p-2"><strong>{{$s1}}</strong></td>
                                        <td class="bdr_btm text-blue p-2"><strong>{{$n1}}</strong></td>
                                        <td rowspan="2" class="p-2"><strong>=</strong></td>
                                        <td class="bdr_btm p-2"><strong>{{$d1}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2"><strong>{{$detail['upr']}}</strong></td>
                                        <td class="text-blue p-2"><strong>{{$d1}}</strong></td>
                                    </tr>
                                </table>
                            @endif
                            <table class="mt-3 text-center">
                                <tr>
                                    <td class="bdr_btm text-blue p-2"><strong>{{$detail['upr']}}</strong></td>
                                    <td rowspan="2"><img class="mx-2" src="{{asset('images/cross-arrow1.png')}}" height="30" width="30" alt="Multiplicative inverse" loading="lazy" decoding="async"></td>
                                    <td class="bdr_btm p-2"><strong>{{$detail['btm']}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2"><strong>{{$detail['btm']}}</strong></td>
                                    <td class="text-blue p-2"><strong>{{$detail['upr']}}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
</div>
