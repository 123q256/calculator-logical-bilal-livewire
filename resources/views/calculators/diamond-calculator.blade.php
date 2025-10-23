<style>
img{object-fit: contain;}
</style>
<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <style>
                .heading>p {
                    position: absolute;
                    left: 120px;
                    top: 0px;
                }

                .resh tbody tr, td {
                    border: none;
                }

                .swann tbody tr, td {
                    border: none;
                }

                .answer {
                    position: relative;
                    height: 100px;
                    /* this can be anything */
                    width: 100%;
                    /* ...but maintain 1:1 aspect ratio */
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                }
                .answer::before, .answer::after {
                    position: absolute;
                    content: '';
                    width: 100%;
                    height: 5px;
                    background-color: #1670a7;
                }

                .answer::before {
                    transform: rotate(45deg);
                }

                .answer::after {
                    transform: rotate(-45deg);
                }
            </style>
            @php $request = request();@endphp
            <div class="col-span-6">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 text-[14px]"><b class="text-blue"><?= $lang['3'] ?>:</b> <?= $lang['4'] ?>.</p>
                    <div class="col-span-6">
                        <label for="factor_a" class="font-s-14 text-blue"><?= $lang['2'] ?> (A):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="factor_a" id="factor_a" class="input" aria-label="input" value="{{ isset($$request->factor_a)?$$request->factor_a:'2' }}" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="factor_b" class="font-s-14 text-blue"><?= $lang['2'] ?> (B):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="factor_b" id="factor_b" class="input" aria-label="input" value="{{ isset($$request->factor_b)?$$request->factor_b:'6' }}" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="product" class="font-s-14 text-blue"><?= $lang['1'] ?>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="product" id="product" class="input" aria-label="input" value="{{ isset($$request->product)?$$request->product:'' }}" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="sum" class="font-s-14 text-blue"><?= $lang['5'] ?>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="sum" id="sum" class="input" aria-label="input" value="{{ isset($$request->sum)?$$request->sum:'' }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-6 flex justify-end items-center text-center">
                    <table class="swann div_center">
                        <tr>
                            <td></td>
                            <td class="center font_size20"><strong><?= $lang['1'] ?></strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center font_size20"><strong><?= $lang['2'] ?>&nbsp;(A)</strong></td>
                            <td class="answer"></td>
                            <td class="center font_size20"><strong><?= $lang['2'] ?>&nbsp;(B)</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="center font_size20"><strong><?= $lang['5'] ?></strong></td>
                            <td></td>
                        </tr>
                    </table>
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
                            $factor_a= $request->factor_a;
                            $factor_b= $request->factor_b;
                            $product= $request->product;
                            $sum= $request->sum;
                        @endphp
                        <div class="w-full">
                            <div class="w-full md:w-[50%] lg:w-[50%] mt-2 text-[16px]">
                                <table class="w-full text-center"> 
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <?php if ($detail['met'] == "1" || $detail['met'] == "3" || $detail['met'] == "5") { ?>
                                                <td><b class="text-blue"><?= $lang['1'] ?></b>
                                                    <p class="font-s-18 mt-1"><?php echo $detail['pro']; ?></p>
                                                </td>
                                            <?php } else { ?>
                                                <td><b><?= $lang['1'] ?></b>
                                                    <p class="mt-1"><?php echo $detail['pro']; ?></p>
                                                </td>
                                            <?php } ?>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <?php if ($detail['met'] == "4" || $detail['met'] == "5" || $detail['met'] == "6") { ?>
                                                <td><b class="text-blue"><?= $lang['2'] ?>&nbsp;A</b>
                                                    <p class="mt-1 font-s-18"><?php echo $detail['facta']; ?></p>
                                                </td>
                                            <?php } else { ?>
                                                <td><b><?= $lang['2'] ?>&nbsp;A</b>
                                                    <p class="mt-1"><?php echo $detail['facta']; ?></p>
                                                </td>
                                            <?php } ?>
                                            <td class="answer"></td>
                                            <?php if ($detail['met'] == "2" || $detail['met'] == "3" || $detail['met'] == "6") { ?>
                                                <td><b class="text-blue"><?= $lang['2'] ?>&nbsp;B</b>
                                                    <p class="font-s-18 mt-1"><?php echo $detail['factb']; ?></p>
                                                </td>
                                            <?php } else { ?>
                                                <td><b><?= $lang['2'] ?>&nbsp;B</b>
                                                    <p class="mt-1"><?php echo $detail['factb']; ?></p>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <?php if ($detail['met'] == "1" || $detail['met'] == "2" || $detail['met'] == "4") { ?>
                                                <td><b class="text-blue"><?= $lang['5'] ?></b>
                                                    <p class="mt-1 font-s-18"><?php echo $detail['su']; ?></p>
                                                <?php } else { ?>
                                                <td><b><?= $lang['5'] ?></b>
                                                    <p class="mt-1"><?php echo $detail['su']; ?></p>
                                                <?php } ?>
                                                <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong><?= $lang['6'] ?>:</strong></p>
                                <?php
                                if ($detail['met'] == "1") { ?>
                                    <p class="mt-2"><?= $lang['1'] ?> = <?= $lang['2'] ?> A x <?= $lang['2'] ?> B</p>
                                    <p class="mt-2"><?= $lang['1'] ?> = <?= $detail['facta'] . "×" . $detail['factb'] ?></p>
                                    <p class="mt-2"><?= $lang['1'] ?> = <?= $detail['facta'] * $detail['factb'] ?></p>
                                    <p class="mt-2"><?= $lang['5'] ?> = <?= $lang['2'] ?> A + <?= $lang['2'] ?> B</p>
                                    <p class="mt-2"><?= $lang['5'] ?> = <?= $detail['facta'] . "+" . $detail['factb'] ?></p>
                                    <p class="mt-2"><?= $lang['5'] ?> = <?= $detail['facta'] + $detail['factb'] ?></p>
                                <?php
                                } else if ($detail['met'] == "2") { ?>
                                    <p class="mt-2"><?= $lang['2'] ?> B = <?= $lang['1'] ?> ÷ <?= $lang['2'] ?> A</p>
                                    <p class="mt-2"><?= $lang['2'] ?> B = <?= $detail['pro'] . "÷" . $detail['facta'] ?></p>
                                    <p class="mt-2"><?= $lang['2'] ?> B = <?= $detail['pro'] / $detail['facta'] ?></p>
                                    <p class="mt-2"><?= $lang['5'] ?> = <?= $lang['2'] ?> A + <?= $lang['2'] ?> B</p>
                                    <p class="mt-2"><?= $lang['5'] ?> = <?= $detail['facta'] . "+" . $detail['factb'] ?></p>
                                    <p class="mt-2"><?= $lang['5'] ?> = <?= $detail['facta'] + $detail['factb'] ?></p>
                                <?php
                                } else if ($detail['met'] == "3") { ?>
                                    <p class="mt-2"><?= $lang['2'] ?> B = <?= $lang['5'] ?> - <?= $lang['2'] ?> A</p>
                                    <p class="mt-2"><?= $lang['2'] ?> B = <?php echo $detail['su'] . "-" . $detail['facta'] ?></p>
                                    <p class="mt-2"><?= $lang['2'] ?> B = <?= $detail['su'] - $detail['facta'] ?></p>
                                    <p class="mt-2"><?= $lang['1'] ?> = <?= $lang['2'] ?> A x <?= $lang['2'] ?> B</p>
                                    <p class="mt-2"><?= $lang['1'] ?> = <?= $detail['facta'] . "x" . $detail['factb'] ?></p>
                                    <p class="mt-2"><?= $lang['1'] ?> = <?= $detail['facta'] * $detail['factb'] ?></p>
                                <?php
                                } else if ($detail['met'] == "4") { ?>
                                    <p class="mt-2"><?= $lang['2'] ?> A = <?= $lang['1'] ?> ÷ <?= $lang['2'] ?> B</p>
                                    <p class="mt-2"><?= $lang['2'] ?> A = <?php echo $detail['pro'] . "÷" . $detail['factb'] ?></p>
                                    <p class="mt-2"><?= $lang['2'] ?> A = <?= $detail['pro'] / $detail['factb'] ?></p>
                                    <p class="mt-2"><?= $lang['5'] ?> = <?= $lang['2'] ?> A + <?= $lang['2'] ?> B</p>
                                    <p class="mt-2"><?= $lang['5'] ?> = <?= $detail['facta'] . "+" . $detail['factb'] ?></p>
                                    <p class="mt-2"><?= $lang['5'] ?> = <?= $detail['facta'] + $detail['factb'] ?></p>
                                <?php
                                } else if ($detail['met'] == "5") { ?>
                                    <p class="mt-2"><?= $lang['2'] ?> A = <?= $lang['5'] ?> - <?= $lang['2'] ?> B</p>
                                    <p class="mt-2"><?= $lang['2'] ?> A = <?php echo $detail['su'] . "-" . $detail['factb'] ?></p>
                                    <p class="mt-2"><?= $lang['2'] ?> A = <?php echo $detail['su'] - $detail['factb'] ?></p>
                                    <p class="mt-2"><?= $lang['1'] ?> = <?= $lang['2'] ?> A x <?= $lang['2'] ?> B</p>
                                    <p class="mt-2"><?= $lang['1'] ?> = <?= $detail['facta'] . "x" . $detail['factb'] ?></p>
                                    <p class="mt-2"><?= $lang['1'] ?> = <?= $detail['facta'] * $detail['factb'] ?></p>
                                <?php
                                }
                                if ($detail['met'] == "6") {
                                ?>
                                    <p class="mt-2"><?= $lang['7'] ?><?php echo $detail['pro']; ?> are:</p>
                                    <?php
                                    for ($i = 1; $i * $i <= $product; $i++) {
                                        if ($product % $i == 0) {
                                    ?>
                                            <?php
                                            if ($i + $product / $i == $detail['su']) {
                                            ?>
                                                <p class="mt-2 orange-text text-accent-4">[<?php echo $i ?>,<?php echo $product / $i; ?>] and <?php echo $i ?>+<?php echo $product / $i; ?>=<?php echo $i + $product / $i; ?></p>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="mt-2">[<?php echo $i ?>,<?php echo $product / $i; ?>] and <?php echo $i ?>+<?php echo $product / $i; ?>=<?php echo $i + $product / $i; ?></p>
                                            <?php
                                            }
                                            ?>
                
                                    <?php
                                        }
                                    }
                                    ?>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>