<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-2 md:gap-4 lg:gap-4">
                    {{-- MAP --}}
                    <div class="px-2">
                        <label for="map" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="map" id="map" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none py-2">
                                    {{ $map_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('map_unit', 'mmHg'); open = false">mmHg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('map_unit', 'cmH2O'); open = false">cmH2O</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('map_unit', 'kPa'); open = false">kPa</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('map_unit', 'atm'); open = false">atm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('map_unit', 'psi'); open = false">psi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CVP --}}
                    <div class="px-2">
                        <label for="cvp" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="cvp" id="cvp" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none py-2">
                                    {{ $cvp_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('cvp_unit', 'mmHg'); open = false">mmHg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('cvp_unit', 'cmH2O'); open = false">cmH2O</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('cvp_unit', 'kPa'); open = false">kPa</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('cvp_unit', 'atm'); open = false">atm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('cvp_unit', 'psi'); open = false">psi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Cardiac Output --}}
                    <div class="px-2">
                        <label for="co" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="co" id="co" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none py-2">
                                    {{ $co_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('co_unit', 'L/min'); open = false">L/min</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('co_unit', 'mL/min'); open = false">mL/min</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @if ($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-5">
                        <div class="col-12 text-center">
                            <p><strong>{{ $lang['4'] }} (SVR)</strong></p>
                            <p class="mt-2">
                                <strong class="text-[#119154] lg:text-[32px] md:text-[32px] text-[27px]">{{ number_format($detail['svr'], 2) }}</strong>
                                <strong class="text-[#119154] lg:text-[20px] md:text-[20px] text-[19px]">(dynes-sec/cm5)</strong>
                            </p>
                            <p class="mt-4 text-gray-700">Normal range lies between 700 and 1600 dynes-sec/cm5.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
