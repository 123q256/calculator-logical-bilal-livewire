<div x-data="{ dropdowns: {} }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    {{-- Height --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="height" class="label">{{ $lang['1'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="height" id="height" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['height'] = !dropdowns['height']">
                                {{ $height_unit == 'm' ? 'meters (m)' : 'inches (in)' }} ▾
                            </label>
                            <div x-show="dropdowns['height']" @click.away="dropdowns['height'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('height_unit', 'm'); dropdowns['height'] = false">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('height_unit', 'in'); dropdowns['height'] = false">inches (in)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Stone --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="stone" class="label">{{ $lang['2'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="stone" id="stone" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['stone'] = !dropdowns['stone']">
                                {{ $stone_unit == 'm' ? 'meters (m)' : 'inches (in)' }} ▾
                            </label>
                            <div x-show="dropdowns['stone']" @click.away="dropdowns['stone'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('stone_unit', 'm'); dropdowns['stone'] = false">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('stone_unit', 'in'); dropdowns['stone'] = false">inches (in)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Length --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="length" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="length" id="length" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['length'] = !dropdowns['length']">
                                {{ $length_unit == 'm' ? 'meters (m)' : 'inches (in)' }} ▾
                            </label>
                            <div x-show="dropdowns['length']" @click.away="dropdowns['length'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('length_unit', 'm'); dropdowns['length'] = false">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('length_unit', 'in'); dropdowns['length'] = false">inches (in)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Deck --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="deck" class="label">{{ $lang['4'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="deck" id="deck" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['deck'] = !dropdowns['deck']">
                                {{ $deck_unit == 'm' ? 'meters (m)' : 'inches (in)' }} ▾
                            </label>
                            <div x-show="dropdowns['deck']" @click.away="dropdowns['deck'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('deck_unit', 'm'); dropdowns['deck'] = false">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('deck_unit', 'in'); dropdowns['deck'] = false">inches (in)</p>
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
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full mt-1">
                                <div class="w-full lg:w-[80%] text-[18px] overflow-auto">
                                    <p class="text-[20px] my-2"><strong>{{ $lang['5'] }}</strong></p>
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-3 font-bold">{{ round($detail['compression_val'], 6) }}</td>
                                            <td class="border-b py-3 text-right text-gray-500">inches (in)</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3 font-bold">{{ round($detail['compression_val_m'], 6) }}</td>
                                            <td class="border-b py-3 text-right text-gray-500">meters (m)</td>
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
