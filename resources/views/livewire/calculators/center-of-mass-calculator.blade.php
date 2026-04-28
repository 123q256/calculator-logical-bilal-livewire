<div>
    <style>
        .tagsUnit {
            background-color: #2845F5 !important;
            color: white !important;
        }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Dimensions --}}
                    <div class="col-span-6">
                        <label for="dem" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="dem" class="input" id="dem">
                                <option value="1">1D</option>
                                <option value="2">2D</option>
                                <option value="3">3D</option>
                            </select>
                        </div>
                    </div>

                    {{-- Number of Masses --}}
                    <div class="col-span-6">
                        <label for="how" class="font-s-14 text-blue">{{ $lang['2'] }}?</label>
                        <div class="w-full py-2">
                            <select wire:model.live="how" class="input" id="how">
                                @for ($i = 2; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    {{-- Dynamic Mass/Position Inputs --}}
                    @for ($i = 1; $i <= $how; $i++)
                        <div class="col-span-12">
                            <p class="my-2 p-2 tagsUnit rounded-lg"><strong class="text-white">{{ $lang['3'] }} {{ $i }}</strong></p>
                        </div>

                        {{-- Mass --}}
                        <div class="col-span-6">
                            <label for="m{{ $i }}" class="font-s-14 text-blue">m{{ $i }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="text" inputmode="decimal" wire:model.live="m.{{ $i }}" id="m{{ $i }}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('m{{ $i }}_unit')">
                                    {{ $m_unit[$i] }} ▾
                                </label>
                                @if ($openDropdown === "m{$i}_unit")
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['g', 'kg', 'lbs'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('m_unit', {{ $i }}, '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- X Position --}}
                        <div class="col-span-6">
                            <label for="x{{ $i }}" class="font-s-14 text-blue">x{{ $i }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="text" inputmode="decimal" wire:model.live="x.{{ $i }}" id="x{{ $i }}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('x{{ $i }}_unit')">
                                    {{ $x_unit[$i] }} ▾
                                </label>
                                @if ($openDropdown === "x{$i}_unit")
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['cm', 'm', 'in', 'ft', 'yd'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('x_unit', {{ $i }}, '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Y Position (2D/3D) --}}
                        @if ($dem >= 2)
                            <div class="col-span-6">
                                <label for="y{{ $i }}" class="font-s-14 text-blue">y{{ $i }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="text" inputmode="decimal" wire:model.live="y.{{ $i }}" id="y{{ $i }}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('y{{ $i }}_unit')">
                                        {{ $y_unit[$i] }} ▾
                                    </label>
                                    @if ($openDropdown === "y{$i}_unit")
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (['cm', 'm', 'in', 'ft', 'yd'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('y_unit', {{ $i }}, '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Z Position (3D) --}}
                        @if ($dem == 3)
                            <div class="col-span-6">
                                <label for="z{{ $i }}" class="font-s-14 text-blue">z{{ $i }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="text" inputmode="decimal" wire:model.live="z.{{ $i }}" id="z{{ $i }}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('z{{ $i }}_unit')">
                                        {{ $z_unit[$i] }} ▾
                                    </label>
                                    @if ($openDropdown === "z{$i}_unit")
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (['cm', 'm', 'in', 'ft', 'yd'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('z_unit', {{ $i }}, '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endfor

                    {{-- Result Unit --}}
                    <div class="col-span-12">
                        <label for="res_unit" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                        <div class="w-full py-2">
                            <select wire:model.live="res_unit" class="input" id="res_unit">
                                <option value="cm">cm</option>
                                <option value="m">m</option>
                                <option value="in">in</option>
                                <option value="ft">ft</option>
                                <option value="yd">yd</option>
                            </select>
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
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full text-center text-[20px]">
                                <p>{{ $lang[5] }}</p>
                                <div class="flex justify-center">
                                    <p class="my-3">
                                        <strong class="bg-[#2845F5] text-white px-3 py-2 lg:text-[30px] md:text-[30px] text-[18px] rounded-lg">
                                            ({{ round($detail['ansx'], 3) }} {{ $detail['unit'] }}
                                            @if ($dem == 2 || $dem == 3)
                                                , {{ round($detail['ansy'], 3) }} {{ $detail['unit'] }}
                                            @endif
                                            @if ($dem == 3)
                                                , {{ round($detail['ansz'], 3) }} {{ $detail['unit'] }}
                                            @endif
                                            )
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
