<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="ast" class="font-s-14 text-blue">AST <span class="bg-white radius-circle px-2" title="Aspartate transaminase<br>(AspAT/SGOT/ASAT/AAT/GOT)">?</span>:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="ast" id="ast" step="any" placeholder="424.18" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $ast_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ast_unit', 'U / mm³'); open = false">U / millimeters cube (mm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ast_unit', 'U / cm³'); open = false">U / centimeters cube (cm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ast_unit', 'U / dm³'); open = false">U / decimeters cube (dm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ast_unit', 'U / cu in'); open = false">U / cubic inches (cu in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ast_unit', 'U / cu ft'); open = false">U / cubic feet (cu ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ast_unit', 'U / ml'); open = false">U / milliliters (ml)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ast_unit', 'U / cl'); open = false">U / centiliters (cl)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ast_unit', 'U / liter'); open = false">U / liter</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12">
                    <label for="alt" class="font-s-14 text-blue">ALT <span class="bg-white radius-circle px-2" title="Alanine transaminase / alanine aminotransferase<br>(ALAT/SGPT)">?</span>:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="alt" id="alt" step="any" placeholder="424.18" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $alt_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('alt_unit', 'U / mm³'); open = false">U / millimeters cube (mm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('alt_unit', 'U / cm³'); open = false">U / centimeters cube (cm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('alt_unit', 'U / dm³'); open = false">U / decimeters cube (dm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('alt_unit', 'U / cu in'); open = false">U / cubic inches (cu in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('alt_unit', 'U / cu ft'); open = false">U / cubic feet (cu ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('alt_unit', 'U / ml'); open = false">U / milliliters (ml)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('alt_unit', 'U / cl'); open = false">U / centiliters (cl)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('alt_unit', 'U / liter'); open = false">U / liter</p>
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
                <div class="w-full mt-3">
                    <div class="col-12">
                        <p><strong>{{ $lang['ratio'] }}</strong></p>
                        <p><strong class="text-[30px] text-green-500">{{ $detail['ratio'] }}</strong></p>
                        <p><strong>{{ $detail['m3'] }}</strong></p>
                        @if($detail['ratio'] >= 2)
                            <p>{{ $lang['suggest'] }}</p>
                        @endif
                        <div class="col s12 overflow-auto mt-2">
                            <table class="w-full md:w-[60%] lg:w-[60%]" cellspacing="0">
                                <tr id="first_row">
                                    <td class="border-b py-2"><strong>Name</strong></td>
                                    <td class="border-b py-2"><strong>Value</strong></td>
                                    <td class="border-b py-2"><strong>Result</strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">AST</td>
                                    <td class="border-b py-2">{{ round($detail['ast'], 2) }} U / liter</td>
                                    <td class="border-b py-2">{{ $detail['m1'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">ALT</td>
                                    <td class="border-b py-2">{{ round($detail['alt'], 2) }} U / liter</td>
                                    <td class="border-b py-2">{{ $detail['m2'] }}</td>
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
