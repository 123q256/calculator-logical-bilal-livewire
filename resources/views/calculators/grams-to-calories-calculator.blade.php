<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 mb-2">
                    <p><strong class="text-blue-700">Convert Macronutrient from Grams to Calories!</strong></p>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="carbohydrate" class="label">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="carbohydrate" id="carbohydrate" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['carbohydrate']) ? $_POST['carbohydrate'] : '25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="carbo_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('carbo_unit_dropdown')">{{ isset($_POST['carbo_unit'])?$_POST['carbo_unit']:'g' }} ▾</label>
                        <input type="text" name="carbo_unit" value="{{ isset($_POST['carbo_unit'])?$_POST['carbo_unit']:'g' }}" id="carbo_unit" class="hidden">
                        <div id="carbo_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="carbo_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('carbo_unit', 'g')">grams (g)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('carbo_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('carbo_unit', 'oz')">ounces (oz)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="protein" class="label">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="protein" id="protein" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['protein']) ? $_POST['protein'] : '25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="protein_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('protein_unit_dropdown')">{{ isset($_POST['protein_unit'])?$_POST['protein_unit']:'g' }} ▾</label>
                        <input type="text" name="protein_unit" value="{{ isset($_POST['protein_unit'])?$_POST['protein_unit']:'g' }}" id="protein_unit" class="hidden">
                        <div id="protein_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="protein_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('protein_unit', 'g')">grams (g)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('protein_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('protein_unit', 'oz')">ounces (oz)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fat" class="label">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="fat" id="fat" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fat']) ? $_POST['fat'] : '25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="fat_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fat_unit_dropdown')">{{ isset($_POST['fat_unit'])?$_POST['fat_unit']:'g' }} ▾</label>
                        <input type="text" name="fat_unit" value="{{ isset($_POST['fat_unit'])?$_POST['fat_unit']:'g' }}" id="fat_unit" class="hidden">
                        <div id="fat_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fat_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat_unit', 'g')">grams (g)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat_unit', 'oz')">ounces (oz)</p>
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
                        <div class="w-full">
                            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-[10px] p-3" style="border: 1px solid #c1b8b899;">
                                        <span>{{ $lang['4'] }} =</span>
                                        <strong class="text-green-700 font-s-25">{{ round($detail['carbs'],3) }}</strong>
                                        <strong>(kcal)</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-[10px] p-3" style="border: 1px solid #c1b8b899;">
                                        <span>{{ $lang['5'] }} =</span>
                                        <strong class="text-green-700 font-s-25">{{ round($detail['pr'],3) }}</strong>
                                        <strong>(kcal)</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-[10px] p-3" style="border: 1px solid #c1b8b899;">
                                        <span>{{ $lang['6'] }} =</span>
                                        <strong class="text-green-700 font-s-25">{{ round($detail['cf'],3) }}</strong>
                                        <strong>(kcal)</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-[10px] p-3" style="border: 1px solid #c1b8b899;">
                                        <span>{{ $lang['7'] }} =</span>
                                        <strong class="text-green-700 font-s-25">{{ round($detail['tc'],3) }}</strong>
                                        <strong>(kcal)</strong>
                                    </div>
                                </div>
                            </div>
                            <p class="text-[18px] px-3 mb-lg-1 my-4"><strong class="text-blue-700">{{ $lang['8'] }} :</strong></p>
                            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-3 lg:col-span-3">
                                    <p><strong class="text-blue-700">1- {{ $lang['9'] }}</strong></p>
                                    <p>= 4 <span class="text-[16px]"><strong>(kcal)</strong></span> * ({{ $detail['cv'] }})</p>
                                    <p>= <strong class="text-green-700">{{ $detail['carbs'] }}</strong><span class="text-[16px]"><strong> (kcal)</strong></span></p>
                                </div>
                                <div class="col-span-1 border-r pe-3 hidden md:block lg:block"></div>
                                <div class="col-span-12 md:col-span-3 lg:col-span-3">
                                    <p><strong class="text-blue-700">2- {{ $lang['10'] }}</strong></p>
                                    <p>= 4 <span class="text-[16px]"><strong>(kcal)</strong></span> * ({{ $detail['pv'] }})</p>
                                    <p>= <strong class="text-green-700">{{ $detail['pr'] }}</strong><span class="text-[16px]"><strong> (kcal)</strong></span></p>
                                </div>
                                <div class="col-span-1 border-r pe-3 hidden md:block lg:block"></div>
                                <div class="col-span-12 md:col-span-3 lg:col-span-3">
                                    <p><strong class="text-blue-700">3- {{ $lang['11'] }}</strong></p>
                                    <p>= 9 <span class="text-[16px]"><strong>(kcal)</strong></span> * ({{ $detail['fv'] }})</p>
                                    <p>= <strong class="text-green-700">{{ $detail['cf'] }}</strong><span class="text-[16px]"><strong> (kcal)</strong></span></p>
                                </div>
                            </div>
                            <div class="w-full mt-3">
                                <p><strong class="text-blue-700">4- {{ $lang['12'] }}</strong></p>
                                <p>= {{ $lang['9'] }} + {{ $lang['10'] }} + {{ $lang['11'] }} </p>
                                <p>= ({{ $detail['carbs'] }} <span class="black-text text-[16px]"><strong>kcal</strong></span>) + ({{ $detail['pr'] }} <span class="black-text text-[16px]"><strong>kcal</strong></span>) + ({{ $detail['cf'] }} <span class="black-text text-[16px]"><strong>kcal</strong></span>)</p>
                                <p class=" dk">= <strong class="text-green-700">{{ $detail['tc'] }}</strong><span class="text-[16px]"><strong> (kcal)</strong></span></p>
                            </div>
                            <div class="w-full mt-3">
                                <span>Related Calculators : </span>
                                <span><a class="text-blue-700 text-decoration-none underline" href="{{ url('calorie-calculator') }}/" title='Sine Calculator' target='_blank' rel='noopener'>Calorie Calculator</a></span>,
                                <span><a class="text-blue-700 text-decoration-none underline" href="{{ url('calorie-deficit-calculator') }}/" title='ArcSine Calculator' target='_blank' rel='noopener'>Calorie Deficit Calculator</a></span>,
                                <span><a class="text-blue-700 text-decoration-none underline" href="{{ url('steps-to-calories-calculator') }}/" title='Cosecant Calculator' target='_blank' rel='noopener'>Steps to Calories Calculator</a></span>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset
</form>