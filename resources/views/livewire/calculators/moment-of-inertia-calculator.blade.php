<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">

                    {{-- Shape Selection --}}
                    <div class="col-span-12">
                        <label for="selection" class="label">{{ $lang['1'] }}</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="selection" class="input" id="selection">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="2">{{ $lang['3'] }}</option>
                                <option value="3">{{ $lang['4'] }}</option>
                                <option value="4">{{ $lang['5'] }}</option>
                                <option value="7">{{ $lang['6'] }}</option>
                                <option value="8">I-{{ $lang['7'] }}</option>
                                <option value="9">L-{{ $lang['7'] }}</option>
                                <option value="10">T-{{ $lang['7'] }}</option>
                                <option value="11">{{ $lang['8'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Illustrative Image --}}
                    <div class="col-span-12 flex justify-center my-3">
                        @php
                            $images = [
                                '1' => 'p9.png',
                                '2' => 'p1.png',
                                '3' => 'p4.png',
                                '4' => 'p3.png',
                                '7' => 'p2.png',
                                '8' => 'p5.png',
                                '9' => 'p7.png',
                                '10' => 'p6.png',
                                '11' => 'p8.png',
                            ];
                            $currentImage = $images[$selection] ?? 'p9.png';
                        @endphp
                        <img src="{{ asset('images/' . $currentImage) }}" alt="moment of inertia calculator" width="180" height="180" class="coloring">
                    </div>

                    {{-- Base Width (b) --}}
                    @if (in_array($selection, ['1', '2', '7']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="b_width" class="label">{{ $lang['9'] }} (b):</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="b_width" id="b_width" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    {{-- Radius/Diameter (D) --}}
                    @if (in_array($selection, ['3', '4']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="radius" class="label">D ({{ $lang['10'] }})</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="radius" id="radius" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    {{-- Inner Radius (d) --}}
                    @if ($selection == '3')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="radius2" class="label">d ({{ $lang['11'] }})</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="radius2" id="radius2" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    {{-- Height (h) --}}
                    @if (in_array($selection, ['1', '2', '7']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="height" class="label">{{ $lang['12'] }} (h)</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="height" id="height" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    {{-- Distance (a) --}}
                    @if ($selection == '1')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="dis_to_height" class="label">{{ $lang['13'] }} (a)</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="dis_to_height" id="dis_to_height" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    {{-- Structural Beam Fields --}}
                    @if (in_array($selection, ['8', '10', '11']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="tfw" class="label">TFw</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="tfw" id="tfw" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="tft" class="label">TFt</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="tft" id="tft" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    @if (in_array($selection, ['8', '9', '11']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="bfw" class="label">BFw</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="bfw" id="bfw" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="bft" class="label">BFt</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="bft" id="bft" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    @if ($selection == '9')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="lft" class="label">LFt</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="lft" id="lft" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="lfh" class="label">LFh</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="lfh" id="lfh" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    @if (in_array($selection, ['8', '10']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="wh" class="label">Wh</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="wh" id="wh" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="wt" class="label">Wt</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="wt" id="wt" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    @if ($selection == '11')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="wt" class="label">Wt</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="wt" id="wt" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="h1" class="label">h</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="h1" id="h1" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    @if ($selection == '7')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="b1" class="label">b1</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="b1" id="b1" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="h1" class="label">h1</label>
                            <div class="w-full py-2">
                                <input type="text" inputmode="decimal" wire:model.live="h1" id="h1" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    {{-- Unit Selection --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="unit" class="label">{{ $lang['14'] }}</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="unit" class="input" id="unit">
                                <option value="mm">mm</option>
                                <option value="m">m</option>
                                <option value="cm">cm</option>
                                <option value="in">in</option>
                                <option value="ft">ft</option>
                            </select>
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
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>Ix</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['answer1'], 4) }} {!! $detail['m4'] !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>Iy</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['answer2'], 4) }} {!! $detail['m4'] !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>Cy</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['answer3'], 4) }} {!! $detail['m'] !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>Cx</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['answer4'], 4) }} {!! $detail['m'] !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>Area</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['answer5'], 4) }} {!! $detail['m2'] !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>Sz</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['answer6'], 4) }} {!! $detail['m3'] !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>Sx</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['answer7'], 4) }} {!! $detail['m3'] !!}</td>
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
