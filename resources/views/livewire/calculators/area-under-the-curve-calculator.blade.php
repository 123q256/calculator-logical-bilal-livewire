<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="EnterEq1" class="font-s-14 text-blue text-left">{{ $lang[1] }}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="EnterEq1" id="EnterEq1" class="input" wire:model.live="EnterEq1" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="upper" class="font-s-14 text-blue text-left">{{ $lang[2] }}: (inf = ∞ , pi = π)</label>
                    <div class="w-full py-2">
                        <input type="text" name="upper" id="upper" class="input" wire:model.live="upper" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="lower" class="font-s-14 text-blue text-left">{{ $lang[3] }}: (inf = ∞ , pi = π)</label>
                    <div class="w-full py-2">
                        <input type="text" name="lower" id="lower" class="input" wire:model.live="lower" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="with" class="font-s-14 text-blue text-left">W.R.T</label>
                    <div class="w-full py-2 position-relative">
                        <select name="with" id="with" class="input" wire:model.live="with" aria-label="select">
                            <option value="x">x</option>
                            <option value="y">y</option>
                        </select>
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
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[16px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['4'] }}:</td>
                                        <td class="py-2 border-b"><strong>\( \int\limits_{ {!! $detail['lb'] !!} }^{ {!! $detail['ub'] !!} } \left({!! $detail['enter'] !!}\right)\, d{!! $detail['with'] !!} \)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang['5'] }}:</td>
                                        <td class="py-2 border-b"><strong>= \( {!! $detail['ans'] !!} \)</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="w-full mt-3 text-[21px] text-blue-500">{{ $lang[6] }}</p>
                            <div class="w-full mt-3 px-3">
                                {!! $detail['steps'] !!}
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
