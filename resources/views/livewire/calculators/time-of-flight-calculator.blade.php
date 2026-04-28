<div>
    <style> [x-cloak] { display: none !important; } </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Angle (α) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label for="a" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Angle' }} (α)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="a" id="a" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                {{ $a_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 dropdown-content">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('a_unit', 'deg'); open = false">deg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('a_unit', 'rad'); open = false">rad</p>
                            </div>
                        </div>
                    </div>

                    {{-- Initial Height (h) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label for="h" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Initial Height' }} (h)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="h" id="h" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                {{ $h_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 dropdown-content">
                                @foreach (['cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('h_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Launch Velocity (V) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label for="v" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Launch Velocity' }} (V)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="v" id="v" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                {{ $v_unit == 'ms' ? 'm/s' : ($v_unit == 'kmh' ? 'km/h' : ($v_unit == 'fts' ? 'ft/s' : $v_unit)) }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 dropdown-content">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('v_unit', 'ms'); open = false">m/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('v_unit', 'kmh'); open = false">km/h</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('v_unit', 'fts'); open = false">ft/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('v_unit', 'mph'); open = false">mph</p>
                            </div>
                        </div>
                    </div>

                    {{-- Gravitational Acceleration (g) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label for="g" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Gravity' }} (g)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="g" id="g" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                {{ $g_unit == 'msms2' ? 'm/s²' : $g_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 dropdown-content">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('g_unit', 'msms2'); open = false">m/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('g_unit', 'g'); open = false">g</p>
                            </div>
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
                 x-init="if (typeof MathJax !== 'undefined') { MathJax.Hub.Queue(['Typeset', MathJax.Hub]); } else { setTimeout(() => { if (typeof MathJax !== 'undefined') MathJax.Hub.Queue(['Typeset', MathJax.Hub]); }, 500); }"
                 wire:loading.remove wire:target="calculate" 
                 class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full md:w-[100%] lg:w-[100%] overflow-auto mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] ?? 'Time of Flight' }}</strong></td>
                                    <td class="py-2 border-b">{{ $detail['tof'] }} sec</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang[6] ?? 'Horizontal Velocity' }} (Vx)</strong></td>
                                    <td class="py-2 border-b">{{ $detail['vx'] }} m/s</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang[7] ?? 'Vertical Velocity' }} (Vy)</strong></td>
                                    <td class="py-2 border-b">{{ $detail['vy'] }} m/s</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang[8] ?? 'Gravity Used' }}</strong></td>
                                    <td class="py-2 border-b">{{ $detail['g'] }} m/s²</td>
                                </tr>
                            </table>
                        </div>

                        <div class="w-full font-s-16 overflow-auto mt-6 space-y-6">
                            {{-- Formula Section --}}
                            <div>
                                <p class="font-bold md:text-[30px] text-[22px]  mb-2">Formula:</p>
                                <div class="space-y-2 md:text-[20px] text-[18px] overflow-auto">
                                    @if ($detail['h'] == 0)
                                        <p>\(\text{∴ } {{ $lang['10'] ?? 'initial height' }} = 0\)</p>
                                        <p>\(t = \dfrac{2 V_o \sin(α)}{g}\)</p>
                                    @else
                                        <p>\(\text{∴ } {{ $lang['10'] ?? 'initial height' }} > 0\)</p>
                                        <p>\(t = \dfrac{V_o \sin(α) + \sqrt{(V_o \sin(α))^2 + 2gh}}{g}\)</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Inputs Section --}}
                            <div>
                                <p class="font-bold md:text-[30px] text-[22px]  mb-2">Inputs:</p>
                                <div class="space-y-2 md:text-[20px] text-[18px] overflow-auto">
                                    <p>\(V_o = {{ $detail['v'] }} \text{ m/s}\)</p>
                                    <p>\(α = {{ $detail['a'] }} \text{ deg}\)</p>
                                    <p>\(g = {{ $detail['g'] }} \text{ m/s²}\)</p>
                                    @if ($detail['h'] > 0)
                                        <p>\(h = {{ $detail['h'] }} \text{ m}\)</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Solution Section --}}
                            <div>
                                <p class="font-bold md:text-[30px] text-[22px]  mb-2">Solution:</p>
                                <div class="space-y-4 md:text-[25px] text-[18px] overflow-auto">
                                    @if ($detail['h'] == 0)
                                        <p>\( t = \frac{ 2 \times {{ $detail['v'] }} \times \sin( {{ $detail['a'] }} ) }{ {{ $detail['g'] }} } \)</p>
                                        <p>\( t = \frac{ 2 \times {{ $detail['v'] }} \times {{ $detail['sin'] }} }{ {{ $detail['g'] }} } \)</p>
                                        <p>\( t = \frac{ {{ $detail['res'] }} }{ {{ $detail['g'] }} } \)</p>
                                        <p class="bg-blue-50 p-3 rounded font-semibold text-center">\( t = {{ $detail['tof'] }} \text{ sec} \)</p>
                                    @else
                                        <p>\( t = \frac{ {{ $detail['v'] }} \times \sin( {{ $detail['a'] }} ) + \sqrt{ ( {{ $detail['v'] }} \times \sin( {{ $detail['a'] }} ) )^2 + 2 \times {{ $detail['g'] }} \times {{ $detail['h'] }} } }{ {{ $detail['g'] }} } \)</p>
                                        <p>\( t = \frac{ {{ $detail['v'] }} \times {{ $detail['sin'] }} + \sqrt{ ( {{ $detail['v'] }} \times {{ $detail['sin'] }} )^2 + 2 \times {{ $detail['g'] }} \times {{ $detail['h'] }} } }{ {{ $detail['g'] }} } \)</p>
                                        <p>\( t = \frac{ {{ $detail['vy'] }} + \sqrt{ ( {{ $detail['vy'] }} )^2 + {{ $detail['gh'] }} } }{ {{ $detail['g'] }} } \)</p>
                                        <p>\( t = \frac{ {{ $detail['vy'] }} + \sqrt{ {{ $detail['vs2gh'] }} } }{ {{ $detail['g'] }} } \)</p>
                                        <p>\( t = \frac{ {{ $detail['vysqrt'] }} }{ {{ $detail['g'] }} } \)</p>
                                        <p class="bg-blue-50 p-3 rounded font-semibold text-center">\( t = {{ $detail['tof'] }} \text{ sec} \)</p>
                                    @endif
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