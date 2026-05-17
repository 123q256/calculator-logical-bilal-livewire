<div>
  <form wire:submit.prevent="calculate">
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
            
            <div class="col-span-12 ">
                <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <p class="col-span-12 label"><strong>{{$lang['calculate']}} {{$lang['1']}}:</strong></p>
                <p class="col-span-12 md:col-span-4 lg:col-span-4 simple_sum flex items-center gap-1">
                    <input type="radio" name="cal_meth" id="simple_sum" value="simple_sum" wire:model.live="cal_meth" class="cursor-pointer">
                    <label for="simple_sum" class="font-s-14 cursor-pointer select-none">{{$lang['2']}}</label>
                </p>
                <p class="col-span-12 md:col-span-6 lg:col-span-6 sigma_sum flex items-center gap-1">
                    <input type="radio" name="cal_meth" id="sigma_sum" value="sigma_sum" wire:model.live="cal_meth" class="cursor-pointer">
                    <label for="sigma_sum" class="font-s-14 cursor-pointer select-none">{{$lang['3']}} (Σ) {{$lang['4']}}</label>
                </p>
                </div>
            </div>
            
            <div class="col-span-12 @if($cal_meth === 'sigma_sum') hidden @endif" id="numsInput">
                <label for="nums" class="label">{{$lang[5]}} (,):</label>
                <div class="w-100 py-2">
                    <textarea aria-label="textarea input" id="nums" name="nums" class="textareaInput" wire:model.live="nums"></textarea>
                </div>
            </div>
            
            <div class="col-span-12 @if($cal_meth !== 'sigma_sum') hidden @endif sigmaInput">
                <label for="eq" class="label">{{$lang['6']}}:</label>
                <div class="w-100 py-2">
                    <input type="text" name="eq" id="eq" class="input" aria-label="input" wire:model.live="eq" />
                </div>
            </div>
            
            <div class="col-span-12 @if($cal_meth !== 'sigma_sum') hidden @endif sigmaInput">
                <label for="x" class="label">{{$lang['7']}} (x) ({{$lang['9']}} ∞, {{$lang['10']}} oo):</label>
                <div class="w-100 py-2">
                    <input type="text" name="x" id="x" class="input" aria-label="input" wire:model.live="x" />
                </div>
            </div>
            
            <div class="col-span-12 @if($cal_meth !== 'sigma_sum') hidden @endif sigmaInput">
                <label for="n" class="label">{{$lang['8']}} (n) ({{$lang['9']}} -∞, {{$lang['10']}} -oo):</label>
                <div class="w-100 py-2">
                    <input type="text" name="n" id="n" class="input" aria-label="input" wire:model.live="n" />
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
                    <div class="w-full md:w-[60%] lg:w-[60%]   mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}}</strong></td>
                                <td class="py-2 border-b">\( {!! $detail['sum'] !!} \)</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                <td class="py-2 border-b">\( {!! $detail['tn'] !!} \)</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                        <p class="mt-3"><strong>{{$lang['12']}}</strong></p>
                        @if($cal_meth === "simple_sum")
                            <p class="mt-3">∑({{$nums}}) = {!! preg_replace('/\,/','+',$nums) !!}</p>
                            <p class="mt-3">∑({{$nums}}) = {!! $detail['sum'] !!}</p>
                            <p class="mt-3">{{$lang['13']}} = {!! $detail['tn'] !!}</p>
                        @else
                            @php
                                $enter=$detail['enter'];
                                $i_n=$detail['i_n'];
                                $solve=$detail['solve'];
                                $cnvrgnt=$detail['cnvrgnt'];
                            @endphp
                            @if($cnvrgnt==='True')
                                <p class="mt-3">\( x = {{$x}} \) {{$lang['15']}} \( {{$n}} \)</p>
                                <p class="mt-3">
                                    \( 
                                        x = {!! implode(',', $i_n) !!}
                                    \)
                                </p>
                                <p class="mt-3">{{$lang['16']}} x {{$lang['17']}} \( ({!! $enter !!}) \):</p>
                                
                                @php
                                    $expr_parts = [];
                                    foreach ($i_n as $value) {
                                        $expr_parts[] = '(' . preg_replace('/x/', '(' . $value . ')', $enter) . ')';
                                    }
                                    $expr_str = implode('+', $expr_parts);
                                @endphp
                                
                                <p class="mt-3">
                                    \( 
                                        \sum_{x={{$x}}}^{{$n}} {!! $enter !!} = {!! $expr_str !!}
                                    \)
                                </p>
                                
                                @php
                                    $solve_parts = [];
                                    foreach ($solve as $value) {
                                        $solve_parts[] = round($value, 2);
                                    }
                                    $solve_str = implode('+', $solve_parts);
                                @endphp
                                
                                <p class="mt-3">
                                    \( 
                                        \sum_{x={{$x}}}^{{$n}} {!! $enter !!} = {!! $solve_str !!}
                                    \)
                                </p>
                                <p class="mt-3">\( \sum_{x={{$x}}}^{{$n}} {!! $enter !!} = {!! $detail['sum'] !!} \)</p>
                            @else
                                <p class="mt-3">{{$lang['18']}}</p>
                                <p class="mt-3">\( \sum_{x={{$x}}}^{{{$n}}} {!! $enter !!} \) {{$lang['19']}}</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="if (typeof renderMathInElement === 'function') renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</form>
</div>
