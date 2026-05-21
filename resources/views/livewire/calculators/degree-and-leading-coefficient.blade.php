<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="equ" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                    <div class="w-full py-2">
                        <input type="text" id="equ" class="input" aria-label="input" wire:model.live="equ" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="vari" class="font-s-14 text-blue">{{$lang['2']}}:</label>
                    <div class="w-full py-2">
                        <input type="text" pattern="[A-Za-z]{1}" maxlength="1" id="vari" class="input" aria-label="input" wire:model.live="vari" />
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
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                    <td class="py-2 border-b">{{$detail['degree']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                    <td class="py-2 border-b">{{$detail['lead']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['5'] }}</strong></td>
                                    <td class="py-2 border-b">\( {{ (($detail['lead']!=1)?$detail['lead']:'').$vari.(($detail['degree']!=1)?'^{'.$detail['degree'].'}':'') }} \)</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-3"><strong>{{$lang['6']}}</strong></p>
                            <p class="mt-3">{{ $lang['7'] }}: {{$lang[8]}} \( p({{$vari}}) = {{$detail['input']}} \)</p>
                            <p class="mt-3">{{$lang[9]}}: {{$detail['degree']}}</p>
                            <p class="mt-3">{{$lang[10]}}: \( {{(($detail['lead']!=1)?$detail['lead']:'').$vari.(($detail['degree']!=1)?'^{'.$detail['degree'].'}':'')}} \)</p>
                            <p class="mt-3">{{$lang[11]}}: {{$detail['lead']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
        @push('calculatorJS')
            <script type="text/x-mathjax-config">
                MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        @endpush
</div>
