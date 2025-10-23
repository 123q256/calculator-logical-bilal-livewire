<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="angle" class="font-s-14 text-blue">{{$lang[1]}}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="angle" id="angle" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle']) ? $_POST['angle'] : '30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_unit_dropdown')">{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }} ▾</label>
                    <input type="text" name="angle_unit" value="{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }}" id="angle_unit" class="hidden">
                    <div id="angle_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'deg')">degrees (degs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'rad')">radians (rad)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', '* π rad')">* π rad</p>
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
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full  text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>In Degrees</strong></td>
                                        <td class="py-2 border-b">{{$detail['ans']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>In Radians</strong></td>
                                        <td class="py-2 border-b">{{ ($detail['ans'] * 0.017453) }} (rad)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>In Pi Radians</strong></td>
                                        <td class="py-2 border-b">{{ $detail['pi'] }} (π rad)</td>
                                    </tr>
                                </table>
                            </div>
                            @if($detail['ans']!==0 && $detail['ans']!==90 && $detail['ans']!==180)
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                    <div class="w-full md:w-[60%] lg:w-[60%]">
                                        <img src="{{ asset('images/'.$detail['src']) }}" width="100%" height="100%" alt="{{$detail['ans']}}" loading="lazy" decoding="async">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset
</form>