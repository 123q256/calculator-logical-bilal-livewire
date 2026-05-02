<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2 relative">
                        <label for="x" class="font-s-14 text-blue">{{ $lang['x'] ?? 'Total Amount' }}</label>
                        <input type="number" step="any" wire:model.live="x" id="x" class="input" placeholder="00">
                        <span class="text-blue input_unit absolute right-4 top-[70%] -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                    </div>

                    <div class="space-y-2">
                        <label for="rate" class="font-s-14 text-blue">{{ $lang['1'] ?? 'PayPal Fee Rate' }}:</label>
                        <select wire:model.live="rate" id="rate" class="input mt-2">
                            <optgroup label="{{ $lang['dom'] ?? 'Domestic' }}">
                                <option value="0">2.9% + $.30 ({{ $lang['online'] ?? 'Online' }})</option>
                                <option value="1">2.7% + $.30 ({{ $lang['store'] ?? 'In-Store' }})</option>
                                <option value="2">2.2% + $.30 ({{ $lang['non'] ?? 'Non-Profit' }})</option>
                                <option value="3">5% + $.05 ({{ $lang['micro'] ?? 'Micropayments' }})</option>
                            </optgroup>
                            <optgroup label="{{ $lang['inter'] ?? 'International' }}">
                                <option value="4">4.4% + $.30 ({{ $lang['online'] ?? 'Online' }})</option>
                                <option value="5">4.2% + $.30 ({{ $lang['store'] ?? 'In-Store' }})</option>
                                <option value="6">3.7% + $.30 ({{ $lang['non'] ?? 'Non-Profit' }})</option>
                                <option value="7">6.5% + $.05 ({{ $lang['micro'] ?? 'Micropayments' }})</option>
                            </optgroup>
                            <optgroup label="{{ $lang['mob'] ?? 'Mobile' }}">
                                <option value="8">2.7% ({{ $lang['swip'] ?? 'Swiped' }})</option>
                                <option value="9">3.5% + $.15 ({{ $lang['key'] ?? 'Keyed' }})</option>
                            </optgroup>
                            <optgroup label="{{ $lang['vir'] ?? 'Virtual Terminal' }}">
                                <option value="10">3.1% + $.30</option>
                            </optgroup>
                        </select>
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
                        <div class="w-full bg-light-blue rounded-lg mt-6">
                            <div class="lg:w-[80%] w-full overflow-auto mt-4">
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 w-3/4"><strong>{{ $lang['want'] ?? 'If you want to receive' }} {{ $x }} {{ $currancy }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-3/4"><strong>{{ $lang['ask_for'] ?? 'You should ask for' }}</strong></td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ $detail['send'] ?? '0.00' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-3/4"><strong>{{ $lang['s_fee'] ?? 'PayPal Fees' }}</strong></td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ $detail['fee1'] ?? '0.00' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="lg:w-[80%] w-full overflow-auto mt-4">
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 w-3/4"><strong>{{ $lang['ask'] ?? 'If you receive' }} {{ $x }} {{ $currancy }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-3/4"><strong>{{ $lang['get'] ?? 'You will get' }}</strong></td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ $detail['receive'] ?? '0.00' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-3/4"><strong>{{ $lang['s_fee'] ?? 'PayPal Fees' }}</strong></td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ $detail['fee'] ?? '0.00' }}</td>
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
