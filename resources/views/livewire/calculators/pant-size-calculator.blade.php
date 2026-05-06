<div x-data="{ dropdowns: {} }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4 mt-3">
                    {{-- Waist Input --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="weist" class="label">
                            {{ $measure == 'myself' ? $lang['1'] : $lang['2'] }}:
                        </label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="weist" id="weist" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['weist'] = !dropdowns['weist']">
                                {{ $measure_in_weiat }} ▾
                            </label>
                            <div x-show="dropdowns['weist']" @click.away="dropdowns['weist'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                @foreach(['cm' => 'centimeters (cm)', 'dm' => 'decimeter (dm)', 'in' => 'inches (in)'] as $val => $label)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('measure_in_weiat', '{{ $val }}'); dropdowns['weist'] = false">{{ $label }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Length Input --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="length" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="length" id="length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['length'] = !dropdowns['length']">
                                {{ $measure_in_length }} ▾
                            </label>
                            <div x-show="dropdowns['length']" @click.away="dropdowns['length'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                @foreach(['cm' => 'centimeters (cm)', 'dm' => 'decimeter (dm)', 'in' => 'inches (in)'] as $val => $label)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('measure_in_length', '{{ $val }}'); dropdowns['length'] = false">{{ $label }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Measure selection --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="measure" class="label">{{ $lang['4'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="measure" id="measure" class="input">
                                <option value="myself">{{ $lang['5'] }}</option>
                                <option value="pair">{{ $lang['6'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Gender selection --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="gender" class="label">{{ $lang['7'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="gender" id="gender" class="input">
                                <option value="male">{{ $lang['8'] }}</option>
                                <option value="female">{{ $lang['9'] }}</option>
                            </select>
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

        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full mt-3">
                                <div class="w-full">
                                    <div class="w-full md:w-[60%] lg:w-[60%] text-[18px]">
                                        <table class="w-full">
                                            @if(!empty($detail['result_us']))
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong>US {{$lang['10']}}:</strong></td>
                                                    <td class="border-b py-2">{{$detail['result_us']}}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($detail['result_india']))
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong>India {{$lang['10']}}:</strong></td>
                                                    <td class="border-b py-2">{{$detail['result_india']}}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($detail['result_uk']))
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong>United Kindom {{$lang['10']}}:</strong></td>
                                                    <td class="border-b py-2">{{$detail['result_uk']}}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($detail['result_eu']))
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong>European {{$lang['10']}}:</strong></td>
                                                    <td class="border-b py-2">{{$detail['result_eu']}}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($detail['result_it']))
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong>Italian {{$lang['10']}}:</strong></td>
                                                    <td class="border-b py-2">{{$detail['result_it']}}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($detail['result_ru']))
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong>Russian {{$lang['10']}}:</strong></td>
                                                    <td class="border-b py-2">{{$detail['result_ru']}}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($detail['result_ja']))
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong>Japanese {{$lang['10']}}:</strong></td>
                                                    <td class="border-b py-2">{{$detail['result_ja']}}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
</div>
