<div>
<form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="EnterEq" class="font-s-14 text-blue">f(x):</label>
                <div class="w-full py-2">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" wire:model.live="EnterEq" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="EnterEq1" class="font-s-14 text-blue">g(x):</label>
                <div class="w-full py-2">
                    <input type="text" name="EnterEq1" id="EnterEq1" class="input" wire:model.live="EnterEq1" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ub" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                <div class="w-full py-2">
                    <input type="number" name="ub" id="ub" class="input" wire:model.live="ub" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="lb" class="font-s-14 text-blue">{{$lang['2']}}:</label>
                <div class="w-full py-2">
                    <input type="number" name="lb" id="lb" class="input" wire:model.live="lb" aria-label="input"/>
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
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[18px]"><strong>{{$lang['3']}}</strong></p>
                                <p class="mt-3">\( \pi \int\limits_{ {!! $lb !!} }^{ {!! $ub !!} } ({!! $detail['enter'] !!})\, dx \)</p>
                                <p class="mt-3">\( = \pi \times {!! $detail['ress'] !!} \approx {!! round($detail['ress1'], 4) !!} \)</p>
                                <p class="mt-3 text-[18px]"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-3">\( \pi \int ({!! $detail['enter'] !!})\, dx \)</p>
                                <p class="mt-3">\( = \pi \left({!! $detail['res'] !!}\right) + \mathrm{constant} \)</p>
                                <p class="mt-3"><strong>{{$lang['5']}}:</strong></p>
                                <p class="mt-3">\( \int ({!! $detail['enter'] !!})\, dx \)</p>
                                <div class="w-full  mt-3 res_step">
                                    {!! $detail['step'] !!}
                                </div>
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
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="if (typeof convertLegacyMathScripts === 'function') { convertLegacyMathScripts(); } if (typeof renderMathInElement === 'function') { renderMathInElement(document.body); }"></script>
        <script>
            function convertLegacyMathScripts() {
                document.querySelectorAll('script[type^="math/tex"]').forEach(script => {
                    const isDisplay = script.type.includes('mode=display');
                    const mathText = script.textContent;
                    const span = document.createElement(isDisplay ? 'div' : 'span');
                    span.className = isDisplay ? 'math-display-block' : 'math-inline-block';
                    span.textContent = isDisplay ? '$$' + mathText + '$$' : '\\(' + mathText + '\\)';
                    script.parentNode.replaceChild(span, script);
                });
            }
            document.addEventListener('DOMContentLoaded', () => {
                convertLegacyMathScripts();
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</form>
</div>
