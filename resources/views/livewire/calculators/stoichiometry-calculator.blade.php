<div>
    <style>
        [x-cloak] { display: none !important; }
        .bt_set {
            background: #2845F5;
            letter-spacing: 0.5px;
            color: white;
            cursor: pointer;
            padding: 8px 16px;
            font-size: 13px;
            border: none;
            border-radius: 4px;
            box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%);
        }
        .bt_set:hover { background: #1A1A1A; }
        
        .stoich-input {
            border: 1.5px solid #2845F5;
            border-radius: 12px;
            padding: 8px 12px;
            width: 100%;
            transition: all 0.2s;
            outline: none;
            text-align: center;
        }
        .stoich-input:focus {
            box-shadow: 0 0 0 3px rgba(40, 69, 245, 0.2);
            border-color: #1a36d1;
        }
        .stoich-input[readonly] {
            background-color: #ffffff;
            border-color: #2845F5;
            color: #374151;
        }
        .section-divider {
            background-color: #f3f4f6;
            font-weight: 700;
            color: #1f2937;
            text-align: center;
            padding: 8px;
            border-radius: 10px;
        }
        .table-head-text {
            font-weight: 700;
            color: #374151;
            padding: 10px;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2 relative">
                        @php
                            $examples = [
                                "CH4 + O2 = CO2 + 2H2O",
                                "Mg + HCl = MgCl2 + H2",
                                "C6H12O6 + O2 = CO2 + H2O",
                                "H2 + O2 = H2O",
                                "Al + Fe2O4 = Fe + Al2O3",
                                "Fe + O2 = Fe2O3",
                                "NH3 + O2 = NO + H2O"
                            ];
                        @endphp
                        <button type="button" class="bt_set" 
                                onclick="@this.set('eq', '{{ $examples[array_rand($examples)] }}')">
                            {!! $lang['2'] !!}
                        </button>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="eq" class="font-s-14 text-blue cursor-pointer">{!! $lang['1'] !!}:</label>
                        <input type="text" wire:model="eq" id="eq" class="input" placeholder="e.g. Fe + O2 = Fe2O3" />
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    <hr>

    @if($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full bg-white p-3 radius-10 mt-3 overflow-auto">
                        <div class="w-full">
                            <p class="text-center text-gray-500 font-medium text-sm uppercase tracking-wider">Your Input</p>
                            <p class="text-center my-2 text-lg font-bold text-gray-800">{{ $eq }}</p>
                            
                            <p class="text-center mt-8 mb-2 text-gray-500 font-medium text-sm uppercase tracking-wider">Balanced Equation</p>
                            <div class="flex items-center justify-center w-full overflow-x-auto py-4">
                                <div class="text-[12px] lg:text-4xl font-bold whitespace-nowrap px-4">
                                    {!! $this->formatEquation($detail['be']) !!}
                                </div>
                            </div>

                            <div class="lg:w-[98%] mx-auto overflow-auto">
                                <table class="w-full border-separate border-spacing-y-6" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="table-head-text text-left">Compound</th>
                                            <th class="table-head-text text-left">Coefficient</th>
                                            <th class="table-head-text text-left">Molar Mass</th>
                                            <th class="table-head-text text-center">Moles(g/mol)</th>
                                            <th class="table-head-text text-center">Weight(g)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Reactants --}}
                                        <tr>
                                            <td colspan="5" class="section-divider">Reactants</td>
                                        </tr>
                                        @foreach($reactants as $index => $r)
                                            <tr class="align-middle">
                                                <td class="p-2 font-bold text-gray-800 text-lg">{!! $this->formatFormula($r['formula']) !!}</td>
                                                <td class="p-2 text-gray-700 font-bold text-lg">{{ $r['coeff'] }}</td>
                                                <td class="p-2 text-gray-700 font-bold text-lg">{{ number_format($r['molar_mass'], 3) }}</td>
                                                <td class="p-2">
                                                    <input type="number" step="any" wire:model.live="reactants.{{ $index }}.moles" class="stoich-input" placeholder="">
                                                </td>
                                                <td class="p-2">
                                                    <input type="number" step="any" wire:model.live="reactants.{{ $index }}.weight" class="stoich-input" placeholder="">
                                                </td>
                                            </tr>
                                        @endforeach

                                        {{-- Products --}}
                                        <tr>
                                            <td colspan="5" class="section-divider">Products</td>
                                        </tr>
                                        @foreach($products as $index => $p)
                                            <tr class="align-middle">
                                                <td class="p-2 font-bold text-gray-800 text-lg">{!! $this->formatFormula($p['formula']) !!}</td>
                                                <td class="p-2 text-gray-700 font-bold text-lg">{{ $p['coeff'] }}</td>
                                                <td class="p-2">
                                                    <div class="stoich-input readonly">
                                                        {{ number_format($p['molar_mass'], 4) }}
                                                    </div>
                                                </td>
                                                <td class="p-2">
                                                    <input type="number" step="any" wire:model.live="products.{{ $index }}.moles" class="stoich-input" placeholder="">
                                                </td>
                                                <td class="p-2">
                                                    <input type="number" step="any" wire:model.live="products.{{ $index }}.weight" class="stoich-input" placeholder="">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
