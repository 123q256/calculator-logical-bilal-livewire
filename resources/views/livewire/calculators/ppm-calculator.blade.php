<div>
    <style>
        .tagsUnit { background-color: #2845F5 !important; color: white !important; }
        .tab-inactive { background-color: white; color: #374151; }
        .tab-inactive:hover { background-color: #f3f4f6; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <div class="bg-red-50 text-red-600 p-4 rounded-xl border border-red-100 font-semibold mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $error }}
                </div>
            @endif

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                {{-- Tab Switcher --}}
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 ">
                    <div class="lg:w-1/2 w-full p-1">
                        <button type="button" 
                            wire:click="$set('calculator_name', 'calculator1')"
                            class="w-full py-3 px-4 rounded-lg font-bold transition-all duration-300 {{ $calculator_name == 'calculator1' ? 'tagsUnit shadow-md' : 'tab-inactive' }}">
                            {{ $lang['1'] }}
                        </button>
                    </div>
                    <div class="lg:w-1/2 w-full p-1">
                        <button type="button" 
                            wire:click="$set('calculator_name', 'calculator2')"
                            class="w-full py-3 px-4 rounded-lg font-bold transition-all duration-300 {{ $calculator_name == 'calculator2' ? 'tagsUnit shadow-md' : 'tab-inactive' }}">
                            {{ $lang['2'] }}
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    {{-- Calculator 1: Unit Converter --}}
                    @if($calculator_name == 'calculator1')
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 bg-white p-6  ">
                            <div class="space-y-2">
                                <label class="label font-bold text-gray-700">{!! $lang['3'] !!}:</label>
                                <select wire:model.live="operations" class="input border-gray-300 focus:border-blue-500 ">
                                    <option value="1">{!! $lang['4'] !!}</option>
                                    <option value="2">{!! $lang['5'] !!}</option>
                                    <option value="3">{!! $lang['6'] !!}</option>
                                    <option value="4">PPM</option>
                                    <option value="5">PPB</option>
                                    <option value="6">PPT</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="label font-bold text-gray-700">
                                    @if($operations == '1') {!! $lang['4'] !!}
                                    @elseif($operations == '2') {!! $lang['5'] !!}
                                    @elseif($operations == '3') {!! $lang['6'] !!}
                                    @elseif($operations == '4') PPM
                                    @elseif($operations == '5') PPB
                                    @elseif($operations == '6') PPT
                                    @endif:
                                </label>
                                <div class="relative group">
                                    <input type="number" step="any" wire:model="first" class="input pr-12" placeholder="0.00">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-blue-600 font-bold text-sm">
                                        @if($operations == '2') %
                                        @elseif($operations == '3') ‰
                                        @elseif($operations == '4') ppm
                                        @elseif($operations == '5') ppb
                                        @elseif($operations == '6') ppt
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Calculator 2: Advanced PPM --}}
                    @if($calculator_name == 'calculator2')
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 bg-white p-6 ">
                            <div class="space-y-2">
                                <label class="label font-bold text-gray-700">{!! $lang['7'] !!} (ppm) {!! $lang['8'] !!}:</label>
                                <select wire:model.live="drop1" class="input">
                                    <option value="1">{!! $lang[9] !!}</option>
                                    <option value="2">{!! $lang[10] !!}</option>
                                    <option value="3">{!! $lang[11] !!}</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="label font-bold text-gray-700">Measured in:</label>
                                <select wire:model.live="drop2" class="input">
                                    <option value="1">Air</option>
                                    <option value="2">Water</option>
                                </select>
                            </div>

                            @if($drop1 != '3')
                                <div class="space-y-2">
                                    <label class="label font-bold text-gray-700">{!! $lang['12'] !!}:</label>
                                    <select wire:model.live="drop3" class="input">
                                        <option value="">{!! $lang['13'] !!}</option>
                                        <option value="17.03">Ammonia [NH3]</option>
                                        <option value="39.95">Argon [Ar]</option>
                                        <option value="44.01">Carbon Dioxide [CO2]</option>
                                        <option value="28.01">Carbon Monoxide [CO]</option>
                                        <option value="4.00">Helium [He]</option>
                                        <option value="2.02">Hydrogen [H2]</option>
                                        <option value="34.08">Hydrogen Sulfide [H2S]</option>
                                        <option value="83.80">Krypton [Kr]</option>
                                        <option value="16.04">Methane [CH4]</option>
                                        <option value="20.18">Neon [Ne]</option>
                                        <option value="30.01">Nitric Oxide [NO]</option>
                                        <option value="28.01">Nitrogen [N2]</option>
                                        <option value="46.01">Nitrogen Dioxide [NO2]</option>
                                        <option value="44.01">Nitrous Oxide [N2O]</option>
                                        <option value="32.00">Oxygen [O2]</option>
                                        <option value="48.00">Ozone [O3]</option>
                                        <option value="64.06">Sulfur Dioxide [SO2]</option>
                                        <option value="18.02">Water [H2O]</option>
                                        <option value="131.29">Xenon [Xe]</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="label font-bold text-gray-700">M:</label>
                                    <div class="relative group">
                                        <input type="number" step="any" wire:model="second" class="input pr-16">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-blue-600 font-bold text-sm">g/mol</span>
                                    </div>
                                </div>
                            @endif

                            <div class="space-y-2">
                                <label class="label font-bold text-gray-700">{!! $lang['14'] !!}:</label>
                                <select wire:model.live="drop4" class="input">
                                    <option value="1">{!! $lang['15'] !!} ppm</option>
                                    <option value="2">{!! $lang['15'] !!} mg/m3</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="label font-bold text-gray-700">
                                    {{ $drop4 == '1' ? 'Xppm' : 'Xmg/m3' }}:
                                </label>
                                <div class="relative group">
                                    <input type="number" step="any" wire:model="third" class="input pr-16">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-blue-600 font-bold text-sm">
                                        {{ $drop4 == '1' ? 'ppm' : 'mg/m3' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

                @if ($type == 'calculator')
                    @include('inc.button')
                @elseif ($type == 'widget')
                    @include('inc.widget-button')
                @endif
        </div>

        <hr class="border-gray-200">

        {{-- Result Section --}}
        @if ($detail)
            <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-xl space-y-6 mt-6">
                 <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        @if($detail['type']=="calculator1")
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 mt-5   gap-4">
                                <div class="space-y-2 py-2">
                                    <div class="bg-[#F6FAFC] border rounded px-3 py-2">
                                        <strong>{!! $lang[4] !!} =</strong>
                                        <strong class="text-[#119154] font-s-22">{!! $detail['answer1'] !!}</strong>
                                    </div>
                                </div>
                                <div class="space-y-2 py-2">
                                    <div class="bg-[#F6FAFC] border rounded px-3 py-2">
                                        <strong>{!! $lang[5] !!} =</strong>
                                        <strong class="text-[#119154] font-s-22">{!! $detail['answer2'] !!} <span class="text-[#119154]">(%)</span></strong>
                                    </div>
                                </div>
                                <div class="space-y-2 py-2">
                                    <div class="bg-[#F6FAFC] border rounded px-3 py-2">
                                        <strong>{!! $lang[6] !!} =</strong>
                                        <strong class="text-[#119154] font-s-22">{!! $detail['answer3'] !!} <span class="text-[#119154]">(‰)</span></strong>
                                    </div>
                                </div>
                                <div class="space-y-2 py-2">
                                    <div class="bg-[#F6FAFC] border rounded px-3 py-2">
                                        <strong>PPM =</strong>
                                        <strong class="text-[#119154] font-s-22">{!! $detail['answer4'] !!} <span class="text-[#119154]">(PPM)</span></strong>
                                    </div>
                                </div>
                                <div class="space-y-2 py-2">
                                    <div class="bg-[#F6FAFC] border rounded px-3 py-2">
                                        <strong>PPB =</strong>
                                        <strong class="text-[#119154] font-s-22">{!! $detail['answer5'] !!} <span class="text-[#119154]">(PPB)</span></strong>
                                    </div>
                                </div>
                                <div class="space-y-2 py-2">
                                    <div class="bg-[#F6FAFC] border rounded px-3 py-2">
                                        <strong>PPT =</strong>
                                        <strong class="text-[#119154] font-s-22">{!! $detail['answer6'] !!} <span class="text-[#119154]">(PPT)</span></strong>
                                    </div>
                                </div>
                            </div>
                        @elseif($detail['type']=="calculator2")
                            <p class="text-center text-[20px]"><strong>{!! $lang[16] !!}</strong></p>
                            @if($detail['drop4'] == 1)
                                <p class="text-center"><strong class="text-[#119154] text-[24px]">{!! $detail['jawab2'] !!} <span class="text-[#119154] font-s-20">mg/m3</span></strong></p>
                            @elseif($detail['drop4'] == 2)
                                <p class="text-center"><strong class="text-[#119154] text-[24px]">{!! $detail['jawab2'] !!} <span class="text-[#119154] font-s-20">ppm</span></strong></p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
            </div>
        @endif
    </form>
</div>
