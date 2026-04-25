<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="w-full mx-auto my-2 ">
                <input type="hidden" wire:model="calculator_name" id="calculator_name">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  lg:gap-4 md:gap-4 gap-1 flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 ">
                    <div class="space-y-2  px-2 py-1">
                        <div wire:click="$set('calculator_name', 'calculator1')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $calculator_name == 'calculator1' ? 'tagsUnit' : 'pacetab' }}" id="calculator1">
                            {{ isset($lang['calculator']) ? $lang['calculator'] : 'Calculator' }}
                        </div>
                    </div>
                    <div class="space-y-2  px-2 py-1">
                        <div wire:click="$set('calculator_name', 'calculator2')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $calculator_name == 'calculator2' ? 'tagsUnit' : 'pacetab' }}" id="calculator2">
                            {{ isset($lang['converter']) ? $lang['converter'] : 'Converter' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4 calculators calculator1" style="{{ $calculator_name == 'calculator1' ? '' : 'display:none;' }}">
             
                <div class="col-lg-6 px-2">
                    <label for="find" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="find" id="find" class="input">
                            @php
                                $name_arr = [$lang[2]." (Nₜ)",$lang[3]." (N₀)",$lang[4]." (t)",$lang[5]." (t₁/₂)"];
                                $val_arr = ["nt","n0","t","t1_2"];
                            @endphp
                            @foreach($val_arr as $index => $val_item)
                                <option value="{!! $val_item !!}">
                                    {!! $name_arr[$index] !!}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 px-2 nt" style="{{ $find == 'nt' ? 'display:none;' : '' }}">
                    <label for="nt" class="font-s-14 text-blue">{!! $lang['2'] !!} (N<sub class="text-blue">t</sub>):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model="nt" id="nt" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-lg-6 px-2 n0" style="{{ $find == 'n0' ? 'display:none;' : '' }}">
                    <label for="n0" class="font-s-14 text-blue">{!! $lang['3'] !!} (N<sub class="text-blue">0</sub>):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" wire:model="n0" id="n0" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-lg-6 px-2 t" style="{{ $find == 't' ? 'display:none;' : '' }}">
                    <label for="t" class="font-s-14 text-blue">{!! $lang['4'] !!} (t):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" wire:model="t" id="t" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-lg-6 px-2 t1_2" style="{{ $find == 't1_2' ? 'display:none;' : '' }}">
                    <label for="t1_2" class="font-s-14 text-blue">{!! $lang['5'] !!} (t<sub class="text-blue">1/2</sub>):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" wire:model="t1_2" id="t1_2" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4 calculators calculator2" style="{{ $calculator_name == 'calculator2' ? '' : 'display:none;' }}">
                <div class="col-span-1 lg:col-span-2 md:col-span-2">
                    <h2 class="text-blue font-s-18 px-2 mb-0">{{ $lang['6'] }}</h2>
                </div>
                <div class="col-lg-6 px-2 imperial_input">
                    <label for="find_by" class="font-s-14 text-blue">{!! $lang['7'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="find_by" id="find_by" class="input">
                            @php
                                $name_arr2 = [$lang[5]." (t₁/₂)",$lang[8]." (τ)",$lang[9]." (λ)"];
                                $val_arr2 = ["t_1_2","T","lamda"];
                            @endphp
                            @foreach($val_arr2 as $index => $val_item)
                                <option value="{!! $val_item !!}">
                                    {!! $name_arr2[$index] !!}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 px-2 t_1_2" style="{{ $find_by == 't_1_2' ? 'display:none;' : '' }}">
                    <label for="t_1_2" class="font-s-14 text-blue">{!! $lang['5'] !!} (t<sub class="text-blue">1/2</sub>):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model="t_1_2" id="t_1_2" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-lg-6 px-2 T" style="{{ $find_by == 'T' ? 'display:none;' : '' }}">
                    <label for="T" class="font-s-14 text-blue">{!! $lang['8'] !!} (τ):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model="T" id="T" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-lg-6 px-2 lamda" style="{{ $find_by == 'lamda' ? 'display:none;' : '' }}">
                    <label for="lamda" class="font-s-14 text-blue">{!! $lang['9'] !!} (λ):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model="lamda" id="lamda" class="input" aria-label="input" placeholder="00" />
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

      <hr>
    @isset($detail)
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                    @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full radius-10 p-3 mt-3">
                        <div class="w-full mt-2">
                            @if($calculator_name === "calculator1")
                                @php
                                    $ans=$detail['ans'];
                                    $s1=isset($detail['s1']) ? $detail['s1'] : '';
                                    $s2=isset($detail['s2']) ? $detail['s2'] : '';
                                    $s3= isset($detail['s3']) ? $detail['s3'] : '';
                                    $s4=isset($detail['s4']) ? $detail['s4'] : '';
                
                                    if($find==='nt'){
                                        $head='Quantity Remains \( (N_t) \)';
                                    }elseif($find==='n0'){
                                        $head='Initial Quantity \( (N_0) \)';
                                    }elseif($find==='t'){
                                        $head="Time \( (t) \)";
                                    }elseif($find==='t1_2'){
                                        $head='Half Life \( (t_{\frac{1}{2}}) \)';
                                    }
                                @endphp
                                <p><strong>{{ $head }}</strong></p>
                                <p><strong class="text-[#119154] text-[32px]">{{ round($ans,4) }}</strong></p>
                                <div class="col-12 mt-2">
                                    <p class="font-s-20"><strong>{{ $lang[10] }}:</strong></p>
                                    <p class="my-2"><strong>{{ $lang[11] }}:</strong></p>
                                    @if($find==='nt')
                                        <p class="my-2">\( N_t = N_0 \left(\dfrac{1}{2} \right)^\dfrac{t}{ {t_{\frac{1}{2}} } } \)</p>
                                        <p class="my-2"><strong>{{ $lang[12] }}:</strong></p>
                                        <p class="my-2">\( N_0 = {{ $n0 }}, t = {{ $t }}, t_{\frac{1}{2}} = {{ $t1_2 }}, N_t = ? \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[13] }}:</strong></p>
                                        <p class="my-2">\( N_t = N_0 \left(\dfrac{1}{2} \right)^\dfrac{t}{ {t_{\frac{1}{2}} } } \)</p>
                                        <p class="my-2">\( N_t = {{ $n0 }} * \left(\dfrac{1}{2} \right)^\dfrac{ {{ $t }} }{ { {{ $t1_2 }} } } \)</p>
                                        <p class="my-2">\( N_t = {{ $n0 }} * (0.5)^{{{ $s1 }}} \)</p>
                                        <p class="my-2">\( N_t = {{ $n0 }} * {{ $s2 }} \)</p>
                                        <p class="my-2">\( N_t = {{ $ans }} \)</p>
                                    @elseif($find==='n0')
                                        <p class="my-2">\( N_0 = \dfrac{N_t} {\left(\dfrac{1}{2} \right)^\dfrac{t}{ {t_{\frac{1}{2}} } } } \)</p>
                                        <p class="my-2"><strong>{{ $lang[12] }}:</strong></p>
                                        <p class="my-2">\( N_t = {{ $nt }}, t = {{ $t }}, t_{\frac{1}{2}} = {{ $t1_2 }}, N_0 = ? \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[13] }}:</strong></p>
                                        <p class="my-2">\( N_0 = \dfrac{N_t} {\left(\dfrac{1}{2} \right)^\dfrac{t}{ {t_{\frac{1}{2} } } } } \)</p>
                                        <p class="my-2">\( N_0 = \dfrac{ {{ $nt }} }{\left(\dfrac{1}{2} \right)^\dfrac{ {{ $t }} }{ { {{ $t1_2 }} } } } \)</p>
                                        <p class="my-2">\( N_0 = \dfrac{ {{ $nt }} }{(0.5)^{ {{ $s1 }} }} \)</p>
                                        <p class="my-2">\( N_0 = \dfrac{ {{ $nt }} }{ {{ $s2 }} } \)</p>
                                        <p class="my-2">\( N_0 = {{ $ans }} \)</p>
                                    @elseif($find==='t')
                                        <p class="my-2">\( t = \dfrac{t_{\frac{1}{2}} ln \left(\dfrac{N_t}{N_0} \right)}{-ln(2)} \)</p>
                                        <p class="my-2"><strong>{{ $lang[12] }}:</strong></p>
                                        <p class="my-2">\( N_t = {{ $nt }}, N_0 = {{ $n0 }}, t_{\frac{1}{2}} = {{ $t1_2 }}, t = ? \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[13] }}:</strong></p>
                                        <p class="my-2">\( t = \dfrac{t_{\frac{1}{2}} ln \left(\dfrac{N_t}{N_0} \right)}{-ln(2)} \)</p>
                                        <p class="my-2">\( t = \dfrac{ {{ $t1_2 }} * ln \left(\dfrac{ {{ $nt }} }{ {{ $n0 }} } \right)}{-ln(2)} \)</p>
                                        <p class="my-2">\( t = \dfrac{ {{ $t1_2 }} * ln ( {{ $s1 }} )}{-ln(2)} \)</p>
                                        <p class="my-2">\( t = \dfrac{ {{ $t1_2 }} * ( {{ $s2 }} )}{ {{ $s4 }} } \)</p>
                                        <p class="my-2">\( t = \dfrac{ {{ $s3 }} }{ {{ $s4 }} } \)</p>
                                        <p class="my-2">\( t = {{ $ans }} \)</p>
                                    @elseif($find==='t1_2')
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{t * (-ln(2))}{ln \left(\dfrac{N_t}{N_0} \right)} \)</p>
                                        <p class="my-2"><strong>{{ $lang[12] }}:</strong></p>
                                        <p class="my-2">\( N_t = {{ $nt }}, N_0 = {{ $n0 }}, t = {{ $t }}, t_{\frac{1}{2}} = ? \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[13] }}:</strong></p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{t * (-ln(2))}{ln \left(\dfrac{N_t}{N_0} \right)} \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{ {{ $t }} * (-ln(2))}{ln \left(\dfrac{ {{ $nt }} }{ {{ $n0 }} } \right)} \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{ {{ $t }} * (-ln(2))}{ln ({{ $s1 }}) } \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{ {{ $t }} * {{ $s3 }} }{ {{ $s2 }} } \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{ {{ $s4 }} }{ {{ $s2 }} } \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = {{ $ans }} \)</p>
                                    @endif
                                </div>
                            @else
                                @php
                                    $t_1_2_ans=$detail['t_1_2'];
                                    $T_ans=$detail['T'];
                                    $lamda_ans=$detail['lamda'];
                                @endphp
                                <p><strong>{{ $lang[5] }} \( (t_{\frac{1}{2}}) \)</strong></p>
                                <p class="font-s-28"><strong class="{{ ($find_by==='t_1_2')?'':'text-[#119154] text-[30px]' }}">{{ round($t_1_2_ans,4) }}</strong></p>
                                <p><strong>{{ $lang[8] }} (τ)</strong></p>
                                <p class="font-s-28"><strong class="{{ ($find_by==='T')?'':'text-[#119154] text-[30px]' }}">{{ round($T_ans,4) }}</strong></p>
                                <p><strong>{{ $lang[9] }} (λ)</strong></p>
                                <p class="font-s-28"><strong class="{{ ($find_by==='lamda')?'':'text-[#119154] text-[30px]' }}">{{ round($lamda_ans,4) }}</strong></p>
                                <div class="col-12 mt-3">
                                    <p class="font-s-20"><strong>{{ $lang[10] }}:</strong></p>
                                    @if($find_by==='t_1_2')
                                        <p class="my-2"><strong>{{ $lang[8] }} (τ):</strong></p>
                                        <p class="my-2">\( τ = \dfrac{t_{\frac{1}{2}} }{ln(2)} \)</p>
                                        <p class="my-2">\( τ = \dfrac{ {{ $t_1_2 }} }{ {{(log(2))}} } \)</p>
                                        <p class="my-2">\( τ = {{ $T_ans }} \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[9] }} (λ):</strong></p>
                                        <p class="my-2">\( λ = \dfrac{ln(2)}{t_{\frac{1}{2}}} \)</p>
                                        <p class="my-2">\( λ = \dfrac{ {{(log(2))}} }{ {{ $t_1_2 }} } \)</p>
                                        <p class="my-2">\( λ = {{ $lamda_ans }} \)</p>
                                    @elseif($find_by==='T')
                                        <p class="my-2"><strong>{{ $lang[5] }} \( (t_{\frac{1}{2}}) \):</strong></p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = τ * ln(2) \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = {{ $T }} * {{(log(2))}} \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = {{ $t_1_2_ans }} \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[9] }} (λ):</strong></p>
                                        <p class="my-2">\( λ = \dfrac{ln(2)}{t_{\frac{1}{2}}} \)</p>
                                        <p class="my-2">\( λ = \dfrac{ {{(log(2))}} }{ {{ $t_1_2_ans }} } \)</p>
                                        <p class="my-2">\( λ = {{ $lamda_ans }} \)</p>
                                    @elseif($find_by==='lamda')
                                        <p class="my-2"><strong>{{ $lang[5] }} \( (t_{\frac{1}{2}}) \):</strong></p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{ln(2)}{λ} \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = \dfrac{ {{(log(2))}} }{ {{ $lamda }} } \)</p>
                                        <p class="my-2">\( t_{\frac{1}{2}} = {{ $t_1_2_ans }} \)</p>
                                        <p class="mt-3 mb-2"><strong>{{ $lang[8] }} (τ):</strong></p>
                                        <p class="my-2">\( τ = \dfrac{t_{\frac{1}{2}}}{ln(2)} \)</p>
                                        <p class="my-2">\( τ = \dfrac{ {{ $t_1_2_ans }} }{ {{(log(2))}} } \)</p>
                                        <p class="my-2">\( τ = {{ $T_ans }} \)</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @script
    <script>
        function ensureMathJax(callback) {
            if (window.MathJax) {
                callback();
                return;
            }
            var script = document.createElement('script');
            script.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
            script.async = true;
            script.onload = () => {
                if (window.MathJax.Hub) {
                    window.MathJax.Hub.Config({
                        tex2jax: {
                            inlineMath: [['\\(', '\\)']],
                            displayMath: [['\\[', '\\]']],
                            processEscapes: true
                        },
                        "HTML-CSS": { linebreaks: { automatic: true } },
                        SVG: { linebreaks: { automatic: true } }
                    });
                }
                callback();
            };
            document.head.appendChild(script);
        }

        ensureMathJax(() => {
            setTimeout(() => {
                if (window.MathJax) {
                    if (window.MathJax.typesetPromise) {
                        MathJax.typesetClear();
                        MathJax.typesetPromise().catch(err => console.error(err));
                    } else if (window.MathJax.Hub) {
                        window.MathJax.Hub.Queue(["Typeset", window.MathJax.Hub]);
                    }
                }
            }, 100);
        });

        $wire.on('math-updated', () => {
            setTimeout(() => {
                if (window.MathJax) {
                    if (window.MathJax.typesetPromise) {
                        const el = document.getElementById('result-section');
                        MathJax.typesetClear();
                        MathJax.typesetPromise(el ? [el] : []).then(() => {
                        }).catch(err => console.error('MathJax v3 error:', err));
                    } else if (window.MathJax.Hub) {
                        window.MathJax.Hub.Queue(["Typeset", window.MathJax.Hub]);
                    }
                }
            }, 100); 
        });
    </script>
    @endscript
</form>
</div>
