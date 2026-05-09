<div>
    <style>
        @media (min-width: 992px) { .font-lg-14 { font-size: 14px; } }
        @media (max-width: 620px) { .velocitytab { min-width: 400px; } }
        .bg-gray { background-color: #F6FAFC !important; }
        .tagsUnit { background-color: #2845F5 !important; color: white !important; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3" x-data="{ 
            mode: $wire.entangle('calculator_name'),
            get txt1() {
                if (this.mode === 'z_val') return 'Significance Level α: (0 to 1)';
                return 'Significance Level α: (0 to 0.5)';
            },
            get txt3() {
                if (this.mode === 'f_val') return 'Degrees of Freedom Denominator:';
                return 'Degrees of Freedom';
            },
            get mainText() {
                switch(this.mode) {
                    case 't_val': return 'How Does T Critical Value Calculator Work?';
                    case 'z_val': return 'How Does Z Critical Value Calculator Work?';
                    case 'chi_val': return 'How Does This Calculator Work?';
                    case 'f_val': return 'How Does F Critical Value Calculator Work?';
                    case 'r_val': return 'How Does R Critical Value Calculator Work?';
                    default: return '';
                }
            },
            get f_li() {
                switch(this.mode) {
                    case 't_val': return 'Enter <strong>Significance Level(α)</strong> In The Input Box.';
                    case 'z_val': return 'Enter The <strong>Significance Level(α)</strong> In The Input Box.';
                    case 'chi_val': return 'Enter <strong>Significance Level(α)</strong> In Required Input Box.';
                    case 'f_val': return 'Enter <strong>Significance Level(α)</strong>';
                    case 'r_val': return 'Enter <strong>Significance Level(α)</strong> In Required Input Box.';
                    default: return '';
                }
            },
            get s_li() {
                switch(this.mode) {
                    case 't_val': return 'Put the <strong>Degrees Of Freedom</strong> In The Input Box.';
                    case 'z_val': return 'Use The <strong>Calculate</strong> Button To Get The <strong>Z</strong> Critical Value.';
                    case 'chi_val': return 'Enter <strong>Degree of freedom</strong> In Required Input Box.';
                    case 'f_val': return 'Enter <strong>Degree of freedom</strong> of numerator in required input box.';
                    case 'r_val': return 'Enter <strong>Degree of freedom</strong> In Required Input Box.';
                    default: return '';
                }
            },
            get t_li() {
                switch(this.mode) {
                    case 't_val': return 'Hit The <strong>Calculate</strong> Button To Find <strong>T</strong> Critical Value.';
                    case 'z_val': return '';
                    case 'chi_val': return 'Click The <strong>Calculate</strong> Button.';
                    case 'f_val': return 'Click The <strong>Calculate</strong> Button.';
                    case 'r_val': return 'Click The <strong>Calculate</strong> Button.';
                    default: return '';
                }
            }
        }">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif
            
            <div class="col-12 col-lg-10 mx-auto mt-2 lg:w-[90%] w-full">
                <div class="lg:w-1/5 w-full py-2 font-s-14">{{ $lang['to_calc'] ?? 'To Calculate' }}:</div>
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    @foreach([
                        't_val' => 'T Value',
                        'z_val' => 'Z Value',
                        'f_val' => 'F Value',
                        'chi_val' => 'Chi-Square Value',
                        'r_val' => 'R Value'
                    ] as $val => $label)
                        <div class="lg:w-1/5 w-full px-2 py-1">
                            <div @click="mode = '{{ $val }}'; $wire.setCalculator('{{ $val }}')" 
                                 :class="mode === '{{ $val }}' ? 'tagsUnit' : ''"
                                 class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white veloTabs">
                                {{ $label }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-5">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <div class="space-y-4">
                            <div class="f_input">
                                <label for="first" class="font-s-14 text-blue" x-text="txt1"></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="first" id="first" class="input" aria-label="input" placeholder="0.3" />
                                </div>
                            </div>
                            <div class="s_input" x-show="mode === 'f_val'" x-cloak>
                                <label for="second" class="font-s-14 text-blue">Degrees of Freedom Numerator</label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="second" id="second" class="input" aria-label="input" placeholder="7" />
                                </div>
                            </div>
                            <div class="t_input" x-show="mode !== 'z_val'" x-cloak>
                                <label for="third" class="font-s-14 text-blue" x-text="txt3"></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="third" id="third" class="input" aria-label="input" placeholder="45" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <p class="font-s-18 mt-4"><strong class="text-blue" x-text="mainText"></strong></p>
                        <ul class="mt-2 ms-1 list-disc">
                            <li class="my-2 ms-5" x-html="f_li"></li>
                            <li class="my-2 ms-5" x-html="s_li"></li>
                            <li class="my-2 ms-5" x-show="mode === 'f_val'" x-cloak>Enter Degree of freedom denominator in required input box.</li>
                            <li class="my-2 ms-5" x-show="t_li" x-html="t_li"></li>
                        </ul>
                    </div>
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
                                @if ($detail['submit'] == "t_val")
                                    <div class="lg:w-[80%] w-full mt-2 overflow-auto">
                                        <table class="w-full text-[18px]">
                                            <tr>
                                                <td class="py-2 border-b">T Value for Right Tailed Probability</td>
                                                <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t_jawab'][0] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">T Value for Left Tailed Probability</td>
                                                <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t_jawab'][1] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">T Value for Two Tailed Probability</td>
                                                <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t_jawab'][2] }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="mt-6 overflow-auto">{!! $detail['t_jawab'][3] !!}</div>
                                    <div class="mt-6 overflow-auto">{!! $detail['t_jawab'][4] !!}</div>
                                @elseif ($detail['submit'] == "z_val")
                                    <div class="lg:w-[80%] w-full mt-2 overflow-auto">
                                        <table class="w-full text-[18px]">
                                            <tr>
                                                <td class="py-2 border-b">Z Value</td>
                                                <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['z_jawab'][2], 6) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">Z Value for Right Tailed Probability</td>
                                                <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['z_jawab'][1], 6) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">Z Value for Left Tailed Probability</td>
                                                <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['z_jawab'][0], 6) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">Z Value for Two Tailed Probability</td>
                                                <td class="py-2 border-b"><strong class="text-blue">{{ $detail['z_jawab'][3] }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                @elseif ($detail['submit'] == "chi_val")
                                    <div class="lg:w-[80%] w-full mt-2 overflow-auto">
                                        <table class="w-full text-[18px]">
                                            <tr>
                                                <td class="py-2 border-b">Right Tailed</td>
                                                <td class="py-2 border-b"><strong class="text-blue" id="chi_right"></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">Left Tailed</td>
                                                <td class="py-2 border-b"><strong class="text-blue" id="chi_left"></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">Two Tailed</td>
                                                <td class="py-2 border-b"><strong class="text-blue" id="chi_two"></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                @elseif ($detail['submit'] == "f_val")
                                    <div class="lg:w-[80%] w-full mt-2 overflow-auto">
                                        <table class="w-full text-[18px]">
                                            <tr>
                                                <td class="py-2 border-b">Right Tailed</td>
                                                <td class="py-2 border-b"><strong class="text-blue" id="f_right"></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">Left Tailed</td>
                                                <td class="py-2 border-b"><strong class="text-blue" id="f_left"></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">Two Tailed</td>
                                                <td class="py-2 border-b"><strong class="text-blue" id="f_two"></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                @elseif ($detail['submit'] == "r_val")
                                    <div class="lg:w-[80%] w-full mt-2 overflow-auto">
                                        <table class="w-full text-[18px]">
                                            <tr>
                                                <td class="py-2 border-b">Right Tailed</td>
                                                <td class="py-2 border-b"><strong class="text-blue" id="r_right"></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">Left Tailed</td>
                                                <td class="py-2 border-b"><strong class="text-blue" id="r_left"></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">Two Tailed</td>
                                                <td class="py-2 border-b"><strong class="text-blue" id="r_two"></strong></td>
                                            </tr>
                                        </table>
                                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstat/1.9.1/jstat.min.js"></script>
    <script>
        window.calculateJStat = function(result) {
            if (!result) return;
            if (typeof jStat === 'undefined') {
                setTimeout(function() { window.calculateJStat(result) }, 200);
                return;
            }
            if (result.submit === 'chi_val') {
                let alpha = parseFloat(result.value);
                let df = parseFloat(result.degree);
                setTimeout(function() {
                    let r = document.getElementById('chi_right'); if (r) r.textContent = jStat.chisquare.inv(1 - alpha, df).toFixed(4);
                    let l = document.getElementById('chi_left'); if (l) l.textContent = jStat.chisquare.inv(alpha, df).toFixed(4);
                    let t = document.getElementById('chi_two'); if (t) t.textContent = jStat.chisquare.inv(alpha/2, df).toFixed(4) + ' & ' + jStat.chisquare.inv(1-alpha/2, df).toFixed(4);
                }, 100);
            } else if (result.submit === 'f_val') {
                let alpha = parseFloat(result.first);
                let num_df = parseFloat(result.second);
                let den_df = parseFloat(result.third);
                setTimeout(function() {
                    let r = document.getElementById('f_right'); if (r) r.textContent = jStat.centralF.inv(1 - alpha, num_df, den_df).toFixed(4);
                    let l = document.getElementById('f_left'); if (l) l.textContent = jStat.centralF.inv(alpha, num_df, den_df).toFixed(4);
                    let t = document.getElementById('f_two'); if (t) t.textContent = jStat.centralF.inv(alpha/2, num_df, den_df).toFixed(4) + ' & ' + jStat.centralF.inv(1-alpha/2, num_df, den_df).toFixed(4);
                }, 100);
            } else if (result.submit === 'r_val') {
                let alpha = parseFloat(result.value);
                let df = parseFloat(result.degree);
                let t_val = jStat.studentt.inv(1 - alpha, df);
                let _2t = jStat.studentt.inv(1 - alpha / 2, df);
                let one_tailed = t_val / Math.sqrt(Math.pow(t_val, 2) + df);
                let two_tailed = _2t / Math.sqrt(Math.pow(_2t, 2) + df);
                setTimeout(function() {
                    let r = document.getElementById('r_right'); if (r) r.textContent = one_tailed.toFixed(4);
                    let l = document.getElementById('r_left'); if (l) l.textContent = '-' + one_tailed.toFixed(4);
                    let t = document.getElementById('r_two'); if (t) t.textContent = two_tailed.toFixed(4);
                }, 100);
            }
        };
    </script>
@endpush