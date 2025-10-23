<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


            @php $request = request(); @endphp

            <div class="col-span-12 inputs">
                <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="same_sample" class="font-s-14 text-blue">Are all sample sizes the same?:</label>
                        <div class="w-full py-2">
                            <select name="same_sample" class="input" id="same_sample" aria-label="select">
                                <option value="no">{{$lang['no']}}</option>
                                <option value="yes" {{ isset($request->same_sample) && $request->same_sample=='yes'?'selected':'' }}>{{$lang['yes']}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 entry">
                    <p class="col-span-12 text-[14px]"><strong><?=$lang['entry']?> # 1</strong></p>
                    <div class="{{ isset($request->same_sample) && $request->same_sample=='yes'?'col-span-12':'col-span-6' }} mt-0 mt-lg-2 px-2 percentage">
                        <label for="percentage" class="font-s-14 text-blue"><?=$lang['percent']?>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="percentage[]" id="percentage" class="input percent" aria-label="input" value="{{ isset($request->percentage[0])?$request->percentage[0]:'' }}" />
                        </div>
                    </div>
                    <div class="col-span-6 {{ isset($request->same_sample) && $request->same_sample=='yes'?'d-none':'' }} sample">
                        <label for="sample" class="font-s-14 text-blue"><?=$lang['sample']?>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="sample[]" id="sample" class="input" aria-label="input" value="{{ isset($request->sample[0])?$request->sample[0]:'' }}" />
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 entry">
                    <p class="col-span-12 text-[14px]"><strong><?=$lang['entry']?> # 2</strong></p>
                    <div class="{{ isset($request->same_sample) && $request->same_sample=='yes'?'col-span-12':'col-span-6' }} mt-0 mt-lg-2 px-2 percentage">
                        <label for="percentage1" class="font-s-14 text-blue"><?=$lang['percent']?>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="percentage[]" id="percentage1" class="input percent" aria-label="input" value="{{ isset($request->percentage[1])?$request->percentage[1]:'' }}" />
                        </div>
                    </div>
                    <div class="col-span-6 {{ isset($request->same_sample) && $request->same_sample=='yes'?'d-none':'' }} sample">
                        <label for="sample1" class="font-s-14 text-blue"><?=$lang['sample']?>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="sample[]" id="sample1" class="input" aria-label="input" value="{{ isset($request->sample[1])?$request->sample[1]:'' }}" />
                        </div>
                    </div>
                </div>
                @if(isset($detail['sample']) || isset($detail['percentage']))
                    @for ($i = 2; $i < count($detail['percentage']); $i++)
                        <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 entry">
                            <p class="col-span-12 text-[14px]"><strong><?=$lang['entry']?> # {{$i+1}}</strong></p>
                            <div class="{{ isset($request->same_sample) && $request->same_sample=='yes'?'col-span-12':'col-span-6' }} mt-0 mt-lg-2 px-2 percentage">
                                <label for="percentage{{$i}}" class="font-s-14 text-blue"><?=$lang['percent']?>:</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="percentage[]" id="percentage{{$i}}" class="input percent" aria-label="input" value="{{ isset($request->percentage[$i])?$request->percentage[$i]:'' }}" />
                                </div>
                            </div>
                            <div class="col-span-6 {{ isset($request->same_sample) && $request->same_sample=='yes'?'d-none':'' }} sample">
                                <label for="sample{{$i}}" class="font-s-14 text-blue"><?=$lang['sample']?>:</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="sample[]" id="sample{{$i}}" class="input" aria-label="input" value="{{ isset($request->sample[$i])?$request->sample[$i]:'' }}" />
                                </div>
                            </div>
                        </div>  
                    @endfor
                @endif
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        @php
                            $same_sample = $request->same_sample;
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['avg_per'] }}</strong></td>
                                    <td class="py-2 border-b"><?=round($result, 4)?>%</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-3"><strong><?=$lang['solution']?>:</strong></p>
                            <p class="mt-3">\( \dfrac{<?=$numerator?>}{<?=$denominator?>} \)</p>
                            <?php if($same_sample === 'no'){ ?>
                                <p class="mt-3">\( = \dfrac{<?=$step1?>}{<?=$samples_sum?>} \)</p>
                            <?php } ?>
                            <p class="mt-3">\( = \dfrac{<?=$percents_sum?>\%}{<?=$samples_sum?>} \)</p>
                            <p class="mt-3">\( = <?=round($result, 4)?>\% \)</p>
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
        <script>
            document.addEventListener('input', function(event) {
                if (event.target.closest('.inputs .entry:last-child .percent')) {
                    let i = document.querySelectorAll('.inputs .entry').length;
                    let secondLastPercent = document.querySelector('.inputs .entry:nth-last-child(2):not(:last-child) .percent');
                    let lastPercent = document.querySelector('.inputs .entry:last-child .percent');
                    if (secondLastPercent && lastPercent && secondLastPercent.value === '' && lastPercent.value === '') {
                        document.querySelector('.inputs .entry:last-child').remove();
                    }
                    if (i <= 10) {
                        let html = '';
                        let sameSample = document.getElementById('same_sample').value;
                        if (sameSample == "no") {
                            let percentHtml = `
                                <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 entry">
                                    <p class="col-span-12 text-[14px]"><strong><?=$lang['entry']?> # `+(i+1)+`</strong></p>
                                    <div class="{{ isset($request->same_sample) && $request->same_sample=='yes'?'col-span-12':'col-span-6' }} mt-0 mt-lg-2 px-2 percentage">
                                        <span class="font-s-14 text-blue"><?=$lang['percent']?>:</span>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" name="percentage[]" class="input percent" aria-label="input" value="" />

                                        </div>
                                    </div>
                                    <div class="col-span-6 {{ isset($request->same_sample) && $request->same_sample=='yes'?'d-none':'' }} sample">
                                        <span class="font-s-14 text-blue"><?=$lang['sample']?>:</span>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" name="sample[]" class="input" aria-label="input" value="" />
                                        </div>
                                    </div>
                                </div>
                            `;
                            document.querySelector('.inputs').insertAdjacentHTML('beforeend', percentHtml);
                        } else {
                            let percentHtml = `
                                <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 entry">
                                    <p class="col-span-12 text-[14px]"><strong><?=$lang['entry']?> # `+(i+1)+`</strong></p>
                                    <div class="col-span-12 mt-0 mt-lg-2 px-2 percentage">
                                        <span class="font-s-14 text-blue"><?=$lang['percent']?>:</span>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" name="percentage[]" class="input percent" aria-label="input" value="" />
                                        </div>
                                    </div>
                                    <div class="col-span-6 {{ isset($request->same_sample) && $request->same_sample=='yes'?'d-none':'' }} d-none sample">
                                        <span class="font-s-14 text-blue"><?=$lang['sample']?>:</span>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" name="sample[]" class="input" aria-label="input" value="" />
                                        </div>
                                    </div>
                                </div>
                            `;
                            document.querySelector('.inputs').insertAdjacentHTML('beforeend', percentHtml);
                            
                        }
                    }
                }
                if (event.target.closest('.inputs .entry:nth-last-child(2):not(:last-child) .percent')) {
                    let lastPercent = document.querySelector('.inputs .entry:last-child .percent');
                    let secondLastPercent = document.querySelector('.inputs .entry:nth-last-child(2):not(:last-child) .percent');

                    if (lastPercent && secondLastPercent && lastPercent.value === '' && secondLastPercent.value === '') {
                        document.querySelector('.inputs .entry:last-child').remove();
                    }
                }
            });
            document.getElementById('same_sample').addEventListener('change', function() {
                let val = this.value;
                if (val === 'yes') {
                    ['.sample'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    ['.percentage'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('col-span-6');
                            element.classList.add('col-span-12');
                        });
                    });
                } else {
                    ['.sample'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['.percentage'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('col-span-12');
                            element.classList.add('col-span-6');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>