<div>
 <form wire:submit.prevent="calculate">
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 gap-4">
                <div class="space-y-2 relative">
                    <label for="formula" class="label">{!! $lang['1'] !!}:</label>
                    <select wire:model.live="formula" id="formula" class="input">
                        @php
                            $name = ["Dalton's law","Ideal gas law","Henry's law - method 1","Henry's law - method 2"];
                            $val = ["1","2","3","4"];
                        @endphp
                        @foreach($val as $index => $val_item)
                            <option value="{!! $val_item !!}">{!! $name[$index] !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="formula1" style="{{ $formula != '1' ? 'display:none;' : '' }}">
                <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="to_cal1" class="label">{!! $lang['2'] !!}:</label>
                            <select wire:model.live="to_cal1" id="to_cal1" class="input">
                                @php
                                    $name = [$lang[3],$lang[4],$lang[5]];
                                    $val = ["1","2","3"];
                                @endphp
                                @foreach($val as $index => $val_item)
                                    <option value="{!! $val_item !!}">{!! $name[$index] !!}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="space-y-2 total" style="{{ $to_cal1 == '3' ? 'display:none;' : '' }}">
                        <label for="total" class="label">{{ $lang['5'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="total" id="total" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label for="total_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $total_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                @foreach(['Pa','Bar','Torr','psi','atm','hPa','MPa','kPa','GPa','mmHg','in Hg'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('total_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mole" style="{{ $to_cal1 == '2' ? 'display:none;' : '' }}">
                        <label for="mole" class="label">{!! $lang['4'] !!}:</label>
                            <input type="number" step="any" wire:model="mole" id="mole" class="input" min="0" max="1" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2 partial" style="{{ $to_cal1 == '1' ? 'display:none;' : '' }}">
                        <label for="partial" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="partial" id="partial" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label for="part_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $part_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                @foreach(['Pa','Bar','Torr','psi','atm','hPa','MPa','kPa','GPa','mmHg','in Hg'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('part_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="formula2" style="{{ $formula != '2' ? 'display:none;' : '' }}">
                 <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="to_cal2" class="label">{!! $lang['2'] !!}:</label>
                            <select wire:model.live="to_cal2" id="to_cal2" class="input">
                                @php
                                    $name = [$lang[3],$lang[8],$lang[7],$lang[12]];
                                    $val = ["1","2","3","4"];
                                @endphp
                                @foreach($val as $index => $val_item)
                                    <option value="{!! $val_item !!}">{!! $name[$index] !!}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="space-y-2 amole" style="{{ $to_cal2 == '4' ? 'display:none;' : '' }}">
                        <label for="amole" class="label">{!! $lang['6'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model="amole" id="amole" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit absolute right-6 top-8">mol</span>
                        </div>
                    </div>
                    <div class="space-y-2 temp" style="{{ $to_cal2 == '3' ? 'display:none;' : '' }}">
                        <label for="temp" class="label">{{ $lang['7'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="temp" id="temp" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label for="temp_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $temp_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                @foreach(['°C','°F','K'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('temp_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 volume" style="{{ $to_cal2 == '2' ? 'display:none;' : '' }}">
                        <label for="volume" class="label">{{ $lang['8'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="volume" id="volume" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label for="vol_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $vol_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                @foreach(['mm³','cm³','dm³','m³','in³','ft³','yd³','litre'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('vol_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 partial1" style="{{ $to_cal2 == '1' ? 'display:none;' : '' }}">
                        <label for="partial1" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="partial1" id="partial1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label for="part_unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $part_unit1 }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                @foreach(['Pa','Bar','Torr','psi','atm','hPa','MPa','kPa','GPa','mmHg','in Hg'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('part_unit1', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            
            <div class="henry1" style="{{ $formula != '3' ? 'display:none;' : '' }}">
               <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="to_cal3" class="label">{!! $lang['2'] !!}:</label>
                            <select wire:model.live="to_cal3" id="to_cal3" class="input">
                                @php
                                    $name = [$lang[3],$lang[9]];
                                    $val = ["1","2"];
                                @endphp
                                @foreach($val as $index => $val_item)
                                    <option value="{!! $val_item !!}">{!! $name[$index] !!}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="space-y-2">
                        <label for="gas" class="label">{!! $lang['10'] !!}:</label>
                            <select wire:model.live="gas" id="gas" class="input">
                                @php
                                    $name = [$lang[13],$lang[14],$lang[15],$lang[16],$lang[17],$lang[18],$lang[19],$lang[20],$lang[21]];
                                    $val = ["1","2","3","4","5","6","7","8","9"];
                                @endphp
                                @foreach($val as $index => $val_item)
                                    <option value="{!! $val_item !!}">{!! $name[$index] !!}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="space-y-2 const" style="{{ $gas == '9' ? '' : 'display:none;' }}">
                        <label for="cons" class="label">{!! $lang['22'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model="cons" id="cons" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input-unit absolute right-6 top-2">litre*atm/mol</span>
                        </div>
                    </div>
                    <div class="space-y-2 conc" style="{{ $to_cal3 == '2' ? 'display:none;' : '' }}">
                        <label for="conc" class="label">{{ $lang['9'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="conc" id="conc" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label for="conc_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $conc_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                @foreach(['M','mM','μM','nM','pM','fM','aM','zM','yM'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('conc_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 partial2" style="{{ $to_cal3 == '1' ? 'display:none;' : '' }}">
                        <label for="partial2" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="partial2" id="partial2" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label for="part_unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $part_unit2 }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                @foreach(['Pa','Bar','Torr','psi','atm','hPa','MPa','kPa','GPa','mmHg','in Hg'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('part_unit2', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="henry2" style="{{ $formula != '4' ? 'display:none;' : '' }}">
               <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="to_cal4" class="label">{!! $lang['2'] !!}:</label>
                            <select wire:model.live="to_cal4" id="to_cal4" class="input">
                                @php
                                    $name = [$lang[3],$lang[4]];
                                    $val = ["1","2"];
                                @endphp
                                @foreach($val as $index => $val_item)
                                    <option value="{!! $val_item !!}">{!! $name[$index] !!}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="space-y-2">
                        <label for="gas1" class="label">{!! $lang['10'] !!}:</label>
                            <select wire:model.live="gas1" id="gas1" class="input">
                                @php
                                    $name = [$lang[13],$lang[14],$lang[15],$lang[16],$lang[17],$lang[18],$lang[19],$lang[20],$lang[21]];
                                    $val = ["1","2","3","4","5","6","7","8","9"];
                                @endphp
                                @foreach($val as $index => $val_item)
                                    <option value="{!! $val_item !!}">{!! $name[$index] !!}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="space-y-2 cons1" style="{{ $gas1 == '9' ? '' : 'display:none;' }}">
                        <label for="cons1" class="label">{!! $lang['22'] !!}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="cons1" id="cons1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label for="cons1_unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $cons1_unit2 }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                @foreach(['Pa','Bar','Torr','psi','atm','hPa','MPa','kPa','GPa','mmHg','in Hg'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('cons1_unit2', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 mole1" style="{{ $to_cal4 == '2' ? 'display:none;' : '' }}">
                        <label for="mole1" class="label">{!! $lang['4'] !!}:</label>
                            <input type="number" step="any" wire:model="mole1" id="mole1" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2 partial3" style="{{ $to_cal4 == '1' ? 'display:none;' : '' }}">
                        <label for="partial3" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="partial3" id="partial3" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label for="part_unit3" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $part_unit3 }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display: none;">
                                @foreach(['Pa','Bar','Torr','psi','atm','hPa','MPa','kPa','GPa','mmHg','in Hg'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('part_unit3', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
        <div>
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full p-3 rounded mt-3">
                    <div class="w-full text-center">
                        @if($detail['mode']===1)
                          <p class="text-[16px]">{{ $lang[3] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> {{ $detail['unit'] ?? '' }}</span></strong></p>
                        @elseif($detail['mode']===2)
                          <p class="text-[16px]">{{ $lang[4] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}</strong></p>
                          @if(is_numeric($detail['ans']) && $detail['ans'] > 1)
                            <p class="text-red">{{ $lang[11] }} 1</p>
                          @endif
                        @elseif($detail['mode']===3)
                          <p class="text-[16px]">{{ $lang[5] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> {{ $detail['unit'] ?? '' }}</span></strong></p>
                        @elseif($detail['mode']===4)
                          <p class="text-[16px]">{{ $lang[3] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> Pa</span></strong></p>
                        @elseif($detail['mode']===5)
                          <p class="text-[16px]">{{ $lang[8] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> m³</span></strong></p>
                        @elseif($detail['mode']===6)
                          <p class="text-[16px]">{{ $lang[7] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> K</span></strong></p>
                        @elseif($detail['mode']===7)
                          <p class="text-[16px]">{{ $lang[12] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> mol</span></strong></p>
                        @elseif($detail['mode']===8)
                          <p class="text-[16px]">{{ $lang[9] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> M</span></strong></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
