<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 relative">
                        <label for="selection" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                        <select wire:model.live="selection" id="selection" class="input">
                            <option value="1">{!! $lang['2'] !!}</option>
                            <option value="2">{!! $lang['3'] !!}</option>
                        </select>
                    </div>

                    @if($selection == '1')
                        <div class="space-y-2">
                            <label for="concentration_one" class="font-s-14 text-blue">{{ $lang['2'] }} [A]:</label>
                            <div class="relative w-full" x-data="{ open: false }">
                                <input type="number" wire:model="concentration_one" id="concentration_one" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $concentration_one_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                    @foreach(['M', 'mM', 'μM', 'nM', 'pM', 'fM', 'aM', 'zM', 'yM'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('concentration_one_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="a" class="font-s-14 text-blue">{!! $lang['4'] !!} a:</label>
                            <input type="number" step="any" wire:model="a" id="a" class="input" />
                        </div>
                        <div class="space-y-2">
                            <label for="concentration_two" class="font-s-14 text-blue">{{ $lang['2'] }} [B]:</label>
                            <div class="relative w-full" x-data="{ open: false }">
                                <input type="number" wire:model="concentration_two" id="concentration_two" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $concentration_two_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                    @foreach(['M', 'mM', 'μM', 'nM', 'pM', 'fM', 'aM', 'zM', 'yM'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('concentration_two_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="b" class="font-s-14 text-blue">{!! $lang['4'] !!} b:</label>
                            <input type="number" step="any" wire:model="b" id="b" class="input" />
                        </div>
                        <div class="space-y-2">
                            <label for="concentration_three" class="font-s-14 text-blue">{{ $lang['2'] }} [C]:</label>
                            <div class="relative w-full" x-data="{ open: false }">
                                <input type="number" wire:model="concentration_three" id="concentration_three" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $concentration_three_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                    @foreach(['M', 'mM', 'μM', 'nM', 'pM', 'fM', 'aM', 'zM', 'yM'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('concentration_three_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="c" class="font-s-14 text-blue">{!! $lang['4'] !!} c:</label>
                            <input type="number" step="any" wire:model="c" id="c" class="input" />
                        </div>
                        <div class="space-y-2">
                            <label for="concentration_four" class="font-s-14 text-blue">{{ $lang['2'] }} [D]:</label>
                            <div class="relative w-full" x-data="{ open: false }">
                                <input type="number" wire:model="concentration_four" id="concentration_four" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $concentration_four_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                                    @foreach(['M', 'mM', 'μM', 'nM', 'pM', 'fM', 'aM', 'zM', 'yM'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('concentration_four_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="d" class="font-s-14 text-blue">{!! $lang['4'] !!} d:</label>
                            <input type="number" step="any" wire:model="d" id="d" class="input" />
                        </div>
                    @else
                        <div class="space-y-2">
                            <label for="chemical_equation" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                            <input type="text" wire:model="chemical_equation" id="chemical_equation" class="input" placeholder="4NO2 + O2 = 2N2O5" />
                        </div>
                        <div class="space-y-2">
                            <label for="total_pressure" class="font-s-14 text-blue">Total Pressure:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model="total_pressure" id="total_pressure" class="input" />
                                <span class="text-blue input_unit">atm</span>
                            </div>
                        </div>
                    @endif
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @if(isset($detail['answer']) && $detail['answer'] != "")
                                    <p class="text-center"><strong>{!! $lang['7'] !!} (Kc)</strong></p>
                                    <p class="text-center my-1"><strong class="text-[#119154] text-[30px]">{!! round($detail['answer'], 4) !!}</strong></p>
                                @endif

                                @if(isset($detail['eqn_html']))
                                    <div class="text-center text-blue-600 text-xl font-bold">Equilibrium Constant k<sub>p</sub></div>
                                    <div class="text-center text-orange-500 text-3xl font-bold mt-2">{!! number_format($detail['kp'], 4) !!}</div>
                                    
                                    <div class="text-center mt-6 mb-2 text-lg font-semibold">Balanced Equation</div>
                                    <div class="text-center mb-6 text-2xl">{!! $detail['eqn_html'] !!}</div>

                                    <div class="overflow-auto mt-4">
                                        <table class="w-full border-collapse">
                                            <thead>
                                                <tr class="bg-gray-100">
                                                    <th class="p-2 border">Compound</th>
                                                    <th class="p-2 border">Moles</th>
                                                    <th class="p-2 border">Mole Fraction</th>
                                                    <th class="p-2 border">Partial Pressure</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-blue-50"><th colspan="4" class="p-2 border text-left">Reactants</th></tr>
                                                @foreach($detail['reactants'] as $data)
                                                    <tr>
                                                        <td class="p-2 border text-center">{!! $data['name'] !!}</td>
                                                        <td class="p-2 border text-center">{{ number_format($data['moles'], 4) }} mol</td>
                                                        <td class="p-2 border text-center">{{ number_format($data['fraction'], 4) }}</td>
                                                        <td class="p-2 border text-center">{{ number_format($data['partial'], 4) }} atm</td>
                                                    </tr>
                                                @endforeach
                                                <tr class="bg-green-50"><th colspan="4" class="p-2 border text-left">Products</th></tr>
                                                @foreach($detail['products'] as $data)
                                                    <tr>
                                                        <td class="p-2 border text-center">{!! $data['name'] !!}</td>
                                                        <td class="p-2 border text-center">{{ number_format($data['moles'], 4) }} mol</td>
                                                        <td class="p-2 border text-center">{{ number_format($data['fraction'], 4) }}</td>
                                                        <td class="p-2 border text-center">{{ number_format($data['partial'], 4) }} atm</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <script>
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('scroll-to-result', () => {
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                });
            });
        </script>
    @endpush
</div>
