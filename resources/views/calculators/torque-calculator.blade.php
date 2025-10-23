<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  gap-4">
                <div class="space-y-2">
                    <label for="to" class="font-s-14 text-blue">To Calculate:</label>
                    <select class="input" name="to" id="to">
                        <option value="1"  {{ isset($_POST['to']) && $_POST['to']=='1'?'selected':''}}> {{ $lang['tor']}}</option>
                        <option value="2"  {{ isset($_POST['to']) && $_POST['to']=='2'?'selected':''}}> {{$lang['coil']}} </option>
                        <option value="3"  {{ isset($_POST['to']) && $_POST['to']=='3'?'selected':''}} >{{$lang['vector']}} </option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-2  gap-4 torque">
                <p class="w-full px-2"><strong>Note:</strong> Please! enter any three values to know the fourth one.</p>
            </div>
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4 torque">
                <div class="space-y-2">
                    <label for="distance" class="font-s-14 text-blue" >{{ $lang['dis']}}</label>
                    <div class="relative w-full ">
                        <input type="number" name="distance" id="distance"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance'])?$_POST['distance']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dis_u" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_u_dropdown')">{{ isset($_POST['dis_u'])?$_POST['dis_u']:'m' }} ▾</label>
                        <input type="text" name="dis_u" value="{{ isset($_POST['dis_u'])?$_POST['dis_u']:'m' }}" id="dis_u" class="hidden">
                        <div id="dis_u_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_u', 'm')">m/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_u', 'mm')">mm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_u', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_u', 'km')">km</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_u', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_u', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_u', 'yd')">yd</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="force" class="font-s-14 text-blue" >{{ $lang['for']}}</label>
                    <div class="relative w-full ">
                        <input type="number" name="force" id="force"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['force'])?$_POST['force']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="for_u" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('for_u_dropdown')">{{ isset($_POST['for_u'])?$_POST['for_u']:'N' }} ▾</label>
                        <input type="text" name="for_u" value="{{ isset($_POST['for_u'])?$_POST['for_u']:'N' }}" id="for_u" class="hidden">
                        <div id="for_u_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('for_u', 'N')">N</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('for_u', 'kN')">kN</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('for_u', 'MN')">MN</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('for_u', 'GN')">GN</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('for_u', 'TN')">TN</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="angle" class="font-s-14 text-blue" >{{ $lang['ang']}}</label>
                    <div class="relative w-full ">
                        <input type="number" name="angle" id="angle"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle'])?$_POST['angle']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="ang_u" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ang_u_dropdown')">{{ isset($_POST['ang_u'])?$_POST['ang_u']:'deg' }} ▾</label>
                        <input type="text" name="ang_u" value="{{ isset($_POST['ang_u'])?$_POST['ang_u']:'deg' }}" id="ang_u" class="hidden">
                        <div id="ang_u_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ang_u', 'deg')">deg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ang_u', 'rad')">rad</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ang_u', 'gon')">gon</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ang_u', 'tr')">tr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ang_u', 'arcmin')">arcmin</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ang_u', 'arcsec')">arcsec</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ang_u', 'mrad')">mrad</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ang_u', 'μrad')">μrad</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="torque" class="font-s-14 text-blue" >{{ $lang['tor']}}</label>
                    <div class="relative w-full ">
                        <input type="number" name="torque" id="torque"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle'])?$_POST['angle']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="tor_u" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tor_u_dropdown')">{{ isset($_POST['tor_u'])?$_POST['tor_u']:'Nm' }} ▾</label>
                        <input type="text" name="tor_u" value="{{ isset($_POST['tor_u'])?$_POST['tor_u']:'Nm' }}" id="tor_u" class="hidden">
                        <div id="tor_u_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tor_u', 'Nm')">Nm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tor_u', 'kg-cm')">kg-cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tor_u', 'J/rad')">J/rad</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tor_u', 'ft-lb')">ft-lb</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-2  gap-4 hidden coil">
                <p class="col-12 px-2"><strong>Note:</strong> Please! enter any five values to know the sixth one.</p>
            </div>
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4 hidden coil">
              
                <div class="space-y-2">
                    <label for="loop" class="font-s-14 text-blue">{{ $lang['loop'] }}:</label>
                    <input type="number" step="any" name="loop" id="loop" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['loop'])?$_POST['loop']:'' }}" />
                </div>
                <div class="space-y-2">
                    <label for="angle_c" class="font-s-14 text-blue" >{{ $lang['ang']}}</label>
                    <div class="relative w-full ">
                        <input type="number" name="angle_c" id="angle_c"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_c'])?$_POST['angle_c']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angc_u" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angc_u_dropdown')">{{ isset($_POST['angc_u'])?$_POST['angc_u']:'deg' }} ▾</label>
                        <input type="text" name="angc_u" value="{{ isset($_POST['angc_u'])?$_POST['angc_u']:'deg' }}" id="angc_u" class="hidden">
                        <div id="angc_u_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angc_u', 'deg')">deg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angc_u', 'rad')">rad</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angc_u', 'gon')">gon</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angc_u', 'tr')">tr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angc_u', 'arcmin')">arcmin</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angc_u', 'arcsec')">arcsec</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angc_u', 'mrad')">mrad</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angc_u', 'μrad')">μrad</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="current" class="font-s-14 text-blue" >{{ $lang['cur']}}</label>
                    <div class="relative w-full ">
                        <input type="number" name="current" id="current"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['current'])?$_POST['current']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="cur_u" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cur_u_dropdown')">{{ isset($_POST['cur_u'])?$_POST['cur_u']:'A' }} ▾</label>
                        <input type="text" name="cur_u" value="{{ isset($_POST['cur_u'])?$_POST['cur_u']:'A' }}" id="cur_u" class="hidden">
                        <div id="cur_u_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cur_u', 'A')">A</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cur_u', 'mA')">mA</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cur_u', 'kA')">kA</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cur_u', 'μA')">μA</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cur_u', 'boit')">boit</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="area" class="font-s-14 text-blue" >{{ $lang['area']}}</label>
                    <div class="relative w-full ">
                        <input type="number" name="area" id="area"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area'])?$_POST['area']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="area_u" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_u_dropdown')">{{ isset($_POST['area_u'])?$_POST['area_u']:'m²' }} ▾</label>
                        <input type="text" name="area_u" value="{{ isset($_POST['area_u'])?$_POST['area_u']:'m²' }}" id="area_u" class="hidden">
                        <div id="area_u_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_u', 'm²')">m²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_u', 'km²')">km²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_u', 'Mile²')">Mile²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_u', 'ac')">ac</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_u', 'yd²')">yd²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_u', 'ft²')">ft²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_u', 'in²')">in²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_u', 'cm²')">cm²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_u', 'mm²')">mm²</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="mag" class="font-s-14 text-blue" >{{ $lang['mag']}}</label>
                    <div class="relative w-full ">
                        <input type="number" name="mag" id="mag"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mag'])?$_POST['mag']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mag_u" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mag_u_dropdown')">{{ isset($_POST['mag_u'])?$_POST['mag_u']:'T' }} ▾</label>
                        <input type="text" name="mag_u" value="{{ isset($_POST['mag_u'])?$_POST['mag_u']:'T' }}" id="mag_u" class="hidden">
                        <div id="mag_u_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mag_u', 'T')">T</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mag_u', 'mT')">mT</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mag_u', 'μT')">μT</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="tor" class="font-s-14 text-blue" >{{ $lang['tor']}}</label>
                    <div class="relative w-full ">
                        <input type="number" name="tor" id="tor"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tor'])?$_POST['tor']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="torc_u" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('torc_u_dropdown')">{{ isset($_POST['torc_u'])?$_POST['torc_u']:'Nm' }} ▾</label>
                        <input type="text" name="torc_u" value="{{ isset($_POST['torc_u'])?$_POST['torc_u']:'Nm' }}" id="torc_u" class="hidden">
                        <div id="torc_u_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('torc_u', 'Nm')">Nm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('torc_u', 'kg-cm')">kg-cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('torc_u', 'J/rad')">μT</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('torc_u', 'ft-lb')">ft-lb</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1  gap-4 mt-3 hidden vector">
                <div class="space-y-2">
                    <p class="col-12 px-2"><strong>{{$lang['av']}}, r:</strong></p>
                </div>
            </div>
            <div class="grid grid-cols-3  lg:grid-cols-3 md:grid-cols-3  gap-4 hidden vector">
                
                <div class="space-y-2 relative">
                    <label for="ax" class="font-s-14 text-blue">&nbsp;</label>
                    <input type="number" step="any" name="ax" id="ax" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['ax'])?$_POST['ax']:'00' }}" />
                    <span class="text-blue input_unit">i</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="ay" class="font-s-14 text-blue">&nbsp;</label>
                    <input type="number" step="any" name="ay" id="ay" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['ay'])?$_POST['ay']:'00' }}" />
                        <span class="text-blue input_unit">i</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="az" class="font-s-14 text-blue">&nbsp;</label>
                    <input type="number" step="any" name="az" id="az" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['az'])?$_POST['az']:'00' }}" />
                    <span class="text-blue input_unit">i</span>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-3  gap-4 hidden vector">
                <div class="space-y-2">
                    <p class="col-12"><strong><?=$lang['bv']?>, F:</strong></p>
                </div>
            </div>
            <div class="grid grid-cols-3   lg:grid-cols-3 md:grid-cols-3  gap-4 hidden vector">
                <div class="space-y-2 relative">
                    <label for="bx" class="font-s-14 text-blue">&nbsp;</label>
                    <input type="number" step="any" name="bx" id="bx" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['bx'])?$_POST['bx']:'00' }}" />
                    <span class="text-blue input_unit">i</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="by" class="font-s-14 text-blue">&nbsp;</label>
                    <input type="number" step="any" name="by" id="by" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['by'])?$_POST['by']:'00' }}" />
                    <span class="text-blue input_unit">j</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="bz" class="font-s-14 text-blue">&nbsp;</label>
                    <input type="number" step="any" name="bz" id="bz" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['bz'])?$_POST['bz']:'00' }}" />
                    <span class="text-blue input_unit">k</span>
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
                <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                    <div class="lg:w-7/12 mt-2">
                        @if($_POST['to']==1)
                        <table class="w-full text-lg">
                            <tr>
                                <td class="py-2 border-b border-[#99EA48] w-7/10">{{ $lang['dis'] }}</td>
                                <td class="py-2 border-b border-[#99EA48]"><strong>{{ $detail['dis'] }}</strong></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b border-[#99EA48] w-7/10">{{ $lang['for'] }}</td>
                                <td class="py-2 border-b border-[#99EA48]"><strong>{{ $detail['force'] }}</strong></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b border-[#99EA48] w-7/10">{{ $lang['ang'] }}</td>
                                <td class="py-2 border-b border-[#99EA48]"><strong>{{ $detail['angle'] }}</strong></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b border-[#99EA48] w-7/10">{{ $lang['tor'] }}</td>
                                <td class="py-2 border-b border-[#99EA48]"><strong>{{ $detail['tor'] }}</strong></td>
                            </tr>
                        </table>
                        @elseif($_POST['to']==2)
                        <table class="w-full text-lg">
                            <tr>
                                <td class="py-2 border-b border-[#99EA48] w-7/10">{{ $lang['loop'] }}</td>
                                <td class="py-2 border-b border-[#99EA48]"><strong>{{ $detail['loop'] }}</strong></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b border-[#99EA48] w-7/10">{{ $lang['ang'] }}</td>
                                <td class="py-2 border-b border-[#99EA48]"><strong>{{ $detail['angle'] }}</strong></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b border-[#99EA48] w-7/10">{{ $lang['cur'] }}</td>
                                <td class="py-2 border-b border-[#99EA48]"><strong>{{ $detail['current'] }}</strong></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b border-[#99EA48] w-7/10">{{ $lang['area'] }}</td>
                                <td class="py-2 border-b border-[#99EA48]"><strong>{{ $detail['area'] }}</strong></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b border-[#99EA48] w-7/10">{{ $lang['mag'] }}</td>
                                <td class="py-2 border-b border-[#99EA48]"><strong>{{ $detail['mag'] }}</strong></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b border-[#99EA48] w-7/10">{{ $lang['tor'] }}</td>
                                <td class="py-2 border-b border-[#99EA48]"><strong>{{ $detail['tor'] }}</strong></td>
                            </tr>
                        </table>
                        @elseif($_POST['to']==3)
                        <p class="mt-2">{{ $lang['vector'] }} = <strong class="text-black">{{ $detail['ans'] }}</strong></p>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')

<script>

@if(isset($error))
    var to = "{{$_POST['to']}}";
    var torqueElements = document.querySelectorAll('.torque');
    var coilElements = document.querySelectorAll('.coil');
    var vectorElements = document.querySelectorAll('.vector');

    if (to == 1) {
        torqueElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
        coilElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        vectorElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    } else if (to == 2) {
        torqueElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        coilElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
        vectorElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    } else if (to == 3) {
        torqueElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        coilElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        vectorElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }
    

    @endif

    @if(isset($detail))
    var to = "{{$_POST['to']}}";
    var torqueElements = document.querySelectorAll('.torque');
    var coilElements = document.querySelectorAll('.coil');
    var vectorElements = document.querySelectorAll('.vector');

    if (to == 1) {
        torqueElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
        coilElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        vectorElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    } else if (to == 2) {
        torqueElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        coilElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
        vectorElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    } else if (to == 3) {
        torqueElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        coilElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        vectorElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }
    

    @endif


    document.getElementById('to').addEventListener('change', function() {
    var to = this.value;
    var torqueElements = document.querySelectorAll('.torque');
    var coilElements = document.querySelectorAll('.coil');
    var vectorElements = document.querySelectorAll('.vector');

    if (to == 1) {
        torqueElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
        coilElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        vectorElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    } else if (to == 2) {
        torqueElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        coilElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
        vectorElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    } else if (to == 3) {
        torqueElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        coilElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        vectorElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    }
});

</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>