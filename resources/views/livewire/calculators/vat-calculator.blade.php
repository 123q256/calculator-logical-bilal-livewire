<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Calculation Method --}}
                    <div class="space-y-2">
                        <label for="method" class="font-s-14 text-blue">{{ $lang['t_cal'] ?? 'To Calculate' }}:</label>
                        <select wire:model.live="method" id="method" class="input">
                            <option value="add">{{ $lang['add'] ?? 'Add VAT' }}</option>
                            <option value="remove">{{ $lang['remove'] ?? 'Remove VAT' }}</option>
                        </select>
                    </div>

                    {{-- Amount --}}
                    <div class="space-y-2 relative">
                        <label for="amount" class="font-s-14 text-blue">
                            {{ $method === 'add' ? ($lang['net_price'] ?? 'Net Price') : ($lang['gross_price'] ?? 'Gross Price') }}
                        </label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="amount" id="amount" class="input" placeholder="00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">{{ $currancy }}</span>
                        </div>
                    </div>

                    {{-- VAT Rate --}}
                    <div class="space-y-2 relative">
                        <label for="vat" class="font-s-14 text-blue">{{ $lang['rate'] ?? 'VAT Rate' }} %</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="vat" id="vat" class="input" placeholder="00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">%</span>
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
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue  rounded-lg mt-6">
                        <div class="lg:w-[80%] w-full overflow-auto mt-4">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b w-7/10 font-bold">Your Value-Added Tax (VAT)</td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ $detail['vatAmount'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-7/10 font-bold">{{ $lang['net_price'] }}</td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ $detail['net'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-7/10 font-bold">{{ $lang['gross_price'] }}</td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ $detail['gross'] }}</td>
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
