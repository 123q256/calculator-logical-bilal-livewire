
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
    [x-cloak] { display: none !important; }
</style>
  <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="operations" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select class="input" aria-label="select" name="operations" id="operations" wire:model.live="operations">
                                <option value="1">{{ $lang['2'] }} x₀</option>
                                <option value="2">{{ $lang['3'] }} r</option>
                                <option value="3">{{ $lang['4'] }} t</option>
                                <option value="4">{{ $lang['5'] }} x(t)</option>
                            </select>
                        </div>
                    </div>

                    @if ($operations !== '1')
                    <div class="col-span-12" id="firstInput">
                        <label for="first" class="label">{{ $lang['2'] }} x₀:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="first" id="first" class="input" wire:model.live="first" aria-label="input" required />
                        </div>
                    </div>
                    @endif

                    @if ($operations !== '2')
                    <div class="col-span-12" id="secondInput">
                        <label for="second" class="label">{{ $lang['3'] }} r:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="second" id="second" class="input" wire:model.live="second" aria-label="input" required />
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                    @endif

                    @if ($operations !== '3')
                    <div class="col-span-12" id="thirdInput">
                        <label for="third" class="label">{{$lang[4]}} t:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="third" id="third" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" required />
                            <button type="button" @click="open = !open" class="absolute text-sm underline right-6 top-4 text-blue font-semibold">
                                {{ $t_unit }} ▾
                            </button>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="$set('t_unit', 'sec'); open = false">{{$lang['6']}} (sec)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="$set('t_unit', 'min'); open = false">{{$lang['7']}} (min)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="$set('t_unit', 'hr'); open = false">{{$lang['8']}} (hr)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="$set('t_unit', 'days'); open = false">{{$lang['9']}}</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="$set('t_unit', 'wks'); open = false">{{$lang['10']}}</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="$set('t_unit', 'mon'); open = false">{{$lang['11']}} (mon)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="$set('t_unit', 'yrs'); open = false">{{$lang['12']}} (yrs)</p>
                            </div>
                         </div>
                    </div>
                    @endif

                    @if ($operations !== '4')
                    <div class="col-span-12" id="fourInput">
                        <label for="four" class="label">{{ $lang['5'] }} x(t):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="four" id="four" class="input" wire:model.live="four" aria-label="input" required />
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-span-6 text-center flex justify-center items-center">
                <p class="text-[20px]">
                    <strong>
                        x(t) = x₀ × (1 +  
                        <span class="quadratic_fraction">
                            <span class="num">r</span>
                            <span>100</span>
                        </span> )<sup class="font-s-14">t</sup>
                    </strong>
                </p>
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
                        <div class="w-full text-center text-[20px]">
                            <p>{{$detail['jawab']}}</p>
                            <p class="my-3">
                                <strong class="bg-[#2845F5] text-white px-3 py-2 text-[32px] rounded-lg text-blue">
                                    {{$detail['final']}}
                                    @if($detail['operations'] === "2")
                                        %
                                    @elseif($detail['operations'] === "3")
                                        {{ $t_unit }}
                                    @endif
                                </strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
