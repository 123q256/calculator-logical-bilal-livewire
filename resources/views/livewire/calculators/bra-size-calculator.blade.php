<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="w-full lg:w-7/12 mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-5">
                    {{-- Bust --}}
                    <div class="px-2">
                        <label for="bust" class="label">{{ $lang['1'] ?? 'Bust Measurement' }}:</label>
                        <div class="relative w-full py-2" x-data="{ open: false }">
                            <input type="number" wire:model.live="bust" id="bust" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-[#3E9960] w-full" placeholder="00" required />
                            <div class="absolute right-3 top-5 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none">
                                    {{ $bust_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('bust_unit', 'in'); open = false">inches (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('bust_unit', 'cm'); open = false">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Band --}}
                    <div class="px-2">
                        <label for="band" class="label">{{ $lang['2'] ?? 'Band Measurement' }}:</label>
                        <div class="relative w-full py-2" x-data="{ open: false }">
                            <input type="number" wire:model.live="band" id="band" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-[#3E9960] w-full" placeholder="00" required />
                            <div class="absolute right-3 top-5 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none">
                                    {{ $band_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('band_unit', 'in'); open = false">inches (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('band_unit', 'cm'); open = false">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @if ($detail)
        <hr class="my-6">
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full p-3 rounded-lg mt-3 result">
                        <div class="w-full mt-2">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr>
                                        <th class="text-[#2845F5] text-left border-b py-3">{{ $lang['3'] }}</th>
                                        <th class="text-[#2845F5] text-left border-b py-3">{{ $lang['4'] }}</th>
                                        <th class="text-[#2845F5] text-left border-b py-3">{{ $lang['5'] }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-b py-3"><strong>US/CA</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['band'] }}</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['ans'][0] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3"><strong>UK</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['band'] }}</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['ans'][2] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3"><strong>US/CA ({{ $lang['6'] }} +4)</strong></td>
                                        <td class="border-b py-3"><strong>{{ (is_numeric($detail['band']) ? (int)$detail['band'] + 4 : $detail['band']) }}</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['ans'][0] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3"><strong>UK ({{ $lang['6'] }} +4)</strong></td>
                                        <td class="border-b py-3"><strong>{{ (is_numeric($detail['band']) ? (int)$detail['band'] + 4 : $detail['band']) }}</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['ans'][2] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3"><strong>EU</strong></td>
                                        <td class="border-b py-3"><strong>{{ (is_numeric($detail['eu']) ? $detail['eu'].' cm' : $detail['eu']) }}</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['ans'][3] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3"><strong>FR/ES/BE</strong></td>
                                        <td class="border-b py-3"><strong>{{ (is_numeric($detail['fr']) ? $detail['fr'].' cm' : $detail['fr']) }}</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['ans'][4] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-3"><strong>Australia/New Zealand</strong></td>
                                        <td class="py-3"><strong>{{ (is_numeric($detail['aus']) ? 'dress code '.$detail['aus'] : $detail['aus']) }}</strong></td>
                                        <td class="py-3"><strong>{{ $detail['ans'][1] }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
