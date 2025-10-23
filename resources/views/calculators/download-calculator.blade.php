@php
    if (isset($_POST['submit'])) {
		$operations=$_POST['operations'];
	}elseif(isset($_GET['res_link'])){
		$operations=$_GET['operations'];
    }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select name="operations" id="operations" class="input my-2">
                        <option value="1" {{ isset($_POST['operations']) && $_POST['operations'] === "1" ? 'selected' : '' }}>{{ $lang['2'] }}</option>
                        <option value="2" {{ isset($_POST['operations']) && $_POST['operations'] === "2" ? 'selected' : '' }}> {{ $lang['3'] }}</option>
                        <option value="3" {{ isset($_POST['operations']) && $_POST['operations'] === "3" ? 'selected' : '' }}> {{ $lang['4'] }}</option>
                    </select>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6 file-size">
                    <label for="first" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['f_unit'])?$_POST['f_unit']:'MB' }} ▾</label>
                        <input type="text" name="f_unit" value="{{ isset($_POST['f_unit'])?$_POST['f_unit']:'MB' }}" id="f_unit" class="hidden">
                        <div id="f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'B')">B</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'kB')">kB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'MB')" selected>MB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'GB')">GB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'TB')">TB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'PB')">PB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'EB')">EB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'ZB')">ZB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'YB')">YB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'bit')">bit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'kbit')">kbit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'Mbit')">Mbit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'Gbits')">Gbits</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'Tbit')">Tbit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'KiB')">KiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'MiB')">MiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'GiB')">GiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'TiB')">TiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'PiB')">PiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'EiB')">EiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'ZiB')">ZiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'YiB')">YiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'Kibit')">Kibit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'Mibit')">Mibit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'Gibit')">Gibit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'Tibit')">Tibit</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 dwn-time {{ isset($_POST['operations']) && $_POST['operations'] !== "1" ? 'd-block' : 'd-none' }}">
                    <label for="third" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third']) ? $_POST['third'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_unit_dropdown')">{{ isset($_POST['t_unit'])?$_POST['t_unit']:'min' }} ▾</label>
                        <input type="text" name="t_unit" value="{{ isset($_POST['t_unit'])?$_POST['t_unit']:'min' }}" id="t_unit" class="hidden">
                        <div id="t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'sec')">sec</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'min')">min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'hrs')">hrs</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'days')">days</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'wks')">wks</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'mos')">mos</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'yrs')">yrs</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 dwn-speed {{ isset($_POST['operations']) && $_POST['operations'] === "2" ? 'd-none' : 'd-block' }}">
                    <label for="second" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="s_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('s_unit_dropdown')">{{ isset($_POST['s_unit'])?$_POST['s_unit']:'MB' }} ▾</label>
                        <input type="text" name="s_unit" value="{{ isset($_POST['s_unit'])?$_POST['s_unit']:'MB' }}" id="s_unit" class="hidden">
                        <div id="s_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="s_unit">
                          
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'B')">B</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'kB')">kB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'MB')" selected>MB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'GB')">GB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'TB')">TB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'PB')">PB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'EB')">EB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'ZB')">ZB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'YB')">YB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'bit')">bit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'kbit')">kbit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'Mbit')">Mbit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'Gbits')">Gbits</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'Tbit')">Tbit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'KiB')">KiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'MiB')">MiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'GiB')">GiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'TiB')">TiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'PiB')">PiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'EiB')">EiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'ZiB')">ZiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'YiB')">YiB</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'Kibit')">Kibit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'Mibit')">Mibit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'Gibit')">Gibit</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_unit', 'Tibit')">Tibit</p>
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
                        <div class="w-full my-1">
                            <div class="w-full md:w-[80%] lg:w-[80%] lg:text-[18px] md:text-[18px] text-[16px] overflow-auto">
                                @if ($operations==1)
                                    @php
                                        $min = $detail['jawab'] / 60;
                                        $min = round($min, 5);
                                        $hrs = $detail['jawab'] / 3600;
                                        $hrs = round($hrs, 5);
                                        $days = $detail['jawab'] / 86400;
                                        $days = round($days, 5);
                                        $wks = $detail['jawab'] / 604800;
                                        $wks = round($wks, 5);
                                    @endphp
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[2] }} :</strong></td>
                                            <td class="border-b py-2">{{$detail['jawab']." "."sec"}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[2] }} (min) :</strong></td>
                                            <td class="border-b py-2">{{$min." "."min"}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[2] }} (hrs) :</strong></td>
                                            <td class="border-b py-2">{{$hrs." "."hrs"}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[2] }} (days) :</strong></td>
                                            <td class="border-b py-2">{{$days." "."days"}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[2] }} (wks) :</strong></td>
                                            <td class="border-b py-2">{{$wks." "."wks"}}</td>
                                        </tr>
                                    </table>
                                    <table class="w-full text-center">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang[5]}}</strong></td>
                                            <td class="border-b py-2"><strong>{{$lang[3]}}</strong></td>
                                            <td class="border-b py-2"><strong>{{$lang[2]}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[6]}}</td>
                                            <td class="border-b py-2">28,8 kbit/s</td>
                                            <td class="border-b py-2">{{$detail['f1']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[6]}}</td>
                                            <td class="border-b py-2">56,6 kbit/s</td>
                                            <td class="border-b py-2">{{$detail['f2']}}</td>
                                            </tr>
                                        <tr>
                                            <td class="border-b py-2">ADSL</td>
                                            <td class="border-b py-2">256 kbit/s</td>
                                            <td class="border-b py-2">{{$detail['f3']}}</td>
                                            </tr>
                                        <tr>
                                            <td class="border-b py-2">ADSL</td>
                                            <td class="border-b py-2">512 kbit/s</td>
                                            <td class="border-b py-2">{{$detail['f4']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">ADSL</td>
                                            <td class="border-b py-2">1 Mbit/s</td>
                                            <td class="border-b py-2">{{$detail['f5']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">ADSL</td>
                                            <td class="border-b py-2">2 Mbit/s</td>
                                            <td class="border-b py-2">{{$detail['f6']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">ADSL</td>
                                            <td class="border-b py-2">8 Mbit/s</td>
                                            <td class="border-b py-2">{{$detail['f7']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">ADSL</td>
                                            <td class="border-b py-2">24 Mbit/s</td>
                                            <td class="border-b py-2">{{$detail['f8']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">LAN</td>
                                            <td class="border-b py-2">10 Mbit/s</td>
                                            <td class="border-b py-2">{{$detail['f9']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">LAN</td>
                                            <td class="border-b py-2">100 Mbit/s</td>
                                            <td class="border-b py-2">{{$detail['f10']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[7]}} 3G</td>
                                            <td class="border-b py-2">7,2 Mbit/s</td>
                                            <td class="border-b py-2">{{$detail['f11']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">4G</td>
                                            <td class="border-b py-2">80 Mbit/s</td>
                                            <td class="border-b py-2">{{$detail['f12']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">5G</td>
                                            <td class="border-b py-2">1 Gbit/s</td>
                                            <td class="border-b py-2">{{$detail['f13']}}</td>
                                        </tr>
                                    </table>
                                @elseif ($operations==2)
                                    @php
                                        $kb = $detail['jawab'] * 1000;
                                        $gb = $detail['jawab'] / 1000;
                                        $tb = $detail['jawab'] / 1000000;
                                        $b = $detail['jawab'] * 1000000;
                                    @endphp
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[3] }} :</strong></td>
                                            <td class="border-b py-2">{{$detail['jawab']." "."MB"}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[3] }} (b) :</strong></td>
                                            <td class="border-b py-2">{{$b." "."b"}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[3] }} (kb) :</strong></td>
                                            <td class="border-b py-2">{{$kb." "."kb"}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[3] }} (gb) :</strong></td>
                                            <td class="border-b py-2">{{$gb." "."gb"}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[3] }} (tb) :</strong></td>
                                            <td class="border-b py-2">{{$tb." "."tb"}}</td>
                                        </tr>
                                    </table>
                                @elseif ($operations==3)
                                    @php
                                        $kb = $detail['jawab'] * 1000;
                                        $gb = $detail['jawab'] / 1000;
                                        $tb = $detail['jawab'] / 1000000;
                                        $b = $detail['jawab'] * 1000000;
                                    @endphp
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[4] }} :</strong></td>
                                            <td class="border-b py-2">{{$detail['jawab']." "."MB"}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[4] }} (b) :</strong></td>
                                            <td class="border-b py-2">{{$b." "."b"}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[4] }} (kb) :</strong></td>
                                            <td class="border-b py-2">{{$kb." "."kb"}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[4] }} (gb) :</strong></td>
                                            <td class="border-b py-2">{{$gb." "."gb"}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[4] }} (tb) :</strong></td>
                                            <td class="border-b py-2">{{$tb." "."tb"}}</td>
                                        </tr>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS') 
    <script>
        var x = document.querySelector('.file-size');
        var y = document.querySelector('.dwn-time');
        var z = document.querySelector('.dwn-speed');
        @if(isset($detail))
            var value = document.getElementById('operations').value;
            if (value == 1) {
                x.classList.add('d-block');
                x.classList.remove("d-none");
                y.classList.add('d-none');
                y.classList.remove('d-block');
                z.classList.add('d-block');
                z.classList.remove("d-none");
            } else if(value == 2) {
                x.classList.add("d-block");
                x.classList.remove("d-none");
                y.classList.add("d-block");
                y.classList.remove("d-none");
                z.classList.add("d-none");
                z.classList.remove("d-block");
            }else{
                x.classList.add("d-none");
                x.classList.remove("d-block");
                y.classList.add("d-block");
                y.classList.remove("d-none");
                z.classList.add("d-block");
                z.classList.remove("d-none");
            }
        @endif
        document.getElementById('operations').addEventListener('change', function() {
            var value = this.value;
            if (value == 1) {
                x.classList.add('d-block');
                x.classList.remove("d-none");
                y.classList.add('d-none');
                y.classList.remove('d-block');
                z.classList.add('d-block');
                z.classList.remove("d-none");
            } else if(value == 2) {
                x.classList.add("d-block");
                x.classList.remove("d-none");
                y.classList.add("d-block");
                y.classList.remove("d-none");
                z.classList.add("d-none");
                z.classList.remove("d-block");
            }else{
                x.classList.add("d-none");
                x.classList.remove("d-block");
                y.classList.add("d-block");
                y.classList.remove("d-none");
                z.classList.add("d-block");
                z.classList.remove("d-none");
            }
        });
    </script>
    @endpush 
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>