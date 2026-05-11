<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    {{-- Condition --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="selection" class="label">{{ $lang['1'] ?? 'Reason for melatonin' }}:</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="selection" id="selection" class="input">
                                <option value="1">{!! $lang['2'] !!}</option>
                                <option value="2">{!! $lang['3'] !!}</option>
                                <option value="3">{!! $lang['4'] !!}</option>
                                <option value="4">{!! $lang['5'] !!}</option>
                                <option value="5">{!! $lang['6'] !!}</option>
                                <option value="6">{!! $lang['7'] !!}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Form --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="selection3" class="label">{!! $lang['8'] ?? 'Melatonin form' !!}:</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="selection3" id="selection3" class="input">
                                <option value="1">{!! $lang['9'] !!}</option>
                                <option value="2">{!! $lang['10'] !!}</option>
                                <option value="3">{!! $lang['11'] !!}</option>
                                <option value="4">{!! $lang['12'] !!}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Duration --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="charge" class="label">{{ $lang['13'] ?? 'Treatment duration' }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="charge" id="charge" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" required />
                            <div class="absolute right-3 top-2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer focus:outline-none py-2">
                                    @php
                                        $unit_labels = ['1' => $lang['14'], '2' => $lang['15'], '3' => $lang['16'], '4' => $lang['17']];
                                    @endphp
                                    {{ $unit_labels[$d_unit] ?? $lang['14'] }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('d_unit', '1'); open = false">{{ $lang['14'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('d_unit', '2'); open = false">{{ $lang['15'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('d_unit', '3'); open = false">{{ $lang['16'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('d_unit', '4'); open = false">{{ $lang['17'] }}</p>
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
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-5">
                        <div class="w-full">
                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                {{ $lang['18'] ?? 'Recommended daily dose' }} = <strong class="text-[#119154] text-[25px]">{{ $detail['answer1'] }}</strong> mg {{ $lang['19'] ?? 'of melatonin' }}
                            </div>
                            <div class="bg-[#F6FAFC] border rounded-lg p-3 mt-2" style="border: 1px solid #c1b8b899;">
                                {{ $lang['20'] ?? 'Recommended time' }} = <strong class="text-[#119154] text-[20px]">{{ $detail['answer2'] }}</strong>
                            </div>
                            <p class="mt-4 text-gray-700">{{ $lang['21'] ?? 'Amount needed for treatment' }}:</p>
                            <p class="mt-1 font-medium">{{ $detail['answer3'] }} <strong class="text-[#119154] text-[18px]">{{ $detail['answer4'] }} {{ $detail['days'] ?? '' }}{{ $detail['weeks'] ?? '' }}{{ $detail['months'] ?? '' }}{{ $detail['years'] ?? '' }}</strong>-{{ $lang['22'] ?? 'treatment' }}:</p>
                            
                            <div class="w-full md:w-[70%] lg:w-[70%] overflow-auto mt-4">
                                <table class="w-full" cellspacing="0">
                                    @if(isset($detail['ans1']))
                                        <tr>
                                            <td class="border-b py-3">
                                                <div class="flex items-center space-x-2">
                                                    <span class="font-bold">{{ $detail['ans1'] }}</span>
                                                    <span>{{ $detail['ans1_first'] ?? '' }} {{ $detail['tablets'] ?? '' }}{{ $detail['tablet'] ?? '' }}{{ $detail['ml'] ?? '' }}{{ $detail['applications'] ?? '' }}{{ $detail['strips'] ?? '' }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @if(isset($detail['ans2']))
                                        <tr>
                                            <td class="border-b py-3">
                                                <div class="flex items-center space-x-2">
                                                    <span class="font-bold">{{ $detail['ans2'] }}</span>
                                                    <span>{{ $detail['ans1_second'] ?? '' }} {{ $detail['tablets'] ?? '' }}{{ $detail['tablet'] ?? '' }}{{ $detail['drops'] ?? '' }}{{ $detail['strips'] ?? '' }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @if(isset($detail['ans3']))
                                        <tr>
                                            <td class="border-b py-3">
                                                <div class="flex items-center space-x-2">
                                                    <span class="font-bold">{{ $detail['ans3'] }}</span>
                                                    <span>{{ $detail['ans1_third'] ?? '' }} {{ $detail['tablets'] ?? '' }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @if(isset($detail['ans4']))
                                        <tr>
                                            <td class="py-3">
                                                <div class="flex items-center space-x-2">
                                                    <span class="font-bold">{{ $detail['ans4'] }}</span>
                                                    <span>{{ $detail['ans1_four'] ?? '' }} {{ $detail['tablets'] ?? '' }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
