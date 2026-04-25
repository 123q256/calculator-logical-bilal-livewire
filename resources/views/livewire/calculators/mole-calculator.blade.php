<div>
   <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                <div class="space-y-2 relative">
                    <label for="cal" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <select wire:model.live="cal" id="cal" class="input">
                        @php
                            $name = [$lang['2'],$lang['3'],$lang['4']];
                            $val = ["mass","mw","moles"];
                        @endphp
                        @foreach($val as $index => $val_item)
                            <option value="{!! $val_item !!}">
                                {!! $name[$index] !!}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2 mass" style="{{ $cal == 'mass' ? 'display:none;' : '' }}">
                    <label for="mass" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" step="any" wire:model="mass" id="mass" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $mass_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0" style="display: none;">
                            @foreach(['pg' => 'picograms (pg)', 'ng' => 'nanograms (ng)', 'μg' => 'micrograms (μg)', 'mg' => 'milligrams (mg)', 'g' => 'grams (g)', 'dag' => 'decagrams (dag)', 'kg' => 'kilograms (kg)', 't' => 'metric tons (t)', 'oz' => 'ounces (oz)', 'lbs' => 'pounds (lbs)', 'stones' => 'stones', 'US ton' => 'US short tons (US ton)', 'Long ton' => 'imperial tons (Long ton)', 'u' => 'atomic mass units (u)'] as $unit => $label)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('mass_unit', '{{ $unit }}'); open = false">{{ $label }}</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 mw" style="{{ $cal == 'mw' ? 'display:none;' : '' }}">
                    <label for="mw" class="font-s-14 text-blue">{!! $lang['3'] !!} (g/mol):</label>
                    <input type="number" step="any" wire:model="mw" id="mw" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 moles" style="{{ $cal == 'moles' ? 'display:none;' : '' }}">
                    <label for="moles" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" step="any" wire:model="moles" id="moles" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="moles_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $moles_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0" style="display: none;">
                            @foreach(['M' => 'M', 'mM' => 'mM', 'μM' => 'μM', 'nM' => 'nM', 'pM' => 'pM'] as $unit => $label)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('moles_unit', '{{ $unit }}'); open = false">{{ $label }}</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
            </div>
       </div>
        @if ($type == 'calculator')
        @include('inc.button')
       @endif
       @if ($type=='widget')
       @include('inc.widget-button')
        @endif
    </div>
    <hr>
    @isset($detail)
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full p-3 radius-10 mt-3">
                        @php
                            $ans=$detail['ans'];
                            $molecules_22=$detail['molecules_22'];
                            $molecules_23=$detail['molecules_23'];
                            $molecules_24=$detail['molecules_24'];
            
                            if($cal === 'mass'){
                                $head='Mass';
                            }elseif($cal === 'mw'){
                                $head='Molecular Weight';
                            }elseif($cal === 'moles'){
                                $head='Moles';
                            }
                        @endphp
                        <div class="col-12">
                            <p><strong>{{ $head }}</strong></p>
                            <p><strong class="text-[#119154] text-[26px]">{!! $ans !!}</strong></p>
                            <p><strong>Molecules</strong></p>
                            <p class="font-s-20 my-1"><strong class="text-[#119154]">{{ $molecules_22 }}</strong></p>
                            <p class="font-s-20 my-1"><strong class="text-[#119154]">{{ $molecules_23 }}</strong></p>
                            <p class="font-s-20 my-1"><strong class="text-[#119154]">{{ $molecules_24 }}</strong></p>
                            @if($cal !== 'mw')
                                <p class="my-2"><strong>{{ $lang['5'] }}</strong></p>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                    <table class="col-12 col-lg-6" cellspacing="0">
                                        @if($cal === 'mass')
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_pg'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_ng'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_ug'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_mg'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_dag'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_kg'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_t'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_oz'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_lb'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_stone'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_us_ton'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_long_ton'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2">{{ $head }}</td>
                                                <td class='py-2'><strong>{{ $detail['ans_u'] }}</strong></td>
                                            </tr>
                                        @elseif($cal === 'moles')
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_pm'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_nm'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_um'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2">{{ $head }}</td>
                                                <td class='py-2'><strong>{{ $detail['ans_mm'] }}</strong></td>
                                            </tr>
                                        @endif
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
</div>
