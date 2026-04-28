<div>
    <style> [x-cloak] { display: none !important; } </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Type Selection --}}
                    <div class="col-span-12 div_center">
                        <label for="calc_type" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Quantum Number Type' }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select class="input w-full border border-gray-300 p-2 rounded-lg focus:ring-2" wire:model.live="calc_type" id="calc_type">
                                <option value="principal">{{ $lang[2] ?? 'Principal' }}</option>
                                <option value="angular">{{ $lang[3] ?? 'Angular Momentum' }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Value Input --}}
                    <div class="col-span-12">
                        <label for="value" class="font-s-14 text-blue">
                            <span x-show="$wire.calc_type == 'principal'">{{ $lang['4'] ?? 'Principal quantum number (n)' }}:</span>
                            <span x-show="$wire.calc_type == 'angular'" x-cloak>{{ $lang['5'] ?? 'Angular momentum quantum number (l)' }}:</span>
                        </label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" wire:model.live="value" id="value" class="input w-full border border-gray-300 p-2 rounded-lg focus:ring-2" placeholder="0" min="1" max="7" />
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
                 wire:loading.remove wire:target="calculate" 
                 class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="flex items-center justify-center">
                    <div class="w-full mt-3">
                        @if($detail['type'] == 'principal')
                            <div class="w-full md:w-[100%] lg:w-[100%] overflow-auto mt-2">
                                <p class="mb-4 font-semibold text-lg">{{ $lang['6'] ?? 'Quantum Numbers Details' }}</p>
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="80%"><strong>{{ $lang[7] ?? 'Principal quantum number' }} (n)</strong></td>
                                        <td class="py-2 border-b">{{ $detail['value'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="80%"><strong>{{ $lang[8] ?? 'Angular momentum' }} (l)</strong></td>
                                        <td class="py-2 border-b">{{ implode(',', str_split($detail['angular_momentum'])) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="80%"><strong>{{ $lang[9] ?? 'Spin quantum number' }} (m<sub>s</sub>)</strong></td>
                                        <td class="py-2 border-b">-1/2, +1/2</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="80%"><strong>{{ $lang[10] ?? 'Total Orbitals' }}</strong></td>
                                        <td class="py-2 border-b">{{ $detail['value'] * $detail['value'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="80%"><strong>{{ $lang[11] ?? 'Total Electrons' }}</strong></td>
                                        <td class="py-2 border-b">{{ 2 * $detail['value'] * $detail['value'] }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="mt-8 overflow-auto">
                                <p class="mb-4 font-semibold text-lg text-center">{{ $lang['12'] ?? 'Detailed Table' }}</p>
                                <div class="w-full overflow-x-auto">
                                    {!! $detail['table'] !!}
                                </div>
                            </div>
                        @elseif($detail['type'] == 'angular')
                            <div class="w-full md:w-[100%] lg:w-[100%] overflow-auto mt-2">
                                <p class="mb-4 font-semibold text-lg">{{ $lang['12'] ?? 'Result Details' }}</p>
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['13'] ?? 'Magnetic quantum number' }} (m<sub>l</sub>)</strong></td>
                                        <td class="py-2 border-b">{{ $detail['magnetic'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['14'] ?? 'Spin quantum number' }} (m<sub>s</sub>)</strong></td>
                                        <td class="py-2 border-b">-1/2, +1/2</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['10'] ?? 'Number of Orbitals' }}</strong></td>
                                        <td class="py-2 border-b">{{ $detail['num_orbital'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
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
