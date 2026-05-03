<div>
    <style>
        img { object-fit: contain; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto" x-data="{ compare: @entangle('checkbox') }">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Comparison Toggle --}}
                    <div class="col-span-12">
                        <div class="w-100 py-2">
                            <label for="checkbox" class="font-s-17 text-blue flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" wire:model.live="checkbox" id="checkbox" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" />
                                <strong>{{ $lang['comp'] ?? 'Compare two campaigns' }}:</strong>
                            </label>
                        </div>
                    </div>

                    {{-- Single Mode --}}
                    <div class="col-span-12" x-show="!compare">
                        <div class="grid grid-cols-12 mt-3 gap-4">
                            <div class="col-span-6 md:col-span-4">
                                <label for="method" class="font-s-14 text-blue">{{ $lang['t_cal'] ?? 'To Calculate' }}</label>
                                <select wire:model.live="method" id="method" class="input mt-2">
                                    <option value="cpm">{{ $lang['cpm'] ?? 'CPM' }}</option>
                                    <option value="im">{{ $lang['im'] ?? 'Impressions' }}</option>
                                    <option value="tc">{{ $lang['tc'] ?? 'Total Cost' }}</option>
                                </select>
                            </div>
                            <div class="col-span-6 md:col-span-4">
                                <label for="x" class="font-s-14 text-blue">
                                    @if($method == 'cpm') {{ $lang['im'] ?? 'Impressions' }}
                                    @else {{ $lang['cpm'] ?? 'CPM' }} @endif
                                </label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" wire:model.live="x" id="x" class="input" placeholder="00" />
                                </div>
                            </div>
                            <div class="col-span-6 md:col-span-4">
                                <label for="y" class="font-s-14 text-blue">
                                    @if($method == 'tc') {{ $lang['im'] ?? 'Impressions' }}
                                    @else {{ $lang['tc'] ?? 'Total Cost' }} @endif
                                </label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" wire:model.live="y" id="y" class="input" placeholder="00" />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Comparison Mode --}}
                    <div class="col-span-12" x-show="compare" x-cloak>
                        <div class="grid grid-cols-12 mt-3 gap-4">
                            <p class="col-span-12 font-bold text-blue">{{ $lang['first'] ?? 'Campaign 1' }}</p>
                            <div class="col-span-6 md:col-span-4">
                                <label for="methodf" class="font-s-14 text-blue">{{ $lang['t_cal'] ?? 'To Calculate' }}:</label>
                                <select wire:model.live="methodf" id="methodf" class="input mt-2">
                                    <option value="cpm">{{ $lang['cpm'] ?? 'CPM' }}</option>
                                    <option value="im">{{ $lang['im'] ?? 'Impressions' }}</option>
                                    <option value="tc">{{ $lang['tc'] ?? 'Total Cost' }}</option>
                                </select>
                            </div>
                            <div class="col-span-6 md:col-span-4">
                                <label for="xf" class="font-s-14 text-blue">
                                    @if($methodf == 'cpm') {{ $lang['im'] ?? 'Impressions' }}
                                    @else {{ $lang['cpm'] ?? 'CPM' }} @endif
                                </label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" wire:model.live="xf" id="xf" class="input" placeholder="00" />
                                </div>
                            </div>
                            <div class="col-span-6 md:col-span-4">
                                <label for="yf" class="font-s-14 text-blue">
                                    @if($methodf == 'tc') {{ $lang['im'] ?? 'Impressions' }}
                                    @else {{ $lang['tc'] ?? 'Total Cost' }} @endif
                                </label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" wire:model.live="yf" id="yf" class="input" placeholder="00" />
                                </div>
                            </div>

                            <p class="col-span-12 font-bold text-blue mt-4">{{ $lang['second'] ?? 'Campaign 2' }}</p>
                            <div class="col-span-6 md:col-span-4">
                                <label for="methods" class="font-s-14 text-blue">{{ $lang['t_cal'] ?? 'To Calculate' }}:</label>
                                <select wire:model.live="methods" id="methods" class="input mt-2">
                                    <option value="cpm">{{ $lang['cpm'] ?? 'CPM' }}</option>
                                    <option value="im">{{ $lang['im'] ?? 'Impressions' }}</option>
                                    <option value="tc">{{ $lang['tc'] ?? 'Total Cost' }}</option>
                                </select>
                            </div>
                            <div class="col-span-6 md:col-span-4">
                                <label for="xs" class="font-s-14 text-blue">
                                    @if($methods == 'cpm') {{ $lang['im'] ?? 'Impressions' }}
                                    @else {{ $lang['cpm'] ?? 'CPM' }} @endif
                                </label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" wire:model.live="xs" id="xs" class="input" placeholder="00" />
                                </div>
                            </div>
                            <div class="col-span-6 md:col-span-4">
                                <label for="ys" class="font-s-14 text-blue">
                                    @if($methods == 'tc') {{ $lang['im'] ?? 'Impressions' }}
                                    @else {{ $lang['tc'] ?? 'Total Cost' }} @endif
                                </label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" wire:model.live="ys" id="ys" class="input" placeholder="00" />
                                </div>
                            </div>
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
                            @if ($checkbox)
                                <div class="w-full lg:w-[80%] mt-2 space-y-4">
                                    {{-- First Campaign --}}
                                    <div>
                                        <p class="font-bold text-[18px] mb-1">{{ $lang['first'] ?? 'First Campaign' }}</p>
                                        <div class="flex justify-between border-b py-2">
                                            <span class="text-gray-700 font-medium">
                                                {{ $methodf == 'cpm' ? ($lang['cpm'] ?? 'CPM') : ($methodf == 'im' ? ($lang['im'] ?? 'Impressions') : ($lang['tc'] ?? 'Total Cost')) }}
                                            </span>
                                            <span class="font-bold">{{ $detail['ansf'] ?? '0.0' }}</span>
                                        </div>
                                    </div>

                                    {{-- Second Campaign --}}
                                    <div>
                                        <p class="font-bold text-[18px] mb-1">{{ $lang['second'] ?? 'Second Campaign' }}</p>
                                        <div class="flex justify-between border-b py-2">
                                            <span class="text-gray-700 font-medium">
                                                {{ $methods == 'cpm' ? ($lang['cpm'] ?? 'CPM') : ($methods == 'im' ? ($lang['im'] ?? 'Impressions') : ($lang['tc'] ?? 'Total Cost')) }}
                                            </span>
                                            <span class="font-bold">{{ $detail['anss'] ?? '0.0' }}</span>
                                        </div>
                                    </div>

                                    {{-- Summary --}}
                                    <div class="pt-2">
                                        <p class="font-bold text-[18px] border-b pb-2">
                                            @if ($detail['cpmf'] < $detail['cpms'])
                                                {{ $lang['camp1_better'] ?? 'Campaign 1 is less expensive.' }}
                                            @elseif($detail['cpmf'] > $detail['cpms'])
                                                {{ $lang['camp2_better'] ?? 'Campaign 2 is less expensive.' }}
                                            @else
                                                {{ $lang['camp_equal'] ?? 'The campaigns cost is the same.' }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 text-center text-[20px]">
                                    <p class="font-semibold text-gray-600">
                                        {{ $method == 'cpm' ? ($lang['cpm'] ?? 'CPM') : ($method == 'im' ? ($lang['im'] ?? 'Impressions') : ($lang['tc'] ?? 'Total Cost')) }}
                                    </p>
                                    <p class="mt-3">
                                        <strong class="text-white bg-[#2845F5] px-6 py-3 rounded-xl text-[36px] shadow-lg inline-block">
                                            {{ $detail['ans'] ?? '0.0' }}
                                        </strong>
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
