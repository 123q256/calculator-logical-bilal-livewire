<div>
    <style>
        .text-green-700 { color: #15803d; }
        .font-s-20 { font-size: 20px; }
        .font-s-28 { font-size: 28px; }
        .bg-result { background-color: #F6FAFC; border: 1px solid #c1b8b899; }
        [x-cloak] { display: none !important; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3" x-data="{ calcType: '{{ $calc_type }}' }">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">

                    <!-- Mode Selection (Radio) -->
                    <div class="col-span-12 flex items-center space-x-6">
                        <span class="font-bold">{{ $lang[1] }}:</span>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" value="frst" wire:model.live="calc_type" @click="calcType = 'frst'" class="w-4 h-4 text-blue-600">
                            <span class="ml-2">{{ $lang[2] }}</span>
                        </label>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" value="scnd" wire:model.live="calc_type" @click="calcType = 'scnd'" class="w-4 h-4 text-blue-600">
                            <span class="ml-2">{{ $lang[3] }}</span>
                        </label>
                    </div>

                    <!-- Calculator Mode Inputs -->
                    <div class="col-span-12 mt-4" x-show="calcType == 'frst'" style="{{ $calc_type == 'frst' ? '' : 'display: none;' }}">
                        <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-12 md:col-span-6">
                                <label class="label">{!! $lang['4'] !!}:</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" wire:model.live="first" class="input" placeholder="00">
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <label class="label">{!! $lang['5'] !!}:</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" wire:model.live="second" class="input" placeholder="00">
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <label class="label">{!! $lang['6'] !!}:</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" wire:model.live="third" class="input" placeholder="00">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Converter Mode Inputs -->
                    <div class="col-span-12 mt-4" x-show="calcType == 'scnd'" style="{{ $calc_type == 'scnd' ? '' : 'display: none;' }}">
                        <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-12">
                                <label class="label">{!! $lang['7'] !!}:</label>
                                <div class="w-full py-2 relative">
                                    <select wire:model.live="operations" class="input">
                                        <option value="1">{{ $lang['8'] }}</option>
                                        <option value="2">{{ $lang['9'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12">
                                <label class="label">
                                    {{ $operations == '1' ? $lang['10'] : $lang['18'] }}:
                                </label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" wire:model.live="four" class="input" placeholder="00">
                                    @if($operations == '1')
                                        <span class="input_unit">%</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(isset($lang['after_title']))
                        <div class="col-span-12">
                            <p class="text-sm text-gray-500 italic px-1">{!! $lang['after_title'] !!}</p>
                        </div>
                    @endif
                </div>
            </div>

                @if ($type == 'calculator')
                    @include('inc.button')
                @endif
                @if ($type == 'widget')
                    @include('inc.widget-button')
                @endif
            </div>
    </form>

    <!-- Result Section -->
    @isset($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-4 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg">
                    <div class="w-full mt-3 space-y-4">
                        
                        <!-- Converter Result Logic -->
                        @if ($calc_type == "scnd")
                            <div class="bg-result rounded-lg px-6 py-4">
                                @if ($operations == 1)
                                    <p class="text-lg">
                                        <span class="text-green-700 font-s-28 font-bold">{{ $four }}</span>% = 
                                        1 in <strong class="font-s-20 text-blue-600">{{ round($detail['f_ans'], 4) }}</strong> {{ $lang[12] }}
                                    </p>
                                @else
                                    <p class="text-lg">
                                        <span class="text-green-700 font-s-28 font-bold">{{ round($detail['f_ans'], 4) }}</span>% = 
                                        1 in <strong class="text-blue-600">{{ $four }}</strong> {{ $lang[12] }}
                                    </p>
                                @endif
                            </div>
                        @endif

                        <!-- Common Frequencies -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-result rounded-lg px-6 py-4 flex justify-between items-center">
                                <span class="font-bold">{{ $lang[13] }} (p)</span>
                                <span class="text-green-700 font-s-28 font-bold">{{ round($detail['pfreq'], 4) }}%</span>
                            </div>
                            <div class="bg-result rounded-lg px-6 py-4 flex justify-between items-center">
                                <span class="font-bold">{{ $lang[14] }} (q)</span>
                                <span class="text-green-700 font-s-28 font-bold">{{ round($detail['qfreq'], 4) }}%</span>
                            </div>
                        </div>

                        <!-- Genotype Breakdown -->
                        <div class="bg-white overflow-hidden mt-6">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 font-bold">{{ $lang[9] }}</th>
                                        <th class="px-6 py-3 font-bold">Formula / Frequency</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr>
                                        <td class="px-6 py-4">{{ $lang[15] }}</td>
                                        <td class="px-6 py-4 font-bold">p² = <span class="text-green-700">{{ round($detail['p_square'], 4) }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4">{{ $lang[16] }}</td>
                                        <td class="px-6 py-4 font-bold">2pq = <span class="text-green-700">{{ round($detail['p_q'], 4) }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4">{{ $lang[17] }}</td>
                                        <td class="px-6 py-4 font-bold">q² = <span class="text-green-700">{{ round($detail['q_square'], 4) }}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
