<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="expression_unit" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="expression_unit" id="expression_unit" class="input">
                                <option value="1">{!! $lang[2] !!}</option>
                                <option value="2">{!! $lang[3] !!}</option>
                                <option value="3">{!! $lang[4] !!}</option>
                                <option value="4">{!! $lang[5] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 text-center my-3" id="equation-display" wire:ignore x-data="{ expression_unit: @entangle('expression_unit') }">
                        <div x-show="expression_unit === '1'" style="display: none;">$$ a\sqrt[n]{b} $$</div>
                        <div x-show="expression_unit === '2'" style="display: none;">$$ a\sqrt[n]{b}+c\sqrt[m]{d}=? $$</div>
                        <div x-show="expression_unit === '3'" style="display: none;">$$ a\sqrt[n]{b} \cdot c\sqrt[m]{d}=? $$</div>
                        <div x-show="expression_unit === '4'" style="display: none;">$$ \frac{a\sqrt[n]{b}}{c\sqrt[m]{d}}=? $$</div>
                    </div>

                    <div class="col-span-6 num1">
                        <label for="num1" class="font-s-14 text-blue">a ({{ $lang[6] }}):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="num1" id="num1" class="input" aria-label="input" placeholder="5" />
                        </div>
                    </div>
                    <div class="col-span-6 num2">
                        <label for="num2" class="font-s-14 text-blue r">b:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="num2" id="num2" class="input" aria-label="input" placeholder="7" />
                        </div>
                    </div>
                    <div class="col-span-6 num3">
                        <label for="num3" class="font-s-14 text-blue r">n:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="num3" id="num3" class="input" aria-label="input" placeholder="7" />
                        </div>
                    </div>

                    @if ($expression_unit !== '1')
                        <div class="col-span-6 num4">
                            <label for="num4" class="font-s-14 text-blue r">c ({{ $lang[6] }}):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="num4" id="num4" class="input" aria-label="input" placeholder="7" />
                            </div>
                        </div>
                        <div class="col-span-6 num5">
                            <label for="num5" class="font-s-14 text-blue r">d:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="num5" id="num5" class="input" aria-label="input" placeholder="7" />
                            </div>
                        </div>
                        <div class="col-span-6 num6">
                            <label for="num6" class="font-s-14 text-blue r">m:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="num6" id="num6" class="input" aria-label="input" placeholder="7" />
                            </div>
                        </div>
                    @endif

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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{ $lang[7] }}:</strong></p>
                                    <div class="col-12">
                                        <div class="all_result text-[20px] mt-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

        @push('calculatorJS')
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
            <script defer src="{{ url('katex/katex.min.js') }}"></script>
            <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderKaTeX()"></script>

            <script>
                function renderKaTeX() {
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
                }

                document.addEventListener('DOMContentLoaded', renderKaTeX);
                document.addEventListener('livewire:initialized', () => {
                    setTimeout(renderKaTeX, 100);
                });
                function calculate(a, b, c, d, n, m, option) {
                    const container = document.querySelector('.all_result');
                    if (!container) return;
                    container.innerHTML = '';

                    function addHtml(argument) {
                        const p = document.createElement('p');
                        p.className = 'font-s-25 mt-2 text-blue';
                        p.innerHTML = argument;
                        container.appendChild(p);
                    }

                    var newRoot = n;
                    var simplification_first;
                    var simplification_second;
                    var numberwrite = n;
                    var mWrite = m;
                    var num1Write, cWrite;
                    var fline = '', sline = '', tline = '', lline = '';
                    var number_in_front;
                    var expresssion_first, expression_second;
                    var operation = '';

                    if (n == 2) {
                        numberwrite = '';
                    }
                    if (m == 2) {
                        mWrite = '';
                    }
                    if (isNaN(a) || a == 1 || a === '') {
                        a = 1;
                        num1Write = '';
                    } else {
                        num1Write = a + ' * ';
                    }
                    if (isNaN(c) || c == 1 || c === '') {
                        c = 1;
                        cWrite = '';
                    } else {
                        cWrite = c + ' * ';
                    }

                    expresssion_first = [a, n, b];
                    expression_second = [c, m, d];

                    if (!isNaN(b)) {
                        if (isInteger(Math.pow(b, 1/n)) && option == 1) {
                            addHtml(num1Write + '<sup>' + numberwrite + '</sup>√' + b + ' = ' + (a * Math.pow(b, 1/n)));
                            return;
                        } else {
                            if (!isNaN(n)) {
                                simplification_first = getSimplification(b, n);
                            }
                        }
                    }

                    if (!isNaN(d)) {
                        if (!isNaN(m)) {
                            simplification_second = getSimplification(d, m);
                        }
                    }

                    if (!isNaN(b) && !isNaN(n) && (option == 1 || (!isNaN(d) && !isNaN(m)))) {
                        if (option == 1) {
                            fline += num1Write + '<sup>' + numberwrite + '</sup>√' + b;

                            if (simplification_first.length > 2) {
                                fline += ' = ' + num1Write + '<sup>' + numberwrite + '</sup>√(' + simplification_first[1] + ') =';
                                addHtml(fline);

                                sline += '= ' + num1Write + simplification_first[2][0] + ' * ' + '<sup>' + numberwrite + '</sup>√(' + simplification_first[2][1] + ')';
                                expresssion_first[0] = a * simplification_first[2][0];
                                expresssion_first[2] = b / Math.pow(simplification_first[2][0], n);

                                if (simplification_first.length > 3) {
                                    sline += ' =';
                                    if (simplification_first[2][0] != 1) {
                                        addHtml(sline);
                                    }

                                    if (simplification_first[3][1] == 2) {
                                        numberwrite = '';
                                    } else {
                                        numberwrite = simplification_first[3][1];
                                    }
                                    if (a * simplification_first[3][0] == 1) {
                                        num1Write = '';
                                    } else {
                                        num1Write = a * simplification_first[3][0];
                                    }
                                    tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2];
                                    addHtml(tline);
                                    expresssion_first[2] = Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1]));
                                    expresssion_first[1] = simplification_first[3][1];
                                } else {
                                    addHtml(sline);
                                }

                                if (expresssion_first[0] == 1) {
                                    expresssion_first[0] = '';
                                } else {
                                    expresssion_first[0] += ' * ';
                                }
                                if (expresssion_first[1] == 2) {
                                    expresssion_first[1] = '';
                                }

                                lline += '= ' + expresssion_first[0] + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2];
                                if (lline != sline && lline != tline) {
                                    addHtml(lline);
                                }
                            } else {
                                addHtml(fline);
                                addHtml('{{ $lang[8] }}.');
                            }
                        }

                        else if (option == 2) {
                            if (c >= 0) {
                                operation = ' + ';
                            } else {
                                operation = ' ';
                            }
                            if (isInteger(Math.pow(b, 1/n)) && isInteger(Math.pow(d, 1/m))) {
                                addHtml(num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ' + (a * Math.pow(b, 1/n)) + ' + ' + (c * Math.pow(d, 1/m)) + ' = ' + (a * Math.pow(b, 1/n) + c * Math.pow(d, 1/m)));
                            }
                            else if (isInteger(Math.pow(b, 1/n))) {
                                fline += num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d;
                                if (simplification_second.length > 2) {
                                    fline += ' = ' + Math.pow(b, 1/n) + operation + cWrite + '<sup>' + mWrite + '</sup>√(' + simplification_second[1] + ') =';
                                    addHtml(fline);

                                    sline += '= ' + Math.pow(b, 1/n) + operation + cWrite + simplification_second[2][0] + ' * ' + '<sup>' + mWrite + '</sup>√(' + simplification_second[2][1] + ')';
                                    expression_second[0] = c * simplification_second[2][0];
                                    expression_second[2] = d / Math.pow(simplification_second[2][0], m);

                                    if (simplification_second.length > 3) {
                                        sline += ' =';
                                        if (simplification_second[2][0] != 1) {
                                            addHtml(sline);
                                        }

                                        if (simplification_second[3][1] == 2) {
                                            mWrite = '';
                                        } else {
                                            mWrite = simplification_second[3][1];
                                        }
                                        if (c * simplification_second[3][0] == 1) {
                                            cWrite = '';
                                        } else {
                                            cWrite = c * simplification_second[3][0];
                                        }
                                        tline += '= ' + Math.pow(b, 1/n) + operation + cWrite + '<sup>' + mWrite + '</sup>√' + simplification_second[3][2];
                                        addHtml(tline);
                                        expression_second[2] = Math.pow(expression_second[2], 1/(expression_second[1] / simplification_second[3][1]));
                                        expression_second[1] = simplification_second[3][1];
                                    } else {
                                        addHtml(sline);
                                    }

                                    if (expression_second[0] == 1) {
                                        expression_second[0] = '';
                                    } else {
                                        expression_second[0] += ' * ';
                                    }
                                    if (expression_second[1] == 2) {
                                        expression_second[1] = '';
                                    }

                                    lline += '= ' + Math.pow(b, 1/n) + operation + expression_second[0] + '<sup>' + expression_second[1] + '</sup>√' + expression_second[2];
                                    if (lline != sline && lline != tline) {
                                        addHtml(lline);
                                    }
                                } else {
                                    fline += ' = ' + Math.pow(b, 1/n) + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d;
                                    addHtml(fline);
                                }
                            }
                            else if (isInteger(Math.pow(d, 1/m))) {
                                fline += num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d;
                                if (simplification_first.length > 2) {
                                    fline += ' = ' + num1Write + '<sup>' + numberwrite + '</sup>√(' + simplification_first[1] + ')' + operation + Math.pow(d, 1/m) + ' =';
                                    addHtml(fline);

                                    sline += '= ' + num1Write + simplification_first[2][0] + ' * ' + '<sup>' + numberwrite + '</sup>√(' + simplification_first[2][1] + ')' + operation + Math.pow(d, 1/m);
                                    expresssion_first[0] = a * simplification_first[2][0];
                                    expresssion_first[2] = b / Math.pow(simplification_first[2][0], n);

                                    if (simplification_first.length > 3) {
                                        sline += ' =';
                                        if (simplification_first[2][0] != 1) {
                                            addHtml(sline);
                                        }

                                        if (simplification_first[3][1] == 2) {
                                            numberwrite = '';
                                        } else {
                                            numberwrite = simplification_first[3][1];
                                        }
                                        if (a * simplification_first[3][0] == 1) {
                                            num1Write = '';
                                        } else {
                                            num1Write = a * simplification_first[3][0];
                                        }
                                        tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2] + operation + Math.pow(d, 1/m);
                                        addHtml(tline);
                                        expresssion_first[2] = Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1]));
                                        expresssion_first[1] = simplification_first[3][1];
                                    } else {
                                        addHtml(sline);
                                    }

                                    if (expresssion_first[0] == 1) {
                                        expresssion_first[0] = '';
                                    } else {
                                        expresssion_first[0] += ' * ';
                                    }
                                    if (expresssion_first[1] == 2) {
                                        expresssion_first[1] = '';
                                    }

                                    lline += '= ' + expresssion_first[0] + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2] + operation + Math.pow(d, 1/m);
                                    if (lline != sline && lline != tline) {
                                        addHtml(lline);
                                    }
                                } else {
                                    fline += ' = ' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + Math.pow(d, 1/m);
                                    addHtml(fline);
                                }
                            }
                            else {
                                fline += num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ';

                                if (simplification_first.length > 2 && simplification_second.length > 2) {
                                    fline += num1Write + '<sup>' + numberwrite + '</sup>√(' + simplification_first[1] + ')' + operation + cWrite + '<sup>' + mWrite + '</sup>√(' + simplification_second[1] + ') =';
                                    addHtml(fline);
                                    sline += '= ' + num1Write + simplification_first[2][0] + ' * ' + '<sup>' + numberwrite + '</sup>√(' + simplification_first[2][1] + ')' + operation + cWrite + simplification_second[2][0] + ' * ' + '<sup>' + mWrite + '</sup>√(' + simplification_second[2][1] + ')';

                                    expresssion_first[0] = a * simplification_first[2][0];
                                    expresssion_first[2] = b / Math.pow(simplification_first[2][0], n);
                                    expression_second[0] = c * simplification_second[2][0];
                                    expression_second[2] = d / Math.pow(simplification_second[2][0], m);
                                    if (expresssion_first[0] == 1) {
                                        expresssion_first[0] = '';
                                    }
                                    if (expresssion_first[1] == 2) {
                                        expresssion_first[1] = '';
                                    }
                                    if (expression_second[0] == 1) {
                                        expression_second[0] = '';
                                    }
                                    if (expression_second[1] == 2) {
                                        expression_second[1] = '';
                                    }

                                    if (simplification_first.length > 3 && simplification_second.length > 3) {
                                        sline += ' =';
                                        if (simplification_first[2][0] != 1 && simplification_second[2][0] != 1) {
                                            addHtml(sline);
                                        }
                                        if (simplification_first[3][1] == 2) {
                                            numberwrite = '';
                                        } else {
                                            numberwrite = simplification_first[3][1];
                                        }
                                        if (a * simplification_first[3][0] == 1) {
                                            num1Write = '';
                                        } else {
                                            num1Write = a * simplification_first[3][0];
                                        }
                                        if (simplification_second[3][1] == 2) {
                                            mWrite = '';
                                        } else {
                                            mWrite = simplification_second[3][1];
                                        }
                                        if (a * simplification_second[3][0] == 1) {
                                            cWrite = '';
                                        } else {
                                            cWrite = c * simplification_second[3][0];
                                        }

                                        expresssion_first[2] = Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1]));
                                        expresssion_first[1] = simplification_first[3][1];
                                        expression_second[2] = Math.pow(expression_second[2], 1/(expression_second[1] / simplification_second[3][1]));
                                        expression_second[1] = simplification_second[3][1];

                                        tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2] + operation + cWrite + '<sup>' + mWrite + '</sup>√' + simplification_second[3][2];
                                        addHtml(tline);
                                    } else if (simplification_first.length > 3 && simplification_second.length <= 3) {
                                        if (simplification_first[2][0] != 1 && simplification_second[2][0] != 1) {
                                            addHtml(sline);
                                        }
                                        if (simplification_first[3][1] == 2) {
                                            numberwrite = '';
                                        } else {
                                            numberwrite = simplification_first[3][1];
                                        }
                                        if (a * simplification_first[3][0] == 1) {
                                            num1Write = '';
                                        } else {
                                            num1Write = a * simplification_first[3][0];
                                        }

                                        expresssion_first[2] = Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1]));
                                        expresssion_first[1] = simplification_first[3][1];

                                        tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2] + operation + expression_second[0] + '<sup>' + expression_second[1] + '</sup>√' + expression_second[2];
                                        addHtml(tline);
                                    } else if (simplification_first.length <= 3 && simplification_second.length > 3) {
                                        if (simplification_first[2][0] != 1 && simplification_second[2][0] != 1) {
                                            addHtml(sline);
                                        }
                                        if (simplification_second[3][1] == 2) {
                                            mWrite = '';
                                        } else {
                                            mWrite = simplification_second[3][1];
                                        }
                                        if (a * simplification_second[3][0] == 1) {
                                            cWrite = '';
                                        } else {
                                            cWrite = c * simplification_second[3][0];
                                        }

                                        expression_second[2] = Math.pow(expression_second[2], 1/(expression_second[1] / simplification_second[3][1]));
                                        expression_second[1] = simplification_second[3][1];

                                        tline += '= ' + expresssion_first[0] + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2] + operation + cWrite + '<sup>' + mWrite + '</sup>√' + simplification_second[3][2];
                                        addHtml(tline);
                                    } else {
                                        addHtml(sline);
                                    }
                                } else if (simplification_first.length > 2 && simplification_second.length <= 2) {
                                    if (c == 1) {
                                        cWrite = '';
                                    }
                                    fline += num1Write + '<sup>' + numberwrite + '</sup>√(' + simplification_first[1] + ')' + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' =';
                                    addHtml(fline);
                                    sline += '= ' + num1Write + simplification_first[2][0] + ' * ' + '<sup>' + numberwrite + '</sup>√(' + simplification_first[2][1] + ')' + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d;

                                    expresssion_first[0] = a * simplification_first[2][0];
                                    expresssion_first[2] = b / Math.pow(simplification_first[2][0], n);

                                    if (simplification_first.length > 3) {
                                        sline += ' =';
                                        expresssion_first[2] = Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1]));
                                        expresssion_first[1] = simplification_first[3][1];

                                        if (simplification_first[2][0] != 1) {
                                            addHtml(sline);
                                        }
                                        if (simplification_first[3][1] == 2) {
                                            numberwrite = '';
                                        } else {
                                            numberwrite = simplification_first[3][1];
                                        }
                                        if (a * simplification_first[3][0] == 1) {
                                            num1Write = '';
                                        } else {
                                            num1Write = a * simplification_first[3][0];
                                        }
                                        tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2] + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d;
                                        addHtml(tline);
                                    } else {
                                        addHtml(sline);
                                    }
                                } else if (simplification_first.length <= 2 && simplification_second.length > 2) {
                                    if (a == 1) {
                                        num1Write = '';
                                    }
                                    fline += num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√(' + simplification_second[1] + ') =';
                                    addHtml(fline);
                                    sline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + simplification_second[2][0] + ' * ' + '<sup>' + mWrite + '</sup>√(' + simplification_second[2][1] + ')';

                                    expression_second[0] = c * simplification_second[2][0];
                                    expression_second[2] = d / Math.pow(simplification_second[2][0], m);

                                    if (simplification_second.length > 3) {
                                        sline += ' =';
                                        expression_second[2] = Math.pow(expression_second[2], 1/(expression_second[1] / simplification_second[3][1]));
                                        expression_second[1] = simplification_second[3][1];

                                        if (simplification_second[2][0] != 1) {
                                            addHtml(sline);
                                        }
                                        if (simplification_second[3][1] == 2) {
                                            mWrite = '';
                                        } else {
                                            mWrite = simplification_second[3][1];
                                        }
                                        if (a * simplification_second[3][0] == 1) {
                                            cWrite = '';
                                        } else {
                                            cWrite = c * simplification_second[3][0];
                                        }
                                        tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + simplification_second[3][2];
                                        addHtml(tline);
                                    } else {
                                        addHtml(sline);
                                    }
                                } else if (b == d && n == m) {
                                    addHtml(num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ' + (a + c) + '<sup>' + numberwrite + '</sup>√' + b);
                                    return;
                                } else {
                                    addHtml(num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d);
                                    addHtml('{{ $lang[8] }}.');
                                }

                                if (simplification_first.length > 2 || simplification_second.length > 2) {
                                    number_in_front = expresssion_first[0] + expression_second[0];

                                    if (expresssion_first[0] == 1) {
                                        expresssion_first[0] = '';
                                    } else {
                                        expresssion_first[0] += ' * ';
                                    }
                                    if (expresssion_first[1] == 2) {
                                        expresssion_first[1] = '';
                                    }
                                    if (expression_second[0] == 1) {
                                        expression_second[0] = '';
                                    } else {
                                        expression_second[0] += ' * ';
                                    }
                                    if (expression_second[1] == 2) {
                                        expression_second[1] = '';
                                    }

                                    lline += '= ' + expresssion_first[0] + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2] + operation + expression_second[0] + '<sup>' + expression_second[1] + '</sup>√' + expression_second[2];
                                    if (lline != sline && lline != tline) {
                                        addHtml(lline);
                                    }
                                }

                                if (expresssion_first[1] == expression_second[1] && expresssion_first[2] == expression_second[2]) {
                                    addHtml('= ' + number_in_front + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2]);
                                }
                            }
                        }

                        else if (option == 3) {
                            if (isInteger(Math.pow(b, 1/n)) && isInteger(Math.pow(d, 1/m))) {
                                addHtml(num1Write + '<sup>' + numberwrite + '</sup>√' + b + ' * ' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ' + num1Write + Math.pow(b, 1/n) + ' * ' + cWrite + Math.pow(d, 1/m) + ' = ' + (a * Math.pow(b, 1/n) * c * Math.pow(d, 1/m)));
                                return;
                            } else if (isInteger(Math.pow(b, 1/n))) {
                                addHtml(num1Write + '<sup>' + numberwrite + '</sup>√' + b + ' * ' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ' + num1Write + Math.pow(b, 1/n) + ' * ' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' =');
                                a = a * Math.pow(b, 1/n) * c;
                                num1Write = a + ' * ';
                                if (a == 1) {
                                    num1Write = '';
                                }
                                b = d;
                                n = m;
                                numberwrite = mWrite;
                            } else if (isInteger(Math.pow(d, 1/m))) {
                                addHtml(num1Write + '<sup>' + numberwrite + '</sup>√' + b + ' * ' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ' * ' + cWrite + Math.pow(d, 1/m) + ' =');
                                a = a * c * Math.pow(d, 1/m);
                                num1Write = a + ' * ';
                                if (a == 1) {
                                    num1Write = '';
                                }
                            } else {
                                newRoot = simply_lcm(n, m);
                                if (newRoot == 2) {
                                    newRoot = '';
                                }
                                number_in_front = a * c;
                                if (number_in_front == 1) {
                                    number_in_front = '';
                                } else {
                                    number_in_front += ' * ';
                                }
                                addHtml(num1Write + '<sup>' + numberwrite + '</sup>√' + b + ' * ' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ' + number_in_front + '<sup>' + newRoot + '</sup>√(' + (Math.pow(b, simply_lcm(n, m)/n)) + ' * ' + (Math.pow(d, simply_lcm(n, m)/m)) + ') = ');

                                b = Math.pow(b, simply_lcm(n, m)/n) * Math.pow(d, simply_lcm(n, m)/m);
                                a = a * c;
                                num1Write = a + ' * ';
                                n = simply_lcm(n, m);
                                numberwrite = n;
                                expresssion_first = [a, n, b];
                                if (a == 1) {
                                    num1Write = '';
                                }
                                if (n == 2) {
                                    numberwrite = '';
                                }
                            }
                            fline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + b;

                            simplification_first = getSimplification(b, n);

                            if (isInteger(Math.round(Math.pow(b, 1/n), 5))) {
                                fline += ' = ' + Math.round(Math.pow(b, 1/n), 5);
                                addHtml(fline);
                                return;
                            } else if (simplification_first.length > 2) {
                                fline += ' = ' + num1Write + '<sup>' + numberwrite + '</sup>√(' + simplification_first[1] + ') =';
                                addHtml(fline);

                                sline += '= ' + num1Write + simplification_first[2][0] + ' * ' + '<sup>' + numberwrite + '</sup>√(' + simplification_first[2][1] + ')';
                                expresssion_first[0] = a * simplification_first[2][0];
                                expresssion_first[2] = b / Math.pow(simplification_first[2][0], n);

                                if (simplification_first.length > 3) {
                                    sline += ' =';
                                    if (simplification_first[2][0] != 1) {
                                        addHtml(sline);
                                    }

                                    if (simplification_first[3][1] == 2) {
                                        numberwrite = '';
                                    } else {
                                        numberwrite = simplification_first[3][1];
                                    }
                                    if (a * simplification_first[3][0] == 1) {
                                        num1Write = '';
                                    } else {
                                        num1Write = a * simplification_first[3][0];
                                    }
                                    tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2];
                                    addHtml(tline);
                                    expresssion_first[2] = Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1]));
                                    expresssion_first[1] = simplification_first[3][1];
                                } else {
                                    addHtml(sline);
                                }

                                if (expresssion_first[0] == 1) {
                                    expresssion_first[0] = '';
                                } else {
                                    expresssion_first[0] += ' * ';
                                }
                                if (expresssion_first[1] == 2) {
                                    expresssion_first[1] = '';
                                }

                                lline += '= ' + expresssion_first[0] + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2];
                                if (lline != sline && lline != tline) {
                                    addHtml(lline);
                                }
                            } else {
                                addHtml(fline);
                            }
                        }

                        else if (option == 4) {
                            if (n == m && b == d) {
                                addHtml('(' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ') / (' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ') = ' + (a / c));
                                return;
                            } else if (isInteger(Math.pow(b, 1/n)) && isInteger(Math.pow(d, 1/m))) {
                                addHtml('(' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ') / (' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = (' + num1Write + Math.pow(b, 1/n) + ') / (' + cWrite + Math.pow(d, 1/m) + ') = ' + (Math.round((a * Math.pow(b, 1/n)) / (c * Math.pow(d, 1/m)), 3)));
                                return;
                            } else if (isInteger(Math.pow(b, 1/n))) {
                                addHtml('(' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ') / (' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ') = (' + num1Write + Math.pow(b, 1/n) + ') * (' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ') =');
                                a = Math.round(a * Math.pow(b, 1/n) / (c * d), 5);
                                num1Write = a + ' * ';
                                if (a == 1) {
                                    num1Write = '';
                                }
                                b = Math.pow(d, m-1);
                                n = m;
                                numberwrite = mWrite;
                            } else if (isInteger(Math.pow(d, 1/m))) {
                                addHtml('(' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ') / (' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ') = (' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ') / (' + cWrite + Math.pow(d, 1/m) + ') =');
                                a = Math.round(a / (c * Math.pow(d, 1/m)), 5);
                                num1Write = a + ' * ';
                                if (a == 1) {
                                    num1Write = '';
                                }
                            } else {
                                newRoot = simply_lcm(n, m);
                                if (newRoot == 2) {
                                    newRoot = '';
                                }
                                number_in_front = Math.round(a / (c * d), 5);
                                if (number_in_front == 1) {
                                    number_in_front = '';
                                } else {
                                    number_in_front += ' * ';
                                }
                                addHtml('(' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ') / (' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ') = ' + number_in_front + '<sup>' + newRoot + '</sup>√(' + (Math.pow(b, simply_lcm(n, m)/n)) + ' * ' + (Math.pow(d, simply_lcm(n, m)/m)) + '<sup>' + (m-1) + '</sup>) = ');

                                b = Math.round(Math.pow(b, simply_lcm(n, m)/n) * Math.pow(d, (simply_lcm(n, m)/m)*(m-1)), 5);
                                a = Math.round(a / (c * d), 5);
                                num1Write = a + ' * ';
                                n = simply_lcm(n, m);
                                numberwrite = n;
                                expresssion_first = [a, n, b];
                                if (a == 1) {
                                    num1Write = '';
                                }
                                if (n == 2) {
                                    numberwrite = '';
                                }
                            }
                            fline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + b;

                            simplification_first = getSimplification(b, n);

                            if (simplification_first.length > 2) {
                                fline += ' = ' + num1Write + '<sup>' + numberwrite + '</sup>√(' + simplification_first[1] + ') =';
                                addHtml(fline);
                                sline += '= ' + num1Write + simplification_first[2][0] + ' * ' + '<sup>' + numberwrite + '</sup>√(' + simplification_first[2][1] + ')';
                                expresssion_first[0] = Math.round(a * simplification_first[2][0], 5);
                                expresssion_first[2] = b / Math.pow(simplification_first[2][0], n);

                                if (simplification_first.length > 3) {
                                    sline += ' =';
                                    if (simplification_first[2][0] != 1) {
                                        addHtml(sline);
                                    }

                                    if (simplification_first[3][1] == 2) {
                                        numberwrite = '';
                                    } else {
                                        numberwrite = simplification_first[3][1];
                                    }
                                    if (a * simplification_first[3][0] == 1) {
                                        num1Write = '';
                                    } else {
                                        num1Write = Math.round(a * simplification_first[3][0], 5);
                                    }
                                    tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2];
                                    addHtml(tline);
                                    expresssion_first[2] = Math.round(Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1])), 5);
                                    expresssion_first[1] = simplification_first[3][1];
                                } else {
                                    addHtml(sline);
                                }

                                if (expresssion_first[0] == 1) {
                                    expresssion_first[0] = '';
                                } else {
                                    expresssion_first[0] += ' * ';
                                }
                                if (expresssion_first[1] == 2) {
                                    expresssion_first[1] = '';
                                }

                                lline += '= ' + expresssion_first[0] + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2];
                                if (lline != sline && lline != tline) {
                                    addHtml(lline);
                                }
                            } else {
                                addHtml(fline);
                            }
                        }
                    }
                }

                function compareNumbers(x, y) {
                    return x - y;
                }

                function isInteger(_n) {
                    return _n % 1 === 0;
                }

                function primesimplify(num) {
                    var root = Math.sqrt(num),
                        result = arguments[1] || [],
                        x = 2;

                    if (num % x) {
                        x = 3;
                        while ((num % x) && ((x = x + 2) < root)) {}
                    }
                    x = (x <= root) ? x : num;
                    result.push(x);

                    return (x === num) ? result : primesimplify(num / x, result);
                }

                function forpower(primeFactors) {
                    var i, array = [], power = 1, isShorter = false, exponents = [];
                    for (i = 0; i < primeFactors.length; i++) {
                        if (i != primeFactors.length - 1 && primeFactors[i] == primeFactors[i + 1]) {
                            power++;
                        } else {
                            if (power != 1) {
                                array.push(primeFactors[i] + '<sup>' + power + '</sup>');
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
                    var primeFactors = primesimplify(x);
                    var to_power;
                    var valuesPulled = [];
                    var i, j;
                    var numberInFront = 1, numberUnder = 1;
                    var newRoot, newUnder;
                    var to_powerUnderAfter;
                    var factorizationRoot, factorizationUnder;
                    var simplifyRoot = [], divideRootBy = 1;

                    if (primeFactors.length === 1) {
                        simplification.push('prime');
                    } else {
                        simplification.push(primeFactors.join(' * '));
                        to_power = forpower(primeFactors);

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
                            numberUnder = Math.round(x / Math.pow(numberInFront, root), 5);

                            factorizationRoot = primesimplify(root);
                            factorizationUnder = primesimplify(numberUnder);
                            to_powerUnderAfter = forpower(factorizationUnder);

                            for (i = 0; i < factorizationRoot.length; i++) {
                                for (j = 0; j < to_powerUnderAfter[2].length; j++) {
                                    if (to_powerUnderAfter[2][j] % factorizationRoot[i] == 0) {
                                        simplifyRoot.push(1);
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

                            newRoot = Math.round(root / divideRootBy, 5);
                            newUnder = Math.round(Math.pow(numberUnder, 1/divideRootBy), 5);

                            if (numberInFront != 1 || newRoot !== root) {
                                simplification.push([]);
                                simplification[2].push(numberInFront);
                                simplification[2].push(to_powerUnderAfter[0].join(' * '));
                                if (newRoot !== root) {
                                    simplification.push([]);
                                    simplification[3].push(numberInFront);
                                    simplification[3].push(newRoot);
                                    simplification[3].push(newUnder);
                                }
                            }
                        }
                    }
                    return simplification;
                }

                function simplify_gcf(a, b) {
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
                        if (a == 0) {
                            return b;
                        }
                        b = b % a;
                    }
                }

                function simply_lcm(a, b) {
                    return Math.abs((a * b) / simplify_gcf(a, b));
                }
            </script>
        @endpush
    </form>
</div>
