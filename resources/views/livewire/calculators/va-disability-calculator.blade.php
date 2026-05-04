<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
        @endif

        <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
            <div class="grid grid-cols-12 gap-4 mt-3">
                <div class="col-span-12 font-bold text-sm">{{ $lang['1'] ?? 'Physical Disability Ratings' }}</div>
                
                <div class="col-span-12 md:col-span-6">
                    <label for="right_arm" class="label">{{ $lang['2'] ?? 'Right Arm' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="right_arm" class="input" id="right_arm">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="left_arm" class="label">{{ $lang['3'] ?? 'Left Arm' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="left_arm" class="input" id="left_arm">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="right_leg" class="label">{{ $lang['4'] ?? 'Right Leg' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="right_leg" class="input" id="right_leg">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="left_leg" class="label">{{ $lang['5'] ?? 'Left Leg' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="left_leg" class="input" id="left_leg">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="right_foot" class="label">{{ $lang['6'] ?? 'Right Foot' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="right_foot" class="input" id="right_foot">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="left_foot" class="label">{{ $lang['7'] ?? 'Left Foot' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="left_foot" class="input" id="left_foot">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="back" class="label">{{ $lang['8'] ?? 'Back' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="back" class="input" id="back">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 font-bold text-sm mt-4">{{ $lang['9'] ?? 'Other Conditions' }}</div>
                
                <div class="col-span-12 md:col-span-6">
                    <label for="ssd" class="label">{{ $lang['9'] ?? 'Sleep Apnea' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="ssd" class="input" id="ssd">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="ptsd" class="label">{{ $lang['10'] ?? 'PTSD' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="ptsd" class="input" id="ptsd">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="tinnitus" class="label">{{ $lang['11'] ?? 'Tinnitus' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="tinnitus" class="input" id="tinnitus">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="migraines" class="label">{{ $lang['12'] ?? 'Migraines' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="migraines" class="input" id="migraines">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="sleep_apnea" class="label">{{ $lang['13'] ?? 'Sleep Apnea' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="sleep_apnea" class="input" id="sleep_apnea">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="bilateral_upper" class="label">{{ $lang['14'] ?? 'Bilateral Upper' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="bilateral_upper" class="input" id="bilateral_upper">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="bilateral_lower" class="label">{{ $lang['15'] ?? 'Bilateral Lower' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="bilateral_lower" class="input" id="bilateral_lower">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="others" class="label">{{ $lang['16'] ?? 'Others' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="others" class="input" id="others">
                            @for ($i = 0; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 font-bold text-sm mt-4">{{ $lang[17] ?? 'Dependency Status' }}</div>
                
                <div class="col-span-12 md:col-span-6">
                    <label for="status" class="label">{{ $lang[18] ?? 'Marital Status' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="status" class="input" id="status">
                            <option value="{{ $lang[19] ?? 'Single' }}">{{ $lang[19] ?? 'Single' }}</option>
                            <option value="{{ $lang[20] ?? 'Married' }}">{{ $lang[20] ?? 'Married' }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="under_age" class="label">{{ $lang[21] ?? 'Children under' }} 18:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="under_age" class="input" id="under_age">
                            @for ($i = 0; $i <= 15; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="over_age" class="label">{{ $lang[22] ?? 'Children over' }} 18:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="over_age" class="input" id="over_age">
                            @for ($i = 0; $i <= 15; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                    <label for="parent" class="label">{{ $lang[23] ?? 'Parents' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="parent" class="input" id="parent">
                            <option value="0">{{ $lang[24] ?? 'None' }}</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>

                @if($status === ($lang[20] ?? 'Married'))
                    <div class="col-span-12 md:col-span-6">
                        <label for="attendance" class="label">{{ $lang[29] ?? 'Spouse Aid and' }} {{ $lang[30] ?? 'Attendance' }}?</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="attendance" class="input" id="attendance">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                    </div>
                @endif
            </div>

                @if ($type == 'calculator')
                    @include('inc.button')
                @else
                    @include('inc.widget-button')
                @endif
        </div>
    </div>

    <hr class="border-gray-100">

    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
           <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full md:w-[80%] lg:w-[80%]  mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[25] }}  </strong></td>
                                <td class="py-2 border-b"> {{ round($detail['total_combined'], 4) }}%</td>
                            </tr>
                            <tr>
                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[26] }}  </strong></td>
                                <td class="py-2 border-b"> {{ round($detail['total_cumulative'], 4) }}%</td>
                            </tr>
                            <tr>
                            <td class="py-2 border-b" width="50%"><strong>💵 {{ $lang[27] }}  </strong></td>
                                <td class="py-2 border-b"> {{ $currancy}} {{ round($detail['rate'], 4) }} {{ $lang[28] }}</td>
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
