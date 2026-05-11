<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    {{-- Length --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="length" class="label">{!! $lang['1'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none py-2">
                                    {{ $length_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('length_unit', 'mm'); open = false">millimeters (mm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('length_unit', 'cm'); open = false">centimeters (cm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('length_unit', 'dm'); open = false">decimeters (dm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('length_unit', 'm'); open = false">meters (m)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('length_unit', 'km'); open = false">kilometers (km)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('length_unit', 'mi'); open = false">miles (mi)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('length_unit', 'in'); open = false">inches (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('length_unit', 'ft'); open = false">feet (ft)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('length_unit', 'yd'); open = false">yards (yd)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Width --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="width" class="label">{!! $lang['2'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="width" id="width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none py-2">
                                    {{ $width_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('width_unit', 'mm'); open = false">millimeters (mm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('width_unit', 'cm'); open = false">centimeters (cm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('width_unit', 'dm'); open = false">decimeters (dm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('width_unit', 'm'); open = false">meters (m)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('width_unit', 'km'); open = false">kilometers (km)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('width_unit', 'mi'); open = false">miles (mi)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('width_unit', 'in'); open = false">inches (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('width_unit', 'ft'); open = false">feet (ft)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('width_unit', 'yd'); open = false">yards (yd)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Height --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="height" class="label">{!! $lang['3'] !!}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="height" id="height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none py-2">
                                    {{ $height_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('height_unit', 'mm'); open = false">millimeters (mm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('height_unit', 'cm'); open = false">centimeters (cm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('height_unit', 'dm'); open = false">decimeters (dm)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('height_unit', 'm'); open = false">meters (m)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('height_unit', 'km'); open = false">kilometers (km)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('height_unit', 'mi'); open = false">miles (mi)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('height_unit', 'in'); open = false">inches (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('height_unit', 'ft'); open = false">feet (ft)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('height_unit', 'yd'); open = false">yards (yd)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PSA --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="psa" class="label">PSA ({!! $lang['4'] !!}):</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="psa" id="psa" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit">ng/ml</span>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @if ($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-5">
                        <div class="w-full">
                            <div class="w-full md:w-[80%] lg:w-[80%] flex flex-wrap justify-between">
                                <div class="px-3 mt-3">
                                    <p><strong>{{ $lang[5] }} cm³</strong></p>
                                    <p class="text-[28px]"><strong class="text-[#119154]">{{ number_format($detail['answer'], 3)." "."cm³" }}</strong></p>
                                    @if(!empty($detail['answer2']))
                                      <p class="mt-2"><strong>PSA {{ $lang[6] }}</strong></p>
                                      <p class="text-[28px]"><strong class="text-[#119154]">{{ number_format($detail['answer2'], 3)." "."ng/ml²" }}</strong></p>
                                    @endif
                                </div>
                                <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                <div class="px-3 mt-3">
                                    <p><strong>{{ $lang[7] }} cm³</strong></p>
                                    <p class="text-[28px]"><strong class="text-[#119154]">{{ number_format($detail['answer22'], 3)." "."cm³" }}</strong></p>
                                    @if(!empty($detail['answer23']))
                                      <p class="mt-2"><strong>PSA {{ $lang[6] }}</strong></p>
                                      <p class="text-[28px]"><strong class="text-[#119154]">{{ number_format($detail['answer23'], 3)." "."ng/ml²" }}</strong></p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap text-center justify-between mt-8 border-t pt-4">
                                <div class="px-3 mt-3">
                                    <p class="text-sm">{{ $lang[5] }} in³</p>
                                    <p><strong>{{ number_format(($detail['answer']/16.387), 3)." "."in³" }}</strong></p>
                                </div>
                                <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                <div class="px-3 mt-3">
                                    <p class="text-sm">{{ $lang[7] }} in³</p>
                                    <p><strong>{{ number_format(($detail['answer22']/16.387), 3)." "."in³" }}</strong></p>
                                </div>
                                <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                <div class="px-3 mt-3">
                                    <p class="text-sm">{{ $lang[5] }} mm³</p>
                                    <p><strong>{{ number_format(($detail['answer']*1000), 3) ." "."mm³" }}</strong></p>
                                </div>
                                <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                <div class="px-3 mt-3">
                                    <p class="text-sm">{{ $lang[7] }} mm³</p>
                                    <p><strong>{{ number_format(($detail['answer22']*1000), 3)." "."mm³" }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
