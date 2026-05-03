<div>
    <style>
        img { object-fit: contain; }
    </style>
    
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Confidence Level --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="per" class="font-s-14 text-blue">{{ $lang['a'] ?? 'Confidence Level' }}</label>
                        <select wire:model.live="per" id="per" class="input mt-2">
                            <option value="11@70">70%</option>
                            <option value="1.5@75">75%</option>
                            <option value="1.28@80">80%</option>
                            <option value="1.44@85">85%</option>
                            <option value="1.645@90">90%</option>
                            <option value="1.7@91">91%</option>
                            <option value="1.75@92">92%</option>
                            <option value="1.81@93">93%</option>
                            <option value="1.88@94">94%</option>
                            <option value="1.96@95">95%</option>
                            <option value="22@96">96%</option>
                            <option value="2.17@97">97%</option>
                            <option value="2.33@98">98%</option>
                            <option value="2.576@99">99%</option>
                            <option value="2.807@99.5">99.5%</option>
                            <option value="3.29@99.9">99.9%</option>
                            <option value="3.89@99.99">99.99%</option>
                        </select>
                    </div>

                    {{-- Sample Proportion --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="x" class="font-s-14 text-blue">{{ $lang['p'] ?? 'Sample Proportion' }} (%)</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="x" id="x" min="1" max="99" class="input" placeholder="50" />
                            <span class="text-blue input_unit absolute right-4 top-1/2 -translate-y-1/2 font-semibold">%</span>
                        </div>
                    </div>

                    {{-- Sample Size --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="y" class="font-s-14 text-blue">{{ $lang['n'] ?? 'Sample Size (n)' }}</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="y" id="y" class="input" placeholder="30" />
                        </div>
                    </div>

                    {{-- Population Size --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="z" class="font-s-14 text-blue">{{ $lang['pp'] ?? 'Population Size (N)' }}</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="z" id="z" class="input" placeholder="60" />
                        </div>
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
    <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[60%] lg:w-[60%] overflow-auto mt-2">
                                <table class="w-100 text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang['ans'] ?? 'Margin of Error' }}</strong></td>
                                        <td class="py-2 border-b">
                                            <strong class="text-blue">{{ $detail['ans'] ?? '0.0%' }}</strong>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="w-full text-[16px] mt-6">
                                <p class="font-bold text-blue">Solution:</p>
                                @php
                                    $z_parts = explode('@', $per);
                                    $p_val = round($x / 100, 2);
                                @endphp

                                @if(empty($z))
                                    <p class="mt-2">MOE = z × 
                                        <span class="quadratic_math-eq-token">
                                            <span class="quadratic_square-root">p × (1 - p)</span>
                                            <span class="quadratic_square-root">{{ $y }}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2 text-sm text-gray-600">Where: z = {{ $z_parts[0] }} for a confidence level of {{ $z_parts[1] ?? '95' }}% , p = {{ $p_val }} and n = {{ $y }}</p>
                                    
                                    <div class="mt-3 space-y-1">
                                        <p>MOE = {{ $z_parts[0] }} ×
                                            <span class="quadratic_math-eq-token">
                                                <span class="quadratic_square-root">{{ $p_val }} (1 - {{ $p_val }})</span>
                                                <span class="quadratic_square-root">{{ $y }}</span>
                                            </span>
                                        </p>
                                        <p>MOE = {{ $z_parts[0] }} ×
                                            <span class="quadratic_math-eq-token">
                                                <span class="quadratic_square-root">{{ round($p_val * (1 - $p_val), 4) }}</span>
                                                <span class="quadratic_square-root">{{ $y }}</span>
                                            </span>
                                        </p>
                                        <p>MOE = {{ $z_parts[0] }} ×
                                            <span class="quadratic_math-eq-token">
                                                <span>{{ round(sqrt($p_val * (1 - $p_val)), 4) }}</span>
                                                <span>{{ round(sqrt($y), 2) }}</span>
                                            </span>
                                        </p>
                                        <p class="text-lg font-bold text-blue mt-2">MOE {{ $detail['ans'] }}</p>
                                    </div>
                                @else
                                    <p class="mt-2">MOE = z × 
                                        <span class="quadratic_math-eq-token">
                                            <span class="quadratic_square-root">p × (1 - p)</span>
                                            <span class="quadratic_square-root">((N - 1) * n / (N - n))</span>
                                        </span>
                                    </p>
                                    <p class="mt-2 text-sm text-gray-600">Where: z = {{ $z_parts[0] }} for a confidence level of {{ $z_parts[1] ?? '95' }}% , p = {{ $p_val }}, N = {{ $z }} and n = {{ $y }}</p>

                                    <div class="mt-3 space-y-1">
                                        <p>MOE = {{ $z_parts[0] }} ×
                                            <span class="quadratic_math-eq-token">
                                                <span class="quadratic_square-root">{{ $p_val }} (1 - {{ $p_val }})</span>
                                                <span class="quadratic_square-root">({{ $z }} - 1) * {{ $y }} / ({{ $z }} - {{ $y }})</span>
                                            </span>
                                        </p>
                                        <p>MOE = {{ $z_parts[0] }} ×
                                            <span class="quadratic_math-eq-token">
                                                <span class="quadratic_square-root">{{ $p_val }} ({{ 1 - $p_val }})</span>
                                                <span class="quadratic_square-root">{{ $z - 1 }} * {{ $y }} / ({{ $z - $y }})</span>
                                            </span>
                                        </p>
                                        @php
                                            $fpc_denom = ($z == $y) ? 0 : ($z - 1) * $y / ($z - $y);
                                        @endphp
                                        <p>MOE = {{ $z_parts[0] }} ×
                                            <span class="quadratic_math-eq-token">
                                                <span class="quadratic_square-root">{{ round($p_val * (1 - $p_val), 4) }}</span>
                                                @if ($z == $y)
                                                    <span class="quadratic_square-root">0</span>
                                                @else
                                                    <span class="quadratic_square-root">{{ round(sqrt($z - 1), 2) }} * ({{ round($y / ($z - $y), 2) }})</span>
                                                @endif
                                            </span>
                                        </p>
                                        <p>MOE = {{ $z_parts[0] }} ×
                                            <span class="quadratic_math-eq-token">
                                                <span class="quadratic_square-root">{{ round(sqrt($p_val * (1 - $p_val)), 4) }}</span>
                                                @if ($z == $y)
                                                    <span class="quadratic_square-root">0</span>
                                                @else
                                                    <span class="quadratic_square-root">{{ round(sqrt($fpc_denom), 4) }}</span>
                                                @endif
                                            </span>
                                        </p>
                                        <p class="text-lg font-bold text-blue mt-2">MOE {{ $detail['ans'] }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
