<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="calculation" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="w-100 py-2">
                    <select name="calculation" id="calculation" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'],$lang['3']];
                            $val = ["2D","3D"];
                            optionsList($val,$name,isset($_POST['calculation'])?$_POST['calculation'] : '3D');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="operation" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="operation" id="operation">
                        <?php
                            $name = [$lang['5'],$lang['6'],$lang['7'],$lang['8']];
                            $val = ["1","2","3","4"];
                            optionsList($val,$name,isset($_POST['operation'])?$_POST['operation'] : '1');
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 alpha hidden">
                <label for="alpha" class="font-s-14 text-blue">α:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="alpha" id="alpha" class="input" aria-label="input" value="{{ isset($_POST['alpha'])?$_POST['alpha']:'7' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 beta hidden">
                <label for="beta" class="font-s-14 text-blue">β:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="beta" id="beta" class="input" aria-label="input" value="{{ isset($_POST['beta'])?$_POST['beta']:'7' }}" />
                </div>
            </div>
            <div class="col-span-12 hidden" id="stokes">
                <label for="vectora_representation" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                <div class="w-100 py-2">
                    <select class="input" name="vectora_representation" id="vectora_representation">
                        <?php
                            $name = [$lang['10'],$lang['11']];
                            $val = ["1","2"];
                            optionsList($val,$name,isset($_POST['vectora_representation'])?$_POST['vectora_representation'] : '1');
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-span-12 x_coor">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <p class="col-span-12 px-lg-3"><?=$lang['12']?> (a) </p>
                <div class="col-span-4">
                    <label for="ax" class="font-s-14 text-blue" >{{ $lang['13'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="ax" id="ax" class="input" aria-label="input"  value="{{ isset($_POST['ax'])?$_POST['ax']: '3' }}" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="ay" class="font-s-14 text-blue" >{{ $lang['14'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="ay" id="ay" class="input" aria-label="input"  value="{{ isset($_POST['ay'])?$_POST['ay']: '4' }}" />
                    </div>
                </div>

                <div class="col-span-4 az">
                    <label for="az" class="font-s-14 text-blue" >{{ $lang['15'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="az" id="az" class="input" aria-label="input"  value="{{ isset($_POST['az'])?$_POST['az']: '5' }}" />
                    </div>
                </div>
               </div>
            </div>

            <div class="col-span-12 data_x hidden">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6">
                    <label for="magnitude_x" class="font-s-14 text-blue" >{{ $lang['16'] }} (m):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="magnitude_x" id="magnitude_x" class="input" aria-label="input"  value="{{ isset($_POST['magnitude_x'])?$_POST['magnitude_x']: '3' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="direction_x" class="font-s-14 text-blue" >{{ $lang['17'] }} (θ):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="direction_x" id="direction_x" class="input" aria-label="input"  value="{{ isset($_POST['direction_x'])?$_POST['direction_x']: '4' }}" />
                        <label for="direction_x_unit" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['direction_x_unit'])?$_POST['direction_x_unit']:'rad' }} ▾</label>
                        <input type="text" name="direction_x_unit" value="{{ isset($_POST['direction_x_unit'])?$_POST['direction_x_unit']:'rad' }}" id="direction_x_unit" class="hidden">
                        <div class="units direction_x_unit hidden" to="direction_x_unit">
                            @foreach (["deg", "rad", "gon", "tr", "arcmin", "arcsec", "mrad", "μrad", "* π rad"] as $item)
                                <p value="{{$item}}">{{$item}}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-span-12 hidden" id="stokes2">
                <label for="vectorb_representation" class="font-s-14 text-blue">{{ $lang['18'] }}</label>
                <div class="w-100 py-2">
                    <select class="input" name="vectorb_representation" id="vectorb_representation">
                        <?php
                            $name = [$lang['10'], $lang['11']];
                            $val = ["1", "2"];
                            optionsList($val,$name,isset($_POST['vectorb_representation'])?$_POST['vectorb_representation'] : '1');
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-span-12 y_coor ">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <p class="col-span-12 px-lg-3"><?=$lang['12']?> (2) </p>
                <div class="col-span-4">
                    <label for="bx" class="font-s-14 text-blue" >{{ $lang['13'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="bx" id="bx" class="input" aria-label="input"  value="{{ isset($_POST['bx'])?$_POST['bx']: '3' }}" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="by" class="font-s-14 text-blue" >{{ $lang['14'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="by" id="by" class="input" aria-label="input"  value="{{ isset($_POST['by'])?$_POST['by']: '4' }}" />
                    </div>
                </div>
                <div class="col-span-4 bz">
                    <label for="bz" class="font-s-14 text-blue" >{{ $lang['15'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="bz" id="bz" class="input" aria-label="input"  value="{{ isset($_POST['bz'])?$_POST['bz']: '5' }}" />
                    </div>
                </div>
            </div>
            </div>
            <div class="col-span-12 data_y  hidden">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6">
                    <label for="magnitude_y" class="font-s-14 text-blue" >{{ $lang['16'] }} (m):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="magnitude_y" id="magnitude_y" class="input" aria-label="input"  value="{{ isset($_POST['magnitude_y'])?$_POST['magnitude_y']: '3' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="direction_y" class="font-s-14 text-blue" >{{ $lang['17'] }} (θ):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="direction_y" id="direction_y" class="input" aria-label="input"  value="{{ isset($_POST['direction_y'])?$_POST['direction_y']: '4' }}" />
                        <label for="direction_y_unit" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['direction_y_unit'])?$_POST['direction_y_unit']:'rad' }} ▾</label>
                        <input type="text" name="direction_y_unit" value="{{ isset($_POST['direction_y_unit'])?$_POST['direction_y_unit']:'rad' }}" id="direction_y_unit" class="hidden">
                        <div class="units direction_y_unit hidden" to="direction_y_unit">
                            @foreach (["deg", "rad", "gon", "tr", "arcmin", "arcsec", "mrad", "μrad", "* π rad"] as $item)
                                <p value="{{$item}}">{{$item}}</p>
                            @endforeach
                        </div>
                    </div>
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
                    @php
                        $calculation=request()->calculation;
                        $operation=request()->operation;
                        $alpha=request()->alpha;
                        $beta=request()->beta;
                        $ax=request()->ax;
                        $ay=request()->ay;
                        $az=request()->az;
                        $vectorb_representation=request()->vectorb_representation;
                        $bx=request()->bx;
                        $by=request()->by;
                        $bz=request()->bz;
                    @endphp
                    <div class="w-full my-2">
                        @if($calculation == '3D')
                        <?php if (request()->operation == "1") : ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['23']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">(<?php echo $detail['x'] ?>,<?php echo $detail['y'] ?>,<?php echo $detail['z'] ?>)</strong></p>
                            </div>
                        </div>
                            <p class="mt-2"><strong><?= $lang['24'] ?></strong></p>
                            <p class="mt-2"><strong><?= $lang['25'] ?></strong> (<?php echo request()->ax ?>,<?php echo request()->ay ?>,<?php echo request()->az ?>) + (<?php echo request()->bx ?>,<?php echo request()->by ?>,<?php echo request()->bz ?>).</p>
                            <p class="mt-2">=((<?php echo request()->ax; ?>) + (<?php echo request()->bx; ?>) , (<?php echo request()->ay; ?>) + (<?php echo request()->by; ?>) , (<?php echo request()->az; ?>) + (<?php echo request()->bz; ?>))</p>
                            <p class="mt-2">=(<?php echo $detail['x'] ?> , <?php echo $detail['y'] ?> , <?php echo $detail['z'] ?>)</p>
                        <?php endif; ?>
                        <?php if ($detail['operation'] == "2") : ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['23']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">(<?php echo $detail['x'] ?>,<?php echo $detail['y'] ?>,<?php echo $detail['z'] ?>)</strong></p>
                            </div>
                        </div>
                            <p class="mt-2"><strong><?= $lang['24'] ?></strong></p>
                            <p class="mt-2"><strong><?= $lang['25'] ?></strong> (<?php echo $ax ?>,<?php echo $ay ?>,<?php echo $az ?>) + (<?php echo $bx ?>,<?php echo $by ?>,<?php echo $bz ?>) with multiples (<?php echo $alpha ?>,<?php echo $beta ?>)</p>
                            <p class="mt-2">=((<?php echo $ax; ?>*<?php echo $alpha ?>) + (<?php echo $bx; ?>*<?php echo $beta ?>) , (<?php echo $ay; ?>*<?php echo $alpha ?>) + (<?php echo $by; ?>*<?php echo $beta ?>) , (<?php echo $az; ?>*<?php echo $alpha ?>) + (<?php echo $bz; ?>*<?php echo $beta ?>))</p>
                            <p class="mt-2">=(<?php echo $detail['x'] ?> , <?php echo $detail['y'] ?> , <?php echo $detail['z'] ?>)</p>
                        <?php endif; ?>
                        <?php if ($detail['operation'] == "3") : ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['23']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">(<?php echo $detail['x'] ?>,<?php echo $detail['y'] ?>,<?php echo $detail['z'] ?>)</strong></p>
                            </div>
                        </div>
                            <p class="mt-2"><strong><?= $lang['24'] ?></strong></p>
                            <p class="mt-2"><strong><?= $lang['25'] ?></strong> (<?php echo $ax ?>,<?php echo $ay ?>,<?php echo $az ?>) - (<?php echo $bx ?>,<?php echo $by ?>,<?php echo $bz ?>).</p>
                            <p class="mt-2">=((<?php echo $ax; ?>) - (<?php echo $bx; ?>) , (<?php echo $ay; ?>) - (<?php echo $by; ?>) , (<?php echo $az; ?>) - (<?php echo $bz; ?>))</p>
                            <p class="mt-2">=(<?php echo $detail['x'] ?> , <?php echo $detail['y'] ?> , <?php echo $detail['z'] ?>)</p>
                        <?php endif; ?>
                        <?php if ($detail['operation'] == "4") : ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['23']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">(<?php echo $detail['x'] ?>,<?php echo $detail['y'] ?>,<?php echo $detail['z'] ?>)</strong></p>
                            </div>
                        </div>
                            <p class="mt-2"><strong><?= $lang['24'] ?></strong></p>
                            <p class="mt-2"><strong><?= $lang['25'] ?> $bx ?>,<?php echo $by ?>,<?php echo $bz ?>) with multiples (<?php echo $alpha ?>,<?php echo $beta ?>)</p>
                            <p class="mt-2">=((<?php echo $ax; ?>*<?php echo $alpha ?>) - (<?php echo $bx; ?>*<?php echo $beta ?>) , (<?php echo $ay; ?>*<?php echo $alpha ?>) - (<?php echo $by; ?>*<?php echo $beta ?>) , (<?php echo $az; ?>*<?php echo $alpha ?>) - (<?php echo $bz; ?>*<?php echo $beta ?>))</p>
                            <p class="mt-2">=(<?php echo $detail['x'] ?> , <?php echo $detail['y'] ?> , <?php echo $detail['z'] ?>)</p>
                        <?php endif; ?>
                        @else
                        <div class="col-lg-8 font-s-18">
                            <table class="w-100">
                                <?php if ($detail['method'] == "1") : ?>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['19'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['x'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['20'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['y'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['21'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['m'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['22'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['theta'], 2) ?><span class="font-s-16"> (rad) </span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['22'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['theta'] * 57.2958, 2) ?><span class="font-s-16"> (deg) </span></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if ($detail['method'] == "2") : ?>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['19'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['x'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['20'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['y'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['21'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['m'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['22'] ?>  :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['theta'], 2) ?><span class="black-text font_size22"> (rad) </span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['22'] ?>  :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['theta'] * 57.2958, 2) ?><span class="black-text font_size22"> (deg) </span></td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        var stokes = document.getElementById('stokes');
        var stokes2 = document.getElementById('stokes2');
        var azElements = document.querySelectorAll('.az');
        var bzElements = document.querySelectorAll('.bz');
        var xCoorElements = document.querySelectorAll('.x_coor');
        var dataXElements = document.querySelectorAll('.data_x');
        var yCoorElements = document.querySelectorAll('.y_coor');
        var dataYElements = document.querySelectorAll('.data_y');
        var alphaElements = document.querySelectorAll('.alpha');
        var betaElements = document.querySelectorAll('.beta');
        var vectorARepresentation = document.getElementById('vectora_representation');
        var vectorBRepresentation = document.getElementById('vectorb_representation');
        var buttElements = document.querySelectorAll('#butt1, #butt2, #butt3, #butt4');
        @if(isset($detail) || isset($error))
            var operation = document.getElementById('operation').value;
            if (operation == "1" || operation == "3") {
                alphaElements.forEach(function(el) {
                    el.style.display = 'none';
                });
                betaElements.forEach(function(el) {
                    el.style.display = 'none';
                });
            } else if (operation == "2" || operation == "4") {
                alphaElements.forEach(function(el) {
                    el.style.display = 'block';
                });
                betaElements.forEach(function(el) {
                    el.style.display = 'block';
                });
            }
            var calculation = document.getElementById('calculation');
            var q = calculation.value;
            if (q == "2D") {
                stokes.style.display = 'block';
                stokes2.style.display = 'block';
                azElements.forEach(function(el) { el.style.display = 'none'; });
                bzElements.forEach(function(el) { el.style.display = 'none'; });

                var h = document.getElementById('vectora_representation').value;
                if (h == "1") {
                    xCoorElements.forEach(function(el) { 
                        el.classList.add('row'); 
                        el.classList.remove('hidden'); 
                    });
                    dataXElements.forEach(function(el) { 
                        el.classList.remove('row'); 
                        el.classList.add('hidden'); 
                    });
                } else if (h == "2") {
                    xCoorElements.forEach(function(el) { 
                        el.classList.remove('row'); 
                        el.classList.add('hidden'); 
                    });
                    dataXElements.forEach(function(el) { 
                        el.classList.add('row'); 
                        el.classList.remove('hidden');
                    });
                }

                var h1 = document.getElementById('vectorb_representation').value;
                if (h1 == "1") {
                    yCoorElements.forEach(function(el) {
                        el.classList.add('row'); 
                        el.classList.remove('hidden');
                    });
                    dataYElements.forEach(function(el) { 
                        el.classList.remove('row'); 
                        el.classList.add('hidden'); 
                    });
                } else if (h1 == "2") {
                    yCoorElements.forEach(function(el) { 
                        el.classList.remove('row'); 
                        el.classList.add('hidden');
                    });
                    dataYElements.forEach(function(el) {
                        el.classList.add('row'); 
                        el.classList.remove('hidden'); 
                    });
                }
            } else if (q == "3D") {
                stokes.style.display = 'none';
                stokes2.style.display = 'none';
                dataXElements.forEach(function(el) {
                    el.classList.add('hidden');
                    el.classList.remove('row');
                });
                dataYElements.forEach(function(el) {
                    el.classList.add('hidden');
                    el.classList.remove('row');
                });
                azElements.forEach(function(el) { el.style.display = 'block'; });
                bzElements.forEach(function(el) { el.style.display = 'block'; });
                xCoorElements.forEach(function(el) {
                    el.classList.add('row');
                    el.classList.remove('hidden');
                });
                yCoorElements.forEach(function(el) {
                    el.classList.add('row');
                    el.classList.remove('hidden');
                });
            }
            var o = vectorARepresentation.value;
            if (o == "1") {
                xCoorElements.forEach(function(el) { 
                    el.classList.add('row'); 
                    el.classList.remove('hidden'); 
                });
                dataXElements.forEach(function(el) { 
                    el.classList.remove('row'); 
                    el.classList.add('hidden'); 
                });
            } else if (o == "2") {
                xCoorElements.forEach(function(el) { 
                    el.classList.remove('row'); 
                    el.classList.add('hidden'); 
                });
                dataXElements.forEach(function(el) { 
                    el.classList.add('row'); 
                    el.classList.remove('hidden');
                });
            }
            var p = vectorBRepresentation.value;
            if (p == "1") {
                yCoorElements.forEach(function(el) {
                    el.classList.add('row'); 
                    el.classList.remove('hidden');
                });
                dataYElements.forEach(function(el) { 
                    el.classList.remove('row'); 
                    el.classList.add('hidden'); 
                });
            } else if (p == "2") {
                yCoorElements.forEach(function(el) { 
                    el.classList.remove('row'); 
                    el.classList.add('hidden');
                });
                dataYElements.forEach(function(el) {
                    el.classList.add('row'); 
                    el.classList.remove('hidden'); 
                });
            }
        @endif

        document.addEventListener('DOMContentLoaded', function() {
            var operation = document.getElementById('operation');
            var alphaElements = document.querySelectorAll('.alpha');
            var betaElements = document.querySelectorAll('.beta');

            operation.addEventListener('change', function() {
                var a = this.value;

                if (a == "1" || a == "3") {
                    alphaElements.forEach(function(el) {
                        el.style.display = 'none';
                    });
                    betaElements.forEach(function(el) {
                        el.style.display = 'none';
                    });
                } else if (a == "2" || a == "4") {
                    alphaElements.forEach(function(el) {
                        el.style.display = 'block';
                    });
                    betaElements.forEach(function(el) {
                        el.style.display = 'block';
                    });
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            calculation.addEventListener('change', function() {
                var q = this.value;

                if (q == "2D") {
                    stokes.style.display = 'block';
                    stokes2.style.display = 'block';
                    azElements.forEach(function(el) { el.style.display = 'none'; });
                    bzElements.forEach(function(el) { el.style.display = 'none'; });

                    var h = document.getElementById('vectora_representation').value;
                    if (h == "1") {
                        xCoorElements.forEach(function(el) { 
                            el.classList.add('row'); 
                            el.classList.remove('hidden'); 
                        });
                        dataXElements.forEach(function(el) { 
                            el.classList.remove('row'); 
                            el.classList.add('hidden'); 
                        });
                    } else if (h == "2") {
                        xCoorElements.forEach(function(el) { 
                            el.classList.remove('row'); 
                            el.classList.add('hidden'); 
                        });
                        dataXElements.forEach(function(el) { 
                            el.classList.add('row'); 
                            el.classList.remove('hidden');
                        });
                    }

                    var h1 = document.getElementById('vectorb_representation').value;
                    if (h1 == "1") {
                        yCoorElements.forEach(function(el) {
                            el.classList.add('row'); 
                            el.classList.remove('hidden');
                        });
                        dataYElements.forEach(function(el) { 
                            el.classList.remove('row'); 
                            el.classList.add('hidden'); 
                        });
                    } else if (h1 == "2") {
                        yCoorElements.forEach(function(el) { 
                            el.classList.remove('row'); 
                            el.classList.add('hidden');
                        });
                        dataYElements.forEach(function(el) {
                            el.classList.add('row'); 
                            el.classList.remove('hidden'); 
                        });
                    }

                    buttElements.forEach(function(el) {
                        el.classList.add('s6');
                        el.classList.remove('s4');
                    });
                } else if (q == "3D") {
                    stokes.style.display = 'none';
                    stokes2.style.display = 'none';
                    dataXElements.forEach(function(el) {
                        el.classList.add('hidden');
                        el.classList.remove('row');
                    });
                    dataYElements.forEach(function(el) {
                        el.classList.add('hidden');
                        el.classList.remove('row');
                    });
                    azElements.forEach(function(el) { el.style.display = 'block'; });
                    bzElements.forEach(function(el) { el.style.display = 'block'; });
                    xCoorElements.forEach(function(el) {
                        el.classList.add('row');
                        el.classList.remove('hidden');
                    });
                    yCoorElements.forEach(function(el) {
                        el.classList.add('row');
                        el.classList.remove('hidden');
                    });
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var vectorARepresentation = document.getElementById('vectora_representation');
            var vectorBRepresentation = document.getElementById('vectorb_representation');
            var xCoorElements = document.querySelectorAll('.x_coor');
            var dataXElements = document.querySelectorAll('.data_x');
            var yCoorElements = document.querySelectorAll('.y_coor');
            var dataYElements = document.querySelectorAll('.data_y');

            vectorARepresentation.addEventListener('change', function() {
                var o = this.value;
                if (o == "1") {
                    xCoorElements.forEach(function(el) { 
                        el.classList.add('row'); 
                        el.classList.remove('hidden'); 
                    });
                    dataXElements.forEach(function(el) { 
                        el.classList.remove('row'); 
                        el.classList.add('hidden'); 
                    });
                } else if (o == "2") {
                    xCoorElements.forEach(function(el) { 
                        el.classList.remove('row'); 
                        el.classList.add('hidden'); 
                    });
                    dataXElements.forEach(function(el) { 
                        el.classList.add('row'); 
                        el.classList.remove('hidden');
                    });
                }
            });

            vectorBRepresentation.addEventListener('change', function() {
                var p = this.value;
                if (p == "1") {
                    yCoorElements.forEach(function(el) {
                        el.classList.add('row'); 
                        el.classList.remove('hidden');
                    });
                    dataYElements.forEach(function(el) { 
                        el.classList.remove('row'); 
                        el.classList.add('hidden'); 
                    });
                } else if (p == "2") {
                    yCoorElements.forEach(function(el) { 
                        el.classList.remove('row'); 
                        el.classList.add('hidden');
                    });
                    dataYElements.forEach(function(el) {
                        el.classList.add('row'); 
                        el.classList.remove('hidden'); 
                    });
                }
            });
        });
 </script>
@endpush