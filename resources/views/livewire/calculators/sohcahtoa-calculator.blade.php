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
   <style>
    .border-b{
        border-bottom: 1px solid black!important;
    }
</style>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            @php
                $filled_alpha = trim($angle_alpha) !== '';
                $filled_beta = trim($angle_beta) !== '';
                $filled_a = trim($len_a) !== '';
                $filled_b = trim($len_b) !== '';
                $filled_c = trim($len_c) !== '';
                
                $filledCount = ($filled_alpha ? 1 : 0) + ($filled_beta ? 1 : 0) + ($filled_a ? 1 : 0) + ($filled_b ? 1 : 0) + ($filled_c ? 1 : 0);
                
                $disable_a = ($filledCount >= 2 && !$filled_a);
                $disable_b = ($filledCount >= 2 && !$filled_b);
                $disable_c = ($filledCount >= 2 && !$filled_c);
                
                $disable_alpha = $filled_beta || ($filledCount >= 2 && !$filled_alpha);
                $disable_beta = $filled_alpha || ($filledCount >= 2 && !$filled_beta);
            @endphp
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-6">
                        <label for="len_a" class="font-s-14 text-blue">{{$lang['8'] ?? 'Length'}} a</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" wire:model.live="len_a" id="len_a" class="input" aria-label="input" @if($disable_a) disabled style="background-color: gainsboro;" @endif/>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="len_b" class="font-s-14 text-blue">{{$lang['8'] ?? 'Length'}} b</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" wire:model.live="len_b" id="len_b" class="input" aria-label="input" @if($disable_b) disabled style="background-color: gainsboro;" @endif/>
                          
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="len_c" class="font-s-14 text-blue">{{$lang['9'] ?? 'Length'}} c</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" wire:model.live="len_c" id="len_c" class="input" aria-label="input" @if($disable_c) disabled style="background-color: gainsboro;" @endif/>
                           
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="angle_alpha" class="font-s-14 text-blue">{{$lang['2'] ?? 'Angle'}} α</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="angle_alpha" id="angle_alpha" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" @if($disable_alpha) disabled style="background-color: gainsboro;" @endif/>
                            <label for="angle_alpha_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="document.getElementById('angle_alpha_unit_dropdown').classList.toggle('hidden')">{{ $angle_alpha_unit }} ▾</label>
                            <div id="angle_alpha_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('angle_alpha_unit', 'deg'); document.getElementById('angle_alpha_unit_dropdown').classList.add('hidden')">degrees (deg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('angle_alpha_unit', 'rad'); document.getElementById('angle_alpha_unit_dropdown').classList.add('hidden')">radians (rad)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12">
                        <label for="angle_beta" class="font-s-14 text-blue">{{$lang['2'] ?? 'Angle'}} β</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="angle_beta" id="angle_beta" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" @if($disable_beta) disabled style="background-color: gainsboro;" @endif/>
                            <label for="angle_beta_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="document.getElementById('angle_beta_unit_dropdown').classList.toggle('hidden')">{{ $angle_beta_unit }} ▾</label>
                            <div id="angle_beta_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('angle_beta_unit', 'deg'); document.getElementById('angle_beta_unit_dropdown').classList.add('hidden')">degrees (deg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('angle_beta_unit', 'rad'); document.getElementById('angle_beta_unit_dropdown').classList.add('hidden')">radians (rad)</p>
                            </div>
                         </div>
                    </div>
                    </div>
                </div>
                <div class="col-span-6 flex justify-center items-center">
                    <div class="w-full">
                        <img src="{{asset('images/trogono_co.png')}}" height="160px" width="220px" alt="trianle details image">
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            @if($detail['method'] == "1" || $detail['method'] == "2" || $detail['method'] == "3" || $detail['method'] == "4" || $detail['method'] == "5" || $detail['method'] == "6" || $detail['method'] == "7" || $detail['method'] == "8" || $detail['method'] == "9" || $detail['method'] == "10" || $detail['method'] == "12" || $detail['method'] == "13" || $detail['method'] == "14" || $detail['method'] == "11")
                                <div class="w-full  ">
                                    <div class="w-full md:w-[80%] lg:w-[80%] mt-2 p-3">
                                        <table class="w-full text-[18px] px-lg-3 p-1 py-2">
                                            @if($detail['method'] == "1" || $detail['method'] == "4" || $detail['method'] == "5" || $detail['method'] == "7" || $detail['method'] == "8" || $detail['method'] == "10" || $detail['method'] == "13" || $detail['method'] == "14" || $detail['method'] == "11")
                                                <tr>
                                                    <td class="py-2 border-b" width="50%"><strong>{{$lang['9'] ?? 'Length'}} c</strong></td>
                                                    <td class="py-2 border-b">{{safe_round($detail['c'],2)}} </td>
                                                </tr>
                                            @endif
                                            @if($detail['method'] == "2" || $detail['method'] == "4" || $detail['method'] == "6" || $detail['method'] == "7" || $detail['method'] == "9" || $detail['method'] == "10" || $detail['method'] == "12" || $detail['method'] == "13" || $detail['method'] == "14")
                                                <tr>
                                                    <td class="py-2 border-b" width="50%"><strong>{{$lang['8'] ?? 'Length'}} b</strong></td>
                                                    <td class="py-2 border-b">{{safe_round($detail['b'],2)}} </td>
                                                </tr>
                                            @endif
                                            @if($detail['method'] == "3" || $detail['method'] == "5" || $detail['method'] == "6" || $detail['method'] == "8" || $detail['method'] == "9" || $detail['method'] == "12" || $detail['method'] == "13" || $detail['method'] == "14" || $detail['method'] == "11")
                                                <tr>
                                                    <td class="py-2 border-b" width="50%"><strong>{{$lang['8'] ?? 'Length'}} a</strong></td>
                                                    <td class="py-2 border-b">{{safe_round($detail['a'],2)}} </td>
                                                </tr>
                                            @endif
                                            @if($detail['method'] != "4" && $detail['method'] != "5" && $detail['method'] != "6" || $detail['method'] == "8" || $detail['method'] == "9" || $detail['method'] == "10" || $detail['method'] == "12" || $detail['method'] == "14" || $detail['method'] == "11")
                                                @php
                                                    $radians = $detail['anglea'];
                                                    $degreesa = safe_round($radians * (180 / pi()), 3);
                                                @endphp
                                                @if($detail['method'] != "13")
                                                    <tr>
                                                        <td class="py-2 border-b" width="50%"><strong>{{$lang['2'] ?? 'Angle'}} α</strong></td>
                                                        <td class="py-2 border-b flex align-items-center" x-data="{ unit: '{{ $angle_alpha_unit === 'deg' ? 'c' : 'rad' }}', val_c: '{{$degreesa}}', val_rad: '{{safe_round($detail['anglea'],4)}}' }"> 
                                                            <span x-text="unit === 'c' ? val_c : val_rad"></span>
                                                            <div class=" py-2 px-2 position-relative">
                                                                <select class="input" x-model="unit">
                                                                    <option value="c" > °</option>
                                                                    <option value="rad" > rad</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                            @if($detail['method'] != "7" && $detail['method'] != "8" && $detail['method'] != "9" || $detail['method'] == "10" || $detail['method'] == "12" || $detail['method'] == "13" || $detail['method'] == "11")
                                                @php
                                                    $radians = $detail['angleb'];
                                                    $degrees = safe_round($radians * (180 / pi()), 3);
                                                @endphp
                                                <tr>
                                                    <td class="py-2 border-b" width="50%"><strong>{{$lang['2'] ?? 'Angle'}} β</strong></td>
                                                    <td class="py-2 border-b flex align-items-center" x-data="{ unit: '{{ $angle_beta_unit === 'deg' ? 'c' : 'rad' }}', val_c: '{{$degrees}}', val_rad: '{{safe_round($detail['angleb'],4)}}' }"> 
                                                        <span x-text="unit === 'c' ? val_c : val_rad"></span>
                                                        <div class=" py-2 px-2 position-relative">
                                                            <select class="input" x-model="unit">
                                                                <option value="c" > °</option>
                                                                <option value="rad" > rad</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                            @isset($detail['height'])
                                            <tr>
                                                <td class="py-2 border-b" width="35%"><strong>{{$lang['ht'] ?? "Height"}}</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['height'],3)}} </td>
                                            </tr>
                                            @endisset
                                            @isset($detail['area'])
                                            <tr>
                                                <td class="py-2 border-b" width="35%"><strong>{{$lang['ar'] ?? "Area"}}</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['area'],3)}}</td>
                                            </tr>
                                            @endisset
                                            @isset($detail['peremter'])
                                            <tr>
                                                <td class="py-2 border-b" width="35%"><strong>{{$lang['per'] ?? "Perimeter"}}</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['peremter'],3)}} </td>
                                            </tr>
                                            @endisset
                                            @isset($detail['R_cap'])
                                            <tr>
                                                <td class="py-2 border-b" width="35%"><strong>{{$lang['cir'] ?? "Circumradius"}}</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['R_cap'],3)}} </td>
                                            </tr>
                                            @endisset
                                            @isset($detail['R_sml'])
                                            <tr>
                                                <td class="py-2 " width="35%"><strong>{{$lang['inr'] ?? "Inradius"}}</strong></td>
                                                <td class="py-2 ">{{safe_round($detail['R_sml'],3)}} </td>
                                            </tr>
                                            @endisset
                                        </table>
                                    </div>
                                </div>
                            @endif
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['3'] ?? 'Steps'}}</strong></p>
                                @if($detail['method'] == "1" || $detail['method'] == "2" || $detail['method'] == "3" || $detail['method'] == "4" || $detail['method'] == "5" || $detail['method'] == "6" || $detail['method'] == "7" || $detail['method'] == "8" || $detail['method'] == "9")
                                    @if($detail['method'] == "2" || $detail['method'] == "4" || $detail['method'] == "6" || $detail['method'] == "7" || $detail['method'] == "9")
                                        <p class="mt-2"><strong>{{$lang['4'] ?? 'Find'}} b:</strong></p>
                                        <p class="mt-2">\( b=\sqrt{(c^2-a^2)} \)</p>
                                        <p class="mt-2">\( b=\sqrt{({{ safe_round($detail['c'],2) }}^2-{{ safe_round($detail['a'],2) }}^2)} \)</p>
                                        <p class="mt-2">\( b=\sqrt{({{ pow(safe_round($detail['c'],2), 2) }}-{{ pow(safe_round($detail['a'],2), 2) }})} \)</p>
                                        <p class="mt-2">\( b={{ safe_round($detail['b'],2) }} \)</p>
                                    @endif
                                    @if ($detail['method'] == "1" || $detail['method'] == "4" || $detail['method'] == "5" || $detail['method'] == "7" || $detail['method'] == "8")
                                        <p class="mt-2"><strong>{{$lang['4'] }} c:</strong></p>
                                        <p class="mt-2">\( c=\sqrt{(a^2+b^2)} \)</p>
                                        <p class="mt-2">\( c=\sqrt{({{ safe_round($detail['a'],2) }}^2+{{ safe_round($detail['b'],2) }}^2)} \)</p>
                                        <p class="mt-2">\( c=\sqrt{({{ pow(safe_round($detail['a'],2), 2) }}+{{ pow(safe_round($detail['b'],2), 2) }})} \)</p>
                                        <p class="mt-2">\( c={{ safe_round($detail['c'],2) }} \)</p>
                                    @endif
                                    @if ($detail['method'] == "3" || $detail['method'] == "5" || $detail['method'] == "6" || $detail['method'] == "8" || $detail['method'] == "9")
                                        <p class="mt-2"><strong>{{$lang['4'] }} a:</strong> </p>
                                        <p class="mt-2">\( a=\sqrt{(c^2-b^2)} \)</p>
                                        <p class="mt-2">\( a=\sqrt{({{ safe_round($detail['c'],2) }}^2-{{ safe_round($detail['b'],2) }}^2)} \)</p>
                                        <p class="mt-2">\( a=\sqrt{({{ pow(safe_round($detail['c'],2), 2) }}-{{ pow(safe_round($detail['b'],2), 2) }})} \)</p>
                                        <p class="mt-2">\( a={{ safe_round($detail['a'],2) }} \)</p>
                                    @endif
                                    @if ($detail['method'] != "4" && $detail['method'] != "5" && $detail['method'] != "6")
                                        <p class="mt-2"><strong>{{$lang['5'] }} α:</strong> </p>
                                        <p class="mt-2">\( \alpha= arctan(\dfrac{a}{b}) \)</p>
                                        <p class="mt-2">\( \alpha= arctan(\dfrac{{{ safe_round($detail['a'],2) }}}{{{ safe_round($detail['b'],2) }}}) \)</p>
                                        <p class="mt-2">\( \alpha= arctan({{ safe_round($detail['a'] / $detail['b'],2) }}) \)</p>
                                        <p class="mt-2">\( \alpha= {{ safe_round($detail['anglea'],3) }} \) rad</p>
                                        <p class="mt-2">\( \alpha= {{$degreesa}} \) °</p>
                                    @endif
                                    @if ($detail['method'] != "7" && $detail['method'] != "8" && $detail['method'] != "9")
                                        <p class="mt-2"><strong>{{$lang['5'] }} β:</strong> </p>
                                        <p class="mt-2">\( \beta= arctan(\dfrac{b}{a}) \)</p>
                                        <p class="mt-2">\( \beta= arctan(\dfrac{{{ safe_round($detail['b'],2) }}}{{{ safe_round($detail['a'],2) }}}) \)</p>
                                        <p class="mt-2">\( \beta= arctan({{ safe_round($detail['b'] / $detail['a'],2) }}) \)</p>
                                        <p class="mt-2">\( \beta= {{ safe_round($detail['angleb'],3) }} \) rad</p>
                                        <p class="mt-2">\( \beta= {{$degrees}} \) °</p>
                                    @endif
                                @endif
                                {{-- @if($detail['method'] != "10" && $detail['method'] != "11" && $detail['method'] != "12" && $detail['method'] != "13" && $detail['method'] != "14")
                                    <p class="mt-2"><strong> Find Are</strong> :</p>
                                    <p class="mt-2">\( area=\dfrac{a*b}{2} \)</p>
                                    <p class="mt-2">\( area=\dfrac{ {{safe_round($detail['a'],2)}} * {{safe_round($detail['b'],2)}} }{2} \)</p>
                                    <p class="mt-2">\( area= {{safe_round($detail['area'],2)}} \)</p>
                                @endif --}}
                                @if ($detail['method'] == "10" || $detail['method'] == "11" || $detail['method'] == "12" || $detail['method'] == "13")
                                    @if ($detail['method'] != "12" && $detail['method'] != "13")
                                        <p class="mt-2"><strong> Find c :</strong></p>
                                        <p class="mt-2">\( c=\sqrt{(a^2+b^2)} \)</p>
                                        <p class="mt-2">\( c=\sqrt{({{ safe_round($detail['a'],2)}}^2+{{ safe_round($detail['b'],2)}}^2)} \)</p>
                                        <p class="mt-2">\( c=\sqrt{({{ pow(safe_round($detail['a'],2), 2)}}+{{ pow(safe_round($detail['b'],2), 2)}})} \)</p>
                                        <p class="mt-2">\( c={{ safe_round($detail['c'],2)}} \)</p>
                                    @endif
                                    @if ($detail['method'] == "10" && $detail['method'] != "13")
                                        <p class="mt-2"><strong> Find b :</strong></p>
                                        <p class="mt-2">\( b=\dfrac{2*area}{a} \)</p>
                                        <p class="mt-2">\( b=\dfrac{2*{{ safe_round($detail['area'],2)}}}{{{ safe_round($detail['a'],2)}}} \)</p>
                                        <p class="mt-2">\( b={{ safe_round($detail['b'],2)}} \)</p>
                                    @endif
                                    @if ($detail['method'] == "11" && $detail['method'] != "13")
                                        <p class="mt-2"><strong> Find a :</strong></p>
                                        <p class="mt-2">\( a=\dfrac{2*area}{b} \)</p>
                                        <p class="mt-2">\( a=\dfrac{2*{{ safe_round($detail['area'],2)}}}{{{ safe_round($detail['b'],2)}}} \)</p>
                                        <p class="mt-2">\( a={{ safe_round($detail['a'],2)}} \)</p>
                                    @endif
                                    @if ($detail['method'] == "12" && $detail['method'] != "13")
                                        <p class="mt-2"><strong> Find a :</strong></p>
                                        <p class="mt-2">\( a=\sqrt{\dfrac{c^2+\sqrt{c^4-16*a^2}}{2}}\)</p>
                                        <p class="mt-2">\( a=\sqrt{\dfrac{ {{ safe_round($detail['c'],2)}}^2+\sqrt{ {{ safe_round($detail['c'],2)}}^4-16*{{ safe_round($detail['a'],2)}}^2}}{2}}\)</p>
                                        <p class="mt-2">\( a=\sqrt{\dfrac{ {{ safe_round($detail['c'],2)}}^2+\sqrt{ {{ safe_round($detail['c'],2)}}^4-16*{{ safe_round($detail['a'],2)}}^2}}{2}}\)</p>
                                        <p class="mt-2">\( a= {{safe_round($detail['a'],2)}}\)</p>
                                        <p class="mt-2"><strong> Find b :</strong></p>
                                        <p class="mt-2">\( b=\sqrt{\dfrac{c^2-\sqrt{c^4-16*a^2}}{2}}\)</p>
                                        <p class="mt-2">\( b=\sqrt{\dfrac{ {{ safe_round($detail['c'],2)}}^2-\sqrt{ {{ safe_round($detail['c'],2)}}^4-16*{{ safe_round($detail['a'],2)}}^2}}{2}}\)</p>
                                        <p class="mt-2">\( b=\sqrt{\dfrac{ {{ safe_round($detail['c'],2)}}^2-\sqrt{ {{ safe_round($detail['c'],2)}}^4-16*{{ safe_round($detail['a'],2)}}^2}}{2}}\)</p>
                                        <p class="mt-2">\( b={{safe_round($detail['b'],2)}}\)</p>
                                    @endif
                                    @if ($detail['method'] != "13")
                                        <p class="mt-2"> <strong>{{$lang['5'] ?? 'Find angle'}} α:</strong></p>
                                        <p class="mt-2">\( \alpha= arctan(\dfrac{a}{b}) \)</p>
                                        <p class="mt-2">\( \alpha= arctan(\dfrac{{{safe_round($detail['a'],2)}}}{{{safe_round($detail['b'],2)}}}) \)</p>
                                        <p class="mt-2">\( \alpha= arctan({{safe_round($detail['a'],2) / safe_round($detail['b'],2)}}) \)</p>
                                        <p class="mt-2">\( \alpha= {{safe_round($detail['anglea'],3)}} \) rad</p>
                                        <p class="mt-2"> <strong>{{$lang['5'] ?? 'Find angle'}} β:</strong></p>
                                        <p class="mt-2">\( \beta= arctan(\dfrac{b}{a}) \)</p>
                                        <p class="mt-2">\( \beta= {{$degrees}} \) °</p>
                
                                        <p class="mt-2">\( \beta= arctan(\dfrac{{{safe_round($detail['b'],2)}}}{{{safe_round($detail['a'],2)}}}) \)</p>
                                        <p class="mt-2">\( \beta= arctan({{safe_round($detail['b'] / $detail['a'],2)}}) \)</p>
                                        <p class="mt-2">\( \beta= {{safe_round($detail['angleb'],3)}} \) rad</p>
                                        <p class="mt-2">\( \beta= {{$degrees}} \) °</p>
                                    @endif
                                @endif
                                @if ($detail['method'] == "13" || $detail['method'] == "14")
                                    <p class="mt-2"> <strong>Find a :</strong></p>
                                    <p class="mt-2">\( a=\sqrt{2*area*tan(α)} \)</p>
                                    <p class="mt-2">\( a=\sqrt{2*{{safe_round($detail['area'],2)}}*tan({{safe_round($detail['anglea'],2)}})} \)</p>
                                    <p class="mt-2">\( a={{safe_round($detail['a'],2)}} \)</p>
                                    <p class="mt-2"><strong> Find b :</strong> </p>
                                    <p class="mt-2">\( b=\sqrt{\dfrac{2*area}{tan(α)}} \)</p>
                                    <p class="mt-2">\( b=\sqrt{\dfrac{2*{{safe_round($detail['area'],2)}}}{tan({{safe_round($detail['anglea'],2)}})}} \)</p>
                                    <p class="mt-2">\( b={{safe_round($detail['b'],2)}} \)</p>
                                    <p class="mt-2"><strong> Find c :</strong> </p>
                                    <p class="mt-2">\( c=\sqrt{(a^2+b^2)} \)</p>
                                    <p class="mt-2">\( c=\sqrt{({{safe_round($detail['a'],2)}}^2+{{safe_round($detail['b'],2)}}^2)} \)</p>
                                    <p class="mt-2">\( c=\sqrt{({{pow(safe_round($detail['a'],2), 2)}}+{{pow(safe_round($detail['b'],2), 2)}})} \)</p>
                                    <p class="mt-2">\( c={{safe_round($detail['c'],3)}} \)</p>
                                    @if ($detail['method'] == "13" && $detail['method'] != "14")
                                        <p class="mt-2"><strong>{{$lang['5'] ?? 'Find angle'}} β : </strong></p>
                                        <p class="mt-2">\( \beta= arctan(\dfrac{b}{a}) \)</p>
                                        <p class="mt-2">\( \beta= arctan(\dfrac{{{safe_round($detail['b'],2)}}}{{{safe_round($detail['a'],2)}}}) \)</p>
                                        <p class="mt-2">\( \beta= arctan({{safe_round($detail['b'] / $detail['a'],2)}}) \)</p>
                                        <p class="mt-2">\( \beta= {{safe_round($detail['angleb'],3)}} \) rad</p>
                                        <p class="mt-2">\( \beta= {{$degrees}} \) °</p>
                
                                    @endif
                                    @if ($detail['method'] == "14" && $detail['method'] != "13")
                                        <p class="mt-2"><strong>{{$lang['5'] ?? 'Find angle'}} α :</strong> </p>
                                        <p class="mt-2">\( \alpha= arctan(\dfrac{a}{b}) \)</p>
                                        <p class="mt-2">\( \alpha= arctan(\dfrac{{{safe_round($detail['a'],2)}}}{{{safe_round($detail['b'],2)}}}) \)</p>
                                        <p class="mt-2">\( \alpha= arctan({{safe_round($detail['a'] / $detail['b'],2)}}) \)</p>
                                        <p class="mt-2">\( \alpha= {{safe_round($detail['anglea'],3)}} \) rad</p>
                                        <p class="mt-2">\( \alpha= {{$degreesa}} \) °</p>
                
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({"SVG": {linebreaks: { automatic: true }} });
    </script>
    <script>
        function MJrerender() {
            if (window.MathJax) {
                MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
            }
        }
    </script>
@endpush

</div>
