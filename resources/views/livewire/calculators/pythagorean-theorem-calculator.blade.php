<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    {{-- Left Column: All Inputs --}}
                    <div class="col-span-6">
                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="for" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="for" class="input" id="for" aria-label="select">
                                    <option value="a">{{ $lang['2'] }} a</option>
                                    <option value="b">{{ $lang['2'] }} b</option>
                                    <option value="c">{{ $lang['3'] }} c</option>
                                    <option value="ar">{{ $lang['6'] }} A</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="one" class="font-s-14 text-blue one">
                                @if ($for !== 'a')
                                    {{ $lang[2] }} a
                                @else
                                    {{ $lang[2] }} b
                                @endif
                            </label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="one" id="one" class="input" aria-label="input" />
                            </div>
                        </div>

                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="two" class="font-s-14 text-blue two">
                                @if ($for === 'c' || $for === 'ar')
                                    {{ $lang[2] }} b
                                @else
                                    {{ $lang[3] }} c
                                @endif
                            </label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="two" id="two" class="input" aria-label="input" />
                            </div>
                        </div>

                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="unit" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="unit" class="input" id="unit" aria-label="select">
                                    <option value="m">m</option>
                                    <option value="cm">cm</option>
                                    <option value="mm">mm</option>
                                    <option value="yd">yd</option>
                                    <option value="ft">ft</option>
                                    <option value="in">in</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="nbr" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="nbr" class="input" id="nbr" aria-label="select">
                                    @for ($i = 0; $i <= 9; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Visualization --}}
                    <div class="col-span-6 flex flex-col items-center justify-center">
                        <div class="w-full text-[32px] text-center mt-5">
                            @if ($for === 'a')
                                <p id="aText"><strong>a = <span class="quadratic_square-root">c² - b²</span></strong></p>
                            @elseif ($for === 'b')
                                <p id="bText"><strong>b = <span class="quadratic_square-root">c² - a²</span></strong></p>
                            @elseif ($for === 'c')
                                <p id="cText"><strong>c = <span class="quadratic_square-root">a² + b²</span></strong></p>
                            @elseif ($for === 'ar')
                                <p id="areaText"><strong>A = <span class="quadratic_fraction"><span class="num">1</span><span>2</span></span> ab</strong></p>
                            @endif
                        </div>
                        <div class="w-full text-center mt-5">
                            <img src="{{ asset('images/tri-ang.webp') }}" width="220" height="100%" alt="Pythagorean Theorem" class="mx-auto" loading="lazy" decoding="async">
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @isset($detail)
        <hr>
        <div id="result-section" wire:key="result-{{ count($detail) }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full text-[18px]">
                                @if($for === 'a')
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['2']}} a</strong></td>
                                        <td class="py-2 border-b text-blue-700 font-bold">{{round($detail['a'], $nbr)}} {{$unit}}</td>
                                    </tr>
                                @elseif($for === 'b')
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['2']}} b</strong></td>
                                        <td class="py-2 border-b text-blue-700 font-bold">{{round($detail['b'], $nbr)}} {{$unit}}</td>
                                    </tr>
                                @elseif($for === 'c')
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['3']}} c</strong></td>
                                        <td class="py-2 border-b text-blue-700 font-bold">{{round($detail['c'], $nbr)}} {{$unit}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['6']}}</strong></td>
                                        <td class="py-2 border-b text-blue-700 font-bold">{{round($detail['area'], $nbr)}} {{$unit}}²</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full text-[16px]">
                                @if($for !== 'ar')
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{ $lang['6'] }}</td>
                                        <td class="py-2 border-b font-semibold">{{round($detail['area'], $nbr)}} {{$unit}}²</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['7'] }}</td>
                                    <td class="py-2 border-b font-semibold">{{round($detail['peri'], $nbr)}} {{$unit}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">∠α</td>
                                    <td class="py-2 border-b font-semibold">{{round($detail['a_deg'], $nbr)}}° ({{round($detail['alfa'], $nbr)}} rad)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">∠β</td>
                                    <td class="py-2 border-b font-semibold">{{round($detail['b_deg'], $nbr)}}° ({{round($detail['beta'], $nbr)}} rad)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">h</td>
                                    <td class="py-2 border-b font-semibold">{{round($detail['h'], $nbr)}} {{$unit}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px] math-render">
                            <p class="mt-3"><strong>Step-by-Step Calculation:</strong></p>
                            @if($for === 'a')
                                <p class="mt-3">\( a = \sqrt{c^2 - b^2} \)</p>
                                <p class="mt-3">\( a = \sqrt{ {{ $detail['c'] }}^2 - {{ $detail['b'] }}^2} \)</p>
                                <p class="mt-3">\( a = \sqrt{ {{ pow($detail['c'], 2) }} - {{ pow($detail['b'], 2) }}} \)</p>
                                <p class="mt-3">\( a = \sqrt{ {{ pow($detail['c'], 2) - pow($detail['b'], 2) }}} \)</p>
                                <p class="mt-3">\( a = {{ $detail['a'] }} \)</p>
                            @elseif($for === 'b')
                                <p class="mt-3">\( b = \sqrt{c^2 - a^2} \)</p>
                                <p class="mt-3">\( b = \sqrt{ {{ $detail['c'] }}^2 - {{ $detail['a'] }}^2} \)</p>
                                <p class="mt-3">\( b = \sqrt{ {{ pow($detail['c'], 2) }} - {{ pow($detail['a'], 2) }}} \)</p>
                                <p class="mt-3">\( b = \sqrt{ {{ pow($detail['c'], 2) - pow($detail['a'], 2) }}} \)</p>
                                <p class="mt-3">\( b = {{ $detail['b'] }} \)</p>
                            @elseif($for === 'c' || $for === 'ar')
                                <p class="mt-3">\( c = \sqrt{a^2 + b^2} \)</p>
                                <p class="mt-3">\( c = \sqrt{ {{ $detail['a'] }}^2 + {{ $detail['b'] }}^2} \)</p>
                                <p class="mt-3">\( c = \sqrt{ {{ pow($detail['a'], 2) }} + {{ pow($detail['b'], 2) }}} \)</p>
                                <p class="mt-3">\( c = \sqrt{ {{ pow($detail['a'], 2) + pow($detail['b'], 2) }}} \)</p>
                                <p class="mt-3">\( c = {{ $detail['c'] }} \)</p>
                            @endif
                            <p class="mt-3">\( \alpha = \sin^{-1}(\frac{a}{c}) = \sin^{-1}(\frac{ {{ $detail['a'] }} }{ {{ $detail['c'] }} }) = {{ round($detail['a_deg'], $nbr) }}^\circ \)</p>
                            <p class="mt-3">\( \beta = \sin^{-1}(\frac{b}{c}) = \sin^{-1}(\frac{ {{ $detail['b'] }} }{ {{ $detail['c'] }} }) = {{ round($detail['b_deg'], $nbr) }}^\circ \)</p>
                            <p class="mt-3">\( \text{Area} = \frac{1}{2}ab = \frac{ {{ $detail['a'] }} \times {{ $detail['b'] }} }{2} = {{ $detail['area'] }} \)</p>
                            <p class="mt-3">\( \text{ {{$lang['7']}}} = a + b + c = {{ $detail['a'] }} + {{ $detail['b'] }} + {{ $detail['c'] }} = {{ $detail['peri'] }} \)</p>
                            <p class="mt-3">\( h = \frac{a \times b}{c} = \frac{ {{ $detail['a'] }} \times {{ $detail['b'] }} }{ {{ $detail['c'] }} } = {{ $detail['h'] }} \)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('math-updated', () => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });
            });
        </script>
    @endpush
</div>
