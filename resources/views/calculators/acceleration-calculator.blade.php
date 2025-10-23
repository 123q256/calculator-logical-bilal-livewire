<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="with" class="font-s-14 text-blue">{{ $lang['for'] }}:</label>
                    <div class="w-full py-2">
                        <i class="fas fa-sort-down color_blue"></i>
                        <select name="with" id="with" class="input">
                            <option value="1" {{ isset($_POST['with']) && $_POST['with']=='1'?'selected':''}} >{{$lang['w1'] }}</option>
                            <option value="5" {{ isset($_POST['with']) && $_POST['with']=='5'?'selected':''}} >{{ $lang['w5']}}</option>
                            <option value="2" {{ isset($_POST['with']) && $_POST['with']=='2'?'selected':''}} >{{ $lang['w2'] }}</option>
                            <option value="3" {{ isset($_POST['with']) && $_POST['with']=='3'?'selected':''}} >{{ $lang['w3'] }}</option>
                            <option value="4" {{ isset($_POST['with']) && $_POST['with']=='4'?'selected':''}} >{{ $lang['w4'] }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 mt-3  gap-4 speed">
                <div class="col-span-12 hidden distance">
                    <p class="col s12"><b class="color_blue">{{ $lang['note']}}</b> {{ $lang['p1']}}</p>
                </div>
                    <p class="col to_cal px-2"><strong>To Calculate</strong></p>
                <div class="col-span-12 to_cal flex">
                    <div class="col mx-2">
                        <label class="acc_">
                            @if(isset($detail['to_cal']) && $detail['to_cal']=="acc")
                            <input class="with-gap" name="to_cal" value="acc" type="radio" checked />
                            @else
                            <input class="with-gap" name="to_cal" value="acc" type="radio" checked/>
                            @endif
                            <span>{{ $lang['acc']}}</span>
                        </label>
                    </div>
                    <div class="col mx-2">
                        <label class="is_">
                            @if(isset($detail['to_cal']) && $detail['to_cal']=="is")
                            <input class="with-gap" name="to_cal" value="is" type="radio" checked />
                            @else
                            <input class="with-gap" name="to_cal" value="is" type="radio"/>
                            @endif
                            <span>{{ $lang['is']}}</span>
                        </label>
                    </div>
                    <div class="col mx-2">
                        <label class="fs_">
                            @if(isset($_POST['to_cal']))
                                @if(isset($detail['to_cal']) && $detail['to_cal']=="fs")
                                <input class="with-gap" name="to_cal" value="fs" type="radio" checked />
                                @else
                                <input class="with-gap" name="to_cal" value="fs" type="radio" />
                                @endif
                            @else
                                <input class="with-gap" name="to_cal" value="fs" type="radio" />
                            @endif
                            <span>{{ $lang['fs']}}</span>
                        </label>
                    </div>
                    <div class="col mx-2">
                        <label class="time_">
                            @if(isset($_POST['to_cal']))
                            @if(isset($detail['to_cal']) && $detail['to_cal']=="time")
                                <input class="with-gap" name="to_cal" value="time" type="radio" checked />
                                @else
                                <input class="with-gap" name="to_cal" value="time" type="radio" />
                                @endif
                            @else
                                <input class="with-gap" name="to_cal" value="time" type="radio" />
                            @endif
                            <span>{{ $lang['time']}}</span>
                        </label>
                    </div>
                </div>
                <div class="col-span-6 is">
                    <label for="is" class="font-s-14 text-blue">{{ $lang['is'] }} </label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="is" id="is" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['is'])?$_POST['is']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="isU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('isU_dropdown')">{{ isset($_POST['isU'])?$_POST['isU']:'m/s' }} ▾</label>
                       <input type="text" name="isU" value="{{ isset($_POST['isU'])?$_POST['isU']:'m/s' }}" id="isU" class="hidden">
                       <div id="isU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="isU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('isU', 'm/s')">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('isU', 'ft/s')">ft/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('isU', 'km/h')">km/h</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('isU', 'km/s')">km/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('isU', 'fmi/s')">fmi/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('isU', 'mph')">mph</p>
                       </div>
                    </div>
                </div>
                <div class="col-span-6 final">
                    <label for="fs" class="font-s-14 text-blue">{{ $lang['fs'] }} </label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="fs" id="fs" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fs'])?$_POST['fs']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="fsU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fsU_dropdown')">{{ isset($_POST['fsU'])?$_POST['fsU']:'m/s' }} ▾</label>
                       <input type="text" name="fsU" value="{{ isset($_POST['fsU'])?$_POST['fsU']:'m/s' }}" id="fsU" class="hidden">
                       <div id="fsU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fsU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fsU', 'm/s')">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fsU', 'ft/s')">ft/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fsU', 'km/h')">km/h</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fsU', 'km/s')">km/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fsU', 'fmi/s')">fmi/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fsU', 'mph')">mph</p>
                       </div>
                    </div>
                </div>
                <div class="col-span-6 distance hidden">
                    <label for="dis" class="font-s-14 text-blue">{{ $lang['dis'] }} </label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="dis" id="dis" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dis'])?$_POST['dis']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="disU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('disU_dropdown')">{{ isset($_POST['disU'])?$_POST['disU']:'m' }} ▾</label>
                       <input type="text" name="disU" value="{{ isset($_POST['disU'])?$_POST['disU']:'m' }}" id="disU" class="hidden">
                       <div id="disU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="disU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('disU', 'm')">m</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('disU', 'cm')">cm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('disU', 'in')">in</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('disU', 'ft')">ft</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('disU', 'km')">km</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('disU', 'mi')">mi</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('disU', 'yd')">yd</p>
                       </div>
                    </div>
                </div>
                <div class="col-span-6 time">
                    <label for="time" class="font-s-14 text-blue">{{ $lang['time'] }} </label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="time" id="time" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time'])?$_POST['time']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="disU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('disU_dropdown')">{{ isset($_POST['disU'])?$_POST['disU']:'sec' }} ▾</label>
                       <input type="text" name="disU" value="{{ isset($_POST['disU'])?$_POST['disU']:'sec' }}" id="disU" class="hidden">
                       <div id="disU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="disU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('disU', 'sec')">sec</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('disU', 'min')">min</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('disU', 'h')">h</p>
                       </div>
                    </div>
                </div>
                <div class="col-span-6 acc hidden">
                    <label for="ac" class="font-s-14 text-blue">{{ $lang['acc'] }} </label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="ac" id="ac" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ac'])?$_POST['ac']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="acU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('acU_dropdown')">{{ isset($_POST['acU'])?$_POST['acU']:'m/s' }} ▾</label>
                       <input type="text" name="acU" value="{{ isset($_POST['acU'])?$_POST['acU']:'m/s' }}" id="acU" class="hidden">
                       <div id="acU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="acU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('acU', 'm/s')">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('acU', 'ft/s²')">ft/s²</p>
                       </div>
                    </div>
                </div>
                
            </div>
            <div class="grid grid-cols-2 mt-3  gap-4 force hidden">
                <div class="col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                <p class="my-3"><strong>{{$lang['note']}} </strong>{{$lang['p2']}}</p>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="mass" class="font-s-14 text-blue">{{ $lang['mass'] }} </label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="mass" id="mass" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass'])?$_POST['mass']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="masU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('masU_dropdown')">{{ isset($_POST['masU'])?$_POST['masU']:'kg' }} ▾</label>
                       <input type="text" name="masU" value="{{ isset($_POST['masU'])?$_POST['masU']:'kg' }}" id="masU" class="hidden">
                       <div id="masU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="masU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('masU', 'kg')">kg</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('masU', 'g')">g</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('masU', 'mg')">mg</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('masU', 'lbs')">lbs</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="force" class="font-s-14 text-blue">{{ $lang['net'] }} </label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="force" id="force" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['force'])?$_POST['force']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="masU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('masU_dropdown')">{{ isset($_POST['masU'])?$_POST['masU']:'N' }} ▾</label>
                       <input type="text" name="masU" value="{{ isset($_POST['masU'])?$_POST['masU']:'N' }}" id="masU" class="hidden">
                       <div id="masU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="masU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('masU', 'N')">N</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('masU', 'KN')">KN</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('masU', 'mg')">mg</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('masU', 'MN')">MN</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="fac" class="font-s-14 text-blue">{{ $lang['acc'] }} </label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="fac" id="fac" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fac'])?$_POST['fac']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="facU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('facU_dropdown')">{{ isset($_POST['facU'])?$_POST['facU']:'m/s²' }} ▾</label>
                       <input type="text" name="facU" value="{{ isset($_POST['facU'])?$_POST['facU']:'m/s²' }}" id="facU" class="hidden">
                       <div id="facU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="facU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('facU', 'm/s²')">m/s²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('facU', 'ft/s²')">ft/s²</p>
                       </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 mt-3  gap-4 constant hidden">
                <div class="col-12 px-2 pe-lg-4">
                    <label for="known" class="font-s-14 text-blue">$Select Known Parameters</label>
                    <div class="w-full py-2">
                        <i class="fas fa-sort-down color_blue"></i>
                        <select name="known" id="known" class="input">
                            <option value="1" {{ isset($_POST['known']) && $_POST['known']=='1'?'selected':''}}  >Time, Initial Velocity, Final Velocity</option>
                            <option value="2" {{ isset($_POST['known']) && $_POST['known']=='2'?'selected':''}}  >Acceleration, Initial Velocity, Final Velocity</option>
                            <option value="3" {{ isset($_POST['known']) && $_POST['known']=='3'?'selected':''}}  >Time, Acceleration, Final Velocity</option>
                            <option value="4" {{ isset($_POST['known']) && $_POST['known']=='4'?'selected':''}}  >Time, Acceleration, Initial Velocity</option>
                            <option value="5" {{ isset($_POST['known']) && $_POST['known']=='5'?'selected':''}}  >Time, Initial Velocity, Displacement</option>
                            <option value="6" {{ isset($_POST['known']) && $_POST['known']=='6'?'selected':''}}  >Time, Final Velocity, Displacement</option>
                            <option value="7" {{ isset($_POST['known']) && $_POST['known']=='7'?'selected':''}}  >Acceleration, Initial Velocity, Displacement</option>
                            <option value="8" {{ isset($_POST['known']) && $_POST['known']=='8'?'selected':''}}  >Acceleration, Final Velocity, Displacement</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="cdis" class="font-s-14 text-blue">{{ $lang['disp'] }} (∆x)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="cdis" id="cdis" step="any"  readonly="readonly" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cdis'])?$_POST['cdis']:'1000' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="cdisU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cdisU_dropdown')">{{ isset($_POST['cdisU'])?$_POST['cdisU']:'m' }} ▾</label>
                       <input type="text" name="cdisU" value="{{ isset($_POST['cdisU'])?$_POST['cdisU']:'m' }}" id="cdisU" class="hidden">
                       <div id="cdisU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cdisU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'm')">m</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'cm')">cm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'in')">in</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'ft')">ft</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'km')">km</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'mi')">mi</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'yd')">yd</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="iv" class="font-s-14 text-blue">{{ $lang['iv'] }} (V<sub>0</sub>)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="iv" id="iv" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['iv'])?$_POST['iv']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="ivU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ivU_dropdown')">{{ isset($_POST['ivU'])?$_POST['ivU']:'m/s' }} ▾</label>
                       <input type="text" name="ivU" value="{{ isset($_POST['ivU'])?$_POST['ivU']:'m/s' }}" id="ivU" class="hidden">
                       <div id="ivU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ivU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ivU', 'm/s')">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ivU', 'ft/s')">ft/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ivU', 'km/h')">km/h</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ivU', 'km/s')">km/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ivU', 'mi/s')">mi/s</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ivU', 'mph')">mph</p>
                      
                       </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="fv" class="font-s-14 text-blue">{{ $lang['fv'] }} (V<sub>f</sub>)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="fv" id="fv" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fv'])?$_POST['fv']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="fvU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fvU_dropdown')">{{ isset($_POST['fvU'])?$_POST['fvU']:'m/s' }} ▾</label>
                       <input type="text" name="fvU" value="{{ isset($_POST['fvU'])?$_POST['fvU']:'m/s' }}" id="fvU" class="hidden">
                       <div id="fvU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fvU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fvU', 'm/s')">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fvU', 'ft/s')">ft/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fvU', 'km/h')">km/h</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fvU', 'km/s')">km/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fvU', 'mi/s')">mi/s</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fvU', 'mph')">mph</p>
                      
                       </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="ct" class="font-s-14 text-blue">Elapsed Time (t)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="ct" id="ct" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ct'])?$_POST['ct']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="ctU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ctU_dropdown')">{{ isset($_POST['ctU'])?$_POST['ctU']:'sec' }} ▾</label>
                       <input type="text" name="ctU" value="{{ isset($_POST['ctU'])?$_POST['ctU']:'sec' }}" id="ctU" class="hidden">
                       <div id="ctU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ctU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ctU', 'sec')">sec</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ctU', 'min')">min</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ctU', 'h')">h</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="cac" class="font-s-14 text-blue"> {{$lang['w4']}} (a)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="cac" id="cac" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cac'])?$_POST['cac']:'5' }}" aria-label="input"  readonly="readonly" placeholder="00" oninput="checkInput()"/>
                       <label for="cacU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cacU_dropdown')">{{ isset($_POST['cacU'])?$_POST['cacU']:'m/s²' }} ▾</label>
                       <input type="text" name="cacU" value="{{ isset($_POST['cacU'])?$_POST['cacU']:'m/s²' }}" id="cacU" class="hidden">
                       <div id="cacU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cacU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cacU', 'm/s²')">m/s²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cacU', 'ft/s²')">ft/s²</p>
                       </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 mt-3  gap-4 average hidden">
                <div class="col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                <p class="my-3"><strong>{{ $lang['note']}} </strong>{{ $lang['p4']}}</p>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="aiv" class="font-s-14 text-blue"> {{$lang['iv']}} (V<sub>0</sub>)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="aiv" id="aiv" step="any" readonly="readonly"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['aiv'])?$_POST['aiv']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="aivU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('aivU_dropdown')">{{ isset($_POST['aivU'])?$_POST['aivU']:'m/s' }} ▾</label>
                       <input type="text" name="aivU" value="{{ isset($_POST['aivU'])?$_POST['aivU']:'m/s' }}" id="aivU" class="hidden">
                       <div id="aivU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="aivU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('aivU', 'm/s')">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('aivU', 'ft/s')">ft/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('aivU', 'km/h')">km/h</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('aivU', 'km/s')">km/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('aivU', 'mi/s')">mi/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('aivU', 'mph')">mph</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="afv" class="font-s-14 text-blue"> {{$lang['fv']}} (V<sub>f</sub>)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="afv" id="afv" step="any" readonly="readonly"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['afv'])?$_POST['afv']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="afvU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('afvU_dropdown')">{{ isset($_POST['afvU'])?$_POST['afvU']:'m/s' }} ▾</label>
                       <input type="text" name="afvU" value="{{ isset($_POST['afvU'])?$_POST['afvU']:'m/s' }}" id="afvU" class="hidden">
                       <div id="afvU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="afvU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('afvU', 'm/s')">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('afvU', 'ft/s')">ft/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('afvU', 'km/h')">km/h</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('afvU', 'km/s')">km/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('afvU', 'mi/s')">mi/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('afvU', 'mph')">mph</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="itime" class="font-s-14 text-blue"> {{$lang['it']}}</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="itime" id="itime" step="any" readonly="readonly"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['itime'])?$_POST['itime']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="itU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('itU_dropdown')">{{ isset($_POST['itU'])?$_POST['itU']:'sec' }} ▾</label>
                       <input type="text" name="itU" value="{{ isset($_POST['itU'])?$_POST['itU']:'sec' }}" id="itU" class="hidden">
                       <div id="itU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="itU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('itU', 'sec')">sec</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('itU', 'min')">min</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('itU', 'h')">h</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="ftime" class="font-s-14 text-blue"> {{$lang['ft']}}</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="ftime" id="ftime" step="any" readonly="readonly"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ftime'])?$_POST['ftime']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="ftU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ftU_dropdown')">{{ isset($_POST['ftU'])?$_POST['ftU']:'sec' }} ▾</label>
                       <input type="text" name="ftU" value="{{ isset($_POST['ftU'])?$_POST['ftU']:'sec' }}" id="ftU" class="hidden">
                       <div id="ftU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ftU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ftU', 'sec')">sec</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ftU', 'min')">min</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ftU', 'h')">h</p>
                       </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                    <label for="avc" class="font-s-14 text-blue"> {{$lang['w5']}}</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="avc" id="avc" step="any" readonly="readonly"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['avc'])?$_POST['avc']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="avcU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('avcU_dropdown')">{{ isset($_POST['avcU'])?$_POST['avcU']:'m/s²' }} ▾</label>
                       <input type="text" name="avcU" value="{{ isset($_POST['avcU'])?$_POST['avcU']:'m/s²' }}" id="avcU" class="hidden">
                       <div id="avcU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="avcU">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avcU', 'm/s²')">m/s²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avcU', 'ft/s²')">ft/s²</p>
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
                <div class="w-full  mt-3">
                    <div class="w-full font-s-20">
                        @if($_POST['with']==1)
                            @if($_POST['to_cal']=='acc')
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang["acc"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['a'] }}</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang["is"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['vi'] }}</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang["fs"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['vf'] }}</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang["time"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['time'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($_POST['to_cal']=='is')
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang["is"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['vi'] }}</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang["acc"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['a'] }}</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang["fs"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['vf'] }}</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang["time"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['time'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($_POST['to_cal']=='fs')
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang["fs"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['vf'] }}</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang["acc"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['a'] }}</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang["is"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['vi'] }}</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang["time"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['time'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($_POST['to_cal']=='time')
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang["time"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['time'] }}</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang["acc"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['a'] }}</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang["is"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['vi'] }}</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang["fs"] }}  </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['vf'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        @elseif($_POST['with']==2)
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang["is"] }}  </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['vi'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["dis"] }}  </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['dis'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["time"] }}  </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['time'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["acc"] }}  </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['a'] }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        @elseif($_POST['with']==3)
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang["net"] }}  </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['force'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["mass"] }}  </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['mass'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["acc"] }}  </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['a'] }}</td>
                                </tr>
                            </table>
                        </div>
                        @elseif($_POST['with']==4)
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang["iv"] }} (V<sub>0</sub>) </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['iv'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["fv"] }}  (V<sub>f</sub>)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['fv'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["time"] }}  </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['a'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["w4"] }} (a)  </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['time'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["disp"] }} (∆x) </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['time'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>Average Velocity (V<sub>ave</sub>) </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['avev'] }}</td>
                                </tr>
                            </table>
                        </div>
                            <div class="col-12">
                                <div id="chart_div" class="my-3 px-3" style="height: 400px;"></div>
                            </div>
                            <div class="col-12">
                                <div id="chart_div2" class="my-3 px-3" style="height: 400px;"></div>
                            </div>
                        @elseif($_POST['with']==5)
            
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang["iv"] }} (V<sub>0</sub>) </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['iv'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["fv"] }}  (V<sub>f</sub>)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['fv'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["it"] }}  </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['itime'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["ft"] }}  </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['ftime'] }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang["w5"] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['a'] }} </td>
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

<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
  
    document.getElementById("with").addEventListener("change", function () {
        var s = document.getElementById("with").value;
        var to_cal_checked = document.querySelector("input[name='to_cal']:checked").value;

        var speedFinalToCal = document.querySelectorAll(".speed, .final, .to_cal");
        var distanceForceConstantAverage = document.querySelectorAll(".distance, .force, .constant, .average");

        speedFinalToCal.forEach(function (el) {
            el.classList.add("hidden");
        });
        distanceForceConstantAverage.forEach(function (el) {
            el.classList.add("hidden");
        });

        if (s == 1) {
            speedFinalToCal.forEach(function (el) {
                el.classList.remove("hidden");
            });
            distanceForceConstantAverage.forEach(function (el) {
                el.classList.add("hidden");
            });

            if (to_cal_checked == 'is') {
                document.querySelectorAll('.acc, .final, .time').forEach(function (el) {
                    el.classList.remove('hidden');
                });
                document.querySelector('.is').classList.add('hidden');
            } else if (to_cal_checked == 'fs') {
                document.querySelectorAll('.acc, .is, .time').forEach(function (el) {
                    el.classList.remove('hidden');
                });
                document.querySelector('.final').classList.add('hidden');
            } else if (to_cal_checked == 'time') {
                document.querySelectorAll('.acc, .is, .final').forEach(function (el) {
                    el.classList.remove('hidden');
                });
                document.querySelector('.time').classList.add('hidden');
            } else if (to_cal_checked == 'acc') {
                document.querySelectorAll('.is, .final, .time').forEach(function (el) {
                    el.classList.remove('hidden');
                });
                document.querySelector('.acc').classList.add('hidden');
            }
        } else if (s == 2) {
            document.querySelectorAll(".speed, .acc, .time, .is ,.distance").forEach(function (el) {
                el.classList.remove("hidden");
            });
        } else if (s == 3) {
            document.querySelector(".force").classList.remove("hidden");
        } else if (s == 4) {
            document.querySelector(".constant").classList.remove("hidden");
        } else if (s == 5) {
            document.querySelector(".average").classList.remove("hidden");
        }
    });
    @if(isset($detail))
    var s = "{{$_POST['with']}}";
       
        var to_cal_checked = document.querySelector("input[name='to_cal']:checked").value;

        var speedFinalToCal = document.querySelectorAll(".speed, .final, .to_cal");
        var distanceForceConstantAverage = document.querySelectorAll(".distance, .force, .constant, .average");

        speedFinalToCal.forEach(function (el) {
            el.classList.add("hidden");
        });
        distanceForceConstantAverage.forEach(function (el) {
            el.classList.add("hidden");
        });

        if (s == 1) {
            speedFinalToCal.forEach(function (el) {
                el.classList.remove("hidden");
            });
            distanceForceConstantAverage.forEach(function (el) {
                el.classList.add("hidden");
            });

            if (to_cal_checked == 'is') {
                document.querySelectorAll('.acc, .final, .time').forEach(function (el) {
                    el.classList.remove('hidden');
                });
                document.querySelector('.is').classList.add('hidden');
            } else if (to_cal_checked == 'fs') {
                document.querySelectorAll('.acc, .is, .time').forEach(function (el) {
                    el.classList.remove('hidden');
                });
                document.querySelector('.final').classList.add('hidden');
            } else if (to_cal_checked == 'time') {
                document.querySelectorAll('.acc, .is, .final').forEach(function (el) {
                    el.classList.remove('hidden');
                });
                document.querySelector('.time').classList.add('hidden');
            } else if (to_cal_checked == 'acc') {
                document.querySelectorAll('.is, .final, .time').forEach(function (el) {
                    el.classList.remove('hidden');
                });
                document.querySelector('.acc').classList.add('hidden');
            }
        } else if (s == 2) {
            document.querySelectorAll(".speed, .acc, .time, .is ,.distance").forEach(function (el) {
                el.classList.remove("hidden");
            });
        } else if (s == 3) {
            document.querySelector(".force").classList.remove("hidden");
        } else if (s == 4) {
            document.querySelector(".constant").classList.remove("hidden");
        } else if (s == 5) {
            document.querySelector(".average").classList.remove("hidden");
        }

    @endif

    @if(isset($error))
          var s = "{{$_POST['with']}}";
       
        var to_cal_checked = document.querySelector("input[name='to_cal']:checked").value;

        var speedFinalToCal = document.querySelectorAll(".speed, .final, .to_cal");
        var distanceForceConstantAverage = document.querySelectorAll(".distance, .force, .constant, .average");

        speedFinalToCal.forEach(function (el) {
            el.classList.add("hidden");
        });
        distanceForceConstantAverage.forEach(function (el) {
            el.classList.add("hidden");
        });

        if (s == 1) {
            speedFinalToCal.forEach(function (el) {
                el.classList.remove("hidden");
            });
            distanceForceConstantAverage.forEach(function (el) {
                el.classList.add("hidden");
            });

            if (to_cal_checked == 'is') {
                document.querySelectorAll('.acc, .final, .time').forEach(function (el) {
                    el.classList.remove('hidden');
                });
                document.querySelector('.is').classList.add('hidden');
            } else if (to_cal_checked == 'fs') {
                document.querySelectorAll('.acc, .is, .time').forEach(function (el) {
                    el.classList.remove('hidden');
                });
                document.querySelector('.final').classList.add('hidden');
            } else if (to_cal_checked == 'time') {
                document.querySelectorAll('.acc, .is, .final').forEach(function (el) {
                    el.classList.remove('hidden');
                });
                document.querySelector('.time').classList.add('hidden');
            } else if (to_cal_checked == 'acc') {
                document.querySelectorAll('.is, .final, .time').forEach(function (el) {
                    el.classList.remove('hidden');
                });
                document.querySelector('.acc').classList.add('hidden');
            }
        } else if (s == 2) {
            document.querySelectorAll(".speed, .acc, .time, .is ,.distance").forEach(function (el) {
                el.classList.remove("hidden");
            });
        } else if (s == 3) {
            document.querySelector(".force").classList.remove("hidden");
        } else if (s == 4) {
            document.querySelector(".constant").classList.remove("hidden");
        } else if (s == 5) {
            document.querySelector(".average").classList.remove("hidden");
        }

    @endif  
 

    document.querySelector('.acc_').addEventListener('click', function() {
        var isFinalTimeElements = document.querySelectorAll('.is, .final, .time');
        isFinalTimeElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        var accElement = document.querySelector('.acc');
        accElement.classList.add('hidden');
    });

    document.querySelector('.is_').addEventListener('click', function() {
        var accFinalTimeElements = document.querySelectorAll('.acc, .final, .time');
        accFinalTimeElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        var isElement = document.querySelector('.is');
        isElement.classList.add('hidden');
    });

    document.querySelector('.fs_').addEventListener('click', function() {
        var accIsTimeElements = document.querySelectorAll('.acc, .is, .time');
        accIsTimeElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        var finalElement = document.querySelector('.final');
        finalElement.classList.add('hidden');
    });

    document.querySelector('.time_').addEventListener('click', function() {
        var accIsFinalElements = document.querySelectorAll('.acc, .is, .final');
        accIsFinalElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        var timeElement = document.querySelector('.time');
        timeElement.classList.add('hidden');
    });


    @if(isset($detail))
        var check = "{{$_POST['to_cal']}}"

        if(check == "acc"){
            var radioButton = document.querySelector('input[name="to_cal"][value="acc"]');
        if (radioButton && check === 'acc') {
            radioButton.checked = true;
        }
        var isFinalTimeElements = document.querySelectorAll('.is, .final, .time');
        isFinalTimeElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        var accElement = document.querySelector('.acc');
        accElement.classList.add('hidden');

        }else if(check== "is"){
            var radioButton = document.querySelector('input[name="to_cal"][value="is"]');
        if (radioButton && check === 'is') {
            radioButton.checked = true;
        }
           var accFinalTimeElements = document.querySelectorAll('.acc, .final, .time');
        accFinalTimeElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        var isElement = document.querySelector('.is');
        isElement.classList.add('hidden');

        }else if(check== "fs"){
            var radioButton = document.querySelector('input[name="to_cal"][value="fs"]');
        if (radioButton && check === 'fs') {
            radioButton.checked = true;
        }
            var accIsTimeElements = document.querySelectorAll('.acc, .is, .time');
        accIsTimeElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        var finalElement = document.querySelector('.final');
        finalElement.classList.add('hidden');

        }else if(check== "time"){

        var radioButton = document.querySelector('input[name="to_cal"][value="time"]');
        if (radioButton && check === 'time') {
            radioButton.checked = true;
        }

            var accIsFinalElements = document.querySelectorAll('.acc, .is, .final');
        accIsFinalElements.forEach(function(element) {
            element.classList.remove('hidden');
        });

        var timeElement = document.querySelector('.time');
        timeElement.classList.add('hidden');

        }
    @endif


    document.getElementById('known').addEventListener('change', function() {
        var k = document.getElementById('known').value;
        var disElements = document.querySelectorAll('.dis');
        var accelElements = document.querySelectorAll('.accel');
        var timeElements = document.querySelectorAll('.time');
        var inVelElements = document.querySelectorAll('.in_vel');
        var fnVelElements = document.querySelectorAll('.fn_vel');

        disElements.forEach(function(element) {
            element.value = '';
            element.setAttribute('readonly', 'readonly');
        });

        accelElements.forEach(function(element) {
            element.value = '';
            element.setAttribute('readonly', 'readonly');
        });

        timeElements.forEach(function(element) {
            element.removeAttribute('readonly');
        });

        inVelElements.forEach(function(element) {
            element.removeAttribute('readonly');
        });

        fnVelElements.forEach(function(element) {
            element.removeAttribute('readonly');
        });

        if (k == '2') {
            timeElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            accelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        } else if (k == '3') {
            inVelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            accelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            timeElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        } else if (k == '4') {
            fnVelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            accelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            timeElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            inVelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        } else if (k == '5') {
            accelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            fnVelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            disElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            timeElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            inVelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        } else if (k == '6') {
            accelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            inVelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            disElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            timeElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            fnVelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        } else if (k == '7') {
            timeElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            fnVelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            disElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            accelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            inVelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        } else if (k == '8') {
            timeElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            inVelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            disElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            accelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            fnVelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        }
    });






    @if(isset($detail))
     var k = "{{$_POST['known']}}"
        var disElements = document.querySelectorAll('.dis');
        var accelElements = document.querySelectorAll('.accel');
        var timeElements = document.querySelectorAll('.time');
        var inVelElements = document.querySelectorAll('.in_vel');
        var fnVelElements = document.querySelectorAll('.fn_vel');

        disElements.forEach(function(element) {
            element.value = '';
            element.setAttribute('readonly', 'readonly');
        });

        accelElements.forEach(function(element) {
            element.value = '';
            element.setAttribute('readonly', 'readonly');
        });

        timeElements.forEach(function(element) {
            element.removeAttribute('readonly');
        });

        inVelElements.forEach(function(element) {
            element.removeAttribute('readonly');
        });

        fnVelElements.forEach(function(element) {
            element.removeAttribute('readonly');
        });

        if (k == '2') {
            timeElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            accelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        } else if (k == '3') {
            inVelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            accelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            timeElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        } else if (k == '4') {
            fnVelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            accelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            timeElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            inVelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        } else if (k == '5') {
            accelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            fnVelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            disElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            timeElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            inVelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        } else if (k == '6') {
            accelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            inVelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            disElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            timeElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            fnVelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        } else if (k == '7') {
            timeElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            fnVelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            disElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            accelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            inVelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        } else if (k == '8') {
            timeElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            inVelElements.forEach(function(element) {
                element.value = '';
                element.setAttribute('readonly', 'readonly');
            });
            disElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            accelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
            fnVelElements.forEach(function(element) {
                element.removeAttribute('readonly');
            });
        }
    @endif
</script>
<script>
    @if(isset($detail['graph']) && $detail['graph']!="" && isset($detail['graph2']) && $detail['graph2']!=""  )
               google.charts.load("current", {packages:["corechart"]});
               google.charts.setOnLoadCallback(drawChart);
               google.charts.setOnLoadCallback(drawChart2);
   
               function drawChart() {
                 var data = new google.visualization.DataTable();
                 data.addColumn('number');
                 data.addColumn('number');
   
                     data.addRows([<?=$detail['graph']?>]);
   
                 var options = {
                   legend: 'none',
                   colors: ['#13699E'],
                   lineWidth: 2,
                   pointSize: 0,
                   hAxis: {title: 'Time (s)'},
                   vAxis: {title: 'Velocity (m/s)'},
                 };
   
                 var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
   
                 chart.draw(data, options);
                   // data.setValue(-1.34, x);
                   // data.setValue(0.877, y);
                   chart.draw(data, options);
               }
               function drawChart2() {
                 var data = new google.visualization.DataTable();
                 data.addColumn('number');
                 data.addColumn('number');
   
                     data.addRows([<?=$detail['graph2']?>]);
   
                 var options = {
                   legend: 'none',
                   colors: ['#13699E'],
                   lineWidth: 2,
                   pointSize: 0,
                   hAxis: {title: 'Time (s)'},
                   vAxis: {title: 'Displacement (m)'},
                 };
   
                 var chart = new google.visualization.ScatterChart(document.getElementById('chart_div2'));
   
                 chart.draw(data, options);
                   // data.setValue(-1.34, x);
                   // data.setValue(0.877, y);
                   chart.draw(data, options);
               }
           @endif
   
   </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
