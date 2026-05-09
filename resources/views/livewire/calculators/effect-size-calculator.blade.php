<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-6">
                        <label for="myselection" class="font-s-14">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="effect_type" id="myselection" class="input">
                                <option value="cohen">Cohen's d - one-sample</option>
                                <option value="cohen2e">Cohen's d - two-sample equal sd</option>
                                <option value="cohen2u">Cohen's d - two-sample unequal sd</option>
                                <option value="h">Cohen's h</option>
                                <option value="phi">Phi (φ)</option>
                                <option value="cramer">Cramér's V (φ꜀)</option>
                                <option value="r2">R², and f²</option>
                                <option value="eta2">η², and f²</option>
                                <option value="r2f">R² to f²</option>
                                <option value="f2r">f² to R²</option>
                                <option value="dr">d & r</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="formula_change" class="font-s-14">Rounding:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="ronding" id="formula_change" class="input">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    {{-- Cohen's d - one-sample --}}
                    @if ($effect_type == 'cohen')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <label for="c_x1" class="font-s-14">{{ $lang[3] }} (x):</label>
                                    <input type="number" step="any" wire:model.live="c_x1" id="c_x1" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="c_s" class="font-s-14">{{ $lang[4] }} (s):</label>
                                    <input type="number" step="any" wire:model.live="c_s" id="c_s" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="c_pm" class="font-s-14">{{ $lang[5] }} (μ₀):</label>
                                    <input type="number" step="any" wire:model.live="c_pm" id="c_pm" class="input" />
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Cohen's d - two-sample (equal or unequal sd) --}}
                    @if (in_array($effect_type, ['cohen2e', 'cohen2u']))
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <label for="x1" class="font-s-14">{{ $lang[3] }} (x₁):</label>
                                    <input type="number" step="any" wire:model.live="x1" id="x1" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="x2" class="font-s-14">{{ $lang[3] }} (x₂):</label>
                                    <input type="number" step="any" wire:model.live="x2" id="x2" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="n1" class="font-s-14">{{ $lang[6] }} (n₁):</label>
                                    <input type="number" step="any" wire:model.live="n1" id="n1" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="n2" class="font-s-14">{{ $lang[6] }} (n₂):</label>
                                    <input type="number" step="any" wire:model.live="n2" id="n2" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="s1" class="font-s-14">{{ $lang[4] }} (s₁):</label>
                                    <input type="number" step="any" wire:model.live="s1" id="s1" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="s2" class="font-s-14">{{ $lang[4] }} (s₂):</label>
                                    <input type="number" step="any" wire:model.live="s2" id="s2" class="input" />
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Cohen's h --}}
                    @if ($effect_type == 'h')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <label for="p1" class="font-s-14">Proportion₁ (p₁):</label>
                                    <input type="number" step="any" wire:model.live="p1" id="p1" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="p2" class="font-s-14">Proportion₂ (p₂):</label>
                                    <input type="number" step="any" wire:model.live="p2" id="p2" class="input" />
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Phi --}}
                    @if ($effect_type == 'phi')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <label for="ph_x2" class="font-s-14">Chi-square (χ²):</label>
                                    <input type="number" step="any" wire:model.live="ph_x2" id="ph_x2" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="ph_n1" class="font-s-14">{{ $lang[6] }} (n):</label>
                                    <input type="number" step="any" wire:model.live="ph_n1" id="ph_n1" class="input" />
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Cramer's V --}}
                    @if ($effect_type == 'cramer')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <label for="cr_x2" class="font-s-14">Chi-square (χ²):</label>
                                    <input type="number" step="any" wire:model.live="cr_x2" id="cr_x2" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="cr_n1" class="font-s-14">{{ $lang[6] }} (n):</label>
                                    <input type="number" step="any" wire:model.live="cr_n1" id="cr_n1" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="row" class="font-s-14">Rows (r):</label>
                                    <input type="number" step="any" wire:model.live="row" id="row" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="col" class="font-s-14">Columns (c):</label>
                                    <input type="number" step="any" wire:model.live="col" id="col" class="input" />
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- R2 and f2 --}}
                    @if ($effect_type == 'r2')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <label for="ssr" class="font-s-14">{{ $lang[9] }}:</label>
                                    <input type="number" step="any" wire:model.live="ssr" id="ssr" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="sst" class="font-s-14">{{ $lang[10] }}:</label>
                                    <input type="number" step="any" wire:model.live="sst" id="sst" class="input" />
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Eta2 and f2 --}}
                    @if ($effect_type == 'eta2')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <label for="ssg" class="font-s-14">{{ $lang[11] }}:</label>
                                    <input type="number" step="any" wire:model.live="ssg" id="ssg" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="et_sst" class="font-s-14">{{ $lang[10] }}:</label>
                                    <input type="number" step="any" wire:model.live="et_sst" id="et_sst" class="input" />
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- R2 to f2 --}}
                    @if ($effect_type == 'r2f')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <label for="r2f_input" class="font-s-14">\(R^2\):</label>
                                    <input type="number" step="any" wire:model.live="r2f_input" id="r2f_input" class="input" />
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- f2 to R2 --}}
                    @if ($effect_type == 'f2r')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <label for="f2r_input" class="font-s-14">\(f^2\):</label>
                                    <input type="number" step="any" wire:model.live="f2r_input" id="f2r_input" class="input" />
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- d & r --}}
                    @if ($effect_type == 'dr')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <label for="t_value" class="font-s-14">{{ $lang[12] }}:</label>
                                    <input type="number" step="any" wire:model.live="t_value" id="t_value" class="input" />
                                </div>
                                <div class="col-span-6">
                                    <label for="df" class="font-s-14">{{ $lang[13] }}:</label>
                                    <input type="number" step="any" wire:model.live="df" id="df" class="input" />
                                </div>
                            </div>
                        </div>
                    @endif
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
                                <div class="text-center">
                                    <p class="text-[18px]">
                                        <strong>{{ $lang[14] }}</strong>
                                    </p>
                                </div>
                                
                                @php $et = $detail['effect_type']; @endphp

                                {{-- Cohen's d Two-Sample Equal SD --}}
                                @if ($et == 'cohen2e')
                                    <div class="flex justify-center">                            
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['cohen2e'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[15] }}</strong></p>
                                    <p class="w-full mt-3">\({\bar x}_1 = {{ $detail['x1'] }} &ensp; ; &ensp; {\bar x}_2 = {{ $detail['x2'] }}\)</p>
                                    <p class="w-full mt-3">\(n_1 = {{ $detail['n1'] }} &ensp; ; &ensp; n_2 = {{ $detail['n2'] }}\)</p>
                                    <p class="w-full mt-3">\(S_1 = {{ $detail['s1'] }} &ensp; ; &ensp; S_2 = {{ $detail['s2'] }}\)</p>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[16] }}</strong></p>
                                    <p class="w-full mt-3">\(S^2 = \dfrac{(n_1 - 1)S_1^2 +  (n_2 - 1)S_2^2}{n_1 + n_2 - 2}\)</p>
                                    <p class="w-full mt-3">\(S^2 = \dfrac{({{ $detail['n1'] }} - 1)({{ $detail['s1'] }})^2 +  ({{ $detail['n2'] }} - 1)({{ $detail['s2'] }})^2}{ {{ $detail['n1'] }} + {{ $detail['n2'] }} - 2 }\)</p>
                                    <p class="w-full mt-3">\(S^2 = \dfrac{({{ $detail['n1']-1 }})({{ $detail['s1pow'] }}) + ({{ $detail['n2']-1 }})({{ $detail['s2pow'] }})}{ {{ $detail['n1']+$detail['n2']-2 }} }\)</p>
                                    <p class="w-full mt-3">\(S^2 = \dfrac{ {{ $detail['res'] }} }{ {{ $detail['n1']+$detail['n2']-2 }} }\)</p>
                                    <p class="w-full mt-3">\(S^2 = {{ $detail['sqr'] }}\)</p>
                                    <p class="w-full mt-3">\(S = \sqrt{ {{ $detail['sqr'] }} } = {{ $detail['sqrt'] }}\) @if($detail['sqr'] < 0) &ensp; (∴ {{ $lang[19] }}.) @endif</p>
                                    <p class="w-full mt-3">{{ $lang[17] }}:</p>
                                    <p class="w-full mt-3">\(d = \dfrac{|{\bar x}_1 - {\bar x}_2|}{S} = \dfrac{|{{ $detail['x1'] }} - {{ $detail['x2'] }}|}{ {{ $detail['sqrt'] }} } = \dfrac{ {{ $detail['x1x2'] }} }{ {{ $detail['sqrt'] }} } = {{ $detail['cohen2e'] }}\)</p>

                                {{-- Cohen's d Two-Sample Unequal SD --}}
                                @elseif ($et == 'cohen2u')
                                    <div class="flex justify-center">                            
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['cohen2u'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[15] }}</strong></p>
                                    <p class="w-full mt-3">\({\bar x}_1 = {{ $detail['x1'] }} &ensp; ; &ensp; {\bar x}_2 = {{ $detail['x2'] }}\)</p>
                                    <p class="w-full mt-3">\(n_1 = {{ $detail['n1'] }} &ensp; ; &ensp;n_2 = {{ $detail['n2'] }}\)</p>
                                    <p class="w-full mt-3">\(S_1 = {{ $detail['s1'] }} &ensp; ; &ensp;S_2 = {{ $detail['s2'] }}\)</p>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[16] }}</strong></p>
                                    <p class="w-full mt-3">\(S^2 = \dfrac{S_1^2 + S_2^2}{2} = \dfrac{({{ $detail['s1'] }})^2 + ({{ $detail['s2'] }})^2}{2} = \dfrac{ {{ $detail['s1pow'] }} + {{ $detail['s2pow'] }} }{2} = \dfrac{ {{ $detail['res'] }} }{2} = {{ $detail['sqr'] }}\)</p>
                                    <p class="w-full mt-3">\(S = \sqrt{ {{ $detail['sqr'] }} } = {{ $detail['sqrt'] }}\) @if($detail['sqr'] < 0) &ensp; (∴ {{ $lang[19] }}.) @endif</p>
                                    <p class="w-full mt-3">{{ $lang[17] }}:</p>
                                    <p class="w-full mt-3">\(d = \dfrac{|{\bar x}_1 - {\bar x}_2|}{S} = \dfrac{|{{ $detail['x1'] }} - {{ $detail['x2'] }}|}{ {{ $detail['sqrt'] }} } = \dfrac{ {{ $detail['x1x2'] }} }{ {{ $detail['sqrt'] }} } = {{ $detail['cohen2u'] }}\)</p>

                                {{-- Cohen's d One-Sample --}}
                                @elseif ($et == 'cohen')
                                    <div class="flex justify-center">                            
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['cohen'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[15] }}</strong></p>
                                    <p class="w-full mt-3">\(\text{ {{ $lang[3] }} } &ensp; {\bar x} = {{ $detail['c_x1'] }}\)</p>
                                    <p class="w-full mt-3">\(\text{ {{ $lang[4] }} } &ensp; σ (S)  = {{ $detail['c_s'] }}\)</p>
                                    <p class="w-full mt-3">\(\text{ {{ $lang[5] }} } &ensp; (μ_0)  = {{ $detail['c_pm'] }}\)</p>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[16] }}</strong></p>
                                    <p class="w-full mt-3">\(d = \dfrac{|{\bar x} - μ_0|}{S} = \dfrac{|{{ $detail['c_x1'] }} - {{ $detail['c_pm'] }}|}{ {{ $detail['c_s'] }} } = \dfrac{ {{ $detail['c'] }} }{ {{ $detail['c_s'] }} } = {{ $detail['cohen'] }}\)</p>

                                {{-- Cohen's h --}}
                                @elseif ($et == 'h')
                                    <div class="flex justify-center">                            
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['h'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[15] }}</strong></p>
                                    <p class="w-full mt-3">\(P_1 (Proportion_1) = {{ $detail['p1'] }}\) ; \(P_2 (Proportion_2) = {{ $detail['p2'] }}\)</p>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[16] }}</strong></p>
                                    <p class="w-full mt-3">\(h = 2(arcsin(\sqrt{p_1}) - arcsin(\sqrt{p_2})) = 2(arcsin(\sqrt{ {{ $detail['p1'] }} }) - arcsin(\sqrt{ {{ $detail['p2'] }} })) = 2({{ $detail['arcp1'] }} - {{ $detail['arcp2'] }}) = {{ $detail['h'] }}\)</p>

                                {{-- Phi --}}
                                @elseif ($et == 'phi')
                                    <div class="flex justify-center">                            
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['phi'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[15] }}</strong></p>
                                    <p class="w-full mt-3">\(X^2 = {{ $detail['ph_x2'] }} &ensp; ; &ensp; n = {{ $detail['ph_n1'] }}\)</p>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[16] }}</strong></p>
                                    <p class="w-full mt-3">\(φ = \sqrt{\dfrac{X^2}{n}} = \sqrt{\dfrac{ {{ $detail['ph_x2'] }} }{ {{ $detail['ph_n1'] }} }} = \sqrt{ {{ $detail['res'] }} } = {{ $detail['phi'] }}\)</p>

                                {{-- Cramer's V --}}
                                @elseif ($et == 'cramer')
                                    <div class="flex justify-center">                            
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['cramer'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[15] }}</strong></p>
                                    <p class="w-full mt-3">\(X^2 = {{ $detail['cr_x2'] }} &ensp; ; &ensp; n = {{ $detail['cr_n1'] }}\)</p>
                                    <p class="w-full mt-3">Rows: {{ $detail['row'] }} ; Cols: {{ $detail['col'] }}</p>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[16] }}</strong></p>
                                    <p class="w-full mt-3">\(V = \sqrt{\dfrac{X^2}{n \cdot Min(R-1 , C-1)}} = \sqrt{\dfrac{ {{ $detail['cr_x2'] }} }{ {{ $detail['cr_n1'] }} \cdot Min({{ $detail['row'] }}-1 , {{ $detail['col'] }}-1)}} = \sqrt{\dfrac{ {{ $detail['cr_x2'] }} }{ {{ $detail['res'] }} }} = {{ $detail['cramer'] }}\)</p>

                                {{-- R2 and f2 --}}
                                @elseif ($et == 'r2')
                                    <div class="flex justify-center">                            
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['r2'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[15] }}</strong></p>
                                    <p class="w-full mt-3">SSR = {{ $detail['ssr'] }} ; SST = {{ $detail['sst'] }}</p>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[16] }}</strong></p>
                                    <p class="w-full mt-3">\(R^2 = \dfrac{SSR}{SST} = \dfrac{ {{ $detail['ssr'] }} }{ {{ $detail['sst'] }} } = {{ $detail['r'] }}\)</p>
                                    <p class="w-full mt-3">\(f^2  = \dfrac{R^2}{1 - R^2} = \dfrac{ {{ $detail['r'] }} }{1 - {{ $detail['r'] }} } = {{ $detail['r2'] }}\)</p>

                                {{-- Eta2 and f2 --}}
                                @elseif ($et == 'eta2')
                                    <div class="flex justify-center">                            
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['eta2'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[15] }}</strong></p>
                                    <p class="w-full mt-3">SSG = {{ $detail['ssg'] }} ; SST = {{ $detail['et_sst'] }}</p>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[16] }}</strong></p>
                                    <p class="w-full mt-3">\(η^2 = \dfrac{SSG}{SST} = \dfrac{ {{ $detail['ssg'] }} }{ {{ $detail['et_sst'] }} } = {{ $detail['et'] }}\)</p>
                                    <p class="w-full mt-3">\(f^2  = \dfrac{η^2}{1 - η^2} = \dfrac{ {{ $detail['et'] }} }{1 - {{ $detail['et'] }} } = {{ $detail['eta2'] }}\)</p>

                                {{-- R2 to f2 --}}
                                @elseif ($et == 'r2f')
                                    <div class="flex justify-center">                            
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['rf'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[15] }}</strong></p>
                                    <p class="w-full mt-3">\(R^2 = {{ $detail['r2f'] }}\)</p>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[16] }}</strong></p>
                                    <p class="w-full mt-3">\(f^2 = \dfrac{R^2}{1 - R^2} = \dfrac{ {{ $detail['r2f'] }} }{1 - {{ $detail['r2f'] }} } = {{ $detail['rf'] }}\)</p>

                                {{-- f2 to R2 --}}
                                @elseif ($et == 'f2r')
                                    <div class="flex justify-center">                            
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['fr'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[15] }}</strong></p>
                                    <p class="w-full mt-3">\(f^2 = {{ $detail['f2r'] }}\)</p>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[16] }}</strong></p>
                                    <p class="w-full mt-3">\(R^2 = \dfrac{f^2}{1 + f^2} = \dfrac{ {{ $detail['f2r'] }} }{1 + {{ $detail['f2r'] }} } = {{ $detail['fr'] }}\)</p>

                                {{-- d & r --}}
                                @elseif ($et == 'dr')
                                    <div class="flex justify-center">                            
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['dr'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[15] }}</strong></p>
                                    <p class="w-full mt-3">t Value = {{ $detail['t_value'] }} ; df = {{ $detail['df'] }}</p>
                                    <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang[16] }}</strong></p>
                                    <p class="w-full mt-3">\(\text{Cohen's d} = \dfrac{2t}{\sqrt{df}} = \dfrac{2 \cdot {{ $detail['t_value'] }} }{\sqrt{ {{ $detail['df'] }} }} = {{ $detail['dr'] }}\)</p>
                                    <p class="w-full mt-3">\(r_{Yλ} = \sqrt{\dfrac{t^2}{t^2 + df}} = \sqrt{\dfrac{ ({{ $detail['t_value'] }})^2 }{ ({{ $detail['t_value'] }})^2 + {{ $detail['df'] }} }} = {{ $detail['r'] }}\)</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    @endpush
</div>
