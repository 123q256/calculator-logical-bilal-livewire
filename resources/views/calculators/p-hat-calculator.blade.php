<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2 relative">
                    <label for="sample_size" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <input type="number" step="any" name="sample_size" id="sample_size" value="{{ isset($_POST['sample_size'])?$_POST['sample_size']:'30' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2">
                    <label for="occurrences" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <input type="number" step="any" name="occurrences" id="occurrences" value="{{ isset($_POST['occurrences'])?$_POST['occurrences']:'10' }}" class="input" aria-label="input" placeholder="00" />
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
            <div class="rounded-lg  mt-3 flex items-center justify-center">
                <div class="w-full">
                    @php
                        $request = request();
                        $sample_size = $request->sample_size;
                        $occurrences = $request->occurrences;
                    @endphp
                    <div class="text-center">
                        <p class="font-s-18">
                            <strong>p̂</strong>
                        </p>
                        <p class="font-s-21 px-3 py-2  my-3">
                            <strong class="bg-[#2845F5] text-white rounded-lg  p-4">{{ round($detail['p_hat'], 3) }}</strong>
                        </p>
                    </div>
                    <p class="col-12 mt-3 font-s-18"><strong class="text-blue"><?= $lang['3'] ?></strong></p>
                    <p class="col-12 mt-2"><?= $lang['1'] ?> : <?php echo $sample_size; ?></p>
                    <p class="col-12 mt-2"><?= $lang['2'] ?> : <?php echo $occurrences; ?></p>
                    <!-- -------------------------- Solution ----------------------- -->
                    <p class="col-12 mt-3 font-s-18"><strong class="text-blue"><?= $lang['5'] ?></strong></p>
                    <p class="col-12 mt-2"><?= $lang['4'] ?> :</p>
                    <p class="col-12 mt-2">\(\hat{p} = \dfrac{\text{Number of Occurrences} }{\text{Sample Size} }\)</p>
                    <p class="col-12 mt-2">\(\hat{p} = \dfrac{\text{<?php echo $occurrences; ?>} }{\text{<?php echo $sample_size; ?>} }\)</p>
                    <p class="col-12 mt-2">\(\hat{p} = <?= round($detail['p_hat'], 3) ?>\)</p>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" 
        onload="renderMathInElement(document.body);"></script>  
    @endif
@endpush