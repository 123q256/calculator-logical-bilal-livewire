<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="flex items-center justify-center my-2">
               <p class="pe-lg-3 text-blue">{{ $lang['1'] }}:</p>
               <input type="radio" name="type" id="first" value="first" checked {{ isset(request()->type) && request()->type === 'first' ? 'checked' : '' }}>
               <label for="first" class="label ps-lg-1 pe-2">{{ $lang['2'] }}</label>
               <input type="radio" name="type" id="second" value="second" {{ isset(request()->type) && request()->type === 'second' ? 'checked' : '' }}>
               <label for="second" class="font-s-14 ps-lg-1 text-blue">{{ $lang['3'] }}</label>
           </div>
            <div class="grid grid-cols-12 mt-3  gap-4">   
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="trip_type" class="label">{{ $lang['4'] }}</label>
                    <div class="w-full py-2">
                        <select class="input" name="trip_type" id="trip_type">
                            <option selected value="1">{{$lang[5]}}</option>
                            <option value="2">{{$lang[6]}}</option>
                            <option value="3">{{$lang[7]}}</option>
                            <option value="4">{{$lang[8]}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="distance" class="label">{{ $lang['9'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="distance" id="distance" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance']) ? $_POST['distance'] : '250' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
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
                    <label for="week_day" class="label">{{ $lang['10'] }}</label>
                    <div class="w-full py-2">                                  
                        <input type="number" step="any" name="week_day" id="week_day" class="input" aria-label="input"
                        value="{{ isset(request()->week_day) ? request()->week_day : '5' }}" />
                    </div>
                </div>
                <p class="col-span-12 my-2"><strong>{{$lang[11]}}</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="price" class="label">{{ $lang['12'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price']) ? $_POST['price'] : '250' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_unit_dropdown')">{{ isset($_POST['price_unit'])?$_POST['price_unit']:'kg' }} ▾</label>
                        <input type="text" name="price_unit" value="{{ isset($_POST['price_unit'])?$_POST['price_unit']:'kg' }}" id="price_unit" class="hidden">
                        <div id="price_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_unit">
                        @foreach ([$currancy.' '.$lang['14'],$currancy.' '.$lang['15']] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>

              
                <div class="col-span-12 md:col-span-6 lg:col-span-6 optional {{ isset(request()->type) && request()->type === 'second' ? 'hidden' : 'd-block' }}">
                    <label for="peoples" class="label">{{ $lang['16'] }} ({{ $lang['17'] }})</label>
                    <div class="w-full py-2">                                  
                        <input type="number" step="any" name="peoples" id="peoples" class="input" aria-label="input"
                        value="{{ isset(request()->peoples) ? request()->peoples : '4' }}" />
                    </div>
                </div>
                <p class="my-2 col-span-12 "><strong class="vehical">
                    @if(isset(request()->type) && request()->type === 'second')
                        {{$lang[38]}}
                    @else
                        {{$lang[18]}}
                    @endif    
                    </strong>
                </p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="name_v1" class="label">{{ $lang['19'] }} </label>
                    <div class="w-full py-2">                                  
                        <input type="text" step="any" name="name_v1" id="name_v1" class="input" aria-label="input"
                        value="{{ isset(request()->name_v1) ? request()->name_v1 : 'Toyota Grande' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fule_effi_v1" class="label">{{ $lang['20'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="fule_effi_v1" id="fule_effi_v1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fule_effi_v1']) ? $_POST['fule_effi_v1'] : '250' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="fule_effi_v1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fule_effi_v1_unit_dropdown')">{{ isset($_POST['fule_effi_v1_unit'])?$_POST['fule_effi_v1_unit']:'kg' }} ▾</label>
                        <input type="text" name="fule_effi_v1_unit" value="{{ isset($_POST['fule_effi_v1_unit'])?$_POST['fule_effi_v1_unit']:'kg' }}" id="fule_effi_v1_unit" class="hidden">
                        <div id="fule_effi_v1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fule_effi_v1_unit">
                            @foreach (["kmpl","mpg"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('fule_effi_v1_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>

              
                <div class="col-span-12 {{ isset(request()->type) && request()->type === 'second' ? 'col-span-12' : 'hidden' }}" id="comparison">
                    <div class="grid grid-cols-12 mt-3  gap-4"> 
                        <p class="my-2 col-span-12"><strong>{{$lang[21]}}</strong></p>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="name_v2" class="label">{{ $lang['19'] }} </label>
                            <div class="w-full py-2">                                  
                                <input type="text" step="any" name="name_v2" id="name_v2" class="input" aria-label="input"
                                value="{{ isset(request()->name_v2) ? request()->name_v2 : 'Honda Civic' }}" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="fule_effi_v2" class="label">{{ $lang['20'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="fule_effi_v2" id="fule_effi_v2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fule_effi_v2']) ? $_POST['fule_effi_v2'] : '250' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="fule_effi_v2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fule_effi_v2_unit_dropdown')">{{ isset($_POST['fule_effi_v2_unit'])?$_POST['fule_effi_v2_unit']:'kg' }} ▾</label>
                                <input type="text" name="fule_effi_v2_unit" value="{{ isset($_POST['fule_effi_v2_unit'])?$_POST['fule_effi_v2_unit']:'kg' }}" id="fule_effi_v2_unit" class="hidden">
                                <div id="fule_effi_v2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fule_effi_v2_unit">
                                    @foreach (["kmpl","mpg"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('fule_effi_v2_unit', '{{ $name }}')"> {{ $name }}</p>
                                @endforeach
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
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    @php
                        $type              = request()->type;
                        $week_day          = request()->week_day;
                        $distance          = request()->distance;
                        $distance_unit     = request()->distance_unit;
                        $price             = request()->price;
                        $price_unit        = request()->price_unit;
                        $trip_type         = request()->trip_type;
                        $peoples           = request()->peoples;
                        $name_v1           = request()->name_v1;
                        $fule_effi_v1      = request()->fule_effi_v1;
                        $fule_effi_v1_unit = request()->fule_effi_v1_unit;
                        $name_v2           = request()->name_v2;
                        $fule_effi_v2      = request()->fule_effi_v2;
                        $fule_effi_v2_unit = request()->fule_effi_v2_unit;
                    @endphp
                    <div class="w-full my-2">
                        @if(request()->type == 'first')
                            <p>
                                {{$lang[22]}}
                                <strong>
                                    {{$detail['fule_req'] }} {{ ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }},
                                </strong> 
                                {{$lang[23]}}
                                <strong>{{$currancy.' '. $detail['fule_price_daily']}}</strong>
                            </p>
                            <?php if (!empty($peoples)) { ?>
                                <p class="mt-1">{{$lang[24]}}
                                    <strong>{{$currancy.' '.$detail['each_pay']}}</strong>
                                </p>
                            <?php } ?>
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                                <table class="w-full"> 
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang[27]}}</strong></p></td>
                                        <td class="border-b py-2"><strong>{{$lang[25]}}</strong></p></td>
                                        <td class="border-b py-2"><strong>{{$lang[26]}}</strong></p></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang[28]}}</p></td>
                                        <td class="border-b py-2">{{ $detail['fule_req']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                        <td class="border-b py-2">{{$currancy.' '. $detail['fule_price_daily']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang[29]}}</p></td>
                                        <td class="border-b py-2">{{ $detail['fule_req_weekly']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                        <td class="border-b py-2">{{$currancy.' '. $detail['fule_price_weekly']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang[30]}}</p></td>
                                        <td class="border-b py-2">{{ $detail['fule_req_biweekly']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                        <td class="border-b py-2">{{$currancy.' '. $detail['fule_price_biweekly']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang[31]}}</p></td>
                                        <td class="border-b py-2">{{ $detail['fule_req_monthly']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                        <td class="border-b py-2">{{$currancy.' '. $detail['fule_price_monthly']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang[32]}}</p></td>
                                        <td class="border-b py-2">{{ $detail['fule_req_yearly']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                        <td class="border-b py-2">{{$currancy.' '. $detail['fule_price_yearly']}}</td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <div class="flex">
                                <div class="col-lg-4 border-lg-end">
                                    <p>{{$lang[35]}}</p>
                                    <p><strong class="text-green font-s-21">{{$detail['weekly_saving']}}</strong></p>
                                </div>
                                <div class="col-lg-4 ps-lg-4 border-lg-end">
                                    <p>{{$lang[36]}}</p>
                                    <p><strong class="text-green font-s-21">{{$detail['monthly_saving']}}</strong></p>
                                </div>
                                <div class="col-lg-4 ps-lg-4">
                                    <p>{{$lang[37]}}</p>
                                    <p><strong class="text-green font-s-21">{{$detail['yearly_saving']}}</strong></p>
                                </div>
                            </div>
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px] mt-lg-3">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang[27]}}</strong></td>
                                        <td class="border-b py-2"><strong>{{$name_v1}}</strong></td>
                                        <td class="border-b py-2"><strong>{{$name_v2}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><p class="left-align">{{$lang[33]}}</p></td>
                                        <td class="border-b py-2">{{ $detail['fule_req_v1']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                        <td class="border-b py-2">{{ $detail['fule_req_v2']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><p class="left-align">{{$lang[34]}}</p></td>
                                        <td class="border-b py-2">{{$currancy.' '.$detail['price_price_v1']}}</td>
                                        <td class="border-b py-2">{{$currancy.' '.$detail['price_price_v2']}}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        var vehical = document.querySelector('.vehical');
        var comparison = document.getElementById('comparison');
        var optional = document.querySelector('.optional');
        document.getElementById('first').addEventListener('click', function() {
            comparison.classList.add('hidden');
            comparison.classList.remove('row');
            optional.style.display = "block";
            vehical.innerHTML = "{{$lang[18]}}";
        });
        document.getElementById('second').addEventListener('click', function() {
            comparison.classList.add('row');
            comparison.classList.remove('hidden');
            optional.style.display = "none";
            vehical.innerHTML = "{{$lang[38]}}";
        });
    </script>
@endpush