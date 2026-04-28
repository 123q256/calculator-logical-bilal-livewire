<div>
    <style> [x-cloak] { display: none !important; } </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Mode Selection --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 div_center">
                        <label for="calculate" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Calculate' }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select class="input w-full border border-gray-300 p-2 rounded-lg focus:ring-2" wire:model.live="calc_method" id="calculate">
                                <option value="4">{{ $lang[8] ?? 'Friction on inclined plane' }}</option>
                                <option value="1">{{ $lang[2] ?? 'Friction Coefficient' }}</option>
                                <option value="2">{{ $lang[3] ?? 'Normal Force' }}</option>
                                <option value="3">{{ $lang[4] ?? 'Friction' }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Friction Coefficient (μ) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="$wire.calc_method == '4' || $wire.calc_method == '2' || $wire.calc_method == '3'">
                        <label for="fr_co" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Friction Coefficient' }} (μ)</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" wire:model.live="fr_co" id="fr_co" class="input w-full border border-gray-300 p-2 rounded-lg focus:ring-2" placeholder="0.2" />
                        </div>
                    </div>

                    {{-- Normal Force (N) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }" x-show="$wire.calc_method == '1' || $wire.calc_method == '3'" x-cloak>
                        <label for="force" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Normal Force' }} (N)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="force" id="force" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                {{ $force_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 dropdown-content">
                                @foreach (['N', 'kN', 'MN', 'GN', 'TN'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('force_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Friction (F) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }" x-show="$wire.calc_method == '1' || $wire.calc_method == '2'" x-cloak>
                        <label for="fr" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Friction' }} (F)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="fr" id="fr" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                {{ $fr_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 dropdown-content">
                                @foreach (['N', 'kN', 'MN', 'GN', 'TN'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('fr_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Mass (m) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="$wire.calc_method == '4'">
                        <label for="mass" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Mass' }} (m)</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="mass" id="mass" class="input w-full border border-gray-300 p-2 rounded-lg focus:ring-2" placeholder="13" />
                            <span class="absolute right-4 top-4 text-blue">kg</span>
                        </div>
                    </div>

                    {{-- Plane Angle (θ) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="$wire.calc_method == '4'">
                        <label for="plane" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Angle' }} (θ)</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" wire:model.live="plane" id="plane" class="input w-full border border-gray-300 p-2 rounded-lg focus:ring-2" placeholder="13" />
                        </div>
                    </div>

                    {{-- Gravity (g) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="$wire.calc_method == '4'">
                        <label for="gravity" class="font-s-14 text-blue">{{ $lang['7'] ?? 'Gravity' }} (g)</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" wire:model.live="gravity" id="gravity" class="input w-full border border-gray-300 p-2 rounded-lg focus:ring-2" placeholder="9.81" />
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        <hr>

        @isset($detail)
            <div id="result-section" 
                 x-data="{ resultData: @entangle('detail') }"
                 x-effect="if(resultData) { setTimeout(() => { if (typeof MathJax !== 'undefined') { MathJax.Hub.Queue(['Typeset', MathJax.Hub]); } }, 100); }"
                 wire:loading.remove wire:target="calculate" 
                 class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full overflow-auto">
                            <div class="w-full space-y-6">
                                {{-- Result Tables --}}
                                <div class="w-full md:w-[100%] lg:w-[100%] overflow-auto mt-2">
                                    <table class="w-full font-s-18">
                                        @if(isset($detail['friction_coefficient']))
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang[2] ?? 'Friction Coefficient' }} (μ)</strong></td>
                                                <td class="py-2 border-b">{{ round($detail['friction_coefficient'], 4) }}</td>
                                            </tr>
                                        @elseif(isset($detail['calculate_force']))
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang[3] ?? 'Normal Force' }} (N)</strong></td>
                                                <td class="py-2 border-b">{{ round($detail['calculate_force'], 4) }} N</td>
                                            </tr>
                                        @elseif(isset($detail['friction']))
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] ?? 'Friction' }} (F)</strong></td>
                                                <td class="py-2 border-b">{{ round($detail['friction'], 4) }} N</td>
                                            </tr>
                                        @elseif(isset($detail['friction2']))
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang[8] ?? 'Friction Force' }} (F_f)</strong></td>
                                                <td class="py-2 border-b">{{ round($detail['friction2'], 4) }} N</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>

                                {{-- Formula/Solution Section --}}
                                <div class="space-y-6">
                                    <div>
                                        <p class="font-bold md:text-[20px] text-[16px] mb-2">Formula:</p>
                                        <div class="space-y-2 md:text-[22px] text-[18px] overflow-auto">
                                            @if(isset($detail['friction_coefficient']))
                                                <p>\( \mu = \frac{F}{N} \)</p>
                                            @elseif(isset($detail['calculate_force']))
                                                <p>\( N = \frac{F}{\mu} \)</p>
                                            @elseif(isset($detail['friction']))
                                                <p>\( F = N \times \mu \)</p>
                                            @elseif(isset($detail['friction2']))
                                                <p>\( F_{\text{friction}} = \mu \times m \times g \times \cos(\theta) \)</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div>
                                        <p class="font-bold md:text-[20px] text-[16px] mb-2">Inputs:</p>
                                        <div class="space-y-2 md:text-[22px] text-[18px] overflow-auto">
                                            @if(isset($detail['friction_coefficient']))
                                                <p>\( F = {{ $detail['fr_value'] }} \text{ N} \)</p>
                                                <p>\( N = {{ $detail['force_value'] }} \text{ N} \)</p>
                                            @elseif(isset($detail['calculate_force']))
                                                <p>\( F = {{ $detail['force_value'] }} \text{ N} \)</p>
                                                <p>\( \mu = {{ $detail['fr_co'] }} \)</p>
                                            @elseif(isset($detail['friction']))
                                                <p>\( N = {{ $detail['force_value'] }} \text{ N} \)</p>
                                                <p>\( \mu = {{ $detail['fr_co'] }} \)</p>
                                            @elseif(isset($detail['friction2']))
                                                <p>\( \mu = {{ $detail['fr_co'] }} \)</p>
                                                <p>\( m = {{ $detail['mass'] }} \text{ kg} \)</p>
                                                <p>\( g = {{ $detail['gravity'] }} \text{ m/s²} \)</p>
                                                <p>\( \theta = {{ $detail['plane'] }}^\circ \)</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div>
                                        <p class="font-bold md:text-[20px] text-[16px] mb-2">Solution:</p>
                                        <div class="space-y-4 md:text-[25px] text-[18px] overflow-auto">
                                            @if(isset($detail['friction_coefficient']))
                                                <p>\( \mu = \frac{ {{ $detail['fr_value'] }} }{ {{ $detail['force_value'] }} } \)</p>
                                                <p class="bg-blue-50 p-3 rounded font-semibold text-center">\( \mu = {{ round($detail['friction_coefficient'], 4) }} \)</p>
                                            @elseif(isset($detail['calculate_force']))
                                                <p>\( N = \frac{ {{ $detail['force_value'] }} }{ {{ $detail['fr_co'] }} } \)</p>
                                                <p class="bg-blue-50 p-3 rounded font-semibold text-center">\( N = {{ round($detail['calculate_force'], 4) }} \text{ N} \)</p>
                                            @elseif(isset($detail['friction']))
                                                <p>\( F = {{ $detail['force_value'] }} \times {{ $detail['fr_co'] }} \)</p>
                                                <p class="bg-blue-50 p-3 rounded font-semibold text-center">\( F = {{ round($detail['friction'], 4) }} \text{ N} \)</p>
                                            @elseif(isset($detail['friction2']))
                                                <p>\( F_{\text{friction}} = {{ $detail['fr_co'] }} \times {{ $detail['mass'] }} \times {{ $detail['gravity'] }} \times \cos({{ $detail['plane'] }}^\circ) \)</p>
                                                <p>\( F_{\text{friction}} = {{ $detail['fr_co'] }} \times {{ $detail['mass'] }} \times {{ $detail['gravity'] }} \times {{ round($detail['read'], 4) }} \)</p>
                                                <p class="bg-blue-50 p-3 rounded font-semibold text-center">\( F_{\text{friction}} = {{ round($detail['friction2'], 4) }} \text{ N} \)</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({
                tex2jax: {
                    inlineMath: [['$', '$'], ['\\(', '\\)']],
                    displayMath: [['$$', '$$'], ['\\[', '\\]']],
                    processEscapes: true
                },
                "HTML-CSS": { linebreaks: { automatic: true } },
                "CommonHTML": { linebreaks: { automatic: true } }
            });
        </script>
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('initKaTeX', () => {
                    setTimeout(() => {
                        if (window.MathJax) {
                            window.MathJax.Hub.Queue(["Typeset", window.MathJax.Hub]);
                        }
                    }, 300);
                });
            });
            window.addEventListener('load', () => {
                if (window.MathJax) {
                    window.MathJax.Hub.Queue(["Typeset", window.MathJax.Hub]);
                }
            });
        </script>
    @endpush
</div>
