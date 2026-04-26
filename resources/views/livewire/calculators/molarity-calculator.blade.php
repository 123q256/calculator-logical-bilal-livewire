<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <!-- Mode Selection -->
                    <div class="space-y-2 relative">
                        <label for="cal" class="font-s-14 text-blue">{!! $lang['15'] !!}:</label>
                        <select wire:model.live="cal" id="cal" class="input">
                            <option value="mass">{!! $lang['1'] !!}</option>
                            <option value="vol">{!! $lang['2'] !!}</option>
                            <option value="mol">{!! $lang['3'] !!}</option>
                            <option value="rv">{!! $lang['4'] !!}</option>
                        </select>
                    </div>

                    @if($cal !== 'rv')
                        <!-- Molecular Weight (g/mol) -->
                        <div class="space-y-2 mw">
                            <label for="mw" class="font-s-14 text-blue">{!! $lang['7'] !!} (g/mol):</label>
                            <input type="number" step="any" wire:model.live="mw" id="mw" class="input" placeholder="00" />
                        </div>
                    @endif

                    @if($cal === 'vol' || $cal === 'mol')
                        <!-- Mass -->
                        <div class="space-y-2 mass">
                            <label for="mass" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="mass" id="mass" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('mass_unit_dropdown')">{{ $mass_unit }} ▾</label>
                                @if ($showDropdown === 'mass_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['pg', 'ng', 'μg', 'mg', 'g', 'kg'] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('mass_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($cal === 'mass' || $cal === 'mol')
                        <!-- Volume -->
                        <div class="space-y-2 vol">
                            <label for="vol" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="vol" id="vol" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('vol_unit_dropdown')">{{ $vol_unit }} ▾</label>
                                @if ($showDropdown === 'vol_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['nL', 'μL', 'mL', 'L'] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('vol_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($cal === 'mass' || $cal === 'vol')
                        <!-- Concentration -->
                        <div class="space-y-2 conc">
                            <label for="conc" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="conc" id="conc" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('conc_unit_dropdown')">{{ $conc_unit }} ▾</label>
                                @if ($showDropdown === 'conc_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['fM', 'pM', 'nM', 'μM', 'mM', 'M'] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('conc_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($cal === 'rv')
                        <!-- Stock Concentration -->
                        <div class="space-y-2 sc">
                            <label for="sc" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="sc" id="sc" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('sc_unit_dropdown')">{{ $sc_unit }} ▾</label>
                                @if ($showDropdown === 'sc_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['fM', 'pM', 'nM', 'μM', 'mM', 'M'] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('sc_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Desired Concentration -->
                        <div class="space-y-2 dc">
                            <label for="dc" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="dc" id="dc" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('dc_unit_dropdown')">{{ $dc_unit }} ▾</label>
                                @if ($showDropdown === 'dc_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['fM', 'pM', 'nM', 'μM', 'mM', 'M'] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('dc_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Desired Volume -->
                        <div class="space-y-2 dv">
                            <label for="dv" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="dv" id="dv" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('dv_unit_dropdown')">{{ $dv_unit }} ▾</label>
                                @if ($showDropdown === 'dv_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['nL', 'μL', 'mL', 'L'] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('dv_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex justify-center gap-4">
                @if ($type == 'calculator')
                    @include('inc.button')
                @else
                    @include('inc.widget-button')
                @endif
            </div>
        </div>

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full result p-3 radius-10 mt-3">
                            @php
                                $ans = $detail['ans'];
                                if($cal === 'mass'){
                                    $head = $lang['5'];
                                } elseif($cal === 'vol'){
                                    $head = $lang['8'];
                                } elseif($cal === 'mol'){
                                    $head = $lang['12'];
                                } elseif($cal === 'rv'){
                                    $head = $lang['13'];
                                }
                            @endphp
                            <div class="w-full">
                                <p class=""><strong>{{ $head }}</strong></p>
                                <p class=""><strong class="text-green font-s-32">{!! $ans !!}</strong></p>
                                <p class="my-2"><strong>{{ $lang['14'] }}</strong></p>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                    <table class="col-12 col-lg-7" cellspacing="0">
                                        @if($cal === 'mass')
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_pg'] }}</strong></td></tr>
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_ng'] }}</strong></td></tr>
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_ug'] }}</strong></td></tr>
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_g'] }}</strong></td></tr>
                                            <tr><td class="py-2">{{ $head }}</td><td class='py-2'><strong>{{ $detail['ans_kg'] }}</strong></td></tr>
                                        @elseif($cal === 'vol' || $cal === 'rv')
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_nl'] }}</strong></td></tr>
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_ul'] }}</strong></td></tr>
                                            <tr><td class="py-2">{{ $head }}</td><td class='py-2'><strong>{{ $detail['ans_l'] }}</strong></td></tr>
                                        @elseif($cal === 'mol')
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_fm'] }}</strong></td></tr>
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_pm'] }}</strong></td></tr>
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_nm'] }}</strong></td></tr>
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_um'] }}</strong></td></tr>
                                            <tr><td class="py-2">{{ $head }}</td><td class='py-2'><strong>{{ $detail['ans_m'] }}</strong></td></tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
    
</div>
