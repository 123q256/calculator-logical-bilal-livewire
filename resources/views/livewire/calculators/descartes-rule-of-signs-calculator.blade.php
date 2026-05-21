<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-9">
                <label for="equ" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="w-100 py-2">
                    <input type="text" id="equ" class="input" wire:model.live="equ" aria-label="input" />
                </div>
            </div>
            <div class="col-span-3">
                <label for="vari" class="font-s-14 text-blue">&nbsp;</label>
                <div class="w-100 py-2">
                    <input type="text" maxlength="1" pattern="[A-Za-z]{1}" id="vari" class="input" wire:model.live="vari" aria-label="input" />
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                @php $positive=$detail['positive'];$negative=$detail['negative']; @endphp
                                <table class="w-full text-[16px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">
                                            {{$positive}}
                                            @while($positive>1)
                                                @php $positive=$positive-2; @endphp
                                                {{ "or $positive" }}
                                            @endwhile
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                        <td class="py-2 border-b">
                                            {{$negative}}
                                            @while($negative>1)
                                                @php $negative=$negative-2; @endphp
                                                {{ "or $negative" }}
                                            @endwhile
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full ftext-[16px]">
                                <p class="mt-3"><strong>Solution</strong></p>
                                <p class="mt-3">{{$lang[5]}}:</p>
                                <p class="mt-3">{{$lang[6]}} \({{$detail['input1']}}\) {{$lang[7]}}.</p>
                                <p class="mt-3">{{$lang[8]}}</p>
                                <p class="mt-3">
                                    {{$lang[9]}}
                                    \(
                                        @php
                                            foreach ($detail['cof1'] as $key => $value) {
                                                if ($key==0) {
                                                    echo "$value";
                                                }else{
                                                    echo ", $value";
                                                }
                                            }        
                                        @endphp
                                    \)
                                </p>
                                <p class="mt-3">{{$lang[10]}} \({{$detail['positive']}}\) {{$lang[11]}}.</p>
                                <p class="mt-3">
                                    {{$lang[16]}} \({{$detail['positive']}} 
                                    @php 
                                        $positive=$detail['positive'];
                                        while($positive>1) {
                                            $positive=$positive-2;
                                            echo "\\text{ or } $positive";
                                        }
                                    @endphp \)
                                    {{strtolower($lang[3])}}.
                                </p>
                                <p class="mt-3">{{$lang[12]}} \(-{{$vari}}\) {{$lang[13]}} \({{$vari}}\) {{$lang[14]}}:</p>
                                <p class="mt-3">\({{$detail['input1']}}\) {{$lang[15]}} \({{$detail['input2']}}\)</p>
                                <p class="mt-3">
                                    {{$lang[9]}}
                                    \(
                                        @php
                                            foreach ($detail['cof2'] as $key => $value) {
                                                if ($key==0) {
                                                    echo "$value";
                                                }else{
                                                    echo ", $value";
                                                }
                                            }      
                                        @endphp
                                    \)
                                </p>
                                <p class="mt-3">{{$lang[10]}} \({{$detail['negative']}}\) {{$lang[11]}}.</p>
                                <p class="mt-3">
                                    {{$lang[16]}} \({{$detail['negative']}}
                                    @php
                                        $negative=$detail['negative'];
                                        while ($negative>1) {
                                            $negative=$negative-2;
                                            echo "\\text{ or } $negative";
                                        }
                                    @endphp \)
                                    {{strtolower($lang[4])}}.
                                </p>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({"SVG": {linebreaks: { automatic: true }} });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
    @endpush
</form>
</div>
