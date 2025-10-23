<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-8">
                    <label for="incidence" class="labele">{{ $lang[1] }} (I):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="incidence" id="incidence" class="input" value="{{ isset($_POST['incidence'])?$_POST['incidence']:'10' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="incidence_unit" class="labele">&nbsp;</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="incidence_unit" id="incidence_unit" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['6'], $lang['7'], $lang['8'], $lang['9'], $lang['10'], $lang['11'], $lang['12'], $lang['13'], $lang['14'], $lang['15'], $lang['16'], $lang['17'], $lang['18'], $lang['19'], $lang['20'], $lang['21'], $lang['22'], $lang['23'], $lang['24'], $lang['25']];
                                $val = ["circle", "cycle", "degree", "gon", "gradian", "mil", "milliradian", "minute", "minutes of arc", "point", "quadrant", "quartercircle", "radian", "revolution", "right angle", "second", "semicircle", "sextant", "sign", "turn"];
                                optionsList($val,$name,isset($_POST['incidence_unit'])?$_POST['incidence_unit']:'degree');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-8">
                    <label for="emergence" class="labele">{{ $lang[2] }} (E):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="emergence" id="emergence" class="input" value="{{ isset($_POST['emergence'])?$_POST['emergence']:'35' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="emergence_unit" class="labele">&nbsp;</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="emergence_unit" id="emergence_unit" class="input">
                            @php
                                $name = [$lang['6'], $lang['7'], $lang['8'], $lang['9'], $lang['10'], $lang['11'], $lang['12'], $lang['13'], $lang['14'], $lang['15'], $lang['16'], $lang['17'], $lang['18'], $lang['19'], $lang['20'], $lang['21'], $lang['22'], $lang['23'], $lang['24'], $lang['25']];
                                $val = ["circle", "cycle", "degree", "gon", "gradian", "mil", "milliradian", "minute", "minutes of arc", "point", "quadrant", "quartercircle", "radian", "revolution", "right angle", "second", "semicircle", "sextant", "sign", "turn"];
                                optionsList($val,$name,isset($_POST['emergence_unit'])?$_POST['emergence_unit']:'degree');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-8">
                    <label for="prism" class="labele">{{ $lang[3] }} (A):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="prism" id="prism" class="input" value="{{ isset($_POST['prism'])?$_POST['prism']:'35' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="prism_unit" class="labele">&nbsp;</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="prism_unit" id="prism_unit" class="input">
                            @php
                                $name = [$lang['6'], $lang['7'], $lang['8'], $lang['9'], $lang['10'], $lang['11'], $lang['12'], $lang['13'], $lang['14'], $lang['15'], $lang['16'], $lang['17'], $lang['18'], $lang['19'], $lang['20'], $lang['21'], $lang['22'], $lang['23'], $lang['24'], $lang['25']];
                                $val = ["circle", "cycle", "degree", "gon", "gradian", "mil", "milliradian", "minute", "minutes of arc", "point", "quadrant", "quartercircle", "radian", "revolution", "right angle", "second", "semicircle", "sextant", "sign", "turn"];
                                optionsList($val,$name,isset($_POST['prism_unit'])?$_POST['prism_unit']:'degree');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="deviation_unit" class="labele">{{ $lang[4] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="deviation_unit" id="deviation_unit" class="input">
                            @php
                                $name = [$lang['6'], $lang['7'], $lang['8'], $lang['9'], $lang['10'], $lang['11'], $lang['12'], $lang['13'], $lang['14'], $lang['15'], $lang['16'], $lang['17'], $lang['18'], $lang['19'], $lang['20'], $lang['21'], $lang['22'], $lang['23'], $lang['24'], $lang['25']];
                                $val = ["circle", "cycle", "degree", "gon", "gradian", "mil", "milliradian", "minute", "minutes of arc", "point", "quadrant", "quartercircle", "radian", "revolution", "right angle", "second", "semicircle", "sextant", "sign", "turn"];
                                optionsList($val,$name,isset($_POST['deviation_unit'])?$_POST['deviation_unit']:'degree');
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
                    <div class="w-full">
                        @php
                            $request = request();
                            $deviation_unit=trim($request->deviation_unit);
                            $incidence=trim($request->incidence);
                            $incidence_unit=trim($request->incidence_unit);
                            $emergence=trim($request->emergence);
                            $emergence_unit=trim($request->emergence_unit);
                            $prism=trim($request->prism);
                            $prism_unit=trim($request->prism_unit);
                        @endphp
                        <div class="text-center">
                            <p class="text-[18px]"><strong>{{$lang['5']}} (D)</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                                <strong class=""><?= $detail['deviation'] ?> <?php echo $deviation_unit; ?></strong>
                            </p>
                        </div>
                    </div>
                        <p class="col-12 mt-3 text-[18px]"><strong><?= $lang[31] ?></strong></p>
                        <p class="col-12 mt-2">(<?= $lang[26] ?>)</p>
                        <p class="col-12 mt-2"><?= $lang[5] ?> = <?= $lang[1] ?> + <?= $lang[2] ?> - <?= $lang[3] ?></p>
                        <p class="col-12 mt-2">D= I + E - A</p>
                        <p class="col-12 mt-2"><?= $lang[27] ?></p>
                        <p class="col-12 mt-2"><?= $lang[1] ?>: <?php echo $incidence; ?> -> <?= $detail['incidence'] ?>(<?php echo $incidence_unit; ?>)</p>
                        <p class="col-12 mt-2"><?= $lang[2] ?>: <?php echo $emergence; ?> -> <?= $detail['emergence'] ?>(<?php echo $emergence_unit; ?>) </p>
                        <p class="col-12 mt-2"><?= $lang[3] ?>: <?php echo $prism; ?> -> <?= $detail['prism'] ?>(<?php echo $prism_unit; ?>)</p>
                        <p class="col-12 mt-2"><?= $lang[28] ?></p>
                        <p class="col-12 mt-2">D= I + E - A -> <?= $detail['incidence'] ?> +<?= $detail['emergence'] ?> - <?php echo $prism; ?></p>
                        <p class="col-12 mt-2"><?= $lang[29] ?></p>
                        <p class="col-12 mt-2">D= <?= $detail['deviation'] ?></p>
                        <p class="col-12 mt-2"><?= $lang[30] ?></p>
                        <p class="col-12 mt-2">D = <?= $detail['deviation'] ?> <?php echo $deviation_unit; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
    
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>