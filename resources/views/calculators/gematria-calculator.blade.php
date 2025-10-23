<style>
    .hov_line:hover{
        color: gray !important;
        filter: grayscale(80%);
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST" id="myForm">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 two mt-1">
                    <label for="input" class="font-s-14">{{ $lang['1'] }} e.g:
                        <span class="ps-1 text-decoration-underline link cursor-pointer text-blue">Heaven</span>,
                        <span class="text-decoration-underline link cursor-pointer text-blue">Beast</span>,
                        <span class="text-decoration-underline link cursor-pointer text-blue">Earth</span>
                    </label>
                    <div class="w-100 py-2">
                        <input type="text" name="input" id="input" value="{{ isset($_POST['input'])?$_POST['input']:'HELLO' }}" class="input" aria-label="input" placeholder="00" />
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
                    <div class="w-full bg-light-blue  p-3 radius-10 mt-3">
                        <div class="row">
                            <div class="w-full" id="res_step1">
                                <div class="row">
                                    {{-- harbw --}}
                                    <p class="w-full mt-2 font-s-18 cursor-pointer mb-lg-0 mb-3" id="first_time5"><strong class="d-flex align-items-center text-blue hov_line text-decoration-underline"><?= $lang[9] ?> 
                                        <img src="{{asset('images/keyboard.png')}}" width="30px" height="30px" alt="More info" class="ps-1">
                                    </strong></p>
                                    <p class="w-full text-center"><?php echo '"' . $detail['input'] . '" = ' . "<strong> " . $detail['answer_jg'] . "</strong> " ?></p>
                                    <div class="col-lg-7 mx-auto mt-2 overflow-auto">
                                        <table class="w-100" style='border-collapse: collapse'>
                                            <tr class="bg-white">
                                                <?php
                                                $inner_alpha = $detail['inner_alpha'];
                                                $inner_sum_jg = $detail['inner_sum_jg'];
            
                                                // dd($inner_alpha, $inner_sum_jg);
                                                for ($i = 0; $i < count($inner_alpha); $i++) {
                                                    foreach ($inner_alpha[$i] as $value) {
                                                        echo "<td class='border p-2 text-center'>" . $value . "</td>";
                                                    }
                                                    echo "<td rowspan='2' class='border p-2 text-center'><strong>" . $detail['answer_jg'] . "</strong></td>";
                                                }
                                                if (count($inner_alpha) > 1) {
                                                    echo "<td rowspan='2' class='border p-2 text-center'><strong>" . $detail['answer_jg'] . "</strong></td>";
                                                }
                                                ?>
                                            </tr>
                                            <tr class="bg-white">
                                                <?php
                                                $inner_ans_jg = $detail['inner_ans_jg'];
                                                for ($i = 0; $i < count($inner_alpha); $i++) {
                                                    foreach ($inner_ans_jg[$i] as $value) {
                                                        echo "<td class='border p-2 text-center'>" . $value . "</td>";
                                                    }
                                                }
                                                ?>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="w-full " id="res_step5" style="display: none">
                                        <div class="w-full mt-3 over overflow-auto">
                                            <table class="w-100" style='border-collapse: collapse'>
                                                <tr class="bg-gray">
                                                    <td colspan="13" class="border p-2 text-center font-s-18"><strong class="text-blue"><?= $lang[7] ?></strong></td>
                                                </tr>
                                                <tr class="bg-white">
                                                    <td class="border p-2 text-center">a</td>
                                                    <td class="border p-2 text-center">b</td>
                                                    <td class="border p-2 text-center">c</td>
                                                    <td class="border p-2 text-center">d</td>
                                                    <td class="border p-2 text-center">e</td>
                                                    <td class="border p-2 text-center">f</td>
                                                    <td class="border p-2 text-center">g</td>
                                                    <td class="border p-2 text-center">h</td>
                                                    <td class="border p-2 text-center">i</td>
                                                    <td class="border p-2 text-center">j</td>
                                                    <td class="border p-2 text-center">k</td>
                                                    <td class="border p-2 text-center">l</td>
                                                    <td class="border p-2 text-center">m</td>
                                                </tr>
                                                <tr class="bg-white">
                                                    <td class="border p-2 text-center">1</td>
                                                    <td class="border p-2 text-center">2</td>
                                                    <td class="border p-2 text-center">3</td>
                                                    <td class="border p-2 text-center">4</td>
                                                    <td class="border p-2 text-center">5</td>
                                                    <td class="border p-2 text-center">6</td>
                                                    <td class="border p-2 text-center">7</td>
                                                    <td class="border p-2 text-center">8</td>
                                                    <td class="border p-2 text-center">9</td>
                                                    <td class="border p-2 text-center">600</td>
                                                    <td class="border p-2 text-center">10</td>
                                                    <td class="border p-2 text-center">20</td>
                                                    <td class="border p-2 text-center">30</td>
                                                </tr>
                                                <tr class="bg-white">
                                                    <td class="border p-2 text-center">n</td>
                                                    <td class="border p-2 text-center">o</td>
                                                    <td class="border p-2 text-center">p</td>
                                                    <td class="border p-2 text-center">q</td>
                                                    <td class="border p-2 text-center">r</td>
                                                    <td class="border p-2 text-center">s</td>
                                                    <td class="border p-2 text-center">t</td>
                                                    <td class="border p-2 text-center">u</td>
                                                    <td class="border p-2 text-center">v</td>
                                                    <td class="border p-2 text-center">w</td>
                                                    <td class="border p-2 text-center">x</td>
                                                    <td class="border p-2 text-center">y</td>
                                                    <td class="border p-2 text-center">z</td>
                                                </tr>
                                                <tr class="bg-white">
                                                    <td class="border p-2 text-center">40</td>
                                                    <td class="border p-2 text-center">50</td>
                                                    <td class="border p-2 text-center">60</td>
                                                    <td class="border p-2 text-center">70</td>
                                                    <td class="border p-2 text-center">80</td>
                                                    <td class="border p-2 text-center">90</td>
                                                    <td class="border p-2 text-center">100</td>
                                                    <td class="border p-2 text-center">200</td>
                                                    <td class="border p-2 text-center">700</td>
                                                    <td class="border p-2 text-center">900</td>
                                                    <td class="border p-2 text-center">300</td>
                                                    <td class="border p-2 text-center">400</td>
                                                    <td class="border p-2 text-center">500</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
            
                                    {{-- english --}}
                                    <p class="w-full mt-3 font-s-18 cursor-pointer mb-lg-0 mb-3" id="first_time6"><strong class="d-flex align-items-center text-blue hov_line text-decoration-underline"><?= $lang[8] ?> 
                                        <img src="{{asset('images/keyboard.png')}}" width="30px" height="30px" alt="More info" class="ps-1"></strong></p>
                                    <p class="w-full text-center"><?php echo '"' . $detail['input'] . '" = ' . "<strong> " . $detail['answer_eg'] . "</strong> " ?></p>
                                    <div class="col-lg-7 mx-auto mt-2 overflow-auto">
                                        <table class="w-100" style='border-collapse: collapse'>
                                            <tr class="bg-white">
                                                <?php
                                                $inner_alpha = $detail['inner_alpha'];
                                                $inner_sum_eg = $detail['inner_sum_eg'];
                                                for ($i = 0; $i < count($inner_alpha); $i++) {
                                                    foreach ($inner_alpha[$i] as $value) {
                                                        echo "<td class='border p-2 text-center'>" . $value . "</td>";
                                                    }
                                                    // $inner_sum_eg[$i]
                                                    echo "<td rowspan='2' class='border p-2 text-center'><strong>" .  $detail['answer_eg'] . "</strong></td>";
                                                }
                                                if (count($inner_alpha) > 1) {
                                                    echo "<td rowspan='2' class='border p-2 text-center'><strong>" . $detail['answer_eg'] . "</strong></td>";
                                                }
                                                ?>
                                            </tr>
                                            <tr class="bg-white">
                                                <?php
                                                $inner_ans_eg = $detail['inner_ans_eg'];
                                                for ($i = 0; $i < count($inner_alpha); $i++) {
                                                    foreach ($inner_ans_eg[$i] as $value) {
                                                        echo "<td class='border p-2 text-center'>" . $value . "</td>";
                                                    }
                                                }
                                                ?>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="w-full " id="res_step6" style="display: none">
                                        <div class="w-full mt-3 over overflow-auto">
                                            <table class="w-100" style='border-collapse: collapse'>
                                                <tr class="bg-gray">
                                                    <td colspan="13" class="border p-2 text-center font-s-18"><strong class="text-blue"><?= $lang[8] ?></strong></td>
                                                </tr>
                                                <tr class="bg-white">
                                                    <td class="border p-2 text-center">a</td>
                                                    <td class="border p-2 text-center">b</td>
                                                    <td class="border p-2 text-center">c</td>
                                                    <td class="border p-2 text-center">d</td>
                                                    <td class="border p-2 text-center">e</td>
                                                    <td class="border p-2 text-center">f</td>
                                                    <td class="border p-2 text-center">g</td>
                                                    <td class="border p-2 text-center">h</td>
                                                    <td class="border p-2 text-center">i</td>
                                                    <td class="border p-2 text-center">j</td>
                                                    <td class="border p-2 text-center">k</td>
                                                    <td class="border p-2 text-center">l</td>
                                                    <td class="border p-2 text-center">m</td>
                                                </tr>
                                                <tr class="bg-white">
                                                    <td class="border p-2 text-center">6</td>
                                                    <td class="border p-2 text-center">12</td>
                                                    <td class="border p-2 text-center">18</td>
                                                    <td class="border p-2 text-center">24</td>
                                                    <td class="border p-2 text-center">30</td>
                                                    <td class="border p-2 text-center">36</td>
                                                    <td class="border p-2 text-center">42</td>
                                                    <td class="border p-2 text-center">48</td>
                                                    <td class="border p-2 text-center">54</td>
                                                    <td class="border p-2 text-center">60</td>
                                                    <td class="border p-2 text-center">66</td>
                                                    <td class="border p-2 text-center">72</td>
                                                    <td class="border p-2 text-center">78</td>
                                                </tr>
                                                <tr class="bg-white">
                                                    <td class="border p-2 text-center">n</td>
                                                    <td class="border p-2 text-center">o</td>
                                                    <td class="border p-2 text-center">p</td>
                                                    <td class="border p-2 text-center">q</td>
                                                    <td class="border p-2 text-center">r</td>
                                                    <td class="border p-2 text-center">s</td>
                                                    <td class="border p-2 text-center">t</td>
                                                    <td class="border p-2 text-center">u</td>
                                                    <td class="border p-2 text-center">v</td>
                                                    <td class="border p-2 text-center">w</td>
                                                    <td class="border p-2 text-center">x</td>
                                                    <td class="border p-2 text-center">y</td>
                                                    <td class="border p-2 text-center">z</td>
                                                </tr>
                                                <tr class="bg-white">
                                                    <td class="border p-2 text-center">84</td>
                                                    <td class="border p-2 text-center">90</td>
                                                    <td class="border p-2 text-center">96</td>
                                                    <td class="border p-2 text-center">102</td>
                                                    <td class="border p-2 text-center">108</td>
                                                    <td class="border p-2 text-center">114</td>
                                                    <td class="border p-2 text-center">120</td>
                                                    <td class="border p-2 text-center">126</td>
                                                    <td class="border p-2 text-center">132</td>
                                                    <td class="border p-2 text-center">138</td>
                                                    <td class="border p-2 text-center">144</td>
                                                    <td class="border p-2 text-center">150</td>
                                                    <td class="border p-2 text-center">156</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
            
                                    {{-- simple --}}
                                    <p class="w-full mt-3 font-s-18 cursor-pointer mb-lg-0 mb-3" id="first_time8"><strong class="d-flex align-items-center text-blue hov_line text-decoration-underline"><?= $lang[3] ?> 
                                        <img src="{{asset('images/keyboard.png')}}" width="30px" height="30px" alt="More info" class="ps-1">
                                    </strong></p>
                                    <p class="w-full text-center"><?php echo '"' . $detail['input'] . '" = ' . "<strong> " . $detail['answer_eo'] . "</strong> " ?></p>
                                    <div class="col-lg-7 mx-auto mt-2 overflow-auto">
                                        <table class="w-100" style='border-collapse: collapse'>
                                            <tr class="bg-white">
                                                <?php
                                                $inner_alpha = $detail['inner_alpha'];
                                                $inner_sum_eo = $detail['inner_sum_eo'];
                                                for ($i = 0; $i < count($inner_alpha); $i++) {
                                                    foreach ($inner_alpha[$i] as $value) {
                                                        echo "<td class='border p-2 text-center'>" . $value . "</td>";
                                                    }
                                                    echo "<td rowspan='2' class='border p-2 text-center'><strong>" . $detail['answer_eo'] . "</strong></td>";
                                                }
                                                if (count($inner_alpha) > 1) {
                                                    echo "<td rowspan='2' class='border p-2 text-center'><strong>" . $detail['answer_eo'] . "</strong></td>";
                                                }
                                                ?>
                                            </tr>
                                            <tr class="bg-white">
                                                <?php
                                                $inner_ans_eo = $detail['inner_ans_eo'];
                                                for ($i = 0; $i < count($inner_alpha); $i++) {
                                                    foreach ($inner_ans_eo[$i] as $value) {
                                                        echo "<td class='border p-2 text-center'>" . $value . "</td>";
                                                    }
                                                }
                                                ?>
                                            </tr>
                                        </table>
                                    </div>
                                    {{-- <?php
                                        $of_octal = base_convert(abs($detail['answer_eo']), 8, 10);
                                        $of_duo = base_convert(abs($detail['answer_eo']), 12, 10);
                                        $of_hex = base_convert(abs($detail['answer_eo']), 16, 10);
                                        $in_octal = base_convert(abs($detail['answer_eo']), 10, 8);
                                        $in_hex = base_convert(abs($detail['answer_eo']), 10, 16);
                                        $in_duo = base_convert(abs($detail['answer_eo']), 10, 12);
                                    ?> --}}
                                    <div class="row">
                                        <div id="res_step8" class="d-none">
                                            {{-- <div class="w-full mt-3 overflow-auto">
                                                <table class="w-100" style='border-collapse: collapse'>
                                                    <tr class="bg-gray">
                                                        <td class="border p-2 text-center text-blue" colspan="2"><strong><?= $lang[10] ?> <?php echo $detail['answer_eo']; ?></strong></td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center text-blue"><?= $lang[11] ?></td>
                                                        <td class='border p-2 text-center'><?php echo $of_octal; ?></td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center text-blue"><?= $lang[12] ?></td>
                                                        <td class='border p-2 text-center'><?php echo $of_duo; ?></td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center text-blue"><?= $lang[13] ?></td>
                                                        <td class='border p-2 text-center'><?php echo $of_hex; ?></td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center text-blue"><?= $lang[14] ?></td>
                                                        <td class='border p-2 text-center'><?php echo $in_octal; ?></td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center text-blue"><?= $lang[15] ?></td>
                                                        <td class='border p-2 text-center'><?php echo $in_duo; ?></td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center text-blue"><?= $lang[16] ?></td>
                                                        <td class='border p-2 text-center'><?php echo $in_hex; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="w-full mt-3 overflow-auto">
                                                <table class="w-100" style='border-collapse: collapse'>
                                                    <tr class="bg-gray">
                                                        <td class="border p-2 text-center text-blue"><strong><?= $lang[17] ?></strong></td>
                                                        <td class="border p-2 text-center text-blue"><strong><?= $lang[18] ?></strong></td>
                                                        <td class="border p-2 text-center text-blue"><strong><?= $lang[19] ?></strong></td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center"><?= $lang[20] ?></td>
                                                        <?php
                                                        if (empty($detail['eo_fib'])) {
                                                        ?>
                                                            <td class="border p-2 text-center"><?php echo "(" . ($detail['fcountg_eo'] - 1) . "th) " . $detail['fendg_eo'] . " - <strong>" . $detail['answer_eo'] . "</strong> - " . $detail['ffl_eo'] . " (" . ($detail['fcountg_eo1'] - 1) . "th)"; ?></td>
                                                        <?php
                                                        } else if (!empty($detail['eo_fib'])) {
                                                        ?>
                                                            <td class="border p-2 text-center"><?php echo "YES - (" . ($detail['findex_eo'] - 1) . "th)"; ?></td>
                                                        <?php
                                                        }
                                                        ?>
                                                        <td class="border p-2 text-center"><?php echo round($detail['final_ans']); ?></td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center"><?= $lang[21] ?></td>
                                                        <?php
                                                        if (empty($detail['eo'])) {
                                                        ?>
                                                            <td class="border p-2 text-center"><?php echo "(" . $detail['countg_eo'] . "th) " . $detail['endg_eo'] . " - <strong>" . $detail['answer_eo'] . "</strong> - " . $detail['fl_eo'] . " (" . $detail['countg_eo1'] . "th)"; ?></td>
                                                        <?php
                                                        } else if (!empty($detail['eo'])) {
                                                        ?>
                                                            <td class="border p-2 text-center"><?php echo "YES - (" . $detail['index_eo'] . "th)"; ?></td>
                                                        <?php
                                                        }
                                                        ?>
                                                        <td class="border p-2 text-center"><?php echo $detail['trelation_eo']; ?></td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center"><?= $lang[22] ?></td>
                                                        <?php
                                                        if ($detail['check_eo'] == "0") {
                                                        ?>
                                                            <td class="border p-2 text-center"><?php echo "(" . $detail['previous_eo'] . "th) " . $detail['apeo_p'] . " - <strong>" . $detail['answer_eo'] . "</strong> - " . $detail['apeo_n'] . " (" . $detail['next_eo'] . "th)"; ?></td>
                                                        <?php
                                                        } else if ($detail['check_eo'] == "1") {
                                                        ?>
                                                            <td class="border p-2 text-center"><?php echo "YES - (" . $detail['previous_eo'] . "th)"; ?></td>
                                                        <?php
                                                        }
                                                        ?>
                                                        <td class="border p-2 text-center"><?php echo $detail['prelation_eo']; ?></td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center"><?= $lang[23] ?></td>
                                                        <td class="border p-2 text-center" colspan="2"><?php echo $detail['newtext_eo']; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="w-full mt-3 overflow-auto">
                                                <table class="w-100" style='border-collapse: collapse'>
                                                    <tr class="bg-gray">
                                                        <td class="border p-2 text-center text-blue"><strong><?= $lang[24] ?></strong></td>
                                                        <td class="border p-2 text-center text-blue"><strong><?= $lang[25] ?></strong></td>
                                                        <td class="border p-2 text-center text-blue"><strong><?= $lang[26] ?></strong></td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center"><?php echo $detail['count_eodivi']; ?></td>
                                                        <td class="border p-2 text-center"><?php foreach ($detail['eo_divi'] as $eo) {
                                                                                echo $eo;
                                                                            } ?></td>
                                                        <td class="border p-2 text-center"><?php echo $detail['eodivi_sum']; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="w-full mt-4 overflow-auto">
                                                <table class="w-100" style='border-collapse: collapse'>
                                                    <tr class="bg-gray">
                                                        <td class="border p-2 text-center text-blue font-s-18"><?= $lang[3] ?></td>
                                                        <td class="border p-2 text-center text-blue font-s-18"><?= $lang[4] ?></td>
                                                        <td class="border p-2 text-center text-blue font-s-18"><?= $lang[5] ?></td>
                                                        <td class="border p-2 text-center text-blue font-s-18"><?= $lang[6] ?></td>
                                                        @if($device == 'desktop')
                                                            <td class="border p-2 text-center text-blue font-s-18"><?= $lang[7] ?></td>
                                                            <td class="border p-2 text-center text-blue font-s-18"><?= $lang[8] ?></td>
                                                            <td class="border p-2 text-center text-blue font-s-18"><?= $lang[9] ?></td>
                                                        @endif
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center font-s-20"><?php echo $detail['answer_eo'] ?></td>
                                                        <td class="border p-2 text-center font-s-20"><?php echo $detail['answer_fr'] ?></td>
                                                        <td class="border p-2 text-center font-s-20"><?php echo $detail['answer_ro'] ?></td>
                                                        <td class="border p-2 text-center font-s-20"><?php echo $detail['answer_rfd'] ?></td>
                                                        @if($device == 'desktop')
                                                            <td class="border p-2 text-center font-s-20"><?php echo $detail['answer_jg'] ?></td>
                                                            <td class="border p-2 text-center font-s-20"><?php echo $detail['answer_eg'] ?></td>
                                                            <td class="border p-2 text-center font-s-20"><?php echo $detail['answer_h'] ?></td>
                                                        @endif
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center"><?php echo $detail['dosra_eo'] ?></td>
                                                        <td class="border p-2 text-center"><?php echo $detail['dosra_fr'] ?></td>
                                                        <td class="border p-2 text-center"><?php echo $detail['dosra_ro'] ?></td>
                                                        <td class="border p-2 text-center"><?php echo $detail['dosra_rfd'] ?></td>
                                                        @if($device == 'desktop')
                                                            <td class="border p-2 text-center"><?php echo $detail['dosra_jg'] ?></td>
                                                            <td class="border p-2 text-center"><?php echo $detail['dosra_eg'] ?></td>
                                                            <td class="border p-2 text-center"><?php echo $detail['dosra_h'] ?></td>
                                                        @endif
                                                    </tr>
                                                </table>
                                            </div> --}}
                                            {{-- <p class="w-full mt-1 text-center"><?php echo "( <strong>" . $detail['count_ans'] . "</strong> " . $lang[27] . " , <strong>" . $detail['words_ans'] . "</strong> " . $lang[28] . " )"; ?></p> --}}
                                            <div class="w-full mt-3 overflow-auto">
                                                <table class="w-100" style='border-collapse: collapse'>
                                                    <tr class="bg-gray">
                                                        <td colspan="13" class="border p-2 text-center text-blue"><strong><?= $lang[3] ?></strong></td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center">a</td>
                                                        <td class="border p-2 text-center">b</td>
                                                        <td class="border p-2 text-center">c</td>
                                                        <td class="border p-2 text-center">d</td>
                                                        <td class="border p-2 text-center">e</td>
                                                        <td class="border p-2 text-center">f</td>
                                                        <td class="border p-2 text-center">g</td>
                                                        <td class="border p-2 text-center">h</td>
                                                        <td class="border p-2 text-center">i</td>
                                                        <td class="border p-2 text-center">j</td>
                                                        <td class="border p-2 text-center">k</td>
                                                        <td class="border p-2 text-center">l</td>
                                                        <td class="border p-2 text-center">m</td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center">1</td>
                                                        <td class="border p-2 text-center">2</td>
                                                        <td class="border p-2 text-center">3</td>
                                                        <td class="border p-2 text-center">4</td>
                                                        <td class="border p-2 text-center">5</td>
                                                        <td class="border p-2 text-center">6</td>
                                                        <td class="border p-2 text-center">7</td>
                                                        <td class="border p-2 text-center">8</td>
                                                        <td class="border p-2 text-center">9</td>
                                                        <td class="border p-2 text-center">10</td>
                                                        <td class="border p-2 text-center">11</td>
                                                        <td class="border p-2 text-center">12</td>
                                                        <td class="border p-2 text-center">13</td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center">n</td>
                                                        <td class="border p-2 text-center">o</td>
                                                        <td class="border p-2 text-center">p</td>
                                                        <td class="border p-2 text-center">q</td>
                                                        <td class="border p-2 text-center">r</td>
                                                        <td class="border p-2 text-center">s</td>
                                                        <td class="border p-2 text-center">t</td>
                                                        <td class="border p-2 text-center">u</td>
                                                        <td class="border p-2 text-center">v</td>
                                                        <td class="border p-2 text-center">w</td>
                                                        <td class="border p-2 text-center">x</td>
                                                        <td class="border p-2 text-center">y</td>
                                                        <td class="border p-2 text-center">z</td>
                                                    </tr>
                                                    <tr class="bg-white">
                                                        <td class="border p-2 text-center">14</td>
                                                        <td class="border p-2 text-center">15</td>
                                                        <td class="border p-2 text-center">16</td>
                                                        <td class="border p-2 text-center">17</td>
                                                        <td class="border p-2 text-center">18</td>
                                                        <td class="border p-2 text-center">19</td>
                                                        <td class="border p-2 text-center">20</td>
                                                        <td class="border p-2 text-center">21</td>
                                                        <td class="border p-2 text-center">22</td>
                                                        <td class="border p-2 text-center">23</td>
                                                        <td class="border p-2 text-center">24</td>
                                                        <td class="border p-2 text-center">25</td>
                                                        <td class="border p-2 text-center">26</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                {{-- reduction --}}
                                <p class="w-full mt-3 font-s-18 cursor-pointer mb-lg-0 mb-3" id="first_time2"><strong class="d-flex align-items-center text-blue hov_line text-decoration-underline"><?= $lang[4] ?> 
                                    <img src="{{asset('images/keyboard.png')}}" width="30px" height="30px" alt="More info" class="ps-1"></strong></p>
                                <p class="w-full text-center"><?php echo '"' . $detail['input'] . '" = ' . "<strong> " . $detail['answer_fr'] . "</strong> " ?></p>
                                <div class="col-lg-7 mt-2 mx-auto overflow-auto">
                                    <table class="w-100" style='border-collapse: collapse'>
                                        <tr class="bg-white">
                                            <?php
                                            $inner_alpha = $detail['inner_alpha'];
                                            $inner_sum_fr = $detail['inner_sum_fr'];
                                            for ($i = 0; $i < count($inner_alpha); $i++) {
                                                foreach ($inner_alpha[$i] as $value) {
                                                    echo "<td class='border p-2 text-center'>" . $value . "</td>";
                                                }
                                                echo "<td rowspan='2' class='border p-2 text-center'><strong>" . $detail['answer_fr'] . "</strong></td>";
                                            }
                                            if (count($inner_alpha) > 1) {
                                                echo "<td rowspan='2' class='border p-2 text-center'><strong>" . $detail['answer_fr'] . "</strong></td>";
                                            }
                                            ?>
                                        </tr>
                                        <tr class="bg-white">
                                            <?php
                                            $inner_ans_fr = $detail['inner_ans_fr'];
                                            for ($i = 0; $i < count($inner_alpha); $i++) {
                                                foreach ($inner_ans_fr[$i] as $value) {
                                                    echo "<td class='border p-2 text-center'>" . $value . "</td>";
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full" id="res_step2" style="display: none">
                                    <div class="row">
                                        <div class="w-full mt-3 overflow-auto">
                                            <table class="w-100" style='border-collapse: collapse'>
                                                <tr class="bg-gray">
                                                    <td colspan="13" class="border p-2 text-center text-blue font-s-18"><strong><?= $lang[4] ?></strong></td>
                                                </tr>
                                                <tr class="bg-white">
                                                    <td class="border p-2 text-center">a</td>
                                                    <td class="border p-2 text-center">b</td>
                                                    <td class="border p-2 text-center">c</td>
                                                    <td class="border p-2 text-center">d</td>
                                                    <td class="border p-2 text-center">e</td>
                                                    <td class="border p-2 text-center">f</td>
                                                    <td class="border p-2 text-center">g</td>
                                                    <td class="border p-2 text-center">h</td>
                                                    <td class="border p-2 text-center">i</td>
                                                    <td class="border p-2 text-center">j</td>
                                                    <td class="border p-2 text-center">k</td>
                                                    <td class="border p-2 text-center">l</td>
                                                    <td class="border p-2 text-center">m</td>
                                                </tr>
                                                <tr class="bg-white">
                                                    <td class="border p-2 text-center">1</td>
                                                    <td class="border p-2 text-center">2</td>
                                                    <td class="border p-2 text-center">3</td>
                                                    <td class="border p-2 text-center">4</td>
                                                    <td class="border p-2 text-center">5</td>
                                                    <td class="border p-2 text-center">6</td>
                                                    <td class="border p-2 text-center">7</td>
                                                    <td class="border p-2 text-center">8</td>
                                                    <td class="border p-2 text-center">9</td>
                                                    <td class="border p-2 text-center">1</td>
                                                    <td class="border p-2 text-center">2</td>
                                                    <td class="border p-2 text-center">3</td>
                                                    <td class="border p-2 text-center">4</td>
                                                </tr>
                                                <tr class="bg-white">
                                                    <td class="border p-2 text-center">n</td>
                                                    <td class="border p-2 text-center">o</td>
                                                    <td class="border p-2 text-center">p</td>
                                                    <td class="border p-2 text-center">q</td>
                                                    <td class="border p-2 text-center">r</td>
                                                    <td class="border p-2 text-center">s</td>
                                                    <td class="border p-2 text-center">t</td>
                                                    <td class="border p-2 text-center">u</td>
                                                    <td class="border p-2 text-center">v</td>
                                                    <td class="border p-2 text-center">w</td>
                                                    <td class="border p-2 text-center">x</td>
                                                    <td class="border p-2 text-center">y</td>
                                                    <td class="border p-2 text-center">z</td>
                                                </tr>
                                                <tr class="bg-white">
                                                    <td class="border p-2 text-center">5</td>
                                                    <td class="border p-2 text-center">6</td>
                                                    <td class="border p-2 text-center">7</td>
                                                    <td class="border p-2 text-center">8</td>
                                                    <td class="border p-2 text-center">9</td>
                                                    <td class="border p-2 text-center">1</td>
                                                    <td class="border p-2 text-center">2</td>
                                                    <td class="border p-2 text-center">3</td>
                                                    <td class="border p-2 text-center">4</td>
                                                    <td class="border p-2 text-center">5</td>
                                                    <td class="border p-2 text-center">6</td>
                                                    <td class="border p-2 text-center">7</td>
                                                    <td class="border p-2 text-center">8</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
            
                                {{-- Reverse --}}
                                <p class="w-full mt-3 font-s-18 cursor-pointer mb-lg-0 mb-3" id="first_time3"><strong class="d-flex align-items-center text-blue hov_line text-decoration-underline"><?= $lang[5] ?> 
                                    <img src="{{asset('images/keyboard.png')}}" width="30px" height="30px" alt="More info" class="ps-1"></strong></p>
                                <p class="w-full text-center"><?php echo '"' . $detail['input'] . '" = ' . "<strong> " . $detail['answer_ro'] . "</strong> " ?></p>
                                <div class="col-lg-7 mx-auto mt-2 overflow-auto">
                                    <table class="w-100" style='border-collapse: collapse'>
                                        <tr class="bg-white">
                                            <?php
                                            $inner_alpha = $detail['inner_alpha'];
                                            $inner_sum_ro = $detail['inner_sum_ro'];
                                            for ($i = 0; $i < count($inner_alpha); $i++) {
                                                foreach ($inner_alpha[$i] as $value) {
                                                    echo "<td class='border p-2 text-center'>" . $value . "</td>";
                                                }
                                                echo "<td rowspan='2' class='border p-2 text-center'><strong>" .  $detail['answer_ro']  . "</strong></td>";
                                            }
                                            if (count($inner_alpha) > 1) {
                                                echo "<td rowspan='2' class='border p-2 text-center'><strong>" . $detail['answer_ro'] . "</strong></td>";
                                            }
                                            ?>
                                        </tr>
                                        <tr class="bg-white">
                                            <?php
                                            $inner_ans_ro = $detail['inner_ans_ro'];
                                            for ($i = 0; $i < count($inner_alpha); $i++) {
                                                foreach ($inner_ans_ro[$i] as $value) {
                                                    echo "<td class='border p-2 text-center'>" . $value . "</td>";
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full mt-3" id="res_step3" style="display: none">
                                    <div class="w-full mt-3 over overflow-auto">
                                        <table class="w-100" style='border-collapse: collapse'>
                                            <tr class="bg-gray">
                                                <td colspan="13" class="border p-2 text-center font-s-18"><strong class="text-blue"><?= $lang[5] ?></strong></td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="border p-2 text-center">a</td>
                                                <td class="border p-2 text-center">b</td>
                                                <td class="border p-2 text-center">c</td>
                                                <td class="border p-2 text-center">d</td>
                                                <td class="border p-2 text-center">e</td>
                                                <td class="border p-2 text-center">f</td>
                                                <td class="border p-2 text-center">g</td>
                                                <td class="border p-2 text-center">h</td>
                                                <td class="border p-2 text-center">i</td>
                                                <td class="border p-2 text-center">j</td>
                                                <td class="border p-2 text-center">k</td>
                                                <td class="border p-2 text-center">l</td>
                                                <td class="border p-2 text-center">m</td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="border p-2 text-center">26</td>
                                                <td class="border p-2 text-center">25</td>
                                                <td class="border p-2 text-center">24</td>
                                                <td class="border p-2 text-center">23</td>
                                                <td class="border p-2 text-center">22</td>
                                                <td class="border p-2 text-center">21</td>
                                                <td class="border p-2 text-center">20</td>
                                                <td class="border p-2 text-center">19</td>
                                                <td class="border p-2 text-center">18</td>
                                                <td class="border p-2 text-center">17</td>
                                                <td class="border p-2 text-center">16</td>
                                                <td class="border p-2 text-center">15</td>
                                                <td class="border p-2 text-center">14</td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="border p-2 text-center">n</td>
                                                <td class="border p-2 text-center">o</td>
                                                <td class="border p-2 text-center">p</td>
                                                <td class="border p-2 text-center">q</td>
                                                <td class="border p-2 text-center">r</td>
                                                <td class="border p-2 text-center">s</td>
                                                <td class="border p-2 text-center">t</td>
                                                <td class="border p-2 text-center">u</td>
                                                <td class="border p-2 text-center">v</td>
                                                <td class="border p-2 text-center">w</td>
                                                <td class="border p-2 text-center">x</td>
                                                <td class="border p-2 text-center">y</td>
                                                <td class="border p-2 text-center">z</td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="border p-2 text-center">13</td>
                                                <td class="border p-2 text-center">12</td>
                                                <td class="border p-2 text-center">11</td>
                                                <td class="border p-2 text-center">10</td>
                                                <td class="border p-2 text-center">9</td>
                                                <td class="border p-2 text-center">8</td>
                                                <td class="border p-2 text-center">7</td>
                                                <td class="border p-2 text-center">6</td>
                                                <td class="border p-2 text-center">5</td>
                                                <td class="border p-2 text-center">4</td>
                                                <td class="border p-2 text-center">3</td>
                                                <td class="border p-2 text-center">2</td>
                                                <td class="border p-2 text-center">1</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
            
                                {{-- Reverse Reduction --}}
                                <p class="w-full mt-3 font-s-18 cursor-pointer mb-lg-0 mb-3" id="first_time4"><strong class="d-flex align-items-center text-blue hov_line text-decoration-underline"><?= $lang[6] ?> 
                                    <img src="{{asset('images/keyboard.png')}}" width="30px" height="30px" alt="More info" class="ps-1"></strong></p>
                                <p class="w-full text-center"><?php echo '"' . $detail['input'] . '" = ' . "<strong> " . $detail['answer_rfd'] . "</strong> " ?></p>
                                <div class="w-full md:w-[80%] lg:w-[80%] mx-auto mt-2 overflow-auto">
                                    <table class="w-full" style='border-collapse: collapse'>
                                        <tr class="bg-white">
                                            <?php
                                            $inner_alpha = $detail['inner_alpha'];
                                            $inner_sum_rfd = $detail['inner_sum_rfd'];
                                            for ($i = 0; $i < count($inner_alpha); $i++) {
                                                foreach ($inner_alpha[$i] as $value) {
                                                    echo "<td class='border p-2 text-center'>" . $value . "</td>";
                                                }
                                                echo "<td rowspan='2' class='border p-2 text-center'><strong>" . $detail['answer_rfd'] . "</strong></td>";
                                            }
                                            if (count($inner_alpha) > 1) {
                                                echo "<td rowspan='2' class='border p-2 text-center'><strong>" . $detail['answer_rfd'] . "</strong></td>";
                                            }
                                            ?>
                                        </tr>
                                        <tr class="bg-white">
                                            <?php
                                            $inner_ans_rfd = $detail['inner_ans_rfd'];
                                            for ($i = 0; $i < count($inner_alpha); $i++) {
                                                foreach ($inner_ans_rfd[$i] as $value) {
                                                    echo "<td class='border p-2 text-center'>" . $value . "</td>";
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full mt-3" id="res_step4" style="display: none">
                                    <div class="w-full mt-3 over overflow-auto">
                                        <table class="w-full" style='border-collapse: collapse'>
                                            <tr class="bg-gray">
                                                <td colspan="13" class="border p-2 text-center font-s-18"><strong class="text-blue"><?= $lang[6] ?></strong></td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="border p-2 text-center">a</td>
                                                <td class="border p-2 text-center">b</td>
                                                <td class="border p-2 text-center">c</td>
                                                <td class="border p-2 text-center">d</td>
                                                <td class="border p-2 text-center">e</td>
                                                <td class="border p-2 text-center">f</td>
                                                <td class="border p-2 text-center">g</td>
                                                <td class="border p-2 text-center">h</td>
                                                <td class="border p-2 text-center">i</td>
                                                <td class="border p-2 text-center">j</td>
                                                <td class="border p-2 text-center">k</td>
                                                <td class="border p-2 text-center">l</td>
                                                <td class="border p-2 text-center">m</td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="border p-2 text-center">8</td>
                                                <td class="border p-2 text-center">7</td>
                                                <td class="border p-2 text-center">6</td>
                                                <td class="border p-2 text-center">5</td>
                                                <td class="border p-2 text-center">4</td>
                                                <td class="border p-2 text-center">3</td>
                                                <td class="border p-2 text-center">2</td>
                                                <td class="border p-2 text-center">1</td>
                                                <td class="border p-2 text-center">9</td>
                                                <td class="border p-2 text-center">8</td>
                                                <td class="border p-2 text-center">7</td>
                                                <td class="border p-2 text-center">6</td>
                                                <td class="border p-2 text-center">5</td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="border p-2 text-center">n</td>
                                                <td class="border p-2 text-center">o</td>
                                                <td class="border p-2 text-center">p</td>
                                                <td class="border p-2 text-center">q</td>
                                                <td class="border p-2 text-center">r</td>
                                                <td class="border p-2 text-center">s</td>
                                                <td class="border p-2 text-center">t</td>
                                                <td class="border p-2 text-center">u</td>
                                                <td class="border p-2 text-center">v</td>
                                                <td class="border p-2 text-center">w</td>
                                                <td class="border p-2 text-center">x</td>
                                                <td class="border p-2 text-center">y</td>
                                                <td class="border p-2 text-center">z</td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="border p-2 text-center">4</td>
                                                <td class="border p-2 text-center">3</td>
                                                <td class="border p-2 text-center">2</td>
                                                <td class="border p-2 text-center">1</td>
                                                <td class="border p-2 text-center">9</td>
                                                <td class="border p-2 text-center">8</td>
                                                <td class="border p-2 text-center">7</td>
                                                <td class="border p-2 text-center">6</td>
                                                <td class="border p-2 text-center">5</td>
                                                <td class="border p-2 text-center">4</td>
                                                <td class="border p-2 text-center">3</td>
                                                <td class="border p-2 text-center">2</td>
                                                <td class="border p-2 text-center">1</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                         
                           
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.link');
            const input = document.getElementById('input');
            links.forEach(link => {
                link.addEventListener('click', function() {
                    input.value = link.innerText;
                    document.querySelector('button[name="submit"]').click();
                });
            });
        });

        if (document.getElementById('first_time2')) {
            function addSlideToggle(buttonId, resultId) {
                document.getElementById(buttonId).addEventListener('click', function() {
                    const element = document.getElementById(resultId);
                    if (element.style.display === "none" || element.style.display === "") {
                        element.style.display = "block";
                        element.style.transition = "all 0.7s";
                        element.style.maxHeight = element.scrollHeight + "px";
                    } else {
                        element.style.display = "none";
                        element.style.transition = "all 0.7s";
                        element.style.maxHeight = "0px";
                    }
                });
            }
            // Apply slideToggle to each button and result pair
            // addSlideToggle('first_time1', 'res_step1');
            addSlideToggle('first_time2', 'res_step2');
            addSlideToggle('first_time3', 'res_step3');
            addSlideToggle('first_time4', 'res_step4');
            addSlideToggle('first_time5', 'res_step5');
            addSlideToggle('first_time6', 'res_step6');
            // addSlideToggle('first_time7', 'res_step7');
            addSlideToggle('first_time8', 'res_step8');
        }
    </script>
@endpush