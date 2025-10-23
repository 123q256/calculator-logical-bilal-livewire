<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="col-12 px-2 mb-3 mt-0 mt-lg-2 text-center d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center">
                    @if (isset($_POST['type']))
                        @if ($_POST['type']=='first')
                            <input name="type" id="type" value="first" class="r_data" type="radio" checked />
                        @else
                            <input name="type" id="type" value="first" class="r_data" type="radio" />
                        @endif
                    @else
                        <input name="type" id="type" value="first" class="r_data" type="radio" checked />
                    @endif
                    <label for="type" class="font-s-14 text-blue pe-lg-3 px-1">{{ $lang['1'] }}</label>
                    @if (isset($_POST['type']) && $_POST['type']=='second')
                        <input name="type" id="type1" value="second" class="s_data" type="radio" checked />
                    @else
                        <input name="type" id="type1" value="second" class="s_data" type="radio" />
                    @endif
                    <label for="type1" class="font-s-14 text-blue ps-1">{{ $lang['2'] }}</label>
                </div>
            </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="mean" class="font-s-14">
                        <span class="sample text-blue" style="display: none"><?= $lang[13] ?>(<span style="border-top: 1px solid;">X</span>)</span>
                        <span class="population text-blue"><?= $lang[12] ?>(μ)</span>
                    </label>
                    <input type="number" step="any" name="mean" id="mean" value="{{ isset($_POST['mean'])?$_POST['mean']:'10' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2">
                    <label for="standard_daviation" class="font-s-14">
                        <span class="sample text-blue" style="display: none"><?= $lang[4] ?>(s)</span>
                        <span class="population text-blue"><?= $lang[4] ?>(σ)</span>
                    </label>
                    <input type="number" step="any" name="standard_daviation" id="standard_daviation" value="{{ isset($_POST['standard_daviation'])?$_POST['standard_daviation']:'20' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2">
                    <label for="z_score" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <input type="number" step="any" name="z_score" id="z_score" value="{{ isset($_POST['z_score'])?$_POST['z_score']:'30' }}" class="input" aria-label="input" placeholder="00" />
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
                            $type = $detail['type'];
                        @endphp
                        <div class="text-center">
                            <p class="font-s-20">
                                {{ $lang['6'] }}
                            </p>
                            <div class="flex justify-center">
                                <p class="text-[30px] w-auto bg-[#2845F5] px-3 py-2 text-white rounded-lg d-inline-block my-3">
                                {{ $detail['res'] }}
                            </p>
                        </div>
                    </div>
                        <p class="col-12 mt-3 font-s-20 text-blue">
                            <?= $lang[7] ?>:
                        </p>
        
                        <p class="col-12 mt-2">
                            <b>
                                <?= $lang[8] ?>:
                            </b>
                        </p>
                        <?php if ($detail['type'] == 'first') { ?>
                            <p class="col-12 mt-2">μ = Population Mean</p>
                            <p class="col-12 mt-2">z = Z Score</p>
                            <p class="col-12 mt-2">σ = Standard Daviation</p>
                            <p class="col-12 mt-2">Inputs</p>
                        <?php } ?>
                        <?php if ($detail['type'] == 'second') { ?>
                            <p class="col-12 mt-2"><span style="border-top:1px solid !important">x</span>= Sample
                                Mean</p>
                            <p class="col-12 mt-2">z = Z Score</p>
                            <p class="col-12 mt-2"> = Standard Daviation</p>
                            <p class="col-12 mt-2">Inputs</p>
                        <?php } ?>
                        <?php if ($detail['type'] == 'second') { ?>
                            <p class="col-12 mt-2">
                                <span style="border-top: 1px solid;"> x </span>
        
                                =
                                <?= $detail['mean'] ?>
                            </p>
                        <?php } ?>
        
                        <?php if ($detail['type'] == 'first') { ?>
                            <p class="col-12 mt-2 "> μ=
                                <?= $detail['standard_daviation'] ?>
                            </p>
                        <?php } ?>
        
        
                        <p class="col-12 mt-2 ">z =
                            <?= $detail['z_score'] ?>
                        </p>
                        <?php if ($detail['type'] == 'first') { ?>
                            <p class="col-12 mt-2 "> σ=
                                <?= $detail['standard_daviation'] ?>
                            </p>
                        <?php } ?>
                        <?php if ($detail['type'] == 'second') { ?>
                            <p class="col-12 mt-2 "> s=
                                <?= $detail['standard_daviation'] ?>
                            </p>
                        <?php } ?>
        
                        <p class="col-12 mt-2 ">
                            <b>
                                <?= $lang[14] ?>:
                            </b>
                        </p>
        
                        <?php if ($detail['type'] == 'first') { ?>
                            <p class="col-12 mt-2 ">X = μ + z(σ)</p>
                        <?php } ?>
                        <?php if ($detail['type'] == 'second') { ?>
                            <p class="col-12 mt-2 ">X = <span style="border-top:1px solid">x</span>+zs</p>
                        <?php } ?>
        
        
        
        
                        <p class="col-12 mt-2">
                            <b>
                                <?= $lang[15] ?>:
                            </b>
                        </p>
        
        
                        <p class="col-12 mt-2">
                            X =
                            <?= $detail['mean'] ?> + (
                            <?= $detail['z_score'] ?>)(
                            <?= $detail['standard_daviation'] ?>)
                        </p>
                        <p class="col-12 mt-2">
                            X =
                            <?= $detail['mean'] ?> +
                            <?= $detail['z_score'] * $detail['standard_daviation'] ?>
                        </p>
                        <p class="col-12 mt-2">
                            X =
                                <?= $detail['res'] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
<script>
        @if (isset($_POST['type']) && $_POST['type']=='first')
            document.querySelectorAll('.sample').forEach(function(sample) {
                sample.style.display = 'none';
            });
            document.querySelectorAll('.population').forEach(function(population) {
                population.style.display = 'block';
            });
        @endif
        @if (isset($_POST['type']) && $_POST['type']!='first')
            document.querySelectorAll('.sample').forEach(function(sample) {
                sample.style.display = 'block';
            });
            document.querySelectorAll('.population').forEach(function(population) {
                population.style.display = 'none';
            });
        @endif
        document.querySelectorAll('.r_data').forEach(function(element) {
            element.addEventListener('click', function() {
                document.querySelectorAll('.sample').forEach(function(sample) {
                    sample.style.display = 'none';
                });
                document.querySelectorAll('.population').forEach(function(population) {
                    population.style.display = 'block';
                });
            });
        });

        document.querySelectorAll('.s_data').forEach(function(element) {
            element.addEventListener('click', function() {
                document.querySelectorAll('.sample').forEach(function(sample) {
                    sample.style.display = 'block';
                });
                document.querySelectorAll('.population').forEach(function(population) {
                    population.style.display = 'none';
                });
            });
        });

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>