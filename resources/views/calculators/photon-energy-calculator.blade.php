<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <p class="col-span-12"><strong class="text-blue">{{$lang[1]}}:</strong>{{$lang[2]}}.</p>
            <div class="col-span-12 ">
                <label for="wave" class="font-s-14 text-blue" >{{$lang[3]}} (λ):</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="wave" id="wave" step="any"  min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wave'])?$_POST['wave']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="width_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_units_dropdown')">{{ isset($_POST['width_units'])?$_POST['width_units']:'Å' }} ▾</label>
                   <input type="text" name="width_units" value="{{ isset($_POST['width_units'])?$_POST['width_units']:'Å' }}" id="width_units" class="hidden">
                   <div id="width_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_units">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_units', 'Å')">Å</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_units', 'mm')">mm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_units', 'μm')">μm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_units', 'nm')">nm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_units', 'm')">m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_units', 'km')">km</p>
                   </div>
                </div>
              </div>
              <div class="col-span-12 ">
                <label for="freq" class="font-s-14 text-blue" >{{ $lang['4']}} (f): </label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="freq" id="freq" step="any"  min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['freq'])?$_POST['freq']:'16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="unit_f" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_f_dropdown')">{{ isset($_POST['unit_f'])?$_POST['unit_f']:'Hz' }} ▾</label>
                   <input type="text" name="unit_f" value="{{ isset($_POST['unit_f'])?$_POST['unit_f']:'Hz' }}" id="unit_f" class="hidden">
                   <div id="unit_f_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_f">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_f', 'Hz')">Hz</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_f', 'kHz')">kHz</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_f', 'MHz')">MHz</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_f', 'GHz')">GHz</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_f', 'THz')">THz</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_f', 'RPM')">RPM</p>
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
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                           <tr>
                              <td class="py-2 border-b" width="40%"><strong>{{ $lang[5] }} </strong></td>
                               <td class="py-2 border-b"> {!! $detail['energy'] !!} joules</td>
                           </tr>
                           @if(is_numeric($_POST['wave']))
                           <tr>
                             <td class="py-2 border-b" width="40%"><strong>{{ $lang[4] }} </strong></td>
                             <td class="py-2 border-b"> {{ $detail['frequency'] }} Hz</td>
                           </tr>
                           @endif
                           @if(is_numeric($_POST['freq']))
                           <tr>
                              <td class="py-2 border-b" width="40%"><strong>{{ $lang[3] }} </strong></td>
                              <td class="py-2 border-b"> {{ @$detail['wave'] }} m</td>
                           </tr>
                           @endif
                        </table>
                  </div>
                  <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                    <p class="my-2"><strong>{{$lang[6]}}:</strong></p>
                    <table class="w-full text-[18px]">
                        <tr>
                            <td class="py-2 border-b" width="40%">{{$lang[5]}}</td>
                            <td class="py-2 border-b"><strong>{{$detail['en']*6.242e+18}} eV</strong></td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="40%">{{$lang[5]}}</td>
                            <td class="py-2 border-b"><strong>{{$detail['en']*6.242e+15}} keV</strong></td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="40%">{{$lang[5]}}</td>
                            <td class="py-2 border-b"><strong>{{$detail['en']*6.242e+12}} MeV</strong></td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="40%">{{$lang[5]}}</td>
                            <td class="py-2 border-b"><strong>{{$detail['en']*6.242e+24}} μeV</strong></td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="40%">{{$lang[5]}}</td>
                            <td class="py-2 border-b"><strong>{{$detail['en']*6.242e+21}} meV</strong></td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="40%">{{$lang[5]}}</td>
                            <td class="py-2 border-b"><strong>{{$detail['en']*6.242e+27}} neV</strong></td>
                        </tr>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>