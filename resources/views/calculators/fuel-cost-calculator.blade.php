<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

   

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4"> 

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="distance" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="distance" id="distance" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance']) ? $_POST['distance'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="d_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('d_units_dropdown')">{{ isset($_POST['d_units'])?$_POST['d_units']:'km' }} ▾</label>
                        <input type="text" name="d_units" value="{{ isset($_POST['d_units'])?$_POST['d_units']:'km' }}" id="d_units" class="hidden">
                        <div id="d_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="d_units">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_units', 'km')">km</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_units', 'mi')">mi</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="f_efficiency" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="f_efficiency" id="f_efficiency" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f_efficiency']) ? $_POST['f_efficiency'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="f_eff_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_eff_units_dropdown')">{{ isset($_POST['f_eff_units'])?$_POST['f_eff_units']:'L/100km' }} ▾</label>
                        <input type="text" name="f_eff_units" value="{{ isset($_POST['f_eff_units'])?$_POST['f_eff_units']:'L/100km' }}" id="f_eff_units" class="hidden">
                        <div id="f_eff_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_eff_units">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_eff_units', 'L/100km')">L/100km</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_eff_units', 'US mpg')">US mpg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_eff_units', 'UK mpg')">UK mpg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_eff_units', 'kmpl')">kmpl</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_eff_units', 'lpm')">liters per mile</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="f_price" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="f_price" id="f_price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f_price']) ? $_POST['f_price'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="f_p_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_p_units_dropdown')">{{ isset($_POST['f_p_units'])?$_POST['f_p_units']:$currancy.'/liter' }} ▾</label>
                        <input type="text" name="f_p_units" value="{{ isset($_POST['f_p_units'])?$_POST['f_p_units']:$currancy.'/liter' }}" id="f_p_units" class="hidden">
                        <div id="f_p_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_p_units">
                            <input type="hidden" name="currancy" value="{{$currancy}}">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_p_units', '{{$currancy}}/cl')">{{$currancy}}/cl</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_p_units', '{{$currancy}}/liter')">{{$currancy}}/liter</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_p_units', '{{$currancy}}/US gal')">{{$currancy}}/US gal</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_p_units', '{{$currancy}}/UK gal')">{{$currancy}}/UK gal</p>
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
                    <div class="w-full my-2">
                        <div class="w-full md:w-[60%] lg:w-[60%]  lg:text-[18px] md:text-[18px]  text-[14px]  overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2"><strong>{{ $lang['9']}} :</strong></td>
                                    <td class="border-b py-2">{{round($detail['fuel'],2)}} {{ $lang['10']}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{ $lang['11']}} :</strong></td>
                                    <td class="border-b py-2">{{$currancy}} {{ round($detail['trip_cost'] ,2)}}</td>
                                </tr>
                            </table>
                            <p class="text-[20px] mb-3 mt-4"><strong>{{$lang['12']}}</strong></p>
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2">{{ $lang['9']}} ({{ $lang['13']}}) :</td>
                                    <td class="border-b py-2">{{ round($detail['fuel'] * 0.26417,3)}} {{ $lang['14']}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['9']}} ({{ $lang['15']}}) :</td>
                                    <td class="border-b py-2">{{ round($detail['fuel'] * 0.21997,3)}} {{ $lang['14']}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full mt-3 lg:text-[18px] md:text-[18px]  text-[14px]">
                            @if ($detail['f_eff_units'] == 'L/100km')
                                <p class="mt-2">if 40 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (100 / 40),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (100 / 40)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ ($detail['distance'] / (100 / 40)) * $detail['f_price']}}.</p>
                                <p class="mt-2">if 30 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (100 / 30),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (100 / 30)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ ($detail['distance'] / (100 / 30)) * $detail['f_price']}}</p>
                                <p class="mt-2">if 20 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (100 / 20),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (100 / 20)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ ($detail['distance'] / (100 / 20)) * $detail['f_price']}}</p>
                                <p class="mt-2">if 10 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (100 / 10),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (100 / 10)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ ($detail['distance'] / (100 / 10)) * $detail['f_price']}}</p>
                                <p class="mt-2">if 5 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (100 / 5),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (100 / 5)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ ($detail['distance'] / (100 / 5)) * $detail['f_price']}}</p>
                                <p class="mt-2">if 3 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (100 / 3),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (100 / 3)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ ($detail['distance'] / (100 / 3)) * $detail['f_price']}}</p>
                                <p class="mt-2">if 2 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (100 / 2),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (100 / 2)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ ($detail['distance'] / (100 / 2)) * $detail['f_price']}}</p>
                            @elseif ($detail['f_eff_units'] == 'US mpg')
                                <p class="mt-2">if 5 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (5 * 0.425144),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (5 * 0.425144)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (5 * 0.425144)) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 10 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (10 * 0.425144),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (10 * 0.425144)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (10 * 0.425144)) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 20 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (20 * 0.425144),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (20 * 0.425144)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (20 * 0.425144)) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 30 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (30 * 0.425144),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (30 * 0.425144)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (30 * 0.425144)) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 40 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (40 * 0.425144),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (40 * 0.425144)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (40 * 0.425144)) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 50 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (50 * 0.425144),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (50 * 0.425144)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (50 * 0.425144)) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 60 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (60 * 0.425144),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (60 * 0.425144)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (60 * 0.425144)) * $detail['f_price'],2)}}</p>
                            @elseif ($detail['f_eff_units'] == 'UK mpg')
                                <p class="mt-2">if 5 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (5 * 0.354006),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (5 * 0.354006)) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 10 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (10 * 0.354006),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (10 * 0.354006)) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 20 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (20 * 0.354006),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (20 * 0.354006)) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 30 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (30 * 0.354006),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (30 * 0.354006)) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 40 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (40 * 0.354006),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (40 * 0.354006)) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 50 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (50 * 0.354006),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (50 * 0.354006)) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 60 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / (60 * 0.354006),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / (5 * 0.354006)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / (60 * 0.354006)) * $detail['f_price'],2)}}</p>
                            @elseif ($detail['f_eff_units'] == 'kmpl')
                                <p class="mt-2">if 3 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / 3 , 1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / 3) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / 3) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 5 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / 5,1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / 5) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / 5) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 10 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / 10,1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / 10) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / 10) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 20 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / 20,1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / 20) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / 20) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 30 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / 30,1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / 30) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / 30) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 50 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / 50,1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / 50) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / 50) * $detail['f_price'],2)}}</p>
                            @elseif ($detail['f_eff_units'] == 'lpm')
                                <p class="mt-2">if 1 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / ((1 / 1) * 1.6093 ) , 1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / ((1 / 1) * 1.6093) ) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / ((1 / 1) * 1.6093 )) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 0.5 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / ((1 / 0.5) * 1.6093 ),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / ((1 / 0.5) * 1.6093)) * 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / ((1 / 0.5) * 1.6093 )) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 0.2 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / ((1 / 0.2) * 1.6093 ),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / ((1 / 0.2) * 1.6093))* 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / ((1 / 0.2) * 1.6093 )) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 0.1 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / ((1 / 0.1) * 1.6093 ),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / ((1 / 0.1) * 1.6093 ))* 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / ((1 / 0.1) * 1.6093 )) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 0.08 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / ((1 / 0.08) * 1.6093 ),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / ((1 / 0.08) * 1.6093))* 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / ((1 / 0.08) * 1.6093 )) * $detail['f_price'],2)}}</p>
                                <p class="mt-2">if 0.05 {{ $detail['f_eff_units']}}, {{ $lang['16']}} {{ round($detail['distance'] / ((1 / 0.05) * 1.6093 ),1)}} {{ $lang['17']}} / {{ round(($detail['distance'] / ((1 / 0.05) * 1.6093))* 0.26417,1)}} {{ $lang['18']}} <i>{{$currancy}}</i> {{ round(($detail['distance'] / ((1 / 0.05) * 1.6093 )) * $detail['f_price'],2)}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endisset
</form>