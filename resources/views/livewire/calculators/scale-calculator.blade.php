<div>
    <style>
        @media (min-width: 992px) {
            .font-lg-14 { font-size: 14px; }
        }
        .velocitytab .tagsUnit {
            border-bottom: 3px solid var(--light-blue);
        }
        .velocitytab .tagsUnit strong {
            color: var(--light-blue);
        }
        .velocitytab p {
            position: relative;
            top: 2px;
        }
        [x-cloak] { display: none !important; }
        
        . {
            max-height: 250px;
            overflow: auto;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            padding-left: 5px;
        }
        
        /* Matching the user's preferred input style */
        .simple-input {
            border: 1px solid #d1d5db;
            padding: 0.5rem;
            border-radius: 0.5rem;
            width: 100%;
            outline: none;
        }
        .simple-input:focus {
            ring: 2px;
            ring-color: #3b82f6;
        }
        .unit-label-abs {
            position: absolute;
            cursor: pointer;
            font-size: 0.875rem;
            text-decoration: underline;
            right: 1.5rem;
            top: 1rem;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[80%] w-full">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 velocitytab">
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div wire:click="$set('choice', '1')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover:bg-blue-500 hover:text-white {{ $choice == '1' ? 'tagsUnit' : '' }}">
                            <strong>{{ $lang['6'] }}</strong>
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div wire:click="$set('choice', '2')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover:bg-blue-500 hover:text-white {{ $choice == '2' ? 'tagsUnit' : '' }}">
                            <strong>{{ $lang['7'] }}</strong>
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div wire:click="$set('choice', '3')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover:bg-blue-500 hover:text-white {{ $choice == '3' ? 'tagsUnit' : '' }}">
                            <strong>{{ $lang['8'] }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4">
                    
                    @if($choice == '1')
                        {{-- Scale Factor Mode --}}
                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="scaled_length" class="font-s-14 text-blue">{{ $lang['7'] }}</label>
                            <div class="relative w-full" x-data="{ open: false }">
                                <input type="number" wire:model="scaled_length" id="scaled_length" step="any" class="simple-input" />
                                <label @click="open = !open" class="unit-label-abs">{{ $scaled_length_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 " x-cloak>
                                    @foreach(['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('scaled_length_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="real_length" class="font-s-14 text-blue">{{ $lang['8'] }}</label>
                            <div class="relative w-full" x-data="{ open: false }">
                                <input type="number" wire:model="real_length" id="real_length" step="any" class="simple-input" />
                                <label @click="open = !open" class="unit-label-abs">{{ $real_length_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 " x-cloak>
                                    @foreach(['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('real_length_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Conversion Mode (Scale Up or Down) --}}
                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                            <div class="flex items-center gap-2">
                                <input type="number" step="any" wire:model="y1" class="simple-input" placeholder="00" />
                                <span class="font-bold">:</span>
                                <input type="number" step="any" wire:model="y2" class="simple-input" placeholder="00" />
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="real_length_conv" class="font-s-14 text-blue">
                                {{ $choice == '2' ? $lang['8'] : $lang['7'] }}
                            </label>
                            <div class="relative w-full" x-data="{ open: false }">
                                <input type="number" wire:model="real_length" id="real_length_conv" step="any" class="simple-input" />
                                <label @click="open = !open" class="unit-label-abs">{{ $real_length_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 " x-cloak>
                                    @foreach(['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('real_length_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        <hr>

        @if($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3 text-center">
                        @if($choice == '1')
                            <p class="text-xl text-blue font-semibold">{{ $lang[6] }}</p>
                            <div class="flex justify-center mt-3">
                                <div class="bg-[#2845F5] text-white px-6 py-4 rounded-xl text-3xl font-bold">
                                    {{ $detail['v5'] }}
                                </div>
                            </div>
                        @else
                            <p class="text-xl text-blue font-semibold">{{ $choice == '2' ? $lang[7] : $lang[8] }}</p>
                            <div class="flex justify-center mt-3">
                                <div class="bg-[#2845F5] text-white px-6 py-4 rounded-xl text-3xl font-bold flex items-baseline gap-2">
                                    {{ round($detail['answer'], 4) }}
                                    <span class="text-lg font-normal">{{ $real_length_unit }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </form>
</div>
