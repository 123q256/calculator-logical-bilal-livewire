<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class=" mx-auto mt-2 w-full">
                <input type="hidden" name="population" id="round" value="{{ isset($_POST['population'])?$_POST['population']:'sample' }}">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="yes">
                                {{ $lang['1'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="no">
                                {{ $lang['2'] }}
                        </div>
                    </div>
                </div>
          </div>

            <div class="grid grid-cols-1   lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
                <div class="space-y-2">
                    <label for="given_change" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="given_unit" id="given_change" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{$name=='standard'? 'id=change_finite' :''}} {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[4],$lang[5]];
                                $val = ['standard','population'];
                                optionsList($val,$name,isset($_POST['given_unit'])?$_POST['given_unit']:'standard');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="confidence_unit" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="confidence_unit" id="confidence_unit" class="input">
                            @php
                                $name = ["70%", "75%", "80%", "85%", "90%", "95%", "98%", "99%", "99.9%", "99.99%", "99.999%"];
                                $val = ["70%", "75%", "80%", "85%", "90%", "95%", "98%", "99%", "99.9%", "99.99%", "99.999%"];
                                optionsList($val,$name,isset($_POST['confidence_unit'])?$_POST['confidence_unit']:'95%');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="space-y-2" id="moe">
                    <label for="margin" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="margin" min="1" id="margin" value="{{ isset($_POST['margin'])?$_POST['margin']:'5' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="space-y-2" id="stander">
                    <label for="standard" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="standard" min="1" id="standard" value="{{ isset($_POST['standard'])?$_POST['standard']:'2' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="space-y-2 hidden" id="proportion">
                    <label for="proportion1" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="proportion" min="1" id="proportion1" value="{{ isset($_POST['proportion'])?$_POST['proportion']:'50' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="space-y-2 hidden" id="finite">
                    <label for="n_finite" class="font-s-14 text-blue">N:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="n_finite" min="1" id="n_finite" value="{{ isset($_POST['n_finite'])?$_POST['n_finite']:'10' }}" class="input" aria-label="input" placeholder="00" />
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
                            $population = trim($request->population);
                            $given_unit = trim($request->given_unit);
                            $confidence_unit = trim($request->confidence_unit);
                            $margin = trim($request->margin);
                            $standard = trim($request->standard);
                            $proportion = trim($request->proportion);
                            $n_finite = trim($request->n_finite);
                        @endphp
                        <div class="text-center">
                            <p class="text-[20px]">
                                <strong>{{ $lang['8'] }}</strong>
                            </p>
                            <div class="flex justify-center">
                            <p class="text-[30px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-white">{{ $detail['answer'] }}</strong>
                            </p>
                        </div>
                    </div>
                        <?php if ($population == "sample") { ?>
                            <?php if ($given_unit == "standard") { ?>
                                <p class="w-full mt-2 font-s-18 text-blue"><strong><?= $lang['9'] ?></strong></p>
                                <p class="w-full mt-3"><?= $lang['10'] ?>.</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \left(\frac{\text{<?= $lang['6'] ?>}\times \text{<?= $lang['4'] ?>}}{<?= $lang['7'] ?>}\right)^2 \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \left(\frac{{<?= round($detail['confidence_unit'], 4) ?>}\times {<?= round($detail['standard'], 4) ?>}}{<?= round($detail['margin'], 4) ?>}\right)^2 \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \left( \frac{<?= round($detail['multiply'], 4) ?>}{<?= round($detail['margin'], 4) ?>} \right)^2 \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( (<?= round($detail['divide'], 4) ?>)^2 \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = <?= round($detail['sub_answer'], 4) ?></p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = <?= round($detail['answer'], 7) ?></p>
                            <?php } else { ?>
                                <p class="w-full mt-2 font-s-18 text-blue"><strong><?= $lang['9'] ?></strong></p>
                                <p class="w-full mt-3"><?= $lang['10'] ?>.</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \(\frac{ \text({<?= $lang['6'] ?>})^2 \times \text{<?= $lang['5'] ?>}(1 -\text{<?= $lang['5'] ?>})}{\text({<?= $lang['7'] ?>})^2} \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \(\frac{ ({<?= round($detail['confidence_unit'], 4) ?>})^2 \times {<?= round($detail['proportion'], 4) ?>}(1 - <?= round($detail['proportion'], 4) ?>)}{({<?= round($detail['margin'], 4) ?>})^2} \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \(\frac{ ({<?= round($detail['confidence_unit'], 4) ?>})^2 \times {<?= round($detail['proportion'], 4) ?>}(<?= round($detail['minus'], 4) ?>)}{{<?= round($detail['marg'], 4) ?>}} \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \(\frac{ {<?= round($detail['con_unit'], 4) ?>} \times {<?= round($detail['proportion'], 4) ?>}\times<?= round($detail['minus'], 4) ?>}{{<?= round($detail['marg'], 4) ?>}} \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \frac{<?= round($detail['propro'], 4) ?>}{<?= round($detail['marg'], 4) ?>} \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = <?= round($detail['propro_answer'], 4) ?></p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = <?= round($detail['answer'], 7) ?></p>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if ($given_unit == "standard") { ?>
                                <p class="w-full mt-2 font-s-18 text-blue"><strong><?= $lang['9'] ?></strong></p>
                                <p class="w-full mt-3"><?= $lang['11'] ?>.</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \frac{n \times N}{n + N - 1} \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \frac{n \times <?= round($detail['n_finite'], 4) ?>}{n + {<?= round($detail['n_finite'], 4) ?>} - 1} \)</p>
                                <p class="w-full mt-3"><?= $lang['13'] ?> n=?</p>
                                <p class="w-full mt-3"> n = \( \left(\frac{\text{<?= $lang['6'] ?>}\times \text{<?= $lang['4'] ?>}}{Margin of Error}\right)^2 \)</p>
                                <p class="w-full mt-3">n = \( \left(\frac{{<?= round($detail['confidence_unit'], 4) ?>}\times {<?= round($detail['standard'], 4) ?>}}{<?= round($detail['margin'], 4) ?>}\right)^2 \)</p>
                                <p class="w-full mt-3">n = \( \left( \frac{<?= round($detail['multiply'], 4) ?>}{<?= round($detail['margin'], 4) ?>} \right)^2 \)</p>
                                <p class="w-full mt-3">n = \( (<?= round($detail['divide'], 4) ?>)^2 \)</p>
                                <p class="w-full mt-3">n = <?= round($detail['sub_answer'], 4) ?></p>
                                <p class="w-full mt-3"><?= $lang['12'] ?> </p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \frac{n \times N}{n + N - 1} \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \frac{ <?= round($detail['sub_answer'], 4) ?> \times <?= round($detail['n_finite'], 4) ?>}{ <?= round($detail['sub_answer'], 4) ?> + {<?= round($detail['n_finite'], 4) ?>} - 1} \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \frac{ <?= round($detail['a_answer'], 4) ?>}{ <?= round($detail['b_answer'], 4) ?> }\)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = <?= round($detail['answer'], 7) ?></p>
                            <?php } else { ?>
                                <p class="w-full mt-2 font-s-18 text-blue"><strong><?= $lang['9'] ?></strong></p>
                                <p class="w-full mt-3"><?= $lang['11'] ?>.</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \frac{n \times N}{n + N - 1} \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \frac{n \times <?= round($detail['n_finite'], 4) ?>}{n + {<?= round($detail['n_finite'], 4) ?>} - 1} \)</p>
                                <p class="w-full mt-3"><?= $lang['13'] ?> n=?</p>
                                <p class="w-full mt-3"> n = \(\frac{ \text({<?= $lang['6'] ?>})^2 \times \text{<?= $lang['5'] ?>}(1 -\text{<?= $lang['5'] ?>})}{\text({<?= $lang['7'] ?>})^2} \)</p>
                                <p class="w-full mt-3">n= \(\frac{ ({<?= round($detail['confidence_unit'], 4) ?>})^2 \times {<?= round($detail['proportion'], 4) ?>}(1 - <?= round($detail['proportion'], 4) ?>)}{({<?= round($detail['margin'], 4) ?>})^2} \)</p>
                                <p class="w-full mt-3">n= \(\frac{ ({<?= round($detail['confidence_unit'], 4) ?>})^2 \times {<?= round($detail['proportion'], 4) ?>}(<?= round($detail['minus'], 4) ?>)}{{<?= round($detail['marg'], 4) ?>}} \)</p>
                                <p class="w-full mt-3">n = \(\frac{ {<?= round($detail['con_unit'], 4) ?>} \times {<?= round($detail['proportion'], 4) ?>}\times<?= round($detail['minus'], 4) ?>}{{<?= round($detail['marg'], 4) ?>}} \)</p>
                                <p class="w-full mt-3">n= \( \frac{<?= round($detail['propro'], 4) ?>}{<?= round($detail['marg'], 4) ?>} \)</p>
                                <p class="w-full mt-3">n= <?= round($detail['sub_answer'], 7) ?></p>
                                <p class="w-full mt-3"><?= $lang['12'] ?></p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \frac{n \times N}{n + N - 1} \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \frac{ <?= round($detail['sub_answer'], 4) ?> \times <?= round($detail['n_finite'], 4) ?>}{ <?= round($detail['sub_answer'], 4) ?> + {<?= round($detail['n_finite'], 4) ?>} - 1} \)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = \( \frac{ <?= round($detail['a_answer'], 4) ?>}{ <?= round($detail['b_answer'], 4) ?> }\)</p>
                                <p class="w-full mt-3"><?= $lang['8'] ?> = <?= round($detail['answer'], 7) ?></p>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        @if (isset($detail))
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @endif
        document.getElementById("change_finite").innerHTML = "Standard Deviation";
        document.getElementById('finite').style.display = 'none';

        document.getElementById('yes').addEventListener('click', function() {
            this.classList.add('tagsUnit');
            document.getElementById('no').classList.remove('tagsUnit');
            document.getElementById('round').value = 'sample';
            document.getElementById("change_finite").innerHTML = "Standard Deviation";
            document.getElementById('finite').style.display = 'none';
        });

        document.getElementById('no').addEventListener('click', function() {
            this.classList.add('tagsUnit');
            document.getElementById('yes').classList.remove('tagsUnit');
            document.getElementById('round').value = 'margin';
            document.getElementById("change_finite").innerHTML = "Normal Distribution";
            document.getElementById('finite').style.display = 'block';
        });
        let round = document.getElementById('round').value;
        if (round === 'sample') {
            document.getElementById('yes').click();
        } else {
            document.getElementById('no').click();
        }
        // for standard or proportion
        document.getElementById('moe').style.display = 'block';
        document.getElementById('stander').style.display = 'block';
        document.getElementById('proportion').style.display = 'none';

        document.getElementById('given_change').addEventListener('change', function() {
            if (this.value === 'standard') {
                document.getElementById('moe').style.display = 'block';
                document.getElementById('stander').style.display = 'block';
                document.getElementById('proportion').style.display = 'none';
            } else {
                document.getElementById('moe').style.display = 'block';
                document.getElementById('proportion').style.display = 'block';
                document.getElementById('stander').style.display = 'none';
            }
        });

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>