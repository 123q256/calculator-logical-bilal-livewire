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
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="main" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2">
                            <select class="input" aria-label="select" wire:model.live="selection" id="main">
                                <option value="1">{{$lang['2']}} (A)</option>
                                <option value="2">{{$lang['3']}} (B)</option>
                                <option value="3">{{$lang['4']}} ((A+B))</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="a" class="font-s-14 text-blue" id="changeText">
                            @if ($selection == '2')
                                {{ $lang[3] }} (B):
                            @elseif ($selection == '3')
                                {{ $lang[4] }} (A+B):
                            @else
                                {{ $lang[2] }} (A):
                            @endif
                        </label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="a" id="a" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click.stop="open = !open">
                                {{ $units }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-transition style="display: none;">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'mm')">milimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'km')">kilometers (km)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'dm')">decimetre (dm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'ft')">feets (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'yd')">yards (yd)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'mi')">miles (mi)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="open = false; $wire.set('units', 'nmi')">nautical mile (nmi)</p>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['2']}} (A)</strong></td>
                                            <td class="py-2 border-b">{{ safe_round($detail['longer_section'], 3) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['3']}} (B)</strong></td>
                                            <td class="py-2 border-b">{{ safe_round($detail['shorter_section'], 3) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}} (A+B)</strong></td>
                                            <td class="py-2 border-b">{{ safe_round($detail['sum'], 3) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>φ = A/B = (A+B)/A</strong></td>
                                            <td class="py-2 border-b">{{ safe_round($detail['value'], 3) }}</td>
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
