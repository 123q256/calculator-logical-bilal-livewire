<div>
    @if(app()->getLocale() == "ru")
        @include('calculators.square-meter-calculator-ru')
    @else
        <form wire:submit.prevent="calculate">
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
                @if (isset($error))
                    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
                @endif
                <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 row">
                            <div class="space-y-2">
                                <label for="volume_select" class="label">{{ $lang['12'] ?? 'Shape' }}</label>
                                <div class="w-full pt-1">
                                    <select wire:model.live="volume_select" id="volume_select" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full">
                                        <option value="1">{{ $lang['13'] ?? 'Rectangle' }}</option>
                                        <option value="2">{{ $lang['14'] ?? 'Square' }}</option>
                                        <option value="3">{{ $lang['15'] ?? 'Circle' }}</option>
                                        <option value="4">{{ $lang['16'] ?? 'Triangle' }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-12 gap-4 mt-3">
                                @if($volume_select == 1 || $volume_select == 3 || $volume_select == 4)
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="length" class="label">
                                        @if($volume_select == 3)
                                            {{ $lang['18'] ?? 'Diameter' }}:
                                        @elseif($volume_select == 4)
                                            {{ $lang['17'] ?? 'Side' }} a:
                                        @else
                                            {{ $lang['1'] ?? 'Length' }}:
                                        @endif
                                    </label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model.live="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label for="l_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('l_units')">{{ $l_units }} ▾</label>
                                        @if($showDropdown === 'l_units')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm","mm","m","in","ft","yd"] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('l_units', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                @if($volume_select == 1 || $volume_select == 2 || $volume_select == 4)
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="width" class="label">
                                        @if($volume_select == 4)
                                            {{ $lang['17'] ?? 'Side' }} b:
                                        @else
                                            {{ $lang['2'] ?? 'Width' }}:
                                        @endif
                                    </label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model.live="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label for="w_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('w_units')">{{ $w_units }} ▾</label>
                                        @if($showDropdown === 'w_units')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm","mm","m","in","ft","yd"] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('w_units', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                @if($volume_select == 4)
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="side" class="label">{{ $lang['17'] ?? 'Side' }} c:</label>
                                    <div class="relative w-full">
                                        <input type="number" wire:model.live="side" id="side" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                        <label for="s_units" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('s_units')">{{ $s_units }} ▾</label>
                                        @if($showDropdown === 's_units')
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                @foreach (["cm","mm","m","in","ft","yd"] as $unit)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('s_units', '{{ $unit }}')">{{ $unit }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="quantity" class="label">{{ $lang['19'] ?? 'Quantity' }}:</label>
                                    <div class="w-full">
                                        <input type="number" wire:model.live="quantity" id="quantity" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="1" />
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 mt-3">
                                <label for="price" class="label">{{ $lang['3'] ?? 'Price' }} ({{ $lang['4'] ?? 'per square meter' }}):</label>
                                <div class="w-full relative">
                                    <input type="number" wire:model.live="price" id="price" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="0.00" />
                                    <span class="absolute right-3 top-2 text-blue-500">{{ $currancy }}/m²</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 flex items-center justify-center">
                            <div class="col-11 px-2 mx-auto">
                                @php
                                    $img = "meter1.png";
                                    if($volume_select == 2) $img = "meter2.png";
                                    elseif($volume_select == 3) $img = "meter3.png";
                                    elseif($volume_select == 4) $img = "meter4.png";
                                @endphp
                                <img src="{{ asset('images/'.$img) }}" alt="Square Meter" class="max-width" width="300px">
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

            <hr/>

            @isset($detail)
                <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full mt-3">
                                <div class="row mt-2">
                                    <div class="w-full">
                                        @php
                                            $res = round($detail['res'] ?? 0, 2);
                                        @endphp
                                        <div class="w-full md:w-[50%] lg:w-[50%] overflow-auto font-s-18">
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong>{{ $lang[20] ?? 'Total' }} {{ $lang[5] ?? 'Area' }}:</strong></td>
                                                    <td class="border-b py-2">{{ $res }} m²</td>
                                                </tr>
                                                @if(isset($detail['cost']))
                                                    <tr>
                                                        <td class="border-b py-2"><strong>{{ $lang['3'] ?? 'Price' }}:</strong></td>
                                                        <td class="border-b py-2">{{ $currancy }} {{ round($detail['cost'], 2) }}</td>
                                                    </tr>
                                                @endif
                                            </table>
                                            <table class="w-full mt-4 text-sm text-gray-600">
                                                <tr>
                                                    <td width="60%" class="border-b py-2">{{ $lang[20] ?? 'Total' }} {{ $lang['11'] ?? 'in' }} {{ $lang['6'] ?? 'mm²' }}:</td>
                                                    <td class="border-b py-2">{{ number_format($res * 1000000, 0) }} mm²</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang[20] ?? 'Total' }} {{ $lang['11'] ?? 'in' }} {{ $lang['7'] ?? 'cm²' }}:</td>
                                                    <td class="border-b py-2">{{ number_format($res * 10000, 0) }} cm²</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang[20] ?? 'Total' }} {{ $lang['11'] ?? 'in' }} {{ $lang['8'] ?? 'in²' }}:</td>
                                                    <td class="border-b py-2">{{ number_format($res * 1550, 2) }} in²</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang[20] ?? 'Total' }} {{ $lang['11'] ?? 'in' }} {{ $lang['9'] ?? 'ft²' }}:</td>
                                                    <td class="border-b py-2">{{ number_format($res * 10.764, 2) }} ft²</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2">{{ $lang[20] ?? 'Total' }} {{ $lang['11'] ?? 'in' }} {{ $lang['10'] ?? 'yd²' }}:</td>
                                                    <td class="py-2">{{ number_format($res * 1.196, 2) }} yd²</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </form>
    @endif
</div>
