<div>
   <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <button type="button" wire:click="setDimension('two')" class="w-full bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white tab {{ $gradient_type === 'two' ? 'tagsUnit' : '' }}">
                        {{ $lang['1'] }} (x , y)
                    </button>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <button type="button" wire:click="setDimension('three')" class="w-full bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white tab {{ $gradient_type === 'three' ? 'tagsUnit' : '' }}">
                        {{ $lang['1'] }} (x , y , z)
                    </button>
                </div>
            </div>
        </div>

            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="EnterEq" class="font-s-14 text-blue" id="functionText">
                        @if($gradient_type === "three")
                            {{$lang['2']}} f(x, y, z):
                        @else
                            {{$lang['2']}} f(x, y):
                        @endif
                    </label>
                    <div class="w-100 py-2">
                        <input type="text" name="EnterEq" id="EnterEq" class="input" wire:model.live="EnterEq" aria-label="input"/>
                    </div>
                </div>
                <div class="{{ $gradient_type === 'three' ? 'col-span-4':'col-span-6' }}" id="xValue">
                    <label for="x" class="font-s-14 text-blue">x:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="x" id="x" class="input" wire:model.live="x" aria-label="input"/>
                    </div>
                </div>
                <div class="{{ $gradient_type === 'three' ? 'col-span-4':'col-span-6' }}" id="yValue">
                    <label for="y" class="font-s-14 text-blue">y:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="y" id="y" class="input" wire:model.live="y" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-4 {{ $gradient_type === 'three' ? '':'hidden' }}" id="zValue">
                    <label for="z" class="font-s-14 text-blue">z:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="z" id="z" class="input" wire:model.live="z" aria-label="input"/>
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
                        <div class="w-full">
                            @if($gradient_type === 'two')
                                <p class="mt-3 text-[18px]">
                                    \( ∇({{$detail['enter']}})|_{(x,y)=({{$x . ',' . $y}})} = ({{$detail['x1'] . ',' . $detail['y1']}}) \)
                                </p>
                                <p class="mt-3"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-3">\( ∇f = \left( \frac{\partial f}{\partial x},\frac{\partial f}{\partial y}\right)\)</p>
                                <p class="mt-3">\(\frac{\partial f}{\partial x} = {{$detail['difs1']}}\)</p>
                                
                                <div x-data="{ showStep: false }">
                                    <div class="w-full mt-3">
                                        <button type="button" @click="showStep = !showStep" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['5']}}</button>
                                    </div>
                                    <div class="w-full res_step" x-show="showStep" x-collapse style="display: none;">
                                        {!! $detail['steps'] !!}
                                    </div>
                                </div>

                                <p class="mt-3">\(\frac{\partial f}{\partial y} = {{$detail['difs2']}}\)</p>
                                
                                <div x-data="{ showStep1: false }">
                                    <div class="w-full mt-3">
                                        <button type="button" @click="showStep1 = !showStep1" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['5']}}</button>
                                    </div>
                                    <div class="w-full res_step" x-show="showStep1" x-collapse style="display: none;">
                                        {!! $detail['steps1'] !!}
                                    </div>
                                </div>

                                <p class="mt-3">{{$lang['6']}}</p>
                                <p class="mt-3">\(∇f({{$x . ',' . $y}}) = ({{$detail['x1'] . ',' . $detail['y1']}})\)</p>
                                <p class="mt-3">\(∇({{$detail['enter']}})(x,y) = ({{$detail['difs1'] . ',' . $detail['difs2']}})\)</p>
                                <p class="mt-3">{{$lang['3']}}</p>
                                <p class="mt-3">\(∇({{$detail['enter']}})|_{(x,y)=({{$x . ',' . $y}})} = ({{$detail['x1'] . ',' . $detail['y1']}})\)</p>
                            @else
                                <p class="mt-3 font-s-18">
                                    \( ∇({{$detail['enter']}})|_{(x,y,z)=({{$x . ',' . $y . ',' . $z}})} = ({{$detail['x1'] . ',' . $detail['y1'] . ',' . $detail['z1']}}) \)
                                </p>
                                <p class="mt-3"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-3">\( ∇f = \left( \frac{\partial f}{\partial x},\frac{\partial f}{\partial y},\frac{\partial f}{\partial z}\right)\)</p>
                                <p class="mt-3">\(\frac{\partial f}{\partial x} = {{$detail['difs1']}}\)</p>
                                
                                <div x-data="{ showStep: false }">
                                    <div class="w-full mt-3">
                                        <button type="button" @click="showStep = !showStep" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['5']}}</button>
                                    </div>
                                    <div class="w-full res_step" x-show="showStep" x-collapse style="display: none;">
                                        {!! $detail['steps'] !!}
                                    </div>
                                </div>

                                <p class="mt-3">\(\frac{\partial f}{\partial y} = {{$detail['difs2']}}\)</p>
                                
                                <div x-data="{ showStep1: false }">
                                    <div class="w-full mt-3">
                                        <button type="button" @click="showStep1 = !showStep1" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['5']}}</button>
                                    </div>
                                    <div class="w-full res_step" x-show="showStep1" x-collapse style="display: none;">
                                        {!! $detail['steps1'] !!}
                                    </div>
                                </div>

                                <p class="mt-3">\(\frac{\partial f}{\partial z} = {{$detail['difs3']}}\)</p>
                                
                                <div x-data="{ showStep2: false }">
                                    <div class="w-full mt-3">
                                        <button type="button" @click="showStep2 = !showStep2" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['5']}}</button>
                                    </div>
                                    <div class="w-full res_step" x-show="showStep2" x-collapse style="display: none;">
                                        {!! $detail['steps2'] !!}
                                    </div>
                                </div>

                                <p class="mt-3">{{$lang['6']}}</p>
                                <p class="mt-3">\(∇f({{$x . ',' . $y . ',' . $z}}) = ({{$detail['x1'] . ',' . $detail['y1'] . ',' . $detail['z1']}})\)</p>
                                <p class="mt-3">\(∇({{$detail['enter']}})(x,y,z) = ({{$detail['difs1'] . ',' . $detail['difs2'] . ',' . $detail['difs3']}})\)</p>
                                <p class="mt-3">{{$lang['3']}}</p>
                                <p class="mt-3">\(∇({{$detail['enter']}})|_{(x,y,z)=({{$x . ',' . $y . ',' . $z}})} = ({{$detail['x1'] . ',' . $detail['y1'] . ',' . $detail['z1']}})\)</p>
                            @endif
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
