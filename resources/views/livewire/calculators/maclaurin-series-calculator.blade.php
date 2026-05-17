<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3" x-data="{ showKeyboard: false }">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
            
            <div class="col-span-9">
                <label for="EnterEq" class="label">{{$lang['1']}}:</label>
                <div class="w-full py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" wire:model.live="EnterEq" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" @click="showKeyboard = !showKeyboard" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-span-3">
                <label for="with" class="label">W.R.T:</label>
                <div class="w-full py-2">
                    <select name="with" class="input" id="with" wire:model.live="with" aria-label="select">
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
                        <option value="n">n</option>
                        <option value="x">x</option>
                        <option value="y">y</option>
                        <option value="z">z</option>
                    </select>
                </div>
            </div>
            
            <div class="col-span-12 keyboard" x-show="showKeyboard" x-collapse style="display: none;">
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="if (confirm('Are you sure you want to clear Equation?')) $wire.EnterEq = ''">CLS</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '+'">+</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '-'">-</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '/'">/</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '*'">*</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '^'">^</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += 'sqrt('">√</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += '('">(</button>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="$wire.EnterEq += ')'">)</button>
            </div>
            
            <div class="col-span-12">
                <label for="n" class="label">{{$lang['3']}} n:</label>
                <div class="w-full py-2">
                    <input type="number" name="n" id="n" class="input" wire:model.live="n" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="find" class="label">{{$lang['4']}}:</label>
                <div class="w-full py-2">
                    <input type="number" name="find" id="find" class="input" wire:model.live="find" aria-label="input"/>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result overflow-auto">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="row">
                            @php
                                $find_val = $find;
                                $n_val = $n;
                                $with_val = $with;
                                $point = 0;
                            @endphp
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[16px]">\( {!! $detail['enter'] !!} ≈ P({{$point}}) = {!! $detail['series'] !!} \)</p>
                                @if(is_numeric($find_val))
                                    <p class="mt-3 text-[16px]"><strong>\( f({{$point}}) = {!! $detail['efun'] !!} ≈ {!! $detail['efv'] !!} \)</strong></p>
                                    <p class="mt-3 text-[16px]"><strong>\( P({{$point}}) = {!! $detail['eser'] !!} ≈ {!! $detail['fsv'] !!} \)</strong></p>
                                    <p class="mt-3 text-[16px]"><strong>\( E = {!! $detail['efun'] !!} - ({!! $detail['eser'] !!}) ≈ {{ abs($detail['err']) }} \)</strong></p>
                                @endif
                                <p class="mt-3"><strong>{{$lang['6']}}</strong></p>
                                <p class="mt-3">{{$lang['7']}} \( {!! $detail['enter'] !!} \) {{$lang['8']}} \(a = {{$point}}\) {{$lang['9']}} \(n = {{$n_val}}\) <?=((is_numeric($find_val))?$lang['10'].' \(y = '.$find_val.'\)':'')?></p>
                                <p class="mt-3">{{$lang['11']}} \(f ({{$with_val}}) = \sum\limits_{k=0}^{\infty} \frac{f^{(k)}(a)}{k!}({{$with_val}} - a)^{k}\)</p>
                                <p class="mt-3">{{$lang['12']}}, \(f ({{$with_val}}) ≈ P({{$with_val}}) = \sum\limits_{k=0}^{\infty} \frac{f^{(k)}(a)}{k!}({{$with_val}} - a)^{k} = \sum\limits_{k=0}^{{{$n_val}}} \frac{f^{(k)}(a)}{k!}({{$with_val}} - a)^{k}\)</p>
                                <p class="mt-3">{{$lang['13']}}</p>
                                <p class="mt-3">\( f^{(0)}({{$with_val}}) = f({{$with_val}}) = {!! $detail['enter'] !!} \)</p>
                                <p class="mt-3">{{$lang['14']}}: \( f({{$point}}) = {!! $detail['eexe'] !!} \)</p>
                                <?php 
                                    $result=explode('@HA@', $detail['res']);
                                    $i=0;
                                    $der="'";
                                    if ($point==0) {
                                        $series='f('.$with_val.') ≈ \frac{'.$detail['eexe'].'}{0!}'.$with_val.'^{0}';
                                    }else{
                                        $series='f('.$with_val.') ≈ \frac{'.$detail['eexe'].'}{0!}('.$with_val.'- ('.$point.'))^{0}';
                                    }
                                    foreach ($result as $key => $value) {
                                        $get=explode('@@@', $value);
                                        if ($point==0) {
                                            $series.=' + \frac{'.$get[1].'}{'.($i+1).'!}'.$with_val.'^{'.($i+1).'}';
                                        }else{
                                            $series.=' + \frac{'.$get[1].'}{'.($i+1).'!}('.$with_val.'- ('.$point.'))^{'.($i+1).'}';
                                        }
                                        if($i==0){
                                        ?>
                                        <p class="mt-3">{{$i+1}}. {{$lang['15']}} {{$i+1}} {{$lang['16']}} : <strong>\( f^{({{$i+1}})}({{$with_val}}) =  \left(f^{({{$i}})}({{$with_val}})\right)^{'}= \left({!! $detail['enter'] !!}\right)^{'} = {!! $get[0] !!} \)</strong></p>
                                        <p class="mt-3">{{$lang['17']}} {{$i+1}} {{$lang['18']}}: \(\left(f({{$point}})\right)' = {!! $get[1] !!}\)</p>
                                    <?php }else{ ?>
                                        <p class="mt-3">{{$i+1}}. {{$lang['15']}} {{$i+1}} {{$lang['16']}} : <strong>\( f^{({{$i+1}})}({{$with_val}}) =  \left(f^{({{$i}})}({{$with_val}})\right)^{'}= \left({!! $per !!}\right)^{'} = {!! $get[0] !!} \)</strong></p>
                                        <p class="mt-3">{{$lang['17']}} {{$i+1}} {{$lang['18']}}: \(\left(f({{$point}})\right){!! $der !!} = {!! $get[1] !!}\)</p>
                                <?php }$per=$get[0];$i++;$der.="'"; } ?>
                                <p class="mt-3">{{$lang['19']}}: \( {!! $series !!} \)</p>
                                <p class="mt-3">{{$lang['20']}}:  \( f({{$with_val}}) ≈ P({{$with_val}}) = {!! $detail['series'] !!} \)</p>
                                <?php if(is_numeric($find_val)){ ?>
                                    <p class="mt-3">{{$lang['21']}}: \( f({{$find_val}}) = {!! $detail['efun'] !!} \)</p>
                                    <p class="mt-3">{{$lang['22']}}: \( P({{$find_val}}) = {!! $detail['eser'] !!} \)</p>
                                    <p class="mt-3">{{$lang['23']}}: \( E|f({{$find_val}}) - P({{$find_val}})| = {!! $detail['efun'] !!} - ({!! $detail['eser'] !!}) \)</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
        </script>
        <script>
            window.MJrerender = function() {
                if (typeof MathJax !== 'undefined' && MathJax.Hub && typeof MathJax.Hub.Queue === 'function') {
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                }
            };

            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(window.MJrerender, 100);
            });

            document.addEventListener('livewire:initialized', () => {
                window.MJrerender();

                @this.on('math-updated', (event) => {
                    setTimeout(window.MJrerender, 100);
                });
            });
        </script>
    @endpush
</form>
</div>
