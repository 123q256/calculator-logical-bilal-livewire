<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12   mt-3  gap-3">
                <div class="col-span-12  md:col-span-6 lg:col-span-6">
                    <div class="grid grid-cols-12   mt-3  gap-3">
                        <div class="col-span-8 " id="optimistic">
                            <label for="optimistic1" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="optimistic" id="optimistic1" value="{{ isset($_POST['optimistic'])?$_POST['optimistic']:'5' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-8 hidden" id="dubble_input">
                            <div class="row">
                                <div class="col-6 px-2">
                                    <label for="optimistic_one" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="optimistic_one" id="optimistic_one" value="{{ isset($_POST['optimistic_one'])?$_POST['optimistic_one']:'9' }}" class="input" aria-label="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-6 px-2">
                                    <label for="optimistic_sec" class="font-s-14">&nbsp;</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="optimistic_sec" id="optimistic_sec" value="{{ isset($_POST['optimistic_sec'])?$_POST['optimistic_sec']:'7' }}" class="input" aria-label="input" placeholder="00" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-4 ">
                            <label for="optimistic_unit" class="font-s-14">&nbsp;</label>
                            <div class="w-100 py-2">
                                <select name="optimistic_unit" id="optimistic_unit" class="input" onchange="mySelection(this)">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                            {!! $arr2[$index] !!}
                                        </option>
                                    @php
                                        }}
                                        $name = ["hrs", "days", "wks", "mos", "yrs", "yrs/mos", "wks/days", "days/hrs"];
                                        $val = ["hrs", "days", "wks", "mos", "yrs", "yrs/mos", "wks/days", "days/hrs"];
                                        optionsList($val,$name,isset($_POST['optimistic_unit'])?$_POST['optimistic_unit']:'days');
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12  md:col-span-6 lg:col-span-6">
                    <div class="grid grid-cols-12   mt-3  gap-3">
                        <div class="col-span-8 " id="pessimistic">
                            <label for="pessimistic1" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="pessimistic" id="pessimistic1" value="{{ isset($_POST['pessimistic'])?$_POST['pessimistic']:'9' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-8 hidden" id="dubb_input">
                            <div class="row">
                                <div class="col-6 px-2">
                                    <label for="pessimistic_one" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="pessimistic_one" id="pessimistic_one" value="{{ isset($_POST['pessimistic_one'])?$_POST['pessimistic_one']:'8' }}" class="input" aria-label="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-6 px-2">
                                    <label for="pessimistic_sec" class="font-s-14">&nbsp;</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="pessimistic_sec" id="pessimistic_sec" value="{{ isset($_POST['pessimistic_sec'])?$_POST['pessimistic_sec']:'6' }}" class="input" aria-label="input" placeholder="00" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-4 ">
                            <label for="pessimistic_unit" class="font-s-14">&nbsp;</label>
                            <div class="w-100 py-2">
                                <select name="pessimistic_unit" id="pessimistic_unit" class="input" onchange="sec_Selection(this)">
                                    @php
                                        $name = ["hrs", "days", "wks", "mos", "yrs", "yrs/mos", "wks/days", "days/hrs"];
                                        $val = ["hrs", "days", "wks", "mos", "yrs", "yrs/mos", "wks/days", "days/hrs"];
                                        optionsList($val,$name,isset($_POST['pessimistic_unit'])?$_POST['pessimistic_unit']:'days');
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12  md:col-span-6 lg:col-span-6">
                    <div class="grid grid-cols-12   mt-3  gap-3">
                        <div class="col-span-8 " id="most">
                            <label for="most1" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="most" id="most1" value="{{ isset($_POST['most'])?$_POST['most']:'7' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-8 hidden" style="margin-top: 2px" id="dub_input">
                            <div class="row">
                                <label for="most_one" class="px-2 w-full font-s-14 text-blue">{{ $lang['3'] }}:</label>
                                <div class="col-6 px-2">
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="most_one" id="most_one" value="{{ isset($_POST['most_one'])?$_POST['most_one']:'9' }}" class="input" aria-label="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-6 px-2">
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="most_sec" id="most_sec" value="{{ isset($_POST['most_sec'])?$_POST['most_sec']:'7' }}" class="input" aria-label="input" placeholder="00" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-4 ">
                            <label for="most_unit" class="font-s-14">&nbsp;</label>
                            <div class="w-100 py-2">
                                <select name="most_unit" id="most_unit" class="input" onchange="third_Selection(this)">
                                    @php
                                        $name = ["hrs", "days", "wks", "mos", "yrs", "yrs/mos", "wks/days", "days/hrs"];
                                        $val = ["hrs", "days", "wks", "mos", "yrs", "yrs/mos", "wks/days", "days/hrs"];
                                        optionsList($val,$name,isset($_POST['most_unit'])?$_POST['most_unit']:'days');
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12  md:col-span-6 lg:col-span-6">
                    <div class="grid grid-cols-12   mt-3  gap-3">
                        <div class="col-span-8 " id="desired">
                            <label for="desired1" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="desired" id="desired1" value="{{ isset($_POST['desired'])?$_POST['desired']:'7' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-8 hidden" style="margin-top: 2px" id="desired_input">
                            <div class="row">
                                <label for="desired_one" class="px-2 w-full font-s-14 text-blue">{{ $lang['4'] }}:</label>
                                <div class="col-6 px-2">
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="desired_one" id="desired_one" value="{{ isset($_POST['desired_one'])?$_POST['desired_one']:'9' }}" class="input" aria-label="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-6 px-2">
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="desired_sec" id="desired_sec" value="{{ isset($_POST['desired_sec'])?$_POST['desired_sec']:'7' }}" class="input" aria-label="input" placeholder="00" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-4 ">
                            <label for="desired_unit" class="font-s-14">&nbsp;</label>
                            <div class="w-100 py-2">
                                <select name="desired_unit" id="desired_unit" class="input" onchange="forth_Selection(this)">
                                    @php
                                        $name = ["hrs", "days", "wks", "mos", "yrs", "yrs/mos", "wks/days", "days/hrs"];
                                        $val = ["hrs", "days", "wks", "mos", "yrs", "yrs/mos", "wks/days", "days/hrs"];
                                        optionsList($val,$name,isset($_POST['desired_unit'])?$_POST['desired_unit']:'days');
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 px-2">
                    <label for="output_unit" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="w-100 py-2">
                        <select name="output_unit" id="output_unit" class="input">
                            @php
                                $name = ["hrs", "days", "wks", "mos", "yrs", "yrs/mos", "wks/days", "days/hrs"];
                                $val = ["hrs", "days", "wks", "mos", "yrs", "yrs/mos", "wks/days", "days/hrs"];
                                optionsList($val,$name,isset($_POST['output_unit'])?$_POST['output_unit']:'days');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 px-2">
                    <label for="deviation_unit" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="w-100 py-2">
                        <select name="deviation_unit" id="deviation_unit" class="input">
                            @php
                                $name = ["hrs", "days", "wks", "mos", "yrs", "yrs/mos", "wks/days", "days/hrs"];
                                $val = ["hrs", "days", "wks", "mos", "yrs", "yrs/mos", "wks/days", "days/hrs"];
                                optionsList($val,$name,isset($_POST['deviation_unit'])?$_POST['deviation_unit']:'days');
                            @endphp
                        </select>
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
                        <div class="w-full text-[12px] md:text-[16px] lg:text-[16px]">
                            @php
                                $request = request();
                                $optimistic = trim($request->optimistic);
                                $optimistic_one = trim($request->optimistic_one);
                                $optimistic_sec = trim($request->optimistic_sec);
                                $optimistic_unit = trim($request->optimistic_unit);
                                $pessimistic = trim($request->pessimistic);
                                $pessimistic_one = trim($request->pessimistic_one);
                                $pessimistic_sec = trim($request->pessimistic_sec);
                                $pessimistic_unit = trim($request->pessimistic_unit);
                                $most = trim($request->most);
                                $most_one = trim($request->most_one);
                                $most_sec = trim($request->most_sec);
                                $most_unit = trim($request->most_unit);
                                $desired = trim($request->desired);
                                $desired_one = trim($request->desired_one);
                                $desired_sec = trim($request->desired_sec);
                                $desired_unit = trim($request->desired_unit);
                                $output_unit = trim($request->output_unit);
                                $deviation_unit = trim($request->deviation_unit);
                            @endphp
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 px-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['7']?>:</td>
                                        <td class="py-2 border-b"><strong>
                                            <?php 
                                                echo round($detail['main_answer'], 2)
                                             ?>
                                        </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['8']?>:</td>
                                        <td class="py-2 border-b"><strong>
                                            <?php 
                                                echo round($detail['sub_answer'], 2)
                                             ?>
                                        </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['9']?>:</td>
                                        <td class="py-2 border-b"><strong>
                                            <?php 
                                                echo round($detail['ans'], 2)
                                             ?>%
                                        </strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="w-full mt-2 text-[20px]"><strong class="text-blue"><?= $lang['10'] ?></strong></p>
                            <p class="w-full mt-3"><?= $lang['11'] ?>.</p>
                            <p class="w-full mt-3"><?= $lang['7'] ?> =\(\dfrac{\text{ <?= $lang['1'] ?>} +(4 × \text{ <?= $lang['3'] ?>})+ \text{<?= $lang['2'] ?>}}{6} \)</p>
                            <p class="w-full mt-3"><?= $lang['7'] ?> =\(\dfrac{{
                                <?php
                                    if ($optimistic_unit === "yrs/mos" || $optimistic_unit === "wks/days" || $optimistic_unit === "days/hrs") {
                                        echo round($detail['optimistic'], 4);
                                    } else {
                                        echo $optimistic;
                                    }
                                ?>
                                } +(4 × {
                                <?php
                                    if ($most_unit === "yrs/mos" || $most_unit === "wks/days" || $most_unit === "days/hrs") {
                                        echo round($detail['most'], 4);
                                    } else {
                                        echo $most;;
                                    }
                                ?>
                                    })+{
                                <?php
                                    if ($pessimistic_unit === "yrs/mos" || $pessimistic_unit === "wks/days" || $pessimistic_unit === "days/hrs") {
                                        echo round($detail['pessimistic'], 4);
                                    } else {
                                        echo $pessimistic;;
                                    }
                                ?>
                                }}{6} \)
                            </p>
                            <p class="w-full mt-3"><?= $lang['7'] ?> =\(\dfrac{<?php echo round($detail['add']); ?>}{6} \)</p>
                            <p class="w-full mt-3"><?= $lang['7'] ?> =<?php echo round($detail['main_answer'],2); ?></p>
                            <p class="w-full mt-3"><?= $lang['12'] ?>.</p>
                            <p class="w-full mt-3"><?= $lang['8'] ?> =\(\dfrac{\text{<?= $lang['2'] ?>} - \text{<?= $lang['1'] ?>}}{6} \)</p>
                            <p class="w-full mt-3"><?= $lang['8'] ?> =\(\dfrac{{
                                        <?php
                                        if ($pessimistic_unit === "yrs/mos" || $pessimistic_unit === "wks/days" || $pessimistic_unit === "days/hrs") {
                                            echo round($detail['pessimistic'], 4);
                                        } else {
                                            echo $pessimistic;;
                                        }
                                        ?>
                                    } - {
                                        <?php
                                        if ($optimistic_unit === "yrs/mos" || $optimistic_unit === "wks/days" || $optimistic_unit === "days/hrs") {
                                            echo round($detail['optimistic'], 4);
                                        } else {
                                            echo $optimistic;;
                                        }
                                        ?>
                                    }}{6} \)</p>
                            <p class="w-full mt-3"><?= $lang['8'] ?> = <?php echo round($detail['sub_answer'], 2); ?></p>
                            <p class="w-full mt-3"><?= $lang['13'] ?>.</p>
                            <p class="w-full mt-3 overflow-auto"><?= $lang['9'] ?> =\(\dfrac{\text{<?= $lang['4'] ?>} - \text{<?= $lang['7'] ?>}}{\text{<?= $lang['8'] ?>}}\)</p>
                            <p class="w-full mt-3"><?= $lang['9'] ?> =\(\dfrac{{
                                        <?php
                                        if ($desired_unit === "yrs/mos" || $desired_unit === "wks/days" || $desired_unit === "days/hrs") {
                                            echo round($detail['desired'], 4);
                                        } else {
                                            echo $desired;;
                                        }
                                        ?> } - {<?= round($detail['main_answer'], 2) ?>}}{<?= round($detail['sub_answer'], 2) ?>} \)</p>
                            <p class="w-full mt-3"><?= $lang['9'] ?> = <?= round($detail['ans'], 2) ?><span class="black-text font_size18 ">%</span></p>
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
        function mySelection(chal) {
            var aja = chal.value;
            if (aja === 'yrs/mos' || aja === 'wks/days' || aja === 'days/hrs') {
                document.getElementById('dubble_input').style.display = 'block';
                document.getElementById('optimistic').style.display = 'none';
            } else {
                document.getElementById('dubble_input').style.display = 'none';
                document.getElementById('optimistic').style.display = 'block';
            }
        }

        function sec_Selection(chal) {
            var aja = chal.value;
            if (aja === 'yrs/mos' || aja === 'wks/days' || aja === 'days/hrs') {
                document.getElementById('dubb_input').style.display = 'block';
                document.getElementById('pessimistic').style.display = 'none';
            } else {
                document.getElementById('dubb_input').style.display = 'none';
                document.getElementById('pessimistic').style.display = 'block';
            }
        }

        function third_Selection(chal) {
            var aja = chal.value;
            if (aja === 'yrs/mos' || aja === 'wks/days' || aja === 'days/hrs') {
                document.getElementById('dub_input').style.display = 'block';
                document.getElementById('most').style.display = 'none';
            } else {
                document.getElementById('dub_input').style.display = 'none';
                document.getElementById('most').style.display = 'block';
            }
        }

        function forth_Selection(chal) {
            var aja = chal.value;
            if (aja === 'yrs/mos' || aja === 'wks/days' || aja === 'days/hrs') {
                document.getElementById('desired_input').style.display = 'block';
                document.getElementById('desired').style.display = 'none';
            } else {
                document.getElementById('desired_input').style.display = 'none';
                document.getElementById('desired').style.display = 'block';
            }
        }
        ['optimistic_unit', 'pessimistic_unit', 'most_unit', 'desired_unit'].forEach(function(id) {
            document.getElementById(id).dispatchEvent(new Event('change'));
        });

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>