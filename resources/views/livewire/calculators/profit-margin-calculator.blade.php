<div>
    <style>
        .input_unit {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #2845F5;
            font-weight: 600;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="method" class="font-s-14 text-blue">{{ $lang['chose'] ?? 'Choose' }}:</label>
                        <select wire:model.live="method" id="method" class="input mt-2">
                            <option value="Gross">{{ $lang['g_m'] ?? 'Gross Margin' }}</option>
                            <option value="Net">{{ $lang['n_p_m'] ?? 'Net Profit Margin' }}</option>
                            <option value="Operating">{{ $lang['o_p_m'] ?? 'Operating Profit Margin' }}</option>
                        </select>
                    </div>

                    @php
                        $labelX = '';
                        $labelY = '';
                        if ($method == 'Gross') {
                            $labelX = $lang['cost'] ?? 'Cost';
                            $labelY = $lang['rev'] ?? 'Revenue';
                        } elseif ($method == 'Net') {
                            $labelX = $lang['total_s'] ?? 'Total Sales';
                            $labelY = $lang['net_profit'] ?? 'Net Profit';
                        } else {
                            $labelX = $lang['o_i'] ?? 'Operating Income';
                            $labelY = $lang['s_r'] ?? 'Sales Revenue';
                        }
                    @endphp

                    <div class="space-y-2 relative">
                        <label for="x" class="font-s-14 text-blue">{{ $labelX }}</label>
                        <input type="number" step="any" wire:model.live="x" id="x" class="input" placeholder="50">
                        <span class="input_unit">{{ $currancy }}</span>
                    </div>

                    <div class="space-y-2 relative">
                        <label for="y" class="font-s-14 text-blue">{{ $labelY }}</label>
                        <input type="number" step="any" wire:model.live="y" id="y" class="input" placeholder="50">
                        <span class="input_unit">{{ $currancy }}</span>
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
            {{-- result --}}
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full bg-light-blue  rounded-lg mt-6">
                    <div class="lg:w-[80%] w-full overflow-auto mt-4">
                        <table class="w-full text-lg">
                            <tr>
                                <td class="py-2 border-b w-7/10 font-bold">{{ $lang['margin'] }}</td>
                                <td class="py-2 border-b">
                                    @if(isset($detail['margin']))
                                    {{$detail['margin']}}
                                    @else
                                    0.0 %
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-7/10 font-bold">{{ $lang['profit'] }}</td>
                                <td class="py-2 border-b">
                                    @if(isset($detail['profit']))
                                    {{$detail['profit']}}
                                    @else
                                    {{$currancy}} 0.0
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-7/10 font-bold">{{ $lang['mark'] }}</td>
                                <td class="py-2 border-b">
                                    @if(isset($detail['mark']))
                                    {{$detail['mark']}}
                                    @else
                                    0.0 %
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-7/10 font-bold">{{ $lang['o_margin'] }}</td>
                                <td class="py-2 border-b">
                                    @if(isset($detail['operating']))
                                    {{ $detail['operating'] }}
                                    @else
                                    0.0 %
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            </div>
        @endisset
    </form>
</div>
