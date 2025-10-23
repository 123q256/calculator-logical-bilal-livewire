<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="calculation" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="calculation" id="calculation" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[2], $lang[3], $lang[4], $lang[5]];
                                $val = [1, 2, 3, 4];
                                optionsList($val,$name,isset($_POST['calculation'])?$_POST['calculation']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="input" class="font-s-14 text-blue" id="text_change">{{ $lang[6] }}</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="input" id="input" class="input" value="{{ isset($_POST['input'])?$_POST['input']:'5' }}" aria-label="input" placeholder="00" />
                        <span class="text-blue input_unit" id="unit_text">dBm</span>
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
                                $calculation = trim($request->calculation);
                            @endphp
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong>
                                        <?php if ($calculation === "1") { ?>
                                            <?= $lang[7] ?> (<?= $lang[8] ?>)
                                        <?php }else if ($calculation === "2"){ ?>
                                            <?= $lang[7] ?> (<?= $lang[8] ?>)
                                        <?php }else if ($calculation === "3"){ ?>
                                            <?= $lang[7] ?> (<?= $lang[9] ?>)
                                        <?php } else { ?>
                                            <?= $lang[7] ?> (<?= $lang[9] ?>)
                                        <?php } ?>
                                    </strong>
                                </p>
                                <div class="flex justify-center">
                                    <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                                    <strong>{{ round($detail['answer'], 4) . ' ' .$detail['unit'] }}</strong>
                                </p>
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
            const calculationElement = document.getElementById('calculation');
            const textChangeElement = document.getElementById('text_change');
            const unitTextElement = document.getElementById('unit_text');

            function updateTextAndUnit() {
                const method_val = calculationElement.value;
                if (method_val === "1") {
                    textChangeElement.textContent = "<?= $lang[6] ?>";
                    unitTextElement.textContent = "dBm";
                } else if (method_val === "2") {
                    textChangeElement.textContent = "<?= $lang[3] ?>";
                    unitTextElement.textContent = "dBm";
                } else if (method_val === "3") {
                    textChangeElement.textContent = "<?= $lang[4] ?>";
                    unitTextElement.textContent = "W";
                } else {
                    textChangeElement.textContent = "<?= $lang[5] ?>";
                    unitTextElement.textContent = "mW";
                }
            }

            calculationElement.addEventListener('change', function() {
                updateTextAndUnit();
            });

            // Initial update
            updateTextAndUnit();
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>