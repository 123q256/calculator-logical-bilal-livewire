<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1    gap-4">
                <div class="space-y-2 relative">
                    <label for="z_score" class="font-s-14 text-blue">{{ $lang['1'] }} (-5 to 5):</label>
                    <input type="number" step="any" name="z_score" id="z_score" value="{{ isset($_POST['z_score'])?$_POST['z_score']:'3' }}" class="input" aria-label="input" placeholder="00" />
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
                                <div class="text-center">
                                    <p class="font-s-20">
                                        <strong><?= round(100 * $detail['res_val'], 0) ?>-th <?=$lang[2]?></strong>
                                    </p>
                                    <p class="px-3 py-2 radius-10 d-inline-block my-3">
                                        <strong class="bg-[#2845F5] text-[30px] text-white p-4 rounded-lg">{{ round(100*$detail['res_val'],2) }}%</strong>
                                    </p>
                                </div>
                                <p class="col-12 mt-3 font-s-20 text-[#2845F5]"><?=$lang[3]?>:</p>
                                <p class="col-12 mt-2"><?=$lang[4]?> <span>Z = <?= round($detail['z_score'],4) ?></span></p>
                                <p class="col-12 mt-2"><?=$lang[5]?> (Z < <?= round($detail['z_score'], 4) ?>)<br> <br>Pr (Z < <?= round($detail['z_score'], 4) ?>) = <?= round($detail['res_val'],4)?></p>
                                <p class="col-12 mt-2"><?=$lang[6]?>:<br> <br>100 X Pr (Z > <?= round($detail['z_score'], 4)?>) = 100 X <?= round($detail['res_val'],4) ?> = <?= round(100*$detail['res_val'],2)?>%</p>
                                <p class="col-12 mt-2"><?=$lang[7]?>: <br><br>  <?=round($detail['z_score'],4)?> is the <?= round(100 * $detail['res_val'], 0) ?>-th <?=$lang[2]?></p>
                                <p class="col-12 mt-3 font-s-20 text-center"><?=$lang[8]?></p>
                                <p class="col-12 mt-2">The <?= round(100 * $detail['res_val'], 0) ?>-th <?=$lang[2]?> <?=$lang[9]?> z = <?=round($detail['z_score'],4)?></p>        
                                <div class="col-12 mt-2">
                                    <img src="<?=url('images/graph/'.$detail['img']."")?>" alt="Calcultor" alt="Z-Score_to_percentile Graph" width="100%">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    
@endpush