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
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
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

                    <div class="flex justify-center">
                        @if ($type == 'calculator')
                            @include('inc.button')
                        @elseif ($type == 'widget')
                            @include('inc.widget-button')
                        @endif
                    </div>
                </div>
            </div>
        </form>
        <hr>

        @if($detail)
            <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 rounded-lg mt-6">
                <div class="lg:w-[90%] mx-auto">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="mt-4">
                        {{-- Your Input --}}
                        <div class="text-center mb-4">
                            <h3 class="font-bold text-gray-800 text-lg">Your Input</h3>
                            <p class="text-gray-700 mt-1">{{ $eq }}</p>
                        </div>

                        {{-- Balanced Equation Box --}}
                        <div class="text-center mb-8">
                            <h3 class="font-bold text-gray-800 text-lg mb-3">Balanced Equation</h3>
                            
                            {{-- Formatted output using native HTML/Blade instead of MathJax --}}
                            <div id="equ" class="text-xl md:text-2xl font-bold tracking-wide flex items-center justify-center flex-wrap">
                                @foreach($reactants as $index => $r)
                                    @if($index > 0) <span class="mx-2 text-gray-600">+</span> @endif
                                    <span class="inline-flex items-baseline">
                                        @if($r['coeff'] > 1)<span class="text-blue-700 mr-1">{{ $r['coeff'] }}</span>@endif
                                        <span class="text-yellow-600">{!! preg_replace('/(\d+)/', '<sub class="text-[0.7em] ml-0.5">$1</sub>', $r['formula']) !!}</span>
                                    </span>
                                @endforeach
                                
                                <span class="text-green-600 mx-4">&rarr;</span>
                                
                                @foreach($products as $index => $p)
                                    @if($index > 0) <span class="mx-2 text-gray-600">+</span> @endif
                                    <span class="inline-flex items-baseline">
                                        @if($p['coeff'] > 1)<span class="text-blue-700 mr-1">{{ $p['coeff'] }}</span>@endif
                                        <span class="text-orange-500">{!! preg_replace('/(\d+)/', '<sub class="text-[0.7em] ml-0.5">$1</sub>', $p['formula']) !!}</span>
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Mode Switcher --}}
                        <div class="flex justify-center mb-8">
                            <div class="inline-flex p-1 bg-[#e8f0fe] rounded-lg border border-blue-400 shadow-sm w-full max-w-lg">
                                <button type="button" wire:click="setMode('stoichiometry')" class="w-1/2 py-2.5 px-4 rounded-md text-sm font-semibold transition-all duration-300 {{ $mode === 'stoichiometry' ? 'bg-[#3b5af1] text-white shadow' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                                    Reaction Stoichiometry
                                </button>
                                <button type="button" wire:click="setMode('limiting')" class="w-1/2 py-2.5 px-4 rounded-md text-sm font-semibold transition-all duration-300 {{ $mode === 'limiting' ? 'bg-[#3b5af1] text-white shadow' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                                    Limiting Reagent
                                </button>
                            </div>
                        </div>

                        @if($limiting_message)
                            <div class="bg-blue-50 text-blue-700 p-3 rounded-lg text-center font-bold mb-6 border border-blue-200">
                                {{ $limiting_message }}
                            </div>
                        @endif

                        {{-- Interactive Results Table --}}
                        <div class="overflow-x-auto w-full">
                            <table class="w-full border-collapse text-left">
                                <thead>
                                    <tr class="border-b-2 border-white">
                                        <th class="px-1 md:px-3 py-2 md:py-3 font-bold text-gray-800 text-[11px] md:text-sm">Compound</th>
                                        <th class="px-1 md:px-3 py-2 md:py-3 font-bold text-gray-800 text-[11px] md:text-sm">Coefficient</th>
                                        <th class="px-1 md:px-3 py-2 md:py-3 font-bold text-gray-800 text-[11px] md:text-sm text-center">Molar<br>Mass</th>
                                        <th class="px-1 md:px-3 py-2 md:py-3 font-bold text-gray-800 text-[11px] md:text-sm text-center">Moles<span class="hidden md:inline">(g/mol)</span></th>
                                        <th class="px-1 md:px-3 py-2 md:py-3 font-bold text-gray-800 text-[11px] md:text-sm text-center">Weight<span class="hidden md:inline">(g)</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Reactants --}}
                                    <tr class="border-b-2 border-white">
                                        <td colspan="5" class="px-2 py-2 md:py-3 font-bold text-gray-800 text-center text-xs md:text-base">Reactants</td>
                                    </tr>
                                    @foreach($reactants as $index => $reactant)
                                        <tr class="border-b-2 border-white">
                                            <td class="px-1 md:px-3 py-2 md:py-4 text-gray-800 text-xs md:text-base">{!! preg_replace('/(\d+)/', '<sub class="text-[0.7em] ml-0.5">$1</sub>', $reactant['formula']) !!}</td>
                                            <td class="px-1 md:px-3 py-2 md:py-4 text-gray-800 text-xs md:text-base text-center md:text-left">{{ $reactant['coeff'] }}</td>
                                            <td class="px-1 md:px-3 py-2 md:py-4 text-gray-800 text-center text-xs md:text-base">{{ $reactant['molar_mass'] }}</td>
                                            <td class="px-1 md:px-3 py-2 md:py-3">
                                                <input type="number" step="any" wire:model.live.debounce.400ms="reactants.{{ $index }}.moles" class="w-full min-w-[60px] md:min-w-[100px] border border-blue-500 rounded-lg p-1.5 md:p-2 focus:ring-2 focus:ring-blue-300 outline-none transition-all bg-white text-center text-gray-800 font-medium text-xs md:text-base" placeholder="">
                                            </td>
                                            <td class="px-1 md:px-3 py-2 md:py-3">
                                                <input type="number" step="any" wire:model.live.debounce.400ms="reactants.{{ $index }}.weight" class="w-full min-w-[60px] md:min-w-[100px] border border-blue-500 rounded-lg p-1.5 md:p-2 focus:ring-2 focus:ring-blue-300 outline-none transition-all bg-white text-center text-gray-800 font-medium text-xs md:text-base" placeholder="">
                                            </td>
                                        </tr>
                                    @endforeach

                                    {{-- Products --}}
                                    <tr class="border-b-2 border-white">
                                        <td colspan="5" class="px-2 py-2 md:py-3 font-bold text-gray-800 text-center text-xs md:text-base">Products</td>
                                    </tr>
                                    @foreach($products as $index => $product)
                                        <tr class="border-b-2 border-white">
                                            <td class="px-1 md:px-3 py-2 md:py-4 text-gray-800 text-xs md:text-base">{!! preg_replace('/(\d+)/', '<sub class="text-[0.7em] ml-0.5">$1</sub>', $product['formula']) !!}</td>
                                            <td class="px-1 md:px-3 py-2 md:py-4 text-gray-800 text-xs md:text-base text-center md:text-left">{{ $product['coeff'] }}</td>
                                            <td class="px-1 md:px-3 py-2 md:py-4 text-gray-800 text-center text-xs md:text-base">{{ $product['molar_mass'] }}</td>
                                            <td class="px-1 md:px-3 py-2 md:py-3">
                                                <input type="number" step="any" wire:model.live.debounce.400ms="products.{{ $index }}.moles" class="w-full min-w-[60px] md:min-w-[100px] border border-blue-500 rounded-lg p-1.5 md:p-2 focus:ring-2 focus:ring-blue-300 outline-none transition-all disabled:bg-gray-100 disabled:border-gray-300 disabled:opacity-70 bg-white text-center text-gray-800 font-medium text-xs md:text-base" placeholder="" {{ $mode === 'limiting' ? 'disabled' : '' }}>
                                            </td>
                                            <td class="px-1 md:px-3 py-2 md:py-3">
                                                <input type="number" step="any" wire:model.live.debounce.400ms="products.{{ $index }}.weight" class="w-full min-w-[60px] md:min-w-[100px] border border-blue-500 rounded-lg p-1.5 md:p-2 focus:ring-2 focus:ring-blue-300 outline-none transition-all disabled:bg-gray-100 disabled:border-gray-300 disabled:opacity-70 bg-white text-center text-gray-800 font-medium text-xs md:text-base" placeholder="" {{ $mode === 'limiting' ? 'disabled' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
