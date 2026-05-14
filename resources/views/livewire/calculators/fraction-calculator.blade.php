<div class="calc-container px-3">
    <style>
        .calc-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .mode-toggle {
            background: #f8fafc;
            border-radius: 12px;
            padding: 5px;
            display: inline-flex;
            border: 1px solid #e2e8f0;
        }
        .mode-btn {
            padding: 8px 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
            color: #64748b;
        }
        .mode-btn.active {
            background: #3b82f6;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);
        }
        .fraction-input-group {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .fraction-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            width: 130px;
        }
        .fraction-box.mixed {
            flex-direction: row;
            width: auto;
            gap: 12px;
            align-items: center;
        }
        .whole-num {
            width: 130px !important;
            flex-shrink: 0;
        }
        .frac-part {
            display: flex;
            flex-direction: column;
            gap: 4px;
            width: 120px;
            flex-shrink: 0;
        }
        .frac-line {
            width: 100%;
            height: 2px;
            background: #3b82f6;
            border-radius: 2px;
        }
        .op-select {
            height: 45px;
            min-width: 65px;
            text-align: center;
            font-weight: bold;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }
        .num-den-input {
            text-align: center;
            padding: 8px;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            width: 100%;
            transition: border-color 0.2s;
        }
        .num-den-input:focus {
            border-color: #3b82f6;
            outline: none;
        }
        @media (max-width: 768px) {
            .fraction-input-group {
                gap: 20px;
            }
            .fraction-box {
                width: 70px;
            }
        }
    </style>
    <form wire:submit.prevent="calculate">
        <!-- Error Message -->
        @if($error)
            <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 text-center border border-red-100">
                <strong>{{ $error }}</strong>
            </div>
        @endif

        <div class="mb-8 lg:w-[50%] md:w-[75%] w-[100%] mx-auto mt-5">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1" wire:click="$set('calculate_type', 'fraction_type')">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $calculate_type === 'fraction_type' ? 'tagsUnit' : '' }}">
                        Fractions
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1" wire:click="$set('calculate_type', 'mixed_type')">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $calculate_type === 'mixed_type' ? 'tagsUnit' : '' }}">
                        {{ $lang['44'] }}
                    </div>
                </div>
            </div>
        </div>

        @if($calculate_type === 'fraction_type')
            <!-- Fraction Type Selector (Radio buttons) -->
            <div class="flex justify-center flex-wrap gap-4 mb-8">
                @foreach([
                    'one_frac' => '1 Fraction',
                    'simple_frac' => '2 ' . $lang[47],
                    'three_frac' => '3 ' . $lang[47],
                    'four_frac' => '4 ' . $lang[47]
                ] as $val => $label)
                    <label class="flex items-center gap-2 cursor-pointer px-4 py-2">
                        <input type="radio" wire:model.live="stype" value="{{ $val }}" class="w-4 h-4 text-blue-600">
                        <span class="text-sm font-medium text-gray-700">{!! $label !!}</span>
                    </label>
                @endforeach
            </div>

            <!-- Inputs Area -->
            <div class="bg-white p-8 rounded-2xl mb-8">
                <div class="fraction-input-group">
                    @if($fraction_types === 'one_frac')
                        <div class="fraction-box mixed">
                            <input type="number" step="any" wire:model.live="ne1" class="num-den-input whole-num" placeholder="W">
                            <div class="frac-part">
                                <input type="number" step="any" wire:model.live="neo2" class="num-den-input" placeholder="N">
                                <div class="frac-line"></div>
                                <input type="number" step="any" wire:model.live="du1" class="num-den-input" placeholder="D">
                            </div>
                        </div>
                    @else
                        <!-- Fraction 1 -->
                        <div class="fraction-box">
                            <input required type="number" step="any" wire:model.live="N1" class="num-den-input" placeholder="N1">
                            <div class="frac-line"></div>
                            <input required type="number" step="any" wire:model.live="D1" class="num-den-input" placeholder="D1">
                        </div>

                        <!-- Op 1 -->
                        <select wire:model.live="action" class="op-select">
                            @foreach(['+', '-', '×', '÷'] as $op)
                                <option value="{{ $op }}">{{ $op }}</option>
                            @endforeach
                        </select>

                        <!-- Fraction 2 -->
                        <div class="fraction-box">
                            <input required type="number" step="any" wire:model.live="N2" class="num-den-input" placeholder="N2">
                            <div class="frac-line"></div>
                            <input required type="number" step="any" wire:model.live="D2" class="num-den-input" placeholder="D2">
                        </div>

                        @if(in_array($fraction_types, ['three_frac', 'four_frac']))
                            <select wire:model.live="action1" class="op-select">
                                @foreach(['+', '-', '×', '÷'] as $op)
                                    <option value="{{ $op }}">{{ $op }}</option>
                                @endforeach
                            </select>
                            <div class="fraction-box">
                                <input required type="number" step="any" wire:model.live="N3" class="num-den-input" placeholder="N3">
                                <div class="frac-line"></div>
                                <input required type="number" step="any" wire:model.live="D3" class="num-den-input" placeholder="D3">
                            </div>
                        @endif

                        @if($fraction_types === 'four_frac')
                            <select wire:model.live="action2" class="op-select">
                                @foreach(['+', '-', '×', '÷'] as $op)
                                    <option value="{{ $op }}">{{ $op }}</option>
                                @endforeach
                            </select>
                            <div class="fraction-box">
                                <input required type="number" step="any" wire:model.live="N4" class="num-den-input" placeholder="N4">
                                <div class="frac-line"></div>
                                <input required type="number" step="any" wire:model.live="D4" class="num-den-input" placeholder="D4">
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @else
            <!-- Mixed Numbers Mode -->
            <div class="bg-white p-8 rounded-2xl mb-8">
                <div class="fraction-input-group">
                    <!-- Mixed 1 -->
                    <div class="fraction-box mixed">
                        <input required type="number" wire:model.live="s1" class="num-den-input whole-num" placeholder="W1">
                        <div class="frac-part">
                            <input required type="number" wire:model.live="nu1" class="num-den-input" placeholder="N1">
                            <div class="frac-line"></div>
                            <input required type="number" wire:model.live="de1" class="num-den-input" placeholder="D1">
                        </div>
                    </div>

                    <!-- Op -->
                    <select wire:model.live="actions" class="op-select">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="×">×</option>
                        <option value="÷">÷</option>
                    </select>

                    <!-- Mixed 2 -->
                    <div class="fraction-box mixed">
                        <input required type="number" wire:model.live="s2" class="num-den-input whole-num" placeholder="W2">
                        <div class="frac-part">
                            <input required type="number" wire:model.live="nu2" class="num-den-input" placeholder="N2">
                            <div class="frac-line"></div>
                            <input required type="number" wire:model.live="de2" class="num-den-input" placeholder="D2">
                        </div>
                    </div>
                </div>
            </div>
        @endif
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
    </form>

            @if ($type == 'widget')
                <div class="mt-4">
                    @include('inc.widget-button')
                </div>
            @endif

<!-- Result Section -->
@if($detail)
<hr>
    <div id="result-section" class="mt-8 w-full">
        <div class="py-6">
            <div>
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif      
            </div>

            @if($calculate_type == 'fraction_type')
                <div class="space-y-10">
                    @if($fraction_types === "one_frac")
                        <div class="p-6 my-4 space-y-6 result-font" wire:key="result-one-frac">
                            <div class="text-left math-render-target">
                                \( {!! $ne1 !!} \frac{ {!! $neo2 !!} }{ {!! $du1 !!} } = \frac{ {!! $detail['upr'] !!} }{ {!! $detail['btm'] !!} } \)
                            </div>
                            
                            <div class="space-y-4 md:text-[20px] text-[16px]">
                                <p class="font-bold border-b pb-2">Explanation:</p>
                                <p>Your Input: \( {!! $ne1 !!} \frac{ {!! $neo2 !!} }{ {!! $du1 !!} } \)</p>
                                <p>Step # 1 = \( \frac{ {!! $detail['totalN'] !!} }{ {!! $detail['totalD'] !!} } \)</p>
                                <p>Step # 2 = \( \frac{ ({!! $detail['totalN'] !!} \div {!! $detail['g'] !!}) }{ ({!! $detail['totalD'] !!} \div {!! $detail['g'] !!}) } \)</p>
                                <p>Ans = \( \frac{ {!! $detail['upr'] !!} }{ {!! $detail['btm'] !!} } \)</p>
                                
                                @if($detail['upr'] > $detail['btm'] && $detail['btm'] != 1)
                                    @php 
                                        $bta = abs($detail['upr'] % $detail['btm']); 
                                        $shi = floor($detail['upr'] / $detail['btm']); 
                                    @endphp
                                    <p>OR = {!! $shi !!} \( \frac{ {!! $bta !!} }{ {!! $detail['btm'] !!} } \)</p>
                                @endif
                                
                                <p>Result in decimal = {{ round($detail['upr']/$detail['btm'], 4) }}</p>
                            </div>
                        </div>
                    @elseif($fraction_types === "simple_frac")
                        <div class="p-6 my-4 result-font math-render-target" wire:key="result-simple-frac">
                            <p class="text-center mt-2 font-bold">
                                @if($action=='^')
                                    $$ \left( \frac{ {!! $N1 !!} }{ {!! $D1 !!} } \right) {!! $action !!} \frac{ {!! $N2 !!} }{ {!! $D2 !!} } = @if($detail['btm'] != 1 && $detail['upr'] != 0)\frac{ {!! $detail['upr'] !!} }{ {!! $detail['btm'] !!} }@else{!! $detail['upr'] !!}@endif $$
                                @else
                                    $$ \frac{ {!! $N1 !!} }{ {!! $D1 !!} } {!! $action !!} \frac{ {!! $N2 !!} }{ {!! $D2 !!} } = @if($detail['btm'] != 1 && $detail['upr'] != 0)\frac{ {!! $detail['upr'] !!} }{ {!! $detail['btm'] !!} }@else{!! $detail['upr'] !!}@endif $$
                                @endif
                            </p>
                        </div>
                        
                        <div class="space-y-8">
                            <div>
                                <h3 class="font-bold text-gray-800 mb-4">Explanation:</h3>
                                <div class="math-steps prose max-w-none">
                                    @php
                                        $gN1 = $N1; $gD1 = $D1; $gN2 = $N2; $gD2 = $D2; $gAct = $action;
                                        $displayN2 = $N2; $displayAction = $action;
                                        if($N2 < 0 && $action == '+') { $displayAction = '-'; $displayN2 = abs($N2); }
                                        elseif($N2 < 0 && $action == '-') { $displayAction = '+'; $displayN2 = abs($N2); }
                                    @endphp

                                    <div class="text-center p-4 mb-4">
                                        \( \dfrac{ {!! $N1 !!} }{ {!! $D1 !!} } {!! $displayAction !!} \dfrac{ {!! $displayN2 !!} }{ {!! $D2 !!} } = ? \)
                                    </div>

                                    @if($action == '+' || $action == '-')
                                        @include('livewire.calculators.frac.two-add-sub')
                                    @elseif($action == '×' || $action == 'of' || $action == '÷')
                                        @include('livewire.calculators.frac.two-mul')
                                    @elseif($action == '^')
                                        @include('livewire.calculators.frac.power')
                                    @endif
                                </div>
                            </div>

                            <div class="pt-6 border-t">
                                <p class="font-bold text-gray-800 mb-2">Result in decimal:</p>
                                <div class="text-center text-xl font-bold py-4">
                                    \( = {{ round($detail['upr'] / $detail['btm'], 10) }} \)
                                </div>

                                <p class="font-bold text-gray-800 mt-6 mb-4">Fraction Visualization:</p>
                                <div class="flex flex-wrap items-center justify-center gap-6 py-8 border">
                                    <div id="firstFrac"></div>
                                    <div class="text-3xl font-bold text-gray-400">{!! $action !!}</div>
                                    <div id="secondFrac"></div>
                                    <div class="text-3xl font-bold text-gray-400">=</div>
                                    <div id="ansFrac"></div>
hr                                </div>
                                </div>
                            </div>
                        </div>

                    @elseif($fraction_types === "three_frac")
                        <div class="p-6 my-4 result-font math-render-target" wire:key="result-three-frac">
                            <p class="text-center mt-2 font-bold">
                                $$ \frac{ {!! $N1 !!} }{ {!! $D1 !!} } {!! $action !!} \frac{ {!! $N2 !!} }{ {!! $D2 !!} } {!! $action1 !!} \frac{ {!! $N3 !!} }{ {!! $D3 !!} } = @if($detail['btm'] != 1 && $detail['upr'] != 0)\frac{ {!! $detail['upr'] !!} }{ {!! $detail['btm'] !!} }@else{!! $detail['upr'] !!}@endif $$
                            </p>
                        </div>
                        <div class="space-y-8">
                            <div class="p-6 my-4">
                                @php
                                    $gN1=$N1; $gD1=$D1; $gN2=$N2; $gD2=$D2; $gN3=$N3; $gD3=$D3; $gAct=$action; $gAct1=$action1;
                                    if (($action=='+' || $action=='-') && ($action1=='+' || $action1=='-')) {
                                        require resource_path('views/livewire/calculators/frac/three-add-sub.php');
                                    } elseif (($action=='÷' || $action=='×') && ($action1=='÷' || $action1=='×')) {
                                        require resource_path('views/livewire/calculators/frac/three-mul-div.php');
                                    } elseif (($action=='÷' || $action=='×') && ($action1=='+' || $action1=='-')) {
                                        require resource_path('views/livewire/calculators/frac/three-mul-add.php');
                                    } elseif (($action1=='÷' || $action1=='×') && ($action=='+' || $action=='-')) {
                                        require resource_path('views/livewire/calculators/frac/three-div-sub.php');
                                    }
                                @endphp
                            </div>
                            <div class="flex flex-wrap items-center justify-center gap-4 bg-gray-50 p-6 rounded-xl border">
                                <div id="firstFrac"></div>
                                <div class="text-xl font-bold">{!! $gAct !!}</div>
                                <div id="secondFrac"></div>
                                <div class="text-xl font-bold">{!! $gAct1 !!}</div>
                                <div id="thirdFrac"></div>
                                <div class="text-xl font-bold">=</div>
                                <div id="ansFrac"></div>
                            </div>
                        </div>
                    @elseif($fraction_types === "four_frac")
                        <div class="p-6 my-4 result-font math-render-target" wire:key="result-four-frac">
                            <p class="text-center mt-2 font-bold">
                                $$ \frac{ {!! $N1 !!} }{ {!! $D1 !!} } {!! $action !!} \frac{ {!! $N2 !!} }{ {!! $D2 !!} } {!! $action1 !!} \frac{ {!! $N3 !!} }{ {!! $D3 !!} } {!! $action2 !!} \frac{ {!! $N4 !!} }{ {!! $D4 !!} } = @if($detail['btm'] != 1 && $detail['upr'] != 0)\frac{ {!! $detail['upr'] !!} }{ {!! $detail['btm'] !!} }@else{!! $detail['upr'] !!}@endif $$
                            </p>
                        </div>
                        <div class="space-y-8 mt-6">
                            <div class="p-6 my-4 math-steps prose max-w-none">
                                @php
                                    $gN1=$N1; $gD1=$D1; $gN2=$N2; $gD2=$D2; $gN3=$N3; $gD3=$D3; $gN4=$N4; $gD4=$D4;
                                    $gAct=$action; $gAct1=$action1; $gAct2=$action2;
                                    
                                    $file = "";
                                    if(($action=='+' || $action=='-') && ($action1=='+' || $action1=='-') && ($action2=='+' || $action2=='-')) $file = "four-add-sub-add.php";
                                    elseif(($action=='+' || $action=='-') && ($action1=='+' || $action1=='-') && ($action2=='×' || $action2=='÷')) $file = "four-add-sub-mul.php";
                                    elseif(($action=='+' || $action=='-') && ($action1=='×' || $action1=='÷') && ($action2=='+' || $action2=='-')) $file = "four-add-mul-sub.php";
                                    elseif(($action=='+' || $action=='-') && ($action1=='×' || $action1=='÷') && ($action2=='×' || $action2=='÷')) $file = "four-add-mul-div.php";
                                    elseif(($action=='×' || $action=='÷') && ($action1=='+' || $action1=='-') && ($action2=='+' || $action2=='-')) $file = "four-mul-add-sub.php";
                                    elseif(($action=='×' || $action=='÷') && ($action1=='+' || $action1=='-') && ($action2=='×' || $action2=='÷')) $file = "four-mul-add-div.php";
                                    elseif(($action=='×' || $action=='÷') && ($action1=='×' || $action1=='÷') && ($action2=='+' || $action2=='-')) $file = "four-mul-div-add.php";
                                    elseif(($action=='×' || $action=='÷') && ($action1=='×' || $action1=='÷') && ($action2=='×' || $action2=='÷')) $file = "four-mul-div-mul.php";

                                    if($file && file_exists(resource_path("views/livewire/calculators/frac/$file"))) {
                                        require resource_path("views/livewire/calculators/frac/$file");
                                    }
                                @endphp
                            </div>
                            <div class="flex flex-wrap items-center justify-center gap-4 bg-gray-50 p-6 rounded-xl border">
                                <div id="firstFrac"></div>
                                <div class="text-xl font-bold">{!! $action !!}</div>
                                <div id="secondFrac"></div>
                                <div class="text-xl font-bold">{!! $action1 !!}</div>
                                <div id="thirdFrac"></div>
                                <div class="text-xl font-bold">{!! $action2 !!}</div>
                                <div id="fourFrac"></div>
                                <div class="text-xl font-bold text-blue-500">=</div>
                                <div id="ansFrac"></div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="col-12 text-[18px] p-6 my-4">
                    <p class="mt-3 text-[25px] text-center pb-4 mb-6">
                        <strong>\(
                            {!! $s1 !!} \frac{ {!! $nu1 !!} }{ {!! $de1 !!} } {!! $actions !!} {!! $s2 !!} \frac{ {!! $nu2 !!} }{ {!! $de2 !!} } = \frac{ {!! $detail['upr'] !!} }{ {!! $detail['btm'] !!} }
                        \)</strong>
                    </p>
                    
                    <div class="space-y-4 text-[20px] md:text-[25px]">
                        <p class="mt-3 font-bold text-gray-800 underline">Explanation:</p>
                        
                        <p class="mt-3">
                            Input:
                            \(
                                {!! $s1 !!} \frac{ {!! $nu1 !!} }{ {!! $de1 !!} } {!! $actions !!} {!! $s2 !!} \frac{ {!! $nu2 !!} }{ {!! $de2 !!} } 
                            \)
                        </p>

                        @if(is_numeric($s1) || is_numeric($s2))
                            <p class="mt-3">Step # 1 :
                                \(
                                    \frac{ {!! $detail['N1'] !!} }{ {!! $detail['D1'] !!} } {!! $actions !!} \frac{ {!! $detail['N2'] !!} }{ {!! $detail['D2'] !!} }
                                \)
                            </p>
                        @endif

                        @if($actions == '×')
                            <p class="mt-3">
                                Step # 2 =
                                \(
                                    \frac{ {!! $detail['N1'].$actions.$detail['N2'] !!} }{ {!! $detail['D1'].$actions.$detail['D2'] !!} }
                                \)
                            </p>
                        @elseif($actions == '÷')
                            <p class="mt-3">
                                Step # 2 =
                                \(
                                    \frac{ ({!! $detail['N1'].'×'.$detail['D2'] !!}) }{ ({!! $detail['N2'].'×'.$detail['D1'] !!}) }
                                )
                            </p>
                        @else
                            <p class="mt-3">
                                Step # 2 =
                                \(
                                    \frac{ ({!! $detail['N1'].'×'.$detail['D2'] !!}) {!! $actions !!} {!! $detail['N2'].'×'.$detail['D1'] !!} }{ {!! $detail['D1'].'×'.$detail['D2'] !!} }
                                \)
                            </p>
                        @endif

                        <p class="mt-3">
                            Step # 3 =
                            \(
                                \frac{ {!! $detail['totalN'] !!} }{ {!! $detail['totalD'] !!} }
                            \)
                        </p>

                        <p class="mt-3">
                            Step # 4 =
                            \(
                                \frac{ ({!! $detail['totalN'].'÷'.$detail['g'] !!}) }{ ({!! $detail['totalD'].'÷'.$detail['g'] !!}) }
                            \)
                        </p>

                        @if($detail['btm'] == '1')
                            <p class="mt-3 font-bold">
                                Final Answer = 
                                \( {!! $detail['upr'] !!} \)
                            </p>
                        @else
                            <p class="mt-3 font-bold">
                                Final Answer = 
                                \( \frac{ {!! $detail['upr'] !!} }{ {!! $detail['btm'] !!} } \)
                            </p>
                        @endif

                        @if($detail['upr'] > $detail['btm'] && $detail['btm'] != '1')
                            @php 
                                $bta = abs($detail['upr'] % $detail['btm']); 
                                $shi = floor($detail['upr'] / $detail['btm']); 
                            @endphp
                            <p class="mt-3 font-bold text-blue-600">
                                Mixed Form = {!! $shi !!} 
                                \( \frac{ {!! $bta !!} }{ {!! $detail['btm'] !!} } \)
                            </p>
                        @endif

                        @if($detail['btm'] != '1')
                            <p class="mt-3">Decimal: {{ round($detail['upr']/$detail['btm'], 4) }}</p>
                        @endif

                        <div class="mt-8 pt-8 border-t">
                            <p class="font-bold text-gray-800 mb-4">Fraction Visualization:</p>
                            <div class="flex flex-wrap items-center justify-center gap-4 bg-gray-50 p-6 rounded-xl border">
                                <div id="firstFrac"></div>
                                <div class="text-xl font-bold">{!! $actions !!}</div>
                                <div id="secondFrac"></div>
                                <div class="text-xl font-bold">=</div>
                                <div id="ansFrac"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            @endif
        </div>
    </div>
    @endif
</div>
@push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="{{ url('katex/katex.min.js') }}"></script>
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="processMathAndRender();"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ url('js/jquery.fractionpainter.js') }}"></script>

    <script>
        function processMathAndRender() {
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body, {
                    delimiters: [
                        {left: '$$', right: '$$', display: true},
                        {left: '\\(', right: '\\)', display: false},
                        {left: '$', right: '$', display: false}
                    ],
                    throwOnError: false
                });
            }

            document.querySelectorAll('.math-render-target').forEach(function(el) {
                const math = el.textContent.trim();
                const match = math.match(/^\\\((.*)\\\)$/) || math.match(/^\$\$(.*)\$\$$/);
                if (match && match[1]) {
                    try {
                        katex.render(match[1], el, {
                            throwOnError: false,
                            displayMode: true
                        });
                    } catch (err) {}
                }
            });

            // If we have detail, try to initialize painters with existing data
            const currentDetail = @json($detail);
            if (currentDetail) {
                initializePainters({
                    detail: currentDetail,
                    N1: {!! (float)($N1 ?? 0) !!},
                    D1: {!! (float)($D1 ?? 1) !!},
                    N2: {!! (float)($N2 ?? 0) !!},
                    D2: {!! (float)($D2 ?? 1) !!},
                    N3: {!! (float)($N3 ?? 0) !!},
                    D3: {!! (float)($D3 ?? 1) !!},
                    N4: {!! (float)($N4 ?? 0) !!},
                    D4: {!! (float)($D4 ?? 1) !!},
                    fraction_types: @json($fraction_types)
                });
            }
        }

        function initializePainters(data) {
            if (!data || !data.detail) return;
            const size = window.innerWidth < 768 ? 60 : 110;

            const n1 = parseFloat(data.N1 || data.detail.N1 || 0);
            const d1 = parseFloat(data.D1 || data.detail.D1 || 1);
            const n2 = parseFloat(data.N2 || data.detail.N2 || 0);
            const d2 = parseFloat(data.D2 || data.detail.D2 || 1);
            const n3 = parseFloat(data.N3 || 0);
            const d3 = parseFloat(data.D3 || 1);
            const n4 = parseFloat(data.N4 || 0);
            const d4 = parseFloat(data.D4 || 1);

            if ($('#firstFrac').length) $('#firstFrac').empty().fractionPainter({ numerator: n1, denominator: d1, width: size, height: size });
            if ($('#secondFrac').length) $('#secondFrac').empty().fractionPainter({ numerator: n2, denominator: d2, width: size, height: size });
            
            if (data.fraction_types === "three_frac" || data.fraction_types === "four_frac") {
                if ($('#thirdFrac').length) $('#thirdFrac').empty().fractionPainter({ numerator: n3, denominator: d3, width: size, height: size });
            }
            if (data.fraction_types === "four_frac") {
                if ($('#fourFrac').length) $('#fourFrac').empty().fractionPainter({ numerator: n4, denominator: d4, width: size, height: size });
            }

            if ($('#ansFrac').length) $('#ansFrac').empty().fractionPainter({ 
                numerator: parseFloat(data.detail.upr || 0), 
                denominator: parseFloat(data.detail.btm || 1), 
                width: size + 10, 
                height: size + 10 
            });
        }

        document.addEventListener('livewire:initialized', () => {
            processMathAndRender();
            
            Livewire.hook('morph.updated', (el, component) => {
                setTimeout(processMathAndRender, 100);
            });

            @this.on('math-updated', (event) => {
                const data = Array.isArray(event) ? event[0] : event;
                setTimeout(() => {
                    processMathAndRender();
                    initializePainters(data);
                }, 200);
            });
        });
    </script>
@endpush

