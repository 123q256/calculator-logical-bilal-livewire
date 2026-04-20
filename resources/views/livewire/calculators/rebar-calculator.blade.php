<div>
   <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="first" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Grid length' }}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $units1 }} ▾</label>
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 shadow-lg">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units1', 'cm'); open = false">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units1', 'm'); open = false">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units1', 'ft'); open = false">feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units1', 'in'); open = false">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units1', 'yd'); open = false">yards (yd)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units1', 'km'); open = false">kilometer (km)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units1', 'mi'); open = false">miles (mi)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="second" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Grid width' }}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $units2 }} ▾</label>
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 shadow-lg">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units2', 'cm'); open = false">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('units2', 'm'); open = false">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units2', 'ft'); open = false">feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units2', 'in'); open = false">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units2', 'yd'); open = false">yards (yd)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units2', 'km'); open = false">kilometer (km)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units2', 'mi'); open = false">miles (mi)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="third" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Spacing' }}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $units3 }} ▾</label>
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 shadow-lg">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units3', 'mm'); open = false">milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units3', 'cm'); open = false">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units3', 'm'); open = false">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units3', 'ft'); open = false">feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units3', 'in'); open = false">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units3', 'yd'); open = false">yards (yd)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="four" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Edge clearance' }}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="four" id="four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $units4 }} ▾</label>
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 shadow-lg">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units4', 'mm'); open = false">milimeters (mm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units4', 'cm'); open = false">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units4', 'm'); open = false">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units4', 'ft'); open = false">feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units4', 'in'); open = false">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units4', 'yd'); open = false">yards (yd)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="five" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Price' }}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="five" id="five" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $units5 }} ▾</label>
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 shadow-lg">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units5', '{{$currancy}} cm'); open = false">{{$currancy}} centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units5', '{{$currancy}} m'); open = false">{{$currancy}} meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units5', '{{$currancy}} ft'); open = false">{{$currancy}} feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units5', '{{$currancy}} in'); open = false">{{$currancy}} inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units5', '{{$currancy}} yd'); open = false">{{$currancy}} yards (yd)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2">
                    <label for="six" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Rebar length' }}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="six" id="six" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $units6 }} ▾</label>
                        <div x-show="open" @click.away="open = false" style="display: none;" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 shadow-lg">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units6', 'cm'); open = false">centimeters (cm)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units6', 'm'); open = false">meters (m)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units6', 'ft'); open = false">feet (ft)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units6', 'in'); open = false">inches (in)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('units6', 'yd'); open = false">yards (yd)</p>
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
                        <div class="w-full mt-1">
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 col-12">
                                 <table class="font-s-18 w-100">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[7] ?? 'Grid length' }} :</strong></td>
                                        <td class="border-b py-2">{{ $detail['grid_len'] }} <span>(cm)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[8] ?? 'Grid width' }} :</strong></td>
                                        <td class="border-b py-2">{{ $detail['grid_wid'] }} <span>(cm)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[12] ?? 'Price per item' }} :</strong></td>
                                        <td class="border-b py-2">{{ $currancy }} {{ $detail['price_s'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[9] ?? 'Total Rebar Length' }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['trl'], 3) }} <span>(cm)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[10] ?? 'Rebar pieces' }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['rebar_pie']) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang[11] ?? 'Total Cost' }} :</strong></td>
                                        <td class="border-b py-2">{{ $currancy }} {{ round($detail['cost']) }}</td>
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
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</div>
