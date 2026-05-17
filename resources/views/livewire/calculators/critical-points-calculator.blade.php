<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="EnterEq" class="label text-left">{{$lang['1']}} f(x,y):</label>
                    <div class="w-full py-2">
                        <input type="text" name="EnterEq" id="EnterEq" class="input" wire:model.live="EnterEq" aria-label="input"/>
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
                        <div class="row">
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[18px]"><strong>{{$lang['3']}}</strong></p>
                                <p class="mt-3">\( {!! $detail['root'] !!} \)</p>
                                <p class="mt-3"><strong>{{$lang['5']}}</strong></p>
                                <p class="mt-2">{{$lang['4']}}:</p>
                                <p class="mt-2">\( \frac{\partial}{\partial x}\left({!! $detail['enter'] !!}\right) \)</p>
                                <div class="w-full res_step">
                                    {!! $detail['buffer'] !!}
                                </div>
                                @if(isset($detail['wrt']))
                                    <p class="mt-3">{{$lang['4']}}:</p>
                                    <p class="mt-3">\( \frac{\partial}{\partial y}\left({!! $detail['enter'] !!}\right) \)</p>
                                    <div class="w-full my-3 res_step">
                                        {!! $detail['step'] !!}
                                    </div>
                                    <p class="mt-3">{{$lang['6']}} f'(x,y) = 0</p>
                                    <p class="mt-3">\( {!! $detail['ans'] !!} = 0\)</p>
                                    <p class="mt-3">\( {!! $detail['ans1'] !!} = 0\)</p>
                                @else
                                    <p class="mt-3">{{$lang['6']}} f'(x) = 0</p>
                                    <p class="mt-3">\( {!! $detail['ans'] !!} = 0\)</p>
                                    <p class="mt-3">Local Minima</p>
                                    <p class="mt-3">\( (x,f(x)) = {!! $detail['mini'] !!} \)</p>
                                    <p class="mt-3">Local Maxima</p>
                                    <p class="mt-3">\( (x,f(x)) = {!! $detail['maxi'] !!} \)</p>
                                @endif
                                <p class="mt-3">{{$lang['7']}}: \( {!! $detail['root'] !!} \)</p>
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
