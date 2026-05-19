<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="expression_unit" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="expression_unit" id="expression_unit" class="input">
                                <option value="1">{!! $lang[2] !!}</option>
                                <option value="2">{!! $lang[3] !!}</option>
                                <option value="3">{!! $lang[4] !!}</option>
                                <option value="4">{!! $lang[5] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 text-center my-3" id="equation-display" wire:ignore x-data="{ expression_unit: @entangle('expression_unit') }">
                        <div x-show="expression_unit === '1'" style="display: none;">$$ a\sqrt[n]{b} $$</div>
                        <div x-show="expression_unit === '2'" style="display: none;">$$ a\sqrt[n]{b}+c\sqrt[m]{d}=? $$</div>
                        <div x-show="expression_unit === '3'" style="display: none;">$$ a\sqrt[n]{b} \cdot c\sqrt[m]{d}=? $$</div>
                        <div x-show="expression_unit === '4'" style="display: none;">$$ \frac{a\sqrt[n]{b}}{c\sqrt[m]{d}}=? $$</div>
                    </div>

                    <div class="col-span-6 num1">
                        <label for="num1" class="font-s-14 text-blue">a ({{ $lang[6] }}):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="num1" id="num1" class="input" aria-label="input" placeholder="5" />
                        </div>
                    </div>
                    <div class="col-span-6 num2">
                        <label for="num2" class="font-s-14 text-blue r">b:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="num2" id="num2" class="input" aria-label="input" placeholder="7" />
                        </div>
                    </div>
                    <div class="col-span-6 num3">
                        <label for="num3" class="font-s-14 text-blue r">n:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="num3" id="num3" class="input" aria-label="input" placeholder="7" />
                        </div>
                    </div>

                    @if ($expression_unit !== '1')
                        <div class="col-span-6 num4">
                            <label for="num4" class="font-s-14 text-blue r">c ({{ $lang[6] }}):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="num4" id="num4" class="input" aria-label="input" placeholder="7" />
                            </div>
                        </div>
                        <div class="col-span-6 num5">
                            <label for="num5" class="font-s-14 text-blue r">d:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="num5" id="num5" class="input" aria-label="input" placeholder="7" />
                            </div>
                        </div>
                        <div class="col-span-6 num6">
                            <label for="num6" class="font-s-14 text-blue r">m:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="num6" id="num6" class="input" aria-label="input" placeholder="7" />
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{ $lang[7] }}:</strong></p>
                                    <div class="col-12">
                                        <div class="all_result text-[20px] mt-2">
                                            @if (!empty($result_steps))
                                                @foreach ($result_steps as $step)
                                                    <p class="font-s-25 mt-2 text-blue">{!! $step !!}</p>
                                                @endforeach
                                            @endif
                                        </div>
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
            <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderKaTeX()"></script>

            <script>
                function renderKaTeX() {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.body, {
                            delimiters: [
                                {left: '$$', right: '$$', display: true},
                                {left: '\\(', right: '\\)', display: false},
                                {left: '$', right: '$', display: false}
                            ],
                            throwOnError: false
                        });
                    }
                }

                document.addEventListener('DOMContentLoaded', renderKaTeX);
                document.addEventListener('livewire:initialized', () => {
                    setTimeout(renderKaTeX, 100);
                });
            </script>
        @endpush
    </form>
</div>
