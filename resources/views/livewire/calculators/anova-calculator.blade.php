<div>
    <style>
        .bg-gray {
            background-color: #F6FAFC !important;
            color: #2845F5 !important;
        }
        .tagsUnit {
            background-color: #2845F5 !important;
            color: white !important;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="w-full mx-auto">
                <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="setCalculatorType('one_way')" 
                                 class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $calculator_type === 'one_way' ? 'tagsUnit' : 'bg-white' }} hover:bg-blue-600 hover:text-white">
                                {{ $lang['1'] ?? 'One-Way ANOVA' }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="setCalculatorType('two_way')" 
                                 class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $calculator_type === 'two_way' ? 'tagsUnit' : 'bg-white' }} hover:bg-blue-600 hover:text-white">
                                {{ $lang['2'] ?? 'Two-Way ANOVA' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 mt-3 gap-2">
                    @if($calculator_type === 'one_way')
                        <div class="col-span-12">
                            <div class="row">
                                @foreach($groups as $index => $group)
                                    <div class="col-lg-7 mx-auto px-2 mb-4">
                                        <label for="group{{ $index }}" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Group' }} {{ $index }}:</label>
                                        <div class="w-full py-2">
                                            <textarea wire:model.live="groups.{{ $index }}" id="group{{ $index }}" class="textareaInput" placeholder="e.g. 5, 1, 11, 2, 8"></textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-lg-7 mx-auto flex px-2 space-x-2">
                                <button type="button" wire:click="addGroup" class="bg-white border rounded-md px-4 py-2 hover:bg-gray-100">
                                    <strong class="text-blue">{{ $lang['5'] ?? 'Add' }} {{ $lang['7'] ?? 'Group' }}</strong>
                                </button>
                                <button type="button" wire:click="removeGroup" class="bg-white border rounded-md px-4 py-2 hover:bg-gray-100">
                                    <strong class="text-blue">{{ $lang['6'] ?? 'Delete' }} {{ $lang['7'] ?? 'Group' }}</strong>
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="col-span-12">
                            <div class="overflow-auto">
                                <table class="w-full text-center border-separate border-spacing-2">
                                    @for($i = 0; $i < $rows; $i++)
                                        <tr>
                                            @for($j = 0; $j < $columns; $j++)
                                                <td>
                                                    <input type="text" wire:model.live="table_data.{{ $i }}.{{ $j }}" 
                                                           class="input border rounded p-2 w-[100px]" 
                                                           placeholder="e.g. 4,6,8">
                                                </td>
                                            @endfor
                                        </tr>
                                    @endfor
                                </table>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 mt-3 gap-2 px-2">
                                <button type="button" wire:click="addRow" class="bg-white border rounded-md px-4 py-2 hover:bg-gray-100">
                                    <strong class="text-blue">{{ $lang['5'] ?? 'Add' }} {{ $lang['8'] ?? 'Row' }}</strong>
                                </button>
                                <button type="button" wire:click="removeRow" class="bg-white border rounded-md px-4 py-2 hover:bg-gray-100">
                                    <strong class="text-blue">{{ $lang['6'] ?? 'Delete' }} {{ $lang['8'] ?? 'Row' }}</strong>
                                </button>
                                <button type="button" wire:click="addColumn" class="bg-white border rounded-md px-4 py-2 hover:bg-gray-100">
                                    <strong class="text-blue">{{ $lang['5'] ?? 'Add' }} {{ $lang['9'] ?? 'Column' }}</strong>
                                </button>
                                <button type="button" wire:click="removeColumn" class="bg-white border rounded-md px-4 py-2 hover:bg-gray-100">
                                    <strong class="text-blue">{{ $lang['6'] ?? 'Delete' }} {{ $lang['9'] ?? 'Column' }}</strong>
                                </button>
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
                        <div class="w-full mt-2">
                            <div class="w-full">
                                @php
                                    $submit = $detail['type'] ?? $calculator_type;
                                    $table = $detail['table'];
                                    $table1 = $detail['table1'];
                                @endphp
                                @if ($submit == 'one_way')
                                    @php
                                        $k = $detail['k'];
                                        $N = $detail['N'];
                                        $table2 = $detail['table2'];
                                        $s1 = $detail['s1'];
                                        $s2 = $detail['s2'];
                                        $ssb = $detail['ssb'];
                                        $ssw = $detail['ssw'];
                                        $dfb = $k - 1;
                                        $dfw = $N - $k;
                                        $msb = $dfb > 0 ? round(($ssb / $dfb), 4) : 0;
                                        $msw = $dfw > 0 ? round(($ssw / $dfw), 4) : 0;
                                        $f = $msw > 0 ? round(($msb / $msw), 4) : 0;
                                    @endphp
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2 px-2">
                                        <table class="w-full font-s-18">
                                            <tr>
                                                <td class="text-blue py-2 border-b">{{ $lang['26'] ?? 'Calculated' }} {{ $lang['10'] ?? 'Value' }} F</td>
                                                <td class="py-2 border-b"><strong>{{ $f }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-blue py-2 border-b">P-{{ $lang['11'] ?? 'Value' }}</td>
                                                <td class="py-2 border-b"><strong>{{ $detail['p_value'] ?? '' }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="grid grid-cols-1 mt-3 overflow-auto">{!! $table !!}</div>
                                    <div class="grid grid-cols-1 mt-3 overflow-auto">{!! $table1 !!}</div>
                                    <div class="grid grid-cols-1 mt-3 overflow-auto">{!! $table2 !!}</div>
                                    <div class="grid grid-cols-1 mt-3 overflow-auto">
                                        <table class="w-full" style="border-collapse: collapse">
                                            <tr class="bg-sky">
                                                <td colspan="6" class="p-2 border text-center text-blue">{{ $lang['25'] ?? 'ANOVA' }} {{ $lang['13'] ?? 'Table' }}</td>
                                            </tr>
                                            <tr class="bg-sky">
                                                <td class="p-2 border text-center text-blue">{{ $lang['14'] ?? 'Source' }}</td>
                                                <td class="p-2 border text-center text-blue">{{ $lang['15'] ?? 'DF' }}</td>
                                                <td class="p-2 border text-center text-blue">{{ $lang['16'] ?? 'SS' }}</td>
                                                <td class="p-2 border text-center text-blue">{{ $lang['17'] ?? 'MS' }}</td>
                                                <td class="p-2 border text-center text-blue">F-{{ $lang['18'] ?? 'Ratio' }}</td>
                                                <td class="p-2 border text-center text-blue">P-{{ $lang['11'] ?? 'Value' }}</td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="p-2 border text-center text-blue">{{ $lang['19'] ?? 'Between' }}</td>
                                                <td class="p-2 border text-center">{{ $dfb }}</td>
                                                <td class="p-2 border text-center">{{ $ssb }}</td>
                                                <td class="p-2 border text-center">{{ $msb }}</td>
                                                <td class="p-2 border text-center">{{ $f }}</td>
                                                <td class="p-2 border text-center"><strong>{{ $detail['p_value'] ?? '' }}</strong></td>
                                            </tr>
                                            <tr class="bg-white"> 
                                                <td class="p-2 border text-center text-blue">{{ $lang['20'] ?? 'Within' }}</td>
                                                <td class="p-2 border text-center">{{ $dfw }}</td>
                                                <td class="p-2 border text-center">{{ $ssw }}</td>
                                                <td class="p-2 border text-center">{{ $msw }}</td>
                                                <td colspan="2" class="p-2 border text-center"></td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="p-2 border text-center text-blue">{{ $lang['21'] ?? 'Total' }}</td>
                                                <td class="p-2 border text-center">{{ $dfb + $dfw }}</td>
                                                <td class="p-2 border text-center">{{ $ssb + $ssw }}</td>
                                                <td colspan="3" class="p-2 border text-center"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <p class="w-full mt-3"><strong class="text-blue">{{ $lang['22'] ?? 'Step' }}:1 - {{ $lang['16'] ?? 'SS' }} {{ $lang['19'] ?? 'Between' }}</strong></p>
                                        <p class="w-full mt-3">$$ SS_B = \sum^k_{i=1} n_i(\bar x_i - \bar x)^2 $$</p>
                                        <p class="w-full mt-3">$$ SS_B = {{ $s1 }} $$</p>
                                        <p class="w-full mt-3">$$ SS_B = {{ $ssb }} $$</p>
                                        <p class="w-full mt-3"><strong class="text-blue">{{ $lang['22'] ?? 'Step' }}:2 - {{ $lang['16'] ?? 'SS' }} {{ $lang['20'] ?? 'Within' }}</strong></p>
                                        <p class="w-full mt-3">$$ SS_W = \sum^k_{i=1} (n_i - 1)S_i^2 $$</p>
                                        <p class="w-full mt-3">$$ SS_W = {{ $s2 }} $$</p>
                                        <p class="w-full mt-3">$$ SS_W = {{ $ssw }} $$</p>
                                        <p class="w-full mt-3"><strong class="text-blue">{{ $lang['22'] ?? 'Step' }}:3 - Total {{ $lang['16'] ?? 'SS' }}</strong></p>
                                        <p class="w-full mt-3">$$ SS_T = SS_B + SS_W $$</p>
                                        <p class="w-full mt-3">$$ SS_T = {{ $ssb }} + {{ $ssw }} $$</p>
                                        <p class="w-full mt-3">$$ SS_T = {{ $ssb + $ssw }} $$</p>
                                        <p class="w-full mt-3"><strong class="text-blue">{{ $lang['22'] ?? 'Step' }}:4 - {{ $lang['17'] ?? 'MS' }} {{ $lang['19'] ?? 'Between' }}</strong></p>
                        
                                        <p class="w-full mt-3">$$ MS_B = \dfrac{SS_B}{k - 1} $$</p>
                                        <p class="w-full mt-3">$$ MS_B = \dfrac{ {{ $ssb }} }{ {{ $k }} - 1 } $$</p>
                                        <p class="w-full mt-3">$$ MS_B = \dfrac{ {{ $ssb }} }{ {{ $dfb }} } $$</p>
                                        <p class="w-full mt-3">$$ MS_B = {{ $msb }} $$</p>
                                        <p class="w-full mt-3"><strong class="text-blue">{{ $lang['22'] ?? 'Step' }}:5 - {{ $lang['17'] ?? 'MS' }} {{ $lang['20'] ?? 'Within' }}</strong></p>
                                        <p class="w-full mt-3">$$ MS_W = \dfrac{SS_W}{N - k} $$</p>
                                        <p class="w-full mt-3">$$ MS_W = \dfrac{ {{ $ssw }} }{ {{ $N }} - {{ $k }} } $$</p>
                                        <p class="w-full mt-3">$$ MS_W = \dfrac{ {{ $ssw }} }{ {{ $dfw }} } $$</p>
                                        <p class="w-full mt-3">$$ MS_W = {{ $msw }} $$</p>
                                        <p class="w-full mt-3"><strong class="text-blue">{{ $lang['22'] ?? 'Step' }}:6 - {{ $lang['26'] ?? 'Calculated' }} {{ $lang['23'] ?? 'F' }} Value</strong></p>
                                        <p class="w-full mt-3">$$ F = \dfrac{MS_B}{MS_W} $$</p>
                                        <p class="w-full mt-3">$$ F = \dfrac{ {{ $msb }} }{ {{ $msw }} } $$</p>
                                        <p class="w-full mt-3">$$ F = {{ $f }} $$</p>
                                        <p class="w-full mt-3"><strong class="text-blue">If F {{ $lang['26'] ?? 'Calculated' }} > Critical Value, Reject the Null Hypothesis</strong></p>
                                        <p class="w-full mt-3"><strong class="text-blue">If F {{ $lang['26'] ?? 'Calculated' }} < Critical Value, Fail to Reject the Null Hypothesis</strong></p>
                                    </div>
                                @elseif ($submit == 'two_way')
                                    @php
                                        $rows = $detail['rows'];
                                        $columns = $detail['columns'];
                                        $p1 = $detail['p1'];
                                        $A = $detail['A'];
                                        $p2_s1 = $detail['p2_s1'];
                                        $p2_s2 = $detail['p2_s2'];
                                        $p2_s3 = $detail['p2_s3'];
                                        $B = $detail['B'];
                                        $p3_s1 = $detail['p3_s1'];
                                        $p3_s2 = $detail['p3_s2'];
                                        $p3_s3 = $detail['p3_s3'];
                                        $C = $detail['C'];
                                        $p4_s1 = $detail['p4_s1'];
                                        $p4_s2 = $detail['p4_s2'];
                                        $p4_s3 = $detail['p4_s3'];
                                        $D = $detail['D'];
                                        $p5_s1 = $detail['p5_s1'];
                                        $p5_s2 = $detail['p5_s2'];
                                        $E = $detail['E'];
                                        $n = $detail['n'];
                                        $dfa = $rows - 1;
                                        $dfb = $columns - 1;
                                        $dfab = ($rows - 1) * ($columns - 1);
                                        $dfe = $n - ($rows * $columns);
                                        $df_total = $n - 1;
                                        $sst = $A - $E;
                                        $ssa = $C - $E;
                                        $ssb = $B - $E;
                                        $ssab = $D - $E - $ssa - $ssb;
                                        $sse = $sst - $ssa - $ssb - $ssab;
                                        $msa = $dfa > 0 ? $ssa / $dfa : 0;
                                        $msb = $dfb > 0 ? $ssb / $dfb : 0;
                                        $msab = $dfab > 0 ? $ssab / $dfab : 0;
                                        $mse = $dfe > 0 ? $sse / $dfe : 0;
                                        $fa = $mse > 0 ? $msa / $mse : 0;
                                        $fb = $mse > 0 ? $msb / $mse : 0;
                                        $fab = $mse > 0 ? $msab / $mse : 0;
                                        $ssa = round($ssa, 4);
                                        $ssb = round($ssb, 4);
                                        $ssab = round($ssab, 4);
                                        $sse = round($sse, 4);
                                        $msa = round($msa, 4);
                                        $msb = round($msb, 4);
                                        $msab = round($msab, 4);
                                        $mse = round($mse, 4);
                                        $fa = round($fa, 4);
                                        $fb = round($fb, 4);
                                        $fab = round($fab, 4);
                                        $A = round($A, 4);
                                        $B = round($B, 4);
                                        $C = round($C, 4);
                                        $D = round($D, 4);
                                    @endphp
                                    <div class="w-full mt-2 px-2">
                                        <table class="w-full font-s-18">
                                            <tr>
                                                <td class="text-blue py-2 border-b">{{ $lang['26'] ?? 'Calculated' }} {{ $lang['10'] ?? 'Value' }} F</td>
                                                <td class="py-2 border-b"><strong>\( {{ $fa }}, {{ $fb }}, {{ $fab }} \)</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="text-blue py-2 border-b">P-{{ $lang['11'] ?? 'Value' }}</td>
                                                <td class="py-2 border-b"><strong>\( {{ $detail['p_value1'] ?? '' }}, {{ $detail['p_value2'] ?? '' }}, {{ $detail['p_value3'] ?? '' }} \)</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="w-full mt-3"><strong class="text-blue">{{ $lang['12'] ?? 'Observations' }}:</strong></p>
                                    <div class="w-full mt-3 overflow-auto">{!! $table !!}</div>
                                    <div class="w-full mt-3 overflow-auto">{!! $table1 !!}</div>
                                    <p class="w-full mt-3 overflow-auto">$$ \text {Note: } a \Rightarrow \text {Factor A}, b \Rightarrow \text {Factor B}, {n \Rightarrow \text {Total Sample}} $$</p>
                                    <div class="w-full mt-3 overflow-auto">
                                        <table class="w-full" style="border-collapse: collapse">
                                            <tr class="bg-sky">
                                                <th class="p-2 border text-center text-blue" colspan="6">{{ $lang['25'] ?? 'ANOVA' }} {{ $lang['13'] ?? 'Table' }}</th>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="p-2 border text-center text-blue">{{ $lang['14'] ?? 'Source' }}</td>
                                                <td class="p-2 border text-center text-blue">{{ $lang['15'] ?? 'DF' }}</td>
                                                <td class="p-2 border text-center text-blue">{{ $lang['16'] ?? 'SS' }}</td>
                                                <td class="p-2 border text-center text-blue">{{ $lang['17'] ?? 'MS' }}</td>
                                                <td class="p-2 border text-center text-blue">F-{{ $lang['18'] ?? 'Ratio' }}</td>
                                                <td class="p-2 border text-center text-blue">P-{{ $lang['11'] ?? 'Value' }}</td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="p-2 border text-center text-blue">A</td>
                                                <td class="p-2 border text-center">$$ a - 1 = {{ $dfa }} $$</td>
                                                <td class="p-2 border text-center">$$ {{ $ssa }} $$</td>
                                                <td class="p-2 border text-center">$$ {{ $msa }} $$</td>
                                                <td class="p-2 border text-center">$$ {{ $fa }} $$</td>
                                                <td class="p-2 border text-center"><strong>\( {{ $detail['p_value1'] ?? '' }} \)</strong></td>
                                            </tr>
                                            <tr class="bg-white"> 
                                                <td class="p-2 border text-center text-blue">B</td>
                                                <td class="p-2 border text-center">$$ b - 1 = {{ $dfb }} $$</td>
                                                <td class="p-2 border text-center">$$ {{ $ssb }} $$</td>
                                                <td class="p-2 border text-center">$$ {{ $msb }} $$</td>
                                                <td class="p-2 border text-center">$$ {{ $fb }} $$</td>
                                                <td class="p-2 border text-center"><strong>\( {{ $detail['p_value2'] ?? '' }} \)</strong></td>
                                            </tr>
                                            <tr class="bg-white"> 
                                                <td class="p-2 border text-center text-blue">AB</td>
                                                <td class="p-2 border text-center">$$ (a - 1)(b - 1) = {{ $dfab }} $$</td>
                                                <td class="p-2 border text-center">$$ {{ $ssab }} $$</td>
                                                <td class="p-2 border text-center">$$ {{ $msab }} $$</td>
                                                <td class="p-2 border text-center">$$ {{ $fab }} $$</td>
                                                <td class="p-2 border text-center"><strong>\( {{ $detail['p_value3'] ?? '' }} \)</strong></td>
                                            </tr>
                                            <tr class="bg-white"> 
                                                <td class="p-2 border text-center text-blue">Error (Within)</td>
                                                <td class="p-2 border text-center">$$ n - ab = {{ $dfe }} $$</td>
                                                <td class="p-2 border text-center">$$ {{ $sse }} $$</td>
                                                <td class="p-2 border text-center">$$ {{ $mse }} $$</td>
                                                <td colspan="2" class="p-2 border text-center"></td>
                                            </tr>
                                            <tr class="bg-white">
                                                <td class="p-2 border text-center text-blue">{{ $lang['21'] ?? 'Total' }}</td>
                                                <td class="p-2 border text-center">$$ n - 1 = {{ $df_total }} $$</td>
                                                <td class="p-2 border text-center">$$ {{ round($sst, 4) }} $$</td>
                                                <td colspan="3" class="p-2 border text-center"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">Calculation A</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum x^2 = {{ $p1 }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum x^2 = {{ $A }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">Calculation B</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_b^2}{n_b} = {{ $p2_s1 }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_b^2}{n_b} = {{ $p2_s2 }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_b^2}{n_b} = {{ $p2_s3 }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_b^2}{n_b} = {{ $B }} $$</p>
                                        
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">Calculation C</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_a^2}{n_a} = {{ $p3_s1 }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_a^2}{n_a} = {{ $p3_s2 }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_a^2}{n_a} = {{ $p3_s3 }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_a^2}{n_a} = {{ $C }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">Calculation D</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {\sum x_{ab}^2}{n_{ab}} = {{ $p4_s1 }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {\sum x_{ab}^2}{n_{ab}} = {{ $p4_s2 }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {\sum x_{ab}^2}{n_{ab}} = {{ $p4_s3 }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {\sum x_{ab}^2}{n_{ab}} = {{ $D }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">Calculation E</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ \dfrac {\sum x^2}{n} = {{ $p5_s1 }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ \dfrac {\sum x^2}{n} = {{ $p5_s2 }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ \dfrac {\sum x^2}{n} = {{ $E }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">{{ $lang['22'] ?? 'Step' }}:1 - Total {{ $lang['16'] ?? 'SS' }}</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_T = \sum x^2 - \dfrac {(\sum x)^2}{n} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_T = (A) - (E) $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_T = {{ $A }} - {{ $E }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_T = {{ round($sst, 4) }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">{{ $lang['22'] ?? 'Step' }}:2 - {{ $lang['16'] ?? 'SS' }} Factor A</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_A = \sum \dfrac {x^2_a}{n_a} - \dfrac {(\sum x)^2}{n} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_A = (C) - (E) $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_A = {{ $C }} - {{ $E }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_A = {{ $ssa }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">{{ $lang['22'] ?? 'Step' }}:3 - {{ $lang['16'] ?? 'SS' }} Factor B</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_B = \sum \dfrac {x^2_b}{n_b} - \dfrac {(\sum x)^2}{n} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_B = (B) - (E) $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_B = {{ $B }} - {{ $E }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_B = {{ $ssb }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">{{ $lang['22'] ?? 'Step' }}:4 - {{ $lang['16'] ?? 'SS' }} Interaction (AB)</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_{AB} = \sum \dfrac {\sum x_{ab}^2}{n_{ab}} - \dfrac {(\sum x)^2}{n} - SS_A - SS_B $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_{AB} = (D) - (E) - SS_A - SS_B $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_{AB} = {{ $D }} - {{ $E }} - {{ $ssa }} - {{ $ssb }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_{AB} = {{ $ssab }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">{{ $lang['22'] ?? 'Step' }}:5 - {{ $lang['16'] ?? 'SS' }} Error (Within)</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_E = SS_T - SS_A - SS_B - SS_{AB} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_E = {{ round($sst, 4) }} - {{ $ssa }} - {{ $ssb }} - {{ $ssab }} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ SS_E = {{ $sse }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">Mean Squares Factor A</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ MS_A = \dfrac {SS_A}{DF_A} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ MS_A = \dfrac {{{ $ssa }}}{{{ $dfa }}} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ MS_A = {{ $msa }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">Mean Squares Factor B</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ MS_B = \dfrac {SS_B}{DF_B} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ MS_B = \dfrac {{{ $ssb }}}{{{ $dfb }}} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ MS_B = {{ $msb }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">Mean Squares Interaction (AB)</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ MS_{AB} = \dfrac {SS_{AB}}{DF_{AB}} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ MS_{AB} = \dfrac {{{ $ssab }}}{{{ $dfab }}} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ MS_{AB} = {{ $msab }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">Mean Squares Error (Within)</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ MS_E = \dfrac {SS_E}{DF_E} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ MS_E = \dfrac {{{ $sse }}}{{{ $dfe }}} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ MS_E = {{ $mse }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">Calculated F-Ratio Factor A</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ F_A = \dfrac {MS_A}{MS_E} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ F_A = \dfrac {{{ $msa }}}{{{ $mse }}} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ F_A = {{ $fa }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">Calculated F-Ratio Factor B</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ F_B = \dfrac {MS_B}{MS_E} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ F_B = \dfrac {{{ $msb }}}{{{ $mse }}} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ F_B = {{ $fb }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">Calculated F-Ratio Interaction (AB)</strong></p>
                                        <p class="w-full mt-3 overflow-auto">$$ F_{AB} = \dfrac {MS_{AB}}{MS_E} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ F_{AB} = \dfrac {{{ $msab }}}{{{ $mse }}} $$</p>
                                        <p class="w-full mt-3 overflow-auto">$$ F_{AB} = {{ $fab }} $$</p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">If F {{ $lang['26'] ?? 'Calculated' }} > Critical Value, Reject the Null Hypothesis</strong></p>
                                        <p class="w-full mt-3 overflow-auto"><strong class="text-blue">If F {{ $lang['26'] ?? 'Calculated' }} < Critical Value, Fail to Reject the Null Hypothesis</strong></p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                // Initial render
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</div>
