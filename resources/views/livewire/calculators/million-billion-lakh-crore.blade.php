 <div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="from" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="from" name="from" id="from" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-5 ">
                <label for="calFrom" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" wire:model.live="calFrom" name="calFrom" id="calFrom">
                        <option value="Hundred">{{ $lang['3'] }}</option>
                        <option value="Thousand">{{ $lang['4'] }}</option>
                        <option value="Lakh">{{ $lang['5'] }}</option>
                        <option value="Million">{{ $lang['6'] }}</option>
                        <option value="Crore">{{ $lang['7'] }}</option>
                        <option value="Billion">{{ $lang['8'] }}</option>
                        <option value="Trillion">{{ $lang['9'] }}</option>
                        <option value="Arab">{{ $lang['10'] }}</option>
                        <option value="Kharab">{{ $lang['11'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-2 my-auto text-center">
                <button type="button" class="calculate mt-4 bg-[#2845F5] text-white rounded-lg" 
                    wire:click="swapUnits"
                    style="padding: 5px 10px;cursor: pointer;">⇄</button>
            </div>
            <div class="col-span-5">
                <label for="calto" class="font-s-14 text-blue">{{ $lang['12'] }}</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" wire:model.live="calto" name="calto" id="calto">
                        <option value="Hundred">{{ $lang['3'] }}</option>
                        <option value="Thousand">{{ $lang['4'] }}</option>
                        <option value="Lakh">{{ $lang['5'] }}</option>
                        <option value="Million">{{ $lang['6'] }}</option>
                        <option value="Crore">{{ $lang['7'] }}</option>
                        <option value="Billion">{{ $lang['8'] }}</option>
                        <option value="Trillion">{{ $lang['9'] }}</option>
                        <option value="Arab">{{ $lang['10'] }}</option>
                        <option value="Kharab">{{ $lang['11'] }}</option>
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
    {{-- result --}}
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="col-12 text-[16px]">
                            <p class="mt-2 text-[18px]"><strong>{{ number_format($detail['from_input']) . ' ' . $detail['f_u_input'] }} = {{ $detail['to'] . ' ' . $detail['t_u_input'] }}</strong></p>
                            <p class="mt-2">{{ $lang['13'] }}:</p>
                            <p class="mt-2">
                                <strong class="ans" x-data="{
                                    numberToWords(number) {  
                                        var digit = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];  
                                        var elevenSeries = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];  
                                        var countingByTens = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];  
                                        var shortScale = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];  
                                
                                        number = number.toString(); number = number.replace(/[\, ]/g, ''); if (number != parseFloat(number)) return 'not a number'; var x = number.indexOf('.'); if (x == -1) x = number.length; if (x > 15) return 'too big'; var n = number.split(''); var str = ''; var sk = 0; for (var i = 0; i < x; i++) { if ((x - i) % 3 == 2) { if (n[i] == '1') { str += elevenSeries[Number(n[i + 1])] + ' '; i++; sk = 1; } else if (n[i] != 0) { str += countingByTens[n[i] - 2] + ' '; sk = 1; } } else if (n[i] != 0) { str += digit[n[i]] + ' '; if ((x - i) % 3 == 0) str += 'Hundred '; sk = 1; } if ((x - i) % 3 == 1) { if (sk) str += shortScale[(x - i - 1) / 3] + ' '; sk = 0; } } if (x != number.length) { var y = number.length; str += 'Point '; for (var i = x + 1; i < y; i++) str += digit[n[i]] + ' '; } str = str.replace(/\number+/g, ' '); return str.trim();
                                    }
                                }" x-text="numberToWords('{{ $detail['to'] }}') + ' ' + '{{ $calto }}'"></strong>
                            </p>
                            <p class="mt-2"><strong>{{ $calFrom }} {{ $lang['12'] }}:</strong></p>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[16px]">
                                    @foreach(['t1','t2','t3','t4','t5','t6','t7','t8'] as $t)
                                    <tr>
                                        <td class="py-2 border-b">{{ number_format($from) . ' ' . $calFrom }} = </td>
                                        <td class="py-2 border-b">{{ $detail[$t] }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <p class="my-2"><strong>{{ $lang['14'] }}</strong></p>
                            <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                                {!! $detail['table'] !!}
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
