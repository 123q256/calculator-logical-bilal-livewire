<div x-data="{ operations: @entangle('operations'), band: @entangle('band') }">
    <style>
        [x-cloak] { display: none !important; }
        .b_text { color: #000; border: 1px solid #ccc; padding: 2px 5px; }
        .w_text { color: #fff; border: 1px solid #ccc; padding: 2px 5px; }
        .black { background-color: #000; }
        .brown { background-color: #964b00; }
        .red { background-color: #ff0000; }
        .orange { background-color: #ffa500; }
        .yellow { background-color: #ffff00; }
        .green { background-color: #9acd32; }
        .blue { background-color: #6495ed; }
        .violet { background-color: #9400d3; }
        .grey { background-color: #a0a0a0; }
        .white { background-color: #fff; }
        .gold { background-color: #cfb53b; }
        .silver { background-color: #c0c0c0; }
        .div_center { width: 60%; margin: 0px auto; position: relative; }
        .color_div { display: inline-block; position: absolute; width: 15px; }
        .color1 { left: 109px; top: 0; height: 101px; }
        .color2 { top: 10px; left: 160px; height: 82px; }
        .color3 { top: 10px; left: 196px; height: 82px; }
        .color4 { top: 10px; left: 230px; height: 82px; }
        .color5 { top: 10px; left: 312px; height: 82px; }
        .color6 { top: 10px; left: 370px; height: 100px; }
        @media (max-width: 610px) { .div_center { width: 100%; } }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2">
                    <!-- Operation Selection -->
                    <div class="col-span-12">
                        <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="operations" id="operations" class="input">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="2">{{ $lang['3'] }}</option>
                                <option value="3">{{ $lang['4'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Color Band Mode (Operation 1) -->
                    <div x-show="operations == '1'" x-cloak class="col-span-12">
                        <div class="w-full">
                            <label for="band" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="band" id="band" class="input">
                                    <option value="3">3 {{ $lang['6'] }}</option>
                                    <option value="4">4 {{ $lang['6'] }}</option>
                                    <option value="5">5 {{ $lang['6'] }}</option>
                                    <option value="6">6 {{ $lang['6'] }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="w-full mt-4 space-y-6">
                            <!-- 1st Band -->
                            <div class="space-y-2">
                                <p class="text-blue font-bold text-sm">1<sup>st</sup> {{ $lang['7'] }}:</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                                    @foreach(['black','brown','red','orange','yellow','green','blue','violet','grey','white'] as $color)
                                        <label class="flex items-center space-x-2 cursor-pointer p-1 rounded hover:bg-gray-50 transition-colors">
                                            <input type="radio" wire:model="first" value="{{ $color }}" class="cursor-pointer">
                                            <span class="{{ in_array($color, ['black','brown','red','violet']) ? 'w_text' : 'b_text' }} {{ $color }} rounded text-[11px] flex-1 text-center py-1">{{ $color }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- 2nd Band -->
                            <div class="space-y-2">
                                <p class="text-blue font-bold text-sm">2<sup>nd</sup> {{ $lang['7'] }}:</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                                    @foreach(['black','brown','red','orange','yellow','green','blue','violet','grey','white'] as $color)
                                        <label class="flex items-center space-x-2 cursor-pointer p-1 rounded hover:bg-gray-50 transition-colors">
                                            <input type="radio" wire:model="second" value="{{ $color }}" class="cursor-pointer">
                                            <span class="{{ in_array($color, ['black','brown','red','violet']) ? 'w_text' : 'b_text' }} {{ $color }} rounded text-[11px] flex-1 text-center py-1">{{ $color }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- 3rd Band (Visible for 5 and 6 bands) -->
                            <div x-show="band == '5' || band == '6'" x-cloak class="space-y-2">
                                <p class="text-blue font-bold text-sm">3<sup>rd</sup> {{ $lang['7'] }}:</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                                    @foreach(['black','brown','red','orange','yellow','green','blue','violet','grey','white'] as $color)
                                        <label class="flex items-center space-x-2 cursor-pointer p-1 rounded hover:bg-gray-50 transition-colors">
                                            <input type="radio" wire:model="third" value="{{ $color }}" class="cursor-pointer">
                                            <span class="{{ in_array($color, ['black','brown','red','violet']) ? 'w_text' : 'b_text' }} {{ $color }} rounded text-[11px] flex-1 text-center py-1">{{ $color }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Multiplier -->
                            <div class="space-y-2">
                                <p class="text-blue font-bold text-sm">{{ $lang['8'] }}:</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                                    @foreach(['black','brown','red','orange','yellow','green','blue','violet','grey','white','gold', 'silver'] as $color)
                                        <label class="flex items-center space-x-2 cursor-pointer p-1 rounded hover:bg-gray-50 transition-colors">
                                            <input type="radio" wire:model="multi" value="{{ $color }}" class="cursor-pointer">
                                            <span class="{{ in_array($color, ['black','brown','red','violet']) ? 'w_text' : 'b_text' }} {{ $color }} rounded text-[11px] flex-1 text-center py-1">{{ $color }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Tolerance (Visible for 4, 5, 6 bands) -->
                            <div x-show="band != '3'" x-cloak class="space-y-2">
                                <p class="text-blue font-bold text-sm">{{ $lang['9'] }}:</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                                    @foreach(['brown','red','orange','yellow','green','blue','violet','grey','gold','silver'] as $color)
                                        <label class="flex items-center space-x-2 cursor-pointer p-1 rounded hover:bg-gray-50 transition-colors">
                                            <input type="radio" wire:model="tolerance" value="{{ $color }}" class="cursor-pointer">
                                            <span class="{{ in_array($color, ['black','brown','red','violet']) ? 'w_text' : 'b_text' }} {{ $color }} rounded text-[11px] flex-1 text-center py-1">{{ $color }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Temperature (Visible for 6 bands) -->
                            <div x-show="band == '6'" x-cloak class="space-y-2">
                                <p class="text-blue font-bold text-sm">{{ $lang['10'] }}:</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                                    @foreach(['black','brown','red','orange','yellow','green','blue','violet','grey'] as $color)
                                        <label class="flex items-center space-x-2 cursor-pointer p-1 rounded hover:bg-gray-50 transition-colors">
                                            <input type="radio" wire:model="temp" value="{{ $color }}" class="cursor-pointer">
                                            <span class="{{ in_array($color, ['black','brown','red','violet']) ? 'w_text' : 'b_text' }} {{ $color }} rounded text-[11px] flex-1 text-center py-1">{{ $color }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- List Mode (Operation 2) -->
                    <div x-show="operations == '2'" x-cloak class="col-span-12">
                        <p class="font-s-16 text-blue">{{ $lang['11'] }}:</p>
                        <div class="py-2">
                            <textarea wire:model="x" class="textareaInput" placeholder="12, 23, 45"></textarea>
                        </div>
                    </div>

                    <!-- Physical Mode (Operation 3) -->
                    <div x-show="operations == '3'" x-cloak class="col-span-12">
                        <div class="grid grid-cols-12 mt-3 gap-4">
                            <div class="col-span-6">
                                <p class="text-blue font-s-14">{{ $lang['12'] }}:</p>
                                <div class="grid grid-cols-12 mt-3 gap-2">
                                    <div class="col-span-6">
                                        <input type="number" step="any" wire:model="length" class="input">
                                    </div>
                                    <div class="col-span-6">
                                        <select wire:model="l_unit" class="input">
                                            <option value="ft">ft</option>
                                            <option value="yd">yd</option>
                                            <option value="in">in</option>
                                            <option value="mile">mile</option>
                                            <option value="m">m</option>
                                            <option value="km">km</option>
                                            <option value="cm">cm</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <p class="text-blue font-s-14">{{ $lang['13'] }}:</p>
                                <div class="grid grid-cols-12 mt-3 gap-2">
                                    <div class="col-span-6">
                                        <input type="number" step="any" wire:model="diameter" class="input">
                                    </div>
                                    <div class="col-span-6">
                                        <select wire:model="d_unit" class="input">
                                            <option value="ft">ft</option>
                                            <option value="yd">yd</option>
                                            <option value="in">in</option>
                                            <option value="mile">mile</option>
                                            <option value="m">m</option>
                                            <option value="km">km</option>
                                            <option value="cm">cm</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <p class="text-blue font-s-14 pb-2">{{ $lang['14'] }}:</p>
                                <select wire:model.live="material" class="input">
                                    <option value="63000000">{{ $lang['15'] }}</option>
                                    <option value="59600000">{{ $lang['16'] }}</option>
                                    <option value="58000000">{{ $lang['17'] }}</option>
                                    <option value="45200000">{{ $lang['18'] }}</option>
                                    <option value="37800000">{{ $lang['19'] }}</option>
                                </select>
                            </div>
                            <div class="col-span-6">
                                <label for="conductivity" class="text-blue font-s-14">{{ $lang['20'] }}:</label>
                                <div class="relative py-2">
                                    <input type="number" step="any" wire:model="conductivity" class="input">
                                    <i class="text-blue input_unit">S/m</i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Calculators -->
                    <div class="col-span-12">
                        <p class="my-2">
                            <span class="font_size18">{{ $lang['21'] }}:</span>
                            <span><a href="{{ asset('ohms-law-calculator/') }}/" target="_blank" rel="noopener">Ohms Law Calculator</a></span>,
                            <span><a href="{{ asset('parallel-resistor-calculator/') }}/" target="_blank" rel="noopener">Parallel Resistor Calculator</a></span>
                        </p>
                    </div>
                </div>
            </div>

            @if ($type_calc == 'calculator')
                @include('inc.button')
            @endif
            @if ($type_calc == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        <hr>

        <!-- Result Section -->
        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type_calc == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full text-center">
                                @if ($operations == "1")
                                    <div class="col-12 text-center">
                                        <div class="div_center overflow-auto">
                                            <img src="{{ asset('images/Resistor.svg') }}" id="im" alt="Resistor Image" width="500px" height="300px">
                                            <div class="color_div color1 {{ $first }}"></div>
                                            <div class="color_div color2 {{ $second }}"></div>
                                            @if ($band == "5" || $band == "6")
                                                <div class="color_div color4 {{ $third }}"></div>
                                            @endif
                                            <div class="color_div color3 {{ $multi }}"></div>                  
                                            @if ($band == "5" || $band == "4" || $band == "6")
                                                <div class="color_div color5 {{ $tolerance }}"></div>
                                            @endif
                                            @if ($band == "6")
                                                <div class="color_div color6 {{ $temp }}"></div>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-[25px] bg-w-auto bg-sku px-3 py-2 d-inline-block my-3"><strong class="text-blue">{{ $detail['answer'] }}</strong></p>
                                @elseif ($operations == "2")
                                    <div class="text-center">
                                        <p class="font-s-20"><strong>{{ $lang['23'] }}</strong></p>
                                        <div class="flex justify-center">
                                            <p class="text-[25px] bg-w-auto bg-[#2845F5] rounded-lg text-white px-3 py-2 d-inline-block my-3"><strong class="text-blue">{{ $detail['answer'] }}</strong></p>
                                        </div>
                                    </div>
                                @elseif ($operations == "3")
                                    <div class="text-center">
                                        <p class="font-s-20"><strong>{{ $lang['24'] }}</strong></p>
                                        <div class="flex justify-center">
                                            <p class="text-[25px] bg-w-auto bg-[#2845F5] rounded-lg text-white px-3 py-2 d-inline-block my-3"><strong class="text-blue">{{ $detail['answer'] }} ohm (Ω)</strong></p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
