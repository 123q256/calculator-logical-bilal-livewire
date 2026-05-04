 <div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 mt-3 gap-4">
                    <div class="col-12 px-2">
                        <label for="for" class="font-s-14 text-blue">{{ $lang['for'] }}:</label>
                        <select wire:model.live="for" id="for" class="input my-2">
                            <option value="share">{{ $lang['share'] }}</option>
                            <option value="single">{{ $lang['single'] }}</option>
                        </select>
                    </div>
                </div>

                @if ($for === 'share')
                    <div class="share row">
                        <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-4">
                            <div class="col-lg-6 col-12 px-2 pe-lg-4">
                                <label for="x" class="font-s-14 text-blue">{{ $lang['x'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="text" wire:model.live="x" id="x" class="input" aria-label="input" placeholder="{{ $lang['x'] }}" />
                                    <span class="text-blue input_unit">{{ $currancy }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 px-2 ps-lg-4 tip">
                                <label for="y" class="font-s-14 text-blue">{{ $lang['y'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="text" wire:model.live="y" id="y" class="input" aria-label="input" placeholder="{{ $lang['y'] }}" />
                                    <span class="text-blue input_unit">%</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 px-2 pe-lg-4 ppl">
                                <label for="z" class="font-s-14 text-blue">{{ $lang['z'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="text" wire:model.live="z" id="z" class="input" aria-label="input" placeholder="{{ $lang['z'] }}" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 px-2 ps-lg-4">
                                <label for="round" class="font-s-14 text-blue">{{ $lang['round'] }} {{ $currancy }}:</label>
                                <select wire:model.live="round" id="round" class="input my-2">
                                    <option value="yes">{{ $lang['yes'] }}</option>
                                    <option value="no">{{ $lang['no'] }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="single row">
                        <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-4">
                            <div class="col-lg-6 col-12 px-2 pe-lg-4">
                                <label for="xs" class="font-s-14 text-blue">{{ $lang['x'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="text" wire:model.live="xs" id="xs" class="input" aria-label="input" />
                                    <span class="text-blue input_unit">{{ $currancy }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 px-2 ps-lg-4">
                                <label for="rounds" class="font-s-14 text-blue">{{ $lang['round'] }} {{ $currancy }}:</label>
                                <select wire:model.live="rounds" id="rounds" class="input my-2">
                                    <option value="yes">{{ $lang['yes'] }}</option>
                                    <option value="no">{{ $lang['no'] }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                @endif
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
                            <div class="w-full">
                                <div class="w-full md:w-[80%] lg:w-[80%] text-[18px] overflow-auto">
                                    @if ($for === 'single')
                                        <table class="w-full text-center">
                                            <tbody>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['y'] }}</strong></td>
                                                    <td class="border-b py-2"><strong>{{ $lang['a'] }}</strong></td>
                                                    <td class="border-b py-2"><strong>{{ $lang['b'] }}</strong></td>
                                                </tr>
                                                @foreach ([5, 10, 12, 14, 15, 18, 20, 25, 30, 50] as $percent)
                                                    <tr>
                                                        <td class="border-b py-2">
                                                            <p>{{ $percent }}%</p>
                                                        </td>
                                                        <td class="border-b py-2">
                                                            @php
                                                                $tipAmount = $xs * ($percent / 100);
                                                                $displayTip = ($rounds == 'yes') ? round($tipAmount) : round($tipAmount, 2);
                                                            @endphp
                                                            {{ $displayTip }} {{ $currancy }}
                                                        </td>
                                                        <td class="border-b py-2">
                                                            @php
                                                                $totalAmount = $tipAmount + $xs;
                                                                $displayTotal = ($rounds == 'yes') ? round($totalAmount) : round($totalAmount, 2);
                                                            @endphp
                                                            {{ $displayTotal }} {{ $currancy }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <table class="w-full">
                                            <tbody>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <p><strong>{{ $lang['a'] }} :<strong></p>
                                                    </td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ $detail['a'] ?? '0.0' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <p><strong>{{ $lang['b'] }} :<strong></p>
                                                    </td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ $detail['b'] ?? '0.0' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <p><strong>{{ $lang['c'] }} :<strong></p>
                                                    </td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ $detail['c'] ?? '0.0' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <p><strong>{{ $lang['d'] }} :<strong></p>
                                                    </td>
                                                    <td class="border-b py-2">{{ $currancy }} {{ $detail['d'] ?? '0.0' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
