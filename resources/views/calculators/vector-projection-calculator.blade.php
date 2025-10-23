<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @php
        error_reporting(0);
    @endphp
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="dimension" class="label">{{ $lang[1] }}</label>
                    <div class="w-100 py-2 relative">
                        <select name="dem" id="dimension" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ['2','3'];
                                $val = ["2","3"];
                                optionsList($val,$name,isset($_POST['dem'])?$_POST['dem']:'2');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="representation_a" class="label">{{$lang['2']}} (A) {{$lang['3']}}</label>
                    <div class="w-100 py-2 relative">
                        <select name="vector_representation" id="representation_a" class="input">
                            @php
                                $name = [$lang['4'],$lang['5']];
                                $val = ["coor","point"];
                                optionsList($val,$name,isset($_POST['vector_representation'])?$_POST['vector_representation']:'coor');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 a_coor">
                    <div class="grid grid-cols-12 gap-4">
                        <p class="col-span-12 "><strong class="label">{{ $lang[2] }} (a)</strong></p>
                        <div class="col-span-6 ">
                            <div class="w-100 relative">
                                <input type="number" step="any" name="ax" id="ax" class="input" value="{{ isset($_POST['ax'])?$_POST['ax']:'3' }}" aria-label="input" placeholder="00" />
                                <i class="text-blue input_unit">i</i>
                            </div>
                        </div>
                        <div class="col-span-6 ">
                            <div class="w-100  relative">
                                <input type="number" step="any" name="ay" id="ay" class="input" value="{{ isset($_POST['ay'])?$_POST['ay']:'4' }}" aria-label="input" placeholder="00" />
                                <i class="text-blue input_unit">j</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-6  third_one">
                    <p class="col-span-12"><strong class="label">&nbsp;</strong></p>
                    <div class="w-100 relative">
                        <input type="number" step="any" name="az" id="az" class="input" value="{{ isset($_POST['az'])?$_POST['az']:'5' }}" aria-label="input" placeholder="00" />
                        <i class="text-blue input_unit">k</i>
                    </div>
                </div>
                <div class="col-span-8 a_one">
                    <div class="grid grid-cols-12 gap-4">
                        <p class="col-span-12"><strong class="label">{{ $lang[2] }} (a)</strong></p>
                        <div class="col-span-6 ">
                            <label for="1a" class="label">{{ $lang[6] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="1a" id="1a" class="input" value="{{ isset($_POST['1a'])?$_POST['1a']:'2' }}" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6 ">
                            <label for="2a" class="label">&nbsp;</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="2a" id="2a" class="input" value="{{ isset($_POST['2a'])?$_POST['2a']:'3' }}" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-4  a_two">
                    <p class="col-12 mx-2 mt-2">&nbsp;</p>
                    <div class="w-100 py-2">
                        <label for="3a" class="label">&nbsp;</label>
                        <input type="number" step="any" name="3a" id="3a" class="input" value="{{ isset($_POST['3a'])?$_POST['3a']:'4' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-8 a_three">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6 ">
                            <label for="1a" class="label">{{ $lang[7] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="1b" id="1b" class="input" value="{{ isset($_POST['1b'])?$_POST['1b']:'5' }}" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6 ">
                            <label for="2a" class="label">&nbsp;</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="2b" id="2b" class="input" value="{{ isset($_POST['2b'])?$_POST['2b']:'6' }}" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 px-2 a_four">
                    <div class="w-100 py-2">
                        <label for="3b" class="label">&nbsp;</label>
                        <input type="number" step="any" name="3b" id="3b" class="input" value="{{ isset($_POST['3b'])?$_POST['3b']:'7' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 ">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-6 ">
                        <label for="representation_b" class="label">{{$lang['2']}} (B) {{$lang['3']}}</label>
                        <div class="w-100 py-2 relative">
                            <select name="vector_b" id="representation_b" class="input">
                                @php
                                    $name = [$lang['4'],$lang['5']];
                                    $val = ["coor","point"];
                                    optionsList($val,$name,isset($_POST['vector_b'])?$_POST['vector_b']:'coor');
                                @endphp
                            </select>
                          </div>
                        </div>
                   </div>
                </div>
                <div class="col-span-8 b_coor">
                    <div class="grid grid-cols-12 gap-4">
                        <p class="col-span-12"><strong class="label">{{ $lang[8] }} (b)</strong></p>
                        <div class="col-span-6 ">
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="bx" id="bx" class="input" value="{{ isset($_POST['bx'])?$_POST['bx']:'7' }}" aria-label="input" placeholder="00" />
                                <i class="text-blue input_unit">i</i>
                            </div>
                        </div>
                        <div class="col-span-6 ">
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="by" id="by" class="input" value="{{ isset($_POST['by'])?$_POST['by']:'8' }}" aria-label="input" placeholder="00" />
                                <i class="text-blue input_unit">j</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 px-2 tw">
                    <p class="col-span-12"><strong class="label">&nbsp;</strong></p>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="bz" id="bz" class="input" value="{{ isset($_POST['bz'])?$_POST['bz']:'9' }}" aria-label="input" placeholder="00" />
                        <i class="text-blue input_unit">k</i>
                    </div>
                </div>
                <div class="col-span-8 b_one">
                    <div class="grid grid-cols-12 gap-4">
                        <p class="col-span-12"><strong class="label">{{ $lang[8] }} (b)</strong></p>
                        <div class="col-span-6 ">
                            <label for="1aa" class="label">{{ $lang[6] }} (A):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="1aa" id="1aa" class="input" value="{{ isset($_POST['1aa'])?$_POST['1aa']:'6' }}" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6 ">
                            <label for="2a" class="label">&nbsp;</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="2aa" id="2aa" class="input" value="{{ isset($_POST['2aa'])?$_POST['2aa']:'7' }}" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 px-2 b_two">
                    <p class="col-span-6">&nbsp;</p>
                    <p class="col-span-6">&nbsp;</p>
                    <div class="w-100 ">
                        <label for="3a" class="label">&nbsp;</label>
                        <input type="number" step="any" name="3aa" id="3aa" class="input" value="{{ isset($_POST['3aa'])?$_POST['3aa']:'8' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-8 b_three">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6 ">
                            <label for="1bb" class="label">{{ $lang[7] }} (B):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="1bb" id="1bb" class="input" value="{{ isset($_POST['1bb'])?$_POST['1bb']:'9' }}" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6 ">
                            <label for="2bb" class="label">&nbsp;</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="2bb" id="2bb" class="input" value="{{ isset($_POST['2bb'])?$_POST['2bb']:'10' }}" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 px-2 b_four">
                    <div class="w-100 py-2">
                        <label for="3bb" class="label">&nbsp;</label>
                        <input type="number" step="any" name="3bb" id="3bb" class="input" value="{{ isset($_POST['3bb'])?$_POST['3bb']:'11' }}" aria-label="input" placeholder="00" />
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
                        <?php if ($detail['dem'] == "3") { ?>
                            <?php if ($detail['vector_representation'] == "coor" && $detail['vector_b'] == "coor") { ?>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['9'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">
                                    $$\ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['az']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$</p>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['12'] ?> <?= $lang['14'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">$$ |\ proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$</p>
                                <p class="col-12 mt-2"> \[<?= $lang['13'] ?> \ <?= $lang['14'] ?>=\ proj[\vec u]{\vec{v}} = \frac{ \vec{v} \cdot \vec{u}}{||{\vec{u}}^2||} \vec{u}\]
                                </p>
                                <p class="col-12 mt-2">$$\vec v.\vec u=<?php echo $detail['vector_unit'] ?>$$
                                    <span class="font_size18">(<?= $lang['11'] ?>
                                        <?php
                                        $dimen = "3d";
                                        $a_rep = $_POST['vector_representation'];
                                        $b_rep = $_POST['vector_b'];
                                        $submit = "vc";
                                        $bx = $detail['f1'];
                                        $by = $detail['f2'];
                                        $bz = $detail['f3'];
                                        $ax = $detail['ax'];
                                        $ay = $detail['ay'];
                                        $az = $detail['az'];
                                        ?>
                                        <a href="{{url('dot-product-calculator/')}}/" title=" Dot Product Calculator" target="_blank" rel="noopener">
                                            Dot Product Calculator
                                        </a>)
                                    </span>
                                    $$ |\vec u|=\sqrt{<?php echo $detail['vector_u']; ?>}$$
                                </p>
                                <p class="text-center">
                                    <span class="text-center">(<?= $lang['11'] ?>
                                        <a href="{{url('vector-magnitude-calculator')}}/" title="Vector Magnitude Calculator" target="_blank" rel="noopener">Vector Magnitude Calculator
                                        </a>)
                                    </span>
                                </p>
                                <p class="col-12 mt-2">
                                    $$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['vector_unit']; ?>}{\Bigg(\sqrt<?php echo $detail['vector_u']; ?>\Bigg)^2}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>,<?php echo $detail['az']; ?>\Bigg)$$
                                </p>
                                <p class="col-12 mt-2">$$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['call0'] ?>}{\Bigg(<?php echo $detail['call1']; ?>\Bigg)}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>,<?php echo $detail['az']; ?>\Bigg)$$
                                    $$ <?= $lang['13'] ?> \ <?= $lang['14'] ?> \ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['az']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}| = \frac{ \vec{v} \cdot \vec{u}}{|{\vec{u}}|}\ $$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$
                                </p>
                            <?php } ?>
                            <?php if ($detail['vector_representation'] == "coor" && $detail['vector_b'] == "point") {
                            ?>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['9'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">
                                    $$\ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['az']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$</p>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['10'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">$$ |\ proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$</p>
                                <p class="col-12 mt-2"> \[ <?= $lang['13'] ?> \ <?= $lang['14'] ?>=\ proj[\vec u]{\vec{v}} = \frac{ \vec{v} \cdot \vec{u}}{||{\vec{u}}^2||} \vec{u}\]
                                </p>
                                <p class="col-12 mt-2">$$\vec v.\vec u=<?php echo $detail['vector_unit'] ?>$$
                                    <?php
                                    ?>
                                    <?php
                                    $vector_representation = $detail['vector_representation'];
                                    ?>
                                    <span class="font_size18">(<?= $lang['11'] ?>
                                        <?php
                                        $dimen = "3d";
                                        $a_rep = $_POST['vector_representation'];
                                        $b_rep = "coor";
                                        $submit = "vc";
                                        $bx = $detail['ax'];
                                        $by = $detail['ay'];
                                        $bz = $detail['az'];
                                        ?>
                                        <a href="<?= url('dot-product-calculator/?res_link=0&g=' . $dimen . '&a_rep=' . $a_rep . '&ax=' . $detail['f1'] . '&ay=' . $detail['f2'] . '&az=' . $detail['f3'] . '&b_rep=' . $b_rep . '&bx=' . $bx . '&by=' . $by . '&bz=' . $bz . '&submit=' . $submit) ?>" title=" Dot Product Calculator" target="_blank" rel="noopener">
                                            Dot Product Calculator
                                        </a>)
                                    </span>
                                    $$ |\vec u|=\sqrt{<?php echo $detail['vector_u']; ?>}$$
                                </p>
                                <p class="text-center">
                                    <?php
                                    $ax = $detail['ax'];
                                    $ay = $detail['ay'];
                                    $az = $detail['az'];
                                    ?>
                                    <span class="text-center">(<?= $lang['11'] ?>
                                        <a href="<?= url('vector-magnitude-calculator/?res_link=0&dem=' . $dem . '&rep=' . $vector_representation . '&ax=' . $ax . '&ay=' . $ay . '&az=' . $az) ?>" title="Vector Magnitude Calculator" target="_blank" rel="noopener">Vector Magnitude Calculator
                                        </a>)
                                    </span>
                                </p>
                                <p class="col-12 mt-2">
                                    $$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['vector_unit']; ?>}{\Bigg(\sqrt<?php echo $detail['vector_u']; ?>\Bigg)^2}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>,<?php echo $detail['az']; ?>\Bigg)$$
                                </p>
                                <p class="col-12 mt-2">$$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['call0'] ?>}{\Bigg(<?php echo $detail['call1']; ?>\Bigg)}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>,<?php echo $detail['az']; ?>\Bigg)$$
                                    $$ Vector \ <?= $lang['14'] ?> \ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['az']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> |\ proj[\vec u]{\vec{v}}| = \frac{ \vec{v} \cdot \vec{u}}{|{\vec{u}}|}\ $$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> |\ proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$
                                </p>
                            <?php } ?>
                            <?php if ($detail['vector_representation'] == "point" && $detail['vector_b'] == "coor") { ?>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['9'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">
                                    $$\ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['bx']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['by']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['bz']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$</p>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['10'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">$$ |\ proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$</p>
                                <p class="col-12 mt-2"> \[ Vector \ <?= $lang['14'] ?>=\ proj[\vec u]{\vec{v}} = \frac{ \vec{v} \cdot \vec{u}}{||{\vec{u}}^2||} \vec{u}\]
                                </p>
                                <p class="col-12 mt-2">$$\vec v.\vec u=<?php echo $detail['vector_unit'] ?>$$
                                    <?php
                                    $vector_representation = $detail['vector_representation'];
                                    $dimen = "3d";
                                    $a_rep = $vector_b;
                                    $b_rep = "coor";
                                    $submit = "vc";
                                    $bx = $detail['ax'];
                                    $by = $detail['ay'];
                                    $bz = $detail['az'];
                                    ?>
                                    <span class="font_size18">(<?= $lang['11'] ?>
                                        <a href="<?= url('dot-product-calculator/?res_link=0&g=' . $dimen . '&a_rep=' . $a_rep . '&ax=' . $bx . '&ay=' . $by . '&az=' . $bz . '&b_rep=' . $b_rep . '&bx=' . $detail['bx'] . '&by=' . $detail['by'] . '&bz=' . $detail['bz'] . '&submit=' . $submit) ?>" title=" Dot Product Calculator" target="_blank" rel="noopener">
                                            Dot Product Calculator
                                        </a>)
                                    </span>
                                    $$ |\vec u|=\sqrt{<?php echo $detail['vector_u']; ?>}$$
                                    <?php  ?>
                                </p>
                                <p class="text-center">
                                    <?php
                                    $ax = $detail['bx'];
                                    $ay = $detail['by'];
                                    $az = $detail['bz'];
                                    ?>
                                    <span class="text-center">(<?= $lang['11'] ?>
                                        <a href="<?= url('vector-magnitude-calculator/?res_link=0&dem=' . $dem . '&rep=' . $vector_b . '&ax=' . $ax . '&ay=' . $ay . '&az=' . $az) ?>" title="Vector Magnitude Calculator" target="_blank" rel="noopener">Vector Magnitude Calculator
                                        </a>)
                                    </span>
                                </p>
                                <p class="col-12 mt-2">
                                    $$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['vector_unit']; ?>}{\Bigg(\sqrt<?php echo $detail['vector_u']; ?>\Bigg)^2}.\Bigg(<?php echo $detail['bx']; ?>,<?php echo $detail['by']; ?>,<?php echo $detail['bz']; ?>\Bigg)$$
                                </p>
                                <p class="col-12 mt-2">$$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['call0'] ?>}{\Bigg(<?php echo $detail['call1']; ?>\Bigg)}.\Bigg(<?php echo $detail['bx']; ?>,<?php echo $detail['by']; ?>,<?php echo $detail['bz']; ?>\Bigg)$$
                                    $$ Vector \ <?= $lang['14'] ?> \ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['bx']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['by']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['bz']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}| = \frac{ \vec{v} \cdot \vec{u}}{|{\vec{u}}|}\ $$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$
                                </p>
                            <?php } ?>
                            <?php if ($detail['vector_representation'] == "point" && $detail['vector_b'] == "point") { ?>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['9'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">
                                    $$\ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['az']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$</p>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['10'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">$$ |\ proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$</p>
                                <p class="col-12 mt-2"> \[ <?= $lang['13'] ?> \ <?= $lang['14'] ?>=\ proj[\vec u]{\vec{v}} = \frac{ \vec{v} \cdot \vec{u}}{||{\vec{u}}^2||} \vec{u}\]
                                </p>
                                <p class="col-12 mt-2">$$\vec v.\vec u=<?php echo $detail['vector_unit'] ?>$$
                                    <?php
                                    $vector_representation = $detail['vector_representation'];
                                    $dimen = "3d";
                                    $a_rep = "coor";
                                    $b_rep = "coor";
                                    $submit = "vc";
                                    $bx = $detail['ax'];
                                    $by = $detail['ay'];
                                    $bz = $detail['az'];
                                    $ex = $detail['ex'];
                                    $ey = $detail['ey'];
                                    $ez = $detail['ez'];
                                    ?>
                                    <span class="font_size18">(<?= $lang['11'] ?>
                                        <a href="<?= url('dot-product-calculator/?res_link=0&g=' . $dimen . '&a_rep=' . $a_rep . '&ax=' . $bx . '&ay=' . $by . '&az=' . $bz . '&b_rep=' . $b_rep . '&bx=' . $ex . '&by=' . $ey . '&bz=' . $ez . '&submit=' . $submit) ?>" title=" Dot Product Calculator" target="_blank" rel="noopener">
                                            Dot Product Calculator
                                        </a>)
                                    </span>
                                    $$ |\vec u|=\sqrt{<?php echo $detail['vector_u']; ?>}$$
                                </p>
                                <?php
                                $vector_representation = "coor";
                                ?>
                                <p class="text-center">
                                    <?php
                                    $ax = $detail['ax'];
                                    $ay = $detail['ay'];
                                    $az = $detail['az'];
                                    $dx = $detail['dx'];
                                    $dy = $detail['dy'];
                                    $dz = $detail['dz'];
                                    ?>
                                    <span class="text-center">(<?= $lang['11'] ?>
                                        <a href="<?= url('vector-magnitude-calculator/?res_link=0&dem=' . $dem . '&rep=' . $vector_representation . '&ax=' . $ax . '&ay=' . $ay . '&az=' . $az) ?>" title="Vector Magnitude Calculator" target="_blank" rel="noopener">Vector Magnitude Calculator
                                        </a>)
                                    </span>
                                </p>
                                <p class="col-12 mt-2">
                                    $$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['vector_unit']; ?>}{\Bigg(\sqrt<?php echo $detail['vector_u']; ?>\Bigg)^2}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>,<?php echo $detail['az']; ?>\Bigg)$$
                                </p>
                                <p class="col-12 mt-2">$$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['call0'] ?>}{\Bigg(<?php echo $detail['call1']; ?>\Bigg)}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>,<?php echo $detail['az']; ?>\Bigg)$$
                                    $$ Vector \ <?= $lang['14'] ?> \ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['az']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}| = \frac{ \vec{v} \cdot \vec{u}}{|{\vec{u}}|}\ $$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$
                                </p>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($detail['dem'] == "2") { ?>
                            <?php if ($detail['vector_representation'] == "coor" && $detail['vector_b'] == "coor") { ?>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['9'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">
                                    $$\ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$</p>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['10'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">$$ |\ proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$</p>
                                <p class="col-12 mt-2"> \[ <?= $lang['13'] ?> \ <?= $lang['14'] ?>=\ proj[\vec u]{\vec{v}} = \frac{ \vec{v} \cdot \vec{u}}{||{\vec{u}}^2||} \vec{u}\]
                                </p>
                                <p class="col-12 mt-2">$$\vec v.\vec u=<?php echo $detail['vector_unit'] ?>$$
                                    <?php
                                    $ax = $detail['ax'];
                                    $ay = $detail['ay'];
                                    $ex = $detail['bx'];
                                    $ey = $detail['by'];
                                    $dimen = "2d";
                                    $a_rep = "coor";
                                    $b_rep = "coor";
                                    $submit = "vc";
                                    ?>
                                    <span class="font_size18">(<?= $lang['11'] ?>
                                        <a href="<?= url('dot-product-calculator/?res_link=0&g=' . $dimen . '&a_rep=' . $a_rep . '&ax=' . $ex . '&ay=' . $ey . '&b_rep=' . $b_rep . '&bx=' . $ax . '&by=' . $ay . '&submit=' . $submit) ?>" title=" Dot Product Calculator" target="_blank" rel="noopener">
                                            Dot Product Calculator
                                        </a>)
                                    </span>
                                    $$ |\vec u|=\sqrt{<?php echo $detail['vector_u']; ?>}$$
                                </p>
                                <p class="text-center">
                                    <span class="text-center">(<?= $lang['11'] ?>
                                        <a href="<?= url('vector-magnitude-calculator/?res_link=0&dem=' . $dem . '&rep=' . $vector_b . '&ax=' . $ax . '&ay=' . $ay) ?>" title="Vector Magnitude Calculator" target="_blank" rel="noopener">Vector Magnitude Calculator
                                        </a>)
                                    </span>
                                </p>
                                <p class="col-12 mt-2">
                                    $$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['vector_unit']; ?>}{\Bigg(\sqrt<?php echo $detail['vector_u']; ?>\Bigg)^2}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>\Bigg)$$
                                </p>
                                <p class="col-12 mt-2">$$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['call0'] ?>}{\Bigg(<?php echo $detail['call1']; ?>\Bigg)}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>\Bigg)$$
                                    $$ Vector \ <?= $lang['14'] ?> \ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}| = \frac{ \vec{v} \cdot \vec{u}}{|{\vec{u}}|}\ $$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$
                                </p>
                            <?php } ?>
                            <?php if ($detail['vector_representation'] == "coor" && $detail['vector_b'] == "point") { ?>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue">Vector <?= $lang['14'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">
                                    $$\ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$</p>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['10'] ?> <?= $lang['14'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">$$ |\ proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$</p>
            
                                <p class="col-12 mt-2"> \[ <?= $lang['13'] ?> \ <?= $lang['14'] ?>=\ proj[\vec u]{\vec{v}} = \frac{ \vec{v} \cdot \vec{u}}{||{\vec{u}}^2||} \vec{u}\]
                                </p>
                                <p class="col-12 mt-2">$$\vec v.\vec u=<?php echo $detail['vector_unit'] ?>$$
                                    <?php
                                    $ax = $detail['ax'];
                                    $ay = $detail['ay'];
                                    $ex = $detail['ex'];
                                    $ey = $detail['ey'];
                                    $dem = 2;
                                    $dimen = "2d";
                                    $a_rep = "coor";
                                    $b_rep = "coor";
                                    $submit = "vc";
                                    $rep = "coor";
                                    ?>
                                    <span class="font_size18">(<?= $lang['11'] ?>
                                        <a href="<?= url('dot-product-calculator/?res_link=0&g=' . $dimen . '&a_rep=' . $a_rep . '&ax=' . $ex . '&ay=' . $ey . '&b_rep=' . $b_rep . '&bx=' . $ax . '&by=' . $ay . '&submit=' . $submit) ?>" title=" Dot Product Calculator" target="_blank" rel="noopener">
                                            Dot Product Calculator
                                        </a>)
                                    </span>
                                    $$ |\vec u|=\sqrt{<?php echo $detail['vector_u']; ?>}$$
                                </p>
                                <p class="text-center">
                                    <span class="text-center">(<?= $lang['11'] ?>
                                        <a href="<?= url('vector-magnitude-calculator/?res_link=0&dem=' . $dem . '&rep=' . $rep . '&ax=' . $ax . '&ay=' . $ay) ?>" title="Vector Magnitude Calculator" target="_blank" rel="noopener">Vector Magnitude Calculator
                                        </a>)
                                    </span>
                                </p>
                                <p class="col-12 mt-2">
                                    $$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['vector_unit']; ?>}{\Bigg(\sqrt<?php echo $detail['vector_u']; ?>\Bigg)^2}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>\Bigg)$$
                                </p>
                                <p class="col-12 mt-2">$$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['call0'] ?>}{\Bigg(<?php echo $detail['call1']; ?>\Bigg)}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>\Bigg)$$
                                    $$ Vector \ <?= $lang['14'] ?> \ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}| = \frac{ \vec{v} \cdot \vec{u}}{|{\vec{u}}|}\ $$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$
                                </p>
                            <?php } ?>
                            <?php if ($detail['vector_representation'] == "point" && $detail['vector_b'] == "coor") { ?>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['9'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">
                                    $$\ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$</p>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['10'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">$$ |\ proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$</p>
                                <p class="col-12 mt-2"> \[ <?= $lang['13'] ?> \ <?= $lang['14'] ?>=\ proj[\vec u]{\vec{v}} = \frac{ \vec{v} \cdot \vec{u}}{||{\vec{u}}^2||} \vec{u}\]
                                </p>
                                <p class="col-12 mt-2">$$\vec v.\vec u=<?php echo $detail['vector_unit'] ?>$$
                                    <?php
                                    $ax = $detail['ax'];
                                    $ay = $detail['ay'];
                                    $az = $detail['az'];
                                    ?>
                                    <?php
                                    $ax = $detail['ax'];
                                    $ay = $detail['ay'];
                                    $ex = $detail['cx'];
                                    $ey = $detail['cy'];
                                    $dem = 2;
                                    $dimen = "2d";
                                    $a_rep = "coor";
                                    $b_rep = "coor";
                                    $submit = "vc";
                                    $rep = "coor";
                                    ?>
                                    <span class="font_size18">(<?= $lang['11'] ?>
                                        <a href="<?= url('dot-product-calculator/?res_link=0&g=' . $dimen . '&a_rep=' . $a_rep . '&ax=' . $ex . '&ay=' . $ey . '&b_rep=' . $b_rep . '&bx=' . $ax . '&by=' . $ay . '&submit=' . $submit) ?>" title=" Dot Product Calculator" target="_blank" rel="noopener">
                                            Dot Product Calculator
                                        </a>)
                                    </span>
                                    $$ |\vec u|=\sqrt{<?php echo $detail['vector_u']; ?>}$$
                                </p>
                                <p class="text-center">
                                    <span class="text-center">(<?= $lang['11'] ?>
                                        <a href="<?= url('vector-magnitude-calculator/?res_link=0&dem=' . $dem . '&rep=' . $rep . '&ax=' . $ax . '&ay=' . $ay) ?>" title="Vector Magnitude Calculator" target="_blank" rel="noopener">Vector Magnitude Calculator
                                        </a>)
                                    </span>
                                </p>
                                <p class="col-12 mt-2">
                                    $$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['vector_unit']; ?>}{\Bigg(\sqrt<?php echo $detail['vector_u']; ?>\Bigg)^2}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>\Bigg)$$
                                </p>
                                <p class="col-12 mt-2">$$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['call0'] ?>}{\Bigg(<?php echo $detail['call1']; ?>\Bigg)}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>\Bigg)$$
                                    $$ Vector \ <?= $lang['14'] ?> \ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}| = \frac{ \vec{v} \cdot \vec{u}}{|{\vec{u}}|}\ $$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$
                                </p>
                            <?php } ?>
                            <?php if ($detail['vector_representation'] == "point" && $detail['vector_b'] == "point") { ?>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['9'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">
                                    $$\ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$</p>
                                <p class="col-12 font-s-18 mt-2 text-center text-blue"><?= $lang['10'] ?></p>
                                <p class="col-12 mt-2 text-center font-s-20">$$ |\ proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$</p>
            
                                <p class="col-12 mt-2"> \[ <?= $lang['13'] ?> \ <?= $lang['14'] ?>=\ proj[\vec u]{\vec{v}} = \frac{ \vec{v} \cdot \vec{u}}{||{\vec{u}}^2||} \vec{u}\]
                                </p>
                                <p class="col-12 mt-2">$$\vec v.\vec u=<?php echo $detail['vector_unit'] ?>$$
                                    <?php
                                    $ax = $detail['ax'];
                                    $ay = $detail['ay'];
                                    $ex = $detail['dx'];
                                    $ey = $detail['dy'];
                                    $dem = 2;
                                    $dimen = "2d";
                                    $a_rep = "coor";
                                    $b_rep = "coor";
                                    $submit = "vc";
                                    $rep = "coor";
                                    ?>
                                    <span class="font_size18">(<?= $lang['11'] ?>
                                        <a href="<?= url('dot-product-calculator/?res_link=0&g=' . $dimen . '&a_rep=' . $a_rep . '&ax=' . $ax . '&ay=' . $ay . '&b_rep=' . $b_rep . '&bx=' . $ex . '&by=' . $ey . '&submit=' . $submit) ?>" title=" Dot Product Calculator" target="_blank" rel="noopener">
                                            Dot Product Calculator
                                        </a>)
                                    </span>
                                    $$ |\vec u|=\sqrt{<?php echo $detail['vector_u']; ?>}$$
                                </p>
                                <p class="text-center">
                                    <span class="text-center">(<?= $lang['11'] ?>
                                        <a href="<?= url('vector-magnitude-calculator/?res_link=0&dem=' . $dem . '&rep=' . $rep . '&ax=' . $ax . '&ay=' . $ay) ?>" title="Vector Magnitude Calculator" target="_blank" rel="noopener">Vector Magnitude Calculator
                                        </a>)
                                    </span>
                                </p>
                                <p class="col-12 mt-2">
                                    $$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['vector_unit']; ?>}{\Bigg(\sqrt<?php echo $detail['vector_u']; ?>\Bigg)^2}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>\Bigg)$$
                                </p>
                                <p class="col-12 mt-2">$$ \ proj[\vec u]{\vec{v}}= \frac{<?php echo $detail['call0'] ?>}{\Bigg(<?php echo $detail['call1']; ?>\Bigg)}.\Bigg(<?php echo $detail['ax']; ?>,<?php echo $detail['ay']; ?>\Bigg)$$
                                    $$ Vector \ <?= $lang['14'] ?> \ proj[\vec u]{\vec{v}} =\Bigg(\frac{<?php echo $d = $detail['call0'] * $detail['ax']; ?>}{<?php echo $detail['call1']; ?>},\frac{<?php echo $detail['call0'] * $detail['ay']; ?>}{<?php echo $detail['call1']; ?>}\Bigg)$$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}| = \frac{ \vec{v} \cdot \vec{u}}{|{\vec{u}}|}\ $$
                                    $$ <?= $lang['12'] ?> \ <?= $lang['14'] ?> \ | proj[\vec u]{\vec{v}}|=\frac{<?php echo $detail['vector_unit'] ?>}{\sqrt <?php echo $detail['vector_u']; ?>}$$
                                </p>
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
        function showElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.style.display = 'block';
                });
            });
        }

        function hideElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.style.display = 'none';
                });
            });
        }

        function handleDimensionChange() {
            var a = document.getElementById('dimension').value;
            var b = document.getElementById('dimension').value;
            var q = document.getElementById('representation_a').value;
            var q2 = document.getElementById('representation_b').value;
            
            // Handling dimension for element A
            if (a === "3") {
                if (q === "coor") {
                    showElements([".a_coor", ".third_one"]);
                    hideElements([".a_one", ".a_two", ".a_three", ".a_four"]);
                } else if (q === "point") {
                    showElements([".a_one", ".a_two", ".a_three", ".a_four"]);
                    hideElements([".a_coor", ".third_one"]);
                }
            } else if (a === "2") {
                if (q === "coor") {
                    showElements([".a_coor"]);
                    hideElements([".a_one", ".a_two", ".a_three", ".a_four", ".third_one"]);
                } else if (q === "point") {
                    showElements([".a_one", ".a_three"]);
                    hideElements([".a_coor", ".third_one", ".a_two", ".a_four"]);
                }
            }

            // Handling dimension for element B
            if (b === "3") {
                if (q2 === "coor") {
                    showElements([".b_coor", ".tw"]);
                    hideElements([".b_one", ".b_two", ".b_three", ".b_four"]);
                } else if (q2 === "point") {
                    showElements([".b_one", ".b_two", ".b_three", ".b_four"]);
                    hideElements([".b_coor", ".tw"]);
                }
            } else if (b === "2") {
                if (q2 === "coor") {
                    showElements([".b_coor"]);
                    hideElements([".b_one", ".b_two", ".b_three", ".b_four", ".tw"]);
                } else if (q2 === "point") {
                    showElements([".b_one", ".b_three"]);
                    hideElements([".b_coor", ".tw", ".b_two", ".b_four"]);
                }
            }
        }

        function handleRepresentationAChange() {
            var resa = document.getElementById('representation_a').value;
            var dimension_value = document.getElementById('dimension').value;

            if (resa === "coor") {
                if (dimension_value === "3") {
                    showElements([".a_coor", ".third_one"]);
                    hideElements([".a_one", ".a_two", ".a_three", ".a_four"]);
                } else if (dimension_value === "2") {
                    showElements([".a_coor"]);
                    hideElements([".a_one", ".a_two", ".a_three", ".a_four", ".third_one"]);
                }
            } else if (resa === "point") {
                if (dimension_value === "3") {
                    showElements([".a_one", ".a_two", ".a_three", ".a_four"]);
                    hideElements([".a_coor", ".third_one"]);
                } else if (dimension_value === "2") {
                    showElements([".a_one", ".a_three"]);
                    hideElements([".a_coor", ".third_one", ".a_two", ".a_four"]);
                }
            }
        }

        function handleRepresentationBChange() {
            var resa2 = document.getElementById('representation_b').value;
            var dimension_value3 = document.getElementById('dimension').value;

            if (resa2 === "coor") {
                if (dimension_value3 === "3") {
                    showElements([".b_coor", ".tw"]);
                    hideElements([".b_one", ".b_two", ".b_three", ".b_four"]);
                } else if (dimension_value3 === "2") {
                    showElements([".b_coor"]);
                    hideElements([".b_one", ".b_two", ".b_three", ".b_four", ".tw"]);
                }
            } else if (resa2 === "point") {
                if (dimension_value3 === "3") {
                    showElements([".b_one", ".b_two", ".b_three", ".b_four"]);
                    hideElements([".b_coor", ".tw"]);
                } else if (dimension_value3 === "2") {
                    showElements([".b_one", ".b_three"]);
                    hideElements([".b_coor", ".tw", ".b_two", ".b_four"]);
                }
            }
        }

        document.getElementById("dimension").addEventListener("change", handleDimensionChange);
        document.getElementById("representation_a").addEventListener("change", handleRepresentationAChange);
        document.getElementById("representation_b").addEventListener("change", handleRepresentationBChange);

        // Initial call to set the state based on current selection
        handleDimensionChange();
        handleRepresentationAChange();
        handleRepresentationBChange();
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>