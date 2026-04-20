<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    <div class="grid grid-cols-1   gap-4">
                        <p class="px-2">{{$lang['1']}}</p>
                    </div>
                    <div class="grid grid-cols-1 mt-3  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="inner_diameter" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                            <div class="relative w-full" x-data="{ open: false }">
                                <input type="number" wire:model="inner_diameter" id="inner_diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $inner_diameter_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md mt-1 right-0 shadow-lg">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('inner_diameter_unit', 'cm'); open = false">centimeters (cm)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('inner_diameter_unit', 'mm'); open = false">milimeters (mm)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('inner_diameter_unit', 'm'); open = false">meters (m)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('inner_diameter_unit', 'in'); open = false">inches (in)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('inner_diameter_unit', 'km'); open = false">kilometers (km)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('inner_diameter_unit', 'yd'); open = false">yard (yd)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('inner_diameter_unit', 'mi'); open = false">miles (mi)</p>
                                </div>
                            </div>
                         </div>
                         <div class="space-y-2">
                            <label for="length" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            <div class="relative w-full" x-data="{ open: false }">
                                <input type="number" wire:model="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $length_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md mt-1 right-0 shadow-lg">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('length_unit', 'cm'); open = false">centimeters (cm)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('length_unit', 'mm'); open = false">milimeters (mm)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('length_unit', 'm'); open = false">meters (m)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('length_unit', 'in'); open = false">inches (in)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('length_unit', 'km'); open = false">kilometers (km)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('length_unit', 'yd'); open = false">yard (yd)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('length_unit', 'mi'); open = false">miles (mi)</p>
                                </div>
                            </div>
                         </div>

                         <div class="space-y-2">
                            <label for="density" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            <div class="relative w-full" x-data="{ open: false }">
                                <input type="number" wire:model="density" id="density" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $density_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md mt-1 right-0 shadow-lg h-48 overflow-y-auto">
                                    @foreach (["kg/m³","kg/dm³","kg/L","g/mL","g/cm³","oz/cu in","lb/cu in","lb/cu ft","lb/US gal","g/L","g/dL","mg/L"] as $name)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('density_unit', '{{$name}}'); open = false">{{$name}}</p>
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


    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full  mt-3">
                        <div class="w-full">
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18">
                                <table class="w-100">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['5']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['volume'],2)}} (cubic inch)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="pt-2">{{$lang['6']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['5']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume']/231,3)}} <span>(gallons)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['5']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume']/16390,3)}} <span>(cu mm)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['5']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume']/61.0237,3)}} <span>(liters)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['7']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['weight'],2)}} (lb)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="pt-2">{{$lang['6']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['7']}} :</td>
                                        <td class="border-b py-2">{{round($detail['weight']/ 2.205,3)}} <span>(kg)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['7']}} :</td>
                                        <td class="border-b py-2">{{round($detail['weight']*453600,3)}} <span>(mg)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['7']}} :</td>
                                        <td class="border-b py-2">{{round($detail['weight']*45.36,3)}} <span>(dag)</span></td>
                                    </tr>
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
