<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2">
                        <label for="calculation_unit" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Calculate by' }}:</label>
                        <select wire:model.live="calculation_unit" id="calculation_unit" class="input">
                            <option value="1">{{ $lang[2] ?? 'Dimensions' }} & {{ $lang[3] ?? 'Depth' }}</option>
                            <option value="2">{{ $lang[4] ?? 'Area' }} & {{ $lang[3] ?? 'Depth' }}</option>
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 mt-3 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    @if ($calculation_unit === '1')
                        <div class="space-y-2">
                            <label for="length" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Length' }}:</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('length_unit_dropdown')">{{ $length_unit }} ▾</label>
                                @if ($showDropdown === 'length_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["in", "ft", "cm", "m", "yd", "mi", "km"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('length_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="width" class="font-s-14 text-blue">{{ $lang['7'] ?? 'Width' }}/{{ $lang['8'] ?? 'Diameter' }}:</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('width_unit_dropdown')">{{ $width_unit }} ▾</label>
                                @if ($showDropdown === 'width_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["in", "ft", "cm", "m", "yd", "mi", "km"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('width_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="space-y-2">
                        <label for="depth" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Depth' }}/{{ $lang['9'] ?? 'Thickness' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="depth" id="depth" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('depth_unit_dropdown')">{{ $depth_unit }} ▾</label>
                            @if ($showDropdown === 'depth_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                    @foreach (["in", "ft", "cm", "m", "yd", "mi", "km"] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('depth_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($calculation_unit === '2')
                        <div class="space-y-2">
                            <label for="area" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Area' }}:</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('area_unit_dropdown')">{{ $area_unit }} ▾</label>
                                @if ($showDropdown === 'area_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["sq yd", "sq ft", "sq m"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('area_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <p class="mt-2"><strong>{{$lang['10'] ?? 'Cost Estimation'}} ({{$lang['11'] ?? 'Optional'}})</strong></p>

                <div class="grid grid-cols-2 mt-3 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="purchase_unit" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Purchase Mode' }}:</label>
                        <select wire:model.live="purchase_unit" id="purchase_unit" class="input">
                            <option value="1">In Bags</option>
                            <option value="2">In Bulk</option>
                        </select>
                    </div>

                    @if ($purchase_unit === '1')
                        <div class="space-y-2">
                            <label for="bag_size" class="font-s-14 text-blue">{{$lang['12'] ?? 'Bag Size'}}:</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="bag_size" id="bag_size" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('bag_size_unit_dropdown')">{{ $bag_size_unit }} ▾</label>
                                @if ($showDropdown === 'bag_size_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg border">
                                        @foreach (["cu ft", "cu yd", "cu m", "lbs", "kg", "liters"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('bag_size_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="price_per_bag" class="font-s-14 text-blue">{{$lang['13'] ?? 'Price Per Bag'}}:</label>
                            <div class="relative">
                                <input type="number" wire:model="price_per_bag" id="price_per_bag" step="any" class="input" placeholder="00" />
                                <span class="absolute right-3 top-3 text-blue">{{$currancy}}</span>
                            </div>
                        </div>
                    @else
                        <div class="space-y-2 relative">
                            <label for="price_per_ton" class="font-s-14 text-blue">{{$lang['14'] ?? 'Price Per Ton'}}:</label>
                            <div class="relative">
                                <input type="number" wire:model="price_per_ton" id="price_per_ton" step="any" class="input" placeholder="00" />
                                <span class="absolute right-3 top-3 text-blue">{{$currancy}}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
        <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-1">
                                <p class="font-s-20"><strong>{{$lang[15] ?? 'Result'}}</strong></p>
                                <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang[16] ?? 'Volume'}} :</strong></td>
                                            <td class="border-b py-2">{{ number_format($detail['calculation'], 2) }} (ft³)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang[17] ?? 'Cubic Yards'}} :</strong></td>
                                            <td class="border-b py-2">{{ number_format($detail['calculation'] * 0.037037, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang[18] ?? 'Weight'}} ({{$lang[19] ?? 'dry'}}) :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['calculation'] * 0.037037, 2) }} - {{ round($detail['calculation'] * 0.037037 * 1.3, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang[20] ?? 'Weight'}} (wet) :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['calculation'] * 0.037037 * 1.5, 2) }} - {{ round(($detail['calculation'] * 0.037037) * 1.7, 2) }}</td>
                                        </tr>
                                        @if(isset($detail['calculate_cost']) && $detail['calculate_cost'] > 0)
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang[21] ?? 'Calculate Cost'}} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy }}{{ number_format($detail['calculate_cost'], 2) }}</td>
                                        </tr>  
                                        @endif
                                        @if(isset($detail['number_of_bags']) && $detail['number_of_bags'] > 0)
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang[22] ?? 'Number of bags'}} :</strong></td>
                                            <td class="border-b py-2">{{ number_format($detail['number_of_bags'], 2) }}</td>
                                        </tr>  
                                        @endif
                                        @if(isset($detail['total_cost']) && $detail['total_cost'] > 0)
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang[23] ?? 'Total Cost'}} :</strong></td>
                                            <td class="border-b py-2">{{$currancy}}{{ number_format($detail['total_cost'], 2) }}<span class="font-s-14 text-gray-500 sty"> ({{$currancy}}{{ number_format($detail['price_in_ton'] ?? 0, 2) }} {{$lang[24] ?? 'per ton'}})</span></td>
                                        </tr>  
                                        @endif
                                        
                                        @if(isset($detail['bag1']) && $detail['bag1'] > 0)
                                        <tr>
                                            <td class="border-b py-2">0.75 cu.ft. {{$lang[25] ?? 'bags'}} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['bag1'], 2) }}</td>
                                        </tr>
                                        @endif
                                        @if(isset($detail['bag2']) && $detail['bag2'] > 0)
                                        <tr>
                                            <td class="border-b py-2">1 cu.ft. {{$lang[25] ?? 'bags'}} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['bag2'], 2) }}</td>
                                        </tr>
                                        @endif
                                        @if(isset($detail['bag3']) && $detail['bag3'] > 0)
                                        <tr>
                                            <td class="border-b py-2">1.5 cu.ft. {{$lang[25] ?? 'bags'}} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['bag3'], 2) }}</td>
                                        </tr>
                                        @endif
                                        @if(isset($detail['bag4']) && $detail['bag4'] > 0)
                                        <tr>
                                            <td class="border-b py-2">2 cu.ft. {{$lang[25] ?? 'bags'}} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['bag4'], 2) }}</td>
                                        </tr>
                                        @endif
                                        @if(isset($detail['bag5']) && $detail['bag5'] > 0)
                                        <tr>
                                            <td class="border-b py-2">3 cu.ft. {{$lang[25] ?? 'bags'}} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['bag5'], 2) }}</td>
                                        </tr>
                                        @endif
                                        @if(isset($detail['bag6']) && $detail['bag6'] > 0)
                                        <tr>
                                            <td class="border-b py-2">25 quart {{$lang[25] ?? 'bags'}} :</td>
                                            <td class="border-b py-2">{{ number_format($detail['bag6'], 2) }}</td>
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
