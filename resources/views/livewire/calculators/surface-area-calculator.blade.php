<div>
  <style>
    #onetw{
        background: transparent;
        border: none;
        color: #1670a7;
        outline: none;
    }
</style>
 <form wire:submit.prevent="calculate">
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3"
         x-data="{
            opt: @entangle('operations'),
            shp: @entangle('shape'),
            get viewData() {
                let showF1=false, showF2=false, showF3=false, showF4=false, showPi=false, showShape=false;
                let txt1='', txt2='', txt3='', txt4='', imgSrc='';
                
                switch(String(this.opt)) {
                    case '1': showF1=showF2=showPi=true; imgSrc='{{asset('images/surface_area_images/surface1.png')}}'; txt1='{{$lang[29]}}'; txt2='{{$lang[30]}}'; break;
                    case '2': showF1=showF2=showPi=true; imgSrc='{{asset('images/surface_area_images/surface2.png')}}'; txt1='{{$lang[29]}}'; txt2='{{$lang[24]}}'; break;
                    case '3': showF1=showF2=showF3=showPi=true; imgSrc='{{asset('images/surface_area_images/surface3.png')}}'; txt1='{{$lang[20]}}'; txt2='{{$lang[21]}}'; txt3='{{$lang[24]}}'; break;
                    case '4': showF1=true; imgSrc='{{asset('images/surface_area_images/surface4.png')}}'; txt1='{{$lang[30]}}'; break;
                    case '5': showF1=showF2=showPi=true; imgSrc='{{asset('images/surface_area_images/surface5.png')}}'; txt1='{{$lang[29]}}'; txt2='{{$lang[24]}}'; break;
                    case '6': showF1=showPi=true; imgSrc='{{asset('images/surface_area_images/surface6.png')}}'; txt1='{{$lang[29]}}'; break;
                    case '7': showF1=showF2=showF3=true; imgSrc='{{asset('images/surface_area_images/surface7.png')}}'; txt1='{{$lang[24]}}'; txt2='{{$lang[31]}}'; txt3='{{$lang[32]}}'; break;
                    case '8': showF1=showPi=true; imgSrc='{{asset('images/surface_area_images/surface8.png')}}'; txt1='{{$lang[29]}}'; break;
                    case '9': showF1=showF2=showPi=true; imgSrc='{{asset('images/surface_area_images/surface9.png')}}'; txt1='{{$lang[33]}}'; txt2='{{$lang[34]}}'; break;
                    case '10': showF1=showF2=showF3=showF4=true; imgSrc='{{asset('images/surface_area_images/surface10.png')}}'; txt1='{{$lang[30]}}'; txt2='{{$lang[35]}}'; txt3='{{$lang[36]}}'; txt4='{{$lang[24]}}'; break;
                    case '11':
                        showShape=true;
                        switch(String(this.shp)) {
                            case '1': showF1=showF2=true; imgSrc='{{asset('images/surface_area_images/surface11.png')}}'; txt1='{{$lang[37]}}'; txt2='{{$lang[38]}}'; break;
                            case '2': showF1=showF2=true; imgSrc='{{asset('images/surface_area_images/pyramids2.png')}}'; txt1='{{$lang[37]}}'; txt2='{{$lang[38]}}'; break;
                            case '3': showF1=showF2=showF3=true; imgSrc='{{asset('images/surface_area_images/pyramids3.png')}}'; txt1='{{$lang[37]}}'; txt2='{{$lang[42]}}'; txt3='{{$lang[24]}}'; break;
                            case '4': showF1=showF2=true; imgSrc='{{asset('images/surface_area_images/pyramids4.png')}}'; txt1='{{$lang[37]}}'; txt2='{{$lang[38]}}'; break;
                            case '5': showF1=showF2=true; imgSrc='{{asset('images/surface_area_images/pyramids5.png')}}'; txt1='{{$lang[37]}}'; txt2='{{$lang[38]}}'; break;
                        }
                        break;
                    case '12': showF1=true; imgSrc='{{asset('images/surface_area_images/surface12.png')}}'; txt1='{{$lang[29]}}'; break;
                    case '13': showF1=showF2=showF4=true; imgSrc='{{asset('images/surface_area_images/surface13.png')}}'; txt1='{{$lang[39]}}'; txt2='{{$lang[40]}}'; txt4='{{$lang[41]}}'; break;
                }
                return {showF1, showF2, showF3, showF4, showPi, showShape, txt1, txt2, txt3, txt4, imgSrc};
            }
         }">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-6">
                <div class="col-12 px-2">
                    <label for="operations" class="font-s-14 text-blue">{{ $lang['43'] }}</label>
                    <div class="w-full py-2">
                        <select wire:model.live="operations" id="operations" class="input">
                            @php
                                $names = [$lang[1],$lang[2],$lang[3],$lang[4],$lang[5],$lang[6],$lang[7],$lang[8],$lang[9],$lang[10],$lang[11],$lang[12],$lang[13]];
                                $vals = ['1','2','3','4','5','6','7','8','9','10','11','12','13'];
                            @endphp
                            @foreach($vals as $idx => $v)
                                <option value="{{ $v }}">{{ $names[$idx] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-6 px-2 shape" x-show="viewData.showShape">
                        <label for="shape" class="font-s-14 text-blue">{{ $lang['16'] }}</label>
                        <div class="w-full py-2 position-relative">
                            <select wire:model.live="shape" class="input" id="shape">
                                @php
                                    $names = [$lang[15],$lang[16],$lang[17],$lang[18],$lang[19]];
                                    $vals = ["1","2","3","4","5"];
                                @endphp
                                @foreach($vals as $idx => $v)
                                    <option value="{{ $v }}">{{ $names[$idx] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 col-6 px-2 f1" x-show="viewData.showF1" style="display: none;">
                        <label for="first" class="font-s-14 text-blue" x-text="viewData.txt1 + ':'"></label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="first" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $unit1 }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'cm'); open = false">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'mm'); open = false">millimetre (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'm'); open = false">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'in'); open = false">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'ft'); open = false">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'yd'); open = false">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-lg-12 col-6 px-2 f2" x-show="viewData.showF2" style="display: none;">
                        <label for="second" class="font-s-14 text-blue" x-text="viewData.txt2 + ':'"></label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="second" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $unit2 }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'cm'); open = false">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'mm'); open = false">millimetre (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'm'); open = false">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'in'); open = false">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'ft'); open = false">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'yd'); open = false">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-lg-12 col-6 px-2 f3" x-show="viewData.showF3" style="display: none;">
                        <label for="third" class="font-s-14 text-blue" x-text="viewData.txt3 + ':'"></label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="third" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $unit3 }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit3', 'cm'); open = false">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit3', 'mm'); open = false">millimetre (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit3', 'm'); open = false">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit3', 'in'); open = false">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit3', 'ft'); open = false">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit3', 'yd'); open = false">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-lg-12 col-6 px-2 f4" x-show="viewData.showF4" style="display: none;">
                        <label for="four" class="font-s-14 text-blue" x-text="viewData.txt4 + ':'"></label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="four" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $unit4 }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit4', 'cm'); open = false">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit4', 'mm'); open = false">millimetre (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit4', 'm'); open = false">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit4', 'in'); open = false">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit4', 'ft'); open = false">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit4', 'yd'); open = false">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                  
                    <div class="col-lg-12 col-6 px-2 pi" x-show="viewData.showPi" style="display: none;">
                        <label for="pi" class="font-s-14 text-blue"><?=$lang[23]?> π:</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live="pi" step="any" id="pi" class="input" aria-label="input" placeholder="40" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-6 flex items-center ps-lg-3 justify-center">
                <img :src="viewData.imgSrc" alt="surface image" width="200px" height="200px" class="change_img"> 
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
                        <div class="w-full my-2">
                            <div class="w-full md:w-[80%] lg:w-[80%] text-[18px]">
                                <table class="w-full">
                                    <?php
                                    if (isset($detail['height'])) {
                                      ?>
                                        <tr>
                                          <td class="border-b py-2"><strong><?=$lang[25]?> :</strong></td>
                                          <td class="border-b py-2"><?=safe_round($detail['height'], 3)?><span class="font-s-16"> (cm)</span></td>
                                        </tr>
                                      <?php
                                    }
                                    if (isset($detail['ttsa'])) {
                                      ?>
                                        <tr>
                                          <td class="border-b py-2"><strong><?=$lang[26]?> :</strong></td>
                                          <td class="border-b py-2">
                                            <div x-data="{ unit: '{{ $circle_unit_result ?? 'cm²' }}', orig: '{{ safe_round($detail['ttsa'], 3) }}', 
                                                get converted() {
                                                    if (this.orig === 'NAN' || this.orig === 'INF') return this.orig;
                                                    const origNum = parseFloat(this.orig);
                                                    const facts = { 'in²': 6.452, 'cm²': 1, 'ft²': 929, 'yd²': 8381, 'm²': 10000, 'km²': 1e-10, 'mm²': 100 };
                                                    return this.unit === 'mm²' ? Number((origNum * facts[this.unit]).toFixed(6)) : Number((origNum / facts[this.unit]).toFixed(6));
                                                } }">
                                                <span class="font-s-16" x-text="converted"></span>
                                                <select x-model="unit" wire:model="circle_unit_result" id="onetw" class="d-inline ms-2" style="width:100px">
                                                    @foreach(["in²","cm²","m²","ft²","yd²","km²","mm²"] as $u)
                                                        <option value="{{ $u }}">{{ $u }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        </tr>
                                      <?php
                                    }
                                    if (isset($detail['csa'])) {
                                      ?>
                                        <tr>
                                          <td class="border-b py-2"><strong><?=$lang[27]?> :</strong></td>
                                          <td class="border-b py-2"><?=safe_round($detail['csa'], 3)?><span class="font-s-16"> (cm²)</span></td>
                                        </tr>
                                      <?php
                                    }
                                    if (isset($detail['top'])) {
                                      ?>
                                        <tr>
                                          <td class="border-b py-2"><strong><?=$lang[28]?> :</strong></td>
                                          <td class="border-b py-2"><?=safe_round($detail['top'], 3)?><span class="font-s-16"> (cm²)</span></td>
                                        </tr>
                                      <?php
                                    }
                                    if (isset($detail['bsa'])) {
                                      ?>
                                        <tr>
                                          <td class="border-b py-2"><strong><?=$lang[44]?> :</strong></td>
                                          <td class="border-b py-2"><?=safe_round($detail['bsa'], 3)?><span class="font-s-16"> (cm²)</span></td>
                                        </tr>
                                      <?php
                                    }
                                    if (isset($detail['lsa'])) {
                                      ?>
                                        <tr>
                                          <td class="border-b py-2"><strong><?=$lang[45]?> :</strong></td>
                                          <td class="border-b py-2"><?=safe_round($detail['lsa'], 3)?><span class="font-s-16"> (cm²)</span></td>
                                        </tr>
                                      <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>

@push('calculatorJS')
@endpush
</div>
