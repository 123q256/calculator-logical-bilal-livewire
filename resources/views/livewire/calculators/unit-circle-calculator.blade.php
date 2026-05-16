<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    {{-- Angle Input with Custom Dropdown --}}
                    <div class="col-span-12" x-data="{ open: false }">
                        <label for="angle" class="font-s-14 text-blue">{{ $lang['1'] }} (θ)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" step="any" wire:model.live="angle" id="angle" 
                                   class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" 
                                   placeholder="00" aria-label="input" />
                            
                            {{-- Dropdown Trigger --}}
                            <label for="angle_unit" @click="open = !open" 
                                   class="absolute cursor-pointer text-sm underline right-6 top-4 select-none">
                                @if($angle_unit === 'deg') deg
                                @elseif($angle_unit === 'rad') rad
                                @else pirad
                                @endif ▾
                            </label>

                            {{-- Dropdown Menu --}}
                            <div x-show="open" @click.away="open = false" x-cloak
                                 class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg overflow-hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm {{ $angle_unit === 'deg' ? 'bg-blue-50 text-blue-600 font-bold' : '' }}" 
                                   @click="$wire.set('angle_unit', 'deg'); open = false">degrees (deg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm {{ $angle_unit === 'rad' ? 'bg-blue-50 text-blue-600 font-bold' : '' }}" 
                                   @click="$wire.set('angle_unit', 'rad'); open = false">radians (rad)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm {{ $angle_unit === 'pirad' ? 'bg-blue-50 text-blue-600 font-bold' : '' }}" 
                                   @click="$wire.set('angle_unit', 'pirad'); open = false">* π rad (pirad)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Image --}}
                    <div class="col-span-12 flex justify-center text-center">
                        <img src="{{ asset('images/unit-circle.webp') }}" height="250px" width="250px" alt="Unit Circle Diagram" style="object-fit: none;" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @isset($detail)
        <hr>
        <div id="result-section" wire:key="result-{{ count($detail) }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full lg:w-[80%] overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    @php
                                        $deg = ($angle_unit === 'deg') ? '°' : (($angle_unit === 'pirad') ? ' * π' : ' rad');
                                    @endphp
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>sin({{ $angle }}{{ $deg }})</strong></td>
                                        <td class="py-2 border-b font-bold">{{ $detail['sin'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>cos({{ $angle }}{{ $deg }})</strong></td>
                                        <td class="py-2 border-b font-bold">{{ $detail['cos'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>tan({{ $angle }}{{ $deg }})</strong></td>
                                        <td class="py-2 border-b font-bold">
                                            @if(abs($detail['tan']) > 1e10) Undefined @else {{ $detail['tan'] }} @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    <style>
        [x-cloak] { display: none !important; }
    </style>
</div>
