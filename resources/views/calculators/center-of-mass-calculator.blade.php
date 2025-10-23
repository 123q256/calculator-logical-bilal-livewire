<style>
    ..tagsUnit {
        background-color: ##2845F5 !important;
        color: white !important;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
   
    
                <div class="col-span-6">
                    <label for="dem" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <i class="fas fa-sort-down color_blue"></i>
                        <select name="dem" id="dem" class="input">
                            <option value="1" {{ isset($_POST['dem']) && $_POST['dem']=='1'?'selected':''}}  >1D</option>
                            <option value="2" {{ isset($_POST['dem']) && $_POST['dem']=='2'?'selected':''}}  >2D</option>
                            <option value="3" {{ isset($_POST['dem']) && $_POST['dem']=='3'?'selected':''}}  >3D</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="how" class="font-s-14 text-blue">{{ $lang['2'] }} ?</label>
                    <div class="w-100 py-2">
                        <i class="fas fa-sort-down color_blue"></i>
                        <select name="how" id="how" class="input">
                            <option value="2" {{ isset($_POST['how']) && $_POST['how']=='2'?'selected':''}}  >2</option>
                            <option value="3" {{ isset($_POST['how']) && $_POST['how']=='3'?'selected':''}}  >3</option>
                            <option value="4" {{ isset($_POST['how']) && $_POST['how']=='4'?'selected':''}}  >4</option>
                            <option value="5" {{ isset($_POST['how']) && $_POST['how']=='5'?'selected':''}}  >5</option>
                            <option value="6" {{ isset($_POST['how']) && $_POST['how']=='6'?'selected':''}}  >6</option>
                            <option value="7" {{ isset($_POST['how']) && $_POST['how']=='7'?'selected':''}}  >7</option>
                            <option value="8" {{ isset($_POST['how']) && $_POST['how']=='8'?'selected':''}}  >8</option>
                            <option value="9" {{ isset($_POST['how']) && $_POST['how']=='9'?'selected':''}}  >9</option>
                            <option value="10" {{ isset($_POST['how']) && $_POST['how']=='10'?'selected':''}}  >10</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12  ">
                    <p class="my-2 p-2 tagsUnit radius-5"><strong class="text-white">{{$lang['3']}} 1</strong></p>
                </div>
                <div class="col-span-6 mt-0 mt-lg-2 ">
                    <label for="m1" class="font-s-14 text-white">m1</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="m1" id="m1" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m1']) ? $_POST['m1'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="m1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m1_unit_dropdown')">{{ isset($_POST['m1_unit'])?$_POST['m1_unit']:'g' }} ▾</label>
                        <input type="text" name="m1_unit" value="{{ isset($_POST['m1_unit'])?$_POST['m1_unit']:'g' }}" id="m1_unit" class="hidden">
                        <div id="m1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m1_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m1_unit', 'g')">g</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m1_unit', 'kg')">kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m1_unit', 'lbs')">lbs</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 mt-0 mt-lg-2 ">
                    <label for="x1" class="font-s-14 text-white">x1</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="x1" id="x1" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x1']) ? $_POST['x1'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="x1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('x1_unit_dropdown')">{{ isset($_POST['x1_unit'])?$_POST['x1_unit']:'cm' }} ▾</label>
                        <input type="text" name="x1_unit" value="{{ isset($_POST['x1_unit'])?$_POST['x1_unit']:'cm' }}" id="x1_unit" class="hidden">
                        <div id="x1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="x1_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x1_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x1_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x1_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x1_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x1_unit', 'yd')">yd</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 mt-0 mt-lg-2 hidden twod">
                    <label for="y1" class="font-s-14 text-blue">y1</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="y1" id="y1" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y1']) ? $_POST['y1'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="y1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('y1_unit_dropdown')">{{ isset($_POST['y1_unit'])?$_POST['y1_unit']:'cm' }} ▾</label>
                        <input type="text" name="y1_unit" value="{{ isset($_POST['y1_unit'])?$_POST['y1_unit']:'cm' }}" id="y1_unit" class="hidden">
                        <div id="y1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="y1_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y1_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y1_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y1_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y1_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y1_unit', 'yd')">yd</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 mt-0 mt-lg-2 hidden threed">
                    <label for="z1" class="font-s-14 text-blue">z1</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="z1" id="z1" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z1']) ? $_POST['z1'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="z1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('z1_unit_dropdown')">{{ isset($_POST['z1_unit'])?$_POST['z1_unit']:'cm' }} ▾</label>
                        <input type="text" name="z1_unit" value="{{ isset($_POST['z1_unit'])?$_POST['z1_unit']:'cm' }}" id="z1_unit" class="hidden">
                        <div id="z1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="z1_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z1_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z1_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z1_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z1_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z1_unit', 'yd')">yd</p>
                        </div>
                     </div>
                </div>
                
             
                <div class="col-span-12">
                    <p class="my-2 p-2 tagsUnit radius-5"><strong class="text-white">{{$lang['3']}} 2</strong></p>
                </div>
                <div class="col-span-6 mt-0 mt-lg-2 ">
                    <label for="m2" class="font-s-14 text-blue">m2</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="m2" id="m2" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m2']) ? $_POST['m2'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="m2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m2_unit_dropdown')">{{ isset($_POST['m2_unit'])?$_POST['m2_unit']:'g' }} ▾</label>
                        <input type="text" name="m2_unit" value="{{ isset($_POST['m2_unit'])?$_POST['m2_unit']:'g' }}" id="m2_unit" class="hidden">
                        <div id="m2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m2_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m2_unit', 'g')">g</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m2_unit', 'kg')">kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m2_unit', 'lbs')">lbs</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 mt-0 mt-lg-2 ">
                    <label for="x2" class="font-s-14 text-blue">x2</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="x2" id="x2" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x2']) ? $_POST['x2'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="x2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('x2_unit_dropdown')">{{ isset($_POST['x2_unit'])?$_POST['x2_unit']:'cm' }} ▾</label>
                        <input type="text" name="x2_unit" value="{{ isset($_POST['x2_unit'])?$_POST['x2_unit']:'cm' }}" id="x2_unit" class="hidden">
                        <div id="x2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="x2_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x2_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x2_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x2_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x2_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x2_unit', 'yd')">yd</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 mt-0 mt-lg-2 hidden twod">
                    <label for="y2" class="font-s-14 text-blue">y2</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="y2" id="y2" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y2']) ? $_POST['y2'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="y2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('y2_unit_dropdown')">{{ isset($_POST['y2_unit'])?$_POST['y2_unit']:'cm' }} ▾</label>
                        <input type="text" name="y2_unit" value="{{ isset($_POST['y2_unit'])?$_POST['y2_unit']:'cm' }}" id="y2_unit" class="hidden">
                        <div id="y2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="y2_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y2_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y2_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y2_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y2_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y2_unit', 'yd')">yd</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 mt-0 mt-lg-2  hidden threed">
                    <label for="z2" class="font-s-14 text-blue">z2</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="z2" id="z2" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z2']) ? $_POST['z2'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="z2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('z2_unit_dropdown')">{{ isset($_POST['z2_unit'])?$_POST['z2_unit']:'cm' }} ▾</label>
                        <input type="text" name="z2_unit" value="{{ isset($_POST['z2_unit'])?$_POST['z2_unit']:'cm' }}" id="z2_unit" class="hidden">
                        <div id="z2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="z2_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z2_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z2_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z2_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z2_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z2_unit', 'yd')">yd</p>
                        </div>
                     </div>
                </div>
              

                <div class="col-span-12 hidden three">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12  ">
                        <p class="my-2 p-2 tagsUnit radius-5"><strong class="">{{$lang['3']}} 3</strong></p>
                    </div>
                    <div class="col-span-6 ">
                        <label for="m3" class="font-s-14 text-blue">m3</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="m3" id="m3" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m3']) ? $_POST['m3'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="m3_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m3_unit_dropdown')">{{ isset($_POST['m3_unit'])?$_POST['m3_unit']:'g' }} ▾</label>
                            <input type="text" name="m3_unit" value="{{ isset($_POST['m3_unit'])?$_POST['m3_unit']:'g' }}" id="m3_unit" class="hidden">
                            <div id="m3_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m3_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m3_unit', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m3_unit', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m3_unit', 'lbs')">lbs</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-6 ">
                        <label for="x3" class="font-s-14 text-blue">x3</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="x3" id="x3" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x3']) ? $_POST['x3'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="x3_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('x3_unit_dropdown')">{{ isset($_POST['x3_unit'])?$_POST['x3_unit']:'cm' }} ▾</label>
                            <input type="text" name="x3_unit" value="{{ isset($_POST['x3_unit'])?$_POST['x3_unit']:'cm' }}" id="x3_unit" class="hidden">
                            <div id="x3_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="x3_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x3_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x3_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x3_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x3_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x3_unit', 'yd')">yd</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-6 twod">
                        <label for="y3" class="font-s-14 text-blue">y3</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="y3" id="y3" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y3']) ? $_POST['y3'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="y3_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('y3_unit_dropdown')">{{ isset($_POST['y3_unit'])?$_POST['y3_unit']:'cm' }} ▾</label>
                            <input type="text" name="y3_unit" value="{{ isset($_POST['y3_unit'])?$_POST['y3_unit']:'cm' }}" id="y3_unit" class="hidden">
                            <div id="y3_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="y3_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y3_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y3_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y3_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y3_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y3_unit', 'yd')">yd</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-6 threed">
                            <label for="z3" class="font-s-14 text-blue">z3</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="z3" id="z3" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z3']) ? $_POST['z3'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="z3_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('z3_unit_dropdown')">{{ isset($_POST['z3_unit'])?$_POST['z3_unit']:'cm' }} ▾</label>
                                <input type="text" name="z3_unit" value="{{ isset($_POST['z3_unit'])?$_POST['z3_unit']:'cm' }}" id="z3_unit" class="hidden">
                                <div id="z3_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="z3_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z3_unit', 'cm')">cm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z3_unit', 'm')">m</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z3_unit', 'in')">in</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z3_unit', 'ft')">ft</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z3_unit', 'yd')">yd</p>
                                </div>
                            </div>
                      </div>
                    </div>
                </div>

                <div class="col-span-12 hidden four">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12  ">
                        <p class="my-2 p-2 tagsUnit radius-5"><strong class="" >{{$lang['3']}} 4</strong></p>
                    </div>
                    <div class="col-span-6 ">
                        <label for="m4" class="font-s-14 text-blue">m4</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="m4" id="m4" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m4']) ? $_POST['m4'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="m4_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m4_unit_dropdown')">{{ isset($_POST['m4_unit'])?$_POST['m4_unit']:'g' }} ▾</label>
                            <input type="text" name="m4_unit" value="{{ isset($_POST['m4_unit'])?$_POST['m4_unit']:'g' }}" id="m4_unit" class="hidden">
                            <div id="m4_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m4_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m4_unit', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m4_unit', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m4_unit', 'lbs')">lbs</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-6 ">
                        <label for="x4" class="font-s-14 text-blue">x4</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="x4" id="x4" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x4']) ? $_POST['x4'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="x4_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('x4_unit_dropdown')">{{ isset($_POST['x4_unit'])?$_POST['x4_unit']:'cm' }} ▾</label>
                            <input type="text" name="x4_unit" value="{{ isset($_POST['x4_unit'])?$_POST['x4_unit']:'cm' }}" id="x4_unit" class="hidden">
                            <div id="x4_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="x4_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x4_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x4_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x4_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x4_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x4_unit', 'yd')">yd</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 twod">
                        <label for="y4" class="font-s-14 text-blue">y4</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="y4" id="y4" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y4']) ? $_POST['y4'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="y4_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('y4_unit_dropdown')">{{ isset($_POST['y4_unit'])?$_POST['y4_unit']:'cm' }} ▾</label>
                            <input type="text" name="y4_unit" value="{{ isset($_POST['y4_unit'])?$_POST['y4_unit']:'cm' }}" id="y4_unit" class="hidden">
                            <div id="y4_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="y4_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y4_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y4_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y4_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y4_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y4_unit', 'yd')">yd</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 threed">
                        <label for="z4" class="font-s-14 text-blue">z4</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="z4" id="z4" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z4']) ? $_POST['z4'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="z4_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('z4_unit_dropdown')">{{ isset($_POST['z4_unit'])?$_POST['z4_unit']:'cm' }} ▾</label>
                            <input type="text" name="z4_unit" value="{{ isset($_POST['z4_unit'])?$_POST['z4_unit']:'cm' }}" id="z4_unit" class="hidden">
                            <div id="z4_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="z4_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z4_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z4_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z4_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z4_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z4_unit', 'yd')">yd</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                </div>

                <div class="col-span-12 hidden five">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                       
                    <div class="col-span-12 ">
                        <p class="my-2 p-2 tagsUnit radius-5"><strong class="" >{{$lang['3']}} 5</strong></p>
                    </div>
                    <div class="col-span-6 ">
                        <label for="m5" class="font-s-14 text-blue">m5</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="m5" id="m5" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m5']) ? $_POST['m5'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="m5_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m5_unit_dropdown')">{{ isset($_POST['m5_unit'])?$_POST['m5_unit']:'g' }} ▾</label>
                            <input type="text" name="m5_unit" value="{{ isset($_POST['m5_unit'])?$_POST['m5_unit']:'g' }}" id="m5_unit" class="hidden">
                            <div id="m5_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m5_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m5_unit', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m5_unit', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m5_unit', 'lbs')">lbs</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 ">
                        <label for="x5" class="font-s-14 text-blue">x5</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="x5" id="x5" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x5']) ? $_POST['x5'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="x5_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('x5_unit_dropdown')">{{ isset($_POST['x5_unit'])?$_POST['x5_unit']:'g' }} ▾</label>
                            <input type="text" name="x5_unit" value="{{ isset($_POST['x5_unit'])?$_POST['x5_unit']:'g' }}" id="x5_unit" class="hidden">
                            <div id="x5_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="x5_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x5_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x5_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x5_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x5_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x5_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 twod">
                        <label for="y5" class="font-s-14 text-blue">y5</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="y5" id="y5" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y5']) ? $_POST['y5'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="y5_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('y5_unit_dropdown')">{{ isset($_POST['y5_unit'])?$_POST['y5_unit']:'g' }} ▾</label>
                            <input type="text" name="y5_unit" value="{{ isset($_POST['y5_unit'])?$_POST['y5_unit']:'g' }}" id="y5_unit" class="hidden">
                            <div id="y5_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="y5_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y5_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y5_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y5_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y5_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y5_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 threed">
                        <label for="z5" class="font-s-14 text-blue">z5</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="z5" id="z5" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z5']) ? $_POST['z5'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="z5_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('z5_unit_dropdown')">{{ isset($_POST['z5_unit'])?$_POST['z5_unit']:'g' }} ▾</label>
                            <input type="text" name="z5_unit" value="{{ isset($_POST['z5_unit'])?$_POST['z5_unit']:'g' }}" id="z5_unit" class="hidden">
                            <div id="z5_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="z5_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z5_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z5_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z5_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z5_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z5_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                </div>
                </div>

                <div class="col-span-12 hidden six">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12 ">
                        <p class="my-2 p-2 tagsUnit radius-5"><strong class="" >{{$lang['3']}} 6</strong></p>
                    </div>
                    <div class="col-span-6 ">
                        <label for="m6" class="font-s-14 text-blue">m6</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="m6" id="m6" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m6']) ? $_POST['m6'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="m6_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m6_unit_dropdown')">{{ isset($_POST['m6_unit'])?$_POST['m6_unit']:'g' }} ▾</label>
                            <input type="text" name="m6_unit" value="{{ isset($_POST['m6_unit'])?$_POST['m6_unit']:'g' }}" id="m6_unit" class="hidden">
                            <div id="m6_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m6_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m6_unit', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m6_unit', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m6_unit', 'lbs')">lbs</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 ">
                        <label for="x6" class="font-s-14 text-blue">x6</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="x6" id="x6" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x6']) ? $_POST['x6'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="x6_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('x6_unit_dropdown')">{{ isset($_POST['x6_unit'])?$_POST['x6_unit']:'g' }} ▾</label>
                            <input type="text" name="x6_unit" value="{{ isset($_POST['x6_unit'])?$_POST['x6_unit']:'g' }}" id="x6_unit" class="hidden">
                            <div id="x6_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="x6_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x6_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x6_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x6_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x6_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x6_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 twod">
                        <label for="y6" class="font-s-14 text-blue">y6</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="y6" id="y6" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y6']) ? $_POST['y6'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="y6_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('y6_unit_dropdown')">{{ isset($_POST['y6_unit'])?$_POST['y6_unit']:'g' }} ▾</label>
                            <input type="text" name="y6_unit" value="{{ isset($_POST['y6_unit'])?$_POST['y6_unit']:'g' }}" id="y6_unit" class="hidden">
                            <div id="y6_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="y6_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y6_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y6_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y6_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y6_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y6_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 threed">
                        <label for="z6" class="font-s-14 text-blue">z6</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="z6" id="z6" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z6']) ? $_POST['z6'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="z6_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('z6_unit_dropdown')">{{ isset($_POST['z6_unit'])?$_POST['z6_unit']:'g' }} ▾</label>
                            <input type="text" name="z6_unit" value="{{ isset($_POST['z6_unit'])?$_POST['z6_unit']:'g' }}" id="z6_unit" class="hidden">
                            <div id="z6_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="z6_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z6_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z6_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z6_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z6_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z6_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                    </div>
                </div>

                <div class="col-span-12 hidden seven">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12 ">
                        <p class="my-2 p-2 tagsUnit radius-5"><strong class="" > {{$lang['3']}} 7</strong></p>
                    </div>
                    <div class="col-span-6 ">
                        <label for="m7" class="font-s-14 text-blue">m7</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="m7" id="m7" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m7']) ? $_POST['m7'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="m7_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m7_unit_dropdown')">{{ isset($_POST['m7_unit'])?$_POST['m7_unit']:'g' }} ▾</label>
                            <input type="text" name="m7_unit" value="{{ isset($_POST['m7_unit'])?$_POST['m7_unit']:'g' }}" id="m7_unit" class="hidden">
                            <div id="m7_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m7_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m7_unit', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m7_unit', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m7_unit', 'lbs')">lbs</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 ">
                        <label for="x7" class="font-s-14 text-blue">x7</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="x7" id="x7" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x7']) ? $_POST['x7'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="x7_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('x7_unit_dropdown')">{{ isset($_POST['x7_unit'])?$_POST['x7_unit']:'g' }} ▾</label>
                            <input type="text" name="x7_unit" value="{{ isset($_POST['x7_unit'])?$_POST['x7_unit']:'g' }}" id="x7_unit" class="hidden">
                            <div id="x7_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="x7_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x7_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x7_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x7_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x7_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x7_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 twod">
                        <label for="y7" class="font-s-14 text-blue">y7</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="y7" id="y7" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y7']) ? $_POST['y7'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="y7_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('y7_unit_dropdown')">{{ isset($_POST['y7_unit'])?$_POST['y7_unit']:'g' }} ▾</label>
                            <input type="text" name="y7_unit" value="{{ isset($_POST['y7_unit'])?$_POST['y7_unit']:'g' }}" id="y7_unit" class="hidden">
                            <div id="y7_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="y7_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y7_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y7_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y7_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y7_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y7_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 threed">
                        <label for="z7" class="font-s-14 text-blue">z7</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="z7" id="z7" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z7']) ? $_POST['z7'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="z7_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('z7_unit_dropdown')">{{ isset($_POST['z7_unit'])?$_POST['z7_unit']:'g' }} ▾</label>
                            <input type="text" name="z7_unit" value="{{ isset($_POST['z7_unit'])?$_POST['z7_unit']:'g' }}" id="z7_unit" class="hidden">
                            <div id="z7_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="z7_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z7_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z7_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z7_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z7_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z7_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                </div>
                </div>

                <div class="col-span-12 hidden eight">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12 ">
                        <p class="my-2 p-2 tagsUnit radius-5"><strong class="" >{{$lang['3']}} 8</strong></p>
                    </div>
                    <div class="col-span-6 ">
                        <label for="m8" class="font-s-14 text-blue">m8</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="m8" id="m8" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m8']) ? $_POST['m8'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="m8_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m8_unit_dropdown')">{{ isset($_POST['m8_unit'])?$_POST['m8_unit']:'g' }} ▾</label>
                            <input type="text" name="m8_unit" value="{{ isset($_POST['m8_unit'])?$_POST['m8_unit']:'g' }}" id="m8_unit" class="hidden">
                            <div id="m8_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m8_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m8_unit', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m8_unit', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m8_unit', 'lbs')">lbs</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 ">
                        <label for="x8" class="font-s-14 text-blue">x8</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="x8" id="x8" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x8']) ? $_POST['x8'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="x8_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('x8_unit_dropdown')">{{ isset($_POST['x8_unit'])?$_POST['x8_unit']:'g' }} ▾</label>
                            <input type="text" name="x8_unit" value="{{ isset($_POST['x8_unit'])?$_POST['x8_unit']:'g' }}" id="x8_unit" class="hidden">
                            <div id="x8_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="x8_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x8_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x8_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x8_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x8_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x8_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 twod">
                        <label for="y8" class="font-s-14 text-blue">y8</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="y8" id="y8" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y8']) ? $_POST['y8'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="y8_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('y8_unit_dropdown')">{{ isset($_POST['y8_unit'])?$_POST['y8_unit']:'g' }} ▾</label>
                            <input type="text" name="y8_unit" value="{{ isset($_POST['y8_unit'])?$_POST['y8_unit']:'g' }}" id="y8_unit" class="hidden">
                            <div id="y8_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="y8_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y8_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y8_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y8_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y8_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y8_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 threed">
                        <label for="z8" class="font-s-14 text-blue">z8</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="z8" id="z8" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z8']) ? $_POST['z8'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="z8_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('z8_unit_dropdown')">{{ isset($_POST['z8_unit'])?$_POST['z8_unit']:'g' }} ▾</label>
                            <input type="text" name="z8_unit" value="{{ isset($_POST['z8_unit'])?$_POST['z8_unit']:'g' }}" id="z8_unit" class="hidden">
                            <div id="z8_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="z8_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z8_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z8_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z8_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z8_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z8_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                  
                    </div>
                </div>

                <div class="col-span-12 hidden nine">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12 ">
                        <p class="my-2 p-2 tagsUnit radius-5"><strong class="" >{{$lang['3']}} 9</strong></p>
                    </div>
                    <div class="col-span-6 ">
                        <label for="m9" class="font-s-14 text-blue">m9</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="m9" id="m9" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m9']) ? $_POST['m9'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="m9_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m9_unit_dropdown')">{{ isset($_POST['m9_unit'])?$_POST['m9_unit']:'g' }} ▾</label>
                            <input type="text" name="m9_unit" value="{{ isset($_POST['m9_unit'])?$_POST['m9_unit']:'g' }}" id="m9_unit" class="hidden">
                            <div id="m9_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m9_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m9_unit', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m9_unit', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m9_unit', 'lbs')">lbs</p>
                            </div>
                         </div>
                     </div>
                    <div class="col-span-6 ">
                        <label for="x9" class="font-s-14 text-blue">x9</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="x9" id="x9" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x9']) ? $_POST['x9'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="x9_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('x9_unit_dropdown')">{{ isset($_POST['x9_unit'])?$_POST['x9_unit']:'g' }} ▾</label>
                            <input type="text" name="x9_unit" value="{{ isset($_POST['x9_unit'])?$_POST['x9_unit']:'g' }}" id="x9_unit" class="hidden">
                            <div id="x9_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="x9_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x9_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x9_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x9_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x9_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x9_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                    
                    <div class="col-span-6 twod">
                        <label for="y9" class="font-s-14 text-blue">y9</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="y9" id="y9" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y9']) ? $_POST['y9'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="y9_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('y9_unit_dropdown')">{{ isset($_POST['y9_unit'])?$_POST['y9_unit']:'g' }} ▾</label>
                            <input type="text" name="y9_unit" value="{{ isset($_POST['y9_unit'])?$_POST['y9_unit']:'g' }}" id="y9_unit" class="hidden">
                            <div id="y9_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="y9_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y9_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y9_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y9_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y9_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y9_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                   
                    <div class="col-span-6 threed">
                        <label for="z9" class="font-s-14 text-blue">z9</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="z9" id="z9" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z9']) ? $_POST['z9'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="z9_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('z9_unit_dropdown')">{{ isset($_POST['z9_unit'])?$_POST['z9_unit']:'g' }} ▾</label>
                            <input type="text" name="z9_unit" value="{{ isset($_POST['z9_unit'])?$_POST['z9_unit']:'g' }}" id="z9_unit" class="hidden">
                            <div id="z9_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="z9_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z9_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z9_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z9_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z9_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z9_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                    
                    </div>
                </div>

                <div class="col-span-12 hidden ten">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12 ">
                        <p class="my-2 p-2 tagsUnit radius-5"><strong class="" >{{$lang['3']}} 10</strong></p>
                    </div>
                    <div class="col-span-6 ">
                        <label for="m10" class="font-s-14 text-blue">m10</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="m10" id="m10" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m10']) ? $_POST['m10'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="m10_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m10_unit_dropdown')">{{ isset($_POST['m10_unit'])?$_POST['m10_unit']:'g' }} ▾</label>
                            <input type="text" name="m10_unit" value="{{ isset($_POST['m10_unit'])?$_POST['m10_unit']:'g' }}" id="m10_unit" class="hidden">
                            <div id="m10_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m10_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m10_unit', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m10_unit', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m10_unit', 'lbs')">lbs</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 ">
                        <label for="x10" class="font-s-14 text-blue">x10</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="x10" id="x10" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x10']) ? $_POST['x10'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="x10_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('x10_unit_dropdown')">{{ isset($_POST['x10_unit'])?$_POST['x10_unit']:'g' }} ▾</label>
                            <input type="text" name="x10_unit" value="{{ isset($_POST['x10_unit'])?$_POST['x10_unit']:'g' }}" id="x10_unit" class="hidden">
                            <div id="x10_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="x10_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x10_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x10_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x10_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x10_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('x10_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 twod">
                        <label for="y10" class="font-s-14 text-blue">y10</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="y10" id="y10" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y10']) ? $_POST['y10'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="y10_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('y10_unit_dropdown')">{{ isset($_POST['y10_unit'])?$_POST['y10_unit']:'g' }} ▾</label>
                            <input type="text" name="y10_unit" value="{{ isset($_POST['y10_unit'])?$_POST['y10_unit']:'g' }}" id="y10_unit" class="hidden">
                            <div id="y10_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="y10_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y10_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y10_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y10_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y10_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('y10_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-span-6 threed">
                        <label for="z10" class="font-s-14 text-blue">z10</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="z10" id="z10" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z10']) ? $_POST['z10'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="z10_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('z10_unit_dropdown')">{{ isset($_POST['z10_unit'])?$_POST['z10_unit']:'g' }} ▾</label>
                            <input type="text" name="z10_unit" value="{{ isset($_POST['z10_unit'])?$_POST['z10_unit']:'g' }}" id="z10_unit" class="hidden">
                            <div id="z10_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="z10_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z10_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z10_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z10_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z10_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('z10_unit', 'yd')">yd</p>
                            </div>
                         </div>
                     </div>
                </div>
                </div>

                <div class="col-span-6">
                    <label for="res_unit" class="font-s-14 text-blue">{{ $lang['4'] }} </label>
                    <div class="w-100 py-2">
                        <i class="fas fa-sort-down color_blue"></i>
                        <select name="res_unit" id="res_unit" class="input">
                            <option value="cm" {{ isset($_POST['res_unit']) && $_POST['res_unit']=='cm'?'selected':''}}  >cm</option>
                            <option value="m" {{ isset($_POST['res_unit']) && $_POST['res_unit']=='m'?'selected':''}}  >m</option>
                            <option value="in" {{ isset($_POST['res_unit']) && $_POST['res_unit']=='in'?'selected':''}}  >in</option>
                            <option value="ft" {{ isset($_POST['res_unit']) && $_POST['res_unit']=='ft'?'selected':''}}  >ft</option>
                            <option value="yd" {{ isset($_POST['res_unit']) && $_POST['res_unit']=='yd'?'selected':''}}  >yd</option>
                        </select>
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
                    <div class="w-full text-center text-[20px]">
                        <p>{{ $lang[5] }}</p>
                        <div class="flex justify-center">
                        <p class="my-3">
                            <strong class="bg-[#2845F5] text-white px-3 py-2 lg:text-[30px] md:text-[30px] text-[18px] rounded-lg">
                            ({{ round($detail['ansx'],3)}} {{ $detail['unit']}} 
                            @if($_POST['dem']==2 || $_POST['dem']==3)
                                ,{{round($detail['ansy'],3)}} {{$detail['unit']}}
                            @elseif($_POST['dem']==3)
                                ,{{round($detail['ansz'],3)}} {{$detail['unit']}}
                            @endif
                            )
                        </strong></p>
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
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("how").addEventListener("change", function() {
        let how = this.value;

        var hideElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.add("hidden");
                });
            });
        };

        var showElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.remove("hidden");
                });
            });
        };

        if (how == 2) {
            hideElements(['.three', '.four', '.five', '.six', '.seven', '.eight', '.nine', '.ten']);
        } else if (how == 3) {
            hideElements(['.four', '.five', '.six', '.seven', '.eight', '.nine', '.ten']);
            showElements(['.three']);
        } else if (how == 4) {
            hideElements(['.five', '.six', '.seven', '.eight', '.nine', '.ten']);
            showElements(['.three', '.four']);
        } else if (how == 5) {
            hideElements(['.six', '.seven', '.eight', '.nine', '.ten']);
            showElements(['.three', '.four', '.five']);
        } else if (how == 6) {
            hideElements(['.seven', '.eight', '.nine', '.ten']);
            showElements(['.three', '.four', '.five', '.six']);
        } else if (how == 7) {
            hideElements(['.eight', '.nine', '.ten']);
            showElements(['.three', '.four', '.five', '.six', '.seven']);
        } else if (how == 8) {
            hideElements(['.nine', '.ten']);
            showElements(['.three', '.four', '.five', '.six', '.seven', '.eight']);
        } else if (how == 9) {
            hideElements(['.ten']);
            showElements(['.three', '.four', '.five', '.six', '.seven', '.eight', '.nine']);
        } else if (how == 10) {
            showElements(['.three', '.four', '.five', '.six', '.seven', '.eight', '.nine', '.ten']);
        }
    });
});

@if(isset($detail))
    var how = "{{$_POST['how']}}";

    var hideElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.add("hidden");
                });
            });
        };

        var showElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.remove("hidden");
                });
            });
        };

        if (how == 2) {
            hideElements(['.three', '.four', '.five', '.six', '.seven', '.eight', '.nine', '.ten']);
        } else if (how == 3) {
            hideElements(['.four', '.five', '.six', '.seven', '.eight', '.nine', '.ten']);
            showElements(['.three']);
        } else if (how == 4) {
            hideElements(['.five', '.six', '.seven', '.eight', '.nine', '.ten']);
            showElements(['.three', '.four']);
        } else if (how == 5) {
            hideElements(['.six', '.seven', '.eight', '.nine', '.ten']);
            showElements(['.three', '.four', '.five']);
        } else if (how == 6) {
            hideElements(['.seven', '.eight', '.nine', '.ten']);
            showElements(['.three', '.four', '.five', '.six']);
        } else if (how == 7) {
            hideElements(['.eight', '.nine', '.ten']);
            showElements(['.three', '.four', '.five', '.six', '.seven']);
        } else if (how == 8) {
            hideElements(['.nine', '.ten']);
            showElements(['.three', '.four', '.five', '.six', '.seven', '.eight']);
        } else if (how == 9) {
            hideElements(['.ten']);
            showElements(['.three', '.four', '.five', '.six', '.seven', '.eight', '.nine']);
        } else if (how == 10) {
            showElements(['.three', '.four', '.five', '.six', '.seven', '.eight', '.nine', '.ten']);
        }

@endif

@if(isset($error))
    var how = "{{$_POST['how']}}";

    var hideElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.add("hidden");
                });
            });
        };

        var showElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.remove("hidden");
                });
            });
        };

        if (how == 2) {
            hideElements(['.three', '.four', '.five', '.six', '.seven', '.eight', '.nine', '.ten']);
        } else if (how == 3) {
            hideElements(['.four', '.five', '.six', '.seven', '.eight', '.nine', '.ten']);
            showElements(['.three']);
        } else if (how == 4) {
            hideElements(['.five', '.six', '.seven', '.eight', '.nine', '.ten']);
            showElements(['.three', '.four']);
        } else if (how == 5) {
            hideElements(['.six', '.seven', '.eight', '.nine', '.ten']);
            showElements(['.three', '.four', '.five']);
        } else if (how == 6) {
            hideElements(['.seven', '.eight', '.nine', '.ten']);
            showElements(['.three', '.four', '.five', '.six']);
        } else if (how == 7) {
            hideElements(['.eight', '.nine', '.ten']);
            showElements(['.three', '.four', '.five', '.six', '.seven']);
        } else if (how == 8) {
            hideElements(['.nine', '.ten']);
            showElements(['.three', '.four', '.five', '.six', '.seven', '.eight']);
        } else if (how == 9) {
            hideElements(['.ten']);
            showElements(['.three', '.four', '.five', '.six', '.seven', '.eight', '.nine']);
        } else if (how == 10) {
            showElements(['.three', '.four', '.five', '.six', '.seven', '.eight', '.nine', '.ten']);
        }


@endif

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("dem").addEventListener("change", function() {
        let dem = this.value;

        var hideElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.add("hidden");
                });
            });
        };

        var showElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.remove("hidden");
                });
            });
        };

        if (dem == 1) {
            hideElements(['.twod', '.threed']);
        } else if (dem == 2) {
            hideElements(['.threed']);
            showElements(['.twod']);
        } else if (dem == 3) {
            showElements(['.twod', '.threed']);
        }
    });
});

@if(isset($detail))
    var dem = "{{$_POST['dem']}}";

    var hideElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.add("hidden");
                });
            });
        };

        var showElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.remove("hidden");
                });
            });
        };

        if (dem == 1) {
            hideElements(['.twod', '.threed']);
        } else if (dem == 2) {
            hideElements(['.threed']);
            showElements(['.twod']);
        } else if (dem == 3) {
            showElements(['.twod', '.threed']);
        }
@endif

@if(isset($error))
    var dem = "{{$_POST['dem']}}";

    var hideElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.add("hidden");
                });
            });
        };

        var showElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.remove("hidden");
                });
            });
        };

        if (dem == 1) {
            hideElements(['.twod', '.threed']);
        } else if (dem == 2) {
            hideElements(['.threed']);
            showElements(['.twod']);
        } else if (dem == 3) {
            showElements(['.twod', '.threed']);
        }
@endif
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>