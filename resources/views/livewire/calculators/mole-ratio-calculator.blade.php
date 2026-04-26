<div>

    <form wire:submit.prevent="calculate">
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
                @if ($error)
                    <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
                @endif

                <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                    <div class="col-12 col-lg-7 mx-auto">
                        <div class="row">
                            <div class="grid grid-cols-1 mb-6">
                                <div class="w-full input-field px-2">
                                    <label for="find" class="font-s-14 text-blue">Find:</label>
                                    <div class="w-full py-2">
                                        <select wire:model.live="find" id="find" class="input">
                                            <option value="1">Molar Ratio</option>
                                            <option value="2">Mole-Mole Relationship</option>
                                            <option value="3">Mass-Mass Relationship</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Reactants Section --}}
                            <div class="space-y-6">
                                <h3 class="text-xl font-bold text-blue px-2">Reactants</h3>
                                <div class="grid grid-cols-1 {{ $find == 3 ? '' : 'md:grid-cols-2' }} gap-6">
                                    @foreach($reactants as $index => $reactant)
                                        <div class="px-2 space-y-2">
                                            <div class="flex justify-between items-center">
                                                <p><strong class="font-s-14 text-blue">{{ $this->ordinal($index + 1) }} Reactant</strong></p>
                                                @if(count($reactants) > 2)
                                                    <button type="button" wire:click="removeReactant({{ $index }})" class="text-red-500 text-xs underline">Remove</button>
                                                @endif
                                            </div>
                                            
                                            <div class="space-y-2">
                                                <div>
                                                    <label class="font-s-12 text-blue">Coefficient in balanced reaction:</label>
                                                    <input type="number" step="any" wire:model.live="reactants.{{ $index }}.coefficient" class="input" placeholder="00" />
                                                </div>
                                                
                                                @if($find >= 2)
                                                    <div>
                                                        <label class="font-s-12 text-blue">Number of moles or molecules:</label>
                                                        <input type="number" step="any" wire:model.live="reactants.{{ $index }}.moles" class="input" placeholder="00" />
                                                    </div>
                                                @endif
                                            </div>

                                            @if($find == 3)
                                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3">
                                                    @foreach($reactant['atoms'] as $aIndex => $atom)
                                                        <div class="p-3 border rounded-lg bg-gray-50 space-y-2">
                                                            <label class="font-s-12 text-blue block font-bold">Atoms / Element:</label>
                                                            <div class="flex gap-2">
                                                                <input type="number" step="any" wire:model.live="reactants.{{ $index }}.atoms.{{ $aIndex }}.count" class="input w-1/4" placeholder="0" />
                                                                <select wire:model.live="reactants.{{ $index }}.atoms.{{ $aIndex }}.mass" class="input w-3/4 text-xs">
                                                                    @include('livewire.calculators.partials.periodic-table-options')
                                                                </select>
                                                            </div>
                                                            <div class="text-xs text-blue text-right border-t pt-1">
                                                                Mass: <span class="font-bold">{{ number_format(($reactant['atoms'][$aIndex]['mass'] ?? 0) * ($reactant['atoms'][$aIndex]['count'] ?? 0), 4) }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="pt-3 text-sm text-blue font-bold border-t mt-4">
                                                    <div class="flex justify-between"><span>Molecular Weight:</span><span>{{ number_format($reactant['molecular_weight'], 4) }} amu</span></div>
                                                    <div class="flex justify-between text-lg text-blue-800"><span>Total Mass:</span><span>{{ number_format($reactant['mass'], 4) }} g</span></div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <div class="px-2 pt-4">
                                    <button type="button" wire:click="addReactant" class="text-blue font-bold border rounded px-4 py-2 hover:bg-blue-50">+ Add Reactant</button>
                                </div>
                            </div>

                            {{-- Products Section --}}
                            <div class="space-y-6 mt-10">
                                <h3 class="text-xl font-bold text-blue px-2">Products</h3>
                                <div class="grid grid-cols-1 {{ $find == 3 ? '' : 'md:grid-cols-2' }} gap-6">
                                    @foreach($products as $index => $product)
                                        <div class="px-2 space-y-2">
                                            <div class="flex justify-between items-center">
                                                <p><strong class="font-s-14 text-blue">{{ $this->ordinal($index + 1) }} Product</strong></p>
                                                @if(count($products) > 2)
                                                    <button type="button" wire:click="removeProduct({{ $index }})" class="text-red-500 text-xs underline">Remove</button>
                                                @endif
                                            </div>

                                            <div class="space-y-2">
                                                <div>
                                                    <label class="font-s-12 text-blue">Coefficient in balanced reaction:</label>
                                                    <input type="number" step="any" wire:model.live="products.{{ $index }}.coefficient" class="input" placeholder="00" />
                                                </div>
                                                
                                                @if($find >= 2)
                                                    <div>
                                                        <label class="font-s-12 text-blue">Number of moles or molecules:</label>
                                                        <input type="number" step="any" wire:model.live="products.{{ $index }}.moles" class="input" placeholder="00" />
                                                    </div>
                                                @endif
                                            </div>

                                            @if($find == 3)
                                                <div class="mt-4 grid grid-cols-1 xl:grid-cols-2 gap-3">
                                                    @foreach($product['atoms'] as $aIndex => $atom)
                                                        <div class="p-3 border rounded-lg bg-gray-50 space-y-2">
                                                            <label class="font-s-12 text-blue block font-bold">Atoms / Element:</label>
                                                            <div class="flex gap-2">
                                                                <input type="number" step="any" wire:model.live="products.{{ $index }}.atoms.{{ $aIndex }}.count" class="input w-1/4" placeholder="0" />
                                                                <select wire:model.live="products.{{ $index }}.atoms.{{ $aIndex }}.mass" class="input w-3/4 text-xs">
                                                                    @include('livewire.calculators.partials.periodic-table-options')
                                                                </select>
                                                            </div>
                                                            <div class="text-xs text-blue text-right border-t pt-1">
                                                                Mass: <span class="font-bold">{{ number_format(($product['atoms'][$aIndex]['mass'] ?? 0) * ($product['atoms'][$aIndex]['count'] ?? 0), 4) }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="pt-3 text-sm text-blue font-bold border-t mt-4">
                                                    <div class="flex justify-between"><span>Molecular Weight:</span><span>{{ number_format($product['molecular_weight'], 4) }} amu</span></div>
                                                    <div class="flex justify-between text-lg text-blue-800"><span>Total Mass:</span><span>{{ number_format($product['mass'], 4) }} g</span></div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <div class="px-2 pt-4">
                                    <button type="button" wire:click="addProduct" class="text-blue font-bold border rounded px-4 py-2 hover:bg-blue-50">+ Add Product</button>
                                </div>
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

        @isset($detail)
            <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            @php
                                $coefficients = $detail['coefficient'];
                                $products_coeffs = $detail['first_product'];
                                
                                function gcd($a, $b) {
                                    $a = abs($a); $b = abs($b);
                                    if($a < $b) list($b, $a) = [$a, $b];
                                    if($b == 0) return $a;
                                    $r = $a % $b;
                                    while($r > 0) {
                                        $a = $b; $b = $r; $r = $a % $b;
                                    }
                                    return $b;
                                }

                                function simplify($num, $den) {
                                    $g = gcd($num, $den);
                                    return [$num/$g, $den/$g];
                                }

                                function getLabel($index, $isProduct = false) {
                                    $ordinals = ['First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth', 'Ninth', 'Tenth'];
                                    return ($ordinals[$index] ?? ($index + 1) . 'th') . ($isProduct ? ' Product' : ' Reactant');
                                }
                            @endphp

                            <div class="w-full overflow-auto">
                                <table class="w-full text-left" cellspacing="0">
                                    <thead>
                                        <tr class="bg-blue-50">
                                            <th class="text-start text-blue border-b p-3">Description</th>
                                            <th class="text-start text-blue border-b p-3">Molar Ratio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Reactant-Reactant Ratios --}}
                                        @for($i = 0; $i < count($coefficients); $i++)
                                            @for($j = $i + 1; $j < count($coefficients); $j++)
                                                @php $ratio = simplify($coefficients[$i], $coefficients[$j]); @endphp
                                                <tr class="hover:bg-gray-50">
                                                    <td class="border-b p-3">{{ getLabel($i) }} : {{ getLabel($j) }}</td>
                                                    <td class="border-b p-3">{{ $ratio[0] }} : {{ $ratio[1] }}</td>
                                                </tr>
                                            @endfor
                                            
                                            {{-- Reactant-Product Ratios --}}
                                            @foreach($products_coeffs as $k => $pCoeff)
                                                @php $ratio = simplify($coefficients[$i], $pCoeff); @endphp
                                                <tr class="hover:bg-gray-50">
                                                    <td class="border-b p-3">{{ getLabel($i) }} : {{ getLabel($k, true) }}</td>
                                                    <td class="border-b p-3">{{ $ratio[0] }} : {{ $ratio[1] }}</td>
                                                </tr>
                                            @endforeach
                                        @endfor

                                        {{-- Product-Product Ratios --}}
                                        @for($i = 0; $i < count($products_coeffs); $i++)
                                            @for($j = $i + 1; $j < count($products_coeffs); $j++)
                                                @php $ratio = simplify($products_coeffs[$i], $products_coeffs[$j]); @endphp
                                                <tr class="hover:bg-gray-50">
                                                    <td class="border-b p-3">{{ getLabel($i, true) }} : {{ getLabel($j, true) }}</td>
                                                    <td class="border-b p-3">{{ $ratio[0] }} : {{ $ratio[1] }}</td>
                                                </tr>
                                            @endfor
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

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
    </form>
</div>

