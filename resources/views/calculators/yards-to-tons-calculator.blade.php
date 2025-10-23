<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <label for="thickness_unit" class="font-s-14 text-blue">{{ $lang['1'] }}({{ $lang['2'] }}):</label>
                    <div class="w-100 py-2">
                        <select class="input" name="thickness_unit" id="thickness_unit">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = ["Own Density","Asphalt (crushed)","Asphalt (liquid)","Cement (portland)","Concrete","Dirt","Gravel (loose, dry)","Gravel (dry, 1/4 to 2 in)","Gravel (wet 1/4 to 2 in)","Gravel (with sand)","Limestone (crushed)","Limestone (low density)","Limestone (high density)","Mulch (bark)","Mulch (woodchip)","Sand (dry)","Sand (loose)","Sand (wet)","Topsoil","Topsoil (saturated)"];
                            $val = ["","45","65","94","145","72","85","105","125","120","90","120","160","18.728","24.97","100","90","120","100","115"];
                                optionsList($val,$name,isset($_POST['thickness_unit'])?$_POST['thickness_unit']:'120');
                            @endphp
                        </select>
                    </div>
                </div>

                <div class="col-span-12">
                    <label for="density" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="density" id="density" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['density']) ? $_POST['density'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('density_unit_dropdown')">{{ isset($_POST['density_unit'])?$_POST['density_unit']:'lb/ft³' }} ▾</label>
                        <input type="text" name="density_unit" value="{{ isset($_POST['density_unit'])?$_POST['density_unit']:'lb/ft³' }}" id="density_unit" class="hidden">
                        <div id="density_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="density_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'lb/ft³')">lb/ft³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'kg/m³')">kg/m³</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12">
                    <label for="cubic_yards" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="cubic_yards" id="cubic_yards" class="input" aria-label="input"  value="{{ isset($_POST['cubic_yards'])?$_POST['cubic_yards']:'7' }}" />
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
            <div class="rounded-lg  items-center ">
                <div class="grid grid-cols-12 gap-4 mt-5">
                    <div class="col-span-12 md:col-span-4 lg:col-span-4 border-r">
                        <p class="text-[25px] px-3 px-lg-0 py-2"><strong class="text-green-700">{{ round($detail['tons'], 2)}}</strong> <span class="text-[18px]"> {{$lang['6']}}</span></p>
                    </div>
                    <div class="col-span-12 md:col-span-4 lg:col-span-4 border-r">
                        <p class="text-[25px] px-3 py-2"><strong class="text-green-700">{{round($detail['metric_tonnes'], 2)}}</strong> <span class="text-[18px]"> {{$lang['7']}}</span></p>
                    </div>
                    <div class="col-span-12 md:col-span-4 lg:col-span-4">
                        <p class="text-[25px] px-3 py-2"><strong class="text-green-700">{{  round($detail['pounds'], 2) }}</strong> <span class="text-[18px]"> {{$lang['8']}}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.getElementById('thickness_unit').addEventListener('change',function(){
            var densityInputs = document.querySelectorAll('.density');
            var selected = this.value;
            densityInputs.forEach(function(input) {
                input.value = selected;
            });
        });
    </script>
@endpush