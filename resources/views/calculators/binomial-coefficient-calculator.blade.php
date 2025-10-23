<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                
                <div class="col-span-12">
                    <label for="n" class="font-s-14 text-blue">n:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="n" id="n" value="{{ isset($_POST['n'])?$_POST['n']:'13' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="k" class="font-s-14 text-blue">k:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="k" id="k" value="{{ isset($_POST['k'])?$_POST['k']:'7' }}" class="input" aria-label="input" placeholder="00" />
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
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            @php
                                $request = request();
                                $n = $request->n;
                                $k = $request->k;
                                function factorial($n)
                                {
                                    if ($n <= 1) {
                                        return 1;
                                    } else {
                                        try {
                                            $fact = gmp_fact($n);
                                            return gmp_strval($fact);
                                        } catch (\Exception $r) {
                                            return false;
                                        }
                                    }
                                }
                            @endphp
                            <div class="text-center">
                                <p class="lg:text-[22px] md:text-[22px] text-[18px]">
                                    <strong>{{ $lang['1'] }}</strong>
                                </p>
                                <div class="flex justify-center">
                                <p class="text-[21px] bg-[#2845F5] w-auto px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $detail['ans'] }}</strong>
                                </p>
                            </div>
                        </div>
                            <p class="w-full mt-3 text-[18px]">Solution:</p>
                            <p class="w-full mt-2"><?=$lang[1]?> \(= \dbinom{n}{k} = \dfrac{n!}{k!(n-k)!}\)</p>
                            <p class="w-full mt-2"><strong>n = <?=$n?>, k = <?=$k?></strong></p>
                            <p class="w-full mt-2"><strong>\(\dbinom{<?=$n?>}{<?=$k?>} = \dfrac{<?=$n?>!}{<?=$k?>!(<?=$n?>-<?=$k?>)!}\)</strong></p>
                            <p class="w-full mt-2"><strong>\(\dbinom{<?=$n?>}{<?=$k?>} = \dfrac{<?=$n?>!}{<?=$k?>!(<?=$n-$k?>)!}\)</strong></p>
                            <p class="w-full mt-2 overflow-auto"><strong>\(\dbinom{<?=$n?>}{<?=$k?>} = \dfrac{<?=factorial($n)?>}{<?=factorial($k)?>(<?=factorial($n-$k)?>)}\)</strong></p>
                            <p class="w-full mt-2 overflow-auto"><strong>\(\dbinom{<?=$n?>}{<?=$k?>} = \dfrac{<?=factorial($n)?>}{<?=factorial($k)*factorial($n-$k)?>}\)</strong></p>
                            <p class="w-full mt-2"><strong>\(\dbinom{<?=$n?>}{<?=$k?>} = <?=$detail['ans']?>\)</strong></p>
                            <p class="w-full mt-3 text-[18px]"><strong><?=$lang[1]?> \( = <?=$detail['ans']?>\)</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>