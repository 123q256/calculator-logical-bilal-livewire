<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- To Calculate --}}
                    <div class="space-y-2 relative lg:col-span-2">
                        <label for="cal" class="font-s-14 text-blue">{!! $lang['to_calc'] !!}:</label>
                        <select wire:model.live="cal" id="cal" class="input">
                            <option value="ma">{!! $lang['1'] !!}</option>
                            <option value="va">{!! $lang['2'] !!}</option>
                            <option value="hp">{!! $lang['3'] !!}</option>
                            <option value="mb">{!! $lang['4'] !!}</option>
                            <option value="vb">{!! $lang['5'] !!}</option>
                            <option value="oh">{!! $lang['6'] !!}</option>
                        </select>
                    </div>

                    {{-- Molar Concentration of Acid (ma) --}}
                    @if($cal !== 'ma')
                    <div class="space-y-2 ma">
                        <label for="ma" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="ma" id="ma" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $ma_unit }} ▾</label>
                            <div x-show="open" x-cloak @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                @foreach(['pM', 'nM', 'μM', 'mM', 'M'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ma_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Volume of Acid (va) --}}
                    @if($cal !== 'va')
                    <div class="space-y-2 va">
                        <label for="va" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="va" id="va" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $va_unit }} ▾</label>
                            <div x-show="open" x-cloak @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg h-48 overflow-y-auto">
                                @foreach(['mm³', 'cm³', 'dm³', 'm³', 'cu in', 'cu ft', 'cu yd', 'ml', 'cl', 'l', 'us gal', 'uk gal', 'us fl oz', 'uk fl oz'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('va_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Acid Stoichiometric Coefficient (hp) --}}
                    @if($cal !== 'hp')
                    <div class="space-y-2 hp">
                        <label for="hp" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                        <input type="number" step="any" wire:model="hp" id="hp" class="input" placeholder="00" />
                    </div>
                    @endif

                    {{-- Molar Concentration of Base (mb) --}}
                    @if($cal !== 'mb')
                    <div class="space-y-2 mb">
                        <label for="mb" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="mb" id="mb" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $mb_unit }} ▾</label>
                            <div x-show="open" x-cloak @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                @foreach(['pM', 'nM', 'μM', 'mM', 'M'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mb_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Volume of Base (vb) --}}
                    @if($cal !== 'vb')
                    <div class="space-y-2 vb">
                        <label for="vb" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="vb" id="vb" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $vb_unit }} ▾</label>
                            <div x-show="open" x-cloak @click.away="open = false" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg h-48 overflow-y-auto">
                                @foreach(['mm³', 'cm³', 'dm³', 'm³', 'cu in', 'cu ft', 'cu yd', 'ml', 'cl', 'l', 'us gal', 'uk gal', 'us fl oz', 'uk fl oz'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('vb_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Base Stoichiometric Coefficient (oh) --}}
                    @if($cal !== 'oh')
                    <div class="space-y-2 oh">
                        <label for="oh" class="font-s-14 text-blue">{!! $lang['6'] !!}:</label>
                        <input type="number" step="any" wire:model="oh" id="oh" class="input" placeholder="00" />
                    </div>
                    @endif
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
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full overflow-auto">
                            @php
                                $mainHeading = '';
                                if($cal === 'ma') $mainHeading = $lang['1'];
                                elseif($cal === 'va') $mainHeading = $lang['2'];
                                elseif($cal === 'hp') $mainHeading = $lang['3'];
                                elseif($cal === 'mb') $mainHeading = $lang['4'];
                                elseif($cal === 'vb') $mainHeading = $lang['5'];
                                elseif($cal === 'oh') $mainHeading = $lang['6'];
                            @endphp
                            <div class="bg-[#F6FAFC] border radius-10 p-3 mb-3 text-center">
                                <strong class="font-s-25">{{ $mainHeading }} =</strong>
                                <strong class="text-green font-s-25">{!! $detail['ans'] !!}</strong>
                            </div>

                            @php
                                $otherUnits = array_filter($detail, function($key) {
                                    return str_starts_with($key, 'ans_') && $key !== 'ans';
                                }, ARRAY_FILTER_USE_KEY);
                            @endphp

                            @if(count($otherUnits) > 0 && isset($lang['7']))
                                <p class="mb-2"><strong>{{ $lang['7'] }}</strong></p>
                                <div class="grid grid-cols-1 overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        @foreach($otherUnits as $key => $value)
                                            <tr>
                                                <td class="border-b py-2">{{ $mainHeading }} ({{ str_replace('ans_', '', $key) }})</td>
                                                <td class='border-b py-2 text-end'><strong>{!! $value !!}</strong></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                            <script>console.log('Calculation Detail:', @json($detail));</script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endisset
    </form>
</div>
