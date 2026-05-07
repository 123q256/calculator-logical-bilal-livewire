<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 mt-3 gap-8">
                    <div class="space-y-4">
                        {{-- Bike For --}}
                        <div>
                            <label for="bike_for" class="font-s-14 text-blue one_text">{{ $lang['1'] }}</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="bike_for" id="bike_for" class="input">
                                    <option value="adult">{{ $lang[33] }}</option>
                                    <option value="kids">{{ $lang[34] }}</option>
                                </select>
                            </div>
                        </div>

                        {{-- Adults Section --}}
                        @if($bike_for === 'adult')
                            <div>
                                <label for="bike_type" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                                <select wire:model.live="bike_type" id="bike_type" class="input my-2">
                                    <option value="road">{{ $lang[3] }}</option>
                                    <option value="city">{{ $lang[4] }}</option>
                                    <option value="hybrid">{{ $lang[5] }}</option>
                                    <option value="trekking">{{ $lang[6] }}</option>
                                    <option value="mountain">{{ $lang[7] }}</option>
                                </select>
                            </div>
                            
                            {{-- Height with absolute unit dropdown --}}
                            <div>
                                <label for="hight" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                                <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : 'z-10'">
                                    <input type="number" step="any" wire:model.live="hight" id="hight" class="input pr-20" />
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                        <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                            {{ $hight_unit }} ▾
                                        </button>
                                        <div x-show="open" x-cloak @click.away="open = false" 
                                             class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[80px] overflow-hidden">
                                            @foreach(['cm', 'mm', 'in', 'ft'] as $u)
                                                <div @click="$wire.set('hight_unit', '{{ $u }}'); open = false" 
                                                     class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                                    {{ $u }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Inseam Length with absolute unit dropdown --}}
                            <div>
                                <label for="inseam_length" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                                <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-40' : 'z-0'">
                                    <input type="number" step="any" wire:model.live="inseam_length" id="inseam_length" class="input pr-20" />
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                        <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                            {{ $inseam_length_unit }} ▾
                                        </button>
                                        <div x-show="open" x-cloak @click.away="open = false" 
                                             class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[80px] overflow-hidden">
                                            @foreach(['cm', 'mm', 'in', 'ft'] as $u)
                                                <div @click="$wire.set('inseam_length_unit', '{{ $u }}'); open = false" 
                                                     class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                                    {{ $u }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Kids Section --}}
                            <div>
                                <label for="kids_age" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                                <div class="py-2">
                                    <select wire:model.live="kids_age" id="kids_age" class="input">
                                        <option value="2-3">2-3 {{ $lang[9] }} (86-102 cm)</option>
                                        <option value="2-4">2-4 {{ $lang[9] }} (94-109 cm)</option>
                                        <option value="4-6">4-6 {{ $lang[9] }} (109-122 cm)</option>
                                        <option value="5-8">5-8 {{ $lang[9] }} (114-130 cm)</option>
                                        <option value="8-11">8-11 {{ $lang[9] }} (122-135 cm)</option>
                                        <option value="11+">11+ {{ $lang[9] }} (135-145 cm)</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col items-center justify-center space-y-4">
                        @php
                            $imgName = 'City.webp';
                            if ($bike_for === 'kids') {
                                $imgName = 'Child.webp';
                            } else {
                                $bikeImgs = [
                                    'road' => 'Road.webp',
                                    'city' => 'City.webp',
                                    'hybrid' => 'Hybrid_n_Fitness.webp',
                                    'trekking' => 'Trekking.webp',
                                    'mountain' => 'Mountain.webp'
                                ];
                                $imgName = $bikeImgs[$bike_type] ?? 'City.webp';
                            }
                        @endphp
                        <img src="{{ asset('images/bike-size/' . $imgName) }}" alt="bike" class="max-width" style="max-width: 250px; height: auto;">
                        
                        @if($bike_for === 'adult')
                            <img src="{{ asset('images/bike-size/hight-inseam-new.png') }}" alt="bike" class="max-width" style="max-width: 250px; height: auto;">
                        @endif
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="space-y-6">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="space-y-4">
                        <p><strong class="text-blue text-xl">{{ $lang[12] }}</strong></p>
                        <p class="capitalize font-bold text-lg text-blue">{{ $bike_for }}</p>

                        @if($bike_for === 'kids')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-[#F6FAFC] border rounded-lg p-4">
                                    <p class="font-bold mb-1">{{ $lang[13] }}</p>
                                    <p><span class="text-2xl text-green-600 font-bold">{{ $detail['kids_age'] }}</span> <span class="text-blue">{{ $lang[14] }}</span></p>
                                </div>
                                <div class="bg-[#F6FAFC] border rounded-lg p-4">
                                    <p class="font-bold mb-1">{{ $lang[15] }}</p>
                                    <p><span class="text-2xl text-green-600 font-bold">{{ $detail['hight'] }}</span> <span class="text-blue">cm</span></p>
                                </div>
                            </div>
                        @else
                            <div class="space-y-4">
                                <p class="font-bold text-blue">{{ $lang[16] }}</p>
                                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                    @foreach(['mm' => 'milimeter', 'cm' => 'centimeter', 'in' => 'inch', 'ft' => 'foot'] as $unit => $label)
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3">
                                            <p><span class="text-xl text-green-600 font-bold">{{ $detail['hight_'.$unit] }}</span> <span class="text-sm text-blue">{{ $label }}</span></p>
                                        </div>
                                    @endforeach
                                </div>

                                <p class="font-bold text-blue">{{ $lang[17] }}</p>
                                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                    @foreach(['mm' => 'milimeter', 'cm' => 'centimeter', 'in' => 'inch', 'ft' => 'foot'] as $unit => $label)
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3">
                                            <p><span class="text-xl text-green-600 font-bold">{{ $detail['inseam_'.$unit] }}</span> <span class="text-sm text-blue">{{ $label }}</span></p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="border-t pt-6 mt-6">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                <div class="md:col-span-8 space-y-4">
                                    <p class="text-xl font-bold text-blue">
                                        @if($bike_for == 'kids')
                                            {{ $lang[18] }}
                                        @else
                                            {{ ucfirst($bike_type) }} {{ $lang[19] }}
                                        @endif
                                    </p>
                                    <p class="text-gray-700">
                                        {{ ($bike_for == 'kids') ? "Kids" : ucfirst($bike_type) }} {{ $lang[20] }}
                                    </p>
                                    @if($bike_for == 'kids')
                                        <strong>{{ $lang[21] }}</strong>
                                        <p>{{ $lang[22] }}</p>
                                    @else
                                        <strong>{{ $lang[24] }}</strong>
                                        <p>{{ $lang[25] }}</p>
                                    @endif
                                </div>
                                <div class="md:col-span-4 flex justify-center items-center">
                                    @if($bike_for == 'kids')
                                        <img src="{{ asset('images/bike-size/Child.webp') }}" class="max-w-full h-auto rounded" style="max-height: 150px;">
                                    @else
                                        <img src="{{ asset('images/bike-size/frame-new.webp') }}" class="max-w-full h-auto rounded" style="max-height: 150px;">
                                    @endif
                                </div>
                            </div>

                            <div class="mt-6">
                                <p class="font-bold text-blue mb-4">{{ ($bike_for == 'kids') ? $lang[23] : $lang[26] }}</p>
                                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                    @php $keyPrefix = ($bike_for == 'kids') ? 'wheel_' : 'frame_'; @endphp
                                    @foreach(['mm' => 'milimeter', 'cm' => 'centimeter', 'in' => 'inch', 'ft' => 'foot'] as $unit => $label)
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3 text-center">
                                            <p><span class="text-xl text-green-600 font-bold">{{ $detail[$keyPrefix.$unit] }}</span></p>
                                            <p class="text-xs text-blue uppercase">{{ $label }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="border-t pt-6 mt-6">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                <div class="md:col-span-8 space-y-4">
                                    <p class="text-xl font-bold text-blue">{{ $lang[27] }}</p>
                                    <p class="text-gray-700">{{ $lang[28] }}</p>
                                    <strong class="text-blue">{{ $lang[29] }}</strong>
                                    @if($bike_for == 'kids')
                                        <p>{{ $lang[30] }}</p>
                                    @endif
                                </div>
                                <div class="md:col-span-4 flex justify-center items-center">
                                    <img src="{{ asset('images/bike-size/crank-updated.webp') }}" class="max-w-full h-auto rounded" style="max-height: 150px;">
                                </div>
                            </div>

                            @if($bike_for == 'adult')
                                <div class="mt-6 space-y-6">
                                    <div>
                                        <p class="font-bold text-blue mb-2">{{ $lang[31] }} (L)</p>
                                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                            @foreach(['mm' => 'milimeter', 'cm' => 'centimeter', 'in' => 'inch', 'ft' => 'foot'] as $unit => $label)
                                                <div class="bg-[#F6FAFC] border rounded-lg p-3 text-center">
                                                    <p><span class="text-xl text-green-600 font-bold">{{ $detail['crank_'.$unit] }}</span></p>
                                                    <p class="text-xs text-blue uppercase">{{ $label }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-bold text-blue mb-2">{{ $lang[32] }} (D)</p>
                                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                            @foreach(['mm' => 'milimeter', 'cm' => 'centimeter', 'in' => 'inch', 'ft' => 'foot'] as $unit => $label)
                                                <div class="bg-[#F6FAFC] border rounded-lg p-3 text-center">
                                                    <p><span class="text-xl text-green-600 font-bold">{{ $detail['crank_dia_'.$unit] }}</span></p>
                                                    <p class="text-xs text-blue uppercase">{{ $label }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
