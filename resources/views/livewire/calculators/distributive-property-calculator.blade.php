<div x-data="{
    EnterEq: @entangle('EnterEq').live
}">
<style>
    .own_steps p {
        margin-top: 10px;
    }
</style>

<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif

        <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                <p class="col-span-12 my-2 text-[14px]">
                    <strong>{{ $lang['2'] ?? 'Standard Form' }}: {{ $lang['3'] ?? 'a*(b + c)' }}</strong>
                </p>
                
                <div class="col-span-12">
                    <label for="EnterEq" class="label">{{ $lang['1'] ?? 'Enter Equation' }}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="EnterEq" id="EnterEq" class="input" x-model="EnterEq" aria-label="input"/>
                    </div>
                </div>
                
                <p class="col-span-12 my-2 text-[14px]">
                    <strong>Examples:</strong> (2-13+4)/(9), 3*(13-7), (13-3-2)*(12-5), (5*(7-3))*(16*(13-3)+5)
                </p>
            </div>
        </div>

        @if ($type == 'calculator')
            @include('inc.button')
        @endif
        @if ($type == 'widget')
            @include('inc.widget-button')
        @endif
    </div>

    @isset($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div>
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="text-center pt-1 pb-2">
                            <p class="bg-gradient-to-r relative inline-block rounded-full p-3">
                                {!! $lang['4'] ?? 'Answer' !!}
                            </p>
                            <div class="flex justify-center">
                                <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                    {{ round($detail['ans'], 5) }}
                                </p>
                            </div>
                        </div>

                        <div class="w-full text-[16px]">
                            <p class="text-danger"><strong>{{ $lang['5'] ?? 'Steps' }} :</strong></p>
                            <p class="text-danger">{{ $lang['6'] ?? 'Expression' }} : {{ $detail['input'] }}</p>
                            <p class="text-danger"> = {{ round($detail['ans'], 5) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @push('calculatorJS')
        <script>
            function convertScriptTagsToMathJax() {
                document.querySelectorAll('script[type^="math/tex"]').forEach(script => {
                    const math = script.textContent || script.innerText;
                    const isDisplay = script.getAttribute('type').includes('mode=display') || script.getAttribute('mode') === 'display';
                    
                    const span = document.createElement('span');
                    if (isDisplay) {
                        span.textContent = '$$' + math + '$$';
                    } else {
                        span.textContent = '\\(' + math + '\\)';
                    }
                    script.parentNode.replaceChild(span, script);
                });
            }

            function rerenderMath() {
                convertScriptTagsToMathJax();
                if (typeof MathJax !== 'undefined') {
                    if (typeof MathJax.typesetPromise === 'function') {
                        MathJax.typesetPromise().catch(err => console.log(err));
                    } else if (typeof MathJax.typeset === 'function') {
                        MathJax.typeset();
                    } else if (MathJax.Hub && typeof MathJax.Hub.Queue === 'function') {
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                    }
                }
            }

            if (typeof MathJax === 'undefined') {
                var script = document.createElement('script');
                script.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                document.head.appendChild(script);

                var config = document.createElement('script');
                config.type = "text/x-mathjax-config";
                config.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }}, "CommonHTML": {linebreaks: { automatic: true }}});';
                document.head.appendChild(config);
            } else {
                setTimeout(rerenderMath, 200);
            }

            document.addEventListener('livewire:init', () => {
                Livewire.on('math-updated', () => {
                    setTimeout(rerenderMath, 100);
                });
            });
        </script>
    @endpush
</form>
</div>
