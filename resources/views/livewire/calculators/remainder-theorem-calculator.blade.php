<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="num" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                <div class="w-full py-2">
                    <input type="text" name="num" id="num" class="input" aria-label="input" wire:model.live="num" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="denom" class="font-s-14 text-blue">{{$lang['2']}}:</label>
                <div class="w-full py-2">
                    <input type="text" name="denom" id="denom" class="input" aria-label="input" wire:model.live="denom" />
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
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                    <td class="py-2 border-b">\( {{round($detail['ans'],3)}} \)</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[18px]">
                            <p class="mt-3"><strong>{{$lang['5']}}</strong></p>
                            <p class="mt-3">{{$lang['3']}}</p>
                            <p class="mt-3">\( f(x) = {{$detail['enter']}}  \)</p>
                            <p class="mt-3">{{$lang['6']}}</p>
                            <p class="mt-3">\( f(x) = {{$detail['enter']}}  \)</p>
                            <p class="mt-3">\( x = {{ preg_match("/frac/",$detail['x'])?'\Large{'.$detail['x'].'}':$detail['x'] }}  \)</p>
                            <p class="mt-3">{{$lang['7']}} \( {{preg_match("/frac/",$detail['x'])?'\Large{('.$detail['x'].')}':'('.$detail['x'].')'}} \)</p>
                            <p class="mt-3">\( f({{$detail['x']}}) = {{preg_replace("/x/",'('.$detail['x'].')',$detail['enter'])}} \)</p>
                            <p class="mt-3">\( f({{$detail['x']}}) = {{$detail['ans']}} \)</p>
                            <p class="mt-3">{{$lang['8']}} \( {{round($detail['ans'],3)}} \)</p>
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
