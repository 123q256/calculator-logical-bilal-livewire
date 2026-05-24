<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4" x-data="{ showKeyboard: false }">

            <div class="col-span-9">
                <label for="EnterEq" class="label">{{$lang['1']}}:</label>
                <div class="w-full py-2 relative">
                    <input type="text" wire:model.live="EnterEq" id="EnterEq" class="input" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" @click="showKeyboard = !showKeyboard" style="cursor: pointer;" class="absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9" alt="keyboard" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-span-3">
                <label for="with" class="label">Variable:</label>
                <div class="w-full py-2">
                    <select wire:model.live="with" class="input" id="with" aria-label="select">
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
            <div class="col-span-12 keyboard" x-show="showKeyboard" style="display: none;">
                <button type="button" @click="if(confirm('Are you sure you want to clear Equation?')) { $wire.EnterEq = ''; }" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">CLS</button>
                <button type="button" @click="$wire.EnterEq += '+'" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">+</button>
                <button type="button" @click="$wire.EnterEq += '-'" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">-</button>
                <button type="button" @click="$wire.EnterEq += '/'" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">/</button>
                <button type="button" @click="$wire.EnterEq += '*'" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">*</button>
                <button type="button" @click="$wire.EnterEq += '^'" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">^</button>
                <button type="button" @click="$wire.EnterEq += 'sqrt('" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">√</button>
                <button type="button" @click="$wire.EnterEq += '('" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">(</button>
                <button type="button" @click="$wire.EnterEq += ')'" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">)</button>
            </div>
            <div class="col-span-6">
                <label for="point" class="label">{{$lang['3']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="point" id="point" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="n" class="label">{{$lang['4']}} n:</label>
                <div class="w-full py-2">
                    <input type="number" wire:model.live="n" id="n" max="10" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="find" class="label">{{$lang['5']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="find" id="find" class="input" aria-label="input"/>
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
                    <div class="w-full">
                        <div class="w-full text-[16px]">
                            <p class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2 text-[18px] overflow-auto">
                                \( <?=$detail['enter']?>≈P(<?=$point?>)=<?=$detail['series']?> \)
                            </p>
                            @if(is_numeric($find))
                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2 overflow-auto">
                                    <p class="mt-3 text-[18px]"><strong>\(f(<?=$find?>)=<?=$detail['efun']?>≈<?=$detail['efv']?>\)</strong></p>
                                    <p class="mt-3 text-[18px]"><strong>\(P(<?=$find?>)=<?=$detail['eser']?>≈<?=$detail['fsv']?>\)</strong></p>
                                    <p class="mt-3 text-[18px]"><strong>\(E=<?=$detail['efun']?>-(<?=$detail['eser']?>)≈<?=abs($detail['err'])?>\)</strong></p>
                                </div>
                            @endif
                            <p class="mt-3"><strong>Step by Step Solution:</strong></p>
                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2 overflow-auto">
                                <p class="mt-3"><?=$lang['8']?> \(<?=$detail['enter']?> \) <?=$lang['9']?> \(a = <?=$point?>\) <?=$lang['10']?> \(n = <?=$n?>\) <?=((is_numeric($find))?$lang['11'].' \(y = '.$find.'\)':'')?></p>
                                <p class="mt-3"><?=$lang['12']?> \(f (<?=$with?>) = \sum\limits_{k=0}^{\infty} \frac{f^{(k)}(a)}{k!}(<?=$with?> - a)^{k}\)</p>
                                <p class="mt-3"><?=$lang['13']?>, \(f (<?=$with?>) ≈ P(<?=$with?>) = \sum\limits_{k=0}^{\infty} \frac{f^{(k)}(a)}{k!}(<?=$with?> - a)^{k} = \sum\limits_{k=0}^{<?=$n?>} \frac{f^{(k)}(a)}{k!}(<?=$with?> - a)^{k}\)</p>
                                <p class="mt-3"><?=$lang['14']?></p>
                                <p class="mt-3">\( f^{(0)}(<?=$with?>) = f(<?=$with?>)= <?=$detail['enter']?> \)</p>
                                <p class="mt-3"><?=$lang['15']?>: \( f(<?=$point?>) = <?=$detail['eexe']?> \)</p>
                                <?php 
                                    $result=explode('@HA@', $detail['res']);
                                    $i=0;
                                    $der="'";
                                    if ($point==0) {
                                        $series='f('.$with.') ≈ \frac{'.$detail['eexe'].'}{0!}'.$with.'^{0}';
                                    }else{
                                        $series='f('.$with.') ≈ \frac{'.$detail['eexe'].'}{0!}('.$with.'- ('.$point.'))^{0}';
                                    }
                                    foreach ($result as $key => $value) {
                                        $get=explode('@@@', $value);
                                        if ($point==0) {
                                            $series.=' + \frac{'.$get[1].'}{'.($i+1).'!}'.$with.'^{'.($i+1).'}';
                                        }else{
                                            $series.=' + \frac{'.$get[1].'}{'.($i+1).'!}('.$with.'- ('.$point.'))^{'.($i+1).'}';
                                        }
                                        if($i==0){
                                        ?>
                                        <p class="mt-3"><?=$i+1?>. <?=$lang['16']?> <?=$i+1?> <?=$lang['17']?> : <strong>\( f^{(<?=$i+1?>)}(<?=$with?>) =  \left(f^{(<?=$i?>)}(<?=$with?>)\right)^{'}= \left(<?=$detail['enter']?>\right)^{'} = <?=$get[0]?> \)</strong></p>
                                        <p class="mt-3"><?=$lang['18']?> <?=$i+1?> <?=$lang['19']?>: \(\left(f(<?=$point?>)\right)^{'} = <?=$get[1]?>\)</p>
                                    <?php }else{ ?>
                                        <p class="mt-3"><?=$i+1?>. <?=$lang['16']?> <?=$i+1?> <?=$lang['17']?> : <strong>\( f^{(<?=$i+1?>)}(<?=$with?>) =  \left(f^{(<?=$i?>)}(<?=$with?>)\right)^{'}= \left(<?=$per?>\right)^{'} = <?=$get[0]?> \)</strong></p>
                                        <p class="mt-3"><?=$lang['18']?> <?=$i+1?> <?=$lang['19']?>: \(\left(f(<?=$point?>)\right)^{<?=$der?>} = <?=$get[1]?>\)</p>
                                <?php }$per=$get[0];$i++;$der.="'"; } ?>
                                <p class="mt-3"><?=$lang['20']?>: \( <?=$series?>\)</p>
                                <p class="mt-3"><?=$lang['21']?>:  \(f(<?=$with?>)≈P(<?=$with?>)=<?=$detail['series']?>\)</p>
                                <?php if(is_numeric($find)){ ?>
                                    <p class="mt-3"><?=$lang['22']?>: \(f(<?=$find?>)=<?=$detail['efun']?>\)</p>
                                    <p class="mt-3"><?=$lang['23']?>: \(P(<?=$find?>)=<?=$detail['eser']?>\)</p>
                                    <p class="mt-3"><?=$lang['24']?>: \(E|f(<?=$find?>) - P(<?=$find?>)|=<?=$detail['efun']?>-(<?=$detail['eser']?>)\)</p>
                                <?php } ?>
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
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>

    @endpush
</form>
</div>
