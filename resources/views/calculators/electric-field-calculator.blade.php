<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="grid grid-cols-12  gap-4">
               
               <div class="col-span-12 md:col-span-6 lg:col-span-6">
                   <label for="selection" class="label">{{ $lang['1'] }} a:</label>
                   <div class="w-100 py-2 position-relative">
                       <select name="selection" id="selection" class="input">
                        <option value="1" {{ isset($_POST['selection']) && $_POST['selection'] == '1' ? 'selected' : '' }}>{{ $lang['2'] }}</option>
                        <option value="2" {{ isset($_POST['selection']) && $_POST['selection'] == '2' ? 'selected' : '' }}>{{ $lang['3'] }}</option>
                       </select>
                   </div>
               </div>
               <div class="col-span-12 md:col-span-6 lg:col-span-6 dis calculate1">
                   <label for="selection2" class="label">{{ $lang['4'] }}:</label>
                   <div class="w-100 py-2 position-relative">
                       <select name="selection3" id="selection2" class="input">
                        <option value="1" {{ isset($_POST['selection3']) && $_POST['selection3'] == '1' ? 'selected' : '' }}>{{ $lang['5'] }}</option>
                        <option value="2" {{ isset($_POST['selection3']) && $_POST['selection3'] == '2' ? 'selected' : '' }}>{{ $lang['6'] }}</option>
                        <option value="3" {{ isset($_POST['selection3']) && $_POST['selection3'] == '3' ? 'selected' : '' }}>{{ $lang['7'] }}</option>
                       </select>
                   </div>
               </div>
               <div class="col-span-12 md:col-span-6 lg:col-span-6">
                   <label for="per" class="label">{{ $lang[8] }}:</label>
                   <div class="w-full py-2 position-relative">
                       <input type="number" step="any" name="per" id="per" class="input" value="{{ isset($_POST['per'])?$_POST['per']:'5' }}" aria-label="input" placeholder="00" />
                   </div>
               </div>
               <div class="col-span-6 charge" id="charge">
                <label for="charge1" class="label ch"><?=$lang['7']?></label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="charge" id="charge1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['charge'])?$_POST['charge']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="c_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('c_unit_dropdown')">{{ isset($_POST['c_unit'])?$_POST['c_unit']:'μC' }} ▾</label>
                   <input type="text" name="c_unit" value="{{ isset($_POST['c_unit'])?$_POST['c_unit']:'μC' }}" id="c_unit" class="hidden">
                   <div id="c_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="c_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'PC')">PC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'NC')">NC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'μC')">μC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'mC')">mC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'C')">C</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'e')">e</p>
                      
                   </div>
                </div>
              </div>
              <div class="col-span-6 distance" id="distance">
                <label for="distance1" class="label di"><?=$lang['6']?></label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="distance" id="distance1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance'])?$_POST['distance']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="d_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('d_unit_dropdown')">{{ isset($_POST['d_unit'])?$_POST['d_unit']:'nm' }} ▾</label>
                   <input type="text" name="d_unit" value="{{ isset($_POST['d_unit'])?$_POST['d_unit']:'nm' }}" id="d_unit" class="hidden">
                   <div id="d_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="d_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'nm')">nm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'μm')">μm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'mm')">mm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'cm')">cm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'm')">m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'km')">km</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'in')">in</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'ft')">ft</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'yd')">yd</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'mi')">mi</p>
                   </div>
                </div>
              </div>
           
               <div class="col-span-6 electric_field">
                   <label for="electric_field" class="label di"><?=$lang['5']?></label>
                   <div class="w-full py-2 relative">
                       <input type="number" step="any" name="electric_field" id="electric_field" class="input" value="{{ isset($_POST['electric_field'])?$_POST['electric_field']:'2' }}" aria-label="input" placeholder="00" />
                       <span class="input_unit">N/C</span>
                   </div>
               </div>
               <div class="col-span-12 hidden cd">
                <div class="grid grid-cols-12  gap-4">
                    <div class="col-span-6 dis">
                        <label for="charge_1" class="label c1"><?=$lang['7']?> 2</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="charge1[]" id="charge1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="charge_unit_1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('charge_unit_1_dropdown')">{{ isset($_POST['charge_unit_1'])?$_POST['charge_unit_1']:'nm' }} ▾</label>
                           <input type="text" name="charge_unit[]" value="{{ isset($_POST['charge_unit_1'])?$_POST['charge_unit_1']:'nm' }}" id="charge_unit_1" class="hidden">
                           <div id="charge_unit_1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="charge_unit_1">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit_1', 'PC')">PC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit_1', 'NC')">NC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit_1', 'μC')">μC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit_1', 'mC')">mC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit_1', 'C')">C</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit_1', 'e')">e</p>
                           </div>
                        </div>
                      </div>
                      <div class="col-span-6 dis">
                        <label for="distance_1" class="label d1"><?=$lang['6']?> 2</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="distance1[]" id="distance_1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="distance_unit_1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('distance_unit_1_dropdown')">{{ isset($_POST['distance_unit_1'])?$_POST['distance_unit_1']:'nm' }} ▾</label>
                           <input type="text" name="distance_unit[]" value="{{ isset($_POST['distance_unit_1'])?$_POST['distance_unit_1']:'nm' }}" id="distance_unit_1" class="hidden">
                           <div id="distance_unit_1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="distance_unit_1">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_1', 'nm')">nm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_1', 'μm')">μm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_1', 'mm')">mm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_1', 'cm')">cm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_1', 'm')">m</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_1', 'km')">km</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_1', 'in')">in</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_1', 'ft')">ft</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_1', 'yd')">yd</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_1', 'mi')">mi</p>
                           </div>
                        </div>
                      </div>
                   </div>
                   <div class="cd1">
                   </div>
                   <div class="col-12 d-flex px-2 mt-5">
                       <button type="button" id="btn2" class="bg-[#2845F5] text-white  border rounded px-4 py-2 me-2"><strong class="text-blue">{{ $lang[9] }}</strong></button>
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
                    <div class="w-full justify-center flex mt-3">
                        <div class="w-[400px] ">
                            <?php if(isset($detail['answer'])){ ?>
                                <div class="text-center overflow-auto">
                                    <p class="text-[20px]">
                                        <strong>{{ $lang[5] }}</strong>
                                    </p>
                                    <p class="lg:text-[22px] md:text-[22px] text-[16px]  bg-[#2845F5] px-5 py-3  my-3 ">
                                        <strong class="text-white">{{ $detail['answer'] }} (N/C)</strong>
                                    </p>
                                </div>
                            <?php } ?>
                            <?php  if(isset($detail['answer1'])){ ?>
                                <div class="text-center overflow-auto">
                                    <p class="text-[20px]">
                                        <strong>{{ $lang[6] }}</strong>
                                    </p>
                                    <p class="lg:text-[22px] md:text-[22px] text-[16px]  bg-[#2845F5] px-5 py-3  my-3 ">
                                        <strong class="text-white">{{ $detail['answer1'] }} (m)</strong>
                                    </p>
                                </div>
                            <?php } ?>
                            <?php  if(isset($detail['answer2'])){ ?>
                                <div class="text-center overflow-auto">
                                    <p class="text-[20px]">
                                        <strong>{{ $lang[7] }}</strong>
                                    </p>
                                    <p class="lg:text-[22px] md:text-[22px] text-[16px]  bg-[#2845F5] px-5 py-3  my-3 ">
                                        <strong class="text-white">{{ $detail['answer2'] }} (c)</strong>
                                    </p>
                                </div>
                            <?php } ?>
                            <?php  if(isset($detail['answer3'])){ ?>
                                <div class="text-center overflow-auto">
                                    <p class="text-[20px]">
                                        <strong>{{ $lang[5] }}</strong>
                                    </p>
                                    <p class="lg:text-[22px] md:text-[22px] text-[16px]  bg-[#2845F5] px-5 py-3  my-3 ">
                                        <strong class="text-white">{{ $detail['answer3'] }} (N/C)</strong>
                                    </p>
                                </div>
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
        var x = 2;
        document.getElementById('btn2').addEventListener('click', function() {
            if (x < 10) {
                x++;
                let html = `  <div class="grid grid-cols-12 mt-3  gap-4">
                     <div class="col-span-6 dis">
                      <label for="charge_${x}" class="label c1"><?=$lang['7']?> ${x}</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="charge1[]" id="charge_${x}" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="charge_unit_${x}" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('charge_unit_${x}_dropdown')">{{ isset($_POST['charge_unit_${x}'])?$_POST['charge_unit_${x}']:'nm' }} ▾</label>
                           <input type="text" name="charge_unit[]" value="{{ isset($_POST['charge_unit_${x}'])?$_POST['charge_unit_${x}']:'nm' }}" id="charge_unit_${x}" class="hidden">
                           <div id="charge_unit_${x}_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="charge_unit_${x}">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit_${x}', 'PC')">PC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit_${x}', 'NC')">NC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit_${x}', 'μC')">μC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit_${x}', 'mC')">mC</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit_${x}', 'C')">C</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit_${x}', 'e')">e</p>
                           </div>
                        </div>
                      </div>
                      <div class="col-span-6 dis">
                        <label for="distance_${x}" class="label d1"><?=$lang['6']?> ${x}</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="distance1[]" id="distance_${x}" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="distance_unit_${x}" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('distance_unit_${x}_dropdown')">{{ isset($_POST['distance_unit_${x}'])?$_POST['distance_unit_${x}']:'nm' }} ▾</label>
                           <input type="text" name="distance_unit[]" value="{{ isset($_POST['distance_unit_${x}'])?$_POST['distance_unit_${x}']:'nm' }}" id="distance_unit_${x}" class="hidden">
                           <div id="distance_unit_${x}_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="distance_unit_${x}">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_${x}', 'nm')">nm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_${x}', 'μm')">μm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_${x}', 'mm')">mm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_${x}', 'cm')">cm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_${x}', 'm')">m</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_${x}', 'km')">km</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_${x}', 'in')">in</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_${x}', 'ft')">ft</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_${x}', 'yd')">yd</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit_${x}', 'mi')">mi</p>
                           </div>
                        </div>
                      </div>
                </div>`;
                document.querySelector('.cd1').insertAdjacentHTML('beforeend', html);
            } else {
                alert('Add Only 10 fields');
            }
        });
        var selection2 = document.getElementById('selection2').value;
        function handleSelection2Change(selection2) {
            if (selection2 == "1") {
                document.querySelectorAll(".electric_field").forEach(el => el.style.display = 'none');
                document.querySelectorAll(".charge, .distance").forEach(el => el.style.display = 'block');
            } else if (selection2 == "2") {
                document.querySelectorAll(".electric_field, .charge").forEach(el => el.style.display = 'block');
                document.querySelectorAll(".distance").forEach(el => el.style.display = 'none');
            } else if (selection2 == "3") {
                document.querySelectorAll(".electric_field, .distance").forEach(el => el.style.display = 'block');
                document.querySelectorAll(".charge").forEach(el => el.style.display = 'none');
            }
        }

        function handleSelectionChange(b) {
            document.querySelectorAll(".ch").forEach(el => el.innerHTML = "Charge");
            document.querySelectorAll(".di").forEach(el => el.innerHTML = "Distance");
            
            if (b == "1") {
                document.querySelectorAll(".distance, .charge").forEach(el => el.style.display = 'block');
                document.querySelectorAll(".electric_field").forEach(el => el.style.display = 'none');
                document.getElementById('btn2').style.display = 'none';
                document.querySelectorAll(".cd, .cd2").forEach(el => el.style.display = 'none');
                document.querySelectorAll(".calculate1").forEach(el => el.style.display = 'block');
            }
            if (b == "2") {
                document.getElementById('btn2').style.display = 'block';
                document.querySelectorAll(".cd, .cd2").forEach(el => el.style.display = 'block');
                document.querySelectorAll(".calculate1").forEach(el => el.style.display = 'none');
                document.querySelectorAll(".ch").forEach(el => el.innerHTML = "Charge 1");
                document.querySelectorAll(".di").forEach(el => el.innerHTML = "Distance 1");
            }
        }

        handleSelection2Change(selection2);

        document.getElementById('selection2').addEventListener('change', function() {
            handleSelection2Change(this.value);
        });

        document.getElementById('selection').addEventListener('change', function() {
            handleSelectionChange(this.value);
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>