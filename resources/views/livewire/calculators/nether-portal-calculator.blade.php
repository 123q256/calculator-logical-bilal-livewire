<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                {{-- Tabs --}}
                <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="setTab('simple')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $sim_adv === 'simple' ? 'tagsUnit' : '' }}">
                                {{ $cal_name }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="setTab('advance')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $sim_adv === 'advance' ? 'tagsUnit' : '' }}">
                                3D {{ $lang['5'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Simple View --}}
                    @if ($sim_adv === 'simple')
                        <div class="col-span-6">
                            <label for="cal" class="font-s-14 text-blue">{{ $lang['calculate'] }}</label>
                            <select wire:model.live="cal" id="cal" class="input my-2">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="2">{{ $lang['3'] }}</option>
                            </select>
                        </div>
                        <div class="col-span-6">
                            <label for="x" class="font-s-14 text-blue">X</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="x" id="x" class="input" placeholder="2" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="y" class="font-s-14 text-blue">Y</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="y" id="y" class="input" placeholder="1080" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="z" class="font-s-14 text-blue">Z</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="z" id="z" class="input" placeholder="1080" />
                            </div>
                        </div>
                    @else
                        {{-- 3D View --}}
                        <div class="col-span-6">
                            <label for="x1" class="font-s-14 text-blue">X1</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="x1" id="x1" class="input" placeholder="2" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="x2" class="font-s-14 text-blue">X2</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="x2" id="x2" class="input" placeholder="2" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="y1" class="font-s-14 text-blue">Y1</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="y1" id="y1" class="input" placeholder="1080" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="y2" class="font-s-14 text-blue">Y2</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="y2" id="y2" class="input" placeholder="1080" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="z1" class="font-s-14 text-blue">Z1</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="z1" id="z1" class="input" placeholder="1080" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="z2" class="font-s-14 text-blue">Z2</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="z2" id="z2" class="input" placeholder="1080" />
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                @if ($sim_adv === 'simple')
                                    <div class="w-full md:w-[60%] lg:w-[60%] text-[18px]">
                                        <table class="w-full">
                                            @php
                                                $xVal = $detail['x'];
                                                $yVal = $detail['y'];
                                                $zVal = $detail['z'];
                                                $comment = $detail['comment'] ?? null;
                                                $head = ($cal === '1') ? 'Nether Coordinates' : 'Overworld Coordinates';
                                            @endphp
                                            <tr>
                                                <td colspan="2"><strong>{{ $head }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">X</td>
                                                <td class="border-b py-2">{{ $xVal }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">Y</td>
                                                <td class="border-b py-2">{{ $yVal }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">Z</td>
                                                <td class="border-b py-2">{{ $zVal }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="pt-2"></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">X,Y,Z</td>
                                                <td class="border-b py-2">{{ $xVal . ', ' . $yVal . ', ' . $zVal }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    @if ($comment)
                                        <p class="mt-4">{{ $comment }}</p>
                                    @endif
                                @else
                                    <div class="text-center">
                                        <p class="font-s-20"><strong>{{ $lang['4'] }}</strong></p>
                                         <div class="flex flex-col items-center mt-2">
                                              <p class="text-[22px] bg-[#2845F5] px-3 py-2 radius-10 d-inline-block mt-3 p-3 rounded-[10px]">
                                            <strong class="text-white">{{ $detail['distance'] }}</strong>
                                        </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
