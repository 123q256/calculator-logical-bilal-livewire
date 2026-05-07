<div>
    <style>
        input {
            background-color: transparent;
            outline: none;
        }
        table.scorecard {
            margin: 0 auto; 
            width: 100%; 
            font-size: 12px; 
            border: 1px solid black; 
            text-align: center; 
            table-layout: fixed; 
            margin-bottom: 20px;
        }
        table.scorecard th {
            border-bottom: 1px solid black; 
            background-color: #d3313a; 
            height: 30px; 
            color: #fff;
        }
        table.scorecard th:not(:last-child) {
            border-right: 1px solid black;
        }
        table.scorecard td {
            height: 35px; 
            background: rgba(255, 255, 255, 0.5);
        }
        table.scorecard tr td:not(:last-child) {
            border-right: 1px solid black;
        }
        table.scorecard tr:nth-child(2) td:nth-child(even) {
            border-bottom: 1px solid black;
        }
        table.scorecard tr:nth-child(2) td:last-child {
            border-bottom: 1px solid black;
        }
        table.scorecard tr {
            border: none;
        }
        table.scorecard input {
            text-align: center; 
            border: none !important;
            padding: 0px !important; 
            height: 1.25rem !important;
            width: 100%;
            outline: none !important;
            box-shadow: none !important;
            pointer-events: none;
        }
        .pins {
            justify-content: center;
            display: flex;
            flex-wrap: wrap; 
            gap: 8px;
        }
        .buttons input {
            height: 2.75rem !important;
            padding: 5px 22px;
            font-family: "Roboto", "Helvetica", "Arial", sans-serif;
            line-height: 1.75;
            border-radius: 4px;
            border: 1px solid rgba(0, 0, 0, 0.23) !important;
            width: 4rem; 
            background-color: #fff; 
            visibility: visible;
            cursor: pointer;
        }
        .buttons input:hover:not(:disabled) {
            background-color: rgba(255, 255, 255, 0.5);
        }
        .buttons input:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }
    </style>

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
        @endif

        <div class="lg:w-[100%] md:w-[100%] w-full mx-auto">
            <div class="col-12 mt-3 gap-4">
                <div id="scorecard" class="text-center overflow-auto">
                    <table id="scorecardTable" class="scorecard" cellpadding="1" cellspacing="0">
                        <tbody>
                            <tr></tr>
                            <tr>
                                {{-- Frames 1-9 Throws --}}
                                @for($i=1; $i<=9; $i++)
                                    <td colspan="3">
                                        <div>
                                            <input value="{{ $frames[$i]['1'] === 10 ? '' : $frames[$i]['1'] }}" readonly aria-label="frame {{ $i }} throw 1">
                                        </div>
                                    </td>
                                    <td colspan="3">
                                        <div>
                                            <input value="{{ $frames[$i]['status'] === 'X' ? 'X' : ($frames[$i]['status'] === '/' ? '/' : $frames[$i]['2']) }}" readonly aria-label="frame {{ $i }} throw 2">
                                        </div>
                                    </td>
                                @endfor

                                {{-- Frame 10 Throws --}}
                                <td colspan="3">
                                    <div>
                                        <input value="{{ $frames[10]['1'] === 10 ? 'X' : $frames[10]['1'] }}" readonly aria-label="frame 10 throw 1">
                                    </div>
                                </td>
                                <td colspan="3">
                                    @php
                                        $f10t2 = $frames[10]['2'];
                                        if ($f10t2 === 10) {
                                            $display2 = 'X';
                                        } elseif ($frames[10]['1'] !== '' && $f10t2 !== '' && $frames[10]['1'] + $f10t2 === 10 && $frames[10]['1'] !== 10) {
                                            $display2 = '/';
                                        } else {
                                            $display2 = $f10t2;
                                        }
                                    @endphp
                                    <div>
                                        <input value="{{ $display2 }}" readonly aria-label="frame 10 throw 2">
                                    </div>
                                </td>
                                <td colspan="3" style="border-bottom:1px solid">
                                    @php
                                        $f10t3 = $frames[10]['3'];
                                        if ($f10t3 === 10) {
                                            $display3 = 'X';
                                        } elseif ($frames[10]['2'] !== '' && $f10t3 !== '' && $frames[10]['2'] + $f10t3 === 10 && $display2 !== 'X') {
                                            $display3 = '/';
                                        } else {
                                            $display3 = $f10t3;
                                        }
                                    @endphp
                                    <div>
                                        <input value="{{ $display3 }}" readonly aria-label="frame 10 throw 3">
                                    </div>
                                </td>

                                {{-- Total Score --}}
                                <td colspan="9" rowspan="9" style="border-left:1px solid;">
                                    <div>
                                        <input value="{{ $totalScore }}" readonly style="font-size: 18px; font-weight: 500" aria-label="total score">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                {{-- Frame Result (Cumulative) --}}
                                @for($i=1; $i<=9; $i++)
                                    <td colspan="6">
                                        <div>
                                            <input value="{{ $frames[$i]['result'] }}" readonly aria-label="frame {{ $i }} cumulative">
                                        </div>
                                    </td>
                                @endfor
                                <td colspan="9">
                                    <div>
                                        <input value="{{ $frames[10]['result'] }}" readonly aria-label="frame 10 cumulative">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="pins">
                    @php
                        // Logic to disable buttons based on current throw
                        $disabledPins = [];
                        if ($currentFrame < 10) {
                            if ($currentThrow == 2) {
                                $pinsLeft = 10 - (int)$frames[$currentFrame]['1'];
                                for ($p = $pinsLeft + 1; $p <= 9; $p++) {
                                    $disabledPins[] = $p;
                                }
                            }
                        } else {
                            if ($currentThrow == 2 && $frames[10]['1'] !== 10) {
                                $pinsLeft = 10 - (int)$frames[10]['1'];
                                for ($p = $pinsLeft + 1; $p <= 9; $p++) {
                                    $disabledPins[] = $p;
                                }
                            } elseif ($currentThrow == 3 && $frames[10]['2'] !== 10 && ($frames[10]['1'] + $frames[10]['2'] !== 10)) {
                                $pinsLeft = 10 - (int)$frames[10]['2'];
                                for ($p = $pinsLeft + 1; $p <= 9; $p++) {
                                    $disabledPins[] = $p;
                                }
                            }
                        }

                        $strikeDisabled = false;
                        if ($currentFrame < 10 && $currentThrow == 2) $strikeDisabled = true;
                        if ($currentFrame == 10) {
                            if ($currentThrow == 2 && $frames[10]['1'] !== 10) $strikeDisabled = true;
                            if ($currentThrow == 3 && $frames[10]['2'] !== 10 && ($frames[10]['1'] + $frames[10]['2'] !== 10)) $strikeDisabled = true;
                        }

                        $spareDisabled = true;
                        if ($currentThrow == 2) $spareDisabled = false;
                        if ($currentFrame == 10 && $currentThrow == 3) {
                            if ($frames[10]['2'] === 10) $spareDisabled = true;
                            else $spareDisabled = false;
                        }
                        
                        if($gameOver) {
                            $strikeDisabled = true;
                            $spareDisabled = true;
                            for($i=0; $i<=9; $i++) $disabledPins[] = $i;
                        }
                    @endphp

                    @for($p=0; $p<=9; $p++)
                        <div class="buttons">
                            <input type="button" value="{{ $p }}" wire:click="handleInput({{ $p }})" @disabled(in_array($p, $disabledPins))>
                        </div>
                    @endfor
                    <div class="buttons">
                        <input type="button" value="X" wire:click="handleInput('X')" @disabled($strikeDisabled)>
                    </div>
                    <div class="buttons">
                        <input type="button" value="/" wire:click="handleInput('/')" @disabled($spareDisabled)>
                    </div>
                </div>

                <div class="col-12 text-center mt-[30px]">
                    <button type="button" wire:click="resetGame" class="calculate px-6 py-3 sm:px-10 sm:py-4 text-white font-semibold bg-[#2845F5] rounded-[30px] focus:outline-none focus:ring-2 text-sm sm:text-base">
                        New Game
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if ($type == 'widget')
        @include('inc.widget-button')
    @endif
</div>
