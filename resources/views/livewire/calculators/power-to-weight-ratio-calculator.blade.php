<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Power --}}
                    <div class="space-y-2">
                        <label for="power" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="relative w-full">
                            <input type="text" inputmode="decimal" wire:model.live="power" id="power" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('power_unit')">
                                {{ $power_unit }} ▾
                            </label>
                            @if ($openDropdown === 'power_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('power_unit', 'W')">W</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('power_unit', 'kW')">kW</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('power_unit', 'hpl')">hp(l)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('power_unit', 'hpm')">hp(M)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('power_unit', 'js')">j/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('power_unit', 'kjs')">kj/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('power_unit', 'nms')">Nm/s</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Weight --}}
                    <div class="space-y-2">
                        <label for="weight" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                        <div class="relative w-full">
                            <input type="text" inputmode="decimal" wire:model.live="weight" id="weight" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('weight_unit')">
                                {{ $weight_unit }} ▾
                            </label>
                            @if ($openDropdown === 'weight_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('weight_unit', 'g')">g</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('weight_unit', 'kg')">kg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('weight_unit', 't')">t</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('weight_unit', 'oz')">oz</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('weight_unit', 'lb')">lb</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('weight_unit', 'us')">US (ton)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('weight_unit', 'long')">Long (ton)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('weight_unit', 'mg')">mg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('weight_unit', 'gr')">gr</p>
                                </div>
                            @endif
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full bg-light-blue p-4 rounded-lg mt-3">
                            <div class="w-full lg:w-[80%] md:w-[80%] mt-2 overflow-auto">
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 border-b w-7/12"><strong>{{ $lang[3] }}</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['answer'], 4) }} (kW/kg)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-7/12"><strong>{{ $lang[4] }}</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['answer'] * 1000, 4) }} (W/kg)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-7/12"><strong>{{ $lang[5] }}</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['answer'] * 0.608, 4) }} (hp(l)/lb)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-7/12"><strong>{{ $lang[6] }}</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['answer'] * 1.34, 4) }} (hp(l)/kg)</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
