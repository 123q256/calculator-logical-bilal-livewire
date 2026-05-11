<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[50%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    {{-- Waist --}}
                    <div class="col-span-12">
                        <label for="waist" class="label">{!! $lang['3'] ?? 'Waist' !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="waist" id="waist" class="input">
                                <option value="30">58 cm (< 23 in)</option>
                                <option value="32">58-61 cm (23-24 in)</option>
                                <option value="34">62-64 cm (24-25 in)</option>
                                <option value="36">65-68 cm (25-26.5 in)</option>
                                <option value="38">69-72 cm (26.5-28 in)</option>
                                <option value="40">73-77 cm (28-30 in)</option>
                                <option value="42">78-81 cm (30-32 in)</option>
                                <option value="44">82-85 cm (32-33.5 in)</option>
                                <option value="46">86-90 cm (33.5-35.5 in)</option>
                                <option value="48">91-95 cm (35.5-37.5 in)</option>
                                <option value="50">96-102 cm (37.5-40 in)</option>
                                <option value="52">103-108 cm (40-42.5 in)</option>
                                <option value="54">109-114 cm (42.5-45 in)</option>
                                <option value="56">>114 cm (>45 in)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Bust --}}
                    <div class="col-span-12">
                        <label for="bust" class="label">{!! $lang['2'] ?? 'Bust' !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="bust" id="bust" class="input">
                                <option value="30">74 cm (29 in)</option>
                                <option value="32">74-77 cm (29-30 in)</option>
                                <option value="34">78-81 cm (31-32 in)</option>
                                <option value="36">82-85 cm (32-33.5 in)</option>
                                <option value="38">86-89 cm (33.5-35 in)</option>
                                <option value="40">90-93 cm (35-36.5 in)</option>
                                <option value="42">94-97 cm (36.5-38 in)</option>
                                <option value="44">98-102 cm (38-40 in)</option>
                                <option value="46">103-107 cm (40-42 in)</option>
                                <option value="48">108-113 cm (42-44.5 in)</option>
                                <option value="50">114-119 cm (44.5-47 in)</option>
                                <option value="52">120-125 cm (47-49 in)</option>
                                <option value="54">126-131 cm (49-51.5 in)</option>
                                <option value="56">>131 cm (>51.5 in)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Hips --}}
                    <div class="col-span-12">
                        <label for="hips" class="label">{!! $lang['4'] ?? 'Hips' !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="hips" id="hips" class="input">
                                <option value="30">< 80 cm (< 31.5 in)</option>
                                <option value="32">80-84 cm (31.5-33 in)</option>
                                <option value="34">85-89 cm (33-35 in)</option>
                                <option value="36">90-94 cm (35-37 in)</option>
                                <option value="38">95-97 cm (37-38 in)</option>
                                <option value="40">98-101 cm (38-40 in)</option>
                                <option value="42">102-104 cm (40-41 in)</option>
                                <option value="44">105-108 cm (41-42.5 in)</option>
                                <option value="46">109-112 cm (42.5-44 in)</option>
                                <option value="48">113-116 cm (44-45.5 in)</option>
                                <option value="50">117-122 cm (45.5-48 in)</option>
                                <option value="52">123-128 cm (48-50 in)</option>
                                <option value="54">129-134 cm (50-53 in)</option>
                                <option value="56">>134 cm (>53 in)</option>
                            </select>
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
                            @isset($detail['firstText'])
                                @php
                                    $msg = $detail['firstText'];
                                    $msg = $lang['5'] . "🙂.";
                                @endphp
                                <p class="mt-2 font-s-18">{!! $msg !!}</p>
                            @endisset
                            @isset($detail['secondText'])
                                <p class="mt-2">{!! $lang['8'] !!}</p>
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2 overflow-auto">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b">&nbsp;</td>
                                            <td class="py-2 border-b"><strong>{!! $lang['2'] !!}</strong></td>
                                            <td class="py-2 border-b"><strong>{!! $lang['4'] !!}</strong></td>
                                            <td class="py-2 border-b"><strong>{!! $lang['3'] !!}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">USA</td>
                                            <td class="py-2 border-b">{{ $detail['usBust'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['usHips'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['usWaist'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">UK</td>
                                            <td class="py-2 border-b">{{ $detail['ukBust'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['ukHips'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['ukWaist'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">EU</td>
                                            <td class="py-2 border-b">{{ $detail['euBust'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['euHips'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['euWaist'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{!! $lang['9'] !!}</td>
                                            <td class="py-2 border-b">{{ $detail['internationalBust'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['internationalHips'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['internationalWaist'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endisset
                            @isset($detail['usaSize'])
                                <p class="my-2"><strong>{!! $lang['6'] !!}</strong></p>
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div class="flex flex-wrap items-center me-2">
                                                <img src="{{ url('images/USA.png') }}" width="30px">
                                                <span class="pt-1 ms-2">USA</span>
                                            </div>
                                            <div><strong class="text-green text-[25px]">{{ $detail['usaSize'] }}</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div class="flex flex-wrap items-center me-2">
                                                <img src="{{ url('images/UK.png') }}" width="30px">
                                                <span class="pt-1 ms-2">UK</span>
                                            </div>
                                            <div><strong class="text-green text-[25px]">{{ $detail['ukSize'] }}</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div class="flex flex-wrap items-center me-2">
                                                <img src="{{ url('images/Europe.png') }}" width="30px">
                                                <span class="pt-1 ms-2">Europe (DE/AT/NL/SE/DK)</span>
                                            </div>
                                            <div><strong class="text-green text-[25px]">{{ $detail['euroSize'] }}</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div class="flex flex-wrap items-center me-2">
                                                <img src="{{ url('images/International.png') }}" width="30px">
                                                <span class="pt-1 ms-2">{!! $lang['9'] !!}</span>
                                            </div>
                                            <div><strong class="text-green text-[25px]">{{ $detail['internationalSize'] }}</strong></div>
                                        </div>
                                    </div>
                                </div>
                            @endisset
                            <p class="mt-2">
                                <strong>{!! $lang['10'] !!}:</strong>{!! $lang['11'] !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
