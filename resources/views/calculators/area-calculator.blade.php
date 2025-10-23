<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <div class="col-12">
                    <label for="shapes" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="w-100 py-2">
                        <select name="shapes" id="shapes" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name=[$lang['2'],$lang['3'],$lang['4'],$lang['5'],$lang['6'],$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12'],$lang['13'],$lang['14'],$lang['15'],$lang['16'],$lang['17'],$lang['18']];
                                $val = ["square","rectangle","triangle","circle","semicircle","sector","ellipse","trapezoid","parallelogram","rhombus","kite","regular pentagon","regular hexagon","regular octagon","annulus (ring)","irregular quadrilateral","regular polygon"];
                                optionsList($val,$name,isset($_POST['shapes'])?$_POST['shapes'] : 'square');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-12 radius">
                    <label for="radius" class="font-s-14 text-blue">r</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="radius" id="radius" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['radius']) ? $_POST['radius'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="radius_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('radius_unit_dropdown')">{{ isset($_POST['radius_unit'])?$_POST['radius_unit']:'m' }} ▾</label>
                        <input type="text" name="radius_unit" value="{{ isset($_POST['radius_unit'])?$_POST['radius_unit']:'m' }}" id="radius_unit" class="hidden">
                        <div id="radius_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="radius_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('radius_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 bara_radius">
                    <label for="bara_radius" class="font-s-14 text-blue">R:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="bara_radius" id="bara_radius" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bara_radius']) ? $_POST['bara_radius'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="bara_radius_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('bara_radius_unit_dropdown')">{{ isset($_POST['bara_radius_unit'])?$_POST['bara_radius_unit']:'m' }} ▾</label>
                        <input type="text" name="bara_radius_unit" value="{{ isset($_POST['bara_radius_unit'])?$_POST['bara_radius_unit']:'m' }}" id="bara_radius_unit" class="hidden">
                        <div id="bara_radius_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="bara_radius_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('bara_radius_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
              
              
                <div class="col-12 no_of_sides">
                    <label for="number_of_sides" class="font-s-14 text-blue">{{ $lang['19'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="number_of_sides" id="number_of_sides" class="input" aria-label="input"  value="{{ isset($_POST['number_of_sides'])?$_POST['number_of_sides']: '13' }}" />
                    </div>
                </div>
                <div class="col-12 test1">
                    <label for="find_triangle" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                    <div class="w-100 py-2">
                        <select class="input" name="find_triangle" id="find_triangle">
                            <?php
                              $name=[$lang['21'],$lang['22']."(SSS)",$lang['23']."(SAS)",$lang['24']."(ASA)"];
                              $val = ["1","2","3","4"];
                              optionsList($val,$name,isset($_POST['find_triangle'])?$_POST['find_triangle'] : '1');
                            ?>
                          </select>
                    </div>
                </div>
                <div class="col-12 test2">
                    <label for="find_triangle_two" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                    <div class="w-100 py-2">
                        <select class="input" name="find_triangle_two" id="find_triangle_two">
                            <?php
                                $name=[$lang['21'],$lang['25'],$lang['26']];
                                $val = ["1","2","3"];
                                optionsList($val,$name,isset($_POST['find_triangle_two'])?$_POST['find_triangle_two'] : '1');
                            ?>
                          </select>
                    </div>
                </div>
                <div class="col-12 test3">
                    <label for="find_triangle_three" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                    <div class="w-100 py-2">
                        <select class="input" name="find_triangle_three" id="find_triangle_three">
                            <?php
                                $name=[$lang['21'],$lang['27'],$lang['28']];
                                $val = ["1","2","3"];
                                optionsList($val,$name,isset($_POST['find_triangle_three'])?$_POST['find_triangle_three'] : '1');
                            ?>
                          </select>
                    </div>
                </div>
                <div class="col-12 test4">
                    <label for="find_triangle_four" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                    <div class="w-100 py-2">
                        <select class="input" name="find_triangle_four" id="find_triangle_four">
                            <?php
                                $name=[$lang['27'],$lang['29']];
                                $val = ["1","2"];
                                optionsList($val,$name,isset($_POST['find_triangle_four'])?$_POST['find_triangle_four'] : '1');
                            ?>
                          </select>
                    </div>
                </div>
                <div class="col-12 angle_alpha">
                    <label for="angle_alpha" class="font-s-14 text-blue">{{ $lang['30'] }} α:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle_alpha" id="angle_alpha" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_alpha']) ? $_POST['angle_alpha'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_alpha_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_alpha_unit_dropdown')">{{ isset($_POST['angle_alpha_unit'])?$_POST['angle_alpha_unit']:'deg' }} ▾</label>
                        <input type="text" name="angle_alpha_unit" value="{{ isset($_POST['angle_alpha_unit'])?$_POST['angle_alpha_unit']:'deg' }}" id="angle_alpha_unit" class="hidden">
                        <div id="angle_alpha_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_alpha_unit">
                            @foreach (["deg","rad"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('angle_alpha_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 angle_beta">
                    <label for="angle_beta" class="font-s-14 text-blue">{{ $lang['30'] }} β:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle_beta" id="angle_beta" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_beta']) ? $_POST['angle_beta'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_beta_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_beta_unit_dropdown')">{{ isset($_POST['angle_beta_unit'])?$_POST['angle_beta_unit']:'deg' }} ▾</label>
                        <input type="text" name="angle_beta_unit" value="{{ isset($_POST['angle_beta_unit'])?$_POST['angle_beta_unit']:'deg' }}" id="angle_beta_unit" class="hidden">
                        <div id="angle_beta_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_beta_unit">
                            @foreach (["deg","rad"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('angle_beta_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 angle_theta">
                    <label for="angle_theta" class="font-s-14 text-blue">{{ $lang['30'] }} θ:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle_theta" id="angle_theta" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_theta']) ? $_POST['angle_theta'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_theta_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_theta_unit_dropdown')">{{ isset($_POST['angle_theta_unit'])?$_POST['angle_theta_unit']:'deg' }} ▾</label>
                        <input type="text" name="angle_theta_unit" value="{{ isset($_POST['angle_theta_unit'])?$_POST['angle_theta_unit']:'deg' }}" id="angle_theta_unit" class="hidden">
                        <div id="angle_theta_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_theta_unit">
                            @foreach (["deg","rad"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('angle_theta_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 angle_gamma">
                    <label for="angle_gamma" class="font-s-14 text-blue">{{ $lang['30'] }} γ:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle_gamma" id="angle_gamma" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_gamma']) ? $_POST['angle_gamma'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_gamma_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_gamma_unit_dropdown')">{{ isset($_POST['angle_gamma_unit'])?$_POST['angle_gamma_unit']:'deg' }} ▾</label>
                        <input type="text" name="angle_gamma_unit" value="{{ isset($_POST['angle_gamma_unit'])?$_POST['angle_gamma_unit']:'deg' }}" id="angle_gamma_unit" class="hidden">
                        <div id="angle_gamma_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_gamma_unit">
                            @foreach (["deg","rad"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('angle_gamma_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 e">
                    <label for="e" class="font-s-14 text-blue">e:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="e" id="e" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['e']) ? $_POST['e'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="e_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('e_unit_dropdown')">{{ isset($_POST['e_unit'])?$_POST['e_unit']:'m' }} ▾</label>
                        <input type="text" name="e_unit" value="{{ isset($_POST['e_unit'])?$_POST['e_unit']:'m' }}" id="e_unit" class="hidden">
                        <div id="e_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="e_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('e_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 area">
                    <label for="area" class="font-s-14 text-blue">a:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area']) ? $_POST['area'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'m' }} ▾</label>
                        <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'m' }}" id="area_unit" class="hidden">
                        <div id="area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('area_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 boxes">
                    <label for="box" class="font-s-14 text-blue">b:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="box" id="box" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['box']) ? $_POST['box'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="box_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('box_unit_dropdown')">{{ isset($_POST['box_unit'])?$_POST['box_unit']:'m' }} ▾</label>
                        <input type="text" name="box_unit" value="{{ isset($_POST['box_unit'])?$_POST['box_unit']:'m' }}" id="box_unit" class="hidden">
                        <div id="box_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="box_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('box_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 f">
                    <label for="f" class="font-s-14 text-blue">f:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="f" id="f" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f']) ? $_POST['f'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['f_unit'])?$_POST['f_unit']:'m' }} ▾</label>
                        <input type="text" name="f_unit" value="{{ isset($_POST['f_unit'])?$_POST['f_unit']:'m' }}" id="f_unit" class="hidden">
                        <div id="f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('f_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 height">
                    <label for="height" class="font-s-14 text-blue">h:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'m' }} ▾</label>
                        <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'m' }}" id="height_unit" class="hidden">
                        <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('height_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 c">
                    <label for="c" class="font-s-14 text-blue">c:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="c" id="c" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['c']) ? $_POST['c'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="c_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('c_unit_dropdown')">{{ isset($_POST['c_unit'])?$_POST['c_unit']:'m' }} ▾</label>
                        <input type="text" name="c_unit" value="{{ isset($_POST['c_unit'])?$_POST['c_unit']:'m' }}" id="c_unit" class="hidden">
                        <div id="c_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="c_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('c_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                
            </div>
            <div class="col-span-6 flex items-center justify-center">
                <img src="<?=asset('images/sav1.svg')?>" alt="Flow Rate Calculator" width="130" height="130" class="change_img"> 
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
                    <div class="w-full my-2 text-center">
                        <?php if($detail['method']=="1"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['2']?> <?=$lang['32']?></strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                            </div>
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['2']?> \ <?=$lang['32']?> = a^2 `</p>
                            <p class="mt-2"><strong><?=$lang['34']?> :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?> `</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['2']?> \ <?=$lang['32']?> = <?php echo $detail['area']; ?>^2 `</p>
                            <p class="mt-2">`<?=$lang['2']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="2"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['3']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['3']?> \ <?=$lang['32']?> = a*b `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?>,b=<?php echo $detail['box']; ?> `</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['3']?> \ <?=$lang['32']?> = <?php echo $detail['area']; ?>*<?php echo $detail['box']; ?> `</p>
                            <p class="mt-2">`<?=$lang['3']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="31"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['4']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['4']?> \ <?=$lang['32']?> = \dfrac{b*h}{2} `</p>
                            <p class="mt-2"><strong><?=$lang['35']?> :</strong></p>
                            <p class="mt-2">`b=<?php echo $detail['box']; ?>,h=<?php echo $detail['height'] ?> `</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['4']?> \ <?=$lang['32']?> = \dfrac{<?php echo $detail['box'] ?>*<?php echo $detail['height'] ?>}{2} `</p>
                            <p class="mt-2">`<?=$lang['4']?> \ <?=$lang['32']?>= <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="15"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['10']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['10']?> \ <?=$lang['32']?> = b*h `</p>
                            <p class="mt-2"><strong><?=$lang['35']?> :</strong></p>
                            <p class="mt-2">`b=<?php echo $detail['box']; ?>,h=<?php echo $detail['height'] ?> `</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['10']?> \ <?=$lang['32']?> = <?php echo $detail['box'] ?>*<?php echo $detail['height'] ?> `</p>
                            <p class="mt-2">`<?=$lang['10']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="16"): ?>
                        <div class="text-center">
                            <p class="text-[20px]"><strong><?=$lang['10']?> <?=$lang['32']?></strong></p>
                             <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                        </div>
                    </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['10']?> \ <?=$lang['32']?> = a*b*sin(\alpha) `</p>
                            <p class="mt-2"><strong><?=$lang['35']?> :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?>,b=<?php echo $detail['box'] ?>,\alpha=<?php echo $detail['alpha']; ?> `</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['10']?> \ area = <?php echo $detail['area']?>*<?php echo $detail['box'] ?>*sin(<?php echo $detail['alpha'] ?>) `</p>
                            <p class="mt-2">`<?=$lang['10']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="17"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['10']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['10']?> \ <?=$lang['32']?> = e*f*sin(\theta) `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`e=<?php echo $detail['e']; ?>,f=<?php echo $detail['f'] ?>,\theta=<?php echo $detail['theta_value']; ?> `</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['10']?> \ <?=$lang['32']?> = <?php echo $detail['e']?>*<?php echo $detail['f'] ?>*sin(<?php echo $detail['theta_value'] ?>) `</p>
                            <p class="mt-2">`<?=$lang['10']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="21"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['11']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['11']?> \ <?=$lang['32']?> = a*h `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?>,h=<?php echo $detail['height'] ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['11']?> \ <?=$lang['32']?> = <?php echo $detail['area'] ?>*<?php echo $detail['height']; ?> `</p>
                            <p class="mt-2">`<?=$lang['11']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="22"): ?>
                        <div class="text-center">
                            <p class="text-[20px]"><strong><?=$lang['11']?> <?=$lang['32']?></strong></p>
                             <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                        </div>
                    </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['11']?> \<?=$lang['32']?> = \dfrac{e*f}{2} `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`e=<?php echo $detail['e']; ?>,f=<?php echo $detail['f'] ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['11']?> \<?=$lang['32']?> = \dfrac{<?php echo $detail['e']?>*<?php echo $detail['f'] ?>}{2} `</p>
                            <p class="mt-2">`<?=$lang['11']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="25"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['12']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['12']?> \ <?=$lang['32']?> = \dfrac{e*f}{2} `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`e=<?php echo $detail['e']; ?>,f=<?php echo $detail['f'] ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['12']?> \ <?=$lang['32']?> = \dfrac{<?php echo $detail['e']?>*<?php echo $detail['f'] ?>}{2} `</p>
                            <p class="mt-2">`<?=$lang['12']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="23"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['11']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['11']?> \ <?=$lang['32']?> = a^2*sin(\alpha) `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?>,\alpha=<?php echo $detail['alpha_value'] ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['11']?> \ <?=$lang['32']?> = <?php echo $detail['area']?>^2*sin(<?php echo $detail['alpha_value'] ?>) `</p>
                            <p class="mt-2">`<?=$lang['11']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="24"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['12']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['12']?> \ <?=$lang['32']?> = a*b*sin(\alpha) `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?>,b=<?php echo $detail['box'] ?>,\alpha=<?php echo $detail['alpha']; ?> `</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['12']?> \ <?=$lang['32']?> = <?php echo $detail['area']?>*<?php echo $detail['box'] ?>*sin(<?php echo $detail['alpha'] ?>) `</p>
                            <p class="mt-2">`<?=$lang['12']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="32"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['4']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['4']?> \ <?=$lang['32']?> = 0.5*\sqrt(((a)+(b)+(c))*
                            (-(a)+(b)+(c))*((a)-(b)+(c))*((a)+(b)-(c)) `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?>,b=<?php echo $detail['box'] ?>,c=<?php echo $detail['c'] ?> `</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['4']?> \ <?=$lang['32']?> = 0.5*\sqrt(((<?php echo $detail['area'] ?>)+(<?php echo $detail['box'] ?>)+(<?php echo $detail['c'] ?>))*
                            (-(<?php echo $detail['area'] ?>)+(<?php echo $detail['box'] ?>)+(<?php echo $detail['c'] ?>))*((<?php echo $detail['area'] ?>)-(<?php echo $detail['box'] ?>)+(<?php echo $detail['c'] ?>))*((<?php echo $detail['area'] ?>)+(<?php echo $detail['box'] ?>)-(<?php echo $detail['c'] ?>)) `</p>
                            <p class="mt-2">`<?=$lang['4']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="33"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['4']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['4']?> \ <?=$lang['32']?> = 0.5*a*b*sin(\gamma)`</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?>,b=<?php echo $detail['box'] ?>,γ=<?php echo $detail['gamma'] ?> `</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['4']?> \ <?=$lang['32']?> = 0.5*<?php echo $detail['area']?>*<?php echo $detail['box'] ?>*sin(<?php echo $detail['gamma'] ?>)`</p>
                            <p class="mt-2">`<?=$lang['4']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="34"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['4']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['4']?> \ <?=$lang['32']?> = \dfrac{a^2*sin(\beta)*sin(\gamma)}{2*sin(\beta+\gamma)}`</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?>,\beta=<?php echo $detail['beta'] ?>,γ=<?php echo $detail['gamma'] ?> `</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['4']?> \ <?=$lang['32']?> = \dfrac{<?php echo $detail['area'] ?>^2*sin(<?php echo $detail['beta'] ?>)*sin(<?php echo $detail['gamma'] ?>)}{2*sin(<?php echo $detail['beta'] ?>+<?php echo $detail['gamma']; ?>)}`</p>
                            <p class="mt-2">`<?=$lang['4']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="4"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['5']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['5']?> \<?=$lang['32']?> = \pi*r^2 `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`r=<?php echo $detail['radius']; ?> `</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['5']?> \<?=$lang['32']?> = 3.14159265358*<?php echo $detail['radius']; ?>^2 `</p>
                            <p class="mt-2">`<?=$lang['5']?> \<?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="5"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['6']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['6']?> \ <?=$lang['32']?> = \ \dfrac{\pi r^2}{2} `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`r=<?php echo $detail['radius']; ?> `</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['6']?> \ <?=$lang['32']?> = \ \dfrac{3.14159265358*<?php echo $detail['radius'] ?>^2}{2} `</p>
                            <p class="mt-2">`<?=$lang['6']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="6"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['6']?> <?=$lang['7']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['6']?> \ <?=$lang['7']?> \ <?=$lang['32']?> = \  \dfrac{r^2*α}{2} `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`r=<?php echo $detail['radius']; ?> ,  α = <?php echo $detail['angle_value']; ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['6']?> \ <?=$lang['7']?> \ <?=$lang['32']?> =\dfrac{<?php echo $detail['radius']; ?>^2*<?php echo $detail['angle_value'] ?>}{2} `</p>
                            <p class="mt-2">`<?=$lang['6']?> \ <?=$lang['7']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="7"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['8']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['8']?> \ <?=$lang['32']?> = πab `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?> ,  b = <?php echo $detail['box']; ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['8']?> \ <?=$lang['32']?> = 3.14159265358*<?php echo $detail['area']?>*<?php echo $detail['box'] ?> `</p>
                            <p class="mt-2">`<?=$lang['8']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="8"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['9']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['9']?> \ <?=$lang['32']?> = \dfrac{(a+b)*h}{2} `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?> ,  b = <?php echo $detail['box']; ?> ,h = <?php echo $detail['height'] ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['9']?> \ <?=$lang['32']?> = \dfrac{(<?php echo $detail['area'] ?> + <?php echo $detail['box'] ?>)*<?php echo $detail['height'] ?>}{2} `</p>
                            <p class="mt-2">`<?=$lang['9']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="9"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['13']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['13']?> \ <?=$lang['32']?> = \dfrac{a^2*\sqrt{(25)+10\sqrt(5)}}{4} `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['13']?> \<?=$lang['32']?> = \dfrac{<?php echo $detail['area']?>^2*\sqrt{(25)+10\sqrt(5)}}{4} `</p>
                            <p class="mt-2">`<?=$lang['13']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="10"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['14']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['14']?> \ <?php $lang['32'] ?> = \dfrac{3}{2}*\sqrt{3}*a^2 `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`<?=$lang['14']?> \ <?=$lang['32'] ?> = \dfrac{3}{2}*\sqrt{3}*<?php echo $detail['area']; ?>^2 `</p>
                            <p class="mt-2">`<?=$lang['14']?> \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="11"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['15']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`\text{<?=$lang['15']?>  <?=$lang['32']?>} = 2*(1+\sqrt(2))*a^2 `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`\text{<?=$lang['15']?> <?=$lang['32']?>} = 2*(1+\sqrt(2))*<?php echo $detail['area']; ?>^2 `</p>
                            <p class="mt-2">`\text{<?=$lang['15']?> <?=$lang['32']?>} = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="12"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['16']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`\text{<?=$lang['16']?> <?=$lang['32']?>} = \pi(R^2-r^2) `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`r=<?php echo $detail['radius']; ?>,R=<?php echo $detail['bara_radius']; ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`\text{<?=$lang['16']?> <?=$lang['32']?>} = 3.14159265358*(<?php echo $detail['bara_radius']?>^2-<?php echo $detail['radius'] ?>^2) `</p>
                            <p class="mt-2">`\text{<?=$lang['16']?> <?=$lang['32']?>} = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="13"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['17']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`\text{<?=$lang['17']?> <?=$lang['32']?>} = e*f*sin(α) `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`e=<?php echo $detail['e']; ?>,f=<?php echo $detail['f']; ?>,α=<?php echo $detail['angle_value']; ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`\text{<?=$lang['17']?> <?=$lang['32']?>} = <?php echo $detail['e'] ?>*<?php echo $detail['f'] ?>*sin(<?php echo $detail['angle_value'] ?>) `</p>
                            <p class="mt-2">`\text{<?=$lang['17']?> <?=$lang['32']?>} = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                        <?php if($detail['method']=="14"): ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['18']?> <?=$lang['32']?></strong></p>
                                 <div class="flex justify-center">
  <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=round($detail['answer'],2)?><span class="text-[20px]"> (cm<sup>2</sup>)</span></strong></p>
                            </div>
                        </div>
                            
                            <p class="mt-2"><strong><?=$lang['36']?> :</strong></p>
                            <p class="mt-2">`\text{<?=$lang['18']?>} \ <?=$lang['32']?> = a^2*\dfrac{cot\Bigg(\dfrac{\pi}{n}\Bigg)}{4} `</p>
                            <p class="mt-2"><strong>Input :</strong></p>
                            <p class="mt-2">`a=<?php echo $detail['area']; ?>,Number \ of \ sides (n)=<?php echo $detail['number_of_sides']; ?>`</p>
                            <p class="mt-2"><strong><?=$lang['37']?> :</strong></p>
                            <p class="mt-2">`\text{<?=$lang['18']?>} \ <?=$lang['32']?> = <?php echo $detail['area'] ?>^2*\dfrac{cot\Bigg(\dfrac{\pi}{<?php echo $detail['number_of_sides'] ?>}\Bigg)}{4} `</p>
                            <p class="mt-2">`\text{<?=$lang['18']?>} \ <?=$lang['32']?> = <?php echo round($detail['answer'],2); ?> ` <span class="black-text"> (cm<sup>2</sup>)</span></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" async
            src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML">
        </script>
    @endisset
</form>
@push('calculatorJS')
    <script>
        var shape = document.getElementById('shapes').value;
        if(shape == 'square'){
            var elements = ['.test1', '.test2', '.test3', '.test4', '.radius', '.bara_radius', '.area', '.boxes', '.angle_alpha', '.angle_gamma', '.angle_beta', '.angle_theta', '.height', '.e', '.f', '.c', '.no_of_sides'];
            elements.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(el) {
                    el.style.display = 'none';
                });
            });
            document.querySelector('.area').style.display = 'block';
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('shapes').addEventListener('change', function() {
                var r = this.value;
                var elements = ['.test1', '.test2', '.test3', '.test4', '.radius', '.bara_radius', '.area', '.boxes', '.angle_alpha', '.angle_gamma', '.angle_beta', '.angle_theta', '.height', '.e', '.f', '.c', '.no_of_sides'];
                elements.forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(el) {
                        el.style.display = 'none';
                    });
                });

                var imgSrc;
                switch(r) {
                    case 'square':
                        document.querySelector('.area').style.display = 'block';
                        imgSrc = '<?=asset('images/sav1.svg')?>';
                        break;
                    case 'rectangle':
                        document.querySelector('.area').style.display = 'block';
                        document.querySelector('.boxes').style.display = 'block';
                        imgSrc = '<?=asset('images/sav2.svg')?>';
                        break;
                    case 'triangle':
                        handleTriangleOptions();
                        break;
                    case 'circle':
                        document.querySelector('.radius').style.display = 'block';
                        imgSrc = '<?=asset('images/sav7.svg')?>';
                        break;
                    case 'semicircle':
                        document.querySelector('.radius').style.display = 'block';
                        imgSrc = '<?=asset('images/sav8.svg')?>';
                        break;
                    case 'sector':
                        document.querySelector('.radius').style.display = 'block';
                        document.querySelector('.angle_alpha').style.display = 'block';
                        imgSrc = '<?=asset('images/sav9.svg')?>';
                        break;
                    case 'ellipse':
                        document.querySelector('.area').style.display = 'block';
                        document.querySelector('.boxes').style.display = 'block';
                        imgSrc = '<?=asset('images/sav10.svg')?>';
                        break;
                    case 'trapezoid':
                        document.querySelector('.area').style.display = 'block';
                        document.querySelector('.boxes').style.display = 'block';
                        document.querySelector('.height').style.display = 'block';
                        imgSrc = '<?=asset('images/sav11.svg')?>';
                        break;
                    case 'parallelogram':
                        handleParallelogramOptions();
                        break;
                    case 'rhombus':
                        handleRhombusOptions();
                        break;
                    case 'kite':
                        handleKiteOptions();
                        break;
                    case 'regular pentagon':
                        document.querySelector('.area').style.display = 'block';
                        imgSrc = '<?=asset('images/sav20.svg')?>';
                        break;
                    case 'regular hexagon':
                        document.querySelector('.area').style.display = 'block';
                        imgSrc = '<?=asset('images/sav21.svg')?>';
                        break;
                    case 'regular octagon':
                        document.querySelector('.area').style.display = 'block';
                        imgSrc = '<?=asset('images/sav22.svg')?>';
                        break;
                    case 'annulus (ring)':
                        document.querySelector('.radius').style.display = 'block';
                        document.querySelector('.bara_radius').style.display = 'block';
                        imgSrc = '<?=asset('images/sav23.svg')?>';
                        break;
                    case 'irregular quadrilateral':
                        document.querySelector('.e').style.display = 'block';
                        document.querySelector('.f').style.display = 'block';
                        document.querySelector('.angle_alpha').style.display = 'block';
                        imgSrc = '<?=asset('images/sav24.svg')?>';
                        break;
                    case 'regular polygon':
                        document.querySelector('.area').style.display = 'block';
                        document.querySelector('.no_of_sides').style.display = 'block';
                        imgSrc = '<?=asset('images/sav25.svg')?>';
                        break;
                }
                if (imgSrc) {
                    document.querySelector('.change_img').src = imgSrc;
                }
            });

            function handleTriangleOptions() {
                var triangleType = document.getElementById('find_triangle').value;
                var imgSrc;
                switch(triangleType) {
                    case '1':
                        document.querySelector('.height').style.display = 'block';
                        document.querySelector('.boxes').style.display = 'block';
                        document.querySelector('.test1').style.display = 'block';
                        imgSrc = '<?=asset('images/sav12.svg')?>';
                        break;
                    case '2':
                        document.querySelector('.area').style.display = 'block';
                        document.querySelector('.boxes').style.display = 'block';
                        document.querySelector('.test1').style.display = 'block';
                        document.querySelector('.c').style.display = 'block';
                        imgSrc = '<?=asset('images/sav4.svg')?>';
                        break;
                    case '3':
                        document.querySelector('.area').style.display = 'block';
                        document.querySelector('.boxes').style.display = 'block';
                        document.querySelector('.test1').style.display = 'block';
                        document.querySelector('.angle_gamma').style.display = 'block';
                        imgSrc = '<?=asset('images/sav5.svg')?>';
                        break;
                    case '4':
                        document.querySelector('.area').style.display = 'block';
                        document.querySelector('.angle_beta').style.display = 'block';
                        document.querySelector('.test1').style.display = 'block';
                        document.querySelector('.angle_gamma').style.display = 'block';
                        imgSrc = '<?=asset('images/sav6.svg')?>';
                        break;
                }
                if (imgSrc) {
                    document.querySelector('.change_img').src = imgSrc;
                }
            }

            function handleParallelogramOptions() {
                var parallelogramType = document.getElementById('find_triangle_two').value;
                var imgSrc;
                switch(parallelogramType) {
                    case '1':
                        document.querySelector('.height').style.display = 'block';
                        document.querySelector('.boxes').style.display = 'block';
                        document.querySelector('.test2').style.display = 'block';
                        imgSrc = '<?=asset('images/sav12.svg')?>';
                        break;
                    case '2':
                        document.querySelector('.area').style.display = 'block';
                        document.querySelector('.boxes').style.display = 'block';
                        document.querySelector('.angle_alpha').style.display = 'block';
                        document.querySelector('.test2').style.display = 'block';
                        imgSrc = '<?=asset('images/sav13.svg')?>';
                        break;
                    case '3':
                        document.querySelector('.e').style.display = 'block';
                        document.querySelector('.f').style.display = 'block';
                        document.querySelector('.angle_theta').style.display = 'block';
                        document.querySelector('.test2').style.display = 'block';
                        imgSrc = '<?=asset('images/sav14.svg')?>';
                        break;
                }
                if (imgSrc) {
                    document.querySelector('.change_img').src = imgSrc;
                }
            }

            function handleRhombusOptions() {
                var rhombusType = document.getElementById('find_triangle_three').value;
                var imgSrc;
                switch(rhombusType) {
                    case '1':
                        document.querySelector('.height').style.display = 'block';
                        document.querySelector('.area').style.display = 'block';
                        document.querySelector('.test3').style.display = 'block';
                        imgSrc = '<?=asset('images/sav16.svg')?>';
                        break;
                    case '2':
                        document.querySelector('.test3').style.display = 'block';
                        document.querySelector('.e').style.display = 'block';
                        document.querySelector('.f').style.display = 'block';
                        imgSrc = '<?=asset('images/sav17.svg')?>';
                        break;
                    case '3':
                        document.querySelector('.test3').style.display = 'block';
                        document.querySelector('.area').style.display = 'block';
                        document.querySelector('.angle_alpha').style.display = 'block';
                        imgSrc = '<?=asset('images/sav15.svg')?>';
                        break;
                }
                if (imgSrc) {
                    document.querySelector('.change_img').src = imgSrc;
                }
            }

            function handleKiteOptions() {
                var kiteType = document.getElementById('find_triangle_four').value;
                var imgSrc;
                switch(kiteType) {
                    case '1':
                        document.querySelector('.e').style.display = 'block';
                        document.querySelector('.f').style.display = 'block';
                        document.querySelector('.test4').style.display = 'block';
                        imgSrc = '<?=asset('images/sav18.svg')?>';
                        break;
                    case '2':
                        document.querySelector('.area').style.display = 'block';
                        document.querySelector('.angle_alpha').style.display = 'block';
                        document.querySelector('.boxes').style.display = 'block';
                        document.querySelector('.test4').style.display = 'block';
                        imgSrc = '<?=asset('images/sav19.svg')?>';
                        break;
                }
                if (imgSrc) {
                    document.querySelector('.change_img').src = imgSrc;
                }
            }
        });

        document.getElementById("find_triangle").addEventListener("change", function() {
            var l = this.value;
            var elementsToHide = [
                '.test2', '.test3', '.test4', '.radius', '.bara_radius', '.area',
                '.angle_alpha', '.angle_gamma', '.angle_beta', '.angle_theta', 
                '.e', '.f', '.c','.boxes', '.no_of_sides', '.height'
            ];

            function hideElements(selectors) {
                selectors.forEach(selector => {
                    document.querySelectorAll(selector).forEach(el => el.style.display = 'none');
                });
            }

            function showElements(selectors) {
                selectors.forEach(selector => {
                    document.querySelectorAll(selector).forEach(el => el.style.display = 'block');
                });
            }

            function changeImage(src) {
                document.querySelector(".change_img").src = src;
            }

            switch (l) {
                case "1":
                    hideElements(elementsToHide);
                    showElements(['.height', '.boxes', '.test1']);
                    changeImage('<?=asset('images/sav12.svg')?>');
                    break;
                case "2":
                    hideElements(elementsToHide);
                    showElements(['.area', '.boxes', '.test1', '.c']);
                    changeImage('<?=asset('images/sav4.svg')?>');
                    break;
                case "3":
                    hideElements(elementsToHide);
                    showElements(['.area', '.boxes', '.test1', '.angle_gamma']);
                    changeImage('<?=asset('images/sav5.svg')?>');
                    break;
                case "4":
                    hideElements(elementsToHide);
                    showElements(['.area', '.angle_beta', '.test1', '.angle_gamma']);
                    changeImage('<?=asset('images/sav6.svg')?>');
                    break;
            }
        });

        document.getElementById("find_triangle_two").addEventListener("change", function() {
            var v = this.value;
            var elementsToHide = [
                '.test1', '.test3', '.test4', '.radius', '.bara_radius', '.area',
                '.angle_alpha', '.angle_gamma', '.angle_beta', '.angle_theta', 
                '.area', '.e','.boxes', '.f', '.c', '.no_of_sides', '.height'
            ];
            elementsToHide.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(el) {
                    el.style.display = 'none';
                });
            });

            function showElements(selectors) {
                selectors.forEach(selector => {
                    document.querySelectorAll(selector).forEach(el => el.style.display = 'block');
                });
            }

            function changeImage(src) {
                document.querySelector(".change_img").src = src;
            }

            switch (v) {
                case "1":
                    showElements(['.height', '.boxes', '.test2']);
                    changeImage('<?=asset('images/sav12.svg')?>');
                    break;
                case "2":
                    showElements(['.area', '.boxes', '.angle_alpha', '.test2']);
                    changeImage('<?=asset('images/sav13.svg')?>');
                    break;
                case "3":
                    showElements(['.e', '.f', '.angle_theta', '.test2']);
                    changeImage('<?=asset('images/sav14.svg')?>');
                    break;
            }
        });

        document.getElementById("find_triangle_three").addEventListener("change", function() {
            var k = this.value;
            var elementsToHide = [
                '.test1', '.test2', '.test4', '.radius', '.bara_radius', '.boxes',
                '.angle_alpha', '.angle_gamma', '.angle_beta', '.angle_theta', 
                '.e', '.f', '.c', '.no_of_sides', '.height', '.area', '.angle_alpha'
            ];

            function hideElements(selectors) {
                selectors.forEach(selector => {
                    document.querySelectorAll(selector).forEach(el => el.style.display = 'none');
                });
            }

            function showElements(selectors) {
                selectors.forEach(selector => {
                    document.querySelectorAll(selector).forEach(el => el.style.display = 'block');
                });
            }

            function changeImage(src) {
                document.querySelector(".change_img").src = src;
            }

            switch (k) {
                case "1":
                    hideElements(elementsToHide);
                    showElements(['.height', '.area', '.test3']);
                    changeImage('<?=asset('images/sav16.svg')?>');
                    break;
                case "2":
                    hideElements(elementsToHide);
                    showElements(['.test3', '.e', '.f']);
                    changeImage('<?=asset('images/sav17.svg')?>');
                    break;
                case "3":
                    hideElements(elementsToHide);
                    showElements(['.test3', '.area', '.angle_alpha']);
                    changeImage('<?=asset('images/sav15.svg')?>');
                    break;
            }
        });

        document.getElementById("find_triangle_four").addEventListener("change", function() {
            var j = this.value;
            var elementsToHide = [
                '.test1', '.test2', '.test3', '.radius', '.bara_radius', '.boxes',
                '.angle_alpha', '.angle_gamma', '.angle_beta', '.angle_theta', 
                '.c', '.no_of_sides', '.area', '.height', '.e', '.f'
            ];

            function hideElements(selectors) {
                selectors.forEach(selector => {
                    document.querySelectorAll(selector).forEach(el => el.style.display = 'none');
                });
            }

            function showElements(selectors) {
                selectors.forEach(selector => {
                    document.querySelectorAll(selector).forEach(el => el.style.display = 'block');
                });
            }

            function changeImage(src) {
                document.querySelector(".change_img").src = src;
            }

            switch (j) {
                case "1":
                    hideElements(elementsToHide);
                    showElements(['.e', '.f', '.test4']);
                    changeImage('<?=asset('images/sav18.svg')?>');
                    break;
                case "2":
                    hideElements(elementsToHide);
                    showElements(['.test4', '.area', '.angle_alpha', '.boxes']);
                    changeImage('<?=asset('images/sav19.svg')?>');
                    break;
            }
        });

        @if(isset($detail) || isset($error))
            document.addEventListener('DOMContentLoaded', function() {
                    var r = document.getElementById('shapes').value;
                    var elements = ['.test1', '.test2', '.test3', '.test4', '.radius', '.bara_radius', '.area', '.boxes', '.angle_alpha', '.angle_gamma', '.angle_beta', '.angle_theta', '.height', '.e', '.f', '.c', '.no_of_sides'];
                    elements.forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(el) {
                            el.style.display = 'none';
                        });
                    });

                    var imgSrc;
                    switch(r) {
                        case 'square':
                            document.querySelector('.area').style.display = 'block';
                            imgSrc = '<?=asset('images/sav1.svg')?>';
                            break;
                        case 'rectangle':
                            document.querySelector('.area').style.display = 'block';
                            document.querySelector('.boxes').style.display = 'block';
                            imgSrc = '<?=asset('images/sav2.svg')?>';
                            break;
                        case 'triangle':
                            handleTriangleOptions();
                            break;
                        case 'circle':
                            document.querySelector('.radius').style.display = 'block';
                            imgSrc = '<?=asset('images/sav7.svg')?>';
                            break;
                        case 'semicircle':
                            document.querySelector('.radius').style.display = 'block';
                            imgSrc = '<?=asset('images/sav8.svg')?>';
                            break;
                        case 'sector':
                            document.querySelector('.radius').style.display = 'block';
                            document.querySelector('.angle_alpha').style.display = 'block';
                            imgSrc = '<?=asset('images/sav9.svg')?>';
                            break;
                        case 'ellipse':
                            document.querySelector('.area').style.display = 'block';
                            document.querySelector('.boxes').style.display = 'block';
                            imgSrc = '<?=asset('images/sav10.svg')?>';
                            break;
                        case 'trapezoid':
                            document.querySelector('.area').style.display = 'block';
                            document.querySelector('.boxes').style.display = 'block';
                            document.querySelector('.height').style.display = 'block';
                            imgSrc = '<?=asset('images/sav11.svg')?>';
                            break;
                        case 'parallelogram':
                            handleParallelogramOptions();
                            break;
                        case 'rhombus':
                            handleRhombusOptions();
                            break;
                        case 'kite':
                            handleKiteOptions();
                            break;
                        case 'regular pentagon':
                            document.querySelector('.area').style.display = 'block';
                            imgSrc = '<?=asset('images/sav20.svg')?>';
                            break;
                        case 'regular hexagon':
                            document.querySelector('.area').style.display = 'block';
                            imgSrc = '<?=asset('images/sav21.svg')?>';
                            break;
                        case 'regular octagon':
                            document.querySelector('.area').style.display = 'block';
                            imgSrc = '<?=asset('images/sav22.svg')?>';
                            break;
                        case 'annulus (ring)':
                            document.querySelector('.radius').style.display = 'block';
                            document.querySelector('.bara_radius').style.display = 'block';
                            imgSrc = '<?=asset('images/sav23.svg')?>';
                            break;
                        case 'irregular quadrilateral':
                            document.querySelector('.e').style.display = 'block';
                            document.querySelector('.f').style.display = 'block';
                            document.querySelector('.angle_alpha').style.display = 'block';
                            imgSrc = '<?=asset('images/sav24.svg')?>';
                            break;
                        case 'regular polygon':
                            document.querySelector('.area').style.display = 'block';
                            document.querySelector('.no_of_sides').style.display = 'block';
                            imgSrc = '<?=asset('images/sav25.svg')?>';
                            break;
                    }
                    if (imgSrc) {
                        document.querySelector('.change_img').src = imgSrc;
                    }
                });

                function handleTriangleOptions() {
                    var triangleType = document.getElementById('find_triangle').value;
                    var imgSrc;
                    switch(triangleType) {
                        case '1':
                            document.querySelector('.height').style.display = 'block';
                            document.querySelector('.boxes').style.display = 'block';
                            document.querySelector('.test1').style.display = 'block';
                            imgSrc = '<?=asset('images/sav12.svg')?>';
                            break;
                        case '2':
                            document.querySelector('.area').style.display = 'block';
                            document.querySelector('.boxes').style.display = 'block';
                            document.querySelector('.test1').style.display = 'block';
                            document.querySelector('.c').style.display = 'block';
                            imgSrc = '<?=asset('images/sav4.svg')?>';
                            break;
                        case '3':
                            document.querySelector('.area').style.display = 'block';
                            document.querySelector('.boxes').style.display = 'block';
                            document.querySelector('.test1').style.display = 'block';
                            document.querySelector('.angle_gamma').style.display = 'block';
                            imgSrc = '<?=asset('images/sav5.svg')?>';
                            break;
                        case '4':
                            document.querySelector('.area').style.display = 'block';
                            document.querySelector('.angle_beta').style.display = 'block';
                            document.querySelector('.test1').style.display = 'block';
                            document.querySelector('.angle_gamma').style.display = 'block';
                            imgSrc = '<?=asset('images/sav6.svg')?>';
                            break;
                    }
                    if (imgSrc) {
                        document.querySelector('.change_img').src = imgSrc;
                    }
                }

                function handleParallelogramOptions() {
                    var parallelogramType = document.getElementById('find_triangle_two').value;
                    var imgSrc;
                    switch(parallelogramType) {
                        case '1':
                            document.querySelector('.height').style.display = 'block';
                            document.querySelector('.boxes').style.display = 'block';
                            document.querySelector('.test2').style.display = 'block';
                            imgSrc = '<?=asset('images/sav12.svg')?>';
                            break;
                        case '2':
                            document.querySelector('.area').style.display = 'block';
                            document.querySelector('.boxes').style.display = 'block';
                            document.querySelector('.angle_alpha').style.display = 'block';
                            document.querySelector('.test2').style.display = 'block';
                            imgSrc = '<?=asset('images/sav13.svg')?>';
                            break;
                        case '3':
                            document.querySelector('.e').style.display = 'block';
                            document.querySelector('.f').style.display = 'block';
                            document.querySelector('.angle_theta').style.display = 'block';
                            document.querySelector('.test2').style.display = 'block';
                            imgSrc = '<?=asset('images/sav14.svg')?>';
                            break;
                    }
                    if (imgSrc) {
                        document.querySelector('.change_img').src = imgSrc;
                    }
                }

                function handleRhombusOptions() {
                    var rhombusType = document.getElementById('find_triangle_three').value;
                    var imgSrc;
                    switch(rhombusType) {
                        case '1':
                            document.querySelector('.height').style.display = 'block';
                            document.querySelector('.area').style.display = 'block';
                            document.querySelector('.test3').style.display = 'block';
                            imgSrc = '<?=asset('images/sav16.svg')?>';
                            break;
                        case '2':
                            document.querySelector('.test3').style.display = 'block';
                            document.querySelector('.e').style.display = 'block';
                            document.querySelector('.f').style.display = 'block';
                            imgSrc = '<?=asset('images/sav17.svg')?>';
                            break;
                        case '3':
                            document.querySelector('.test3').style.display = 'block';
                            document.querySelector('.area').style.display = 'block';
                            document.querySelector('.angle_alpha').style.display = 'block';
                            imgSrc = '<?=asset('images/sav15.svg')?>';
                            break;
                    }
                    if (imgSrc) {
                        document.querySelector('.change_img').src = imgSrc;
                    }
                }

                function handleKiteOptions() {
                    var kiteType = document.getElementById('find_triangle_four').value;
                    var imgSrc;
                    switch(kiteType) {
                        case '1':
                            document.querySelector('.e').style.display = 'block';
                            document.querySelector('.f').style.display = 'block';
                            document.querySelector('.test4').style.display = 'block';
                            imgSrc = '<?=asset('images/sav18.svg')?>';
                            break;
                        case '2':
                            document.querySelector('.area').style.display = 'block';
                            document.querySelector('.angle_alpha').style.display = 'block';
                            document.querySelector('.boxes').style.display = 'block';
                            document.querySelector('.test4').style.display = 'block';
                            imgSrc = '<?=asset('images/sav19.svg')?>';
                            break;
                    }
                    if (imgSrc) {
                        document.querySelector('.change_img').src = imgSrc;
                    }
            }
        @endif
    </script>
@endpush