<div>
<form wire:submit.prevent="calculate">
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 flex items-center justify-evenly">
                <p class="label"><strong>{{$lang['1']}}:</strong></p>
                <p class="bnry_cal">
                    <input type="radio" wire:model.live="cal" name="cal" id="bnry_cal" value="bnry_cal" class="cursor-pointer">
                    <label for="bnry_cal" class="font-s-14 cursor-pointer">{{$lang['2']}}</label>
                </p>
                <p class="dec_cal">
                    <input type="radio" wire:model.live="cal" name="cal" id="dec_cal" value="dec_cal" class="cursor-pointer">
                    <label for="dec_cal" class="font-s-14 cursor-pointer">{{$lang['3']}}</label>
                </p>
                <p class="hex_cal">
                    <input type="radio" wire:model.live="cal" name="cal" id="hex_cal" value="hex_cal" class="cursor-pointer">
                    <label for="hex_cal" class="font-s-14 cursor-pointer">{{$lang['4']}}</label>
                </p>
            </div>
            @if($cal === 'bnry_cal' && $this->currentBits() < 55)
            <p class="col-span-12 text-center my-3 text-[14px]" id="dec_rng">
                {{$lang['2']}} {{$lang['8']}} = <span id="dec_range">{{ $this->decRangeText() }}</span>
            </p>
            @endif
            @if($cal === 'dec_cal')
            <p class="col-span-12 text-center my-3 text-[14px]" id="bnry_rng">
                {{$lang['3']}} {{$lang['8']}} = <span id="bnry_range">{{ $this->bnryRangeText() }}</span>
            </p>
            @endif
            @if($cal === 'hex_cal')
            <p class="col-span-12 text-center my-3 text-[14px]" id="hex_rng">
                {{$lang['4']}} {{$lang['8']}} = <span id="hex_range">0-9 {{$lang['15']}} A-F (16-{{$lang['13']}})</span>
            </p>
            @endif
            @if($cal === 'bnry_cal')
            <div class="col-span-12" id="dec">
                <label for="dec_val" class="label">{{$lang['2']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="dec" name="dec" id="dec_val" min="{{ $this->decMin() }}" max="{{ $this->decMax() }}" class="input" aria-label="input"/>
                </div>
            </div>
            @endif
            @if($cal === 'dec_cal')
            <div class="col-span-12" id="bnry">
                <label for="bnry_val" class="label">{{$lang['3']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="bnry" maxlength="{{ $this->bnryMaxLength() }}" name="bnry" id="bnry_val" class="input" aria-label="input" onkeydown="if (![48, 49, 8, 13, 17, 65, 67, 86].includes(event.which)) { event.preventDefault(); }"/>
                </div>
            </div>
            @endif
            @if($cal === 'hex_cal')
            <div class="col-span-12" id="hex">
                <label for="hex_val" class="label">{{$lang['4']}}</label>
                <div class="w-full py-2">
                    <input type="text" step="any" maxlength="16" wire:model.live="hex" name="hex" id="hex_val" class="input" aria-label="input"/>
                </div>
            </div>
            @endif
            @if($cal !== 'hex_cal')
            <div class="col-span-12" id="bit">
                <label for="bits" class="label">{{$lang['5']}}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" wire:model.live="bits" name="bits" id="bits">
                        <option value="4">4-bit</option>
                        <option value="8">8-bit</option>
                        <option value="12">12-bit</option>
                        <option value="16">16-bit</option>
                        <option value="other">{{$lang['6']}}</option>
                    </select>
                </div>
            </div>
            @endif
            @if(($cal === 'dec_cal' || $cal === 'bnry_cal') && $bits === 'other')
            <div class="col-span-12" id="no_of_bits">
                <label for="n_o_b" class="label">{{$lang['7']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" min="2" max="70" wire:model.live="no_of_bits" name="no_of_bits" id="n_o_b" class="input" aria-label="input"/>
                </div>
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}}</strong></td>
                                        <td class="py-2 border-b">{!!$detail['_1s']!!}</td>
                                    </tr>
                                </table>
                                <p class="mt-2 font-s-16"><strong>{{$lang['10']}} {{$detail['bit']}}-bit {{$lang['11']}}:</strong></p>
                                <table class="w-full text-[18px] mt-2">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['2']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['dec']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['3']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['binary']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['4']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['hex']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">1's {{$lang['12']}}</td>
                                        <td class="py-2 border-b"><strong>{!!$detail['_1s']!!}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
    @endpush
</form>
</div>
