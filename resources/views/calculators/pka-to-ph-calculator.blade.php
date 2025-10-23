<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="convert" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                    <select name="convert" id="convert" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name=[$lang['10'],$lang['11']];
                            $val = ["1","2"];
                            optionsList($val,$name,isset(request()->convert)?request()->convert:'1');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="convert" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>   <label for="buf_unit" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>   <select name="buf_unit" id="buf_unit" class="input">
                        @php
                            $name=[$lang['2'],$lang['3']];
                            $val = ["1","2"];
                            optionsList($val,$name,isset(request()->buf_unit)?request()->buf_unit:'1');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 ka">
                    <label for="ka" class="font-s-14 text-blue">K<span class="text-blue rep">a</span>:</label>
                    <input type="number" step="any" name="ka" id="ka" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->ka)?request()->ka:'7' }}" />
                </div>

                <div class="space-y-2">
                    <label for="acid" class="font-s-14 text-blue">
                        <span class="text-blue rep1">{{ $lang['2'] }}</span> {{ $lang['4'] }}:
                    </label>
                    <div class="relative w-full">
                        <input type="number" step="any" name="acid" id="acid" value="{{ isset(request()->acid) ? request()->acid : '20' }}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        @php
                            function unit_values($names, $values, $post){
                                $unit = '';
                                foreach($values as $key => $unit_value){
                                    if($post == $unit_value){
                                        $unit = $names[$key];
                                    }
                                }
                                return $unit;
                            }
                            $unit_names = ["M","mM","μM"];
                            $unit_values = ["1","0.001","0.000001"];
                            $post_value = isset(request()->acid_unit) ? request()->acid_unit : '';
                            $result_unit = unit_values($unit_names, $unit_values, $post_value);
                        @endphp
                        <label for="acid_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('acid_unit_dropdown')">
                            {{ isset(request()->acid_unit) ? $result_unit : 'M' }} ▾
                        </label>
                        <input type="text" name="acid_unit" value="{{ isset(request()->acid_unit) ? request()->acid_unit : '1' }}" id="acid_unit" class="hidden">
                        <div id="acid_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('acid_unit', '1')">M</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('acid_unit', '0.001')">mM</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('acid_unit', '0.000001')">μM</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="salt" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="relative w-full">
                        <input type="number" step="any" name="salt" id="salt" value="{{ isset(request()->salt) ? request()->salt : '25' }}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        @php
                            $unit_names = ["M", "mM", "μM"];
                            $unit_values = ["1", "0.001", "0.000001"];
                            $post_value = isset(request()->salt_unit) ? request()->salt_unit : '';
                            $result_unit = unit_values($unit_names, $unit_values, $post_value);
                        @endphp
                        <label for="salt_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('salt_unit_dropdown')">
                            {{ isset(request()->salt_unit) ? $result_unit : 'M' }} ▾
                        </label>
                        <input type="text" name="salt_unit" value="{{ isset(request()->salt_unit) ? request()->salt_unit : '1' }}" id="salt_unit" class="hidden">
                        <div id="salt_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('salt_unit', '1')">M</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('salt_unit', '0.001')">mM</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('salt_unit', '0.000001')">μM</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 ph hidden">
                    <label for="ph" class="font-s-14 text-blue">{!! $lang['8'] !!}:</label>
                    <input type="number" step="any" name="ph" id="ph" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->ph)?request()->ph:'25' }}" />
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
                    <div class="w-full  rounded-lg mt-3">
                        <div class="w-full text-center">
                            @php
                                $i = ($detail['unit'] == "1") ? $lang['6'] : $lang['7'];
                            @endphp
                            
                            @if(isset($detail['pk']) && $detail['pk'] != "")
                                <p class="text-lg">{!! ($detail['unit'] == "1") ? $lang['12'] : $lang['13'] !!}</p>
                                <p><strong class="text-[#119154] lg:text-3xl md:text-2xl">{!! $detail['pk'] !!}</strong></p>
                            @endif
                    
                            <p class="text-lg">{!! $i !!}</p>
                            <p><strong class="text-[#119154] lg:text-3xl md:text-2xl">{!! round($detail['pka'], 4) !!}</strong></p>
                    
                            @if(isset($detail['ph']) && $detail['ph'] != "")
                                <p class="text-lg">{!! $lang['8'] !!}</p>
                                <p><strong class="text-[#119154] lg:text-3xl md:text-2xl">{!! round($detail['ph'], 4) !!}</strong></p>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function updateTexts() {
                    var a = document.getElementById("buf_unit").value;

                    if (a == "1") {
                        document.querySelector(".rep").textContent = 'a';
                        document.querySelector(".rep1").textContent = 'Acid';
                    } else if (a == "2") {
                        document.querySelector(".rep").textContent = 'b';
                        document.querySelector(".rep1").textContent = 'Base';
                    }
                }

                document.getElementById("buf_unit").addEventListener("change", function() {
                    updateTexts();
                });

                function updateFiels() {
                    var a = document.getElementById("convert").value;

                    if (a == "1") {
                        document.querySelector(".ph").style.display = 'none';
                        document.querySelector(".ka").style.display = 'block';
                    } else if (a == "2") {
                        document.querySelector(".ka").style.display = 'none';
                        document.querySelector(".ph").style.display = 'block';
                    }
                }

                document.getElementById("convert").addEventListener("change", function() {
                    updateFiels();
                });
            });
        </script>
    @endpush
</form>