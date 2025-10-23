<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-12 px-2 mx-auto">
                            <label for="optionSelect" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            <div class="w-full py-2">
                                <select name="optionSelect" id="optionSelect" class="input" autocomplete="off">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                            {!! $arr2[$index] !!}
                                        </option>
                                    @php
                                        }}
                                        $name = ["Addition", "Subtraction", "Multiplication", "Division"];
                                        $val = ["addition", "subtraction", "multiplication", "division"];
                                        optionsList($val,$name,isset($_POST['optionSelect'])?$_POST['optionSelect']:'addition');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12" id="addition">
                            <p class="w-full mt-2 text-center">\( Z &equals; X &plus; Y\)</p>
                            <p class="w-full my-3 text-center">\( ΔZ &equals; \sqrt{(ΔX)^2 &plus; (ΔY)^2}\)</p>
                        </div>
                        <div class="col-span-12 hidden" id="subtraction">
                            <p class="w-full mt-2 text-center">\( Z &equals; X &minus; Y\)</p>
                            <p class="w-full my-3 text-center">\( ΔZ &equals; \sqrt{(ΔX)^2 &plus; (ΔY)^2}\)</p>
                        </div>
                        <div class="col-span-12 hidden" id="multiplication">
                            <p class="w-full mt-2 text-center">\( Z = X \cdot Y\)</p>
                            <p class="w-full my-3 text-center">\( ΔZ = Z \cdot \sqrt{(\dfrac{ΔX}{X})^2 + (\dfrac{ΔY}{Y})^2}\)</p>
                        </div>
                        <div class="col-span-12 hidden" id="division">
                            <p class="w-full mt-2 text-center">\( Z &equals; \dfrac {X} {Y}\)</p>
                            <p class="w-full my-3 text-center">\( ΔZ &equals; Z \cdot \sqrt{(\dfrac{ΔX}{X})^2 &plus; (\dfrac{ΔY}{Y})^2}\)</p>
                        </div>
                        <div class="col-span-6 px-2">
                            <label for="x" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="x" id="x" value="{{ isset($_POST['x'])?$_POST['x']:'850' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6 px-2">
                            <label for="delta_x" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="delta_x" id="delta_x" value="{{ isset($_POST['delta_x'])?$_POST['delta_x']:'600' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6 px-2">
                            <label for="y" class="font-s-14 text-blue">{{ $lang[4] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="y" id="y" value="{{ isset($_POST['y'])?$_POST['y']:'400' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6 px-2">
                            <label for="delta_y" class="font-s-14 text-blue">{{ $lang[5] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="delta_y" id="delta_y" value="{{ isset($_POST['delta_y'])?$_POST['delta_y']:'900' }}" class="input" aria-label="input" placeholder="00" />
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
                
                <div class="w-full  mt-3">
                    <div class="w-full">
                        @php
                            $request = request();
                            $x = $request->x;
                            $y = $request->y;
                            $delta_x = $request->delta_x;
                            $delta_y = $request->delta_y;
                            $optionSelect = $request->optionSelect;
                        @endphp
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                            <table class="w-fill text-[20px]">
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['6'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ $detail['z'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang['7'] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['delta_z'] ,2) }}</strong></td>
                                </tr>                        
                            </table>
                        </div>
                        <p class="w-full mt-3 text-[20px]"><strong class="text-blue"><?= $lang['8']?></strong></p>
                        <p class="w-full mt-2"><?= $lang['2']?> : <?php echo $x; ?></p>
                        <p class="w-full mt-2"> <?= $lang['3']?> : <?php echo $delta_x; ?></p>
                        <p class="w-full mt-2"><?= $lang['4']?> : <?php echo $y; ?></p>
                        <p class="w-full mt-2"> <?= $lang['5']?> : <?php echo $delta_y; ?></p>
            
                        <!-- -------------------------- Solution ----------------------- -->
                        <p class="w-full mt-3 text-[20px]"><strong class="text-blue"><?= $lang['9']?></strong></p>
            
                        <?php if($optionSelect === 'addition'){ ?>
                            <p class="w-full mt-2"><?= $lang['10']?></p>
                            <p class="w-full mt-3">\( Z &equals; X &plus; Y\)</p>
                            <p class="w-full mt-3">\( Z &equals; <?php echo $x ?> &plus;<?php echo $y ?>\)</p>
                            <p class="w-full mt-3">\( Z &equals; <?= $detail['z']  ?>\)</p>
                            <p class="w-full mt-3">\( ΔZ &equals; \sqrt{(ΔX)^2 &plus; (ΔY)^2}\)</p>
                            <p class="w-full mt-3">\( ΔZ &equals; \sqrt{(<?php echo $delta_x ?>)^2 &plus;(<?php echo $delta_y ?>)^2}\)</p>
                            <p class="w-full mt-3">\( ΔZ &equals; <?= round($detail['delta_z'],2)?>\)</p>
                        <?php } elseif($optionSelect === 'subtraction'){ ?>
                            <p class="w-full mt-2"><?= $lang['11']?></p>
                            <p class="w-full mt-3">\( Z &equals; X &minus; Y\)</p>
                            <p class="w-full mt-3">\( Z &equals; <?php echo $x ?> &minus; <?php echo $y ?>\)</p>
                            <p class="w-full mt-3">\( Z &equals; <?= $detail['z']?>\)</p>
                            <p class="w-full mt-3">\( ΔZ &equals; \sqrt{(ΔX)^2 &plus; (ΔY)^2}\)</p>
                            <p class="w-full mt-3">\( ΔZ &equals; \sqrt{(<?php echo $delta_x ?>)^2 &plus;(<?php echo $delta_y ?>)^2}\)</p>
                            <p class="w-full mt-3">\( ΔZ &equals; <?= round($detail['delta_z'],2)?>\)</p>
                        <?php } elseif($optionSelect === 'multiplication'){ ?>
                            <p class="w-full mt-2"><?= $lang['12']?></p>
                            <p class="w-full mt-3">\( Z = X \cdot Y \)</p>
                            <p class="w-full mt-3">\( Z = <?php echo $x ?> \cdot <?php echo $y ?>\)</p>
                            <p class="w-full mt-3">\( Z = <?= $detail['z']?>\)</p>
                            <p class="w-full mt-3">\( ΔZ = Z \cdot \sqrt{(\dfrac{ΔX}{X})^2 +(\dfrac{ΔY}{Y})^2}\)</p>
                            <p class="w-full mt-3">\( ΔZ = <?= $detail['z']?> \cdot \sqrt{(\dfrac{<?php echo $delta_x ?>}{<?php echo $x ?>})^2 +(\dfrac{<?php echo $delta_y ?>}{<?php echo $y ?>})^2}\)</p>
                            <p class="w-full mt-3">\( ΔZ &equals; <?= round($detail['delta_z'],2)?>\)</p>
                        <?php  } elseif($optionSelect === 'division'){ ?>      
                            <p class="w-full mt-2"><?= $lang['13']?></p>
                            <p class="w-full mt-3">\( Z &equals; \dfrac {X} {Y}\)</p>
                            <p class="w-full mt-3">\( Z &equals; \dfrac {<?php echo $x ?>} {<?php echo $y ?>}\)</p>
                            <p class="w-full mt-3">\( Z &equals; <?= $detail['z']?>\)</p>
                            <p class="w-full mt-3">\( ΔZ &equals; Z \cdot \sqrt{(\dfrac{ΔX}{X})^2 &plus;(\dfrac{ΔY}{Y})^2}\)</p>
                            <p class="w-full mt-3">\( ΔZ &equals; <?= $detail['z']?> \cdot \sqrt{(\dfrac{<?php echo $delta_x ?>}{ <?php echo $x ?>})^2 &plus;(\dfrac{<?php echo $delta_y ?>}{<?php echo $y ?>})^2}\)</p>
                            <p class="w-full mt-3">\( ΔZ &equals; <?= round($detail['delta_z'],2)?>\)</p>
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
        const optionSelect = document.getElementById('optionSelect');
        const division = document.getElementById('division');
        const multiplication = document.getElementById('multiplication');
        const subtraction = document.getElementById('subtraction');
        const addition = document.getElementById('addition');

        // Function to hide all operations
        function hideAllOperations() {
            addition.classList.add('hidden');
            subtraction.classList.add('hidden');
            multiplication.classList.add('hidden');
            division.classList.add('hidden');
        }

        updateDisplay(optionSelect.value);
        function updateDisplay(val){

      
            hideAllOperations();
            if (val == 'addition') {
                addition.classList.remove('hidden');
            } else if (val == 'subtraction') {
                subtraction.classList.remove('hidden');
            } else if (val == 'multiplication') {
                multiplication.classList.remove('hidden');
            } else if (val == 'division') {
                division.classList.remove('hidden');
            }
        }
        optionSelect.addEventListener('change', function() {
            // Hide all operations first
            updateDisplay(optionSelect.value);
        });
        </script>
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>