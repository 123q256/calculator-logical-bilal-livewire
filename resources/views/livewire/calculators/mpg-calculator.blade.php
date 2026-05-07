<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="setTab('first')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $calc_type === 'first' ? 'tagsUnit' : '' }}">
                                {{ $lang['1'] }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="setTab('second')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $calc_type === 'second' ? 'tagsUnit' : '' }}">
                                {{ $lang['2'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 mt-3 gap-4">
                    @if ($calc_type === 'first')
                        {{-- Simple Calculator --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="operations" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="operations" id="operations" class="input">
                                    <option value="1">{{ $lang['4'] }}</option>
                                    <option value="2">{{ $lang['5'] }}</option>
                                    <option value="3">{{ $lang['6'] }}</option>
                                </select>
                            </div>
                        </div>

                        {{-- Input 1 (Distance or Efficiency) --}}
                        @if ($operations !== '1')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="first" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                                <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                                    <input type="number" step="any" wire:model.live="first" id="first" class="input" />
                                    @php $u1_map = ['1' => 'km', '2' => 'mi']; @endphp
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="('{{ $u1_map[$units1] ?? 'km' }}') + ' ▾'"></label>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                        @foreach ($u1_map as $val => $name)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units1', '{{ $val }}')" @click="open = false">{{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Input 2 (Fuel Used) --}}
                        @if ($operations !== '2')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="second" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                                <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                                    <input type="number" step="any" wire:model.live="second" id="second" class="input" />
                                    @php $u2_map = ['1' => $lang[7], '2' => 'US gal', '3' => 'UK gal']; @endphp
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="('{{ $u2_map[$units2] ?? $lang[7] }}') + ' ▾'"></label>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                        @foreach ($u2_map as $val => $name)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units2', '{{ $val }}')" @click="open = false">{{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Input 3 (Efficiency or Fuel Used) --}}
                        @if ($operations !== '3')
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="third" class="font-s-14 text-blue">{{ $operations === '1' ? $lang['6'] : $lang['5'] }}:</label>
                                <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                                    <input type="number" step="any" wire:model.live="third" id="third" class="input" />
                                    @php $u3_map = ['1' => 'L/100km', '2' => 'US mpg', '3' => 'UK mpg', '4' => 'kmpl']; @endphp
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="('{{ $u3_map[$units3] ?? 'L/100km' }}') + ' ▾'"></label>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                        @foreach ($u3_map as $val => $name)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units3', '{{ $val }}')" @click="open = false">{{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Gas Price --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="four" class="font-s-14 text-blue">{{ $lang[8] }} ({{ $lang[9] }}):</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                                <input type="number" step="any" wire:model.live="four" id="four" class="input" />
                                @php $u4_map = ['1' => $currancy.' '.$lang[7], '2' => $currancy.' US gal', '3' => $currancy.' UK gal']; @endphp
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="('{{ $u4_map[$units4] ?? ($currancy.' '.$lang[7]) }}') + ' ▾'"></label>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                    @foreach ($u4_map as $val => $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units4', '{{ $val }}')" @click="open = false">{{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @else
                        {{-- Advanced Calculator --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="ad_first" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="ad_first" id="ad_first" class="input" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="ad_second" class="font-s-14 text-blue">{{ $lang['12'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="ad_second" id="ad_second" class="input" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="ad_third" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                                <input type="number" step="any" wire:model.live="ad_third" id="ad_third" class="input" />
                                @php $adu3_map = ['1' => $lang[7], '2' => 'US gal', '3' => 'UK gal']; @endphp
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="('{{ $adu3_map[$ad_units3] ?? $lang[7] }}') + ' ▾'"></label>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                    @foreach ($adu3_map as $val => $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('ad_units3', '{{ $val }}')" @click="open = false">{{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="ad_four" class="font-s-14 text-blue">{{ $lang[8] }} ({{ $lang[9] }}):</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                                <input type="number" step="any" wire:model.live="ad_four" id="ad_four" class="input" />
                                @php $adu4_map = ['1' => $currancy.' '.$lang[7], '2' => $currancy.' US gal', '3' => $currancy.' UK gal']; @endphp
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="('{{ $adu4_map[$ad_units4] ?? ($currancy.' '.$lang[7]) }}') + ' ▾'"></label>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                    @foreach ($adu4_map as $val => $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('ad_units4', '{{ $val }}')" @click="open = false">{{ $name }}</p>
                                    @endforeach
                                </div>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="w-full md:w-[60%] lg:w-[60%] lg:text-[18px] md:text-[18px] text-[14px]">
                                    <table class="w-full">
                                        @if ($calc_type === 'first')
                                            @if ($operations === '1')
                                                @php
                                                    $j5 = round(1.609344 * $detail['jawab'], 3);
                                                @endphp
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[4] }}<span> (miles)</span> :</strong></td>
                                                    <td class="border-b py-2">{{ round($detail['jawab'], 3) }}<span> (mi)</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[4] }}<span> ({{ $lang[13] }})</span> :</strong></td>
                                                    <td class="border-b py-2">{{ $j5 }}<span> (km)</span></td>
                                                </tr>
                                            @elseif ($operations === '2')
                                                @php
                                                    $j2 = round(3.78541 * $detail['jawab'], 3);
                                                    $j3 = round($detail['jawab'] / 1.201, 3);
                                                @endphp
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[5] }} :</strong></td>
                                                    <td class="border-b py-2">{{ round($detail['jawab'], 3) }} (US gal)</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[7] }}<span> ({{ $lang[13] }})</span> :</strong></td>
                                                    <td class="border-b py-2">{{ $j2 }} ({{ $lang[7] }})</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[15] }}<span> ({{ $lang[13] }})</span> :</strong></td>
                                                    <td class="border-b py-2">{{ $j3 }} (UK gal)</td>
                                                </tr>
                                            @elseif ($operations === '3')
                                                @php
                                                    $j2 = round(235.215 / $detail['jawab'], 3);
                                                    $j3 = round(1.2 * $detail['jawab'], 3);
                                                    $j4 = round(0.425144 * $detail['jawab'], 3);
                                                @endphp
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[6] }} :</strong></td>
                                                    <td class="border-b py-2">{{ round($detail['jawab'], 3) }} (US mpg)</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[16] }} 100 {{ $lang[13] }} :</strong></td>
                                                    <td class="border-b py-2">{{ $j2 }} (L/100km)</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[18] }} (US) :</strong></td>
                                                    <td class="border-b py-2">{{ round($detail['jawab'], 3) }} (US mpg)</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[18] }}<span> (UK)</span> :</strong></td>
                                                    <td class="border-b py-2">{{ $j3 }} (UK mpg)</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[17] }}<span> (UK)</span> :</strong></td>
                                                    <td class="border-b py-2">{{ $j4 }} (kmpl)</td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['cost']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[14] }} :</strong></td>
                                                    <td class="border-b py-2">{{ $currancy . ' ' . $detail['cost'] }}</td>
                                                </tr>
                                            @endif
                                        @else
                                            @php
                                                $j2 = round(235.215 / $detail['mi_jawab'], 3);
                                                $j3 = round(1.2 * $detail['mi_jawab'], 3);
                                                $j4 = round(0.425144 * $detail['mi_jawab'], 3);
                                                $j22 = round(235.215 / $detail['km_jawab'], 3);
                                                $j32 = round(1.2 * $detail['km_jawab'], 3);
                                                $j42 = round(0.425144 * $detail['km_jawab'], 3);
                                            @endphp
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[4] }} :</strong></td>
                                                <td class="border-b py-2">{{ $detail['distance'] }} ({{ $lang[19] }})</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[6] }} :</strong></td>
                                                <td class="border-b py-2">{{ round($detail['mi_jawab'], 3) }} (US mpg)</td>
                                            </tr>
                                            @if (!empty($detail['ad_cost']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang[14] }} :</strong></td>
                                                    <td class="border-b py-2">{{ $currancy . ' ' . $detail['ad_cost'] }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[16] }} 100 {{ $lang[13] }} :</strong></td>
                                                <td class="border-b py-2">{{ $j2 }} (L/100km)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[18] }} (US) :</strong></td>
                                                <td class="border-b py-2">{{ round($detail['mi_jawab'], 3) }} (US mpg)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[18] }} (UK) :</strong></td>
                                                <td class="border-b py-2">{{ $j3 }} (UK mpg)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[17] }} :</strong></td>
                                                <td class="border-b py-2">{{ $j4 }} (kmpl)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[4] }} :</strong></td>
                                                <td class="border-b py-2">{{ round($detail['km_dis'], 3) }} (km)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[6] }} :</strong></td>
                                                <td class="border-b py-2">{{ round($detail['km_jawab'], 3) }} (US mpg)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[16] }} 100 {{ $lang[13] }} :</strong></td>
                                                <td class="border-b py-2">{{ $j22 }} (L/100km)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[18] }} (US) :</strong></td>
                                                <td class="border-b py-2">{{ round($detail['km_jawab'], 3) }} (US mpg)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[18] }} (UK) :</strong></td>
                                                <td class="border-b py-2">{{ $j32 }} (UK mpg)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[17] }} :</strong></td>
                                                <td class="border-b py-2">{{ $j42 }} (kmpl)</td>
                                            </tr>
                                        @endif
                                    </table>
                                    <div class="text-center mt-6">
                                        <button type="button" wire:click="resetForm" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3">
                                            {{ (app()->getLocale() == 'en') ? 'RESET' : ($lang['reset'] ?? 'RESET') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
