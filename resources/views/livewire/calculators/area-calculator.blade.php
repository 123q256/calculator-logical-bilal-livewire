<div>
    @php
        if (!function_exists('safe_round')) {
            function safe_round($val, $precision = 5) {
                if ($val === 'NAN' || $val === 'NaN' || (is_numeric($val) && is_nan((float)$val))) {
                    return 'NAN';
                }
                if ($val === 'INF' || $val === 'INF' || $val === 'infinity' || $val === 'Infinity' || (is_numeric($val) && is_infinite((float)$val))) {
                    return 'INF';
                }
                return is_numeric($val) ? round((float)$val, $precision) : $val;
            }
        }
    @endphp
 <form wire:submit.prevent="calculate">
 

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
                        <select wire:model.live="shapes" id="shapes" class="input">
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
                                optionsList($val,$name,$shapes);
                            @endphp
                        </select>
                    </div>
                </div>
                @if($this->displayConfig['fields']['radius'])
                <div class="col-12 radius">
                    <label for="radius" class="font-s-14 text-blue">r</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="radius" id="radius" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="radius_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $radius_unit }} ▾</label>
                        <input type="text" wire:model.live="radius_unit" id="radius_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('radius_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['bara_radius'])
                <div class="col-12 bara_radius">
                    <label for="bara_radius" class="font-s-14 text-blue">R:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="bara_radius" id="bara_radius" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="bara_radius_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $bara_radius_unit }} ▾</label>
                        <input type="text" wire:model.live="bara_radius_unit" id="bara_radius_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('bara_radius_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
              
              
                @if($this->displayConfig['fields']['no_of_sides'])
                <div class="col-12 no_of_sides">
                    <label for="number_of_sides" class="font-s-14 text-blue">{{ $lang['19'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="number_of_sides" id="number_of_sides" class="input" aria-label="input" />
                    </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['test1'])
                <div class="col-12 test1">
                    <label for="find_triangle" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                    <div class="w-100 py-2">
                        <select class="input" wire:model.live="find_triangle" id="find_triangle">
                            <?php
                              $name=[$lang['21'],$lang['22']."(SSS)",$lang['23']."(SAS)",$lang['24']."(ASA)"];
                              $val = ["1","2","3","4"];
                              optionsList($val,$name,$find_triangle);
                            ?>
                          </select>
                    </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['test2'])
                <div class="col-12 test2">
                    <label for="find_triangle_two" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                    <div class="w-100 py-2">
                        <select class="input" wire:model.live="find_triangle_two" id="find_triangle_two">
                            <?php
                                $name=[$lang['21'],$lang['25'],$lang['26']];
                                $val = ["1","2","3"];
                                optionsList($val,$name,$find_triangle_two);
                            ?>
                          </select>
                    </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['test3'])
                <div class="col-12 test3">
                    <label for="find_triangle_three" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                    <div class="w-100 py-2">
                        <select class="input" wire:model.live="find_triangle_three" id="find_triangle_three">
                            <?php
                                $name=[$lang['21'],$lang['27'],$lang['28']];
                                $val = ["1","2","3"];
                                optionsList($val,$name,$find_triangle_three);
                            ?>
                          </select>
                    </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['test4'])
                <div class="col-12 test4">
                    <label for="find_triangle_four" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                    <div class="w-100 py-2">
                        <select class="input" wire:model.live="find_triangle_four" id="find_triangle_four">
                            <?php
                                $name=[$lang['27'],$lang['29']];
                                $val = ["1","2"];
                                optionsList($val,$name,$find_triangle_four);
                            ?>
                          </select>
                    </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['angle_alpha'])
                <div class="col-12 angle_alpha">
                    <label for="angle_alpha" class="font-s-14 text-blue">{{ $lang['30'] }} α:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="angle_alpha" id="angle_alpha" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="angle_alpha_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $angle_alpha_unit }} ▾</label>
                        <input type="text" wire:model.live="angle_alpha_unit" id="angle_alpha_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["deg","rad"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('angle_alpha_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['angle_beta'])
                <div class="col-12 angle_beta">
                    <label for="angle_beta" class="font-s-14 text-blue">{{ $lang['30'] }} β:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="angle_beta" id="angle_beta" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="angle_beta_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $angle_beta_unit }} ▾</label>
                        <input type="text" wire:model.live="angle_beta_unit" id="angle_beta_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["deg","rad"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('angle_beta_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['angle_theta'])
                <div class="col-12 angle_theta">
                    <label for="angle_theta" class="font-s-14 text-blue">{{ $lang['30'] }} θ:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="angle_theta" id="angle_theta" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="angle_theta_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $angle_theta_unit }} ▾</label>
                        <input type="text" wire:model.live="angle_theta_unit" id="angle_theta_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["deg","rad"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('angle_theta_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['angle_gamma'])
                <div class="col-12 angle_gamma">
                    <label for="angle_gamma" class="font-s-14 text-blue">{{ $lang['30'] }} γ:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="angle_gamma" id="angle_gamma" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="angle_gamma_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $angle_gamma_unit }} ▾</label>
                        <input type="text" wire:model.live="angle_gamma_unit" id="angle_gamma_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["deg","rad"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('angle_gamma_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['e'])
                <div class="col-12 e">
                    <label for="e" class="font-s-14 text-blue">e:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="e" id="e" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="e_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $e_unit }} ▾</label>
                        <input type="text" wire:model.live="e_unit" id="e_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('e_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['area'])
                <div class="col-12 area">
                    <label for="area" class="font-s-14 text-blue">a:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $area_unit }} ▾</label>
                        <input type="text" wire:model.live="area_unit" id="area_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('area_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['boxes'])
                <div class="col-12 boxes">
                    <label for="box" class="font-s-14 text-blue">b:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="box" id="box" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="box_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $box_unit }} ▾</label>
                        <input type="text" wire:model.live="box_unit" id="box_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('box_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['f'])
                <div class="col-12 f">
                    <label for="f" class="font-s-14 text-blue">f:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="f" id="f" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $f_unit }} ▾</label>
                        <input type="text" wire:model.live="f_unit" id="f_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('f_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['height'])
                <div class="col-12 height">
                    <label for="height" class="font-s-14 text-blue">h:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="height" id="height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $height_unit }} ▾</label>
                        <input type="text" wire:model.live="height_unit" id="height_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('height_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($this->displayConfig['fields']['c'])
                <div class="col-12 c">
                    <label for="c" class="font-s-14 text-blue">c:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="c" id="c" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="c_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $c_unit }} ▾</label>
                        <input type="text" wire:model.live="c_unit" id="c_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('c_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                
            </div>
            <div class="col-span-6 flex items-center justify-center">
                <img src="{{ asset($this->displayConfig['img']) }}" alt="Flow Rate Calculator" width="130" height="130" class="change_img"> 
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
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

</div>
