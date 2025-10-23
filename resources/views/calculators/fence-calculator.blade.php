<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  gap-4">
                      
                 <div class="space-y-2">
                    <label for="f_length" class="label"> {{ $lang['6'] }} :</label>
                    <div class="relative w-full ">
                        <input type="number" name="f_length" id="f_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f_length'])?$_POST['f_length']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="fl_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fl_units_dropdown')">{{ isset($_POST['fl_units'])?$_POST['fl_units']:'km' }} ▾</label>
                        <input type="text" name="fl_units" value="{{ isset($_POST['fl_units'])?$_POST['fl_units']:'km' }}" id="fl_units" class="hidden">
                        <div id="fl_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fl_units', '{{$name}}')">{{$name}}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="post_space" class="label"> {{ $lang['7'] }} :</label>
                    <div class="relative w-full ">
                        <input type="number" name="post_space" id="post_space" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['post_space'])?$_POST['post_space']:'1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="po_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('po_units_dropdown')">{{ isset($_POST['po_units'])?$_POST['po_units']:'km' }} ▾</label>
                        <input type="text" name="po_units" value="{{ isset($_POST['po_units'])?$_POST['po_units']:'km' }}" id="po_units" class="hidden">
                        <div id="po_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('po_units', '{{$name}}')">{{$name}}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div class="mt-0 my-lg-2 -lg-3 chose">
                    <input type="radio" name="drop1" id="drop11" value="2" checked >
                    <label for="drop11" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['8'] }}:</label>
                    <input type="radio" name="drop1" id="drop12" value="1" {{isset($_POST['drop1'])&& $_POST['drop1'] === '1' ? 'checked':'' }}>
                    <label for="drop12" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['9'] }}:</label>
                    {{-- <input type="hidden" name="drop1" id="check1" value="1"> --}}
                </div> 
            </div>
            <div class="grid grid-cols-2 mt-2  gap-4">
                <div class="space-y-2">
                    <label for="first" class="font-s-14 text-blue ffirst">
                        @if ( isset($_POST['drop1']) && $_POST['drop1'] !== '1')
                            {{ $lang['8'] }}
                        @else
                            {{ $lang['9'] }}
                            
                        @endif
                    </label>
                    <div class="relative w-full ">
                        <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first'])?$_POST['first']:'13' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'km' }} ▾</label>
                        <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'km' }}" id="units1" class="hidden">
                        <div id="units1_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', '{{$name}}')">{{$name}}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
            </div>
            <div class="grid grid-cols-1 mt-2  gap-4">
                <p class="mt-2"><strong>{{$lang['10']}}</strong></p>
            </div>
            <div class="grid grid-cols-1 mt-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="p_width" class="font-s-14 text-blue ">
                        {{$lang['11']}}
                    :</label>
                    <div class="relative w-full ">
                        <input type="number" name="p_width" id="p_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p_width'])?$_POST['p_width']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pw_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pw_units_dropdown')">{{ isset($_POST['pw_units'])?$_POST['pw_units']:'km' }} ▾</label>
                        <input type="text" name="pw_units" value="{{ isset($_POST['pw_units'])?$_POST['pw_units']:'km' }}" id="pw_units" class="hidden">
                        <div id="pw_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pw_units', '{{$name}}')">{{$name}}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="p_spacing" class="font-s-14 text-blue ">
                        {{$lang['12']}}
                    :</label>
                    <div class="relative w-full ">
                        <input type="number" name="p_spacing" id="p_spacing" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p_spacing'])?$_POST['p_spacing']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="ps_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ps_units_dropdown')">{{ isset($_POST['ps_units'])?$_POST['ps_units']:'km' }} ▾</label>
                        <input type="text" name="ps_units" value="{{ isset($_POST['ps_units'])?$_POST['ps_units']:'km' }}" id="ps_units" class="hidden">
                        <div id="ps_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ps_units', '{{$name}}')">{{$name}}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
            </div>
            <div class="grid grid-cols-1   mt-2 gap-4">
                <p class="mt-2"><strong>{{$lang['13']}}</strong></p>
            </div>
            <div class="grid grid-cols-1 mt-2  gap-4">

                <div class="mt-0 my-lg-2 -lg-3 chose {{ isset($_POST['shape']) && $_POST['shape'] !== '0' ? 'd-none':'d-block' }}">
                    <input type="radio" name="drop2" id="drop13" value="2" checked >
                    <label for="drop13" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['14'] }}:</label>
                    <input type="radio" name="drop2" id="drop14" value="1" {{isset($_POST['drop2'])&& $_POST['drop2'] === '1' ? 'checked':'' }}>
                    <label for="drop14" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['15'] }}:</label>
                    {{-- <input type="hidden" name="drop2" id="check2" value="1"> --}}
                </div>
            </div>
            <div class="grid grid-cols-1 mt-2  gap-4">

                <div class="col-lg-6 col-12 mt-0 mt-lg-2 pe-lg-3">
                    <label for="second" class="font-s-14 text-blue post_space">
                        @if ( isset($_POST['drop2']) && $_POST['drop2'] !== '1')
                            {{ $lang['15'] }}
                        @else
                            {{ $lang['14'] }}
                        @endif
                    :</label>
                    <div class="w-100 py-2 position-relative"> 
                        <input type="number" step="any" name="second" id="second" class="input" aria-label="input"  value="{{ isset($_POST['second'])?$_POST['second']:'7' }}" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1  mt-2  gap-4">

                <p class="mt-2"><strong>{{$lang['17']}}</strong></p>
            </div>
            <div class="grid grid-cols-1  mt-2 gap-4">

                <div class="mt-0 my-lg-2 -lg-3 chose {{ isset($_POST['shape']) && $_POST['shape'] !== '0' ? 'd-none':'d-block' }}">
                    <input type="radio" name="drop3" id="drop15" value="1" checked >
                    <label for="drop15" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['18'] }}:</label>
                    <input type="radio" name="drop3" id="drop16" value="2" {{isset($_POST['drop3'])&& $_POST['drop3'] === '2' ? 'checked':'' }}>
                    <label for="drop16" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['19'] }}:</label>
                    {{-- <input type="hidden" name="drop3" id="check3" value="1"> --}}
                </div>
            </div>
            <div class="grid grid-cols-1 mt-2  lg:grid-cols-2 md:grid-cols-2  gap-4">

                <div class="space-y-2">
                    <label for="third" class="font-s-14 text-blue third">
                        @if ( isset($_POST['drop3']) && $_POST['drop3'] !== '1')
                            {{ $lang['31'] }}
                        @else
                            {{ $lang['20'] }}
                        @endif
                    :</label>
                    <div class="relative w-full ">
                        <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third'])?$_POST['third']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units3_dropdown')">{{ isset($_POST['units3'])?$_POST['units3']:'km' }} ▾</label>
                        <input type="text" name="units3" value="{{ isset($_POST['units3'])?$_POST['units3']:'km' }}" id="units3" class="hidden">
                        <div id="units3_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', '{{$name}}')">{{$name}}</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 third_div {{isset($_POST['drop3'])&& $_POST['drop3'] !== '1' ? 'hidden':'d-block' }}">
                    <label for="four" class="font-s-14 text-blue">
                        {{$lang['21']}}
                    :</label>
                    <div class="relative w-full ">
                        <input type="number" name="four" id="four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['four'])?$_POST['four']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units4_dropdown')">{{ isset($_POST['units4'])?$_POST['units4']:'km' }} ▾</label>
                        <input type="text" name="units4" value="{{ isset($_POST['units4'])?$_POST['units4']:'km' }}" id="units4" class="hidden">
                        <div id="units4_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[22%] mt-1 right-0 hidden">
                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', '{{$name}}')">{{$name}}</p>
                           @endforeach
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
                            <div class="col-lg-8 font-s-18">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                <table class="w-100">
                                    @if ($detail['no_post'])
                                        <tr>
                                            <td width="70%" class="border-b py-2"><strong> {{$lang['16']}}</strong></td>
                                            <td class="border-b py-2">{{ $detail['no_post']}} 
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($detail['no_sections'])
                                    <tr class="rounded-top bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['22']}}</td>
                                        <td class="border-b py-2">{{ $detail['no_sections'] }}</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['post_heigth']))
                                    <tr class="bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['8']}}</td>
                                        <td class="border-b py-2">{{ $detail['post_heigth'] }}</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['fence_heigth']))
                                    <tr class="bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['9']}}</td>
                                        <td class="border-b py-2">{{ $detail['fence_heigth'] }}</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['no_rails']))
                                    <tr class="bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['14']}}</td>
                                        <td class="border-b py-2">{{ $detail['no_rails'] }}</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['rails_section']))
                                    <tr class="bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['15']}}</td>
                                        <td class="border-b py-2">{{ $detail['rails_section'] }}</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['no_pickets'])) 
                                    <tr class="bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['23']}}</td>
                                        <td class="border-b py-2">{{ $detail['no_pickets'] }}</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['c_volume']))
                                    <tr class="rounded-bottom bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['24']}}</td>
                                        <td class="border-b py-2">{{ $detail['c_volume'] }} in³</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['ft_volume']))
                                    <tr class="rounded-bottom bg-body-secondary bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['25']}}</td>
                                        <td class="border-b py-2">{{ $detail['ft_volume'] }} ft³</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['yd_volume']))
                                    <tr class="rounded-bottom bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['26']}}</td>
                                        <td class="border-b py-2">{{ $detail['yd_volume'] }} yd³</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                                <p class="mt-3 mb-2">{{$lang['27']}}</p>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">

                                <table class="w-100">
                                    <tr class="rounded-top bg-light bg-opacity-50">
                                        <td width="70%" class="border-b py-2">{{$lang['28']}}</td>
                                        <td class="border-b py-2"> 3 {{$currancy}} - 7 {{$currancy}} </td>
                                    </tr>
                                    <tr class="bg-body-secondary bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['29']}}</td>
                                        <td class="border-b py-2">18 {{$currancy}} - 35 {{$currancy}}</td>
                                    </tr>
                                    <tr class="bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['30']}}</td>
                                        <td class="border-b py-2">25 {{$currancy}} - 50 {{$currancy}}</td>
                                    </tr>
                                </table>
                            </div>
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
        var first = document.querySelector('.ffirst');
        var post_space = document.querySelector('.post_space');
        var third = document.querySelector('.third');
        var third_div = document.querySelector('.third_div');

        document.getElementById('drop11').addEventListener('click', function() {
            first.innerHTML ="{{ $lang['9'] }}:";
            
        });
        document.getElementById('drop12').addEventListener('click', function() {
            first.innerHTML = "{{ $lang['8'] }}:";
        });
        document.getElementById('drop13').addEventListener('click', function() {
            post_space.innerHTML ="{{ $lang['14'] }}:";
            
        });
        document.getElementById('drop14').addEventListener('click', function() {
            post_space.innerHTML = "{{ $lang['15'] }}:";
        });
        document.getElementById('drop15').addEventListener('click', function() {
            third.innerHTML ="{{ $lang['20'] }}:";
                third_div.style.display ="block";
        });
        document.getElementById('drop16').addEventListener('click', function() {
            third.innerHTML = "{{ $lang['31'] }}:";
            third_div.style.display ="none";
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>