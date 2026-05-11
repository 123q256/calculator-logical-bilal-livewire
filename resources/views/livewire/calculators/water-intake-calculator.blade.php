<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="w-full lg:w-8/12 mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-5">
                    {{-- Gender --}}
                    <div class="space-y-2 relative">
                        <label for="gender" class="label">{!! $lang['gender'] !!}:</label>
                        <select wire:model.live="gender" id="gender" class="input">
                            <option value="Male">{!! $lang['male'] !!}</option>
                            <option value="Female">{!! $lang['female'] !!}</option>
                        </select>
                    </div>

                    {{-- Weight --}}
                    <div class="space-y-2">
                        <label for="weight" class="label">{!! $lang['weight'] !!}:</label>
                        <div class="relative w-auto" x-data="{ open: false, unit: @entangle('unit') }">
                            <input type="number" step="any" wire:model.live="weight" id="weight" class="input" placeholder="00" />
                            <span class="absolute right-3 top-4 cursor-pointer text-sm underline" @click="open = !open">
                                <span x-text="unit"></span> ▾
                            </span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                <p @click="$wire.set('unit', 'lbs'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">pounds (lbs)</p>
                                <p @click="$wire.set('unit', 'kg'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">kilograms (kg)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Activity --}}
                    <div class="space-y-2 relative">
                        <label for="activity" class="label">{!! $lang['activity'] !!}:</label>
                        <select wire:model.live="activity" id="activity" class="input">
                            <option value="0">{!! $lang['Sedentary'] !!}</option>
                            <option value="0.1">{!! $lang['Lightly'] !!}</option>
                            <option value="0.2">{!! $lang['Moderately'] !!}</option>
                            <option value="0.4">{!! $lang['Very'] !!}</option>
                        </select>
                    </div>

                    {{-- Weather --}}
                    <div class="space-y-2 relative">
                        <label for="weather" class="label">{!! $lang['weather'] !!}:</label>
                        <select wire:model.live="weather" id="weather" class="input">
                            <option value="0.05">{!! $lang['e_cool'] !!}</option>
                            <option value="0">{!! $lang['cool'] !!}</option>
                            <option value="0.1">{!! $lang['hot'] !!}</option>
                            <option value="0.2">{!! $lang['e_hot'] !!}</option>
                        </select>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full  rounded-xl  mt-4 ">
                            <div class="w-full">
                                <div class=" border rounded-xl px-4 py-3 mt-2" style="border: 1px solid #c1b8b899;">
                                    <strong>{{ $lang['1'] }}</strong>
                                    <strong class="text-[#119154] text-2xl">{{ round($detail['cups']) }}</strong>
                                    <strong>{{ $lang['2'] }}</strong>
                                </div>
                                <div class=" border rounded-xl px-4 py-3 mt-3" style="border: 1px solid #c1b8b899;">
                                    <strong>Which is</strong>
                                    <strong class="text-[#119154] text-2xl">{{ round($detail['us_ounce'] * 1.043175556502 ,1) }}</strong>
                                    <strong>Ounces</strong>
                                </div>
                                <div class="w-full">
                                    <div class="flex flex-wrap items-center">
                                        <div class="w-full lg:w-1/4 mt-3 lg:pr-2"><strong>{{ $lang['result'] }}</strong></div>
                                        <div class="w-full lg:w-1/4 mt-3 px-2">
                                            <div class="flex justify-between  border rounded-xl px-4 py-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="pr-3">{{ round($detail['us_ounce'] * 29.5735 ,2) }}</strong>
                                                <strong>{{ $lang['mili'] }}</strong>
                                            </div>
                                        </div>
                                        <div class="w-full lg:w-1/4 mt-3 px-2">
                                            <div class="flex justify-between  border rounded-xl px-4 py-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="pr-3">{{ round($detail['us_ounce'] * 0.0295735 ,2) }}</strong>
                                                <strong>{{ $lang['li'] }}</strong>
                                            </div>
                                        </div>
                                        <div class="w-full lg:w-1/4 mt-3 px-2">
                                            <div class="flex justify-between  border rounded-xl px-4 py-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="pr-3">{{ number_format($detail['us_ounce'] * 0.125,2) }}</strong>
                                                <strong>{{ $lang['cu'] }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <p class="mt-3"><strong class="text-blue">{{ $lang['12'] }}</strong></p>
                                <p>{{ $lang['13'] }}</p>
                                <p class="mt-2">{{ $lang['14'] }}</p>
                                <div class="w-full overflow-auto mt-4">
                                    <table class="w-full text-sm" cellspacing="0">
                                        <tr class="bg-gradient-to-r from-[#2845F5] to-[#2845F5] text-white">
                                            <td rowspan="2" class="text-center rounded-l-xl border-r px-4 py-3">
                                                {{ $lang['15'] }}
                                            </td>
                                            <td colspan="2" class="border-r text-center px-4 py-3">
                                                {{ $lang['16'] }}
                                            </td>
                                            <td colspan="2" class="text-center rounded-tr-xl px-4 py-3">
                                                {{ $lang['17'] }}
                                            </td>
                                        </tr>
                                        <tr class="bg-gradient-to-r from-[#2845F5] to-[#2845F5] text-white">
                                            <td class="border-r px-4 py-3">{{ $lang['18'] }} ({{ $lang['30'] }})</td>
                                            <td class="border-r px-4 py-3">{{ $lang['19'] }} ({{ $lang['30'] }})</td>
                                            <td class="border-r px-4 py-3">{{ $lang['18'] }} ({{ $lang['30'] }})</td>
                                            <td class="rounded-br-xl px-4 py-3">{{ $lang['19'] }} ({{ $lang['30'] }})</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b px-3 py-2">0-6 mo.</td>
                                            <td class="border-b px-3 py-2">0.68 ({{ $lang['20'] }})</td>
                                            <td class="border-b px-3 py-2">0.68 ({{ $lang['20'] }})</td>
                                            <td class="border-b px-3 py-2">0.70</td>
                                            <td class="border-b px-3 py-2">0.70</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b px-3 py-2">6-12 mo.</td>
                                            <td class="border-b px-3 py-2">0.80 - 1.00</td>
                                            <td class="border-b px-3 py-2">0.64 - 0.80</td>
                                            <td class="border-b px-3 py-2">0.80</td>
                                            <td class="border-b px-3 py-2">0.80</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b px-3 py-2">1-2 {{ $lang['21'] }}</td>
                                            <td class="border-b px-3 py-2">1.10 - 1.20</td>
                                            <td class="border-b px-3 py-2">0.88 - 0.90</td>
                                            <td class="border-b px-3 py-2">N/A</td>
                                            <td class="border-b px-3 py-2">N/A</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b px-3 py-2">2-3 {{ $lang['21'] }}</td>
                                            <td class="border-b px-3 py-2">1.30</td>
                                            <td class="border-b px-3 py-2">1.00</td>
                                            <td class="border-b px-3 py-2">N/A</td>
                                            <td class="border-b px-3 py-2">N/A</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b px-3 py-2">1-3 {{ $lang['21'] }}</td>
                                            <td class="border-b px-3 py-2">N/A</td>
                                            <td class="border-b px-3 py-2">N/A</td>
                                            <td class="border-b px-3 py-2">1.30</td>
                                            <td class="border-b px-3 py-2">0.90</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b px-3 py-2">4-8 {{ $lang['21'] }}</td>
                                            <td class="border-b px-3 py-2">1.60</td>
                                            <td class="border-b px-3 py-2">1.20</td>
                                            <td class="border-b px-3 py-2">1.70</td>
                                            <td class="border-b px-3 py-2">1.20</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b px-3 py-2">9-13 y. {{ $lang['22'] }}</td>
                                            <td class="border-b px-3 py-2">2.10</td>
                                            <td class="border-b px-3 py-2">1.60</td>
                                            <td class="border-b px-3 py-2">2.40</td>
                                            <td class="border-b px-3 py-2">1.80</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b px-3 py-2">9-13 y. {{ $lang['23'] }}</td>
                                            <td class="border-b px-3 py-2">1.90</td>
                                            <td class="border-b px-3 py-2">1.50</td>
                                            <td class="border-b px-3 py-2">2.10</td>
                                            <td class="border-b px-3 py-2">1.60</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b px-3 py-2">{{ $lang['22'] }} 14+ &amp; {{ $lang['24'] }}</td>
                                            <td class="border-b px-3 py-2">2.50</td>
                                            <td class="border-b px-3 py-2">2.00</td>
                                            <td class="border-b px-3 py-2">3.30</td>
                                            <td class="border-b px-3 py-2">2.60</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b px-3 py-2">{{ $lang['23'] }} 14+ &amp; {{ $lang['25'] }}</td>
                                            <td class="border-b px-3 py-2">2.00</td>
                                            <td class="border-b px-3 py-2">1.60</td>
                                            <td class="border-b px-3 py-2">2.30</td>
                                            <td class="border-b px-3 py-2">1.80</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b px-3 py-2">{{ $lang['26'] }}</td>
                                            <td class="border-b px-3 py-2">2.30</td>
                                            <td class="border-b px-3 py-2">1.84</td>
                                            <td class="border-b px-3 py-2">2.60</td>
                                            <td class="border-b px-3 py-2">1.90</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b px-3 py-2">{{ $lang['27'] }}</td>
                                            <td class="border-b px-3 py-2">2.60</td>
                                            <td class="border-b px-3 py-2">2.10</td>
                                            <td class="border-b px-3 py-2">3.40</td>
                                            <td class="border-b px-3 py-2">2.80</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2">{{ $lang['28'] }}</td>
                                            <td class="px-3 py-2">{{ $lang['29'] }}</td>
                                            <td class="px-3 py-2">{{ $lang['29'] }}</td>
                                            <td class="px-3 py-2">{{ $lang['29'] }}</td>
                                            <td class="px-3 py-2">{{ $lang['29'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
