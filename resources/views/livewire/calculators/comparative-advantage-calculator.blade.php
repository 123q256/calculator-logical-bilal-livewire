<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <p class="text-lg font-bold border-b pb-2 text-blue-800">{{ $lang[3] ?? 'Entity X (e.g. Country A)' }}</p>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="first" class="label">{{ $lang['1'] ?? 'Product 1' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="first" id="first" class="input" aria-label="first" placeholder="35" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="second" class="label">{{ $lang['2'] ?? 'Product 2' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="second" id="second" class="input" aria-label="second" placeholder="15" />
                        </div>
                    </div>

                    <div class="col-span-12 mt-4">
                        <p class="text-lg font-bold border-b pb-2 text-blue-800">{{ $lang[4] ?? 'Entity Y (e.g. Country B)' }}</p>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="third" class="label">{{ $lang['1'] ?? 'Product 1' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="third" id="third" class="input" aria-label="third" placeholder="45" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="four" class="label">{{ $lang['2'] ?? 'Product 2' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="four" id="four" class="input" aria-label="four" placeholder="25" />
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
                    <div class="mt-5">
                        <div class="w-full mt-2 space-y-6">
                            <div class="bg-gray-50 p-6 rounded-lg border overflow-auto">
                                <h4 class="text-xl font-bold mb-4 text-blue-900">{{ $lang[3] ?? 'Opportunity Cost for Entity X' }}</h4>
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-3 border-b border-blue-200" width="70%">{{ $lang['5'] ?? 'Cost of Product 1 in terms of Product 2' }}</td>
                                        <td class="py-3 border-b border-blue-200 font-bold orange-text">{{ $detail['X_A'] + 0 }} {{ $lang[10] ?? 'units' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3" width="70%">{{ $lang['6'] ?? 'Cost of Product 2 in terms of Product 1' }}</td>
                                        <td class="py-3 font-bold orange-text">{{ $detail['X_B'] + 0 }} {{ $lang[9] ?? 'units' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="bg-gray-50 p-6 rounded-lg border overflow-auto">
                                <h4 class="text-xl font-bold mb-4 text-green-900">{{ $lang[4] ?? 'Opportunity Cost for Entity Y' }}</h4>
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-3 border-b border-green-200" width="70%">{{ $lang['5'] ?? 'Cost of Product 1 in terms of Product 2' }}</td>
                                        <td class="py-3 border-b border-green-200 font-bold orange-text">{{ $detail['Y_A'] + 0 }} {{ $lang[10] ?? 'units' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3" width="70%">{{ $lang['6'] ?? 'Cost of Product 2 in terms of Product 1' }}</td>
                                        <td class="py-3 font-bold orange-text">{{ $detail['Y_B'] + 0 }} {{ $lang[9] ?? 'units' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="w-full text-[16px] mt-5 ">
                            <p class="font-bold text-lg text-blue-600 border-b pb-2 mb-4">{{ $lang[8] ?? 'Calculation Breakdown' }}:</p>
                            <div class="space-y-6">
                                <div class="bg-gray-50 p-4 rounded-lg border">
                                    <h5 class="font-bold mb-2">{{ $lang[3] ?? 'Entity X Analysis' }}:</h5>
                                    <ul class="space-y-3 list-none pl-4 border-l-4 border-blue-200">
                                        <li>{{ $lang[7] ?? 'Formula' }}: Product 1 / Product 2 = {{ $first + 0 }} / {{ $second + 0 }} = <strong>{{ $detail['X_B'] + 0 }}</strong></li>
                                        <li>{{ $lang[7] ?? 'Formula' }}: Product 2 / Product 1 = {{ $second + 0 }} / {{ $first + 0 }} = <strong>{{ $detail['X_A'] + 0 }}</strong></li>
                                    </ul>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border">
                                    <h5 class="font-bold mb-2">{{ $lang[4] ?? 'Entity Y Analysis' }}:</h5>
                                    <ul class="space-y-3 list-none pl-4 border-l-4 border-green-200">
                                        <li>{{ $lang[7] ?? 'Formula' }}: Product 1 / Product 2 = {{ $third + 0 }} / {{ $four + 0 }} = <strong>{{ $detail['Y_B'] + 0 }}</strong></li>
                                        <li>{{ $lang[7] ?? 'Formula' }}: Product 2 / Product 1 = {{ $four + 0 }} / {{ $third + 0 }} = <strong>{{ $detail['Y_A'] + 0 }}</strong></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
