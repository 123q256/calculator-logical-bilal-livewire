<div>
  <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <p class="col-span-12"><strong>{{$lang['1']}}: f(x,y) = g(x,y)</strong></p>
            <div class="col-span-12">
                <label for="EnterEq" class="label text-left">f(x,y):</label>
                <div class="w-100 py-2">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" wire:model.live="EnterEq" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="EnterEq1" class="label text-left">g(x,y):</label>
                <div class="w-100 py-2">
                    <input type="text" name="EnterEq1" id="EnterEq1" class="input" wire:model.live="EnterEq1" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="with" class="label text-left">{{$lang['2']}} W.R.T:</label>
                <div class="w-100 py-2">
                    <select name="with" class="input" id="with" wire:model.live="with" aria-label="select">
                        <option value="x">x</option>
                        <option value="y">y</option>
                    </select>
                </div>
            </div>
            <p class="col-span-12"><strong>{{$lang['3']}} (x,y): ({{$lang['5']}})</strong></p>
            <div class="col-span-6">
                <label for="x" class="label text-left">x:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x" id="x" class="input" wire:model.live="x" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="y" class="label text-left">y:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y" id="y" class="input" wire:model.live="y" aria-label="input"/>
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
                            @if($with=='x')
                                <div class="w-full text-center font-s-20">
                                    <p class="my-3"><strong class="bg-[#ffffff] px-3 py-4 text-[32px] rounded-lg text-blue-500">\( \color{#1670a7} {\frac{dy}{dx} = {!! $detail['res'] !!}} \)</strong></p>
                                </div>
                                @if(is_numeric($x) && is_numeric($y))
                                    <div class="w-full text-center font-s-20 mt-3">
                                        <p class="my-3"><strong class="bg-[#ffffff] px-3 py-4 text-[32px] rounded-lg text-blue-500">\( \color{#1670a7} {\left.\frac{dy}{dx}\right|_{(x,y)=({!! $x !!},{!! $y !!})} = {!! round($detail['resf'], 4) !!}} \)</strong></p>
                                    </div>
                                @endif
                            @else
                                <div class="w-full text-center font-s-20">
                                    <p class="my-3"><strong class="bg-[#ffffff] px-3 py-4 text-[32px] rounded-lg text-blue-500">\( \color{#1670a7} {\frac{dx}{dy} = {!! $detail['res'] !!}} \)</strong></p>
                                </div>
                                @if(is_numeric($x) && is_numeric($y))
                                    <div class="w-full text-center font-s-20 mt-3">
                                        <p class="my-3"><strong class="bg-[#ffffff] px-3 py-4 text-[32px] rounded-lg text-blue-500">\( \color{#1670a7} {\left.\frac{dx}{dy}\right|_{(x,y)=({!! $x !!},{!! $y !!})} = {!! round($detail['resf'], 4) !!}} \)</strong></p>
                                    </div>
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
