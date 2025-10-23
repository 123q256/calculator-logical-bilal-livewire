<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php
                $request = request();
            @endphp
            <div class="col-span-12 ">
                <label for="dtrmn_slct_method" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select id="dtrmn_slct_method" name="dtrmn_slct_method" class="input dtrmn_mtrx_slct">
                        <?php
                          function optnsList($arr1,$arr2,$frst,$matrix){
                          foreach($arr1 as $index => $name){
                        ?>
                        <option value="<?php echo $name; ?>" <?php if (isset($matrix)) {
                            echo $name === $matrix ? ' selected' : '';
                        } else {
                            echo $name === $frst ? ' selected' : '';
                        } ?>><?php echo $arr2[$index]; ?></option>
                        <?php
                            }
                          }
                          $name = ["2","3","4","5"];
                          $val = ["2","3","4","5"];
                          optnsList($val,$name,"3",$request->dtrmn_slct_method);
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <table class="w-full dtrmn_mtrx_tbl">
                    <tr>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_0_0" class="input"
                                    value="<?= isset($request->dtrmn_0_0) ? $request->dtrmn_0_0 : '1' ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_0_1" class="input"
                                    value="<?= isset($request->dtrmn_0_1) ? $request->dtrmn_0_1 : '1' ?>" required>
                            </div>
                        </td>
                        <td
                            class="{{ isset($request->dtrmn_slct_method) && $request->dtrmn_slct_method == '2' ? 'hidden' : '' }}">
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_0_2" class="input"
                                    value="<?= isset($request->dtrmn_0_2) ? $request->dtrmn_0_2 : '9' ?>" required>
                            </div>
                        </td>
                        @for ($j = 3; $j < $request->dtrmn_slct_method; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'dtrmn_0_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'dtrmn_0_' . $j }}" class="input"
                                        value="{{ $request->$mat }}" required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_1_0" class="input"
                                    value="<?= isset($request->dtrmn_1_0) ? $request->dtrmn_1_0 : '2' ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_1_1" class="input"
                                    value="<?= isset($request->dtrmn_1_1) ? $request->dtrmn_1_1 : '5' ?>" required>
                            </div>
                        </td>
                        <td
                            class="{{ isset($request->dtrmn_slct_method) && $request->dtrmn_slct_method == '2' ? 'hidden' : '' }}">
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_1_2" class="input"
                                    value="<?= isset($request->dtrmn_1_2) ? $request->dtrmn_1_2 : '1' ?>" required>
                            </div>
                        </td>
                        @for ($j = 3; $j < $request->dtrmn_slct_method; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'dtrmn_1_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'dtrmn_1_' . $j }}" class="input"
                                        value="{{ $request->$mat }}" required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    <tr
                        class="{{ isset($request->dtrmn_slct_method) && $request->dtrmn_slct_method == '2' ? 'hidden' : '' }}">
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_2_0" class="input"
                                    value="<?= isset($request->dtrmn_2_0) ? $request->dtrmn_2_0 : '1' ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_2_1" class="input"
                                    value="<?= isset($request->dtrmn_2_1) ? $request->dtrmn_2_1 : '2' ?>" required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="dtrmn_2_2" class="input"
                                    value="<?= isset($request->dtrmn_2_2) ? $request->dtrmn_2_2 : '7' ?>" required>
                            </div>
                        </td>
                        @for ($j = 3; $j < $request->dtrmn_slct_method; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'dtrmn_2_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'dtrmn_2_' . $j }}" class="input"
                                        value="{{ $request->$mat }}" required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    @isset($request->submit)
                        @for ($i = 3; $i < $request->dtrmn_slct_method; $i++)
                            <tr>
                                @for ($j = 0; $j < $request->dtrmn_slct_method; $j++)
                                    <td>
                                        <div class="px-1 pt-2">
                                            @php $mat = 'dtrmn_'.$i.'_'. $j; @endphp
                                            <input type="number" step="any" name="{{ 'dtrmn_' . $i . '_' . $j }}"
                                                class="input" value="{{ $request->$mat }}" required>
                                        </div>
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    @endisset
                </table>
            </div>
            <div class="col-span-12 ">
                <button type="button" id="dtrmn_gen_btn"
                    class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?= $lang['2'] ?></button>
                <button type="button" id="dtrmn_clr_btn"
                    class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?= $lang['3'] ?></button>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="dtrmn_opts_method" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-full py-2">
                    <select id="dtrmn_opts_method" name="dtrmn_opts_method" class="input dtrmn_mtrx_opts">
                        <?php
                        $name = [$lang['5'], $lang['6'], $lang['7'], $lang['8'], $lang['9']];
                        $val = ['exp_col', 'exp_row', 'leibniz', 'triangle', 'sarrus'];
                        optnsList($val, $name, 'exp_col', $request->dtrmn_opts_method);
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 {{ isset($request->dtrmn_opts_method) && ($request->dtrmn_opts_method === 'leibniz' || $request->dtrmn_opts_method === 'triangle' || $request->dtrmn_opts_method === 'sarrus') ? 'hidden':'' }}" id="dtrmn_opts_Input">
                <label for="dtrmn_opts" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" id="dtrmn_opts" max="3" min="1"
                        name="dtrmn_opts" class="input"
                        value="<?= isset($request->dtrmn_opts) ? $request->dtrmn_opts : '1' ?>" required>
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong><?= $lang['11'] ?></strong></td>
                                        <td class="py-2 border-b"><?= $detail['ans'] ?></td>
                                    </tr>
                                </table>
                            </div>
                            <style>
                                .dtrmn_colsf {
                                    margin: 10px 0;
                                    display: inline-block;
                                }
                                .dtrmn_cols {
                                    margin: 10px 0;
                                    display: inline-block;
                                }
                            </style>
                            @php
                                function gtVl($arr)
                                {
                                    $ars = [];
                                    foreach ($arr as $value) {
                                        $nms = $_POST['dtrmn_' . $value];
                                        array_push($ars, $nms);
                                    }
                                    return array_product($ars);
                                }
                            @endphp
                            <div class="w-full text-[16px]">
                                <div class="w-full">
                                    <p class="mt-2" style="margin-bottom:20px;font-weight:600;">
                                        <?= $lang['13'] ?> :</p>
                                    <p>
                                        <?php
                                            //Getting Values from Matrix
                                            function dspVl($vl) {
                                                return $_POST['dtrmn_'.$vl];
                                            }

                                            //Expand along the columns For 3x3 matrix
                                            function dspThrdCl($rc1,$rc2,$rc3,$rc4,$rc5,$rc6,$a1,$a2,$a3,$b1,$b2,$b3,$c1,$c2,$c3,$stepKey) {
                                        ?>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 1
                                    </p>


                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;\Big]\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($b3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;\Big]\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($c3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> \\
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;\Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size14" style="margin:15px 0;">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 2
                                    </p>



                                    <p class="dtrmn_cols">
                                        \(
                                        =\Big[
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \{\;\;(<?= dspVl($a2) ?> \times <?= dspVl($b2) ?> ) - ( <?= dspVl($a3) ?> \times
                                        <?= dspVl($b1) ?>)\;\;\}
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]\;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($b3) ?> \times
                                        \{\;\;(<?= dspVl($c1) ?> \times <?= dspVl($b2) ?> ) - ( <?= dspVl($c2) ?> \times
                                        <?= dspVl($b1) ?>)\;\;\}
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]\;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($c3) ?> \times
                                        \{\;\;(<?= dspVl($c1) ?> \times <?= dspVl($a3) ?> ) - ( <?= dspVl($c2) ?> \times
                                        <?= dspVl($a2) ?>)\;\;\}
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size14" style="margin:15px 0;">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 3
                                    </p>


                                    <p class="dtrmn_cols">
                                        \(
                                        =\Big[
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($a1) ?> \times
                                        \{\;\;( <?= gtVl([$a2, $b2]) ?> ) - ( <?= gtVl([$a3, $b1]) ?>)\;\;\}
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]\;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($b3) ?> \times
                                        \{\;\;( <?= gtVl([$c1, $b2]) ?> ) - ( <?= gtVl([$c2, $b1]) ?>)\;\;\}
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]\;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc6 ?>)} \times <?= dspVl($c3) ?> \times
                                        \{\;\;( <?= gtVl([$c1, $a3]) ?> ) - ( <?= gtVl([$c2, $a2]) ?>)\;\;\}
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size14" style="margin:15px 0;">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 4
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($a1) ?> \times
                                        ( <?= gtVl([$a2, $b2]) - gtVl([$a3, $b1]) ?>)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big[\;\;
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($b3) ?> \times
                                        ( <?= gtVl([$c1, $b2]) - gtVl([$c2, $b1]) ?>)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big[\;\;
                                        (-1)^{(<?= $rc6 ?>)} \times <?= dspVl($c3) ?> \times
                                        ( <?= gtVl([$c1, $a3]) - gtVl([$c2, $a2]) ?>)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 5
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        (<?= pow(-1, $rc4) ?>) \times (<?= dspVl($a1) * (gtVl([$a2, $b2]) - gtVl([$a3, $b1])) ?>)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big[\;\;
                                        (<?= pow(-1, $rc5) ?>) \times (<?= dspVl($b3) * (gtVl([$c1, $b2]) - gtVl([$c2, $b1])) ?>)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big[\;\;
                                        (<?= pow(-1, $rc6) ?>) \times (<?= dspVl($c3) * (gtVl([$c1, $a3]) - gtVl([$c2, $a2])) ?>)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 6
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big(
                                        <?= pow(-1, $rc4) * dspVl($a1) * (gtVl([$a2, $b2]) - gtVl([$a3, $b1])) ?>
                                        \Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big(
                                        <?= pow(-1, $rc5) * dspVl($b3) * (gtVl([$c1, $b2]) - gtVl([$c2, $b1])) ?>
                                        \Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big(
                                        <?= pow(-1, $rc6) * dspVl($c3) * (gtVl([$c1, $a3]) - gtVl([$c2, $a2])) ?>
                                        \Big)
                                        \)
                                    </p>
                                    </p>
                                    <?php
                                            }

                                            //Expand along the Rows For 3x3 matrix
                                            function dspThrdRw($rc1,$rc2,$rc3,$rc4,$rc5,$rc6,$a1,$a2,$a3,$b1,$b2,$b3,$c1,$c2,$c3,$stepKey) {
                                        ?>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 1
                                    </p>


                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big[\;\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($b3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c1) ?> & <?= dspVl($a3) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($b2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big[\;\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($c3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c1) ?> & <?= dspVl($a2) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($b1) ?>
                                        \end{smallmatrix}\bigr)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size14" style="margin:15px 0;">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 2
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\Big[\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \{\;\;(<?= dspVl($a2) ?> \times <?= dspVl($b2) ?> ) - ( <?= dspVl($a3) ?> \times
                                        <?= dspVl($b1) ?>)\;\;\}
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]\;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($b3) ?> \times
                                        \{\;\;(<?= dspVl($c1) ?> \times <?= dspVl($b2) ?> ) - ( <?= dspVl($a3) ?> \times
                                        <?= dspVl($c2) ?>)\;\;\}
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]\;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($c3) ?> \times
                                        \{\;\;(<?= dspVl($c1) ?> \times <?= dspVl($b1) ?> ) - ( <?= dspVl($a2) ?> \times
                                        <?= dspVl($c2) ?>)\;\;\}
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size14" style="margin:15px 0;">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 3
                                    </p>


                                    <p class="dtrmn_cols">
                                        \(
                                        =\Big[\;\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($a1) ?> \times
                                        \{\;\;( <?= gtVl([$a2, $b2]) ?> ) - ( <?= gtVl([$a3, $b1]) ?>)\;\;\}
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big[\;\;
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($b3) ?> \times
                                        \{\;\;( <?= gtVl([$c1, $b2]) ?> ) - ( <?= gtVl([$a3, $c2]) ?>)\;\;\}
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big[\;\;
                                        (-1)^{(<?= $rc6 ?>)} \times <?= dspVl($c3) ?> \times
                                        \{\;\;( <?= gtVl([$c1, $b1]) ?> ) - ( <?= gtVl([$a2, $c2]) ?>)\;\;\}
                                        \;\;\Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size14" style="margin:15px 0;">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 4
                                    </p>


                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($a1) ?> \times
                                        ( <?= gtVl([$a2, $b2]) - gtVl([$a3, $b1]) ?>)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big[\;\;
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($b3) ?> \times
                                        ( <?= gtVl([$c1, $b2]) - gtVl([$a3, $c2]) ?>)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big[\;\;
                                        (-1)^{(<?= $rc6 ?>)} \times <?= dspVl($c3) ?> \times
                                        ( <?= gtVl([$c1, $b1]) - gtVl([$a2, $c2]) ?>)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 5
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        (<?= pow(-1, $rc4) ?>) \times (<?= dspVl($a1) * (gtVl([$a2, $b2]) - gtVl([$a3, $b1])) ?>)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big[\;\;
                                        (<?= pow(-1, $rc5) ?>) \times (<?= dspVl($b3) * (gtVl([$c1, $b2]) - gtVl([$a3, $c2])) ?>)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big[\;\;
                                        (<?= pow(-1, $rc6) ?>) \times (<?= dspVl($c3) * (gtVl([$c1, $b1]) - gtVl([$a2, $c2])) ?>)
                                        \;\;\Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 6</p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big(
                                        <?= pow(-1, $rc4) * dspVl($a1) * (gtVl([$a2, $b2]) - gtVl([$a3, $b1])) ?>
                                        \Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big(
                                        <?= pow(-1, $rc5) * dspVl($b3) * (gtVl([$c1, $b2]) - gtVl([$a3, $c2])) ?>
                                        \Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \Big(
                                        <?= pow(-1, $rc6) * dspVl($c3) * (gtVl([$c1, $b1]) - gtVl([$a2, $c2])) ?>
                                        \Big)
                                        \)
                                    </p>
                                    </p>
                                    <?php
                                            }
            
                                            //Expand along the Rows For 4x4 matrix
                                            function dspFrthCl($rc1,$rc2,$rc3,$rc4,$rc5,$rc6,$rc7,$rc8,$a1,$a2,$a3,$a4,$b1,$b2,$b3,$b4,$c1,$c2,$c3,$c4,$d1,$d2,$d3,$d4,$stepKey) {
                                                ?>
                                    <p class="col s12 font_size20" style="margin-top:30px;">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 1
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($b4) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{vmatrix}
                                        \;\Big\}\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($c3) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($c4) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($b4) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{vmatrix}
                                        \;\Big\}\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($d3) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($c4) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?> \\
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($b4) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{vmatrix}
                                        \;\Big\}\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($d4) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($c4) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?> \\
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?>
                                        \end{vmatrix}
                                        \;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 2
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;(-1)^{\;(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times\;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($c3) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?> \\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($d3) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?> \\
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($d4) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?> \\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?> \\
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 3
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($c2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($c2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($b3) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($c3) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($c2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($d1) ?> \times <?= dspVl($c2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($d2) ?> \times <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($d1) ?> \times <?= dspVl($b3) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($d2) ?> \times <?= dspVl($b2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($d3) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($c2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($d1) ?> \times <?= dspVl($c2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($d2) ?> \times <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($d1) ?> \times <?= dspVl($a4) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($d2) ?> \times <?= dspVl($a3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($d4) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($b3) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($d1) ?> \times <?= dspVl($b3) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($d2) ?> \times <?= dspVl($b2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($d1) ?> \times <?= dspVl($a4) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($d2) ?> \times <?= dspVl($a3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}

                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 4
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($a1) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 1 + 1 ?>)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $c2]) - gtVl([$b3, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 2 + 1 ?>)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $c2]) - gtVl([$a4, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 3 + 1 ?>)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $b3]) - gtVl([$a4, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc6 ?>)} \times <?= dspVl($c3) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 1 + 1 ?>)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $c2]) - gtVl([$b3, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 2 + 1 ?>)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$d1, $c2]) - gtVl([$d2, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 3 + 1 ?>)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$d1, $b3]) - gtVl([$d2, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc7 ?>)} \times <?= dspVl($d3) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 1 + 1 ?>)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $c2]) - gtVl([$a4, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 2 + 1 ?>)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$d1, $c2]) - gtVl([$d2, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 3 + 1 ?>)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$d1, $a4]) - gtVl([$d2, $a3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}

                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc8 ?>)} \times <?= dspVl($d4) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 1 + 1 ?>)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $b3]) - gtVl([$a4, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 2 + 1 ?>)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$d1, $b3]) - gtVl([$d2, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 3 + 1 ?>)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$d1, $a4]) - gtVl([$d2, $a3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 5
                                    </p>


                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($a1) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 1 + 1 ?>)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $c2]) - gtVl([$b3, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 2 + 1 ?>)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $c2]) - gtVl([$a4, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 3 + 1 ?>)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $b3]) - gtVl([$a4, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}

                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc6 ?>)} \times <?= dspVl($c3) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 1 + 1 ?>)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $c2]) - gtVl([$b3, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 2 + 1 ?>)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$d1, $c2]) - gtVl([$d2, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 3 + 1 ?>)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$d1, $b3]) - gtVl([$d2, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc7 ?>)} \times <?= dspVl($d3) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 1 + 1 ?>)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $c2]) - gtVl([$a4, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 2 + 1 ?>)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$d1, $c2]) - gtVl([$d2, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 3 + 1 ?>)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$d1, $a4]) - gtVl([$d2, $a3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}

                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big\{\;
                                        (-1)^{(<?= $rc8 ?>)} \times <?= dspVl($d4) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 1 + 1 ?>)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $b3]) - gtVl([$a4, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 2 + 1 ?>)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$d1, $b3]) - gtVl([$d2, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 3 + 1 ?>)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$d1, $a4]) - gtVl([$d2, $a3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}

                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 6
                                    </p>
                                    \(
                                    =\;\Big[\;\; \\
                                    \;\Big\{\;\;
                                    (<?= pow(-1, $rc5) ?>) \times <?= dspVl($a1) ?> \times
                                    \Big(\;
                                    ( <?= pow(-1, 1 + 1) * (dspVl($a2) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * (dspVl($b1) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2]))) ?> )
                                    \;\Big)
                                    \;\Big\}\;\; \\
                                    + \\

                                    \;\Big\{\;\;
                                    (<?= pow(-1, $rc6) ?>) \times <?= dspVl($c3) ?> \times
                                    \Big(\;
                                    ( <?= pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * (dspVl($b1) * (gtVl([$d1, $c2]) - gtVl([$d2, $c1]))) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$d1, $b3]) - gtVl([$d2, $b2]))) ?> )
                                    \;\Big)
                                    \;\Big\}\;\; \\
                                    + \\

                                    \;\Big\{\;\;
                                    (<?= pow(-1, $rc7) ?>) \times <?= dspVl($d3) ?> \times
                                    \Big(\;
                                    ( <?= pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * (dspVl($a2) * (gtVl([$d1, $c2]) - gtVl([$d2, $c1]))) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$d1, $a4]) - gtVl([$d2, $a3]))) ?> )
                                    \;\Big)
                                    \;\Big\}\;\; \\
                                    + \\

                                    \;\Big\{\;\;
                                    (<?= pow(-1, $rc8) ?>) \times <?= dspVl($d4) ?> \times
                                    \Big(\;
                                    ( <?= pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2]))) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * (dspVl($a2) * (gtVl([$d1, $b3]) - gtVl([$d2, $b2]))) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * (dspVl($b1) * (gtVl([$d1, $a4]) - gtVl([$d2, $a3]))) ?> )
                                    \;\Big)
                                    \;\Big\}\;\; \\
                                    \;\;\Big]
                                    \)
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 7
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;
                                        \Big(\;
                                        (<?= pow(-1, $rc5) * dspVl($a1) ?>) \times
                                        (<?= pow(-1, 1 + 1) * (dspVl($a2) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) + pow(-1, 2 + 1) * (dspVl($b1) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) + pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2]))) ?>)
                                        \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \Big(\;
                                        (<?= pow(-1, $rc6) * dspVl($c3) ?>) \times
                                        (<?= pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) + pow(-1, 2 + 1) * (dspVl($b1) * (gtVl([$d1, $c2]) - gtVl([$d2, $c1]))) + pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$d1, $b3]) - gtVl([$d2, $b2]))) ?>)
                                        \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \Big(\;
                                        (<?= pow(-1, $rc7) * dspVl($d3) ?>) \times
                                        (<?= pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) + pow(-1, 2 + 1) * (dspVl($a2) * (gtVl([$d1, $c2]) - gtVl([$d2, $c1]))) + pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$d1, $a4]) - gtVl([$d2, $a3]))) ?>)
                                        \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \Big(\;
                                        (<?= pow(-1, $rc8) * dspVl($d4) ?>) \times
                                        (<?= pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2]))) + pow(-1, 2 + 1) * (dspVl($a2) * (gtVl([$d1, $b3]) - gtVl([$d2, $b2]))) + pow(-1, 3 + 1) * (dspVl($b1) * (gtVl([$d1, $a4]) - gtVl([$d2, $a3]))) ?>)
                                        \;\Big)
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 8
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;
                                        \Big(\;
                                        <?= pow(-1, $rc5) * dspVl($a1) * (pow(-1, 1 + 1) * (dspVl($a2) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) + pow(-1, 2 + 1) * (dspVl($b1) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) + pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2])))) ?>
                                        \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \Big(\;
                                        <?= pow(-1, $rc6) * dspVl($c3) * (pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) + pow(-1, 2 + 1) * (dspVl($b1) * (gtVl([$d1, $c2]) - gtVl([$d2, $c1]))) + pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$d1, $b3]) - gtVl([$d2, $b2])))) ?>
                                        \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \Big(\;
                                        <?= pow(-1, $rc7) * dspVl($d3) * (pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) + pow(-1, 2 + 1) * (dspVl($a2) * (gtVl([$d1, $c2]) - gtVl([$d2, $c1]))) + pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$d1, $a4]) - gtVl([$d2, $a3])))) ?>
                                        \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \Big(\;
                                        <?= pow(-1, $rc8) * dspVl($d4) * (pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2]))) + pow(-1, 2 + 1) * (dspVl($a2) * (gtVl([$d1, $b3]) - gtVl([$d2, $b2]))) + pow(-1, 3 + 1) * (dspVl($b1) * (gtVl([$d1, $a4]) - gtVl([$d2, $a3])))) ?>
                                        \;\Big)
                                        \)
                                    </p>
                                    </p>

                                    <?php	}

                                            //Expand along the Rows For 4x4 matrix
                                            function dspFrthRw($rc1,$rc2,$rc3,$rc4,$rc5,$rc6,$rc7,$rc8,$a1,$a2,$a3,$a4,$b1,$b2,$b3,$b4,$c1,$c2,$c3,$c4,$d1,$d2,$d3,$d4,$stepKey) {
                                    ?>
                                    <p class="col s12 font_size20" style="margin-top:30px;">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 1
                                    </p>



                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($b4) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{vmatrix}
                                        \;\Big\}\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($c3) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($c4) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($d2) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?> \\
                                        \end{vmatrix}
                                        \;\Big\}\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($d3) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($c4) ?> & <?= dspVl($a2) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($b1) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($d2) ?> & <?= dspVl($b4) ?> & <?= dspVl($c2) ?> \\
                                        \end{vmatrix}
                                        \;\Big\}\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($d4) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($c4) ?> & <?= dspVl($a2) ?> & <?= dspVl($a3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($b1) ?> & <?= dspVl($b2) ?> \\
                                        <?= dspVl($d2) ?> & <?= dspVl($b4) ?> & <?= dspVl($c1) ?> \\
                                        \end{vmatrix}
                                        \;\Big\}\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 2
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($c3) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($c3) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($d1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($d2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($d3) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b1) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($b4) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($d1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($b4) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($d2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b3) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> \\
                                        <?= dspVl($b4) ?> & <?= dspVl($c1) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($d1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> \\
                                        <?= dspVl($b4) ?> & <?= dspVl($c1) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($d2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 3
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($c2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($c2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($b3) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($c3) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($c2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($d1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($c2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($d2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($b3) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}

                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($d3) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b1) ?> \times <?= dspVl($c2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($b4) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($d1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a2) ?> \times <?= dspVl($c2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($d2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a2) ?> \times <?= dspVl($b3) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(1+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b1) ?> \times <?= dspVl($c1) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($b4) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(2+1)} \times <?= dspVl($d1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a2) ?> \times <?= dspVl($c1) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($b4) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(3+1)} \times <?= dspVl($d2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a2) ?> \times <?= dspVl($b2) ?>\;)
                                        \;-\;
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($b1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]
                                        \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 4
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($a1) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 1 + 1 ?>)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $c2]) - gtVl([$b3, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 2 + 1 ?>)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $c2]) - gtVl([$a4, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 3 + 1 ?>)} \times <?= dspVl($b4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $b3]) - gtVl([$a4, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}

                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc6 ?>)} \times <?= dspVl($c3) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 1 + 1 ?>)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $c2]) - gtVl([$b3, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 2 + 1 ?>)} \times <?= dspVl($d1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $c2]) - gtVl([$a4, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 3 + 1 ?>)} \times <?= dspVl($d2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $b3]) - gtVl([$a4, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc7 ?>)} \times <?= dspVl($d3) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 1 + 1 ?>)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b1, $c2]) - gtVl([$b3, $b4]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 2 + 1 ?>)} \times <?= dspVl($d1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a2, $c2]) - gtVl([$a4, $b4]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 3 + 1 ?>)} \times <?= dspVl($d2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a2, $b3]) - gtVl([$a4, '2_21']) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc8 ?>)} \times <?= dspVl($d4) ?> \times
                                        \;\Big(
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 1 + 1 ?>)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b1, $c1]) - gtVl([$b2, $b4]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 2 + 1 ?>)} \times <?= dspVl($d1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a2, $c1]) - gtVl([$a3, $b4]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        (-1)^{(<?= 3 + 1 ?>)} \times <?= dspVl($d2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a2, $b2]) - gtVl([$a3, $b1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \end{vmatrix}

                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big)\;\Big\}
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big]
                                        \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 5</p>
                                    \(
                                    =\;\Big[\;\; \\
                                    \;\Big\{\;\;
                                    (<?= pow(-1, $rc5) ?>) \times <?= dspVl($a1) ?> \times \\
                                    \Big(\;
                                    ( <?= pow(-1, 1 + 1) * (dspVl($a2) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * (dspVl($b1) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2]))) ?> )
                                    \;\Big)
                                    \;\Big\}\;\; \\
                                    + \\

                                    \;\Big\{\;\;
                                    (<?= pow(-1, $rc6) ?>) \times <?= dspVl($c3) ?> \times \\
                                    \Big(\;
                                    ( <?= pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * (dspVl($d1) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * (dspVl($d2) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2]))) ?> )
                                    \;\Big)
                                    \;\Big\}\;\; \\
                                    + \\

                                    \;\Big\{\;\;
                                    (<?= pow(-1, $rc7) ?>) \times <?= dspVl($d3) ?> \times \\
                                    \Big(\;
                                    ( <?= pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$b1, $c2]) - gtVl([$b3, $b4]))) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * (dspVl($d1) * (gtVl([$a2, $c2]) - gtVl([$a4, $b4]))) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * (dspVl($d2) * (gtVl([$a2, $b3]) - gtVl([$a4, $b1]))) ?> )
                                    \;\Big)
                                    \;\Big\}\;\; \\
                                    + \\

                                    \;\Big\{\;\;
                                    (<?= pow(-1, $rc8) ?>) \times <?= dspVl($d4) ?> \times \\
                                    \Big(\;
                                    ( <?= pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$b1, $c1]) - gtVl([$b2, $b4]))) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * (dspVl($d1) * (gtVl([$a2, $c1]) - gtVl([$a3, $b4]))) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * (dspVl($d2) * (gtVl([$a2, $b2]) - gtVl([$a3, $b1]))) ?> )
                                    \;\Big)
                                    \;\Big\}\;\; \\
                                    \;\;\Big]
                                    \)
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 6
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;
                                        \Big(\;
                                        (<?= pow(-1, $rc5) * dspVl($a1) ?>) \times
                                        (<?= pow(-1, 1 + 1) * (dspVl($a2) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) + pow(-1, 2 + 1) * (dspVl($b1) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) + pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2]))) ?>)
                                        \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \Big(\;
                                        (<?= pow(-1, $rc6) * dspVl($c3) ?>) \times
                                        (<?= pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) + pow(-1, 2 + 1) * (dspVl($d1) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) + pow(-1, 3 + 1) * (dspVl($d2) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2]))) ?>)
                                        \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \Big(\;
                                        (<?= pow(-1, $rc7) * dspVl($d3) ?>) \times
                                        (<?= pow(-1, 1 + 1) * (dspVl($c3) * (gtVl([$b1, $c2]) - gtVl([$b3, $b4]))) + pow(-1, 2 + 1) * (dspVl($a2) * (gtVl([$a2, $c2]) - gtVl([$a4, $b4]))) + pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$a2, $b3]) - gtVl([$a4, $b1]))) ?>)
                                        \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \Big(\;
                                        (<?= pow(-1, $rc8) * dspVl($d4) ?>) \times
                                        (<?= pow(-1, 1 + 1) * (dspVl($c3) * (gtVl([$b1, $c1]) - gtVl([$b2, $b4]))) + pow(-1, 2 + 1) * (dspVl($a2) * (gtVl([$a2, $c1]) - gtVl([$a3, $b4]))) + pow(-1, 3 + 1) * (dspVl($b1) * (gtVl([$a2, $b2]) - gtVl([$a3, $b1]))) ?>)
                                        \;\Big)
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 7
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;
                                        \Big(\;
                                        <?= pow(-1, $rc5) * dspVl($a1) * (pow(-1, 1 + 1) * (dspVl($a2) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) + pow(-1, 2 + 1) * (dspVl($b1) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) + pow(-1, 3 + 1) * (dspVl($b4) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2])))) ?>
                                        \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \Big(\;
                                        <?= pow(-1, $rc6) * dspVl($c3) * (pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) + pow(-1, 2 + 1) * (dspVl($d1) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) + pow(-1, 3 + 1) * (dspVl($d2) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2])))) ?>
                                        \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \Big(\;
                                        <?= pow(-1, $rc7) * dspVl($d3) * (pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$b1, $c2]) - gtVl([$b3, $b4]))) + pow(-1, 2 + 1) * (dspVl($d1) * (gtVl([$a2, $c2]) - gtVl([$a4, $b4]))) + pow(-1, 3 + 1) * (dspVl($d2) * (gtVl([$a2, $b3]) - gtVl([$a4, $b1])))) ?>
                                        \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \Big(\;
                                        <?= pow(-1, $rc8) * dspVl($d4) * (pow(-1, 1 + 1) * (dspVl($c4) * (gtVl([$b1, $c1]) - gtVl([$b2, $b4]))) + pow(-1, 2 + 1) * (dspVl($d1) * (gtVl([$a2, $c1]) - gtVl([$a3, $b4]))) + pow(-1, 3 + 1) * (dspVl($d2) * (gtVl([$a2, $b2]) - gtVl([$a3, $b1])))) ?>
                                        \;\Big)
                                        \)
                                    </p>
                                    </p>
                                    <?php	}

                                            //Expand along the Columns For 5x5 matrix
                                            function dspFifthCl($rc1,$rc2,$rc3,$rc4,$rc5,$rc6,$rc7,$rc8,$rc9,$rc10,$a1,$a2,$a3,$a4,$a5,$b1,$b2,$b3,$b4,$b5,$c1,$c2,$c3,$c4,$c5,$d1,$d2,$d3,$d4,$d5,$e1,$e2,$e3,$e4,$e5,$stepKey) {
                                    ?>
                                    <p class="col s12 font_size20" style="margin-top:30px;">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 1
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($b5) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($c4) ?> & <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big\}\;\; +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($d3) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($d4) ?> & <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($b5) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($c4) ?> & <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big\}\;\; +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($e3) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($d4) ?> & <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b5) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($c4) ?> & <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big\}\;\; +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($e4) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($d4) ?> & <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c4) ?> & <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big\}\;\; +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($e5) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($d4) ?> & <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($b5) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        \end{vmatrix}
                                        \;\Big\}\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \( \;\;\Big] \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 2
                                    </p>
                                    <p class="dtrmn_cols">
                                        \( =\;\Big[\;\; \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \( (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times \;\Big\{\;\; \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\; +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\; +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\; +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        \;\Big\}\;\;
                                        \;\;\Big]\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;(-1)^{(<?= $rc2 ?>)} \times <?= dspVl($d3) ?> \times \;\Big\{\;\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\; +
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{vmatrix}
                                        \;\Big)\;
                                        \;\Big\}\;
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($e3) ?> \times \;\Big\{\;\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($a2) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?>\\
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?>\\
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{vmatrix}
                                        \;\Big)\;
                                        \;\Big\}\;
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($e4) ?> \times \;\Big\{\;\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($a2) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b1) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?>\\
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?>\\
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{vmatrix}
                                        \;\Big)\;
                                        \;\Big\}\;
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($e5) ?> \times \;\Big\{\;\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($a2) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b1) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?>\\
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($b5) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($d5) ?> & <?= dspVl($e1) ?> & <?= dspVl($e2) ?>\\
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{vmatrix}
                                        \;\Big)\;
                                        \;\Big\}\;
                                        \;\;\Big]
                                        \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 3
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \;\Big\{\;\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)\;\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)\;\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)\;\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)\;
                                        \;\Big\}\;
                                        \;\;\Big]\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($d3) ?> \times
                                        \;\Big\{\;\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)\;\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)\;
                                        \;\Big\}\;
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($e3) ?> \times
                                        \;\Big\{\;\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($a2) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)\;
                                        \;\Big\}\;
                                        \;\;\Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($e4) ?> \times
                                        \;\Big\{
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($a2) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b1) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($b2) ?> \t��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������             </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($b5) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($e1) ?> & <?= dspVl($e2) ?> \\
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)\;
                                        \;\Big\}\;
                                        \;\Big]\;
                                        \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 4
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \;\Big\{
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(

                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($d3) ?> \times
                                        \;\Big\{
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($e3) ?> \times
                                        \;\Big\{
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($a2) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($a5) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($a4) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($a5) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($a4) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($e4) ?> \times
                                        \;\Big\{
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($a2) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b1) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($a5) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($a4) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($a5) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($a4) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($e5) ?> \times
                                        \;\Big\{
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($a2) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b1) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($a5) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($a4) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)\;
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($b5) ?> \times
                                        \;\Big(\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($d5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($e1) ?> \times <?= dspVl($a5) ?>\;)\;-\;(\;<?= dspVl($e2) ?> \times
                                        <?= dspVl($a4) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 5
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;
                                        (<?= pow(-1, $rc6) * dspVl($a1) ?>) \times \;
                                        \Big\{\;
                                        \Big(\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times \;
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c2, $d2]) - gtVl([$c3, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $d2]) - gtVl([$b4, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $c3]) - gtVl([$b4, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />

                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b1) ?>) \times \;
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c2, $d2]) - gtVl([$c3, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $d2]) - gtVl([$a5, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $c3]) - gtVl([$a5, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 3 + 1) * dspVl($b5) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $d2]) - gtVl([$b4, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $d2]) - gtVl([$a5, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $b4]) - gtVl([$a5, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 4 + 1) * dspVl($c4) ?>) \times
                                        \;\Big(\;\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $c3]) - gtVl([$b4, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $c3]) - gtVl([$a5, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $b4]) - gtVl([$a5, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;
                                        (<?= pow(-1, $rc7) * dspVl($d3) ?>) \times
                                        \;\Big\{\;
                                        \Big(\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c2, $d2]) - gtVl([$c3, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $d2]) - gtVl([$b4, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $c3]) - gtVl([$b4, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b1) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c2, $d2]) - gtVl([$c3, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $d2]) - gtVl([$e2, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $c3]) - gtVl([$e2, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 3 + 1) * dspVl($b5) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $d2]) - gtVl([$b4, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $d2]) - gtVl([$e2, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $b4]) - gtVl([$e2, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 4 + 1) * dspVl($c4) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $c3]) - gtVl([$b4, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $c3]) - gtVl([$e2, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $b4]) - gtVl([$e2, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;
                                        (<?= pow(-1, $rc8) * dspVl($e3) ?>) \times
                                        \;\Big\{\;
                                        \Big(\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c2, $d2]) - gtVl([$c3, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $d2]) - gtVl([$a5, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $c3]) - gtVl([$a5, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 2 + 1) * dspVl($a2) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c2, $d2]) - gtVl([$c3, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $d2]) - gtVl([$e2, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $c3]) - gtVl([$e2, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 3 + 1) * dspVl($b5) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $d2]) - gtVl([$a5, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $d2]) - gtVl([$e2, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $a5]) - gtVl([$e2, $a4]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 4 + 1) * dspVl($c4) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $c3]) - gtVl([$a5, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $c3]) - gtVl([$e2, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $a5]) - gtVl([$e2, $a4]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;
                                        (<?= pow(-1, $rc9) * dspVl($e4) ?>) \times
                                        \;\Big\{\;
                                        \Big(\;\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $d2]) - gtVl([$b4, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $d2]) - gtVl([$a5, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $b4]) - gtVl([$a5, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 2 + 1) * dspVl($a2) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $d2]) - gtVl([$b4, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $d2]) - gtVl([$e2, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $b4]) - gtVl([$e2, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 3 + 1) * dspVl($b1) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $d2]) - gtVl([$a5, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $d2]) - gtVl([$e2, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $a5]) - gtVl([$e2, $a4]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 4 + 1) * dspVl($c4) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $b4]) - gtVl([$a5, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $b4]) - gtVl([$e2, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $a5]) - gtVl([$e2, $a4]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;
                                        (<?= pow(-1, $rc10) * dspVl($e5) ?>) \times
                                        \;\Big\{\;
                                        \Big(\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $c3]) - gtVl([$b4, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $c3]) - gtVl([$a5, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $b4]) - gtVl([$a5, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 2 + 1) * dspVl($a2) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $c3]) - gtVl([$b4, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $c3]) - gtVl([$e2, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $b4]) - gtVl([$e2, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 3 + 1) * dspVl($b1) ?>) \times
                                        \;\Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $c3]) - gtVl([$a5, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $c3]) - gtVl([$e2, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $a5]) - gtVl([$e2, $a4]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 4 + 1) * dspVl($b5) ?>) \times
                                        \;\Big(\;\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $b4]) - gtVl([$a5, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $b4]) - gtVl([$e2, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$e1, $a5]) - gtVl([$e2, $a4]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 6
                                    </p>
                                    \(
                                    =\;\Big[\;\;
                                    (<?= pow(-1, $rc6) * dspVl($a1) ?>) \times
                                    \;\Big\{\\
                                    \Big(
                                    (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($b2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) ?> )
                                    )
                                    \Big) \\
                                    +
                                    \Big(
                                    (<?= pow(-1, 2 + 1) * dspVl($b1) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) ?> )
                                    )
                                    \Big) \\
                                    +
                                    \Big(
                                    (<?= pow(-1, 3 + 1) * dspVl($b5) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) ?> )
                                    )
                                    \Big) \\
                                    +
                                    \Big(
                                    (<?= pow(-1, 4 + 1) * dspVl($c4) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) ?> )
                                    )
                                    \Big) \\
                                    \Big\}
                                    \Big] \\

                                    + \\

                                    \Big[\;\;
                                    (<?= pow(-1, $rc7) * dspVl($d3) ?>) \times
                                    \;\Big\{\\
                                    \Big(
                                    (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($b2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) ?> )
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 2 + 1) * dspVl($b1) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2])) ?> )
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 3 + 1) * dspVl($b5) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3])) ?> )
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 4 + 1) * dspVl($c4) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3])) ?> )
                                    )
                                    \Big)\\
                                    \Big\}
                                    \Big]\\

                                    + \\

                                    \Big[\;\;
                                    (<?= pow(-1, $rc8) * dspVl($e3) ?>) \times
                                    \;\Big\{\\
                                    \Big(
                                    (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) ?> )
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 2 + 1) * dspVl($a2) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2])) ?> )
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 3 + 1) * dspVl($b5) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($a3) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $a5]) - gtVl([$e2, $a4])) ?> )
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 4 + 1) * dspVl($c4) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($a3) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$e1, $a5]) - gtVl([$e2, $a4])) ?> )
                                    )
                                    \Big)\\
                                    \Big\}
                                    \Big]\\

                                    + \\

                                    \Big[\;\;
                                    (<?= pow(-1, $rc9) * dspVl($e4) ?>) \times
                                    \;\Big\{\\
                                    \Big(
                                    (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) ?> )
                                    )
                                    \Big) \\
                                    +
                                    \Big(
                                    (<?= pow(-1, 2 + 1) * dspVl($a2) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3])) ?> )
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 3 + 1) * dspVl($b1) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($a3) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $a5]) - gtVl([$e2, $a4])) ?> )
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 4 + 1) * dspVl($c4) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($a3) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($b2) * (gtVl([$e1, $a5]) - gtVl([$e2, $a4])) ?> )
                                    )
                                    \Big)\\
                                    \Big\}
                                    \Big]\\

                                    + \\

                                    \Big[\;\;
                                    (<?= pow(-1, $rc10) * dspVl($e5) ?>) \times
                                    \;\Big\{\\
                                    \Big(
                                    (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) ?> )
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 2 + 1) * dspVl($a2) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3])) ?> )
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 3 + 1) * dspVl($b1) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($a3) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$e1, $a5]) - gtVl([$e2, $a4])) ?> )
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 4 + 1) * dspVl($b5) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($a3) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($b2) * (gtVl([$e1, $a5]) - gtVl([$e2, $a4])) ?> )
                                    )
                                    \Big)\\
                                    \Big\}
                                    \Big]\\

                                    \)
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 7
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        (<?= pow(-1, $rc6) * dspVl($a1) ?>)
                                        \times
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) * (pow(-1, 1 + 1) * dspVl($b2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2]))) + pow(-1, 2 + 1) * dspVl($b1) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2]))) + pow(-1, 3 + 1) * dspVl($b5) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) + pow(-1, 4 + 1) * dspVl($c4) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) + pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) ?>)
                                        \;\;\Big]\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \;\Big[\;\;
                                        (<?= pow(-1, $rc7) * dspVl($d3) ?>)
                                        \times
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($b2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2]))) + pow(-1, 2 + 1) * dspVl($b1) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2]))) + pow(-1, 3 + 1) * dspVl($b5) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3]))) + pow(-1, 4 + 1) * dspVl($c4) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2])) + pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3]))) ?>)
                                        \;\;\Big]\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \;\Big[\;\;
                                        (<?= pow(-1, $rc8) * dspVl($e3) ?>)
                                        \times
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2]))) + pow(-1, 2 + 1) * dspVl($a2) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2]))) + pow(-1, 3 + 1) * dspVl($b5) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 2 + 1) * dspVl($a3) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $a5]) - gtVl([$e2, $a4]))) + pow(-1, 4 + 1) * dspVl($c4) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) + pow(-1, 2 + 1) * dspVl($a3) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2])) + pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$e1, $a5]) - gtVl([$e2, $a4]))) ?>)
                                        \;\;\Big]\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \;\Big[\;\;
                                        (<?= pow(-1, $rc9) * dspVl($e4) ?>)
                                        \times
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) + pow(-1, 2 + 1) * dspVl($a2) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3]))) + pow(-1, 3 + 1) * dspVl($b1) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 2 + 1) * dspVl($a3) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $a5]) - gtVl([$e2, $a4]))) + pow(-1, 4 + 1) * dspVl($c4) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) + pow(-1, 2 + 1) * dspVl($a3) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3])) + pow(-1, 3 + 1) * dspVl($b2) * (gtVl([$e1, $a5]) - gtVl([$e2, $a4]))) ?>)
                                        \;\;\Big]\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \;\Big[\;\;
                                        (<?= pow(-1, $rc10) * dspVl($e5) ?>)
                                        \times
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) + pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) + pow(-1, 2 + 1) * dspVl($a2) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2])) + pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3]))) + pow(-1, 3 + 1) * dspVl($b1) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) + pow(-1, 2 + 1) * dspVl($a3) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2])) + pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$e1, $a5]) - gtVl([$e2, $a4]))) + pow(-1, 4 + 1) * dspVl($b5) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) + pow(-1, 2 + 1) * dspVl($a3) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3])) + pow(-1, 3 + 1) * dspVl($b2) * (gtVl([$e1, $a5]) - gtVl([$e2, $a4]))) ?>)
                                        \;\;\Big]\;
                                        \)
                                    </p>

                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 8
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        <?= pow(-1, $rc6) *
                                dspVl($a1) *
                                (pow(-1, 1 + 1) * dspVl($a2) * (pow(-1, 1 + 1) * dspVl($b2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2]))) + pow(-1, 2 + 1) * dspVl($b1) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2]))) + pow(-1, 3 + 1) * dspVl($b5) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) + pow(-1, 4 + 1) * dspVl($c4) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) + pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])))) ?>
                                        \;\;\Big]\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        \;\Big[\;\;
                                        <?= pow(-1, $rc7) *
                                dspVl($d3) *
                                (pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($b2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2]))) + pow(-1, 2 + 1) * dspVl($b1) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2]))) + pow(-1, 3 + 1) * dspVl($b5) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$e1, $d2]) - gtVl([$e2, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3]))) + pow(-1, 4 + 1) * dspVl($c4) * (pow(-1, 1 + 1) * dspVl($d5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$e1, $c3]) - gtVl([$e2, $c2])) + pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$e1, $b4]) - gtVl([$e2, $b3])))) ?>
                                        \;\;\Big]\;
                                        \)
                                    </p>
                       ��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������                                  \end{vmatrix}
                                        \;\Big\}\;\;
                                        +
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($e4) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($d4) ?> & <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($d5) ?> & <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($e1) ?> & <?= dspVl($b5) ?> & <?= dspVl($c1) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($e2) ?> & <?= dspVl($c4) ?> & <?= dspVl($c5) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big\}\;\; +
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big\{\;\;
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($e5) ?> \times
                                        \begin{vmatrix}
                                        <?= dspVl($d4) ?> & <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($d5) ?> & <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($e1) ?> & <?= dspVl($b5) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?> \\
                                        <?= dspVl($e2) ?> & <?= dspVl($c4) ?> & <?= dspVl($c5) ?> & <?= dspVl($d1) ?> \\
                                        \end{vmatrix}
                                        \;\Big\}\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\;\Big]
                                        \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 2
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \;\Big\{\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        \;\Big\}\;\;
                                        \;\;\Big]\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($d3) ?> \times
                                        \;\Big\{\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($d5) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($e1) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($e2) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        \;\Big\}\;\;
                                        \;\;\Big]\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($e3) ?> \times
                                        \;\Big\{\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($b1) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($b5) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c4) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($d5) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b5) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c4) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($e1) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b1) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c4) ?> & <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($e2) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a4) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b1) ?> & <?= dspVl($b3) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($b5) ?> & <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{vmatrix}
                                        \;\Big)
                                        \;\Big\}
                                        \;\Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($e4) ?> \times
                                        \;\Big\{\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($b5) ?> & <?= dspVl($c1) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c4) ?> & <?= dspVl($c5) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($d5) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b5) ?> & <?= dspVl($c1) ?> & <?= dspVl($c3) ?>\\
                                        <?= dspVl($c4) ?> & <?= dspVl($c5) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($e1) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($c4) ?> & <?= dspVl($c5) ?> & <?= dspVl($d2) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($e2) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a5) ?>\\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b4) ?>\\
                                        <?= dspVl($b5) ?> & <?= dspVl($c1) ?> & <?= dspVl($c3) ?>
                                        \end{vmatrix}
                                        \;\Big)
                                        \;\Big\}
                                        \;\Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($e5) ?> \times
                                        \;\Big\{\;\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?>\\
                                        <?= dspVl($b5) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?>\\
                                        <?= dspVl($c4) ?> & <?= dspVl($c5) ?> & <?= dspVl($d1) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($d5) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?>\\
                                        <?= dspVl($b5) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?>\\
                                        <?= dspVl($c4) ?> & <?= dspVl($c5) ?> & <?= dspVl($d1) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($e1) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?>\\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?>\\
                                        <?= dspVl($c4) ?> & <?= dspVl($c5) ?> & <?= dspVl($d1) ?>
                                        \end{vmatrix}
                                        \;\Big)\;\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($e2) ?> \times
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \begin{vmatrix}
                                        <?= dspVl($a2) ?> & <?= dspVl($a3) ?> & <?= dspVl($a4) ?>\\
                                        <?= dspVl($b1) ?> & <?= dspVl($b2) ?> & <?= dspVl($b3) ?>\\
                                        <?= dspVl($b5) ?> & <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{vmatrix}
                                        \;\Big)
                                        \;\Big\}
                                        \;\Big]
                                        \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 3
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \;\Big\{\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($d3) ?> \times
                                        \;\Big\{\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($d5) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($e1) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($e2) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($e3) ?> \times
                                        \;\Big\{\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($d5) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($e1) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($d1) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($e2) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c2) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a4) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b3) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($e4) ?> \times
                                        \;\Big\{\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c1) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($c5) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c5) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($d5) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c1) ?> & <?= dspVl($c3) ?> \\
                                        <?= dspVl($c5) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c5) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($e1) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c5) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c5) ?> & <?= dspVl($d2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b2) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($e2) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b4) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a5) ?> \\
                                        <?= dspVl($b2) ?> & <?= dspVl($b4) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($e5) ?> \times
                                        \;\Big\{\;
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> \\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(2+1)} \times <?= dspVl($d5) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?> \\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(3+1)} \times <?= dspVl($e1) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($c5) ?> & <?= dspVl($d1) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (-1)^{(4+1)} \times <?= dspVl($e2) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(

                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($c1) ?> & <?= dspVl($c2) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        <?= dspVl($a3) ?> & <?= dspVl($a4) ?> \\
                                        <?= dspVl($b2) ?> & <?= dspVl($b3) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 4
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        (-1)^{(<?= $rc1 ?>)} \times <?= dspVl($a1) ?> \times
                                        \;\Big\{
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(4+1)} \times <?= dspVl($c4) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc2 ?>)} \times <?= dspVl($d3) ?> \times
                                        \;\Big\{
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(2+1)} \times <?= dspVl($d5) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(3+1)} \times <?= dspVl($e1) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(4+1)} \times <?= dspVl($e2) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a3) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc3 ?>)} \times <?= dspVl($e3) ?> \times
                                        \;\Big\{
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(2+1)} \times <?= dspVl($d5) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(3+1)} \times <?= dspVl($e1) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($d1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(4+1)} \times <?= dspVl($e2) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a4) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b3) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc4 ?>)} \times <?= dspVl($e4) ?> \times
                                        \;\Big\{
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c1) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($c5) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c5) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(2+1)} \times <?= dspVl($d5) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c1) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($c3) ?> \times
                                        <?= dspVl($c5) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c5) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(3+1)} \times <?= dspVl($e1) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c5) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($d2) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c5) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(4+1)} \times <?= dspVl($e2) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($b4) ?> \times
                                        <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($c3) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($b4) ?>\;)\;-\;(\;<?= dspVl($a5) ?> \times
                                        <?= dspVl($b2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (-1)^{(<?= $rc5 ?>)} \times <?= dspVl($e5) ?> \times
                                        \;\Big\{
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big(\;
                                        (-1)^{(1+1)} \times <?= dspVl($d4) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c1) ?> \times <?= dspVl($d1) ?>\;)\;-\;(\;<?= dspVl($c2) ?> \times
                                        <?= dspVl($c5) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($d1) ?>\;)\;-\;(\;<?= dspVl($b3) ?> \times
                                        <?= dspVl($c5) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($c2) ?>\;)\;-\;(\;<?= dspVl($b3) ?> \times
                                        <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(2+1)} \times <?= dspVl($d5) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($c1) ?> \times <?= dspVl($d1) ?>\;)\;-\;(\;<?= dspVl($c2) ?> \times
                                        <?= dspVl($c5) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($d1) ?>\;)\;-\;(\;<?= dspVl($a4) ?> \times
                                        <?= dspVl($c5) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($c2) ?>\;)\;-\;(\;<?= dspVl($a4) ?> \times
                                        <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(3+1)} \times <?= dspVl($e1) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($d1) ?>\;)\;-\;(\;<?= dspVl($b3) ?> \times
                                        <?= dspVl($c5) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($d1) ?>\;)\;-\;(\;<?= dspVl($a4) ?> \times
                                        <?= dspVl($c5) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($c4) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($b3) ?>\;)\;-\;(\;<?= dspVl($a4) ?> \times
                                        <?= dspVl($b2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (-1)^{(4+1)} \times <?= dspVl($e2) ?> \times
                                        \Big(\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(1+1)} \times <?= dspVl($a2) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($b2) ?> \times <?= dspVl($c2) ?>\;)\;-\;(\;<?= dspVl($b3) ?> \times
                                        <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(2+1)} \times <?= dspVl($b1) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($c2) ?>\;)\;-\;(\;<?= dspVl($a4) ?> \times
                                        <?= dspVl($c1) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (-1)^{(3+1)} \times <?= dspVl($b5) ?> \times
                                        \bigl(\begin{smallmatrix}
                                        (\;<?= dspVl($a3) ?> \times <?= dspVl($b3) ?>\;)\;-\;(\;<?= dspVl($a4) ?> \times
                                        <?= dspVl($b2) ?>\;)
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 5
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;
                                        (<?= pow(-1, $rc6) * dspVl($a1) ?>) \times
                                        \;\Big\{\;
                                        \Big(\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c2, $d2]) - gtVl([$c3, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $d2]) - gtVl([$b4, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $c3]) - gtVl([$b4, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b1) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c2, $d2]) - gtVl([$c3, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $d2]) - gtVl([$a5, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $c3]) - gtVl([$a5, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 3 + 1) * dspVl($b5) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $d2]) - gtVl([$b4, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $d2]) - gtVl([$a5, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $b4]) - gtVl([$a5, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 4 + 1) * dspVl($c4) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $c3]) - gtVl([$b4, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $c3]) - gtVl([$a5, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $b4]) - gtVl([$a5, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;\;
                                        (<?= pow(-1, $rc7) * dspVl($d3) ?>) \times
                                        \;\Big\{\;
                                        \Big(\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c2, $d2]) - gtVl([$c3, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $d2]) - gtVl([$b4, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $c3]) - gtVl([$b4, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 2 + 1) * dspVl($d5) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c2, $d2]) - gtVl([$c3, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $d2]) - gtVl([$a5, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $c3]) - gtVl([$a5, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 3 + 1) * dspVl($e1) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $d2]) - gtVl([$b4, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $d2]) - gtVl([$a5, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $b4]) - gtVl([$a5, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 4 + 1) * dspVl($e2) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a3) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $c3]) - gtVl([$b4, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $c3]) - gtVl([$a5, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $b4]) - gtVl([$a5, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;
                                        (<?= pow(-1, 3 + 1) * dspVl($e3) ?>) \times
                                        \;\Big\{\;
                                        \Big(\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($b1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c2, $d2]) - gtVl([$c3, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $d2]) - gtVl([$b4, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c4) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $c3]) - gtVl([$b4, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 2 + 1) * dspVl($d5) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c2, $d2]) - gtVl([$c3, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $d2]) - gtVl([$a5, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c4) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $c3]) - gtVl([$a5, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 3 + 1) * dspVl($e1) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $d2]) - gtVl([$b4, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $d2]) - gtVl([$a5, $d1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c4) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $b4]) - gtVl([$a5, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 4 + 1) * dspVl($e2) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b3, $c3]) - gtVl([$b4, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $c3]) - gtVl([$a5, $c2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($b5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a4, $b4]) - gtVl([$a5, $b3]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;
                                        (<?= pow(-1, 4 + 1) * dspVl($e4) ?>) \times
                                        \;\Big\{\;
                                        \Big(\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($b1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c1, $d2]) - gtVl([$c3, $c5]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $d2]) - gtVl([$b4, $c5]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c4) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $c3]) - gtVl([$b4, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 2 + 1) * dspVl($d5) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c1, $d2]) - gtVl([$c3, $c5]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $d2]) - gtVl([$a5, $c5]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c4) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $c3]) - gtVl([$a5, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 3 + 1) * dspVl($e1) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $d2]) - gtVl([$b4, $c5]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $d2]) - gtVl([$a5, $c5]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c4) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $b4]) - gtVl([$a5, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 4 + 1) * dspVl($e2) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $c3]) - gtVl([$b4, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $c3]) - gtVl([$a5, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($b5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $b4]) - gtVl([$a5, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \Big[\;
                                        (<?= pow(-1, 5 + 1) * dspVl($e5) ?>) \times
                                        \;\Big\{\;
                                        \Big(\;
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($b1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c1, $d1]) - gtVl([$c2, $c5]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $d1]) - gtVl([$b3, $c5]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c4) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $c2]) - gtVl([$b3, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 2 + 1) * dspVl($d5) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$c1, $d1]) - gtVl([$c2, $c5]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $d1]) - gtVl([$a4, $c5]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c4) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $c2]) - gtVl([$a4, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;\;
                                        (<?= pow(-1, 3 + 1) * dspVl($e1) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $d1]) - gtVl([$b3, $c5]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $d1]) - gtVl([$a4, $c5]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($c4) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $b3]) - gtVl([$a4, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;\Big)
                                        \;\Big)
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        +
                                        \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big(\;
                                        (<?= pow(-1, 4 + 1) * dspVl($e2) ?>) \times
                                        \Big(\;
                                        (\;
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$b2, $c2]) - gtVl([$b3, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;
                                        (<?= pow(-1, 2 + 1) * dspVl($b1) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $c2]) - gtVl([$a4, $c1]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \;+\;
                                        (\;
                                        (<?= pow(-1, 3 + 1) * dspVl($b5) ?>) \times
                                        \bigl(\begin{smallmatrix}
                                        <?= gtVl([$a3, $b3]) - gtVl([$a4, $b2]) ?>
                                        \end{smallmatrix}\bigr)
                                        \;)
                                        \Big)
                                        \Big)
                                        \Big\}
                                        \Big]
                                        \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 6
                                    </p>
                                    \(
                                    =\;\Big[\;\;
                                    (<?= pow(-1, $rc6) * dspVl($a1) ?>) \times
                                    \;\Big\{\\
                                    \Big(
                                    (<?= pow(-1, 1 + 1) * dspVl($a2) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($b2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 2 + 1) * dspVl($b1) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 3 + 1) * dspVl($b5) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 4 + 1) * dspVl($c4) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) ?>)
                                    )
                                    \Big)\\
                                    \Big\}
                                    \Big]\\

                                    + \\

                                    \Big[\;\;
                                    (<?= pow(-1, $rc7) * dspVl($d3) ?>) \times
                                    \;\Big\{\\
                                    \Big(
                                    (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($b2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 2 + 1) * dspVl($d5) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 3 + 1) * dspVl($e1) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 4 + 1) * dspVl($e2) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) ?>)
                                    )
                                    \Big)\\
                                    \Big\}
                                    \Big]\\

                                    + \\

                                    \Big[\;\;
                                    (<?= pow(-1, $rc8) * dspVl($e3) ?>) \times
                                    \;\Big\{\\
                                    \Big(
                                    (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($b1) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 2 + 1) * dspVl($d5) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 3 + 1) * dspVl($e1) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 4 + 1) * dspVl($e2) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($b5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])) ?>)
                                    )
                                    \Big)\\
                                    \Big\}
                                    \Big]\\

                                    + \\

                                    \Big[\;\;
                                    (<?= pow(-1, $rc9) * dspVl($e4) ?>) \times
                                    \;\Big\{\\
                                    \Big(
                                    (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($b1) * (gtVl([$c1, $d2]) - gtVl([$c3, $c5])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$b2, $d2]) - gtVl([$b4, $c5])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$b2, $c3]) - gtVl([$b4, $c1])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 2 + 1) * dspVl($d5) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$c1, $d2]) - gtVl([$c3, $c5])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$a3, $d2]) - gtVl([$a5, $c5])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a3, $c3]) - gtVl([$a5, $c1])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 3 + 1) * dspVl($e1) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b2, $d2]) - gtVl([$b4, $c5])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a3, $d2]) - gtVl([$a5, $c5])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a3, $b4]) - gtVl([$a5, $b2])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 4 + 1) * dspVl($e2) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b2, $c3]) - gtVl([$b4, $c1])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a3, $c3]) - gtVl([$a5, $c1])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($b5) * (gtVl([$a3, $b4]) - gtVl([$a5, $b2])) ?>)
                                    )
                                    \Big)\\
                                    \Big\}
                                    \Big]\\

                                    + \\

                                    \Big[\;\;
                                    (<?= pow(-1, $rc10) * dspVl($e5) ?>) \times
                                    \;\Big\{\\
                                    \Big(
                                    (<?= pow(-1, 1 + 1) * dspVl($d4) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($b1) * (gtVl([$c1, $d1]) - gtVl([$c2, $c5])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$b2, $d1]) - gtVl([$b3, $c5])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 2 + 1) * dspVl($d5) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$c1, $d1]) - gtVl([$c2, $c5])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$a3, $d1]) - gtVl([$a4, $c5])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 3 + 1) * dspVl($e1) ?>) \times
                                    (
                                    (<?= pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b2, $d1]) - gtVl([$b3, $c5])) ?>)
                                    +
                                    (<?= pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a3, $d1]) - gtVl([$a4, $c5])) ?>)
                                    +
                                    (<?= pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2])) ?>)
                                    )
                                    \Big)\\
                                    +
                                    \Big(
                                    (<?= pow(-1, 4 + 1) * dspVl($e2) ?>) \times
                                    (
                                    ( <?= pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1])) ?> )
                                    +
                                    ( <?= pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1])) ?> )
                                    +
                                    ( <?= pow(-1, 3 + 1) * dspVl($b5) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2])) ?> )
                                    )
                                    \Big)\\
                                    \Big\}
                                    \Big]\\
                                    \)
                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 7
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        (<?= pow(-1, $rc6) * dspVl($a1) ?>)
                                        \times
                                        (<?= pow(-1, 1 + 1) * dspVl($a2) * (pow(-1, 1 + 1) * dspVl($b2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2]))) + pow(-1, 2 + 1) * dspVl($b1) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2]))) + pow(-1, 3 + 1) * dspVl($b5) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) + pow(-1, 4 + 1) * dspVl($c4) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) + pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) ?>)
                                        \;\;\Big]\;
                                        +
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big[\;\;
                                        (<?= pow(-1, $rc7) * dspVl($d3) ?>)
                                        \times
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($b2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2]))) + pow(-1, 2 + 1) * dspVl($d5) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2]))) + pow(-1, 3 + 1) * dspVl($e1) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) + pow(-1, 4 + 1) * dspVl($e2) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) + pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) ?>)
                                        \;\;\Big]\;
                                        +
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big[\;\;
                                        (<?= pow(-1, $rc8) * dspVl($e3) ?>)
                                        \times
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($b1) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2]))) + pow(-1, 2 + 1) * dspVl($d5) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2]))) + pow(-1, 3 + 1) * dspVl($e1) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) + pow(-1, 4 + 1) * dspVl($e2) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) + pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) + pow(-1, 3 + 1) * dspVl($b5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) ?>)
                                        \;\;\Big]\;
                                        +
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big[\;\;
                                        (<?= pow(-1, $rc9) * dspVl($e4) ?>)
                                        \times
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($b1) * (gtVl([$c1, $d2]) - gtVl([$c3, $c5])) + pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$b2, $d2]) - gtVl([$b4, $c5])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$b2, $c3]) - gtVl([$b4, $c1]))) + pow(-1, 2 + 1) * dspVl($d5) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$c1, $d2]) - gtVl([$c3, $c5])) + pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$a3, $d2]) - gtVl([$a5, $c5])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a3, $c3]) - gtVl([$a5, $c1]))) + pow(-1, 3 + 1) * dspVl($e1) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b2, $d2]) - gtVl([$b4, $c5])) + pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a3, $d2]) - gtVl([$a5, $c5])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a3, $b4]) - gtVl([$a5, $b2]))) + pow(-1, 4 + 1) * dspVl($e2) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b2, $c3]) - gtVl([$b4, $c1])) + pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a3, $c3]) - gtVl([$a5, $c1])) + pow(-1, 3 + 1) * dspVl($b5) * (gtVl([$a3, $b4]) - gtVl([$a5, $b2]))) ?>)
                                        \;\;\Big]\;
                                        +
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big[\;\;
                                        (<?= pow(-1, $rc10) * dspVl($e5) ?>)
                                        \times
                                        (<?= pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($b1) * (gtVl([$c1, $d1]) - gtVl([$c2, $c5])) + pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$b2, $d1]) - gtVl([$b3, $c5])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) + pow(-1, 2 + 1) * dspVl($d5) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$c1, $d1]) - gtVl([$c2, $c5])) + pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$a3, $d1]) - gtVl([$a4, $c5])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) + pow(-1, 3 + 1) * dspVl($e1) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b2, $d1]) - gtVl([$b3, $c5])) + pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a3, $d1]) - gtVl([$a4, $c5])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2]))) + pow(-1, 4 + 1) * dspVl($e2) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1])) + pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1])) + pow(-1, 3 + 1) * dspVl($b5) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2]))) ?>)
                                        \;\;\Big]\;
                                        \)
                                    </p>

                                    </p>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">
                                        <?= $stepKey ?> : 8
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;\Big[\;\;
                                        <?= pow(-1, $rc6) *
                                dspVl($a1) *
                                (pow(-1, 1 + 1) * dspVl($a2) * (pow(-1, 1 + 1) * dspVl($b2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2]))) + pow(-1, 2 + 1) * dspVl($b1) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2]))) + pow(-1, 3 + 1) * dspVl($b5) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) + pow(-1, 4 + 1) * dspVl($c4) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) + pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])))) ?>
                                        \;\;\Big]\;
                                        +
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big[\;\;
                                        <?= pow(-1, $rc7) *
                                dspVl($d3) *
                                (pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($b2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2]))) + pow(-1, 2 + 1) * dspVl($d5) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($c1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2]))) + pow(-1, 3 + 1) * dspVl($e1) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) + pow(-1, 4 + 1) * dspVl($e2) * (pow(-1, 1 + 1) * dspVl($a3) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) + pow(-1, 2 + 1) * dspVl($b2) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) + pow(-1, 3 + 1) * dspVl($c1) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])))) ?>
                                        \;\;\Big]\;
                                        +
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big[\;\;
                                        <?= pow(-1, $rc8) *
                                dspVl($e3) *
                                (pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($b1) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2]))) + pow(-1, 2 + 1) * dspVl($d5) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$c2, $d2]) - gtVl([$c3, $d1])) + pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2]))) + pow(-1, 3 + 1) * dspVl($e1) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b3, $d2]) - gtVl([$b4, $d1])) + pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a4, $d2]) - gtVl([$a5, $d1])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3]))) + pow(-1, 4 + 1) * dspVl($e2) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b3, $c3]) - gtVl([$b4, $c2])) + pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a4, $c3]) - gtVl([$a5, $c2])) + pow(-1, 3 + 1) * dspVl($b5) * (gtVl([$a4, $b4]) - gtVl([$a5, $b3])))) ?>
                                        \;\;\Big]\;
                                        +
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big[\;\;
                                        <?= pow(-1, $rc9) *
                                dspVl($e4) *
                                (pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($b1) * (gtVl([$c1, $d2]) - gtVl([$c3, $c5])) + pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$b2, $d2]) - gtVl([$b4, $c5])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$b2, $c3]) - gtVl([$b4, $c1]))) + pow(-1, 2 + 1) * dspVl($d5) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$c1, $d2]) - gtVl([$c3, $c5])) + pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$a3, $d2]) - gtVl([$a5, $c5])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a3, $c3]) - gtVl([$a5, $c1]))) + pow(-1, 3 + 1) * dspVl($e1) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b2, $d2]) - gtVl([$b4, $c5])) + pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a3, $d2]) - gtVl([$a5, $c5])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a3, $b4]) - gtVl([$a5, $b2]))) + pow(-1, 4 + 1) * dspVl($e2) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b2, $c3]) - gtVl([$b4, $c1])) + pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a3, $c3]) - gtVl([$a5, $c1])) + pow(-1, 3 + 1) * dspVl($b5) * (gtVl([$a3, $b4]) - gtVl([$a5, $b2])))) ?>
                                        \;\;\Big]\;
                                        +
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;\Big[\;\;
                                        <?= pow(-1, $rc10) *
                                dspVl($e5) *
                                (pow(-1, 1 + 1) * dspVl($d4) * (pow(-1, 1 + 1) * dspVl($b1) * (gtVl([$c1, $d1]) - gtVl([$c2, $c5])) + pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$b2, $d1]) - gtVl([$b3, $c5])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1]))) + pow(-1, 2 + 1) * dspVl($d5) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$c1, $d1]) - gtVl([$c2, $c5])) + pow(-1, 2 + 1) * dspVl($b5) * (gtVl([$a3, $d1]) - gtVl([$a4, $c5])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1]))) + pow(-1, 3 + 1) * dspVl($e1) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b2, $d1]) - gtVl([$b3, $c5])) + pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a3, $d1]) - gtVl([$a4, $c5])) + pow(-1, 3 + 1) * dspVl($c4) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2]))) + pow(-1, 4 + 1) * dspVl($e2) * (pow(-1, 1 + 1) * dspVl($a2) * (gtVl([$b2, $c2]) - gtVl([$b3, $c1])) + pow(-1, 2 + 1) * dspVl($b1) * (gtVl([$a3, $c2]) - gtVl([$a4, $c1])) + pow(-1, 3 + 1) * dspVl($b5) * (gtVl([$a3, $b3]) - gtVl([$a4, $b2])))) ?>
                                        \;\;\Big]\;
                                        \)
                                    </p>
                                    </p>
                                    <?php	}
                    
                                        if ($_POST['dtrmn_slct_method']=='2') { //Showing calculation of 2 x 2 Matrix

                                            if ($_POST['dtrmn_opts_method']=='leibniz') { //Using Leibniz method

                                        ?>
                                    <p class="col s12 font_size16">
                                        \(
                                        det
                                        \begin{vmatrix}
                                        <?= dspVl('0_0') ?> & <?= dspVl('0_1') ?> \\
                                        <?= dspVl('1_0') ?> & <?= dspVl('1_1') ?>
                                        \end{vmatrix} \\
                                        \)
                                    </p>

                                    <p class="col s12 font_size16">
                                        \(
                                        \;=\; ( <?= dspVl('0_0') ?> \times <?= dspVl('1_1') ?> ) - ( <?= dspVl('0_1') ?> \times
                                        <?= dspVl('1_0') ?> )
                                        \)
                                    </p>

                                    <p class="col s12 font_size16">
                                        \(
                                        \;=\; <?= $detail['ans'] ?>
                                        \)
                                    </p>

                                    <?php

                                            } elseif ($_POST['dtrmn_opts_method']=='exp_col' || $_POST['dtrmn_opts_method']=='exp_row') { //Using Expand along the columns Or Rows method

                                                ?>
                                    <p class="col s12 font_size16">
                                        \(
                                        det
                                        \begin{vmatrix}
                                        <?= dspVl('0_0') ?> & <?= dspVl('0_1') ?> \\
                                        <?= dspVl('1_0') ?> & <?= dspVl('1_1') ?>
                                        \end{vmatrix} \\
                                        \)
                                    </p>

                                    <p class="col s12 font_size16">
                                        \(
                                        \;=\; <?= $detail['ans'] ?>
                                        \)
                                    </p>

                                    <?php

                                            }

                                        } elseif ($_POST['dtrmn_slct_method']=='3') { //Showing calculation of 3 x 3 Matrix

                                            if ($_POST['dtrmn_opts_method']=='leibniz') { //Using Leibniz method

                                                ?>

                                    <p class="col s12 font_size16">
                                        \(
                                        det
                                        \begin{vmatrix}
                                        <?= dspVl('0_0') ?> & <?= dspVl('0_1') ?> & <?= dspVl('0_2') ?> \\
                                        <?= dspVl('1_0') ?> & <?= dspVl('1_1') ?> & <?= dspVl('1_2') ?> \\
                                        <?= dspVl('2_0') ?> & <?= dspVl('2_1') ?> & <?= dspVl('2_2') ?>
                                        \end{vmatrix} \\
                                        \)
                                    </p>






                                    <p class="col s12 font_size16">


                                    <p class="dtrmn_cols">
                                        \(
                                        \;=\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_2') ?> )
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_0') ?> )
                                        \)
                                    </p>
                                    </p>

                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        =\; <?= $detail['ans'] ?>
                                        \)
                                    </p>
                                    </p>

                                    <?php
                    
                                            } elseif ($_POST['dtrmn_opts_method']=='exp_col') { //Using Expand along the columns method
                                        ?>
                                    <p class="col s12 font_size14" style="margin:15px 0;">
                                        \(
                                        det
                                        \begin{vmatrix}
                                        <?= dspVl('0_0') ?> & <?= dspVl('0_1') ?> & <?= dspVl('0_2') ?> \\
                                        <?= dspVl('1_0') ?> & <?= dspVl('1_1') ?> & <?= dspVl('1_2') ?> \\
                                        <?= dspVl('2_0') ?> & <?= dspVl('2_1') ?> & <?= dspVl('2_2') ?>
                                        \end{vmatrix} \;=\;\\
                                        \)
                                    </p>
                                    <?php
                                                if ($_POST['dtrmn_opts']=='1') { //Column 1
                                                    dspThrdCl("1+1","2+1","3+1",1+1,2+1,3+1,"0_0","1_1","1_2","2_1","2_2","1_0","0_1","0_2","2_0",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='2') { //Column 2
                                                    dspThrdCl("1+2","2+2","3+2",1+2,2+2,3+2,"0_1","1_0","1_2","2_0","2_2","1_1","0_0","0_2","2_1",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='3') { //Column 3
                                                    dspThrdCl("1+3","2+3","3+3",1+3,2+3,3+3,"0_2","1_0","1_1","2_0","2_1","1_2","0_0","0_1","2_2",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                }
                                            } elseif ($_POST['dtrmn_opts_method']=='exp_row') { //Using Expand along the rows method
                                        ?>
                                    <p class="col s12 font_size14" style="margin:15px 0;">
                                        \(
                                        det
                                        \begin{vmatrix}
                                        <?= dspVl('0_0') ?> & <?= dspVl('0_1') ?> & <?= dspVl('0_2') ?> \\
                                        <?= dspVl('1_0') ?> & <?= dspVl('1_1') ?> & <?= dspVl('1_2') ?> \\
                                        <?= dspVl('2_0') ?> & <?= dspVl('2_1') ?> & <?= dspVl('2_2') ?>
                                        \end{vmatrix} \;=\;\\
                                        \)
                                    </p>
                                    <?php
                                                if ($_POST['dtrmn_opts']=='1') { //Row 1
                                                    dspThrdRw("1+1","1+2","1+3",1+1,1+2,1+3,"0_0","1_1","1_2","2_1","2_2","0_1","1_0","2_0","0_2",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='2') { //Row 2
                                                    dspThrdRw("2+1","2+2","2+3",2+1,2+2,2+3,"1_0","0_1","0_2","2_1","2_2","1_1","0_0","2_0","1_2",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                    
                                                } elseif ($_POST['dtrmn_opts']=='3') { //Row 3
                                                    dspThrdRw("3+1","3+2","3+3",3+1,3+2,3+3,"2_0","0_1","0_2","1_1","1_2","2_1","0_0","1_0","2_2",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                }

                                            } elseif ($_POST['dtrmn_opts_method']=='sarrus') { //Using Sarrus method
                                        ?>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">Rule of
                                        Sarrus : </p>
                                    \(
                                    M =
                                    \begin{bmatrix}
                                    a11 & a12 & a13 \\
                                    a21 & a22 & a23 \\
                                    a31 & a32 & a33
                                    \end{bmatrix}
                                    \)
                                    <br />
                                    <br />
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        det(M)\;=
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;a11 \times a22 \times a33\;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;a12 \times a23 \times a31\;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;a13 \times a21 \times a32\;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;-\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;a31 \times a22 \times a13\;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;-\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;a32 \times a23 \times a11\;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;-\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;a33 \times a21 \times a12\;)
                                        \)
                                    </p>
                                    <p class="color_blue left-align font_size20"></p>
                                    {{-- <img data-src="<?= base_url('assets/img/sarrus-matrix.png') ?>" title="Rule of Sarrus"
                                        alt="Rule of Sarrus" class="image"
                                        style="display:block;width:222px;margin:10px 10px 0px;"> --}}
                                        <img src="{{asset('assets/img/sarrus-matrix.png')}}" height="100%" width="222px" alt="Rule of Sarrus" loading="lazy" decoding="async">
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:30px 0;">
                                        <?= $lang['14'] ?> : 1</p>
                                    \(
                                    det
                                    \begin{vmatrix}
                                    <?= dspVl('0_0') ?> & <?= dspVl('0_1') ?> & <?= dspVl('0_2') ?> \\
                                    <?= dspVl('1_0') ?> & <?= dspVl('1_1') ?> & <?= dspVl('1_2') ?> \\
                                    <?= dspVl('2_0') ?> & <?= dspVl('2_1') ?> & <?= dspVl('2_2') ?>
                                    \end{vmatrix} \\
                                    \)
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:30px 0;">
                                        <?= $lang['14'] ?> : 2</p>
                                    <p class="dtrmn_cols">
                                        \(
                                        =\;
                                        \Big(\;\; <?= dspVl('0_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_2') ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;\Big(\;\; <?= dspVl('0_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_0') ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;\Big(\;\; <?= dspVl('0_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_1') ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\Big(\;\; <?= dspVl('2_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('0_2') ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\Big(\;\; <?= dspVl('2_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('0_0') ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\Big(\;\; <?= dspVl('2_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('0_1') ?> \;\Big)
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:30px 0;">
                                        <?= $lang['14'] ?> : 3</p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;
                                        \Big(\;\; <?= gtVl(['0_0', '1_1', '2_2']) ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;\Big(\;\; <?= gtVl(['0_1', '1_2', '2_0']) ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;\Big(\;\; <?= gtVl(['0_2', '1_0', '2_1']) ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\Big(\;\; <?= gtVl(['2_0', '1_1', '0_2']) ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\Big(\;\; <?= gtVl(['2_1', '1_2', '0_0']) ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\Big(\;\; <?= gtVl(['2_2', '1_0', '0_1']) ?> \;\Big)
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:30px 0;">
                                        <?= $lang['14'] ?> : 4</p>
                                    \(
                                    =\;
                                    \Big(\;\;
                                    <?= gtVl(['0_0', '1_1', '2_2']) + gtVl(['0_1', '1_2', '2_0']) + gtVl(['0_2', '1_0', '2_1']) ?>
                                    \;\Big)
                                    -\;\Big(\;\;
                                    <?= gtVl(['2_0', '1_1', '0_2']) + gtVl(['2_1', '1_2', '0_0']) + gtVl(['2_2', '1_0', '0_1']) ?>
                                    \;\Big)
                                    \)
                                    </p>

                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                            } elseif ($_POST['dtrmn_opts_method']=='triangle') { //Using Triangle method
                                        ?>

                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="margin:30px 0;font-weight:600;">Triangle’s
                                        Rule : </p>
                                    \(
                                    M =
                                    \begin{bmatrix}
                                    a11 & a12 & a13 \\
                                    a21 & a22 & a23 \\
                                    a31 & a32 & a33
                                    \end{bmatrix}
                                    \)
                                    </p>
                                    <br />
                                    <p class="dtrmn_cols">
                                        \(
                                        det(M)\;=
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;(\;a11 \times a22 \times a33\;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;a12 \times a23 \times a31\;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;+\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;a13 \times a21 \times a32\;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;-\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;a31 \times a22 \times a13\;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;-\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;a32 \times a23 \times a11\;)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        \;-\;
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        (\;a33 \times a21 \times a12\;)
                                        \)
                                    </p>
                                    <p class="col s12 font_size20">
                                        {{-- <img data-src="<?= base_url('assets/img/triangle-matrix.png') ?>" title="Rule of Triangle"
                                            alt="Rule of Triangle" class="image"
                                            style="display:block;width:222px;margin:10px 10px 0px;"> --}}
                                        <img src="{{asset('assets/img/triangle-matrix.png')}}" height="100%" width="222px" alt="Rule of Triangle" loading="lazy" decoding="async">
                                    </p>

                                    <p class="col s12 font_size16" style="margin:50px 0 0 0;">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:30px 0;">
                                        <?= $lang['14'] ?> : 1</p>
                                    \(
                                    det
                                    \begin{vmatrix}
                                    <?= dspVl('0_0') ?> & <?= dspVl('0_1') ?> & <?= dspVl('0_2') ?> \\
                                    <?= dspVl('1_0') ?> & <?= dspVl('1_1') ?> & <?= dspVl('1_2') ?> \\
                                    <?= dspVl('2_0') ?> & <?= dspVl('2_1') ?> & <?= dspVl('2_2') ?>
                                    \end{vmatrix} \\
                                    \)
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:30px 0;">
                                        <?= $lang['14'] ?> : 2</p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;
                                        \Big(\;\; <?= dspVl('0_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_2') ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;\Big(\;\; <?= dspVl('0_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_0') ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;\Big(\;\; <?= dspVl('0_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_1') ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\Big(\;\; <?= dspVl('2_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('0_2') ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\Big(\;\; <?= dspVl('2_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('0_0') ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\Big(\;\; <?= dspVl('2_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('0_1') ?> \;\Big)
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:30px 0;">
                                        <?= $lang['14'] ?> : 3</p>

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;
                                        \Big(\;\; <?= gtVl(['0_0', '1_1', '2_2']) ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;\Big(\;\; <?= gtVl(['0_1', '1_2', '2_0']) ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;\Big(\;\; <?= gtVl(['0_2', '1_0', '2_1']) ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\Big(\;\; <?= gtVl(['2_0', '1_1', '0_2']) ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\Big(\;\; <?= gtVl(['2_1', '1_2', '0_0']) ?> \;\Big)
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\Big(\;\; <?= gtVl(['2_2', '1_0', '0_1']) ?> \;\Big)
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size20">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:30px 0;">
                                        <?= $lang['14'] ?> : 4</p>
                                    \(
                                    =\;
                                    \Big(\;\;
                                    <?= gtVl(['0_0', '1_1', '2_2']) + gtVl(['0_1', '1_2', '2_0']) + gtVl(['0_2', '1_0', '2_1']) ?>
                                    \;\Big)
                                    -\;\Big(\;\;
                                    <?= gtVl(['2_0', '1_1', '0_2']) + gtVl(['2_1', '1_2', '0_0']) + gtVl(['2_2', '1_0', '0_1']) ?>
                                    \;\Big)
                                    \)
                                    </p>

                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                            }

                                        } elseif ($_POST['dtrmn_slct_method']=='4') { //Showing calculation of 4 x 4 Matrix
                                        ?>
                                    <p class="col s12 font_size16">
                                        \(
                                        det
                                        \begin{vmatrix}
                                        <?= dspVl('0_0') ?> & <?= dspVl('0_1') ?> & <?= dspVl('0_2') ?> & <?= dspVl('0_3') ?> \\
                                        <?= dspVl('1_0') ?> & <?= dspVl('1_1') ?> & <?= dspVl('1_2') ?> & <?= dspVl('1_3') ?> \\
                                        <?= dspVl('2_0') ?> & <?= dspVl('2_1') ?> & <?= dspVl('2_2') ?> & <?= dspVl('2_3') ?> \\
                                        <?= dspVl('3_0') ?> & <?= dspVl('3_1') ?> & <?= dspVl('3_2') ?> & <?= dspVl('3_3') ?>
                                        \end{vmatrix} \;=\;\\
                                        \)
                                    </p>
                                    <?php
                                            if ($_POST['dtrmn_opts_method']=='leibniz') { //Using Leibniz method

                                                ?>
                                    <p class="col s12 font_size16">

                                    <p class="dtrmn_cols">
                                        \(
                                        =\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_3') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">

                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_1') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_3') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_0') ?> )
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_3') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_2') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        =\; <?= $detail['ans'] ?>
                                        \)
                                    </p>
                                    </p>
                                    <?php
                                            } elseif ($_POST['dtrmn_opts_method']=='exp_col') { //Using Expand along the columns method

                                                if ($_POST['dtrmn_opts']=='1') { //Column 1
                                                    dspFrthCl("1+1","2+1","3+1","4+1",1+1,2+1,3+1,4+1,"0_0","1_1","1_2","1_3","2_1","2_2","2_3","3_1","3_2","3_3","1_0","0_1","0_2","0_3","2_0","3_0",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='2') { //Column 2
                                                    dspFrthCl("1+2","2+2","3+2","4+2",1+2,2+2,3+2,4+2,"0_1","1_0","1_2","1_3","2_0","2_2","2_3","3_0","3_2","3_3","1_1","0_0","0_2","0_3","2_1","3_1",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='3') { //Column 3
                                                    dspFrthCl("1+3","2+3","3+3","4+3",1+3,2+3,3+3,4+3,"0_2","1_0","1_1","1_3","2_0","2_1","2_3","3_0","3_1","3_3","1_2","0_0","0_1","0_3","2_2","3_2",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='4') { //Column 4
                                                    dspFrthCl("1+4","2+4","3+4","4+4",1+4,2+4,3+4,4+4,"0_3","1_0","1_1","1_2","2_0","2_1","2_2","3_0","3_1","3_2","1_3","0_0","0_1","0_2","2_3","3_3",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                }

                                            } elseif ($_POST['dtrmn_opts_method']=='exp_row') { //Using Expand along the rows method

                                                if ($_POST['dtrmn_opts']=='1') { //Row 1
                                                    dspFrthRw("1+1","1+2","1+3","1+4",1+1,1+2,1+3,1+4,"0_0","1_1","1_2","1_3","2_1","2_2","2_3","3_1","3_2","3_3","0_1","1_0","2_0","3_0","0_2","0_3",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='2') { //Row 2
                                                    dspFrthRw("2+1","2+2","2+3","2+4",2+1,2+2,2+3,2+4,"1_0","0_1","0_2","0_3","2_1","2_2","2_3","3_1","3_2","3_3","1_1","0_0","2_0","3_0","1_2","1_3",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='3') { //Row 3
                                                    dspFrthRw("3+1","3+2","3+3","3+4",3+1,3+2,3+3,3+4,"2_0","0_1","0_2","0_3","1_1","1_2","1_3","3_1","3_2","3_3","2_1","0_0","1_0","3_0","2_2","2_3",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='4') { //Row 4
                                                    dspFrthRw("4+1","4+2","4+3","4+4",4+1,4+2,4+3,4+4,"3_0","0_1","0_2","0_3","1_1","1_2","1_3","2_1","2_2","2_3","3_1","0_0","1_0","2_0","3_2","3_3",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                }

                                            }

                                        } elseif ($_POST['dtrmn_slct_method']=='5') { //Showing calculation of 5 x 5 Matrix

                                        ?>
                                    <p class="col s12 font_size16">
                                        \(
                                        det
                                        \begin{vmatrix}
                                        <?= dspVl('0_0') ?> & <?= dspVl('0_1') ?> & <?= dspVl('0_2') ?> & <?= dspVl('0_3') ?> &
                                        <?= dspVl('0_4') ?> \\
                                        <?= dspVl('1_0') ?> & <?= dspVl('1_1') ?> & <?= dspVl('1_2') ?> & <?= dspVl('1_3') ?> &
                                        <?= dspVl('1_4') ?> \\
                                        <?= dspVl('2_0') ?> & <?= dspVl('2_1') ?> & <?= dspVl('2_2') ?> & <?= dspVl('2_3') ?> &
                                        <?= dspVl('2_4') ?> \\
                                        <?= dspVl('3_0') ?> & <?= dspVl('3_1') ?> & <?= dspVl('3_2') ?> & <?= dspVl('3_3') ?> &
                                        <?= dspVl('3_4') ?> \\
                                        <?= dspVl('4_0') ?> & <?= dspVl('4_1') ?> & <?= dspVl('4_2') ?> & <?= dspVl('4_3') ?> &
                                        <?= dspVl('4_4') ?> \\
                                        \end{vmatrix} \;=\;\\
                                        \)
                                    </p>

                                    <?php
                                            if ($_POST['dtrmn_opts_method']=='leibniz') { //Using Leibniz method
                                        ?>

                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_0') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
      ��������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������        <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_1') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_2') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_4') ?> )

                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_4') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_4') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_4') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_3') ?> \times <?= dspVl('1_4') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_0') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_1') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_3') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_3') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>

                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_2') ?> \times <?= dspVl('2_3') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_0') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_2') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_1') ?> \times
                                        <?= dspVl('3_2') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        -\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_0') ?> \times <?= dspVl('4_1') ?> )
                                        \)
                                    </p>
                                    <p class="dtrmn_cols">
                                        \(
                                        +\;
                                        ( <?= dspVl('0_4') ?> \times <?= dspVl('1_3') ?> \times <?= dspVl('2_2') ?> \times
                                        <?= dspVl('3_1') ?> \times <?= dspVl('4_0') ?> )
                                        \)
                                    </p>
                                    </p>
                                    <p class="col s12 font_size16">
                                    <p class="dtrmn_cols">
                                        \(
                                        =\; <?= $detail['ans'] ?>
                                        \)
                                    </p>
                                    </p>
                                    <?php

                                            } elseif ($_POST['dtrmn_opts_method']=='exp_col') { //Using Expand along the columns method

                                                if ($_POST['dtrmn_opts']=='1') { //Column 1
                                                    dspFifthCl("1+1","2+1","3+1","4+1","5+1",1+1,2+1,3+1,4+1,5+1,"0_0","1_1","1_2","1_3","1_4","2_1","2_2","2_3","2_4","3_1","3_2","3_3","3_4","4_1","4_2","4_3","4_4","1_0","0_1","0_2","0_3","0_4","2_0","3_0","4_0",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='2') { //Column 2
                                                    dspFifthCl("1+2","2+2","3+2","4+2","5+2",1+2,2+2,3+2,4+2,5+2,"0_1","1_0","1_2","1_3","1_4","2_0","2_2","2_3","2_4","3_0","3_2","3_3","3_4","4_0","4_2","4_3","4_4","1_1","0_0","0_2","0_3","0_4","2_1","3_1","4_1",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='3') { //Column 3
                                                    dspFifthCl("1+3","2+3","3+3","4+3","5+3",1+3,2+3,3+3,4+3,5+3,"0_2","1_0","1_1","1_3","1_4","2_0","2_1","2_3","2_4","3_0","3_1","3_3","3_4","4_0","4_1","4_3","4_4","1_2","0_0","0_1","0_3","0_4","2_2","3_2","4_2",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='4') { //Column 4
                                                    dspFifthCl("1+4","2+4","3+4","4+4","5+4",1+4,2+4,3+4,4+4,5+4,"0_3","1_0","1_1","1_2","1_4","2_0","2_1","2_2","2_4","3_0","3_1","3_2","3_4","4_0","4_1","4_2","4_4","1_3","0_0","0_1","0_2","0_4","2_3","3_3","4_3",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='5') { //Column 5
                                                    dspFifthCl("1+5","2+5","3+5","4+5","5+5",1+5,2+5,3+5,4+5,5+5,"0_4","1_0","1_1","1_2","1_3","2_0","2_1","2_2","2_3","3_0","3_1","3_2","3_3","4_0","4_1","4_2","4_3","1_4","0_0","0_1","0_2","0_3","2_4","3_4","4_4",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                }
                                            
                                            } elseif ($_POST['dtrmn_opts_method']=='exp_row') { //Using Expand along the rows method

                                                if ($_POST['dtrmn_opts']=='1') { //Row 1
                                                    dspFifthRw("1+1","1+2","1+3","1+4","1+5",1+1,1+2,1+3,1+4,1+5,"0_0","1_1","1_2","1_3","1_4","2_1","2_2","2_3","2_4","3_1","3_2","3_3","3_4","4_1","4_2","4_3","4_4","0_1","1_0","2_0","3_0","4_0","0_2","0_3","0_4",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='2') { //Row 2
                                                    dspFifthRw("2+1","2+2","2+3","2+4","2+5",2+1,2+2,2+3,2+4,2+5,"1_0","0_1","0_2","0_3","0_4","2_1","2_2","2_3","2_4","3_1","3_2","3_3","3_4","4_1","4_2","4_3","4_4","1_1","0_0","2_0","3_0","4_0","1_2","1_3","1_4",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='3') { //Row 3
                                                    dspFifthRw("3+1","3+2","3+3","3+4","3+5",3+1,3+2,3+3,3+4,3+5,"2_0","0_1","0_2","0_3","0_4","1_1","1_2","1_3","1_4","3_1","3_2","3_3","3_4","4_1","4_2","4_3","4_4","2_1","0_0","1_0","3_0","4_0","2_2","2_3","2_4",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='4') { //Row 4
                                                    dspFifthRw("4+1","4+2","4+3","4+4","4+5",4+1,4+2,4+3,4+4,4+5,"3_0","0_1","0_2","0_3","0_4","1_1","1_2","1_3","1_4","2_1","2_2","2_3","2_4","4_1","4_2","4_3","4_4","3_1","0_0","1_0","2_0","4_0","3_2","3_3","3_4",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                } elseif ($_POST['dtrmn_opts']=='5') { //Row 5
                                                    dspFifthRw("5+1","5+2","5+3","5+4","5+5",5+1,5+2,5+3,5+4,5+5,"4_0","0_1","0_2","0_3","0_4","1_1","1_2","1_3","1_4","2_1","2_2","2_3","2_4","3_1","3_2","3_3","3_4","4_1","0_0","1_0","2_0","3_0","4_2","4_3","4_4",$lang['14']);
                                        ?>
                                    <p class="col s12 font_size16">
                                    <p class="color_blue left-align font_size20" style="font-weight:600;margin:25px 0;">
                                        <?= $lang['15'] ?> = <?= $detail['ans'] ?></p>
                                    </p>
                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
    
    
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        <script>
            document.getElementById('dtrmn_gen_btn').addEventListener('click', function() {
                var arr = [];
                for (var i = 0; i < 25; ++i) {
                    arr[i] = i;
                }
                arr = randNums(arr);
                var inputs = document.querySelectorAll('.dtrmn_mtrx_tbl > tbody > tr > td > div > input');
                inputs.forEach(function(input, index) {
                    input.value = String(arr[index]).charAt(0);
                });
            });
            function randNums(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            }
            document.getElementById('dtrmn_clr_btn').addEventListener('click', function() {
                var inputs = document.querySelectorAll('.dtrmn_mtrx_tbl > tbody > tr > td > div > input');
                inputs.forEach(function(input) {
                    input.value = "";
                });
            });
            function crDetMatrix(mat) {
                var matrixOptVal = mat.value;
                var matrixTableBody = document.querySelector(".dtrmn_mtrx_tbl > tbody");
                var matrixRows = matrixTableBody.querySelectorAll("tr");
                var matrixRowLen = matrixRows.length;
                if (matrixOptVal > matrixRowLen) {
                    for (var i = 0; i < (matrixOptVal - matrixRowLen); i++) {
                        var newRow = document.createElement("tr");
                        matrixTableBody.appendChild(newRow);
                    }
                    matrixTableBody.querySelectorAll("tr").forEach(function(row, index) {
                        var matrixTdLen = row.querySelectorAll("td").length;
                        var matrixTdLens = matrixTdLen;
                        for (var i = 0; i < (matrixOptVal - matrixTdLen); i++) {
                            var newCell = document.createElement("td");
                            var div = document.createElement("div");
                            div.classList.add("px-1", "pt-2");
                            var input = document.createElement("input");
                            input.type = "number";
                            input.name = "dtrmn_" + index + "_" + matrixTdLens;
                            input.value = "0";
                            input.id = "dtrmn_" + index + "_" + matrixTdLens;
                            input.required = true;
                            input.classList.add("input");
                            div.appendChild(input);
                            newCell.appendChild(div);
                            row.appendChild(newCell);
                            matrixTdLens++;
                        }
                    });
                } else if (matrixOptVal < matrixRowLen) {
                    for (var i = 0; i < (matrixRowLen - matrixOptVal); i++) {
                        matrixTableBody.removeChild(matrixTableBody.lastElementChild);
                    }
                    matrixTableBody.querySelectorAll("tr").forEach(function(row, index) {
                        var matrixTdLen = row.querySelectorAll("td").length;
                        for (var i = 0; i < (matrixTdLen - matrixOptVal); i++) {
                            row.removeChild(row.lastElementChild);
                        }
                    });
                }
            }
            document.querySelectorAll(".dtrmn_mtrx_slct").forEach(function(element) {
                element.addEventListener("change", function() {
                    crDetMatrix(element);
                });
            });
            document.querySelectorAll(".dtrmn_mtrx_opts").forEach(function(element) {
                element.addEventListener("change", function() {
                    var thisVals = this.value;
                    if (thisVals === 'exp_col' || thisVals === 'exp_row' || thisVals === 'zro_col' ||
                        thisVals === 'zro_row') {
                        document.getElementById("dtrmn_opts").disabled = false;
                        document.getElementById("dtrmn_opts_Input").classList.remove("hidden");
                    } else {
                        document.getElementById("dtrmn_opts").disabled = true;
                        document.getElementById("dtrmn_opts_Input").classList.add("hidden");
                    }
                });
            });
            document.querySelector('button.calculate[name="submit"]').addEventListener("click", function(e) {
                var inputsLength = document.querySelectorAll(".dtrmn_mtrx_tbl > tbody > tr > td > div > input").length;
                var dtrmnOptsMethod = document.getElementById("dtrmn_opts_method").value;
                if ((inputsLength !== 9) && (dtrmnOptsMethod === "triangle" || dtrmnOptsMethod === "sarrus")) {
                    e.preventDefault();
                    alert("This method can only be used with 3×3 matrices.");
                }
            });
        </script>
    @endpush
</form>
