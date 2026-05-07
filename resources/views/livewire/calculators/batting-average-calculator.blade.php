<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Operation Selection --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="operations" id="operations" class="input">
                                @php
                                    $opNames = [$lang['2'],$lang['3'],$lang['4'],$lang['5'],$lang['6'],$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12'],$lang['13'],$lang['14'],$lang['15'],$lang['16'],$lang['17'],$lang['18'],$lang['19'],$lang['20'],$lang['21'],$lang['22'],$lang['23']];
                                    $opVals = ['3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
                                @endphp
                                @foreach($opVals as $idx => $val)
                                    <option value="{{ $val }}">{{ $opNames[$idx] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @php
                        $config = [
                            '3' => ['lb_1' => "Number of Runs Scored:", 'lb_2' => "Number of Innings Played:", 'lb_3' => "Number of Times Not Out:"],
                            '4' => ['lb_1' => "Number of At Bats:", 'lb_2' => "Number of Hits:"],
                            '5' => ['lb_1' => "At Bats:", 'lb_2' => "Hits:", 'lb_3' => "Walks:", 'lb_4' => "Hit by Pitch:", 'lb_5' => "Sacrifice Flies:"],
                            '6' => ['lb_1' => "At Bats:", 'lb_2' => "Singles:", 'lb_3' => "Doubles:", 'lb_4' => "Triples:", 'lb_5' => "Home Runs:"],
                            '7' => ['lb_1' => "Singles:", 'lb_2' => "Doubles:", 'lb_3' => "Triples:", 'lb_4' => "Home Runs:", 'lb_5' => "Hits:", 'lb_6' => "Walks:", 'lb_5b' => "Sacrifice Flies:", 'lb_7' => "Hits by Pitch:", 'lb_8' => "At Bats:"],
                            '8' => ['lb_1' => "Plate Appearances:", 'lb_2' => "Non Intentional Walks (BB-IBB):", 'lb_3' => "Hit by Pitch:", 'lb_4' => "Singles:", 'lb_5' => "Doubles:", 'lb_6' => "Triples:", 'lb_5b' => "Home Runs:", 'lb_7' => "Reached Base on Error:"],
                            '9' => ['lb_1' => "At Bats:", 'lb_2' => "Hits:", 'lb_3' => "Home Runs:", 'lb_4' => "Sacrifice Flies:", 'lb_5' => "Strikeouts:"],
                            '10' => ['lb_1' => "At Bats:", 'lb_2' => "Doubles:", 'lb_3' => "Triples:", 'lb_4' => "Home Runs:"],
                            '11' => ['lb_1' => "At Bats:", 'lb_2' => "Hits:", 'lb_3' => "Walks:", 'lb_4' => "Total Bases:", 'lb_5' => "Hit by Pitch:", 'lb_6' => "GIDP (Grounded into Double Play):", 'lb_5b' => "IBB (Intentional Base on Balls):", 'lb_7' => "Sacrifice Hits:", 'lb_8' => "Sacrifice Flies:", 'lb_9' => "Stolen Bases:", 'lb_10' => "Caught Stealing:"],
                            '12' => ['lb_1' => "Total Bases:", 'lb_2' => "Hits:", 'lb_3' => "Walks:", 'lb_4' => "Stolen Bases:", 'lb_5' => "Caught Stealing:", 'lb_6' => "At Bats:"],
                            '13' => ['lb_1' => "Singles:", 'lb_2' => "Doubles:", 'lb_3' => "Triples:", 'lb_4' => "Home Runs:"],
                            '14' => ['lb_1' => "At Bats:", 'lb_2' => "Home Runs:"],
                            '15' => ['lb_1' => "Assists:", 'lb_2' => "Putouts:", 'lb_3' => "Errors:"],
                            '16' => ['lb_1' => "Games Played:", 'lb_2' => "Putouts:", 'lb_3' => "Assists:"],
                            '17' => ['lb_1' => "Innings Played:", 'lb_2' => "Putouts:", 'lb_3' => "Assists:"],
                            '18' => ['lb_1' => "Earned Runs:", 'lb_2' => "Innings Pitched:"],
                            '19' => ['lb_1' => "Hits Allowed:", 'lb_2' => "Walks Allowed:", 'lb_3' => "Innings Pitched:"],
                            '20' => ['lb_1' => "Innings Pitched:", 'lb_2' => "Hits Allowed:"],
                            '21' => ['lb_1' => "Innings Pitched:", 'lb_2' => "Home Runs:"],
                            '22' => ['lb_1' => "Innings Pitched:", 'lb_2' => "Strikeouts:"],
                            '23' => ['lb_1' => "Innings Pitched:", 'lb_2' => "Walks:"],
                            '24' => ['lb_1' => "Strikeouts:", 'lb_2' => "Walks:"],
                        ];
                        $curr = $config[$operations] ?? [];
                    @endphp

                    {{-- Dynamic Inputs --}}
                    @if (isset($curr['lb_1']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="first" class="font-s-14 text-blue">{{ $curr['lb_1'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="first" id="first" class="input" />
                            </div>
                        </div>
                    @endif
                    @if (isset($curr['lb_2']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="second" class="font-s-14 text-blue">{{ $curr['lb_2'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="second" id="second" class="input" />
                            </div>
                        </div>
                    @endif
                    @if (isset($curr['lb_3']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="third" class="font-s-14 text-blue">{{ $curr['lb_3'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="third" id="third" class="input" />
                            </div>
                        </div>
                    @endif
                    @if (isset($curr['lb_4']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="four" class="font-s-14 text-blue">{{ $curr['lb_4'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="four" id="four" class="input" />
                            </div>
                        </div>
                    @endif
                    @if (isset($curr['lb_5']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="five" class="font-s-14 text-blue">{{ $curr['lb_5'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="five" id="five" class="input" />
                            </div>
                        </div>
                    @endif
                    @if (isset($curr['lb_6']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="quantity" class="font-s-14 text-blue">{{ $curr['lb_6'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="quantity" id="quantity" class="input" />
                            </div>
                        </div>
                    @endif
                    @if (isset($curr['lb_5b']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="fiveb" class="font-s-14 text-blue">{{ $curr['lb_5b'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="fiveb" id="fiveb" class="input" />
                            </div>
                        </div>
                    @endif
                    @if (isset($curr['lb_7']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="seven" class="font-s-14 text-blue">{{ $curr['lb_7'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="seven" id="seven" class="input" />
                            </div>
                        </div>
                    @endif
                    @if (isset($curr['lb_8']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="eight" class="font-s-14 text-blue">{{ $curr['lb_8'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="eight" id="eight" class="input" />
                            </div>
                        </div>
                    @endif
                    @if (isset($curr['lb_9']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="nine" class="font-s-14 text-blue">{{ $curr['lb_9'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="nine" id="nine" class="input" />
                            </div>
                        </div>
                    @endif
                    @if (isset($curr['lb_10']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="ten" class="font-s-14 text-blue">{{ $curr['lb_10'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="ten" id="ten" class="input" />
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
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{ $detail['heading'] }}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2 my-3"><strong class="text-blue">{{ $detail['batting'] }}</strong></p>
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
