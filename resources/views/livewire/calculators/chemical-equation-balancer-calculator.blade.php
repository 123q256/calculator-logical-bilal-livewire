<div>
    <style>
        .tagsUnit {
            background-color: #2845F5 !important;
            color: white !important;
        }
        .tab:hover {
            background-color: #f3f4f6;
        }
        .tagsUnit:hover {
            background-color: #1e3a8a !important;
        }
        input:disabled {
            background-color: #f3f4f6;
            cursor: not-allowed;
            opacity: 0.7;
        }
        /* Custom scrollbar for table */
        .table-container::-webkit-scrollbar {
            height: 6px;
        }
        .table-container::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
    </style>

    <div class="w-full" wire:key="main-balancer-container">
        <form wire:submit.prevent="calculate">
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3 shadow-sm border border-gray-100">
                @if ($error)
                    <div class="bg-red-50 text-red-600 p-4 rounded-xl border border-red-100 font-semibold mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $error }}
                    </div>
                @endif

                <div class="lg:w-[85%] md:w-[90%] w-full mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                        
                        {{-- Input Section --}}
                        <div class="lg:col-span-7 space-y-4">
                            <div class="flex items-center justify-between mb-2">
                                <label class="label font-bold text-blue text-xs tracking-wider uppercase">{!! $lang['1'] !!}:</label>
                            </div>
                            <div class="mb-4">
                                <button type="button" wire:click="loadExample" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg text-[11px] font-bold uppercase tracking-widest shadow-md hover:bg-blue-700 hover:shadow-lg transition-all active:scale-95">
                                    {!! $lang['2'] !!}
                                </button>
                            </div>
                            <div class="relative">
                                <input type="text" wire:model="eq" id="chemical-eq-input" class="border-2 border-gray-200 p-4 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 w-full outline-none font-medium text-lg text-gray-700 transition-all shadow-inner" placeholder="Fe + O2 = Fe2O3">
                            </div>
                        </div>

                        {{-- Examples Sidebar --}}
                        <div class="lg:col-span-5 bg-gradient-to-br from-blue-50 to-blue-100/50 p-5 rounded-2xl border border-blue-100 shadow-sm">
                            <h4 class="text-[11px] font-extrabold text-blue-700 uppercase tracking-widest mb-4 flex items-center">
                                <svg class="w-4 h-4 mr-2 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                {{$lang['examp']}}
                            </h4>
                            <ul class="text-sm space-y-2.5">
                                @foreach(['H2 + O2 = H2O', 'CH4 + O2 = CO2 + H2O', 'Mg + HCl = MgCl2 + H2', 'C6H12O6 + O2 = CO2 + H2O', 'NH3 + O2 = NO + H2O', 'Al + Fe2O4 = Fe + Al2O3'] as $example)
                                    <li>
                                        <button type="button" wire:click="setEquation('{{ $example }}')" class="eq_link w-full text-left cursor-pointer text-gray-600 hover:text-blue-700 transition-colors py-1.5 border-b border-dashed border-gray-300 hover:border-blue-400 font-medium group">
                                            <span class="group-hover:translate-x-1 inline-block transition-transform duration-200">{{ $example }}</span>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="flex justify-center mt-12">
                        @if ($type == 'calculator')
                            @include('inc.button')
                        @elseif ($type == 'widget')
                            @include('inc.widget-button')
                        @endif
                    </div>
                </div>
            </div>
        </form>

        @if($detail)
            <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 mt-8 border-t border-gray-100">
                <div class="lg:w-[90%] mx-auto">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="mt-8">
                        {{-- Balanced Equation Box --}}
                        <div class="bg-gradient-to-b from-white to-gray-50 p-6 lg:p-10 text-center rounded-3xl mb-10 border border-gray-200 shadow-lg relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-blue-600"></div>
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.3em] mb-4">Balanced Equation</p>
                            
                            {{-- Formatted output using native HTML/Blade instead of MathJax --}}
                            <div id="equ" class="text-2xl md:text-3xl font-bold text-gray-800 tracking-wide my-4 flex items-center justify-center flex-wrap">
                                @foreach($reactants as $index => $r)
                                    @if($index > 0) <span class="mx-2">+</span> @endif
                                    <span class="inline-flex items-baseline">
                                        @if($r['coeff'] > 1)<span class="text-blue-600 font-extrabold mr-0.5">{{ $r['coeff'] }}</span>@endif
                                        {!! preg_replace('/(\d+)/', '<sub class="text-[0.7em] ml-0.5">$1</sub>', $r['formula']) !!}
                                    </span>
                                @endforeach
                                
                                <span class="text-green-500 font-bold mx-4 text-3xl">&rarr;</span>
                                
                                @foreach($products as $index => $p)
                                    @if($index > 0) <span class="mx-2">+</span> @endif
                                    <span class="inline-flex items-baseline">
                                        @if($p['coeff'] > 1)<span class="text-blue-600 font-extrabold mr-0.5">{{ $p['coeff'] }}</span>@endif
                                        {!! preg_replace('/(\d+)/', '<sub class="text-[0.7em] ml-0.5">$1</sub>', $p['formula']) !!}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Mode Switcher --}}
                        <div class="flex justify-center mb-10">
                            <div class="inline-flex p-1.5 bg-gray-100/80 rounded-2xl border border-gray-200 shadow-inner w-full max-w-lg relative">
                                <button type="button" wire:click="setMode('stoichiometry')" class="w-1/2 py-3 px-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 {{ $mode === 'stoichiometry' ? 'bg-blue-600 text-white shadow-md' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200/50' }}">
                                    Reaction Stoichiometry
                                </button>
                                <button type="button" wire:click="setMode('limiting')" class="w-1/2 py-3 px-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 {{ $mode === 'limiting' ? 'bg-blue-600 text-white shadow-md' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200/50' }}">
                                    Limiting Reagent
                                </button>
                            </div>
                        </div>

                        @if($limiting_message)
                            <div class="bg-blue-50 text-blue-700 p-4 rounded-xl text-center font-bold mb-6 border border-blue-100 shadow-sm animate-pulse">
                                {{ $limiting_message }}
                            </div>
                        @endif

                        {{-- Interactive Results Table --}}
                        <div class="table-container overflow-x-auto rounded-2xl border border-gray-200 shadow-sm bg-white">
                            <table class="w-full border-collapse text-sm text-left">
                                <thead class="bg-gray-50/80 border-b border-gray-200">
                                    <tr>
                                        <th class="px-5 py-4 font-bold text-gray-500 text-[10px] uppercase tracking-wider">Compound</th>
                                        <th class="px-5 py-4 font-bold text-gray-500 text-[10px] uppercase tracking-wider">Coefficient</th>
                                        <th class="px-5 py-4 font-bold text-gray-500 text-[10px] uppercase tracking-wider">Molar Mass <span class="text-gray-400 lowercase normal-case">(g/mol)</span></th>
                                        <th class="px-5 py-4 font-bold text-gray-500 text-[10px] uppercase tracking-wider">Moles <span class="text-gray-400 lowercase normal-case">(mol)</span></th>
                                        <th class="px-5 py-4 font-bold text-gray-500 text-[10px] uppercase tracking-wider">Weight <span class="text-gray-400 lowercase normal-case">(g)</span></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    {{-- Reactants --}}
                                    <tr class="bg-blue-50/40">
                                        <td colspan="5" class="px-5 py-2.5 font-bold text-blue-600 text-[10px] uppercase tracking-widest text-center">Reactants</td>
                                    </tr>
                                    @foreach($reactants as $index => $reactant)
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="px-5 py-4 font-bold text-gray-800 text-lg">{!! preg_replace('/(\d+)/', '<sub class="text-[0.7em] ml-0.5">$1</sub>', $reactant['formula']) !!}</td>
                                            <td class="px-5 py-4 text-gray-600 font-semibold">{{ $reactant['coeff'] }}</td>
                                            <td class="px-5 py-4 text-gray-500">{{ $reactant['molar_mass'] }}</td>
                                            <td class="px-5 py-3">
                                                <input type="number" step="any" wire:model.live.debounce.400ms="reactants.{{ $index }}.moles" class="w-full border border-gray-200 rounded-lg p-2.5 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" placeholder="0.0">
                                            </td>
                                            <td class="px-5 py-3">
                                                <input type="number" step="any" wire:model.live.debounce.400ms="reactants.{{ $index }}.weight" class="w-full border border-gray-200 rounded-lg p-2.5 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" placeholder="0.0">
                                            </td>
                                        </tr>
                                    @endforeach

                                    {{-- Products --}}
                                    <tr class="bg-green-50/40">
                                        <td colspan="5" class="px-5 py-2.5 font-bold text-green-600 text-[10px] uppercase tracking-widest text-center">Products</td>
                                    </tr>
                                    @foreach($products as $index => $product)
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="px-5 py-4 font-bold text-gray-800 text-lg">{!! preg_replace('/(\d+)/', '<sub class="text-[0.7em] ml-0.5">$1</sub>', $product['formula']) !!}</td>
                                            <td class="px-5 py-4 text-gray-600 font-semibold">{{ $product['coeff'] }}</td>
                                            <td class="px-5 py-4 text-gray-500">{{ $product['molar_mass'] }}</td>
                                            <td class="px-5 py-3">
                                                <input type="number" step="any" wire:model.live.debounce.400ms="products.{{ $index }}.moles" class="w-full border border-gray-200 rounded-lg p-2.5 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all disabled:bg-gray-100 disabled:opacity-60" placeholder="0.0" {{ $mode === 'limiting' ? 'disabled' : '' }}>
                                            </td>
                                            <td class="px-5 py-3">
                                                <input type="number" step="any" wire:model.live.debounce.400ms="products.{{ $index }}.weight" class="w-full border border-gray-200 rounded-lg p-2.5 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all disabled:bg-gray-100 disabled:opacity-60" placeholder="0.0" {{ $mode === 'limiting' ? 'disabled' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            
            {{-- Load MathJax to format equations beautifully --}}
            @push('calculatorJS')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_SVG-full"></script>
                <script type="text/x-mathjax-config">
                    MathJax.Hub.Config({
                        "SVG": { linebreaks: { automatic: true } },
                        messageStyle: "none"
                    });
                </script>
                <script>
                    document.addEventListener('livewire:navigated', () => {
                        if (typeof MathJax !== 'undefined') MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                    });
                    document.addEventListener('livewire:initialized', () => {
                        Livewire.hook('morph.updated', ({ el, component }) => {
                            if (typeof MathJax !== 'undefined') MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                        });
                    });
                </script>
            @endpush
        @endif
    </div>
</div>
