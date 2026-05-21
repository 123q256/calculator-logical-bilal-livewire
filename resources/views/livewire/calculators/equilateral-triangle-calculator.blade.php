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
            <div class="col-span-12" x-data="{ 
                op: @entangle('operations').live,
                get label() {
                    const ops = { 'side': 'a:', 'perimeter': 'p:', 'semiperimeter': 's:', 'area': 'K:', 'altitude': 'h:' };
                    return ops[this.op] || 'K:';
                },
                get placeholder() {
                    const ops = { 'side': '{{$lang[4]}}', 'perimeter': '{{$lang[6]}}', 'semiperimeter': '{{$lang[7]}}', 'area': '{{$lang[5]}}', 'altitude': '{{$lang[8]}}' };
                    return ops[this.op] || '{{$lang[5]}}';
                }
            }">
                <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" id="operations" x-model="op">
                        <option value="side"><?=$lang[2]?> P, s, K, h | <?=$lang[3]?> a</option>
                        <option value="perimeter"><?=$lang[2]?> a, s, K, h | <?=$lang[3]?> P</option>
                        <option value="semiperimeter"><?=$lang[2]?> a, P, K, h | <?=$lang[3]?> s</option>
                        <option value="area"><?=$lang[2]?> a, P, s, h | <?=$lang[3]?> K</option>
                        <option value="altitude"><?=$lang[2]?> a, P, s, K | <?=$lang[3]?> h</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12" x-data="{ open: false }">
                <label for="first" class="font-s-14 text-blue" id="txt" x-text="label">K:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model.live="first" id="first" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" x-bind:placeholder="placeholder" />
                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $unit1 }} ▾</label>
                    <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'cm'); open = false">centimeters (cm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'mm'); open = false">milimeters (mm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'm'); open = false">meters (m)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'km'); open = false">kilometers (km)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'in'); open = false">inches (in)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'yd'); open = false">yards (yd)</p>
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
                    <div class="w-full bg-light-blue p-3 radius-10 mt-3">
                        <div class="w-full">
                            <div class="w-full lg:w-[80%] overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[4] }}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['a'], 3)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[5] }}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['k'], 3)}} {{$detail['unit']}}<sup>2</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[6] }}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['p'], 3)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] }}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['s'], 3)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[8] }}</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['h'], 3)}} {{$detail['unit']}}</td>
                                    </tr>
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
