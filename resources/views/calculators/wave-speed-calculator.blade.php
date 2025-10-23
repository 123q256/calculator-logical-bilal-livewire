<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12">
                    <label for="frequency" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="frequency" id="frequency" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['frequency'])?$_POST['frequency']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['f_unit'])?$_POST['f_unit']:'Hz' }} ▾</label>
                       <input type="text" name="f_unit" value="{{ isset($_POST['f_unit'])?$_POST['f_unit']:'Hz' }}" id="f_unit" class="hidden">
                       <div id="f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'Hz')">Hz</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'kHz')">kHz</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'MHz')">MHz</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'GHz')">GHz</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'kWh')">kWh</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'THz')">THz</p>
                       </div>
                    </div>
                  </div>
                  <div class="col-span-12">
                    <label for="wavelength" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="wavelength" id="wavelength" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wavelength'])?$_POST['wavelength']:'0.221' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="w_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('w_units_dropdown')">{{ isset($_POST['w_units'])?$_POST['w_units']:'m' }} ▾</label>
                       <input type="text" name="w_units" value="{{ isset($_POST['w_units'])?$_POST['w_units']:'m' }}" id="w_units" class="hidden">
                       <div id="w_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="w_units">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'm')">m</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'nm')">nm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'μm')">μm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'mm')">mm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'cm')">cm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'km')">km</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'in')">in</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'ft')">ft</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'yd')">yd</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_units', 'mi')">mi</p>
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
                <div class="w-full bg-light-blue  p-3 radius-10 mt-3 overflow-auto">
                    <div class="row">
                        <p class="w-full mt-2 font-s-18"><strong>{{ $lang[3] }}</strong></p>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['v'] }}</strong></td>
                                    <td class="p-2 border-b">m/s</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['v']*3.6 }}</strong></td>
                                    <td class="p-2 border-b">km/h</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['v']*3.28084 }}</strong></td>
                                    <td class="p-2 border-b">ft/s</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['v']*2.236936 }}</strong></td>
                                    <td class="p-2 border-b">mph</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['v']*1.943844 }}</strong></td>
                                    <td class="p-2 border-b">knots</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['v']*0.00000000333564 }}</strong></td>
                                    <td class="p-2 border-b">light speed</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['v']*100 }}</strong></td>
                                    <td class="p-2 border-b">cm/s</td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-2 font-s-18"><strong>{{ $lang[4] }}</strong></p>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t'] }}</strong></td>
                                    <td class="p-2 border-b">sec</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t']*1000000000000 }}</strong></td>
                                    <td class="p-2 border-b">{{ $lang['5'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t']*1000000000 }}</strong></td>
                                    <td class="p-2 border-b">{{ $lang['6'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t']*1000000 }}</strong></td>
                                    <td class="p-2 border-b">{{ $lang['7'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t']*1000 }}</strong></td>
                                    <td class="p-2 border-b">{{ $lang['8'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t']*0.016667 }}</strong></td>
                                    <td class="p-2 border-b">{{ $lang['9'] }}</td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-2 font-s-18"><strong>{{ $lang[10] }}</strong></p>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['vn'] }}</strong></td>
                                    <td class="p-2 border-b">m</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['vn']*0.001 }}</strong></td>
                                    <td class="p-2 border-b">mm</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['vn']*0.01 }}</strong></td>
                                    <td class="p-2 border-b">cm</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['vn']*1000 }}</strong></td>
                                    <td class="p-2 border-b">km</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['vn']*0.0254 }}</strong></td>
                                    <td class="p-2 border-b">in</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['vn']*0.3048 }}</strong></td>
                                    <td class="p-2 border-b">ft</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $detail['vn']*0.9144 }}</strong></td>
                                    <td class="p-2 border-b">yd</td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-3 font-s-18 text-blue"><strong><?= $lang['11']?></strong></p>
                        <p class="w-full mt-3">\( \text{ <?= $lang['1']?> = } <?= $detail['frequency']?> \)</p>
                        <p class="w-full mt-3">\( \text{ <?= $lang['2']?> = } <?= $detail['wavelength']?> \)</p>
                        <p class="w-full mt-3 font-s-18 text-blue"><?= $lang['12']?></p>
                        <p class="w-full mt-3 color_blue padding_5"><?= $lang['13']?> <?= $lang['3']?>. </p>
                        <p class="w-full mt-3">\( \text{ <?= $lang['3']?> = } fλ \)</p>
                        <p class="w-full mt-3">\( \text{ <?= $lang['3']?> = } <?= $detail['frequency']?> \times <?= $detail['wavelength']?> \)</p>
                        <p class="w-full mt-3 font-s-18">\( \text{ <?= $lang['3']?> = } <?= round($detail['v'],3)?>m/s \)</p>
                        <p class="w-full mt-3 color_blue padding_5"><?= $lang['13']?> <?= $lang['4']?>. </p>
                        <p class="w-full mt-3">\( \text{ <?= $lang['4']?> = } \dfrac{1}{ \text{ <?= $lang['1']?>}} \)</p>
                        <p class="w-full mt-3">\( \text{ <?= $lang['4']?> = } \dfrac{1}{ <?= $detail['frequency']?>} \)</p>
                        <p class="w-full mt-3 font-s-18">\( \text{ <?= $lang['4']?> = } <?= round($detail['t'],8)?>sec \)</p>
                        <p class="w-full mt-3 color_blue padding_5"><?= $lang['13']?> <?= $lang['10']?>. </p>
                        <p class="w-full mt-3">\( \text{ <?= $lang['10']?> = } \dfrac{1}{ λ} \)</p>
                        <p class="w-full mt-3">\( \text{ <?= $lang['10']?> = } \dfrac{1}{ <?= $detail['wavelength']?>} \)</p>
                        <p class="w-full mt-3 font-s-18">\( \text{ <?= $lang['10']?> = } <?= round($detail['vn'],3)?> m \)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        @if (isset($detail))
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @endif
    </script>
@endpush