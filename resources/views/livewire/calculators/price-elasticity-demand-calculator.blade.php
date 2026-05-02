<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                {{-- Mode Selector (Tag Style) --}}
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 py-1 mb-6">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="setUnitType('Price Elasticity')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $unit_type == 'Price Elasticity' ? 'tagsUnit' : '' }}">
                            {{ $lang['pe'] ?? 'Price Elasticity' }}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="setUnitType('Revenue')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $unit_type == 'Revenue' ? 'tagsUnit' : '' }}">
                            {{ $lang['revenue'] ?? 'Revenue' }}
                        </div>
                    </div>
                </div>

                @if ($unit_type == 'Price Elasticity')
                    <div class="space-y-6">
                        {{-- Method Selector --}}
                        <div class="space-y-2">
                            <label for="method" class="font-s-14 text-blue">{{ $lang['met'] ?? 'Method' }}:</label>
                            <select wire:model.live="method" id="method" class="input">
                                <option value="1">{{ $lang['m1'] ?? 'Midpoint Method' }}</option>
                                <option value="2">{{ $lang['m2'] ?? 'Point Method' }}</option>
                                <option value="3">{{ $lang['m3'] ?? '% Change Method' }}</option>
                            </select>
                        </div>

                        @if ($method == '1' || $method == '2')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2 relative">
                                    <label for="i_p" class="font-s-14 text-blue">{{ $lang['i_p'] ?? 'Initial Price' }}</label>
                                    <div class="relative">
                                        <input type="number" step="any" wire:model.live="i_p" id="i_p" class="input">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div class="space-y-2 relative">
                                    <label for="n_p" class="font-s-14 text-blue">{{ $lang['n_p'] ?? 'New Price' }}</label>
                                    <div class="relative">
                                        <input type="number" step="any" wire:model.live="n_p" id="n_p" class="input">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="i_q" class="font-s-14 text-blue">{{ $lang['i_q'] ?? 'Initial Quantity' }}</label>
                                    <input type="number" step="any" wire:model.live="i_q" id="i_q" class="input">
                                </div>
                                <div class="space-y-2">
                                    <label for="n_q" class="font-s-14 text-blue">{{ $lang['n_q'] ?? 'New Quantity' }}</label>
                                    <input type="number" step="any" wire:model.live="n_q" id="n_q" class="input">
                                </div>
                            </div>
                        @elseif ($method == '3')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2 relative">
                                    <label for="quantity" class="font-s-14 text-blue">{{ $lang['q_ch'] ?? '% Change in Quantity' }}:</label>
                                    <div class="relative">
                                        <input type="number" step="any" wire:model.live="quantity" id="quantity" class="input">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">%</span>
                                    </div>
                                </div>
                                <div class="space-y-2 relative">
                                    <label for="prince" class="font-s-14 text-blue">{{ $lang['p_h'] ?? '% Change in Price' }}:</label>
                                    <div class="relative">
                                        <input type="number" step="any" wire:model.live="prince" id="prince" class="input">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">%</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                @if ($unit_type == 'Revenue')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2 relative">
                            <label for="i_r" class="font-s-14 text-blue">{{ $lang['i_p'] ?? 'Initial Price' }}</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="i_r" id="i_r" class="input">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">{{ $currancy }}</span>
                            </div>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="f_r" class="font-s-14 text-blue">{{ $lang['n_p'] ?? 'New Price' }}</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="f_r" id="f_r" class="input">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">{{ $currancy }}</span>
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
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full text-[16px]">
                        @if(!isset($detail['rev']))
                            <p class="col py-3 border-b">{{ $lang['ans']}}  = <strong>{{ $detail['PED']}}</strong></p>
                            <p class="col py-3 border-b">{{ $lang['ans_type']}}  = <strong>{{ $detail['type']}}</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  my-2">
                                <img src="{{ asset('images/' . $detail['type'] . '.png') }}" alt="{{ $detail['type'] }} Image" width="250px" height="100%" loading="lazy" decoding="async">
                            </div>
                            <p class="col py-3 border-b">{{ $lang['sum']}} <span>{{ $lang['aone']}} {{ $detail['PED']}}% {{ $lang['bcz']}}</span></p>
                        @endif
                        @if(isset($_POST['method'])=='1' || isset($_POST['method'])=='2' || isset($detail['rev']))
                                <table class="w-full">
                                <tbody>
                                    <tr>
                                    <td class="py-3 border-b" width="50%">{{ $lang['i_r'] }}</td>
                                    <td class="py-3 border-b"> = {{ (isset($detail['i_r']) ? $detail['i_r'] . $currancy : '00 ' . $currancy) }}
                                    </td>
                                    </tr>
                                    <tr>
                                    <td class="py-3 border-b" width="50%">{{ $lang['f_r'] }}</td>
                                    <td class="py-3 border-b"> = {{ ((isset($detail['f_r']))?$detail['f_r'].$currancy:'00 ' . $currancy) }}</td>
                                    </tr>
                                    <tr>
                                    <td class="py-3 border-b" width="50%">{{ $lang['i_rev'] }}</td>
                                    <td class="py-3 border-b"> =  {{ ((isset($detail['r_percent']))?$detail['r_percent'].'% ':'00 %') }}</td>
                                    </tr>
                                </tbody>
                                </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endisset
    </form>
</div>
