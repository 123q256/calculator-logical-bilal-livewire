<div>
    <style>
        .fractionUpDown {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            font-size: .9em;
        }
        .fractionUpDown .num {
            top: 0;
            padding: 0 .3rem;
            display: block;
            white-space: nowrap;
            border-bottom: 1px solid currentColor;
        }
        .visually-hidden {
            width: 1px;
            height: 1px;
            margin: -1px;
            padding: 0;
            border: 0;
            position: absolute;
            clip: rect(0 0 0 0);
            overflow: hidden;
        }
        .fractionUpDown .den {
            line-height: 15px;
            display: block;
            width: 100%;
            white-space: nowrap;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
             <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 gap-4">
                {{-- IBO Speed --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="first" class="label">{{ $lang['1'] ?? 'IBO Speed' }}</label>
                    <div class="relative">
                        <input type="number" step="any" wire:model.live="first" id="first" class="input" placeholder="300" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('units1')">
                            {{ $units1 }} ▾
                        </label>
                        @if ($openDropdown === 'units1')
                            <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                @foreach (['m/s', 'km/h', 'ft/s', 'mph', 'knots'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units1', '{{ $u }}')">{{ $u }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Draw Length --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="second" class="label">{{ $lang['2'] ?? 'Draw Length' }}</label>
                    <div class="relative">
                        <input type="number" step="any" wire:model.live="second" id="second" class="input" placeholder="29" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('units2')">
                            {{ $units2 }} ▾
                        </label>
                        @if ($openDropdown === 'units2')
                            <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                @foreach (['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi', 'nmi'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units2', '{{ $u }}')">{{ $u }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Draw Weight --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="third" class="label">{{ $lang['3'] ?? 'Draw Weight' }}</label>
                    <div class="relative">
                        <input type="number" step="any" wire:model.live="third" id="third" class="input" placeholder="70" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('units3')">
                            {{ $units3 }} ▾
                        </label>
                        @if ($openDropdown === 'units3')
                            <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                @foreach (['g', 'kg', 'gr', 'oz', 'lb', 'stone'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units3', '{{ $u }}')">{{ $u }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Arrow Weight --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="four" class="label">{{ $lang['4'] ?? 'Total Arrow Weight' }}</label>
                    <div class="relative">
                        <input type="number" step="any" wire:model.live="four" id="four" class="input" placeholder="350" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('units4')">
                            {{ $units4 }} ▾
                        </label>
                        @if ($openDropdown === 'units4')
                            <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                @foreach (['mg', 'g', 'dag', 'kg', 'gr', 'dr', 'oz', 'lb', 'stone'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units4', '{{ $u }}')">{{ $u }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Added Weight on String --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="five" class="label">{{ $lang['5'] ?? 'Added Weight on String' }}</label>
                    <div class="relative">
                        <input type="number" step="any" wire:model.live="five" id="five" class="input" placeholder="0" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('units5')">
                            {{ $units5 }} ▾
                        </label>
                        @if ($openDropdown === 'units5')
                            <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto">
                                @foreach (['mg', 'g', 'dag', 'kg', 'gr', 'dr', 'oz', 'lb', 'stone'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units5', '{{ $u }}')">{{ $u }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
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

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
               <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                          <table class="w-full font-s-18">
                             <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] }} </strong></td>
                                 <td class="py-2 border-b"> {{ round($detail['speed'], 3) }} (ft/s)</td>
                             </tr>
                             <tr>
                              <td class="py-2 border-b" width="50%"><strong>{{ $lang[8] }} </strong></td>
                               <td class="py-2 border-b"> {{ round($detail['momentum'], 6) }}  (Ns)</td>
                           </tr>
                           <tr>
                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[9] }} </strong></td>
                             <td class="py-2 border-b"> {{ round($detail['k_energy'], 5) }} (J)</td>
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
