<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 mt-2 gap-4">
                <div class="space-y-2 relative">
                    <label for="type" class="label">{{ $lang['1'] }}</label>
                    <select name="type" id="type" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["Yes", "No"];
                            $val = ["yes","no"];
                            optionsList($val,$name,isset($_POST['type'])?$_POST['type']: 'yes' );
                        @endphp
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1  mt-3 gap-4">
                <p class="mt-1">{{ $lang['2'] }}</p>
            </div>
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="r_length" class="label">{{ $lang['4'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="r_length" id="r_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['r_length'])?$_POST['r_length']:'100' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="rl_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rl_units_dropdown')">{{ isset($_POST['rl_units'])?$_POST['rl_units']:'ft' }} ▾</label>
                        <input type="text" name="rl_units" value="{{ isset($_POST['rl_units'])?$_POST['rl_units']:'ft' }}" id="rl_units" class="hidden">
                        <div id="rl_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[40%] mt-1 right-0 hidden">
                            @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rl_units', '{{$name}}')">{{$name}}</p>
                           @endforeach
                       
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="r_width" class="label">{{ $lang['5'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="r_width" id="r_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['r_width'])?$_POST['r_width']:'100' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="rw_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rw_units_dropdown')">{{ isset($_POST['rw_units'])?$_POST['rw_units']:'ft' }} ▾</label>
                        <input type="text" name="rw_units" value="{{ isset($_POST['rw_units'])?$_POST['rw_units']:'ft' }}" id="rw_units" class="hidden">
                        <div id="rw_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[40%] mt-1 right-0 hidden">
                            @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rw_units', '{{$name}}')">{{$name}}</p>
                           @endforeach
                       
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 hidden noclass">
                    <label for="roof_pitch" class="label">{{ $lang['6'].' '.$lang['7'] }}</label>
                    <select name="roof_pitch" id="roof_pitch" class="input">
                        @php
                        $name = ["1:12","2:12","3:12","4:12","5:12","6:12","7:12","8:12","9:12","10:12","11:12","12:12","13:12","14:12","15:12","16:12","17:12","18:12","19:12","20:12","21:12","22:12","23:12","24:12","25:12","26:12","27:12","28:12","29:12","30:12"];
                            $val = ["1:12","2:12","3:12","4:12","5:12","6:12","7:12","8:12","9:12","10:12","11:12","12:12","13:12","14:12","15:12","16:12","17:12","18:12","19:12","20:12","21:12","22:12","23:12","24:12","25:12","26:12","27:12","28:12","29:12","30:12"];
                            optionsList($val,$name,isset($_POST['roof_pitch'])?$_POST['roof_pitch']: '1:12' );
                        @endphp
                    </select>
                 </div>
            </div>
            <div class="grid grid-cols-1 mt-3  gap-4">
                <p class="mt-1">{{$lang['8']}}</p>
            </div>
            <div class="grid grid-cols-2  mt-3 lg:grid-cols-2 md:grid-cols-2  gap-4">
                 <div class="space-y-2">
                    <label for="p_length" class="label">{{ $lang['4'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="p_length" id="p_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p_length'])?$_POST['p_length']:'16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pl_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pl_units_dropdown')">{{ isset($_POST['pl_units'])?$_POST['pl_units']:'ft' }} ▾</label>
                        <input type="text" name="pl_units" value="{{ isset($_POST['pl_units'])?$_POST['pl_units']:'ft' }}" id="pl_units" class="hidden">
                        <div id="pl_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[40%] mt-1 right-0 hidden">
                            @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pl_units', '{{$name}}')">{{$name}}</p>
                           @endforeach
                       
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="p_width" class="label">{{ $lang['5'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="p_width" id="p_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p_width'])?$_POST['p_width']:'16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pw_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pw_units_dropdown')">{{ isset($_POST['pw_units'])?$_POST['pw_units']:'ft' }} ▾</label>
                        <input type="text" name="pw_units" value="{{ isset($_POST['pw_units'])?$_POST['pw_units']:'ft' }}" id="pw_units" class="hidden">
                        <div id="pw_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[40%] mt-1 right-0 hidden">
                            @foreach (["cm", "m", "in", "ft", "yd"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pw_units', '{{$name}}')">{{$name}}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
            </div>
            <div class="grid grid-cols-1  mt-3  gap-4">
                <p class="mt-1">{{$lang['10']}}</p>
            </div>
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="cost" class="label">{{$lang['11'].' '.$lang['8'] }}</label>
                    <input type="number" step="any" name="cost" id="cost" class="input" aria-label="input"  value="{{ isset($_POST['cost'])?$_POST['cost']:'3' }}" />
                    <span class="input_unit">{{$currancy}}</span>
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
    @else

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18">
                            <table class="w-100">
                                <tr>
                                    <td width="60%" class="border-b py-2"><strong>{{$lang['12']}} :</strong></td>
                                    <td class="border-b py-2">{{round($detail['panel'],0)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['10']}} :</strong></td>
                                    <td class="border-b py-2">{{ $currancy.' '.round($detail['expense'],0)}}</td>
                                </tr>
                                <tr>
                                    <td class="pt-2" colspan="2"><strong>{{ $lang['6'] }} {{ $lang['13'] }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['14'] }} {{ $lang['15'] }} :</td>
                                    <td class="border-b py-2">{{$detail['r_area']}} ft<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['14'] }} {{ $lang['16'] }} :</td>
                                    <td class="border-b py-2">{{$detail['r_area'] * 0.0929}} m<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['14'] }} {{ $lang['17'] }} :</td>
                                    <td class="border-b py-2">{{$detail['r_area'] * 0.1111}} yd<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <td class="pt-2" colspan="2"><strong>{{ $lang['8'] }} {{ $lang['13'] }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['14'] }} {{ $lang['15'] }} :</td>
                                    <td class="border-b py-2">{{$detail['p_area']}} ft<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['14'] }} {{ $lang['18'] }} :</td>
                                    <td class="border-b py-2">{{$detail['r_area'] * 0.0929}} cm<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['14'] }} {{ $lang['19'] }} :</td>
                                    <td class="border-b py-2">{{$detail['r_area'] * 9.29}} dm<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['14'] }} {{ $lang['16'] }} :</td>
                                    <td class="border-b py-2">{{$detail['r_area'] * 0.0929}} m<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['14'] }} {{ $lang['20'] }} :</td>
                                    <td class="border-b py-2">{{$detail['r_area'] * 144}} in<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['14'] }} {{ $lang['17'] }} :</td>
                                    <td class="border-b py-2">{{$detail['r_area'] * 0.1111}} yd<sup>2</sup></td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <div class="col s12 padding_0">
                                <p class="mt-2 font-s-18"> <strong>{{ $lang['21'] }}</strong></p>
                                <p class="mt-2">{{ $lang['6'] }} {{ $lang['4'] }} = {{ $detail['r_length']}} ft</p>
                                <p class="mt-2">{{ $lang['6'] }} {{ $lang['5'] }} = {{ $detail['r_width']}} ft</p>
                                @if (isset($detail['roof_pitch']))
                                    <p class="mt-2"> {{ $lang['6'] }} {{ $lang['7'] }} = {{ $detail['roof_pitch']}} -  {{ $lang['22'] }} - {{ $detail['value']}}</p>
                                @endif
                                <p class="mt-2"> {{ $lang['8'] }} {{ $lang['4'] }} = {{ $detail['p_length']}}  ft</p>
                                <p class="mt-2">{{ $lang['8'] }} {{ $lang['5'] }} = {{ $detail['p_width']}} ft</p>
                                <p class="mt-2">{{ $lang['11'] }} {{ $lang['8'] }} = {{$currancy}} {{ $detail['cost']}} </p>
                                <p class="mt-2 font-s-18"> <strong>{{ $lang['23'] }}</strong></p>
                                <p class="mt-2 color_blue padding_5">{{ $lang['24'] }} {{ $lang['6'] }} {{ $lang['13'] }}. </p>
                                <p class="mt-2"> {{ $lang['6'] }} {{ $lang['13'] }} =  {{ $lang['6'] }} {{ $lang['4'] }} <i>x</i> {{ $lang['6'] }} {{ $lang['5'] }} 
                                    @if (isset($detail['roof_pitch']))
                                        \( \times \text{ {{ $lang['6'] }} {{ $lang['7'] }}}\)
                                    @endif
                                </p>
                                <p class="mt-2">{{ $lang['6'] }} {{ $lang['13'] }} = {{ $detail['r_length']}} <i>x</i> {{ $detail['r_width']}}
                                    @if (isset($detail['roof_pitch']))
                                        \( \times {{ $detail['value']}}\)
                                    @endif
                                </p>
                                <p class="mt-2 text-[#2845F5] text-accent-4">{{ $lang['6'] }} {{ $lang['13'] }} = {{ $detail['r_area']}} ft<sup>2</sup></p>
                                <p class="mt-2 color_blue padding_5">{{ $lang['24'] }} {{ $lang['8'] }} {{ $lang['13'] }}. </p>
                                <p class="mt-2"> {{ $lang['8'] }} {{ $lang['13'] }}  =  {{ $lang['8'] }} {{ $lang['4'] }} <i>x</i> {{ $lang['8'] }} {{ $lang['5'] }}</p>
                                <p class="mt-2"> {{ $lang['8'] }} {{ $lang['13'] }}  = {{ $detail['p_length']}} <i>x</i> {{ $detail['p_width']}}</p>
                                <p class="mt-2 text-[#2845F5] text-accent-4">{{ $lang['8'] }} {{ $lang['13'] }} = {{ $detail['p_area']}} ft<sup>2</sup></p>
                                <p class="mt-2 color_blue padding_5">{{ $lang['24'] }} {{ $lang['12'] }}.</p>
                                <p class="mt-2">{{ $lang['25'] }} = 
                                    <span class="fraction">
                                        <span class="num">{{ $lang['6'] }} {{ $lang['13'] }}</span>
                                        <span class="visually-hidden "></span>
                                        <span class="den">{{ $lang['8'] }} {{ $lang['13'] }}</span>
                                    </span>
                                     </p>
                                <p class="mt-2">{{ $lang['25'] }} 
                                    <span class="fraction">
                                        <span class="num">{{ $detail['r_area']}}</span>
                                        <span class="visually-hidden "></span>
                                        <span class="den">{{ $detail['p_area']}}</span>
                                    </span>
                                </p>
                                <p class="mt-2 text-[#2845F5] text-accent-4">{{ $lang['25'] }} = {{ $detail['panel']}} </p>
                                <p class="mt-2 color_blue padding_5">{{ $lang['24'] }} {{ $lang['10'] }}.</p>
                                <p class="mt-2"> {{ $lang['10'] }} =  {{ $lang['11'] }} {{ $lang['8'] }} <i>x</i> {{ $lang['25'] }}</p>
                                <p class="mt-2">{{ $lang['10'] }} = {{ $detail['cost']}} <i>x</i> {{ $detail['panel']}}</p>
                                <p class="mt-2 text-[#2845F5] text-accent-4"> {{ $lang['10'] }} = {{ round($detail['expense'],0)}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full text-center mt-3">
                        <a href="{{ url()->current() }}/" class="calculate bg-[#000000] shadow-2xl text-[#fff] hover:bg-[#2845F5]  duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                            @if (app()->getLocale() == 'en')
                                RESET
                            @else
                                {{ $lang['reset'] ?? 'RESET' }}
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
@push('calculatorJS')
    <script>
        var noclass = document.querySelector('.noclass');
        document.getElementById('type').addEventListener('change',function(){
            var type = this.value;
            if(type == 'no'){
                noclass.style.display = "block";
            }else{
                noclass.style.display = "none";
            }
        });
    </script>
@endpush