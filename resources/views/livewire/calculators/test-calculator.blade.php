<div>
 <form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto " x-data="{ grades: @entangle('grades') }">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="grades" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" wire:model.live="grades" id="grades">
                        <option value="1">A,B,C,D,......</option>
                        <option value="2">A+,A,A-,B+,......</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="first" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="first" id="first" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="second" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="second" id="second" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="increment" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="increment" id="increment" class="input" aria-label="input" />
                </div>
            </div>
            <p class="col-span-12 text-center mt-3 mb-1"><strong>{{ $lang['5'] }}</strong></p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="grades == '2'">
                <label for="aplus" class="font-s-14 text-blue">{{ $lang['6'] }} A+ ≥</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" wire:model.live="aplus" id="aplus" class="input" aria-label="input" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="a" class="font-s-14 text-blue">{{ $lang['6'] }} A ≥</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="a" id="a" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="grades == '2'">
                <label for="aminus" class="font-s-14 text-blue">{{ $lang['6'] }} A- ≥</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" wire:model.live="aminus" id="aminus" class="input" aria-label="input" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="grades == '2'">
                <label for="bplus" class="font-s-14 text-blue">{{ $lang['6'] }} B+ ≥</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="bplus" id="bplus" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="b" class="font-s-14 text-blue">{{ $lang['6'] }} B ≥</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" wire:model.live="b" id="b" class="input" aria-label="input" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="grades == '2'">
                <label for="bminus" class="font-s-14 text-blue">{{ $lang['6'] }} B- ≥</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="bminus" id="bminus" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="grades == '2'">
                <label for="cplus" class="font-s-14 text-blue">{{ $lang['6'] }} C+ ≥</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" wire:model.live="cplus" id="cplus" class="input" aria-label="input" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="c" class="font-s-14 text-blue">{{ $lang['6'] }} C ≥</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="c" id="c" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="grades == '2'">
                <label for="cminus" class="font-s-14 text-blue">{{ $lang['6'] }} C- ≥</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" wire:model.live="cminus" id="cminus" class="input" aria-label="input" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="grades == '2'">
                <label for="dplus" class="font-s-14 text-blue">{{ $lang['6'] }} D+ ≥</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="dplus" id="dplus" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="d" class="font-s-14 text-blue">{{ $lang['6'] }} D ≥</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" wire:model.live="d" id="d" class="input" aria-label="input" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="grades == '2'">
                <label for="dminus" class="font-s-14 text-blue">{{ $lang['6'] }} D- ≥</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="dminus" id="dminus" class="input" aria-label="input" />
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
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['per']}} %</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['8'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['letter_ans']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['9'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['correct']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['10'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['correct']}}/{{$detail['first']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full mt-3 text-center">                    
                                <table class="w-full font-s-16">
                                    <tr>
                                        <td class="py-2 border-b"><strong># {{$lang[11]}}</strong></td>
                                        <td class="py-2 border-b"><strong># {{$lang[12]}}</strong></td>
                                        <td class="py-2 border-b"><strong>{{$lang[6]}} (%)</strong></td>
                                        <td class="py-2 border-b"><strong>{{$lang[13]}}</strong></td>
                                    </tr>
                                    @for ($i = 0; $i <  count($detail['q_array']) - 1; $i++)
                                        <tr>
                                            <td class="py-2 border-b">{{$detail['q_array'][$i]}}</td>
                                            <td class="py-2 border-b">{{$detail['i_array'][$i]}}</td>
                                            <td class="py-2 border-b">{{$detail['g_array'][$i]}}</td>
                                            <td class="py-2 border-b">{{$detail['l_array'][$i]}}</td>
                                        </tr>
                                    @endfor
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

</form>
</div>
