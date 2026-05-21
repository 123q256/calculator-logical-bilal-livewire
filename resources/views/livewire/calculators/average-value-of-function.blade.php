<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="fun" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="w-100 py-2">
                    <input type="text" wire:model.live="fun" id="fun" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="lb" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="lb" id="lb" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="ub" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="ub" id="ub" class="input" aria-label="input" />
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
                            <div class="col-12 text-[16px]">
                                <p class="mt-3 text-[18px]">\( \int_{ {{$lb.'}^{'.$ub}} } {{$detail['sim']}}\, d{{$detail['with']}} = {{$detail['ans']}} \)</p>
                                <p class="mt-3"><strong>{{$lang['5']}}:</strong></p>
                                <p class="mt-3">{{$lang[6]}} \({{$detail['input']}}\) {{$lang[7]}} \( \left[{{$lb}},{{$ub}}\right]\)</p>
                                <p class="mt-3">{{$lang[8]}} \(f(x)\) {{$lang[7]}} \([a,b]\) is \( \bar{f}= \frac{1}{b-a} \int_a^b f \left( x \right) d x \)</p>
                                <p class="mt-3">{{$lang[9]}} \( L = \frac{1}{\left( {{$ub}} \right)-\left( {{$lb}} \right)}\int_{ {{$lb}} }^{ {{$ub}} } {{$detail['input']}} d{{$detail['with']}} = \int_{ {{$lb}} }^{ {{$ub}} } {{$detail['sim']}}d{{$detail['with']}}\)</p>
                                <p class="mt-3">
                                    {{$lang[10]}}:
                                    <a href="{{ url('integral-calculator') }}/" class="text-blue" target="_blank">{{$lang[11]}}</a>
                                </p>
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
            MathJax.Hub.Config({"SVG": {linebreaks: { automatic: true }} });
        </script>
        <script>
            function MJrerender() {
                if (window.MathJax) {
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                }
            }
            document.addEventListener('livewire:initialized', () => {
                Livewire.hook('morph.updated', () => {
                    MJrerender();
                });
            });
        </script>
    @endpush
</form>
</div>
