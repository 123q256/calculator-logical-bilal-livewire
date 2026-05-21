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
                <div class="col-span-12">
                    <label for="selection" class="label">{{ $lang['1'] }}</label>
                    <div class="w-100 py-2">
                        <select wire:model.live="selection" id="selection" class="input">
                            <option value="1">{{ $lang['2'] }}</option>
                            <option value="2">{{ $lang['3'] }}</option>
                        </select>
                    </div>
                </div>
              
                @if($selection == 1)
                <div class="col-span-12 tri">
                    <label for="triangle_type" class="label">{{ $lang['4'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" wire:model.live="triangle_type" id="triangle_type">
                            <option value="1">{{ $lang['5'] }}</option>
                            <option value="2">{{ $lang['6'] }} (SSS)</option>
                            <option value="3">{{ $lang['7'] }} (SAS)</option>
                            <option value="4">{{ $lang['8'] }} (ASA)</option>
                        </select>
                    </div>
                </div>
                @endif
                @if($selection == 1 && $triangle_type == 1)
                <div class="col-span-12 base_height">
                    <label for="base_height" class="label"><?=$lang['9']?> (h):</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="base_height" id="base_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="base_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $base_height_unit }} ▾</label>
                        <input type="text" wire:model.live="base_height_unit" id="base_height_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('base_height_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($selection == 2)
                <div class="col-span-12 pyramid_base_area">
                    <label for="pyramid_base_area" class="label">{{ $lang['10'] }} (A):</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="pyramid_base_area" id="pyramid_base_area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="pyramid_base_area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $pyramid_base_area_unit }} ▾</label>
                        <input type="text" wire:model.live="pyramid_base_area_unit" id="pyramid_base_area_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm²","cm²","m²","km²","in²","ft²","yd²","mi²"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pyramid_base_area_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($selection == 1 && $triangle_type == 1)
                <div class="col-span-12 base">
                    <label for="base" class="label"><?=$lang['11']?> (b):</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="base" id="base" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="base_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $base_unit }} ▾</label>
                        <input type="text" wire:model.live="base_unit" id="base_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('base_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($selection == 1 && in_array($triangle_type, [2, 3, 4]))
                <div class="col-span-12 sidea">
                    <label for="sidea" class="label"><?=$lang['12']?> a:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="sidea" id="sidea" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="sidea_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $sidea_length_unit }} ▾</label>
                        <input type="text" wire:model.live="sidea_length_unit" id="sidea_length_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('sidea_length_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($selection == 1 && in_array($triangle_type, [2, 3]))
                <div class="col-span-12 sideb">
                    <label for="sideb" class="label"><?=$lang['12']?> b:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="sideb" id="sideb" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="sideb_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $sideb_length_unit }} ▾</label>
                        <input type="text" wire:model.live="sideb_length_unit" id="sideb_length_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('sideb_length_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($selection == 1 && $triangle_type == 2)
                <div class="col-span-12 sidec">
                    <label for="sidec" class="label"><?=$lang['12']?> c:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="sidec" id="sidec" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="sidec_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $sidec_length_unit }} ▾</label>
                        <input type="text" wire:model.live="sidec_length_unit" id="sidec_length_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('sidec_length_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($selection == 1 && $triangle_type == 4)
                <div class="col-span-12 angle_beta">
                    <label for="angle_beta" class="label"><?=$lang['13']?> β:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="angle_beta" id="angle_beta" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="angle_beta_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $angle_beta_unit }} ▾</label>
                        <input type="text" wire:model.live="angle_beta_unit" id="angle_beta_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["deg","rad"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('angle_beta_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                @if($selection == 1 && in_array($triangle_type, [3, 4]))
                <div class="col-span-12 angle_gamma">
                    <label for="angle_gamma" class="label"><?=$lang['12']?> γ:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="angle_gamma" id="angle_gamma" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="angle_gamma_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $angle_gamma_unit }} ▾</label>
                        <input type="text" wire:model.live="angle_gamma_unit" id="angle_gamma_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["deg","rad"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('angle_gamma_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                @endif
                <div class="col-span-12 pyramid_height">
                    <label for="pyramid_height" class="label"><?=$lang['14']?> (H):</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : ''">
                        <input type="number" wire:model.live="pyramid_height" id="pyramid_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label for="pyramid_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $pyramid_height_unit }} ▾</label>
                        <input type="text" wire:model.live="pyramid_height_unit" id="pyramid_height_unit" class="hidden">
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pyramid_height_unit', '{{ $item }}')" @click="open = false"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
               
                
            </div>
            <div class="col-span-6 flex items-center ps-lg-3 justify-center">
                @php
                    $imgSrc = 'picture1.png';
                    if ($selection == 2) {
                        $imgSrc = 'picture5.png';
                    } elseif ($selection == 1) {
                        if ($triangle_type == 2) $imgSrc = 'picture2.png';
                        elseif ($triangle_type == 3) $imgSrc = 'picture3.png';
                        elseif ($triangle_type == 4) $imgSrc = 'picture4.png';
                    }
                @endphp
                <img src="<?=asset('images/'.$imgSrc)?>" alt="Triangular Pyramid Calculator" width="130" height="130" class="change_img"> 
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
                            <div class="w-full my-2">
                                <div class="w-full md:w-[80%] lg:w-[80%] text-[18px]">
                                <?php if(!empty($detail['volume'])): ?>
                                    <table class="w-full">
                                        <?php if(!empty($detail['pba'])): ?>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['10']}} :</strong></td>
                                                <td class="border-b py-2"><?=safe_round($detail['pba'],5)?><span class="font-s-14"> (cm<sup>2</sup>)</span></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td width="45%" class="border-b py-2"><strong><?=$lang['15']?> :</strong></td>
                                            <td class="border-b py-2"><strong><?=safe_round($detail['volume'],5)?><span class="font_size22 font-s-14"> (cm<sup>3</sup>)</span> </strong></td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2" colspan="2"><strong><?=$lang['16']?></strong></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*1000;?> <span class="font-s-14">cubic millimeters (mm<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*0.001;?> <span class="font-s-14"> cubic decimeters (dm<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*0.000001;?> <span class="font-s-14">cubic meters (m<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*0.000000000000001;?> <span class="font-s-14">cubic kilometers (km<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*0.061024;?> <span class="font-s-14">cubic inches (in<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*0.000035315;?> <span class="font-s-14">cubic feet (ft<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*0.00000130795;?> <span class="font-s-14">cubic  yards (yd<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']/4168000000000000;?> <span class="font-s-14">cubic miles (mi<sup>3</sup>)</span></td>
                                        </tr>
                    
                                    </table>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

    @endisset
</form>


</div>
