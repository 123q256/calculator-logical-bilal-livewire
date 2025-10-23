<style>
    img{
        object-fit: contain;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-6">
                <div class="grid grid-cols-12   gap-4">
                    <div class="col-span-12">
                        <label for="surface" class="font-s-14 ">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select name="surface" id="surface" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name = ["Inclined", "Horizontal"];
                                    $val = ["inclined", "horizontal"];
                                    optionsList($val,$name,isset($_POST['surface'])?$_POST['surface']:'inclined');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 hidden" id="external_hidde">
                        <label for="external" class="font-s-14 ">{{ $lang['2'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select name="external" id="external" class="input">
                                @php
                                    $name = ["No", "Downward", "Upward"];
                                    $val = ["no", "downward", "upward"];
                                    optionsList($val,$name,isset($_POST['external'])?$_POST['external']:'no');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="mass" class="font-s-14 ">{{ $lang[3] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="mass" id="mass" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass']) ? $_POST['mass'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="mass_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_units_dropdown')">{{ isset($_POST['mass_units'])?$_POST['mass_units']:'µg' }} ▾</label>
                            <input type="text" name="mass_units" value="{{ isset($_POST['mass_units'])?$_POST['mass_units']:'µg' }}" id="mass_units" class="hidden">
                            <div id="mass_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mass_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_units', 'µg')">µg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_units', 'mg')">mg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_units', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_units', 'dag')">dag</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_units', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_units', 't')">t</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_units', 'gr')">gr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_units', 'dr')">dr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_units', 'oz')">oz</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_units', 'lb')">lb</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12 hidden" id="outside_force">
                        <label for="outside_force1" class="font-s-14 ">{{ $lang[4] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="outside_force" id="outside_force" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['outside_force']) ? $_POST['outside_force'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="outside_force_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('outside_force_units_dropdown')">{{ isset($_POST['outside_force_units'])?$_POST['outside_force_units']:'µg' }} ▾</label>
                            <input type="text" name="outside_force_units" value="{{ isset($_POST['outside_force_units'])?$_POST['outside_force_units']:'µg' }}" id="outside_force_units" class="hidden">
                            <div id="outside_force_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="outside_force_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('outside_force_units', 'N')">N</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('outside_force_units', 'KN')">KN</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('outside_force_units', 'MN')">MN</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('outside_force_units', 'GN')">GN</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('outside_force_units', 'TN')">TN</p>
                            </div>
                         </div>
                    </div>
                   
                    <div class="col-span-12" id="angle">
                        <label for="angle1" class="font-s-14 " id="angle_text">Angle:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="angle" id="angle1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle']) ? $_POST['angle'] : '30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="angle_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_units_dropdown')">{{ isset($_POST['angle_units'])?$_POST['angle_units']:'deg' }} ▾</label>
                            <input type="text" name="angle_units" value="{{ isset($_POST['angle_units'])?$_POST['angle_units']:'deg' }}" id="angle_units" class="hidden">
                            <div id="angle_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_units', 'deg')">deg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_units', 'ran')">ran</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_units', 'gon')">gon</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_units', 'tr')">tr</p>
                            </div>
                         </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-span-6 text-center pt-2">
                <img src="<?= url('images/inclined.png') ?>" alt="inclined" width="231px" height="182px" id="inclined">
                <img src="<?= url('images/horizontal_no.png') ?>" alt="horizontal_no" width="280px" height="265px" id="horizontal_no" class="hidden">
                <img src="<?= url('images/horizontal_upward.png') ?>" alt="horizontal_upward" width="280px" height="260px"  id="horizontal_upward" class="hidden">
                <img src="<?= url('images/horizontal_downward.png') ?>" alt="horizontal_downward" width="280px" height="265px" id="horizontal_downward" class="hidden">
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
                        <div class="text-center">
                            <p class="text-[20px]">
                                <strong>{{ $lang['6'] }}</strong>
                            </p>
                            <div class="flex justify-center">
                            <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-white">{{ round($detail['normal_force'], 2) }}</strong>
                            </p>
                        </div>
                    </div>
                        <p class="w-full my-3 text-[18px] "><?= $lang[7] ?></p>
                        <div class="w-full overflow-auto">
                            <table class="w-full" style="border-collapse: collapse">
                                <thead>
                                    <tr class="bg-[#F6FAFC]">
                                        <td class="p-2 border text-center"><strong class="">KN</strong></td>
                                        <td class="p-2 border text-center"><strong class="">MN</strong></td>
                                        <td class="p-2 border text-center"><strong class="">GN</strong></td>
                                        <td class="p-2 border text-center"><strong class="">TN</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white">
                                        <td class="text-center p-2 border"><?= round($detail['normal_force'] * 0.001, 3); ?></td>
                                        <td class="text-center p-2 border"><?= round($detail['normal_force'] * 0.000001, 5); ?></td>
                                        <td class="text-center p-2 border"><?= round($detail['normal_force'] * 0.000000001, 8); ?></td>
                                        <td class="text-center p-2 border"><?= round($detail['normal_force'] * 0.000000000001, 10); ?></td>
                                    </tr>
                                </tbody>
                            </table>
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
        // Initial surface check
        let surface = document.getElementById("surface").value;
        if (surface === "horizontal") {
            document.getElementById("outside_force").classList.add('hidden');
            document.getElementById("angle").classList.add('hidden');
            document.getElementById("external_hidde").classList.remove('hidden');
            document.getElementById("horizontal_no").classList.remove('hidden');
            document.getElementById("inclined").classList.add('hidden');
        } else if (surface === "inclined") {
            document.getElementById("horizontal_upward").classList.add('hidden');
            document.getElementById("horizontal_downward").classList.add('hidden');
            document.getElementById("horizontal_no").classList.add('hidden');
            document.getElementById("inclined").classList.remove('hidden');
            document.getElementById("angle").classList.remove('hidden');
            document.getElementById("outside_force").classList.add('hidden');
            document.getElementById("external_hidde").classList.add('hidden');
            document.getElementById("angle_text").textContent = 'Angle';
        }

        // Surface change event listener
        document.getElementById("surface").addEventListener('change', function() {
            let surface = document.getElementById("surface").value;
            if (surface === "horizontal") {
                document.getElementById("outside_force").classList.add('hidden');
                document.getElementById("angle").classList.add('hidden');
                document.getElementById("external_hidde").classList.remove('hidden');
                document.getElementById("horizontal_no").classList.remove('hidden');
                document.getElementById("inclined").classList.add('hidden');
            } else if (surface === "inclined") {
                document.getElementById("horizontal_upward").classList.add('hidden');
                document.getElementById("horizontal_downward").classList.add('hidden');
                document.getElementById("horizontal_no").classList.add('hidden');
                document.getElementById("inclined").classList.remove('hidden');
                document.getElementById("angle").classList.remove('hidden');
                document.getElementById("outside_force").classList.add('hidden');
                document.getElementById("external_hidde").classList.add('hidden');
                document.getElementById("angle_text").textContent = 'Angle';
            }
        });

        // External change event listener
        document.getElementById("external").addEventListener('change', function() {
            let external = document.getElementById("external").value;
            if (external === 'no') {
                document.getElementById("horizontal_downward").classList.add('hidden');
                document.getElementById("horizontal_upward").classList.add('hidden');
                document.getElementById("horizontal_no").classList.remove('hidden');
                document.getElementById("inclined").classList.add('hidden');
                document.getElementById("angle").classList.add('hidden');
                document.getElementById("outside_force").classList.add('hidden');
            } else if (external === 'downward') {
                document.getElementById("horizontal_downward").classList.remove('hidden');
                document.getElementById("horizontal_upward").classList.add('hidden');
                document.getElementById("horizontal_no").classList.add('hidden');
                document.getElementById("inclined").classList.add('hidden');
                document.getElementById("angle").classList.remove('hidden');
                document.getElementById("angle_text").textContent = 'Angle of the outside force';
                document.getElementById("outside_force").classList.remove('hidden');
            } else if (external === 'upward') {
                document.getElementById("horizontal_downward").classList.add('hidden');
                document.getElementById("horizontal_upward").classList.remove('hidden');
                document.getElementById("horizontal_no").classList.add('hidden');
                document.getElementById("inclined").classList.add('hidden');
                document.getElementById("angle").classList.remove('hidden');
                document.getElementById("angle_text").textContent = 'Angle of the outside force';
                document.getElementById("outside_force").classList.remove('hidden');
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>