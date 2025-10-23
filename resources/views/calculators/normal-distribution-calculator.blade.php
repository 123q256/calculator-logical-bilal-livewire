<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2">
                <div class="col-span-12   md:col-span-6 lg:col-span-6  mb-2">
                    <label for="operation" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <select name="operations" id="operation" class="input">
                            @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                            }}
                            $name = [$lang[2],$lang[3]];
                            $val = [3,4];
                            optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']:'3');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12" id="main_div">
                    <div class="grid grid-cols-12  gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="find_compare" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <select name="find_compare" id="find_compare" class="input">
                                    @php
                                    $name = [$lang[5].' (x)',$lang[6].' P(X < x)']; $val=[1,2]; optionsList($val,$name,isset($_POST['find_compare'])?$_POST['find_compare']:'3'); @endphp </select>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="f_first" class="font-s-14 text-blue" id="f_1">{{ $lang['7'] }} P(X < x):</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="f_first" id="f_first" value="{{ isset($_POST['f_first'])?$_POST['f_first']:'0.4' }}" class="input" aria-label="input" placeholder="00" />
                                    </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="f_second" class="font-s-14 text-blue" id="f_2">{{ $lang['8'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="f_second" id="f_second" value="{{ isset($_POST['f_second'])?$_POST['f_second']:'3' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="f_third" class="font-s-14 text-blue" id="f_3">{{ $lang['9'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="f_third" id="f_third" value="{{ isset($_POST['f_third'])?$_POST['f_third']:'5' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                    </div>
                </div>
                <div id="main_div2" class="col-span-12 hidden">
                    <div class="grid grid-cols-12  gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="mean" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="mean" id="mean" value="{{ isset($_POST['mean'])?$_POST['mean']:'' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="deviation" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="deviation" id="deviation" value="{{ isset($_POST['deviation'])?$_POST['deviation']:'' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <p class="col-span-12 font-s-18 px-2"><strong class="text-blue"><?= $lang[10] ?></strong></p>
                        <div class="col-span-12 flex align-items-center">
                            <label for="a">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P</mi>
                                                    <mo stretchy="false">(</mo>
                                                    <mi>X</mi>
                                                    <mo>&#x2264;<!-- ≤ --></mo>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </label>
                            <input type="number" step="any" name="a" id="a" value="{{ isset($_POST['a'])?$_POST['a']:'' }}" class="input mx-2" aria-label="input" placeholder="00" style="width: 100px" />
                            <math xmlns="http://www.w3.org/1998/Math/MathML">
                                <mstyle displaystyle="true" scriptlevel="0">
                                    <mrow class="MJX-TeXAtom-ORD">
                                        <mstyle mathsize="1.2em">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mo stretchy="false">)</mo>
                                                <mi>=</mi>
                                                <mo>?</mo>
                                            </mrow>
                                        </mstyle>
                                    </mrow>
                                </mstyle>
                            </math>
                        </div>
                        <div class="col-span-12 flex align-items-center mt-3">
                            <label for="b">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P</mi>
                                                    <mo stretchy="false">(</mo>
                                                    <mi>X</mi>
                                                    <mo>&#x2265;<!-- ≥ --></mo>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </label>
                            <input type="number" step="any" name="b" id="b" value="{{ isset($_POST['b'])?$_POST['b']:'' }}" class="input mx-2" aria-label="input" placeholder="00" style="width: 100px" />
                            <math xmlns="http://www.w3.org/1998/Math/MathML">
                                <mstyle displaystyle="true" scriptlevel="0">
                                    <mrow class="MJX-TeXAtom-ORD">
                                        <mstyle mathsize="1.2em">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mo stretchy="false">)</mo>
                                                <mi>=</mi>
                                                <mo>?</mo>
                                            </mrow>
                                        </mstyle>
                                    </mrow>
                                </mstyle>
                            </math>
                        </div>
                        <div class="col-span-12 flex align-items-center mt-3">
                            <label for="c">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P</mi>
                                                    <mo stretchy="false">(</mo>
                                                    <mi>X</mi>
                                                    <mo>&#x2264;</mo>
                                                    <mo stretchy="false">? )</mo>
                                                    <mi>=</mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </label>
                            <input type="number" step="any" name="c" id="c" value="{{ isset($_POST['c'])?$_POST['c']:'' }}" class="input mx-2" aria-label="input" placeholder="00" style="width: 100px" />
                        </div>
                        <div class="col-span-12 flex align-items-center mt-3">
                            <label for="d">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P</mi>
                                                    <mo stretchy="false">(</mo>
                                                    <mi>X</mi>
                                                    <mo>&#x2265;<!-- ≤ --></mo>
                                                    <mo stretchy="false">? )</mo>
                                                    <mi>=</mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </label>
                            <input type="number" step="any" name="d" id="d" value="{{ isset($_POST['d'])?$_POST['d']:'' }}" class="input mx-2" aria-label="input" placeholder="00" style="width: 100px" />
                        </div>
                        <div class="col-span-12 flex align-items-center mt-3">
                            <label for="e1">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P (</mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </label>
                            <input type="number" step="any" name="e1" id="e1" value="{{ isset($_POST['e1'])?$_POST['e1']:'' }}" class="input mx-2" aria-label="input" placeholder="00" style="width: 100px" />
                            <label for="e2">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mo>&#x2264;</mo>
                                                    <mi>X</mi>
                                                    <mo>&#x2265;</mo>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </label>
                            <input type="number" step="any" name="e2" id="e2" value="{{ isset($_POST['e2'])?$_POST['e2']:'' }}" class="input mx-2" aria-label="input" placeholder="00" style="width: 100px" />
                            <math xmlns="http://www.w3.org/1998/Math/MathML">
                                <mstyle displaystyle="true" scriptlevel="0">
                                    <mrow class="MJX-TeXAtom-ORD">
                                        <mstyle mathsize="1.2em">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mo stretchy="false">)</mo>
                                                <mi>= ?</mi>
                                            </mrow>
                                        </mstyle>
                                    </mrow>
                                </mstyle>
                            </math>
                        </div>
                        <div class="col-span-12 flex align-items-center mt-3">
                            <label for="f">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( -?</mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi>X</mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi>? ) =</mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </label>
                            <input type="number" step="any" name="f" id="f" value="{{ isset($_POST['f'])?$_POST['f']:'' }}" class="input mx-2" aria-label="input" placeholder="00" style="width: 100px" />
                        </div>
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
                        <?php
                            $request = request();
                        // if (($request->operations)=="3") {
                        if (isset($detail['option1'])) {
                        ?>
                            <?php
                            $answer1_f = $request->f_first - $request->f_second;
                            $final_first = $answer1_f / $request->f_third;
                            ?>
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong class="text-blue">{{ $lang['12'] }}</strong>
                                </p>
                                <div class="flex justify-center">
                                <p class="text-[21px] bg-[#2845F5] text-white px-3 overflow-auto py-2 rounded-lg d-inline-block my-3">
                                    <strong>
                                        <math xmlns="http://www.w3.org/1998/Math/MathML">
                                            <mstyle displaystyle="true" scriptlevel="0">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mstyle mathsize="1.2em">
                                                        <mrow class="MJX-TeXAtom-ORD">
                                                            <mi>P ( X </mi>
                                                            <mo>&#x2264;</mo>
                                                            <mi><?php echo $detail['blow_first']; ?></mi>
                                                            <mi> ) = <?php echo $request->f_first; ?></mi>
                                                        </mrow>
                                                    </mstyle>
                                                </mrow>
                                            </mstyle>
                                        </math>
                                    </strong>
                                </p>
                            </div>
                        </div>
                            <p class="col-12 mt-3 text-[18px]"><strong class="text-blue"><?= $lang[13] ?>:</strong></p>
                            <p class="col-12 mt-2 text-[18px]"><b><?= $lang[14] ?> 1:</b></p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <?= $lang[15] ?>
                                <strong>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>( X </mi>
                                                        <mo>&#x2264;</mo>
                                                        <mi><?php echo $request->f_first; ?> )</mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </strong>
                                <?= $lang[16] ?>.
                            </p>
                            <div class="col-12 text-center">
                                <img src="<?= url('images/z_score/' . $detail['z_url'] . '.png') ?>" alt="Z-Score Graph" class="img_set" width="57%" height="100%">
                            </div>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 2:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>μ = <?php echo $request->f_second; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[18] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>σ = <?php echo $request->f_third; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( X </mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi>? ) = P ( X - μ</mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $request->f_first . " - " . $request->f_second; ?> ) = </mi>
                                                    <mi>P ( </mi>
                                                    <mo>X - μ / σ</mo>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $request->f_first . " - " . $request->f_second . " / " . $request->f_third; ?> ) </mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mo>x - μ / σ = Z <?= $lang[18] ?> </mo>
                                                        <mi><?php echo $request->f_first . " - " . $request->f_second . " / " . $request->f_third . " = " . $final_first; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( X </mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo "? ) = P ( Z "; ?></mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $final_first; ?> )</mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 3:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[20] ?>
                                <b>
                                    <?= $lang[21] ?>
                                </b>
                                <?= $lang[22] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi> P ( Z </mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $detail['blow_first'] . " ) = " . $request->f_first; ?></mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                        <?php
                        } else if (isset($detail['option2'])) {
                        ?>
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong class="text-blue">{{ $lang['12'] }}</strong>
                                </p>
                                <div class="flex justify-center">
                                <p class="font-s-21 bg-[#2845F5] text-white px-3 overflow-auto py-2 rounded-lg d-inline-block my-3">
                                    <strong>
                                        <math xmlns="http://www.w3.org/1998/Math/MathML">
                                            <mstyle displaystyle="true" scriptlevel="0">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mstyle mathsize="1.2em">
                                                        <mrow class="MJX-TeXAtom-ORD">
                                                            <mi>P ( X </mi>
                                                            <mo>&#x2264;</mo>
                                                            <mi><?php echo $request->f_first; ?></mi>
                                                            <mi> ) = <?php echo $detail['ltpv_first']; ?></mi>
                                                        </mrow>
                                                    </mstyle>
                                                </mrow>
                                            </mstyle>
                                        </math>
                                    </strong>
                                </p>
                            </div>
                        </div>
                            <p class="col-12 mt-3 text-[18px]"><strong class="text-blue"><?= $lang[13] ?>:</strong></p>
                            <p class="col-12 mt-2 text-[18px]"><strong class="text-blue"><?= $lang[14] ?> 1:</strong></p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <?= $lang[15] ?>
                                <strong>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>( X </mi>
                                                        <mo>&#x2264;</mo>
                                                        <mi><?php echo $request->f_first; ?> )</mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </strong>
                                <?= $lang[16] ?>.
                            </p>
                            <div class="col-12 text-center">
                                <img src="<?= url('images/z_score/' . $detail['z_url'] . '.png') ?>" alt="Z-Score Graph" class="img_set" width="57%" height="100%">
                            </div>
                            <p class="col-12 mt-2 text-[18px]"><strong class="text-blue"><?= $lang[14] ?> 2:</strong></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <strong>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>μ = <?php echo $request->f_second; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </strong>
                                <?= $lang[18] ?>
                                <strong>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>σ = <?php echo $request->f_third; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </strong>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( X </mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $request->f_first; ?> ) = P ( X - μ</mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $request->f_first . " - " . $request->f_second; ?> ) = </mi>
                                                    <mi>P ( </mi>
                                                    <mo>X - μ / σ</mo>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $request->f_first . " - " . $request->f_second . " / " . $request->f_third; ?> ) </mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <strong>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mo>x - μ / σ = Z <?= $lang[18] ?> </mo>
                                                        <mi><?php echo $request->f_first . " - " . $request->f_second . " / " . $request->f_third . " = " . $detail['ltpv_first']; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </strong>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( X </mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $request->f_first . " ) = P ( Z "; ?></mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $detail['rz_first']; ?> )</mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[19] ?> 3:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[20] ?>
                                <b>
                                    <?= $lang[21] ?>
                                </b>
                                <?= $lang[22] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi> P ( Z </mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $detail['rz_first'] . " ) = " . $detail['ltpv_first']; ?></mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                        <?php
                        }
                        // }else if (($request->operations)=="4") {
                        if (isset($detail['a'])) {
                        ?>
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong class="text-blue">{{ $lang['12'] }}</strong>
                                </p>
                                <div class="flex justify-center">
                                <p class="font-s-21 bg-[#2845F5] text-white px-3 overflow-auto py-2 rounded-lg d-inline-block my-3">
                                    <strong>
                                        <math xmlns="http://www.w3.org/1998/Math/MathML">
                                            <mstyle displaystyle="true" scriptlevel="0">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mstyle mathsize="1.2em">
                                                        <mrow class="MJX-TeXAtom-ORD">
                                                            <mi>P ( X </mi>
                                                            <mo>&#x2264;</mo>
                                                            <mi><?php echo $request->a; ?></mi>
                                                            <mi> ) = <?php echo $detail['ltpv']; ?></mi>
                                                        </mrow>
                                                    </mstyle>
                                                </mrow>
                                            </mstyle>
                                        </math>
                                    </strong>
                                </p>
                            </div>
                        </div>
                            <p class="col-12 mt-3 text-[18px]"><strong class="text-blue"><?= $lang[13] ?>:</strong></p>
                            <p class="col-12 mt-2 text-[18px]"><strong class="text-blue"><?= $lang[14] ?> 1:</strong></p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <?= $lang[15] ?>
                                <strong>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>( X </mi>
                                                        <mo>&#x2264;</mo>
                                                        <mi><?php echo $request->a; ?> )</mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </strong>
                                <?= $lang[16] ?>.
                            </p>
                            <div class="text-center">
                                <img src="<?= url('images/z_score/' . $detail['z_url'] . '.png') ?>" alt="Z-Score Graph" class="img_set" width="57%" height="100%">
                            </div>
                            <p class="col-12 mt-2 text-[18px]"><strong class="text-blue"><?= $lang[14] ?> 2:</strong></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <strong>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>μ = <?php echo $request->mean; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </strong>
                                <?= $lang[18] ?>
                                <strong>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>σ = <?php echo $request->deviation; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </strong>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( X </mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $request->a; ?> ) = P ( X - μ</mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $request->a . " - " . $request->mean; ?> ) = </mi>
                                                    <mi>P ( </mi>
                                                    <mo>X - μ / σ</mo>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $request->a . " - " . $request->mean . " / " . $request->deviation; ?> ) </mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <strong>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mo>x - μ / σ = Z <?= $lang[18] ?> </mo>
                                                        <mi><?php echo $request->a . " - " . $request->mean . " / " . $request->deviation . " = " . $detail['ltpv']; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </strong>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( X </mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $request->a . " ) = P ( Z "; ?></mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $detail['rz']; ?> )</mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 3:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[20] ?>
                                <strong>
                                    <?= $lang[21] ?>
                                </strong>
                                <?= $lang[22] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi> P ( Z </mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $detail['rz'] . " ) = " . $detail['ltpv']; ?></mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                        <?php
                        }
                        if (isset($detail['b'])) {
                        ?>
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong class="text-blue">{{ $lang['12'] }}</strong>
                                </p>
                                <p class="font-s-21 bg-white px-3 overflow-auto py-2 radius-10 d-inline-block my-3">
                                    <strong>
                                        <math xmlns="http://www.w3.org/1998/Math/MathML">
                                            <mstyle displaystyle="true" scriptlevel="0">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mstyle mathsize="1.2em">
                                                        <mrow class="MJX-TeXAtom-ORD">
                                                            <mi>P ( X </mi>
                                                            <mo>&#x2265;</mo>
                                                            <mi><?php echo $request->b; ?></mi>
                                                            <mi> ) = <?php echo $detail['rtpv2']; ?></mi>
                                                        </mrow>
                                                    </mstyle>
                                                </mrow>
                                            </mstyle>
                                        </math>
                                    </strong>
                                </p>
                            </div>
                            <p class="col-12 mt-3 text-[18px]"><strong class="text-blue"><?= $lang[13] ?>:</strong></p>
                            <p class="col-12 mt-2 text-[18px]"><strong class="text-blue"><?= $lang[14] ?> 1:</strong></p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <?= $lang[15] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>( X </mi>
                                                        <mo>&#x2265;</mo>
                                                        <mi><?php echo $request->b; ?> )</mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[16] ?>.
                            </p>
                            <div class="text-blue">
                                <img src="<?= url('images/z_score/' . $detail['z_url2'] . '.png') ?>" alt="Z-Score Graph" class="img_set" width="57%" height="100%">
                            </div>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 2:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>μ = <?php echo $request->mean; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[18] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>σ = <?php echo $request->deviation; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( X </mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo $request->b; ?> ) = P ( X - μ</mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo $request->b . " - " . $request->mean; ?> ) = </mi>
                                                    <mi>P ( </mi>
                                                    <mo>X - μ / σ</mo>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo $request->b . " - " . $request->mean . " / " . $request->deviation; ?> ) </mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mo>x - μ / σ = Z <?= $lang[18] ?> </mo>
                                                        <mi><?php echo $request->b . " - " . $request->mean . " / " . $request->deviation . " = " . $detail['rtpv2']; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( X </mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo $request->b . " ) = P ( Z "; ?></mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo $detail['rz2']; ?> )</mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 3:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[20] ?>
                                <b>
                                    <?= $lang[21] ?>
                                </b>
                                <?= $lang[22] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi> P ( Z </mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo $detail['rz2'] . " ) = " . $detail['rtpv2']; ?></mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                        <?php
                        }
                        if (isset($detail['c'])) {
                        ?>
                            <?php
                            $answer1 = $detail['blow'] - $request->mean;
                            $final = $answer1 / $request->deviation;
                            ?>
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong class="text-blue">{{ $lang['12'] }}</strong>
                                </p>
                                <p class="font-s-21 bg-white px-3 overflow-auto py-2 radius-10 d-inline-block my-3">
                                    <strong>
                                        <math xmlns="http://www.w3.org/1998/Math/MathML">
                                            <mstyle displaystyle="true" scriptlevel="0">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mstyle mathsize="1.2em">
                                                        <mrow class="MJX-TeXAtom-ORD">
                                                            <mi>P ( X </mi>
                                                            <mo>&#x2264;</mo>
                                                            <mi><?php echo $detail['blow']; ?></mi>
                                                            <mi> ) = <?php echo $request->c; ?></mi>
                                                        </mrow>
                                                    </mstyle>
                                                </mrow>
                                            </mstyle>
                                        </math>
                                    </strong>
                                </p>
                            </div>
                            <p class="col-12 mt-3 text-[18px]"><strong class="text-blue"><?= $lang[13] ?>:</strong></p>
                            <p class="col-12 mt-2 text-[18px]"><strong class="text-blue"><?= $lang[14] ?> 1:</strong></p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <?= $lang[15] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>( X </mi>
                                                        <mo>&#x2264;</mo>
                                                        <mi><?php echo $request->c; ?> )</mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[16] ?>.
                            </p>
                            <div class="text-center">
                                <img src="<?= url('images/z_score/' . $detail['z_urlc'] . '.png') ?>" alt="Z-Score Graph" class="img_set" width="57%" height="100%">
                            </div>
                            <p class="col-12 mt-2 text-[18px]"><b><?= $lang[14] ?> 2:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>μ = <?php echo $request->mean; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[18] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>σ = <?php echo $request->deviation; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( X </mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi>? ) = P ( X - μ</mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo  "?  - " . $request->mean; ?> ) = </mi>
                                                    <mi>P ( </mi>
                                                    <mo>X - μ / σ</mo>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo "?  - " . $request->mean . " / " . $request->deviation; ?> ) </mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mo>x - μ / σ = Z <?= $lang[18] ?> </mo>
                                                        <mi><?php echo $detail['blow'] . " - " . $request->mean . " / " . $request->deviation . " = " . $final; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( X </mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo "? ) = P ( Z "; ?></mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $detail['blow']; ?> )</mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 3:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[20] ?>
                                <b>
                                    <?= $lang[21] ?>
                                </b>
                                <?= $lang[22] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi> P ( Z </mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi><?php echo $detail['blow'] . " ) = " . $request->c; ?></mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                        <?php
                        }
                        if (isset($detail['d'])) {
                        ?>
                            <?php
                            $answer1 = $detail['above2'] - $request->mean;
                            $final = $answer1 / $request->deviation;
                            ?>
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong class="text-blue">{{ $lang['12'] }}</strong>
                                </p>
                                <p class="font-s-21 bg-white px-3 overflow-auto py-2 radius-10 d-inline-block my-3">
                                    <strong>
                                        <math xmlns="http://www.w3.org/1998/Math/MathML">
                                            <mstyle displaystyle="true" scriptlevel="0">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mstyle mathsize="1.2em">
                                                        <mrow class="MJX-TeXAtom-ORD">
                                                            <mi>P ( X </mi>
                                                            <mo>&#x2265;</mo>
                                                            <mi><?php echo $detail['above2']; ?></mi>
                                                            <mi> ) = <?php echo $request->d; ?></mi>
                                                        </mrow>
                                                    </mstyle>
                                                </mrow>
                                            </mstyle>
                                        </math>
                                    </strong>
                                </p>
                            </div>
                            <p class="col-12 mt-3 text-[18px]"> <b><?= $lang[13] ?>:</b></p>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 1:</b></p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <?= $lang[15] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>( X </mi>
                                                        <mo>&#x2265;</mo>
                                                        <mi><?php echo $request->d; ?> )</mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[16] ?>.
                            </p>
                            <div class="text-center">
                                <img src="<?= url('images/z_score/' . $detail['z_urld'] . '.png') ?>" alt="Z-Score Graph" class="img_set" width="57%" height="100%">
                            </div>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 2:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>μ = <?php echo $request->mean; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[18] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>σ = <?php echo $request->deviation; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( X </mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi>? ) = P ( X - μ</mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo  "?  - " . $request->mean; ?> ) = </mi>
                                                    <mi>P ( </mi>
                                                    <mo>X - μ / σ</mo>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo "?  - " . $request->mean . " / " . $request->deviation; ?> ) </mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mo>x - μ / σ = Z <?= $lang[18] ?> </mo>
                                                        <mi><?php echo $detail['above2'] . " - " . $request->mean . " / " . $request->deviation . " = " . $final; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( X </mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo "? ) = P ( Z "; ?></mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo $detail['above2']; ?> )</mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 3:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[20] ?>
                                <b>
                                    <?= $lang[21] ?>
                                </b>
                                <?= $lang[22] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi> P ( Z </mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo $detail['above2'] . " ) = " . $request->d; ?></mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                        <?php
                        }
                        if (isset($detail['e1']) && isset($detail['e2'])) {
                        ?>
                            <?php
                            
                            $ans_e1 = $request->e1 - $request->mean;
                            $final_e1 = $ans_e1 / $request->deviation;
                            $ans_e2 = $request->e2 - $request->mean;
                            $final_e2 = $ans_e2 / $request->deviation;
                            $main_ans = $detail['ltpv_e2'] - $detail['ltpv_e1'];
                            ?>
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong class="text-blue">{{ $lang['12'] }}</strong>
                                </p>
                                <p class="font-s-21 bg-white px-3 overflow-auto py-2 radius-10 d-inline-block my-3">
                                    <strong>
                                        <math xmlns="http://www.w3.org/1998/Math/MathML">
                                            <mstyle displaystyle="true" scriptlevel="0">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mstyle mathsize="1.2em">
                                                        <mrow class="MJX-TeXAtom-ORD">
                                                            <mi>P ( <?php echo $request->e1; ?></mi>
                                                            <mo>&#x2264;</mo>
                                                            <mi>X</mi>
                                                            <mo>&#x2265;</mo>
                                                            <mi><?php echo $request->e2 . ") = " . $main_ans; ?></mi>
                                                        </mrow>
                                                    </mstyle>
                                                </mrow>
                                            </mstyle>
                                        </math>
                                    </strong>
                                </p>
                            </div>
                            <p class="col-12 mt-3 text-[18px]"> <b><?= $lang[13] ?>:</b></p>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 1:</b></p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <?= $lang[15] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>P ( <?php echo $request->e1; ?></mi>
                                                        <mo>&#x2264;</mo>
                                                        <mi>X</mi>
                                                        <mo>&#x2265;</mo>
                                                        <mi><?php echo $request->e2 . ")"; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[16] ?>.
                            </p>
                            <div class="text-center">
                                <img src="<?= url('images/z_score/' . $detail['z_urle'] . '.png') ?>" alt="Z-Score Graph" class="img_set" width="57%" height="100%">
                            </div>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 2:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>μ = <?php echo $request->mean; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[18] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>σ = <?php echo $request->deviation; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( <?php echo $request->e1; ?></mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi>X</mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo $request->e2 . ") = P ( " . $request->e1 . " - " . $request->mean; ?></mi>
                                                    <mo>&#x2264; X - μ &#x2265;</mo>
                                                    <mi><?php echo $request->e2 . " - " . $request->mean . " ) ="; ?></mi>
                                                    <mi>P ( </mi>
                                                    <mi><?php echo $request->e1 . " - " . $request->mean . " / " . $request->deviation; ?>
                                                        <mo>&#x2264;</mo>
                                                        <mo>X - μ / σ</mo>
                                                        <mo>&#x2265;</mo>
                                                        <mi><?php echo $request->e2 . " - " . $request->mean . " / " . $request->deviation; ?> ) </mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mo>Z= x - μ / σ , </mo>
                                                        <mi><?php echo $request->e1 . " - " . $request->mean . " / " . $request->deviation . " = " . $final_e1 . " and "; ?></mi>
                                                        <mi><?php echo $request->e2 . " - " . $request->mean . " / " . $request->deviation . " = " . $final_e2; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( <?php echo $request->e1; ?> </mi>
                                                    <mo>&#x2264; X &#x2265; </mo>
                                                    <mi><?php echo $request->e2 . " ) = P ( " . $final_e1; ?></mi>
                                                    <mo>&#x2264; Z &#x2265;</mo>
                                                    <mi><?php echo $final_e2 . " ) "; ?></mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 3:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[20] ?>
                                <b>
                                    <?= $lang[21] ?>
                                </b>
                                <?= $lang[22] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi><?php echo "P ( " . $final_e1; ?></mi>
                                                    <mo>&#x2264; Z &#x2265;</mo>
                                                    <mi><?php echo $final_e2 . " ) = " . $main_ans; ?></mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                        <?php
                        }
                        if (isset($detail['f'])) {
                        ?>
                            <?php
                            $ans_f1 = $detail['llf'] - $request->mean;
                            $final_f1 = $ans_f1 / $request->deviation;
                            $ans_f2 = $detail['ulf'] - $request->mean;
                            $final_f2 = $ans_f2 / $request->deviation;
                            $main_ansf = $detail['ulf'] - $detail['llf'];
                            ?>
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong class="text-blue">{{ $lang['12'] }}</strong>
                                </p>
                                <p class="font-s-21 bg-white px-3 overflow-auto py-2 radius-10 d-inline-block my-3">
                                    <strong>
                                        <math xmlns="http://www.w3.org/1998/Math/MathML">
                                            <mstyle displaystyle="true" scriptlevel="0">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mstyle mathsize="1.2em">
                                                        <mrow class="MJX-TeXAtom-ORD">
                                                            <mi>P ( <?php echo $detail['llf']; ?></mi>
                                                            <mo>&#x2264;</mo>
                                                            <mi>X</mi>
                                                            <mo>&#x2265;</mo>
                                                            <mi><?php echo $detail['ulf'] . ") = " . $request->f; ?></mi>
                                                        </mrow>
                                                    </mstyle>
                                                </mrow>
                                            </mstyle>
                                        </math>
                                    </strong>
                                </p>
                            </div>
                            <p class="col-12 mt-3 text-[18px]"> <b><?= $lang[13] ?>:</b></p>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 1:</b></p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <?= $lang[15] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>P ( <?php echo $detail['llf']; ?></mi>
                                                        <mo>&#x2264;</mo>
                                                        <mi>X</mi>
                                                        <mo>&#x2265;</mo>
                                                        <mi><?php echo $detail['ulf'] . ")"; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[16] ?>.
                            </p>
                            <div class="text-center">
                                <img src="<?= url('images/z_score/' . $detail['z_urlf'] . '.png') ?>" alt="Z-Score Graph" class="img_set" width="57%" height="100%">
                            </div>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 2:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>μ = <?php echo $request->mean; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[18] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mi>σ = <?php echo $request->deviation; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( <?php echo $detail['llf'] ?></mi>
                                                    <mo>&#x2264;</mo>
                                                    <mi>X</mi>
                                                    <mo>&#x2265;</mo>
                                                    <mi><?php echo $detail['ulf'] . ") = P ( " . $detail['llf'] . " - " . $request->mean; ?></mi>
                                                    <mo>&#x2264; X - μ &#x2265;</mo>
                                                    <mi><?php echo $detail['ulf'] . " - " . $request->mean . " ) ="; ?></mi>
                                                    <mi>P ( </mi>
                                                    <mi><?php echo $detail['llf'] . " - " . $request->mean . " / " . $request->deviation; ?>
                                                        <mo>&#x2264;</mo>
                                                        <mo>X - μ / σ</mo>
                                                        <mo>&#x2265;</mo>
                                                        <mi><?php echo $detail['ulf'] . " - " . $request->mean . " / " . $request->deviation; ?> ) </mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[17] ?>
                                <b>
                                    <math xmlns="http://www.w3.org/1998/Math/MathML">
                                        <mstyle displaystyle="true" scriptlevel="0">
                                            <mrow class="MJX-TeXAtom-ORD">
                                                <mstyle mathsize="1.2em">
                                                    <mrow class="MJX-TeXAtom-ORD">
                                                        <mo>Z= x - μ / σ , </mo>
                                                        <mi><?php echo $detail['llf'] . " - " . $request->mean . " / " . $request->deviation . " = " . $final_f1 . " and "; ?></mi>
                                                        <mi><?php echo $detail['ulf'] . " - " . $request->mean . " / " . $request->deviation . " = " . $final_f2; ?></mi>
                                                    </mrow>
                                                </mstyle>
                                            </mrow>
                                        </mstyle>
                                    </math>
                                </b>
                                <?= $lang[19] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi>P ( <?php echo $detail['llf']; ?> </mi>
                                                    <mo>&#x2264; X &#x2265; </mo>
                                                    <mi><?php echo $detail['ulf'] . " ) = P ( " . $final_f1; ?></mi>
                                                    <mo>&#x2264; Z &#x2265;</mo>
                                                    <mi><?php echo $final_f2 . " ) "; ?></mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                            <p class="col-12 mt-2 text-[18px]"> <b><?= $lang[14] ?> 3:</b></p>
                            <p class="col-12 mt-2 overflow-auto">
                                <?= $lang[20] ?>
                                <b>
                                    <?= $lang[21] ?>
                                </b>
                                <?= $lang[22] ?>:
                            </p>
                            <p class="col-12 mt-2 text-center overflow-auto">
                                <math xmlns="http://www.w3.org/1998/Math/MathML">
                                    <mstyle displaystyle="true" scriptlevel="0">
                                        <mrow class="MJX-TeXAtom-ORD">
                                            <mstyle mathsize="1.2em">
                                                <mrow class="MJX-TeXAtom-ORD">
                                                    <mi><?php echo "P ( " . $final_f1; ?></mi>
                                                    <mo>&#x2264; Z &#x2265;</mo>
                                                    <mi><?php echo $final_f2 . " ) = " . $request->f; ?></mi>
                                                </mrow>
                                            </mstyle>
                                        </mrow>
                                    </mstyle>
                                </math>
                            </p>
                        <?php
                        }
                        // }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
<script>
    // Function to update the text based on the selected value
    function updateText() {
        var c = document.getElementById('find_compare').value;
        if (c == "1") {
            document.getElementById('f_1').innerText = "Cumulative probability: P(X < x):";
            document.getElementById('f_2').innerText = "Mean:";
            document.getElementById('f_3').innerText = "Standard deviation:";
        } else if (c == "2") {
            document.getElementById('f_1').innerText = "Normal random variable (x):";
            document.getElementById('f_2').innerText = "Mean:";
            document.getElementById('f_3').innerText = "Standard deviation:";
        } else if (c == "3") {
            document.getElementById('f_1').innerText = "Normal random variable (x):";
            document.getElementById('f_2').innerText = "Cumulative probability: P(X < x):";
            document.getElementById('f_3').innerText = "Standard deviation:";
        } else if (c == "4") {
            document.getElementById('f_1').innerText = "Normal random variable (x):";
            document.getElementById('f_2').innerText = "Cumulative probability: P(X < x):";
            document.getElementById('f_3').innerText = "Mean:";
        }
    }
    // Initial text update
    updateText();
    // Add event listener for change event
    document.getElementById('find_compare').addEventListener('change', updateText);
    // Function to handle the display logic
    function updateDisplay() {
        let cal = document.getElementById('operation').value;
        if (cal === '3') {
            document.getElementById('main_div').style.display = 'block';
            document.getElementById('main_div2').style.display = 'none';
        } else if (cal === '4') {
            document.getElementById('main_div').style.display = 'none';
            document.getElementById('main_div2').style.display = 'block';
        }
    }
    // Initial display update
    updateDisplay();
    // Add event listener for change event
    document.getElementById('operation').addEventListener('change', updateDisplay);
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>