<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="no" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <input type="number" step="any" wire:model.live="no" id="no" class="input" aria-label="input" placeholder="1" />
                    </div>

                    <div class="space-y-2">
                        <label for="thickness" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model.live="thickness" id="thickness" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $thickness_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[60%] md:w-[60%] w-[80%] mt-1 right-0 shadow-lg" x-cloak>
                                @foreach(['cm' => 'centimeters', 'm' => 'meters', 'in' => 'inches', 'yd' => 'yards', 'ft' => 'foot'] as $key => $val)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('thickness_unit', '{{$key}}')" @click="open = false">{{$val}} ({{$key}})</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="length" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model.live="length" id="length" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $length_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[60%] md:w-[60%] w-[80%] mt-1 right-0 shadow-lg" x-cloak>
                                @foreach(['cm' => 'centimeters', 'm' => 'meters', 'in' => 'inches', 'yd' => 'yards', 'ft' => 'foot'] as $key => $val)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('length_unit', '{{$key}}')" @click="open = false">{{$val}} ({{$key}})</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="width" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" step="any" wire:model.live="width" id="width" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $width_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[60%] md:w-[60%] w-[80%] mt-1 right-0 shadow-lg" x-cloak>
                                @foreach(['cm' => 'centimeters', 'm' => 'meters', 'in' => 'inches', 'yd' => 'yards', 'ft' => 'foot'] as $key => $val)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('width_unit', '{{$key}}')" @click="open = false">{{$val}} ({{$key}})</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2 relative">
                        <label for="price" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <input type="number" step="any" wire:model.live="price" id="price" class="input" aria-label="input" placeholder="" />
                        <span class="text-blue input_unit">{{$currancy}}</span>
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
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                            <div class="flex flex-wrap">
                                <div class="lg:w-[80%] w-full text-lg overflow-auto">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b border-gray-300 py-2"><strong>{{$lang['6']}}</strong></td>
                                            <td class="border-b border-gray-300 py-2">{{round($detail['ans'], 2)}} bd ft</td>
                                        </tr>
                                        @if(is_numeric($price) && $price > 0)
                                            <tr>
                                                <td class="border-b border-gray-300 py-2"><strong>{{$lang['7']}}</strong></td>
                                                <td class="border-b border-gray-300 py-2">{{$currancy}} {{round($detail['ans'] * $price, 2)}}</td>
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
