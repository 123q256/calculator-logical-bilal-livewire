<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
    @if (isset($error))
    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
    @endif
    <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
        <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12">
                <label for="x" class="font-s-14 text-blue">Enter Sample Data (Comma Separated):</label>
                <div class="w-100 py-2">
                    <textarea name="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 11, 12, 13, 14, 14, 15, 15, 17, 18, 19, 20, 9, 23">{{ isset($_POST['x'])?$_POST['x']:'11, 12, 13, 14, 14, 15, 15, 17, 18, 19, 20, 9, 23' }}</textarea>
                </div>
            </div>
            <div class="col-span-12">
                <label for="decile" class="font-s-14 text-blue">Decile (1, 2, ... or 9):</label>
                <div class="w-100 py-2">
                    <input type="number" min="1" max="9" name="decile" id="decile" value="{{ isset($_POST['decile'])?$_POST['decile']:'5' }}" class="input" aria-label="input" placeholder="00" />
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
                        @php
                            $request = request();
                            $x = $request->x;
                            $decile = $request->decile;
                        @endphp
                        <div class="w-full">
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong>Answer</strong>
                                </p>
                                <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white"><?=$detail['main_ans']?></strong>
                                </p>
                            </div>
                        </div>
                            <p class="w-full mt-3 text-[18px]"><strong class="text-blue">Solution</strong></p>
                            <p class="w-full mt-2">The sample data is as follows:</p>
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full" style="border-collapse: collapse">
                                    <tr class="bg-[#2845F5] text-white">
                                        <td class="p-2 border text-center"><strong class="text-blue">Observation</strong></td>
                                        <td class="p-2 border text-center"><strong class="text-blue">X</strong></td>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($detail['ans_list'] as $value) { ?>
                                        <tr class="bg-white">
                                            <td class="p-2 border text-center"><?= $i++ ?></td>
                                            <td class="p-2 border text-center"><?= $value ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <p class="w-full mt-2">
                                We need to compute the sixth decile (D<sub><?= $decile ?></sub>) based on the data provided.
                            </p>
                            <p class="w-full mt-2">
                                You calculate the value of decile, we have to sort the daata in ascending order. For reference, follow the table below:
                            </p>
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full" style="border-collapse: collapse">
                                    <tr class="bg-[#2845F5] text-white">
                                        <td class="p-2 border text-center"><strong class="text-blue">Position</strong></td>
                                        <td class="p-2 border text-center"><strong class="text-blue">X (Asc. Order)</strong></td>
                                    </tr>
                                    <?php $i = 1; ?>
                                    <?php foreach ($detail['ans_list'] as $value) { ?>
                                        <tr class="bg-white">
                                            <td class="p-2 border text-center"><?= $i++ ?></td>
                                            <td class="p-2 border text-center"><?= $value ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <p class="w-full mt-2">
                                Now we have to determine the rank of <?= $decile ?> decile. It yields:
                            </p>
                            <p class="w-full mt-2 text-[18px] text-center">
                                Decile Position \( = \frac{(n + 1)P}{100} = \frac{(<?= $detail['total_values'] ?> + 1) × <?= ($decile/10) ?>}{100} = <?= $detail['decile_pos'] ?> \)
                            </p>
                            <?php if(is_numeric($detail['decile_pos']) && floor($detail['decile_pos']) != $detail['decile_pos']) { ?>
                                <p class="w-full mt-2">
                                    Since the position found is not integer, the method of interpolation needs to be used. The <?= $decile ?> decile is located between the values in the positions <?= $detail['floor_val'] ?> and <?= $detail['ceil_val'] ?>.
                                    As we did not get the whole number integer, we are supposed to use the interpolation method. Here, the <?= $decile ?> decile will be exactly ling between <?= $detail['floor_val'] ?> and <?= $detail['ceil_val'] ?>.
                                </p>
                                <p class="w-full mt-2">
                                    <?= $detail['list_floor_val'] ?> and <?= $detail['list_ceil_val'] ?> are the values that have been determined with reference to the organized data
                                </p>
                                <p class="w-full mt-2">
                                    The value of <?= $detail['decile_pos'] ?> - <?= $detail['floor_val'] ?> = <?= $detail['floor_minus'] ?> corresponds to the proportion of the distance between <?= $detail['list_floor_val'] ?> and <?= $detail['list_ceil_val'] ?> where the quartile we are looking for is located at. In fact, we compute
                                </p>
                                <p class="w-full mt-2 text-[18px] text-center">
                                    \( 
                                        D_<?= $decile ?> = <?= $detail['list_floor_val'] ?> + <?= $detail['floor_minus'] ?> × (<?= $detail['list_ceil_val'] ?> - <?= $detail['list_floor_val'] ?>) = <?= $detail['main_ans'] ?>
                                    \)
                                </p>
                                <p class="w-full mt-2">
                                    This completes the calculation and we conclude that the <?= $decile ?> decile is equal to D<sub><?= $decile ?></sub> = <?= $detail['main_ans'] ?> 
                                </p>
                            <?php } else { ?>
                                <p class="w-full mt-2">
                                    Since the position found is integer, the <?= $decile ?> decile corresponds to the value in the position <?= $detail['decile_pos'] ?> in the data organized in ascending order, so then looking at the table we find directly that the <?= $decile ?> decile is <?= $detail['main_ans'] ?>.
                                </p>
                                <p class="w-full mt-2">
                                This completes the calculation and we conclude that the fifth decile is equal to D<sub><?= $decile ?></sub> = <?= $detail['main_ans'] ?>.
                                </p>
                            <?php } ?>
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
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>