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
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="first" class="font-s-14 text-blue">a</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $unit1 }} ▾</label>
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'mm'); open = false">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'cm'); open = false">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'm'); open = false">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'in'); open = false">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit1', 'ft'); open = false">feets (ft)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="second" class="font-s-14 text-blue">b</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $unit2 }} ▾</label>
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'mm'); open = false">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'cm'); open = false">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'm'); open = false">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'in'); open = false">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit2', 'ft'); open = false">feets (ft)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="third" class="font-s-14 text-blue">Y</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $unit3 }} ▾</label>
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit3', 'pi'); open = false">pi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit3', 'deg'); open = false">degree (deg)</p>
                        </div>
                     </div>
                </div>
            </div>
            <div class="col-span-6 text-center flex justify-center items-center">
                <img src="{{ asset('images/sas_image.webp') }}" width="175" height="100%" alt="SAS Triangle" loading="lazy" decoding="async">
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
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>Side (c)</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['c'])}} cm</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang[5]}} ∠A (α)</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['alpha'], 4)}}<sup class="font-s-14">°</sup></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang[5]}} ∠B (β)</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['beta'], 4)}}<sup class="font-s-14">°</sup></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>Area</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['t'])}} cm²</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang[3]}}</strong></td>
                                    <td class="py-2 border-b">{{safe_round($detail['p'])}} cm</td>
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
