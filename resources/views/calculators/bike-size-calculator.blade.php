<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2 mt-3  gap-4">
                
                <div class="col-lg-6 pe-lg-4">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <label for="bike_for" class="font-s-14 text-blue one_text">{{$lang['1']}}</label>
                            <div class="w-100 py-2">
                                <select class="input" name="bike_for" id="bike_for">
                                    <option selected value="adult">{{$lang[33]}}</option>
                                    <option value="kids">{{$lang[34]}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mt-2 adults">
                            <label for="bike_type" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                            <select name="bike_type" id="bike_type" class="input my-2">
                                <option value="road">{{$lang[3]}}</option>
                                <option selected value="city">{{$lang[4]}}</option>
                                <option value="hybrid">{{$lang[5]}}</option>
                                <option value="trekking">{{$lang[6]}}</option>
                                <option value="mountain">{{$lang[7]}}</option>
                            </select>
                        </div>
                        <div class="col-12 mt-2 kids">
                            <label for="kids_age" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                            <div class="py-2">
                                <select class="input" name="kids_age" id="kids_age">
                                    <option selected value="2-3">2-3 {{$lang[9]}} (86-102 cm)</option>
                                    <option value="2-4">2-4 {{$lang[9]}} (94-109 cm)</option>
                                    <option value="4-6">4-6 {{$lang[9]}} (109-122 cm)</option>
                                    <option value="5-8">5-8 {{$lang[9]}} (114-130 cm)</option>
                                    <option value="8-11">8-11 {{$lang[9]}} (122-135 cm)</option>
                                    <option value="11+">11+ {{$lang[9]}} (135-145 cm)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mt-2 adults">
                            <label for="hight" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="hight" id="hight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hight']) ? $_POST['hight'] : '5.7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="hight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hight_unit_dropdown')">{{ isset($_POST['hight_unit'])?$_POST['hight_unit']:'cm' }} ▾</label>
                                <input type="text" name="hight_unit" value="{{ isset($_POST['hight_unit'])?$_POST['hight_unit']:'cm' }}" id="hight_unit" class="hidden">
                                <div id="hight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hight_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hight_unit', 'cm')">centimeters (cm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hight_unit', 'mm')">milimeters (mm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hight_unit', 'in')">inch (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hight_unit', 'ft')">feet (ft)</p>
                                </div>
                             </div>
                        </div>
                        <div class="col-12 mt-2 adults">
                            <label for="inseam_length" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="inseam_length" id="inseam_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['inseam_length']) ? $_POST['inseam_length'] : '32' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="inseam_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('inseam_length_unit_dropdown')">{{ isset($_POST['inseam_length_unit'])?$_POST['inseam_length_unit']:'cm' }} ▾</label>
                                <input type="text" name="inseam_length_unit" value="{{ isset($_POST['inseam_length_unit'])?$_POST['inseam_length_unit']:'cm' }}" id="inseam_length_unit" class="hidden">
                                <div id="inseam_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="inseam_length_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inseam_length_unit', 'cm')">centimeters (cm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inseam_length_unit', 'mm')">milimeters (mm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inseam_length_unit', 'in')">inch (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inseam_length_unit', 'ft')">feet (ft)</p>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-4 d-flex align-items-center">
                    <div class="row">
                        <div class="col-12">
                            <img src="{{asset('images/bike-size/City.webp')}}" alt="bike" class="max-width change_imge" width="230px" height="140px">
                        </div> 
                        <div class="col-12 mt-3">
                            <img src="{{asset('images/bike-size/hight-inseam-new.png')}}" alt="bike" class="max-width sec_image" width="230px" height="130px">
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
     

    @else
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="col-12 bg-light-blue result p-3 rounded-lg mt-3">
                        @php
                            $bike_for          = request()->bike_for;
                            $bike_type          = request()->bike_type;
                            $kids_age         = request()->kids_age;
                            $hight              = request()->hight;
                            $hight_unit         = request()->hight_unit;
                            $inseam_length      = request()->inseam_length;
                            $inseam_length_unit = request()->inseam_length_unit;
                        @endphp
                        <div class="grid grid-12 gap-5">
                            <p class="col-span-12"><strong class="text-blue">{{$lang[12]}}</strong></p>
                            <p class="col-span-12 mt-2"><strong class="text-blue">{{ucfirst($bike_for)}}</strong></p>
                            @if($bike_for === 'kids')
                                <div class="col-span-6">
                                    <p class="pb-2"><strong>{{$lang[13]}}</strong></p>
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                        <p ><strong class="font-s-18 text-green">{{$detail['kids_age']}}</strong> <span class="font-s-14 text-blue">{{$lang[14]}}</span></p>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <p class="pb-2"><strong>{{$lang[15]}}</strong></p>
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                        <p><strong class="text-[18px] text-green-700">{{$detail['hight']}}</strong> <span class="text-[14px] text-blue">cm</span></p>
                                    </div>
                                </div>
                            @else
                                <p class="pt-2 col-span-12"><strong>{{$lang[16]}}</strong></p>
                                <div class="col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                        <p><strong class="font-s-18 text-green">{{$detail['hight_mm']}}</strong> <span class="font-s-14 text-blue">milimeter</span></p>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                        <p><strong class="font-s-18 text-green">{{$detail['hight_cm']}}</strong> <span class="font-s-14 text-blue">centimeter</span></p>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                        <p><strong class="font-s-18 text-green">{{$detail['hight_in']}}</strong> <span class="font-s-14 text-blue">inch</span></p>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                        <p><strong class="font-s-18 text-green">{{$detail['hight_ft']}}</strong> <span class="font-s-14 text-blue">foot</span></p>
                                    </div>
                                </div>
                                <p class="pt-2 col-span-12"><strong>{{$lang[17]}}</strong></p>
                                <div class="col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                        <p><strong class="font-s-18 text-green">{{$detail['inseam_mm']}}</strong> <span class="font-s-14 text-blue">milimeter</span></p>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                        <p><strong class="font-s-18 text-green">{{$detail['inseam_cm']}}</strong> <span class="font-s-14 text-blue">centimeter</span></p>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                        <p><strong class="font-s-18 text-green">{{$detail['inseam_in']}}</strong> <span class="font-s-14 text-blue">inch</span></p>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                        <p><strong class="font-s-18 text-green">{{$detail['inseam_ft']}}</strong> <span class="font-s-14 text-blue">foot</span></p>
                                    </div>
                                </div>
                            @endif
                            <div class="col-span-12 border-top-black my-2 pt-2 ">
                                <div class="grid grid-cols-12 mt-3  gap-4">
                                    <div class="col-span-12 md:col-span-8 lg:col-span-8">
                                        <p class="my-2">
                                            <strong class="text-blue">
                                                @if($bike_for == 'kids')
                                                    {{$lang[18]}}
                                                @else
                                                    {{ucfirst($bike_type)}} {{$lang[19]}}
                                                @endif
                                            </strong>
                                        </p>
                                        <p class="mb-2">
                                            {{($bike_for == 'kids')  ? "Kids" : ucfirst($bike_type)}}
                                            {{$lang[20]}}
                                        </p>
                                        @if($bike_for == 'kids')
                                            <strong>{{$lang[21]}}</strong>
                                            <p class="my-2">{{$lang[22]}} </p>
                                        @else 
                                            <strong>{{$lang[24]}}</strong>
                                            <p class="my-2"> {{$lang[25]}} </p>
                                        @endif
                                    </div>
                                    <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                        @if($bike_for == 'kids')
                                        <img src="{{asset('images/bike-size/Child.webp')}}" class="max-width mt-lg-4" width="200px" height="150px" alt="Wheel Size">
                                        @else 
                                        <img src="{{asset('images/bike-size/frame-new.webp')}}" class="max-width mt-lg-4" width="250px" height="150px" alt="Frame Size">
                                        @endif
                                    </div>
                                </div>
                                @if($bike_for == 'kids')
                                    <strong class="col-span-12 mb-1">{{$lang[23]}}</strong>
                                    <div class="col-span-12">
                                        <div class="grid grid-cols-12 mt-3  gap-4">
                                            <div class="col-span-6 md:col-span-4 lg:col-span-3">
                                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                    <p><strong class="font-s-18 text-green">{{$detail['wheel_mm']}}</strong> <span class="font-s-14 text-blue">milimeter</span></p>
                                                </div>
                                            </div>
                                            <div class="col-span-6 md:col-span-4 lg:col-span-3">
                                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                    <p><strong class="font-s-18 text-green">{{$detail['wheel_cm']}}</strong> <span class="font-s-14 text-blue">centimeter</span></p>
                                                </div>
                                            </div>
                                            <div class="col-span-6 md:col-span-4 lg:col-span-3">
                                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                    <p><strong class="font-s-18 text-green">{{$detail['wheel_in']}}</strong> <span class="font-s-14 text-blue">inch</span></p>
                                                </div>
                                            </div>
                                            <div class="col-span-6 md:col-span-4 lg:col-span-3">
                                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                    <p><strong class="font-s-18 text-green">{{$detail['wheel_ft']}}</strong> <span class="font-s-14 text-blue">foot</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <strong class="col-span-12 mb-2">{{$lang[26]}}</strong>
                                    <div class="col-span-12">
                                        <div class="grid grid-cols-12 mt-3  gap-4">
                                        <div class="col-span-6 md:col-span-4 lg:col-span-3">
                                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                <p><strong class="font-s-18 text-green">{{$detail['frame_mm']}}</strong> <span class="font-s-14 text-blue">milimeter</span></p>
                                            </div>
                                        </div>
                                        <div class="col-span-6 md:col-span-4 lg:col-span-3">
                                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                <p><strong class="font-s-18 text-green">{{$detail['frame_cm']}}</strong> <span class="font-s-14 text-blue">centimeter</span></p>
                                            </div>
                                        </div>
                                        <div class="col-span-6 md:col-span-4 lg:col-span-3">
                                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                <p><strong class="font-s-18 text-green">{{$detail['frame_in']}}</strong> <span class="font-s-14 text-blue">inch</span></p>
                                            </div>
                                        </div>
                                        <div class="col-span-6 md:col-span-4 lg:col-span-3">
                                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                <p><strong class="font-s-18 text-green">{{$detail['frame_ft']}}</strong> <span class="font-s-14 text-blue">foot</span></p>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                
                            <div class="col-span-12 border-top-black pt-2 mt-1">
                                <div class="grid grid-cols-12 mt-3  gap-4">
                                    <div class="col-span-12 md:col-span-8 lg:col-span-8">
                                        <p class="my-2">
                                            <strong class="text-blue">
                                                {{$lang[27]}}
                                            </strong>
                                        </p>
                                        <p class="mb-2">
                                            {{$lang[28]}}
                                        </p>
                                        <strong class="text-blue">
                                            {{$lang[29]}}
                                        </strong>
                                        @if($bike_for == 'kids')
                                            <p class="my-2">{{$lang[30]}} </p>
                                        @endif
                                    </div>
                                    <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                        <img src="{{asset('images/bike-size/crank-updated.webp')}}" class="max-width" width="200px" height="170px" alt="Frame Size">
                                    </div>
                                </div>
                                @if($bike_for == 'adult')
                                    <div class="row">
                                        <div class="grid grid-cols-12 mt-3  gap-4">
                                            <p class="col-span-12 my-2"> <strong>{{$lang[31]}} (L)</strong></p>
                                            <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                    <p><strong class="font-s-18 text-green">{{$detail['crank_mm']}}</strong> <span class="font-s-14 text-blue">milimeter</span></p>
                                                </div>
                                            </div>
                                            <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                    <p><strong class="font-s-18 text-green">{{$detail['crank_cm']}}</strong> <span class="font-s-14 text-blue">centimeter</span></p>
                                                </div>
                                            </div>
                                            <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                    <p><strong class="font-s-18 text-green">{{$detail['crank_in']}}</strong> <span class="font-s-14 text-blue">inch</span></p>
                                                </div>
                                            </div>
                                            <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                    <p><strong class="font-s-18 text-green">{{$detail['crank_ft']}}</strong> <span class="font-s-14 text-blue">foot</span></p>
                                                </div>
                                            </div>
                                            <strong class="col-span-12 mb-2">{{$lang[32]}} (D)</strong>
                                            <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                    <p><strong class="font-s-18 text-green">{{$detail['crank_dia_mm']}}</strong> <span class="font-s-14 text-blue">milimeter</span></p>
                                                </div>
                                            </div>
                                            <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                    <p><strong class="font-s-18 text-green">{{$detail['crank_dia_cm']}}</strong> <span class="font-s-14 text-blue">centimeter</span></p>
                                                </div>
                                            </div>
                                            <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                    <p><strong class="font-s-18 text-green">{{$detail['crank_dia_in']}}</strong> <span class="font-s-14 text-blue">inch</span></p>
                                                </div>
                                            </div>
                                            <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                                    <p><strong class="font-s-18 text-green">{{$detail['crank_dia_ft']}}</strong> <span class="font-s-14 text-blue">foot</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                
                        </div>
                
                        <div class="col-12 text-center mt-[30px]">
                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
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
        var change_imge =  document.querySelectorAll('.change_imge');
        var kids =  document.querySelectorAll('.kids');
        var adults =  document.querySelectorAll('.adults');
        var sec_image =  document.querySelector('.sec_image');
        var bike_for = document.getElementById('bike_for').value;
        if(bike_for === 'kids'){
            kids.forEach(element => {
                element.style.display= "block";
            });
            adults.forEach(element => {
                element.style.display= "none";
            });
        }else{
            adults.forEach(element => {
                element.style.display= "block";
            });
            kids.forEach(element => {
                element.style.display= "none";
            });
        }
        document.getElementById('bike_for').addEventListener('change',function(){
            var bike_for = this.value;
            if(bike_for === 'kids'){
                change_imge.forEach(element => {
                    element.setAttribute("src","{{asset('images/bike-size/Child.webp')}}");
                    element.setAttribute("height","150px");
                });
                kids.forEach(element => {
                    element.style.display= "block";
                });
                adults.forEach(element => {
                    element.style.display= "none";
                });
            sec_image.style.display = "none";

            }else{
                change_imge.forEach(element => {
                    element.setAttribute("src","{{asset('images/bike-size/City.webp')}}");
                    element.setAttribute("height","140px");
                });
            sec_image.style.display = "block";

                adults.forEach(element => {
                    element.style.display= "block";
                });
                kids.forEach(element => {
                    element.style.display= "none";
                });
            }
        });
        document.getElementById('bike_type').addEventListener('change',function(){
            var bike_type = this.value;
            if(bike_type === 'road'){
                change_imge.forEach(element => {
                    element.setAttribute("src","{{asset('images/bike-size/Road.webp')}}");
                    element.setAttribute("height","140px");
                });
            }else if(bike_type === 'city'){
                change_imge.forEach(element => {
                    element.setAttribute("src","{{asset('images/bike-size/City.webp')}}");
                });
            }else if(bike_type === 'hybrid'){
                change_imge.forEach(element => {
                    element.setAttribute("src","{{asset('images/bike-size/Hybrid_n_Fitness.webp')}}");
                });
            }else if(bike_type === 'trekking'){
                change_imge.forEach(element => {
                    element.setAttribute("src","{{asset('images/bike-size/Trekking.webp')}}");
                });
            }else{
                change_imge.forEach(element => {
                    element.setAttribute("src","{{asset('images/bike-size/Mountain.webp')}}");
                });
            }
        });
    </script>
@endpush
