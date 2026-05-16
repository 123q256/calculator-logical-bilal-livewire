 <div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  gap-4">
                <div class="space-y-2">
                    <label for="dec" class="font-s-14 text-blue">{{ $lang['dec'] }}</label>
                    <input type="number" step="any" wire:model.live="dec" name="dec" id="dec" class="input" aria-label="input" />
                </div>
                <div class="space-y-2">
                    <label for="repeat" class="font-s-14 text-blue">{{ $lang['rep'] }}</label>
                    <input type="number" step="any" min="0" wire:model.live="repeat" name="repeat" id="repeat" class="input" aria-label="input" />
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
                    <div class="w-full  bg-light-blue  p-3 radius-10 mt-3">
                        <div class="row">
                            <div class="col-12 font-s-16">
                                @if(!empty($repeat))
                                    <p class="mt-3 font-s-21">\( {{ $dec . $detail['last_n']}}... = \frac{ {{$detail['uper']}} }{ {{$detail['btm']}} } \)</p>
                                @else
                                    <p class="mt-3 font-s-21">\( {{ $dec }} = \frac{ {{$detail['uper']}} }{ {{$detail['btm']}} } \)</p>    
                                @endif
                                @if(!empty($repeat))
                                    <p class="mt-3">{{$lang['last']}} {{$detail['last_n']}}, {{$lang['so']}} eq(1):</p>
                                    <p class="mt-3">x = {{ $dec . $detail['last_n']}}</p>
                                    <p class="mt-3">{{$lang['find']}} {{$detail['add']}}x</p>
                                    <p class="mt-3">{{$lang['we']}} eq(2): {{$detail['add']}}x = {{$detail['second'].$detail['last_n']}}...</p>
                                    <p class="mt-3">{{$lang['sub']}} eq(2) {{$lang['from']}} eq(1): {{($detail['add']-1)}}x = {{$detail['third']}}</p>
                                    <p class="mt-3">{{$lang['div']}} {{$detail['add']-1}} {{$lang['get']}} x:</p>
                                    <p class="mt-3">\( x = \frac{ {{$detail['third']}} }{ {{$detail['add']-1}} } \)</p>
                                    <p class="mt-3">{{$lang['mul']}} {{$detail['div_']}} x:</p>
                                    <p class="mt-3">\( x = \frac{ ({{$detail['third'].'×'.$detail['div_']}}) }{ ({{($detail['add']-1).'×'.$detail['div_']}}) } \)</p>
                                    <p class="mt-3">\( x = \frac{ ({{$detail['upr']}}) }{ ({{$detail['div']}}) } \)</p>
                                    <p class="mt-3">\( x = \frac{ ({{$detail['upr'].'÷'.$detail['g']}}) }{ ({{$detail['div'].'÷'.$detail['g']}}) } \)</p>
                                @else
                                    <p class="mt-3"><strong>{{$lang['ex']}}:</strong></p>
                                    <p class="mt-3">{{$lang['input']}} {{ $dec }}</p>
                                    <p class="mt-3">{{$lang['step']}} # 1 = \( \frac{ {{$detail['upr']}} }{ {{$detail['div']}} } \)</p>
                                    <p class="mt-3">{{$lang['step']}} # 2 = \( \frac{ ({{$detail['upr'].'÷'.$detail['g']}}) }{ ({{$detail['div'].'÷'.$detail['g']}}) } \)</p>
                                @endif
                                @if($detail['btm']=='1')
                                    <p class="mt-3">{{$lang['an']}} = {{$detail['uper']}}</p>
                                @else
                                    <p class="mt-3">{{$lang['an']}} = \( \frac{ {{$detail['uper']}} }{ {{$detail['btm']}} } \)</p>
                                @endif
                                @if($detail['uper']>$detail['btm'] && $detail['btm']!='1')
                                    @php
                                        $bta=$detail['uper'] % $detail['btm'];
                                        $shi=floor($detail['uper'] / $detail['btm']);
                                    @endphp
                                    <p class="mt-3">{{$lang['or']}} = \( {{$shi}} \frac{ {{$bta}} }{ {{$detail['btm']}} } \)</p>
                                @endif
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
        onload="window.MJrerender && window.MJrerender()"></script>
        <script>
            window.MJrerender = function() {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            }
        </script>
    @endpush
</form>
</div>
