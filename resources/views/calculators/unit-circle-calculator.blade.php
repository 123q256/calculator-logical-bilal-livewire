<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="angle" class="font-s-14 text-blue">{{$lang['1']}} (θ)</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle" id="angle" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle']) ? $_POST['angle'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_unit_dropdown')">{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }} ▾</label>
                        <input type="text" name="angle_unit" value="{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }}" id="angle_unit" class="hidden">
                        <div id="angle_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'deg')">degrees (deg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'rad')">radians (rad)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'pirad')">* π rad (pirad)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 flex justify-center text-center">
                    <img src="{{asset('images/unit-circle.webp')}}" height="250px" width="250px" alt="MAD Formula" style="object-fit: none;" loading="lazy" decoding="async">
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
                                    $sin=$detail['sin'];
                                    $cos=$detail['cos'];
                                    $tan=$detail['tan'];
                                    if($_POST['angle_unit']==='deg'){
                                        $deg='°';
                                    }elseif($_POST['angle_unit']==='pirad'){
                                        $deg=' * π';
                                    }else{
                                        $deg='';
                                    }
                                    $check=(double)-0;
                                    if($sin===$check){
                                        $sin=abs($sin);
                                    }
                                    if($cos===$check){
                                        $cos=abs($cos);
                                    }
                                    if($tan===$check){
                                        $tan=abs($tan);
                                    }
                                @endphp
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>sin({{$_POST['angle']}}{{$deg}})</strong></td>
                                    <td class="py-2 border-b">{{$detail['sin']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>cos({{$_POST['angle']}}{{$deg}})</strong></td>
                                    <td class="py-2 border-b">{{$detail['cos']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>tan({{$_POST['angle']}}{{$deg}})</strong></td>
                                    <td class="py-2 border-b">{{$detail['tan']}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    @endisset
</form>