<div>
    <form wire:submit.prevent="calculate">

        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">

                    <p class="col-span-12"><strong class="text-blue">{{ $lang[1] }}:</strong>{{ $lang[2] }}.</p>
                    <div class="col-span-12 ">
                        <label for="wave" class="font-s-14 text-blue">{{ $lang[3] }} (λ):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="wave" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                wire:click.stop="toggleDropdown('unit_w')">{{ $unit_w }} ▾</label>
                            @if ($openDropdown === 'unit_w')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div
                                    class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (['Å', 'mm', 'μm', 'nm', 'm', 'km'] as $val)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            wire:click.stop="setUnit('unit_w', '{{ $val }}')">{{ $val }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-12 ">
                        <label for="freq" class="font-s-14 text-blue">{{ $lang['4'] }} (f): </label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="freq" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                wire:click.stop="toggleDropdown('unit_f')">{{ $unit_f }} ▾</label>
                            @if ($openDropdown === 'unit_f')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div
                                    class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (['Hz', 'kHz', 'MHz', 'GHz', 'THz', 'RPM'] as $val)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            wire:click.stop="setUnit('unit_f', '{{ $val }}')">{{ $val }}
                                        </p>
                                    @endforeach
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
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>{{ $lang[5] }} </strong></td>
                                        <td class="py-2 border-b"> {!! $detail['energy'] !!} joules</td>
                                    </tr>
                                    @if (isset($detail['frequency']))
                                        <tr>
                                            <td class="py-2 border-b" width="40%"><strong>{{ $lang[4] }} </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['frequency'] }} Hz</td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['wave']))
                                        <tr>
                                            <td class="py-2 border-b" width="40%"><strong>{{ $lang[3] }} </strong></td>
                                            <td class="py-2 border-b"> {{ @$detail['wave'] }} m</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="w-full md:w-[100%] lg:w-[80%] overflow-auto mt-2">
                                <p class="my-2"><strong>{{ $lang[6] }}:</strong></p>
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="40%">{{ $lang[5] }}</td>
                                        <td class="py-2 border-b"><strong>{{ $detail['en'] * 6.242e+18 }} eV</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%">{{ $lang[5] }}</td>
                                        <td class="py-2 border-b"><strong>{{ $detail['en'] * 6.242e+15 }} keV</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%">{{ $lang[5] }}</td>
                                        <td class="py-2 border-b"><strong>{{ $detail['en'] * 6.242e+12 }} MeV</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%">{{ $lang[5] }}</td>
                                        <td class="py-2 border-b"><strong>{{ $detail['en'] * 6.242e+24 }} μeV</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%">{{ $lang[5] }}</td>
                                        <td class="py-2 border-b"><strong>{{ $detail['en'] * 6.242e+21 }} meV</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%">{{ $lang[5] }}</td>
                                        <td class="py-2 border-b"><strong>{{ $detail['en'] * 6.242e+27 }} neV</strong></td>
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
