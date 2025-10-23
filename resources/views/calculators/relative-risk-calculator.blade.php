<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">
                
                <p class="col-span-12 px-2"><strong>{{ $lang[1] }}</strong></p>
                <div class="col-span-6 px-2">
                    <label for="e_disease" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="e_disease" id="e_disease" value="{{ isset($_POST['e_disease'])?$_POST['e_disease']:'5' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6 px-2">
                    <label for="e_no_disease" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="e_no_disease" id="e_no_disease" value="{{ isset($_POST['e_no_disease'])?$_POST['e_no_disease']:'3' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <p class="col-span-12 px-2"><strong>{{ $lang[4] }}</strong></p>
                <div class="col-span-6 px-2">
                    <label for="c_disease" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="c_disease" id="c_disease" value="{{ isset($_POST['c_disease'])?$_POST['c_disease']:'7' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6 px-2">
                    <label for="c_no_disease" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="c_no_disease" id="c_no_disease" value="{{ isset($_POST['c_no_disease'])?$_POST['c_no_disease']:'10' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <input type="hidden" readonly step="any" id="z_score" name="z_score" class="validate" min="0">
                <div class="col-span-6 px-2">
                    <label for="confidenceLevel" class="font-s-14 text-blue">{{ $lang[5] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="confidenceLevel" id="confidenceLevel" value="{{ isset($_POST['confidenceLevel'])?$_POST['confidenceLevel']:'95' }}" class="input" aria-label="input" placeholder="00" />
                        <span class="text-blue input_unit">%</span>
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
                        $e_disease = $request->e_disease;
                        $e_no_disease = $request->e_no_disease;
                        $c_disease = $request->c_disease;
                        $c_no_disease = $request->c_no_disease;
                        $confidenceLevel = $request->confidenceLevel;
                        $z_score = $request->z_score;
                        $RR = $detail['relative'];
                        // Calculate lower bound
                        $lnRR = log($RR);
                        $sqrtTerm = sqrt((1 / $e_disease) + (1 / $c_disease) - (1 / ($e_disease + $e_no_disease)) - (1 / ($c_disease + $c_no_disease)));
                        $lowerBound = exp($lnRR - ($z_score * $sqrtTerm));
                        // Calculate upper bound
                        $upperBound = exp($lnRR + ($z_score * $sqrtTerm));
                    @endphp
                    <div class="w-full">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['7'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ $detail['relative'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['8'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($lowerBound,3) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['9'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($upperBound,3) }}</strong></td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang['10'] ?></strong></p>
                        <p class="w-full mt-2"><?= $lang['5'] ?>: <?php echo $confidenceLevel; ?><?= $lang['6'] ?></p>
                        <p class="w-full mt-2"><?= $lang['11'] ?> : <?php echo $z_score; ?></p>
                        <p class="w-full mt-3"><strong class="text-blue"><?= $lang['1'] ?></strong></p>
                        <p class="w-full mt-2"><?= $lang['2'] ?>: <?php echo $e_disease; ?></p>
                        <p class="w-full mt-2"><?= $lang['3'] ?>: <?php echo $e_no_disease; ?></p>
                        <p class="w-full mt-3"><strong class="text-blue"><?= $lang['4'] ?></strong></p>
                        <p class="w-full mt-2"><?= $lang['2'] ?>: <?php echo $c_disease; ?></p>
                        <p class="w-full mt-2"><?= $lang['3'] ?>: <?php echo $c_no_disease; ?></p>
                        
                        <!-- -------------------------- Solution ----------------------- -->
                        <p class="w-full mt-3 text-[18px]"><strong class="text-blue">Solution</strong></p>
                        <p class="w-full mt-2"><?= $lang['12'] ?></p>
                        <p class="w-full mt-2"><?= $lang['7'] ?> = \(\frac{a}{a + b}\) / \(\frac{c}{c + d}\)
                        </p>
                        <p class="w-full mt-2"><strong><?= $lang['13'] ?>:</strong></p>
                        <p class="w-full mt-2"><strong>a</strong> &rarr; <?= $lang['15'] ?></p>
                        <p class="w-full mt-2"><strong>b</strong> &rarr; <?= $lang['16'] ?></p>
                        <p class="w-full mt-2"><strong>c</strong> &rarr; <?= $lang['17'] ?></p>
                        <p class="w-full mt-2"><strong>d</strong> &rarr; <?= $lang['18'] ?></p>
                        <p class="w-full mt-2"><?= $lang['7'] ?> =
                            \(\frac{<?= $e_disease ?>}{<?= $e_disease ?> +
                            <?= $e_no_disease ?>}\) / \(\frac{<?= $c_disease ?>}{<?= $c_disease ?> +
                            <?= $c_no_disease ?> }\)</p>
                        <p class="w-full mt-2"><?= $lang['7'] ?> =
                            \(\frac{<?= $detail['riskExposed'] ?>}{<?= $detail['riskControl'] ?>}\)</p>
                        <p class="w-full mt-2"><?= $lang['7'] ?> = <?= $detail['relative'] ?></p>
                        <div class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang['14'] ?></strong>
                        </div>
                        <p class="w-full mt-2"><?= $lang['19'] ?> \(RR\):</p>
                        <p class="w-full mt-2">\(ln(RR)\) = <?= $detail['relative'] ?></p>
            
                        <p class="w-full mt-2"><?= $lang['20'] ?>:</p>
                        <p class="w-full mt-2">\(\text{Sqrt Term} = \sqrt{\frac{1}{a} + \frac{1}{c} -
                            \frac{1}{a+b} - \frac{1}{c+d}}\) = <?= $sqrtTerm ?></p>
            
                        <p class="w-full mt-2"><?= $lang['21'] ?>:</p>
                        <p class="w-full mt-2">\(\text{Lower Bound} = exp(<?= $lnRR ?> - (<?= $z_score ?>
                            \times <?= $sqrtTerm ?>))\) = <?= round($lowerBound,3) ?></p>
            
                        <p class="w-full mt-2"><?= $lang['22'] ?>:</p>
                        <p class="w-full mt-2">\(\text{Upper Bound} = exp(<?= $lnRR ?> + (<?= $z_score ?>
                            \times <?= $sqrtTerm ?>))\) = <?= round($upperBound,2) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstat/1.7.1/jstat.min.js"></script>
    <script>
        @if (isset($detail))
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @endif
        function calculateZScore() {
            const confidenceLevel = (parseFloat(document.getElementById("confidenceLevel").value)) / 100;

            if (confidenceLevel >= 0 && confidenceLevel <= 1) {
                const alpha = (1 - confidenceLevel) / 2;
                const zScore = jStat.normal.inv(1 - alpha, 0, 1);
                document.getElementById("z_score").value = zScore.toFixed(4);
            } else {
                alert("Please enter a valid confidence level between 0 and 1.");
            }
        }
        document.addEventListener("click", calculateZScore);
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>