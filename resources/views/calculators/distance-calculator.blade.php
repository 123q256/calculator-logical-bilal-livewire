@php
     if(isset($_POST['submit'])){
    $lat1=trim($_POST['lat1']);
    $long1=trim($_POST['long1']);
    $lat2=trim($_POST['lat2']);
    $long2=trim($_POST['long2']);
    $deg1=trim($_POST['deg1']);
    $mint1=trim($_POST['mint1']);
    $sec1=trim($_POST['sec1']);
    $dir1=trim($_POST['dir1']);
    $deg2=trim($_POST['deg2']);
    $mint2=trim($_POST['mint2']);
    $sec2=trim($_POST['sec2']);
    $dir2=trim($_POST['dir2']);
    $deg21=trim($_POST['deg21']);
    $mint21=trim($_POST['mint21']);
    $sec21=trim($_POST['sec21']);
    $dir21=trim($_POST['dir21']);
    $dir22=trim($_POST['dir22']);
    $deg22=trim($_POST['deg22']);
    $mint22=trim($_POST['mint22']);
    $sec22=trim($_POST['sec22']);
    $dir22=trim($_POST['dir22']);
    $to_cal=trim($_POST['to_cal']);
  }elseif(isset($_GET['res_link'])){
    $lat1=trim($_GET['lat1']);
    $long1=trim($_GET['long1']);
    $lat2=trim($_GET['lat2']);
    $long2=trim($_GET['long2']);
    $deg1=trim($_GET['deg1']);
    $mint1=trim($_GET['mint1']);
    $sec1=trim($_GET['sec1']);
    $dir1=trim($_GET['dir1']);
    $deg2=trim($_GET['deg2']);
    $mint2=trim($_GET['mint2']);
    $sec2=trim($_GET['sec2']);
    $dir2=trim($_GET['dir2']);
    $deg21=trim($_GET['deg21']);
    $mint21=trim($_GET['mint21']);
    $sec21=trim($_GET['sec21']);
    $dir21=trim($_GET['dir21']);
    $dir22=trim($_GET['dir22']);
    $deg22=trim($_GET['deg22']);
    $mint22=trim($_GET['mint22']);
    $sec22=trim($_GET['sec22']);
    $dir22=trim($_GET['dir22']);
    $to_cal=trim($_GET['to_cal']);
  }
@endphp
<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[90%] md:w-[90%] w-full mx-auto ">
            <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[90%] w-full">
                <div class="row">
                    <div class="col-12 col-lg-9 mt-2 lg:w-[90%] w-full mx-auto">
                        <input type="hidden" name="to_cal" id="calculator_time" value="{{ isset(request()->to_cal) ? request()->to_cal : 'decimal' }}">
        
                            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                                    
                                <div class="lg:w-1/2 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit " id="time_first">
                                        {{ $lang['1'] }}
                                    </div>
                                </div>
                                <div class="lg:w-1/2 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white " id="time_sec">
                                        {{$lang['2']}}
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class=" mx-auto">
                        <div class="row">
                            @if(isset($error))
                                <p class="text-danger font-s-18"><strong>{{ $error }}</strong></p>
                            @endif
                           
                            <div class="lg:w-[80%] w-full mx-auto mt-5 decimal">
                                <p class="font-bold mb-4">{{ $lang['5'] }} 1</p>
                                
                                <div class="grid grid-cols-2 gap-4 mt-2">
        
                                    <div class="">
                                        <label for="lat1" class="text-sm text-blue-600 block">{{ $lang['3'] }} 1:</label>
                                        <input type="number" name="lat1" id="lat1" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600" 
                                            value="{{ isset($_POST['lat1']) ? $_POST['lat1'] : '31.4504' }}" />
                                    </div>
                            
                                    <div class="">
                                        <label for="long1" class="text-sm text-blue-600 block">{{ $lang['4'] }} 1:</label>
                                        <input type="number" name="long1" id="long1" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600" 
                                            value="{{ isset($_POST['long1']) ? $_POST['long1'] : '73.1350' }}" />
                                    </div>
                                </div>
                            
                                <p class="font-bold mt-6 mb-4">{{ $lang['5'] }} 2</p>
                                
                                <div class="grid grid-cols-2 gap-4 mt-2">
                                    <div class="">
                                        <label for="lat2" class="text-sm text-blue-600 block">{{ $lang['3'] }} 2:</label>
                                        <input type="number" name="lat2" id="lat2" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600" 
                                            value="{{ isset($_POST['lat2']) ? $_POST['lat2'] : '30.7659' }}" />
                                    </div>
                            
                                    <div class="">
                                        <label for="long2" class="text-sm text-blue-600 block">{{ $lang['4'] }} 2:</label>
                                        <input type="number" name="long2" id="long2" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600" 
                                            value="{{ isset($_POST['long2']) ? $_POST['long2'] : '72.4376' }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="mint hidden mt-5">
                                <p class="mb-2 font-bold">{{$lang['5']}} 1</p>
                                <div class="lg:flex items-center">
                                    <div class="lg:w-[10%] w-full mt-0 pt-2 lg:mt-2 lg:pr-2">
                                        {{$lang['3']}}
                                    </div>
                                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-2">
                                        <div class=" lg:pr-2">
                                            <label for="deg1" class="label">{{ $lang['6'] }}:</label>
                                            <div class="w-full py-2">
                                                <input type="number" name="deg1" id="deg1" class="w-full border border-gray-300 rounded-md p-2" value="{{ isset($_POST['deg1'])?$_POST['deg1']:'31.4504' }}" />
                                            </div>
                                        </div>
                                        <div class=" lg:pr-2">
                                            <label for="mint1" class="label">{{ $lang['7'] }}:</label>
                                            <div class="w-full py-2">
                                                <input type="number" name="mint1" id="mint1" class="w-full border border-gray-300 rounded-md p-2" value="{{ isset($_POST['mint1'])?$_POST['mint1']:'73.1350' }}" />
                                            </div>
                                        </div>
                                        <div class=" lg:pr-2">
                                            <label for="sec1" class="label">{{ $lang['8'] }}:</label>
                                            <div class="w-full py-2">
                                                <input type="number" name="sec1" id="sec1" class="w-full border border-gray-300 rounded-md p-2" value="{{ isset($_POST['sec1'])?$_POST['sec1']:'73.1350' }}" />
                                            </div>
                                        </div>
                                        <div class="">
                                            <label for="dir1" class="label">&nbsp;</label>
                                            <div class="w-full py-2">
                                                <select name="dir1" id="dir1" class="w-full border border-gray-300 rounded-md p-2">
                                                    <option value="N">N</option>
                                                    <option value="S">S</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="lg:flex items-center">
                                    <div class="lg:w-[10%] w-full mt-0 pt-2 lg:mt-2 lg:pr-2">
                                        {{$lang['4']}}
                                    </div>
                                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-2">
                                        <div class="lg:pr-2">
                                            <label for="deg2" class="label">{{ $lang['6'] }}:</label>
                                            <div class="w-full py-2">
                                                <input type="number" name="deg2" id="deg2" class="w-full border border-gray-300 rounded-md p-2" value="{{ isset($_POST['deg2'])?$_POST['deg2']:'31.4504' }}" />
                                            </div>
                                        </div>
                                        <div class="lg:pr-2">
                                            <label for="mint2" class="label">{{ $lang['7'] }}:</label>
                                            <div class="w-full py-2">
                                                <input type="number" name="mint2" id="mint2" class="w-full border border-gray-300 rounded-md p-2" value="{{ isset($_POST['mint2'])?$_POST['mint2']:'73.1350' }}" />
                                            </div>
                                        </div>
                                        <div class="lg:pr-2">
                                            <label for="sec2" class="label">{{ $lang['8'] }}:</label>
                                            <div class="w-full py-2">
                                                <input type="number" name="sec2" id="sec2" class="w-full border border-gray-300 rounded-md p-2" value="{{ isset($_POST['sec2'])?$_POST['sec2']:'73.1350' }}" />
                                            </div>
                                        </div>
                                        <div class="lg:mt-2">
                                            <label for="dir2" class="label">&nbsp;</label>
                                            <div class="w-full py-2">
                                                <select name="dir2" id="dir2" class="w-full border border-gray-300 rounded-md p-2">
                                                    <option value="E">E</option>
                                                    <option value="W">W</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-2 font-bold">{{$lang['5']}} 2</p>
                                <div class="lg:flex items-center">
                                    <div class="lg:w-[10%] w-full mt-0 pt-2 lg:mt-2 lg:pr-2">
                                        {{$lang['3']}}
                                    </div>
                                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-2">
                                        <div class="lg:pr-2">
                                            <label for="deg21" class="label">{{ $lang['6'] }}:</label>
                                            <div class="w-full py-2">
                                                <input type="number" name="deg21" id="deg21" class="w-full border border-gray-300 rounded-md p-2" value="{{ isset($_POST['deg21'])?$_POST['deg21']:'31' }}" />
                                            </div>
                                        </div>
                                        <div class="lg:pr-2">
                                            <label for="mint21" class="label">{{ $lang['7'] }}:</label>
                                            <div class="w-full py-2">
                                                <input type="number" name="mint21" id="mint21" class="w-full border border-gray-300 rounded-md p-2" value="{{ isset($_POST['mint21'])?$_POST['mint21']:'73' }}" />
                                            </div>
                                        </div>
                                        <div class="lg:pr-2">
                                            <label for="sec21" class="label">{{ $lang['8'] }}:</label>
                                            <div class="w-full py-2">
                                                <input type="number" name="sec21" id="sec21" class="w-full border border-gray-300 rounded-md p-2" value="{{ isset($_POST['sec21'])?$_POST['sec21']:'73' }}" />
                                            </div>
                                        </div>
                                        <div class=" lg:mt-2">
                                            <label for="dir2" class="label">&nbsp;</label>
                                            <div class="w-full py-2">
                                                <select name="dir21" id="dir21" class="w-full border border-gray-300 rounded-md p-2">
                                                    <option value="N">N</option>
                                                    <option value="S">S</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:flex items-center">
                                    <div class="lg:w-[10%] w-full mt-0 pt-2 lg:mt-2 lg:pr-2">
                                        {{$lang['4']}}
                                    </div>
                                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-2">
                                        <div class="lg:mt-2 lg:pr-2">
                                            <label for="deg22" class="label">{{ $lang['6'] }}:</label>
                                            <div class="w-full py-2">
                                                <input type="number" name="deg22" id="deg22" class="w-full border border-gray-300 rounded-md p-2" value="{{ isset($_POST['deg22'])?$_POST['deg22']:'31' }}" />
                                            </div>
                                        </div>
                                        <div class="lg:mt-2 lg:pr-2">
                                            <label for="mint22" class="label">{{ $lang['7'] }}:</label>
                                            <div class="w-full py-2">
                                                <input type="number" name="mint22" id="mint22" class="w-full border border-gray-300 rounded-md p-2" value="{{ isset($_POST['mint22'])?$_POST['mint22']:'73' }}" />
                                            </div>
                                        </div>
                                        <div class="lg:mt-2 lg:pr-2">
                                            <label for="sec22" class="label">{{ $lang['8'] }}:</label>
                                            <div class="w-full py-2">
                                                <input type="number" name="sec22" id="sec22" class="w-full border border-gray-300 rounded-md p-2" value="{{ isset($_POST['sec22'])?$_POST['sec22']:'7' }}" />
                                            </div>
                                        </div>
                                        <div class=" mt-0 lg:mt-2">
                                            <label for="dir22" class="label">&nbsp;</label>
                                            <div class="w-full py-2">
                                                <select name="dir22" id="dir22" class="w-full border border-gray-300 rounded-md p-2">
                                                    <option value="E">E</option>
                                                    <option value="W">W</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg p-2 flex items-center justify-center">
                <div class="w-full col-12   p-3  rounded-lg  mt-6">
                    <div class="my-4">
                        <div class="w-full lg:w-10/12">
                            <p class="font-bold text-lg">{{ $lang['9'] }}</p>
                            <table class="w-full text-lg mt-4">
                                @if ($to_cal === 'decimal')
                                    <tr>
                                        <td colspan="2" class="py-3">[{{ $lat1 }}, {{ $long1 }}] {{ $lang['10'] }} [{{ $lat2 }}, {{ $long2 }}]</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3 pr-4">{{ round($detail['mile'], 1) }}</td>
                                        <td class="py-3 text-right">Miles</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3 pr-4">{{ round($detail['km'], 1) }}</td>
                                        <td class="py-3 text-right">KM</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="py-3">[{{ $deg1 }}° {{ $mint1 }}' {{ $sec1 }}" {{ $dir1 }}, {{ $deg2 }}° {{ $mint2 }}' {{ $sec2 }}" {{ $dir2 }}] 
                                            <br>{{ $lang['10'] }} <br>
                                            [{{ $deg21 }}° {{ $mint21 }}' {{ $sec21 }}" {{ $dir21 }}, {{ $deg22 }}° {{ $mint22 }}' {{ $sec22 }}" {{ $dir22 }}]
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3 pr-4">{{ round($detail['mile'], 1) }}</td>
                                        <td class="py-3 text-right">Miles</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3 pr-4">{{ round($detail['km'], 1) }}</td>
                                        <td class="py-3 text-right">KM</td>
                                    </tr>
                                @endif
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

    document.getElementById('time_first').addEventListener('click', function() {
        this.classList.add('tagsUnit');
        document.getElementById('calculator_time').value = "decimal";
        
        document.getElementById('time_sec').classList.remove('tagsUnit');
        document.querySelectorAll('.decimal').forEach(element => {
            element.classList.add("d-lg-flex");
            element.classList.remove("hidden");
        });
        document.querySelectorAll('.mint').forEach(element => {
            element.classList.add("hidden");
        });
    });

    document.getElementById('time_sec').addEventListener('click', function() {
        this.classList.add('tagsUnit');
        document.getElementById('calculator_time').value = "mint";
        document.getElementById('time_first').classList.remove('tagsUnit');
        document.querySelectorAll('.decimal').forEach(element => {
            element.classList.add("hidden");
        });
        document.querySelectorAll('.mint').forEach(element => {
            element.classList.add("d-lg-flex");
            element.classList.remove("hidden");
        });

    });

    @if(isset($detail) || isset($error))

        to_cal = '{{$_POST['to_cal']}}';

        if (to_cal === 'decimal') {

            document.getElementById('time_first').classList.add('tagsUnit');
            document.getElementById('time_sec').classList.remove('tagsUnit');
            document.querySelectorAll('.decimal').forEach(element => {
                element.classList.add("d-lg-flex");
                element.classList.remove("hidden");
            });
            document.querySelectorAll('.mint').forEach(element => {
                element.classList.add("hidden");
            });
        }

        if (to_cal === 'mint') {

            document.getElementById('time_first').classList.remove('tagsUnit');
            document.getElementById('time_sec').classList.add('tagsUnit');

            document.querySelectorAll('.decimal').forEach(element => {
                element.classList.add("hidden");
            });
            document.querySelectorAll('.mint').forEach(element => {
                element.classList.add("d-lg-flex");
                element.classList.remove("hidden");
            });
        

            
        }


    @endif

</script>
@endpush



