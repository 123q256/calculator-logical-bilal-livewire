<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="one" class="label">{{$lang[1]}} f(x):</label>
                <div class="w-full py-2">
                    <input type="text" name="one" id="one" class="input" wire:model.live="one" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="two" class="label">{{$lang[1]}} g(x):</label>
                <div class="w-full py-2">
                    <input type="text" name="two" id="two" class="input" wire:model.live="two" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="point" class="label">{{$lang[2]}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="point" id="point" class="input" wire:model.live="point" aria-label="input"/>
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
                            <div class="w-full text-[18px]">
                                <p class="mt-2">
                                    \( (f∘g)(x) = {{$detail['enter2']}} \)
                                </p>
                                <p class="mt-2">
                                    \( (g∘f)(x) = {{$detail['enter3']}} \)
                                </p>
                                <p class="mt-2">
                                    \( (f∘g)({{$detail['point']}}) = {{$detail['res']}} \)
                                </p>
                                <p class="mt-2">
                                    \( (g∘f)({{$detail['point']}}) = {{$detail['res1']}} \)
                                </p>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-2">Your Input</p>
                                <p class="mt-2">\( f(x)={{$detail['one']}}\)</p>
                                <p class="mt-2">\( g(x)={{$detail['two']}}\)</p>
                                <p class="mt-2">\( x = {{$detail['point']}}\)</p>
                                <p class="mt-2">\( (f∘g)(x)=f(g(x))\)</p>
                                <p class="mt-2">\( (f∘g)(x)=f({{$detail['two']}})\)</p>
                                <p class="mt-2">\( (f∘g)(x)={{$detail['enter']}}\)</p>
                                <p class="mt-2">\( (f∘g)(x)={{$detail['enter2']}}\)</p>
                                <p class="mt-2">\( (f∘g)({{$detail['point']}})={{str_replace('x','('.$detail['point'].')',$detail['enter2'])}}\)</p>
                                <p class="mt-2">\( (f∘g)({{$detail['point']}})={{$detail['res']}}\)</p>
                                <p class="mt-2">\( (g∘f)(x)=g(f(x))\)</p>
                                <p class="mt-2">\( (g∘f)(x)=g({{$detail['one']}})\)</p>
                                <p class="mt-2">\( (g∘f)(x)={{$detail['enter1']}}\)</p>
                                <p class="mt-2">\( (g∘f)(x)={{$detail['enter3']}}\)</p>
                                <p class="mt-2">\( (g∘f)({{$detail['point']}})={{str_replace('x','('.$detail['point'].')',$detail['enter3'])}}\)</p>
                                <p class="mt-2">\( (g∘f)({{$detail['point']}})={{$detail['res1']}}\)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                // Initial render
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</form>
</div>
