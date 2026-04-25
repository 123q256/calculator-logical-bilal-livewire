<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">

                {{-- Mode Selector --}}
                <div class="space-y-2 relative">
                    <label for="chemical_selection" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <select wire:model.live="chemical_selection" id="chemical_selection" class="input">
                        <option value="1">{{ $lang[2] }}</option>
                        <option value="2">{{ $lang[3] }}</option>
                        <option value="3">{{ $lang[4] }}</option>
                        <option value="4">{{ $lang[5] }}</option>
                        <option value="5">[H⁺], [OH⁻], or pOH</option>
                    </select>
                </div>

                {{-- Chemical Name (modes 1-4 only) --}}
                @if(in_array($chemical_selection, ['1','2','3','4']))
                <div class="space-y-2 relative">
                    <label for="chemical_name" class="font-s-14 text-blue">
                        @if(in_array($chemical_selection, ['1','3'])) {{ $lang['6'] }} @else Base: @endif
                    </label>
                    <select wire:model.live="chemical_name" id="chemical_name" class="input">
                        @foreach($chemical_options as $val => $name)
                            <option value="{{ $val }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                {{-- Operation selector (mode 5 only) --}}
                @if($chemical_selection == '5')
                <div class="space-y-2 relative">
                    <label for="operation" class="font-s-14 text-blue">{!! $lang['7'] !!}</label>
                    <select wire:model.live="operation" id="operation" class="input">
                        <option value="1">[H⁺]</option>
                        <option value="2">pOH</option>
                        <option value="3">[OH⁻]</option>
                    </select>
                </div>
                @endif

                {{-- Concentration (modes 1, 2, 5 when operation != 2) --}}
                @if(in_array($chemical_selection, ['1','2']) || ($chemical_selection == '5' && $operation != '2'))
                <div class="space-y-2">
                    <label for="concentration" class="font-s-14 text-blue">
                        @if($chemical_selection == '5' && $operation == '1') [H⁺]:
                        @elseif($chemical_selection == '5' && $operation == '3') [OH⁻]:
                        @else {{ $lang['8'] }}:
                        @endif
                    </label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="concentration" id="concentration" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $con_units }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('con_units', 'M'); open = false">molars (M)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('con_units', 'mM'); open = false">millimolars (mM)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('con_units', 'µM'); open = false">micromolars (µM)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('con_units', 'nM'); open = false">nanomolars (nM)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('con_units', 'pM'); open = false">picomolars (pM)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('con_units', 'fM'); open = false">femtomolars (fM)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('con_units', 'aM'); open = false">attomolars (aM)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('con_units', 'zM'); open = false">zeptomolars (zM)</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Weight field (modes 3 & 4) --}}
                @if(in_array($chemical_selection, ['3','4']))
                <div class="space-y-2">
                    <label for="f_length" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="f_length" id="f_length" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $fl_units }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('fl_units', 'ng'); open = false">nanograms (ng)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('fl_units', 'µg'); open = false">micrograms (µg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('fl_units', 'mg'); open = false">milligrams (mg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('fl_units', 'g'); open = false">grams (g)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('fl_units', 'dag'); open = false">decagrams (dag)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('fl_units', 'kg'); open = false">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('fl_units', 't'); open = false">tons (t)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('fl_units', 'gr'); open = false">grain (gr)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('fl_units', 'lbs'); open = false">pounds (lbs)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('fl_units', 'oz'); open = false">ounces (oz)</p>
                        </div>
                    </div>
                </div>

                {{-- Volume field (modes 3 & 4) --}}
                <div class="space-y-2">
                    <label for="post_space" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="post_space" id="post_space" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $po_units }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('po_units', 'mm³'); open = false">cubic millimeters (mm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('po_units', 'cm³'); open = false">cubic centimeters (cm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('po_units', 'dm³'); open = false">cubic decimeters (dm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('po_units', 'm³'); open = false">cubic meters (m³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('po_units', 'ml'); open = false">milliliters (ml)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('po_units', 'cl'); open = false">centiliters (cl)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('po_units', 'liters'); open = false">liters</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('po_units', 'US gal'); open = false">US gallons (US gal)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('po_units', 'UK gal'); open = false">UK gallons (UK gal)</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- pOH input (mode 5, operation=2) --}}
                @if($chemical_selection == '5' && $operation == '2')
                <div class="space-y-2">
                    <label for="second" class="font-s-14 text-blue">pOH:</label>
                    <input type="number" step="any" wire:model="second" id="second" class="input" aria-label="input" placeholder="00" />
                </div>
                @endif

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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full rounded-lg mt-3">
                    <div class="w-full mt-2">
                        @if(isset($detail['pH']))
                            <p class="text-xl font-semibold">pH:</p>
                            <p class="text-[#119154] text-3xl font-semibold">{!! $detail['pH'] !!}</p>
                        @endif
                        <div class="w-full overflow-auto mt-3">
                            <table class="w-full lg:w-1/2 border-collapse">
                                @if(isset($detail['H']))
                                <tr>
                                    <td class="border-b py-2 font-semibold">[H⁺]</td>
                                    <td class="border-b py-2 font-semibold">{!! $detail['H'] !!}</td>
                                </tr>
                                @endif
                                @if(isset($detail['pho']))
                                <tr>
                                    <td class="border-b py-2 font-semibold">pOH</td>
                                    <td class="border-b py-2 font-semibold">{!! $detail['pho'] !!}</td>
                                </tr>
                                @endif
                                @if(isset($detail['OH']))
                                <tr>
                                    <td class="border-b py-2 font-semibold">OH⁻</td>
                                    <td class="border-b py-2 font-semibold">{!! $detail['OH'] !!}</td>
                                </tr>
                                @endif
                                @if(isset($detail['pka']))
                                <tr>
                                    <td class="border-b py-2 font-semibold">Pka:</td>
                                    <td class="border-b py-2 font-semibold">{!! $detail['pka'] !!}</td>
                                </tr>
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
