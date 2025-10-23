<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4"> 

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="distance" class="label">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="distance" id="distance" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance']) ? $_POST['distance'] : '240' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="distance_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('distance_unit_dropdown')">{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'kg' }} ▾</label>
                        <input type="text" name="distance_unit" value="{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'kg' }}" id="distance_unit" class="hidden">
                        <div id="distance_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="distance_unit">
                            @foreach (["km","mi"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('distance_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="speed" class="label">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="speed" id="speed" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['speed']) ? $_POST['speed'] : '240' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="speed_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('speed_unit_dropdown')">{{ isset($_POST['speed_unit'])?$_POST['speed_unit']:'kg' }} ▾</label>
                        <input type="text" name="speed_unit" value="{{ isset($_POST['speed_unit'])?$_POST['speed_unit']:'kg' }}" id="speed_unit" class="hidden">
                        <div id="speed_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="speed_unit">
                            @foreach (["km","mi"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('speed_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                
          
          
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="break_hrs" class="label cat">{{ $lang['3'] }}:</label>
                <div class="grid grid-cols-12 mt-3  gap-4"> 
                    <div class="col-span-6 relative">
                        <input type="number" name="break_hrs" id="break_hrs" class="input" aria-label="input"  value="{{ isset(request()->break_hrs)?request()->break_hrs:'5' }}" />
                        <span class="input_unit text-blue">hrs</span>
                    </div>
                    <div class="col-span-6 relative">
                        <input type="number" name="break_min" class="input" aria-label="input"  value="{{ isset(request()->break_min)?request()->break_min:'5' }}" />
                        <span class="input_unit text-blue">min</span>
                    </div>
                </div>
            </div> 
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="dep_time" class="label">{{ $lang['4'] }}:</label>
                <div class="w-full py-2 ">
                    <input type="datetime-local" name="dep_time" id="dep_time" class="input" aria-label="input"  value="{{ isset(request()->dep_time)?request()->dep_time:'2023-01-06T11:30:00' }}" />
                </div>
            </div>
            <p class="col-span-12 ">{{$lang['5']}}</p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="fule_effi" class="label cat">{{ $lang['6'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="fule_effi" id="fule_effi" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fule_effi']) ? $_POST['fule_effi'] : '240' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="fule_effi_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fule_effi_unit_dropdown')">{{ isset($_POST['fule_effi_unit'])?$_POST['fule_effi_unit']:'kg' }} ▾</label>
                    <input type="text" name="fule_effi_unit" value="{{ isset($_POST['fule_effi_unit'])?$_POST['fule_effi_unit']:'kg' }}" id="fule_effi_unit" class="hidden">
                    <div id="fule_effi_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fule_effi_unit">
                        @foreach (["kmpl","mpg"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('fule_effi_unit', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="price" class="label">{{ $lang['7'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price']) ? $_POST['price'] : '240' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_unit_dropdown')">{{ isset($_POST['price_unit'])?$_POST['price_unit']:'kg' }} ▾</label>
                    <input type="text" name="price_unit" value="{{ isset($_POST['price_unit'])?$_POST['price_unit']:'kg' }}" id="price_unit" class="hidden">
                    <div id="price_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_unit">
                    @foreach ([$currancy." liter", $currancy." gallon"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="passenger" class="label">{{ $lang['8'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" name="passenger" id="passenger" class="input" aria-label="input"  value="{{ isset(request()->passenger)?request()->passenger:'5' }}" />
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  texr-[18px]">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2" width="60%">
                                        <strong>{{$lang[12]}}</strong> :
                                    </td>
                                    <td class="border-b py-2">{{$detail['hours']}} 
                                        <span class="font-s-14">{{($device=='desktop') ? "Hours" : "hr" }}</span>
                                        {{round($detail['mins'],1)}} 
                                        <span class="font-s-14">{{($device=='desktop') ? "Minutes" : "min" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang[13]}} :</td>
                                    <td class="border-b py-2">{{$detail['depature']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang[14]}} :</td>
                                    <td class="border-b py-2">{{$detail['arrival']}}
                                    </td>
                                </tr>
                            </table>
                             <p class="pt-2">
                                <strong>{{ $lang['15'] }}</strong></p>
                           <table class="w-full">
                                    <tr>
                                        <td width="60%" class="border-b ">{{ $lang['16'] }} :</td>
                                        <td class="border-b py-2">{{ $currancy.' '.$detail['fule_price']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b ">{{ $lang['17'] }} :</td>
                                        <td class="border-b py-2">{{ $currancy.' '.$detail['per_person']}}</td>
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