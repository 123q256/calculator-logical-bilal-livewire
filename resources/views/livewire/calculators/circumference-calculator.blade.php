<div x-data="{ 
    open_r: false, 
    open_d: false, 
    open_c: false, 
    open_a: false 
}">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <p class="w-full my-3">{{ $lang['note_value'] }}</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Radius -->
                    <div class="space-y-2">
                        <label for="radius" class="label">{{ $lang['radius'] }}:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="radius" id="radius" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="open_r = !open_r" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_r }} ▾</label>
                            <div x-show="open_r" @click.away="open_r = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-hidden" x-cloak>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_r', 'cm'); open_r = false">centimeters (cm)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_r', 'mm'); open_r = false">millimeters (mm)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_r', 'm'); open_r = false">meters (m)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_r', 'km'); open_r = false">kilometers (km)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_r', 'in'); open_r = false">inches (in)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_r', 'yd'); open_r = false">yards (yd)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_r', 'mi'); open_r = false">miles (mi)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Diameter -->
                    <div class="space-y-2">
                        <label for="diameter" class="label">{{ $lang['diameter'] }}:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="diameter" id="diameter" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="open_d = !open_d" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_d }} ▾</label>
                            <div x-show="open_d" @click.away="open_d = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-hidden" x-cloak>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_d', 'cm'); open_d = false">centimeters (cm)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_d', 'mm'); open_d = false">millimeters (mm)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_d', 'm'); open_d = false">meters (m)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_d', 'km'); open_d = false">kilometers (km)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_d', 'in'); open_d = false">inches (in)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_d', 'yd'); open_d = false">yards (yd)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_d', 'mi'); open_d = false">miles (mi)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Circumference -->
                    <div class="space-y-2">
                        <label for="circumference" class="label">{{ $lang['circumference'] }}:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="circumference" id="circumference" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="open_c = !open_c" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_c }} ▾</label>
                            <div x-show="open_c" @click.away="open_c = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-hidden" x-cloak>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_c', 'cm'); open_c = false">centimeters (cm)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_c', 'mm'); open_c = false">millimeters (mm)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_c', 'm'); open_c = false">meters (m)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_c', 'km'); open_c = false">kilometers (km)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_c', 'in'); open_c = false">inches (in)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_c', 'yd'); open_c = false">yards (yd)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_c', 'mi'); open_c = false">miles (mi)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Area -->
                    <div class="space-y-2">
                        <label for="area" class="label">{{ $lang['area'] }}:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model.live="area" id="area" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="open_a = !open_a" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_a }} ▾</label>
                            <div x-show="open_a" @click.away="open_a = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-hidden" x-cloak>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_a', 'cm'); open_a = false">centimeters (cm)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_a', 'mm'); open_a = false">millimeters (mm)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_a', 'm'); open_a = false">meters (m)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_a', 'km'); open_a = false">kilometers (km)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_a', 'in'); open_a = false">inches (in)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_a', 'yd'); open_a = false">yards (yd)</p>
                                <p class="p-2 hover:bg-blue-50 cursor-pointer text-sm" @click="$wire.setUnit('unit_a', 'mi'); open_a = false">miles (mi)</p>
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

        @if(isset($detail))
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    
                    <div class="rounded-lg items-center gap-4 mt-5">
                        <div class="w-full md:w-[80%]">
                            <table class="w-full">
                                <tr class="border-b">
                                    <td class="py-3"><strong>{{ $lang['radius'] }}</strong></td>
                                    <td class="py-3 text-right"><strong>r</strong></td>
                                    <td class="py-3 text-right">{{ $detail['Radius'] }} cm</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-3"><strong>{{ $lang['diameter'] }}</strong></td>
                                    <td class="py-3 text-right"><strong>2r</strong></td>
                                    <td class="py-3 text-right">{{ $detail['Diameter'] }} cm</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-3"><strong>{{ $lang['circumference'] }}</strong></td>
                                    <td class="py-3 text-right"><strong>2πr</strong></td>
                                    <td class="py-3 text-right">{{ $detail['Circumference'] }} cm</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-3"><strong>{{ $lang['area'] }}</strong></td>
                                    <td class="py-3 text-right"><strong>πr²</strong></td>
                                    <td class="py-3 text-right">{{ $detail['Area'] }} cm²</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="w-full m-5">
                            <!-- Visual representation of a circle -->
                            <div class="w-40 h-40 rounded-full border-4 border-blue-500 flex items-center justify-center relative bg-blue-50">
                                <div class="absolute w-1/2 h-0.5 bg-blue-500 left-1/2 origin-left"></div>
                                <span class="absolute left-[70%] top-1/2 -translate-y-full text-xs font-bold text-blue-700">r</span>
                                <div class="text-blue-200 text-6xl opacity-20">●</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
