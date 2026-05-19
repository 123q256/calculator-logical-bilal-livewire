<div>
        @php
        if (!function_exists('safe_round')) {
            function safe_round($val, $precision = 5) {
                if ($val === 'NAN' || $val === 'NaN' || (is_numeric($val) && is_nan((float)$val))) {
                    return 'NAN';
                }
                if ($val === 'INF' || $val === 'INF' || $val === 'infinity' || $val === 'Infinity' || (is_numeric($val) && is_infinite((float)$val))) {
                    return 'INF';
                }
                return is_numeric($val) ? round((float)$val, $precision) : $val;
            }
        }
    @endphp
    <form wire:submit.prevent="calculate" class="row w-full">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="slct1" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select wire:model.live="slct1" class="input" id="slct1" aria-label="select">
                        <option value="1">{{ $lang['2'] }} (A = C)</option>
                        <option value="2">{{ $lang['2'] }} (B)</option>
                        <option value="3">{{ $lang['2'] }} (A = C) & {{ $lang[3] }} a</option>
                        <option value="4">{{ $lang['2'] }} (A = C) & {{ $lang[4] }}</option>
                        <option value="5">{{ $lang['5'] }} (P) & {{ $lang[3] }} a</option>
                        <option value="6">{{ $lang['5'] }} (P) & {{ $lang[3] }} b</option>
                        <option value="7">{{ $lang['3'] }} a & {{ $lang[3] }} b</option>
                        <option value="8">{{ $lang['7'] }} (K) & {{ $lang[3] }} b</option>
                        <option value="9">{{ $lang['7'] }} (K) & {{ $lang[4] }} h</option>
                        <option value="10">{{ $lang['3'] }} (b) & {{ $lang[4] }} h</option>
                        <option value="11">{{ $lang['2'] }} (A = C) & {{ $lang[3] }} a & b</option>
                        <option value="12">{{ $lang['3'] }} a & b, {{ $lang[6] }} p</option>
                        <option value="13">{{ $lang['3'] }} a & b, {{ $lang[6] }} q</option>
                        <option value="14">{{ $lang['3'] }} a & b, {{ $lang[4] }} h</option>
                        <option value="15">{{ $lang['3'] }} a & b, {{ $lang[7] }} (K)</option>
                        <option value="16">{{ $lang['2'] }} (A = C), {{ $lang[3] }} a & {{ $lang[7] }} (K)</option>
                        <option value="17">{{ $lang['2'] }} (A = C), {{ $lang[3] }} b & {{ $lang[7] }} (K)</option>
                        <option value="18">{{ $lang['3'] }} a, {{ $lang[6] }} p & q</option>
                        <option value="19">{{ $lang['3'] }} b, {{ $lang[6] }} p & q</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="rad1" class="label" id="heading">{{ $this->getHeading1() }}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model="rad1" id="rad1" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ $this->isSide1Visible() ? '' : 'd-none' }}">
                <label for="side1" class="label" id="heading2">{{ $this->getHeading2() }}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model="side1" id="side1" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ $this->isSide2Visible() ? '' : 'd-none' }}">
                <label for="side2" class="label" id="heading3">{{ $this->getHeading3() }}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model="side2" id="side2" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="pi" class="label">pi π =</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model="pi" id="pi" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="unit" class="label">{{ $lang['8'] }}:</label>
                <div class="w-full py-2">
                    <select wire:model="unit" class="input" id="unit" aria-label="select">
                        <option value="cm">cm</option>
                        <option value="m">m</option>
                        <option value="in">in</option>
                        <option value="ft">ft</option>
                        <option value="yd">yd</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
     @if ($type == 'calculator')
     @include('inc.button')
    @endif
    @if ($type=='widget')
    @include('inc.widget-button')
     @endif
</div>
    @isset($detail)

    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                            @if ($slct1 == 1)
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['c2']) . '°' }}</td>
                                </tr>
                            @elseif ($slct1==2)
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['c1']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . '°' }}</td>
                                </tr>
                            @elseif($slct1=="3")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['h']) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['c2']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                            @elseif($slct1=="4")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['a']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['b']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                            @elseif($slct1=="5")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['b']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} P:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                            @elseif($slct1=="6")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['a']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} P:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                            @elseif($slct1=="7")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} P:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['p']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                            @elseif($slct1=="8")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['h']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($slct1=="9")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['b']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($slct1=="10")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['k']) . ' ' . $unit }}<sup class="font-s-14">2</sup></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . ' ' . $unit }}</td>
                                </tr>
                            @elseif($slct1=="11")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['calculate']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side2) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['p']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['q']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['h']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['P']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['k']) . ' ' . $unit }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($slct1=="12")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['calculate']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side2) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['q']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['h']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['P']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['h']) * safe_round($side1) . ' ' . $unit }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($slct1=="13")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['a']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['b']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['p']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side2) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['h']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['P']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['h']) * safe_round($side1) . ' ' . $unit }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($slct1=="14")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['a']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['b']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['p']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['q']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side2) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['P']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['k']) . ' ' . $unit }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($slct1=="15")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['a']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['b']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['p']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['q']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['h']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['P']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side2) . ' ' . $unit }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($slct1=="16")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['b_angle']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['b']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['p']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['q']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['h']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['P']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side2) . ' ' . $unit }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($slct1=="17")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['b_angle']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['a']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['p']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['q']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['h']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['P']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side2) . ' ' . $unit }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($slct1=="18")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['a']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['b_angle']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['sq']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side2) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['h']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['P']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['k']) . ' ' . $unit }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($slct1=="19")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['an']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['b_angle']) . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['sq']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($rad1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side1) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($side2) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['h']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['P']) . ' ' . $unit }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ safe_round($detail['k']) . ' ' . $unit }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>