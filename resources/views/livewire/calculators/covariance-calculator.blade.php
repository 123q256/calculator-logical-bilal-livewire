<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2 relative">
                        <label for="formula" class="font-s-14 text-blue">{{ $lang['cal_for'] }}:</label>
                        <select wire:model.live="formula" id="formula" class="input">
                            <option value="1">{{ $lang['dataset'] }}</option>
                            <option value="2">{{ $lang['from'] }}</option>
                            <option value="3">{{ $lang['matrix'] }}</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-4 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2" x-show="$wire.formula == '1'">
                        <label for="set_x" class="font-s-14 text-blue">{{ $lang['set'] }} x</label>
                        <textarea wire:model.live="set_x" id="set_x" class="textareaInput" aria-label="input" placeholder="Enter numbers & separate by comma ','"></textarea>
                    </div>
                    <div class="space-y-2" x-show="$wire.formula == '1'">
                        <label for="set_y" class="font-s-14 text-blue">{{ $lang['set'] }} y</label>
                        <textarea wire:model.live="set_y" id="set_y" class="textareaInput" aria-label="input" placeholder="Enter numbers & separate by comma ','"></textarea>
                    </div>

                    <div class="space-y-2" x-show="$wire.formula == '2'" x-cloak>
                        <label for="between" class="font-s-14 text-blue" title="{{ $lang['tool'] }}">{{ $lang['xy'] }}</label>
                        <input type="number" step="any" min="-0.99999" max="0.99999" wire:model.live="between" id="between" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2" x-show="$wire.formula == '2'" x-cloak>
                        <label for="devi_x" class="font-s-14 text-blue">{{ $lang['devi'] }} X:</label>
                        <input type="number" step="any" wire:model.live="devi_x" id="devi_x" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2" x-show="$wire.formula == '2'" x-cloak>
                        <label for="devi_y" class="font-s-14 text-blue">{{ $lang['devi'] }} Y:</label>
                        <input type="number" step="any" wire:model.live="devi_y" id="devi_y" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4" x-show="$wire.formula == '3'" x-cloak>
                    <div class="space-y-2">
                        <label for="matrix" class="font-s-14 text-blue">{{ $lang['input'] }}</label>
                        <textarea wire:model.live="matrix" id="matrix" class="textareaInput" aria-label="input" placeholder="[13 , 44 , 25],[43 , 65 , 76],[12 , 54 , 8] Enter Matrix Value in this form"></textarea>
                    </div>
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
            <div id="result-section" 
                 x-init="
                    renderMath();
                    $nextTick(() => {
                        const offset = $el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    });
                 "
                 @render-math.window="renderMath()"
                 wire:loading.remove wire:target="calculate" 
                 class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg mt-4 items-center justify-center">
                        <div class="row">
                            @if ($detail['formula'] == 1)    
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['s'] }} X</td>
                                            <td class="py-2 border-b"><strong>{{ $set_x }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['s'] }} Y</td>
                                            <td class="py-2 border-b"><strong>{{ $set_y }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['sample'] }}</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['nbr'] ?? '0' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['Mean'] }} X̄</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['mean_x'] ?? '0' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['Mean'] }} Ȳ</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['mean_y'] ?? '0' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['s_cov'] }}</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['population'] ?? '0' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['p_cov'] }}</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['sample'] ?? '0' }}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if ($detail['formula'] == 2)
                                <div class="text-center">
                                    <p class="font-s-20"><strong>{{ $lang['cov_val'] }}</strong></p>
                                    <p class="font-s-32 px-3 py-2 radius-10 d-inline-block my-3">
                                        <strong class="bg-[#2845F5] text-white p-4 rounded-lg">{{ $detail['ans_2'] ?? '00' }}</strong>
                                    </p>
                                </div>
                            @endif
                            @if ($detail['formula'] == 3)
                                <div class="text-center bg-[#2845F5] text-white p-4 rounded-lg">
                                    <p class="font-s-20"><strong>{{ $lang['matrix'] }}</strong></p>
                                    <p class="px-3 py-2 radius-10 d-inline-block my-3">
                                        <strong class="">{!! $detail['output'] ?? '00' !!}</strong>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>

@push('calculatorJS')
    <script>
        function renderMath() {
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body, {
                    delimiters: [
                        {left: '$$', right: '$$', display: true},
                        {left: '$', right: '$', display: false},
                        {left: '\\(', right: '\\)', display: false},
                        {left: '\\[', right: '\\]', display: true}
                    ],
                    throwOnError : false
                });
            }
            if (typeof MathJax !== 'undefined' && typeof MathJax.typeset === 'function') {
                MathJax.typeset();
            }
        }

        window.addEventListener('render-math', renderMath);

        document.addEventListener('livewire:navigated', () => {
            renderMath();
        });
    </script>
@endpush
