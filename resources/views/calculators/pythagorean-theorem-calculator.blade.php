<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                if (!isset($detail)) {
                    $_POST['unit'] = "ft";
                    $_POST['nbr'] = "5";
                }
            @endphp
            <div class="col-span-6">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="for" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                    <div class="w-full py-2">
                        <select name="for" class="input" id="for" aria-label="select">
                            <option value="a" {{ isset($_POST['for']) && $_POST['for']=='a'?'selected':'' }}><?=$lang['2']?> a</option>
                            <option value="b" {{ isset($_POST['for']) && $_POST['for']=='b'?'selected':'' }}><?=$lang['2']?> b</option>
                            <option value="c" {{ isset($_POST['for']) && $_POST['for']=='c'?'selected':'' }}><?=$lang['3']?> c</option>
                            <option value="ar" {{ isset($_POST['for']) && $_POST['for']=='ar'?'selected':'' }}><?=$lang['6']?> A</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="one" class="font-s-14 text-blue one">
                        @if(isset($_POST['for']) && $_POST['for'] !== 'a')
                            {{$lang[2]}} a
                        @else
                            {{$lang[2]}} b
                        @endif
                    </label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="one" id="one" class="input" value="{{ isset($_POST['one'])?$_POST['one']:'12' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="two" class="font-s-14 text-blue two">
                        @if(isset($_POST['for']) && ($_POST['for'] === 'c' || $_POST['for'] === 'ar'))
                            {{$lang[2]}} b
                        @else
                            {{$lang[3]}} c
                        @endif
                    </label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="two" id="two" class="input" value="{{ isset($_POST['two'])?$_POST['two']:'23' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="unit" class="font-s-14 text-blue">{{$lang['4']}}:</label>
                    <div class="w-full py-2">
                        <select name="unit" class="input" id="unit" aria-label="select">
                            <option value="m" {{ isset($_POST['unit']) && $_POST['unit']=='m'?'selected':'' }}>m</option>
                            <option value="cm" {{ isset($_POST['unit']) && $_POST['unit']=='cm'?'selected':'' }}>cm</option>
                            <option value="mm" {{ isset($_POST['unit']) && $_POST['unit']=='mm'?'selected':'' }}>mm</option>
                            <option value="yd" {{ isset($_POST['unit']) && $_POST['unit']=='yd'?'selected':'' }}>yd</option>
                            <option value="ft" {{ isset($_POST['unit']) && $_POST['unit']=='ft'?'selected':'' }}>ft</option>
                            <option value="in" {{ isset($_POST['unit']) && $_POST['unit']=='in'?'selected':'' }}>in</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="nbr" class="font-s-14 text-blue">{{$lang['5']}}:</label>
                    <div class="w-full py-2">
                        <select name="nbr" class="input" id="nbr" aria-label="select">
                            <option value="0" {{ isset($_POST['nbr']) && $_POST['nbr']=='0'?'selected':'' }}>0</option>
                            <option value="1" {{ isset($_POST['nbr']) && $_POST['nbr']=='1'?'selected':'' }}>1</option>
                            <option value="2" {{ isset($_POST['nbr']) && $_POST['nbr']=='2'?'selected':'' }}>2</option>
                            <option value="3" {{ isset($_POST['nbr']) && $_POST['nbr']=='3'?'selected':'' }}>3</option>
                            <option value="4" {{ isset($_POST['nbr']) && $_POST['nbr']=='4'?'selected':'' }}>4</option>
                            <option value="5" {{ isset($_POST['nbr']) && $_POST['nbr']=='5'?'selected':'' }}>5</option>
                            <option value="6" {{ isset($_POST['nbr']) && $_POST['nbr']=='6'?'selected':'' }}>6</option>
                            <option value="7" {{ isset($_POST['nbr']) && $_POST['nbr']=='7'?'selected':'' }}>7</option>
                            <option value="8" {{ isset($_POST['nbr']) && $_POST['nbr']=='8'?'selected':'' }}>8</option>
                            <option value="9" {{ isset($_POST['nbr']) && $_POST['nbr']=='9'?'selected':'' }}>9</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-6 ">
                <div class="w-full text-[32px] text-center mt-5">
                    <p class="{{ isset($_POST['for']) && ($_POST['for']==='b' || $_POST['for']==='c' || $_POST['for']==='ar') ? 'hidden' : '' }}" id="aText">
                        <strong>
                            a = <span class="quadratic_square-root">c² - b²</span>
                        </strong>
                    </p>
                    <p class="{{ isset($_POST['for']) && $_POST['for']==='b'?'':'hidden' }}" id="bText">
                        <strong>
                            b = <span class="quadratic_square-root">c² - a²</span>
                        </strong>
                    </p>
                    <p class="{{ isset($_POST['for']) && $_POST['for']==='c'?'':'hidden' }}" id="cText">
                        <strong>
                            c = <span class="quadratic_square-root">a² + b²</span>
                        </strong>
                    </p>
                    <p class="{{ isset($_POST['for']) && $_POST['for']==='ar'?'':'hidden' }}" id="areaText">
                        <strong>
                            A = 
                            <span class="quadratic_fraction">
                                <span class="num">1</span>
                                <span>2</span>
                            </span> ab
                        </strong>
                    </p>
                </div>
                <div class="w-full text-center mt-5">
                    <img src="{{ asset('images/tri-ang.webp') }}" width="220" height="100%" alt="Pythagorean Theorem" loading="lazy" decoding="async">
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
                                @if($_POST['for'] === 'a')
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['2']}} a</strong></td>
                                        <td class="py-2 border-b">{{round($detail['a'], 2)}} {{$_POST['unit']}}</td>
                                    </tr>
                                @elseif($_POST['for'] === 'b')
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['2']}} b</strong></td>
                                        <td class="py-2 border-b">{{round($detail['b'], 2)}} {{$_POST['unit']}}</td>
                                    </tr>
                                @elseif($_POST['for'] === 'c')
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['3']}} c</strong></td>
                                        <td class="py-2 border-b">{{round($detail['c'], 2)}} {{$_POST['unit']}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['6']}}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['area'], 2)}} {{$_POST['unit']}}²</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">                    
                            <table class="w-full text-[16px]">
                                @if($_POST['for'] !== 'ar')
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{ $lang['6'] }}</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['area'], 2)}} {{$_POST['unit']}}²</strong></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['7'] }}</td>
                                    <td class="py-2 border-b"><strong>{{round($detail['peri'], 2)}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">∠α</td>
                                    <td class="py-2 border-b"><strong>{{round($detail['a_deg'], 2)}}° ({{round($detail['alfa'], 2)}} rad)</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">∠β</td>
                                    <td class="py-2 border-b"><strong>{{round($detail['b_deg'], 2)}}° ({{round($detail['beta'], 2)}} rad)</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">h</td>
                                    <td class="py-2 border-b"><strong>{{round($detail['h'], 2)}}</strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-3"><strong>Step-by-Step Calculation:</strong></p>
                            @if($_POST['for'] === 'a')
                                <p class="mt-3">\( a = \sqrt{c^2 - b^2} \)</p>
                                <p class="mt-3">\( a = \sqrt{ {{$detail['c']}}^2 - {{$detail['b']}}^2} \)</p>
                                <p class="mt-3">\( a = \sqrt{ {{pow($detail['c'],2)}} - {{pow($detail['b'],2)}}} \)</p>
                                <p class="mt-3">\( a = \sqrt{{{pow($detail['c'],2) - pow($detail['b'],2)}}} \)</p>
                                <p class="mt-3">\( a = {{$detail['a']}} \)</p>
                            @elseif($_POST['for'] === 'b')
                                <p class="mt-3">\( b = \sqrt{c^2 - a^2} \)</p>
                                <p class="mt-3">\( b = \sqrt{ {{$detail['c']}}^2 - {{$detail['a']}}^2} \)</p>
                                <p class="mt-3">\( b = \sqrt{ {{pow($detail['c'],2)}} - {{pow($detail['a'],2)}}} \)</p>
                                <p class="mt-3">\( b = \sqrt{{{pow($detail['c'],2) - pow($detail['a'],2)}}} \)</p>
                                <p class="mt-3">\( b = {{$detail['b']}} \)</p>
                            @elseif($_POST['for'] === 'c')
                                <p class="mt-3">\( c = \sqrt{a^2 + b^2} \)</p>
                                <p class="mt-3">\( c = \sqrt{ {{$detail['a']}}^2 + {{$detail['b']}}^2} \)</p>
                                <p class="mt-3">\( c = \sqrt{ {{pow($detail['a'],2)}} + {{pow($detail['b'],2)}}} \)</p>
                                <p class="mt-3">\( c = \sqrt{ {{pow($detail['a'],2) + pow($detail['b'],2)}}} \)</p>
                                <p class="mt-3">\( c = {{$detail['c']}} \)</p>
                            @endif
                            <p class="mt-3">\( \alpha = \sin^{-1}(\frac{a}{c}) \)</p>
                            <p class="mt-3">\( \alpha = \sin^{-1}(\frac{<?=$detail['a']?>}{<?=$detail['c']?>})\)</p>
                            <p class="mt-3">\( \alpha = <?=$detail['a_deg']?>^\circ \)</p>
                            <p class="mt-3">\( \alpha = <?=$detail['alfa']?> \text{ rad}\)</p>
                            <p class="mt-3">\( \beta = \sin^{-1}(\frac{b}{c}) \)</p>
                            <p class="mt-3">\( \beta = \sin^{-1}(\frac{<?=$detail['b']?>}{<?=$detail['c']?>})\)</p>
                            <p class="mt-3">\( \beta = <?=$detail['b_deg']?>^\circ \)</p>
                            <p class="mt-3">\( \beta = <?=$detail['beta']?> \text{ rad}\)</p>
                            <p class="mt-3">\( \text{ area} = \frac{a \times b}{2}\)</p>
                            <p class="mt-3">\( \text{ area} = \frac{<?=$detail['a']?> \times <?=$detail['b']?>}{2}\)</p>
                            <p class="mt-3">\( \text{ area} = \frac{<?=$detail['a'] * $detail['b']?>}{2}\)</p>
                            <p class="mt-3">\( \text{ area} = <?=$detail['area']?>\)</p>
                            <p class="mt-3">\( \text{ <?=$lang['7']?>} = a + b + c \)</p>
                            <p class="mt-3">\( \text{ <?=$lang['7']?>} = <?=$detail['a']?> + <?=$detail['b']?> + <?=$detail['c']?> \)</p>
                            <p class="mt-3">\( \text{ <?=$lang['7']?>} = <?=$detail['peri']?> \)</p>
                            <p class="mt-3">\( \text{ h} = \frac{a \times b}{c} \)</p>
                            <p class="mt-3">\( \text{ h} = \frac{<?=$detail['a']?> \times <?=$detail['b']?>}{<?=$detail['c']?>} \)</p>
                            <p class="mt-3">\( \text{ h} = \frac{<?=$detail['a'] * $detail['b']?>}{<?=$detail['c']?>} \)</p>
                            <p class="mt-3">\( \text{ h} = <?=$detail['h']?> \)</p>
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
        <script>
            document.getElementById('for').addEventListener('change', function() {
                var change = this.value;
                var lang2 = "{{$lang['2']}}";
                var lang3 = "{{$lang['3']}}";
                var one = document.querySelector('.one');
                var two = document.querySelector('.two');
                var a = document.getElementById('aText');
                var b = document.getElementById('bText');
                var c = document.getElementById('cText');
                var ar = document.getElementById('areaText');
                if (change === 'a') {
                    one.textContent = lang2 + ' b';
                    two.textContent = lang3 + ' c';
                    showHide(a, [b, c, ar]);
                } else if (change === 'b') {
                    one.textContent = lang2 + ' a';
                    two.textContent = lang3 + ' c';
                    showHide(b, [a, c, ar]);
                } else if (change === 'c') {
                    one.textContent = lang2 + ' a';
                    two.textContent = lang2 + ' b';
                    showHide(c, [a, b, ar]);
                } else if (change === 'ar') {
                    one.textContent = lang2 + ' a';
                    two.textContent = lang2 + ' b';
                    showHide(ar, [a, b, c]);
                }
            });
            function showHide(showElem, hideElems) {
                showElem.style.display = 'block';
                hideElems.forEach(function(elem) {
                    elem.style.display = 'none';
                });
            }
        </script>
    @endpush
</form>