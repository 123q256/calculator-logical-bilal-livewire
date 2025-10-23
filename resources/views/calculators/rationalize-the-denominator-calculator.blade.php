<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                @php $request = request();@endphp
                <div class="col-span-12 flex items-center justify-evenly">
                    <p class="font-s-14 text-blue"><strong><?= $lang[1] ?>:</strong></p>
                    <p id="fInput">
                        <input type="radio" name="type" id="first" value="first"
                            {{ isset($request->type) && $request->type === 'first' ? 'checked' : 'checked' }}>
                        <label for="first" class="font-s-14">{{ $lang['2'] }}</label>
                    </p>
                    <p id="sInput">
                        <input type="radio" name="type" id="second" value="second"
                            {{ isset($request->type) && $request->type === 'second' ? 'checked' : '' }}>
                        <label for="second" class="font-s-14">{{ $lang['3'] }}</label>
                    </p>
                </div>
                <div class="col-span-12 {{ isset($request->type) && $request->type === 'second' ? 'hidden' : '' }}" id="simpleMethod">
                    <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12 px-2">
                            <label for="operations" class="font-s-14 text-blue"><?= $lang['4'] ?></label>
                            <div class="w-100 py-2">
                                <select name="operations" class="input" id="operations" aria-label="select">
                                    <option value="1"><?= $lang[5] ?>/<?= $lang[5] ?></option>
                                    <option value="2"
                                        {{ isset($request->operations) && $request->operations == '2' ? 'selected' : '' }}>
                                        <?= $lang[6] ?>/<?= $lang[5] ?></option>
                                    <option value="3"
                                        {{ isset($request->operations) && $request->operations == '3' ? 'selected' : '' }}>
                                        <?= $lang[5] ?>/<?= $lang[6] ?></option>
                                    <option value="4"
                                        {{ isset($request->operations) && $request->operations == '4' ? 'selected' : '' }}>
                                        <?= $lang[6] ?>/<?= $lang[6] ?></option>
                                </select>
                            </div>
                        </div>
                            <p
                                class="col-span-12 text-[20px] mt-0 mt-lg-2 text-center show1 {{ isset($request->operations) && $request->operations !== '1' ? 'hidden' : '' }}">
                                \( \frac{a\sqrt[n]b}{x\sqrt[k]y} \ = \ ? \)
                            </p>
                            <p
                                class="col-span-12 text-[20px] mt-0 mt-lg-2 text-center show2 {{ isset($request->operations) && $request->operations == '2' ? '' : 'hidden' }}">
                                \( \frac{ a\sqrt[n]b+c\sqrt[m]d }{ x\sqrt[k]y } \ = \ ? \)
                            </p>
                            <p
                                class="col-span-12 text-[20px] mt-0 mt-lg-2 text-center show3 {{ isset($request->operations) && $request->operations == '3' ? '' : 'hidden' }}">
                                \( \frac{ a\sqrt{b} }{ x\sqrt{y}+z\sqrt{u} } \ = \ ? \)
                            </p>
                            <p
                                class="col-span-12 text-[20px] mt-0 mt-lg-2 text-center show4 {{ isset($request->operations) && $request->operations == '4' ? '' : 'hidden' }}">
                                \( \frac{ a\sqrt{b}+c\sqrt{d} }{ x\sqrt{y}+k\sqrt{u} } \ = \ ? \)
                            </p>
                          <p class="col-span-12"><strong><?= $lang[7] ?></strong></p>
                        <div class="col-span-4" id="aInput">
                            <label for="a" class="font-s-14 text-blue">a:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="a" id="a" class="input" aria-label="input"
                                    value="{{ isset($request->a) ? $request->a : '15' }}" />
                            </div>
                        </div>
                        <div class="col-span-4" id="bInput">
                            <label for="b" class="font-s-14 text-blue">b:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="b" id="b" class="input" aria-label="input"
                                    value="{{ isset($request->b) ? $request->b : '13' }}" />
                            </div>
                        </div>
                        <div class="col-span-4 {{ isset($request->operations) && ($request->operations == '3' || $request->operations == '4') ? 'hidden' : '' }}"
                            id="nInput">
                            <label for="n" class="font-s-14 text-blue">n:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="n" id="n" class="input" aria-label="input"
                                    value="{{ isset($request->n) ? $request->n : '11' }}" />
                            </div>
                        </div>
                        <div class="col-span-4 {{ isset($request->operations) && ($request->operations == '2' || $request->operations == '4') ? '' : 'hidden' }}"
                            id="cInput">
                            <label for="c" class="font-s-14 text-blue">c:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="c" id="c" class="input" aria-label="input"
                                    value="{{ isset($request->c) ? $request->c : '7' }}" />
                            </div>
                        </div>
                        <div class="col-span-4 {{ isset($request->operations) && ($request->operations == '2' || $request->operations == '4') ? '' : 'hidden' }}"
                            id="dInput">
                            <label for="d" class="font-s-14 text-blue">d:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="d" id="d" class="input" aria-label="input"
                                    value="{{ isset($request->d) ? $request->d : '5' }}" />
                            </div>
                        </div>
                        <div class="col-span-4 {{ isset($request->operations) && $request->operations == '2' ? '' : 'hidden' }}"
                            id="mInput">
                            <label for="m" class="font-s-14 text-blue">m:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="m" id="m" class="input"
                                    aria-label="input" value="{{ isset($request->m) ? $request->m : '4' }}" />
                            </div>
                        </div>
                        <p class="col-span-12"><strong><?= $lang[8] ?></strong></p>
                        <div class="col-span-4" id="xInput">
                            <label for="x" class="font-s-14 text-blue">x:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="x" id="x" class="input"
                                    aria-label="input" value="{{ isset($request->x) ? $request->x : '7' }}" />
                            </div>
                        </div>
                        <div class="col-span-4" id="yInput">
                            <label for="y" class="font-s-14 text-blue">y:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="y" id="y" class="input"
                                    aria-label="input" value="{{ isset($request->y) ? $request->y : '13' }}" />
                            </div>
                        </div>
                        <div class="col-span-4" id="kInput">
                            <label for="k" class="font-s-14 text-blue">k:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="k" id="k" class="input"
                                    aria-label="input" value="{{ isset($request->k) ? $request->k : '5' }}" />
                            </div>
                        </div>
                        <div class="col-span-4 {{ isset($request->operations) && ($request->operations == '3' || $request->operations == '4') ? '' : 'hidden' }}"
                            id="uInput">
                            <label for="u" class="font-s-14 text-blue">u:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="u" id="u" class="input"
                                    aria-label="input" value="{{ isset($request->u) ? $request->u : '5' }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 mt-0 mt-lg-2 {{ isset($request->type) && $request->type === 'second' ? '' : 'hidden' }}" id="advanceMethod">
                    <label for="n1" class="font-s-14 text-blue"><?=$lang[9]?>:</label>
                    <div class="w-100 py-2">
                        <input type="text" name="n1" id="n1" class="input" aria-label="input" value="{{ isset($request->n1) ? $request->n1 : 'x^3-2x+1' }}" />
                    </div>
                    <hr class="my-2">
                    <label for="d1" class="font-s-14 text-blue mt-2"><?=$lang[10]?>:</label>
                    <div class="w-100 py-2">
                        <input type="text" name="d1" id="d1" class="input" aria-label="input" value="{{ isset($request->d1) ? $request->d1 : 'x^2-1' }}" />
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
                        <div class="w-full">
                            @if ($request->type === 'first')
                                @php
                                    $operations = $detail['operations'];            
                                    $a = $detail['a'];
                                    $b = $detail['b'];
                                    $n = $detail['n'];
                                    $c = $detail['c'];
                                    $d = $detail['d'];
                                    $m = $detail['m'];
                                    $x = $detail['x'];
                                    $y = $detail['y'];
                                    $k = $detail['k'];
                                    $u = $detail['u'];
                                    $z = $detail['z'];
                                @endphp
                                <div class="w-full text-[16px]">
                                    <p class="mt-3 text-[18px]"><strong class="main_jawab"></strong></p>
                                    <p class="mt-3"><strong><?= $lang[12] ?>:</strong></p>
                                    <div class="w-full all_result">
                                        <p class="mt-3"></p>
                                    </div>
                                    <p class="mt-3">= &nbsp;&nbsp;&nbsp;&nbsp;<span class="main_jawab"></span></p>
                                </div>
                            @else
                                <div class="w-full text-[16px]">
                                    <p class="mt-3 text-[18px]"><strong>\( <?=$detail['main_ans']?> \)</strong></p>
                                    <p class="mt-3"><strong><?= $lang[12] ?>:</strong></p>
                                    <p class="mt-3">\( =<?=$detail['enter']?> \)</p>
                                    <p class="mt-3">\( =\dfrac{<?=$detail['up']?>}{<?=$detail['down']?>} \)</p>
                                    <p class="mt-3">\( =<?=$detail['main_ans']?> \)</p>
                                </div>
                            @endif
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @if (isset($detail) && $request->type == 'first')
            <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
            <script>
                function addHtml(argument) {
                    $('.all_result').append(argument);
                }

                function jawab(argument) {
                    $('.main_jawab').append(argument);
                }

                function roundPrice(rnum, rlength) {
                    var str = rnum.toString();
                    var myarr = str.split(".");
                    if (myarr.length == 1) {
                        var toTenths = rnum;
                    } else if (myarr.length == 2) {
                        var newnumber = Math.ceil(rnum * Math.pow(10, rlength - 1)) / Math.pow(10, rlength - 1);
                        var toTenths = newnumber.toFixed(rlength);
                    }
                    return toTenths;
                }

                function calculate() {
                    var expression = {{$operations}};
                    var a = {{$a}};
                    var b = {{$b}};
                    var c = {{$c}};
                    var d = {{$d}};
                    var n = {{$n}};
                    var m = {{$m}};
                    var x = {{$x}};
                    var y = {{$y}};
                    var k = {{$k}};
                    var z = {{$z}};
                    var u = {{$u}};
                    var newRoot = n;
                    var newRoot1st = n;
                    var newRoot2nd = m;
                    var newRootWrite, newRootWrite1st, newRootWrite2nd;
                    var simplification1st;
                    var nWrite = n;
                    var kWrite = k;
                    var mWrite = m;
                    var aWrite, aWrite2nd, xWrite, xWrite, bWrite, cWrite, dWrite, yWrite, uWrite, zWrite;
                    var reducedMultiplier;
                    var firstLine = '',
                        secondLine = '',
                        thirdLine = '',
                        lastLine = '';
                    var numInFront;
                    var expression1st;
                    var resultWritten1st = '<table class="font-s-16"><tr class="bn">';
                    var resultWritten2nd = '<table class="font-s-16"><tr class="bn">';
                    var resultWritten3rd = '<table class="font-s-16"><tr class="bn">';
                    var resultWritten4th = '';
                    var finalResult, finalResult1st, finalResult2nd, finalResult3rd, finalResult4th;
                    var signUp = ' + ';
                    var signUp2nd, signUp3rd;
                    var signDown = ' + ';
                    var signDownInverse = ' - ';
                    var showLastLine = true;
                    var oneSummand = false;
                    var sthChanged = false;
                    var a2nd;
                    var e, f, g, h, eWrite, fWrite, gWrite, hWrite;
                    var zAbs;
                    var kill3rd = false;
                    var kill4th = false;

                    if (expression > 2) {
                        n = 2;
                        m = 2;
                        k = 2;
                    }

                    if (n == 2) {
                        nWrite = '';
                    }
                    if (m == 2) {
                        mWrite = '';
                    }
                    if (k == 2) {
                        kWrite = '';
                    }

                    if (isNaN(a) || a == 1) {
                        a = 1;
                        aWrite = '';
                    } else if (b == 1) {
                        aWrite = a;
                    } else if (a == -1) {
                        aWrite = '-';
                    } else {
                        aWrite = a + ' * ';
                    }
                    if (isNaN(x) || x == 1) {
                        x = 1;
                        xWrite = '';
                    } else if (y == 1) {
                        xWrite = x;
                    } else if (x == -1) {
                        xWrite = '-';
                    } else {
                        xWrite = x + ' * ';
                    }
                    if (isNaN(c) || c == 1) {
                        c = 1;
                        cWrite = '';
                    } else if (d == 1) {
                        cWrite = c;
                    } else if (c == -1) {
                        cWrite = '-';
                    } else {
                        cWrite = c + ' * ';
                    }
                    if (isNaN(z) || z == 1) {
                        z = 1;
                        zWrite = '';
                    } else if (u == 1) {
                        zWrite = z;
                    } else if (z == -1) {
                        zWrite = '-';
                    } else {
                        zWrite = z + ' * ';
                    }

                    if (b == 1) {
                        bWrite = '';
                    } else {
                        bWrite = '<sup class="font-s-14">' + nWrite + '</sup>√' + b;
                    }
                    if (d == 1) {
                        dWrite = '';
                    } else {
                        dWrite = '<sup class="font-s-14">' + mWrite + '</sup>√' + d;
                    }
                    if (y == 1) {
                        yWrite = '';
                    } else {
                        yWrite = '<sup class="font-s-14">' + kWrite + '</sup>√' + y;
                    }
                    if (u == 1) {
                        uWrite = '';
                    } else {
                        uWrite = '√' + u;
                    }

                    if (a == 1 && b == 1) {
                        bWrite = 1;
                    }
                    if (c == 1 && d == 1) {
                        dWrite = 1;
                    }
                    if (x == 1 && y == 1) {
                        yWrite = 1;
                    }
                    if (z == 1 && u == 1) {
                        uWrite = 1;
                    }

                    if (c < 0) {
                        signUp = ' ';
                    }
                    if (z < 0) {
                        signDown = ' ';
                        signDownInverse = ' + ';
                    }

                    if (k == 2) {
                        reducedMultiplier = yWrite;
                    } else {
                        reducedMultiplier = '<sup class="font-s-14">' + k + '</sup>√(' + y + '<sup class="font-s-14">' + (k - 1) + '</sup>)';
                    }

                    ////////////////////////////////////////////////
                    /////////////////EXPRESSION 1///////////////////
                    ////////////////////////////////////////////////

                    if (expression == 1) {
                        if (!isNaN(b) && !isNaN(n) && !isNaN(y) && !isNaN(k)) {
                            resultWritten1st += '<td rowspan="3" class="py-2">=</td>';
                            resultWritten1st += '<td rowspan="3" class="bn py-2"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                '<br><hr noshade>' + xWrite + yWrite + '</th></table></td>';
                            // resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                            resultWritten1st += '</tr></table>';
                            addHtml(resultWritten1st);
                            resultWritten2nd += '<td  rowspan="3" class="py-2">=</td>';

                            //////////No need for rationalization/////////

                            if (isInteger(roundPrice(Math.pow(y, 1 / k), 4))) {
                                if (isInteger(roundPrice(Math.pow(b, 1 / n), 4))) {
                                    bWrite = roundPrice(Math.pow(b, 1 / n), 4);
                                    if (a == 1 && b == 1) {
                                        bWrite = 1;
                                    } else if (b == 1) {
                                        bWrite = '';
                                    }
                                    yWrite = roundPrice(Math.pow(y, 1 / k), 4);
                                    if (x == 1 && y == 1) {
                                        yWrite = 1;
                                    } else if (y == 1) {
                                        yWrite = '';
                                    }
                                    resultWritten2nd += '<td  rowspan="3" class="py-2"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                        '<br><hr noshade>' + xWrite + yWrite;
                                    resultWritten2nd += '<td class="py-2"  rowspan="3">=</td>';
                                    resultWritten2nd += '</th></table></td>';

                                    resultWritten3rd = roundPrice((a * Math.pow(b, 1 / n)) / (x * Math.pow(y, 1 / k)), 4);
                                    b = 1
                                } else {
                                    yWrite = roundPrice(Math.pow(y, 1 / k), 4);
                                    if (x == 1 && y == 1) {
                                        yWrite = 1;
                                    } else if (y == 1) {
                                        yWrite = '';
                                    }
                                    resultWritten2nd += '<td  rowspan="3" class="py-2"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                        '<br><hr noshade>' + xWrite + yWrite;
                                    // resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten2nd += '</th></table></td>';

                                    a = roundPrice(a / (x * Math.pow(y, 1 / k)), 4);
                                    if (a == 1) {
                                        aWrite = '';
                                    } else {
                                        aWrite = a + ' * ';
                                    }
                                    resultWritten3rd = aWrite + bWrite;
                                }
                                resultWritten2nd += '</tr></table>';
                                addHtml(resultWritten2nd);
                                jawab(resultWritten3rd);
                            }

                            ////////////////Rationalization///////////////
                            else {
                                if (isInteger(roundPrice(Math.pow(b, 1 / n), 4))) {
                                    bWrite = roundPrice(Math.pow(b, 1 / n), 4);
                                    if (a == 1 && b == 1) {
                                        bWrite = 1;
                                    } else if (b == 1) {
                                        bWrite = '';
                                    }
                                    a *= roundPrice(Math.pow(b, 1 / n), 4);
                                    b = 1;
                                }
                                resultWritten2nd += '<td class="py-2" rowspan="3" class="bn py-2"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                    '<br><hr noshade>' + xWrite + yWrite + '</th></table></td>';
                                resultWritten2nd += '<td  rowspan="3" class="py-2">*</td>';
                                resultWritten2nd += '<td  rowspan="3" class="py-2"><table><th class="py-2" rowspan="3">' + reducedMultiplier +
                                    '<br><hr noshade>' + reducedMultiplier + '</th></table></td>';
                                // resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                                newRoot = find_lcm(n, k);
                                if (newRoot == 2) {
                                    newRootWrite = '';
                                } else {
                                    newRootWrite = newRoot;
                                }
                                if (b != 1 && isInteger(roundPrice(Math.pow(b, 1 / n), 4))) {
                                    bWrite = '<sup class="font-s-14">' + newRootWrite + '</sup>√(' + Math.pow(b, newRoot / n);
                                    bWrite += ' * ';
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / n), 4))) {
                                    bWrite += ' * <sup class="font-s-14">' + newRootWrite + '</sup>√(';
                                } else {
                                    bWrite = '<sup class="font-s-14">' + newRootWrite + '</sup>√(' + bWrite;
                                }

                                resultWritten3rd += '<td  rowspan="3" class="py-2">=</td>';
                                resultWritten3rd += '<td  rowspan="3" class="py-2"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + Math
                                    .pow(y, ((k - 1) * newRoot) / k) + ')<br><hr noshade>' + xWrite + y + '</th></table></td>';
                                // resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';

                                a = roundPrice(a / (x * y), 4);
                                b = roundPrice(Math.pow(b, newRoot / n) * Math.pow(y, newRoot / k), 4);
                                n = newRoot;
                                if (a == 1) {
                                    aWrite = '';
                                } else if (a == -1) {
                                    aWrite = '-';
                                } else {
                                    aWrite = a + ' * ';
                                }
                                resultWritten4th += aWrite + '<sup class="font-s-14">' + newRootWrite + '</sup>√' + b;
                                finalResult = getSimplified(b, n);
                                if (finalResult[1] == n && finalResult[2] == b) {
                                    showLastLine = false;
                                }
                                finalResult[0] = roundPrice(finalResult[0] * a, 4);
                                if (finalResult[0] == 1 && finalResult[2] != 1) {
                                    finalResult[0] = '';
                                } else if (finalResult[0] == -1 && finalResult[2] != 1) {
                                    finalResult[0] = '-';
                                } else if (finalResult[2] != 1) {
                                    finalResult[0] += ' * ';
                                }
                                if (finalResult[1] == 2) {
                                    finalResult[1] = '';
                                }
                                if (finalResult[2] == 1) {
                                    finalResult[2] = '';
                                } else {
                                    finalResult[2] = '<sup class="font-s-14">' + finalResult[1] + '</sup>√' + finalResult[2];
                                }
                                if (showLastLine) {
                                    resultWritten4th += finalResult[0] + finalResult[2];
                                }
                                resultWritten2nd += '</tr></table>';
                                addHtml(resultWritten2nd);

                                resultWritten3rd += '</tr></table>';
                                addHtml(resultWritten3rd);

                                // addHtml(resultWritten4th);
                                jawab(resultWritten4th);
                            }
                        }
                    }

                    ////////////////////////////////////////////////
                    /////////////////EXPRESSION 2///////////////////
                    ////////////////////////////////////////////////
                    else if (expression == 2) {
                        if (!isNaN(b) && !isNaN(n) && !isNaN(d) && !isNaN(m) && !isNaN(y) && !isNaN(k)) {
                            resultWritten1st += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp + cWrite +
                                dWrite + '<br><hr noshade>' + xWrite + yWrite + '</th></table></td>';
                            // resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                            resultWritten1st += '</tr></table>';
                            addHtml(resultWritten1st);
                            resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                            //////////No need for rationalization/////////

                            if (isInteger(roundPrice(Math.pow(y, 1 / k), 4))) {
                                if (isInteger(roundPrice(Math.pow(b, 1 / n), 4)) && isInteger(roundPrice(Math.pow(d, 1 / m), 4))) {
                                    bWrite = roundPrice(Math.pow(b, 1 / n), 4);
                                    if (a == 1 && b == 1) {
                                        bWrite = 1;
                                    } else if (b == 1) {
                                        bWrite = '';
                                    }
                                    dWrite = roundPrice(Math.pow(d, 1 / m), 4);
                                    if (c == 1 && d == 1) {
                                        dWrite = 1;
                                    } else if (d == 1) {
                                        dWrite = '';
                                    }
                                    yWrite = roundPrice(Math.pow(y, 1 / k), 4);
                                    if (x == 1 && y == 1) {
                                        yWrite = 1;
                                    } else if (y == 1) {
                                        yWrite = '';
                                    }
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                        cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite;
                                    // resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten2nd += '</th></table></td>';

                                    resultWritten3rd = roundPrice((a * Math.pow(b, 1 / n) + c * Math.pow(d, 1 / m)) / (x * Math.pow(
                                        y, 1 / k)), 4);

                                    addHtml(resultWritten2nd);
                                    resultWritten2nd += '</tr></table>';
                                    addHtml(resultWritten2nd);
                                    // addHtml(resultWritten3rd);
                                    jawab(resultWritten3rd);
                                    return;
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / n), 4))) {
                                    bWrite = roundPrice(Math.pow(b, 1 / n), 4);
                                    if (a == 1 && b == 1) {
                                        bWrite = 1;
                                    } else if (b == 1) {
                                        bWrite = '';
                                    }
                                    yWrite = roundPrice(Math.pow(y, 1 / k), 4);
                                    if (x == 1 && y == 1) {
                                        yWrite = 1;
                                    } else if (y == 1) {
                                        yWrite = '';
                                    }
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                        cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite;
                                    // resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten2nd += '</th></table></td>';

                                    resultWritten3rd = roundPrice((a * Math.pow(b, 1 / n)) / (x * Math.pow(y, 1 / k)), 4);
                                    c /= roundPrice(x * Math.pow(y, 1 / k), 4);
                                    b = 1;
                                    if (c < 0) {
                                        signUp = ' ';
                                    } else {
                                        signUp = ' + ';
                                    }
                                    if (c == 1) {
                                        cWrite = '';
                                    } else if (c == -1) {
                                        cWrite = '-';
                                    } else {
                                        cWrite = roundPrice(c, 5) + ' * ';
                                    }
                                    resultWritten3rd += signUp + cWrite + dWrite;
                                    resultWritten2nd += '</tr></table>';
                                    addHtml(resultWritten2nd);
                                    jawab(resultWritten3rd);
                                } else if (isInteger(roundPrice(Math.pow(d, 1 / m), 4))) {
                                    dWrite = roundPrice(Math.pow(d, 1 / m), 4);
                                    if (c == 1 && d == 1) {
                                        dWrite = 1;
                                    } else if (d == 1) {
                                        dWrite = '';
                                    }
                                    yWrite = roundPrice(Math.pow(y, 1 / k), 4);
                                    if (x == 1 && y == 1) {
                                        yWrite = 1;
                                    } else if (y == 1) {
                                        yWrite = '';
                                    }
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                        cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite;
                                    // resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten2nd += '</th></table></td>';

                                    a = roundPrice(a / (x * Math.pow(y, 1 / k)), 4);
                                    c = roundPrice((c * Math.pow(d, 1 / m)) / (x * Math.pow(y, 1 / k)), 4);
                                    d = 1;
                                    if (c < 0) {
                                        signUp = ' ';
                                    } else {
                                        signUp = ' + ';
                                    }
                                    if (a == 1) {
                                        aWrite = '';
                                    } else if (a == -1) {
                                        aWrite = '-';
                                    } else {
                                        aWrite = a + ' * ';
                                    }
                                    resultWritten3rd = aWrite + bWrite + signUp + c;
                                    resultWritten2nd += '</tr></table>';
                                    addHtml(resultWritten2nd);
                                    jawab(resultWritten3rd);
                                } else {
                                    yWrite = roundPrice(Math.pow(y, 1 / k), 4);
                                    if (x == 1 && y == 1) {
                                        yWrite = 1;
                                    } else if (y == 1) {
                                        yWrite = '';
                                    }
                                    if (n == m && b == d) {
                                        oneSummand = true;
                                        a += c;
                                        if (a == 1) {
                                            aWrite = '';
                                        } else {
                                            aWrite = a + ' * ';
                                        }
                                        resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                            '<br><hr noshade>' + xWrite + yWrite;
                                        // resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                        resultWritten2nd += '</th></table></td>';

                                        a = roundPrice(a / (x * Math.pow(y, 1 / k)), 4);
                                        if (a == 1) {
                                            aWrite = '';
                                        } else {
                                            aWrite = a + ' * ';
                                        }
                                        resultWritten3rd = aWrite + bWrite;
                                        resultWritten2nd += '</tr></table>';
                                        addHtml(resultWritten2nd);
                                        jawab(resultWritten3rd);
                                    } else {
                                        resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                            cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite;
                                        // resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                        resultWritten2nd += '</th></table></td>';

                                        a = roundPrice(a / (x * Math.pow(y, 1 / k)), 4);
                                        c = roundPrice(c / (x * Math.pow(y, 1 / k)), 4);
                                        if (a == 1) {
                                            aWrite = '';
                                        } else {
                                            aWrite = a + ' * ';
                                        }
                                        if (c == 1) {
                                            cWrite = '';
                                        } else {
                                            cWrite = c + ' * ';
                                        }
                                        if (c < 0) {
                                            signUp = ' ';
                                        } else {
                                            signUp = ' + ';
                                        }
                                        resultWritten3rd = aWrite + bWrite + signUp + cWrite + dWrite;
                                        resultWritten2nd += '</tr></table>';
                                        addHtml(resultWritten2nd);
                                        jawab(resultWritten3rd);
                                    }
                                }
                            }

                            ////////////////Rationalization///////////////
                            else {
                                if (isInteger(roundPrice(Math.pow(b, 1 / n), 4)) && isInteger(roundPrice(Math.pow(d, 1 / m), 4))) {
                                    oneSummand = true;
                                    bWrite = roundPrice(Math.pow(b, 1 / n), 4);
                                    if (a == 1 && b == 1) {
                                        bWrite = 1;
                                    } else if (b == 1) {
                                        bWrite = '';
                                    }
                                    dWrite = roundPrice(Math.pow(d, 1 / m), 4);
                                    if (c == 1 && d == 1) {
                                        dWrite = 1;
                                    } else if (d == 1) {
                                        dWrite = '';
                                    }
                                    a = roundPrice(a * Math.pow(b, 1 / n) + c * Math.pow(d, 1 / m), 4);
                                    b = 1;
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / n), 4))) {
                                    bWrite = roundPrice(Math.pow(b, 1 / n), 4);
                                    if (a == 1 && b == 1) {
                                        bWrite = 1;
                                    } else if (b == 1) {
                                        bWrite = '';
                                    }
                                    a = roundPrice(a * Math.pow(b, 1 / n), 4);
                                    b = 1;
                                } else if (isInteger(roundPrice(Math.pow(d, 1 / m), 4))) {
                                    dWrite = roundPrice(Math.pow(d, 1 / m), 4);
                                    if (c == 1 && d == 1) {
                                        dWrite = 1;
                                    } else if (d == 1) {
                                        dWrite = '';
                                    }
                                    c = roundPrice(c * Math.pow(d, 1 / m), 4);
                                    d = 1;
                                }
                                resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp + cWrite +
                                    dWrite + '<br><hr noshade>' + xWrite + yWrite + '</th></table></td>';

                                resultWritten2nd += '<td class="py-2" rowspan="3">*</td>';
                                resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + reducedMultiplier +
                                    '<br><hr noshade>' + reducedMultiplier + '</th></table></td>';
                                // resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                                if (a == 1 && b != 1) {
                                    aWrite = '';
                                } else if (a == -1 && b != -1) {
                                    aWrite = '-';
                                } else if (b != 1) {
                                    aWrite = a + ' * ';
                                } else {
                                    aWrite = a;
                                }
                                if (c == 1) {
                                    cWrite = '';
                                } else if (d != 1) {
                                    cWrite = c + ' * ';
                                } else {
                                    cWrite = c;
                                }

                                newRoot1st = find_lcm(n, k);
                                newRoot2nd = find_lcm(m, k);
                                if (newRoot1st == 2) {
                                    newRootWrite1st = '';
                                } else {
                                    newRootWrite1st = newRoot1st;
                                }
                                if (newRoot2nd == 2) {
                                    newRootWrite2nd = '';
                                } else {
                                    newRootWrite2nd = newRoot2nd;
                                }
                                if (b != 1 && isInteger(roundPrice(Math.pow(b, 1 / n), 4))) {
                                    bWrite = '<sup class="font-s-14">' + newRootWrite1st + '</sup>√(' + Math.pow(b, newRoot1st / n);
                                    bWrite += ' * ';
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / n), 4))) {
                                    bWrite = ' * <sup class="font-s-14">' + newRootWrite1st + '</sup>√(';
                                } else {
                                    bWrite = '<sup class="font-s-14">' + newRootWrite1st + '</sup>√(' + bWrite;
                                }
                                if (d != 1 && isInteger(roundPrice(Math.pow(d, 1 / m), 4))) {
                                    dWrite = '<sup class="font-s-14">' + newRootWrite2nd + '</sup>√(' + Math.pow(d, newRoot2nd / m);
                                    dWrite += ' * ';
                                } else if (isInteger(roundPrice(Math.pow(d, 1 / m), 4))) {
                                    dWrite = ' * <sup class="font-s-14">' + newRootWrite2nd + '</sup>√(';
                                } else {
                                    dWrite = '<sup class="font-s-14">' + newRootWrite2nd + '</sup>√(' + dWrite;
                                }

                                resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';
                                resultWritten3rd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + Math.pow(y,
                                    newRoot1st / k) + ')';
                                if (!oneSummand) {
                                    resultWritten3rd += signUp + cWrite + dWrite + Math.pow(y, newRoot2nd / k) + ')';
                                }
                                resultWritten3rd += '<br><hr noshade>' + xWrite + y + '</th></table></td>';
                                // resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';

                                a = roundPrice(a / (x * y), 4);
                                c = roundPrice(c / (x * y), 4);
                                b = roundPrice(Math.pow(b, newRoot1st / n) * Math.pow(y, newRoot1st / k), 4);
                                d = roundPrice(Math.pow(d, newRoot2nd / m) * Math.pow(y, newRoot2nd / k), 4);
                                n = newRoot1st;
                                m = newRoot2nd;
                                if (a == 1) {
                                    aWrite = '';
                                } else if (a == -1) {
                                    aWrite = '-';
                                } else {
                                    aWrite = a + ' * ';
                                }
                                if (c == 1) {
                                    cWrite = '';
                                } else if (c == -1) {
                                    cWrite = '-';
                                } else {
                                    cWrite = c + ' * ';
                                }
                                if (c < 0) {
                                    signUp = ' ';
                                } else {
                                    signUp = ' + ';
                                }
                                resultWritten4th += aWrite + '<sup class="font-s-14">' + newRootWrite1st + '</sup>√' + b;
                                if (!oneSummand) {
                                    resultWritten4th += signUp + cWrite + '<sup class="font-s-14">' + newRootWrite2nd + '</sup>√' + d;
                                }
                                finalResult1st = getSimplified(b, n);
                                finalResult2nd = getSimplified(d, m);
                                if (finalResult1st[1] == n && finalResult1st[2] == b && finalResult2nd[1] == m && finalResult2nd[
                                    2] == d) {
                                    showLastLine = false;
                                }
                                finalResult1st[0] = roundPrice(finalResult1st[0] * a, 4);
                                finalResult2nd[0] = roundPrice(finalResult2nd[0] * c, 4);
                                if (finalResult1st[0] == 1 && finalResult1st[2] != 1) {
                                    finalResult1st[0] = '';
                                } else if (finalResult1st[0] == -1 && finalResult1st[2] != 1) {
                                    finalResult1st[0] = '-';
                                } else if (finalResult1st[2] != 1) {
                                    finalResult1st[0] += ' * ';
                                }
                                if (finalResult2nd[0] == 1 && finalResult2nd[2] != 1) {
                                    finalResult2nd[0] = '';
                                } else if (finalResult2nd[0] == -1 && finalResult2nd[2] != 1) {
                                    finalResult2nd[0] = '-';
                                } else if (finalResult2nd[2] != 1) {
                                    finalResult2nd[0] += ' * ';
                                }
                                if (finalResult1st[1] == 2) {
                                    finalResult1st[1] = '';
                                }
                                if (finalResult2nd[1] == 2) {
                                    finalResult2nd[1] = '';
                                }
                                if (finalResult1st[2] == 1) {
                                    finalResult1st[2] = '';
                                } else {
                                    finalResult1st[2] = '<sup class="font-s-14">' + finalResult1st[1] + '</sup>√' + finalResult1st[2];
                                }
                                if (finalResult2nd[2] == 1) {
                                    finalResult2nd[2] = '';
                                } else {
                                    finalResult2nd[2] = '<sup class="font-s-14">' + finalResult2nd[1] + '</sup>√' + finalResult2nd[2];
                                }
                                if (showLastLine) {
                                    resultWritten4th += finalResult1st[0] + finalResult1st[2];
                                    if (!oneSummand) {
                                        resultWritten4th += signUp + finalResult2nd[0] + finalResult2nd[2];
                                    }
                                }

                                resultWritten2nd += '</tr></table>';
                                addHtml(resultWritten2nd);

                                resultWritten3rd += '</tr></table>';
                                addHtml(resultWritten3rd);

                                // addHtml(resultWritten4th);
                                jawab(resultWritten4th);
                            }
                        }
                    }

                    ////////////////////////////////////////////////
                    /////////////////EXPRESSION 3///////////////////
                    ////////////////////////////////////////////////
                    else if (expression == 3) {
                        if (!isNaN(b) && !isNaN(y) && !isNaN(u)) {
                            resultWritten1st += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + '<br><hr noshade>' +
                                xWrite + yWrite + signDown + zWrite + uWrite + '</th></table></td>';
                            resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                            //////////No need for rationalization/////////

                            if (isInteger(roundPrice(Math.pow(y, 1 / 2), 4)) && isInteger(roundPrice(Math.pow(u, 1 / 2), 4))) {
                                yWrite = roundPrice(Math.pow(y, 1 / 2), 4);
                                if (x == 1 && y == 1) {
                                    yWrite = 1;
                                } else if (y == 1) {
                                    yWrite = '';
                                }
                                uWrite = roundPrice(Math.pow(u, 1 / 2), 4);
                                if (z == 1 && u == 1) {
                                    uWrite = 1;
                                } else if (u == 1) {
                                    uWrite = '';
                                }
                                if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4))) {
                                    resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten1st += '</tr></table>';
                                    addHtml(resultWritten1st);
                                    bWrite = roundPrice(Math.pow(b, 1 / 2), 4);
                                    if (a == 1 && b == 1) {
                                        bWrite = 1;
                                    } else if (b == 1) {
                                        bWrite = '';
                                    }
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                        '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite;
                                    resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten2nd += '</th></table></td>';

                                    resultWritten3rd = '= ' + roundPrice((a * Math.pow(b, 1 / 2)) / (x * Math.pow(y, 1 / 2) + z *
                                        Math.pow(u, 1 / 2)), 4);
                                    addHtml(resultWritten2nd);
                                    addHtml(resultWritten3rd);
                                    return;
                                } else {
                                    resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten1st += '</tr></table>';
                                    addHtml(resultWritten1st);
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                        '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite;
                                    resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten2nd += '</th></table></td>';

                                    a = roundPrice(a / (x * Math.pow(y, 1 / 2) + z * Math.pow(u, 1 / 2)), 4);
                                    if (a == 1) {
                                        aWrite = '';
                                    } else {
                                        aWrite = a + ' * ';
                                    }
                                    resultWritten3rd = '= ' + aWrite + bWrite;
                                }
                            }

                            ////////////////Rationalization///////////////
                            else if (y == u) {
                                resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                resultWritten1st += '</tr></table>';
                                addHtml(resultWritten1st);
                                y += u;
                                if (y == 1) {
                                    yWrite = '';
                                } else {
                                    yWrite = y + ' * ';
                                }
                                if (b == 1) {
                                    bWrite = '';
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4))) {
                                    bWrite = roundPrice(Math.pow(b, 1 / 2), 4);
                                    a *= roundPrice(Math.pow(b, 1 / 2), 4);
                                    b = 1;
                                }
                                resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                    '<br><hr noshade>' + xWrite + yWrite + '</th></table></td>';

                                resultWritten2nd += '<td class="py-2" rowspan="3">*</td>';
                                resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + reducedMultiplier +
                                    '<br><hr noshade>' + reducedMultiplier + '</th></table></td>';
                                resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                                if (b != 1 && isInteger(roundPrice(Math.pow(b, 1 / 2), 4))) {
                                    bWrite = '√(' + b;
                                    bWrite += ' * ';
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4))) {
                                    bWrite += '√(';
                                } else {
                                    bWrite = '√(' + bWrite;
                                }

                                resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';
                                resultWritten3rd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + y +
                                    ')<br><hr noshade>' + xWrite + y + '</th></table></td>';
                                resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';

                                a = roundPrice(a / (x * y), 4);
                                b = roundPrice(b * y, 4);
                                if (a == 1) {
                                    aWrite = '';
                                } else {
                                    aWrite = a + ' * ';
                                }
                                resultWritten4th += aWrite + '√' + b;
                            } else {
                                if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4))) {
                                    if (b == 1) {
                                        bWrite = '';
                                        aWrite = a;
                                    } else {
                                        sthChanged = true;
                                        bWrite = roundPrice(Math.pow(b, 1 / 2), 4);
                                        a *= roundPrice(Math.pow(b, 1 / 2), 4);
                                        b = 1;
                                    }
                                }
                                if (isInteger(roundPrice(Math.pow(y, 1 / 2), 4))) {
                                    if (y == 1) {
                                        yWrite = '';
                                        xWrite = x;
                                    } else {
                                        sthChanged = true;
                                        yWrite = roundPrice(Math.pow(y, 1 / 2), 4);
                                        x *= roundPrice(Math.pow(y, 1 / 2), 4);
                                        y = 1;
                                    }
                                }
                                if (isInteger(roundPrice(Math.pow(u, 1 / 2), 4))) {
                                    if (u == 1) {
                                        uWrite = '';
                                        zWrite = z;
                                    } else {
                                        sthChanged = true;
                                        uWrite = roundPrice(Math.pow(u, 1 / 2), 4);
                                        z *= roundPrice(Math.pow(u, 1 / 2), 4);
                                        u = 1;
                                    }
                                }
                                if (sthChanged) {
                                    resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten1st += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                        '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite + '</th></table></td>';
                                    if (b == 1) {
                                        bWrite = ''
                                        aWrite = a;
                                    }
                                    if (y == 1) {
                                        yWrite = ''
                                        xWrite = x;
                                    }
                                    if (u == 1) {
                                        uWrite = ''
                                        zWrite = z;
                                    }
                                }
                                zAbs = Math.abs(z);
                                if (zAbs == 1 && u != 1) {
                                    zAbs = '';
                                } else if (u != 1) {
                                    zAbs += ' * ';
                                }
                                // resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                resultWritten1st += '</tr></table>';
                                addHtml(resultWritten1st);

                                resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                    '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite + '</th></table></td>';

                                resultWritten2nd += '<td class="py-2" rowspan="3">*</td>';
                                resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + xWrite + yWrite + signDownInverse +
                                    zAbs + uWrite + '<br><hr noshade>' + xWrite + yWrite + signDownInverse + zAbs + uWrite +
                                    '</th></table></td>';
                                // resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                                if (b != 1 && isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && y != 1) {
                                    bWrite = '√(' + b;
                                    bWrite += ' * ' + y + ')';
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && y != 1) {
                                    bWrite = ' * √' + y;
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && y == 1) {
                                    bWrite = '√' + b;
                                } else {
                                    bWrite = '';
                                }

                                if (b != 1 && isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && u != 1) {
                                    dWrite = '√(' + b;
                                    dWrite += ' * ' + u + ')';
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && u != 1) {
                                    dWrite = ' * √' + u;
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && u == 1) {
                                    dWrite = '√' + b;
                                } else {
                                    dWrite = '';
                                }

                                a2nd = a * z;
                                a *= x;
                                if (z > 0) {
                                    a2nd *= (-1);
                                }
                                if (a2nd == 1) {
                                    aWrite2nd = '';
                                } else if (a2nd == -1) {
                                    aWrite2nd = '-';
                                } else {
                                    aWrite2nd = a2nd;
                                }
                                if (a2nd < 0) {
                                    signUp = ' ';
                                } else {
                                    signUp = ' + ';
                                }
                                if (a == 1 && bWrite != '') {
                                    aWrite = '';
                                } else if (a == 1 && bWrite == '') {
                                    aWrite = 1;
                                } else if (a != 1 && bWrite == '') {
                                    aWrite = a;
                                } else {
                                    aWrite = a + ' * ';
                                }
                                if (a2nd == 1 && dWrite != '') {
                                    aWrite2nd = '';
                                } else if (a2nd == 1 && dWrite == '') {
                                    aWrite2nd = 1;
                                } else {
                                    aWrite2nd = a2nd;
                                }

                                resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';
                                resultWritten3rd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp;
                                resultWritten3rd += aWrite2nd + dWrite + '<br><hr noshade>' + roundPrice(x * x * y, 4) + ' - ' +
                                    roundPrice(z * z * u, 4) + '</th></table></td>';
                                // resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';

                                a = roundPrice((a) / (x * x * y - z * z * u), 4);
                                a2nd = roundPrice((a2nd) / (x * x * y - z * z * u), 4);
                                b = roundPrice(b * y, 4);
                                d = roundPrice(b * u, 4);
                                if (a == 1 && b != 1) {
                                    aWrite = '';
                                } else if (a == -1 && b != -1) {
                                    aWrite = '-';
                                } else if (b != 1) {
                                    aWrite = a + ' * ';
                                } else {
                                    aWrite = a;
                                }
                                if (a2nd == 1 && d != 1) {
                                    aWrite2nd = '';
                                } else if (a2nd == -1 && d != 1) {
                                    aWrite2nd = '-';
                                } else if (d != 1) {
                                    aWrite2nd = a2nd + ' * ';
                                } else {
                                    aWrite2nd = a2nd;
                                }
                                if ((x * x * y - z * z * u < 0 && signUp == ' ') || (x * x * y - z * z * u > 0 && signUp ==
                                    ' + ')) {
                                    signUp = ' + ';
                                } else {
                                    signUp = ' ';
                                }
                                if (b != 1) {
                                    bWrite = '√' + b;
                                }
                                if (d != 1) {
                                    dWrite = '√' + d;
                                }
                                resultWritten4th += aWrite + bWrite + signUp + aWrite2nd + dWrite;

                                finalResult1st = getSimplified(b, 2);
                                finalResult2nd = getSimplified(d, 2);

                                if (finalResult1st[1] == n && finalResult1st[2] == b && finalResult2nd[1] == m && finalResult2nd[
                                    2] == d) {
                                    showLastLine = false;
                                }
                                finalResult1st[0] = roundPrice(finalResult1st[0] * a, 4);
                                finalResult2nd[0] = roundPrice(finalResult2nd[0] * a2nd, 4);
                                if (finalResult1st[0] == 1 && finalResult1st[2] != 1) {
                                    finalResult1st[0] = '';
                                } else if (finalResult1st[0] == -1 && finalResult1st[2] != 1) {
                                    finalResult1st[0] = '-';
                                } else if (finalResult1st[2] != 1) {
                                    finalResult1st[0] += ' * ';
                                }
                                if (finalResult2nd[0] == 1 && finalResult2nd[2] != 1) {
                                    finalResult2nd[0] = '';
                                } else if (finalResult2nd[0] == -1 && finalResult1nd[2] != 1) {
                                    finalResult2nd[0] = '-';
                                } else if (finalResult2nd[2] != 1) {
                                    finalResult2nd[0] += ' * ';
                                }
                                finalResult1st[1] = '';
                                finalResult2nd[1] = '';
                                if (finalResult1st[2] == 1) {
                                    finalResult1st[2] = '';
                                } else {
                                    finalResult1st[2] = '<sup class="font-s-14">' + finalResult1st[1] + '</sup>√' + finalResult1st[2];
                                }
                                if (finalResult2nd[2] == 1) {
                                    finalResult2nd[2] = '';
                                } else {
                                    finalResult2nd[2] = '<sup class="font-s-14">' + finalResult2nd[1] + '</sup>√' + finalResult2nd[2];
                                }
                                if (showLastLine) {
                                    resultWritten4th += finalResult1st[0] + finalResult1st[2] + signUp + finalResult2nd[0] +
                                        finalResult2nd[2];
                                }
                            }

                            resultWritten2nd += '</tr></table>';
                            addHtml(resultWritten2nd);

                            resultWritten3rd += '</tr></table>';
                            addHtml(resultWritten3rd);

                            // addHtml(resultWritten4th);
                            jawab(resultWritten4th);
                        }
                    }

                    ////////////////////////////////////////////////
                    /////////////////EXPRESSION 4///////////////////
                    ////////////////////////////////////////////////
                    else if (expression == 4) {
                        if (!isNaN(b) && !isNaN(d) && !isNaN(y) && !isNaN(u)) {
                            resultWritten1st += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp + cWrite +
                                dWrite + '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite + '</th></table></td>';
                            resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                            resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                            //////////No need for rationalization/////////

                            if (isInteger(roundPrice(Math.pow(y, 1 / 2), 4)) && isInteger(roundPrice(Math.pow(u, 1 / 2), 4))) {
                                addHtml(resultWritten1st);
                                yWrite = roundPrice(Math.pow(y, 1 / 2), 4);
                                if (x == 1 && y == 1) {
                                    yWrite = 1;
                                } else if (y == 1) {
                                    yWrite = '';
                                }
                                uWrite = roundPrice(Math.pow(u, 1 / 2), 4);
                                if (z == 1 && u == 1) {
                                    uWrite = 1;
                                } else if (u == 1) {
                                    uWrite = '';
                                }
                                if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && isInteger(roundPrice(Math.pow(d, 1 / 2), 4))) {
                                    bWrite = roundPrice(Math.pow(b, 1 / 2), 4);
                                    if (a == 1 && b == 1) {
                                        bWrite = 1;
                                    } else if (b == 1) {
                                        bWrite = '';
                                    }
                                    dWrite = roundPrice(Math.pow(d, 1 / 2), 4);
                                    if (c == 1 && d == 1) {
                                        dWrite = 1;
                                    } else if (d == 1) {
                                        dWrite = '';
                                    }
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                        cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite;
                                    resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten2nd += '</th></table></td>';
                                    resultWritten3rd = '= ' + roundPrice((a * Math.pow(b, 1 / 2) + c * Math.pow(d, 1 / 2)) / (x *
                                        Math.pow(y, 1 / 2) + z * Math.pow(u, 1 / 2)), 4);
                                    return;
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4))) {
                                    bWrite = roundPrice(Math.pow(b, 1 / 2), 4);
                                    if (a == 1 && b == 1) {
                                        bWrite = 1;
                                    } else if (b == 1) {
                                        aWrite = a;
                                        bWrite = '';
                                    }
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                        cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite;
                                    resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten2nd += '</th></table></td>';
                                    if (c * (x * Math.pow(y, 1 / 2) + z * Math.pow(u, 1 / 2)) < 0) {
                                        signUp = ' ';
                                    } else {
                                        signUp = ' + ';
                                    }
                                    a = roundPrice((a * Math.pow(b, 1 / 2)) / (x * Math.pow(y, 1 / 2) + z * Math.pow(u, 1 / 2)), 4);
                                    b = 1;
                                    bWrite = ''
                                    c = roundPrice(c / (x * Math.pow(y, 1 / 2) + z * Math.pow(u, 1 / 2)), 4);
                                    aWrite = a;
                                    if (c == 1) {
                                        cWrite = '';
                                    } else {
                                        cWrite = c + ' * ';
                                    }
                                    resultWritten3rd = '= ' + aWrite + bWrite + signUp + cWrite + dWrite;
                                } else if (isInteger(roundPrice(Math.pow(d, 1 / 2), 4))) {
                                    dWrite = roundPrice(Math.pow(d, 1 / 2), 4);
                                    if (c == 1 && d == 1) {
                                        dWrite = 1;
                                    } else if (d == 1) {
                                        cWrite = c;
                                        dWrite = '';
                                    }
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                        cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite;
                                    resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten2nd += '</th></table></td>';
                                    if (c * (x * Math.pow(y, 1 / 2) + z * Math.pow(u, 1 / 2)) < 0) {
                                        signUp = ' ';
                                    } else {
                                        signUp = ' + ';
                                    }
                                    c = roundPrice((c * Math.pow(d, 1 / 2)) / (x * Math.pow(y, 1 / 2) + z * Math.pow(u, 1 / 2)), 4);
                                    d = 1;
                                    dWrite = ''
                                    a = roundPrice(a / (x * Math.pow(y, 1 / 2) + z * Math.pow(u, 1 / 2)), 4);
                                    cWrite = c;
                                    if (a == 1) {
                                        aWrite = '';
                                    } else {
                                        aWrite = a + ' * ';
                                    }
                                    resultWritten3rd = '= ' + aWrite + bWrite + signUp + cWrite + dWrite;
                                } else {
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                        cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite;
                                    resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten2nd += '</th></table></td>';

                                    if (c * (x * Math.pow(y, 1 / 2) + z * Math.pow(u, 1 / 2)) < 0) {
                                        signUp = ' ';
                                    } else {
                                        signUp = ' + ';
                                    }
                                    a = roundPrice(a / (x * Math.pow(y, 1 / 2) + z * Math.pow(u, 1 / 2)), 4);
                                    if (a == 1) {
                                        aWrite = '';
                                    } else {
                                        aWrite = a + ' * ';
                                    }
                                    c = roundPrice(c / (x * Math.pow(y, 1 / 2) + z * Math.pow(u, 1 / 2)), 4);
                                    if (c == 1) {
                                        cWrite = '';
                                    } else {
                                        cWrite = c + ' * ';
                                    }
                                    resultWritten3rd = '= ' + aWrite + bWrite + signUp + cWrite + dWrite;
                                }

                                finalResult1st = getSimplified(b, 2);
                                finalResult2nd = getSimplified(d, 2);
                                if (finalResult1st[1] == n && finalResult1st[2] == b && finalResult2nd[1] == m && finalResult2nd[
                                    2] == d) {
                                    showLastLine = false;
                                }
                                finalResult1st[0] = roundPrice(finalResult1st[0] * a, 4);
                                finalResult2nd[0] = roundPrice(finalResult2nd[0] * a2nd, 4);
                                if (finalResult1st[0] == 1 && finalResult1st[2] != 1) {
                                    finalResult1st[0] = '';
                                } else if (finalResult1st[0] == -1 && finalResult1st[2] != 1) {
                                    finalResult1st[0] = '-';
                                } else if (finalResult1st[2] != 1) {
                                    finalResult1st[0] += ' * ';
                                }
                                if (finalResult2nd[0] == 1 && finalResult2nd[2] != 1) {
                                    finalResult2nd[0] = '';
                                } else if (finalResult2nd[0] == -1 && finalResult2nd[2] != 1) {
                                    finalResult2nd[0] = '-';
                                } else if (finalResult2nd[2] != 1) {
                                    finalResult2nd[0] += ' * ';
                                }
                                finalResult1st[1] = '';
                                finalResult2nd[1] = '';
                                if (finalResult1st[2] == 1) {
                                    finalResult1st[2] = '';
                                } else {
                                    finalResult1st[2] = '<sup class="font-s-14">' + finalResult1st[1] + '</sup>√' + finalResult1st[2];
                                }
                                if (finalResult2nd[2] == 1) {
                                    finalResult2nd[2] = '';
                                } else {
                                    finalResult2nd[2] = '<sup class="font-s-14">' + finalResult2nd[1] + '</sup>√' + finalResult2nd[2];
                                }
                                if (showLastLine) {
                                    resultWritten4th += ' = ' + finalResult1st[0] + finalResult1st[2] + signUp + finalResult2nd[0] +
                                        finalResult2nd[2];
                                }
                            }

                            ////////////////Rationalization///////////////
                            else if (y == u) {
                                resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                resultWritten1st += '</tr></table>';
                                addHtml(resultWritten1st);
                                x += z;
                                if (x == 1) {
                                    xWrite = '';
                                } else {
                                    xWrite = x + ' * ';
                                }

                                //////////Proceed as in Expression 2///////////

                                n = 2;
                                m = 2;
                                k = 2;

                                resultWritten1st += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp + cWrite +
                                    dWrite + '<br><hr noshade>' + xWrite + yWrite + '</th></table></td>';
                                resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                resultWritten1st += '</tr></table>';
                                addHtml(resultWritten1st);
                                resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                                //////////No need for rationalization/////////

                                if (isInteger(roundPrice(Math.pow(y, 1 / k), 4))) {
                                    if (isInteger(roundPrice(Math.pow(b, 1 / n), 4)) && isInteger(roundPrice(Math.pow(d, 1 / m),
                                        4))) {
                                        bWrite = roundPrice(Math.pow(b, 1 / n), 4);
                                        if (a == 1 && b == 1) {
                                            bWrite = 1;
                                        } else if (b == 1) {
                                            bWrite = '';
                                        }
                                        dWrite = roundPrice(Math.pow(d, 1 / m), 4);
                                        if (c == 1 && d == 1) {
                                            dWrite = 1;
                                        } else if (d == 1) {
                                            dWrite = '';
                                        }
                                        yWrite = roundPrice(Math.pow(y, 1 / k), 4);
                                        if (x == 1 && y == 1) {
                                            yWrite = 1;
                                        } else if (y == 1) {
                                            yWrite = '';
                                        }
                                        resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                            cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite;
                                        resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                        resultWritten2nd += '</th></table></td>';

                                        resultWritten3rd = '= ' + roundPrice((a * Math.pow(b, 1 / n) + c * Math.pow(d, 1 / m)) / (
                                            x * Math.pow(y, 1 / k)), 4);

                                        addHtml(resultWritten2nd);
                                        addHtml(resultWritten3rd);
                                        return;
                                    } else if (isInteger(roundPrice(Math.pow(b, 1 / n), 4))) {
                                        bWrite = roundPrice(Math.pow(b, 1 / n), 4);
                                        if (a == 1 && b == 1) {
                                            bWrite = 1;
                                        } else if (b == 1) {
                                            bWrite = '';
                                        }
                                        yWrite = roundPrice(Math.pow(y, 1 / k), 4);
                                        if (x == 1 && y == 1) {
                                            yWrite = 1;
                                        } else if (y == 1) {
                                            yWrite = '';
                                        }
                                        resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                            cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite;
                                        resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                        resultWritten2nd += '</th></table></td>';

                                        resultWritten3rd = '= ' + roundPrice((a * Math.pow(b, 1 / n)) / (x * Math.pow(y, 1 / k)),
                                        4);
                                        c /= x * Math.pow(y, 1 / k);
                                        if (c < 0) {
                                            signUp = ' ';
                                        } else {
                                            signUp = ' + ';
                                        }
                                        if (c == 1) {
                                            cWrite = '';
                                        } else {
                                            cWrite = roundPrice(c, 5) + ' * ';
                                        }
                                        resultWritten3rd += signUp + cWrite + dWrite;
                                    } else if (isInteger(roundPrice(Math.pow(d, 1 / m), 4))) {
                                        dWrite = roundPrice(Math.pow(d, 1 / m), 4);
                                        if (c == 1 && d == 1) {
                                            dWrite = 1;
                                        } else if (d == 1) {
                                            dWrite = '';
                                        }
                                        yWrite = roundPrice(Math.pow(y, 1 / k), 4);
                                        if (x == 1 && y == 1) {
                                            yWrite = 1;
                                        } else if (y == 1) {
                                            yWrite = '';
                                        }
                                        resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                            cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite;
                                        resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                        resultWritten2nd += '</th></table></td>';

                                        a = roundPrice(a / (x * Math.pow(y, 1 / k)), 4);
                                        c = roundPrice((c * Math.pow(d, 1 / m)) / (x * Math.pow(y, 1 / k)), 4);
                                        if (c < 0) {
                                            signUp = ' ';
                                        } else {
                                            signUp = ' + ';
                                        }
                                        if (a == 1) {
                                            aWrite = '';
                                        } else {
                                            aWrite = a + ' * ';
                                        }
                                        resultWritten3rd = '= ' + aWrite + bWrite + signUp + c;
                                    } else {
                                        yWrite = roundPrice(Math.pow(y, 1 / k), 4);
                                        if (x == 1 && y == 1) {
                                            yWrite = 1;
                                        } else if (y == 1) {
                                            yWrite = '';
                                        }
                                        if (n == m && b == d) {
                                            oneSummand = true;
                                            a += c;
                                            if (a == 1) {
                                                aWrite = '';
                                            } else {
                                                aWrite = a + ' * ';
                                            }
                                            resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                                '<br><hr noshade>' + xWrite + yWrite;
                                            resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                            resultWritten2nd += '</th></table></td>';

                                            a = roundPrice(a / (x * Math.pow(y, 1 / k)), 4);
                                            if (a == 1) {
                                                aWrite = '';
                                            } else {
                                                aWrite = a + ' * ';
                                            }
                                            resultWritten3rd = '= ' + aWrite + bWrite;
                                        } else {
                                            resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                                signUp + cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite;
                                            resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                            resultWritten2nd += '</th></table></td>';

                                            a = roundPrice(a / (x * Math.pow(y, 1 / k)), 4);
                                            c = roundPrice(c / (x * Math.pow(y, 1 / k)), 4);
                                            if (a == 1) {
                                                aWrite = '';
                                            } else {
                                                aWrite = a + ' * ';
                                            }
                                            if (c == 1) {
                                                cWrite = '';
                                            } else {
                                                cWrite = c + ' * ';
                                            }
                                            if (c < 0) {
                                                signUp = ' ';
                                            } else {
                                                signUp = ' + ';
                                            }
                                            resultWritten3rd = '= ' + aWrite + bWrite + signUp + cWrite + dWrite;
                                        }
                                    }
                                }

                                ////////////////Rationalization///////////////
                                else {
                                    if (isInteger(roundPrice(Math.pow(b, 1 / n), 4)) && isInteger(roundPrice(Math.pow(d, 1 / m),
                                        4))) {
                                        oneSummand = true;
                                        bWrite = roundPrice(Math.pow(b, 1 / n), 4);
                                        if (a == 1 && b == 1) {
                                            bWrite = 1;
                                        } else if (b == 1) {
                                            bWrite = '';
                                        }
                                        dWrite = roundPrice(Math.pow(d, 1 / m), 4);
                                        if (c == 1 && d == 1) {
                                            dWrite = 1;
                                        } else if (d == 1) {
                                            dWrite = '';
                                        }
                                        a = roundPrice(a * Math.pow(b, 1 / n) + c * Math.pow(d, 1 / m), 4);
                                        b = 1;
                                    } else if (isInteger(roundPrice(Math.pow(b, 1 / n), 4))) {
                                        bWrite = roundPrice(Math.pow(b, 1 / n), 4);
                                        if (a == 1 && b == 1) {
                                            bWrite = 1;
                                        } else if (b == 1) {
                                            bWrite = '';
                                        }
                                        a = roundPrice(a * Math.pow(b, 1 / n), 4);
                                        b = 1;
                                    } else if (isInteger(roundPrice(Math.pow(d, 1 / m), 4))) {
                                        dWrite = roundPrice(Math.pow(d, 1 / m), 4);
                                        if (c == 1 && d == 1) {
                                            dWrite = 1;
                                        } else if (d == 1) {
                                            dWrite = '';
                                        }
                                        c = roundPrice(c * Math.pow(d, 1 / m), 4);
                                        d = 1;
                                    }
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                        cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite + '</th></table></td>';

                                    resultWritten2nd += '<td class="py-2" rowspan="3">*</td>';
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + reducedMultiplier +
                                        '<br><hr noshade>' + reducedMultiplier + '</th></table></td>';
                                    resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                                    if (a == 1) {
                                        aWrite = '';
                                    } else if (b != 1) {
                                        aWrite = a + ' * ';
                                    } else {
                                        aWrite = a;
                                    }
                                    if (c == 1) {
                                        cWrite = '';
                                    } else if (d != 1) {
                                        cWrite = c + ' * ';
                                    } else {
                                        cWrite = c;
                                    }

                                    newRoot1st = find_lcm(n, k);
                                    newRoot2nd = find_lcm(m, k);
                                    if (newRoot1st == 2) {
                                        newRootWrite1st = '';
                                    } else {
                                        newRootWrite1st = newRoot1st;
                                    }
                                    if (newRoot2nd == 2) {
                                        newRootWrite2nd = '';
                                    } else {
                                        newRootWrite2nd = newRoot2nd;
                                    }
                                    if (b != 1 && isInteger(roundPrice(Math.pow(b, 1 / n), 4))) {
                                        bWrite = '<sup class="font-s-14">' + newRootWrite1st + '</sup>√(' + Math.pow(b, newRoot1st / n);
                                        bWrite += ' * ';
                                    } else if (isInteger(roundPrice(Math.pow(b, 1 / n), 4))) {
                                        bWrite = ' * <sup class="font-s-14">' + newRootWrite1st + '</sup>√(';
                                    } else {
                                        bWrite = '<sup class="font-s-14">' + newRootWrite1st + '</sup>√(' + bWrite;
                                    }
                                    if (d != 1 && isInteger(roundPrice(Math.pow(d, 1 / m), 4))) {
                                        dWrite = '<sup class="font-s-14">' + newRootWrite2nd + '</sup>√(' + Math.pow(d, newRoot2nd / m);
                                        dWrite += ' * ';
                                    } else if (isInteger(roundPrice(Math.pow(d, 1 / m), 4))) {
                                        dWrite = ' * <sup class="font-s-14">' + newRootWrite2nd + '</sup>√(';
                                    } else {
                                        dWrite = '<sup class="font-s-14">' + newRootWrite2nd + '</sup>√(' + dWrite;
                                    }

                                    resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten3rd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + Math.pow(y,
                                        newRoot1st / k) + ')';
                                    if (!oneSummand) {
                                        resultWritten3rd += signUp + cWrite + dWrite + Math.pow(y, newRoot2nd / k) + ')';
                                    }
                                    resultWritten3rd += '<br><hr noshade>' + xWrite + y + '</th></table></td>';
                                    resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';

                                    a = roundPrice(a / (x * y), 4);
                                    c = roundPrice(c / (x * y), 4);
                                    b = roundPrice(Math.pow(b, newRoot1st / n) * Math.pow(y, newRoot1st / k), 4);
                                    d = roundPrice(Math.pow(d, newRoot2nd / m) * Math.pow(y, newRoot2nd / k), 4);
                                    n = newRoot1st;
                                    m = newRoot2nd;
                                    if (a == 1) {
                                        aWrite = '';
                                    } else {
                                        aWrite = a + ' * ';
                                    }
                                    if (c == 1) {
                                        cWrite = '';
                                    } else {
                                        cWrite = c + ' * ';
                                    }
                                    if (c < 0) {
                                        signUp = ' ';
                                    } else {
                                        signUp = ' + ';
                                    }
                                    resultWritten4th += aWrite + '<sup class="font-s-14">' + newRootWrite1st + '</sup>√' + b + signUp + cWrite +
                                        '<sup class="font-s-14">' + newRootWrite2nd + '</sup>√' + d;
                                }
                                finalResult1st = getSimplified(b, n);
                                finalResult2nd = getSimplified(d, m);
                                if (finalResult1st[1] == n && finalResult1st[2] == b && finalResult2nd[1] == m && finalResult2nd[
                                    2] == d) {
                                    showLastLine = false;
                                }
                                finalResult1st[0] = roundPrice(finalResult1st[0] * a, 4);
                                finalResult2nd[0] = roundPrice(finalResult2nd[0] * c, 4);
                                if (finalResult1st[0] == 1 && finalResult1st[2] != 1) {
                                    finalResult1st[0] = '';
                                } else if (finalResult1st[0] == -1 && finalResult1st[2] != 1) {
                                    finalResult1st[0] = '-';
                                } else if (finalResult1st[2] != 1) {
                                    finalResult1st[0] += ' * ';
                                }
                                if (finalResult2nd[0] == 1 && finalResult2nd[2] != 1) {
                                    finalResult2nd[0] = '';
                                } else if (finalResult2nd[0] == -1 && finalResult2nd[2] != 1) {
                                    finalResult2nd[0] = '-';
                                } else if (finalResult2nd[2] != 1) {
                                    finalResult2nd[0] += ' * ';
                                }
                                if (finalResult1st[1] == 2) {
                                    finalResult1st[1] = '';
                                }
                                if (finalResult2nd[1] == 2) {
                                    finalResult2nd[1] = '';
                                }
                                if (finalResult1st[2] == 1) {
                                    finalResult1st[2] = '';
                                } else {
                                    finalResult1st[2] = '<sup class="font-s-14">' + finalResult1st[1] + '</sup>√' + finalResult1st[2];
                                }
                                if (finalResult2nd[2] == 1) {
                                    finalResult2nd[2] = '';
                                } else {
                                    finalResult2nd[2] = '<sup class="font-s-14">' + finalResult2nd[1] + '</sup>√' + finalResult2nd[2];
                                }
                                if (showLastLine) {
                                    resultWritten4th += finalResult1st[0] + finalResult1st[2] + signUp + finalResult2nd[0] +
                                        finalResult2nd[2];
                                }

                                resultWritten2nd += '</tr></table>';
                                addHtml(resultWritten2nd);

                                resultWritten3rd += '</tr></table>';
                                addHtml(resultWritten3rd);

                                // addHtml(resultWritten4th);
                                jawab(resultWritten4th);
                            } else if (b == d) {
                                resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                addHtml(resultWritten1st);
                                a += c;
                                if (a == 1) {
                                    aWrite = '';
                                } else {
                                    aWrite = a + ' * ';
                                }

                                //////////Proceed as in Expression 3///////////

                                resultWritten1st += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                    '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite + '</th></table></td>';
                                resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                                //////////No need for rationalization/////////

                                if (isInteger(roundPrice(Math.pow(y, 1 / 2), 4)) && isInteger(roundPrice(Math.pow(u, 1 / 2), 4))) {
                                    yWrite = roundPrice(Math.pow(y, 1 / 2), 4);
                                    if (x == 1 && y == 1) {
                                        yWrite = 1;
                                    } else if (y == 1) {
                                        yWrite = '';
                                    }
                                    uWrite = roundPrice(Math.pow(u, 1 / 2), 4);
                                    if (z == 1 && u == 1) {
                                        uWrite = 1;
                                    } else if (u == 1) {
                                        uWrite = '';
                                    }
                                    if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4))) {
                                        resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                        resultWritten1st += '</tr></table>';
                                        addHtml(resultWritten1st);
                                        bWrite = roundPrice(Math.pow(b, 1 / 2), 4);
                                        if (a == 1 && b == 1) {
                                            bWrite = 1;
                                        } else if (b == 1) {
                                            bWrite = '';
                                        }
                                        resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                            '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite;
                                        resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                        resultWritten2nd += '</th></table></td>';

                                        resultWritten3rd = '= ' + roundPrice((a * Math.pow(b, 1 / 2)) / (x * Math.pow(y, 1 / 2) +
                                            z * Math.pow(u, 1 / 2)), 4);
                                        addHtml(resultWritten2nd);
                                        addHtml(resultWritten3rd);
                                        return;
                                    } else {
                                        resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                        resultWritten1st += '</tr></table>';
                                        addHtml(resultWritten1st);
                                        resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                            '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite;
                                        resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';
                                        resultWritten2nd += '</th></table></td>';

                                        a = roundPrice(a / (x * Math.pow(y, 1 / 2) + z * Math.pow(u, 1 / 2)), 4);
                                        if (a == 1) {
                                            aWrite = '';
                                        } else {
                                            aWrite = a + ' * ';
                                        }
                                        resultWritten3rd = '= ' + aWrite + bWrite;
                                    }
                                }

                                ////////////////Rationalization///////////////
                                else if (y == u) {
                                    resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten1st += '</tr></table>';
                                    addHtml(resultWritten1st);
                                    y += u;
                                    if (y == 1) {
                                        yWrite = '';
                                    } else {
                                        yWrite = y + ' * ';
                                    }
                                    if (b == 1) {
                                        bWrite = '';
                                    } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4))) {
                                        bWrite = roundPrice(Math.pow(b, 1 / 2), 4);
                                        a *= roundPrice(Math.pow(b, 1 / 2), 4);
                                        b = 1;
                                    }
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                        '<br><hr noshade>' + xWrite + yWrite + '</th></table></td>';

                                    resultWritten2nd += '<td class="py-2" rowspan="3">*</td>';
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + reducedMultiplier +
                                        '<br><hr noshade>' + reducedMultiplier + '</th></table></td>';
                                    resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                                    if (b != 1 && isInteger(roundPrice(Math.pow(b, 1 / 2), 4))) {
                                        bWrite = '√(' + b;
                                        bWrite += ' * ';
                                    } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4))) {
                                        bWrite += '√(';
                                    } else {
                                        bWrite = '√(' + bWrite;
                                    }

                                    resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten3rd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + y +
                                        ')<br><hr noshade>' + xWrite + y + '</th></table></td>';
                                    resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';

                                    a = roundPrice(a / (x * y), 4);
                                    b = roundPrice(b * y, 4);
                                    if (a == 1) {
                                        aWrite = '';
                                    } else {
                                        aWrite = a + ' * ';
                                    }
                                    resultWritten4th += aWrite + '√' + b;
                                } else {
                                    if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4))) {
                                        if (b == 1) {
                                            bWrite = '';
                                            aWrite = a;
                                        } else {
                                            sthChanged = true;
                                            bWrite = roundPrice(Math.pow(b, 1 / 2), 4);
                                            a *= roundPrice(Math.pow(b, 1 / 2), 4);
                                            b = 1;
                                        }
                                    }
                                    if (isInteger(roundPrice(Math.pow(y, 1 / 2), 4))) {
                                        if (y == 1) {
                                            yWrite = '';
                                            xWrite = x;
                                        } else {
                                            sthChanged = true;
                                            yWrite = roundPrice(Math.pow(y, 1 / 2), 4);
                                            x *= roundPrice(Math.pow(y, 1 / 2), 4);
                                            y = 1;
                                        }
                                    }
                                    if (isInteger(roundPrice(Math.pow(u, 1 / 2), 4))) {
                                        if (u == 1) {
                                            uWrite = '';
                                            zWrite = z;
                                        } else {
                                            sthChanged = true;
                                            uWrite = roundPrice(Math.pow(u, 1 / 2), 4);
                                            z *= roundPrice(Math.pow(u, 1 / 2), 4);
                                            u = 1;
                                        }
                                    }
                                    if (sthChanged) {
                                        resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                        resultWritten1st += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                            '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite +
                                            '</th></table></td>';
                                        if (b == 1) {
                                            bWrite = ''
                                            aWrite = a;
                                        }
                                        if (y == 1) {
                                            yWrite = ''
                                            xWrite = x;
                                        }
                                        if (u == 1) {
                                            uWrite = ''
                                            zWrite = z;
                                        }
                                    }
                                    zAbs = Math.abs(z);
                                    if (zAbs == 1 && u != 1) {
                                        zAbs = '';
                                    } else if (u != 1) {
                                        zAbs += ' * ';
                                    }
                                    resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten1st += '</tr></table>';
                                    addHtml(resultWritten1st);

                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite +
                                        '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite + '</th></table></td>';

                                    resultWritten2nd += '<td class="py-2" rowspan="3">*</td>';
                                    resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + xWrite + yWrite +
                                        signDownInverse + zAbs + uWrite + '<br><hr noshade>' + xWrite + yWrite + signDownInverse +
                                        zAbs + uWrite + '</th></table></td>';
                                    resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                                    if (b != 1 && isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && y != 1) {
                                        bWrite = '√(' + b;
                                        bWrite += ' * ' + y + ')';
                                    } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && y != 1) {
                                        bWrite = ' * √' + y;
                                    } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && y == 1) {
                                        bWrite = '√' + b;
                                    } else {
                                        bWrite = '';
                                    }

                                    if (b != 1 && isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && u != 1) {
                                        dWrite = '√(' + b;
                                        dWrite += ' * ' + u + ')';
                                    } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && u != 1) {
                                        dWrite = ' * √' + u;
                                    } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && u == 1) {
                                        dWrite = '√' + b;
                                    } else {
                                        dWrite = '';
                                    }

                                    a2nd = a * z;
                                    a *= x;
                                    if (z > 0) {
                                        a2nd *= (-1);
                                    }
                                    if (a2nd == 1) {
                                        aWrite2nd = '';
                                    } else if (a2nd == -1) {
                                        aWrite2nd = '-';
                                    } else {
                                        aWrite2nd = a2nd;
                                    }
                                    if (a2nd < 0) {
                                        signUp = ' ';
                                    } else {
                                        signUp = ' + ';
                                    }
                                    if (a == 1 && bWrite != '') {
                                        aWrite = '';
                                    } else if (a == 1 && bWrite == '') {
                                        aWrite = 1;
                                    } else if (a != 1 && bWrite == '') {
                                        aWrite = a;
                                    } else {
                                        aWrite = a + ' * ';
                                    }
                                    if (a2nd == 1 && dWrite != '') {
                                        aWrite2nd = '';
                                    } else if (a2nd == 1 && dWrite == '') {
                                        aWrite2nd = 1;
                                    } else {
                                        aWrite2nd = a2nd;
                                    }

                                    resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';
                                    resultWritten3rd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp;
                                    resultWritten3rd += aWrite2nd + dWrite + '<br><hr noshade>' + roundPrice(x * x * y, 4) + ' - ' +
                                        roundPrice(z * z * u, 4) + '</th></table></td>';
                                    resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';

                                    a = roundPrice((a) / (x * x * y - z * z * u), 4);
                                    a2nd = roundPrice((a2nd) / (x * x * y - z * z * u), 4);
                                    b = roundPrice(b * y, 4);
                                    d = roundPrice(b * u, 4);
                                    if (a == 1) {
                                        aWrite = '';
                                    } else if (b != 1) {
                                        aWrite = a + ' * ';
                                    } else {
                                        aWrite = a;
                                    }
                                    if (a2nd == 1) {
                                        aWrite2nd = '';
                                    } else if (d != 1) {
                                        aWrite2nd = a2nd + ' * ';
                                    } else {
                                        aWrite2nd = a2nd;
                                    }
                                    if ((x * x * y - z * z * u < 0 && signUp == ' ') || (x * x * y - z * z * u > 0 && signUp ==
                                            ' + ')) {
                                        signUp = ' + ';
                                    } else {
                                        signUp = ' ';
                                    }
                                    if (b != 1) {
                                        bWrite = '√' + b;
                                    }
                                    if (d != 1) {
                                        dWrite = '√' + d;
                                    }
                                    resultWritten4th += aWrite + bWrite + signUp + aWrite2nd + dWrite;

                                    finalResult1st = getSimplified(b, 2);
                                    finalResult2nd = getSimplified(d, 2);

                                    if (finalResult1st[1] == n && finalResult1st[2] == b && finalResult2nd[1] == m &&
                                        finalResult2nd[2] == d) {
                                        showLastLine = false;
                                    }
                                    finalResult1st[0] = roundPrice(finalResult1st[0], 4);
                                    finalResult2nd[0] = roundPrice(finalResult2nd[0], 4);
                                    if (finalResult1st[0] == 1 && finalResult1st[2] != 1) {
                                        finalResult1st[0] = '';
                                    } else if (finalResult1st[0] == -1 && finalResult1st[2] != 1) {
                                        finalResult1st[0] = '-';
                                    } else if (finalResult1st[2] != 1) {
                                        finalResult1st[0] += ' * ';
                                    }
                                    if (finalResult2nd[0] == 1 && finalResult2nd[2] != 1) {
                                        finalResult2nd[0] = '';
                                    } else if (finalResult2nd[0] == -1 && finalResult2nd[2] != 1) {
                                        finalResult2nd[0] = '-';
                                    } else if (finalResult2nd[2] != 1) {
                                        finalResult2nd[0] += ' * ';
                                    }
                                    finalResult1st[1] = '';
                                    finalResult2nd[1] = '';
                                    if (finalResult1st[2] == 1) {
                                        finalResult1st[2] = '';
                                    } else {
                                        finalResult1st[2] = '<sup class="font-s-14">' + finalResult1st[1] + '</sup>√' + finalResult1st[2];
                                    }
                                    if (finalResult2nd[2] == 1) {
                                        finalResult2nd[2] = '';
                                    } else {
                                        finalResult2nd[2] = '<sup class="font-s-14">' + finalResult2nd[1] + '</sup>√' + finalResult2nd[2];
                                    }
                                    if (showLastLine) {
                                        resultWritten4th += finalResult1st[0] + finalResult1st[2] + signUp + finalResult2nd[0] +
                                            finalResult2nd[2];
                                    }
                                }

                                resultWritten2nd += '</tr></table>';
                                addHtml(resultWritten2nd);

                                resultWritten3rd += '</tr></table>';
                                addHtml(resultWritten3rd);

                                // addHtml(resultWritten4th);
                                jawab(resultWritten4th);
                            }

                            //////////Sums above and below/////////////
                            else {
                                if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4))) {
                                    if (b != 1) {
                                        sthChanged = true;
                                    }
                                    bWrite = roundPrice(Math.pow(b, 1 / 2), 4);
                                    a *= roundPrice(Math.pow(b, 1 / 2), 4);
                                    b = 1;
                                }
                                if (isInteger(roundPrice(Math.pow(d, 1 / 2), 4))) {
                                    if (d != 1) {
                                        sthChanged = true;
                                    }
                                    dWrite = roundPrice(Math.pow(d, 1 / 2), 4);
                                    a *= roundPrice(Math.pow(d, 1 / 2), 4);
                                    d = 1;
                                }
                                if (isInteger(roundPrice(Math.pow(y, 1 / 2), 4))) {
                                    if (y != 1) {
                                        sthChanged = true;
                                    }
                                    yWrite = roundPrice(Math.pow(y, 1 / 2), 4);
                                    x *= roundPrice(Math.pow(y, 1 / 2), 4);
                                    y = 1;
                                }
                                if (isInteger(roundPrice(Math.pow(u, 1 / 2), 4))) {
                                    if (u != 1) {
                                        sthChanged = true;
                                    }
                                    uWrite = roundPrice(Math.pow(u, 1 / 2), 4);
                                    z *= roundPrice(Math.pow(u, 1 / 2), 4);
                                    u = 1;
                                }
                                if (sthChanged) {
                                    resultWritten1st += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                        cWrite + dWrite + '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite +
                                        '</th></table></td>';
                                    resultWritten1st += '<td class="py-2" rowspan="3">=</td>';
                                }
                                if (b == 1) {
                                    bWrite = '';
                                    aWrite = a;
                                }
                                if (d == 1) {
                                    dWrite = ''
                                    cWrite = c;
                                }
                                if (y == 1) {
                                    yWrite = '';
                                    xWrite = x;
                                }
                                if (u == 1) {
                                    uWrite = '';
                                    zWrite = z;
                                }
                                zAbs = Math.abs(z);
                                if (zAbs == 1 && u != 1) {
                                    zAbs = '';
                                } else if (u != 1) {
                                    zAbs += ' * ';
                                }
                                resultWritten1st += '</tr></table>';
                                addHtml(resultWritten1st);

                                resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp + cWrite +
                                    dWrite + '<br><hr noshade>' + xWrite + yWrite + signDown + zWrite + uWrite +
                                    '</th></table></td>';
                                resultWritten2nd += '<td class="py-2" rowspan="3">*</td>';
                                resultWritten2nd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + xWrite + yWrite + signDownInverse +
                                    zAbs + uWrite + '<br><hr noshade>' + xWrite + yWrite + signDownInverse + zAbs + uWrite +
                                    '</th></table></td>';
                                resultWritten2nd += '<td class="py-2" rowspan="3">=</td>';

                                if (b != 1 && isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && y != 1) {
                                    bWrite = '√(' + b;
                                    bWrite += ' * ' + y + ')';
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && y != 1) {
                                    bWrite = '√' + y;
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && y == 1) {
                                    bWrite = '√' + b;
                                } else {
                                    bWrite = '';
                                }

                                if (b != 1 && isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && u != 1) {
                                    dWrite = '√(' + b;
                                    dWrite += ' * ' + u + ')';
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && u != 1) {
                                    dWrite = ' * √' + u;
                                } else if (isInteger(roundPrice(Math.pow(b, 1 / 2), 4)) && u == 1) {
                                    dWrite = '√' + b;
                                } else {
                                    dWrite = '';
                                }

                                if (d != 1 && isInteger(roundPrice(Math.pow(d, 1 / 2), 4)) && y != 1) {
                                    fWrite = '√(' + d;
                                    fWrite += ' * ' + y + ')';
                                } else if (isInteger(roundPrice(Math.pow(d, 1 / 2), 4)) && y != 1) {
                                    fWrite = ' * √' + y;
                                } else if (isInteger(roundPrice(Math.pow(d, 1 / 2), 4)) && y == 1) {
                                    fWrite = '√' + d;
                                } else {
                                    fWrite = '';
                                }

                                if (d != 1 && isInteger(roundPrice(Math.pow(d, 1 / 2), 4)) && u != 1) {
                                    hWrite = '√(' + d;
                                    hWrite += ' * ' + u + ')';
                                } else if (isInteger(roundPrice(Math.pow(d, 1 / 2), 4)) && u != 1) {
                                    hWrite = ' * √' + u;
                                } else if (isInteger(roundPrice(Math.pow(d, 1 / 2), 4)) && u == 1) {
                                    hWrite = '√' + d;
                                } else {
                                    hWrite = '';
                                }

                                a2nd = a * z * (-1);
                                a *= x;
                                e = c * x;
                                g = c * z * (-1);

                                if (a2nd < 0) {
                                    signUp = ' ';
                                } else {
                                    signUp = ' + ';
                                }
                                if (e < 0) {
                                    signUp2nd = ' ';
                                } else {
                                    signUp2nd = ' + ';
                                }
                                if (g < 0) {
                                    signUp3rd = ' ';
                                } else {
                                    signUp3rd = ' + ';
                                }
                                if (a == 1 && bWrite != '') {
                                    aWrite = '';
                                } else if (a == 1 && bWrite == '') {
                                    aWrite = 1;
                                } else if (a != 1 && bWrite == '') {
                                    aWrite = a;
                                } else {
                                    aWrite = a + ' * ';
                                }
                                if (a2nd == 1 && dWrite != '') {
                                    aWrite2nd = '';
                                } else if (a2nd == 1 && dWrite == '') {
                                    aWrite2nd = 1;
                                } else {
                                    aWrite2nd = a2nd;
                                }
                                if (e == 1 && fWrite != '') {
                                    eWrite = '';
                                } else if (e == 1 && fWrite == '') {
                                    eWrite = 1;
                                } else if (e != 1 && fWrite == '') {
                                    eWrite = e;
                                } else {
                                    eWrite = e + ' * ';
                                }
                                if (g == 1 && hWrite != '') {
                                    gWrite = '';
                                } else if (g == 1 && hWrite == '') {
                                    gWrite = 1;
                                } else if (g != 1 && hWrite == '') {
                                    gWrite = g;
                                } else {
                                    gWrite = g + ' * ';
                                }

                                resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';
                                resultWritten3rd += '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' + aWrite + bWrite + signUp +
                                    aWrite2nd + dWrite + signUp2nd + eWrite + fWrite + signUp3rd + gWrite + hWrite;
                                resultWritten3rd += '<br><hr noshade>' + roundPrice(x * x * y, 4) + ' - ' + roundPrice(z * z * u,
                                    4) + '</th></table></td>';
                                resultWritten3rd += '<td class="py-2" rowspan="3">=</td>';

                                a = roundPrice(a / (x * x * y - z * z * u), 4);
                                a2nd = roundPrice(a2nd / (x * x * y - z * z * u), 4);
                                e = roundPrice(e / (x * x * y - z * z * u), 4);
                                g = roundPrice(g / (x * x * y - z * z * u), 4);
                                f = roundPrice(d * y, 4);
                                h = roundPrice(d * u, 4);
                                d = roundPrice(b * u, 4);
                                b = roundPrice(b * y, 4);
                                if (a == 1 && b != 1) {
                                    aWrite = '';
                                } else if (a == -1 && b != -1) {
                                    aWrite = '-';
                                } else if (b != 1) {
                                    aWrite = a + ' * ';
                                } else {
                                    aWrite = a;
                                }
                                if (a2nd == 1 && d != 1) {
                                    aWrite2nd = '';
                                } else if (a2nd == -1 && d != 1) {
                                    aWrite2nd = '-';
                                } else if (d != 1) {
                                    aWrite2nd = a2nd + ' * ';
                                } else {
                                    aWrite2nd = a2nd;
                                }
                                if (e == 1) {
                                    eWrite = '';
                                } else if (f != 1) {
                                    eWrite = e + ' * ';
                                } else {
                                    eWrite = e;
                                }
                                if (g == 1) {
                                    gWrite = '';
                                } else if (h != 1) {
                                    gWrite = g + ' * ';
                                } else {
                                    gWrite = g;
                                }
                                if ((x * x * y - z * z * u < 0 && signUp == ' ') || (x * x * y - z * z * u > 0 && signUp ==
                                    ' + ')) {
                                    signUp = ' + ';
                                } else {
                                    signUp = ' ';
                                }
                                if ((x * x * y - z * z * u < 0 && signUp2nd == ' ') || (x * x * y - z * z * u > 0 && signUp2nd ==
                                        ' + ')) {
                                    signUp2nd = ' + ';
                                } else {
                                    signUp2nd = ' ';
                                }
                                if ((x * x * y - z * z * u < 0 && signUp3rd == ' ') || (x * x * y - z * z * u > 0 && signUp3rd ==
                                        ' + ')) {
                                    signUp3rd = ' + ';
                                } else {
                                    signUp3rd = ' ';
                                }
                                if (b != 1) {
                                    bWrite = '√' + b;
                                }
                                if (d != 1) {
                                    dWrite = '√' + d;
                                }
                                if (f != 1) {
                                    fWrite = '√' + f;
                                }
                                if (d != 1) {
                                    hWrite = '√' + h;
                                }
                                resultWritten4th += aWrite + bWrite + signUp + aWrite2nd + dWrite + signUp2nd + eWrite + fWrite +
                                    signUp3rd + gWrite + hWrite;

                                finalResult1st = getSimplified(b, 2);
                                finalResult2nd = getSimplified(d, 2);
                                finalResult3rd = getSimplified(f, 2);
                                finalResult4th = getSimplified(h, 2);

                                if (finalResult1st[2] == b && finalResult2nd[2] == d && finalResult3rd[2] == f && finalResult4th[
                                    2] == h) {
                                    showLastLine = false;
                                }
                                finalResult1st[0] = roundPrice(finalResult1st[0] * a, 4);
                                finalResult2nd[0] = roundPrice(finalResult2nd[0] * a2nd, 4);
                                finalResult3rd[0] = roundPrice(finalResult3rd[0] * e, 4);
                                finalResult4th[0] = roundPrice(finalResult4th[0] * g, 4);
                                if (finalResult1st[2] == finalResult4th[2]) {
                                    finalResult1st[0] += finalResult4th[0];
                                    kill4th = true;
                                }
                                if (finalResult2nd[2] == finalResult3rd[2]) {
                                    finalResult2nd[0] += finalResult3rd[0];
                                    kill3rd = true;
                                    if (finalResult2nd[0] > 0) {
                                        signUp = ' + ';
                                    } else {
                                        signUp = ' ';
                                    }
                                }
                                if (finalResult1st[0] == 1 && finalResult1st[2] != 1) {
                                    finalResult1st[0] = '';
                                } else if (finalResult1st[0] == -1 && finalResult1st[2] != 1) {
                                    finalResult1st[0] = '-';
                                } else if (finalResult1st[2] != 1) {
                                    finalResult1st[0] += ' * ';
                                }
                                if (finalResult2nd[0] == 1 && finalResult2nd[2] != 1) {
                                    finalResult2nd[0] = '';
                                } else if (finalResult2nd[0] == -1 && finalResult2nd[2] != 1) {
                                    finalResult2nd[0] = '-';
                                } else if (finalResult2nd[2] != 1) {
                                    finalResult2nd[0] += ' * ';
                                }
                                if (finalResult3rd[0] == 1 && finalResult3rd[2] != 1) {
                                    finalResult3rd[0] = '';
                                } else if (finalResult3rd[0] == -1 && finalResult3rd[2] != 1) {
                                    finalResult3rd[0] = '-';
                                } else if (finalResult3rd[2] != 1) {
                                    finalResult3rd[0] += ' * ';
                                }
                                if (finalResult4th[0] == 1 && finalResult4th[2] != 1) {
                                    finalResult4th[0] = '';
                                } else if (finalResult4th[0] == -1 && finalResult4th[2] != 1) {
                                    finalResult4th[0] = '-';
                                } else if (finalResult4th[2] != 1) {
                                    finalResult4th[0] += ' * ';
                                }
                                finalResult1st[1] = '';
                                finalResult2nd[1] = '';
                                finalResult3rd[1] = '';
                                finalResult4th[1] = '';
                                if (finalResult1st[2] == 1) {
                                    finalResult1st[2] = '';
                                } else {
                                    finalResult1st[2] = '√' + finalResult1st[2];
                                }
                                if (finalResult2nd[2] == 1) {
                                    finalResult2nd[2] = '';
                                } else {
                                    finalResult2nd[2] = '√' + finalResult2nd[2];
                                }
                                if (finalResult3rd[2] == 1) {
                                    finalResult3rd[2] = '';
                                } else {
                                    finalResult3rd[2] = '√' + finalResult3rd[2];
                                }
                                if (finalResult4th[2] == 1) {
                                    finalResult4th[2] = '';
                                } else {
                                    finalResult4th[2] = '√' + finalResult4th[2];
                                }
                                if (kill3rd) {
                                    signUp2nd = '';
                                    finalResult3rd[0] = '';
                                    finalResult3rd[2] = '';
                                }
                                if (kill4th) {
                                    signUp3rd = '';
                                    finalResult4th[0] = '';
                                    finalResult4th[2] = '';
                                }
                                if (showLastLine || kill3rd || kill4th) {
                                    resultWritten4th += ' = ' + finalResult1st[0] + finalResult1st[2] + signUp + finalResult2nd[0] +
                                        finalResult2nd[2] + signUp2nd + finalResult3rd[0] + finalResult3rd[2] + signUp3rd +
                                        finalResult4th[0] + finalResult4th[2];
                                }
                            }

                            resultWritten2nd += '</tr></table>';
                            addHtml(resultWritten2nd);

                            resultWritten3rd += '</tr></table>';
                            addHtml(resultWritten3rd);

                            // addHtml(resultWritten4th);
                            jawab(resultWritten4th);
                        }
                    }
                };
                calculate();

                function compareNumbers(x, y) {
                    return x - y;
                }

                function isInteger(_n) {
                    return _n % 1 === 0;
                }

                function primeFactorization(num) {
                    var root = Math.sqrt(num),
                        result = arguments[1] || [], //get unnamed paremeter from recursive calls
                        x = 2;

                    if (num % x) { //if not divisible by 2
                        x = 3; //assign first odd
                        while ((num % x) && ((x = x + 2) < root)) {} //iterate odds
                    }
                    //if no factor found then num is prime
                    x = (x <= root) ? x : num;
                    result.push(x); //push latest prime factor

                    //if num isn't prime factor make recursive call
                    return (x === num) ? result : primeFactorization(num / x, result);
                }

                function toPower(primeFactors) {
                    var i, array = [],
                        power = 1,
                        isShorter = false,
                        exponents = [];
                    for (i = 0; i < primeFactors.length; i++) {
                        if (i != primeFactors.length - 1 && primeFactors[i] == primeFactors[i + 1]) {
                            power++;
                        } else {
                            if (power != 1) {
                                array.push(primeFactors[i] + '<sup class="font-s-14">' + power + '</sup>');
                                isShorter = true;
                            } else {
                                array.push(primeFactors[i]);
                            }

                            exponents.push(power);

                            power = 1;
                        }
                    }
                    return [array, isShorter, exponents];
                }

                function getSimplification(x, root) {
                    var simplification = [];
                    var primeFactors = primeFactorization(x);
                    var to_power;
                    var valuesPulled = [];
                    var i, j;
                    var numberInFront = 1,
                        numberUnder = 1;
                    var newRoot, newUnder;
                    var to_powerUnderAfter;
                    var factorizationRoot, factorizationUnder;
                    var simplifyRoot = [],
                        divideRootBy = 1;
                    var index = 1;

                    if (primeFactors.length === 1) {
                        simplification.push('prime');
                    } else {
                        simplification.push(primeFactors.join(' * '));
                        to_power = toPower(primeFactors);
                        index += 1;

                        if (to_power[1]) {
                            simplification.push(to_power[0].join(' * '));

                            for (i = 0; i < to_power[2].length; i++) {
                                for (j = 0; j < Math.floor(to_power[2][i] / root); j++) {
                                    valuesPulled.push(to_power[0][i][0]);
                                }
                            }

                            for (i = 0; i < valuesPulled.length; i++) {
                                numberInFront *= valuesPulled[i];
                            }
                            numberUnder = roundPrice(x / Math.pow(numberInFront, root), 4);


                            factorizationRoot = primeFactorization(root);
                            factorizationUnder = primeFactorization(numberUnder);
                            to_powerUnderAfter = toPower(factorizationUnder);

                            for (i = 0; i < factorizationRoot.length; i++) {
                                for (j = 0; j < to_powerUnderAfter[2].length; j++) {
                                    if (to_powerUnderAfter[2][j] % factorizationRoot[i] == 0) {
                                        simplifyRoot.push(1)
                                    } else {
                                        simplifyRoot.push(0);
                                    }
                                }
                                if (!simplifyRoot.includes(0)) {
                                    divideRootBy *= factorizationRoot[i];
                                    for (j = 0; j < to_powerUnderAfter[2].length; j++) {
                                        to_powerUnderAfter[2][j] /= factorizationRoot[i];
                                    }
                                }
                                simplifyRoot = [];
                            }

                            newRoot = roundPrice(root / divideRootBy, 4);
                            newUnder = roundPrice(Math.pow(numberUnder, 1 / divideRootBy), 4);

                            if (numberInFront != 1 || newRoot !== root) {
                                index += 1;
                                simplification.push([]);
                                simplification[2].push(numberInFront);
                                simplification[2].push(to_powerUnderAfter[0].join(' * '));
                                if (newRoot !== root) {
                                    index += 1;
                                    simplification.push([]);
                                    simplification[3].push(numberInFront);
                                    simplification[3].push(newRoot);
                                    simplification[3].push(newUnder);
                                }
                            }
                        }
                    }
                    return [simplification, index];
                }

                function find_gcf(a, b) {
                    a = Math.abs(a);
                    b = Math.abs(b);
                    if (b > a) {
                        var temp = a;
                        a = b;
                        b = temp;
                    }
                    for (;;) {
                        if (b == 0) {
                            return a;
                        }
                        a = a % b;
                        // a = b.mod(a);
                        if (a == 0) {
                            return b;
                        }
                        b = b % a;
                    }
                }

                function find_lcm(a, b) {
                    return Math.abs((a * b) / find_gcf(a, b));
                }

                function getSimplified(x, root) {
                    var a = x;
                    var n = root;
                    var simplificationAll = getSimplification(a, n);
                    var simplification = simplificationAll[0];

                    if (simplificationAll[1] > 3) {
                        return simplification[3];
                    } else if (simplificationAll[1] > 2) {
                        return [simplification[2][0], root, roundPrice(x / Math.pow(simplification[2][0], root), 4)];
                    } else {
                        return [1, root, x];
                    }
                }
            </script>
        @endif
        <script>
            document.querySelector('#fInput').addEventListener('click', function() {
                ['#simpleMethod'].forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.classList.remove('hidden');
                    });
                });
                ['#advanceMethod'].forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.classList.add('hidden');
                    });
                });
            });
            document.querySelector('#sInput').addEventListener('click', function() {
                ['#simpleMethod'].forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.classList.add('hidden');
                    });
                });
                ['#advanceMethod'].forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.classList.remove('hidden');
                    });
                });
            });
            document.getElementById('operations').addEventListener('change', function() {
                var cal = this.value;
                var show1Elements = document.querySelectorAll(
                    '#aInput, #bInput, #nInput, #xInput, #yInput, #kInput, .show1');
                var show2Elements = document.querySelectorAll(
                    '#aInput, #bInput, #nInput, #cInput, #dInput, #mInput, #xInput, #yInput, #kInput, .show2');
                var show3Elements = document.querySelectorAll(
                    '#aInput, #bInput, #xInput, #yInput, #kInput, #uInput, .show3');
                var show4Elements = document.querySelectorAll(
                    '#aInput, #bInput, #xInput, #yInput, #kInput, #uInput, #cInput, #dInput, .show4');
                var hide1Elements = document.querySelectorAll(
                    '#cInput, #dInput, #mInput, #uInput, .show2, .show3, .show4');
                var hide2Elements = document.querySelectorAll('#uInput, .show1, .show3, .show4');
                var hide3Elements = document.querySelectorAll(
                    '#nInput, #cInput, #dInput, #mInput, .show1, .show2, .show4');
                var hide4Elements = document.querySelectorAll('#nInput, #mInput, .show1, .show2, .show3');

                function showElements(elements) {
                    elements.forEach(function(element) {
                        element.style.display = 'block';
                    });
                }

                function hideElements(elements) {
                    elements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                }
                if (cal == '1') {
                    showElements(show1Elements);
                    hideElements(hide1Elements);
                } else if (cal == '2') {
                    showElements(show2Elements);
                    hideElements(hide2Elements);
                } else if (cal == '3') {
                    showElements(show3Elements);
                    hideElements(hide3Elements);
                } else if (cal == '4') {
                    showElements(show4Elements);
                    hideElements(hide4Elements);
                }
            });
        </script>
    @endpush
</form>
