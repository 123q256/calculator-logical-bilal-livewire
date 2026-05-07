<div>
    <style>
        input[type="number"]:disabled {
            cursor: not-allowed;
            background-color: #f3f4f6;
        }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Checkboxes --}}
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 mt-3 gap-4">
                            <div class="col-span-6 md:col-span-3 lg:col-span-3 pe-1">
                                <div class="w-100 py-2">
                                    <input type="checkbox" wire:model.live="showHours" id="hours_check" value="1" class="cursor-pointer" />
                                    <label for="hours_check" class="cursor-pointer">{{ $lang['1'] ?? 'Hours' }}</label>
                                </div>
                            </div>
                            <div class="col-span-6 md:col-span-3 lg:col-span-3 px-1">
                                <div class="w-100 py-2">
                                    <input type="checkbox" wire:model.live="showMinutes" id="min_check" value="1" class="cursor-pointer" />
                                    <label for="min_check" class="cursor-pointer">{{ $lang['2'] ?? 'Minutes' }}</label>
                                </div>
                            </div>
                            <div class="col-span-6 md:col-span-3 lg:col-span-3 px-1">
                                <div class="w-100 py-2">
                                    <input type="checkbox" wire:model.live="showSeconds" id="sec_check" value="1" class="cursor-pointer" />
                                    <label for="sec_check" class="cursor-pointer">{{ $lang['3'] ?? 'Seconds' }}</label>
                                </div>
                            </div>
                            <div class="col-span-6 md:col-span-3 lg:col-span-3 px-1">
                                <div class="w-100 py-2">
                                    <input type="checkbox" wire:model.live="showMilli" id="milli_check" value="1" class="cursor-pointer" />
                                    <label for="milli_check" class="cursor-pointer">{{ $lang['4'] ?? 'Milliseconds' }}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Dynamic Rows --}}
                    @foreach($rows as $index => $row)
                        <div class="col-span-12 align-items-center">
                            <div class="grid grid-cols-12 mt-3 gap-4">
                                <div class="col-span-3 flex items-center">
                                    <span class="text-blue text-[25px] pe-2">{{ $index == 0 ? '' : '+' }}</span>
                                    <div class="w-100 py-2">
                                        <input type="number" min="0" wire:model="rows.{{ $index }}.hour" 
                                               class="input hours" aria-label="Hours" 
                                               placeholder="{{ $lang[5] ?? 'Hr' }}" 
                                               @if(!$showHours) disabled @endif />
                                    </div>
                                </div>
                                <div class="col-span-3">
                                    <div class="w-100 py-2">
                                        <input type="number" min="0" wire:model="rows.{{ $index }}.min" 
                                               class="input minutes" aria-label="Minutes" 
                                               placeholder="{{ $lang[6] ?? 'Min' }}" 
                                               @if(!$showMinutes) disabled @endif />
                                    </div>
                                </div>
                                <div class="col-span-3">
                                    <div class="w-100 py-2">
                                        <input type="number" min="0" wire:model="rows.{{ $index }}.sec" 
                                               class="input seconds" aria-label="Seconds" 
                                               placeholder="{{ $lang[7] ?? 'Sec' }}" 
                                               @if(!$showSeconds) disabled @endif />
                                    </div>
                                </div>
                                <div class="col-span-3 flex items-center">
                                    <div class="w-100 py-2">
                                        <input type="number" min="0" wire:model="rows.{{ $index }}.milli" 
                                               class="input milliseconds" aria-label="Milliseconds" 
                                               placeholder="{{ $lang[8] ?? 'Ms' }}" 
                                               @if(!$showMilli) disabled @endif />
                                    </div>
                                    @if(count($rows) > 2)
                                        <img src="{{ asset('images/delete.png') }}" 
                                             width="18px" height="18px" 
                                             style="filter: invert(28%) sepia(100%) saturate(7432%) hue-rotate(354deg) brightness(91%) contrast(100%);"
                                             class="cursor-pointer mx-2" 
                                             wire:click="removeRow({{ $index }})" 
                                             alt="Remove">
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-span-12 text-end pe-2 mt-4">
                        <span wire:click="addRow" class="px-3 py-2 bg-white text-blue border radius-5 cursor-pointer">+ {{ $lang[9] ?? 'Add Row' }}</span>
                    </div>
                </div>
            </div>
               @if ($type == 'calculator')
        @include('inc.button')
       @endif
       @if ($type=='widget')
       @include('inc.widget-button')
        @endif
        </div>

   

        @if(isset($detail))
            <hr>
            <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-8 space-y-6">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="col-lg-10 font-s-18 overflow-auto">
                                    <table class="w-full">
                                        @foreach ($detail['hour_list'] as $key => $value)
                                            <tr>
                                                <td class="border-b py-2">
                                                    <span>
                                                        @if($loop->last) + @else &nbsp; @endif
                                                    </span>
                                                    {{ $value }} {{ $lang[5] ?? 'Hr' }}
                                                </td>
                                                <td class="border-b py-2">
                                                    {{ $detail['min_list'][$key] }}
                                                    {{ $lang[6] ?? 'Min' }}
                                                </td>
                                                <td class="border-b py-2">
                                                    {{ $detail['sec_list'][$key] }}
                                                    {{ $lang[7] ?? 'Sec' }}
                                                </td>
                                                <td class="border-b py-2">
                                                    {{ $detail['mili_list'][$key] }}
                                                    {{ $lang[8] ?? 'Ms' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="border-b py-2">
                                                <b class="font_size30 text-accent-4 orange-text">
                                                    {{ round($detail['time_hour']) }}
                                                </b>
                                                {{ $lang[5] ?? 'Hr' }}
                                            </td>
                                            <td class="border-b py-2">
                                                <b class="font_size30 text-accent-4 orange-text">
                                                    {{ round($detail['time_minutes']) }}
                                                </b>
                                                {{ $lang[6] ?? 'Min' }}
                                            </td>
                                            <td class="border-b py-2">
                                                <b class="font_size30 text-accent-4 orange-text">
                                                    {{ round($detail['time_seconds']) }}
                                                </b>
                                                {{ $lang[7] ?? 'Sec' }}
                                            </td>
                                            <td class="border-b py-2">
                                                <b class="font_size30 text-accent-4 orange-text">
                                                    {{ round($detail['time_miliseconds'], 2) }}
                                                </b>
                                                {{ $lang[8] ?? 'Ms' }}
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
