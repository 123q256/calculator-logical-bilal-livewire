<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                <div class="space-y-2 ">
                    <label for="cal" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <select wire:model.live="cal" id="cal" class="input">
                        @php
                            $name = ["E𝒸ₑₗₗ","Eᵒ","T","n","Q"];
                            $val = ["ecell","eo","t","n","q"];
                        @endphp
                        @foreach($val as $index => $val_item)
                            <option value="{!! $val_item !!}">
                                {!! $name[$index] !!}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-4">
                <div class="space-y-2 ecell" style="{{ $cal == 'ecell' ? 'display:none;' : '' }}">
                    <label for="ecell" class="font-s-14 text-blue">E<sub>{{ $lang['2'] }}</sub> <span class="bg-white radius-circle px-2" title="Electromotive force of the cell">?</span>:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="ecell" id="ecell" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="ecell_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $ecell_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('ecell_unit', 'mV'); open = false">mV</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('ecell_unit', 'V'); open = false">V</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 eo" style="{{ $cal == 'eo' ? 'display:none;' : '' }}">
                    <label for="eo" class="font-s-14 text-blue">E<sup>o</sup> <span class="bg-white radius-circle px-2" title="Standard Electrode potential of the cell">?</span>:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="eo" id="eo" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="eo_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $eo_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('eo_unit', 'mV'); open = false">mV</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('eo_unit', 'V'); open = false">V</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 t" style="{{ $cal == 't' ? 'display:none;' : '' }}">
                    <label for="t" class="font-s-14 text-blue">T <span class="bg-white radius-circle px-2" title="Temperature">?</span>:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="t" id="t" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $t_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('t_unit', '°C'); open = false">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('t_unit', '°F'); open = false">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('t_unit', 'K'); open = false">K</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 n" style="{{ $cal == 'n' ? 'display:none;' : '' }}">
                    <label for="n" class="font-s-14 text-blue">n <span class="bg-white radius-circle px-2" title="The number of electrons transferred per cell reaction">?</span>:</label>
                    <input type="number" step="any" wire:model="n" id="n" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 q" style="{{ $cal == 'q' ? 'display:none;' : '' }}">
                    <label for="q" class="font-s-14 text-blue">Q <span class="bg-white radius-circle px-2" title="Reaction Quotient">?</span>:</label>
                    <input type="number" step="any" wire:model="q" id="q" class="input" aria-label="input" placeholder="00" />
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
               <div class="rounded-lg  flex items-center justify-center">
                
                <div class="w-full mt-3">
                    <div class="w-full text-center">
                        @php
                            $ans=$detail['ans'];
                            if($cal === 'ecell'){
                                $head="E<sub>cell</sub>";
                            }elseif($cal === 'eo'){
                                $head="E<sup>o</sup>";
                            }elseif($cal === 't'){
                                $head="Temperature";
                            }elseif($cal === 'n'){
                                $head="Number of Electrons";
                            }elseif($cal === 'q'){
                                $head="Reaction Quotient";
                            }
                        @endphp
                        <p><strong class="text-[20px]">{!! $head !!}</strong></p>
                        <p><strong class="text-[#119154] text-[28px]">{!! $ans !!}</strong></p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
