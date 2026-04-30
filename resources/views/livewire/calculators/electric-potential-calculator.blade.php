<div x-data="{ 
    show_result: @entangle('detail')
}">
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  mt-3  gap-2">
                <div class="col-span-12 mx-auto px-2">
                    <label for="potential_type" class="label">{{ $lang[1] }}</label>
                    <div class="w-full py-2 position-relative">
                        <select wire:model.live="potential_type" id="potential_type" class="input">
                            <option value="single-point">{{ $lang[2] }}</option>
                            <option value="multi-point">{{ $lang[3] }}</option>
                            <option value="difference">{{ $lang[4] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 text-center my-3">
                    @if($potential_type == 'single-point')
                        <img class="mx-auto" src="{{url('images/single.png')}}" alt="Single potential" width="200px">
                    @elseif($potential_type == 'multi-point')
                        <img class="mx-auto" src="{{url('images/multi.png')}}" alt="Multi potential" width="200px">
                    @endif
                </div>

                @if($potential_type == 'single-point' || $potential_type == 'difference')
                <div class="col-span-12 md:col-span-6">
                    <label for="charge" class="label">{{ $lang[5] }} (q):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" wire:model="charge" id="charge" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                       <label for="charge_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('charge_unit')">{{ $charge_unit }} ▾</label>
                       @if($dropdowns['charge_unit'] ?? false)
                       <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                           @foreach(['PC', 'nC', 'μC', 'mC', 'C', 'e'] as $unit)
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('charge_unit', '{{ $unit }}', 'charge_unit')">{{ $unit }}</p>
                           @endforeach
                       </div>
                       @endif
                    </div>
                  </div>
                @endif

                @if($potential_type == 'single-point')
                  <div class="col-span-12 md:col-span-6">
                    <label for="distance" class="label">{{ $lang[6] }} (r):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" wire:model="distance" id="distance" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                       <label for="distance_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('distance_unit')">{{ $distance_unit }} ▾</label>
                       @if($dropdowns['distance_unit'] ?? false)
                       <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                           @foreach(['nm', 'μm', 'mm', 'cm', 'm', 'in', 'ft', 'yd'] as $unit)
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('distance_unit', '{{ $unit }}', 'distance_unit')">{{ $unit }}</p>
                           @endforeach
                       </div>
                       @endif
                    </div>
                  </div>
                @endif

                @if($potential_type == 'difference')
                  <div class="col-span-12 md:col-span-6">
                    <label for="U" class="label">{{ $lang[7] }} (U):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" wire:model="U" id="U" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                       <label for="U_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('U_unit')">{{ $U_unit }} ▾</label>
                       @if($dropdowns['U_unit'] ?? false)
                       <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                           @foreach(['J', 'kJ', 'MJ', 'Wh', 'kWh', 'kcal', 'eV'] as $unit)
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('U_unit', '{{ $unit }}', 'U_unit')">{{ $unit }}</p>
                           @endforeach
                       </div>
                       @endif
                    </div>
                  </div>
                @endif
                
                @if($potential_type == 'multi-point')
                <div class="col-span-12 md:col-span-6">
                    <label for="points" class="label">{{ $lang[8] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="1" min="1" max="20" wire:model.live="points" id="points" class="input" placeholder="00" />
                    </div>
                </div>
                @endif

                <div class="col-span-12 md:col-span-6">
                    <label for="E" class="label">{{ $lang[9] }} (ϵᵣ):</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" wire:model="E" id="E" class="input" placeholder="00" />
                    </div>
                </div>

                @if($potential_type == 'multi-point')
                <div class="col-span-12">
                 <div class="grid grid-cols-12 mt-3 gap-4">
                     @for($i = 0; $i < (int)$points; $i++)
                     <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['5'] }} {{ $i+1 }} (q<sub class="text-blue">{{ $i+1 }}</sub>):</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" wire:model="Q.{{ $i }}" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                           <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit_Q{{ $i }}')">{{ $unit_Q[$i] ?? 'mC' }} ▾</label>
                           @if($dropdowns['unit_Q'.$i] ?? false)
                           <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                               @foreach(['PC', 'nC', 'μC', 'mC', 'C', 'e'] as $unit)
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_Q.{{ $i }}', '{{ $unit }}', 'unit_Q{{ $i }}')">{{ $unit }}</p>
                               @endforeach
                           </div>
                           @endif
                        </div>
                      </div>
                      <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['6'] }} {{ $i+1 }} (r<sub class="text-blue">{{ $i+1 }}</sub>):</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" wire:model="R.{{ $i }}" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                           <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit_R{{ $i }}')">{{ $unit_R[$i] ?? 'm' }} ▾</label>
                           @if($dropdowns['unit_R'.$i] ?? false)
                           <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                               @foreach(['nm', 'μm', 'mm', 'cm', 'm', 'in', 'ft', 'yd'] as $unit)
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_R.{{ $i }}', '{{ $unit }}', 'unit_R{{ $i }}')">{{ $unit }}</p>
                               @endforeach
                           </div>
                           @endif
                        </div>
                      </div>
                     @endfor
                 </div>
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
    <div id="result-section" x-show="show_result" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="text-center">
                                <p class="text-[18px]"><strong>{{ $potential_type == 'difference' ? $lang['10'].' (∆V)' : $lang['11'].' (V)' }}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="">{!! $detail['answer'] !!}</strong>
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
