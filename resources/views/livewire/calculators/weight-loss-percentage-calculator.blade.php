<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    {{-- Initial Weight --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="inw" class="font-s-14 text-blue">{{ $lang['in'] ?? 'Initial Weight' }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="inw" id="inw" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-4 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none">
                                    {{ $inw_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('inw_unit', 'lbs'); open = false">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('inw_unit', 'kg'); open = false">kilograms (kg)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Current Weight --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="crw" class="font-s-14 text-blue">{{ $lang['cur'] ?? 'Current Weight' }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="crw" id="crw" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-4 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none">
                                    {{ $crw_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('crw_unit', 'lbs'); open = false">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('crw_unit', 'kg'); open = false">kilograms (kg)</p>
                                </div>
                            </div>
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
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="bg-[#F6FAFC] border radius-10 px-3 py-2" style="border: 1px solid #c1b8b899;">
                                <strong>{{ $lang['ans'] }} =</strong>
                                <strong class="text-green-700 text-[25px]">{{ $detail['pw'] }} % </strong>
                            </div>
                            <div class="bg-[#F6FAFC]  border rounnded px-3 py-2 mt-3" style="border: 1px solid #c1b8b899;">
                                <strong>{{ $lang['weight'] }} {{ ($detail['pw']<0)?$lang['gain']:$lang['loss'] }} =</strong>
                                <strong class="text-green-700 text-[25px]">{{ abs((float)$detail['wg']) }}</strong>
                            </div>
                            <div class="w-full overflow-auto mt-3">
                                <table class="w-full" cellspacing="0">
                                    <tr>
                                        <th class="text-start text-blue border-b py-2 pe-3" colspan="2">{{ $lang['in'] }}</th>
                                        <th class="text-start text-blue border-b py-2 px-3" colspan="2">{{ $lang['cur'] }}</th>
                                        <th class="text-start text-blue border-b py-2 ps-3" colspan="2">{{ $lang['loss'] }} / {{ $lang['gain'] }}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-start border-b py-2 pe-3">{{ $lang['imperial'] }}</th>
                                        <th class="text-start border-b py-2 px-3">{{ $lang['metric'] }}</th>
                                        <th class="text-start border-b py-2 px-3">{{ $lang['imperial'] }}</th>
                                        <th class="text-start border-b py-2 px-3">{{ $lang['metric'] }}</th>
                                        <th class="text-start border-b py-2 px-3">PCT</th>
                                        <th class="text-start border-b py-2 ps-3">TTL</th>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-3 border-b">{{ $detail['inw_lbs'] }} lbs</td>
                                        <td class="py-2 px-3 border-b">{{ $detail['inw_kg'] }} kg</td>
                                        <td class="py-2 px-3 border-b">{{ $detail['crw_lbs'] }} lbs</td>
                                        <td class="py-2 px-3 border-b">{{ $detail['crw_kg'] }} kg</td>
                                        <td class="py-2 px-3 border-b font-semibold text-green-700">{{ $detail['pw'] }} %</td>
                                        <td class="py-2 ps-3 border-b font-semibold">{{ $detail['wg'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
