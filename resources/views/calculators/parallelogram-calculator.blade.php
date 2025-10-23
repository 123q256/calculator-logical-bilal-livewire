<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php
                if (!isset($detail)) {
                    $_POST['slct1'] = '10';
                    $_POST['unit'] = 'm';
                }
            @endphp
            <div class="col-span-12">
                <label for="slct1" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select name="slct1" class="input" id="slct1" aria-label="select">
                        <option value="1">{{ $lang['2'] }} (A = C)</option>
                        <option value="2" {{ isset($_POST['slct1']) && $_POST['slct1'] == '2' ? 'selected' : '' }}>
                            {{ $lang['2'] }} (B)</option>
                        <option value="3" {{ isset($_POST['slct1']) && $_POST['slct1'] == '3' ? 'selected' : '' }}>
                            {{ $lang['2'] }} (A = C) & {{ $lang[3] }} a</option>
                        <option value="4" {{ isset($_POST['slct1']) && $_POST['slct1'] == '4' ? 'selected' : '' }}>
                            {{ $lang['2'] }} (A = C) & {{ $lang[4] }}</option>
                        <option value="5" {{ isset($_POST['slct1']) && $_POST['slct1'] == '5' ? 'selected' : '' }}>
                            {{ $lang['5'] }} (P) & {{ $lang[3] }} a</option>
                        <option value="6" {{ isset($_POST['slct1']) && $_POST['slct1'] == '6' ? 'selected' : '' }}>
                            {{ $lang['5'] }} (P) & {{ $lang[3] }} b</option>
                        <option value="7" {{ isset($_POST['slct1']) && $_POST['slct1'] == '7' ? 'selected' : '' }}>
                            {{ $lang['3'] }} a & {{ $lang[3] }} b</option>
                        <option value="8" {{ isset($_POST['slct1']) && $_POST['slct1'] == '8' ? 'selected' : '' }}>
                            {{ $lang['7'] }} (K) & {{ $lang[3] }} b</option>
                        <option value="9" {{ isset($_POST['slct1']) && $_POST['slct1'] == '9' ? 'selected' : '' }}>
                            {{ $lang['7'] }} (K) & {{ $lang[4] }} h</option>
                        <option value="10" {{ isset($_POST['slct1']) && $_POST['slct1'] == '10' ? 'selected' : '' }}>
                            {{ $lang['3'] }} (b) & {{ $lang[4] }} h</option>
                        <option value="11" {{ isset($_POST['slct1']) && $_POST['slct1'] == '11' ? 'selected' : '' }}>
                            {{ $lang['2'] }} (A = C) & {{ $lang[3] }} a & b</option>
                        <option value="12" {{ isset($_POST['slct1']) && $_POST['slct1'] == '12' ? 'selected' : '' }}>
                            {{ $lang['3'] }} a & b, {{ $lang[6] }} p</option>
                        <option value="13" {{ isset($_POST['slct1']) && $_POST['slct1'] == '13' ? 'selected' : '' }}>
                            {{ $lang['3'] }} a & b, {{ $lang[6] }} q</option>
                        <option value="14" {{ isset($_POST['slct1']) && $_POST['slct1'] == '14' ? 'selected' : '' }}>
                            {{ $lang['3'] }} a & b, {{ $lang[4] }} h</option>
                        <option value="15" {{ isset($_POST['slct1']) && $_POST['slct1'] == '15' ? 'selected' : '' }}>
                            {{ $lang['3'] }} a & b, {{ $lang[7] }} (K)</option>
                        <option value="16" {{ isset($_POST['slct1']) && $_POST['slct1'] == '16' ? 'selected' : '' }}>
                            {{ $lang['2'] }} (A = C), {{ $lang[3] }} a & {{ $lang[7] }} (K)</option>
                        <option value="17" {{ isset($_POST['slct1']) && $_POST['slct1'] == '17' ? 'selected' : '' }}>
                            {{ $lang['2'] }} (A = C), {{ $lang[3] }} b & {{ $lang[7] }} (K)</option>
                        <option value="18" {{ isset($_POST['slct1']) && $_POST['slct1'] == '18' ? 'selected' : '' }}>
                            {{ $lang['3'] }} a, {{ $lang[6] }} p & q</option>
                        <option value="19" {{ isset($_POST['slct1']) && $_POST['slct1'] == '19' ? 'selected' : '' }}>
                            {{ $lang['3'] }} b, {{ $lang[6] }} p & q</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="rad1" class="label" id="heading">{{ $lang[3] }} b =</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="rad1" id="rad1" class="input"
                        value="{{ isset($_POST['rad1']) ? $_POST['rad1'] : '7' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 side1">
                <label for="side1" class="label" id="heading2">{{ $lang[4] }} h =</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="side1" id="side1" class="input"
                        value="{{ isset($_POST['side1']) ? $_POST['side1'] : '4' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 d-none" id="buttler">
                <label for="side2" class="label" id="heading3">{{ $lang[4] }} h =</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="side2" id="side2" class="input"
                        value="{{ isset($_POST['side2']) ? $_POST['side2'] : '6' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="pi" class="label">pi π =</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="pi" id="pi" class="input"
                        value="{{ isset($_POST['pi']) ? $_POST['pi'] : '3.1415926535898' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="unit" class="label">{{ $lang['8'] }}:</label>
                <div class="w-100 py-2">
                    <select name="unit" class="input" id="unit" aria-label="select">
                        <option value="cm">cm</option>
                        <option value="m" {{ isset($_POST['unit']) && $_POST['unit'] == 'm' ? 'selected' : '' }}>m
                        </option>
                        <option value="in" {{ isset($_POST['unit']) && $_POST['unit'] == 'in' ? 'selected' : '' }}>in
                        </option>
                        <option value="ft" {{ isset($_POST['unit']) && $_POST['unit'] == 'ft' ? 'selected' : '' }}>ft
                        </option>
                        <option value="yd" {{ isset($_POST['unit']) && $_POST['unit'] == 'yd' ? 'selected' : '' }}>yd
                        </option>
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                            @if ($_POST['slct1'] == 1)
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['c2'] . '°' }}</td>
                                </tr>
                            @elseif ($_POST['slct1']==2)
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['c1'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . '°' }}</td>
                                </tr>
                            @elseif($_POST['slct1']=="3")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['h'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['c2'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                            @elseif($_POST['slct1']=="4")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $detail['a'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['b'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                            @elseif($_POST['slct1']=="5")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $detail['b'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} P:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                            @elseif($_POST['slct1']=="6")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $detail['a'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} P:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                            @elseif($_POST['slct1']=="7")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} P:</strong></td>
                                    <td class="py-2 border-b">{{ $detail['p'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                            @elseif($_POST['slct1']=="8")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['h'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($_POST['slct1']=="9")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $detail['b'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($_POST['slct1']=="10")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['k'] . ' ' . $_POST['unit'] }}<sup class="font-s-14">2</sup></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                            @elseif($_POST['slct1']=="11")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['calculate'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side2'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['p'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['q'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['h'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['P'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['k'] . ' ' . $_POST['unit'] }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($_POST['slct1']=="12")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['calculate'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side2'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['q'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['h'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['P'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['h'] * $_POST['side1'] . ' ' . $_POST['unit'] }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($_POST['slct1']=="13")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['a'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['b'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['p'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side2'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['h'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['P'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['h'] * $_POST['side1'] . ' ' . $_POST['unit'] }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($_POST['slct1']=="14")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['a'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['b'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['p'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['q'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side2'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['P'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['k'] . ' ' . $_POST['unit'] }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($_POST['slct1']=="15")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['a'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['b'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['p'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['q'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['h'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['P'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side2'] . ' ' . $_POST['unit'] }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($_POST['slct1']=="16")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['b_angle'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $detail['b'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['p'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['q'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['h'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['P'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side2'] . ' ' . $_POST['unit'] }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($_POST['slct1']=="17")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['b_angle'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $detail['a'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['p'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['q'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['h'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['P'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side2'] . ' ' . $_POST['unit'] }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($_POST['slct1']=="18")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['a'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['b_angle'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $detail['sq'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side2'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['h'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['P'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['k'] . ' ' . $_POST['unit'] }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @elseif($_POST['slct1']=="19")
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} A = C =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['an'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[9] }} B = D =</strong></td>
                                    <td class="py-2 border-b">{{ $detail['b_angle'] . '°' }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[10] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $detail['sq'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[11] }}:</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['rad1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (p):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side1'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[6] }} (q):</strong></td>
                                    <td class="py-2 border-b">{{ $_POST['side2'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} (h):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['h'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[5] }} (P):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['P'] . ' ' . $_POST['unit'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[7] }} (k):</strong></td>
                                    <td class="py-2 border-b">{{ $detail['k'] . ' ' . $_POST['unit'] }}<sup class="font-s-14">2</sup></td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        @isset($_POST['slct1'])
            <script>
                var val1='{{$_POST['slct1']}}';
                if (val1 === '1') {
                    document.getElementById('heading').textContent = "Angle A = C (°):";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (val1 === '2') {
                    document.getElementById('heading').textContent = "Angle B = D (°):";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (val1 === '3') {
                    document.getElementById('heading').textContent = "Angle A = C (°):";
                    document.getElementById('heading2').textContent = "Side Length a:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (val1 === '4') {
                    document.getElementById('heading').textContent = "Angle A = C (°):";
                    document.getElementById('heading2').textContent = "Height h:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (val1 === '5') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Perimeter P:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (val1 === '6') {
                    document.getElementById('heading').textContent = "Side Length b:";
                    document.getElementById('heading2').textContent = "Perimeter P:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (val1 === '7') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Side Length b:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (val1 === '8') {
                    document.getElementById('heading').textContent = "Side Length b:";
                    document.getElementById('heading2').textContent = "Area K:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (val1 === '9') {
                    document.getElementById('heading').textContent = "Height h:";
                    document.getElementById('heading2').textContent = "Area K:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (val1 === '10') {
                    document.getElementById('heading').textContent = "Side Length b:";
                    document.getElementById('heading2').textContent = "Height h:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (val1 === '11') {
                    document.getElementById('heading').textContent = "Angle A = C (°):";
                    document.getElementById('heading2').textContent = "Side Lenght a:";
                    document.getElementById('heading3').textContent = "Side Lenght b:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (val1 === '12') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Side Lenght b:";
                    document.getElementById('heading3').textContent = "Diagonal p:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (val1 === '13') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Side Lenght b:";
                    document.getElementById('heading3').textContent = "Diagonal q:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (val1 === '14') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Side Lenght b:";
                    document.getElementById('heading3').textContent = "Height h:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (val1 === '15') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Side Lenght b:";
                    document.getElementById('heading3').textContent = "Area K:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (val1 === '16') {
                    document.getElementById('heading').textContent = "Angle A = C (°):";
                    document.getElementById('heading2').textContent = "Side Lenght a:";
                    document.getElementById('heading3').textContent = "Area K:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (val1 === '17') {
                    document.getElementById('heading').textContent = "Angle A = C (°):";
                    document.getElementById('heading2').textContent = "Side Lenght b:";
                    document.getElementById('heading3').textContent = "Area K:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (val1 === '18') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Diagonal p:";
                    document.getElementById('heading3').textContent = "Diagonal q:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else {
                    document.getElementById('heading').textContent = "Side Length b:";
                    document.getElementById('heading2').textContent = "Diagonal p:";
                    document.getElementById('heading3').textContent = "Diagonal q:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }
            </script>
        @endisset
        <script>
            document.getElementById('slct1').addEventListener('change', function() {
                var change = this.value;
                if (change === '1') {
                    document.getElementById('heading').textContent = "Angle A = C (°):";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (change === '2') {
                    document.getElementById('heading').textContent = "Angle B = D (°):";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (change === '3') {
                    document.getElementById('heading').textContent = "Angle A = C (°):";
                    document.getElementById('heading2').textContent = "Side Length a:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (change === '4') {
                    document.getElementById('heading').textContent = "Angle A = C (°):";
                    document.getElementById('heading2').textContent = "Height h:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (change === '5') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Perimeter P:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (change === '6') {
                    document.getElementById('heading').textContent = "Side Length b:";
                    document.getElementById('heading2').textContent = "Perimeter P:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (change === '7') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Side Length b:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (change === '8') {
                    document.getElementById('heading').textContent = "Side Length b:";
                    document.getElementById('heading2').textContent = "Area K:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (change === '9') {
                    document.getElementById('heading').textContent = "Height h:";
                    document.getElementById('heading2').textContent = "Area K:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (change === '10') {
                    document.getElementById('heading').textContent = "Side Length b:";
                    document.getElementById('heading2').textContent = "Height h:";
                    ['.side1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else if (change === '11') {
                    document.getElementById('heading').textContent = "Angle A = C (°):";
                    document.getElementById('heading2').textContent = "Side Lenght a:";
                    document.getElementById('heading3').textContent = "Side Lenght b:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (change === '12') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Side Lenght b:";
                    document.getElementById('heading3').textContent = "Diagonal p:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (change === '13') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Side Lenght b:";
                    document.getElementById('heading3').textContent = "Diagonal q:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (change === '14') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Side Lenght b:";
                    document.getElementById('heading3').textContent = "Height h:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (change === '15') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Side Lenght b:";
                    document.getElementById('heading3').textContent = "Area K:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (change === '16') {
                    document.getElementById('heading').textContent = "Angle A = C (°):";
                    document.getElementById('heading2').textContent = "Side Lenght a:";
                    document.getElementById('heading3').textContent = "Area K:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (change === '17') {
                    document.getElementById('heading').textContent = "Angle A = C (°):";
                    document.getElementById('heading2').textContent = "Side Lenght b:";
                    document.getElementById('heading3').textContent = "Area K:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (change === '18') {
                    document.getElementById('heading').textContent = "Side Length a:";
                    document.getElementById('heading2').textContent = "Diagonal p:";
                    document.getElementById('heading3').textContent = "Diagonal q:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else {
                    document.getElementById('heading').textContent = "Side Length b:";
                    document.getElementById('heading2').textContent = "Diagonal p:";
                    document.getElementById('heading3').textContent = "Diagonal q:";
                    ['.side1', '#buttler'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>
