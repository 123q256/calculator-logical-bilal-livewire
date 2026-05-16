 <div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-2 md:gap-4 lg:gap-4">
            <div class="col-12 mt-0 mt-lg-2">
                <label for="x" class="label"><?=$lang['enter']?></label>
                <div class="w-full py-2">
                    <input type="text" wire:model.live="x" id="x" class="input" placeholder="135900000" aria-label="input" />
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
        <div class="" x-data="{
                number: {{ $detail['number'] ?? 0 }},
                power: {{ $detail['right'] ?? 0 }},
                get mantissa() {
                    let str = String(this.number).split('.');
                    let dp = str.length > 1 ? str[1].length : 0;
                    dp += this.power;
                    if (dp < 0) dp = 0;
                    if (dp > 20) dp = 20;
                    return (this.number / Math.pow(10, this.power)).toFixed(dp);
                }
            }">
                    @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><?=$lang[2]?></p>
                                <p class="mt-2 font-s-21">
                                    <strong>
                                        <span id="mantissa" x-text="mantissa">{{ $detail['left'] ?? '' }}</span> <span class="text-muted">x 10</span> <sup class="text-[12px]" id="exponent" x-text="power">{{ $detail['right'] ?? '' }}</sup>
                                    </strong>
                                </p>
                                <button type="button" class="calculate mt-2 right cursur-pointer bg-[#2845F5] text-white rounded-lg" style="padding: 10px 15px;cursor: pointer;" @click="power++">←</button>
                                <button type="button" class="calculate mt-2 ms-2 left bg-[#2845F5] text-white rounded-lg" style="padding: 10px 15px;cursor: pointer;" @click="power--">→</button>
                                <p class="mt-3">Standard form is also known as Scientific Notation. <a href="https://calculator-online.net/scientific-notation-calculator/" class="text-blue" target="_blank">Scientific Notation Calculator</a></p>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><?=$lang['e_n']?></td>
                                            <td class="py-2 border-b">{{ $detail['e_ans'] ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><?=$lang['en_n']?></td>
                                            <td class="py-2 border-b">{{ $detail['ee_ans'] ?? '' }} x10<sup class="text-[12px]">{{ $detail['ee_p'] ?? '' }}</sup></td>
                                        </tr>
                                        @if($detail['real_num'] === 0)
                                            <tr>
                                                <td class="py-2 border-b"><?=$lang['r_n']?></td>
                                                <td class="py-2 border-b">{{ $detail['number'] ?? '' }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="py-2 border-b"><?=$lang['sc_n']?></td>
                                                <td class="py-2 border-b"><span id="mantissa" x-text="mantissa">{{ $detail['left'] ?? '' }}</span>
                                                    <span class="text-muted">x 10</span>
                                                    <sup class="text-[12px]" id="exponent" x-text="power">{{ $detail['right'] ?? '' }}</sup></td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
    @endpush
</form>

</div>
