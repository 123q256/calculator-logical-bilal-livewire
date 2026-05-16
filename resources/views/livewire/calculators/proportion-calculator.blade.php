 <div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <p class="col-span-12 label"><strong>{{$lang['13']}}</strong> {{$lang['14']}}</p>
            <div class="col-span-12 flex items-center">
                <div>
                    <input type="text" wire:model.live="a" name="a" id="a" class="input mb-2" aria-label="input" @click="$wire.set('detail', null)"/>
                    <hr>
                    <input type="text" wire:model.live="b" name="b" id="b" class="input mt-2" aria-label="input" @click="$wire.set('detail', null)"/>
                </div>
                <div class="mx-3 font-s-32"><strong>=</strong></div>
                <div>
                    <input type="text" wire:model.live="c" name="c" id="c" class="input mb-2" aria-label="input" @click="$wire.set('detail', null)"/>
                    <hr>
                    <input type="text" wire:model.live="d" name="d" id="d" class="input mt-2" aria-label="input" @click="$wire.set('detail', null)"/>
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
                        <div class="row">
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    @if(isset($detail['a_val']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $a }}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['a_val'], 4)}}</td>
                                        </tr>
                                    @elseif(isset($detail['b_val']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $b }}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['b_val'], 4)}}</td>
                                        </tr>
                                    @elseif(isset($detail['c_val']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $c }}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['c_val'], 4)}}</td>
                                        </tr>
                                    @elseif(isset($detail['d_val']))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $d }}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['d_val'], 4)}}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['5']}}:</strong></p>
                                <p class="mt-2">{{$lang['6']}}</p>
                                <p class="mt-2">{{$lang['7']}}</p>
                                @if(isset($detail['a_val']))
                                    <p class="mt-2">\( \frac{ {{$a}} }{ {{$b}} } = \frac{ {{$c}} }{ {{$d}} } \)</p>
                                    <p class="mt-2">{{$lang['8']}}</p>
                                    <p class="mt-2">\( {{$a}} \times {{$d}} = {{$b}} \times {{$c}} \)</p>
                                    <p class="mt-2">{{$lang['9']}} {{$a}}</p>
                                    <p class="mt-2">\( {{$a}} = \frac{ {{$b}} \times {{$c}} }{ {{$d}} } \)</p>
                                    <p class="mt-2">\( {{$a}} = {{round($detail['a_val'], 4)}} \)</p>
                                    <p class="mt-2">{{$lang['10']}}</p>
                                    <p class="mt-2">{{$lang['11']}}</p>
                                    @if($b > $d && $d != 0)
                                        @php $s1 = $b/$d; @endphp
                                        <p class="mt-2">if<br>{{$b}} ÷ {{$d}} = {{$s1}}</p>
                                        <p class="mt-2">{{$lang['12']}}<br>{{$a}} ÷ {{$c}} = {{$s1}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$a}}</p>
                                        <p class="mt-2">{{$a}} = {{$c}} x {{$s1}}</p>
                                    @elseif($b <= $d && $b != 0)
                                        @php $s1 = $d/$b; @endphp
                                        <p class="mt-2">if<br>{{$d}} ÷ {{$b}} = {{$s1}}</p>
                                        <p class="mt-2">{{$lang['12']}}<br>{{$c}} ÷ {{$a}} = {{$s1}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$a}}</p>
                                        <p class="mt-2">{{$a}} = {{$c}} ÷ {{$s1}}</p>
                                    @endif
                                    <p class="mt-2">{{$a}} = {{round($detail['a_val'], 4)}}</p>
                                @elseif(isset($detail['b_val']))
                                    <p class="mt-2">\( \frac{ {{$a}} }{ {{$b}} } = \frac{ {{$c}} }{ {{$d}} } \)</p>
                                    <p class="mt-2">{{$lang['8']}}</p>
                                    <p class="mt-2">\( {{$a}} \times {{$d}} = {{$b}} \times {{$c}} \)</p>
                                    <p class="mt-2">{{$lang['9']}} {{$b}}</p>
                                    <p class="mt-2">\( {{$b}} = \frac{ {{$a}} \times {{$d}} }{ {{$c}} } \)</p>
                                    <p class="mt-2">\( {{$b}} = {{round($detail['b_val'], 4)}} \)</p>
                                    <p class="mt-2">{{$lang['10']}}</p>
                                    <p class="mt-2">{{$lang['11']}}</p>
                                    @if($a > $c && $c != 0)
                                        @php $s2 = $a/$c; @endphp
                                        <p class="mt-2">if</p>
                                        <p class="mt-2">{{$a}} ÷ {{$c}} = {{$s2}}</p>
                                        <p class="mt-2">{{$lang['12']}}</p>
                                        <p class="mt-2">{{$b}} ÷ {{$d}} = {{$s2}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$b}}</p>
                                        <p class="mt-2">{{$b}} = {{$d}} x {{$s2}}</p>
                                    @elseif($a <= $c && $a != 0)
                                        @php $s2 = $c/$a; @endphp
                                        <p class="mt-2">if</p>
                                        <p class="mt-2">{{$c}} ÷ {{$a}} = {{$s2}}</p>
                                        <p class="mt-2">{{$lang['12']}}</p>
                                        <p class="mt-2">{{$d}} ÷ {{$b}} = {{$s2}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$b}}</p>
                                        <p class="mt-2">{{$b}} = {{$d}} ÷ {{$s2}}</p>
                                    @endif
                                    <p class="mt-2">{{$b}} = {{round($detail['b_val'], 4)}}</p>
                                @elseif(isset($detail['c_val']))
                                    <p class="mt-2">\( \frac{ {{$a}} }{ {{$b}} } = \frac{ {{$c}} }{ {{$d}} } \)</p>
                                    <p class="mt-2">{{$lang['8']}}</p>
                                    <p class="mt-2">\( {{$a}} \times {{$d}} = {{$b}} \times {{$c}} \)</p>
                                    <p class="mt-2">{{$lang['9']}} {{$c}}</p>
                                    <p class="mt-2">\( {{$c}} = \frac{ {{$a}} \times {{$d}} }{ {{$b}} } \)</p>
                                    <p class="mt-2">\( {{$c}} = {{round($detail['c_val'], 4)}} \)</p>
                                    <p class="mt-2">{{$lang['10']}}</p>
                                    <p class="mt-2">{{$lang['11']}}</p>
                                    @if($d > $b && $b != 0)
                                        @php $s3 = $d/$b; @endphp
                                        <p class="mt-2">if</p>
                                        <p class="mt-2">{{$d}} ÷ {{$b}} = {{$s3}}</p>
                                        <p class="mt-2">{{$lang['12']}}</p>
                                        <p class="mt-2">{{$c}} ÷ {{$a}} = {{$s3}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$c}}</p>
                                        <p class="mt-2">{{$c}} = {{$a}} x {{$s3}}</p>
                                    @elseif($d <= $b && $d != 0)
                                        @php $s3 = $b/$d; @endphp
                                        <p class="mt-2">if</p>
                                        <p class="mt-2">{{$b}} ÷ {{$d}} = {{$s3}}</p>
                                        <p class="mt-2">{{$lang['12']}}</p>
                                        <p class="mt-2">{{$a}} ÷ {{$c}} = {{$s3}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$c}}</p>
                                        <p class="mt-2">{{$c}} = {{$a}} ÷ {{$s3}}</p>
                                    @endif
                                    <p class="mt-2">{{$c}} = {{round($detail['c_val'], 4)}}</p>
                                @elseif(isset($detail['d_val']))
                                    <p class="mt-2">\( \frac{ {{$a}} }{ {{$b}} } = \frac{ {{$c}} }{ {{$d}} } \)</p>
                                    <p class="mt-2">{{$lang['8']}}</p>
                                    <p class="mt-2">\( {{$a}} \times {{$d}} = {{$b}} \times {{$c}} \)</p>
                                    <p class="mt-2">{{$lang['9']}} {{$c}}</p>
                                    <p class="mt-2">\( {{$d}} = \frac{ {{$b}} \times {{$c}} }{ {{$a}} } \)</p>
                                    <p class="mt-2">\( {{$d}} = {{round($detail['d_val'], 4)}} \)</p>
                                    <p class="mt-2">{{$lang['10']}}</p>
                                    <p class="mt-2">{{$lang['11']}}</p>
                                    @if($c > $a && $a != 0)
                                        @php $s4 = $c/$a; @endphp
                                        <p class="mt-2">if<br>{{$c}} ÷ {{$a}} = {{$s4}}</p>
                                        <p class="mt-2">{{$lang['12']}}<br>{{$d}} ÷ {{$b}} = {{$s4}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$c}}</p>
                                        <p class="mt-2">{{$d}} = {{$b}} x {{$s4}}</p>
                                    @elseif($c <= $a && $c != 0)
                                        @php $s4 = $a/$c; @endphp
                                        <p class="mt-2">if</p>
                                        <p class="mt-2">{{$a}} ÷ {{$c}} = {{$s4}}</p>
                                        <p class="mt-2">{{$lang['12']}}</p>
                                        <p class="mt-2">{{$b}} ÷ {{$d}} = {{$s4}}</p>
                                        <p class="mt-2">{{$lang['9']}} {{$c}}</p>
                                        <p class="mt-2">{{$d}} = {{$b}} ÷ {{$s4}}</p>
                                    @endif
                                    <p class="mt-2">{{$d}} = {{round($detail['d_val'], 4)}}</p>
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
       onload="renderMathInElement(document.body);"></script>
    @endpush
</form>
</div>
