<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 bg-white rounded-lg shadow-md space-y-6 mb-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-6">
                    <label for="pipe_diameter" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="pipe_diameter" id="pipe_diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pipe_diameter']) ? $_POST['pipe_diameter'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pipe_diameter_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pipe_diameter_unit_dropdown')">{{ isset($_POST['pipe_diameter_unit'])?$_POST['pipe_diameter_unit']:'m' }} ▾</label>
                        <input type="text" name="pipe_diameter_unit" value="{{ isset($_POST['pipe_diameter_unit'])?$_POST['pipe_diameter_unit']:'m' }}" id="pipe_diameter_unit" class="hidden">
                        <div id="pipe_diameter_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pipe_diameter_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_diameter_unit', 'mm')">mm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_diameter_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_diameter_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_diameter_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_diameter_unit', 'ft')">ft</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6">
                    <label for="pipe_length" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="pipe_length" id="pipe_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pipe_length']) ? $_POST['pipe_length'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pipe_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pipe_length_unit_dropdown')">{{ isset($_POST['pipe_length_unit'])?$_POST['pipe_length_unit']:'m' }} ▾</label>
                        <input type="text" name="pipe_length_unit" value="{{ isset($_POST['pipe_length_unit'])?$_POST['pipe_length_unit']:'m' }}" id="pipe_length_unit" class="hidden">
                        <div id="pipe_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pipe_length_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_length_unit', 'mm')">mm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_length_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_length_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_length_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_length_unit', 'ft')">ft</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6">
                    <label for="volumetric" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="volumetric" id="volumetric" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volumetric']) ? $_POST['volumetric'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="volumetric_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('volumetric_unit_dropdown')">{{ isset($_POST['volumetric_unit'])?$_POST['volumetric_unit']:'m' }} ▾</label>
                        <input type="text" name="volumetric_unit" value="{{ isset($_POST['volumetric_unit'])?$_POST['volumetric_unit']:'m' }}" id="volumetric_unit" class="hidden">
                        <div id="volumetric_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="volumetric_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'US gal/s')">US gal/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'US gal/min')">US gal/min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'US gal/hr')">US gal/hr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'UK gal/s')">UK gal/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'UK gal/min')">UK gal/min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'UK gal/hr')">UK gal/hr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'ft³/s')">ft³/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'ft³/min')">ft³/min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'ft³/hr')">ft³/hr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'm³/s')">m³/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'm³/min')">m³/min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'm³/hr')">m³/hr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'L/s')">L/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'L/min')">L/min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'L/hr')">L/hr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'ml/min')">ml/min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volumetric_unit', 'ml/hr')">ml/hr</p>
                        </div>
                     </div>
                </div>
          
            <div class="col-span-6">
                <label for="material" class="font-s-14 text-blue">{{ $lang[4] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="material" id="material" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["Acrylonitrile Butadiene Styrene (ABS)","Aluminium","Asbestos Cement","Asphalt Lining","
                                Brass","Brick Sewer","Cast Iron - New","Cast Iron - 10 years old","Cast Iron - 20 years old","Cast Iron - 30 years old","Cast Iron - 40 years old","Cast Iron - Asphalt coated","Cast Iron - Bituminous lined","Cast Iron - Cement lined","Cast Iron - Sea coated","Cast Iron - Wrought plain","Cement lining","Concrete","Concrete lined,Steel forms","Concrete lined, Wooden forms","Concrete, old","Copper","Corrugated Metal","Ductile Iron Pipe (DIP)","Ductile Iron, cement lined","Fiber","Fiberglass - FRP","Fire hose - Rubber lined","Galvanized Iron","Glass","HDPE","Lead","Metal pipes - very smooth","Plastic","Polyethylene, PE, PEH","Polyvinyl chloride, PVC, CPVC","
                                Smooth pipes","Steel, new unlined","Steel, corrugated","Steel, interior riveted, no projecting rivets","
                                Steel, projecting girth and horizontal rivets","Steel, vitrified, spiral-riveted","Steel, welded and seamless","
                                Tin","Vitrified Clay","Wood Stave","Wooden or Masonry Pipe - Smooth","Wrought iron, plain"];
                            $val = ["130","140","140","135","135","95","130","110","94.5","92.5","73.5","100","140","140","120","100","135","120","140","120","105","135","60","154","120","140","150","135","120","130","152","135","135","140","140","150","140","145","60","110","100","95","100","130","110","115","120","100"];
                            optionsList($val,$name,isset($_POST['material'])?$_POST['material']:'130');
                        @endphp
                    </select>
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 bg-white rounded-lg shadow-md space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%]  overflow-auto">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang[5] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ $detail['material'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang[6] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ $detail['head_loss'] }} (m)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang[7] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ $detail['pressure_loss'] }} (bar)</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@push('calculatorJS')
    
@endpush