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
                                            <textarea wire:model.lazy="groups.{{ $index }}" id="group{{ $index }}" class="textareaInput" placeholder="e.g. 5, 1, 11, 2, 8"></textarea>
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
                                                    <input type="text" wire:model.lazy="table_data.{{ $i }}.{{ $j }}" 
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
            <hr class="my-8">
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif

                <div class="w-full mt-2">
                    @php
                        $submit = $detail['type'] ?? $calculator_type;
                        $table = $detail['table'] ?? '';
                        $table1 = $detail['table1'] ?? '';
                    @endphp

                    @if ($submit == 'one_way')
                        @php
                            $k = $detail['k'] ?? 0;
                            $N = $detail['N'] ?? 0;
                            $table2 = $detail['table2'] ?? '';
                            $s1 = $detail['s1'] ?? '';
                            $s2 = $detail['s2'] ?? '';
                            $ssb = $detail['ssb'] ?? 0;
                            $ssw = $detail['ssw'] ?? 0;
                            $dfb = max(0, $k - 1);
                            $dfw = max(0, $N - $k);
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
                                    <td class="py-2 border-b"><strong class="p_value"></strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="grid grid-cols-1 mt-3 overflow-auto">{!! $table !!}</div>
                        <div class="grid grid-cols-1 mt-3 overflow-auto">{!! $table1 !!}</div>
                        <div class="grid grid-cols-1 mt-3 overflow-auto">{!! $table2 !!}</div>
                        <div class="grid grid-cols-1 mt-3 overflow-auto">
                            <table class="w-full border-collapse">
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
                                    <td class="p_value p-2 border text-center"></td>
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
                        
                        <div class="mt-6 space-y-4 overflow-x-auto">
                            <p><strong>Step 1: Sum of Squares Between (SSB)</strong></p>
                            <p>$$ SS_B = \sum^k_{i=1} n_i(\bar x_i - \bar x)^2 $$</p>
                            <p>$$ SS_B = {{ $s1 }} $$</p>
                            <p>$$ SS_B = {{ $ssb }} $$</p>

                            <p><strong>Step 2: Sum of Squares Within (SSW)</strong></p>
                            <p>$$ SS_W = \sum^k_{i=1} (n_i - 1)S_i^2 $$</p>
                            <p>$$ SS_W = {{ $s2 }} $$</p>
                            <p>$$ SS_W = {{ $ssw }} $$</p>

                            <p><strong>Step 3: Total Sum of Squares (SST)</strong></p>
                            <p>$$ SS_T = SS_B + SS_W = {{ $ssb }} + {{ $ssw }} = {{ $ssb + $ssw }} $$</p>

                            <p><strong>Step 4: Mean Squares Between (MSB)</strong></p>
                            <p>$$ MS_B = \dfrac{SS_B}{k - 1} = \dfrac{ {{ $ssb }} }{ {{ $k }} - 1 } = {{ $msb }} $$</p>

                            <p><strong>Step 5: Mean Squares Within (MSW)</strong></p>
                            <p>$$ MS_W = \dfrac{SS_W}{N - k} = \dfrac{ {{ $ssw }} }{ {{ $N }} - {{ $k }} } = {{ $msw }} $$</p>

                            <p><strong>Step 6: Calculated F Value</strong></p>
                            <p>$$ F = \dfrac{MS_B}{MS_W} = \dfrac{ {{ $msb }} }{ {{ $msw }} } = {{ $f }} $$</p>
                        </div>

                    @else
                        @php
                            $rows = $detail['rows'] ?? 0;
                            $columns = $detail['columns'] ?? 0;
                            $p1 = $detail['p1'] ?? '';
                            $A = $detail['A'] ?? 0;
                            $p2_s1 = $detail['p2_s1'] ?? '';
                            $p2_s2 = $detail['p2_s2'] ?? '';
                            $p2_s3 = $detail['p2_s3'] ?? '';
                            $B = $detail['B'] ?? 0;
                            $p3_s1 = $detail['p3_s1'] ?? '';
                            $p3_s2 = $detail['p3_s2'] ?? '';
                            $p3_s3 = $detail['p3_s3'] ?? '';
                            $C = $detail['C'] ?? 0;
                            $p4_s1 = $detail['p4_s1'] ?? '';
                            $p4_s2 = $detail['p4_s2'] ?? '';
                            $p4_s3 = $detail['p4_s3'] ?? '';
                            $D = $detail['D'] ?? 0;
                            $p5_s1 = $detail['p5_s1'] ?? '';
                            $p5_s2 = $detail['p5_s2'] ?? '';
                            $E = $detail['E'] ?? 0;
                            $n = $detail['n'] ?? 0;
                            
                            $dfa = max(0, $rows - 1);
                            $dfb = max(0, $columns - 1);
                            $dfab = max(0, ($rows - 1) * ($columns - 1));
                            $dfe = max(0, $n - ($rows * $columns));
                            $df_total = max(0, $n - 1);
                            
                            $sst = round($A - $E, 4);
                            $ssa = round($C - $E, 4);
                            $ssb = round($B - $E, 4);
                            $ssab = round($D - $E - $ssa - $ssb, 4);
                            $sse = round($sst - $ssa - $ssb - $ssab, 4);
                            
                            $msa = $dfa > 0 ? round($ssa / $dfa, 4) : 0;
                            $msb = $dfb > 0 ? round($ssb / $dfb, 4) : 0;
                            $msab = $dfab > 0 ? round($ssab / $dfab, 4) : 0;
                            $mse = $dfe > 0 ? round($sse / $dfe, 4) : 0;
                            
                            $fa = $mse > 0 ? round($msa / $mse, 4) : 0;
                            $fb = $mse > 0 ? round($msb / $mse, 4) : 0;
                            $fab = $mse > 0 ? round($msab / $mse, 4) : 0;
                        @endphp
                        <div class="w-full mt-2 px-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="text-blue py-2 border-b">Calculated F Values</td>
                                    <td class="py-2 border-b"><strong>\( {{ $fa }}, {{ $fb }}, {{ $fab }} \)</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">P-Values</td>
                                    <td class="py-2 border-b"><strong><span class="p_value1"></span>, <span class="p_value2"></span>, <span class="p_value3"></span></strong></td>
                                </tr>
                            </table>
                        </div>
                        <p class="mt-6"><strong>Data Observations:</strong></p>
                        <div class="w-full mt-3 overflow-auto">{!! $table !!}</div>
                        <div class="w-full mt-3 overflow-auto">{!! $table1 !!}</div>
                        
                        <div class="w-full mt-6 overflow-auto">
                            <table class="w-full border-collapse">
                                <tr class="bg-sky">
                                    <th class="p-2 border text-center text-blue" colspan="6">ANOVA Table</th>
                                </tr>
                                <tr class="bg-gray">
                                    <td class="p-2 border text-center text-blue">Source</td>
                                    <td class="p-2 border text-center text-blue">DF</td>
                                    <td class="p-2 border text-center text-blue">SS</td>
                                    <td class="p-2 border text-center text-blue">MS</td>
                                    <td class="p-2 border text-center text-blue">F-Ratio</td>
                                    <td class="p-2 border text-center text-blue">P-Value</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border text-center text-blue">Factor A</td>
                                    <td class="p-2 border text-center">$$ {{ $dfa }} $$</td>
                                    <td class="p-2 border text-center">$$ {{ $ssa }} $$</td>
                                    <td class="p-2 border text-center">$$ {{ $msa }} $$</td>
                                    <td class="p-2 border text-center">$$ {{ $fa }} $$</td>
                                    <td class="p_value1 p-2 border text-center"></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border text-center text-blue">Factor B</td>
                                    <td class="p-2 border text-center">$$ {{ $dfb }} $$</td>
                                    <td class="p-2 border text-center">$$ {{ $ssb }} $$</td>
                                    <td class="p-2 border text-center">$$ {{ $msb }} $$</td>
                                    <td class="p-2 border text-center">$$ {{ $fb }} $$</td>
                                    <td class="p_value2 p-2 border text-center"></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border text-center text-blue">Interaction (AB)</td>
                                    <td class="p-2 border text-center">$$ {{ $dfab }} $$</td>
                                    <td class="p-2 border text-center">$$ {{ $ssab }} $$</td>
                                    <td class="p-2 border text-center">$$ {{ $msab }} $$</td>
                                    <td class="p-2 border text-center">$$ {{ $fab }} $$</td>
                                    <td class="p_value3 p-2 border text-center"></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border text-center text-blue">Error</td>
                                    <td class="p-2 border text-center">$$ {{ $dfe }} $$</td>
                                    <td class="p-2 border text-center">$$ {{ $sse }} $$</td>
                                    <td class="p-2 border text-center">$$ {{ $mse }} $$</td>
                                    <td colspan="2" class="p-2 border text-center"></td>
                                </tr>
                                <tr class="font-bold">
                                    <td class="p-2 border text-center text-blue">Total</td>
                                    <td class="p-2 border text-center">$$ {{ $df_total }} $$</td>
                                    <td class="p-2 border text-center">$$ {{ $sst }} $$</td>
                                    <td colspan="3" class="p-2 border text-center"></td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <script src="https://cdn.jsdelivr.net/npm/jstat@latest/dist/jstat.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
        
        <script>
            window.calculateANOVA = function(result) {
                if (!result) return;
                if (typeof jStat === 'undefined') {
                    setTimeout(function() { window.calculateANOVA(result) }, 200);
                    return;
                }

                if (result.type === 'one_way') {
                    const dfb = Math.max(0, result.k - 1);
                    const dfw = Math.max(0, result.N - result.k);
                    // F calculation in PHP was round($msb/$msw, 4)
                    const msb = dfb > 0 ? result.ssb / dfb : 0;
                    const msw = dfw > 0 ? result.ssw / dfw : 0;
                    const f = msw > 0 ? msb / msw : 0;
                    
                    const p_val = 1 - jStat.centralF.cdf(f, dfb, dfw);
                    document.querySelectorAll('.p_value').forEach(function(el) {
                        el.innerHTML = p_val.toFixed(4);
                    });
                } else if (result.type === 'two_way') {
                    // Extract intermediate values for re-calculating P-values in JS
                    const n = result.n;
                    const rows = result.rows;
                    const columns = result.columns;
                    const sst = result.A - result.E;
                    const ssa = result.C - result.E;
                    const ssb = result.B - result.E;
                    const ssab = result.D - result.E - ssa - ssb;
                    const sse = sst - ssa - ssb - ssab;
                    
                    const dfa = rows - 1;
                    const dfb = columns - 1;
                    const dfab = (rows - 1) * (columns - 1);
                    const dfe = n - (rows * columns);
                    
                    const msa = dfa > 0 ? ssa / dfa : 0;
                    const msb = dfb > 0 ? ssb / dfb : 0;
                    const msab = dfab > 0 ? ssab / dfab : 0;
                    const mse = dfe > 0 ? sse / dfe : 0;
                    
                    const fa = mse > 0 ? msa / mse : 0;
                    const fb = mse > 0 ? msb / mse : 0;
                    const fab = mse > 0 ? msab / mse : 0;

                    const p_val1 = 1 - jStat.centralF.cdf(fa, dfa, dfe);
                    const p_val2 = 1 - jStat.centralF.cdf(fb, dfb, dfe);
                    const p_val3 = 1 - jStat.centralF.cdf(fab, dfab, dfe);

                    document.querySelectorAll('.p_value1').forEach(el => el.innerHTML = `\\( ${p_val1.toFixed(4)} \\)`);
                    document.querySelectorAll('.p_value2').forEach(el => el.innerHTML = `\\( ${p_val2.toFixed(4)} \\)`);
                    document.querySelectorAll('.p_value3').forEach(el => el.innerHTML = `\\( ${p_val3.toFixed(4)} \\)`);
                }
                
                // Re-render math
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            };
        </script>
    @endpush
</div>
