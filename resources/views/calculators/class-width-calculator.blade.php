<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="minimum" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="minimum" id="minimum" value="{{ isset($_POST['minimum'])?$_POST['minimum']:'20' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="maximum" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="maximum" id="maximum" value="{{ isset($_POST['maximum'])?$_POST['maximum']:'40' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="number" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="number" id="number" value="{{ isset($_POST['number'])?$_POST['number']:'2' }}" class="input" aria-label="input" placeholder="00" />
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
                        <div class="col">
                            @php
                                $request = request();
                                $minimum = trim($request->minimum);
                                $maximum = trim($request->maximum);
                                $number = trim($request->number);
                            @endphp
                            <div class="text-center">
                                <p class="lg:text-[22px] md:text-[22px] text-[18px]">
                                    <strong>{{ $lang[4] }}</strong>
                                </p>
                                <div class="flex justify-center">
                                <p class="text-[25px] w-auto bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ round($detail['answer'], 4) }}</strong>
                                </p>
                            </div>
                        </div>
                            <p class="w-full text-[18px]"><strong class="text-blue"><?= $lang[5] ?></strong></p>
                            <p class="w-full my-2"><?= $lang[6] ?>.</p>
                            <p class="w-full my-2"><?= $lang[4] ?> = (<?= $lang[2] ?> - <?= $lang[1] ?>) / <?= $lang[3] ?></p>
                            <p class="w-full my-2"><?= $lang[4] ?> = (<?php echo $maximum; ?>  - <?php echo $minimum; ?> ) / <?php echo  $number; ?> </p>
                            <p class="w-full my-2"><?= $lang[4] ?> = <?= round($detail['answer'], 4) ?></p>
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