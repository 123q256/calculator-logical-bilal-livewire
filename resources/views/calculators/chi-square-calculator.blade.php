<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">
            <div class="col-span-12">
                <label for="observed" class="label">{{ $lang[1] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="observed" id="observed" value="{{ isset($_POST['observed'])?$_POST['observed']:'30' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="expected" class="label">{{ $lang[2] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="expected" id="expected" value="{{ isset($_POST['expected'])?$_POST['expected']:'10' }}" class="input" aria-label="input" placeholder="00" />
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
                                $observed = $request->observed;
                                $expected = $request->expected;
                            @endphp
                            <div class="text-center">
                                <p class="text-[20px]">
                                    <strong>{{ $lang[3] }} ( X&sup2;)</strong>
                                </p>
                                <div class="flex justify-center">
                                <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ round($detail['chiSquared'], 4) }}</strong>
                                </p>
                            </div>
                        </div>
                            <p class="w-full mt-2 text-[20px]"><strong class="text-blue"><?= $lang['4'] ?></strong></p>
                            <p class="w-full mt-2"><?= $lang['1'] ?> : <?php echo $observed; ?></p>
                            <p class="w-full mt-2"><?= $lang['2'] ?> : <?php echo $expected; ?></p>
                            <!-- -------------------------- Solution ----------------------- -->
                            <p class="w-full mt-2 text-[20px]"><strong class="text-blue"><?= $lang['5'] ?></strong></p>
                            <p class="w-full mt-2"><?= $lang['6'] ?> :</p>
                            <p class="w-full mt-2">\(\ \text {X}^2 = \dfrac{ {( \text {Observed value}- \text {Expected value})^2} }{ {\text {Expected value} } }\)</p>
                            <p class="w-full mt-2">\(\ \text {X}^2 = \dfrac{ {( \text {<?php echo $observed; ?>}- \text {<?php echo $expected; ?>})^2} }{ {\text {<?php echo $expected; ?>} } }\)</p>
                            <p class="w-full mt-2">\(\ \text {X}^2 = <?= round($detail['chiSquared'], 4) ?>\)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script>
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        </script>
    @endif
@endpush