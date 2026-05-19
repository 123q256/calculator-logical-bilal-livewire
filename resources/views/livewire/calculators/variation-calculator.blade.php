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
                    <div class="col-span-12">
                        <label for="select" class="label">Y:</label>
                        <div class="w-100 py-2">
                            <select class="input" aria-label="select" wire:model.live="select" id="select">
                                <option value="1">{{$lang['1']}} (X)</option>
                                <option value="2">{{$lang['2']}} (X)</option>
                                <option value="3">{{$lang['3']}} (X)</option>
                                <option value="4">{{$lang['4']}} (X)</option>
                                <option value="5">{{$lang['5']}} (X)</option>
                                <option value="6">{{$lang['6']}} (X)</option>
                                <option value="7">{{$lang['7']}} (X)</option>
                                <option value="8">{{$lang['8']}} (X)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="y" class="label">{{$lang['9']}}  Y = </label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model="y" id="y" class="input" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="x" class="label">{{$lang['10']}}  X = </label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model="x" id="x" class="input" aria-label="input"/>
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
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                    <table class="w-full text-[16px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}} (k)</strong></td>
                                            <td class="py-2 border-b">{{safe_round($detail['ans'])}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">
                                                y = {{safe_round($detail['ans'])}}
                                                @if($select==='1')
                                                    x
                                                @elseif($select==='2')
                                                    / x
                                                @elseif($select==='3')
                                                    x<sup class="font-s-14">2</sup>
                                                @elseif($select==='4')
                                                    x<sup class="font-s-14">3</sup>
                                                @elseif($select==='5')
                                                    √x
                                                @elseif($select==='6')
                                                    / x<sup class="font-s-14">2</sup>
                                                @elseif($select==='7')
                                                    / x<sup class="font-s-14">3</sup>
                                                @else
                                                    / √x
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full  text-[16px] mt-3">
                                    <p><strong>{{$lang[22]}}</strong></p>
                                    @if($select==='1')
                                        <p class="mt-2">Y {{$lang[1]}} (X), y = {{$y}} and x = {{$x}}</p>
                                        <p class="mt-2">{{$lang[13]}}:</p>
                                        <p class="mt-2">y = kx</p>
                                        <p class="mt-2">{{$lang[14]}} x = {{$x}} and y = {{$y}}</p>
                                        <p class="mt-2">{{$y}} = {{$x}}k</p>
                                        <p class="mt-2">k = {{$y}} / {{$x}}</p>
                                        <p class="mt-2">{{$lang[11]}} (k) = {{safe_round($detail['ans'])}}</p>
                                        <p class="mt-2">{{$lang[12]}}: y = {{safe_round($detail['ans'])}}x</p>
                                    @elseif($select==='2')
                                        <p class="mt-2">Y {{$lang[2]}} (X), y = {{$y}} and x = {{$x}}</p>
                                        <p class="mt-2">{{$lang[15]}}:</p>
                                        <p class="mt-2">y = k/x</p>
                                        <p class="mt-2">{{$lang[14]}} x = {{$x}} and y = {{$y}}</p>
                                        <p class="mt-2">{{$y}} = k/{{$x}}</p>
                                        <p class="mt-2">k = {{$y}} * {{$x}}</p>
                                        <p class="mt-2">{{$lang[11]}} (k) = {{safe_round($detail['ans'])}}</p>
                                        <p class="mt-2">{{$lang[12]}}: y = {{safe_round($detail['ans'])}} / x</p>
                                    @elseif($select==='3')
                                        <p class="mt-2">Y {{$lang[3]}} (X), y = {{$y}} and x = {{$x}}</p>
                                        <p class="mt-2">{{$lang[16]}}:</p>
                                        <p class="mt-2">y = kx<sup class="font-s-14">2</sup></p>
                                        <p class="mt-2">{{$lang[14]}} x = {{$x}} and y = {{$y}}</p>
                                        <p class="mt-2">{{$y}} = k({{$x}})<sup class="font-s-14">2</sup></p>
                                        <p class="mt-2">k = {{$y}} / {{ pow((float)$x, 2) }}</p>
                                        <p class="mt-2">{{$lang[11]}} (k) = {{safe_round($detail['ans'])}}</p>
                                        <p class="mt-2">{{$lang[12]}}: y = {{safe_round($detail['ans'])}}x<sup class="font-s-14">2</sup></p>
                                    @elseif($select==='4')
                                        <p class="mt-2">Y {{$lang[4]}} (X), y = {{$y}} and x = {{$x}}</p>
                                        <p class="mt-2">{{$lang[17]}}:</p>
                                        <p class="mt-2">y = kx<sup class="font-s-14">3</sup></p>
                                        <p class="mt-2">{{$lang[14]}} x = {{$x}} and y = {{$y}}</p>
                                        <p class="mt-2">{{$y}} = k({{$x}})<sup class="font-s-14">3</sup></p>
                                        <p class="mt-2">k = {{$y}} / {{ pow((float)$x, 3) }}</p>
                                        <p class="mt-2">{{$lang[11]}} (k) = {{safe_round($detail['ans'])}}</p>
                                        <p class="mt-2">{{$lang[12]}}: y = {{safe_round($detail['ans'])}}x<sup class="font-s-14">3</sup></p>
                                    @elseif($select==='5')
                                        <p class="mt-2">Y {{$lang[5]}} (X), y = {{$y}} and x = {{$x}}</p>
                                        <p class="mt-2">{{$lang[18]}}:</p>
                                        <p class="mt-2">y = k√x</p>
                                        <p class="mt-2">{{$lang[14]}} x = {{$x}} and y = {{$y}}</p>
                                        <p class="mt-2">{{$y}} = k√({{$x}})</p>
                                        <p class="mt-2">k = {{$y}} / {{ pow((float)$x, 1/2) }}</p>
                                        <p class="mt-2">{{$lang[11]}} (k) = {{safe_round($detail['ans'])}}</p>
                                        <p class="mt-2">{{$lang[12]}}: y = {{safe_round($detail['ans'])}}√x</p>
                                    @elseif($select==='6')
                                        <p class="mt-2">Y {{$lang[6]}} (X), y = {{$y}} and x = {{$x}}</p>
                                        <p class="mt-2">{{$lang[19]}}:</p>
                                        <p class="mt-2">y = k / x<sup class="font-s-14">2</sup></p>
                                        <p class="mt-2">{{$lang[14]}} x = {{$x}} and y = {{$y}}</p>
                                        <p class="mt-2">{{$y}} = k / ({{$x}})<sup class="font-s-14">2</sup></p>
                                        <p class="mt-2">k = {{$y}} * {{ pow((float)$x, 2) }}</p>
                                        <p class="mt-2">{{$lang[11]}} (k) = {{safe_round($detail['ans'])}}</p>
                                        <p class="mt-2">{{$lang[12]}}: y = {{safe_round($detail['ans'])}} / x<sup class="font-s-14">2</sup></p>
                                    @elseif($select==='7')
                                        <p class="mt-2">Y {{$lang[7]}} (X), y = {{$y}} and x = {{$x}}</p>
                                        <p class="mt-2">{{$lang[20]}}:</p>
                                        <p class="mt-2">y = k / x<sup class="font-s-14">3</sup></p>
                                        <p class="mt-2">{{$lang[14]}} x = {{$x}} and y = {{$y}}</p>
                                        <p class="mt-2">{{$y}} = k / ({{$x}})<sup class="font-s-14">3</sup></p>
                                        <p class="mt-2">k = {{$y.' * '.pow((float)$x, 3)}}</p>
                                        <p class="mt-2">{{$lang[11]}} (k) = {{safe_round($detail['ans'])}}</p>
                                        <p class="mt-2">{{$lang[12]}}: y = {{safe_round($detail['ans'])}} / x<sup class="font-s-14">3</sup></p>
                                    @else
                                        <p class="mt-2">Y {{$lang[8]}} (X), y = {{$y}} and x = {{$x}}</p>
                                        <p class="mt-2">{{$lang[21]}}:</p>
                                        <p class="mt-2">y = k / √x</p>
                                        <p class="mt-2">{{$lang[14]}} x = {{$x}} and y = {{$y}}</p>
                                        <p class="mt-2">{{$y}} = k / √({{$x}})</p>
                                        <p class="mt-2">k = {{$y.' * '.pow((float)$x, 1/2)}}</p>
                                        <p class="mt-2">{{$lang[11]}} (k) = {{safe_round($detail['ans'])}}</p>
                                        <p class="mt-2">{{$lang[12]}}: y = {{safe_round($detail['ans'])}} / √x</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
