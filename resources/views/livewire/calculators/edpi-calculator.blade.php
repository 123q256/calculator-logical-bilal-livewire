<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="game" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select wire:model.live="game" id="game" class="input my-2">
                            <option value="1">CS:GO</option>
                            <option value="2">Call of Duty</option>
                            <option value="3">Valorant</option>
                            <option value="4">Fortnite</option>
                            <option value="5">Overwatch</option>
                            <option value="6">Apex Legends</option>
                        </select>
                    </div>

                    {{-- DPI and Sensitivity are always shown --}}
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="dpi" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                                <div class="w-100 py-2">
                                    <input type="number" step="any" wire:model.live="dpi" id="dpi" class="input" aria-label="input" placeholder="600" />
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="sen" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                                <div class="w-100 py-2">
                                    <input type="number" step="any" wire:model.live="sen" id="sen" class="input" aria-label="input" placeholder="0.12" />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Raw Input and Windows Sensitivity only for CS:GO --}}
                    @if($game == '1')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="row" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                                    <select wire:model.live="row" id="row" class="input my-2">
                                        <option value="0">Off</option>
                                        <option value="1">On</option>
                                    </select>
                                </div>

                                {{-- Windows Multiplier only if Raw Input is OFF --}}
                                @if($row == '0')
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label for="win" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                                        <select wire:model.live="win" id="win" class="input my-2">
                                            <option value="0.03">1</option>
                                            <option value="0.06">2</option>
                                            <option value="0.25">3</option>
                                            <option value="0.5">4</option>
                                            <option value="0.75">5</option>
                                            <option value="1">6</option>
                                            <option value="1.5">7</option>
                                            <option value="2">8</option>
                                            <option value="2.5">9</option>
                                            <option value="3">10</option>
                                            <option value="3.5">11</option>
                                        </select>
                                    </div>
                                @endif
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
        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-5">
                            <div class="w-full">
                                <div class="w-full lg:w-[80%] mt-2">
                                    <table class="text-[18px] w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['ans'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['type'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>Cm/360° :</strong></td>
                                            <td class="border-b py-2">{{ $detail['cm'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>In/360° :</strong></td>
                                            <td class="border-b py-2">{{ $detail['in'] }}</td>
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
