<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto space-y-4">
                <div class="grid grid-cols-12 gap-4">
                    {{-- Electric Field --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="electric" class="label font-s-14 text-blue">{{ $lang[1] }} (|E|) V/m:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model="electric" id="electric" class="input" />
                        </div>
                    </div>

                    {{-- Surface Area --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="surface" class="label font-s-14 text-blue">{{ $lang[2] }} (|A|) m²:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model="surface" id="surface" class="input" />
                        </div>
                    </div>

                    {{-- Angle --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="degree" class="label font-s-14 text-blue">{{ $lang[3] }} (θ)°:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model="degree" id="degree" class="input" />
                        </div>
                    </div>

                    {{-- Net Charge --}}
                    <div class="col-span-7 md:col-span-4 lg:col-span-4">
                        <label for="charge" class="label font-s-14 text-blue">{{ $lang[4] }} (Q):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model="charge" id="charge" class="input" />
                        </div>
                    </div>

                    {{-- Charge Unit --}}
                    <div class="col-span-5 md:col-span-2 lg:col-span-2">
                        <label class="label">&nbsp;</label>
                        <div class="w-full py-2">
                            <select wire:model="unit" id="unit" class="input">
                                <option value="picocoulomb">{{ $lang['5'] }}</option>
                                <option value="nanocoulomb">{{ $lang['6'] }}</option>
                                <option value="microcoulomb">{{ $lang['7'] }}</option>
                                <option value="millicoulomb">{{ $lang['8'] }}</option>
                                <option value="coulomb">{{ $lang['9'] }}</option>
                                <option value="elementry">{{ $lang['10'] }}</option>
                                <option value="ampere">{{ $lang['11'] }}</option>
                                <option value="milliampere">{{ $lang['12'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Permittivity Constant --}}
                    <div class="col-span-7 md:col-span-6 lg:col-span-6">
                        <label for="const" class="label font-s-14 text-blue">(ϵ₀) C²/N∙m²:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model="const" id="const" class="input" />
                            <span class="text-blue absolute right-4 top-1/2 transform -translate-y-1/2">× 10</span>
                        </div>
                    </div>

                    {{-- Power --}}
                    <div class="col-span-5 md:col-span-6 lg:col-span-6">
                        <label class="label">&nbsp;</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model="power" id="power" class="input" />
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    
                    <div class="space-y-6">
                        <div class="text-center">
                            <p class="text-[18px] font-bold"><strong>{{$lang['14']}}</strong></p>
                            <div class="flex justify-center mt-3">
                                <div class="bg-[#2845F5] text-white rounded-xl px-6 py-4 shadow-lg">
                                    <span class="text-2xl font-bold">{{ round($detail['flux'], 4) }}</span>
                                    <span class="text-sm block opacity-80">N·m²/C</span>
                                </div>
                            </div>
                        </div>

                        {{-- Details & Steps --}}
                        <div class="space-y-6">
                            <div>
                                <p class="text-[18px] font-bold text-blue border-b border-blue-200 pb-2 mb-4">{{ $lang['15'] }}</p>
                                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                    <p>|E| = {{ $detail['electric'] }} V/m</p>
                                    <p>|A| = {{ $detail['surface'] }} m²</p>
                                    <p>(θ) = {{ $detail['degree'] }}°</p>
                                    <p>(Q) = {{ $detail['charge'] }} C</p>
                                    <p>(ϵ₀) = \( {{ $detail['const'] }} \times 10^{ {{ $detail['power'] }} } \) C²/N∙m²</p>
                                </div>
                            </div>

                            <div>
                                <p class="text-[18px] font-bold text-blue border-b border-blue-200 pb-2 mb-4">{{ $lang['16'] }}</p>
                                <div class="space-y-6">
                                    {{-- Gauss Law --}}
                                    <div class="space-y-2">
                                        <p class="font-semibold text-blue">{{ $lang['14'] }} {{ $lang['17'] }} (Gauss's Law):</p>
                                        <p>\[ \Phi = \dfrac{Q}{\epsilon_0} \]</p>
                                        <p>\[ \Phi = \dfrac{ {{ $detail['charge'] }} }{ {{ $detail['const'] }} \times 10^{ {{ $detail['power'] }} } } \]</p>
                                        <p class="font-bold text-blue">\[ \Phi = {{ round($detail['flux'], 4) }} \]</p>
                                    </div>

                                    {{-- Inward --}}
                                    <div class="space-y-2">
                                        <p class="font-semibold text-blue">{{ $lang['14'] }} {{ $lang['18'] }}:</p>
                                        <p>\[ \Phi = |E| \cdot |A| \cdot \cos(180^\circ - \theta) \]</p>
                                        <p>\[ \Phi = {{ $detail['electric'] }} \cdot {{ $detail['surface'] }} \cdot \cos(180^\circ - {{ $detail['degree'] }}^\circ) \]</p>
                                        <p class="font-bold text-blue">\[ \Phi = {{ $detail['inward'] }} \]</p>
                                    </div>

                                    {{-- Outward --}}
                                    <div class="space-y-2">
                                        <p class="font-semibold text-blue">{{ $lang['14'] }} {{ $lang['19'] }}:</p>
                                        <p>\[ \Phi = |E| \cdot |A| \cdot \cos(\theta) \]</p>
                                        <p>\[ \Phi = {{ $detail['electric'] }} \cdot {{ $detail['surface'] }} \cdot \cos({{ $detail['degree'] }}^\circ) \]</p>
                                        <p class="font-bold text-blue">\[ \Phi = {{ $detail['outward'] }} \]</p>
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
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    @endpush
</div>
