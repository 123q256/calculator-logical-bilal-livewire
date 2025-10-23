<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6 file-size">
                    <label for="first" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-8">
                            <input type="text" name="first" id="first" class="input" aria-label="input" value="{{ isset($_POST['first']) ? $_POST['first'] : '620' }}" />
                        </div>
                        <div class="col-span-4">
                            <select name="f_unit" id="f_unit" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {{ $arr2[$index] }}
                                    </option>
                                @php
                                    }}
                                    $name = ["B", "kB", "MB","GB","TB","PB","EB","ZB","YB","bit","kbit","Mbit","Gbits","Tbit","KiB","MiB","GiB","TiB","PiB","EiB","ZiB","YiB","Kibit","Mibit","Gibit","Tibit"];
                                            $val = ["1", "2", "3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26"];
                                    optionsList($val,$name,isset($_POST['f_unit'])?$_POST['f_unit']:'3');
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 dwn-speed ">
                    <label for="second" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-8">
                            <input type="text" name="second" id="second" class="input" aria-label="input" value="{{ isset($_POST['second']) ? $_POST['second'] : '2' }}" />
                        </div>
                        <div class="col-span-4">
                            <select name="s_unit" id="s_unit" class="input">
                                @php
                                    $name = ["B/s", "kB/s", "MB/s","GB/s","TB/s","PB/s","EB/s","ZB/s","YB/s","bit/s","kbit/s","Mbit/s","Gbits/s","Tbit/s","KiB/s","MiB/s","GiB/s","TiB/s","PiB/s","EiB/s","ZiB/s","YiB/s","Kibit/s","Mibit/s","Gibit/s","Tibit/s"];
                                    $val = ["1", "2", "3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26"];
                                    optionsList($val,$name,isset($_POST['s_unit'])?$_POST['s_unit']:'3');
                                @endphp
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                    <label for="overhead" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="w-100 py-2">
                        <select name="overhead" id="overhead" class="input">
                            @php
                                $name = ["$lang[4]:0%","$lang[4]:5%","$lang[4]:10%","$lang[4]:20%","$lang[4]:30%","$lang[4]:40%","$lang[4]:50%"];
                                $val = ["1", "2", "3","4","5","6","7"];
                                optionsList($val,$name,isset($_POST['overhead'])?$_POST['overhead']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                    <label for="kilo" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2">
                        <select name="kilo" id="kilo" class="input">
                            @php
                                $name = ["1024","1000"];
                                $val = ["1", "2"];
                                optionsList($val,$name,isset($_POST['kilo'])?$_POST['kilo']:'1');
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                        @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="w-full md:w-[50%] lg:w-[50%] overflow-auto">
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
                                        <p class="text-[25px]"><strong>{{$lang[5]}}</strong></p>

                                            <div class="flex justify-between my-1">
                                            @php
                                                list($hours_ans,$minutes_ans,$seconds_ans) = explode(":", $detail['main_ans']);
                                            @endphp
                                            <p class="border-lg-end pe-lg-5">
                                                <b class="text-[25px]">
                                                    {{ $hours_ans }}
                                                </b>Hours
                                            </p>
                                            <p class="border-lg-end pe-lg-5">
                                                <b class="text-[25px]">
                                                    {{ $minutes_ans }}
                                                </b>Minutes
                                            </p>
                                            <p>
                                                <b class="text-[25px]">
                                                    {{ $seconds_ans }}
                                                </b>Seconds
                                            </p>
                                    </div>
                                </div>
                                <div class="w-full md:w-[60%] lg:w-[60%] overflow-auto">
                                    <table class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                        <tr>
                                            <td colspan="2" class="pt-3"><strong>Time in Days</strong></td>
                                        </tr>
                                        <tr>
                                            <td width="60%" class="border-b py-2">{{$days}}</td>
                                            <td class="border-b py-2">Days</p>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="pt-3"><strong>Times in Weeks</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$wks}}</td>
                                            <td class="border-b py-2">Weeks</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="pt-3"><strong>Times in Hours</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$hrs}}</td>
                                            <td class="border-b py-2">Hours</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="pt-3"><strong>Times in Minutes</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$min}}</td>
                                            <td class="border-b py-2">Minutes</td>
                                        </tr>
                                    </table>
                                    <table class="w-full md:w-[80%] mt-4 lg:w-[80%] mt-4">
                                        <tbody>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang[6]}}</strong></td>
                                                <td class="border-b py-2"><strong>{{$lang[7]}}</strong></td>
                                                <td class="border-b py-2"><strong>{{$lang[8]}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">T1/DS1 {{$lang[9]}}</td>
                                                <td class="border-b py-2">1.544 Mbps</td>
                                                <td class="border-b py-2">{{$detail['f1']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{$lang[10]}}</td>
                                                <td class="border-b py-2">10 Mbps</td>
                                                <td class="border-b py-2">{{$detail['f2']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{$lang[11]}}</td>
                                                <td class="border-b py-2">100 Mbps</td>
                                                <td class="border-b py-2">{{$detail['f3']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{$lang[12]}}</td>
                                                <td class="border-b py-2">1000 Mbps</td>
                                                <td class="border-b py-2">{{$detail['f4']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">10 {{$lang[13]}}</td>
                                                <td class="border-b py-2">10 Gbps</td>
                                                <td class="border-b py-2">{{$detail['f5']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">USB 2.0</td>
                                                <td class="border-b py-2">480 Mbps</td>
                                                <td class="border-b py-2">{{$detail['f6']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">USB 3.0</td>
                                                <td class="border-b py-2">5 Gbps</td>
                                                <td class="border-b py-2">{{$detail['f7']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{$lang[14]}}</td>
                                                <td class="border-b py-2">10 Gbps</td>
                                                <td class="border-b py-2">{{$detail['f8']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{$lang[14]}} 2</td>
                                                <td class="border-b py-2">20 Gbps</td>
                                                <td class="border-b py-2">{{$detail['f9']}}</td>
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
