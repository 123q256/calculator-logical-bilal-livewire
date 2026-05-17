<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white tab @if($calc_type === 'm1') tagsUnit @endif" wire:click="$set('calc_type', 'm1')">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white tab @if($calc_type === 'm2') tagsUnit @endif" wire:click="$set('calc_type', 'm2')">
                            {{ $lang['2'] }}
                    </div>
                </div>
            </div>
        </div>

            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 mt-5">

            @if($calc_type === 'm1')
            <div class="col-span-12" id="m1Inputs">
                <div class="flex items-center justify-center">
                    <p><strong>| x | =</strong></p>
                    <div class="pl-2">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="n" id="n" class="input" wire:model.live="n" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($calc_type === 'm2')
            <div class="col-span-12 row" id="m2Inputs">
                <div class="flex items-center justify-center">
                    <div>
                        <div class="w-full py-2">
                            <input type="text" name="eq" id="eq" class="input" wire:model.live="eq" aria-label="input" />
                        </div>
                    </div>
                    <p class="px-2"><strong>=</strong></p>
                    <div>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="n1" id="n1" class="input" wire:model.live="n1" aria-label="input" />
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="var" class="font-s-14 text-blue text-left">{{ $lang['3'] }}:</label>
                    <div class="w-full py-2">
                        <select id="var" name="var" class="input dtrmn_mtrx_slct" wire:model.live="var">
                            <option value="x">x</option>
                            <option value="y">y</option>
                            <option value="z">z</option>
                            <option value="u">u</option>
                            <option value="v">v</option>
                            <option value="w">w</option>
                        </select>
                    </div>
                </div>
            </div>
            @endif
         
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
                            @if($calc_type === 'm1')
                                <div class="col-12 text-center my-2">
                                    <p><strong class="bg-[#ffffff] px-3 py-2 text-[32px] rounded-lg text-blue-500">\( |{!! $n !!}| = \space {!! $detail['res'] !!} \)</strong></p>
                                </div>
                            @else
                                <div class="col-12 text-center my-2">
                                    <p><strong class="bg-[#ffffff] p-4 text-[32px] rounded-lg text-blue-500">\( {!! $detail['eq'] !!} = {!! $detail['n1'] !!} \quad : \quad {!! preg_replace('/frac/','dfrac',$detail['res']) !!}, {!! preg_replace('/frac/','dfrac',$detail['res1']) !!} \)</strong></p>
                                </div>
                                @if($detail['check1'] == $detail['check11'] && $detail['check2'] != $detail['check22'])
                                  <p class="mt-2">\( {!! $var !!} = {!! preg_replace('/frac/','dfrac',$detail['res']) !!} \) ({{ $lang['5'] }})</p>
                                  <p class="mt-2">\( {!! $var !!} = {!! preg_replace('/frac/','dfrac',$detail['res1']) !!} \) ({{ $lang['6'] }})</p>
                                @elseif($detail['check1'] != $detail['check11'] && $detail['check2'] == $detail['check22'])
                                  <p class="mt-2">\( {!! $var !!} = {!! preg_replace('/frac/','dfrac',$detail['res1']) !!} \) ({{ $lang['5'] }})</p>
                                  <p class="mt-2">\( {!! $var !!} = {!! preg_replace('/frac/','dfrac',$detail['res']) !!} \) ({{ $lang['6'] }})</p>
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
