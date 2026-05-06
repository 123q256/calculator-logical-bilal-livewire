<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3 gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                    <label for="length" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $length_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                            @foreach(['cm' => 'centimeters', 'mm' => 'milimeters', 'm' => 'meters', 'km' => 'kilometers', 'in' => 'inches', 'ft' => 'feet', 'yd' => 'yards', 'mi' => 'miles', 'nmi' => 'nenomiles'] as $key => $val)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('length_unit', '{{$key}}')" @click="open = false">{{$val}} ({{$key}})</p>
                            @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="width" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $width_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                            @foreach(['cm' => 'centimeters', 'mm' => 'milimeters', 'm' => 'meters', 'km' => 'kilometers', 'in' => 'inches', 'ft' => 'feet', 'yd' => 'yards', 'mi' => 'miles', 'nmi' => 'nenomiles'] as $key => $val)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('width_unit', '{{$key}}')" @click="open = false">{{$val}} ({{$key}})</p>
                            @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="height" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="height" id="height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $height_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                            @foreach(['cm' => 'centimeters', 'mm' => 'milimeters', 'm' => 'meters', 'km' => 'kilometers', 'in' => 'inches', 'ft' => 'feet', 'yd' => 'yards', 'mi' => 'miles', 'nmi' => 'nenomiles'] as $key => $val)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('height_unit', '{{$key}}')" @click="open = false">{{$val}} ({{$key}})</p>
                            @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="weight" id="weight" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $weight_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                            @foreach(['mg', 'g', 'kg', 't', 'oz', 'lb', 'stone', 'us_ton', 'long_ton'] as $unit)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('weight_unit', '{{$unit}}')" @click="open = false">{{$unit}}</p>
                            @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="pq" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="pq" id="pq" class="input" aria-label="input" placeholder="1" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fr" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="fr" id="fr" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $fr_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                            @foreach(['mg', 'g', 'kg', 't', 'oz', 'lb', 'stone', 'us_ton', 'long_ton'] as $unit)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('fr_unit','{{$currancy}}/{{$unit}}')" @click="open = false">{{$currancy}}/{{$unit}}</p>
                            @endforeach
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
    <hr>
    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="w-full mt-3">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="w-full lg:w-[80%] lg:text-[18px] md:text-[18px] text-[16px] mt-5">
                    <table class="w-full">
                        <tr>
                            <td width="60%" class="border-b py-2"><strong>{{$lang['7']}} :</strong></td>
                            <td class="border-b py-2">{{$detail['weight']}} lb</td>
                        </tr>
                        <tr>
                            <td class="border-b py-2"><strong>{{$lang['8']}} :</strong></td>
                            <td class="border-b py-2">{{$detail['volume']}} cu ft</td>
                        </tr>
                        <tr>
                            <td class="border-b py-2"><strong>{{$lang['9']}} :</strong></td>
                            <td class="border-b py-2">{{$detail['density']}} lb/cu ft</td>
                        </tr>
                        <tr>
                            <td class="border-b py-2"><strong>{{$lang['10']}} :</strong></td>
                            <td class="border-b py-2">{{$detail['f_cls']}}</td>
                        </tr>
                        @if(isset($detail['fc']))
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang['11']}} :</strong></td>
                                <td class="border-b py-2">{{$currancy}} {{round($detail['fc'], 2)}}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
