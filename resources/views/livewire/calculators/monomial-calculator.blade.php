<div>
<form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="equ" class="font-s-14 text-blue">Enter the Expression:</label>
                    <div class="w-full py-2">
                        <input type="text" wire:model.live="equ" id="equ" class="input" aria-label="input" />
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
                        <div class="w-full text-center text-[18px] overflow-auto">
                            <p>Simplified Monomial</p>
                            <p class="my-3"><strong class="bg-[#ffffff] px-3 py-2 text-[22px] rounded-lg text-blue">\( {{$detail['ans']}} \)</strong></p>
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
       <script>
           function MJrerender() {
               if (typeof renderMathInElement === 'function') {
                   renderMathInElement(document.body);
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
