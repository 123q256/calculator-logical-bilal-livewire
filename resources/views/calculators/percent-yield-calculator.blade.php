<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="method" class="font-s-14 text-blue">{!! $lang['to'] !!}:</label>
                    <select name="method" id="method" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['yeild'],$lang['ther'],$lang['actul']];
                            $val = ["1","2","3"];
                            optionsList($val,$name,isset(request()->method)?request()->method:'1');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 yield">
                    <label for="x" class="font-s-14 text-blue x_text">{{ $lang['ther'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="x" id="x" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x'])?$_POST['x']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_x" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_x_dropdown')">{{ isset($_POST['unit_x'])?$_POST['unit_x']:'g' }} ▾</label>
                        <input type="text" name="unit_x" value="{{ isset($_POST['unit_x'])?$_POST['unit_x']:'g' }}" id="unit_x" class="hidden">
                        <div id="unit_x_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'g')">grams (g)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'µg')">micrograms (µg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'mg')">milligrams (mg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'lbs')">pounds (lbs)</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 percent_x hidden ">
                    <label for="z" class="font-s-14 text-blue x_text">{!! $lang['yeild'] !!}:</label>
                    <div class="w-full py-2 relative">
                    <input type="number" step="any" name="z" id="z" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->z)?request()->z:'113.5' }}" />
                    <span class="text-blue input_unit">%</span>
                    </div>
                </div>
                <div class="space-y-2 yield">
                    <label for="y" class="font-s-14 text-blue y_text">{{ $lang['actul'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="y" id="y" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y'])?$_POST['y']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_y" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_y_dropdown')">{{ isset($_POST['unit_y'])?$_POST['unit_y']:'g' }} ▾</label>
                        <input type="text" name="unit_y" value="{{ isset($_POST['unit_y'])?$_POST['unit_y']:'g' }}" id="unit_y" class="hidden">
                        <div id="unit_y_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_y', 'g')">grams (g)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_y', 'µg')">micrograms (µg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_y', 'mg')">milligrams (mg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_y', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_y', 'lbs')">pounds (lbs)</p>
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
                <div class="w-full  text-[20px]  mt-3">
                    <div class="w-full  text-center">
                        @php
                            if(request()->method === '1'){
                                $head = $lang['yeild'];
                            }elseif(request()->method === '2'){
                                $head = $lang['ther'];
                            }else{
                                $head = $lang['actul'];
                            }
                        @endphp
                        <p class="mb-2"><strong class="z">{{ $head }}</strong></p>
                        <strong class="text-[#119154] text-[32px]">{{ (isset($detail['ans'])) ? $detail['ans'] : "00" }}</strong>
                        <span class="text-blue text-[20px] nachy">{{ (request()->method === '1') ? '%' : 'g' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var method = document.getElementById('method').value;
                updateText(method);

                document.getElementById('method').addEventListener('change', function() {
                    var method = document.getElementById('method').value;
                    updateText(method);
                });

                function updateText(method) {
                    if (method == '1') {
                        document.querySelector('.x_text').textContent = '<?=$lang['ther']?>';
                        document.querySelector('.y_text').textContent = '<?=$lang['actul']?>';
                        document.querySelector('.percent_x').style.display = 'none';
                        document.querySelector('.yield').style.display = 'block';
                    } else if (method == '2') {
                        document.querySelector('.y_text').textContent = '<?=$lang['actul']?>';
                        document.querySelector('.x_text').textContent = '<?=$lang['yeild']?>';
                        document.querySelector('.percent_x').style.display = 'block';
                        document.querySelector('.yield').style.display = 'none';
                    } else if (method == '3') {
                        document.querySelector('.y_text').textContent = '<?=$lang['ther']?>';
                        document.querySelector('.x_text').textContent = '<?=$lang['yeild']?>';
                        document.querySelector('.percent_x').style.display = 'block';
                        document.querySelector('.yield').style.display = 'none';
                    }
                }
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>