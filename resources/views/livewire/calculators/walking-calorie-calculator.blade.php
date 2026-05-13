<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-12 gap-x-8 gap-y-6">
                    {{-- Unit System Switch --}}
                    <div class="col-span-12 flex space-x-6 items-center">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" wire:model.live="unit_type" value="sl" class="w-4 h-4 text-[#2845F5] focus:ring-[#2845F5]">
                            <span class="text-sm font-medium text-gray-700">SI (cm, kg)</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" wire:model.live="unit_type" value="usa" class="w-4 h-4 text-[#2845F5] focus:ring-[#2845F5]">
                            <span class="text-sm font-medium text-gray-700">USA (ft, lbs)</span>
                        </label>
                    </div>

                    {{-- Age --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['1'] !!}:</label>
                        <input type="number" wire:model.live="age" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" placeholder="22">
                    </div>

                    {{-- Gender --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['2'] !!}:</label>
                        <select wire:model.live="gender" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer">
                            <option value="male">{{ $lang['8'] }}</option>
                            <option value="female">{{ $lang['9'] }}</option>
                        </select>
                    </div>

                    {{-- Height --}}
                    @if($unit_type === 'sl')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['3'] !!} (cm):</label>
                            <div class="relative">
                                <input type="number" wire:model.live="height" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="180">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs font-bold">cm</span>
                            </div>
                        </div>
                    @else
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['3'] !!} (ft/in):</label>
                            <div class="flex gap-2">
                                <div class="relative w-1/2">
                                    <input type="number" wire:model.live="height" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="5">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs font-bold">ft</span>
                                </div>
                                <div class="relative w-1/2">
                                    <input type="number" wire:model.live="inches" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="9">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs font-bold">in</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Weight --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['4'] !!} ({{ $unit_type === 'sl' ? 'kg' : 'lbs' }}):</label>
                        <div class="relative">
                            <input type="number" wire:model.live="weight" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="{{ $unit_type === 'sl' ? '80' : '175' }}">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs font-bold">{{ $unit_type === 'sl' ? 'kg' : 'lbs' }}</span>
                        </div>
                    </div>

                    {{-- Speed Dropdown --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['5'] !!}:</label>
                        <select wire:model.live="speed_unit" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer">
                            <option value="less than 2.0mph (3.2km/h)">less than 2.0mph (3.2km/h)</option>
                            <option value="2.0mph (3.2km/h)">2.0mph (3.2km/h)</option>
                            <option value="2.5mph (4.0km/h)">2.5mph (4.0km/h)</option>
                            <option value="3.0mph (4.8km/h)">3.0mph (4.8km/h)</option>
                            <option value="3.5mph (5.6km/h)">3.5mph (5.6km/h)</option>
                            <option value="4.0mph (6.4km/h)">4.0mph (6.4km/h)</option>
                            <option value="4.5mph (7.2km/h)">4.5mph (7.2km/h)</option>
                            <option value="5.0mph (8.0km/h)">5.0mph (8.0km/h)</option>
                        </select>
                    </div>

                    {{-- METs (Auto-updated but editable) --}}
                    <div class="col-span-12 md:col-span-3 lg:col-span-3">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['6'] !!}:</label>
                        <input type="number" step="any" wire:model.live="mets" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" placeholder="2">
                    </div>

                    {{-- Duration --}}
                    <div class="col-span-12 md:col-span-3 lg:col-span-3">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['7'] !!}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="duration" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-12" placeholder="120">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs font-bold">min</span>
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

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full bg-light-blue radius-10 p-3 mt-3">
                            <div class="w-full mt-2">
                                <div class="w-full border-b-dark pb-3">
                                    <div class="w-full md:w-[60%] lg:w-[60%] flex justify-between">
                                        <div>
                                            <p><strong>{{ $lang['12'] }}:</strong></p>
                                            <p>
                                                <strong class="text-green-700 text-[32px]">{{ $detail['burned'] }}</strong>
                                                <span class="text-blue-700 font-s-18">kcal</span>
                                            </p>
                                        </div>
                                        <div class="hidden md:block lg:block" style="border-right: 1px solid #c6c3c3">&nbsp;</div>
                                        <div>
                                            <p><strong>{{ $lang['13'] }}:</strong></p>
                                            <p>
                                                <strong class="text-green-700 text-[32px]">{{ round($detail['male_calories']) }}</strong>
                                                <span class="text-blue-700 font-s-18">kcal/{{ $lang['17'] }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full overflow-auto">
                                    <table class="w-full md:w-[60%] lg:w-[60%]">
                                        <tr>
                                            <td class="border-b py-3">
                                                <strong>{{ $lang['14'] }}:</strong>
                                                <strong class="text-green-700 text-[28px]">{{ round($detail['exercise'], 2) }}</strong>
                                                <span class="text-blue-700">{{ $lang['6'] }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">
                                                <strong>{{ $lang['15'] }}:</strong>
                                                <strong class="text-green-700 text-[28px]">{{ round($detail['hour_duration_min'], 2) }}</strong>
                                                <span class="text-blue-700">km</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3">
                                                <strong>{{ $lang['15'] }}:</strong>
                                                <strong class="text-green-700 text-[28px]">{{ round($detail['hour_mile'], 2) }}</strong>
                                                <span class="text-blue-700">{{ $lang['16'] }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>

