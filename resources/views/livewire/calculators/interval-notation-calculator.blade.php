<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 text-[14px]">
                        <strong>{{ $lang['1'] }}. (2,8) {{ $lang['2'] }} [2,8] {{ $lang['2'] }} [2,8) {{ $lang['2'] }} (2,8]</strong>
                    </p>
                    <div class="col-span-12">
                        <label for="i" class="label">{{ $lang['3'] }}:</label>
                        <div class="w-full py-2">
                            <input type="text" wire:model.live="i" id="i" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="x" class="label">x {{ $lang['4'] }}:</label>
                        <div class="w-full py-2">
                            <select class="input" wire:model.live="x" id="x" aria-label="select">
                                <option value="select">{{ $lang['5'] }}</option>
                                <option value="even">{{ $lang[6] }}</option>
                                <option value="odd">{{ $lang[7] }}</option>
                                <option value="prime">{{ $lang[8] }}</option>
                            </select>
                        </div>
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
        <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        @php
                            $l = $detail['l'];
                            $r = $detail['r'];
                            $lo_ro = isset($detail['lo_ro']) ? $detail['lo_ro'] : null;
                            $lo_rc = isset($detail['lo_rc']) ? $detail['lo_rc'] : null;
                            $lc_ro = isset($detail['lc_ro']) ? $detail['lc_ro'] : null;
                            $lc_rc = isset($detail['lc_rc']) ? $detail['lc_rc'] : null;

                            // Use Livewire property $x instead of $_POST
                            $set = $detail['set'];
                            
                            if (!function_exists('is_prime_local')) {
                                function is_prime_local($number) {
                                    if ($number == '1') return false;
                                    if ($number == '2') return true;
                                    $x1 = sqrt($number);
                                    $x1 = floor($x1);
                                    for ($i = 2; $i <= $x1; ++$i) {
                                        if ($number % $i === 0) break;
                                    }
                                    if ($x1 === (double)$i - 1) return true;
                                    return false;
                                }
                            }

                            if ($x === 'even') {
                                $set = array_filter($set, fn($val) => $val % 2 === 0);
                            } elseif ($x === 'odd') {
                                $set = array_filter($set, fn($val) => $val % 2 !== 0);
                            } elseif ($x === 'prime') {
                                $prime = [];
                                foreach ($set as $val) {
                                    if (is_prime_local($val)) $prime[] = $val;
                                }
                                $set = $prime;
                            }
                            $set = array_values($set);
                            $set_len = count($set);
                        @endphp

                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full font-s-18"> 
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[9]}}</strong></td>
                                        <td class="py-2 border-b">
                                            {
                                                @php
                                                    for($i=0; $i < $set_len; $i++){
                                                        $comma = ($i < $set_len - 1) ? ', ' : '';
                                                        echo $set[$i].$comma;
                                                    }
                                                @endphp
                                            }
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <div class="steps">
                                    <p class="mt-2"><strong>{{$lang['12']}}</strong></p>
                                    <p class="mt-2">{{$lang['13']}}</p>
                                    <p class="mt-2">
                                        { @php
                                            for($i=0; $i < $set_len; $i++){
                                                $comma = ($i < $set_len - 1) ? ', ' : '';
                                                echo $set[$i].$comma;
                                            }
                                            @endphp }
                                    </p>
                                    <p class="mt-2">{{$lang['14']}}</p>
                                    <p class="mt-2">
                                        @php
                                            $xs_label = ($x === 'select') ? "" : ", \space\space x \space is \space $x";
                                            if($lo_ro){
                                                if($l>$r){ echo "\( \{x \space | \space $r \lt x \lt $l $xs_label \} \)"; }
                                                else{ echo "\( \{x \space | \space $l \lt x \lt $r $xs_label \} \)"; }
                                            }elseif($lo_rc){
                                                if(($l<0 && $r<0 && $l>$r) || ($r<0 || $l>$r)){ echo "\( \{x \space | \space $r \le x \lt $l $xs_label \} \)"; }
                                                else{ echo "\( \{x \space | \space $l \lt x \le $r $xs_label \} \)"; }
                                            }elseif($lc_ro){
                                                if(($l<0 && $r<0 && $l>$r) || ($l<0 || $r>$l)){ echo "\( \{x \space | \space $l \le x \lt $r $xs_label \} \)"; }
                                                else{ echo "\( \{x \space | \space $r \lt x \le $l $xs_label \} \)"; }
                                            }elseif($lc_rc){
                                                if($l>$r){ echo "\( \{x \space | \space $r \le x \le $l $xs_label \} \)"; }
                                                else{ echo "\( \{x \space | \space $l \le x \le $r $xs_label \} \)"; }
                                            }
                                        @endphp
                                    </p>
                                    <p class="mt-2">{{$lang['15']}}</p>
                                    <p class="mt-2">\( {{$set_len}} \)</p>
                                    <p class="mt-2">{{$lang['16']}}</p>
                                    <p class="mt-2">
                                        \(
                                            @php
                                                if($lo_ro){ echo 'left \space '.$lang["17"].' \space \mid \space right \space '.$lang["17"]; }
                                                elseif($lo_rc){ echo 'left \space '.$lang["17"].' \space \mid \space right \space '.$lang["18"]; }
                                                elseif($lc_ro){ echo 'left \space '.$lang["18"].' \space \mid \space right \space '.$lang["17"]; }
                                                elseif($lc_rc){ echo 'left \space '.$lang["18"].' \space \mid \space right \space '.$lang["18"]; }
                                            @endphp
                                        \)
                                    </p>
                                    @if($set_len>7)
                                        <p class="mt-2">{{$lang['19']}}</p>
                                        <p class="mt-2"><hr class="col hr_set"></p>
                                        <p class="mt-2"><hr class="col hr_set1"></p>
                                        <p class="mt-2">
                                            @php
                                                $set_v1=floor(($set_len-1)/3);
                                                $set_v2=floor($set_v1*2);
                                                $set_v3=floor($set_v1*3);
                                                echo "<span class='s_set' style='margin-left:5px'>".$set[0]."</span>
                                                    <span class='s_set'>".$set[$set_v1]."</span>
                                                    <span class='s_set'>".$set[$set_v2]."</span>
                                                    <span class='s_set'>".$set[$set_v3]."</span>
                                                    <span class='s_set'>".end($set)."</span>";
                                            @endphp
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endisset
    </form>
</div>

@push('calculatorJS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('math-updated', (event) => {
                setTimeout(() => {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            });
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body);
            }
        });
    </script>
@endpush
