<div>
    @php
        if (!function_exists('safe_round')) {
            function safe_round($val, $precision = 5) {
                if ($val === 'NAN' || $val === 'NaN' || (is_numeric($val) && is_nan((float)$val))) {
                    return 'NAN';
                }
                if ($val === 'INF' || $val === 'INF' || $val === 'infinity' || $val === 'Infinity' || (is_numeric($val) && is_infinite((float)$val))) {
                    return 'INF';
                }
                return is_numeric($val) ? round((float)$val, $precision) : $val;
            }
        }
    @endphp
  <form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto" x-data="{
    same_sample: @entangle('same_sample').live,
    entries: @entangle('entries').live,
    init() {
        this.$watch('entries', value => {
            if (value.length > 0) {
                let last = value[value.length - 1];
                if (last.percentage !== '' && value.length < 10) {
                    this.entries.push({ percentage: '', sample: '' });
                }
                if (value.length > 2) {
                    let secondLast = value[value.length - 2];
                    if (last.percentage === '' && secondLast.percentage === '') {
                        this.entries.pop();
                    }
                }
            }
        });
    }
}">
            <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 inputs">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="same_sample" class="font-s-14 text-blue">Are all sample sizes the same?:</label>
                        <div class="w-full py-2">
                            <select x-model="same_sample" class="input" id="same_sample" aria-label="select">
                                <option value="no">{{$lang['no']}}</option>
                                <option value="yes">{{$lang['yes']}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 entry">
                    <p class="col-span-12 text-[14px]"><strong><?=$lang['entry']?> # 1</strong></p>
                    <div :class="same_sample === 'yes' ? 'col-span-12' : 'col-span-6'" class="mt-0 mt-lg-2 px-2 percentage">
                        <label for="percentage0" class="font-s-14 text-blue"><?=$lang['percent']?>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" x-model="entries[0].percentage" id="percentage0" class="input percent" aria-label="input" />
                        </div>
                    </div>
                    <div x-show="same_sample === 'no'" class="col-span-6 sample">
                        <label for="sample0" class="font-s-14 text-blue"><?=$lang['sample']?>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" x-model="entries[0].sample" id="sample0" class="input" aria-label="input" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 entry">
                    <p class="col-span-12 text-[14px]"><strong><?=$lang['entry']?> # 2</strong></p>
                    <div :class="same_sample === 'yes' ? 'col-span-12' : 'col-span-6'" class="mt-0 mt-lg-2 px-2 percentage">
                        <label for="percentage1" class="font-s-14 text-blue"><?=$lang['percent']?>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" x-model="entries[1].percentage" id="percentage1" class="input percent" aria-label="input" />
                        </div>
                    </div>
                    <div x-show="same_sample === 'no'" class="col-span-6 sample">
                        <label for="sample1" class="font-s-14 text-blue"><?=$lang['sample']?>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" x-model="entries[1].sample" id="sample1" class="input" aria-label="input" />
                        </div>
                    </div>
                </div>

                <template x-for="(entry, index) in entries" :key="index">
                    <template x-if="index > 1">
                        <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 entry">
                            <p class="col-span-12 text-[14px]"><strong x-text="'<?=$lang['entry']?> # ' + (index + 1)"></strong></p>
                            <div :class="same_sample === 'yes' ? 'col-span-12' : 'col-span-6'" class="mt-0 mt-lg-2 px-2 percentage">
                                <label :for="'percentage'+index" class="font-s-14 text-blue"><?=$lang['percent']?>:</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" x-model="entries[index].percentage" :id="'percentage'+index" class="input percent" aria-label="input" />
                                </div>
                            </div>
                            <div x-show="same_sample === 'no'" class="col-span-6 sample">
                                <label :for="'sample'+index" class="font-s-14 text-blue"><?=$lang['sample']?>:</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" x-model="entries[index].sample" :id="'sample'+index" class="input" aria-label="input" />
                                </div>
                            </div>
                        </div>
                    </template>
                </template>
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
                        @php
                            $percentage = $detail['percentage'];
                            $percents_sum = $detail['percents_sum'];
                            $sample = $detail['sample'];
                            $samples_sum = $detail['samples_sum'];
                            $result = $detail['result'];
                
                            if($same_sample === 'yes'){
                                $numerator = implode('\% + ', $percentage).'\%';
                                $denominator = $samples_sum;
                            }else{
                                $numerator = $detail['percents_show'];
                                $denominator = implode(' + ', $sample);
                                $step1 = $detail['percents_show1'];
                            }
                        @endphp
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2 overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['avg_per'] }}</strong></td>
                                    <td class="py-2 border-b"><?=safe_round($result, 4)?>%</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px] overflow-auto">
                            <p class="mt-3"><strong><?=$lang['solution']?>:</strong></p>
                            <p class="mt-3">\( \dfrac{<?=$numerator?>}{<?=$denominator?>} \)</p>
                            <?php if($same_sample === 'no'){ ?>
                                <p class="mt-3">\( = \dfrac{<?=$step1?>}{<?=$samples_sum?>} \)</p>
                            <?php } ?>
                            <p class="mt-3">\( = \dfrac{<?=$percents_sum?>\%}{<?=$samples_sum?>} \)</p>
                            <p class="mt-3">\( = <?=safe_round($result, 4)?>\% \)</p>
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
