<div>
<form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 lg:col-span-6 md:col-span-6 space-y-4">
                <div class="col-span-12">
                    <label for="shape" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Select Shape' }}</label>
                    <div class="w-100 py-2">
                        <select wire:model.live="shape" id="shape" class="input">
                            @foreach([
                                '1' => $lang['2'] ?? 'Square', '2' => $lang['3'] ?? 'Rectangle', '3' => $lang['4'] ?? 'Triangle',
                                '4' => $lang['5'] ?? 'Circle', '5' => $lang['6'] ?? 'Semicircle', '6' => $lang['7'] ?? 'Sector',
                                '7' => $lang['8'] ?? 'Ellipse', '8' => $lang['9'] ?? 'Trapezoid', '9' => $lang['10'] ?? 'Parallelogram',
                                '10' => $lang['11'] ?? 'Rhombus', '11' => $lang['12'] ?? 'Kite', '12' => $lang['13'] ?? 'Annulus',
                                '13' => $lang['14'] ?? 'Polygon'
                            ] as $val => $name)
                                <option value="{{ $val }}">{!! $name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if($config['show_given'])
                <div class="col-span-12 given">
                    <label for="given" class="font-s-14 text-blue">{{ $lang['15'] ?? 'Given' }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" wire:model.live="given" id="given">
                            @foreach([
                                '1' => $lang['16'] ?? '3 sides',
                                '2' => $lang['17'] ?? '2 sides & angle',
                                '3' => $lang['18'] ?? '1 side & 2 angles'
                            ] as $val => $name)
                                <option value="{{ $val }}">{!! $name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif

                @if($config['show_givena'])
                <div class="col-span-12 givena">
                    <label for="givena" class="font-s-14 text-blue">{{ $lang['16'] ?? 'Given' }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" wire:model.live="givena" id="givena">
                            @foreach([
                                '1' => $lang['19'] ?? 'sides a, b',
                                '2' => $lang['20'] ?? 'side b, diagonals e, f',
                                '3' => $lang['21'] ?? 'side b, height h, angle α'
                            ] as $val => $name)
                                <option value="{{ $val }}">{!! $name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif

                @if($config['show_nbr'])
                <div class="col-span-12 nbr_main">
                    <label for="nbr" class="font-s-14 text-blue">{{ $lang[22] ?? 'Number of sides' }} n:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="nbr" id="nbr" class="input" aria-label="input" />
                    </div>
                </div>
                @endif

                @if($config['show_r'])
                <div class="col-span-12 r_main" x-data="{ open: false }">
                    <label for="r" class="font-s-14 text-blue">{{ $config['r_label'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="r" id="r" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $r_unit }} ▾</label>
                        <div x-show="open" @click.outside="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" style="display: none;">
                            @foreach(['mm' => 'millimetre (mm)', 'm' => 'meters (m)', 'in' => 'inches (in)', 'ft' => 'feet (ft)', 'yd' => 'yards (yd)'] as $key => $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('r_unit', '{{ $key }}'); open = false;">{{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                @if($config['show_b'])
                <div class="col-span-12 b_main" x-data="{ open: false }">
                    <label for="b" class="font-s-14 text-blue">{{ $config['b_label'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="b" id="b" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $b_unit }} ▾</label>
                        <div x-show="open" @click.outside="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" style="display: none;">
                            @foreach(['mm' => 'millimetre (mm)', 'm' => 'meters (m)', 'in' => 'inches (in)', 'ft' => 'feet (ft)', 'yd' => 'yards (yd)'] as $key => $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('b_unit', '{{ $key }}'); open = false;">{{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                @if($config['show_c'])
                <div class="col-span-12 c_main" x-data="{ open: false }">
                    <label for="c" class="font-s-14 text-blue">{{ $config['c_label'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="c" id="c" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $c_unit }} ▾</label>
                        <div x-show="open" @click.outside="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" style="display: none;">
                            @foreach(['mm' => 'millimetre (mm)', 'm' => 'meters (m)', 'in' => 'inches (in)', 'ft' => 'feet (ft)', 'yd' => 'yards (yd)'] as $key => $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('c_unit', '{{ $key }}'); open = false;">{{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                @if($config['show_d'])
                <div class="col-span-12 d_main" x-data="{ open: false }">
                    <label for="d" class="font-s-14 text-blue">{{ $config['d_label'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="d" id="d" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $d_unit }} ▾</label>
                        <div x-show="open" @click.outside="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" style="display: none;">
                            @foreach(['mm' => 'millimetre (mm)', 'm' => 'meters (m)', 'in' => 'inches (in)', 'ft' => 'feet (ft)', 'yd' => 'yards (yd)'] as $key => $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('d_unit', '{{ $key }}'); open = false;">{{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                @if($config['show_angle'])
                <div class="col-span-12 angle_a" x-data="{ open: false }">
                    <label for="angle" class="font-s-14 text-blue">{{ $config['angle_label'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="angle" id="angle" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $angle_unit }} ▾</label>
                        <div x-show="open" @click.outside="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" style="display: none;">
                            @foreach(['deg' => 'deg', 'rad' => 'rad'] as $key => $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('angle_unit', '{{ $key }}'); open = false;">{{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                @if($config['show_angleb'])
                <div class="col-span-12 angle_b" x-data="{ open: false }">
                    <label for="angleb" class="font-s-14 text-blue">{{ $config['angleb_label'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model.live="angleb" id="angleb" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $angleb_unit }} ▾</label>
                        <div x-show="open" @click.outside="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" style="display: none;">
                            @foreach(['deg' => 'deg', 'rad' => 'rad'] as $key => $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('angleb_unit', '{{ $key }}'); open = false;">{{ $name }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-span-12 lg:col-span-6 md:col-span-6 flex items-center ps-lg-3 justify-center">
                <img src="{{ asset('images/' . $config['img']) }}" alt="Perimeter Calculator" width="150px" height="120" class="shape_img">
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
                    <div class="w-full my-2 flex justify-center">
                        <div class="text-center ">
                            <p class="text-[20px] mb-2"><strong>
                                @if($shape === '1') {{ $lang['23'] ?? 'Perimeter of' }} {{ $lang['2'] ?? 'Square' }}
                                @elseif($shape === '2') {{ $lang['23'] ?? 'Perimeter of' }} {{ $lang['3'] ?? 'Rectangle' }}
                                @elseif($shape === '3') {{ $lang['23'] ?? 'Perimeter of' }} {{ $lang['4'] ?? 'Triangle' }}
                                @elseif($shape === '4') {{ $lang['23'] ?? 'Perimeter of' }} {{ $lang['5'] ?? 'Circle' }}
                                @elseif($shape === '5') {{ $lang['23'] ?? 'Perimeter of' }} {{ $lang['6'] ?? 'Semicircle' }}
                                @elseif($shape === '6') {{ $lang['23'] ?? 'Perimeter of' }} {{ $lang['7'] ?? 'Sector' }}
                                @elseif($shape === '7') {{ $lang['23'] ?? 'Perimeter of' }} {{ $lang['8'] ?? 'Ellipse' }}
                                @elseif($shape === '8') {{ $lang['23'] ?? 'Perimeter of' }} {{ $lang['9'] ?? 'Trapezoid' }}
                                @elseif($shape === '9') {{ $lang['23'] ?? 'Perimeter of' }} {{ $lang['10'] ?? 'Parallelogram' }}
                                @elseif($shape === '10') {{ $lang['23'] ?? 'Perimeter of' }} {{ $lang['11'] ?? 'Rhombus' }}
                                @elseif($shape === '11') {{ $lang['23'] ?? 'Perimeter of' }} {{ $lang['12'] ?? 'Kite' }}
                                @elseif($shape === '12') {{ $lang['23'] ?? 'Perimeter of' }} {{ $lang['13'] ?? 'Annulus' }}
                                @elseif($shape === '13') {{ $lang['14'] ?? 'Polygon' }}
                                @endif
                            </strong></p>
                            <img src="{{ asset('images/' . $config['img']) }}" alt="Perimeter Calculator" height="120" width="150px" class="shape_img margin_top_20">
                            <div>    
                                <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-white">{{ $detail['peri'] }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
