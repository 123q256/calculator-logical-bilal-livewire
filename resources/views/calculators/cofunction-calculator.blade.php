<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="func" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="func" id="func">
                        <option value="1" {{ isset($_POST['func']) && $_POST['func']=='1'?'selected':'' }}>sin(x)</option>
                        <option value="2" {{ isset($_POST['func']) && $_POST['func']=='2'?'selected':'' }}>cos(x)</option>
                        <option value="3" {{ isset($_POST['func']) && $_POST['func']=='3'?'selected':'' }}>tan(x)</option>
                        <option value="4" {{ isset($_POST['func']) && $_POST['func']=='4'?'selected':'' }}>cot(x)</option>
                        <option value="5" {{ isset($_POST['func']) && $_POST['func']=='5'?'selected':'' }}>sec(x)</option>
                        <option value="6" {{ isset($_POST['func']) && $_POST['func']=='6'?'selected':'' }}>csc(x)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="angle" class="label">{{$lang[2]}}(x):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="angle" id="angle" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle']) ? $_POST['angle'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'deg' }} ▾</label>
                    <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'deg' }}" id="unit" class="hidden">
                    <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'deg')">degrees (degs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'rad')">radians (rad)</p>
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
                    <div class="w-full">
                        <div class="w-full text-center my-2">
                            @php
                                if($_POST['func'] == 1){
                                    $funName = "sin";
                                    $ansfunName = "cos";
                                }elseif($_POST['func'] == 2){
                                    $funName = "cos";
                                    $ansfunName = "sin";
                                }elseif($_POST['func'] == 3){
                                    $funName = "tan";
                                    $ansfunName = "cot";
                                }elseif($_POST['func'] == 4){
                                    $funName = "cot";
                                    $ansfunName = "tan";
                                }elseif($_POST['func'] == 5){
                                    $funName = "sec";
                                    $ansfunName = "csc";
                                }else{
                                    $funName = "csc";
                                    $ansfunName = "sec";
                                }
                            @endphp
                            <p>
                                <strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[22px]">
                                    {{$funName}}({{$detail['ang']}}@if($_POST['unit'] === "deg")°@endif) &nbsp; = &nbsp; {{$ansfunName}}({{$detail['ang1']}}@if($_POST['unit'] === "deg")°@endif) &nbsp; = &nbsp; {{$detail['ans']}}
                                </strong>
                            </p>
                        </div>
                        @isset($detail['naam'])
                            <div class="w-full mt-3 text-center">
                                <div class="w-full md:w-[60%] lg:w-[60%] ">
                                    <img src="{{ asset('images/'.$detail['naam'].'.webp') }}" width="100%" height="100%" alt="{{$detail['naam']}}" loading="lazy" decoding="async">
                                </div>
                            </div>
                        @endisset
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endisset
</form>