<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="angle" class="font-s-14 text-blue">{{$lang['1']}} (θ)</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle" id="angle" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle']) ? $_POST['angle'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_unit_dropdown')">{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }} ▾</label>
                        <input type="text" name="angle_unit" value="{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }}" id="angle_unit" class="hidden">
                        <div id="angle_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'deg')">degrees (deg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'rad')">radians (rad)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'pirad')">* π rad (pirad)</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 text-center flex justify-center">
                    <img src="{{asset('images/sec_prop.png')}}" height="100%" width="70%" alt="Secant Graph" style="object-fit: contain;" loading="lazy" decoding="async">
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
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    @php
                                        if($_POST['angle_unit']==='deg'){
                                            $deg='°';
                                        }elseif($_POST['angle_unit']==='pirad'){
                                            $deg=' * π';
                                        }else{
                                            $deg='';
                                        }
                                        $sec=$detail['sec'];
                                        $table=array("1.41421356"=>"\sqrt 2", "1.15470054"=>"2{\sqrt 3} \over 3");
                                    @endphp
                                    @if($_POST['angle_unit']==='deg')
                                        @php
                                            $val='';
                                            foreach($table as $key => $value){
                                                if($sec<0){
                                                    $key=$key*(-1);
                                                }
                                                if("$key"==="$sec"){
                                                    $val=$value;
                                                }
                                            }
                                        @endphp
                                        @if(!empty($val))
                                            @php
                                                if($sec<0){
                                                    $val='-'.$val;
                                                }
                                            @endphp
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>sec({{$_POST['angle'].$deg}})</strong></td>
                                                <td class="py-2 border-b">\( {{$val}} \)</td>
                                            </tr>
                                        @endif
                                    @endif
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>sec({{$_POST['angle'].$deg}})</strong></td>
                                        <td class="py-2 border-b">{{$sec}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
    @endpush
</form>