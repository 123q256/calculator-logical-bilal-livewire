<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="choice" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2"> 
                        <select class="input" name="choice" id="choice">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang[2],$lang[3]];
                                $val = ["1","2"];
                                optionsList($val,$name,isset($_POST['choice'])?$_POST['choice']:'1');
                            @endphp
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="racial_choice" class="label">{{ $lang['4'] }}:</label>
                    <div class="w-full py-2">
                        <select class="input" name="racial_choice" id="racial_choice">
                            @php
                                $name = [$lang[5],$lang[6]." (".$lang[7].")","Elf (".$lang[8].")",$lang[9]." (".$lang[10].")",$lang[11]."-Elf",$lang[11]."-Orc",$lang[12]." (".$lang[13].")",$lang[14],$lang[15],$lang[16],$lang[17],$lang[18],$lang[19],$lang[20],$lang[21],$lang[22],$lang[23],$lang[24],$lang[25],$lang[26],$lang[12],$lang[27],$lang[28],$lang[29],$lang[30],$lang[31],$lang[32],$lang[33],$lang[34],$lang[35],$lang[36],$lang[37],$lang[38],$lang[39],$lang[40]];
                                $val = ["2.0.0.0.0.1","0.0.2.0.1.0","0.2.0.1.0.0","0.0.1.0.2.0","0.0.0.0.0.2","2.0.1.0.0.0","0.2.0.0.0.1","1.1.1.1.1.1","0.0.0.1.0.2","0.2.0.0.0.1","0.0.0.0.0.2","2.1.0.0.0.0","2.0.0.0.1.0","1.0.0.0.2.0","0.0.2.0.0.0","0.0.0.1.0.0","0.0.0.2.0.0","0.2.1.0.0.0","2.0.1.0.0.0","0.2.1.0.0.0","0.2.0.0.0.0","0.0.2.1.0.0","0.0.0.0.2.1","0.2.0.0.1.0","0.2.0.0.0.0","1.0.2.0.0.0","0.0.2.0.1.0","2.1.0.0.0.0","0.0.2.0.1.0","2.0.1.0.0.0","0.1.0.0.0.2","0.2.0.0.0.1","2.0.0.0.1.0","1.0.1.0.0.1","39"];
                                optionsList($val,$name,isset($_POST['racial_choice'])?$_POST['racial_choice']:'1.1.1.1.1.1');
                            @endphp
                        </select>
                    </div>
                </div>

                <div class="col-span-12 custmize hidden">

                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-4 md:col-span-4 lg:col-span-4">
                        <label for="points_budget" class="label"><?= $lang[41] ?>:</label>
                        <div class="w-full py-2"> 
                            <input type="number" step="any" name="points_budget" id="points_budget" class="input" aria-label="input"  value="{{ isset(request()->points_budget)?request()->points_budget:'27' }}" />
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-4 lg:col-span-4">
                        <label for="smallest_score" class="label"><?= $lang[42] ?>:</label>
                        <div class="w-full py-2"> 
                            <input type="number" step="any" name="smallest_score" id="smallest_score" class="input small_look" aria-label="input"  value="{{ isset(request()->smallest_score)?request()->smallest_score:'8' }}" />
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-4 lg:col-span-4">
                        <label for="largest_score" class="label"><?= $lang[43] ?>:</label>
                        <div class="w-full py-2"> 
                            <input type="number" step="any" name="largest_score" id="largest_score" class="input large_look" aria-label="input"  value="{{ isset(request()->largest_score)?request()->largest_score:'15' }}" />
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s1" class="label">3:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s1" id="s1" class="input" aria-label="input"  value="<?=isset(request()->s1)?request()->s1:'-9'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s2" class="label">4:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s2" id="s2" class="input" aria-label="input"  value="<?=isset(request()->s2)?request()->s2:'-6'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s3" class="label">5:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s3" id="s3" class="input" aria-label="input"  value="<?=isset(request()->s3)?request()->s3:'-4'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s4" class="label">6:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s4" id="s4" class="input" aria-label="input"  value="<?=isset(request()->s4)?request()->s4:'-2'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s5" class="label">7:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s5" id="s5" class="input" aria-label="input"  value="<?=isset(request()->s5)?request()->s5:'-1'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s6" class="label">8:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s6" id="s6" class="input" aria-label="input"  value="<?=isset(request()->s6)?request()->s6:'0'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s7" class="label">9:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s7" id="s7" class="input" aria-label="input"  value="<?=isset(request()->s7)?request()->s7:'1'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s8" class="label">10:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s8" id="s8" class="input" aria-label="input"  value="<?=isset(request()->s8)?request()->s8:'2'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s9" class="label">11:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s9" id="s9" class="input" aria-label="input"  value="<?=isset(request()->s9)?request()->s9:'3'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s10" class="label">12:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s10" id="s10" class="input" aria-label="input"  value="<?=isset(request()->s10)?request()->s10:'4'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s11" class="label">13:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s11" id="s11" class="input" aria-label="input"  value="<?=isset(request()->s11)?request()->s11:'5'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s12" class="label">14:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s12" id="s12" class="input" aria-label="input"  value="<?=isset(request()->s12)?request()->s12:'7'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s13" class="label">15:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s13" id="s13" class="input" aria-label="input"  value="<?=isset(request()->s13)?request()->s13:'9'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s14" class="label">16:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s14" id="s14" class="input" aria-label="input"  value="<?=isset(request()->s14)?request()->s14:'12'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s15" class="label">17:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s15" id="s15" class="input" aria-label="input"  value="<?=isset(request()->s15)?request()->s15:'15'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                        <label for="s16" class="label">18:</label>
                        <div class="w-full py-2 relative"> 
                            <input type="number" step="any" name="s16" id="s16" class="input" aria-label="input"  value="<?=isset(request()->s16)?request()->s16:'19'?>" />
                            <span class="text-blue input_unit"><?=$lang[44]?></span>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <label for="strength" class="label"><?= $lang[46] ?>:</label>
                    <div class="w-full py-2"> 
                        <input type="number" step="any" name="strength" id="strength" class="input" aria-label="input"  value="{{ isset(request()->strength)?request()->strength:'8' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <label for="dexerity" class="label"><?= $lang[47] ?>:</label>
                    <div class="w-full py-2"> 
                        <input type="number" step="any" name="dexerity" id="dexerity" class="input" aria-label="input"  value="{{ isset(request()->dexerity)?request()->dexerity:'8' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <label for="intelligence" class="label"><?= $lang[48] ?>:</label>
                    <div class="w-full py-2"> 
                        <input type="number" step="any" name="intelligence" id="intelligence" class="input" aria-label="input"  value="{{ isset(request()->intelligence)?request()->intelligence:'8' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <label for="wisdom" class="label"><?= $lang[49] ?>:</label>
                    <div class="w-full py-2"> 
                        <input type="number" step="any" name="wisdom" id="wisdom" class="input" aria-label="input"  value="{{ isset(request()->wisdom)?request()->wisdom:'8' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <label for="charisma" class="label"><?= $lang[50] ?>:</label>
                    <div class="w-full py-2"> 
                        <input type="number" step="any" name="charisma" id="charisma" class="input" aria-label="input"  value="{{ isset(request()->charisma)?request()->charisma:'8' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <label for="constitution" class="label"><?= $lang[51] ?>:</label>
                    <div class="w-full py-2"> 
                        <input type="number" step="any" name="constitution" id="constitution" class="input" aria-label="input"  value="{{ isset(request()->constitution)?request()->constitution:'8' }}" />
                    </div>
                </div>
                <div class="col-span-12 others hidden">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12"><?= $lang[52] ?></p>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="strength1" class="label"><?= $lang[46] ?>:</label>
                        <div class="w-full py-2"> 
                            <input type="number" step="any" name="strength1" id="strength1" class="input" aria-label="input"  value="{{ isset(request()->strength1)?request()->strength1:'6' }}" />
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="dexerity1" class="label"><?= $lang[47] ?>:</label>
                        <div class="w-full py-2"> 
                            <input type="number" step="any" name="dexerity1" id="dexerity1" class="input" aria-label="input"  value="{{ isset(request()->dexerity1)?request()->dexerity1:'6' }}" />
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="intelligence1" class="label"><?= $lang[48] ?>:</label>
                        <div class="w-full py-2"> 
                            <input type="number" step="any" name="intelligence1" id="intelligence1" class="input" aria-label="input"  value="{{ isset(request()->intelligence1)?request()->intelligence1:'6' }}" />
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="wisdom1" class="label"><?= $lang[49] ?>:</label>
                        <div class="w-full py-2"> 
                            <input type="number" step="any" name="wisdom1" id="wisdom1" class="input" aria-label="input"  value="{{ isset(request()->wisdom1)?request()->wisdom1:'6' }}" />
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="charisma1" class="label"><?= $lang[50] ?>:</label>
                        <div class="w-full py-2"> 
                            <input type="number" step="any" name="charisma1" id="charisma1" class="input" aria-label="input"  value="{{ isset(request()->charisma1)?request()->charisma1:'6' }}" />
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="constitution1" class="label"><?= $lang[51] ?>:</label>
                        <div class="w-full py-2"> 
                            <input type="number" step="any" name="constitution1" id="constitution1" class="input" aria-label="input"  value="{{ isset(request()->constitution1)?request()->constitution1:'6' }}" />
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
    @else
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="row">
                            <div class="w-full md:w-[80%] lg:w-[80%] text-[18px]">
                                <table class="w-full">
                                    <tr>
                                      <th class="border-b py-2"><?=$lang[53]?></th>
                                      <th class="border-b py-2"><?=$lang[54]?></th>
                                      <th class="border-b py-2"><?=$lang[55]?></th>
                                      <th class="border-b py-2"><?=$lang[56]?></th>
                                      <th class="border-b py-2"><?=$lang[57]?></th>
                                      <th class="border-b py-2"><?=$lang[58]?></th>
                                    </tr> 
                                    <tr>
                                      <td class="border-b py-2"><?=$lang[46]?></td>
                                      <td class="border-b py-2"><?php echo $detail['strength'] ?></td>
                                      <td class="border-b py-2"><?php echo "+".$detail['strength_racial_bonus'] ?></td>
                                      <td class="border-b py-2"><?php echo $detail['strength']+$detail['strength_racial_bonus']; ?></td>
                                      <td class="border-b py-2"><?php echo round(($detail['strength']+$detail['strength_racial_bonus']-10)/2); ?></td>
                                      <td class="border-b py-2"><?php echo $detail['strength_value'] ?></td>
                                    </tr>  
                                    <tr>
                                      <td class="border-b py-2"><?=$lang[47]?></td>
                                      <td class="border-b py-2"><?php echo $detail['dexerity'] ?></td>
                                      <td class="border-b py-2"><?php echo "+".$detail['dexerity_racial_bonus'] ?></td>
                                      <td class="border-b py-2"><?php echo $detail['dexerity']+$detail['dexerity_racial_bonus'] ?></td>
                                       <td class="border-b py-2"><?php echo round(($detail['dexerity']+$detail['dexerity_racial_bonus']-10)/2); ?></td>
                                      <td class="border-b py-2"><?php echo $detail['dexerity_value'] ?></td>
                                    </tr>
                                     <tr>
                                      <td class="border-b py-2"><?=$lang[51]?></td>
                                      <td class="border-b py-2"><?php echo $detail['constitution'] ?></td>
                                      <td class="border-b py-2"><?php echo "+".$detail['constitution_racial_bonus'] ?></td>
                                    <td class="border-b py-2"><?php echo $detail['constitution']+$detail['constitution_racial_bonus'] ?></td>
                                        <td class="border-b py-2"><?php echo round(($detail['constitution']+$detail['constitution_racial_bonus']-10)/2); ?></td>
                                      <td class="border-b py-2"><?php echo $detail['constitution_value'] ?></td>
                                    </tr>
                                     <tr>
                                      <td class="border-b py-2"><?=$lang[48]?></td>
                                      <td class="border-b py-2"><?php echo $detail['intelligence'] ?></td>
                                      <td class="border-b py-2"><?php echo "+".$detail['intelligence_racial_bonus'] ?></td>
                                      <td class="border-b py-2"><?php echo $detail['intelligence']+$detail['intelligence_racial_bonus'] ?></td>
                                     <td class="border-b py-2"><?php echo round(($detail['intelligence']+$detail['intelligence_racial_bonus']-10)/2); ?></td>
                                      <td class="border-b py-2"><?php echo $detail['intelligence_value'] ?></td>
                                    </tr>
                                    <tr>
                                      <td class="border-b py-2"><?=$lang[49]?></td>
                                      <td class="border-b py-2"><?php echo $detail['wisdom'] ?></td>
                                      <td class="border-b py-2"><?php echo "+".$detail['wisdom_racial_bonus'] ?></td>
                                   <td class="border-b py-2"><?php echo $detail['wisdom']+$detail['wisdom_racial_bonus'] ?></td>
                                      <td class="border-b py-2"><?php echo round(($detail['wisdom']+$detail['wisdom_racial_bonus']-10)/2); ?></td>
                                      <td class="border-b py-2"><?php echo $detail['wisdom_value'] ?></td>
                                    </tr>
                                    <tr>
                                      <td class="border-b py-2"><?=$lang[50]?></td>
                                      <td class="border-b py-2"><?php echo $detail['charisma'] ?></td>
                                      <td class="border-b py-2"><?php echo "+".$detail['charisma_racial_bonus'] ?></td>
                                     <td class="border-b py-2"><?php echo $detail['charisma']+$detail['charisma_racial_bonus'] ?></td>
                                        <td class="border-b py-2"><?php echo round(($detail['charisma']+$detail['charisma_racial_bonus']-10)/2); ?></td>
                                      <td class="border-b py-2"><?php echo $detail['charisma_value'] ?></td>
                                     </tr>
                               </table>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-[25px]">
                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                                @if (app()->getLocale() == 'en')
                                    RESET
                                @else
                                    {{ $lang['reset'] ?? 'RESET' }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endif
</form>
@push('calculatorJS')
    <script>
        document.querySelectorAll(".small_look").forEach(function(element) {
            element.addEventListener("blur", function() {
                var w = parseFloat(this.value);
                if (w <= 3 || w >= 18) {
                    alert("Values less than 3 and greater than 18 are not allowed");
                }
            });
        });
        document.querySelectorAll(".large_look").forEach(function(element) {
            element.addEventListener("blur", function() {
                var l = parseFloat(this.value);
                if (l <= 3 || l >= 18) {
                    alert("Values less than 3 and greater than 18 are not allowed");
                }
            });
        });
        var custmize = document.querySelector('.custmize');
        var others = document.querySelector('.others');
        @if(isset($error))
            var choice = document.getElementById('choice').value;
            if(choice === '2'){
                custmize.classList.add('row');
                custmize.classList.remove('hidden');
            }else{
                custmize.classList.add('hidden');
                custmize.classList.remove('row');
            }
            var racial_choice = document.getElementById('racial_choice').value;
            if(racial_choice === '39'){
                others.classList.add('row');
                others.classList.remove('hidden');
            }else{
                others.classList.add('hidden');
                others.classList.remove('row');
            }
        @endif
        document.getElementById('choice').addEventListener('change',function(){
            var choice = this.value;
            if(choice === '2'){
                custmize.classList.add('row');
                custmize.classList.remove('hidden');
            }else{
                custmize.classList.add('hidden');
                custmize.classList.remove('row');
            }
        });
        document.getElementById('racial_choice').addEventListener('change',function(){
            var racial_choice = this.value;
            if(racial_choice === '39'){
                others.classList.add('row');
                others.classList.remove('hidden');
            }else{
                others.classList.add('hidden');
                others.classList.remove('row');
            }
        });
    </script>
@endpush

