<div>
 <form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto" x-data="{ given: @entangle('given') }">
            <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-7">
                <div class="col-lg-9">
                    <label for="room_unit" class="font-s-14 text-blue">Given:</label>
                    <div class="w-100 py-2">
                        <select wire:model.live="given" class="input" id="room_unit" aria-label="select">
                            <option value="1">Longer (l) & Shorter Side (w)</option>
                            <option value="2">Longer (l) Side & Area</option>
                            <option value="3">Longer (l) Side & Perimeter</option>
                            <option value="4">Longer (l) Side & Angle (α)</option>
                            <option value="5">Shorter Side (w) & Area</option>
                            <option value="6">Shorter Side (w) & Perimeter</option>
                            <option value="7">Shorter Side (w) & Angle (α)</option>
                            <option value="8">Circumcircle radius (r)</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="col-12 mt-0 mt-lg-2 lsInput" x-show="['1','2','3','4'].includes(given)" style="display: none;">
                        <label for="ls" class="font-s-14 text-blue">{{$lang['1']}} (I)</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="ls" id="ls" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $ls_unit }} ▾</label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" @click.away="open = false" style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ls_unit', 'mm'); open = false">millimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ls_unit', 'cm'); open = false">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ls_unit', 'm'); open = false">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ls_unit', 'km'); open = false">kilometers (km)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ls_unit', 'in'); open = false">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ls_unit', 'ft'); open = false">feets (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ls_unit', 'yd'); open = false">yards (yd)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ls_unit', 'mi'); open = false">miles (mi)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 ssInput" x-show="['1','5','6','7'].includes(given)" style="display: none;">
                        <label for="ss" class="font-s-14 text-blue">{{$lang['2']}} (w)</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="ss" id="ss" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $ss_unit }} ▾</label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" @click.away="open = false" style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ss_unit', 'mm'); open = false">millimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ss_unit', 'cm'); open = false">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ss_unit', 'm'); open = false">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ss_unit', 'km'); open = false">kilometers (km)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ss_unit', 'in'); open = false">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ss_unit', 'ft'); open = false">feets (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ss_unit', 'yd'); open = false">yards (yd)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ss_unit', 'mi'); open = false">miles (mi)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 areaInput" x-show="['2','5'].includes(given)" style="display: none;">
                        <label for="area" class="font-s-14 text-blue">{{$lang['3']}} (A)</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $area_unit }} ▾</label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" @click.away="open = false" style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'mm²'); open = false">square millimeters (mm²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'cm²'); open = false">square centimeters (cm²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'm²'); open = false">square meters (m²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'km²'); open = false">square kilometers (km²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'in²'); open = false">square inches (in²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'ft²'); open = false">square feets (ft²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'yd²'); open = false">square yards (yd²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'mi²'); open = false">square miles (mi²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'a'); open = false">(a)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'da'); open = false">(da)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'ha'); open = false">(ha)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('area_unit', 'ac'); open = false">(ac)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 perimeterInput" x-show="['3','6'].includes(given)" style="display: none;">
                        <label for="perimeter" class="font-s-14 text-blue">{{$lang['4']}} (P)</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="perimeter" id="perimeter" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $perimeter_unit }} ▾</label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" @click.away="open = false" style="display: none;">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('perimeter_unit', 'mm'); open = false">millimeters (mm)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('perimeter_unit', 'cm'); open = false">centimeters (cm)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('perimeter_unit', 'm'); open = false">meters (m)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('perimeter_unit', 'km'); open = false">kilometers (km)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('perimeter_unit', 'in'); open = false">inches (in)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('perimeter_unit', 'ft'); open = false">feets (ft)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('perimeter_unit', 'yd'); open = false">yards (yd)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('perimeter_unit', 'mi'); open = false">miles (mi)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 angleInput" x-show="['4','7'].includes(given)" style="display: none;">
                        <label for="angle" class="font-s-14 text-blue">{{$lang['5']}} (α)</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="angle" id="angle" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $angle_unit }} ▾</label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" @click.away="open = false" style="display: none;">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_unit', 'deg'); open = false">degrees (deg)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_unit', 'rad'); open = false">radians (rad)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_unit', 'gon'); open = false">gradians (gon)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_unit', 'pirad'); open = false">* π rad (pirad)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 circumInput" x-show="given === '8'" style="display: none;">
                        <label for="circum" class="font-s-14 text-blue">{{$lang['6']}} (r)</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="circum" id="circum" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $circum_unit }} ▾</label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" @click.away="open = false" style="display: none;">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('circum_unit', 'mm'); open = false">millimeters (mm)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('circum_unit', 'cm'); open = false">centimeters (cm)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('circum_unit', 'm'); open = false">meters (m)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('circum_unit', 'km'); open = false">kilometers (km)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('circum_unit', 'in'); open = false">inches (in)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('circum_unit', 'ft'); open = false">feets (ft)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('circum_unit', 'yd'); open = false">yards (yd)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('circum_unit', 'mi'); open = false">miles (mi)</p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-span-5 flex items-center text-center">
                <img src="{{asset('images/diagonal.webp')}}" height="180px" width="100%" alt="trianle details image" loading="lazy" decoding="async" style="object-fit: contain">
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
    @php
        if (is_array($detail)) {
            foreach ($detail as $key => $val) {
                if (is_float($val)) {
                    if (is_nan($val)) {
                        $detail[$key] = 'NAN';
                    } elseif (is_infinite($val)) {
                        $detail[$key] = 'INF';
                    }
                }
            }
        }

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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2 overflow-auto">
                                <table class="w-full font-s-18">
                                    @if($detail['lsv']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[1]}}</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['lsv'],3)}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['ssv']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[2]}}</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['ssv'],3)}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['area']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[3]}}</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['area'],3)}} cm²</td>
                                        </tr>
                                    @endif
                                    @if($detail['perimeter']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[4]}}</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['perimeter'],3)}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['radius']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[6]}}</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['radius'],3)}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['angle_α']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[8]}}</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['angle_α'],3)}} rad</td>
                                        </tr>
                                    @endif
                                    @if($detail['diagonal']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[7]}}</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['diagonal'],3)}} rad</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

</form>
</div>
