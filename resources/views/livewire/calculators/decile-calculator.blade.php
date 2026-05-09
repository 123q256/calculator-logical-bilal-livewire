<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="x" class="font-s-14 text-blue">Enter Sample Data (Comma Separated):</label>
                        <div class="w-full py-2">
                            <textarea wire:model.live="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 11, 12, 13, 14, 14, 15, 15, 17, 18, 19, 20, 9, 23"></textarea>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="decile" class="font-s-14 text-blue">Decile (1, 2, ... or 9):</label>
                        <div class="w-full py-2">
                            <input type="number" min="1" max="9" wire:model.live="decile" id="decile" class="input" aria-label="input" placeholder="00" />
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="text-center">
                                    <p class="text-[18px]">
                                        <strong>Answer</strong>
                                    </p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['main_ans'] }}</strong>
                                        </p>
                                    </div>
                                </div>
                                
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue">Solution</strong></p>
                                <p class="w-full mt-2">The sample data is as follows:</p>
                                <div class="w-full mt-2 overflow-auto">
                                    <table class="w-full" style="border-collapse: collapse">
                                        <tr class="bg-gray-100">
                                            <td class="p-2 border text-center"><strong class="text-blue">Observation</strong></td>
                                            <td class="p-2 border text-center"><strong class="text-blue">X</strong></td>
                                        </tr>
                                        @foreach ($detail['ans_list'] as $key => $value)
                                            <tr class="bg-white">
                                                <td class="p-2 border text-center">{{ $key + 1 }}</td>
                                                <td class="p-2 border text-center">{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                
                                <p class="w-full mt-4">
                                    We need to compute the {{ $decile }}{{ in_array($decile, [1, 2, 3]) ? ['1' => 'st', '2' => 'nd', '3' => 'rd'][$decile] : 'th' }} decile (D<sub>{{ $decile }}</sub>) based on the data provided.
                                </p>
                                <p class="w-full mt-2">
                                    To calculate the value of the decile, we have to sort the data in ascending order. For reference, follow the table below:
                                </p>
                                <div class="w-full mt-2 overflow-auto">
                                    <table class="w-full" style="border-collapse: collapse">
                                        <tr class="bg-gray-100">
                                            <td class="p-2 border text-center"><strong class="text-blue">Position</strong></td>
                                            <td class="p-2 border text-center"><strong class="text-blue">X (Asc. Order)</strong></td>
                                        </tr>
                                        @foreach ($detail['ans_list'] as $key => $value)
                                            <tr class="bg-white">
                                                <td class="p-2 border text-center">{{ $key + 1 }}</td>
                                                <td class="p-2 border text-center">{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <p class="w-full mt-4">
                                    Now we have to determine the rank of the {{ $decile }}{{ in_array($decile, [1, 2, 3]) ? ['1' => 'st', '2' => 'nd', '3' => 'rd'][$decile] : 'th' }} decile. It yields:
                                </p>
                                <p class="w-full mt-3 text-[18px] text-center">
                                    \( \text{Decile Position} = \dfrac{(n + 1)P}{10} = \dfrac{({{ $detail['total_values'] }} + 1) \times {{ $decile }}}{10} = {{ $detail['decile_pos'] }} \)
                                </p>
                                
                                @if(is_numeric($detail['decile_pos']) && floor($detail['decile_pos']) != $detail['decile_pos'])
                                    <p class="w-full mt-4">
                                        Since the position found is not an integer, the method of interpolation needs to be used. The {{ $decile }}{{ in_array($decile, [1, 2, 3]) ? ['1' => 'st', '2' => 'nd', '3' => 'rd'][$decile] : 'th' }} decile is located between the values in the positions {{ $detail['floor_val'] }} and {{ $detail['ceil_val'] }}.
                                    </p>
                                    <p class="w-full mt-2">
                                        {{ $detail['list_floor_val'] }} and {{ $detail['list_ceil_val'] }} are the values that have been determined with reference to the organized data.
                                    </p>
                                    <p class="w-full mt-2">
                                        The value of {{ $detail['decile_pos'] }} - {{ $detail['floor_val'] }} = {{ $detail['floor_minus'] }} corresponds to the proportion of the distance between {{ $detail['list_floor_val'] }} and {{ $detail['list_ceil_val'] }} where the decile we are looking for is located.
                                    </p>
                                    <p class="w-full mt-3 text-[18px] text-center">
                                        \( D_{{ $decile }} = {{ $detail['list_floor_val'] }} + {{ $detail['floor_minus'] }} \times ({{ $detail['list_ceil_val'] }} - {{ $detail['list_floor_val'] }}) = {{ $detail['main_ans'] }} \)
                                    </p>
                                    <p class="w-full mt-4">
                                        This completes the calculation and we conclude that the {{ $decile }}{{ in_array($decile, [1, 2, 3]) ? ['1' => 'st', '2' => 'nd', '3' => 'rd'][$decile] : 'th' }} decile is equal to D<sub>{{ $decile }}</sub> = {{ $detail['main_ans'] }}.
                                    </p>
                                @else
                                    <p class="w-full mt-4">
                                        Since the position found is an integer, the {{ $decile }}{{ in_array($decile, [1, 2, 3]) ? ['1' => 'st', '2' => 'nd', '3' => 'rd'][$decile] : 'th' }} decile corresponds to the value in the position {{ $detail['decile_pos'] }} in the data organized in ascending order. Looking at the table, we find that the {{ $decile }}{{ in_array($decile, [1, 2, 3]) ? ['1' => 'st', '2' => 'nd', '3' => 'rd'][$decile] : 'th' }} decile is {{ $detail['main_ans'] }}.
                                    </p>
                                    <p class="w-full mt-2">
                                        This completes the calculation and we conclude that the {{ $decile }}{{ in_array($decile, [1, 2, 3]) ? ['1' => 'st', '2' => 'nd', '3' => 'rd'][$decile] : 'th' }} decile is equal to D<sub>{{ $decile }}</sub> = {{ $detail['main_ans'] }}.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    @endpush
</div>
