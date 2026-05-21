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
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                if (!isset($detail)) {
                    $_POST['find'] = "sin";
                }
            @endphp
            <div class="col-span-12">
                <label for="find" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Select Trignometric Function' }}:</label>
                <div class="w-100 py-2">
                    <select wire:model.live="find" class="input" aria-label="select" id="find">
                        <option value="All">All</option>
                        <option value="sin">sin(x)</option>
                        <option value="cos">cos(x)</option>
                        <option value="tan">tan(x)</option>
                        <option value="cot">cot(x)</option>
                        <option value="sec">sec(x)</option>
                        <option value="csc">csc(x)</option>
                        <option value="arcsin">arcsin(x)</option>
                        <option value="arccos">arccos(x)</option>
                        <option value="arctan">arctan(x)</option>
                        <option value="arccsc">arccsc(x)</option>
                        <option value="arcsec">arcsec(x)</option>
                        <option value="arccot">arccot(x)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="angle" class="font-s-14 text-blue">{{$lang[2] ?? 'Enter Angle'}}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model.live="angle" id="angle" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                    <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="document.getElementById('angle_unit_dropdown').classList.toggle('hidden')">{{ $angle_unit }} ▾</label>
                    <div id="angle_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('angle_unit', 'deg'); document.getElementById('angle_unit_dropdown').classList.add('hidden')">degrees (degs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('angle_unit', 'rad'); document.getElementById('angle_unit_dropdown').classList.add('hidden')">radians (rad)</p>
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    @if($detail['method'] == "1")
                                        @if($detail['angle_unit'] == "deg")
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $detail['find'] }} ({{$detail['angle']}}°) =</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['ans1'], 5)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>({{$detail['angle']}}°) =</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['ans2'], 5)}} (rad)</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $detail['find'] }} ({{$detail['angle']}}) =</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['ans1'], 5)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>({{$detail['angle']}} rad) =</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['ans2'], 5)}}°</td>
                                            </tr>
                                        @endif
                                    @elseif($detail['method'] == "2")
                                        @if($detail['angle_unit'] == "deg")
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>sin ({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['sin'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>cos ({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['cos'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>tan ({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['tan'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>cot ({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['cot'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>sec ({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['sec'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>csc ({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['csc'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arcsin ({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['asin'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arccos ({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['atan'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arctan ({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['acos'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arccot ({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['acot'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arcsec ({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['asec'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arccsc ({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['acsc'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>({{safe_round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['fns'], 5)}} (rad)</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>sin ({{safe_round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['sin'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>cos ({{safe_round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['cos'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>tan ({{safe_round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['tan'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>cot ({{safe_round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['cot'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>sec ({{safe_round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['sec'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>csc ({{safe_round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['csc'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arcsin ({{safe_round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['asin'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arccos ({{safe_round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['atan'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arctan ({{safe_round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['acos'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arccot ({{safe_round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['acot'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arcsec ({{safe_round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['asec'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arccsc ({{safe_round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['acsc'])}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>({{safe_round($detail['angle'], 5)}}) rad</strong></td>
                                                <td class="py-2 border-b">{{safe_round($detail['fns'], 5)}}°</td>
                                            </tr>
                
                                        @endif
                                    @elseif($detail['method'] == "3")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$detail['find']}} ({{$detail['angle']}})</strong></td>
                                            <td class="py-2 border-b">{{$detail['deg']}}°</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$detail['find']}} ({{$detail['angle']}})</strong></td>
                                            <td class="py-2 border-b">{{$detail['rad']}} (rad)</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            @isset($detail['naam'])
                                <div class="w-full mt-2">
                                    <div class="w-full md:w-[60%] lg:w-[60%]">
                                        <img src="{{ asset('images/'.$detail['naam'].'.webp') }}" width="100%" height="100%" alt="{{$detail['naam']}}" loading="lazy" decoding="async">
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
</div>
