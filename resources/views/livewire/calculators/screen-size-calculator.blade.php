<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Screen Preset --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="screen" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2"> 
                            <select wire:model.live="screen" id="screen" class="input">
                                <option value="16:9">{{ $lang['9'] }} (16:9)</option>
                                <option value="4:3">{{ $lang['10'] }} (4:3)</option>
                                <option value="16:10">{{ $lang['11'] }} (16:10)</option>
                                <option value="17:10">{{ $lang['12'] }} (17:10)</option>
                                <option value="1:2.35">{{ $lang[13] }} (1:2.35)</option>
                                <option value="21:9">{{ $lang['14'] }} (21:9)</option>
                                <option value="32:9">{{ $lang['15'] }} (32:9)</option>
                                <option value="1:1">1:1</option>
                                <option value="5:3">5:3</option>
                                <option value="3:2">3:2</option>
                                <option value="2:1">2:1</option>
                                <option value="5:4">5:4</option>
                                <option value="custom">{{ $lang['16'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Ratio 1 --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="ratio_1" class="label">{{ $lang['2'] }}:</label>
                        <div class="w-100 py-2 relative"> 
                            <input type="number" wire:model.live="ratio_1" id="ratio_1" class="input" />
                            <span class="input_unit text-blue">:</span>
                        </div>
                    </div>

                    {{-- Ratio 2 --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="ratio_2" class="label">{{ $lang['3'] }}:</label>
                        <div class="w-100 py-2 relative"> 
                            <input type="number" step="any" wire:model.live="ratio_2" id="ratio_2" class="input" />
                            <span class="input_unit text-blue">:</span>
                        </div>
                    </div>

                    {{-- Type --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="type" class="label">{{ $lang['4'] }}:</label>
                        <div class="w-100 py-2 relative"> 
                            <select wire:model.live="screen_type" id="type" class="input">
                                <option value="flat">Flat</option>
                                <option value="curved">Curved</option>
                            </select>
                        </div>
                    </div>

                    @if($screen_type === 'curved')
                        {{-- Curvature (Curved only) --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="curvature" class="label">{{ $lang['5'] }}:</label>
                            <div class="w-100 py-2 relative"> 
                                <select wire:model.live="curvature" id="curvature" class="input">
                                    <option value="1500">1500R</option>
                                    <option value="1800">1800R</option>
                                    <option value="2300">2300R</option>
                                    <option value="3000">3000R</option>
                                    <option value="4000">4000R</option>
                                    <option value="enter">Enter your own value</option>
                                </select>
                            </div>
                        </div>

                        @if($curvature === 'enter')
                            {{-- Radius (Custom Curvature only) --}}
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="radius" class="label">{{ $lang['6'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live="radius" id="radius" step="any" class="input pr-16" />
                                    <div class="absolute right-0 top-0 h-full flex items-center pr-1" x-data="{ open: false }">
                                        <button type="button" @click="open = !open" class=" px-3 py-2 rounded-r-lg border-l text-sm font-semibold">
                                            {{ $radius_units }} ▾
                                        </button>
                                        <div x-show="open" x-cloak @click.away="open = false" class="absolute right-0 top-full mt-1 w-20 border rounded-lg z-50 bg-white shadow-xl">
                                            @foreach (["mm", "cm", "m", "in", "ft", "yd"] as $name)
                                                <button type="button" wire:click="setUnit('radius_units', '{{ $name }}')" @click="open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">{{ $name }}</button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    @if($screen_type === 'flat')
                        {{-- Select One (Flat only) --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="select_one" class="label">{{ $lang['7'] }}:</label>
                            <div class="w-100 py-2 relative"> 
                                <select wire:model.live="select_one" id="select_one" class="input">
                                    <option value="width">{{ $lang['18'] }}</option>
                                    <option value="height">{{ $lang['19'] }}</option>
                                    <option value="diagonal">{{ $lang['8'] }}</option>
                                </select>
                            </div>
                        </div>

                        {{-- Flat Dimension Input --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="flat_dimensions" class="label">
                                @if($select_one === 'width') {{ $lang['18'] }} @elseif($select_one === 'height') {{ $lang['19'] }} @else {{ $lang['8'] }} @endif:
                            </label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="flat_dimensions" id="flat_dimensions" step="any" class="input pr-16" />
                                <div class="absolute right-0 top-0 h-full flex items-center pr-1" x-data="{ open: false }">
                                    <button type="button" @click="open = !open" class="px-3 py-2 underline text-sm font-semibold">
                                        {{ $flat_dimensions_units }} ▾
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false" class="absolute right-0 top-full mt-1 w-20 bg-white border rounded-lg shadow-xl z-50">
                                        @foreach (["mm", "cm", "m", "in", "ft", "yd"] as $name)
                                            <button type="button" wire:click="setUnit('flat_dimensions_units', '{{ $name }}')" @click="open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">{{ $name }}</button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Select Two (Curved only) --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="select_two" class="label">{{ $lang['7'] }}:</label>
                            <div class="w-100 py-2 relative"> 
                                <select wire:model.live="select_two" id="select_two" class="input">
                                    <option value="Width">{{ $lang['21'] }}</option>
                                    <option value="Height">{{ $lang['19'] }}</option>
                                    <option value="Diagonal">{{ $lang['8'] }}</option>
                                </select>
                            </div>
                        </div>

                        {{-- Curved Dimension Input --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="curved_dimensions" class="label">
                                @if($select_two === 'Width') {{ $lang['21'] }} @elseif($select_two === 'Height') {{ $lang['19'] }} @else {{ $lang['8'] }} @endif:
                            </label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="curved_dimensions" id="curved_dimensions" step="any" class="input pr-16" />
                                <div class="absolute right-0 top-0 h-full flex items-center pr-1" x-data="{ open: false }">
                                    <button type="button" @click="open = !open" class="underline px-3 py-2  text-sm font-semibold">
                                        {{ $curved_dimensions_units }} ▾
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false" class="absolute right-0 top-full mt-1 w-20 bg-white border rounded-lg shadow-xl z-50">
                                        @foreach (["mm", "cm", "m", "in", "ft", "yd"] as $name)
                                            <button type="button" wire:click="setUnit('curved_dimensions_units', '{{ $name }}')" @click="open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">{{ $name }}</button>
                                        @endforeach
                                    </div>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full py-2">
                                <div class="w-full lg:w-[80%] text-18px overflow-auto">
                                    <table class="w-full">
                                        @if($screen_type === 'flat')
                                            <tr>
                                                <td width="60%" class="border-b py-2"><strong>{{ $lang['17'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'], 3) }} <span class="text-sm">in²</span></td>
                                            </tr>
                                            @if ($select_one === 'height')
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8'] }}</strong> :</td>
                                                    <td class="border-b py-2">{{ number_format($detail['diagonal'], 2) }} <span class="text-sm">in</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['18'] }}</strong> :</td>
                                                    <td class="border-b py-2">{{ number_format($detail['width'], 1) }} <span class="text-sm">in</span></td>
                                                </tr>
                                            @elseif ($select_one === 'width')
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8'] }}</strong> :</td>
                                                    <td class="border-b py-2">{{ number_format($detail['diagonal'], 2) }} <span class="text-sm">in</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['19'] }}</strong> :</td>
                                                    <td class="border-b py-2">{{ number_format($detail['height'], 1) }} <span class="text-sm">in</span></td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['19'] }}</strong> :</td>
                                                    <td class="border-b py-2">{{ number_format($detail['height'], 2) }} <span class="text-sm">in</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['18'] }}</strong> :</td>
                                                    <td class="border-b py-2">{{ number_format($detail['width'], 2) }} <span class="text-sm">in</span></td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td colspan="2" class="pt-4 pb-2 text-blue-600 font-bold border-b">{{ $lang['20'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">mm² :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'] * 645.16, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">cm² :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'] * 6.4516, 1) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">dm² :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'] * 0.064516, 3) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">m² :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'] * 0.00064516, 5) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">ft² :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'] / 144, 5) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">yd² :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'] / 1296, 5) }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td width="60%" class="border-b py-2"><strong>{{ $lang['17'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'], 3) }} <span class="text-sm">in²</span></td>
                                            </tr>
                                            @if ($select_two === 'Height')
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['21'] }}</strong> :</td>
                                                    <td class="border-b py-2">{{ number_format($detail['base_width'], 2) }} <span class="text-sm">in</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8'] }}</strong> :</td>
                                                    <td class="border-b py-2">{{ number_format($detail['diagonal'], 2) }} <span class="text-sm">in</span></td>
                                                </tr>
                                            @elseif ($select_two === 'Width')
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['19'] }}</strong> :</td>
                                                    <td class="border-b py-2">{{ number_format($detail['height'], 1) }} <span class="text-sm">in</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8'] }}</strong> :</td>
                                                    <td class="border-b py-2">{{ number_format($detail['diagonal'], 2) }} <span class="text-sm">in</span></td>
                                                </tr>
                                            @elseif ($select_two === 'Diagonal') 
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['19'] }}</strong> :</td>
                                                    <td class="border-b py-2">{{ number_format($detail['height'], 2) }} <span class="text-sm">in</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['21'] }}</strong> :</td>
                                                    <td class="border-b py-2">{{ number_format($detail['base_width'], 2) }} <span class="text-sm">in</span></td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['22'] }}</strong> :</td>
                                                <td class="border-b py-2">{{ number_format($detail['base_depth'], 2) }} <span class="text-sm">in</span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['23'] }}</strong> :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screen_length'], 2) }} <span class="text-sm">in</span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="pt-4 pb-2 text-blue-600 font-bold border-b">{{ $lang['20'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">mm² :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'] * 645.16, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">cm² :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'] * 6.4516, 1) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">dm² :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'] * 0.064516, 3) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">m² :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'] * 0.00064516, 5) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">ft² :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'] / 144, 5) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">yd² :</td>
                                                <td class="border-b py-2">{{ number_format($detail['screenArea'] / 1296, 5) }}</td>
                                            </tr>
                                        @endif
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

@push('calculatorJS')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('scroll-to-result', () => {
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            });
        });
    </script>
@endpush
