<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mb-2">
                        <label for="operation" class="label">{{ $lang['1'] ?? 'Select Operation' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="operations" id="operation" class="input">
                                <option value="3">{{ $lang[2] ?? 'Standard Normal Distribution' }}</option>
                                <option value="4">{{ $lang[3] ?? 'Normal Distribution' }}</option>
                            </select>
                        </div>
                    </div>

                    @if($operations == '3')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="find_compare" class="label">{{ $lang['4'] ?? 'Find/Compare' }}:</label>
                                    <div class="w-100 py-2">
                                        <select wire:model.live="find_compare" id="find_compare" class="input">
                                            <option value="1">{{ ($lang[5] ?? 'x') . ' (x)' }}</option>
                                            <option value="2">{{ ($lang[6] ?? 'P(X < x)') . ' P(X < x)' }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label class="label">
                                        @if($find_compare == '1')
                                            {{ $lang['7'] ?? 'Cumulative probability' }}: P(X < x):
                                        @else
                                            Normal random variable (x):
                                        @endif
                                    </label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="f_first" class="input" placeholder="00" />
                                    </div>
                                </div>

                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label class="label">{{ $lang['8'] ?? 'Mean' }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="f_second" class="input" placeholder="00" />
                                    </div>
                                </div>

                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label class="label">{{ $lang['9'] ?? 'Standard deviation' }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="f_third" class="input" placeholder="00" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="mean" class="label">{{ $lang['8'] ?? 'Mean' }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="mean" id="mean" class="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="deviation" class="label">{{ $lang['9'] ?? 'Standard deviation' }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="deviation" id="deviation" class="input" placeholder="00" />
                                    </div>
                                </div>

                                <p class="col-span-12 font-s-18 px-2"><strong class="text-blue">{{ $lang[10] ?? 'Find Probability' }}</strong></p>

                                <div class="col-span-12 flex items-center gap-2">
                                    <span class="text-lg">\( P(X \leq \)</span>
                                    <input type="number" step="any" wire:model.live="a" class="input !w-24" placeholder="00" />
                                    <span class="text-lg">\( ) = ? \)</span>
                                </div>

                                <div class="col-span-12 flex items-center gap-2 mt-3">
                                    <span class="text-lg">\( P(X \geq \)</span>
                                    <input type="number" step="any" wire:model.live="b" class="input !w-24" placeholder="00" />
                                    <span class="text-lg">\( ) = ? \)</span>
                                </div>

                                <div class="col-span-12 flex items-center gap-2 mt-3">
                                    <span class="text-lg">\( P(X \leq ? ) = \)</span>
                                    <input type="number" step="any" wire:model.live="c" class="input !w-24" placeholder="00" />
                                </div>

                                <div class="col-span-12 flex items-center gap-2 mt-3">
                                    <span class="text-lg">\( P(X \geq ? ) = \)</span>
                                    <input type="number" step="any" wire:model.live="d" class="input !w-24" placeholder="00" />
                                </div>

                                <div class="col-span-12 flex items-center gap-2 mt-3">
                                    <span class="text-lg">\( P( \)</span>
                                    <input type="number" step="any" wire:model.live="e1" class="input !w-24" placeholder="00" />
                                    <span class="text-lg">\( \leq X \leq \)</span>
                                    <input type="number" step="any" wire:model.live="e2" class="input !w-24" placeholder="00" />
                                    <span class="text-lg">\( ) = ? \)</span>
                                </div>

                                <div class="col-span-12 flex items-center gap-2 mt-3">
                                    <span class="text-lg">\( P( -? \leq X \leq ? ) = \)</span>
                                    <input type="number" step="any" wire:model.live="f" class="input !w-24" placeholder="00" />
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
                            <div class="w-full">
                                @if (isset($detail['option1']))
                                    @php
                                        $answer1_f = $f_first - $f_second;
                                        $final_first = $f_third != 0 ? round($answer1_f / $f_third, 4) : 0;
                                    @endphp
                                    <div class="text-center">
                                        <p class="text-[18px]">
                                            <strong class="text-blue">{{ $lang['12'] ?? 'Result' }}</strong>
                                        </p>
                                        <div class="flex justify-center">
                                            <p class="text-[21px] bg-[#2845F5] text-white px-3 overflow-auto py-2 rounded-lg d-inline-block my-3">
                                                <strong>\( P( X \leq {{ $detail['blow_first'] }} ) = {{ $f_first }} \)</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="col-12 mt-3 text-[18px]"><strong class="text-blue">{{ $lang[13] ?? 'Solution' }}:</strong></p>
                                    <p class="col-12 mt-2 text-[18px]"><b>{{ $lang[14] ?? 'Step' }} 1:</b></p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        {{ $lang[15] ?? 'Visualize the area for' }}
                                        <strong>\( ( X \leq {{ $f_first }} ) \)</strong>
                                        {{ $lang[16] ?? 'on the graph' }}.
                                    </p>
                                    <div class="col-12 text-center">
                                        <img src="{{ url('images/z_score/' . $detail['z_url'] . '.png') }}" alt="Z-Score Graph" class="img_set mx-auto" width="57%" height="100%">
                                    </div>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 2:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Normalize the variable using' }}
                                        <b>\( \mu = {{ $f_second }} \)</b>
                                        {{ $lang[18] ?? 'and' }}
                                        <b>\( \sigma = {{ $f_third }} \)</b>
                                        {{ $lang[19] ?? 'formula' }}:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( X \leq ? ) = P( X - \mu \leq {{ $f_first }} - {{ $f_second }} ) = P( \frac{X - \mu}{\sigma} \leq \frac{ {{ $f_first }} - {{ $f_second }} }{ {{ $f_third }} } ) \)
                                    </p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Calculating Z-score' }}:
                                        <b>\( \frac{x - \mu}{\sigma} = Z = \frac{ {{ $f_first }} - {{ $f_second }} }{ {{ $f_third }} } = {{ $final_first }} \)</b>
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( X \leq ? ) = P( Z \leq {{ $final_first }} ) \)
                                    </p>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 3:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[20] ?? 'Find the value from' }}
                                        <b>{{ $lang[21] ?? 'Z-table' }}</b>
                                        {{ $lang[22] ?? 'as follows' }}:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( Z \leq {{ $detail['blow_first'] }} ) = {{ $f_first }} \)
                                    </p>

                                @elseif (isset($detail['option2']))
                                    <div class="text-center">
                                        <p class="text-[18px]">
                                            <strong class="text-blue">{{ $lang['12'] ?? 'Result' }}</strong>
                                        </p>
                                        <div class="flex justify-center">
                                            <p class="text-[21px] bg-[#2845F5] text-white px-3 overflow-auto py-2 rounded-lg d-inline-block my-3">
                                                <strong>\( P( X \leq {{ $f_first }} ) = {{ $detail['ltpv_first'] }} \)</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="col-12 mt-3 text-[18px]"><strong class="text-blue">{{ $lang[13] ?? 'Solution' }}:</strong></p>
                                    <p class="col-12 mt-2 text-[18px]"><strong class="text-blue">{{ $lang[14] ?? 'Step' }} 1:</strong></p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        {{ $lang[15] ?? 'Visualize the area for' }}
                                        <strong>\( ( X \leq {{ $f_first }} ) \)</strong>
                                        {{ $lang[16] ?? 'on the graph' }}.
                                    </p>
                                    <div class="col-12 text-center">
                                        <img src="{{ url('images/z_score/' . $detail['z_url'] . '.png') }}" alt="Z-Score Graph" class="img_set mx-auto" width="57%" height="100%">
                                    </div>
                                    <p class="col-12 mt-2 text-[18px]"><strong class="text-blue">{{ $lang[14] ?? 'Step' }} 2:</strong></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Normalize using' }}
                                        <strong>\( \mu = {{ $f_second }} \)</strong>
                                        {{ $lang[18] ?? 'and' }}
                                        <strong>\( \sigma = {{ $f_third }} \)</strong>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( X \leq {{ $f_first }} ) = P( X - \mu \leq {{ $f_first }} - {{ $f_second }} ) = P( \frac{X - \mu}{\sigma} \leq \frac{ {{ $f_first }} - {{ $f_second }} }{ {{ $f_third }} } ) \)
                                    </p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Calculating Z-score' }}:
                                        <strong>\( \frac{x - \mu}{\sigma} = Z = \frac{ {{ $f_first }} - {{ $f_second }} }{ {{ $f_third }} } = {{ $detail['rz_first'] }} \)</strong>
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( X \leq {{ $f_first }} ) = P( Z \leq {{ $detail['rz_first'] }} ) \)
                                    </p>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 3:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[20] ?? 'Find value from' }}
                                        <b>{{ $lang[21] ?? 'Z-table' }}</b>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( Z \leq {{ $detail['rz_first'] }} ) = {{ $detail['ltpv_first'] }} \)
                                    </p>

                                @elseif (isset($detail['a']))
                                    <div class="text-center">
                                        <p class="text-[18px]">
                                            <strong class="text-blue">{{ $lang['12'] ?? 'Result' }}</strong>
                                        </p>
                                        <div class="flex justify-center">
                                            <p class="text-[21px] bg-[#2845F5] text-white px-3 overflow-auto py-2 rounded-lg d-inline-block my-3">
                                                <strong>\( P( X \leq {{ $a }} ) = {{ $detail['ltpv'] }} \)</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="col-12 mt-3 text-[18px]"><strong class="text-blue">{{ $lang[13] ?? 'Solution' }}:</strong></p>
                                    <p class="col-12 mt-2 text-[18px]"><strong class="text-blue">{{ $lang[14] ?? 'Step' }} 1:</strong></p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        {{ $lang[15] ?? 'Visualize area' }}
                                        <strong>\( ( X \leq {{ $a }} ) \)</strong>.
                                    </p>
                                    <div class="text-center">
                                        <img src="{{ url('images/z_score/' . $detail['z_url'] . '.png') }}" alt="Z-Score Graph" class="img_set mx-auto" width="57%" height="100%">
                                    </div>
                                    <p class="col-12 mt-2 text-[18px]"><strong class="text-blue">{{ $lang[14] ?? 'Step' }} 2:</strong></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Normalize' }}
                                        <strong>\( \mu = {{ $mean }} \)</strong>, <strong>\( \sigma = {{ $deviation }} \)</strong>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( X \leq {{ $a }} ) = P( X - \mu \leq {{ $a }} - {{ $mean }} ) = P( \frac{X - \mu}{\sigma} \leq \frac{ {{ $a }} - {{ $mean }} }{ {{ $deviation }} } ) \)
                                    </p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Z-score' }}:
                                        <strong>\( \frac{x - \mu}{\sigma} = Z = \frac{ {{ $a }} - {{ $mean }} }{ {{ $deviation }} } = {{ $detail['rz'] }} \)</strong>
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( X \leq {{ $a }} ) = P( Z \leq {{ $detail['rz'] }} ) \)
                                    </p>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 3:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[20] ?? 'From' }} <b>{{ $lang[21] ?? 'Z-table' }}</b>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( Z \leq {{ $detail['rz'] }} ) = {{ $detail['ltpv'] }} \)
                                    </p>
                                @endif

                                @if (isset($detail['b']))
                                    <div class="text-center">
                                        <p class="text-[18px]">
                                            <strong class="text-blue">{{ $lang['12'] ?? 'Result' }}</strong>
                                        </p>
                                        <div class="flex justify-center">
                                            <p class="text-[21px] bg-[#2845F5] text-white px-3 overflow-auto py-2 rounded-lg d-inline-block my-3">
                                                <strong>\( P( X \geq {{ $b }} ) = {{ $detail['rtpv2'] }} \)</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="col-12 mt-3 text-[18px]"><strong class="text-blue">{{ $lang[13] ?? 'Solution' }}:</strong></p>
                                    <p class="col-12 mt-2 text-[18px]"><strong class="text-blue">{{ $lang[14] ?? 'Step' }} 1:</strong></p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        {{ $lang[15] ?? 'Visualize area' }}
                                        <b>\( ( X \geq {{ $b }} ) \)</b>.
                                    </p>
                                    <div class="text-center">
                                        <img src="{{ url('images/z_score/' . $detail['z_url2'] . '.png') }}" alt="Z-Score Graph" class="img_set mx-auto" width="57%" height="100%">
                                    </div>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 2:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Normalize' }}
                                        <b>\( \mu = {{ $mean }} \)</b>, <b>\( \sigma = {{ $deviation }} \)</b>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( X \geq {{ $b }} ) = P( X - \mu \geq {{ $b }} - {{ $mean }} ) = P( \frac{X - \mu}{\sigma} \geq \frac{ {{ $b }} - {{ $mean }} }{ {{ $deviation }} } ) \)
                                    </p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Z-score' }}:
                                        <b>\( \frac{x - \mu}{\sigma} = Z = \frac{ {{ $b }} - {{ $mean }} }{ {{ $deviation }} } = {{ $detail['rz2'] }} \)</b>
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( X \geq {{ $b }} ) = P( Z \geq {{ $detail['rz2'] }} ) \)
                                    </p>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 3:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[20] ?? 'From' }} <b>{{ $lang[21] ?? 'Z-table' }}</b>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( Z \geq {{ $detail['rz2'] }} ) = {{ $detail['rtpv2'] }} \)
                                    </p>
                                @endif

                                @if (isset($detail['c']))
                                    @php
                                        $answer1 = $detail['blow'] - $mean;
                                        $final = $deviation != 0 ? round($answer1 / $deviation, 4) : 0;
                                    @endphp
                                    <div class="text-center">
                                        <p class="text-[18px]">
                                            <strong class="text-blue">{{ $lang['12'] ?? 'Result' }}</strong>
                                        </p>
                                        <div class="flex justify-center">
                                            <p class="text-[21px] bg-[#2845F5] text-white px-3 overflow-auto py-2 rounded-lg d-inline-block my-3">
                                                <strong>\( P( X \leq {{ $detail['blow'] }} ) = {{ $c }} \)</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="col-12 mt-3 text-[18px]"><strong class="text-blue">{{ $lang[13] ?? 'Solution' }}:</strong></p>
                                    <p class="col-12 mt-2 text-[18px]"><strong class="text-blue">{{ $lang[14] ?? 'Step' }} 1:</strong></p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        {{ $lang[15] ?? 'Visualize area' }}
                                        <b>\( ( X \leq {{ $detail['blow'] }} ) \)</b>.
                                    </p>
                                    <div class="text-center">
                                        <img src="{{ url('images/z_score/' . $detail['z_urlc'] . '.png') }}" alt="Z-Score Graph" class="img_set mx-auto" width="57%" height="100%">
                                    </div>
                                    <p class="col-12 mt-2 text-[18px]"><b>{{ $lang[14] ?? 'Step' }} 2:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Normalize' }}
                                        <b>\( \mu = {{ $mean }} \)</b>, <b>\( \sigma = {{ $deviation }} \)</b>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( X \leq ? ) = P( X - \mu \leq ? - {{ $mean }} ) = P( \frac{X - \mu}{\sigma} \leq \frac{? - {{ $mean }} }{ {{ $deviation }} } ) \)
                                    </p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Z-score calculation' }}:
                                        <b>\( \frac{x - \mu}{\sigma} = Z = \frac{ {{ $detail['blow'] }} - {{ $mean }} }{ {{ $deviation }} } = {{ $final }} \)</b>
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( X \leq ? ) = P( Z \leq {{ $detail['blow'] }} ) \)
                                    </p>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 3:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[20] ?? 'From' }} <b>{{ $lang[21] ?? 'Z-table' }}</b>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( Z \leq {{ $detail['blow'] }} ) = {{ $c }} \)
                                    </p>
                                @endif

                                @if (isset($detail['d']))
                                    @php
                                        $answer1 = $detail['above2'] - $mean;
                                        $final = $deviation != 0 ? round($answer1 / $deviation, 4) : 0;
                                    @endphp
                                    <div class="text-center">
                                        <p class="text-[18px]">
                                            <strong class="text-blue">{{ $lang['12'] ?? 'Result' }}</strong>
                                        </p>
                                        <div class="flex justify-center">
                                            <p class="text-[21px] bg-[#2845F5] text-white px-3 overflow-auto py-2 rounded-lg d-inline-block my-3">
                                                <strong>\( P( X \geq {{ $detail['above2'] }} ) = {{ $d }} \)</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="col-12 mt-3 text-[18px]"> <b>{{ $lang[13] ?? 'Solution' }}:</b></p>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 1:</b></p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        {{ $lang[15] ?? 'Visualize area' }}
                                        <b>\( ( X \geq {{ $detail['above2'] }} ) \)</b>.
                                    </p>
                                    <div class="text-center">
                                        <img src="{{ url('images/z_score/' . $detail['z_urld'] . '.png') }}" alt="Z-Score Graph" class="img_set mx-auto" width="57%" height="100%">
                                    </div>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 2:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Normalize' }}
                                        <b>\( \mu = {{ $mean }} \)</b>, <b>\( \sigma = {{ $deviation }} \)</b>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( X \geq ? ) = P( X - \mu \geq ? - {{ $mean }} ) = P( \frac{X - \mu}{\sigma} \geq \frac{? - {{ $mean }} }{ {{ $deviation }} } ) \)
                                    </p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Z-score' }}:
                                        <b>\( \frac{x - \mu}{\sigma} = Z = \frac{ {{ $detail['above2'] }} - {{ $mean }} }{ {{ $deviation }} } = {{ $final }} \)</b>
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( X \geq ? ) = P( Z \geq {{ $detail['above2'] }} ) \)
                                    </p>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 3:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[20] ?? 'From' }} <b>{{ $lang[21] ?? 'Z-table' }}</b>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( Z \geq {{ $detail['above2'] }} ) = {{ $d }} \)
                                    </p>
                                @endif

                                @if (isset($detail['e1']) && isset($detail['e2']))
                                    @php
                                        $ans_e1 = $e1 - $mean;
                                        $final_e1 = $deviation != 0 ? round($ans_e1 / $deviation, 4) : 0;
                                        $ans_e2 = $e2 - $mean;
                                        $final_e2 = $deviation != 0 ? round($ans_e2 / $deviation, 4) : 0;
                                        $main_ans = round($detail['ltpv_e2'] - $detail['ltpv_e1'], 5);
                                    @endphp
                                    <div class="text-center">
                                        <p class="text-[18px]">
                                            <strong class="text-blue">{{ $lang['12'] ?? 'Result' }}</strong>
                                        </p>
                                        <div class="flex justify-center">
                                            <p class="text-[21px] bg-[#2845F5] text-white px-3 overflow-auto py-2 rounded-lg d-inline-block my-3">
                                                <strong>\( P( {{ $e1 }} \leq X \leq {{ $e2 }} ) = {{ $main_ans }} \)</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="col-12 mt-3 text-[18px]"> <b>{{ $lang[13] ?? 'Solution' }}:</b></p>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 1:</b></p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        {{ $lang[15] ?? 'Visualize area' }}
                                        <b>\( P( {{ $e1 }} \leq X \leq {{ $e2 }} ) \)</b>.
                                    </p>
                                    <div class="text-center">
                                        <img src="{{ url('images/z_score/' . $detail['z_urle'] . '.png') }}" alt="Z-Score Graph" class="img_set mx-auto" width="57%" height="100%">
                                    </div>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 2:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Normalize' }}
                                        <b>\( \mu = {{ $mean }} \)</b>, <b>\( \sigma = {{ $deviation }} \)</b>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( {{ $e1 }} \leq X \leq {{ $e2 }} ) = P( {{ $e1 }} - {{ $mean }} \leq X - \mu \leq {{ $e2 }} - {{ $mean }} ) = P( \frac{ {{ $e1 }} - {{ $mean }} }{ {{ $deviation }} } \leq \frac{X - \mu}{\sigma} \leq \frac{ {{ $e2 }} - {{ $mean }} }{ {{ $deviation }} } ) \)
                                    </p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Z-scores' }}:
                                        <b>\( Z_1 = {{ $final_e1 }} \)</b> and
                                        <b>\( Z_2 = {{ $final_e2 }} \)</b>
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( {{ $e1 }} \leq X \leq {{ $e2 }} ) = P( {{ $final_e1 }} \leq Z \leq {{ $final_e2 }} ) \)
                                    </p>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 3:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[20] ?? 'From' }} <b>{{ $lang[21] ?? 'Z-table' }}</b>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( {{ $final_e1 }} \leq Z \leq {{ $final_e2 }} ) = {{ $main_ans }} \)
                                    </p>
                                @endif

                                @if (isset($detail['f']))
                                    @php
                                        $ans_f1 = $detail['llf'] - $mean;
                                        $final_f1 = $deviation != 0 ? round($ans_f1 / $deviation, 4) : 0;
                                        $ans_f2 = $detail['ulf'] - $mean;
                                        $final_f2 = $deviation != 0 ? round($ans_f2 / $deviation, 4) : 0;
                                    @endphp
                                    <div class="text-center">
                                        <p class="text-[18px]">
                                            <strong class="text-blue">{{ $lang['12'] ?? 'Result' }}</strong>
                                        </p>
                                        <div class="flex justify-center">
                                            <p class="text-[21px] bg-[#2845F5] text-white px-3 overflow-auto py-2 rounded-lg d-inline-block my-3">
                                                <strong>\( P( {{ $detail['llf'] }} \leq X \leq {{ $detail['ulf'] }} ) = {{ $f }} \)</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="col-12 mt-3 text-[18px]"> <b>{{ $lang[13] ?? 'Solution' }}:</b></p>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 1:</b></p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        {{ $lang[15] ?? 'Visualize area' }}
                                        <b>\( P( {{ $detail['llf'] }} \leq X \leq {{ $detail['ulf'] }} ) \)</b>.
                                    </p>
                                    <div class="text-center">
                                        <img src="{{ url('images/z_score/' . $detail['z_urlf'] . '.png') }}" alt="Z-Score Graph" class="img_set mx-auto" width="57%" height="100%">
                                    </div>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 2:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Normalize' }}
                                        <b>\( \mu = {{ $mean }} \)</b>, <b>\( \sigma = {{ $deviation }} \)</b>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( {{ $detail['llf'] }} \leq X \leq {{ $detail['ulf'] }} ) = P( \frac{ {{ $detail['llf'] }} - {{ $mean }} }{ {{ $deviation }} } \leq Z \leq \frac{ {{ $detail['ulf'] }} - {{ $mean }} }{ {{ $deviation }} } ) \)
                                    </p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[17] ?? 'Z-scores' }}:
                                        <b>\( Z_1 = {{ $final_f1 }} \)</b> and
                                        <b>\( Z_2 = {{ $final_f2 }} \)</b>
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( {{ $detail['llf'] }} \leq Z \leq {{ $detail['ulf'] }} ) = {{ $f }} \)
                                    </p>
                                    <p class="col-12 mt-2 text-[18px]"> <b>{{ $lang[14] ?? 'Step' }} 3:</b></p>
                                    <p class="col-12 mt-2 overflow-auto">
                                        {{ $lang[20] ?? 'From' }} <b>{{ $lang[21] ?? 'Z-table' }}</b>:
                                    </p>
                                    <p class="col-12 mt-2 text-center overflow-auto">
                                        \( P( {{ $final_f1 }} \leq Z \leq {{ $final_f2 }} ) = {{ $f }} \)
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

    </form>
</div>

@push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="{{ url('katex/katex.min.js') }}"></script>
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="window.MJrerender && window.MJrerender()"></script>
    
    <script>
        window.MJrerender = function() {
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body, {
                    delimiters: [
                        {left: '$$', right: '$$', display: true},
                        {left: '\\(', right: '\\)', display: false},
                        {left: '\\[', right: '\\]', display: true}
                    ],
                    throwOnError : false
                });
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            window.MJrerender();
        });

        document.addEventListener('livewire:initialized', () => {
            window.MJrerender();

            // Re-render after every Livewire update (input change, reset, etc.)
            Livewire.hook('morph.updated', (el, component) => {
                window.MJrerender();
            });

            Livewire.on('math-updated', () => {
                setTimeout(() => { window.MJrerender(); }, 100);
            });
        });
    </script>
@endpush
