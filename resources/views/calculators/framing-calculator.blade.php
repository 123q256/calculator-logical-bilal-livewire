@php
    if (isset($_POST['submit'])) {
        $wall = trim($_POST['wall']);
        $wall_unit = trim($_POST['wall_unit']);
        $spacing = trim($_POST['spacing']);
        $spacing_unit = trim($_POST['spacing_unit']);
        $price = trim($_POST['price']);
        $estimated = trim($_POST['estimated']);
    } elseif (isset($_GET['res_link'])) {
        $wall = trim($_GET['wall']);
        $wall_unit = trim($_GET['wall_unit']);
        $spacing = trim($_GET['spacing']);
        $spacing_unit = trim($_GET['spacing_unit']);
        $price = trim($_GET['price']);
        $estimated = trim($_GET['estimated']);
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
           

                <div class="col-span-6">
                    <div class="space-y-2 my-2">
                        <label for="wall" class="label">{{ $lang['1'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="wall" id="wall" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wall'])?$_POST['wall']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="wall_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wall_unit_dropdown')">{{ isset($_POST['wall_unit'])?$_POST['wall_unit']:'m' }} ▾</label>
                            <input type="text" name="wall_unit" value="{{ isset($_POST['wall_unit'])?$_POST['wall_unit']:'m' }}" id="wall_unit" class="hidden">
                            <div id="wall_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wall_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_unit', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_unit', 'mm')">milimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_unit', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_unit', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_unit', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_unit', 'yd')">yards (yd)</p>
                            </div>
                        </div>
                     </div>
                     <div class="space-y-2 my-2">
                        <label for="spacing" class="label">{{ $lang['2'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="spacing" id="spacing" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['spacing'])?$_POST['spacing']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="spacing_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('spacing_unit_dropdown')">{{ isset($_POST['spacing_unit'])?$_POST['spacing_unit']:'m' }} ▾</label>
                            <input type="text" name="spacing_unit" value="{{ isset($_POST['spacing_unit'])?$_POST['spacing_unit']:'m' }}" id="spacing_unit" class="hidden">
                            <div id="spacing_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="spacing_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('spacing_unit', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('spacing_unit', 'mm')">milimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('spacing_unit', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('spacing_unit', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('spacing_unit', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('spacing_unit', 'yd')">yards (yd)</p>
                            </div>
                        </div>
                     </div>
                   
                    <div class="w-full">
                        <label for="price" class="label">{{ $lang['4'] }}</label>
                        <div class="w-100 py-2 relative"> 
                            <input type="number" step="any" name="price" id="price" class="input" aria-label="input"  value="{{ isset($_POST['price'])?$_POST['price']:'10' }}" />
                            <span class="input_unit text-blue">{{$currancy}}</span>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="estimated" class="label">{{ $lang['4'] }}</label>
                        <div class="w-100 py-2 relative"> 
                            <input type="number" step="any" name="estimated" id="estimated" class="input" aria-label="input"  value="{{ isset($_POST['estimated'])?$_POST['estimated']:'10' }}" />
                            <span class="input_unit text-blue">%</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 flex items-center justify-center">
                    <img src="{{asset('images/framing_length.webp')}}" alt="Framing" class="max-width" width="260px" height="260px">
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
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 text-[18px]">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2">{{$lang['5']}} :</td>
                                    <td class="border-b py-2">{{round($detail['answer'],2)}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b pt-4 pb-2">{{$lang['6']}} :</td>
                                    <td class="border-b pt-4 pb-2">{{$currancy.round($detail['sub_answer'],2)}}</td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <p class="font-s-20 my-3"><strong>{{ $lang['7'] }}</strong></p>
                            <p>{{ $lang[8]; }}.</p>
                            <p class="mt-2">{{ $lang[5]; }} = ({{ $lang[1]; }} / {{ $lang[2]; }}) + 1</p>
                            <p class="mt-2">{{ $lang[5]; }} = ({{ $wall }}{{ $wall_unit }}/ {{ $spacing }}{{ $spacing_unit }}) + 1</p>
                            <p class="mt-2">{{ $lang[5]; }} = {{ round($detail['answer'], 2) }}</p>
                            <p class="mt-2">{{ $lang[9]; }}.</p>
                            <p class="mt-2">{{ $lang[6]; }} = ({{ $lang[5] }} * {{ $lang[4] }} / 100 * {{ $lang[3] }}) + (Price per stud * {{ $lang[5] }} )</p>
                            <p class="mt-2">{{ $lang[6]; }} = ({{ round($detail['answer'], 2) }} * {{ $estimated }}/ 100 * {{ $price }}) + ({{ $price }}* {{ round($detail['answer'], 2) }})</p>
                            <p class="mt-2">{{ $lang[6]; }} = {{ $currancy }}{{ round($detail['sub_answer'], 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>