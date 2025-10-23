<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
    @endif
    <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-3">
                
                <div class="col-span-12 mx-auto">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2">
                        <select name="method_unit" id="method" class="input" autocomplete="off">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[11],$lang[12],$lang[13]];
                                $val = ["Standard method","Prevalence method","Percent error method"];
                                optionsList($val,$name,isset($_POST['method_unit'])?$_POST['method_unit']:'Standard method');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12" id="standard">
                    <div class="grid grid-cols-12 mt-3  gap-3">
                        <div class="col-span-6">
                            <label for="true_postive" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="true_postive" id="true_postive" value="{{ isset($_POST['true_postive'])?$_POST['true_postive']:'100' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="false_negative" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="false_negative" id="false_negative" value="{{ isset($_POST['false_negative'])?$_POST['false_negative']:'20' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="false_positive" class="font-s-14 text-blue">{{ $lang[4] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="false_positive" id="false_positive" value="{{ isset($_POST['false_positive'])?$_POST['false_positive']:'10' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="true_negative" class="font-s-14 text-blue">{{ $lang[5] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="true_negative" id="true_negative" value="{{ isset($_POST['true_negative'])?$_POST['true_negative']:'40' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 hidden" id="prevalence">
                    <div class="grid grid-cols-12 mt-3  gap-3">
                        <div class="col-span-6">
                            <label for="prevalenc" class="font-s-14 text-blue">{{ $lang[6] }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="prevalence" id="prevalenc" value="{{ isset($_POST['prevalence'])?$_POST['prevalence']:'10' }}" class="input" aria-label="input" placeholder="00" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="sensitivity" class="font-s-14 text-blue">{{ $lang[7] }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="sensitivity" id="sensitivity" value="{{ isset($_POST['sensitivity'])?$_POST['sensitivity']:'20' }}" class="input" aria-label="input" placeholder="00" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="specificity" class="font-s-14 text-blue">{{ $lang[8] }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="specificity" id="specificity" value="{{ isset($_POST['specificity'])?$_POST['specificity']:'10' }}" class="input" aria-label="input" placeholder="00" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 hidden" id="percent">
                    <div class="grid grid-cols-12 mt-3  gap-3">
                        <div class="col-span-6">
                            <label for="observed_value" class="font-s-14 text-blue">{{ $lang[9] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="observed_value" id="observed_value" value="{{ isset($_POST['observed_value'])?$_POST['observed_value']:'40' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="accepted_value" class="font-s-14 text-blue">{{ $lang[10] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="accepted_value" id="accepted_value" value="{{ isset($_POST['accepted_value'])?$_POST['accepted_value']:'50' }}" class="input" aria-label="input" placeholder="00" />
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
                        $request = request();
                        $true_postive = trim($request->true_postive);
                        $false_negative = trim($request->false_negative);
                        $false_positive = trim($request->false_positive);
                        $true_negative = trim($request->true_negative);
                        $prevalence = trim($request->prevalence);
                        $sensitivity = trim($request->sensitivity);
                        $specificity = trim($request->specificity);
                        $observed_value = trim($request->observed_value);
                        $accepted_value = trim($request->accepted_value);
                        $method_unit = trim($request->method_unit);
                    @endphp
                    <div class="w-full">
                        <?php if ($method_unit == "Standard method" || $method_unit == "Prevalence method") { ?>
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong><?= $lang[14] ?></strong>
                                </p>
                                <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ round($detail['answer'], 2) }}%</strong>
                                </p>
                            </div>
                        </div>
                        <?php }else{ ?>
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong><?= $lang[15] ?></strong>
                                </p>
                                <div class="flex justify-center">
                                    <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ round($detail['answer'], 2) }}%</strong>
                                </p>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if ($method_unit == "Standard method") { ?>
                            <p class="col-12 mt-2 text-[18px]"><strong class="text-blue"><?= $lang[19] ?></strong></p>
                            <p class="col-12 mt-2"><?= $lang[17] ?>.</p>
                            <p class="col-12 mt-2"><?= $lang[14] ?> = (TP + TN) / (TP + TN + FP + FN)</p>
                            <p class="col-12 mt-2"><?= $lang[14] ?> = (<?php echo $true_postive; ?> + <?php echo $true_negative; ?>) / (<?php echo $true_postive; ?> + <?php echo $true_negative; ?> + <?php echo $false_positive; ?> + <?php echo $false_negative; ?>)</p>
                            <p class="col-12 mt-2"><?= $lang[14] ?> = <?= round($detail['answer'], 4) ?></p>
                        <?php } elseif ($method_unit == "Prevalence method") { ?>
                            <p class="col-12 mt-2 text-[18px]"><strong class="text-blue"><?= $lang[19] ?></strong></p>
                            <p class="col-12 mt-2"><?= $lang[17] ?>.</p>
                            <p class="col-12 mt-2"><?= $lang[14] ?> = ((<?= $lang[7] ?>) * (<?= $lang[6] ?>)) + ((<?= $lang[8] ?>) * (1 - <?= $lang[6] ?>))</p>
                            <p class="col-12 mt-2"><?= $lang[14] ?> = (<?php echo $sensitivity; ?> *<?php echo $prevalence; ?>) + (<?php echo $specificity; ?> * (1 - <?php echo $prevalence; ?>))</p>
                            <p class="col-12 mt-2"><?= $lang[14] ?> = <?= round($detail['answer'], 4) ?></p>
                        <?php } else{ ?>
                            <p class="col-12 mt-2 text-[18px]"><strong><?= $lang[19] ?></strong></p>
                            <p class="col-12 mt-2"> <?= $lang[18] ?>.</p>
                            <p class="col-12 mt-2"><?= $lang[15] ?> = ((<?= $lang[9] ?> - <?= $lang[10] ?>
                                )/<?= $lang[10] ?>) * 100</p>
                            <p class="col-12 mt-2"><?= $lang[15] ?> = ((<?php echo $observed_value; ?> - <?php echo $accepted_value; ?>)/<?php echo $accepted_value; ?>) * 100</p>
                            <p class="col-12 mt-2"><?= $lang[15] ?> = <?= round($detail['answer'], 4) ?></p>
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
        // Function to update visibility based on the selected method
        function updateMethodVisibility() {
            let val = document.getElementById('method').value;
            if (val == 'Standard method') {
                document.getElementById('prevalence').style.display = 'none';
                document.getElementById('percent').style.display = 'none';
                document.getElementById('standard').style.display = 'block';
            } else if (val == 'Prevalence method') {
                document.getElementById('standard').style.display = 'none';
                document.getElementById('percent').style.display = 'none';
                document.getElementById('prevalence').style.display = 'block';
            } else {
                document.getElementById('percent').style.display = 'block';
                document.getElementById('standard').style.display = 'none';
                document.getElementById('prevalence').style.display = 'none';
            }
        }
        // Initial check when the page loads
        updateMethodVisibility();
        // Event listener for changes to the #method dropdown
        document.getElementById('method').addEventListener('change', updateMethodVisibility);
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>