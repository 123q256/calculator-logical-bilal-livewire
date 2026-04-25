<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                {{-- Section 1: Clausius-Clapeyron --}}
                <div class="mb-6">
                    <p class="text-blue font-bold border-b pb-2 mb-4 uppercase tracking-wider text-sm">{!! $lang['1'] ?? 'Clausius-Clapeyron Equation' !!}</p>
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-6">
                            <label class="font-s-14 text-blue font-bold">{{ $lang['2'] ?? 'Temperature 1' }} [T1]:</label>
                            <div class="relative w-full mt-2">
                                <input type="number" step="any" wire:model.live="t1" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('t1_dropdown')">
                                    {{ $t1_units }} ▾
                                </label>
                                @if ($showDropdown === 't1_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto">
                                        @foreach(['°C', '°F', 'k', '°R', '°De', '°N', '°Ré', '°Rø'] as $unit)
                                            <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('t1_units', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label class="font-s-14 text-blue font-bold">{{ $lang['3'] ?? 'Temperature 2' }} [T2]:</label>
                            <div class="relative w-full mt-2">
                                <input type="number" step="any" wire:model.live="t2" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('t2_dropdown')">
                                    {{ $t2_units }} ▾
                                </label>
                                @if ($showDropdown === 't2_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto">
                                        @foreach(['°C', '°F', 'k', '°R', '°De', '°N', '°Ré', '°Rø'] as $unit)
                                            <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('t2_units', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label class="font-s-14 text-blue font-bold">{{ $lang['4'] ?? 'Pressure 1' }} [P1]:</label>
                            <div class="relative w-full mt-2">
                                <input type="number" step="any" wire:model.live="p1" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('p1_dropdown')">
                                    {{ $p1_units }} ▾
                                </label>
                                @if ($showDropdown === 'p1_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto">
                                        @foreach(['Pa', 'Bar', 'psi', 'at', 'atm', 'Torr', 'hPa', 'kPa', 'MPa', 'GPa'] as $unit)
                                            <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('p1_units', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label class="font-s-14 text-blue font-bold">{{ $lang['5'] ?? 'Enthalpy of Vaporization' }} [ΔHvap]:</label>
                            <div class="relative w-full mt-2">
                                <input type="number" step="any" wire:model.live="deltaHvap" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('deltaHvap_dropdown')">
                                    {{ $deltaHvap_units }} ▾
                                </label>
                                @if ($showDropdown === 'deltaHvap_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto">
                                        @foreach(['J', 'KJ', 'MJ', 'Wh', 'KWh', 'ft-lb', 'kcal'] as $unit)
                                            <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('deltaHvap_units', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section 2: Raoult's Law --}}
                <div class="pt-4 border-t">
                    <p class="text-blue font-bold border-b pb-2 mb-4 uppercase tracking-wider text-sm">{!! $lang['6'] ?? 'Raoult\'s Law' !!}</p>
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-6">
                            <label class="font-s-14 text-blue font-bold">{!! $lang['7'] ?? 'Mole Fraction of Solvent' !!} [x_sol]:</label>
                            <div class="relative w-full mt-2">
                                <input type="number" step="any" wire:model.live="x_sol" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="0.00">
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6">
                            <label class="font-s-14 text-blue font-bold">{{ $lang['8'] ?? 'Pure Solvent Vapor Pressure' }} [P_sol]:</label>
                            <div class="relative w-full mt-2">
                                <input type="number" step="any" wire:model.live="p_sol" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('p_sol_dropdown')">
                                    {{ $p_sol_units }} ▾
                                </label>
                                @if ($showDropdown === 'p_sol_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto">
                                        @foreach(['Pa', 'Bar', 'psi', 'at', 'atm', 'Torr', 'hPa', 'kPa', 'MPa', 'GPa'] as $unit)
                                            <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('p_sol_units', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center space-x-4 mt-8">
                @if ($type == 'calculator')
                    @include('inc.button')
                @elseif ($type == 'widget')
                    @include('inc.widget-button')
                @endif
            </div>
        </div>

        <hr>
        @if($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
             <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full  rounded-lg mt-5">
                        <div class="w-full">
                            <!-- Section 1 -->
                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                <strong>{!! $lang['9'] !!} =</strong>
                                <strong class="text-[#119154] text-2xl">
                                    @if(is_infinite($detail['p2']))
                                        INF
                                    @else
                                        {!! round($detail['p2'], 3) !!}
                                    @endif
                                </strong>
                            </div>
                            @if(isset($detail['message']))
                                <p class="text-xs text-red-500 mt-1 font-bold">{{ $detail['message'] }}</p>
                            @endif
                            <p class="mt-3"><strong>{!! $lang['11'] !!}</strong></p>
                            <div class="flex justify-between overflow-auto gap-4">
                                <div class="mt-3 text-center">
                                    <p><strong>bar</strong></p>
                                    <p>
                                        @if(is_infinite($detail['p2']))
                                            INF
                                        @else
                                            {!! round($detail['p2'] * 0.00001, 5) !!}
                                        @endif
                                    </p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>psi</strong></p>
                                    <p>{!! round($detail['p2'] * 0.00014504, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>at</strong></p>
                                    <p>{!! round($detail['p2'] * 0.000010197, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>atm</strong></p>
                                    <p>{!! round($detail['p2'] * 0.00000987, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>torr</strong></p>
                                    <p>{!! round($detail['p2'] * 0.0075, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>hpa</strong></p>
                                    <p>{!! round($detail['p2'] * 0.01, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>kpa</strong></p>
                                    <p>{!! round($detail['p2'] * 0.001, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>Mpa</strong></p>
                                    <p>{!! round($detail['p2'] * 0.000001, 4) !!}</p>
                                </div>
                            </div>
                
                            <!-- Section 2 -->
                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-3">
                                <strong>{!! $lang['10'] !!} =</strong>
                                <strong class="text-[#119154] text-2xl">{!! round($detail['xsolvent'], 3) !!}</strong>
                            </div>
                            <p class="mt-3"><strong>{!! $lang['11'] !!}</strong></p>
                            <div class="flex justify-between overflow-auto gap-4">
                                <div class="mt-3 text-center">
                                    <p><strong>bar</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.00001, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>psi</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.00014504, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>at</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.000010197, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>atm</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.00000987, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>torr</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.0075, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>hpa</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.01, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>kpa</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.001, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>Mpa</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.000001, 4) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Solution Section --}}
                <div class="mt-10 space-y-8 border-t pt-8">
                    <div>
                        <p class="font-bold font-s-18">Solution (Clausius-Clapeyron):</p>
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg overflow-x-auto">
                            <p class="text-lg">\( \ln(\frac{P_2}{P_1}) = \frac{-\Delta H_{vap}}{R} \times (\frac{1}{T_2} - \frac{1}{T_1}) \)</p>
                            <p class="mt-4 text-lg">\( P_2 = P_1 \times e^{ (\frac{-\Delta H_{vap}}{R} \times (\frac{1}{T_2} - \frac{1}{T_1})) } \)</p>
                            <p class="mt-4 text-gray-600">Substituting values:</p>
                            <p class="mt-2 text-lg">\( P_2 = {!! $p1 !!} \times e^{ (\frac{-{!! $deltaHvap !!}}{8.314} \times (\frac{1}{{!! $t2 !!}} - \frac{1}{{!! $t1 !!}})) } \)</p>
                            <p class="mt-6 font-s-24 font-black">\( P_2 \) = {!! is_infinite($detail['p2']) ? 'INF' : round($detail['p2'], 3) !!} Pa</p>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <p class="font-bold font-s-18">Solution (Raoult's Law):</p>
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <p class="text-lg">\( P_{solution} = P_{pure} \times x_{solvent} \)</p>
                            <p class="mt-4 text-lg">\( P_{solution} = {!! $p_sol !!} \times {!! $x_sol !!} \)</p>
                            <p class="mt-6 font-s-24 font-black">\( P_{solution} \) = {!! round($detail['xsolvent'], 3) !!} Pa</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
            </div>
        @endif
    </form>

    @push('calculatorJS')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({
                "HTML-CSS": { linebreaks: { automatic: true }, scale: 100 },
                "CommonHTML": { linebreaks: { automatic: true } },
                tex2jax: { inlineMath: [['$', '$'], ['\\(', '\\)']] }
            });
        </script>
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('result-updated', (event) => {
                    setTimeout(() => {
                        if (window.MathJax) {
                            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                        }
                    }, 100);
                });
            });
        </script>
    @endpush
</div>
